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
    
    // Get statistics
    $stats = [
        'total_policies' => $db->fetch("SELECT COUNT(*) as count FROM policies WHERE status = 'active'")['count'] ?? 0,
        'total_customers' => $db->fetch("SELECT COUNT(*) as count FROM customers")['count'] ?? 0,
        'expiring_soon' => $db->fetch("SELECT COUNT(*) as count FROM policies WHERE policy_end_date BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 30 DAY) AND status = 'active'")['count'] ?? 0,
        'total_premium' => $db->fetch("SELECT SUM(premium_amount) as total FROM policies WHERE status = 'active'")['total'] ?? 0,
    ];
    
    // Recent policies
    $recent_policies = $db->fetchAll("
        SELECT p.*, c.name as customer_name, ic.name as company_name 
        FROM policies p 
        LEFT JOIN customers c ON p.customer_id = c.id 
        LEFT JOIN insurance_companies ic ON p.insurance_company_id = ic.id 
        ORDER BY p.created_at DESC 
        LIMIT 10
    ");
    
    view('dashboard', [
        'title' => 'Dashboard - Insurance Management System',
        'current_page' => 'dashboard',
        'breadcrumbs' => [
            ['title' => 'Dashboard', 'url' => '/dashboard']
        ],
        'stats' => $stats,
        'recent_policies' => $recent_policies
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
        
        // Get form data
        $category = $_POST['category'] ?? '';
        $customer_id = $_POST['customer_id'] ?? '';
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
    
    $db = Database::getInstance();
    $customers = $db->fetchAll("SELECT id, customer_code, name, phone FROM customers ORDER BY name");
    echo json_encode($customers);
    exit;
});

$router->get('/api/policy-types', function() {
    requireAuth();
    header('Content-Type: application/json');
    
    $category = $_GET['category'] ?? 'motor';
    $db = Database::getInstance();
    $policy_types = $db->fetchAll("SELECT id, name, code FROM policy_types WHERE category = ? AND status = 'active'", [$category]);
    echo json_encode($policy_types);
    exit;
});

$router->get('/api/insurance-companies', function() {
    requireAuth();
    header('Content-Type: application/json');
    
    $category = $_GET['category'] ?? 'motor';
    $column = 'supports_' . $category;
    $db = Database::getInstance();
    $companies = $db->fetchAll("SELECT id, name, code FROM insurance_companies WHERE $column = 1 AND status = 'active'");
    echo json_encode($companies);
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
