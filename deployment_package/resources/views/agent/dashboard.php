<?php
/**
 * Agent Dashboard
 * Insurance Management System v2.0
 */

session_start();

// Check if user is logged in as agent
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'agent') {
    header('Location: /agent-login.php');
    exit;
}

require_once __DIR__ . '/../include/config.php';

$agent_id = $_SESSION['user_id'];
$agent_name = $_SESSION['name'];

// Get agent statistics
$current_month = date('n');
$current_year = date('Y');

// This month's performance
$stmt = $conn->prepare("SELECT policies_sold, total_premium, total_revenue, commission_earned FROM agent_performance WHERE agent_id = ? AND month = ? AND year = ?");
$stmt->bind_param("iii", $agent_id, $current_month, $current_year);
$stmt->execute();
$current_performance = $stmt->get_result()->fetch_assoc() ?: ['policies_sold' => 0, 'total_premium' => 0, 'total_revenue' => 0, 'commission_earned' => 0];

// Recent policies
$stmt = $conn->prepare("
    SELECT p.*, c.name as customer_name, ic.name as company_name, pt.name as policy_type_name 
    FROM policies p 
    JOIN customers c ON p.customer_id = c.id 
    JOIN insurance_companies ic ON p.insurance_company_id = ic.id 
    JOIN policy_types pt ON p.policy_type_id = pt.id 
    WHERE c.created_by = ? 
    ORDER BY p.created_at DESC 
    LIMIT 10
");
$stmt->bind_param("i", $agent_id);
$stmt->execute();
$recent_policies = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

// Monthly performance for chart (last 6 months)
$monthly_data = [];
for ($i = 5; $i >= 0; $i--) {
    $month = date('n', strtotime("-$i months"));
    $year = date('Y', strtotime("-$i months"));
    
    $stmt = $conn->prepare("SELECT policies_sold, total_premium FROM agent_performance WHERE agent_id = ? AND month = ? AND year = ?");
    $stmt->bind_param("iii", $agent_id, $month, $year);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    
    $monthly_data[] = [
        'month' => date('M Y', strtotime("$year-$month-01")),
        'policies' => $result['policies_sold'] ?? 0,
        'premium' => $result['total_premium'] ?? 0
    ];
}

// Customer count
$stmt = $conn->prepare("SELECT COUNT(*) as count FROM customers WHERE created_by = ?");
$stmt->bind_param("i", $agent_id);
$stmt->execute();
$customer_count = $stmt->get_result()->fetch_assoc()['count'];

// Expiring policies (next 30 days)
$stmt = $conn->prepare("
    SELECT p.*, c.name as customer_name, c.phone 
    FROM policies p 
    JOIN customers c ON p.customer_id = c.id 
    WHERE c.created_by = ? 
    AND p.policy_end_date BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 30 DAY)
    AND p.status = 'active'
    ORDER BY p.policy_end_date ASC
");
$stmt->bind_param("i", $agent_id);
$stmt->execute();
$expiring_policies = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agent Dashboard - Insurance Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            background: #f8f9fc;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .stat-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 15px;
            color: white;
            transition: transform 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
        }
        
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 10px;
        }
        
        .table th {
            border-top: none;
            background: #f8f9fc;
            color: #5a5c69;
            font-weight: 600;
        }
        
        .badge {
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="#">
                <i class="fas fa-shield-alt me-2"></i>Agent Portal
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="/agent/dashboard">
                            <i class="fas fa-tachometer-alt me-1"></i>Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/customers/create">
                            <i class="fas fa-user-plus me-1"></i>Add Customer
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/policies/create">
                            <i class="fas fa-file-plus me-1"></i>New Policy
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/agent/customers">
                            <i class="fas fa-users me-1"></i>My Customers
                        </a>
                    </li>
                </ul>
                
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user me-1"></i><?= htmlspecialchars($agent_name) ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/agent/profile">
                                <i class="fas fa-user-cog me-2"></i>Profile
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="/agent/logout">
                                <i class="fas fa-sign-out-alt me-2"></i>Logout
                            </a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid mt-4">
        <!-- Welcome Section -->
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="text-dark mb-1">Welcome back, <?= htmlspecialchars(explode(' ', $agent_name)[0]) ?>! 👋</h2>
                <p class="text-muted">Here's what's happening with your insurance business today.</p>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card stat-card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="card-text opacity-75 mb-1">This Month Policies</p>
                                <h3 class="card-title mb-0"><?= number_format($current_performance['policies_sold']) ?></h3>
                            </div>
                            <div class="fa-2x opacity-75">
                                <i class="fas fa-file-contract"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card stat-card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="card-text opacity-75 mb-1">Premium Generated</p>
                                <h3 class="card-title mb-0">₹<?= number_format($current_performance['total_premium']) ?></h3>
                            </div>
                            <div class="fa-2x opacity-75">
                                <i class="fas fa-rupee-sign"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card stat-card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="card-text opacity-75 mb-1">Commission Earned</p>
                                <h3 class="card-title mb-0">₹<?= number_format($current_performance['commission_earned']) ?></h3>
                            </div>
                            <div class="fa-2x opacity-75">
                                <i class="fas fa-coins"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card stat-card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="card-text opacity-75 mb-1">Total Customers</p>
                                <h3 class="card-title mb-0"><?= number_format($customer_count) ?></h3>
                            </div>
                            <div class="fa-2x opacity-75">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Performance Chart -->
            <div class="col-xl-8 col-lg-7 mb-4">
                <div class="card">
                    <div class="card-header bg-transparent">
                        <h5 class="mb-0">
                            <i class="fas fa-chart-line me-2 text-primary"></i>Performance Trend
                        </h5>
                    </div>
                    <div class="card-body">
                        <canvas id="performanceChart" style="height: 300px;"></canvas>
                    </div>
                </div>
            </div>

            <!-- Expiring Policies -->
            <div class="col-xl-4 col-lg-5 mb-4">
                <div class="card">
                    <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="fas fa-exclamation-triangle me-2 text-warning"></i>Expiring Soon
                        </h5>
                        <span class="badge bg-warning"><?= count($expiring_policies) ?></span>
                    </div>
                    <div class="card-body" style="max-height: 350px; overflow-y: auto;">
                        <?php if (empty($expiring_policies)): ?>
                            <div class="text-center text-muted py-4">
                                <i class="fas fa-check-circle fa-2x mb-2"></i>
                                <p>No policies expiring soon!</p>
                            </div>
                        <?php else: ?>
                            <?php foreach ($expiring_policies as $policy): ?>
                                <div class="d-flex justify-content-between align-items-center mb-3 p-2 bg-light rounded">
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1"><?= htmlspecialchars($policy['customer_name']) ?></h6>
                                        <small class="text-muted">
                                            <i class="fas fa-phone me-1"></i><?= htmlspecialchars($policy['phone']) ?>
                                        </small><br>
                                        <small class="text-danger">
                                            <i class="fas fa-calendar me-1"></i>Expires: <?= date('d M Y', strtotime($policy['policy_end_date'])) ?>
                                        </small>
                                    </div>
                                    <a href="tel:<?= htmlspecialchars($policy['phone']) ?>" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-phone"></i>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Policies -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="fas fa-history me-2 text-primary"></i>Recent Policies
                        </h5>
                        <a href="/policies/create" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus me-1"></i>New Policy
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Policy Number</th>
                                        <th>Customer</th>
                                        <th>Type</th>
                                        <th>Company</th>
                                        <th>Premium</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($recent_policies)): ?>
                                        <tr>
                                            <td colspan="7" class="text-center text-muted py-4">
                                                <i class="fas fa-file-contract fa-2x mb-2"></i><br>
                                                No policies found. <a href="/policies/create">Create your first policy</a>
                                            </td>
                                        </tr>
                                    <?php else: ?>
                                        <?php foreach ($recent_policies as $policy): ?>
                                            <tr>
                                                <td>
                                                    <strong><?= htmlspecialchars($policy['policy_number']) ?></strong>
                                                </td>
                                                <td><?= htmlspecialchars($policy['customer_name']) ?></td>
                                                <td>
                                                    <span class="badge bg-secondary"><?= ucfirst($policy['category']) ?></span>
                                                    <br><small class="text-muted"><?= htmlspecialchars($policy['policy_type_name']) ?></small>
                                                </td>
                                                <td><?= htmlspecialchars($policy['company_name']) ?></td>
                                                <td>₹<?= number_format($policy['premium_amount']) ?></td>
                                                <td>
                                                    <?php
                                                    $status_class = $policy['status'] === 'active' ? 'success' : 
                                                                   ($policy['status'] === 'expired' ? 'warning' : 'danger');
                                                    ?>
                                                    <span class="badge bg-<?= $status_class ?>"><?= ucfirst($policy['status']) ?></span>
                                                </td>
                                                <td><?= date('d M Y', strtotime($policy['created_at'])) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Performance Chart
        const ctx = document.getElementById('performanceChart').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?= json_encode(array_column($monthly_data, 'month')) ?>,
                datasets: [{
                    label: 'Policies Sold',
                    data: <?= json_encode(array_column($monthly_data, 'policies')) ?>,
                    borderColor: 'rgb(102, 126, 234)',
                    backgroundColor: 'rgba(102, 126, 234, 0.1)',
                    tension: 0.4,
                    yAxisID: 'y'
                }, {
                    label: 'Premium (₹)',
                    data: <?= json_encode(array_column($monthly_data, 'premium')) ?>,
                    borderColor: 'rgb(118, 75, 162)',
                    backgroundColor: 'rgba(118, 75, 162, 0.1)',
                    tension: 0.4,
                    yAxisID: 'y1'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
                scales: {
                    x: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Month'
                        }
                    },
                    y: {
                        type: 'linear',
                        display: true,
                        position: 'left',
                        title: {
                            display: true,
                            text: 'Policies Count'
                        }
                    },
                    y1: {
                        type: 'linear',
                        display: true,
                        position: 'right',
                        title: {
                            display: true,
                            text: 'Premium Amount (₹)'
                        },
                        grid: {
                            drawOnChartArea: false,
                        },
                    }
                }
            }
        });
    </script>
</body>
</html>
