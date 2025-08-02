<?php
require_once 'app/Database.php';

try {
    $db = Database::getInstance();
    
    // Check if insurance_companies table exists and has data
    $companies = $db->fetchAll("SELECT * FROM insurance_companies LIMIT 5");
    
    echo "Insurance Companies:\n";
    if (empty($companies)) {
        echo "No companies found. Let's create some sample companies:\n";
        
        $sample_companies = [
            ['ICICI Lombard', 'ICICI-LOMB', 'active'],
            ['HDFC ERGO', 'HDFC-ERGO', 'active'],
            ['Bajaj Allianz', 'BAJAJ-ALL', 'active'],
            ['TATA AIG', 'TATA-AIG', 'active'],
            ['New India Assurance', 'NIA', 'active'],
            ['Oriental Insurance', 'ORIENTAL', 'active'],
            ['National Insurance', 'NATIONAL', 'active'],
            ['United India Insurance', 'UNITED', 'active']
        ];
        
        foreach ($sample_companies as $company) {
            try {
                $id = $db->insert("
                    INSERT INTO insurance_companies (name, code, status, created_at, updated_at) 
                    VALUES (?, ?, ?, NOW(), NOW())
                ", $company);
                echo "Created: {$company[0]} (ID: $id)\n";
            } catch (Exception $e) {
                echo "Error creating {$company[0]}: " . $e->getMessage() . "\n";
            }
        }
        
        echo "\nRefreshing list:\n";
        $companies = $db->fetchAll("SELECT * FROM insurance_companies LIMIT 10");
    }
    
    foreach ($companies as $company) {
        echo "- {$company['name']} ({$company['code']}) - {$company['status']}\n";
    }
    
    // Check policy_types table
    echo "\nPolicy Types:\n";
    $policy_types = $db->fetchAll("SELECT * FROM policy_types LIMIT 5");
    
    if (empty($policy_types)) {
        echo "No policy types found. Creating sample types:\n";
        
        $sample_types = [
            ['Motor Insurance', 'Comprehensive vehicle insurance', 'active'],
            ['Health Insurance', 'Medical coverage insurance', 'active'],
            ['Life Insurance', 'Life coverage insurance', 'active'],
            ['Travel Insurance', 'Travel protection insurance', 'active']
        ];
        
        foreach ($sample_types as $type) {
            try {
                $id = $db->insert("
                    INSERT INTO policy_types (name, description, status, created_at, updated_at) 
                    VALUES (?, ?, ?, NOW(), NOW())
                ", $type);
                echo "Created: {$type[0]} (ID: $id)\n";
            } catch (Exception $e) {
                echo "Error creating {$type[0]}: " . $e->getMessage() . "\n";
            }
        }
        
        $policy_types = $db->fetchAll("SELECT * FROM policy_types LIMIT 10");
    }
    
    foreach ($policy_types as $type) {
        echo "- {$type['name']}: {$type['description']}\n";
    }
    
} catch (Exception $e) {
    echo "Database Error: " . $e->getMessage() . "\n";
    echo "Stack trace:\n" . $e->getTraceAsString() . "\n";
}
?>
