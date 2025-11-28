<?php
require_once '../src/Routes/api.php';

// Set the content type to application/json
header('Content-Type: application/json');

// Handle the incoming request
$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestUri = $_SERVER['REQUEST_URI'];

// Route the request to the appropriate handler
switch ($requestMethod) {
    case 'POST':
        // Handle POST requests (e.g., login)
        handlePostRequest($requestUri);
        break;
    case 'GET':
        // Handle GET requests (e.g., fetch user data)
        handleGetRequest($requestUri);
        break;
    default:
        http_response_code(405);
        echo json_encode(['error' => 'Method Not Allowed']);
        break;
}

function handlePostRequest($uri) {
    // Include the AuthController to handle authentication
    require_once '../src/Controllers/AuthController.php';
    $authController = new AuthController();

    // Route based on the URI
    if (preg_match('/^\/api\/login$/', $uri)) {
        $authController->login();
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'Not Found']);
    }
}

function handleGetRequest($uri) {
    // Include the DashboardController to handle dashboard requests
    require_once '../src/Controllers/DashboardController.php';
    $dashboardController = new DashboardController();

    // Route based on the URI
    if (preg_match('/^\/api\/dashboard$/', $uri)) {
        $dashboardController->getDashboardData();
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'Not Found']);
    }
}
?>