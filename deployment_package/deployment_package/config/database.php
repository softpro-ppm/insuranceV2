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
            'database' => $_ENV['DB_DATABASE'] ?? 'u820431346_v2insurance',
            'username' => $_ENV['DB_USERNAME'] ?? 'u820431346_v2insurance',
            'password' => $_ENV['DB_PASSWORD'] ?? 'Softpro@123',
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null,
        ],
    ],
];
