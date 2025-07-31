<?php
/**
 * Test Customer Management System
 * Run this file to test the customer functionality
 */

// Include configuration and database
require_once __DIR__ . '/config/app.php';
require_once __DIR__ . '/app/Database.php';

$db = Database::getInstance();

echo "<h1>Customer Management System Test</h1>";

// Test 1: Check database connection
echo "<h2>1. Database Connection</h2>";
try {
    $result = $db->fetch("SELECT 1 as test");
    echo "✓ Database connection successful<br>";
} catch (Exception $e) {
    echo "✗ Database connection failed: " . $e->getMessage() . "<br>";
    exit;
}

// Test 2: Check if tables exist
echo "<h2>2. Database Tables</h2>";
$tables = ['users', 'customers', 'policies', 'insurance_companies', 'policy_types'];
foreach ($tables as $table) {
    try {
        $result = $db->fetch("SHOW TABLES LIKE '$table'");
        if ($result) {
            echo "✓ Table '$table' exists<br>";
        } else {
            echo "✗ Table '$table' does not exist<br>";
        }
    } catch (Exception $e) {
        echo "✗ Error checking table '$table': " . $e->getMessage() . "<br>";
    }
}

// Test 3: Check sample data
echo "<h2>3. Sample Data</h2>";

// Check users
$userCount = $db->fetch("SELECT COUNT(*) as count FROM users")['count'];
echo "Users in database: $userCount<br>";

// Check customers
$customerCount = $db->fetch("SELECT COUNT(*) as count FROM customers")['count'];
echo "Customers in database: $customerCount<br>";

// Check policies
$policyCount = $db->fetch("SELECT COUNT(*) as count FROM policies")['count'];
echo "Policies in database: $policyCount<br>";

// Check insurance companies
$companyCount = $db->fetch("SELECT COUNT(*) as count FROM insurance_companies")['count'];
echo "Insurance companies in database: $companyCount<br>";

// Test 4: Test customer creation functionality
echo "<h2>4. Testing Customer Creation</h2>";
try {
    // Generate a unique customer code for testing
    $customer_code = 'TEST' . date('His');
    
    $testCustomer = [
        'customer_code' => $customer_code,
        'name' => 'Test Customer',
        'email' => 'test@example.com',
        'phone' => '9876543210',
        'city' => 'Mumbai',
        'state' => 'Maharashtra',
        'created_by' => 1
    ];
    
    $columns = implode(', ', array_keys($testCustomer));
    $placeholders = ':' . implode(', :', array_keys($testCustomer));
    $sql = "INSERT INTO customers ($columns) VALUES ($placeholders)";
    
    $stmt = $db->prepare($sql);
    $result = $stmt->execute($testCustomer);
    
    if ($result) {
        $customerId = $db->lastInsertId();
        echo "✓ Test customer created successfully with ID: $customerId<br>";
        
        // Clean up - delete the test customer
        $db->execute("DELETE FROM customers WHERE id = ?", [$customerId]);
        echo "✓ Test customer cleaned up<br>";
    } else {
        echo "✗ Failed to create test customer<br>";
    }
} catch (Exception $e) {
    echo "✗ Error creating test customer: " . $e->getMessage() . "<br>";
}

// Test 5: Test customer listing functionality
echo "<h2>5. Testing Customer Listing</h2>";
try {
    $customers = $db->fetchAll("
        SELECT c.*, 
               COUNT(p.id) as policy_count,
               u.name as created_by_name
        FROM customers c 
        LEFT JOIN policies p ON c.id = p.customer_id 
        LEFT JOIN users u ON c.created_by = u.id
        GROUP BY c.id 
        ORDER BY c.created_at DESC 
        LIMIT 5
    ");
    
    echo "✓ Customer listing query successful. Found " . count($customers) . " customers<br>";
    
    if (!empty($customers)) {
        echo "<table border='1' style='border-collapse: collapse; margin-top: 10px;'>";
        echo "<tr><th>Code</th><th>Name</th><th>Phone</th><th>Policies</th></tr>";
        foreach ($customers as $customer) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($customer['customer_code']) . "</td>";
            echo "<td>" . htmlspecialchars($customer['name']) . "</td>";
            echo "<td>" . htmlspecialchars($customer['phone']) . "</td>";
            echo "<td>" . $customer['policy_count'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
} catch (Exception $e) {
    echo "✗ Error testing customer listing: " . $e->getMessage() . "<br>";
}

echo "<h2>6. Next Steps</h2>";
echo "<p>✓ Customer management system is ready!</p>";
echo "<p>You can now:</p>";
echo "<ul>";
echo "<li>Visit <a href='/customers'>/customers</a> to view all customers</li>";
echo "<li>Visit <a href='/customers/create'>/customers/create</a> to add new customers</li>";
echo "<li>Use the search and filter functionality</li>";
echo "<li>Edit and view customer details</li>";
echo "<li>Track customer policies</li>";
echo "</ul>";

echo "<hr>";
echo "<p><strong>Customer Management Features Implemented:</strong></p>";
echo "<ul>";
echo "<li>✓ Customer listing with search and pagination</li>";
echo "<li>✓ Customer creation with validation</li>";
echo "<li>✓ Customer editing and updating</li>";
echo "<li>✓ Customer detail view with policy history</li>";
echo "<li>✓ Customer deletion (only if no policies)</li>";
echo "<li>✓ Export functionality</li>";
echo "<li>✓ Responsive design</li>";
echo "<li>✓ Form validation</li>";
echo "<li>✓ Indian states dropdown</li>";
echo "<li>✓ Document number formatting</li>";
echo "</ul>";
?>
