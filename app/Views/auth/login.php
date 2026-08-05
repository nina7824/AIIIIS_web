<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Sign In — AIIIIS' ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=IBM+Plex+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        :root {
            --primary: #078ece;
            --primary-dark: #045a86;
            --primary-light: #e6f4fb;
            --canvas: #f4f5f6;
            --surface: #ffffff;
            --ink: #1a2332;
            --ink-muted: #5c6b74;
            --border: #e3e7ea;
            --shadow-lg: 0 8px 40px rgba(4, 90, 134, 0.12);
            --radius: 8px;
            --radius-lg: 14px;
            --transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Helvetica, Arial, sans-serif;
            background: var(--canvas);
            color: var(--ink);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
        }

        .login-wrapper {
            width: 100%;
            max-width: 520px;
        }

        .login-card {
            background: var(--surface);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-lg);
            padding: 2rem 2.5rem 2rem;
            border: 1px solid var(--border);
        }

        /* ========== BRAND ========== */
        .brand {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .brand-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 0.75rem;
            font-family: 'IBM Plex Mono', monospace;
            font-weight: 700;
            font-size: 0.9rem;
            color: #fff;
            box-shadow: 0 4px 16px rgba(7, 142, 206, 0.3);
        }

        .brand h1 {
            font-size: 1.3rem;
            font-weight: 800;
            letter-spacing: -0.02em;
        }

        .brand h1 span {
            color: var(--primary);
        }

        .brand p {
            color: var(--ink-muted);
            font-size: 0.85rem;
            margin-top: 0.1rem;
        }

        /* ========== ALERTS ========== */
        .alert {
            padding: 0.6rem 1rem;
            border-radius: var(--radius);
            font-size: 0.82rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }

        .alert-danger {
            background: #fde8e8;
            color: #c62828;
            border: 1px solid #f5c6cb;
        }

        .alert-success {
            background: #e8f5e9;
            color: #2e7d32;
            border: 1px solid #c8e6c9;
        }

        /* ========== FLOATING LABEL FORM ========== */
        .floating-group {
            position: relative;
            margin-bottom: 1.25rem;
        }

        .floating-group .input-wrapper {
            position: relative;
        }

        .floating-group .input-wrapper i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--ink-muted);
            font-size: 0.85rem;
            opacity: 0.5;
            z-index: 2;
            transition: var(--transition);
        }

        .floating-group input {
            width: 100%;
            padding: 0.85rem 1rem 0.85rem 2.8rem;
            border: 1.5px solid var(--border);
            border-radius: var(--radius);
            font-size: 0.9rem;
            font-family: 'Inter', sans-serif;
            transition: var(--transition);
            background: var(--surface);
            color: var(--ink);
            height: 52px;
        }

        .floating-group input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(7, 142, 206, 0.1);
        }

        .floating-group input:focus + .floating-label,
        .floating-group input:not(:placeholder-shown) + .floating-label {
            top: -6px;
            left: 2.8rem;
            font-size: 0.65rem;
            color: var(--primary);
            background: var(--surface);
            padding: 0 0.4rem;
            opacity: 1;
        }

        .floating-group input:focus + .floating-label + .input-wrapper i,
        .floating-group input:not(:placeholder-shown) + .floating-label + .input-wrapper i {
            opacity: 0.8;
        }

        .floating-group .floating-label {
            position: absolute;
            left: 2.8rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--ink-muted);
            font-size: 0.85rem;
            font-weight: 500;
            pointer-events: none;
            transition: all 0.2s ease;
            opacity: 0.6;
            background: transparent;
            padding: 0 0.2rem;
        }

        /* ========== FORM OPTIONS ========== */
        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.25rem;
            font-size: 0.82rem;
        }

        .form-options .remember-me {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--ink-muted);
            cursor: pointer;
        }

        .form-options .remember-me input[type="checkbox"] {
            width: 16px;
            height: 16px;
            accent-color: var(--primary);
            cursor: pointer;
            flex-shrink: 0;
        }

        .form-options .forgot-link {
            color: var(--primary);
            font-weight: 500;
            transition: var(--transition);
            font-size: 0.82rem;
        }

        .form-options .forgot-link:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        /* ========== BUTTON ========== */
        .btn-login {
            width: 100%;
            padding: 0.7rem;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: #fff;
            border: none;
            border-radius: var(--radius);
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            box-shadow: 0 4px 16px rgba(7, 142, 206, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.6rem;
            font-family: 'Inter', sans-serif;
            height: 48px;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 28px rgba(7, 142, 206, 0.4);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .btn-login i {
            font-size: 0.85rem;
        }

        /* ========== DIVIDER ========== */
        .login-divider {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin: 1.25rem 0;
            color: var(--ink-muted);
            font-size: 0.75rem;
        }

        .login-divider::before,
        .login-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--border);
        }

        /* ========== REGISTER LINK ========== */
        .register-link {
            text-align: center;
            font-size: 0.85rem;
            color: var(--ink-muted);
        }

        .register-link a {
            color: var(--primary);
            font-weight: 600;
            transition: var(--transition);
        }

        .register-link a:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        /* ========== BACK TO HOME ========== */
        .back-home {
            text-align: center;
            margin-top: 1rem;
        }

        .back-home a {
            color: var(--ink-muted);
            font-size: 0.78rem;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
        }

        .back-home a:hover {
            color: var(--primary);
        }

        /* ========== RESPONSIVE ========== */
        @media (max-width: 480px) {
            body {
                padding: 1rem;
            }

            .login-wrapper {
                max-width: 100%;
            }

            .login-card {
                padding: 1.5rem 1.25rem 1.5rem;
            }

            .brand h1 {
                font-size: 1.1rem;
            }

            .brand-icon {
                width: 40px;
                height: 40px;
                font-size: 0.8rem;
            }

            .form-options {
                flex-direction: column;
                gap: 0.5rem;
                align-items: flex-start;
            }

            .floating-group input {
                font-size: 0.85rem;
                height: 46px;
                padding: 0.7rem 1rem 0.7rem 2.5rem;
            }

            .floating-group .floating-label {
                font-size: 0.8rem;
                left: 2.5rem;
            }

            .floating-group input:focus + .floating-label,
            .floating-group input:not(:placeholder-shown) + .floating-label {
                left: 2.5rem;
                font-size: 0.6rem;
            }

            .btn-login {
                font-size: 0.85rem;
                height: 44px;
                padding: 0.6rem;
            }
        }

        @media (max-width: 360px) {
            .login-card {
                padding: 1rem 0.75rem 1rem;
            }

            .brand-icon {
                width: 36px;
                height: 36px;
                font-size: 0.7rem;
            }

            .brand h1 {
                font-size: 1rem;
            }

            .floating-group input {
                height: 42px;
                font-size: 0.8rem;
                padding: 0.6rem 0.75rem 0.6rem 2.2rem;
            }

            .floating-group .floating-label {
                font-size: 0.75rem;
                left: 2.2rem;
            }

            .btn-login {
                height: 40px;
                font-size: 0.8rem;
                padding: 0.5rem;
            }
        }
    </style>
</head>
<body>

<div class="login-wrapper">
    <div class="login-card">

        <!-- ========== BRAND ========== -->
        <div class="brand">
            <div class="brand-icon">AI</div>
            <h1>AIIIIS<span>.</span></h1>
            <p>Sign in to your account</p>
        </div>

        <!-- ========== ALERTS ========== -->
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i>
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <!-- ========== LOGIN FORM ========== -->
        <form action="<?= base_url('login/authenticate') ?>" method="post">
            <?= csrf_field() ?>

            <div class="floating-group">
                <div class="input-wrapper">
                    <i class="fas fa-envelope"></i>
                    <input type="email" id="email" name="email" placeholder=" " value="<?= old('email') ?>" required autofocus>
                    <label class="floating-label" for="email">Email Address</label>
                </div>
            </div>

            <div class="floating-group">
                <div class="input-wrapper">
                    <i class="fas fa-lock"></i>
                    <input type="password" id="password" name="password" placeholder=" " required>
                    <label class="floating-label" for="password">Password</label>
                </div>
            </div>

            <div class="form-options">
                <label class="remember-me">
                    <input type="checkbox" name="remember" value="1">
                    Remember me
                </label>
                <a href="<?= base_url('forgot-password') ?>" class="forgot-link">Forgot password?</a>
            </div>

            <button type="submit" class="btn-login">
                <i class="fas fa-arrow-right"></i> Sign In
            </button>
        </form>

        <!-- ========== DIVIDER ========== -->
        <div class="login-divider">or</div>

        <!-- ========== REGISTER LINK ========== -->
        <div class="register-link">
            Don't have an account? <a href="<?= base_url('register') ?>">Create one now</a>
        </div>

        <!-- ========== BACK TO HOME ========== -->
        <div class="back-home">
            <a href="<?= base_url() ?>">
                <i class="fas fa-arrow-left"></i> Back to home
            </a>
        </div>

    </div>
</div>

</body>
</html>