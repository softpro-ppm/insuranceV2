<?php
// Router for PHP built-in server
// This ensures all requests go through index.php

$request_uri = $_SERVER['REQUEST_URI'];
$parsed_url = parse_url($request_uri);
$path = $parsed_url['path'];

// If it's a real file (like CSS, JS, images), serve it directly
if (file_exists(__DIR__ . $path) && is_file(__DIR__ . $path)) {
    return false;
}

// Otherwise, route everything through index.php
require_once __DIR__ . '/index.php';
