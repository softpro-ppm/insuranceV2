<!-- Page Header -->
<div class="page-header">
    <h1 class="page-title">Dashboard</h1>
    <p class="page-subtitle">Welcome back! Here's what's happening with your insurance business today.</p>
</div>

<!-- A. Enhanced Statistics Cards -->
<div class="row g-4 mb-4">
    <!-- Total Premium Card -->
    <div class="col-lg-3 col-md-6">
        <div class="stat-card primary">
            <div class="stat-icon primary">
                <i class="fas fa-rupee-sign"></i>
            </div>
            <div class="stat-number">₹<?= number_format($stats['premium_fy'] ?? 0, 0) ?></div>
            <div class="stat-label">Total Premium (<?= $stats['fy_label'] ?? 'FY' ?>)</div>
            <div class="d-flex align-items-center mt-2">
                <small class="text-muted">Current Month: ₹<?= number_format($stats['premium_current_month'] ?? 0, 0) ?></small>
            </div>
        </div>
    </div>
    
    <!-- Revenue Card -->
    <div class="col-lg-3 col-md-6">
        <div class="stat-card success">
            <div class="stat-icon success">
                <i class="fas fa-chart-line"></i>
            </div>
            <div class="stat-number">₹<?= number_format($stats['revenue_fy'] ?? 0, 0) ?></div>
            <div class="stat-label">Revenue (<?= $stats['fy_label'] ?? 'FY' ?>)</div>
            <div class="d-flex align-items-center mt-2">
                <small class="text-muted">Current Month: ₹<?= number_format($stats['revenue_current_month'] ?? 0, 0) ?></small>
            </div>
        </div>
    </div>
    
    <!-- Policies Card -->
    <div class="col-lg-3 col-md-6">
        <div class="stat-card info">
            <div class="stat-icon info">
                <i class="fas fa-file-contract"></i>
            </div>
            <div class="stat-number"><?= number_format($stats['policies_current_month'] ?? 0) ?></div>
            <div class="stat-label">New Policies (Current Month)</div>
            <div class="d-flex align-items-center mt-2">
                <i class="fas fa-sync-alt text-success me-1"></i>
                <small class="text-success">Renewed: <?= $stats['renewed_current_month'] ?? 0 ?></small>
            </div>
        </div>
    </div>
    
    <!-- Renewals & Expiry Card -->
    <div class="col-lg-3 col-md-6">
        <div class="stat-card warning">
            <div class="stat-icon warning">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <div class="stat-number"><?= number_format($stats['pending_renewal'] ?? 0) ?></div>
            <div class="stat-label">Pending Renewal (Current Month)</div>
            <div class="d-flex align-items-center mt-2">
                <small class="text-danger">Expired: <?= $stats['expired_policies'] ?? 0 ?></small>
                <span class="mx-1">|</span>
                <small class="text-warning">Expiring: <?= $stats['expiring_soon'] ?? 0 ?></small>
            </div>
        </div>
    </div>
</div>

<!-- B. Charts Section -->
<div class="row g-4 mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-chart-bar me-2"></i>
                    Business Analytics
                </h5>
                <div class="d-flex align-items-center">
                    <select class="form-select form-select-sm me-3" id="periodFilter" style="width: auto;">
                        <option value="12months" selected>Last 12 Months</option>
                        <option value="fy2024-25">FY 2024-25</option>
                        <option value="fy2023-24">FY 2023-24</option>
                        <option value="fy2022-23">FY 2022-23</option>
                    </select>
                    <button class="btn btn-sm btn-outline-primary" onclick="refreshChart()">
                        <i class="fas fa-sync-alt"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <canvas id="businessChart" height="100"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- C. Pending Renewal Policies Table -->
<div class="row g-4 mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-clock me-2"></i>
                    Pending Renewal Policies (Current Month)
                </h5>
                <a href="/policies" class="btn btn-sm btn-primary">
                    <i class="fas fa-list me-1"></i>
                    View All Policies
                </a>
            </div>
            <div class="card-body">
                <?php if (!empty($pending_renewal_policies)): ?>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Policy Number</th>
                                <th>Customer</th>
                                <th>Policy Type</th>
                                <th>Company</th>
                                <th>Premium</th>
                                <th>Expiry Date</th>
                                <th>Days Left</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pending_renewal_policies as $policy): ?>
                            <tr>
                                <td>
                                    <strong class="text-primary"><?= htmlspecialchars($policy['policy_number']) ?></strong>
                                </td>
                                <td>
                                    <div>
                                        <strong><?= htmlspecialchars($policy['customer_name']) ?></strong><br>
                                        <small class="text-muted"><?= htmlspecialchars($policy['customer_phone']) ?></small>
                                    </div>
                                </td>
                                <td><?= htmlspecialchars($policy['policy_type_name'] ?? $policy['category']) ?></td>
                                <td><?= htmlspecialchars($policy['company_name'] ?? 'N/A') ?></td>
                                <td>₹<?= number_format($policy['premium_amount'], 0) ?></td>
                                <td>
                                    <span class="badge bg-warning">
                                        <?= date('d M, Y', strtotime($policy['policy_end_date'])) ?>
                                    </span>
                                </td>
                                <td>
                                    <?php 
                                    $days = $policy['days_to_expire'];
                                    $class = $days <= 7 ? 'danger' : ($days <= 15 ? 'warning' : 'success');
                                    ?>
                                    <span class="badge bg-<?= $class ?>">
                                        <?= $days ?> days
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-outline-primary" onclick="renewPolicy(<?= $policy['id'] ?>)">
                                            <i class="fas fa-sync-alt"></i>
                                        </button>
                                        <button class="btn btn-outline-info" onclick="viewPolicy(<?= $policy['id'] ?>)">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php else: ?>
                <div class="text-center py-4">
                    <i class="fas fa-check-circle text-success" style="font-size: 3rem;"></i>
                    <h5 class="mt-3">No Pending Renewals</h5>
                    <p class="text-muted">All policies are up to date for this month!</p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js and Dashboard JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Chart Data from PHP
const chartData = <?= json_encode($chart_data) ?>;

// Initialize Chart
let businessChart;

function initChart(data) {
    const ctx = document.getElementById('businessChart').getContext('2d');
    
    if (businessChart) {
        businessChart.destroy();
    }
    
    businessChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: data.map(item => item.month),
            datasets: [
                {
                    label: 'Policies Count',
                    data: data.map(item => item.policies),
                    backgroundColor: 'rgba(99, 102, 241, 0.7)',
                    borderColor: 'rgba(99, 102, 241, 1)',
                    borderWidth: 2,
                    yAxisID: 'y'
                },
                {
                    label: 'Premium (₹)',
                    data: data.map(item => item.premium),
                    backgroundColor: 'rgba(34, 197, 94, 0.7)',
                    borderColor: 'rgba(34, 197, 94, 1)',
                    borderWidth: 2,
                    yAxisID: 'y1'
                },
                {
                    label: 'Revenue (₹)',
                    data: data.map(item => item.revenue),
                    backgroundColor: 'rgba(251, 191, 36, 0.7)',
                    borderColor: 'rgba(251, 191, 36, 1)',
                    borderWidth: 2,
                    yAxisID: 'y1'
                }
            ]
        },
        options: {
            responsive: true,
            interaction: {
                mode: 'index',
                intersect: false,
            },
            plugins: {
                title: {
                    display: true,
                    text: 'Business Performance Analytics'
                },
                legend: {
                    position: 'top',
                }
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
                        text: 'Number of Policies'
                    }
                },
                y1: {
                    type: 'linear',
                    display: true,
                    position: 'right',
                    title: {
                        display: true,
                        text: 'Amount (₹)'
                    },
                    grid: {
                        drawOnChartArea: false,
                    },
                    ticks: {
                        callback: function(value) {
                            return '₹' + value.toLocaleString();
                        }
                    }
                }
            },
            elements: {
                bar: {
                    borderRadius: 4
                }
            }
        }
    });
}

// Initialize chart on page load
document.addEventListener('DOMContentLoaded', function() {
    initChart(chartData);
});

// Refresh chart based on period selection
function refreshChart() {
    const period = document.getElementById('periodFilter').value;
    
    // Show loading
    const chartContainer = document.querySelector('#businessChart').parentElement;
    chartContainer.innerHTML = '<div class="text-center py-4"><i class="fas fa-spinner fa-spin"></i> Loading chart data...</div>';
    
    // Fetch new data based on period
    fetch(`/api/chart-data?period=${period}`)
        .then(response => response.json())
        .then(data => {
            chartContainer.innerHTML = '<canvas id="businessChart" height="100"></canvas>';
            initChart(data);
        })
        .catch(error => {
            console.error('Error fetching chart data:', error);
            chartContainer.innerHTML = '<div class="text-center py-4 text-danger"><i class="fas fa-exclamation-triangle"></i> Error loading chart data</div>';
        });
}

// Policy action functions
function renewPolicy(policyId) {
    if (confirm('Are you sure you want to renew this policy?')) {
        window.location.href = `/policies/${policyId}/renew`;
    }
}

function viewPolicy(policyId) {
    window.location.href = `/policies/${policyId}/view`;
}

// Auto-refresh dashboard every 5 minutes
setInterval(function() {
    location.reload();
}, 300000);
</script>
