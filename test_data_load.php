<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>🚀 Massive Data Loading System</h1>";

// Direct database connection (bypassing config.php to avoid issues)
echo "<h2>🔗 Establishing Database Connection...</h2>";

$hostname = 'localhost';
$database = 'u820431346_v2insurance';
$username = 'u820431346_v2insurance';
$password = 'Softpro@123';

$conn = new mysqli($hostname, $username, $password, $database);

if ($conn->connect_error) {
    // Try alternative connection methods
    $conn = new mysqli('127.0.0.1', $username, $password, $database);
    if ($conn->connect_error) {
        die("❌ Database connection failed: " . $conn->connect_error);
    }
}

echo "✅ Database connection established<br>";
$conn->set_charset("utf8mb4");

// Check if data already exists
$customer_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM customers"))['count'];
$policy_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM policies"))['count'];

echo "<h2>� Current Data Status:</h2>";
echo "Customers: $customer_count<br>";
echo "Policies: $policy_count<br><br>";

if ($customer_count >= 400 && $policy_count >= 600) {
    echo "<div style='background: #d4edda; border: 1px solid #c3e6cb; padding: 15px; border-radius: 5px;'>";
    echo "✅ <strong>Massive data already loaded!</strong><br>";
    echo "Customers: $customer_count | Policies: $policy_count<br>";
    echo "<a href='/diagnosis.php' style='background: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>View Diagnosis</a>";
    echo "</div>";
    exit;
}

echo "<h2>📥 Loading Massive Dataset...</h2>";

// Load the massive seed data
$seed_file = __DIR__ . '/database/complete_massive_seed_data.sql';

if (!file_exists($seed_file)) {
    die("❌ Error: Massive seed data file not found at: $seed_file");
}

echo "✅ Found massive seed data file<br>";

$seed_content = file_get_contents($seed_file);
if (!$seed_content) {
    die("❌ Error: Could not read seed data file");
}

echo "✅ Read seed data file (" . strlen($seed_content) . " bytes)<br>";

// Split into individual queries
$seed_queries = array_filter(array_map('trim', explode(';', $seed_content)));

echo "✅ Found " . count($seed_queries) . " SQL statements<br><br>";

$success_count = 0;
$error_count = 0;

echo "<h3>⚡ Executing SQL statements:</h3>";
echo "<div style='background: #f8f9fa; border: 1px solid #dee2e6; padding: 15px; border-radius: 5px; max-height: 300px; overflow-y: auto;'>";

foreach ($seed_queries as $i => $query) {
    if (!empty($query) && substr($query, 0, 2) !== '--' && substr($query, 0, 2) !== '/*') {
        if (mysqli_query($conn, $query)) {
            $success_count++;
            if (stripos($query, 'INSERT INTO customers') === 0) {
                echo "✅ Customer batch " . (floor($success_count/20) + 1) . " inserted<br>";
            } elseif (stripos($query, 'INSERT INTO policies') === 0) {
                echo "✅ Policy batch " . (floor($success_count/30) + 1) . " inserted<br>";
            } elseif ($success_count % 20 == 0) {
                echo "✅ Progress: $success_count statements completed<br>";
            }
        } else {
            $error_msg = mysqli_error($conn);
            // Ignore duplicate entry errors
            if (strpos($error_msg, 'Duplicate entry') !== false) {
                echo "⚠️ Duplicate entry (ignored)<br>";
            } else {
                echo "❌ Error: " . $error_msg . "<br>";
                $error_count++;
            }
        }
    }
}

echo "</div>";

echo "<h2>📈 Import Results:</h2>";
echo "✅ Successful operations: $success_count<br>";
echo "❌ Failed operations: $error_count<br>";

// Verify final counts
$new_customer_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM customers"))['count'];
$new_policy_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM policies"))['count'];

echo "<h2>🎯 Final Data Count:</h2>";
echo "Customers: $new_customer_count (+" . ($new_customer_count - $customer_count) . ")<br>";
echo "Policies: $new_policy_count (+" . ($new_policy_count - $policy_count) . ")<br>";

if ($new_customer_count >= 400 && $new_policy_count >= 600) {
    echo "<div style='background: #d4edda; border: 1px solid #c3e6cb; padding: 15px; border-radius: 5px; margin-top: 20px;'>";
    echo "🎉 <strong>MASSIVE DATA LOADING SUCCESSFUL!</strong><br>";
    echo "Your insurance system now has realistic production-level data.<br><br>";
    echo "<a href='/diagnosis.php' style='background: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; margin-right: 10px;'>View Full Diagnosis</a>";
    echo "<a href='/dashboard' style='background: #28a745; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Go to Dashboard</a>";
    echo "</div>";
} else {
    echo "<div style='background: #fff3cd; border: 1px solid #ffeaa7; padding: 15px; border-radius: 5px; margin-top: 20px;'>";
    echo "⚠️ <strong>Partial data loading completed</strong><br>";
    echo "Some data may not have loaded completely. Check the errors above.<br>";
    echo "<a href='/diagnosis.php' style='background: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Run Diagnosis</a>";
    echo "</div>";
}

// Sample data preview
echo "<h2>👥 Sample Loaded Data:</h2>";

$sample_customers = mysqli_query($conn, "SELECT name, email, city FROM customers ORDER BY id DESC LIMIT 5");
if ($sample_customers && mysqli_num_rows($sample_customers) > 0) {
    echo "<strong>Recent Customers:</strong><br>";
    while ($row = mysqli_fetch_assoc($sample_customers)) {
        echo "• " . htmlspecialchars($row['name']) . " (" . htmlspecialchars($row['email']) . ") - " . htmlspecialchars($row['city']) . "<br>";
    }
}

$sample_policies = mysqli_query($conn, "SELECT policy_number, premium_amount, category FROM policies ORDER BY id DESC LIMIT 5");
if ($sample_policies && mysqli_num_rows($sample_policies) > 0) {
    echo "<br><strong>Recent Policies:</strong><br>";
    while ($row = mysqli_fetch_assoc($sample_policies)) {
        echo "• " . htmlspecialchars($row['policy_number']) . " - ₹" . number_format($row['premium_amount']) . " (" . htmlspecialchars($row['category']) . ")<br>";
    }
}

mysqli_close($conn);

$success_count = 0;
$error_count = 0;

echo "<h3>Executing SQL statements:</h3>";

foreach ($seed_queries as $i => $query) {
    if (!empty($query) && substr($query, 0, 2) !== '--' && substr($query, 0, 2) !== '/*') {
        echo "Statement " . ($i + 1) . ": ";
        
        if (mysqli_query($conn, $query)) {
            echo "✅ Success<br>";
            $success_count++;
        } else {
            $error_msg = mysqli_error($conn);
            // Ignore duplicate entry errors
            if (strpos($error_msg, 'Duplicate entry') !== false) {
                echo "⚠️ Duplicate (ignored)<br>";
            } else {
                echo "❌ Error: " . $error_msg . "<br>";
                $error_count++;
            }
        }
        
        // Flush output every 10 statements
        if (($i + 1) % 10 == 0) {
            echo "<br>";
            flush();
        }
    }
}

echo "<br><h3>📊 Final Results:</h3>";
echo "✅ Successful statements: $success_count<br>";
echo "❌ Failed statements: $error_count<br>";

// Check final counts
echo "<br><h3>📈 Data Verification:</h3>";

$tables = ['customers', 'policies', 'users', 'insurance_companies'];
foreach ($tables as $table) {
    $result = mysqli_query($conn, "SELECT COUNT(*) as count FROM $table");
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        echo "📋 $table: " . $row['count'] . " records<br>";
    } else {
        echo "❌ Error checking $table: " . mysqli_error($conn) . "<br>";
    }
}

echo "<br><h3>🎯 Quick Test Query:</h3>";
$result = mysqli_query($conn, "SELECT name, email, city FROM customers LIMIT 5");
if ($result) {
    echo "<table border='1' style='border-collapse: collapse; margin: 10px 0;'>";
    echo "<tr><th>Name</th><th>Email</th><th>City</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
        echo "<td>" . htmlspecialchars($row['city']) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "❌ Error: " . mysqli_error($conn);
}

echo "<br><h3>🔗 Next Steps:</h3>";
echo "<a href='/dashboard' style='background: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Go to Dashboard</a> ";
echo "<a href='/agent-login' style='background: #28a745; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Agent Login</a>";
?>
