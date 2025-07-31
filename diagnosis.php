<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>🔍 Database Diagnosis Report</h1>";

// Database connection check
require_once 'include/config.php';

if (!$conn) {
    die("❌ Database connection failed: " . mysqli_connect_error());
}

echo "✅ Database connection successful<br>";

// Check if tables exist
$tables = ['users', 'customers', 'policies', 'insurance_companies', 'policy_types'];
echo "<h2>📋 Table Status:</h2>";

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
?>
