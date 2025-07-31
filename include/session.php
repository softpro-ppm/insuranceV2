<?php
/**
 * Session Management
 * Insurance Management System v2.0
 */

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in
function isLoggedIn() {
    return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
}

// Redirect to login if not logged in
function requireLogin() {
    if (!isLoggedIn()) {
        $_SESSION['error'] = 'Please login to access this page';
        header('Location: /login');
        exit();
    }
}

// Get current user data
function getCurrentUser() {
    if (!isLoggedIn()) {
        return null;
    }
    
    return [
        'id' => $_SESSION['user_id'] ?? null,
        'name' => $_SESSION['user_name'] ?? 'Unknown User',
        'role' => $_SESSION['user_role'] ?? 'user',
        'email' => $_SESSION['user_email'] ?? '',
    ];
}

// Check if user has specific role
function hasRole($role) {
    return ($_SESSION['user_role'] ?? '') === $role;
}

// Check if user is admin
function isAdmin() {
    return hasRole('admin') || hasRole('administrator');
}

// Logout user
function logout() {
    $_SESSION = array();
    
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    
    session_destroy();
    header('Location: /login');
    exit();
}

// Flash message functions
function setFlashMessage($type, $message) {
    $_SESSION['flash'][$type] = $message;
}

function getFlashMessage($type) {
    if (isset($_SESSION['flash'][$type])) {
        $message = $_SESSION['flash'][$type];
        unset($_SESSION['flash'][$type]);
        return $message;
    }
    return null;
}

function hasFlashMessage($type) {
    return isset($_SESSION['flash'][$type]);
}

// Set success message
function setSuccessMessage($message) {
    $_SESSION['success'] = $message;
}

// Set error message
function setErrorMessage($message) {
    $_SESSION['error'] = $message;
}

// For backward compatibility, ensure these exist if not already logged in via router
if (!isLoggedIn() && !in_array($_SERVER['REQUEST_URI'], ['/login', '/', '/logout'])) {
    // Only redirect if we're not already on a public page
    if (!defined('SKIP_AUTH_CHECK')) {
        requireLogin();
    }
}
