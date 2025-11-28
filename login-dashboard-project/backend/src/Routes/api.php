<?php
require_once __DIR__ . '/../Controllers/AuthController.php';
require_once __DIR__ . '/../Controllers/DashboardController.php';
require_once __DIR__ . '/../Middleware/AuthMiddleware.php';
require_once __DIR__ . '/../Middleware/CsrfMiddleware.php';

use Controllers\AuthController;
use Controllers\DashboardController;
use Middleware\AuthMiddleware;
use Middleware\CsrfMiddleware;

$router = new Router(); // Assuming you have a Router class to handle routing

// Authentication routes
$router->post('/api/login', [AuthController::class, 'login']);
$router->post('/api/logout', [AuthController::class, 'logout']);

// Dashboard routes
$router->get('/api/dashboard', [AuthMiddleware::class, 'handle'], [DashboardController::class, 'index']);

// CSRF protection for form submissions
$router->post('/api/submit-form', [CsrfMiddleware::class, 'handle'], [SomeController::class, 'submitForm']);

// Add more routes as needed
?>