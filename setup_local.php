<?php
/**
 * Local Development Setup Script
 * Initializes database and loads sample data
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "🏗️ Insurance Management System v2.0 - Local Setup\n";
echo "================================================\n\n";

try {
    // Load configuration
    echo "📋 Loading configuration...\n";
    require_once __DIR__ . '/config/app.php';
    require_once __DIR__ . '/app/Database.php';
    
    // Test database connection
    echo "📡 Testing database connection...\n";
    $db = Database::getInstance();
    
    // Get PDO connection for raw SQL execution
    $reflection = new ReflectionClass($db);
    $property = $reflection->getProperty('connection');
    $property->setAccessible(true);
    $pdo = $property->getValue($db);
    
    echo "✅ Database connected successfully!\n\n";
    
    // Check current database
    echo "🔍 Checking current database...\n";
    $currentDB = $pdo->query("SELECT DATABASE()")->fetchColumn();
    echo "Current database: " . ($currentDB ?: 'none') . "\n\n";
    
    // Explicitly select our database
    echo "🎯 Selecting insurance_v2 database...\n";
    $pdo->exec("USE insurance_v2");
    echo "✅ Database selected!\n\n";
    
    // Check if tables exist
    echo "🔍 Checking existing tables...\n";
    $tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
    
    if (empty($tables)) {
        echo "📊 No tables found. Creating database schema...\n";
        
        // Read and execute database initialization
        $initFile = __DIR__ . '/database/init_database.sql';
        if (file_exists($initFile)) {
            echo "📖 Reading SQL file: {$initFile}\n";
            $initSql = file_get_contents($initFile);
            echo "📊 SQL file size: " . strlen($initSql) . " characters\n";
            
            // Remove comments and split by semicolons
            $cleanSql = preg_replace('/--.*$/m', '', $initSql); // Remove line comments
            $cleanSql = preg_replace('/\/\*.*?\*\//s', '', $cleanSql); // Remove block comments
            
            // Split SQL into individual queries
            $queries = array_filter(
                array_map('trim', explode(';', $cleanSql)),
                function($query) { return !empty($query); }
            );
            
            echo "📋 Found " . count($queries) . " SQL statements\n";
            
            $successCount = 0;
            foreach ($queries as $index => $query) {
                // Skip empty queries or whitespace-only queries
                if (empty(trim($query))) continue;
                
                echo "Executing query " . ($index + 1) . ": " . substr(trim($query), 0, 50) . "...\n";
                
                try {
                    $stmt = $pdo->prepare(trim($query));
                    $stmt->execute();
                    
                    // If it's a SELECT statement, fetch the results to clear buffer
                    if (stripos(trim($query), 'SELECT') === 0) {
                        $stmt->fetchAll();
                    }
                    
                    $successCount++;
                    $rowCount = $stmt->rowCount();
                    echo "  ✅ Success (affected rows: {$rowCount})\n";
                } catch (PDOException $e) {
                    if (strpos($e->getMessage(), 'already exists') !== false) {
                        echo "  ⚠️ Skipped (already exists)\n";
                        $successCount++;
                    } else {
                        echo "  ❌ Failed: " . $e->getMessage() . "\n";
                        echo "Query: " . trim($query) . "\n";
                        throw $e;
                    }
                }
            }
            echo "✅ Database schema created! ({$successCount} queries executed)\n\n";
        } else {
            echo "⚠️ Database init file not found: {$initFile}\n";
        }
    } else {
        echo "✅ Found " . count($tables) . " existing tables\n\n";
    }
    
    // Check if we have data
    echo "📊 Checking existing data...\n";
    $customerCount = $pdo->query("SELECT COUNT(*) FROM customers")->fetchColumn();
    $policyCount = $pdo->query("SELECT COUNT(*) FROM policies")->fetchColumn();
    $userCount = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
    
    echo "Current data: {$customerCount} customers, {$policyCount} policies, {$userCount} users\n\n";
    
    if ($customerCount == 0 || $policyCount == 0) {
        echo "🔄 Loading sample data...\n";
        
        // Load sample data
        $sampleFile = __DIR__ . '/database/simple_seed_data.sql';
        if (file_exists($sampleFile)) {
            $sampleSql = file_get_contents($sampleFile);
            
            // Split and execute queries
            $queries = array_filter(
                array_map('trim', 
                    preg_split('/;(?=(?:[^\']*\'[^\']*\')*[^\']*$)/', $sampleSql)
                )
            );
            
            $insertCount = 0;
            foreach ($queries as $query) {
                if (empty($query) || strpos($query, '--') === 0) continue;
                try {
                    $stmt = $pdo->prepare($query);
                    $stmt->execute();
                    if (strpos($query, 'INSERT') === 0) {
                        $insertCount += $stmt->rowCount();
                    }
                } catch (PDOException $e) {
                    if (strpos($e->getMessage(), 'Duplicate entry') === false) {
                        echo "Warning: " . $e->getMessage() . "\n";
                    }
                }
            }
            echo "✅ Sample data loaded! ({$insertCount} records inserted)\n\n";
        } else {
            echo "⚠️ Sample data file not found: {$sampleFile}\n";
        }
    } else {
        echo "✅ Database already has data\n\n";
    }
    
    // Create admin user if not exists
    echo "👤 Setting up admin user...\n";
    $adminExists = $pdo->query("SELECT COUNT(*) FROM users WHERE username = 'admin'")->fetchColumn();
    
    if ($adminExists == 0) {
        $stmt = $pdo->prepare("INSERT INTO users (name, username, email, password, role, status, created_at) VALUES (?, ?, ?, ?, ?, ?, NOW())");
        $stmt->execute([
            'Admin User',
            'admin',
            'admin@insurance.local',
            password_hash('admin123', PASSWORD_DEFAULT),
            'admin',
            'active'
        ]);
        echo "✅ Admin user created!\n";
    } else {
        echo "✅ Admin user already exists\n";
    }
    
    // Final status check
    echo "\n📈 Final database status:\n";
    $finalCustomers = $pdo->query("SELECT COUNT(*) FROM customers")->fetchColumn();
    $finalPolicies = $pdo->query("SELECT COUNT(*) FROM policies")->fetchColumn();
    $finalUsers = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
    $finalCompanies = $pdo->query("SELECT COUNT(*) FROM insurance_companies")->fetchColumn();
    
    echo "- Customers: {$finalCustomers}\n";
    echo "- Policies: {$finalPolicies}\n";
    echo "- Users: {$finalUsers}\n";
    echo "- Insurance Companies: {$finalCompanies}\n";
    
    echo "\n🎉 Local setup completed successfully!\n";
    echo "================================================\n";
    echo "📋 Next Steps:\n";
    echo "1. Run: php server.php\n";
    echo "2. Visit: http://localhost:8000\n";
    echo "3. Login with:\n";
    echo "   👤 Username: admin\n";
    echo "   🔑 Password: password\n";
    echo "================================================\n";
    
} catch (Exception $e) {
    echo "\n❌ Setup failed: " . $e->getMessage() . "\n";
    echo "\n🔧 Troubleshooting:\n";
    echo "1. Make sure MySQL is running\n";
    echo "2. Create database: CREATE DATABASE insurance_v2;\n";
    echo "3. Create user: CREATE USER 'insurance_user'@'localhost' IDENTIFIED BY 'password123';\n";
    echo "4. Grant permissions: GRANT ALL ON insurance_v2.* TO 'insurance_user'@'localhost';\n";
    echo "\nError details: " . $e->getTraceAsString() . "\n";
}
