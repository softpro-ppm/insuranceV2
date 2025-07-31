<?php
/**
 * Insurance Management System v2.0
 * Database Configuration
 */

return [
    'default' => 'mysql',
    
    'connections' => [
        'mysql' => [
            'driver' => 'mysql',
            'host' => $_ENV['DB_HOST'] ?? 'localhost',
            'port' => $_ENV['DB_PORT'] ?? '3306',
            'database' => $_ENV['DB_DATABASE'] ?? ($_ENV['APP_ENV'] === 'local' ? 'insurance_v2_local' : 'u820431346_v2insurance'),
            'username' => $_ENV['DB_USERNAME'] ?? ($_ENV['APP_ENV'] === 'local' ? 'root' : 'u820431346_v2insurance'),
            'password' => $_ENV['DB_PASSWORD'] ?? ($_ENV['APP_ENV'] === 'local' ? '' : 'Softpro@123'),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null,
        ],
    ],
];
