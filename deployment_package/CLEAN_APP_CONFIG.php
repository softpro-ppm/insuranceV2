<?php
/**
 * Insurance Management System v2.0
 * Application Configuration - FIXED VERSION
 */

return [
    'name' => 'Insurance Management System v2.0',
    'env' => $_ENV['APP_ENV'] ?? 'production',
    'debug' => $_ENV['APP_DEBUG'] ?? false,
    'url' => $_ENV['APP_URL'] ?? 'https://v2.insurance.softpromis.com',
    'timezone' => 'Asia/Calcutta',
    
    // Session Configuration - FIXED
    'session' => [
        'lifetime' => 120, // minutes
        'expire_on_close' => false,
        'encrypt' => false,
        'files' => sys_get_temp_dir(), // FIXED: No more storage_path()
        'cookie' => 'insurance_session',
    ],
    
    // Security
    'key' => $_ENV['APP_KEY'] ?? 'base64:'.base64_encode(random_bytes(32)),
    
    // File Upload
    'upload' => [
        'max_size' => 10240, // 10MB in KB
        'allowed_types' => ['pdf', 'doc', 'docx', 'jpg', 'jpeg', 'png'],
        'path' => 'uploads/',
    ],
];
