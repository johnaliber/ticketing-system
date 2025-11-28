<?php
namespace App\Controllers;

use App\Models\User;
use App\Services\SessionService;

class AuthController
{
    private $sessionService;

    public function __construct()
    {
        $this->sessionService = new SessionService();
    }

    public function login($request)
    {
        $username = $request['username'] ?? '';
        $password = $request['password'] ?? '';

        if (empty($username) || empty($password)) {
            return ['error' => 'Username and password are required.'];
        }

        $user = User::findByUsername($username);

        if ($user && password_verify($password, $user->password)) {
            $this->sessionService->startSession($user->id);
            return ['success' => true];
        }

        return ['error' => 'Invalid username or password.'];
    }

    public function logout()
    {
        $this->sessionService->destroySession();
        return ['success' => true];
    }
}
?>