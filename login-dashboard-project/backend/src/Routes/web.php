<?php
require_once __DIR__ . '/../Controllers/AuthController.php';
require_once __DIR__ . '/../Controllers/DashboardController.php';
require_once __DIR__ . '/../Middleware/AuthMiddleware.php';

use FastRoute\RouteCollector;

return function (RouteCollector $r) {
    // Public routes
    $r->addRoute('GET', '/', [DashboardController::class, 'index']);
    $r->addRoute('GET', '/login', [AuthController::class, 'showLoginForm']);
    $r->addRoute('POST', '/login', [AuthController::class, 'login']);
    $r->addRoute('POST', '/logout', [AuthController::class, 'logout']);

    // Protected routes
    $r->addRoute('GET', '/dashboard', [AuthMiddleware::class, 'handle'], [DashboardController::class, 'dashboard']);
};