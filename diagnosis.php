<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>🔍 Database Diagnosis Report</h1>";

// Database connection details
echo "<h2>📋 Database Configuration:</h2>";
echo "Host: localhost<br>";
echo "Database: u820431346_v2insurance<br>";
echo "Username: u820431346_v2insurance<br>";
echo "Password: [HIDDEN]<br><br>";

// Try direct mysqli connection first
echo "<h2>🔗 Direct Database Connection Test:</h2>";

$hostname = 'localhost';
$database = 'u820431346_v2insurance';
$username = 'u820431346_v2insurance';
$password = 'Softpro@123';

echo "Attempting direct mysqli connection...<br>";

$conn = new mysqli($hostname, $username, $password, $database);

if ($conn->connect_error) {
    echo "❌ <strong>Direct mysqli connection failed:</strong> " . $conn->connect_error . "<br>";
    
    // Try alternative connection methods
    echo "<br><h3>🔄 Trying Alternative Connection Methods:</h3>";
    
    // Try with 127.0.0.1
    echo "Trying with 127.0.0.1 instead of localhost...<br>";
    $conn2 = new mysqli('127.0.0.1', $username, $password, $database);
    if ($conn2->connect_error) {
        echo "❌ 127.0.0.1 connection failed: " . $conn2->connect_error . "<br>";
    } else {
        echo "✅ 127.0.0.1 connection successful!<br>";
        $conn = $conn2;
    }
    
    // Try with port 3306
    if ($conn->connect_error) {
        echo "Trying with explicit port 3306...<br>";
        $conn3 = new mysqli($hostname, $username, $password, $database, 3306);
        if ($conn3->connect_error) {
            echo "❌ Port 3306 connection failed: " . $conn3->connect_error . "<br>";
        } else {
            echo "✅ Port 3306 connection successful!<br>";
            $conn = $conn3;
        }
    }
    
    if ($conn->connect_error) {
        echo "<br><div style='background: #ffebee; border: 1px solid #f44336; padding: 15px; border-radius: 5px;'>";
        echo "<strong>🚨 HOSTINGER DEPLOYMENT ISSUE DETECTED</strong><br><br>";
        echo "This error suggests the database connection details may be different on Hostinger.<br>";
        echo "<strong>Solutions to try on Hostinger:</strong><br>";
        echo "1. Check cPanel → MySQL Databases for correct database name<br>";
        echo "2. Verify username and password in cPanel<br>";
        echo "3. Ensure database user has full privileges<br>";
        echo "4. Check if MySQL service is running<br>";
        echo "5. Try connecting through cPanel phpMyAdmin first<br>";
        echo "</div>";
        exit;
    }
} else {
    echo "✅ <strong>Database connection successful!</strong><br>";
}

// Set charset
$conn->set_charset("utf8mb4");
echo "✅ Character set configured<br>";

// Now include the regular diagnosis
echo "<h2>📊 Table Status:</h2>";

// Check if tables exist
$tables = ['users', 'customers', 'policies', 'insurance_companies', 'policy_types'];

foreach ($tables as $table) {
    $result = mysqli_query($conn, "SHOW TABLES LIKE '$table'");
    $exists = mysqli_num_rows($result) > 0;
    
    if ($exists) {
        $count_result = mysqli_query($conn, "SELECT COUNT(*) as count FROM $table");
        $count_row = mysqli_fetch_assoc($count_result);
        $count = $count_row['count'];
        echo "✅ $table: $count records<br>";
    } else {
        echo "❌ $table: Table does not exist<br>";
    }
}

// Check for admin user
echo "<h2>👤 Admin User Check:</h2>";
$admin_result = mysqli_query($conn, "SELECT * FROM users WHERE username = 'admin' OR role = 'admin' LIMIT 1");
if ($admin_result && mysqli_num_rows($admin_result) > 0) {
    $admin = mysqli_fetch_assoc($admin_result);
    echo "✅ Admin user found: " . htmlspecialchars($admin['name']) . " (username: " . htmlspecialchars($admin['username']) . ")<br>";
} else {
    echo "❌ No admin user found<br>";
    echo "<strong>Creating admin user...</strong><br>";
    
    $admin_password = password_hash('admin123', PASSWORD_DEFAULT);
    $create_admin = "INSERT INTO users (name, email, username, password, phone, role, status) VALUES ('Administrator', 'admin@softpromis.com', 'admin', '$admin_password', '9999999999', 'admin', 'active')";
    
    if (mysqli_query($conn, $create_admin)) {
        echo "✅ Admin user created successfully<br>";
    } else {
        echo "❌ Failed to create admin user: " . mysqli_error($conn) . "<br>";
    }
}

// Sample data check
echo "<h2>📊 Sample Data Check:</h2>";

// Check customers
$customer_result = mysqli_query($conn, "SELECT name, email, city FROM customers LIMIT 3");
if ($customer_result && mysqli_num_rows($customer_result) > 0) {
    echo "<strong>Sample Customers:</strong><br>";
    while ($row = mysqli_fetch_assoc($customer_result)) {
        echo "• " . htmlspecialchars($row['name']) . " from " . htmlspecialchars($row['city']) . "<br>";
    }
} else {
    echo "❌ No customer data found<br>";
}

// Check policies
$policy_result = mysqli_query($conn, "SELECT policy_number, premium_amount, category FROM policies LIMIT 3");
if ($policy_result && mysqli_num_rows($policy_result) > 0) {
    echo "<br><strong>Sample Policies:</strong><br>";
    while ($row = mysqli_fetch_assoc($policy_result)) {
        echo "• " . htmlspecialchars($row['policy_number']) . " - ₹" . number_format($row['premium_amount']) . " (" . htmlspecialchars($row['category']) . ")<br>";
    }
} else {
    echo "❌ No policy data found<br>";
}

echo "<h2>🎯 Action Required:</h2>";

$customer_count_result = mysqli_query($conn, "SELECT COUNT(*) as count FROM customers");
$customer_count = $customer_count_result ? mysqli_fetch_assoc($customer_count_result)['count'] : 0;

if ($customer_count < 100) {
    echo "⚠️ <strong>Only $customer_count customers found. Expected 500!</strong><br>";
    echo "📋 <a href='/test_data_load.php' style='background: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Load Massive Data</a><br><br>";
}

echo "🔗 <a href='/setup.php' style='background: #28a745; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Setup Page</a> ";
echo "<a href='/dashboard' style='background: #6f42c1; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Dashboard</a> ";
echo "<a href='/login' style='background: #dc3545; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Login Page</a>";

// Check database structure
echo "<h2>🏗️ Database Structure Check:</h2>";
$show_tables = mysqli_query($conn, "SHOW TABLES");
echo "All tables in database:<br>";
while ($table = mysqli_fetch_array($show_tables)) {
    echo "• " . $table[0] . "<br>";
}

echo "<h2>🔧 Database Connection Info:</h2>";
echo "MySQL Version: " . mysqli_get_server_info($conn) . "<br>";
echo "Client Version: " . mysqli_get_client_info() . "<br>";
echo "Connection Status: " . ($conn->ping() ? "✅ Active" : "❌ Inactive") . "<br>";
?>
