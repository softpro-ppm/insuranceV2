<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Test script to load massive data directly
require_once 'include/config.php';

echo "<h2>🔄 Loading Massive Data (500 customers + 700 policies)...</h2>";

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
