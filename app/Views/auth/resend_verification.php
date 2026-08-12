<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Resend Verification — AIIIIS' ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        /* Same styles as login page */
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
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', -apple-system, sans-serif;
            background: var(--canvas);
            color: var(--ink);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            line-height: 1.6;
        }
        .wrapper { width: 100%; max-width: 480px; }
        .card {
            background: var(--surface);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-lg);
            padding: 2rem 2.5rem;
            border: 1px solid var(--border);
        }
        .brand { text-align: center; margin-bottom: 1.5rem; }
        .brand-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 0.75rem;
            font-weight: 700;
            font-size: 0.9rem;
            color: #fff;
            box-shadow: 0 4px 16px rgba(7, 142, 206, 0.3);
        }
        .brand h1 { font-size: 1.3rem; font-weight: 800; }
        .brand h1 span { color: var(--primary); }
        .brand p { color: var(--ink-muted); font-size: 0.85rem; }
        .alert {
            padding: 0.75rem 1rem;
            border-radius: var(--radius);
            font-size: 0.82rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.6rem;
            border-left: 4px solid transparent;
        }
        .alert-danger { background: #fde8e8; color: #c62828; border-left-color: #e74c3c; }
        .alert-success { background: #e8f5e9; color: #2e7d32; border-left-color: #4caf50; }
        .alert-info { background: #e6f4fb; color: #045a86; border-left-color: var(--primary); }
        .form-group { margin-bottom: 1.25rem; }
        .form-group label {
            display: block;
            font-size: 0.82rem;
            font-weight: 600;
            margin-bottom: 0.3rem;
        }
        .form-group input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1.5px solid var(--border);
            border-radius: var(--radius);
            font-size: 0.9rem;
            font-family: 'Inter', sans-serif;
            transition: var(--transition);
            background: var(--surface);
            color: var(--ink);
        }
        .form-group input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(7, 142, 206, 0.1);
        }
        .btn-submit {
            width: 100%;
            padding: 0.75rem;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: #fff;
            border: none;
            border-radius: var(--radius);
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            box-shadow: 0 4px 16px rgba(7, 142, 206, 0.3);
        }
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 28px rgba(7, 142, 206, 0.4);
        }
        .back-link {
            text-align: center;
            margin-top: 1rem;
        }
        .back-link a {
            color: var(--ink-muted);
            font-size: 0.82rem;
            transition: var(--transition);
        }
        .back-link a:hover { color: var(--primary); }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="card">
        <div class="brand">
            <div class="brand-icon">AI</div>
            <h1>AIIIIS<span>.</span></h1>
            <p>Resend Verification Email</p>
        </div>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('info')): ?>
            <div class="alert alert-info"><?= session()->getFlashdata('info') ?></div>
        <?php endif; ?>

        <form action="<?= base_url('resend-verification') ?>" method="post">
            <?= csrf_field() ?>
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="Enter your email address" required>
            </div>
            <button type="submit" class="btn-submit">
                <i class="fas fa-paper-plane"></i> Resend Verification
            </button>
        </form>

        <div class="back-link">
            <a href="<?= base_url('login') ?>"><i class="fas fa-arrow-left"></i> Back to Sign In</a>
        </div>
    </div>
</div>
</body>
</html>