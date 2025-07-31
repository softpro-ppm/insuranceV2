<?php
/**
 * Common Functions
 * Insurance Management System v2.0
 */

/**
 * Sanitize input data
 */
function sanitize($data) {
    if (is_array($data)) {
        return array_map('sanitize', $data);
    }
    return htmlspecialchars(strip_tags(trim($data)), ENT_QUOTES, 'UTF-8');
}

/**
 * Validate email
 */
function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

/**
 * Generate random string
 */
function generateRandomString($length = 10) {
    return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
}

/**
 * Format currency
 */
function formatCurrency($amount) {
    return '₹' . number_format($amount, 2);
}

/**
 * Format date for display
 */
function formatDate($date, $format = 'M d, Y') {
    return date($format, strtotime($date));
}

/**
 * Get time ago string
 */
function timeAgo($datetime) {
    $time = time() - strtotime($datetime);
    
    if ($time < 60) return 'just now';
    if ($time < 3600) return floor($time/60) . ' minutes ago';
    if ($time < 86400) return floor($time/3600) . ' hours ago';
    if ($time < 2592000) return floor($time/86400) . ' days ago';
    if ($time < 31536000) return floor($time/2592000) . ' months ago';
    
    return floor($time/31536000) . ' years ago';
}

/**
 * Get status badge class
 */
function getStatusBadgeClass($status) {
    $classes = [
        'active' => 'success',
        'pending' => 'warning',
        'expired' => 'danger',
        'cancelled' => 'secondary',
        'draft' => 'info'
    ];
    
    return $classes[strtolower($status)] ?? 'secondary';
}

/**
 * Get policy type icon
 */
function getPolicyTypeIcon($type) {
    $icons = [
        'motor' => 'fas fa-car',
        'health' => 'fas fa-heartbeat',
        'life' => 'fas fa-shield-alt',
        'travel' => 'fas fa-plane',
        'home' => 'fas fa-home',
        'business' => 'fas fa-briefcase'
    ];
    
    return $icons[strtolower($type)] ?? 'fas fa-file-contract';
}

/**
 * Generate policy number
 */
function generatePolicyNumber($type = 'POL') {
    return strtoupper($type) . '-' . date('Y') . '-' . date('m') . '-' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
}

/**
 * Check if date is expiring soon (within 30 days)
 */
function isExpiringSoon($date) {
    $expiry = strtotime($date);
    $today = time();
    $thirtyDaysFromNow = $today + (30 * 24 * 60 * 60);
    
    return $expiry <= $thirtyDaysFromNow && $expiry >= $today;
}

/**
 * Check if date is expired
 */
function isExpired($date) {
    return strtotime($date) < time();
}

/**
 * Get days until expiry
 */
function getDaysUntilExpiry($date) {
    $expiry = strtotime($date);
    $today = time();
    $diff = $expiry - $today;
    
    return floor($diff / (24 * 60 * 60));
}

/**
 * Redirect with message
 */
function redirectWithMessage($url, $message, $type = 'success') {
    $_SESSION[$type] = $message;
    header("Location: $url");
    exit();
}

/**
 * Get avatar initials
 */
function getInitials($name) {
    $words = explode(' ', $name);
    $initials = '';
    
    foreach ($words as $word) {
        if (!empty($word)) {
            $initials .= strtoupper($word[0]);
        }
    }
    
    return substr($initials, 0, 2);
}

/**
 * Log activity
 */
function logActivity($action, $details = '') {
    if (!isLoggedIn()) {
        return;
    }
    
    try {
        $pdo = getDbConnection();
        $stmt = $pdo->prepare("INSERT INTO activity_logs (user_id, action, details, created_at) VALUES (?, ?, ?, NOW())");
        $stmt->execute([$_SESSION['user_id'], $action, $details]);
    } catch (Exception $e) {
        // Log error but don't break the application
        error_log("Activity log error: " . $e->getMessage());
    }
}
