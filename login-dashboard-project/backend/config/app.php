<?php
return [
    'app_name' => 'Login Dashboard Project',
    'app_env' => 'development',
    'app_debug' => true,
    'app_url' => 'http://localhost/login-dashboard-project',
    
    'db' => [
        'host' => 'localhost',
        'port' => '3306',
        'database' => 'your_database_name',
        'username' => 'your_database_username',
        'password' => 'your_database_password',
    ],

    'session' => [
        'name' => 'session_name',
        'lifetime' => 3600,
        'path' => '/',
        'domain' => null,
        'secure' => false,
        'httponly' => true,
        'samesite' => 'Lax',
    ],

    'csrf' => [
        'token_name' => 'csrf_token',
        'token_lifetime' => 3600,
    ],
];
?>