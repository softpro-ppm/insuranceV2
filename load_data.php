<?php
/**
 * Quick Data Loader for Dashboard
 * This will populate the database with sample data to fix the 0 values on dashboard
 */

require_once __DIR__ . '/config/app.php';
require_once __DIR__ . '/app/Database.php';

echo "<!DOCTYPE html>
<html>
<head>
    <title>Data Loader - Insurance Management</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #f5f5f5; }
        .container { max-width: 800px; margin: 0 auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .header { text-align: center; color: #333; margin-bottom: 30px; }
        .success { color: #28a745; background: #d4edda; border: 1px solid #c3e6cb; padding: 15px; border-radius: 5px; margin: 10px 0; }
        .error { color: #dc3545; background: #f8d7da; border: 1px solid #f5c6cb; padding: 15px; border-radius: 5px; margin: 10px 0; }
        .warning { color: #856404; background: #fff3cd; border: 1px solid #ffeaa7; padding: 15px; border-radius: 5px; margin: 10px 0; }
        .btn { background: #007bff; color: white; padding: 12px 25px; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; text-decoration: none; display: inline-block; margin: 10px 0; }
        .btn:hover { background: #0056b3; }
        .progress { margin: 20px 0; }
        .status { font-weight: bold; }
    </style>
</head>
<body>
    <div class='container'>
        <div class='header'>
            <h1>🔧 Insurance Management System</h1>
            <h2>Data Loader & Dashboard Fix</h2>
        </div>";

try {
    $db = Database::getInstance();
    echo "<div class='success'>✓ Database connection successful</div>";
    
    // Check current data status
    echo "<div class='progress'><h3>📊 Current Database Status</h3>";
    
    $tables = ['customers', 'policies', 'insurance_companies', 'policy_types', 'users'];
    $counts = [];
    $totalRecords = 0;
    
    foreach ($tables as $table) {
        try {
            $result = $db->fetch("SELECT COUNT(*) as count FROM $table");
            $count = $result['count'] ?? 0;
            $counts[$table] = $count;
            $totalRecords += $count;
            echo "<div class='status'>$table: $count records</div>";
        } catch (Exception $e) {
            echo "<div class='error'>Error checking $table: " . $e->getMessage() . "</div>";
        }
    }
    echo "</div>";
    
    if ($totalRecords == 0 || $counts['policies'] < 10) {
        echo "<div class='warning'>⚠ Database has insufficient data. This is why dashboard shows 0 values.</div>";
        
        if (isset($_POST['load_data'])) {
            echo "<div class='progress'><h3>🚀 Loading Sample Data...</h3>";
            
            // Load the simple seed data first
            $sqlFile = __DIR__ . '/database/simple_seed_data.sql';
            if (file_exists($sqlFile)) {
                $sql = file_get_contents($sqlFile);
                
                // Remove comments and split queries
                $queries = array_filter(
                    array_map('trim', 
                        preg_split('/;(?=(?:[^\']*\'[^\']*\')*[^\']*$)/', $sql)
                    )
                );
                
                $success_count = 0;
                $error_count = 0;
                
                foreach ($queries as $query) {
                    if (empty($query) || strpos($query, '--') === 0) continue;
                    
                    try {
                        $stmt = $db->connection->prepare($query);
                        $stmt->execute();
                        $success_count++;
                        
                        // Show progress for important inserts
                        if (strpos($query, 'INSERT') === 0) {
                            $affected = $stmt->rowCount();
                            if ($affected > 0) {
                                echo "<div class='success'>✓ Inserted $affected records</div>";
                            }
                        }
                    } catch (PDOException $e) {
                        $error_count++;
                        if (strpos($e->getMessage(), 'Duplicate entry') === false) {
                            echo "<div class='error'>Error: " . $e->getMessage() . "</div>";
                        }
                    }
                }
                
                echo "<div class='success'><strong>✓ Data loading completed!</strong><br>";
                echo "Successfully executed: $success_count queries<br>";
                if ($error_count > 0) {
                    echo "Errors (mostly duplicates): $error_count<br>";
                }
                echo "</div>";
                
                // Check final counts
                echo "<div class='progress'><h3>📈 Updated Database Status</h3>";
                foreach ($tables as $table) {
                    try {
                        $result = $db->fetch("SELECT COUNT(*) as count FROM $table");
                        $count = $result['count'] ?? 0;
                        echo "<div class='status'>$table: $count records</div>";
                    } catch (Exception $e) {
                        echo "<div class='error'>Error checking $table: " . $e->getMessage() . "</div>";
                    }
                }
                echo "</div>";
                
                echo "<div class='success'><h3>🎉 Success!</h3>";
                echo "Your database now has sample data. The dashboard should show real values instead of 0.<br><br>";
                echo "<a href='/dashboard' class='btn'>🚀 Go to Dashboard</a>";
                echo "</div>";
                
            } else {
                echo "<div class='error'>SQL seed file not found: $sqlFile</div>";
            }
            
        } else {
            echo "<form method='post'>";
            echo "<h3>🔧 Fix Dashboard Data</h3>";
            echo "<p>Click the button below to load sample data (customers, policies, agents) into your database:</p>";
            echo "<button type='submit' name='load_data' value='1' class='btn'>🔄 Load Sample Data</button>";
            echo "</form>";
        }
        
    } else {
        echo "<div class='success'><h3>✅ Database Status: Good</h3>";
        echo "Your database has sufficient data ($totalRecords total records).<br>";
        echo "If dashboard still shows 0, there might be a date range issue.<br><br>";
        echo "<a href='/dashboard' class='btn'>📊 Go to Dashboard</a>";
        echo "</div>";
        
        // Show sample policy data to debug date issues
        echo "<div class='progress'><h3>🔍 Sample Policy Data (for debugging)</h3>";
        try {
            $sample_policies = $db->fetchAll("
                SELECT policy_number, policy_start_date, policy_end_date, premium_amount, status 
                FROM policies 
                ORDER BY policy_start_date DESC 
                LIMIT 5
            ");
            
            if (empty($sample_policies)) {
                echo "<div class='warning'>No policies found in database</div>";
            } else {
                echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
                echo "<tr style='background: #f8f9fa;'><th>Policy</th><th>Start Date</th><th>End Date</th><th>Premium</th><th>Status</th></tr>";
                foreach ($sample_policies as $policy) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($policy['policy_number']) . "</td>";
                    echo "<td>" . htmlspecialchars($policy['policy_start_date']) . "</td>";
                    echo "<td>" . htmlspecialchars($policy['policy_end_date']) . "</td>";
                    echo "<td>₹" . number_format($policy['premium_amount'], 2) . "</td>";
                    echo "<td>" . htmlspecialchars($policy['status']) . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
        } catch (Exception $e) {
            echo "<div class='error'>Error fetching sample policies: " . $e->getMessage() . "</div>";
        }
        echo "</div>";
    }

} catch (Exception $e) {
    echo "<div class='error'><h3>❌ Database Connection Failed</h3>";
    echo "Error: " . $e->getMessage() . "<br><br>";
    echo "<strong>Possible solutions:</strong><br>";
    echo "1. Check database credentials in .env file<br>";
    echo "2. Ensure database server is running<br>";
    echo "3. Verify database exists<br>";
    echo "4. Run setup.php first to create tables<br>";
    echo "</div>";
}

echo "
    </div>
</body>
</html>";
?>
