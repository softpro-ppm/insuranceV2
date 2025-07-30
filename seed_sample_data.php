<?php
/**
 * Sample Data Seeder for Insurance Management System
 * Run this once to populate initial data
 */

require_once __DIR__ . '/config/app.php';
require_once __DIR__ . '/app/Database.php';

$db = Database::getInstance();

echo "<h1>Populating Sample Data</h1>";

// Insurance Companies Data
$companies = [
    ['name' => 'HDFC ERGO General Insurance', 'code' => 'HDFC', 'type' => 'General', 'contact_email' => 'info@hdfcergo.com'],
    ['name' => 'ICICI Lombard General Insurance', 'code' => 'ICICI', 'type' => 'General', 'contact_email' => 'info@icicilombard.com'],
    ['name' => 'Bajaj Allianz General Insurance', 'code' => 'BAJAJ', 'type' => 'General', 'contact_email' => 'info@bajajallianz.co.in'],
    ['name' => 'New India Assurance Company', 'code' => 'NIAC', 'type' => 'General', 'contact_email' => 'info@newindia.co.in'],
    ['name' => 'United India Insurance Company', 'code' => 'UIIC', 'type' => 'General', 'contact_email' => 'info@uiic.co.in'],
    ['name' => 'LIC of India', 'code' => 'LIC', 'type' => 'Life', 'contact_email' => 'info@licindia.in'],
    ['name' => 'SBI Life Insurance', 'code' => 'SBIL', 'type' => 'Life', 'contact_email' => 'info@sbilife.co.in'],
    ['name' => 'Max Life Insurance', 'code' => 'MAXL', 'type' => 'Life', 'contact_email' => 'info@maxlifeinsurance.com'],
    ['name' => 'Star Health and Allied Insurance', 'code' => 'STAR', 'type' => 'Health', 'contact_email' => 'info@starhealth.in'],
    ['name' => 'Apollo Munich Health Insurance', 'code' => 'APOLLO', 'type' => 'Health', 'contact_email' => 'info@apollomunich.com']
];

echo "<h2>Inserting Insurance Companies...</h2>";
foreach ($companies as $company) {
    try {
        // Check if company already exists
        $existing = $db->fetch("SELECT id FROM insurance_companies WHERE code = ?", [$company['code']]);
        if (!$existing) {
            $sql = "INSERT INTO insurance_companies (name, code, type, contact_email, status) VALUES (?, ?, ?, ?, 'active')";
            $db->execute($sql, [$company['name'], $company['code'], $company['type'], $company['contact_email']]);
            echo "✓ Added: {$company['name']}<br>";
        } else {
            echo "- Already exists: {$company['name']}<br>";
        }
    } catch (Exception $e) {
        echo "✗ Error adding {$company['name']}: " . $e->getMessage() . "<br>";
    }
}

// Policy Types Data
$policyTypes = [
    // Motor Insurance
    ['name' => 'Two Wheeler Insurance', 'category' => 'Motor', 'description' => 'Comprehensive insurance for motorcycles and scooters'],
    ['name' => 'Four Wheeler Insurance', 'category' => 'Motor', 'description' => 'Comprehensive insurance for cars'],
    ['name' => 'Commercial Vehicle Insurance', 'category' => 'Motor', 'description' => 'Insurance for commercial vehicles'],
    
    // Health Insurance
    ['name' => 'Individual Health Insurance', 'category' => 'Health', 'description' => 'Health insurance for individuals'],
    ['name' => 'Family Health Insurance', 'category' => 'Health', 'description' => 'Health insurance for families'],
    ['name' => 'Critical Illness Insurance', 'category' => 'Health', 'description' => 'Coverage for critical illnesses'],
    ['name' => 'Senior Citizen Health Insurance', 'category' => 'Health', 'description' => 'Health insurance for senior citizens'],
    
    // Life Insurance
    ['name' => 'Term Life Insurance', 'category' => 'Life', 'description' => 'Pure life insurance coverage'],
    ['name' => 'Whole Life Insurance', 'category' => 'Life', 'description' => 'Life insurance with investment component'],
    ['name' => 'ULIP', 'category' => 'Life', 'description' => 'Unit Linked Insurance Plan'],
    ['name' => 'Endowment Policy', 'category' => 'Life', 'description' => 'Life insurance with maturity benefit'],
    
    // General Insurance
    ['name' => 'Home Insurance', 'category' => 'General', 'description' => 'Insurance for home and contents'],
    ['name' => 'Travel Insurance', 'category' => 'General', 'description' => 'Insurance for domestic and international travel'],
    ['name' => 'Fire Insurance', 'category' => 'General', 'description' => 'Insurance against fire damage']
];

echo "<h2>Inserting Policy Types...</h2>";
foreach ($policyTypes as $type) {
    try {
        // Check if policy type already exists
        $existing = $db->fetch("SELECT id FROM policy_types WHERE name = ? AND category = ?", [$type['name'], $type['category']]);
        if (!$existing) {
            $sql = "INSERT INTO policy_types (name, category, description, status) VALUES (?, ?, ?, 'active')";
            $db->execute($sql, [$type['name'], $type['category'], $type['description']]);
            echo "✓ Added: {$type['name']} ({$type['category']})<br>";
        } else {
            echo "- Already exists: {$type['name']}<br>";
        }
    } catch (Exception $e) {
        echo "✗ Error adding {$type['name']}: " . $e->getMessage() . "<br>";
    }
}

// Create a sample admin user if it doesn't exist
echo "<h2>Checking Admin User...</h2>";
try {
    $existingUser = $db->fetch("SELECT id FROM users WHERE username = 'admin'");
    if (!$existingUser) {
        $password = password_hash('admin123', PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, password, name, email, role, status) VALUES (?, ?, ?, ?, ?, 'active')";
        $db->execute($sql, ['admin', $password, 'System Administrator', 'admin@insurance.com', 'admin']);
        echo "✓ Created admin user (username: admin, password: admin123)<br>";
    } else {
        echo "- Admin user already exists<br>";
    }
} catch (Exception $e) {
    echo "✗ Error creating admin user: " . $e->getMessage() . "<br>";
}

// Summary
echo "<h2>Summary</h2>";
$companyCount = $db->fetch("SELECT COUNT(*) as count FROM insurance_companies")['count'];
$typeCount = $db->fetch("SELECT COUNT(*) as count FROM policy_types")['count'];
$userCount = $db->fetch("SELECT COUNT(*) as count FROM users")['count'];

echo "<ul>";
echo "<li>Insurance Companies: $companyCount</li>";
echo "<li>Policy Types: $typeCount</li>";
echo "<li>Users: $userCount</li>";
echo "</ul>";

echo "<p><strong>Your system is now ready for customer management!</strong></p>";
echo "<p>You can login with: username = <code>admin</code>, password = <code>admin123</code></p>";
?>
