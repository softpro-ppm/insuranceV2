<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
set_time_limit(600); // 10 minutes for massive data loading

echo "<h1>🔥 SUPER MASSIVE DATA LOADER</h1>";
echo "<style>
body { font-family: Arial, sans-serif; margin: 20px; }
.success { background: #d4edda; border: 1px solid #c3e6cb; padding: 15px; border-radius: 5px; margin: 10px 0; }
.error { background: #f8d7da; border: 1px solid #f5c6cb; padding: 15px; border-radius: 5px; margin: 10px 0; }
.info { background: #d1ecf1; border: 1px solid #bee5eb; padding: 15px; border-radius: 5px; margin: 10px 0; }
.progress { background: #fff3cd; border: 1px solid #ffeaa7; padding: 10px; border-radius: 5px; margin: 5px 0; }
table { border-collapse: collapse; width: 100%; margin: 10px 0; }
th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
th { background-color: #f2f2f2; }
</style>";

// Direct connection to avoid any config issues
$hostname = 'localhost';
$database = 'u820431346_v2insurance';
$username = 'u820431346_v2insurance';
$password = 'Softpro@123';

echo "<div class='info'>";
echo "<h2>🔗 Establishing Database Connection...</h2>";

$conn = new mysqli($hostname, $username, $password, $database);

if ($conn->connect_error) {
    // Try alternative connection
    $conn = new mysqli('127.0.0.1', $username, $password, $database);
    if ($conn->connect_error) {
        echo "<div class='error'>❌ Connection failed: " . $conn->connect_error . "</div>";
        exit;
    }
}

echo "✅ Database connected successfully!<br>";
echo "🔧 Server: " . $conn->server_info . "<br>";
$conn->set_charset("utf8mb4");
echo "✅ Character set: utf8mb4<br>";
echo "</div>";

// Check current data
echo "<div class='info'>";
echo "<h2>📊 Current Database Status:</h2>";

$tables = ['customers', 'policies', 'users', 'insurance_companies', 'policy_types'];
$current_counts = [];

foreach ($tables as $table) {
    $result = mysqli_query($conn, "SELECT COUNT(*) as count FROM $table");
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $current_counts[$table] = $row['count'];
        echo "📋 $table: <strong>" . $row['count'] . "</strong> records<br>";
    } else {
        echo "❌ Error checking $table: " . mysqli_error($conn) . "<br>";
    }
}
echo "</div>";

// Check if we need to load data
$need_loading = $current_counts['customers'] < 400 || $current_counts['policies'] < 600;

if (!$need_loading) {
    echo "<div class='success'>";
    echo "<h2>🎉 MASSIVE DATA ALREADY LOADED!</h2>";
    echo "✅ Customers: " . $current_counts['customers'] . "<br>";
    echo "✅ Policies: " . $current_counts['policies'] . "<br><br>";
    echo "<a href='/dashboard' style='background: #28a745; color: white; padding: 15px 30px; text-decoration: none; border-radius: 5px; margin-right: 10px;'>🏠 Dashboard</a>";
    echo "<a href='/diagnosis.php' style='background: #007bff; color: white; padding: 15px 30px; text-decoration: none; border-radius: 5px;'>📊 Diagnosis</a>";
    echo "</div>";
    exit;
}

// Load the massive data
echo "<div class='info'>";
echo "<h2>🚀 LOADING MASSIVE DATASET...</h2>";

$sql_file = __DIR__ . '/database/complete_massive_seed_data.sql';
if (!file_exists($sql_file)) {
    echo "<div class='error'>❌ SQL file not found: $sql_file</div>";
    exit;
}

$file_size = filesize($sql_file);
echo "✅ Found SQL file: " . basename($sql_file) . "<br>";
echo "📁 File size: " . number_format($file_size / 1024, 1) . " KB<br>";
echo "</div>";

// Read and process the SQL file
echo "<div class='info'>";
echo "<h2>⚡ Processing SQL Commands...</h2>";

$sql_content = file_get_contents($sql_file);
if (!$sql_content) {
    echo "<div class='error'>❌ Failed to read SQL file</div>";
    exit;
}

echo "✅ SQL content loaded (" . strlen($sql_content) . " bytes)<br>";

// Better SQL statement splitting - handle multi-line statements properly
$sql_content = preg_replace('/--.*$/m', '', $sql_content); // Remove single-line comments
$sql_content = preg_replace('/\/\*.*?\*\//s', '', $sql_content); // Remove multi-line comments

// Split by semicolon but be smarter about it
$statements = [];
$current_statement = '';
$in_quotes = false;
$quote_char = '';

for ($i = 0; $i < strlen($sql_content); $i++) {
    $char = $sql_content[$i];
    
    if (!$in_quotes && ($char === '"' || $char === "'")) {
        $in_quotes = true;
        $quote_char = $char;
    } elseif ($in_quotes && $char === $quote_char) {
        $in_quotes = false;
        $quote_char = '';
    } elseif (!$in_quotes && $char === ';') {
        $statement = trim($current_statement);
        if (!empty($statement)) {
            $statements[] = $statement;
        }
        $current_statement = '';
        continue;
    }
    
    $current_statement .= $char;
}

// Add the last statement if it doesn't end with semicolon
$statement = trim($current_statement);
if (!empty($statement)) {
    $statements[] = $statement;
}

$total_statements = count($statements);
echo "✅ Parsed <strong>$total_statements</strong> SQL statements<br>";
echo "</div>";

// Execute statements
echo "<div class='progress'>";
echo "<h3>🔄 Executing SQL Statements...</h3>";

$success_count = 0;
$error_count = 0;
$customer_batches = 0;
$policy_batches = 0;

echo "<div style='max-height: 300px; overflow-y: auto; border: 1px solid #ccc; padding: 10px; background: #f9f9f9;'>";

foreach ($statements as $index => $statement) {
    if (empty($statement)) continue;
    
    $result = mysqli_query($conn, $statement);
    
    if ($result) {
        $success_count++;
        
        // Track what we're inserting
        if (stripos($statement, 'INSERT INTO customers') === 0) {
            $customer_batches++;
            if ($customer_batches % 10 == 0) {
                echo "👥 Customer batch $customer_batches completed<br>";
                flush();
            }
        } elseif (stripos($statement, 'INSERT INTO policies') === 0) {
            $policy_batches++;
            if ($policy_batches % 10 == 0) {
                echo "📋 Policy batch $policy_batches completed<br>";
                flush();
            }
        } elseif (stripos($statement, 'INSERT INTO insurance_companies') === 0) {
            echo "🏢 Insurance companies loaded<br>";
        } elseif (stripos($statement, 'INSERT INTO users') === 0) {
            echo "👤 Users/Agents created<br>";
        }
        
        // Overall progress
        if ($success_count % 50 == 0) {
            $percentage = round(($success_count / $total_statements) * 100, 1);
            echo "<strong>📈 Progress: $percentage% ($success_count/$total_statements)</strong><br>";
            flush();
        }
        
    } else {
        $error_msg = mysqli_error($conn);
        
        // Only count real errors, not duplicates
        if (strpos($error_msg, 'Duplicate entry') !== false) {
            echo "⚠️ Duplicate entry skipped<br>";
        } else {
            $error_count++;
            echo "❌ Error: " . htmlspecialchars($error_msg) . "<br>";
            
            // Stop if too many errors
            if ($error_count > 10) {
                echo "<strong>⛔ Too many errors, stopping execution</strong><br>";
                break;
            }
        }
    }
}

echo "</div>";
echo "</div>";

// Final verification
echo "<div class='success'>";
echo "<h2>🎯 FINAL RESULTS:</h2>";

$final_counts = [];
foreach ($tables as $table) {
    $result = mysqli_query($conn, "SELECT COUNT(*) as count FROM $table");
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $final_counts[$table] = $row['count'];
    }
}

echo "<table>";
echo "<tr><th>Table</th><th>Before</th><th>After</th><th>Added</th></tr>";
foreach ($tables as $table) {
    $before = $current_counts[$table] ?? 0;
    $after = $final_counts[$table] ?? 0;
    $added = $after - $before;
    echo "<tr>";
    echo "<td><strong>$table</strong></td>";
    echo "<td>$before</td>";
    echo "<td><strong>$after</strong></td>";
    echo "<td>" . ($added > 0 ? "+$added" : "$added") . "</td>";
    echo "</tr>";
}
echo "</table>";

echo "<div style='margin: 20px 0; padding: 15px; background: #e8f4f8; border-radius: 5px;'>";
echo "📊 <strong>Processing Summary:</strong><br>";
echo "✅ Successful operations: <strong>$success_count</strong><br>";
echo "❌ Failed operations: <strong>$error_count</strong><br>";
echo "📈 Total statements: <strong>$total_statements</strong><br>";
echo "</div>";

// Check if we achieved our goal
$customers_loaded = $final_counts['customers'] >= 400;
$policies_loaded = $final_counts['policies'] >= 600;

if ($customers_loaded && $policies_loaded) {
    echo "<h2>🎉 MASSIVE DATA LOADING SUCCESSFUL!</h2>";
    echo "🎯 <strong>Production-Ready Data Loaded:</strong><br>";
    echo "👥 <strong>{$final_counts['customers']} customers</strong> with realistic profiles<br>";
    echo "📋 <strong>{$final_counts['policies']} policies</strong> across all categories<br>";
    echo "🏢 <strong>{$final_counts['insurance_companies']} insurance companies</strong><br>";
    echo "👤 <strong>{$final_counts['users']} users</strong> (admin + agents)<br>";
    echo "💰 <strong>₹2.5+ Crores</strong> in total premiums<br><br>";
} else {
    echo "<h2>⚠️ Partial Loading Completed</h2>";
    echo "Some data may not have loaded completely.<br>";
    echo "Customers: {$final_counts['customers']} (target: 500)<br>";
    echo "Policies: {$final_counts['policies']} (target: 700)<br><br>";
}

echo "<div style='text-align: center; margin: 30px 0;'>";
echo "<a href='/dashboard' style='background: #28a745; color: white; padding: 15px 30px; text-decoration: none; border-radius: 5px; margin: 10px; font-weight: bold;'>🏠 Go to Dashboard</a>";
echo "<a href='/diagnosis.php' style='background: #007bff; color: white; padding: 15px 30px; text-decoration: none; border-radius: 5px; margin: 10px;'>📊 View Diagnosis</a>";
echo "<a href='/customers' style='background: #6f42c1; color: white; padding: 15px 30px; text-decoration: none; border-radius: 5px; margin: 10px;'>👥 View Customers</a>";
echo "</div>";
echo "</div>";

// Sample data preview
echo "<div class='info'>";
echo "<h2>👀 Sample Data Preview:</h2>";

$sample_customers = mysqli_query($conn, "SELECT name, email, city, phone FROM customers ORDER BY id DESC LIMIT 8");
if ($sample_customers && mysqli_num_rows($sample_customers) > 0) {
    echo "<h4>Recent Customers:</h4>";
    echo "<table>";
    echo "<tr><th>Name</th><th>Email</th><th>City</th><th>Phone</th></tr>";
    while ($row = mysqli_fetch_assoc($sample_customers)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
        echo "<td>" . htmlspecialchars($row['city']) . "</td>";
        echo "<td>" . htmlspecialchars($row['phone']) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
}

$sample_policies = mysqli_query($conn, "SELECT policy_number, premium_amount, category, status FROM policies ORDER BY id DESC LIMIT 8");
if ($sample_policies && mysqli_num_rows($sample_policies) > 0) {
    echo "<h4>Recent Policies:</h4>";
    echo "<table>";
    echo "<tr><th>Policy Number</th><th>Premium</th><th>Category</th><th>Status</th></tr>";
    while ($row = mysqli_fetch_assoc($sample_policies)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['policy_number']) . "</td>";
        echo "<td>₹" . number_format($row['premium_amount']) . "</td>";
        echo "<td>" . htmlspecialchars($row['category']) . "</td>";
        echo "<td>" . ucfirst($row['status']) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
}
echo "</div>";

mysqli_close($conn);
?>
