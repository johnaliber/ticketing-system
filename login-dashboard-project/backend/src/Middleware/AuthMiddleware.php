<?php
namespace App\Middleware;

use App\Services\SessionService;

class AuthMiddleware
{
    protected $sessionService;

    public function __construct(SessionService $sessionService)
    {
        $this->sessionService = $sessionService;
    }

    public function handle($request, $next)
    {
        if (!$this->sessionService->isAuthenticated()) {
            http_response_code(403);
            echo json_encode(['error' => 'Unauthorized access']);
            exit;
        }

        return $next($request);
    }
}
?>