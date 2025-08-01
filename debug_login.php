<?php
/**
 * Debug Login Process
 */
session_start();

// Load configuration
require_once __DIR__ . '/config/app.php';
require_once __DIR__ . '/app/Database.php';

echo "<h2>🔧 Login Debug</h2>";

try {
    $db = Database::getInstance();
    
    // Test credentials
    $username = 'admin';
    $password = 'admin123';
    
    echo "<h3>Step 1: Database Connection</h3>";
    echo "✅ Database connected successfully<br>";
    
    echo "<h3>Step 2: User Lookup</h3>";
    $user = $db->fetch(
        "SELECT * FROM users WHERE username = ? AND status = 'active'", 
        [$username]
    );
    
    if (!$user) {
        echo "❌ User not found or not active<br>";
        exit;
    }
    
    echo "✅ User found: {$user['name']} ({$user['email']})<br>";
    echo "User ID: {$user['id']}<br>";
    echo "Role: {$user['role']}<br>";
    echo "Status: {$user['status']}<br>";
    
    echo "<h3>Step 3: Password Verification</h3>";
    echo "Stored hash: {$user['password']}<br>";
    echo "Testing password: {$password}<br>";
    
    $verify_result = password_verify($password, $user['password']);
    echo "Verification result: " . ($verify_result ? "✅ SUCCESS" : "❌ FAILED") . "<br>";
    
    if ($verify_result) {
        echo "<h3>✅ LOGIN SHOULD WORK</h3>";
        echo "<div style='background: #d4edda; padding: 15px; border: 1px solid #c3e6cb; border-radius: 5px;'>";
        echo "<strong>Credentials are correct!</strong><br>";
        echo "Username: admin<br>";
        echo "Password: admin123<br>";
        echo "The login issue might be elsewhere in the system.";
        echo "</div>";
    } else {
        echo "<h3>❌ LOGIN WILL FAIL</h3>";
        echo "<div style='background: #f8d7da; padding: 15px; border: 1px solid #f5c6cb; border-radius: 5px;'>";
        echo "<strong>Password verification failed!</strong><br>";
        echo "Need to reset the password.";
        echo "</div>";
    }
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage();
}
?>
