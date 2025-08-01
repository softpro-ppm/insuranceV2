<?php
/**
 * Database Data Diagnostic Tool
 * Check if there's data in the database tables
 */

require_once __DIR__ . '/config/app.php';
require_once __DIR__ . '/app/Database.php';

echo "<h1>Database Data Diagnostic</h1>";
echo "<style>
    body { font-family: Arial, sans-serif; margin: 20px; }
    table { border-collapse: collapse; width: 100%; margin: 20px 0; }
    th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
    th { background-color: #f2f2f2; }
    .error { color: red; }
    .success { color: green; }
    .warning { color: orange; }
</style>";

try {
    $db = Database::getInstance();
    echo "<p class='success'>✓ Database connection successful</p>";
    
    // Check main tables and count records
    $tables = [
        'customers' => 'Customer records',
        'policies' => 'Policy records', 
        'insurance_companies' => 'Insurance companies',
        'policy_types' => 'Policy types',
        'users' => 'Users (including agents)'
    ];
    
    echo "<h2>Table Record Counts</h2>";
    echo "<table>";
    echo "<tr><th>Table</th><th>Description</th><th>Record Count</th><th>Status</th></tr>";
    
    $totalRecords = 0;
    foreach ($tables as $table => $description) {
        try {
            $result = $db->fetch("SELECT COUNT(*) as count FROM $table");
            $count = $result['count'] ?? 0;
            $totalRecords += $count;
            
            $status = $count > 0 ? "<span class='success'>✓ Has data</span>" : "<span class='warning'>⚠ Empty</span>";
            echo "<tr><td>$table</td><td>$description</td><td>$count</td><td>$status</td></tr>";
        } catch (Exception $e) {
            echo "<tr><td>$table</td><td>$description</td><td colspan='2'><span class='error'>✗ Error: " . $e->getMessage() . "</span></td></tr>";
        }
    }
    echo "</table>";
    
    echo "<h2>Summary</h2>";
    if ($totalRecords == 0) {
        echo "<p class='warning'>⚠ No data found in any tables. This explains why the dashboard shows 0 values.</p>";
        echo "<h3>Solutions:</h3>";
        echo "<ol>";
        echo "<li><strong>Run Sample Data Seeder:</strong> <code>php seed_sample_data.php</code></li>";
        echo "<li><strong>Or manually add data through the application forms</strong></li>";
        echo "<li><strong>Or import existing data via SQL</strong></li>";
        echo "</ol>";
    } else {
        echo "<p class='success'>✓ Found $totalRecords total records across tables</p>";
    }
    
    // Check specifically for policies with valid dates and amounts
    echo "<h2>Policy Data Analysis</h2>";
    try {
        $policyStats = $db->fetch("
            SELECT 
                COUNT(*) as total_policies,
                COUNT(CASE WHEN status = 'active' THEN 1 END) as active_policies,
                COALESCE(SUM(premium_amount), 0) as total_premium,
                COALESCE(AVG(premium_amount), 0) as avg_premium,
                MIN(policy_start_date) as earliest_date,
                MAX(policy_start_date) as latest_date
            FROM policies
        ");
        
        echo "<table>";
        echo "<tr><th>Metric</th><th>Value</th></tr>";
        echo "<tr><td>Total Policies</td><td>" . number_format($policyStats['total_policies']) . "</td></tr>";
        echo "<tr><td>Active Policies</td><td>" . number_format($policyStats['active_policies']) . "</td></tr>";
        echo "<tr><td>Total Premium</td><td>₹" . number_format($policyStats['total_premium'], 2) . "</td></tr>";
        echo "<tr><td>Average Premium</td><td>₹" . number_format($policyStats['avg_premium'], 2) . "</td></tr>";
        echo "<tr><td>Date Range</td><td>" . ($policyStats['earliest_date'] ?? 'N/A') . " to " . ($policyStats['latest_date'] ?? 'N/A') . "</td></tr>";
        echo "</table>";
        
        if ($policyStats['total_policies'] == 0) {
            echo "<p class='warning'>⚠ No policies found. Dashboard will show 0 values.</p>";
        }
        
    } catch (Exception $e) {
        echo "<p class='error'>✗ Error analyzing policy data: " . $e->getMessage() . "</p>";
    }
    
    // Show current date calculations used by dashboard
    echo "<h2>Dashboard Date Calculations</h2>";
    $current_date = date('Y-m-d');
    $current_month_start = date('Y-m-01');
    $current_month_end = date('Y-m-t');
    
    // Financial Year (April to March)
    $current_year = date('Y');
    $current_month = date('m');
    if ($current_month >= 4) {
        $fy_start = $current_year . '-04-01';
        $fy_end = ($current_year + 1) . '-03-31';
        $fy_label = 'FY ' . $current_year . '-' . ($current_year + 1);
    } else {
        $fy_start = ($current_year - 1) . '-04-01';
        $fy_end = $current_year . '-03-31';
        $fy_label = 'FY ' . ($current_year - 1) . '-' . $current_year;
    }
    
    echo "<table>";
    echo "<tr><th>Period</th><th>Date Range</th></tr>";
    echo "<tr><td>Current Date</td><td>$current_date</td></tr>";
    echo "<tr><td>Current Month</td><td>$current_month_start to $current_month_end</td></tr>";
    echo "<tr><td>Financial Year ($fy_label)</td><td>$fy_start to $fy_end</td></tr>";
    echo "</table>";
    
} catch (Exception $e) {
    echo "<p class='error'>✗ Database connection failed: " . $e->getMessage() . "</p>";
    echo "<h3>Possible Issues:</h3>";
    echo "<ul>";
    echo "<li>Database credentials incorrect</li>";
    echo "<li>Database server not running</li>";
    echo "<li>Database does not exist</li>";
    echo "<li>Database tables not created</li>";
    echo "</ul>";
}

echo "<hr>";
echo "<p><em>Generated on " . date('Y-m-d H:i:s') . "</em></p>";
?>
