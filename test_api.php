<?php
session_start();
$_SESSION['user_id'] = 1; // Simulate logged in user for testing

require_once 'app/Database.php';

try {
    $db = Database::getInstance();
    
    echo "Testing API endpoints:\n\n";
    
    // Test insurance companies
    $companies = $db->fetchAll("SELECT id, name FROM insurance_companies WHERE status = 'active' ORDER BY name");
    echo "Insurance Companies (" . count($companies) . "):\n";
    foreach ($companies as $company) {
        echo "- {$company['name']} (ID: {$company['id']})\n";
    }
    
    echo "\nJSON Response for insurance companies:\n";
    echo json_encode(['success' => true, 'companies' => $companies]) . "\n";
    
    // Test agents
    $agents = $db->fetchAll("SELECT id, name FROM users WHERE role = 'agent' AND status = 'active' ORDER BY name");
    echo "\nActive Agents (" . count($agents) . "):\n";
    foreach ($agents as $agent) {
        echo "- {$agent['name']} (ID: {$agent['id']})\n";
    }
    
    $types = [];
    $types[] = ['value' => 'admin_rajesh', 'label' => 'Admin Rajesh'];
    foreach ($agents as $agent) {
        $types[] = ['value' => 'agent_' . $agent['id'], 'label' => 'Agent: ' . $agent['name']];
    }
    
    echo "\nJSON Response for business types:\n";
    echo json_encode(['success' => true, 'types' => $types]) . "\n";
    
    echo "\nDatabase connection: SUCCESS ✅\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>
