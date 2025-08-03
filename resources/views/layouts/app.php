<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Insurance Management System v2.0' ?></title>
    <link rel="shortcut icon" href="/assets/images/optimized/logo-favicon.png">
    
    <!-- Bootstrap 5.3.0 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome 6.4.0 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    
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
            background: rgba(255,255,255,0.1);
            color: white !important;
        }

        .nav-link.btn-add-policy {
            background: rgba(16, 185, 129, 0.2);
            border: 1px solid rgba(16, 185, 129, 0.3);
            margin: 0.2rem 0;
        }

        .nav-link.btn-add-policy:hover {
            background: rgba(16, 185, 129, 0.3);
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
            border-radius: 10px;
            padding: 1rem;
            box-shadow: 0 2px 15px rgba(0,0,0,0.06);
            transition: all 0.3s ease;
            border-left: 3px solid var(--primary-color);
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 25px rgba(0,0,0,0.12);
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
            width: 45px;
            height: 45px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: white;
            margin-bottom: 0.75rem;
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
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 0.25rem;
        }

        .stat-label {
            color: var(--text-muted);
            font-size: 0.85rem;
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
                <img src="/assets/images/optimized/logo-navbar.png" alt="Insurance CRM" style="width: 32px; height: 32px; margin-right: 8px;">
                <span class="logo-text">Insurance CRM</span>
            </a>
        </div>
        
        <nav class="sidebar-nav">
            <div class="nav-item">
                <a href="/dashboard" class="nav-link <?= ($current_page ?? '') === 'dashboard' ? 'active' : '' ?>">
                    <i class="fas fa-tachometer-alt"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </div>
            
            <!-- Add Policy Button in Sidebar -->
            <div class="nav-item">
                <a href="#" class="nav-link btn-add-policy" onclick="openAddPolicyModal(); return false;">
                    <i class="fas fa-plus-circle"></i>
                    <span class="nav-text">Add Policy</span>
                </a>
            </div>
            
            <div class="nav-item">
                <a href="/policies" class="nav-link <?= ($current_page ?? '') === 'policies' ? 'active' : '' ?>">
                    <i class="fas fa-file-contract"></i>
                    <span class="nav-text">All Policies</span>
                </a>
            </div>
            
            <div class="nav-item">
                <a href="/policies/current-month" class="nav-link <?= ($current_page ?? '') === 'current-month-policies' ? 'active' : '' ?>">
                    <i class="fas fa-calendar-check"></i>
                    <span class="nav-text">Current Month</span>
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
                    
                    <!-- Add Policy Button in Top Nav -->
                    <button class="btn btn-primary btn-sm ms-3" id="addPolicyBtn" onclick="openAddPolicyModal()">
                        <i class="fas fa-plus me-2"></i>Add Policy
                    </button>
                    
                    <div class="breadcrumb-wrapper ms-3">
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
    
    <!-- jQuery (required for Select2) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
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

        // Initialize Select2 for all select elements
        $(document).ready(function() {
            // Apply Select2 to all select elements except those with specific classes
            $('select').each(function() {
                const $select = $(this);
                
                // Skip if select has class 'no-select2'
                if ($select.hasClass('no-select2')) {
                    return;
                }
                
                // Skip if select has onchange attribute (like DataTable filters)
                if ($select.attr('onchange')) {
                    return;
                }
                
                // Skip DataTable filter selects and pagination selects
                if ($select.hasClass('form-select') && 
                    ($select.attr('name') === 'per_page' || $select.closest('.filters').length > 0)) {
                    return;
                }
                
                // Skip period filters and small utility selects
                if ($select.attr('id') === 'periodFilter' || 
                    $select.hasClass('form-select-sm')) {
                    return;
                }
                
                // Special handling for important dropdowns that need search even with few options
                const isImportantSelect = $select.attr('id') === 'customer_id' || 
                                        $select.attr('id') === 'insuranceCompany' || 
                                        $select.attr('id') === 'agentSelect' ||
                                        $select.hasClass('select2') ||
                                        $select.data('placeholder');
                
                // Skip if select has fewer than 5 options AND it's not an important select
                if (!isImportantSelect && $select.find('option').length < 5) {
                    return;
                }
                
                // Get placeholder from label or data-placeholder or use default
                let placeholder = 'Select an option';
                
                // Check for data-placeholder attribute first
                if ($select.data('placeholder')) {
                    placeholder = $select.data('placeholder');
                } else {
                    // Try to get from associated label
                    const label = $('label[for="' + $select.attr('id') + '"]');
                    if (label.length > 0) {
                        placeholder = 'Select ' + label.text().replace('*', '').trim().toLowerCase();
                    }
                }
                
                // Initialize Select2
                $select.select2({
                    placeholder: placeholder,
                    allowClear: true,
                    width: '100%',
                    minimumResultsForSearch: 0, // Always show search box
                    dropdownAutoWidth: true
                });
                
                // Remove existing select2 class if present to avoid conflicts
                $select.removeClass('select2');
            });
        });

        // Universal Table Search Functionality
        $(document).ready(function() {
            initializeTableSearch();
        });

        function initializeTableSearch() {
            // Find all tables that should have search functionality
            $('table').each(function() {
                const $table = $(this);
                
                // Skip tables with .no-search class
                if ($table.hasClass('no-search')) {
                    return;
                }
                
                // Add searchable-table class if not present and table has tbody with rows
                if (!$table.hasClass('searchable-table') && $table.find('tbody tr').length > 0) {
                    $table.addClass('searchable-table');
                }
                
                // Only process tables with searchable-table class
                if (!$table.hasClass('searchable-table')) {
                    return;
                }
                
                // Generate unique ID for this table if it doesn't have one
                let tableId = $table.attr('id');
                if (!tableId) {
                    tableId = 'table_' + Math.random().toString(36).substr(2, 9);
                    $table.attr('id', tableId);
                }
                
                // Check if search box already exists
                if ($table.closest('.table-container').find('.table-search-box').length > 0) {
                    return;
                }
                
                // Wrap table in container if not already wrapped
                if (!$table.closest('.table-container').length) {
                    $table.wrap('<div class="table-container"></div>');
                }
                
                const $container = $table.closest('.table-container');
                
                // Create search input
                const searchHtml = `
                    <div class="table-search-wrapper mb-3">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-search"></i>
                                    </span>
                                    <input type="text" 
                                           class="form-control table-search-box" 
                                           placeholder="Search in table..." 
                                           data-table-id="${tableId}">
                                    <button class="btn btn-outline-secondary table-search-clear" 
                                            type="button" 
                                            data-table-id="${tableId}" 
                                            style="display: none;">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="table-search-info text-muted text-end">
                                    <small class="search-results-info" data-table-id="${tableId}"></small>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                
                // Insert search box before table
                $container.prepend(searchHtml);
                
                // Add no-results row template (hidden by default)
                const $tbody = $table.find('tbody');
                const columnCount = $table.find('thead tr:first th').length || $table.find('tbody tr:first td').length;
                const noResultsRow = `
                    <tr class="table-no-results" style="display: none;">
                        <td colspan="${columnCount}" class="text-center py-4">
                            <div class="empty-state">
                                <i class="fas fa-search fa-2x text-muted mb-2"></i>
                                <p class="text-muted mb-0">No matching records found</p>
                                <small class="text-muted">Try adjusting your search terms</small>
                            </div>
                        </td>
                    </tr>
                `;
                $tbody.append(noResultsRow);
            });
            
            // Bind search events
            bindTableSearchEvents();
        }

        function bindTableSearchEvents() {
            // Search input event
            $(document).on('input', '.table-search-box', function() {
                const $input = $(this);
                const tableId = $input.data('table-id');
                const searchTerm = $input.val().toLowerCase().trim();
                const $clearBtn = $(`.table-search-clear[data-table-id="${tableId}"]`);
                const $table = $(`#${tableId}`);
                
                // Show/hide clear button
                if (searchTerm.length > 0) {
                    $clearBtn.show();
                } else {
                    $clearBtn.hide();
                }
                
                filterTable(tableId, searchTerm);
            });
            
            // Clear search event
            $(document).on('click', '.table-search-clear', function() {
                const tableId = $(this).data('table-id');
                const $input = $(`.table-search-box[data-table-id="${tableId}"]`);
                
                $input.val('');
                $(this).hide();
                filterTable(tableId, '');
            });
        }

        function filterTable(tableId, searchTerm) {
            const $table = $(`#${tableId}`);
            const $tbody = $table.find('tbody');
            const $rows = $tbody.find('tr:not(.table-no-results)');
            const $noResultsRow = $tbody.find('.table-no-results');
            const $resultInfo = $(`.search-results-info[data-table-id="${tableId}"]`);
            
            let visibleCount = 0;
            const totalCount = $rows.length;
            
            if (searchTerm === '') {
                // Show all rows
                $rows.show();
                $noResultsRow.hide();
                visibleCount = totalCount;
                $resultInfo.text('');
            } else {
                // Filter rows
                $rows.each(function() {
                    const $row = $(this);
                    const rowText = $row.find('td').text().toLowerCase();
                    
                    if (rowText.includes(searchTerm)) {
                        $row.show();
                        visibleCount++;
                    } else {
                        $row.hide();
                    }
                });
                
                // Show/hide no results row
                if (visibleCount === 0) {
                    $noResultsRow.show();
                    $resultInfo.text('No results found');
                } else {
                    $noResultsRow.hide();
                    $resultInfo.text(`${visibleCount} of ${totalCount} records`);
                }
            }
        }

        // Function to reinitialize search for dynamically loaded tables
        window.reinitializeTableSearch = function() {
            initializeTableSearch();
        };

        // Function to add search to a specific table
        window.addTableSearch = function(tableSelector) {
            const $table = $(tableSelector);
            if ($table.length && !$table.hasClass('no-search')) {
                $table.addClass('searchable-table');
                initializeTableSearch();
            }
        };
    </script>
    
    <!-- Select2 Bootstrap 5 Theme CSS -->
    <style>
        .select2-container {
            width: 100% !important;
        }
        
        .select2-container .select2-selection {
            border: 1px solid var(--border-color);
            border-radius: 0.375rem;
            min-height: 38px;
            font-size: 14px;
        }
        
        .select2-container .select2-selection--single {
            height: 38px;
        }
        
        .select2-container .select2-selection--single .select2-selection__rendered {
            padding-left: 12px;
            padding-top: 8px;
            line-height: 1.5;
            color: var(--dark-color);
        }
        
        .select2-container .select2-selection--single .select2-selection__arrow {
            height: 36px;
            right: 10px;
        }
        
        .select2-dropdown {
            border: 1px solid var(--border-color);
            border-radius: 0.375rem;
            border-top: none;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }
        
        .select2-container--open .select2-selection {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(99, 102, 241, 0.25);
        }
        
        .select2-results__option--highlighted {
            background-color: var(--primary-color);
            color: white;
        }
        
        .select2-search--dropdown .select2-search__field {
            border: 1px solid var(--border-color);
            border-radius: 0.25rem;
            padding: 6px 12px;
        }
        
        .select2-container--disabled .select2-selection {
            background-color: #e9ecef;
            cursor: not-allowed;
        }
        
        /* Custom styles for select elements that already have select2 class */
        .form-control.select2 {
            display: none;
        }
        
        /* Universal Table Search Styles */
        .table-search-wrapper {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 0.5rem;
            border: 1px solid var(--border-color);
            margin-bottom: 1rem;
        }
        
        .table-search-box {
            border-radius: 0.375rem 0 0 0.375rem;
        }
        
        .table-search-clear {
            border-radius: 0 0.375rem 0.375rem 0;
            border-left: 0;
        }
        
        .table-search-info {
            font-size: 0.875rem;
        }
        
        .search-results-info {
            font-weight: 500;
            color: var(--primary-color) !important;
        }
        
        .table-container .table {
            margin-bottom: 0;
        }
        
        .table-no-results .empty-state {
            padding: 2rem 1rem;
        }
        
        .table-no-results .empty-state i {
            opacity: 0.5;
        }
        
        /* Animation for filtering */
        .table tbody tr {
            transition: opacity 0.2s ease;
        }
        
        .table tbody tr[style*="display: none"] {
            opacity: 0;
        }
    </style>
    
    <!-- Add Policy Modal -->
    <div class="modal fade" id="addPolicyModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-plus-circle me-2"></i>
                        <span id="modalTitle">Add New Policy</span>
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="addPolicyForm" enctype="multipart/form-data">
                        <!-- Step 1: Insurance Category -->
                        <div id="step1" class="step-content">
                            <h5 class="mb-4">
                                <i class="fas fa-shield-alt text-primary me-2"></i>
                                Step 1: Select Insurance Category
                            </h5>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <div class="card insurance-category-card" data-category="motor">
                                        <div class="card-body text-center">
                                            <i class="fas fa-car fa-3x text-warning mb-3"></i>
                                            <h5>Motor Insurance</h5>
                                            <p class="text-muted">Vehicle insurance policies</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card insurance-category-card disabled" data-category="health">
                                        <div class="card-body text-center">
                                            <i class="fas fa-heartbeat fa-3x text-info mb-3"></i>
                                            <h5>Health Insurance</h5>
                                            <p class="text-muted">Coming Soon</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card insurance-category-card disabled" data-category="life">
                                        <div class="card-body text-center">
                                            <i class="fas fa-shield-alt fa-3x text-success mb-3"></i>
                                            <h5>Life Insurance</h5>
                                            <p class="text-muted">Coming Soon</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Step 2: Motor Insurance Form -->
                        <div id="step2" class="step-content d-none">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5>
                                    <i class="fas fa-car text-warning me-2"></i>
                                    Motor Insurance Details
                                </h5>
                                <button type="button" class="btn btn-outline-secondary btn-sm" onclick="goToStep1()">
                                    <i class="fas fa-arrow-left me-2"></i>Back
                                </button>
                            </div>
                            
                            <div class="row g-3">
                                <!-- Vehicle Number -->
                                <div class="col-md-6">
                                    <label for="vehicleNumber" class="form-label">
                                        Vehicle Number <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="vehicleNumber" name="vehicleNumber" 
                                           placeholder="e.g., DL1CAB1234" required style="text-transform: uppercase;">
                                </div>
                                
                                <!-- Customer Phone -->
                                <div class="col-md-6">
                                    <label for="customerPhone" class="form-label">
                                        Customer Phone <span class="text-danger">*</span>
                                    </label>
                                    <input type="tel" class="form-control" id="customerPhone" name="customerPhone" 
                                           placeholder="10-digit mobile number" required maxlength="10" pattern="[0-9]{10}">
                                </div>
                                
                                <!-- Customer Name -->
                                <div class="col-md-6">
                                    <label for="customerName" class="form-label">
                                        Customer Name <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="customerName" name="customerName" 
                                           placeholder="Full name as per documents" required>
                                </div>
                                
                                <!-- Email -->
                                <div class="col-md-6">
                                    <label for="customerEmail" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="customerEmail" name="customerEmail" 
                                           placeholder="customer@example.com">
                                </div>
                                
                                <!-- Insurance Company -->
                                <div class="col-md-6">
                                    <label for="insuranceCompany" class="form-label">
                                        Insurance Company <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-control select2" id="insuranceCompany" name="insuranceCompany" required>
                                        <option value="">Select Insurance Company</option>
                                        <option value="1">ICICI Lombard</option>
                                        <option value="2">HDFC ERGO</option>
                                        <option value="3">Bajaj Allianz</option>
                                        <option value="4">SBI General</option>
                                        <option value="5">Tata AIG</option>
                                        <option value="6">Star Health</option>
                                        <option value="7">LIC of India</option>
                                        <option value="8">Max Life</option>
                                        <option value="9">New India Assurance</option>
                                        <option value="10">Oriental Insurance</option>
                                    </select>
                                </div>
                                
                                <!-- Vehicle Type -->
                                <div class="col-md-6">
                                    <label for="vehicleType" class="form-label">
                                        Vehicle Type <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-control" id="vehicleType" name="vehicleType" required>
                                        <option value="">Select Vehicle Type</option>
                                        <option value="two_wheeler">Two Wheeler</option>
                                        <option value="car">Car</option>
                                        <option value="commercial">Commercial</option>
                                        <option value="tractor">Tractor</option>
                                        <option value="others">Others</option>
                                    </select>
                                </div>
                                
                                <!-- Policy Start Date -->
                                <div class="col-md-6">
                                    <label for="policyStartDate" class="form-label">
                                        Policy Start Date <span class="text-danger">*</span>
                                    </label>
                                    <input type="date" class="form-control" id="policyStartDate" name="policyStartDate" required>
                                </div>
                                
                                <!-- Policy Expiry Date -->
                                <div class="col-md-6">
                                    <label for="policyExpiryDate" class="form-label">
                                        Policy Expiry Date <span class="text-danger">*</span>
                                    </label>
                                    <input type="date" class="form-control" id="policyExpiryDate" name="policy_expiry_date" required readonly>
                                </div>
                                
                                <!-- Premium -->
                                <div class="col-md-6">
                                    <label for="premium" class="form-label">
                                        Premium Amount <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">₹</span>
                                        <input type="number" class="form-control" id="premium" name="premium" 
                                               placeholder="0.00" required step="0.01" min="0">
                                    </div>
                                </div>
                                
                                <!-- Payout -->
                                <div class="col-md-6">
                                    <label for="payout" class="form-label">
                                        Payout <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">₹</span>
                                        <input type="number" class="form-control" id="payout" name="payout" 
                                               placeholder="0.00" required step="0.01" min="0">
                                    </div>
                                </div>
                                
                                <!-- Customer Paid -->
                                <div class="col-md-6">
                                    <label for="customerPaid" class="form-label">
                                        Customer Paid <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">₹</span>
                                        <input type="number" class="form-control" id="customerPaid" name="customerPaid" 
                                               placeholder="0.00" required step="0.01" min="0">
                                    </div>
                                </div>
                                
                                <!-- Revenue (Auto-calculated) -->
                                <div class="col-md-6">
                                    <label for="revenue" class="form-label">
                                        Revenue (Auto-calculated)
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">₹</span>
                                        <input type="number" class="form-control" id="revenue" name="revenue" 
                                               placeholder="0.00" readonly step="0.01">
                                    </div>
                                </div>
                                
                                <!-- Business Type -->
                                <div class="col-md-12">
                                    <label for="businessType" class="form-label">
                                        Business Type <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-control" id="businessType" name="businessType" required>
                                        <option value="">Select Business Type</option>
                                    </select>
                                </div>
                            </div>
                            
                            <!-- Document Uploads -->
                            <div class="row g-3 mt-4">
                                <div class="col-12">
                                    <h6 class="text-primary mb-3">
                                        <i class="fas fa-file-upload me-2"></i>Document Uploads (Optional)
                                    </h6>
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="policyDocument" class="form-label">Policy Document</label>
                                    <input type="file" class="form-control" id="policyDocument" name="policyDocument" 
                                           accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="otherDocument" class="form-label">Other Document</label>
                                    <input type="file" class="form-control" id="otherDocument" name="otherDocument" 
                                           accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                                </div>
                            </div>
                        </div>
                                    
                                    <div class="mb-3">
                                        <label for="policyDocument" class="form-label">
                                            Policy Document <span class="text-danger">*</span>
                                        </label>
                                        <input type="file" class="form-control" id="policyDocument" name="policyDocument" 
                                               accept=".pdf,.jpg,.jpeg,.png" required>
                                        <small class="text-muted">PDF, JPG, PNG (Max 10MB)</small>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="rcDocument" class="form-label">RC Document</label>
                                        <input type="file" class="form-control" id="rcDocument" name="rcDocument" 
                                               accept=".pdf,.jpg,.jpeg,.png">
                                        <small class="text-muted">PDF, JPG, PNG (Max 10MB)</small>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <h6 class="text-secondary mb-3">KYC Documents</h6>
                                    
                                    <div class="mb-3">
                                        <label for="aadharCard" class="form-label">Aadhar Card</label>
                                        <input type="file" class="form-control" id="aadharCard" name="aadharCard" 
                                               accept=".pdf,.jpg,.jpeg,.png">
                                        <small class="text-muted">PDF, JPG, PNG (Max 10MB)</small>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="panCard" class="form-label">PAN Card</label>
                                        <input type="file" class="form-control" id="panCard" name="panCard" 
                                               accept=".pdf,.jpg,.jpeg,.png">
                                        <small class="text-muted">PDF, JPG, PNG (Max 10MB)</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Cancel
                    </button>
                    <button type="button" class="btn btn-warning" id="nextStepBtn" onclick="goToStep2('motor')" style="display: none;">
                        <i class="fas fa-arrow-right me-2"></i>Next Step
                    </button>
                    <button type="button" class="btn btn-primary d-none" id="submitPolicyBtn" onclick="submitPolicy()">
                        <i class="fas fa-save me-2"></i>Submit Policy
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Policy Modal Scripts -->
    <script>
        // Global variables
        let selectedCategory = null;
        
        // Open Add Policy Modal
        function openAddPolicyModal() {
            console.log('Opening Add Policy Modal...');
            const modal = new bootstrap.Modal(document.getElementById('addPolicyModal'));
            modal.show();
            // Reset to step 1
            goToStep1();
            // Initialize Select2 dropdowns
            setTimeout(function() {
                initializeSelect2();
            }, 300);
        }
        
        // Fix dropdown positioning for action buttons in tables
        document.addEventListener('DOMContentLoaded', function() {
            // Use Popper.js for proper dropdown positioning
            const dropdowns = document.querySelectorAll('.dropdown-toggle');
            dropdowns.forEach(function(dropdown) {
                dropdown.addEventListener('click', function(e) {
                    const dropdownMenu = this.nextElementSibling;
                    if (dropdownMenu && dropdownMenu.classList.contains('dropdown-menu')) {
                        // Calculate position
                        const rect = this.getBoundingClientRect();
                        const viewportHeight = window.innerHeight;
                        const dropdownHeight = dropdownMenu.offsetHeight || 200;
                        
                        // Position dropdown above if it would go below viewport
                        if (rect.bottom + dropdownHeight > viewportHeight) {
                            dropdownMenu.style.top = (rect.top - dropdownHeight) + 'px';
                            dropdownMenu.style.left = rect.left + 'px';
                            dropdownMenu.classList.add('dropup');
                        } else {
                            dropdownMenu.style.top = rect.bottom + 'px';
                            dropdownMenu.style.left = rect.left + 'px';
                            dropdownMenu.classList.remove('dropup');
                        }
                    }
                });
            });
        });
        
        // Initialize Select2 for dropdowns
        function initializeSelect2() {
            $('#insuranceCompany').select2({
                placeholder: 'Select Insurance Company',
                allowClear: true,
                dropdownParent: $('#addPolicyModal')
            });
            
            // Initialize business type dropdown with Select2
            $('#businessType').select2({
                placeholder: 'Select Business Type',
                allowClear: true,
                dropdownParent: $('#addPolicyModal')
            });
            
            // Load business types
            loadBusinessTypes();
            
            // Initialize vehicle type dropdown (regular select, not Select2)
            const vehicleTypeSelect = document.getElementById('vehicleType');
            if (vehicleTypeSelect) {
                vehicleTypeSelect.selectedIndex = 0; // Reset to first option
            }
        }
        
        // Step navigation
        function goToStep1() {
            $('#step2').addClass('d-none');
            $('#step1').removeClass('d-none');
            $('#modalTitle').text('Add New Policy');
            $('#submitPolicyBtn').addClass('d-none');
            $('#nextStepBtn').hide();
            selectedCategory = null;
            
            // Reset all form fields
            document.getElementById('addPolicyForm').reset();
            
            // Clear Select2 selections
            $('#insuranceCompany').val(null).trigger('change');
            $('#businessType').val(null).trigger('change');
            
            // Reset vehicle type dropdown
            const vehicleTypeSelect = document.getElementById('vehicleType');
            if (vehicleTypeSelect) {
                vehicleTypeSelect.selectedIndex = 0;
            }
        }
        
        // Load business types function
        function loadBusinessTypes() {
            fetch('/get-business-types')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const businessTypeSelect = $('#businessType');
                        businessTypeSelect.empty();
                        businessTypeSelect.append('<option value="">Select Business Type</option>');
                        
                        data.types.forEach(type => {
                            businessTypeSelect.append(`<option value="${type.value}">${type.label}</option>`);
                        });
                    }
                })
                .catch(error => {
                    console.error('Error loading business types:', error);
                });
        }
        
        function goToStep2(category) {
            selectedCategory = category;
            $('#step1').addClass('d-none');
            $('#step2').removeClass('d-none');
            $('#modalTitle').html('<i class="fas fa-car text-warning me-2"></i>Motor Insurance Details');
            $('#nextStepBtn').hide();
            $('#submitPolicyBtn').removeClass('d-none');
        }
        
        // Insurance category selection
        $(document).on('click', '.insurance-category-card:not(.disabled)', function() {
            const category = $(this).data('category');
            
            // Remove selection from other cards
            $('.insurance-category-card').removeClass('selected');
            
            // Add selection to clicked card
            $(this).addClass('selected');
            
            if (category === 'motor') {
                selectedCategory = 'motor';
                $('#nextStepBtn').show();
            }
        });
        
        // Vehicle number input handler
        $(document).on('input', '#vehicleNumber', function() {
            const vehicleNumber = $(this).val().toUpperCase();
            $(this).val(vehicleNumber);
            
            // Clear any existing timeout
            if (window.vehicleSearchTimeout) {
                clearTimeout(window.vehicleSearchTimeout);
            }
            
            if (vehicleNumber.length >= 5) {
                // Show loading state
                $('#vehicleSearchResult').html(`
                    <div class="alert alert-info border-info">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-spinner fa-spin text-info me-3"></i>
                            <span>Searching for existing policies...</span>
                        </div>
                    </div>
                `).removeClass('d-none');
                
                // Debounce the search
                window.vehicleSearchTimeout = setTimeout(function() {
                    searchVehicle(vehicleNumber);
                }, 500);
            } else {
                $('#vehicleSearchResult').addClass('d-none');
            }
        });
        
        // Search for existing vehicle
        function searchVehicle(vehicleNumber) {
            $.ajax({
                url: '/search-vehicle',
                method: 'POST',
                data: { vehicle_number: vehicleNumber },
                success: function(response) {
                    if (response.found) {
                        showVehicleFound(response.data);
                    } else {
                        hideVehicleResult();
                    }
                },
                error: function() {
                    hideVehicleResult();
                }
            });
        }
        
        function showVehicleFound(data) {
            const html = `
                <div class="alert alert-warning border-warning">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-exclamation-triangle text-warning me-3"></i>
                        <div class="flex-grow-1">
                            <h6 class="mb-1">Vehicle Already Exists!</h6>
                            <p class="mb-2">This vehicle number has existing policies:</p>
                            <ul class="mb-2">
                                <li><strong>Customer:</strong> ${data.customer_name} (${data.customer_phone})</li>
                                <li><strong>Last Policy:</strong> ${data.last_policy_date}</li>
                                <li><strong>Company:</strong> ${data.company}</li>
                            </ul>
                            <button type="button" class="btn btn-sm btn-outline-primary" onclick="fillCustomerData('${data.customer_name}', '${data.customer_phone}', '${data.customer_email || ''}')">
                                <i class="fas fa-user-plus me-1"></i>Use Customer Details
                            </button>
                        </div>
                    </div>
                </div>
            `;
            $('#vehicleSearchResult').html(html).removeClass('d-none');
        }
        
        function hideVehicleResult() {
            $('#vehicleSearchResult').addClass('d-none');
        }
        
        function fillCustomerData(name, phone, email) {
            $('#customerName').val(name);
            $('#customerPhone').val(phone);
            $('#customerEmail').val(email || '');
        }
        
        // Customer phone validation
        $(document).on('input', '#customerPhone', function() {
            const phone = $(this).val().replace(/\D/g, '');
            $(this).val(phone);
            
            // Add validation styling
            if (phone.length === 10) {
                $(this).removeClass('is-invalid').addClass('is-valid');
            } else if (phone.length > 0) {
                $(this).removeClass('is-valid').addClass('is-invalid');
            } else {
                $(this).removeClass('is-valid is-invalid');
            }
        });
        
        // Policy date calculations
        $(document).on('change', '#policyStartDate', function() {
            const startDate = new Date($(this).val());
            if (startDate) {
                const expiryDate = new Date(startDate);
                expiryDate.setFullYear(expiryDate.getFullYear() + 1);
                expiryDate.setDate(expiryDate.getDate() - 1); // Subtract 1 day for correct expiry
                $('#policyExpiryDate').val(expiryDate.toISOString().split('T')[0]);
            }
        });
        
        // Revenue calculations
        function calculateRevenue() {
            const premium = parseFloat($('#premium').val()) || 0;
            const payout = parseFloat($('#payout').val()) || 0;
            const customerPaid = parseFloat($('#customerPaid').val()) || 0;
            
            // Correct revenue calculation: 
            // Step 1: Actual Payable = Premium - Payout
            // Step 2: Revenue = Customer Paid - Actual Payable
            const actualPayable = premium - payout;
            const revenue = customerPaid - actualPayable;
            
            $('#revenue').val(revenue.toFixed(2));
            
            // Add visual feedback for revenue
            const revenueField = $('#revenue');
            revenueField.removeClass('text-success text-danger text-warning');
            
            if (revenue > 0) {
                revenueField.addClass('text-success');
            } else if (revenue < 0) {
                revenueField.addClass('text-danger');
            } else {
                revenueField.addClass('text-warning');
            }
            
            // Log calculation for debugging
            console.log('Revenue Calculation:', {
                premium: premium,
                payout: payout,
                customerPaid: customerPaid,
                actualPayable: actualPayable.toFixed(2),
                revenue: revenue.toFixed(2)
            });
        }
        
        // Form validation for financial fields
        $(document).on('input', '#premium, #payout, #customerPaid', function() {
            calculateRevenue();
            
            // Validate positive numbers
            const value = parseFloat($(this).val());
            if (value < 0) {
                $(this).addClass('is-invalid');
            } else if (value > 0) {
                $(this).removeClass('is-invalid').addClass('is-valid');
            } else {
                $(this).removeClass('is-valid is-invalid');
            }
        });
        
        // Form submission
        function submitPolicy() {
            console.log('=== SUBMIT POLICY STARTED ===');
            const form = document.getElementById('addPolicyForm');
            
            // Custom validation
            let isValid = true;
            let errorMessage = '';
            
            console.log('selectedCategory:', selectedCategory);
            
            // Check required fields - including financial fields
            const requiredFields = {
                'vehicleNumber': 'Vehicle Number',
                'customerPhone': 'Customer Phone',
                'customerName': 'Customer Name',
                'insuranceCompany': 'Insurance Company',
                'vehicleType': 'Vehicle Type',
                'policyStartDate': 'Policy Start Date',
                'premium': 'Premium',
                'payout': 'Payout',
                'customerPaid': 'Customer Paid',
                'businessType': 'Business Type'
            };
            
            console.log('Validating required fields...');
            for (const [fieldId, fieldName] of Object.entries(requiredFields)) {
                const field = document.getElementById(fieldId);
                console.log(`${fieldName}: "${field ? field.value : 'FIELD NOT FOUND'}"`);
                if (!field || !field.value.trim()) {
                    isValid = false;
                    errorMessage = `${fieldName} is required`;
                    if (field) field.focus();
                    break;
                }
            }
            
            // Validate phone number
            const phone = $('#customerPhone').val();
            if (phone.length !== 10) {
                isValid = false;
                errorMessage = 'Phone number must be 10 digits';
                $('#customerPhone').focus();
            }
            
            // Validate premium amounts
            const premium = parseFloat($('#premium').val()) || 0;
            const payout = parseFloat($('#payout').val()) || 0;
            const customerPaid = parseFloat($('#customerPaid').val()) || 0;
            
            if (premium <= 0) {
                isValid = false;
                errorMessage = 'Premium must be greater than 0';
                $('#premium').focus();
            } else if (payout < 0) {
                isValid = false;
                errorMessage = 'Payout cannot be negative';
                $('#payout').focus();
            } else if (customerPaid < 0) {
                isValid = false;
                errorMessage = 'Customer Paid cannot be negative';
                $('#customerPaid').focus();
            }
            
            // Check file upload
            const policyDocument = document.getElementById('policyDocument');
            if (!policyDocument.files.length) {
                isValid = false;
                errorMessage = 'Policy document is required';
                policyDocument.focus();
            }
            
            if (!isValid) {
                console.log('Validation failed:', errorMessage);
                Swal.fire({
                    icon: 'error',
                    title: 'Validation Error',
                    text: errorMessage
                });
                return;
            }
            
            console.log('Validation passed, creating FormData...');
            const formData = new FormData(form);
            
            // Ensure we have a category
            if (!selectedCategory) {
                console.warn('No category selected, defaulting to motor');
                selectedCategory = 'motor';
            }
            
            formData.append('category', selectedCategory);
            
            // Log all form data
            console.log('Form data being sent:');
            for (let [key, value] of formData.entries()) {
                console.log(`${key}:`, value);
            }
            
            // Show loading
            const submitBtn = $('#submitPolicyBtn');
            const originalText = submitBtn.html();
            submitBtn.html('<i class="fas fa-spinner fa-spin me-2"></i>Submitting...').prop('disabled', true);
            
            console.log('Sending AJAX request to /add-policy...');
            
            // Add a timeout to detect hanging requests
            let requestTimeout = setTimeout(function() {
                console.error('Request timeout after 30 seconds!');
                submitBtn.html(originalText).prop('disabled', false);
                Swal.fire({
                    icon: 'error',
                    title: 'Request Timeout',
                    text: 'The request is taking too long. Please try again.'
                });
            }, 30000);
            
            $.ajax({
                url: '/add-policy',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                timeout: 30000, // 30 second timeout
                beforeSend: function(xhr, settings) {
                    console.log('AJAX beforeSend triggered');
                    console.log('Request URL:', settings.url);
                    console.log('Request method:', settings.type);
                },
                success: function(response) {
                    clearTimeout(requestTimeout);
                    console.log('AJAX Success response:', response);
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Policy Added Successfully!',
                            text: `Policy has been created with ID: ${response.policy_id}`
                        }).then(() => {
                            // Close the modal
                            var addPolicyModal = document.getElementById('addPolicyModal');
                            var modal = bootstrap.Modal.getInstance(addPolicyModal);
                            modal.hide();
                            // Refresh the page to update stats
                            location.reload();
                        });
                    } else {
                        Swal.fire('Error!', response.message, 'error');
                    }
                },
                error: function(xhr, status, error) {
                    clearTimeout(requestTimeout);
                    console.error('AJAX Error:', status, error);
                    console.error('Response text:', xhr.responseText);
                    console.error('Status code:', xhr.status);
                    console.error('Ready state:', xhr.readyState);
                    
                    let errorMessage = 'Failed to submit policy. Please try again.';
                    try {
                        const response = JSON.parse(xhr.responseText);
                        errorMessage = response.message || errorMessage;
                    } catch (e) {
                        console.error('Failed to parse error response:', e);
                    }
                    
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: errorMessage + ' (Status: ' + xhr.status + ')'
                    });
                },
                complete: function(xhr, status) {
                    clearTimeout(requestTimeout);
                    console.log('AJAX request completed with status:', status);
                    submitBtn.html(originalText).prop('disabled', false);
                }
            });
        }
        
        // Reset form when modal is closed
        $('#addPolicyModal').on('hidden.bs.modal', function() {
            document.getElementById('addPolicyForm').reset();
            goToStep1();
            hideVehicleResult();
            $('#revenue').val('');
        });
        
        // Load insurance companies and business types on modal show
        $('#addPolicyModal').on('show.bs.modal', function() {
            loadInsuranceCompanies();
            loadBusinessTypes();
            
            // Initialize tooltips
            setTimeout(function() {
                $('[data-bs-toggle="tooltip"]').tooltip();
            }, 500);
        });
        
        function loadInsuranceCompanies() {
            console.log('Loading insurance companies...');
            $.ajax({
                url: '/get-insurance-companies',
                method: 'GET',
                success: function(response) {
                    console.log('Insurance companies response:', response);
                    const select = $('#insuranceCompany');
                    // Only clear and reload if we get data from server
                    if (response.success && response.companies && response.companies.length > 0) {
                        select.empty().append('<option value="">Select Insurance Company</option>');
                        response.companies.forEach(company => {
                            select.append(`<option value="${company.id}">${company.name}</option>`);
                        });
                        console.log('Added', response.companies.length, 'insurance companies');
                    } else {
                        console.log('Using default insurance companies (no data from server)');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX error loading insurance companies:', error, 'Using defaults');
                }
            });
        }
        
        function loadBusinessTypes() {
            console.log('Loading business types...');
            $.ajax({
                url: '/get-business-types',
                method: 'GET',
                success: function(response) {
                    console.log('Business types response:', response);
                    const select = $('#businessType');
                    // Only clear and reload if we get data from server
                    if (response.success && response.types && response.types.length > 0) {
                        select.empty().append('<option value="">Select Business Type</option>');
                        response.types.forEach(type => {
                            select.append(`<option value="${type.value}">${type.label}</option>`);
                        });
                        console.log('Added', response.types.length, 'business types');
                    } else {
                        console.log('Using default business types (no data from server)');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX error loading business types:', error, 'Using defaults');
                }
            });
        }
    </script>
    
    <!-- Additional CSS for modal -->
    <style>
        .insurance-category-card {
            cursor: pointer;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }
        
        .insurance-category-card:hover:not(.disabled) {
            border-color: #007bff;
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0,123,255,0.3);
        }
        
        .insurance-category-card.disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }
        
        .insurance-category-card.disabled .card-body {
            color: #6c757d;
        }
        
        .step-content {
            min-height: 400px;
        }
        
        .modal-xl {
            max-width: 1140px;
        }
        
        @media (max-width: 768px) {
            .modal-xl {
                max-width: 95%;
            }
        }
        
        .select2-container {
            width: 100% !important;
        }
        
        .alert-warning {
            background-color: #fff3cd;
            border-color: #ffc107;
        }
        
        .input-group-text {
            background-color: #f8f9fa;
            border-color: #ced4da;
        }
        
        .form-label {
            font-weight: 500;
            margin-bottom: 0.5rem;
        }
        
        .text-danger {
            color: #dc3545 !important;
        }
        
        .btn-add-policy {
            background: linear-gradient(45deg, #28a745, #20c997);
            border: none;
            color: white;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-add-policy:hover {
            background: linear-gradient(45deg, #218838, #1e7e34);
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(40, 167, 69, 0.3);
            color: white;
        }
        
        /* Form validation styles */
        .form-control.is-valid {
            border-color: #198754;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%23198754' d='m2.3 6.73.4-.4 1.4-1.4L6.7 2.3l.4.4-3 3z'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right calc(0.375em + 0.1875rem) center;
            background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
        }
        
        .form-control.is-invalid {
            border-color: #dc3545;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath d='m5.8 4.6 2.4 2.4M8.2 4.6l-2.4 2.4'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right calc(0.375em + 0.1875rem) center;
            background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
        }
        
        /* Revenue field color coding */
        #revenue.text-success {
            color: #198754 !important;
            font-weight: 600;
        }
        
        #revenue.text-danger {
            color: #dc3545 !important;
            font-weight: 600;
        }
        
        #revenue.text-warning {
            color: #fd7e14 !important;
            font-weight: 600;
        }
        
        /* Vehicle search result styling */
        .alert-warning .btn-outline-primary {
            border-color: #0d6efd;
            color: #0d6efd;
        }
        
        .alert-warning .btn-outline-primary:hover {
            background-color: #0d6efd;
            color: white;
        }
        
        /* Step indicator styling */
        .step-content {
            min-height: 400px;
            animation: fadeIn 0.3s ease-in;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        /* File upload styling */
        .form-control[type="file"]:focus {
            border-color: #86b7fe;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }
        
        /* Modal z-index fix */
        .modal {
            z-index: 1055 !important;
        }
        
        .modal-backdrop {
            z-index: 1050 !important;
        }
        
        /* Select2 dropdown z-index fix for modals */
        .select2-container {
            z-index: 1060 !important;
        }
        
        .select2-dropdown {
            z-index: 1061 !important;
        }
        
        /* Dropdown overflow fix for tables with low height */
        .table-responsive {
            position: static !important;
            overflow: visible !important;
        }
        
        .dropdown-menu {
            position: fixed !important;
            z-index: 1060 !important;
        }
        
        /* Ensure dropdowns appear above other elements */
        .btn-group.show .dropdown-menu {
            display: block;
            position: fixed !important;
            will-change: transform;
            top: 0;
            left: 0;
            transform: translate3d(0, 0, 0);
        }
        
        /* Modal backdrop fix */
        .modal-backdrop.show {
            opacity: 0.5;
        }
        
        /* Ensure modal content is above backdrop */
        .modal-dialog {
            position: relative;
            z-index: 1056;
        }
        
        /* Insurance category card selection */
        .insurance-category-card {
            cursor: pointer;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }
        
        .insurance-category-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        
        .insurance-category-card.selected {
            border-color: var(--primary-color);
            background-color: rgba(99, 102, 241, 0.1);
        }
        
        .insurance-category-card.disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }
        
        .insurance-category-card.disabled:hover {
            transform: none;
            box-shadow: none;
        }
    </style>
</script>
</body>
</html>
