<?php
/**
 * Local Development Server
 * Start PHP built-in server for local development
 */

$host = 'localhost';
$port = 8000;

echo "🚀 Insurance Management System v2.0 - Local Development Server\n";
echo "📍 Starting server at: http://{$host}:{$port}\n";
echo "🔄 Press Ctrl+C to stop\n";
echo "📝 Logs will appear below...\n\n";

// Change to project directory
chdir(__DIR__);

// Start PHP built-in server
$command = "php -S {$host}:{$port} -t . index.php";
echo "Command: {$command}\n\n";
passthru($command);
