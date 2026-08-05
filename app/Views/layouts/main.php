<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'AIIIIS — Industrial Innovation & Investment Intelligence System' ?></title>
    <meta name="description" content="<?= $meta_description ?? 'Enterprise mapping, investment matchmaking, and industrial intelligence for Rwanda\'s industrial development.' ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=IBM+Plex+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        /* ========== ROOT VARIABLES ========== */
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
        }

        /* ========== RESET ========== */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            font-family: 'Inter', -apple-system, sans-serif;
            color: var(--ink);
            background: var(--surface);
            line-height: 1.6;
        }
        a { text-decoration: none; color: inherit; transition: var(--transition); }
        .container { max-width: 1320px; margin: 0 auto; padding: 0 2.5rem; }
        @media (max-width: 768px) { .container { padding: 0 1.25rem; } }

        /* ========== TOP BAR ========== */
        .top-bar {
            background: var(--ink);
            color: rgba(255,255,255,0.7);
            padding: 0.4rem 0;
            font-size: 0.7rem;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }
        .top-bar-inner {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 0.5rem;
        }
        .top-bar-left {
            display: flex;
            align-items: center;
            gap: 2rem;
        }
        .top-bar-left span {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .top-bar-left i {
            font-size: 0.55rem;
            color: var(--primary);
        }
        .top-bar-right {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }
        .top-bar-right a {
            color: rgba(255,255,255,0.6);
            transition: var(--transition);
            font-size: 0.7rem;
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }
        .top-bar-right a:hover { color: #fff; }
        .top-bar-right .lang-select {
            background: transparent;
            border: none;
            color: rgba(255,255,255,0.6);
            font-size: 0.7rem;
            cursor: pointer;
            font-family: 'Inter', sans-serif;
            padding: 0.2rem 0.6rem;
            border-radius: 4px;
        }
        .top-bar-right .lang-select:hover { color: #fff; }
        .top-bar-right .lang-select option { color: var(--ink); background: #fff; }
        @media (max-width: 768px) {
            .top-bar-inner { flex-direction: column; align-items: flex-start; gap: 0.25rem; }
            .top-bar-left { flex-wrap: wrap; gap: 0.75rem; }
            .top-bar-right { flex-wrap: wrap; gap: 0.75rem; }
        }

        /* ========== NAVIGATION ========== */
        nav {
            position: sticky;
            top: 0;
            z-index: 1000;
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            box-shadow: var(--shadow-sm);
        }
        .nav-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.75rem 2.5rem;
            max-width: 1320px;
            margin: 0 auto;
            gap: 1rem;
        }
        .brand {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            flex-shrink: 0;
        }
        .brand-icon {
            width: 38px;
            height: 38px;
            border-radius: 8px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'IBM Plex Mono', monospace;
            font-weight: 700;
            font-size: 0.7rem;
            color: #fff;
            box-shadow: 0 4px 12px rgba(7, 142, 206, 0.25);
        }
        .brand-text {
            font-weight: 800;
            font-size: 1.05rem;
            letter-spacing: -0.02em;
            color: var(--ink);
        }
        .brand-text span { color: var(--primary); }
        .nav-main {
            display: flex;
            align-items: center;
            gap: 0.1rem;
            flex: 1;
            justify-content: center;
        }
        .nav-main > a {
            padding: 0.5rem 1rem;
            font-size: 0.82rem;
            font-weight: 500;
            color: var(--ink-muted);
            border-radius: var(--radius);
            transition: var(--transition);
            white-space: nowrap;
        }
        .nav-main > a:hover { color: var(--ink); background: var(--canvas); }
        .nav-main > a.active { color: var(--primary); background: var(--primary-light); }
        .nav-main .has-dropdown { position: relative; }
        .nav-main .has-dropdown > a {
            display: flex;
            align-items: center;
            gap: 0.3rem;
            padding: 0.5rem 1rem;
        }
        .nav-main .has-dropdown > a i {
            font-size: 0.5rem;
            opacity: 0.5;
            transition: var(--transition);
        }
        .nav-main .has-dropdown:hover > a i { transform: rotate(180deg); }

        .dropdown {
            position: absolute;
            top: calc(100% + 4px);
            left: 50%;
            transform: translateX(-50%);
            min-width: 220px;
            max-width: 280px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            box-shadow: var(--shadow-md);
            padding: 0.4rem 0;
            opacity: 0;
            visibility: hidden;
            transform: translateX(-50%) translateY(6px);
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 50;
        }
        .dropdown::before {
            content: '';
            position: absolute;
            top: -6px;
            left: 50%;
            transform: translateX(-50%);
            border-left: 6px solid transparent;
            border-right: 6px solid transparent;
            border-bottom: 6px solid var(--surface);
        }
        .has-dropdown:hover .dropdown {
            opacity: 1;
            visibility: visible;
            transform: translateX(-50%) translateY(0);
        }
        .dropdown a {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            padding: 0.35rem 1rem;
            font-size: 0.78rem;
            color: var(--ink-muted);
        }
        .dropdown a i {
            width: 16px;
            font-size: 0.7rem;
            color: var(--primary);
            opacity: 0.6;
            text-align: center;
        }
        .dropdown a:hover { color: var(--ink); background: var(--canvas); }
        .dropdown a:hover i { opacity: 1; }
        .dropdown .dropdown-divider {
            height: 1px;
            background: var(--border);
            margin: 0.2rem 0.75rem;
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            flex-shrink: 0;
        }
        .nav-actions .search-btn {
            background: none;
            border: none;
            color: var(--ink-muted);
            font-size: 0.9rem;
            cursor: pointer;
            padding: 0.4rem 0.6rem;
            border-radius: var(--radius);
        }
        .nav-actions .search-btn:hover { color: var(--ink); background: var(--canvas); }
        .btn-outline-nav {
            padding: 0.4rem 1.1rem;
            border: 1.5px solid var(--border);
            border-radius: var(--radius);
            font-size: 0.78rem;
            font-weight: 600;
            color: var(--ink);
            background: transparent;
            cursor: pointer;
        }
        .btn-outline-nav:hover {
            border-color: var(--primary);
            color: var(--primary);
            background: var(--primary-light);
        }
        .btn-primary-nav {
            padding: 0.4rem 1.3rem;
            border: none;
            border-radius: var(--radius);
            font-size: 0.78rem;
            font-weight: 600;
            color: #fff;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(7, 142, 206, 0.25);
        }
        .btn-primary-nav:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(7, 142, 206, 0.35);
        }
        .mobile-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.2rem;
            color: var(--ink);
            cursor: pointer;
            padding: 0.4rem;
        }

        @media (max-width: 1024px) {
            .nav-inner { padding: 0.6rem 1.25rem; }
            .nav-main > a { padding: 0.4rem 0.75rem; font-size: 0.78rem; }
        }
        @media (max-width: 992px) {
            .nav-main {
                display: none;
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background: var(--surface);
                flex-direction: column;
                padding: 1rem 1.5rem;
                gap: 0.25rem;
                border-bottom: 1px solid var(--border);
                box-shadow: var(--shadow-lg);
                max-height: 80vh;
                overflow-y: auto;
            }
            .nav-main.active { display: flex; }
            .nav-main > a { width: 100%; padding: 0.6rem 0.75rem; font-size: 0.85rem; }
            .has-dropdown .dropdown {
                position: static;
                transform: none;
                min-width: 100%;
                max-width: 100%;
                box-shadow: none;
                border: none;
                border-left: 2px solid var(--border);
                margin-left: 0.75rem;
                padding-left: 0.5rem;
                opacity: 1;
                visibility: visible;
                display: none;
                border-radius: 0;
            }
            .has-dropdown .dropdown::before { display: none; }
            .has-dropdown.active .dropdown { display: block; }
            .mobile-toggle { display: block; }
            .nav-actions .btn-outline-nav,
            .nav-actions .btn-primary-nav { display: none; }
        }
        @media (max-width: 480px) {
            .nav-inner { padding: 0.5rem 1rem; }
            .brand-text { font-size: 0.85rem; }
            .brand-icon { width: 32px; height: 32px; font-size: 0.6rem; }
        }

        /* ========== SECTION COMMON ========== */
        .section { padding: 4.5rem 0; }
        .section-alt { background: var(--canvas); }
        .section-header { max-width: 38rem; margin-bottom: 3rem; }
        .section-header .eyebrow {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 0.62rem;
            font-weight: 600;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--primary);
            display: inline-block;
            margin-bottom: 0.3rem;
        }
        .section-header h2 {
            font-size: 2rem;
            font-weight: 800;
            letter-spacing: -0.02em;
            margin: 0.4rem 0 0.6rem;
        }
        .section-header p {
            color: var(--ink-muted);
            font-size: 0.98rem;
            line-height: 1.7;
        }
        @media (max-width: 768px) {
            .section { padding: 3rem 0; }
            .section-header h2 { font-size: 1.5rem; }
        }

        /* ========== FOOTER ========== */
        footer {
            background: var(--ink);
            color: rgba(255,255,255,0.7);
            padding: 3rem 0 1.5rem;
        }
        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 3rem;
            padding-bottom: 2.5rem;
            border-bottom: 1px solid rgba(255,255,255,0.06);
        }
        .footer-brand h3 {
            color: #fff;
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 0.6rem;
        }
        .footer-brand h3 span { color: var(--primary); }
        .footer-brand p {
            font-size: 0.82rem;
            line-height: 1.7;
            max-width: 300px;
            opacity: 0.7;
        }
        .footer-col h4 {
            color: #fff;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            margin-bottom: 0.85rem;
        }
        .footer-col a {
            display: block;
            font-size: 0.8rem;
            color: rgba(255,255,255,0.6);
            padding: 0.25rem 0;
        }
        .footer-col a:hover { color: #fff; padding-left: 4px; }
        .footer-bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 1.75rem;
            font-size: 0.75rem;
            color: rgba(255,255,255,0.4);
            flex-wrap: wrap;
            gap: 0.5rem;
        }
        .footer-bottom-links {
            display: flex;
            gap: 1.75rem;
            align-items: center;
        }
        .footer-bottom-links a {
            color: rgba(255,255,255,0.4);
        }
        .footer-bottom-links a:hover { color: #fff; }
        .footer-bottom-links .social-link { font-size: 0.9rem; }
        @media (max-width: 860px) {
            .footer-grid { grid-template-columns: 1fr 1fr; gap: 2rem; }
            .footer-brand p { max-width: 100%; }
        }
        @media (max-width: 560px) {
            .footer-grid { grid-template-columns: 1fr; gap: 1.5rem; }
            .footer-bottom { flex-direction: column; text-align: center; }
            .footer-bottom-links { flex-wrap: wrap; justify-content: center; }
        }

        /* ========== PAGE SPECIFIC STYLES ========== */
        <?= $this->renderSection('styles') ?>
    </style>
</head>
<body>

<!-- ========== TOP BAR ========== -->
<div class="top-bar">
    <div class="container">
        <div class="top-bar-inner">
            <div class="top-bar-left">
                <span><i class="fas fa-circle"></i> NIRDA Industrial Intelligence Platform</span>
                <span><i class="fas fa-calendar-alt"></i> Updated: August 2026</span>
                <span><i class="fas fa-users"></i> 1,200+ registered enterprises</span>
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
</div>

<!-- ========== NAVIGATION ========== -->
<nav>
    <div class="nav-inner">
        <div class="brand">
            <div class="brand-icon">AI</div>
            <div class="brand-text">AIIIIS<span>.</span></div>
        </div>

        <div class="nav-main" id="navMain">
            <a href="<?= base_url() ?>" class="<?= $active_page == 'dashboard' ? 'active' : '' ?>">Dashboard</a>

            <div class="has-dropdown">
                <a href="#">Enterprises <i class="fas fa-chevron-down"></i></a>
                <div class="dropdown">
                    <a href="#"><i class="fas fa-building"></i> Enterprise Directory</a>
                    <a href="#"><i class="fas fa-check-circle"></i> Verification Queue</a>
                    <div class="dropdown-divider"></div>
                    <a href="#"><i class="fas fa-map-marked-alt"></i> GIS Map View</a>
                    <a href="#"><i class="fas fa-chart-pie"></i> Sector Clusters</a>
                    <a href="#"><i class="fas fa-trophy"></i> Enterprise Ranking</a>
                </div>
            </div>

            <div class="has-dropdown">
                <a href="#">Investors <i class="fas fa-chevron-down"></i></a>
                <div class="dropdown">
                    <a href="#"><i class="fas fa-users"></i> Investor Directory</a>
                    <a href="#"><i class="fas fa-handshake"></i> Matchmaking Engine</a>
                    <a href="#"><i class="fas fa-file-signature"></i> Deal Tracking</a>
                    <div class="dropdown-divider"></div>
                    <a href="#"><i class="fas fa-rocket"></i> Opportunities</a>
                    <a href="#"><i class="fas fa-chart-line"></i> Portfolio View</a>
                </div>
            </div>

            <a href="#">Analytics</a>

            <div class="has-dropdown">
                <a href="#">Engagement <i class="fas fa-chevron-down"></i></a>
                <div class="dropdown">
                    <a href="#"><i class="fas fa-user-tie"></i> Expert Directory</a>
                    <a href="#"><i class="fas fa-calendar-check"></i> Advisory Requests</a>
                    <a href="#"><i class="fas fa-headset"></i> Helpdesk</a>
                    <div class="dropdown-divider"></div>
                    <a href="#"><i class="fas fa-clipboard-list"></i> Visit Reports</a>
                    <a href="#"><i class="fas fa-history"></i> Engagement History</a>
                </div>
            </div>

            <div class="has-dropdown">
                <a href="#">Reports <i class="fas fa-chevron-down"></i></a>
                <div class="dropdown">
                    <a href="#"><i class="fas fa-file-pdf"></i> Enterprise Reports</a>
                    <a href="#"><i class="fas fa-file-pdf"></i> Investment Reports</a>
                    <a href="#"><i class="fas fa-file-pdf"></i> Sector Reports</a>
                    <div class="dropdown-divider"></div>
                    <a href="#"><i class="fas fa-file-pdf"></i> Cluster Reports</a>
                    <a href="#"><i class="fas fa-file-pdf"></i> Policy Intelligence</a>
                </div>
            </div>
        </div>

        <div class="nav-actions">
            <button class="search-btn"><i class="fas fa-search"></i></button>
            <a href="<?= base_url('login') ?>" class="btn-outline-nav">Sign in</a>
            <a href="<?= base_url('register') ?>" class="btn-primary-nav">Register</a>
            <button class="mobile-toggle" id="mobileToggle"><i class="fas fa-bars"></i></button>
        </div>
    </div>
</nav>

<!-- ========== MAIN CONTENT ========== -->
<main>
    <?= $this->renderSection('content') ?>
</main>

<!-- ========== FOOTER ========== -->
<footer>
    <div class="container">
        <div class="footer-grid">
            <div class="footer-brand">
                <h3>AIIIIS<span>.</span></h3>
                <p>AI-Powered Industrial Innovation and Investment Intelligence System — supporting Rwanda's industrial transformation through data-driven decision making.</p>
            </div>
            <div class="footer-col">
                <h4>Platform</h4>
                <a href="#">Enterprise Directory</a>
                <a href="#">GIS Mapping</a>
                <a href="#">Ranking System</a>
                <a href="#">Matchmaking Engine</a>
                <a href="#">Analytics</a>
            </div>
            <div class="footer-col">
                <h4>For</h4>
                <a href="#">Enterprises</a>
                <a href="#">Investors</a>
                <a href="#">NIRDA Experts</a>
                <a href="#">Government</a>
                <a href="#">Financial Institutions</a>
            </div>
            <div class="footer-col">
                <h4>Support</h4>
                <a href="#">Helpdesk</a>
                <a href="#">Documentation</a>
                <a href="#">Contact Us</a>
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Service</a>
            </div>
        </div>

        <div class="footer-bottom">
            <span>&copy; 2026 AIIIIS — National Industrial Research and Development Agency (NIRDA)</span>
            <div class="footer-bottom-links">
                <a href="#">Privacy</a>
                <a href="#">Terms</a>
                <a href="#">Accessibility</a>
                <a href="#" class="social-link"><i class="fab fa-linkedin-in"></i></a>
                <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                <a href="#" class="social-link"><i class="fab fa-youtube"></i></a>
            </div>
        </div>
    </div>
</footer>

<!-- ========== SCRIPTS ========== -->
<script>
    const mobileToggle = document.getElementById('mobileToggle');
    const navMain = document.getElementById('navMain');

    if (mobileToggle && navMain) {
        mobileToggle.addEventListener('click', function() {
            navMain.classList.toggle('active');
            const icon = this.querySelector('i');
            icon.classList.toggle('fa-bars');
            icon.classList.toggle('fa-times');
        });

        document.querySelectorAll('.nav-main > a, .dropdown a').forEach(link => {
            link.addEventListener('click', function() {
                navMain.classList.remove('active');
                if (mobileToggle) {
                    const icon = mobileToggle.querySelector('i');
                    icon.classList.add('fa-bars');
                    icon.classList.remove('fa-times');
                }
            });
        });

        document.querySelectorAll('.has-dropdown > a').forEach(item => {
            item.addEventListener('click', function(e) {
                if (window.innerWidth <= 992) {
                    e.preventDefault();
                    this.parentElement.classList.toggle('active');
                }
            });
        });

        document.addEventListener('click', function(e) {
            if (!e.target.closest('.has-dropdown')) {
                document.querySelectorAll('.has-dropdown.active').forEach(el => {
                    el.classList.remove('active');
                });
            }
        });
    }
</script>

<!-- ========== PAGE SPECIFIC SCRIPTS ========== -->
<?= $this->renderSection('scripts') ?>

</body>
</html>