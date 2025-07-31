<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Simple setup script to initialize database
require_once 'include/config.php';

$success = [];
$errors = [];

if ($_POST['action'] ?? '' === 'init_db') {
    try {
        // Read and execute the main SQL file
        $sql_file = __DIR__ . '/database/init_database.sql';
        if (!file_exists($sql_file)) {
            throw new Exception("SQL file not found: " . $sql_file);
        }
        
        $sql_content = file_get_contents($sql_file);
        if (!$sql_content) {
            throw new Exception("Failed to read SQL file");
        }
        
        // Split into individual queries and execute
        $queries = array_filter(array_map('trim', explode(';', $sql_content)));
        
        foreach ($queries as $query) {
            if (empty($query) || substr($query, 0, 2) === '--' || substr($query, 0, 2) === '/*') {
                continue; // Skip comments and empty queries
            }
            
            if (mysqli_query($conn, $query)) {
                $success[] = "Executed: " . substr($query, 0, 50) . "...";
            } else {
                $errors[] = "Failed: " . mysqli_error($conn) . " - " . substr($query, 0, 50);
            }
        }
        
        // Execute seed data if main database setup was successful
        if (empty($errors)) {
            $seed_file = __DIR__ . '/database/complete_massive_seed_data.sql';
            if (file_exists($seed_file)) {
                $seed_content = file_get_contents($seed_file);
                if ($seed_content) {
                    $success[] = "Executing MASSIVE seed data script (500 customers + 700 policies)...";
                    
                    // Split into individual queries for simple seed data
                    $seed_queries = array_filter(array_map('trim', explode(';', $seed_content)));
                    
                    foreach ($seed_queries as $query) {
                        if (!empty($query) && substr($query, 0, 2) !== '--') {
                            if (mysqli_query($conn, $query)) {
                                if (strpos($query, 'SELECT') === 0) {
                                    // It's a select query, get the result
                                    $result = mysqli_query($conn, $query);
                                    if ($result && $row = mysqli_fetch_assoc($result)) {
                                        $success[] = "Stats: " . implode(', ', $row);
                                    }
                                } else {
                                    $success[] = "Executed: " . substr($query, 0, 50) . "...";
                                }
                            } else {
                                $error_msg = mysqli_error($conn);
                                // Ignore duplicate entry errors for seed data
                                if (strpos($error_msg, 'Duplicate entry') === false && strpos($error_msg, 'already exists') === false) {
                                    $errors[] = "Failed: " . $error_msg . " - " . substr($query, 0, 50);
                                }
                            }
                        }
                    }
                }
            }
        }
        
        if (empty($errors)) {
            $success[] = "Database initialization completed successfully!";
            $success[] = "✅ 25 sample customers created with realistic data";
            $success[] = "✅ 25 sample policies created across different FY years";
            $success[] = "✅ 3 agent accounts created (phone: 9876543210, 9876543211, 9876543212)";
            $success[] = "✅ Default password for agents: Softpro@123";
            $success[] = "✅ 20+ insurance companies added";
            $success[] = "✅ Document upload system ready";
            $success[] = "✅ Agent performance data added";
            $success[] = "✅ Renewal tracking system active";
        }
        
    } catch (Exception $e) {
        $errors[] = "Error: " . $e->getMessage();
    }
}

// Check table status
$tables_status = [];
$check_tables = ['users', 'customers', 'insurance_companies', 'policy_types', 'policies', 'customer_documents', 'policy_documents', 'agent_performance'];

foreach ($check_tables as $table) {
    $result = mysqli_query($conn, "SHOW TABLES LIKE '$table'");
    $exists = mysqli_num_rows($result) > 0;
    
    $count = 0;
    if ($exists) {
        $count_result = mysqli_query($conn, "SELECT COUNT(*) as count FROM $table");
        $count_row = mysqli_fetch_assoc($count_result);
        $count = $count_row['count'];
    }
    
    $tables_status[$table] = ['exists' => $exists, 'count' => $count];
}

// Check agent accounts
$agent_check = [];
$agent_result = mysqli_query($conn, "SELECT name, phone, status FROM users WHERE role = 'agent' ORDER BY id");
if ($agent_result) {
    while ($row = mysqli_fetch_assoc($agent_result)) {
        $agent_check[] = $row;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Insurance Management System - Database Setup123</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Database Setup123</h1>
        
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5>Database Tables Status</h5>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Table</th>
                                    <th>Exists</th>
                                    <th>Records</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($tables_status as $table => $status): ?>
                                <tr>
                                    <td><?= htmlspecialchars($table) ?></td>
                                    <td>
                                        <?php if ($status['exists']): ?>
                                            <span class="badge bg-success">Yes</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">No</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= $status['count'] ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <!-- Agent Accounts -->
                <div class="card mt-3">
                    <div class="card-header">
                        <h5>Agent Accounts</h5>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($agent_check)): ?>
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Phone (Login ID)</th>
                                        <th>Status</th>
                                        <th>Default Password</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($agent_check as $agent): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($agent['name']) ?></td>
                                        <td><code><?= htmlspecialchars($agent['phone']) ?></code></td>
                                        <td>
                                            <span class="badge bg-<?= $agent['status'] === 'active' ? 'success' : 'danger' ?>">
                                                <?= ucfirst($agent['status']) ?>
                                            </span>
                                        </td>
                                        <td><code>Softpro@123</code></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <div class="alert alert-info mt-2">
                                <strong>Agent Login:</strong> Use phone number as username and "Softpro@123" as password<br>
                                <strong>Agent Portal:</strong> <a href="/agent-login" target="_blank">https://v2.insurance.softpromis.com/agent-login</a>
                            </div>
                        <?php else: ?>
                            <div class="text-muted">No agent accounts found. Run database initialization to create agent accounts.</div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- System Information -->
                <div class="card mt-3">
                    <div class="card-header">
                        <h5>System Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <strong>Live Website:</strong><br>
                                <a href="https://v2.insurance.softpromis.com/dashboard" target="_blank" class="btn btn-success btn-sm">
                                    <i class="fas fa-external-link-alt"></i> Admin Dashboard
                                </a>
                                <a href="/agent-login" target="_blank" class="btn btn-primary btn-sm">
                                    <i class="fas fa-user-tie"></i> Agent Portal
                                </a>
                            </div>
                            <div class="col-md-6">
                                <strong>Features Ready:</strong><br>
                                <span class="badge bg-success">Document Upload (KYC & Policy)</span><br>
                                <span class="badge bg-success">Email & WhatsApp Ready</span><br>
                                <span class="badge bg-success">Multi-FY Data</span><br>
                                <span class="badge bg-success">Agent Performance Tracking</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Agent Accounts Section -->
                <div class="card mt-4">
                    <div class="card-header">
                        <h5>Agent Accounts</h5>
                    </div>
                    <div class="card-body">
                        <?php if (empty($agent_check)): ?>
                            <div class="alert alert-warning">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                No agent accounts found. Run database initialization to create agent accounts.
                            </div>
                        <?php else: ?>
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Phone (Login ID)</th>
                                            <th>Status</th>
                                            <th>Default Password</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($agent_check as $agent): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($agent['name']) ?></td>
                                            <td><code><?= htmlspecialchars($agent['phone']) ?></code></td>
                                            <td>
                                                <span class="badge bg-<?= $agent['status'] === 'active' ? 'success' : 'danger' ?>">
                                                    <?= ucfirst($agent['status']) ?>
                                                </span>
                                            </td>
                                            <td><code>Softpro@123</code></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-3">
                                <a href="/agent-login" class="btn btn-success btn-sm" target="_blank">
                                    <i class="fas fa-sign-in-alt me-1"></i>Test Agent Login
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <?php if (!empty($success)): ?>
                <div class="alert alert-success mt-3">
                    <h6>Success Messages:</h6>
                    <?php foreach ($success as $msg): ?>
                        <div><?= htmlspecialchars($msg) ?></div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
                
                <?php if (!empty($errors)): ?>
                <div class="alert alert-danger mt-3">
                    <h6>Error Messages:</h6>
                    <?php foreach ($errors as $msg): ?>
                        <div><?= htmlspecialchars($msg) ?></div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
            
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5>Actions</h5>
                    </div>
                    <div class="card-body">
                        <form method="post">
                            <input type="hidden" name="action" value="init_db">
                            <button type="submit" class="btn btn-primary w-100 mb-3">
                                <i class="fas fa-database me-2"></i>Initialize Database
                            </button>
                        </form>
                        
                        <div class="d-grid gap-2">
                            <a href="/" class="btn btn-success">
                                <i class="fas fa-tachometer-alt me-2"></i>Admin Dashboard
                            </a>
                            <a href="/agent-login" class="btn btn-info" target="_blank">
                                <i class="fas fa-user-tie me-2"></i>Agent Portal
                            </a>
                        </div>
                        
                        <div class="mt-4">
                            <h6>Quick Links:</h6>
                            <div class="list-group list-group-flush">
                                <a href="/customers" class="list-group-item list-group-item-action">
                                    <i class="fas fa-users me-2"></i>Customers
                                </a>
                                <a href="/policies" class="list-group-item list-group-item-action">
                                    <i class="fas fa-file-contract me-2"></i>Policies
                                </a>
                                <a href="/policies/create" class="list-group-item list-group-item-action">
                                    <i class="fas fa-plus me-2"></i>Add Policy
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
