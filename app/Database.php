<?php
/**
 * Database Connection Class
 */

class Database {
    private static $instance = null;
    private $connection;
    
    private function __construct() {
        $config = require_once __DIR__ . '/../config/database.php';
        $db = $config['connections']['mysql'];
        
        try {
            $this->connection = new PDO(
                "mysql:host={$db['host']};port={$db['port']};dbname={$db['database']};charset={$db['charset']}",
                $db['username'],
                $db['password'],
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ]
            );
        } catch (PDOException $e) {
            $error_message = "Database connection failed: " . $e->getMessage();
            
            // Add helpful debug information for developers
            if (isset($_ENV['APP_DEBUG']) && $_ENV['APP_DEBUG']) {
                $error_message .= "\n\nDatabase Configuration:";
                $error_message .= "\nHost: " . $db['host'];
                $error_message .= "\nDatabase: " . $db['database'];
                $error_message .= "\nUsername: " . $db['username'];
                $error_message .= "\n\nTo fix this issue:";
                
                if ($db['username'] === 'root' && empty($db['password'])) {
                    $error_message .= "\n1. Make sure MySQL/XAMPP/MAMP is running";
                    $error_message .= "\n2. Create a database named: " . $db['database'];
                    $error_message .= "\n3. Import the database structure from: database/init_database.sql";
                } else {
                    $error_message .= "\n1. Check if the production database credentials are correct";
                    $error_message .= "\n2. Or copy .env.local to .env for local development";
                }
            }
            
            die("<pre>" . htmlspecialchars($error_message) . "</pre>");
        }
    }
    
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function getConnection() {
        return $this->connection;
    }
    
    public function query($sql, $params = []) {
        $stmt = $this->connection->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
    
    public function fetchAll($sql, $params = []) {
        return $this->query($sql, $params)->fetchAll();
    }
    
    public function fetch($sql, $params = []) {
        return $this->query($sql, $params)->fetch();
    }
    
    public function execute($sql, $params = []) {
        return $this->query($sql, $params)->rowCount();
    }
    
    public function prepare($sql) {
        return $this->connection->prepare($sql);
    }
    
    public function lastInsertId() {
        return $this->connection->lastInsertId();
    }
}
