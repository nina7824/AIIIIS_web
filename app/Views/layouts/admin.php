<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Admin Dashboard — AIIIIS' ?></title>
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
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.06);
            --shadow-md: 0 4px 20px rgba(0,0,0,0.08);
            --shadow-lg: 0 8px 40px rgba(4, 90, 134, 0.12);
            --radius: 8px;
            --radius-lg: 14px;
            --transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            --sidebar-width: 260px;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', -apple-system, sans-serif;
            background: var(--canvas);
            color: var(--ink);
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
        }
        a { text-decoration: none; color: inherit; }

        /* ========== TOP BAR ========== */
        .top-bar {
            background: var(--ink);
            color: rgba(255,255,255,0.7);
            padding: 0.3rem 0;
            font-size: 0.65rem;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }
        .top-bar-inner {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 0.5rem;
            max-width: 100%;
            padding: 0 2rem;
        }
        .top-bar-left {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }
        .top-bar-left span {
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }
        .top-bar-left i { font-size: 0.45rem; color: var(--primary); }
        .top-bar-right {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .top-bar-right a {
            color: rgba(255,255,255,0.6);
            transition: var(--transition);
            font-size: 0.65rem;
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }
        .top-bar-right a:hover { color: #fff; }
        .top-bar-right .lang-select {
            background: transparent;
            border: none;
            color: rgba(255,255,255,0.6);
            font-size: 0.65rem;
            cursor: pointer;
            font-family: 'Inter', sans-serif;
            padding: 0.1rem 0.4rem;
            border-radius: 4px;
        }
        .top-bar-right .lang-select:hover { color: #fff; }
        @media (max-width: 768px) {
            .top-bar-inner { flex-direction: column; align-items: flex-start; gap: 0.25rem; padding: 0 1rem; }
            .top-bar-left { flex-wrap: wrap; gap: 0.5rem; }
            .top-bar-right { flex-wrap: wrap; gap: 0.5rem; }
        }

        /* ========== ADMIN LAYOUT ========== */
        .admin-wrapper {
            display: flex;
            min-height: calc(100vh - 38px);
        }

        /* ========== SIDEBAR ========== */
        .admin-sidebar {
            width: var(--sidebar-width);
            background: var(--surface);
            border-right: 1px solid var(--border);
            padding: 1.5rem 0;
            flex-shrink: 0;
            position: sticky;
            top: 0;
            height: calc(100vh - 38px);
            overflow-y: auto;
            transition: var(--transition);
        }

        .sidebar-brand {
            padding: 0 1.5rem 1.25rem;
            border-bottom: 1px solid var(--border);
            margin-bottom: 1rem;
        }
        .sidebar-brand .brand {
            display: flex;
            align-items: center;
            gap: 0.65rem;
        }
        .sidebar-brand .brand-icon {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'IBM Plex Mono', monospace;
            font-weight: 700;
            font-size: 0.65rem;
            color: #fff;
            box-shadow: 0 4px 12px rgba(7, 142, 206, 0.25);
        }
        .sidebar-brand .brand-text {
            font-weight: 800;
            font-size: 1rem;
            letter-spacing: -0.02em;
            color: var(--ink);
        }
        .sidebar-brand .brand-text span { color: var(--primary); }

        .sidebar-user {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1.5rem;
            margin: 0 0.75rem 1rem;
            background: var(--canvas);
            border-radius: var(--radius);
        }
        .sidebar-user .avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 700;
            font-size: 0.85rem;
            flex-shrink: 0;
        }
        .sidebar-user .user-info .name {
            font-weight: 600;
            font-size: 0.85rem;
            color: var(--ink);
            line-height: 1.2;
        }
        .sidebar-user .user-info .role {
            font-size: 0.6rem;
            color: var(--ink-muted);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .sidebar-menu {
            list-style: none;
            padding: 0 0.75rem;
        }
        .sidebar-menu .menu-label {
            font-size: 0.6rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--ink-muted);
            padding: 0.5rem 0.75rem 0.3rem;
            opacity: 0.5;
        }
        .sidebar-menu li { margin-bottom: 0.1rem; }
        .sidebar-menu li a {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.5rem 0.75rem;
            color: var(--ink-muted);
            font-size: 0.82rem;
            font-weight: 500;
            border-radius: var(--radius);
            transition: var(--transition);
        }
        .sidebar-menu li a:hover {
            color: var(--ink);
            background: var(--canvas);
        }
        .sidebar-menu li a.active {
            color: var(--primary);
            background: var(--primary-light);
        }
        .sidebar-menu li a i {
            width: 18px;
            font-size: 0.85rem;
            text-align: center;
        }
        .sidebar-menu li a .badge {
            margin-left: auto;
            background: var(--primary);
            color: #fff;
            font-size: 0.55rem;
            font-weight: 600;
            padding: 0.05rem 0.5rem;
            border-radius: 20px;
        }

        .sidebar-footer {
            padding: 1rem 1.5rem 0;
            border-top: 1px solid var(--border);
            margin-top: 1rem;
        }
        .sidebar-footer a {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            font-size: 0.78rem;
            color: var(--ink-muted);
            padding: 0.4rem 0.75rem;
            border-radius: var(--radius);
            transition: var(--transition);
        }
        .sidebar-footer a:hover {
            color: #c62828;
            background: #fde8e8;
        }

        /* ========== MAIN CONTENT ========== */
        .admin-content {
            flex: 1;
            padding: 1.5rem 2rem 2rem;
            background: var(--canvas);
            min-height: calc(100vh - 38px);
        }

        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
            gap: 1rem;
        }
        .content-header h1 {
            font-size: 1.3rem;
            font-weight: 800;
            letter-spacing: -0.02em;
        }
        .content-header .breadcrumb {
            font-size: 0.78rem;
            color: var(--ink-muted);
        }
        .content-header .breadcrumb span { color: var(--ink); }

        .mobile-toggle-sidebar {
            display: none;
            background: none;
            border: none;
            font-size: 1.2rem;
            color: var(--ink);
            cursor: pointer;
            padding: 0.4rem;
        }

        /* ========== STATS CARDS ========== */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.25rem;
            margin-bottom: 2rem;
        }
        .stat-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 1.25rem 1.5rem;
            transition: var(--transition);
        }
        .stat-card:hover {
            border-color: var(--primary);
            box-shadow: var(--shadow-sm);
        }
        .stat-card .stat-icon {
            font-size: 1.3rem;
            color: var(--primary);
            margin-bottom: 0.3rem;
        }
        .stat-card .stat-number {
            font-size: 1.6rem;
            font-weight: 800;
            color: var(--ink);
            letter-spacing: -0.02em;
        }
        .stat-card .stat-label {
            font-size: 0.72rem;
            color: var(--ink-muted);
            font-weight: 500;
        }

        /* ========== TABLE ========== */
        .table-container {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            overflow: hidden;
        }
        .table-container .table-header {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 0.5rem;
        }
        .table-container .table-header h3 {
            font-size: 0.95rem;
            font-weight: 700;
        }
        .table-container table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.82rem;
        }
        .table-container th {
            text-align: left;
            padding: 0.6rem 1.5rem;
            font-weight: 600;
            color: var(--ink-muted);
            border-bottom: 1px solid var(--border);
            background: var(--canvas);
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        .table-container td {
            padding: 0.6rem 1.5rem;
            border-bottom: 1px solid var(--border);
        }
        .table-container tr:hover td { background: var(--canvas); }

        .badge-status {
            display: inline-block;
            padding: 0.1rem 0.6rem;
            border-radius: 20px;
            font-size: 0.6rem;
            font-weight: 600;
        }
        .badge-active { background: #e6f7ef; color: #22a67e; }
        .badge-inactive { background: #fde8e8; color: #c62828; }
        .badge-pending { background: #fff3cd; color: #856404; }
        .badge-admin { background: #e6f4fb; color: #078ece; }
        .badge-expert { background: #e8f5e9; color: #2e7d32; }
        .badge-enterprise { background: #fff3e0; color: #e65100; }
        .badge-investor { background: #f3e5f5; color: #6a1b9a; }

        .btn-sm {
            padding: 0.2rem 0.6rem;
            border-radius: 4px;
            font-size: 0.7rem;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: var(--transition);
        }
        .btn-primary-sm {
            background: var(--primary);
            color: #fff;
        }
        .btn-primary-sm:hover {
            background: var(--primary-dark);
        }
        .btn-danger-sm {
            background: #c62828;
            color: #fff;
        }
        .btn-danger-sm:hover {
            background: #b71c1c;
        }

        /* ========== SIDEBAR OVERLAY ========== */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.3);
            z-index: 998;
        }
        .sidebar-overlay.active { display: block; }

        /* ========== RESPONSIVE ========== */
        @media (max-width: 992px) {
            .admin-sidebar {
                position: fixed;
                left: calc(-1 * var(--sidebar-width));
                top: 0;
                height: 100vh;
                z-index: 999;
                box-shadow: var(--shadow-lg);
                transition: left 0.3s ease;
            }
            .admin-sidebar.open {
                left: 0;
            }
            .mobile-toggle-sidebar {
                display: block;
            }
            .admin-content {
                padding: 1rem;
            }
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .content-header {
                flex-direction: column;
                align-items: flex-start;
            }
            .stats-grid {
                grid-template-columns: 1fr;
            }
            .table-container {
                overflow-x: auto;
            }
        }

        <?= $this->renderSection('styles') ?>
    </style>
</head>
<body>

<!-- ========== TOP BAR ========== -->
<div class="top-bar">
    <div class="top-bar-inner">
        <div class="top-bar-left">
            <span><i class="fas fa-circle"></i> NIRDA Industrial Intelligence Platform</span>
            <span><i class="fas fa-calendar-alt"></i> <?= date('F d, Y') ?></span>
        </div>
        <div class="top-bar-right">
            <a href="#"><i class="fas fa-envelope"></i> support@aiiiis.rw</a>
            <a href="#"><i class="fas fa-phone-alt"></i> +250 788 123 456</a>
            <select class="lang-select">
                <option>EN</option>
                <option>FR</option>
                <option>KIN</option>
            </select>
        </div>
    </div>
</div>

<!-- ========== ADMIN WRAPPER ========== -->
<div class="admin-wrapper">

    <!-- Sidebar Overlay (mobile) -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- ========== SIDEBAR ========== -->
    <!-- ========== SIDEBAR ========== -->
<aside class="admin-sidebar" id="adminSidebar">
    <div class="sidebar-brand">
        <div class="brand">
            <div class="brand-icon">AI</div>
            <div class="brand-text">AIIIIS<span>.</span></div>
        </div>
    </div>

    <div class="sidebar-user">
        <div class="avatar"><?= strtoupper(substr($user['name'] ?? 'U', 0, 1)) ?></div>
        <div class="user-info">
            <div class="name"><?= $user['name'] ?? 'User' ?></div>
            <div class="role"><?= ucfirst(str_replace('_', ' ', $user['role'] ?? 'user')) ?></div>
        </div>
    </div>

    <ul class="sidebar-menu">
        <?php 
        // Load admin menu helper
        $adminMenuHelper = helper('admin_menu');
        $menus = get_admin_menu($user['role'] ?? 'enterprise');
        $currentUri = current_url();
        
        foreach ($menus as $menu): 
            $isActive = is_menu_active($menu['active'], $currentUri);
        ?>
            <li>
                <a href="<?= base_url($menu['route']) ?>" class="<?= $isActive ? 'active' : '' ?>">
                    <i class="fas <?= $menu['icon'] ?>"></i>
                    <?= $menu['label'] ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>

    <div class="sidebar-footer">
        <a href="<?= base_url('logout') ?>">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>
    </div>
</aside>

    <!-- ========== MAIN CONTENT ========== -->
    <main class="admin-content">
        <div class="content-header">
            <div>
                <h1><?= $page_title ?? 'Dashboard' ?></h1>
                <div class="breadcrumb">
                    <?= $page_title ?? 'Dashboard' ?>
                    <?php if (isset($breadcrumb)): ?>
                        <span> / <?= $breadcrumb ?></span>
                    <?php endif; ?>
                </div>
            </div>
            <button class="mobile-toggle-sidebar" id="mobileToggleSidebar">
                <i class="fas fa-bars"></i>
            </button>
        </div>

        <?= $this->renderSection('content') ?>
    </main>
</div>

<!-- ========== SCRIPTS ========== -->
<script>
    // Mobile sidebar toggle
    const mobileToggle = document.getElementById('mobileToggleSidebar');
    const sidebar = document.getElementById('adminSidebar');
    const overlay = document.getElementById('sidebarOverlay');

    if (mobileToggle) {
        mobileToggle.addEventListener('click', function() {
            sidebar.classList.toggle('open');
            overlay.classList.toggle('active');
        });
    }

    if (overlay) {
        overlay.addEventListener('click', function() {
            sidebar.classList.remove('open');
            overlay.classList.remove('active');
        });
    }

    // Close sidebar on window resize (desktop)
    window.addEventListener('resize', function() {
        if (window.innerWidth > 992) {
            sidebar.classList.remove('open');
            overlay.classList.remove('active');
        }
    });
</script>

<?= $this->renderSection('scripts') ?>

</body>
</html>