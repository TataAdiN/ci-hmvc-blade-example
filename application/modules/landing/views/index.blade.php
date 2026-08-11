<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard | Log in</title>

    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons (Pengganti FontAwesome, 100% Free) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f4f7f6;
        }

        .login-card {
            max-width: 720px;
            width: 100%;
            border-radius: 1rem;
        }

        .brand-logo {
            font-weight: 700;
            font-size: 1.75rem;
            color: #212529;
            text-decoration: none;
            letter-spacing: -0.5px;
        }

        .brand-logo span {
            color: #0d6efd;
        }

        .form-floating>label>i {
            font-size: 1.1rem;
            vertical-align: text-bottom;
        }
    </style>
</head>

<body class="d-flex align-items-center justify-content-center vh-100">

    <div class="login-card p-3">
        <!-- Logo / Title -->
        <div class="text-center mb-4">
            <a href="{{ base_url() }}" class="brand-logo">Admin<span>Panel</span></a>
            <p class="text-muted mt-2">{{ lang("login_title") ?? 'Sign in to start your session' }}</p>
        </div>

        <!-- Card Container -->
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body p-4 p-md-5">
                <form action="{{ base_url('login/process') }}" method="post">
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="emailInput" placeholder="name@example.com"
                            name="email" required>
                        <label for="emailInput"><i class="bi bi-envelope me-2 text-muted"></i>Email address</label>
                    </div>

                    <div class="form-floating mb-4">
                        <input type="password" class="form-control" id="passwordInput" placeholder="Password"
                            name="password" required>
                        <label for="passwordInput"><i class="bi bi-lock me-2 text-muted"></i>Password</label>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="rememberMe" name="remember">
                            <label class="form-check-label text-muted" for="rememberMe">
                                Remember Me
                            </label>
                        </div>
                        <a href="{{ base_url('forgot-password') }}" class="text-decoration-none text-sm">Forgot
                            password?</a>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 py-2 rounded-3 fw-semibold shadow-sm">
                        Sign In
                    </button>
                </form>
            </div>
            <div class="card-footer bg-transparent border-0 text-center pb-4">
                <p class="text-muted mb-0">Don't have an account? <a href="{{ base_url('register') }}"
                        class="text-decoration-none fw-semibold">Register here</a>
                </p>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>