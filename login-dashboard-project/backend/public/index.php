<?php
require_once __DIR__ . '/../src/Routes/web.php';
require_once __DIR__ . '/../src/Routes/api.php';

// Initialize the application
session_start();

// Handle incoming requests
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$requestMethod = $_SERVER['REQUEST_METHOD'];

// Route the request
if (strpos($requestUri, '/api') === 0) {
    // Handle API requests
    handleApiRequest($requestMethod, $requestUri);
} else {
    // Handle web requests
    handleWebRequest($requestMethod, $requestUri);
}

function handleApiRequest($method, $uri) {
    // Include the API routing logic
    require_once __DIR__ . '/api.php';
}

function handleWebRequest($method, $uri) {
    // Include the web routing logic
    require_once __DIR__ . '/web.php';
}
?>