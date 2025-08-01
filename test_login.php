<?php
/**
 * Test Login Credentials
 */
session_start();

// Load configuration
require_once __DIR__ . '/config/app.php';
require_once __DIR__ . '/app/Database.php';

echo "<h2>🔍 Login Credentials Test</h2>";

try {
    $db = Database::getInstance();
    
    echo "<h3>📊 Database Users:</h3>";
    $users = $db->fetchAll("SELECT id, name, username, email, role, status FROM users");
    
    echo "<table border='1' style='border-collapse: collapse; margin: 10px 0;'>";
    echo "<tr><th>ID</th><th>Name</th><th>Username</th><th>Email</th><th>Role</th><th>Status</th></tr>";
    
    foreach ($users as $user) {
        echo "<tr>";
        echo "<td>{$user['id']}</td>";
        echo "<td>{$user['name']}</td>";
        echo "<td><strong>{$user['username']}</strong></td>";
        echo "<td>{$user['email']}</td>";
        echo "<td>{$user['role']}</td>";
        echo "<td>{$user['status']}</td>";
        echo "</tr>";
    }
    echo "</table>";
    
    echo "<h3>🔑 Password Verification Test:</h3>";
    $admin = $db->fetch("SELECT * FROM users WHERE username = 'admin'");
    
    if ($admin) {
        $passwords_to_test = ['password', 'admin123', 'admin', '123456'];
        
        foreach ($passwords_to_test as $test_password) {
            $result = password_verify($test_password, $admin['password']);
            $status = $result ? "✅ WORKS" : "❌ Failed";
            echo "<p><strong>'{$test_password}'</strong>: {$status}</p>";
        }
        
        echo "<h3>📝 Correct Login Credentials:</h3>";
        echo "<div style='background: #d4edda; padding: 15px; border: 1px solid #c3e6cb; border-radius: 5px; margin: 10px 0;'>";
        echo "<strong>Username:</strong> admin<br>";
        echo "<strong>Password:</strong> password";
        echo "</div>";
        
    } else {
        echo "<p>❌ No admin user found!</p>";
    }
    
} catch (Exception $e) {
    echo "<p>❌ Error: " . $e->getMessage() . "</p>";
}

echo "<br><a href='/login' style='background: #007bff; color: white; padding: 10px 15px; text-decoration: none; border-radius: 5px;'>← Back to Login</a>";
?>
