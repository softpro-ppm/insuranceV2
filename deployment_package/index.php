<?php
/**
 * Insurance Management System v2.0
 * Main Entry Point
 */

session_start();

// Load environment variables
if (file_exists(__DIR__ . '/.env')) {
    $env = file_get_contents(__DIR__ . '/.env');
    $lines = explode("\n", $env);
    foreach ($lines as $line) {
        $line = trim($line);
        if (!empty($line) && strpos($line, '#') !== 0 && strpos($line, '=') !== false) {
            list($key, $value) = explode('=', $line, 2);
            $_ENV[trim($key)] = trim($value);
        }
    }
}

// Error reporting for development
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include configuration and database
$config = require_once __DIR__ . '/config/app.php';
require_once __DIR__ . '/app/Database.php';

// Simple Router Class
class Router {
    private $routes = [];
    
    public function get($path, $callback) {
        $this->routes['GET'][$path] = $callback;
    }
    
    public function post($path, $callback) {
        $this->routes['POST'][$path] = $callback;
    }
    
    public function resolve() {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        
        // Remove trailing slash except for root
        if ($path !== '/' && substr($path, -1) === '/') {
            $path = rtrim($path, '/');
        }
        
        // Check for exact match
        if (isset($this->routes[$method][$path])) {
            return call_user_func($this->routes[$method][$path]);
        }
        
        // Check for parameterized routes
        foreach ($this->routes[$method] ?? [] as $route => $callback) {
            $pattern = preg_replace('/\{[^}]+\}/', '([^/]+)', $route);
            $pattern = '#^' . $pattern . '$#';
            
            if (preg_match($pattern, $path, $matches)) {
                array_shift($matches);
                return call_user_func_array($callback, $matches);
            }
        }
        
        // 404 Not Found
        http_response_code(404);
        echo "<h1>404 - Page Not Found</h1>";
    }
}

// Authentication middleware
function requireAuth() {
    if (!isset($_SESSION['user_id'])) {
        header('Location: /login');
        exit;
    }
}

// View helper function
function view($template, $data = []) {
    extract($data);
    
    ob_start();
    include __DIR__ . "/resources/views/{$template}.php";
    $content = ob_get_clean();
    
    // If it's not a layout file, wrap it in the main layout
    if (strpos($template, 'layouts/') !== 0 && strpos($template, 'auth/') !== 0) {
        $data['content'] = $content;
        extract($data);
        include __DIR__ . '/resources/views/layouts/app.php';
    } else {
        echo $content;
    }
}

// Initialize router
$router = new Router();

// Public routes
$router->get('/', function() {
    header('Location: /login');
});

$router->get('/login', function() {
    if (isset($_SESSION['user_id'])) {
        header('Location: /dashboard');
        exit;
    }
    view('auth/login');
});

$router->post('/login', function() {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if (empty($username) || empty($password)) {
        $_SESSION['error'] = 'Please enter both username and password';
        header('Location: /login');
        exit;
    }
    
    $db = Database::getInstance();
    $user = $db->fetch(
        "SELECT * FROM users WHERE username = ? AND status = 'active'", 
        [$username]
    );
    
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_role'] = $user['role'];
        $_SESSION['success'] = 'Welcome back, ' . $user['name'] . '!';
        header('Location: /dashboard');
    } else {
        $_SESSION['error'] = 'Invalid username or password';
        header('Location: /login');
    }
    exit;
});

$router->get('/logout', function() {
    session_destroy();
    header('Location: /login');
    exit;
});

// Protected routes
$router->get('/dashboard', function() {
    requireAuth();
    
    $db = Database::getInstance();
    
    // Current date and financial year calculations
    $current_date = date('Y-m-d');
    $current_month_start = date('Y-m-01');
    $current_month_end = date('Y-m-t');
    
    // Financial Year (April to March)
    $current_year = date('Y');
    $current_month = date('m');
    if ($current_month >= 4) {
        $fy_start = $current_year . '-04-01';
        $fy_end = ($current_year + 1) . '-03-31';
        $fy_label = 'FY ' . $current_year . '-' . ($current_year + 1);
    } else {
        $fy_start = ($current_year - 1) . '-04-01';
        $fy_end = $current_year . '-03-31';
        $fy_label = 'FY ' . ($current_year - 1) . '-' . $current_year;
    }
    
    // A. Dashboard Cards Statistics
    $stats = [];
    
    // 1. Total Premium FY & Current Month
    $premium_fy = $db->fetch("SELECT COALESCE(SUM(premium_amount), 0) as total FROM policies WHERE policy_start_date BETWEEN ? AND ? AND status = 'active'", [$fy_start, $fy_end])['total'] ?? 0;
    $premium_current_month = $db->fetch("SELECT COALESCE(SUM(premium_amount), 0) as total FROM policies WHERE policy_start_date BETWEEN ? AND ? AND status = 'active'", [$current_month_start, $current_month_end])['total'] ?? 0;
    
    // 2. Revenue FY & Current Month (using commission_amount)
    $revenue_fy = $db->fetch("SELECT COALESCE(SUM(commission_amount), 0) as total FROM policies WHERE policy_start_date BETWEEN ? AND ? AND status = 'active'", [$fy_start, $fy_end])['total'] ?? 0;
    $revenue_current_month = $db->fetch("SELECT COALESCE(SUM(commission_amount), 0) as total FROM policies WHERE policy_start_date BETWEEN ? AND ? AND status = 'active'", [$current_month_start, $current_month_end])['total'] ?? 0;
    
    // 3. Total Policies Current Month & Renewed Current Month
    $policies_current_month = $db->fetch("SELECT COUNT(*) as count FROM policies WHERE policy_start_date BETWEEN ? AND ?", [$current_month_start, $current_month_end])['count'] ?? 0;
    $renewed_current_month = $db->fetch("SELECT COUNT(*) as count FROM policy_renewals WHERE renewal_date BETWEEN ? AND ?", [$current_month_start, $current_month_end])['count'] ?? 0;
    
    // 4. Pending Renewal, Expired & Expiring Soon
    $pending_renewal = $db->fetch("SELECT COUNT(*) as count FROM policies WHERE policy_end_date BETWEEN ? AND ? AND status = 'active'", [$current_month_start, $current_month_end])['count'] ?? 0;
    $expired_policies = $db->fetch("SELECT COUNT(*) as count FROM policies WHERE policy_end_date < ? AND status = 'active'", [$current_date])['count'] ?? 0;
    $expiring_soon = $db->fetch("SELECT COUNT(*) as count FROM policies WHERE policy_end_date BETWEEN ? AND DATE_ADD(?, INTERVAL 30 DAY) AND status = 'active'", [$current_date, $current_date])['count'] ?? 0;
    
    $stats = [
        'premium_fy' => $premium_fy,
        'premium_current_month' => $premium_current_month,
        'revenue_fy' => $revenue_fy,
        'revenue_current_month' => $revenue_current_month,
        'policies_current_month' => $policies_current_month,
        'renewed_current_month' => $renewed_current_month,
        'pending_renewal' => $pending_renewal,
        'expired_policies' => $expired_policies,
        'expiring_soon' => $expiring_soon,
        'fy_label' => $fy_label
    ];
    
    // B. Chart Data - Last 12 Months
    $chart_data = [];
    for ($i = 11; $i >= 0; $i--) {
        $month_start = date('Y-m-01', strtotime("-$i months"));
        $month_end = date('Y-m-t', strtotime("-$i months"));
        $month_label = date('M Y', strtotime("-$i months"));
        
        $month_policies = $db->fetch("SELECT COUNT(*) as count FROM policies WHERE policy_start_date BETWEEN ? AND ?", [$month_start, $month_end])['count'] ?? 0;
        $month_premium = $db->fetch("SELECT COALESCE(SUM(premium_amount), 0) as total FROM policies WHERE policy_start_date BETWEEN ? AND ? AND status = 'active'", [$month_start, $month_end])['total'] ?? 0;
        $month_revenue = $db->fetch("SELECT COALESCE(SUM(commission_amount), 0) as total FROM policies WHERE policy_start_date BETWEEN ? AND ? AND status = 'active'", [$month_start, $month_end])['total'] ?? 0;
        
        $chart_data[] = [
            'month' => $month_label,
            'policies' => $month_policies,
            'premium' => $month_premium,
            'revenue' => $month_revenue
        ];
    }
    
    // C. Pending Renewal Policies for Current Month
    $pending_renewal_policies = $db->fetchAll("
        SELECT p.*, c.name as customer_name, c.phone as customer_phone, 
               ic.name as company_name, pt.name as policy_type_name,
               DATEDIFF(p.policy_end_date, CURDATE()) as days_to_expire
        FROM policies p 
        LEFT JOIN customers c ON p.customer_id = c.id 
        LEFT JOIN insurance_companies ic ON p.insurance_company_id = ic.id 
        LEFT JOIN policy_types pt ON p.policy_type_id = pt.id
        WHERE p.policy_end_date BETWEEN ? AND ? 
        AND p.status = 'active'
        ORDER BY p.policy_end_date ASC
        LIMIT 20
    ", [$current_month_start, $current_month_end]);
    
    view('dashboard', [
        'title' => 'Dashboard - Insurance Management System',
        'current_page' => 'dashboard',
        'breadcrumbs' => [
            ['title' => 'Dashboard', 'url' => '/dashboard']
        ],
        'stats' => $stats,
        'chart_data' => $chart_data,
        'pending_renewal_policies' => $pending_renewal_policies
    ]);
});

$router->get('/policies', function() {
    requireAuth();
    
    $db = Database::getInstance();
    $policies = $db->fetchAll("
        SELECT p.*, c.name as customer_name, c.phone as customer_phone, 
               ic.name as company_name, pt.name as policy_type_name
        FROM policies p 
        LEFT JOIN customers c ON p.customer_id = c.id 
        LEFT JOIN insurance_companies ic ON p.insurance_company_id = ic.id 
        LEFT JOIN policy_types pt ON p.policy_type_id = pt.id
        ORDER BY p.created_at DESC
    ");
    
    view('policies/index', [
        'title' => 'All Policies - Insurance Management System',
        'current_page' => 'policies',
        'breadcrumbs' => [
            ['title' => 'Dashboard', 'url' => '/dashboard'],
            ['title' => 'Policies', 'url' => '/policies']
        ],
        'policies' => $policies
    ]);
});

// API endpoint for chart data
$router->get('/api/chart-data', function() {
    requireAuth();
    
    $db = Database::getInstance();
    $period = $_GET['period'] ?? '12months';
    
    $chart_data = [];
    
    if ($period === '12months') {
        // Last 12 months data
        for ($i = 11; $i >= 0; $i--) {
            $month_start = date('Y-m-01', strtotime("-$i months"));
            $month_end = date('Y-m-t', strtotime("-$i months"));
            $month_label = date('M Y', strtotime("-$i months"));
            
            $month_policies = $db->fetch("SELECT COUNT(*) as count FROM policies WHERE policy_start_date BETWEEN ? AND ?", [$month_start, $month_end])['count'] ?? 0;
            $month_premium = $db->fetch("SELECT COALESCE(SUM(premium_amount), 0) as total FROM policies WHERE policy_start_date BETWEEN ? AND ? AND status = 'active'", [$month_start, $month_end])['total'] ?? 0;
            $month_revenue = $db->fetch("SELECT COALESCE(SUM(commission_amount), 0) as total FROM policies WHERE policy_start_date BETWEEN ? AND ? AND status = 'active'", [$month_start, $month_end])['total'] ?? 0;
            
            $chart_data[] = [
                'month' => $month_label,
                'policies' => $month_policies,
                'premium' => $month_premium,
                'revenue' => $month_revenue
            ];
        }
    } else {
        // Financial Year data
        $fy_year = explode('-', str_replace('fy', '', $period));
        $fy_start = $fy_year[0] . '-04-01';
        $fy_end = $fy_year[1] . '-03-31';
        
        // Generate 12 months of FY data
        for ($i = 0; $i < 12; $i++) {
            $month_start = date('Y-m-01', strtotime($fy_start . " +$i months"));
            $month_end = date('Y-m-t', strtotime($fy_start . " +$i months"));
            $month_label = date('M Y', strtotime($fy_start . " +$i months"));
            
            // Stop if we've reached the end of FY
            if ($month_start > $fy_end) break;
            
            $month_policies = $db->fetch("SELECT COUNT(*) as count FROM policies WHERE policy_start_date BETWEEN ? AND ?", [$month_start, $month_end])['count'] ?? 0;
            $month_premium = $db->fetch("SELECT COALESCE(SUM(premium_amount), 0) as total FROM policies WHERE policy_start_date BETWEEN ? AND ? AND status = 'active'", [$month_start, $month_end])['total'] ?? 0;
            $month_revenue = $db->fetch("SELECT COALESCE(SUM(commission_amount), 0) as total FROM policies WHERE policy_start_date BETWEEN ? AND ? AND status = 'active'", [$month_start, $month_end])['total'] ?? 0;
            
            $chart_data[] = [
                'month' => $month_label,
                'policies' => $month_policies,
                'premium' => $month_premium,
                'revenue' => $month_revenue
            ];
        }
    }
    
    header('Content-Type: application/json');
    echo json_encode($chart_data);
    exit;
});

$router->get('/policies/create', function() {
    requireAuth();
    
    $db = Database::getInstance();
    $insurance_companies = $db->fetchAll("SELECT * FROM insurance_companies WHERE status = 'active' ORDER BY name");
    $policy_types = $db->fetchAll("SELECT * FROM policy_types WHERE status = 'active' ORDER BY category, name");
    
    view('policies/create', [
        'title' => 'Add New Policy - Insurance Management System',
        'current_page' => 'add-policy',
        'breadcrumbs' => [
            ['title' => 'Dashboard', 'url' => '/dashboard'],
            ['title' => 'Policies', 'url' => '/policies'],
            ['title' => 'Add Policy', 'url' => '/policies/create']
        ],
        'insurance_companies' => $insurance_companies,
        'policy_types' => $policy_types
    ]);
});

$router->post('/policies/store', function() {
    requireAuth();
    
    try {
        $db = Database::getInstance();
        
        // Handle customer creation or selection
        $customer_id = $_POST['customer_id'] ?? '';
        $customer_option = $_POST['customer_option'] ?? 'new';
        
        if ($customer_option === 'new' || empty($customer_id)) {
            // Create new customer
            $customer_name = $_POST['customer_name'] ?? '';
            $customer_phone = $_POST['customer_phone'] ?? '';
            $customer_email = $_POST['customer_email'] ?? '';
            $customer_dob = $_POST['customer_dob'] ?? '';
            $customer_address = $_POST['customer_address'] ?? '';
            
            if (empty($customer_name) || empty($customer_phone)) {
                $_SESSION['error'] = 'Customer name and phone are required';
                header('Location: /policies/create');
                exit;
            }
            
            // Generate customer code
            $customer_code = 'CUST' . date('Y') . sprintf('%04d', rand(1, 9999));
            
            // Insert new customer
            $customer_data = [
                'customer_code' => $customer_code,
                'name' => $customer_name,
                'phone' => $customer_phone,
                'email' => $customer_email,
                'date_of_birth' => $customer_dob ?: null,
                'address' => $customer_address,
                'created_by' => $_SESSION['user_id']
            ];
            
            $customer_columns = implode(', ', array_keys($customer_data));
            $customer_placeholders = ':' . implode(', :', array_keys($customer_data));
            $customer_sql = "INSERT INTO customers ($customer_columns) VALUES ($customer_placeholders)";
            
            $stmt = $db->getConnection()->prepare($customer_sql);
            $stmt->execute($customer_data);
            
            $customer_id = $db->getConnection()->lastInsertId();
        }
        
        // Get form data
        $category = $_POST['category'] ?? '';
        $insurance_company_id = $_POST['insurance_company_id'] ?? '';
        $policy_type_id = $_POST['policy_type_id'] ?? '';
        $policy_start_date = $_POST['policy_start_date'] ?? '';
        $policy_end_date = $_POST['policy_end_date'] ?? '';
        $premium_amount = $_POST['premium_amount'] ?? 0;
        $sum_insured = $_POST['sum_insured'] ?? 0;
        
        // Generate policy number
        $policy_number = 'POL' . date('Y') . sprintf('%06d', rand(1, 999999));
        
        // Prepare base data
        $data = [
            'policy_number' => $policy_number,
            'customer_id' => $customer_id,
            'insurance_company_id' => $insurance_company_id,
            'policy_type_id' => $policy_type_id,
            'category' => $category,
            'policy_start_date' => $policy_start_date,
            'policy_end_date' => $policy_end_date,
            'premium_amount' => $premium_amount,
            'sum_insured' => $sum_insured,
            'agent_id' => $_SESSION['user_id']
        ];
        
        // Add category-specific fields
        if ($category === 'motor') {
            $data['vehicle_number'] = $_POST['vehicle_number'] ?? '';
            $data['vehicle_type'] = $_POST['vehicle_type'] ?? '';
            $data['vehicle_make'] = $_POST['vehicle_make'] ?? '';
            $data['vehicle_model'] = $_POST['vehicle_model'] ?? '';
            $data['vehicle_year'] = $_POST['vehicle_year'] ?? '';
            $data['engine_number'] = $_POST['engine_number'] ?? '';
            $data['chassis_number'] = $_POST['chassis_number'] ?? '';
            $data['fuel_type'] = $_POST['fuel_type'] ?? '';
        } elseif ($category === 'health') {
            $data['plan_name'] = $_POST['plan_name'] ?? '';
            $data['coverage_type'] = $_POST['coverage_type'] ?? '';
            $data['room_rent_limit'] = $_POST['room_rent_limit'] ?? 0;
            $data['pre_existing_diseases'] = $_POST['pre_existing_diseases'] ?? '';
        } elseif ($category === 'life') {
            $data['policy_term'] = $_POST['policy_term'] ?? 0;
            $data['premium_payment_term'] = $_POST['premium_payment_term'] ?? 0;
            $data['maturity_amount'] = $_POST['maturity_amount'] ?? 0;
            $data['death_benefit'] = $_POST['death_benefit'] ?? 0;
        }
        
        // Calculate commission
        $commission_percentage = $_POST['commission_percentage'] ?? 10;
        $data['commission_percentage'] = $commission_percentage;
        $data['commission_amount'] = ($premium_amount * $commission_percentage) / 100;
        
        // Build query
        $columns = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));
        $sql = "INSERT INTO policies ($columns) VALUES ($placeholders)";
        
        $stmt = $db->prepare($sql);
        $result = $stmt->execute($data);
        
        if ($result) {
            $_SESSION['success'] = 'Policy ' . $policy_number . ' created successfully!';
            header('Location: /policies');
            exit;
        } else {
            $_SESSION['error'] = 'Failed to create policy';
            header('Location: /policies/create');
            exit;
        }
    } catch (Exception $e) {
        $_SESSION['error'] = 'Error: ' . $e->getMessage();
        header('Location: /policies/create');
        exit;
    }
});

$router->get('/customers', function() {
    requireAuth();
    
    $db = Database::getInstance();
    
    // Get search and filter parameters
    $search = $_GET['search'] ?? '';
    $status = $_GET['status'] ?? '';
    $page = max(1, (int)($_GET['page'] ?? 1));
    $limit = 20;
    $offset = ($page - 1) * $limit;
    
    // Build query with filters
    $where = "WHERE 1=1";
    $params = [];
    
    if (!empty($search)) {
        $where .= " AND (c.name LIKE ? OR c.phone LIKE ? OR c.email LIKE ? OR c.customer_code LIKE ?)";
        $searchTerm = '%' . $search . '%';
        $params = array_merge($params, [$searchTerm, $searchTerm, $searchTerm, $searchTerm]);
    }
    
    // Get customers with policy count
    $customers = $db->fetchAll("
        SELECT c.*, 
               COUNT(p.id) as policy_count,
               u.name as created_by_name
        FROM customers c 
        LEFT JOIN policies p ON c.id = p.customer_id 
        LEFT JOIN users u ON c.created_by = u.id
        $where
        GROUP BY c.id 
        ORDER BY c.created_at DESC 
        LIMIT $limit OFFSET $offset
    ", $params);
    
    // Get total count for pagination
    $totalCount = $db->fetch("SELECT COUNT(*) as count FROM customers c $where", $params)['count'];
    $totalPages = ceil($totalCount / $limit);
    
    view('customers/index', [
        'title' => 'Customers - Insurance Management System',
        'current_page' => 'customers',
        'breadcrumbs' => [
            ['title' => 'Dashboard', 'url' => '/dashboard'],
            ['title' => 'Customers', 'url' => '/customers']
        ],
        'customers' => $customers,
        'search' => $search,
        'currentPage' => $page,
        'totalPages' => $totalPages,
        'totalCount' => $totalCount
    ]);
});

$router->get('/customers/create', function() {
    requireAuth();
    
    view('customers/create', [
        'title' => 'Add New Customer - Insurance Management System',
        'current_page' => 'customers',
        'breadcrumbs' => [
            ['title' => 'Dashboard', 'url' => '/dashboard'],
            ['title' => 'Customers', 'url' => '/customers'],
            ['title' => 'Add Customer', 'url' => '/customers/create']
        ]
    ]);
});

$router->post('/customers/store', function() {
    requireAuth();
    
    try {
        $db = Database::getInstance();
        
        // Validate required fields
        $required = ['name', 'phone'];
        foreach ($required as $field) {
            if (empty($_POST[$field])) {
                $_SESSION['error'] = 'Please fill in all required fields';
                header('Location: /customers/create');
                exit;
            }
        }
        
        // Generate customer code
        $customer_code = 'CUST' . date('Y') . sprintf('%05d', rand(1, 99999));
        
        // Check if customer code already exists
        while ($db->fetch("SELECT id FROM customers WHERE customer_code = ?", [$customer_code])) {
            $customer_code = 'CUST' . date('Y') . sprintf('%05d', rand(1, 99999));
        }
        
        $data = [
            'customer_code' => $customer_code,
            'name' => $_POST['name'],
            'email' => $_POST['email'] ?? null,
            'phone' => $_POST['phone'],
            'alternate_phone' => $_POST['alternate_phone'] ?? null,
            'date_of_birth' => $_POST['date_of_birth'] ?? null,
            'gender' => $_POST['gender'] ?? null,
            'address' => $_POST['address'] ?? null,
            'city' => $_POST['city'] ?? null,
            'state' => $_POST['state'] ?? null,
            'pincode' => $_POST['pincode'] ?? null,
            'aadhar_number' => $_POST['aadhar_number'] ?? null,
            'pan_number' => $_POST['pan_number'] ?? null,
            'created_by' => $_SESSION['user_id']
        ];
        
        $columns = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));
        $sql = "INSERT INTO customers ($columns) VALUES ($placeholders)";
        
        $stmt = $db->prepare($sql);
        $result = $stmt->execute($data);
        
        if ($result) {
            $_SESSION['success'] = 'Customer ' . $customer_code . ' created successfully!';
            header('Location: /customers');
        } else {
            $_SESSION['error'] = 'Failed to create customer';
            header('Location: /customers/create');
        }
    } catch (Exception $e) {
        $_SESSION['error'] = 'Error: ' . $e->getMessage();
        header('Location: /customers/create');
    }
    exit;
});

$router->get('/customers/{id}', function($id) {
    requireAuth();
    
    $db = Database::getInstance();
    
    // Get customer details
    $customer = $db->fetch("
        SELECT c.*, u.name as created_by_name 
        FROM customers c 
        LEFT JOIN users u ON c.created_by = u.id 
        WHERE c.id = ?
    ", [$id]);
    
    if (!$customer) {
        $_SESSION['error'] = 'Customer not found';
        header('Location: /customers');
        exit;
    }
    
    // Get customer's policies
    $policies = $db->fetchAll("
        SELECT p.*, ic.name as company_name, pt.name as policy_type_name
        FROM policies p 
        LEFT JOIN insurance_companies ic ON p.insurance_company_id = ic.id 
        LEFT JOIN policy_types pt ON p.policy_type_id = pt.id
        WHERE p.customer_id = ? 
        ORDER BY p.created_at DESC
    ", [$id]);
    
    view('customers/show', [
        'title' => $customer['name'] . ' - Customer Details',
        'current_page' => 'customers',
        'breadcrumbs' => [
            ['title' => 'Dashboard', 'url' => '/dashboard'],
            ['title' => 'Customers', 'url' => '/customers'],
            ['title' => $customer['name'], 'url' => '/customers/' . $id]
        ],
        'customer' => $customer,
        'policies' => $policies
    ]);
});

$router->get('/customers/{id}/edit', function($id) {
    requireAuth();
    
    $db = Database::getInstance();
    $customer = $db->fetch("SELECT * FROM customers WHERE id = ?", [$id]);
    
    if (!$customer) {
        $_SESSION['error'] = 'Customer not found';
        header('Location: /customers');
        exit;
    }
    
    view('customers/edit', [
        'title' => 'Edit ' . $customer['name'] . ' - Customer Management',
        'current_page' => 'customers',
        'breadcrumbs' => [
            ['title' => 'Dashboard', 'url' => '/dashboard'],
            ['title' => 'Customers', 'url' => '/customers'],
            ['title' => $customer['name'], 'url' => '/customers/' . $id],
            ['title' => 'Edit', 'url' => '/customers/' . $id . '/edit']
        ],
        'customer' => $customer
    ]);
});

$router->post('/customers/{id}/update', function($id) {
    requireAuth();
    
    try {
        $db = Database::getInstance();
        
        // Check if customer exists
        $customer = $db->fetch("SELECT * FROM customers WHERE id = ?", [$id]);
        if (!$customer) {
            $_SESSION['error'] = 'Customer not found';
            header('Location: /customers');
            exit;
        }
        
        // Validate required fields
        $required = ['name', 'phone'];
        foreach ($required as $field) {
            if (empty($_POST[$field])) {
                $_SESSION['error'] = 'Please fill in all required fields';
                header('Location: /customers/' . $id . '/edit');
                exit;
            }
        }
        
        $data = [
            'name' => $_POST['name'],
            'email' => $_POST['email'] ?? null,
            'phone' => $_POST['phone'],
            'alternate_phone' => $_POST['alternate_phone'] ?? null,
            'date_of_birth' => $_POST['date_of_birth'] ?? null,
            'gender' => $_POST['gender'] ?? null,
            'address' => $_POST['address'] ?? null,
            'city' => $_POST['city'] ?? null,
            'state' => $_POST['state'] ?? null,
            'pincode' => $_POST['pincode'] ?? null,
            'aadhar_number' => $_POST['aadhar_number'] ?? null,
            'pan_number' => $_POST['pan_number'] ?? null,
        ];
        
        $setParts = [];
        foreach ($data as $key => $value) {
            $setParts[] = "$key = :$key";
        }
        $setClause = implode(', ', $setParts);
        
        $sql = "UPDATE customers SET $setClause WHERE id = :id";
        $data['id'] = $id;
        
        $stmt = $db->prepare($sql);
        $result = $stmt->execute($data);
        
        if ($result) {
            $_SESSION['success'] = 'Customer updated successfully!';
            header('Location: /customers/' . $id);
        } else {
            $_SESSION['error'] = 'Failed to update customer';
            header('Location: /customers/' . $id . '/edit');
        }
    } catch (Exception $e) {
        $_SESSION['error'] = 'Error: ' . $e->getMessage();
        header('Location: /customers/' . $id . '/edit');
    }
    exit;
});

$router->post('/customers/{id}/delete', function($id) {
    requireAuth();
    
    try {
        $db = Database::getInstance();
        
        // Check if customer has policies
        $policyCount = $db->fetch("SELECT COUNT(*) as count FROM policies WHERE customer_id = ?", [$id])['count'];
        
        if ($policyCount > 0) {
            $_SESSION['error'] = 'Cannot delete customer. Customer has ' . $policyCount . ' active policies.';
            header('Location: /customers/' . $id);
            exit;
        }
        
        $result = $db->execute("DELETE FROM customers WHERE id = ?", [$id]);
        
        if ($result) {
            $_SESSION['success'] = 'Customer deleted successfully!';
        } else {
            $_SESSION['error'] = 'Failed to delete customer';
        }
    } catch (Exception $e) {
        $_SESSION['error'] = 'Error: ' . $e->getMessage();
    }
    
    header('Location: /customers');
    exit;
});

// API endpoints for AJAX requests
$router->get('/api/customers', function() {
    requireAuth();
    header('Content-Type: application/json');
    
    try {
        $db = Database::getInstance();
        $customers = $db->fetchAll("SELECT id, customer_code, name, phone FROM customers ORDER BY name");
        echo json_encode($customers);
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
    }
    exit;
});

$router->get('/agent-login', function() {
    session_start();
    
    // Redirect if already logged in
    if (isset($_SESSION['user_id']) && $_SESSION['role'] === 'agent') {
        header('Location: /agent/dashboard');
        exit;
    }
    
    require_once __DIR__ . '/include/config.php';
    
    $error = '';
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $phone = $_POST['phone'] ?? '';
        $password = $_POST['password'] ?? '';
        
        if (empty($phone) || empty($password)) {
            $error = 'Phone number and password are required';
        } else {
            // Check agent credentials
            $stmt = $conn->prepare("SELECT id, name, email, password, status FROM users WHERE phone = ? AND role = 'agent'");
            $stmt->bind_param("s", $phone);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($user = $result->fetch_assoc()) {
                if ($user['status'] !== 'active') {
                    $error = 'Your account is inactive. Please contact administrator.';
                } elseif (password_verify($password, $user['password'])) {
                    // Login successful
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['name'] = $user['name'];
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['role'] = 'agent';
                    
                    header('Location: /agent/dashboard');
                    exit;
                } else {
                    $error = 'Invalid phone number or password';
                }
            } else {
                $error = 'Invalid phone number or password';
            }
        }
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Agent Login - Insurance Management System</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
        <style>
            body {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            }
            
            .login-container {
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(10px);
                border-radius: 20px;
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
                overflow: hidden;
                width: 100%;
                max-width: 400px;
            }
            
            .login-header {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
                padding: 2rem;
                text-align: center;
            }
            
            .login-body {
                padding: 2rem;
            }
            
            .form-control {
                border-radius: 10px;
                border: 1px solid #e1e5e9;
                padding: 0.75rem 1rem;
            }
            
            .form-control:focus {
                box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
                border-color: #667eea;
            }
            
            .btn-primary {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                border: none;
                border-radius: 10px;
                padding: 0.75rem 2rem;
                font-weight: 600;
                transition: all 0.3s ease;
            }
            
            .btn-primary:hover {
                transform: translateY(-2px);
                box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
            }
            
            .input-group-text {
                background: transparent;
                border-right: none;
                color: #667eea;
            }
            
            .form-control {
                border-left: none;
            }
            
            .alert {
                border-radius: 10px;
            }
            
            .company-logo {
                width: 60px;
                height: 60px;
                background: white;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto 1rem;
                font-size: 1.5rem;
                color: #667eea;
            }
        </style>
    </head>
    <body>
        <div class="login-container">
            <div class="login-header">
                <div class="company-logo">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h4 class="mb-0">Agent Portal</h4>
                <p class="mb-0 opacity-75">Insurance Management System</p>
            </div>
            
            <div class="login-body">
                <?php if ($error): ?>
                    <div class="alert alert-danger" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i><?= htmlspecialchars($error) ?>
                    </div>
                <?php endif; ?>
                
                <form method="POST">
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-phone"></i>
                            </span>
                            <input type="tel" class="form-control" id="phone" name="phone" 
                                   placeholder="Enter your phone number" 
                                   pattern="[0-9]{10}" maxlength="10" required 
                                   value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>">
                        </div>
                        <small class="text-muted">Use your registered phone number</small>
                    </div>
                    
                    <div class="mb-4">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </span>
                            <input type="password" class="form-control" id="password" name="password" 
                                   placeholder="Enter your password" required>
                        </div>
                        <small class="text-muted">Default password: Softpro@123</small>
                    </div>
                    
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-sign-in-alt me-2"></i>Login to Portal
                        </button>
                    </div>
                </form>
                
                <div class="text-center mt-4">
                    <small class="text-muted">
                        Need help? Contact administrator<br>
                        <a href="/" class="text-decoration-none">← Back to Main Site</a>
                    </small>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            // Format phone number input
            document.getElementById('phone').addEventListener('input', function(e) {
                this.value = this.value.replace(/[^0-9]/g, '');
            });
            
            // Auto-focus on phone input
            document.getElementById('phone').focus();
        </script>
    </body>
    </html>
    <?php
    exit;
});

$router->get('/agent/dashboard', function() {
    require_once __DIR__ . '/resources/views/agent/dashboard.php';
});

$router->get('/agent/logout', function() {
    session_start();
    session_destroy();
    header('Location: /agent-login');
    exit;
});

// File upload handler for customer documents
$router->post('/api/upload-customer-documents', function() {
    requireAuth();
    header('Content-Type: application/json');
    
    try {
        $customer_id = $_POST['customer_id'] ?? '';
        $uploaded_files = [];
        
        if (empty($customer_id)) {
            throw new Exception('Customer ID is required');
        }
        
        // Create upload directory if it doesn't exist
        $upload_dir = __DIR__ . '/uploads/customers/' . $customer_id;
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        
        // Document types mapping
        $document_types = [
            'aadhar_document' => 'aadhar',
            'pan_document' => 'pan',
            'passport_document' => 'passport',
            'driving_license_document' => 'driving_license',
            'other_document' => 'other'
        ];
        
        foreach ($document_types as $field_name => $doc_type) {
            if (isset($_FILES[$field_name]) && $_FILES[$field_name]['error'] === UPLOAD_ERR_OK) {
                $file = $_FILES[$field_name];
                
                // Validate file
                $allowed_types = ['application/pdf', 'image/jpeg', 'image/png', 'image/jpg'];
                if (!in_array($file['type'], $allowed_types)) {
                    throw new Exception("Invalid file type for $doc_type");
                }
                
                if ($file['size'] > 5 * 1024 * 1024) { // 5MB limit
                    throw new Exception("File too large for $doc_type");
                }
                
                // Generate unique filename
                $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
                $filename = $doc_type . '_' . time() . '_' . uniqid() . '.' . $extension;
                $filepath = $upload_dir . '/' . $filename;
                
                if (move_uploaded_file($file['tmp_name'], $filepath)) {
                    // Save to database
                    $db = Database::getInstance();
                    $db->execute(
                        "INSERT INTO customer_documents (customer_id, document_type, document_number, file_name, file_path, file_size, mime_type, uploaded_by) VALUES (?, ?, ?, ?, ?, ?, ?, ?)",
                        [$customer_id, $doc_type, '', $file['name'], $filepath, $file['size'], $file['type'], $_SESSION['user_id']]
                    );
                    
                    $uploaded_files[] = [
                        'type' => $doc_type,
                        'filename' => $filename,
                        'original_name' => $file['name']
                    ];
                }
            }
        }
        
        echo json_encode(['success' => true, 'uploaded_files' => $uploaded_files]);
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['error' => $e->getMessage()]);
    }
    exit;
});

// File upload handler for policy documents
$router->post('/api/upload-policy-documents', function() {
    requireAuth();
    header('Content-Type: application/json');
    
    try {
        $policy_id = $_POST['policy_id'] ?? '';
        $uploaded_files = [];
        
        if (empty($policy_id)) {
            throw new Exception('Policy ID is required');
        }
        
        // Create upload directory if it doesn't exist
        $upload_dir = __DIR__ . '/uploads/policies/' . $policy_id;
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        
        // Document types mapping
        $document_types = [
            'policy_document' => 'policy_document',
            'proposal_form' => 'proposal_form',
            'vehicle_rc' => 'vehicle_rc',
            'driving_license' => 'driving_license',
            'medical_report' => 'medical_report',
            'previous_policy' => 'previous_policy',
            'nominee_document' => 'nominee_document',
            'income_proof' => 'income_proof'
        ];
        
        foreach ($document_types as $field_name => $doc_type) {
            if (isset($_FILES[$field_name]) && $_FILES[$field_name]['error'] === UPLOAD_ERR_OK) {
                $file = $_FILES[$field_name];
                
                // Validate file
                $allowed_types = ['application/pdf', 'image/jpeg', 'image/png', 'image/jpg'];
                if (!in_array($file['type'], $allowed_types)) {
                    throw new Exception("Invalid file type for $doc_type");
                }
                
                if ($file['size'] > 10 * 1024 * 1024) { // 10MB limit
                    throw new Exception("File too large for $doc_type");
                }
                
                // Generate unique filename
                $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
                $filename = $doc_type . '_' . time() . '_' . uniqid() . '.' . $extension;
                $filepath = $upload_dir . '/' . $filename;
                
                if (move_uploaded_file($file['tmp_name'], $filepath)) {
                    // Save to database
                    $db = Database::getInstance();
                    $db->execute(
                        "INSERT INTO policy_documents (policy_id, document_type, document_name, file_name, file_path, file_size, mime_type, uploaded_by) VALUES (?, ?, ?, ?, ?, ?, ?, ?)",
                        [$policy_id, $doc_type, $doc_type, $file['name'], $filepath, $file['size'], $file['type'], $_SESSION['user_id']]
                    );
                    
                    $uploaded_files[] = [
                        'type' => $doc_type,
                        'filename' => $filename,
                        'original_name' => $file['name']
                    ];
                }
            }
        }
        
        // Handle multiple other documents
        if (isset($_FILES['other_documents'])) {
            foreach ($_FILES['other_documents']['name'] as $key => $name) {
                if ($_FILES['other_documents']['error'][$key] === UPLOAD_ERR_OK) {
                    $file = [
                        'name' => $_FILES['other_documents']['name'][$key],
                        'type' => $_FILES['other_documents']['type'][$key],
                        'tmp_name' => $_FILES['other_documents']['tmp_name'][$key],
                        'size' => $_FILES['other_documents']['size'][$key]
                    ];
                    
                    // Validate file
                    $allowed_types = ['application/pdf', 'image/jpeg', 'image/png', 'image/jpg', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
                    if (!in_array($file['type'], $allowed_types)) {
                        continue; // Skip invalid files
                    }
                    
                    if ($file['size'] > 10 * 1024 * 1024) {
                        continue; // Skip large files
                    }
                    
                    // Generate unique filename
                    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
                    $filename = 'other_' . time() . '_' . uniqid() . '.' . $extension;
                    $filepath = $upload_dir . '/' . $filename;
                    
                    if (move_uploaded_file($file['tmp_name'], $filepath)) {
                        // Save to database
                        $db = Database::getInstance();
                        $db->execute(
                            "INSERT INTO policy_documents (policy_id, document_type, document_name, file_name, file_path, file_size, mime_type, uploaded_by) VALUES (?, ?, ?, ?, ?, ?, ?, ?)",
                            [$policy_id, 'other', 'Other Document', $file['name'], $filepath, $file['size'], $file['type'], $_SESSION['user_id']]
                        );
                        
                        $uploaded_files[] = [
                            'type' => 'other',
                            'filename' => $filename,
                            'original_name' => $file['name']
                        ];
                    }
                }
            }
        }
        
        echo json_encode(['success' => true, 'uploaded_files' => $uploaded_files]);
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['error' => $e->getMessage()]);
    }
    exit;
});

$router->get('/api/debug/policy-types', function() {
    header('Content-Type: application/json');
    
    try {
        $db = Database::getInstance();
        
        // Check if table exists
        $tables = $db->fetchAll("SHOW TABLES LIKE 'policy_types'");
        $table_exists = !empty($tables);
        
        $debug_info = [
            'table_exists' => $table_exists,
            'category_param' => $_GET['category'] ?? 'not_provided',
            'total_records' => 0,
            'sample_data' => [],
            'error' => null
        ];
        
        if ($table_exists) {
            // Get total count
            $count_result = $db->fetchOne("SELECT COUNT(*) as count FROM policy_types");
            $debug_info['total_records'] = $count_result['count'];
            
            // Get sample data
            $debug_info['sample_data'] = $db->fetchAll("SELECT * FROM policy_types LIMIT 5");
            
            // Test category filter
            $category = $_GET['category'] ?? 'motor';
            $filtered_data = $db->fetchAll("SELECT * FROM policy_types WHERE category = ? AND status = 'active'", [$category]);
            $debug_info['filtered_count'] = count($filtered_data);
            $debug_info['filtered_data'] = $filtered_data;
        }
        
        echo json_encode($debug_info, JSON_PRETTY_PRINT);
    } catch (Exception $e) {
        echo json_encode([
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ], JSON_PRETTY_PRINT);
    }
    exit;
});

$router->get('/api/policy-types', function() {
    requireAuth();
    header('Content-Type: application/json');
    
    try {
        $category = $_GET['category'] ?? 'motor';
        $db = Database::getInstance();
        $policy_types = $db->fetchAll("SELECT id, name, code FROM policy_types WHERE category = ? AND status = 'active'", [$category]);
        echo json_encode($policy_types);
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode([
            'error' => 'Database error: ' . $e->getMessage(),
            'category' => $_GET['category'] ?? 'motor'
        ]);
    }
    exit;
});

$router->get('/api/insurance-companies', function() {
    requireAuth();
    header('Content-Type: application/json');
    
    try {
        $category = $_GET['category'] ?? 'motor';
        $column = 'supports_' . $category;
        $db = Database::getInstance();
        
        // Validate column name to prevent SQL injection
        $allowed_columns = ['supports_motor', 'supports_health', 'supports_life'];
        if (!in_array($column, $allowed_columns)) {
            throw new Exception("Invalid category: $category");
        }
        
        $companies = $db->fetchAll("SELECT id, name, code FROM insurance_companies WHERE $column = 1 AND status = 'active'");
        echo json_encode($companies);
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode([
            'error' => 'Database error: ' . $e->getMessage(),
            'category' => $_GET['category'] ?? 'motor'
        ]);
    }
    exit;
});

// Debug endpoint to check database status
$router->get('/api/db-status', function() {
    requireAuth();
    header('Content-Type: application/json');
    
    try {
        $db = Database::getInstance();
        $status = ['tables' => [], 'counts' => []];
        
        // Check if tables exist
        $tables = ['users', 'customers', 'policy_types', 'insurance_companies', 'policies'];
        foreach ($tables as $table) {
            try {
                $result = $db->fetch("SELECT COUNT(*) as count FROM $table");
                $status['tables'][$table] = 'exists';
                $status['counts'][$table] = $result['count'];
            } catch (Exception $e) {
                $status['tables'][$table] = 'missing or error: ' . $e->getMessage();
                $status['counts'][$table] = 0;
            }
        }
        
        echo json_encode($status);
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Database connection error: ' . $e->getMessage()]);
    }
    exit;
});

$router->get('/renewals', function() {
    requireAuth();
    
    $db = Database::getInstance();
    $renewals = $db->fetchAll("
        SELECT p.*, c.name as customer_name, c.phone as customer_phone, 
               ic.name as company_name
        FROM policies p 
        LEFT JOIN customers c ON p.customer_id = c.id 
        LEFT JOIN insurance_companies ic ON p.insurance_company_id = ic.id 
        WHERE p.policy_end_date BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 60 DAY)
        AND p.status = 'active'
        ORDER BY p.policy_end_date ASC
    ");
    
    view('renewals/index', [
        'title' => 'Policy Renewals - Insurance Management System',
        'current_page' => 'renewals',
        'breadcrumbs' => [
            ['title' => 'Dashboard', 'url' => '/dashboard'],
            ['title' => 'Renewals', 'url' => '/renewals']
        ],
        'renewals' => $renewals
    ]);
});

$router->get('/followups', function() {
    requireAuth();
    
    view('followups/index', [
        'title' => 'Follow-ups - Insurance Management System',
        'current_page' => 'followups',
        'breadcrumbs' => [
            ['title' => 'Dashboard', 'url' => '/dashboard'],
            ['title' => 'Follow-ups', 'url' => '/followups']
        ]
    ]);
});

$router->get('/reports', function() {
    requireAuth();
    
    view('reports/index', [
        'title' => 'Reports - Insurance Management System',
        'current_page' => 'reports',
        'breadcrumbs' => [
            ['title' => 'Dashboard', 'url' => '/dashboard'],
            ['title' => 'Reports', 'url' => '/reports']
        ]
    ]);
});

$router->get('/settings', function() {
    requireAuth();
    
    view('settings/index', [
        'title' => 'Settings - Insurance Management System',
        'current_page' => 'settings',
        'breadcrumbs' => [
            ['title' => 'Dashboard', 'url' => '/dashboard'],
            ['title' => 'Settings', 'url' => '/settings']
        ]
    ]);
});

// Resolve the route
$router->resolve();
?>
