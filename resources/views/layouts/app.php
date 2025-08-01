<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Insurance Management System v2.0' ?></title>
    <link rel="shortcut icon" href="/assets/logo.PNG">
    
    <!-- Bootstrap 5.3.0 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome 6.4.0 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #6366f1;
            --primary-dark: #4f46e5;
            --secondary-color: #f1f5f9;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --info-color: #06b6d4;
            --dark-color: #1e293b;
            --light-color: #f8fafc;
            --border-color: #e2e8f0;
            --text-muted: #64748b;
            --sidebar-width: 280px;
            --sidebar-collapsed-width: 80px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--light-color);
            font-size: 14px;
            line-height: 1.6;
            color: var(--dark-color);
        }

        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: var(--sidebar-width);
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            z-index: 1000;
            transition: all 0.3s ease;
            overflow-x: hidden;
            box-shadow: 4px 0 15px rgba(0,0,0,0.1);
        }

        .sidebar.collapsed {
            width: var(--sidebar-collapsed-width);
        }

        .sidebar-header {
            padding: 1.5rem 1rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            text-align: center;
        }

        .sidebar-logo {
            color: white;
            font-size: 1.5rem;
            font-weight: 700;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .sidebar-logo i {
            margin-right: 10px;
            font-size: 1.8rem;
        }

        .sidebar-nav {
            padding: 1rem 0;
        }

        .nav-item {
            margin: 0.2rem 1rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .nav-link:hover {
            background-color: rgba(255,255,255,0.1);
            color: white;
            transform: translateX(5px);
        }

        .nav-link.active {
            background-color: rgba(255,255,255,0.2);
            color: white;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }

        .nav-link i {
            margin-right: 12px;
            width: 20px;
            text-align: center;
            font-size: 1.1rem;
        }

        /* Main Content */
        .main-wrapper {
            margin-left: var(--sidebar-width);
            transition: all 0.3s ease;
            min-height: 100vh;
        }

        .main-wrapper.expanded {
            margin-left: var(--sidebar-collapsed-width);
        }

        /* Top Navigation */
        .topnav {
            background: white;
            padding: 1rem 1.5rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border-bottom: 1px solid var(--border-color);
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .topnav-content {
            display: flex;
            justify-content: between;
            align-items: center;
        }

        .sidebar-toggle {
            background: none;
            border: none;
            font-size: 1.2rem;
            color: var(--text-muted);
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .sidebar-toggle:hover {
            background-color: var(--secondary-color);
            color: var(--primary-color);
        }

        .breadcrumb-wrapper {
            margin-left: 1rem;
        }

        .breadcrumb {
            background: none;
            padding: 0;
            margin: 0;
            font-size: 0.9rem;
        }

        .breadcrumb-item {
            color: var(--text-muted);
        }

        .breadcrumb-item.active {
            color: var(--dark-color);
            font-weight: 500;
        }

        .breadcrumb-item + .breadcrumb-item::before {
            content: "›";
            color: var(--text-muted);
        }

        /* User Profile Dropdown */
        .user-profile {
            display: flex;
            align-items: center;
            margin-left: auto;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            margin-right: 10px;
        }

        .user-info h6 {
            margin: 0;
            font-size: 0.9rem;
            font-weight: 600;
        }

        .user-info small {
            color: var(--text-muted);
            font-size: 0.8rem;
        }

        /* Content Area */
        .content {
            padding: 2rem 1.5rem;
        }

        .page-header {
            margin-bottom: 2rem;
        }

        .page-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
        }

        .page-subtitle {
            color: var(--text-muted);
            font-size: 1rem;
        }

        /* Cards */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            background: white;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(0,0,0,0.12);
        }

        .card-header {
            background: none;
            border-bottom: 1px solid var(--border-color);
            padding: 1.5rem;
            font-weight: 600;
        }

        .card-body {
            padding: 1.5rem;
        }

        /* Statistics Cards */
        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            border-left: 4px solid var(--primary-color);
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 30px rgba(0,0,0,0.15);
        }

        .stat-card.success {
            border-left-color: var(--success-color);
        }

        .stat-card.warning {
            border-left-color: var(--warning-color);
        }

        .stat-card.danger {
            border-left-color: var(--danger-color);
        }

        .stat-card.info {
            border-left-color: var(--info-color);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
            margin-bottom: 1rem;
        }

        .stat-icon.primary {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        }

        .stat-icon.success {
            background: linear-gradient(135deg, var(--success-color), #059669);
        }

        .stat-icon.warning {
            background: linear-gradient(135deg, var(--warning-color), #d97706);
        }

        .stat-icon.danger {
            background: linear-gradient(135deg, var(--danger-color), #dc2626);
        }

        .stat-icon.info {
            background: linear-gradient(135deg, var(--info-color), #0891b2);
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: var(--text-muted);
            font-size: 0.9rem;
            font-weight: 500;
        }

        /* Buttons */
        .btn {
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(99, 102, 241, 0.3);
        }

        /* Tables */
        .table {
            border-radius: 8px;
            overflow: hidden;
        }

        .table thead th {
            background-color: var(--secondary-color);
            border: none;
            color: var(--dark-color);
            font-weight: 600;
            padding: 1rem;
        }

        .table tbody td {
            padding: 1rem;
            border-color: var(--border-color);
            vertical-align: middle;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-wrapper {
                margin-left: 0;
            }

            .content {
                padding: 1rem;
            }

            .page-title {
                font-size: 1.5rem;
            }
        }

        /* Loading Animation */
        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 2px solid rgba(255,255,255,0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Success Messages */
        .alert {
            border-radius: 8px;
            border: none;
            padding: 1rem 1.5rem;
        }

        .alert-success {
            background-color: #d1fae5;
            color: #065f46;
        }

        .alert-danger {
            background-color: #fee2e2;
            color: #991b1b;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: var(--secondary-color);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--text-muted);
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary-color);
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <a href="/dashboard" class="sidebar-logo">
                <i class="fas fa-shield-alt"></i>
                <span class="logo-text">InsuranceV2</span>
            </a>
        </div>
        
        <nav class="sidebar-nav">
            <div class="nav-item">
                <a href="/dashboard" class="nav-link <?= ($current_page ?? '') === 'dashboard' ? 'active' : '' ?>">
                    <i class="fas fa-tachometer-alt"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </div>
            
            <div class="nav-item">
                <a href="/policies" class="nav-link <?= ($current_page ?? '') === 'policies' ? 'active' : '' ?>">
                    <i class="fas fa-file-contract"></i>
                    <span class="nav-text">Policies</span>
                </a>
            </div>
            
            <div class="nav-item">
                <a href="/customers" class="nav-link <?= ($current_page ?? '') === 'customers' ? 'active' : '' ?>">
                    <i class="fas fa-users"></i>
                    <span class="nav-text">Customers</span>
                </a>
            </div>
            
            <div class="nav-item">
                <a href="/agents" class="nav-link <?= ($current_page ?? '') === 'agents' ? 'active' : '' ?>">
                    <i class="fas fa-user-tie"></i>
                    <span class="nav-text">Agents</span>
                </a>
            </div>
            
            <div class="nav-item">
                <a href="/renewals" class="nav-link <?= ($current_page ?? '') === 'renewals' ? 'active' : '' ?>">
                    <i class="fas fa-sync-alt"></i>
                    <span class="nav-text">Renewals</span>
                </a>
            </div>
            
            <div class="nav-item">
                <a href="/follow-ups" class="nav-link <?= ($current_page ?? '') === 'follow-ups' ? 'active' : '' ?>">
                    <i class="fas fa-phone"></i>
                    <span class="nav-text">Follow-ups</span>
                </a>
            </div>
            
            <div class="nav-item">
                <a href="/reports" class="nav-link <?= ($current_page ?? '') === 'reports' ? 'active' : '' ?>">
                    <i class="fas fa-chart-bar"></i>
                    <span class="nav-text">Reports</span>
                </a>
            </div>
            
            <hr style="margin: 1rem; border-color: rgba(255,255,255,0.1);">
            
            <div class="nav-item">
                <a href="/settings" class="nav-link <?= ($current_page ?? '') === 'settings' ? 'active' : '' ?>">
                    <i class="fas fa-cog"></i>
                    <span class="nav-text">Settings</span>
                </a>
            </div>
            
            <div class="nav-item">
                <a href="/logout" class="nav-link">
                    <i class="fas fa-sign-out-alt"></i>
                    <span class="nav-text">Logout</span>
                </a>
            </div>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-wrapper" id="mainWrapper">
        <!-- Top Navigation -->
        <nav class="topnav">
            <div class="topnav-content">
                <div class="d-flex align-items-center">
                    <button class="sidebar-toggle" id="sidebarToggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    
                    <div class="breadcrumb-wrapper">
                        <?php if (isset($breadcrumbs) && !empty($breadcrumbs)): ?>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <?php 
                                    $breadcrumb_keys = array_keys($breadcrumbs);
                                    $last_key = end($breadcrumb_keys);
                                    ?>
                                    <?php foreach ($breadcrumbs as $key => $breadcrumb): ?>
                                        <?php if ($key === $last_key): ?>
                                            <li class="breadcrumb-item active" aria-current="page">
                                                <?= htmlspecialchars($breadcrumb['title']) ?>
                                            </li>
                                        <?php else: ?>
                                            <li class="breadcrumb-item">
                                                <a href="<?= htmlspecialchars($breadcrumb['url']) ?>">
                                                    <?= htmlspecialchars($breadcrumb['title']) ?>
                                                </a>
                                            </li>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </ol>
                            </nav>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="user-profile">
                    <div class="user-avatar">
                        <?= strtoupper(substr($_SESSION['user_name'] ?? 'A', 0, 1)) ?>
                    </div>
                    <div class="user-info">
                        <h6><?= htmlspecialchars($_SESSION['user_name'] ?? 'Admin User') ?></h6>
                        <small><?= htmlspecialchars($_SESSION['user_role'] ?? 'Administrator') ?></small>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main class="content">
            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    <?= htmlspecialchars($_SESSION['success']) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <?= htmlspecialchars($_SESSION['error']) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>

            <!-- Page Content -->
            <?php if (isset($content)): ?>
                <?= $content ?>
            <?php else: ?>
                <!-- Dynamic content will be included here -->
                <?php 
                // Check if we're in a view that should include content
                $current_file = basename($_SERVER['SCRIPT_NAME'], '.php');
                if (file_exists(__DIR__ . "/../{$current_file}.php")) {
                    include __DIR__ . "/../{$current_file}.php";
                }
                ?>
            <?php endif; ?>
        </main>
    </div>

    <!-- Bootstrap 5.3.0 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JavaScript -->
    <script>
        // Sidebar Toggle
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            const mainWrapper = document.getElementById('mainWrapper');
            
            sidebar.classList.toggle('collapsed');
            mainWrapper.classList.toggle('expanded');
        });

        // Mobile Menu Toggle
        if (window.innerWidth <= 768) {
            document.getElementById('sidebarToggle').addEventListener('click', function() {
                const sidebar = document.getElementById('sidebar');
                sidebar.classList.toggle('show');
            });
        }

        // Auto-hide alerts after 5 seconds
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>
</html>
