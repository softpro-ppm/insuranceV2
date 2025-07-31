<?php
/**
 * Insurance Management System v2.0 - Fixed Config
 * Upload this file to replace config/app.php on your server
 */

return [
    // Application Configuration
    'name' => $_ENV['APP_NAME'] ?? 'Insurance Management System v2.0',
    'env' => $_ENV['APP_ENV'] ?? 'production',
    'debug' => $_ENV['APP_DEBUG'] ?? false,
    'url' => $_ENV['APP_URL'] ?? 'http://localhost',
    
    // Database Configuration
    'database' => [
        'default' => 'mysql',
        'connections' => [
            'mysql' => [
                'driver' => 'mysql',
                'host' => $_ENV['DB_HOST'] ?? 'localhost',
                'port' => $_ENV['DB_PORT'] ?? '3306',
                'database' => $_ENV['DB_DATABASE'] ?? 'u820431346_v2insurance',
                'username' => $_ENV['DB_USERNAME'] ?? 'u820431346_v2insurance',
                'password' => $_ENV['DB_PASSWORD'] ?? 'Softpro@123',
                'charset' => 'utf8mb4',
                'collation' => 'utf8mb4_unicode_ci',
            ],
        ],
    ],
    
    // Session configuration - FIXED VERSION
    'session' => [
        'lifetime' => 120, // minutes
        'expire_on_close' => false,
        'encrypt' => false,
        'files' => sys_get_temp_dir(), // Fixed: Use system temp directory
        'cookie' => 'insurance_session',
    ],
    
    // Security
    'key' => $_ENV['APP_KEY'] ?? 'base64:'.base64_encode(random_bytes(32)),
    
    // Timezone
    'timezone' => 'Asia/Kolkata',
];
