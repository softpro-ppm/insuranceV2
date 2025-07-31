<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>🔧 DATABASE STRUCTURE FIXER</h1>";
echo "<style>
body { font-family: Arial, sans-serif; margin: 20px; }
.success { background: #d4edda; border: 1px solid #c3e6cb; padding: 15px; border-radius: 5px; margin: 10px 0; }
.error { background: #f8d7da; border: 1px solid #f5c6cb; padding: 15px; border-radius: 5px; margin: 10px 0; }
.info { background: #d1ecf1; border: 1px solid #bee5eb; padding: 15px; border-radius: 5px; margin: 10px 0; }
</style>";

// Direct database connection
$hostname = 'localhost';
$database = 'u820431346_v2insurance';
$username = 'u820431346_v2insurance';
$password = 'Softpro@123';

$conn = new mysqli($hostname, $username, $password, $database);

if ($conn->connect_error) {
    $conn = new mysqli('127.0.0.1', $username, $password, $database);
    if ($conn->connect_error) {
        echo "<div class='error'>❌ Connection failed: " . $conn->connect_error . "</div>";
        exit;
    }
}

echo "<div class='success'>✅ Database connected successfully!</div>";

// Fix 1: Create agent_performance table if it doesn't exist
echo "<div class='info'><h2>🔧 Creating Missing Tables...</h2>";

$agent_performance_sql = "
CREATE TABLE IF NOT EXISTS agent_performance (
    id INT AUTO_INCREMENT PRIMARY KEY,
    agent_id INT NOT NULL,
    month CHAR(7) NOT NULL,
    policies_sold INT DEFAULT 0,
    total_premium DECIMAL(15,2) DEFAULT 0.00,
    total_commission DECIMAL(15,2) DEFAULT 0.00,
    motor_policies INT DEFAULT 0,
    health_policies INT DEFAULT 0,
    life_policies INT DEFAULT 0,
    target_premium DECIMAL(15,2) DEFAULT 0.00,
    achievement_percentage DECIMAL(5,2) DEFAULT 0.00,
    rank_position INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (agent_id) REFERENCES users(id),
    UNIQUE KEY unique_agent_month (agent_id, month)
)";

if (mysqli_query($conn, $agent_performance_sql)) {
    echo "✅ agent_performance table created/verified<br>";
} else {
    echo "❌ Error creating agent_performance table: " . mysqli_error($conn) . "<br>";
}

// Fix 2: Check if revenue column exists in policies table
$check_revenue = "SHOW COLUMNS FROM policies LIKE 'revenue'";
$result = mysqli_query($conn, $check_revenue);

if (mysqli_num_rows($result) == 0) {
    echo "<br>Adding revenue column to policies table...<br>";
    $add_revenue = "ALTER TABLE policies ADD COLUMN revenue DECIMAL(10,2) DEFAULT 0 AFTER sum_insured";
    if (mysqli_query($conn, $add_revenue)) {
        echo "✅ revenue column added to policies table<br>";
    } else {
        echo "❌ Error adding revenue column: " . mysqli_error($conn) . "<br>";
    }
} else {
    echo "✅ revenue column already exists in policies table<br>";
}

// Fix 3: Update policy categories to include more types
$update_categories = "ALTER TABLE policies MODIFY COLUMN category ENUM('motor', 'health', 'life', 'travel', 'property') NOT NULL";
if (mysqli_query($conn, $update_categories)) {
    echo "✅ Policy categories updated to include travel and property<br>";
} else {
    echo "❌ Error updating categories: " . mysqli_error($conn) . "<br>";
}

echo "</div>";

// Verify all tables exist
echo "<div class='info'><h2>📊 Table Verification:</h2>";

$required_tables = [
    'users', 'customers', 'insurance_companies', 'policy_types', 
    'policies', 'policy_beneficiaries', 'policy_documents', 
    'customer_documents', 'policy_renewals', 'customer_followups', 
    'settings', 'agent_performance'
];

foreach ($required_tables as $table) {
    $result = mysqli_query($conn, "SHOW TABLES LIKE '$table'");
    if (mysqli_num_rows($result) > 0) {
        echo "✅ $table exists<br>";
    } else {
        echo "❌ $table missing<br>";
    }
}

echo "</div>";

// Show table counts
echo "<div class='success'><h2>📈 Current Data Status:</h2>";

$data_tables = ['users', 'customers', 'policies', 'insurance_companies', 'policy_types', 'agent_performance'];
foreach ($data_tables as $table) {
    $result = mysqli_query($conn, "SELECT COUNT(*) as count FROM $table");
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        echo "📋 $table: <strong>" . $row['count'] . "</strong> records<br>";
    }
}

echo "</div>";

echo "<div class='success'>";
echo "<h2>🎉 DATABASE STRUCTURE FIXED!</h2>";
echo "You can now try loading the massive data again:<br><br>";
echo "<a href='/super_data_loader.php' style='background: #ff6b35; color: white; padding: 15px 30px; text-decoration: none; border-radius: 5px; margin-right: 10px; font-weight: bold;'>🚀 Run Super Data Loader</a>";
echo "<a href='/diagnosis.php' style='background: #007bff; color: white; padding: 15px 30px; text-decoration: none; border-radius: 5px; margin-right: 10px;'>📊 Run Diagnosis</a>";
echo "<a href='/setup.php' style='background: #28a745; color: white; padding: 15px 30px; text-decoration: none; border-radius: 5px;'>⚙️ Setup Page</a>";
echo "</div>";

mysqli_close($conn);
?>
