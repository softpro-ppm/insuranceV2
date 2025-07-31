<?php
/**
 * Configuration File
 * Insurance Management System v2.0
 */

// Include app configuration
$app_config = require_once __DIR__ . '/../config/app.php';

// Set timezone
date_default_timezone_set($app_config['timezone']);

// Database connection details
define('DB_HOST', 'localhost');
define('DB_NAME', 'u820431346_v2insurance');
define('DB_USER', 'u820431346_v2insurance');
define('DB_PASS', 'Rajesh@123');

// Application settings
define('APP_NAME', $app_config['name']);
define('APP_URL', $app_config['url']);
define('APP_ENV', $app_config['env']);
define('APP_DEBUG', $app_config['debug']);

// File upload settings
define('UPLOAD_PATH', $app_config['upload']['path']);
define('MAX_FILE_SIZE', $app_config['upload']['max_size']);
define('ALLOWED_FILE_TYPES', $app_config['upload']['allowed_types']);

// Session configuration
ini_set('session.cookie_lifetime', $app_config['session']['lifetime'] * 60);
ini_set('session.gc_maxlifetime', $app_config['session']['lifetime'] * 60);

// Error reporting based on environment
if (APP_ENV === 'development' || APP_DEBUG) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
}

// Helper function to get database connection
function getDbConnection() {
    static $pdo = null;
    
    if ($pdo === null) {
        try {
            $pdo = new PDO(
                "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4",
                DB_USER,
                DB_PASS,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ]
            );
        } catch (PDOException $e) {
            if (APP_DEBUG) {
                die("Database connection failed: " . $e->getMessage());
            } else {
                die("Database connection failed. Please try again later.");
            }
        }
    }
    
    return $pdo;
}

// Include common functions
require_once __DIR__ . '/functions.php';
