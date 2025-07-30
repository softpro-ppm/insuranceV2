<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Insurance Management System v2.0' ?></title>
    <link rel="shortcut icon" href="/assets/logo.PNG">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #556ee6;
            --secondary-color: #f8f9fa;
            --success-color: #34c38f;
            --danger-color: #f46a6a;
            --warning-color: #f1b44c;
            --info-color: #50a5f1;
            --dark-color: #343a40;
        }
        
        body {
            background-color: #f8f9fa;
            font-family: 'Poppins', sans-serif;
        }
        
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        
        .sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 12px 20px;
            margin: 2px 10px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: rgba(255,255,255,0.1);
            color: white;
            transform: translateX(5px);
        }
        
        .sidebar .nav-link i {
            width: 20px;
            margin-right: 10px;
        }
        
        .main-content {
            background-color: #f8f9fa;
            min-height: 100vh;
        }
        
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            transition: transform 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-2px);
        }
        
        .stats-card {
            background: linear-gradient(135deg, var(--primary-color) 0%, #4f46e5 100%);
            color: white;
        }
        
        .stats-card.success {
            background: linear-gradient(135deg, var(--success-color) 0%, #059669 100%);
        }
        
        .stats-card.warning {
            background: linear-gradient(135deg, var(--warning-color) 0%, #d97706 100%);
        }
        
        .stats-card.danger {
            background: linear-gradient(135deg, var(--danger-color) 0%, #dc2626 100%);
        }
        
        .navbar-brand {
            font-weight: 600;
            color: var(--primary-color) !important;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color) 0%, #4f46e5 100%);
            border: none;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(85, 110, 230, 0.4);
        }
        
        .table {
            background: white;
            border-radius: 12px;
            overflow: hidden;
        }
        
        .breadcrumb {
            background: transparent;
            margin-bottom: 0;
        }
        
        .logo-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: 700;
            font-size: 1.2rem;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 px-0">
                <div class="sidebar">
                    <div class="p-3 text-center border-bottom border-light border-opacity-25">
                        <h5 class="text-white mb-0">
                            <i class="fas fa-shield-alt me-2"></i>
                            <span class="logo-text text-white">Insurance v2.0</span>
                        </h5>
                    </div>
                    
                    <nav class="nav flex-column py-3">
                        <a class="nav-link <?= ($current_page ?? '') === 'dashboard' ? 'active' : '' ?>" href="/dashboard">
                            <i class="fas fa-tachometer-alt"></i>Dashboard
                        </a>
                        
                        <div class="nav-item">
                            <a class="nav-link <?= in_array(($current_page ?? ''), ['policies', 'add-policy']) ? 'active' : '' ?>" 
                               data-bs-toggle="collapse" href="#policyMenu" role="button">
                                <i class="fas fa-file-contract"></i>Policies
                                <i class="fas fa-chevron-down ms-auto"></i>
                            </a>
                            <div class="collapse <?= in_array(($current_page ?? ''), ['policies', 'add-policy']) ? 'show' : '' ?>" id="policyMenu">
                                <a class="nav-link ps-5 <?= ($current_page ?? '') === 'add-policy' ? 'active' : '' ?>" href="/policies/create">
                                    <i class="fas fa-plus"></i>Add Policy
                                </a>
                                <a class="nav-link ps-5 <?= ($current_page ?? '') === 'policies' ? 'active' : '' ?>" href="/policies">
                                    <i class="fas fa-list"></i>All Policies
                                </a>
                            </div>
                        </div>
                        
                        <a class="nav-link <?= ($current_page ?? '') === 'customers' ? 'active' : '' ?>" href="/customers">
                            <i class="fas fa-users"></i>Customers
                        </a>
                        
                        <a class="nav-link <?= ($current_page ?? '') === 'renewals' ? 'active' : '' ?>" href="/renewals">
                            <i class="fas fa-sync-alt"></i>Renewals
                        </a>
                        
                        <a class="nav-link <?= ($current_page ?? '') === 'followups' ? 'active' : '' ?>" href="/followups">
                            <i class="fas fa-phone"></i>Follow-ups
                        </a>
                        
                        <a class="nav-link <?= ($current_page ?? '') === 'reports' ? 'active' : '' ?>" href="/reports">
                            <i class="fas fa-chart-bar"></i>Reports
                        </a>
                        
                        <hr class="border-light border-opacity-25 mx-3">
                        
                        <a class="nav-link <?= ($current_page ?? '') === 'settings' ? 'active' : '' ?>" href="/settings">
                            <i class="fas fa-cog"></i>Settings
                        </a>
                        
                        <a class="nav-link" href="/logout">
                            <i class="fas fa-sign-out-alt"></i>Logout
                        </a>
                    </nav>
                </div>
            </div>
            
            <!-- Main Content -->
            <div class="col-md-9 col-lg-10">
                <div class="main-content">
                    <!-- Top Navigation -->
                    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
                        <div class="container-fluid">
                            <ol class="breadcrumb mb-0">
                                <?php if (isset($breadcrumbs)): ?>
                                    <?php 
                                    $breadcrumb_keys = array_keys($breadcrumbs);
                                    $last_key = end($breadcrumb_keys);
                                    ?>
                                    <?php foreach ($breadcrumbs as $key => $breadcrumb): ?>
                                        <?php if ($key === $last_key): ?>
                                            <li class="breadcrumb-item active"><?= htmlspecialchars($breadcrumb['title']) ?></li>
                                        <?php else: ?>
                                            <li class="breadcrumb-item">
                                                <a href="<?= htmlspecialchars($breadcrumb['url']) ?>"><?= htmlspecialchars($breadcrumb['title']) ?></a>
                                            </li>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </ol>
                            
                            <div class="d-flex align-items-center">
                                <div class="dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                        <i class="fas fa-user-circle fa-lg"></i>
                                        <span class="ms-1"><?= $_SESSION['user_name'] ?? 'Admin' ?></span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a class="dropdown-item" href="/profile"><i class="fas fa-user me-2"></i>Profile</a></li>
                                        <li><a class="dropdown-item" href="/settings"><i class="fas fa-cog me-2"></i>Settings</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item" href="/logout"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </nav>
                    
                    <!-- Page Content -->
                    <div class="container-fluid py-4">
                        <?php if (isset($_SESSION['success'])): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <?= htmlspecialchars($_SESSION['success']) ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                            <?php unset($_SESSION['success']); ?>
                        <?php endif; ?>
                        
                        <?php if (isset($_SESSION['error'])): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?= htmlspecialchars($_SESSION['error']) ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                            <?php unset($_SESSION['error']); ?>
                        <?php endif; ?>
                        
                        <?= $content ?? '' ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script>
        // Auto-hide alerts after 5 seconds
        setTimeout(function() {
            var alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                var bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
        
        // Smooth sidebar transitions
        document.querySelectorAll('.sidebar .nav-link').forEach(function(link) {
            link.addEventListener('click', function(e) {
                if (this.getAttribute('data-bs-toggle') === 'collapse') {
                    return; // Let bootstrap handle collapse
                }
                
                // Remove active class from all links
                document.querySelectorAll('.sidebar .nav-link').forEach(function(l) {
                    l.classList.remove('active');
                });
                
                // Add active class to clicked link
                this.classList.add('active');
            });
        });
    </script>
    
    <?= $additional_js ?? '' ?>
</body>
</html>
