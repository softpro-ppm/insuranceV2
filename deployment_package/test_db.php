<?php
/**
 * Database Connection Test
 */

// Test different possible credentials
$credentials = [
    ['host' => 'localhost', 'db' => 'u820431346_v2insurance', 'user' => 'u820431346_v2insurance', 'pass' => 'Softpro@123'],
    ['host' => 'localhost', 'db' => 'u820431346_v2insurance', 'user' => 'u820431346_v2insurance', 'pass' => 'Rajesh@123'],
    ['host' => 'localhost', 'db' => 'insuranceV2', 'user' => 'root', 'pass' => ''],
    ['host' => 'localhost', 'db' => 'insurance_v2', 'user' => 'root', 'pass' => ''],
    ['host' => 'localhost', 'db' => 'insurance', 'user' => 'root', 'pass' => ''],
];

foreach ($credentials as $i => $cred) {
    echo "Testing connection " . ($i + 1) . ":\n";
    echo "Host: {$cred['host']}, DB: {$cred['db']}, User: {$cred['user']}\n";
    
    try {
        $pdo = new PDO(
            "mysql:host={$cred['host']};dbname={$cred['db']};charset=utf8mb4",
            $cred['user'],
            $cred['pass'],
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
        echo "✅ SUCCESS: Connected successfully!\n";
        
        // Test if users table exists
        $stmt = $pdo->query("SHOW TABLES LIKE 'users'");
        if ($stmt->rowCount() > 0) {
            echo "✅ Users table found\n";
            
            // Check if there are any users
            $stmt = $pdo->query("SELECT COUNT(*) as count FROM users");
            $count = $stmt->fetch()['count'];
            echo "Users count: $count\n";
        } else {
            echo "❌ Users table not found\n";
        }
        
        echo "=================================\n";
        break; // Stop on first successful connection
        
    } catch (PDOException $e) {
        echo "❌ FAILED: " . $e->getMessage() . "\n";
        echo "=================================\n";
    }
}
