<?php
namespace Middleware;

class CsrfMiddleware
{
    public function handle($request, $next)
    {
        session_start();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $csrfToken = $_POST['csrf'] ?? '';
            if (empty($csrfToken) || !hash_equals($_SESSION['csrf'], $csrfToken)) {
                http_response_code(403);
                echo json_encode(['error' => 'Invalid CSRF token.']);
                exit;
            }
        }

        return $next($request);
    }
}
?>