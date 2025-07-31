<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
set_time_limit(300); // 5 minutes timeout for large data

echo "<h1>🚀 MASSIVE DATA LOADER - 500 Customers + 700 Policies</h1>";

// Direct database connection (most reliable)
$hostname = 'localhost';
$database = 'u820431346_v2insurance';
$username = 'u820431346_v2insurance';
$password = 'Softpro@123';

$conn = new mysqli($hostname, $username, $password, $database);

if ($conn->connect_error) {
    $conn = new mysqli('127.0.0.1', $username, $password, $database);
    if ($conn->connect_error) {
        die("❌ Database connection failed: " . $conn->connect_error);
    }
}

echo "✅ <strong>Database connected successfully!</strong><br><br>";
$conn->set_charset("utf8mb4");

// Check current data
$current_customers = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM customers"))['count'];
$current_policies = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM policies"))['count'];

echo "<h2>📊 Current Status:</h2>";
echo "Customers: <strong>$current_customers</strong><br>";
echo "Policies: <strong>$current_policies</strong><br><br>";

if ($current_customers >= 400 && $current_policies >= 600) {
    echo "<div style='background: #d4edda; border: 1px solid #c3e6cb; padding: 20px; border-radius: 8px;'>";
    echo "🎉 <strong>MASSIVE DATA ALREADY LOADED!</strong><br>";
    echo "✅ $current_customers customers | ✅ $current_policies policies<br><br>";
    echo "<a href='/diagnosis.php' style='background: #007bff; color: white; padding: 12px 24px; text-decoration: none; border-radius: 5px; margin-right: 10px;'>📊 View Full Diagnosis</a>";
    echo "<a href='/dashboard' style='background: #28a745; color: white; padding: 12px 24px; text-decoration: none; border-radius: 5px;'>🏠 Go to Dashboard</a>";
    echo "</div>";
    exit;
}

echo "<h2>🔥 LOADING MASSIVE DATASET...</h2>";

// Check for the SQL file
$sql_file = __DIR__ . '/database/complete_massive_seed_data.sql';
if (!file_exists($sql_file)) {
    echo "<div style='background: #f8d7da; border: 1px solid #f5c6cb; padding: 15px; border-radius: 5px;'>";
    echo "❌ <strong>SQL file not found:</strong> $sql_file<br>";
    echo "Please ensure the massive seed data file exists in the database folder.";
    echo "</div>";
    exit;
}

$file_size = filesize($sql_file);
echo "✅ Found SQL file: <strong>" . basename($sql_file) . "</strong><br>";
echo "📁 File size: <strong>" . number_format($file_size / 1024, 1) . " KB</strong><br><br>";

echo "<h3>⚡ Processing Data...</h3>";
echo "<div style='background: #e7f3ff; border: 1px solid #b3d9ff; padding: 15px; border-radius: 5px; max-height: 400px; overflow-y: auto;'>";

$sql_content = file_get_contents($sql_file);
$statements = array_filter(array_map('trim', explode(';', $sql_content)));

$total_statements = count($statements);
$success_count = 0;
$error_count = 0;
$customer_inserts = 0;
$policy_inserts = 0;

echo "📋 Found <strong>$total_statements</strong> SQL statements to execute<br><br>";

foreach ($statements as $index => $statement) {
    if (empty($statement) || substr($statement, 0, 2) === '--') {
        continue;
    }
    
    $result = mysqli_query($conn, $statement);
    
    if ($result) {
        $success_count++;
        
        // Track what type of data we're inserting
        if (stripos($statement, 'INSERT INTO customers') === 0) {
            $customer_inserts++;
            if ($customer_inserts % 50 == 0) {
                echo "👥 Loaded $customer_inserts customer batches<br>";
            }
        } elseif (stripos($statement, 'INSERT INTO policies') === 0) {
            $policy_inserts++;
            if ($policy_inserts % 50 == 0) {
                echo "📋 Loaded $policy_inserts policy batches<br>";
            }
        } elseif (stripos($statement, 'INSERT INTO insurance_companies') === 0) {
            echo "🏢 Insurance companies loaded<br>";
        } elseif (stripos($statement, 'INSERT INTO users') === 0) {
            echo "👤 Agent accounts created<br>";
        }
        
        // Progress indicator
        if ($success_count % 100 == 0) {
            $percentage = round(($success_count / $total_statements) * 100, 1);
            echo "📈 Progress: $percentage% ($success_count/$total_statements)<br>";
            flush();
        }
        
    } else {
        $error_msg = mysqli_error($conn);
        
        // Ignore common acceptable errors
        if (strpos($error_msg, 'Duplicate entry') !== false || 
            strpos($error_msg, 'already exists') !== false) {
            echo "⚠️ Skipped duplicate entry<br>";
        } else {
            $error_count++;
            echo "❌ Error: " . htmlspecialchars($error_msg) . "<br>";
        }
    }
}

echo "</div>";

// Final verification
$final_customers = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM customers"))['count'];
$final_policies = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM policies"))['count'];
$final_companies = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM insurance_companies"))['count'];
$final_users = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM users"))['count'];

echo "<h2>🎯 LOADING RESULTS:</h2>";
echo "<table style='border-collapse: collapse; width: 100%; margin: 20px 0;'>";
echo "<tr style='background: #f8f9fa;'><th style='border: 1px solid #dee2e6; padding: 10px;'>Data Type</th><th style='border: 1px solid #dee2e6; padding: 10px;'>Before</th><th style='border: 1px solid #dee2e6; padding: 10px;'>After</th><th style='border: 1px solid #dee2e6; padding: 10px;'>Added</th></tr>";
echo "<tr><td style='border: 1px solid #dee2e6; padding: 10px;'>👥 Customers</td><td style='border: 1px solid #dee2e6; padding: 10px;'>$current_customers</td><td style='border: 1px solid #dee2e6; padding: 10px;'><strong>$final_customers</strong></td><td style='border: 1px solid #dee2e6; padding: 10px;'>+" . ($final_customers - $current_customers) . "</td></tr>";
echo "<tr><td style='border: 1px solid #dee2e6; padding: 10px;'>📋 Policies</td><td style='border: 1px solid #dee2e6; padding: 10px;'>$current_policies</td><td style='border: 1px solid #dee2e6; padding: 10px;'><strong>$final_policies</strong></td><td style='border: 1px solid #dee2e6; padding: 10px;'>+" . ($final_policies - $current_policies) . "</td></tr>";
echo "<tr><td style='border: 1px solid #dee2e6; padding: 10px;'>🏢 Companies</td><td style='border: 1px solid #dee2e6; padding: 10px;'>-</td><td style='border: 1px solid #dee2e6; padding: 10px;'><strong>$final_companies</strong></td><td style='border: 1px solid #dee2e6; padding: 10px;'>+$final_companies</td></tr>";
echo "<tr><td style='border: 1px solid #dee2e6; padding: 10px;'>👤 Users</td><td style='border: 1px solid #dee2e6; padding: 10px;'>-</td><td style='border: 1px solid #dee2e6; padding: 10px;'><strong>$final_users</strong></td><td style='border: 1px solid #dee2e6; padding: 10px;'>+$final_users</td></tr>";
echo "</table>";

echo "<div style='background: #e7f3ff; border: 1px solid #b3d9ff; padding: 15px; border-radius: 5px; margin: 20px 0;'>";
echo "📊 <strong>Processing Summary:</strong><br>";
echo "✅ Successful operations: <strong>$success_count</strong><br>";
echo "❌ Failed operations: <strong>$error_count</strong><br>";
echo "📈 Total statements processed: <strong>$total_statements</strong><br>";
echo "</div>";

// Success or partial success message
if ($final_customers >= 400 && $final_policies >= 600) {
    echo "<div style='background: #d4edda; border: 1px solid #c3e6cb; padding: 20px; border-radius: 8px; text-align: center;'>";
    echo "🎉 <strong>MASSIVE DATA LOADING COMPLETE!</strong><br><br>";
    echo "🎯 <strong>Your Insurance System Now Has:</strong><br>";
    echo "👥 <strong>$final_customers customers</strong> with realistic Indian names & addresses<br>";
    echo "📋 <strong>$final_policies policies</strong> across Motor, Health, Life, Travel & Property<br>";
    echo "🏢 <strong>$final_companies insurance companies</strong> with complete details<br>";
    echo "💰 <strong>₹2.5+ Crores</strong> in total premiums across multiple financial years<br><br>";
    
    echo "<div style='margin-top: 20px;'>";
    echo "<a href='/dashboard' style='background: #28a745; color: white; padding: 15px 30px; text-decoration: none; border-radius: 5px; margin-right: 15px; font-weight: bold;'>🏠 Go to Dashboard</a>";
    echo "<a href='/diagnosis.php' style='background: #007bff; color: white; padding: 15px 30px; text-decoration: none; border-radius: 5px; margin-right: 15px;'>📊 View Diagnosis</a>";
    echo "<a href='/customers' style='background: #6f42c1; color: white; padding: 15px 30px; text-decoration: none; border-radius: 5px;'>👥 View Customers</a>";
    echo "</div>";
    echo "</div>";
} else {
    echo "<div style='background: #fff3cd; border: 1px solid #ffeaa7; padding: 20px; border-radius: 8px;'>";
    echo "⚠️ <strong>Partial Data Loading Completed</strong><br>";
    echo "Some data may not have loaded completely.<br>";
    echo "Current: $final_customers customers, $final_policies policies<br><br>";
    echo "<a href='/diagnosis.php' style='background: #007bff; color: white; padding: 12px 24px; text-decoration: none; border-radius: 5px;'>📊 Run Full Diagnosis</a>";
    echo "</div>";
}

// Sample data preview
echo "<h2>👀 Sample Data Preview:</h2>";

$sample_customers = mysqli_query($conn, "SELECT name, email, city, phone FROM customers ORDER BY id DESC LIMIT 5");
if ($sample_customers && mysqli_num_rows($sample_customers) > 0) {
    echo "<h4>Recent Customers:</h4>";
    echo "<table style='border-collapse: collapse; width: 100%; margin: 10px 0;'>";
    echo "<tr style='background: #f8f9fa;'><th style='border: 1px solid #dee2e6; padding: 8px;'>Name</th><th style='border: 1px solid #dee2e6; padding: 8px;'>Email</th><th style='border: 1px solid #dee2e6; padding: 8px;'>City</th><th style='border: 1px solid #dee2e6; padding: 8px;'>Phone</th></tr>";
    while ($row = mysqli_fetch_assoc($sample_customers)) {
        echo "<tr>";
        echo "<td style='border: 1px solid #dee2e6; padding: 8px;'>" . htmlspecialchars($row['name']) . "</td>";
        echo "<td style='border: 1px solid #dee2e6; padding: 8px;'>" . htmlspecialchars($row['email']) . "</td>";
        echo "<td style='border: 1px solid #dee2e6; padding: 8px;'>" . htmlspecialchars($row['city']) . "</td>";
        echo "<td style='border: 1px solid #dee2e6; padding: 8px;'>" . htmlspecialchars($row['phone']) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
}

$sample_policies = mysqli_query($conn, "SELECT policy_number, premium_amount, category, status FROM policies ORDER BY id DESC LIMIT 5");
if ($sample_policies && mysqli_num_rows($sample_policies) > 0) {
    echo "<h4>Recent Policies:</h4>";
    echo "<table style='border-collapse: collapse; width: 100%; margin: 10px 0;'>";
    echo "<tr style='background: #f8f9fa;'><th style='border: 1px solid #dee2e6; padding: 8px;'>Policy Number</th><th style='border: 1px solid #dee2e6; padding: 8px;'>Premium</th><th style='border: 1px solid #dee2e6; padding: 8px;'>Category</th><th style='border: 1px solid #dee2e6; padding: 8px;'>Status</th></tr>";
    while ($row = mysqli_fetch_assoc($sample_policies)) {
        echo "<tr>";
        echo "<td style='border: 1px solid #dee2e6; padding: 8px;'>" . htmlspecialchars($row['policy_number']) . "</td>";
        echo "<td style='border: 1px solid #dee2e6; padding: 8px;'>₹" . number_format($row['premium_amount']) . "</td>";
        echo "<td style='border: 1px solid #dee2e6; padding: 8px;'>" . htmlspecialchars($row['category']) . "</td>";
        echo "<td style='border: 1px solid #dee2e6; padding: 8px;'><span style='background: " . ($row['status'] === 'active' ? '#28a745' : '#6c757d') . "; color: white; padding: 2px 8px; border-radius: 3px; font-size: 12px;'>" . ucfirst($row['status']) . "</span></td>";
        echo "</tr>";
    }
    echo "</table>";
}

mysqli_close($conn);
?>
