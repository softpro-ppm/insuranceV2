<?php
/**
 * Dummy Data Generator for Insurance Management System
 * Generates 700+ realistic insurance records
 */

set_time_limit(0); // Remove time limit for large data generation
ini_set('memory_limit', '512M');

echo "🏗️ Insurance Management System - Dummy Data Generator\n";
echo "=====================================================\n";
echo "🎯 Target: 700+ records across all tables\n\n";

require_once __DIR__ . '/config/app.php';
require_once __DIR__ . '/app/Database.php';

try {
    $db = Database::getInstance();
    $pdo = $db->getConnection();
    
    echo "📡 Connected to database: insurance_v2\n\n";
    
    // Indian Names Arrays
    $indian_first_names = [
        'Rajesh', 'Priya', 'Amit', 'Sunita', 'Vikram', 'Kavita', 'Suresh', 'Meera', 'Ravi', 'Anita',
        'Sanjay', 'Pooja', 'Arun', 'Deepika', 'Manoj', 'Neha', 'Vinod', 'Seema', 'Ashok', 'Rekha',
        'Ramesh', 'Geeta', 'Praveen', 'Shilpa', 'Yogesh', 'Nisha', 'Harish', 'Preeti', 'Kiran', 'Smita',
        'Dilip', 'Vandana', 'Nitin', 'Swati', 'Prakash', 'Manjula', 'Sachin', 'Archana', 'Gopal', 'Lata',
        'Mahesh', 'Usha', 'Santosh', 'Purnima', 'Rahul', 'Sushma', 'Ajay', 'Leela', 'Brijesh', 'Kalpana'
    ];
    
    $indian_last_names = [
        'Sharma', 'Patel', 'Kumar', 'Singh', 'Gupta', 'Joshi', 'Shah', 'Mehta', 'Agarwal', 'Verma',
        'Yadav', 'Tiwari', 'Mishra', 'Pandey', 'Shukla', 'Srivastava', 'Chandra', 'Jain', 'Bansal', 'Arora',
        'Kapoor', 'Malhotra', 'Chopra', 'Goel', 'Saxena', 'Agarwal', 'Garg', 'Bhatia', 'Sethi', 'Khanna',
        'Thakur', 'Reddy', 'Nair', 'Menon', 'Rao', 'Krishnan', 'Iyer', 'Pillai', 'Das', 'Ghosh'
    ];
    
    $indian_cities = [
        'Mumbai', 'Delhi', 'Bangalore', 'Hyderabad', 'Chennai', 'Kolkata', 'Pune', 'Ahmedabad', 'Surat', 'Jaipur',
        'Lucknow', 'Kanpur', 'Nagpur', 'Indore', 'Thane', 'Bhopal', 'Visakhapatnam', 'Pimpri', 'Patna', 'Vadodara',
        'Ghaziabad', 'Ludhiana', 'Agra', 'Nashik', 'Faridabad', 'Meerut', 'Rajkot', 'Kalyan', 'Vasai', 'Varanasi'
    ];
    
    $indian_states = [
        'Maharashtra', 'Gujarat', 'Karnataka', 'Tamil Nadu', 'Uttar Pradesh', 'Rajasthan', 'West Bengal',
        'Madhya Pradesh', 'Kerala', 'Punjab', 'Haryana', 'Bihar', 'Odisha', 'Jharkhand', 'Assam',
        'Telangana', 'Andhra Pradesh', 'Chhattisgarh', 'Uttarakhand', 'Himachal Pradesh'
    ];
    
    $vehicle_makes = ['Maruti', 'Hyundai', 'Tata', 'Mahindra', 'Honda', 'Toyota', 'Ford', 'Volkswagen', 'Skoda', 'Nissan'];
    $vehicle_models = ['Swift', 'i20', 'Nexon', 'XUV300', 'City', 'Innova', 'EcoSport', 'Polo', 'Rapid', 'Micra'];
    
    // Get existing insurance companies and policy types
    $companies = $db->fetchAll("SELECT id FROM insurance_companies");
    $policy_types = $db->fetchAll("SELECT id, category FROM policy_types");
    $motor_types = array_filter($policy_types, fn($p) => $p['category'] === 'motor');
    $health_types = array_filter($policy_types, fn($p) => $p['category'] === 'health');
    $life_types = array_filter($policy_types, fn($p) => $p['category'] === 'life');
    
    // Function to generate Indian phone number
    function generateIndianPhone() {
        $prefixes = ['98', '97', '96', '95', '94', '93', '92', '91', '90', '89', '88', '87', '86', '85'];
        return $prefixes[array_rand($prefixes)] . str_pad(rand(10000000, 99999999), 8, '0', STR_PAD_LEFT);
    }
    
    // Function to generate Aadhar number
    function generateAadhar() {
        return str_pad(rand(100000000000, 999999999999), 12, '0', STR_PAD_LEFT);
    }
    
    // Function to generate PAN number
    function generatePAN() {
        $letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        return substr(str_shuffle($letters), 0, 5) . str_pad(rand(1000, 9999), 4, '0', STR_PAD_LEFT) . substr(str_shuffle($letters), 0, 1);
    }
    
    // Function to generate vehicle number
    function generateVehicleNumber() {
        $states = ['MH', 'GJ', 'KA', 'TN', 'UP', 'RJ', 'WB', 'MP', 'KL', 'PB'];
        $state = $states[array_rand($states)];
        $district = str_pad(rand(1, 99), 2, '0', STR_PAD_LEFT);
        $series = chr(rand(65, 90)) . chr(rand(65, 90));
        $number = str_pad(rand(1000, 9999), 4, '0', STR_PAD_LEFT);
        return $state . $district . $series . $number;
    }
    
    echo "👥 Generating 200 customers...\n";
    
    // Generate 200 customers
    $customer_codes = [];
    for ($i = 1; $i <= 200; $i++) {
        $first_name = $indian_first_names[array_rand($indian_first_names)];
        $last_name = $indian_last_names[array_rand($indian_last_names)];
        $full_name = $first_name . ' ' . $last_name;
        $customer_code = 'CUST' . str_pad($i + 5, 4, '0', STR_PAD_LEFT); // Start from CUST0006
        $customer_codes[] = $customer_code;
        
        $email = strtolower($first_name) . '.' . strtolower($last_name) . rand(1, 999) . '@example.com';
        $phone = generateIndianPhone();
        $alt_phone = rand(0, 1) ? generateIndianPhone() : null;
        $dob = date('Y-m-d', strtotime('-' . rand(18, 65) . ' years -' . rand(0, 365) . ' days'));
        $gender = ['male', 'female'][array_rand(['male', 'female'])];
        $city = $indian_cities[array_rand($indian_cities)];
        $state = $indian_states[array_rand($indian_states)];
        $pincode = str_pad(rand(100000, 999999), 6, '0', STR_PAD_LEFT);
        $address = rand(1, 999) . ' ' . ['Main Street', 'Park Avenue', 'MG Road', 'Station Road', 'Mall Road'][array_rand(['Main Street', 'Park Avenue', 'MG Road', 'Station Road', 'Mall Road'])];
        $aadhar = generateAadhar();
        $pan = generatePAN();
        
        $stmt = $pdo->prepare("
            INSERT INTO customers (customer_code, name, email, phone, alternate_phone, date_of_birth, gender, address, city, state, pincode, aadhar_number, pan_number, created_by, created_at) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 1, NOW())
        ");
        $stmt->execute([$customer_code, $full_name, $email, $phone, $alt_phone, $dob, $gender, $address, $city, $state, $pincode, $aadhar, $pan]);
        
        if ($i % 50 == 0) echo "   ✅ Created $i customers\n";
    }
    
    echo "📄 Generating 500 policies...\n";
    
    // Get all customer IDs
    $customers = $db->fetchAll("SELECT id FROM customers");
    
    // Generate 500 policies
    for ($i = 1; $i <= 500; $i++) {
        $customer_id = $customers[array_rand($customers)]['id'];
        $company_id = $companies[array_rand($companies)]['id'];
        
        // Random policy category
        $categories = ['motor', 'health', 'life'];
        $category = $categories[array_rand($categories)];
        
        // Get policy type based on category
        if ($category === 'motor') {
            $policy_type_id = $motor_types[array_rand($motor_types)]['id'];
        } elseif ($category === 'health') {
            $policy_type_id = $health_types[array_rand($health_types)]['id'];
        } else {
            $policy_type_id = $life_types[array_rand($life_types)]['id'];
        }
        
        $policy_number = 'POL' . str_pad($i + 5, 6, '0', STR_PAD_LEFT);
        
        // Generate dates within current financial year
        $start_date = date('Y-m-d', strtotime('2025-04-01 +' . rand(0, 120) . ' days'));
        $end_date = date('Y-m-d', strtotime($start_date . ' +1 year'));
        
        // Generate premium based on category
        if ($category === 'motor') {
            $premium = rand(5000, 50000);
            $sum_insured = $premium * rand(5, 20);
        } elseif ($category === 'health') {
            $premium = rand(8000, 25000);
            $sum_insured = rand(200000, 1000000);
        } else { // life
            $premium = rand(15000, 100000);
            $sum_insured = rand(500000, 5000000);
        }
        
        $commission_pct = rand(8, 25);
        $commission_amount = ($premium * $commission_pct) / 100;
        $revenue = rand(100, 1000);
        
        // Motor specific fields
        $vehicle_number = null;
        $vehicle_type = null;
        $vehicle_make = null;
        $vehicle_model = null;
        $vehicle_year = null;
        $engine_number = null;
        $chassis_number = null;
        $fuel_type = null;
        
        if ($category === 'motor') {
            $vehicle_number = generateVehicleNumber();
            $vehicle_type = ['two_wheeler', 'car', 'commercial'][array_rand(['two_wheeler', 'car', 'commercial'])];
            $vehicle_make = $vehicle_makes[array_rand($vehicle_makes)];
            $vehicle_model = $vehicle_models[array_rand($vehicle_models)];
            $vehicle_year = rand(2015, 2024);
            $engine_number = 'ENG' . rand(100000, 999999);
            $chassis_number = 'CHS' . rand(100000, 999999);
            $fuel_type = ['petrol', 'diesel', 'cng'][array_rand(['petrol', 'diesel', 'cng'])];
        }
        
        // Health specific fields
        $plan_name = null;
        $coverage_type = null;
        $room_rent_limit = null;
        
        if ($category === 'health') {
            $plan_name = ['Basic Health', 'Premium Health', 'Family Care', 'Senior Citizen'][array_rand(['Basic Health', 'Premium Health', 'Family Care', 'Senior Citizen'])];
            $coverage_type = ['individual', 'family'][array_rand(['individual', 'family'])];
            $room_rent_limit = rand(1000, 5000);
        }
        
        // Life specific fields
        $policy_term = null;
        $premium_payment_term = null;
        $maturity_amount = null;
        $death_benefit = null;
        
        if ($category === 'life') {
            $policy_term = rand(10, 30);
            $premium_payment_term = rand(5, $policy_term);
            $maturity_amount = $sum_insured + rand(50000, 200000);
            $death_benefit = $sum_insured;
        }
        
        $stmt = $pdo->prepare("
            INSERT INTO policies (
                policy_number, customer_id, insurance_company_id, policy_type_id, category,
                policy_start_date, policy_end_date, premium_amount, sum_insured, revenue,
                vehicle_number, vehicle_type, vehicle_make, vehicle_model, vehicle_year,
                engine_number, chassis_number, fuel_type,
                plan_name, coverage_type, room_rent_limit,
                policy_term, premium_payment_term, maturity_amount, death_benefit,
                agent_id, commission_percentage, commission_amount, status, created_at
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 1, ?, ?, 'active', NOW())
        ");
        
        $stmt->execute([
            $policy_number, $customer_id, $company_id, $policy_type_id, $category,
            $start_date, $end_date, $premium, $sum_insured, $revenue,
            $vehicle_number, $vehicle_type, $vehicle_make, $vehicle_model, $vehicle_year,
            $engine_number, $chassis_number, $fuel_type,
            $plan_name, $coverage_type, $room_rent_limit,
            $policy_term, $premium_payment_term, $maturity_amount, $death_benefit,
            $commission_pct, $commission_amount
        ]);
        
        if ($i % 100 == 0) echo "   ✅ Created $i policies\n";
    }
    
    echo "👨‍💼 Creating 10 additional agents...\n";
    
    // Generate 10 agents
    for ($i = 1; $i <= 10; $i++) {
        $first_name = $indian_first_names[array_rand($indian_first_names)];
        $last_name = $indian_last_names[array_rand($indian_last_names)];
        $full_name = $first_name . ' ' . $last_name . ' (Agent)';
        $username = 'agent' . str_pad($i, 2, '0', STR_PAD_LEFT);
        $email = strtolower($first_name) . '.' . strtolower($last_name) . '.agent@softpromis.com';
        $phone = generateIndianPhone();
        $password = password_hash('agent123', PASSWORD_DEFAULT);
        
        $stmt = $pdo->prepare("
            INSERT INTO users (name, email, username, password, phone, role, status, created_at) 
            VALUES (?, ?, ?, ?, ?, 'agent', 'active', NOW())
        ");
        $stmt->execute([$full_name, $email, $username, $password, $phone]);
    }
    
    echo "📋 Creating follow-ups and renewals...\n";
    
    // Get policy IDs for renewals and follow-ups
    $policies = $db->fetchAll("SELECT id, customer_id FROM policies LIMIT 50");
    
    // Generate 30 follow-ups
    foreach (array_slice($policies, 0, 30) as $policy) {
        $types = ['renewal', 'claim', 'general', 'complaint'];
        $type = $types[array_rand($types)];
        $priority = ['low', 'medium', 'high'][array_rand(['low', 'medium', 'high'])];
        $status = ['pending', 'in_progress', 'completed'][array_rand(['pending', 'in_progress', 'completed'])];
        $subject = [
            'Policy Renewal Reminder',
            'Claim Settlement Inquiry', 
            'Policy Document Request',
            'Premium Payment Issue',
            'Coverage Details Clarification'
        ][array_rand(['Policy Renewal Reminder', 'Claim Settlement Inquiry', 'Policy Document Request', 'Premium Payment Issue', 'Coverage Details Clarification'])];
        
        $scheduled_date = date('Y-m-d', strtotime('+' . rand(1, 30) . ' days'));
        
        $stmt = $pdo->prepare("
            INSERT INTO customer_followups (customer_id, policy_id, followup_type, priority, status, subject, scheduled_date, assigned_to, created_by, created_at)
            VALUES (?, ?, ?, ?, ?, ?, ?, 1, 1, NOW())
        ");
        $stmt->execute([$policy['customer_id'], $policy['id'], $type, $priority, $status, $subject, $scheduled_date]);
    }
    
    // Generate 20 policy renewals
    foreach (array_slice($policies, 0, 20) as $policy) {
        $old_end_date = date('Y-m-d', strtotime('-1 year'));
        $new_end_date = date('Y-m-d', strtotime('+1 year'));
        $renewal_premium = rand(10000, 80000);
        $renewal_date = date('Y-m-d', strtotime('-' . rand(1, 60) . ' days'));
        
        $stmt = $pdo->prepare("
            INSERT INTO policy_renewals (policy_id, old_policy_end_date, new_policy_end_date, renewal_premium, renewal_date, processed_by, created_at)
            VALUES (?, ?, ?, ?, ?, 1, NOW())
        ");
        $stmt->execute([$policy['id'], $old_end_date, $new_end_date, $renewal_premium, $renewal_date]);
    }
    
    // Final count
    $total_customers = $db->fetch("SELECT COUNT(*) as count FROM customers")['count'];
    $total_policies = $db->fetch("SELECT COUNT(*) as count FROM policies")['count'];
    $total_users = $db->fetch("SELECT COUNT(*) as count FROM users")['count'];
    $total_followups = $db->fetch("SELECT COUNT(*) as count FROM customer_followups")['count'];
    $total_renewals = $db->fetch("SELECT COUNT(*) as count FROM policy_renewals")['count'];
    $total_premium = $db->fetch("SELECT SUM(premium_amount) as total FROM policies")['total'];
    
    echo "\n🎉 Dummy Data Generation Completed!\n";
    echo "=====================================\n";
    echo "📊 Final Statistics:\n";
    echo "   👥 Customers: {$total_customers}\n";
    echo "   📄 Policies: {$total_policies}\n";
    echo "   👨‍💼 Users: {$total_users}\n";
    echo "   📋 Follow-ups: {$total_followups}\n";
    echo "   🔄 Renewals: {$total_renewals}\n";
    echo "   💰 Total Premium: ₹" . number_format($total_premium) . "\n";
    echo "=====================================\n";
    echo "✅ Your insurance database is now loaded with realistic dummy data!\n";
    echo "🌐 Refresh your dashboard at http://localhost:8000/dashboard\n";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "📍 Line: " . $e->getLine() . "\n";
}
?>
