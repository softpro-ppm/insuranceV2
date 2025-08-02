<?php
// Debug test file
echo "Debug: Router Test Starting\n";

session_start();
echo "Debug: Session started\n";

// Include configuration and database
try {
    $config = require_once __DIR__ . '/config/app.php';
    echo "Debug: Config loaded\n";
} catch (Exception $e) {
    echo "Debug: Config error: " . $e->getMessage() . "\n";
}

try {
    require_once __DIR__ . '/app/Database.php';
    echo "Debug: Database class loaded\n";
} catch (Exception $e) {
    echo "Debug: Database error: " . $e->getMessage() . "\n";
}

// Simple Router Class
class Router {
    private $routes = [];
    
    public function get($path, $callback) {
        $this->routes['GET'][$path] = $callback;
        echo "Debug: Route registered GET $path\n";
    }
    
    public function resolve() {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        
        echo "Debug: Resolving $method $path\n";
        echo "Debug: Available routes: " . json_encode($this->routes) . "\n";
        
        // Check for exact match
        if (isset($this->routes[$method][$path])) {
            echo "Debug: Found exact match\n";
            return call_user_func($this->routes[$method][$path]);
        }
        
        echo "Debug: No route found, returning 404\n";
        http_response_code(404);
        echo "<h1>404 - Page Not Found</h1>";
    }
}

$router = new Router();

$router->get('/', function() {
    echo "Debug: Root route called\n";
    echo "Hello World";
});

$router->get('/test', function() {
    echo "Debug: Test route called\n";
    echo "Test Route Works";
});

echo "Debug: About to resolve router\n";
$router->resolve();
echo "Debug: Router resolved\n";
?>
