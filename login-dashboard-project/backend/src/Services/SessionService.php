<?php
namespace App\Services;

class SessionService
{
    public function startSession()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function destroySession()
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_unset();
            session_destroy();
        }
    }

    public function setUser($user)
    {
        $_SESSION['user'] = $user;
    }

    public function getUser()
    {
        return $_SESSION['user'] ?? null;
    }

    public function isAuthenticated()
    {
        return isset($_SESSION['user']);
    }
}
?>