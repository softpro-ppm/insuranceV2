<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Simple setup script to initialize database
require_once 'include/config.php';

$success = [];
$errors = [];

if ($_POST['action'] ?? '' === 'init_db') {
    try {
        // Read the SQL file
        $sql_file = __DIR__ . '/database/init_database.sql';
        if (!file_exists($sql_file)) {
            throw new Exception("SQL file not found: " . $sql_file);
        }
        
        $sql_content = file_get_contents($sql_file);
        if (!$sql_content) {
            throw new Exception("Failed to read SQL file");
        }
        
        // Split into individual queries
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
        
        if (empty($errors)) {
            $success[] = "Database initialization completed successfully!";
        }
        
    } catch (Exception $e) {
        $errors[] = "Error: " . $e->getMessage();
    }
}

// Check table status
$tables_status = [];
$check_tables = ['users', 'customers', 'insurance_companies', 'policy_types', 'policies'];

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
?>
<!DOCTYPE html>
<html>
<head>
    <title>Insurance Management System - Database Setup</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Database Setup</h1>
        
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
                            <button type="submit" class="btn btn-primary">Initialize Database</button>
                        </form>
                        
                        <hr>
                        
                        <a href="/" class="btn btn-success">Go to Dashboard</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
