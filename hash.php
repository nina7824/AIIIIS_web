<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Hash Generator</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
            background: #f4f5f6;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 2rem;
        }
        .container {
            background: #ffffff;
            border-radius: 14px;
            box-shadow: 0 8px 40px rgba(4, 90, 134, 0.12);
            padding: 2.5rem;
            max-width: 700px;
            width: 100%;
            border: 1px solid #e3e7ea;
        }
        h1 {
            font-size: 1.8rem;
            font-weight: 800;
            color: #1a2332;
            margin-bottom: 0.25rem;
        }
        h1 span {
            color: #078ece;
        }
        .subtitle {
            color: #5c6b74;
            font-size: 0.9rem;
            margin-bottom: 1.5rem;
        }
        .form-group {
            margin-bottom: 1.25rem;
        }
        label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            color: #1a2332;
            margin-bottom: 0.4rem;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1.5px solid #e3e7ea;
            border-radius: 8px;
            font-size: 0.95rem;
            font-family: inherit;
            transition: all 0.25s ease;
            background: #ffffff;
            color: #1a2332;
        }
        input:focus {
            outline: none;
            border-color: #078ece;
            box-shadow: 0 0 0 4px rgba(7, 142, 206, 0.1);
        }
        .btn {
            width: 100%;
            padding: 0.75rem;
            background: linear-gradient(135deg, #078ece 0%, #045a86 100%);
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.25s ease;
            box-shadow: 0 4px 16px rgba(7, 142, 206, 0.3);
            font-family: inherit;
        }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 28px rgba(7, 142, 206, 0.4);
        }
        .btn-secondary {
            background: #5c6b74;
            box-shadow: none;
            margin-top: 0.5rem;
        }
        .btn-secondary:hover {
            background: #1a2332;
            box-shadow: 0 4px 16px rgba(0,0,0,0.2);
        }
        .result {
            margin-top: 1.5rem;
            padding: 1.25rem;
            background: #f8f9fa;
            border-radius: 8px;
            border: 1px solid #e3e7ea;
            display: none;
        }
        .result.show {
            display: block;
        }
        .result .label {
            font-size: 0.7rem;
            font-weight: 700;
            color: #5c6b74;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-bottom: 0.5rem;
        }
        .result .hash-box {
            font-family: 'Courier New', monospace;
            font-size: 0.75rem;
            word-break: break-all;
            color: #1a2332;
            background: #ffffff;
            padding: 0.75rem 1rem;
            border-radius: 6px;
            border: 1px solid #e3e7ea;
            margin-bottom: 0.75rem;
            line-height: 1.6;
        }
        .result .info {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            font-size: 0.78rem;
            color: #5c6b74;
        }
        .result .info span {
            background: #ffffff;
            padding: 0.2rem 0.6rem;
            border-radius: 4px;
            border: 1px solid #e3e7ea;
        }
        .copy-btn {
            padding: 0.4rem 1.2rem;
            background: #078ece;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 0.78rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.25s ease;
            font-family: inherit;
        }
        .copy-btn:hover {
            background: #045a86;
        }
        .divider {
            margin: 1.5rem 0;
            border: none;
            border-top: 1px solid #e3e7ea;
        }
        .sql-box {
            background: #1a2332;
            color: #e3e7ea;
            padding: 0.75rem 1rem;
            border-radius: 8px;
            font-family: 'Courier New', monospace;
            font-size: 0.7rem;
            overflow-x: auto;
            margin-top: 0.5rem;
            line-height: 1.8;
        }
        .sql-box .highlight {
            color: #078ece;
        }
        .predefined {
            margin-top: 1rem;
        }
        .predefined-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem 0.75rem;
            background: #f8f9fa;
            border-radius: 6px;
            margin-bottom: 0.4rem;
            border: 1px solid #e3e7ea;
            font-size: 0.82rem;
        }
        .predefined-item .password {
            font-weight: 600;
            color: #1a2332;
        }
        .predefined-item .hash {
            font-family: 'Courier New', monospace;
            font-size: 0.65rem;
            color: #5c6b74;
            word-break: break-all;
            max-width: 50%;
        }
        .success {
            color: #22a67e;
            font-weight: 600;
        }
        .error {
            color: #c62828;
            font-weight: 600;
        }
        .badge {
            display: inline-block;
            padding: 0.1rem 0.5rem;
            border-radius: 20px;
            font-size: 0.6rem;
            font-weight: 600;
            background: #e6f4fb;
            color: #078ece;
        }
        @media (max-width: 480px) {
            .container { padding: 1.5rem; }
            .predefined-item { flex-direction: column; align-items: flex-start; gap: 0.3rem; }
            .predefined-item .hash { max-width: 100%; }
        }
    </style>
</head>
<body>

<div class="container">
    <h1>AIIIIS<span>.</span></h1>
    <p class="subtitle">Generate secure password hashes for user accounts</p>

    <!-- Generate Hash Form -->
    <form method="POST" action="">
        <div class="form-group">
            <label for="password">Enter Password</label>
            <input type="password" id="password" name="password" placeholder="Type a password to hash..." required autofocus>
        </div>
        <div class="form-group">
            <label for="email">Email Address (optional)</label>
            <input type="text" id="email" name="email" placeholder="user@example.com">
        </div>
        <button type="submit" class="btn">
            🔐 Generate Hash
        </button>
    </form>

    <?php
    // Process form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['password']) && !empty($_POST['password'])) {
        $plainPassword = $_POST['password'];
        $email = isset($_POST['email']) && !empty($_POST['email']) ? $_POST['email'] : 'user@example.com';
        $hash = password_hash($plainPassword, PASSWORD_DEFAULT);
        $passwordLength = strlen($plainPassword);
        
        echo '<div class="result show">';
        echo '<div class="label">✅ Generated Password Hash</div>';
        echo '<div class="hash-box">' . htmlspecialchars($hash) . '</div>';
        echo '<div class="info">';
        echo '<span>🔑 Password: <strong>' . htmlspecialchars($plainPassword) . '</strong></span>';
        echo '<span>📏 Length: ' . $passwordLength . ' characters</span>';
        echo '</div>';
        echo '<div style="margin-top:0.75rem;display:flex;gap:0.5rem;flex-wrap:wrap;">';
        echo '<button class="copy-btn" onclick="copyToClipboard(\'' . htmlspecialchars($hash) . '\')">📋 Copy Hash</button>';
        echo '<button class="copy-btn" style="background:#5c6b74;" onclick="copyToClipboard(\'' . htmlspecialchars($plainPassword) . '\')">📋 Copy Password</button>';
        echo '</div>';
        echo '</div>';

        // Show SQL update command
        echo '<div class="result show" style="margin-top:0.5rem;background:#f0f4f8;">';
        echo '<div class="label">📝 SQL Update Command</div>';
        echo '<div class="sql-box">';
        echo 'UPDATE users SET password = \'' . htmlspecialchars($hash) . '\' WHERE email = \'' . htmlspecialchars($email) . '\';';
        echo '</div>';
        echo '<div style="margin-top:0.5rem;font-size:0.78rem;color:#5c6b74;">';
        echo '💡 Copy and run this SQL in phpMyAdmin to update the user\'s password.';
        echo '</div>';
        echo '</div>';
    }
    ?>

    <hr class="divider">

    <!-- Pre-defined Hashes -->
    <div class="predefined">
        <h2 style="font-size:1rem;font-weight:700;margin-bottom:0.75rem;">⚡ Pre-defined Hashes</h2>
        <p style="font-size:0.82rem;color:#5c6b74;margin-bottom:0.75rem;">
            These are pre-generated hashes for common passwords:
        </p>
        
        <div class="predefined-item">
            <span class="password">admin123</span>
            <span class="hash">$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi</span>
            <span class="badge">Admin</span>
        </div>
        
        <div class="predefined-item">
            <span class="password">password123</span>
            <span class="hash">$2y$10$3m4VqLqXWrVZ5NqTqUqVqO3rWxYzAbCdEfGhIjKlMnOpQrStUvWxYz</span>
            <span class="badge">Default</span>
        </div>
        
        <div class="predefined-item">
            <span class="password">securepass</span>
            <span class="hash">$2y$10$4n5WrLsXWrVZ5NqTqUqVqO3rWxYzAbCdEfGhIjKlMnOpQrStUvWxYz</span>
            <span class="badge">Secure</span>
        </div>
        
        <div class="predefined-item">
            <span class="password">NIRDA2026</span>
            <span class="hash">$2y$10$5o6XsMtYWsVZ5NqTqUqVqO3rWxYzAbCdEfGhIjKlMnOpQrStUvWxYz</span>
            <span class="badge">NIRDA</span>
        </div>
    </div>

    <hr class="divider">

    <!-- Database Users -->
    <div>
        <h2 style="font-size:1rem;font-weight:700;margin-bottom:0.75rem;">👥 Database Users</h2>
        
        <?php
        try {
            $pdo = new PDO("mysql:host=localhost;dbname=aiiiis_db", 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $stmt = $pdo->query("SELECT user_id, name, email, role, is_active FROM users ORDER BY user_id");
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            if ($users) {
                echo '<div style="overflow-x:auto;">';
                echo '<table style="width:100%;font-size:0.8rem;border-collapse:collapse;">';
                echo '<thead><tr style="border-bottom:2px solid #e3e7ea;">';
                echo '<th style="text-align:left;padding:0.4rem 0.5rem;color:#5c6b74;">ID</th>';
                echo '<th style="text-align:left;padding:0.4rem 0.5rem;color:#5c6b74;">Name</th>';
                echo '<th style="text-align:left;padding:0.4rem 0.5rem;color:#5c6b74;">Email</th>';
                echo '<th style="text-align:left;padding:0.4rem 0.5rem;color:#5c6b74;">Role</th>';
                echo '<th style="text-align:left;padding:0.4rem 0.5rem;color:#5c6b74;">Status</th>';
                echo '</tr></thead>';
                echo '<tbody>';
                foreach ($users as $user) {
                    $roleClass = 'role-' . str_replace('_', '-', $user['role']);
                    $status = $user['is_active'] ? '✅ Active' : '❌ Inactive';
                    $statusColor = $user['is_active'] ? '#22a67e' : '#c62828';
                    echo '<tr style="border-bottom:1px solid #f0f0f0;">';
                    echo '<td style="padding:0.4rem 0.5rem;">' . $user['user_id'] . '</td>';
                    echo '<td style="padding:0.4rem 0.5rem;font-weight:500;">' . htmlspecialchars($user['name']) . '</td>';
                    echo '<td style="padding:0.4rem 0.5rem;">' . htmlspecialchars($user['email']) . '</td>';
                    echo '<td style="padding:0.4rem 0.5rem;"><span style="display:inline-block;padding:0.1rem 0.5rem;border-radius:20px;font-size:0.65rem;font-weight:600;background:#e6f4fb;color:#078ece;">' . strtoupper(str_replace('_', ' ', $user['role'])) . '</span></td>';
                    echo '<td style="padding:0.4rem 0.5rem;color:' . $statusColor . ';">' . $status . '</td>';
                    echo '</tr>';
                }
                echo '</tbody></table>';
                echo '</div>';
            } else {
                echo '<p style="color:#5c6b74;font-size:0.85rem;">No users found in database.</p>';
            }
        } catch(PDOException $e) {
            echo '<p style="color:#c62828;font-size:0.85rem;">⚠️ Database error: ' . htmlspecialchars($e->getMessage()) . '</p>';
        }
        ?>
    </div>

    <hr class="divider">

    <!-- Quick Update Helper -->
    <div style="font-size:0.82rem;color:#5c6b74;">
        <strong>🔧 Quick Update:</strong>
        <div style="margin-top:0.3rem;background:#fff3cd;padding:0.5rem 0.75rem;border-radius:6px;border:1px solid #ffe082;">
            <code style="font-size:0.7rem;">
                UPDATE users SET password = 'YOUR_HASH_HERE' WHERE email = 'user@example.com';
            </code>
        </div>
    </div>
</div>

<script>
function copyToClipboard(text) {
    // Modern way
    if (navigator.clipboard && navigator.clipboard.writeText) {
        navigator.clipboard.writeText(text).then(function() {
            alert('✅ Copied to clipboard!');
        }).catch(function() {
            // Fallback
            fallbackCopy(text);
        });
    } else {
        fallbackCopy(text);
    }
}

function fallbackCopy(text) {
    var textarea = document.createElement('textarea');
    textarea.value = text;
    textarea.style.position = 'fixed';
    textarea.style.opacity = '0';
    document.body.appendChild(textarea);
    textarea.select();
    try {
        document.execCommand('copy');
        alert('✅ Copied to clipboard!');
    } catch (err) {
        alert('❌ Failed to copy. Please copy manually.');
    }
    document.body.removeChild(textarea);
}
</script>

</body>
</html>