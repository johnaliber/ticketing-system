<?php
session_start();

// CSRF token
if (empty($_SESSION['csrf'])) {
    $_SESSION['csrf'] = bin2hex(random_bytes(32));
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $csrf = $_POST['csrf'] ?? '';
    if (!hash_equals($_SESSION['csrf'], $csrf)) {
        $error = 'Invalid session. Please refresh and try again.';
    } else {
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';
        if ($username === '' || $password === '') {
            $error = 'Please enter your username and password.';
        } else {
            // TODO: Replace with real authentication against your database
            if ($username === 'admin' && $password === 'password') {
                $_SESSION['user'] = $username;
                header('Location: dashboard.php');
                exit;
            } else {
                $error = 'Invalid username or password.';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Hotel IT Ticketing System - Login</title>
    <meta name="color-scheme" content="light dark">
    <style>
        :root {
            --bg: #0b1220; --card: #ffffff; --text: #0f172a; --muted: #475569;
            --primary: #2563eb; --primary-600: #1d4ed8; --ring: rgba(37, 99, 235, 0.35);
            --danger: #dc2626;
        }
        @media (prefers-color-scheme: dark) {
            :root { --card: #111827; --text: #e5e7eb; --muted: #94a3b8; --ring: rgba(59,130,246,.45); }
        }
        * { box-sizing: border-box; } html, body { height: 100%; }
        body { margin: 0; font-family: system-ui, -apple-system, Segoe UI, Roboto, Ubuntu, Cantarell, "Helvetica Neue", Arial, "Noto Sans";
            color: var(--text);
            background: radial-gradient(800px 400px at 10% 10%, rgba(37,99,235,.15), transparent 40%),
                        radial-gradient(800px 400px at 90% 90%, rgba(99,102,241,.12), transparent 40%), var(--bg);
            display: grid; place-items: center; padding: 24px; }
        .card { width: 100%; max-width: 420px; background: var(--card); border-radius: 14px;
            box-shadow: 0 15px 35px rgba(0,0,0,.15), 0 2px 8px rgba(0,0,0,.08);
            overflow: hidden; border: 1px solid rgba(148,163,184,.15); }
        .header { padding: 28px 28px 14px; display: grid; gap: 10px; justify-items: center; text-align: center; }
        .brand { width: 56px; height: 56px; border-radius: 14px;
            background: conic-gradient(from 180deg at 50% 50%, #1d4ed8, #22d3ee, #a78bfa, #1d4ed8);
            display: grid; place-items: center; box-shadow: 0 10px 20px rgba(37,99,235,.25); }
        .brand svg { width: 30px; height: 30px; color: #fff; filter: drop-shadow(0 1px 1px rgba(0,0,0,.25)); }
        .title { font-size: 20px; font-weight: 700; letter-spacing: .2px; }
        .subtitle { font-size: 13px; color: var(--muted); }
        .body { padding: 18px 28px 28px; }
        .alert { display: none; background: rgba(220,38,38,.08); border: 1px solid rgba(220,38,38,.35);
            color: var(--danger); padding: 10px 12px; border-radius: 10px; font-size: 13px; margin-bottom: 12px; }
        .alert.show { display: block; }
        .field { margin-bottom: 14px; }
        .label { display: block; font-size: 12px; color: var(--muted); margin-bottom: 6px; }
        .input-wrap { position: relative; }
        .input { width: 100%; height: 44px; padding: 10px 40px 10px 42px; border-radius: 10px;
            border: 1px solid rgba(148,163,184,.35); background: transparent; color: var(--text);
            outline: none; transition: box-shadow .2s, border-color .2s; }
        .input:focus { border-color: var(--primary); box-shadow: 0 0 0 4px var(--ring); }
        .icon-left, .icon-right { position: absolute; top: 50%; transform: translateY(-50%); color: var(--muted); }
        .icon-left { left: 12px; } .icon-right { right: 10px; cursor: pointer; }
        .row { display: flex; align-items: center; justify-content: space-between; gap: 8px; margin: 6px 0 18px; font-size: 13px; }
        .row a { color: var(--primary); text-decoration: none; }
        .btn { width: 100%; height: 44px; border: none; border-radius: 10px;
            background: linear-gradient(180deg, var(--primary), var(--primary-600)); color: #fff; font-weight: 600;
            letter-spacing: .3px; cursor: pointer; box-shadow: 0 8px 18px rgba(37,99,235,.35);
            transition: transform .05s ease, box-shadow .2s ease, filter .2s ease; }
        .btn:active { transform: translateY(1px); box-shadow: 0 5px 12px rgba(37,99,235,.35); }
        .footer-note { margin-top: 14px; text-align: center; font-size: 12px; color: var(--muted); }
    </style>
</head>
<body>
    <main class="card" role="main">
        <div class="header">
            <div class="brand" aria-hidden="true">
                <!-- Inline icon: ticket with wrench (hotel IT ticketing) -->
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                    <!-- Ticket shape -->
                    <path d="M4 7a2 2 0 0 1 2-2h7.5a1 1 0 0 1 .7.29l3.5 3.5a1 1 0 0 1 .29.71V17a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V7z"/>
                    <path d="M15 5v3a1 1 0 0 0 1 1h3"/>
                    <!-- Wrench -->
                    <path d="M10.8 11.2a2.5 2.5 0 1 0 3 3l2.7 2.7a1 1 0 0 1-1.4 1.4l-2.7-2.7a2.5 2.5 0 0 0-3-3z"/>
                </svg>
            </div>
            <div class="title">Hotel IT Ticketing System</div>
            <div class="subtitle">Sign in to manage and track support tickets</div>
        </div>
        <div class="body">
            <div id="alert" class="alert" role="alert" aria-live="polite"></div>
            <form id="loginForm" novalidate>
                <input type="hidden" id="csrf" name="csrf" />
                <div class="field">
                    <label class="label" for="username">Username</label>
                    <div class="input-wrap">
                        <span class="icon-left" aria-hidden="true">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 21a8 8 0 1 0-16 0"/><circle cx="12" cy="7" r="4"/>
                            </svg>
                        </span>
                        <input class="input" type="text" id="username" name="username" autocomplete="username" placeholder="e.g. jdoe" required />
                    </div>
                </div>
                <div class="field">
                    <label class="label" for="password">Password</label>
                    <div class="input-wrap">
                        <span class="icon-left" aria-hidden="true">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="11" width="18" height="10" rx="2" ry="2"></rect>
                                <path d="M7 11V8a5 5 0 0 1 10 0v3"></path>
                            </svg>
                        </span>
                        <input class="input" type="password" id="password" name="password" autocomplete="current-password" placeholder="Enter your password" required />
                        <span class="icon-right" id="togglePwd" title="Show/Hide password" aria-label="Toggle password visibility">
                            <svg id="eyeIcon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12z"/><circle cx="12" cy="12" r="3"/>
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="row">
                    <label style="display:flex;align-items:center;gap:8px;cursor:pointer;">
                        <input type="checkbox" id="remember" name="remember" style="accent-color: var(--primary);" /> Remember me
                    </label>
                    <a href="#" title="Contact admin to reset">Forgot password?</a>
                </div>
                <button class="btn" type="submit">Sign In</button>
                <div class="footer-note">© <span id="year"></span> Hotel IT Department</div>
            </form>
        </div>
    </main>

    <script>
        const alertBox = document.getElementById('alert');
        const csrfInput = document.getElementById('csrf');
        const form = document.getElementById('loginForm');
        document.getElementById('year').textContent = new Date().getFullYear();

        // Toggle password visibility
        (function () {
            const pwd = document.getElementById('password');
            const toggle = document.getElementById('togglePwd');
            const eye = document.getElementById('eyeIcon');
            toggle?.addEventListener('click', () => {
                const isPw = pwd.type === 'password';
                pwd.type = isPw ? 'text' : 'password';
                eye.innerHTML = isPw
                    ? '<path d="M17.94 17.94A10.94 10.94 0 0 1 12 20c-7 0-11-8-11-8a21.77 21.77 0 0 1 5.06-6.94M9.88 9.88A3 3 0 0 0 12 15a3 3 0 0 0 2.12-.88M1 1l22 22" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>'
                    : '<path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12z" /><circle cx="12" cy="12" r="3"/>';
            });
        })();

        function showError(msg) {
            alertBox.textContent = msg || 'Something went wrong.';
            alertBox.classList.add('show');
        }
        function clearError() {
            alertBox.textContent = '';
            alertBox.classList.remove('show');
        }

        // Get CSRF token from backend
        async function loadCsrf() {
            try {
                const res = await fetch('/api/auth/csrf.php', { credentials: 'include' });
                const data = await res.json();
                csrfInput.value = data.csrf || '';
            } catch {
                showError('Failed to initialize session. Please refresh.');
            }
        }

        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            clearError();
            const payload = {
                username: document.getElementById('username').value.trim(),
                password: document.getElementById('password').value,
                remember: document.getElementById('remember').checked,
                csrf: csrfInput.value
            };
            if (!payload.username || !payload.password) {
                showError('Please enter your username and password.');
                return;
            }
            try {
                const res = await fetch('/api/auth/login.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    credentials: 'include',
                    body: JSON.stringify(payload)
                });
                const data = await res.json();
                if (res.ok && data.success) {
                    window.location.href = '/dashboard.php';
                } else {
                    showError(data.error || 'Invalid username or password.');
                    await loadCsrf(); // refresh token on auth error
                }
            } catch {
                showError('Network error. Please try again.');
            }
        });

        loadCsrf();
    </script>
</body>
</html>