<?php
require_once __DIR__ . '/../include/config.php';
require_once __DIR__ . '/../include/session.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    die('Unauthorized access');
}

$user_role = $_SESSION['user_role'];
$user_id = $_SESSION['user_id'];

// Check if file parameter is provided
if (!isset($_GET['file']) || empty($_GET['file'])) {
    http_response_code(400);
    die('File parameter is required');
}

$filename = basename($_GET['file']);
$file_path = __DIR__ . '/../assets/uploads/' . $filename;

// Check if file exists
if (!file_exists($file_path)) {
    http_response_code(404);
    die('File not found');
}

// Role-based access control for document downloads
if ($user_role === 'agent') {
    // Agents cannot download documents - show error message
    http_response_code(403);
    header('Content-Type: application/json');
    echo json_encode([
        'error' => true,
        'message' => 'Access Denied: Agents cannot download policy documents. Please contact the administrator for document access.',
        'user_role' => $user_role
    ]);
    exit;
}

// For admin and receptionist, check if they have access to the specific policy
$db = Database::getInstance();

// Get the policy/customer document details to verify access
$document = null;

// Try to find in policy documents first
$document = $db->fetch("
    SELECT pd.*, p.agent_id, p.policy_number 
    FROM policy_documents pd 
    LEFT JOIN policies p ON pd.policy_id = p.id 
    WHERE pd.file_name = ? OR pd.file_path LIKE ?
", [$filename, '%' . $filename]);

// If not found, try customer documents
if (!$document) {
    $document = $db->fetch("
        SELECT cd.*, c.name as customer_name 
        FROM customer_documents cd 
        LEFT JOIN customers c ON cd.customer_id = c.id 
        WHERE cd.file_name = ? OR cd.file_path LIKE ?
    ", [$filename, '%' . $filename]);
}

// If document not found in database but file exists, allow admin to download
if (!$document && $user_role !== 'admin') {
    http_response_code(403);
    die('Access denied to this document');
}

// Set appropriate headers for file download
$file_info = pathinfo($file_path);
$extension = strtolower($file_info['extension']);

// Set content type based on file extension
$content_types = [
    'pdf' => 'application/pdf',
    'jpg' => 'image/jpeg',
    'jpeg' => 'image/jpeg',
    'png' => 'image/png',
    'gif' => 'image/gif',
    'doc' => 'application/msword',
    'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
    'xls' => 'application/vnd.ms-excel',
    'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
    'txt' => 'text/plain'
];

$content_type = $content_types[$extension] ?? 'application/octet-stream';

// Output file for download
header('Content-Type: ' . $content_type);
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Content-Length: ' . filesize($file_path));
header('Cache-Control: no-cache, must-revalidate');
header('Pragma: no-cache');

// Output the file
readfile($file_path);
exit;
?>
