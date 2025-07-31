<?php
// Test database connection and verify the system is working

error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>Insurance Management System v2.0 - Setup Test</h1>";

// Test 1: Check PHP version
echo "<h3>✓ PHP Version: " . phpversion() . "</h3>";

// Test 2: Check if files exist
$files = [
    '/Users/rajesh/Documents/GitHub/insuranceV2/app/Database.php',
    '/Users/rajesh/Documents/GitHub/insuranceV2/config/database.php',
    '/Users/rajesh/Documents/GitHub/insuranceV2/database/init_database.sql',
    '/Users/rajesh/Documents/GitHub/insuranceV2/public/index.php'
];

echo "<h3>File Structure Check:</h3>";
foreach ($files as $file) {
    if (file_exists($file)) {
        echo "✓ " . basename($file) . " exists<br>";
    } else {
        echo "✗ " . basename($file) . " missing<br>";
    }
}

// Test 3: Check database connection (if config exists)
if (file_exists('/Users/rajesh/Documents/GitHub/insuranceV2/config/database.php')) {
    try {
        require_once '/Users/rajesh/Documents/GitHub/insuranceV2/app/Database.php';
        
        echo "<h3>Database Connection Test:</h3>";
        
        // Try to connect
        $db = Database::getInstance();
        echo "✓ Database connection successful<br>";
        
        // Test a simple query
        $result = $db->fetchOne("SELECT 1 as test");
        if ($result && $result['test'] == 1) {
            echo "✓ Database query test successful<br>";
        } else {
            echo "✗ Database query test failed<br>";
        }
        
        // Check if tables exist
        $tables = ['users', 'customers', 'policies', 'insurance_companies', 'policy_types'];
        echo "<h4>Database Tables Check:</h4>";
        foreach ($tables as $table) {
            try {
                $result = $db->fetchOne("SELECT COUNT(*) as count FROM $table");
                echo "✓ Table '$table' exists with " . $result['count'] . " records<br>";
            } catch (Exception $e) {
                echo "✗ Table '$table' not found<br>";
            }
        }
        
    } catch (Exception $e) {
        echo "<h3>Database Connection Failed:</h3>";
        echo "Error: " . $e->getMessage() . "<br>";
        echo "<p><strong>Note:</strong> You need to:</p>";
        echo "<ol>";
        echo "<li>Create a MySQL database</li>";
        echo "<li>Update the config/database.php file with your database credentials</li>";
        echo "<li>Run the SQL script in database/init_database.sql</li>";
        echo "</ol>";
    }
} else {
    echo "<h3>✗ Database config file not found</h3>";
}

echo "<hr>";
echo "<h3>Next Steps:</h3>";
echo "<ol>";
echo "<li>Set up your MySQL database and update config/database.php</li>";
echo "<li>Run the SQL script: database/init_database.sql</li>";
echo "<li>Start the PHP server: <code>php -S localhost:8000 -t public</code></li>";
echo "<li>Visit <a href='http://localhost:8000'>http://localhost:8000</a></li>";
echo "<li>Login with username: <strong>admin</strong>, password: <strong>password</strong></li>";
echo "</ol>";

echo "<hr>";
echo "<p><em>Insurance Management System v2.0 by SoftPro</em></p>";
?>
