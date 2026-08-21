<!DOCTYPE html>
<html lang="en" data-theme="<?= $themePreference ?? 'light' ?>">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="<?= csrf_hash() ?>">

    <title><?= $title ?? 'Admin Dashboard — AIIIIS' ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=IBM+Plex+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        /* ========== CSS VARIABLES ========== */
        :root {
            --primary: #078ece;
            --primary-dark: #045a86;
            --primary-light: #e6f4fb;
            --primary-gradient: linear-gradient(135deg, #078ece 0%, #045a86 100%);
            --canvas: #f4f5f6;
            --surface: #ffffff;
            --surface-hover: #f8f9fa;
            --ink: #1a2332;
            --ink-muted: #5c6b74;
            --border: #e3e7ea;
            --border-light: #eef0f2;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.06);
            --shadow-md: 0 4px 20px rgba(0,0,0,0.08);
            --shadow-lg: 0 8px 40px rgba(4, 90, 134, 0.12);
            --shadow-xl: 0 12px 60px rgba(0,0,0,0.15);
            --radius: 8px;
            --radius-lg: 14px;
            --transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            --sidebar-width: 280px;
            --sidebar-collapsed-width: 70px;
            --header-height: 64px;
            --footer-height: 56px;
            --topbar-height: 38px;
            --scrollbar-track: #f1f1f1;
            --scrollbar-thumb: #c1c1c1;
            --scrollbar-thumb-hover: #a8a8a8;
            --badge-bg: var(--primary);
            --badge-text: #fff;
            --overlay-bg: rgba(0,0,0,0.3);
            --overlay-blur: blur(4px);
            --scrollbar-width: 6px;
        }

        /* ========== DARK MODE ========== */
        [data-theme="dark"] {
            --canvas: #0f1117;
            --surface: #1a1d27;
            --surface-hover: #242836;
            --ink: #e8edf5;
            --ink-muted: #8b95a9;
            --border: #2d3344;
            --border-light: #252b3a;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.3);
            --shadow-md: 0 4px 20px rgba(0,0,0,0.4);
            --shadow-lg: 0 8px 40px rgba(0,0,0,0.5);
            --shadow-xl: 0 12px 60px rgba(0,0,0,0.6);
            --primary-light: #0a2a3a;
            --primary-gradient: linear-gradient(135deg, #078ece 0%, #045a86 100%);
            --scrollbar-track: #1a1d27;
            --scrollbar-thumb: #2d3344;
            --scrollbar-thumb-hover: #3d4459;
            --badge-bg: var(--primary);
            --badge-text: #fff;
            --overlay-bg: rgba(0,0,0,0.6);
            --overlay-blur: blur(4px);
        }

        /* ========== RESET & BASE ========== */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', -apple-system, sans-serif;
            background: var(--canvas);
            color: var(--ink);
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
            overflow-x: hidden;
            height: 100vh;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        a { text-decoration: none; color: inherit; }

        /* ========== CUSTOM SCROLLBAR ========== */
        ::-webkit-scrollbar {
            width: var(--scrollbar-width);
            height: var(--scrollbar-width);
        }
        ::-webkit-scrollbar-track {
            background: var(--scrollbar-track);
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb {
            background: var(--scrollbar-thumb);
            border-radius: 10px;
            transition: background 0.3s ease;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: var(--scrollbar-thumb-hover);
        }
        ::-webkit-scrollbar-corner {
            background: var(--scrollbar-track);
        }

        /* Firefox scrollbar */
        * {
            scrollbar-width: thin;
            scrollbar-color: var(--scrollbar-thumb) var(--scrollbar-track);
        }

        /* ========== APP CONTAINER ========== */
        .app-container {
            display: flex;
            flex-direction: column;
            height: 100vh;
            overflow: hidden;
        }

        /* ========== TOP BAR ========== */
        .top-bar {
            background: var(--ink);
            color: rgba(255,255,255,0.7);
            padding: 0.3rem 0;
            font-size: 0.65rem;
            border-bottom: 1px solid rgba(255,255,255,0.05);
            flex-shrink: 0;
            height: var(--topbar-height);
            display: flex;
            align-items: center;
            z-index: 1001;
            transition: background-color 0.3s ease;
        }
        [data-theme="dark"] .top-bar { background: #0a0c12; }
        .top-bar-inner {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 0.5rem;
            padding: 0 2rem;
            width: 100%;
        }
        .top-bar-left { display: flex; align-items: center; gap: 1.5rem; }
        .top-bar-left span { display: flex; align-items: center; gap: 0.4rem; }
        .top-bar-left i { font-size: 0.45rem; color: var(--primary); }
        .top-bar-right { display: flex; align-items: center; gap: 1rem; }
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

        /* ========== MAIN LAYOUT ========== */
        .main-layout {
            display: flex;
            flex: 1;
            overflow: hidden;
        }

        /* ========== SIDEBAR ========== */
        .sidebar {
            width: var(--sidebar-width);
            background: var(--surface);
            border-right: 1px solid var(--border);
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            transition: width 0.3s ease, transform 0.3s ease, background-color 0.3s ease, border-color 0.3s ease;
            z-index: 1000;
            overflow: hidden;
            height: 100%;
        }
        .sidebar.collapsed { width: var(--sidebar-collapsed-width); }

        /* Sidebar Brand */
        .sidebar-brand {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid var(--border);
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: padding 0.3s ease, border-color 0.3s ease;
        }
        .sidebar.collapsed .sidebar-brand { padding: 1rem 0.75rem; justify-content: center; }
        .sidebar-brand .brand { display: flex; align-items: center; gap: 0.65rem; }
        .sidebar-brand .brand-icon {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            background: var(--primary-gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'IBM Plex Mono', monospace;
            font-weight: 700;
            font-size: 0.65rem;
            color: #fff;
            box-shadow: 0 4px 12px rgba(7, 142, 206, 0.25);
            flex-shrink: 0;
        }
        .sidebar-brand .brand-text {
            font-weight: 800;
            font-size: 1rem;
            letter-spacing: -0.02em;
            color: var(--ink);
            white-space: nowrap;
            transition: color 0.3s ease;
        }
        .sidebar-brand .brand-text span { color: var(--primary); }
        .sidebar.collapsed .sidebar-brand .brand-text { display: none; }

        .sidebar-brand .collapse-toggle {
            background: none;
            border: none;
            color: var(--ink-muted);
            cursor: pointer;
            padding: 0.3rem;
            border-radius: var(--radius);
            transition: var(--transition);
            font-size: 0.9rem;
            flex-shrink: 0;
        }
        .sidebar-brand .collapse-toggle:hover { background: var(--canvas); color: var(--ink); }
        .sidebar-brand .collapse-toggle .hamburger-icon {
            display: flex;
            flex-direction: column;
            gap: 3px;
            width: 18px;
            height: 14px;
            justify-content: center;
        }
        .sidebar-brand .collapse-toggle .hamburger-icon span {
            display: block;
            width: 100%;
            height: 2px;
            background: var(--ink-muted);
            border-radius: 2px;
            transition: var(--transition);
        }
        .sidebar-brand .collapse-toggle:hover .hamburger-icon span { background: var(--ink); }
        .sidebar.collapsed .sidebar-brand .collapse-toggle { margin: 0; }

        /* ========== SIDEBAR NAVIGATION ========== */
        .sidebar-nav {
            flex: 1;
            overflow-y: auto;
            padding: 0.5rem 0.75rem;
        }
        .sidebar.collapsed .sidebar-nav { padding: 0.5rem 0.25rem; }

        .nav-item {
            margin-bottom: 2px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.5rem 0.75rem;
            color: var(--ink-muted);
            font-size: 0.82rem;
            font-weight: 500;
            border-radius: var(--radius);
            transition: all 0.2s ease;
            cursor: pointer;
            white-space: nowrap;
            position: relative;
            text-decoration: none;
            width: 100%;
            background: transparent;
            border: none;
            font-family: 'Inter', sans-serif;
            text-align: left;
        }
        .nav-link:hover {
            color: var(--ink);
            background: var(--canvas);
        }
        .nav-link.active {
            color: var(--primary);
            background: var(--primary-light);
        }
        .nav-link i {
            width: 18px;
            font-size: 0.85rem;
            text-align: center;
            flex-shrink: 0;
        }
        .nav-link .badge {
            margin-left: auto;
            background: var(--badge-bg);
            color: var(--badge-text);
            font-size: 0.55rem;
            font-weight: 600;
            padding: 0.05rem 0.5rem;
            border-radius: 20px;
            flex-shrink: 0;
        }
        .nav-link .toggle-icon {
            margin-left: auto;
            transition: all 0.3s ease;
            font-size: 0.7rem;
            flex-shrink: 0;
            color: var(--ink-muted);
            width: 18px;
            text-align: center;
            font-weight: 700;
        }
        .nav-link .toggle-icon.open {
            transform: rotate(45deg);
            color: var(--primary);
        }

        /* Submenu wrapper */
        .submenu-wrapper {
            position: relative;
            overflow: hidden;
            max-height: 0;
            transition: max-height 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .submenu-wrapper.open {
            max-height: 800px;
        }

        /* Connection line */
        .submenu-wrapper::before {
            content: '';
            position: absolute;
            left: 22px;
            top: 0;
            bottom: 0;
            width: 1.5px;
            background: var(--border);
            opacity: 0;
            transition: opacity 0.4s ease;
        }
        .submenu-wrapper.open::before {
            opacity: 0.6;
        }

        /* Submenu list */
        .submenu {
            list-style: none;
            padding: 0.25rem 0 0.25rem 2.2rem;
            position: relative;
        }

        /* Submenu item */
        .submenu li {
            position: relative;
            margin-bottom: 1px;
        }

        /* Horizontal connection line */
        .submenu li::before {
            content: '';
            position: absolute;
            left: -1.5rem;
            top: 50%;
            width: 1.2rem;
            height: 1.5px;
            background: var(--border);
            opacity: 0;
            transition: opacity 0.4s ease;
        }
        .submenu-wrapper.open .submenu li::before {
            opacity: 0.5;
        }

        /* Connection dot */
        .submenu li::after {
            content: '';
            position: absolute;
            left: -0.1rem;
            top: 50%;
            transform: translateY(-50%) scale(0);
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: var(--border);
            transition: all 0.3s ease;
        }
        .submenu-wrapper.open .submenu li::after {
            transform: translateY(-50%) scale(1);
            opacity: 0.8;
        }
        .submenu-wrapper.open .submenu li:hover::after {
            background: var(--primary);
            opacity: 1;
            transform: translateY(-50%) scale(1.3);
        }

        /* Submenu link */
        .submenu li a {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            padding: 0.35rem 0.75rem;
            font-size: 0.75rem;
            color: var(--ink-muted);
            border-radius: var(--radius);
            transition: all 0.2s ease;
            text-decoration: none;
            position: relative;
        }
        .submenu li a:hover {
            color: var(--ink);
            background: var(--canvas);
            padding-left: 0.9rem;
        }
        .submenu li a.active {
            color: var(--primary);
            background: var(--primary-light);
        }
        .submenu li a i {
            width: 14px;
            font-size: 0.6rem;
            text-align: center;
            flex-shrink: 0;
            color: var(--ink-muted);
            opacity: 0.5;
        }
        .submenu li a.active i {
            color: var(--primary);
            opacity: 1;
        }
        .submenu li a .sub-badge {
            margin-left: auto;
            font-size: 0.45rem;
            font-weight: 600;
            padding: 0.05rem 0.4rem;
            border-radius: 10px;
            background: var(--primary-light);
            color: var(--primary);
            flex-shrink: 0;
        }
        [data-theme="dark"] .submenu li a .sub-badge {
            background: #1a2a4a;
            color: #64b5f6;
        }

        /* Collapsed sidebar */
        .sidebar.collapsed .nav-link span,
        .sidebar.collapsed .nav-link .badge,
        .sidebar.collapsed .nav-link .toggle-icon {
            display: none;
        }
        .sidebar.collapsed .nav-link {
            justify-content: center;
            padding: 0.5rem;
        }
        .sidebar.collapsed .nav-link i {
            width: auto;
            font-size: 1.1rem;
            margin: 0;
        }
        .sidebar.collapsed .submenu-wrapper {
            max-height: 0 !important;
        }
        .sidebar.collapsed .submenu-wrapper::before,
        .sidebar.collapsed .submenu li::before,
        .sidebar.collapsed .submenu li::after {
            display: none !important;
        }

        /* Tooltip for collapsed */
        .sidebar.collapsed .nav-link[data-tooltip]:hover::after {
            content: attr(data-tooltip);
            position: absolute;
            left: calc(var(--sidebar-collapsed-width) + 10px);
            top: 50%;
            transform: translateY(-50%);
            background: var(--ink);
            color: var(--canvas);
            padding: 0.3rem 0.8rem;
            border-radius: var(--radius);
            font-size: 0.75rem;
            white-space: nowrap;
            z-index: 1002;
            box-shadow: var(--shadow-md);
        }

        /* ========== SIDEBAR FOOTER ========== */
        .sidebar-footer {
            padding: 0.75rem 1.5rem;
            border-top: 1px solid var(--border);
            flex-shrink: 0;
            transition: padding 0.3s ease, border-color 0.3s ease;
        }
        .sidebar.collapsed .sidebar-footer { padding: 0.75rem 0.5rem; }

        .sidebar-footer .theme-toggle-wrapper {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.4rem 0.75rem;
            border-radius: var(--radius);
            transition: var(--transition);
            cursor: pointer;
            margin-bottom: 0.5rem;
        }
        .sidebar-footer .theme-toggle-wrapper:hover { background: var(--canvas); }
        .sidebar.collapsed .sidebar-footer .theme-toggle-wrapper { justify-content: center; padding: 0.4rem 0.5rem; }
        .sidebar-footer .theme-toggle-wrapper .theme-icon {
            width: 18px;
            font-size: 0.85rem;
            text-align: center;
            flex-shrink: 0;
            color: var(--ink-muted);
        }
        .sidebar-footer .theme-toggle-wrapper .theme-label {
            font-size: 0.82rem;
            font-weight: 500;
            color: var(--ink-muted);
            white-space: nowrap;
        }
        .sidebar-footer .theme-toggle-wrapper:hover .theme-label { color: var(--ink); }
        .sidebar.collapsed .sidebar-footer .theme-toggle-wrapper .theme-label { display: none; }

        .sidebar-footer .theme-toggle-wrapper .theme-toggle-switch {
            margin-left: auto;
            width: 40px;
            height: 22px;
            background: var(--border);
            border-radius: 11px;
            position: relative;
            transition: var(--transition);
            flex-shrink: 0;
            cursor: pointer;
        }
        .sidebar.collapsed .sidebar-footer .theme-toggle-wrapper .theme-toggle-switch { margin-left: 0; }
        .sidebar-footer .theme-toggle-wrapper .theme-toggle-switch .toggle-slider {
            position: absolute;
            top: 2px;
            left: 2px;
            width: 18px;
            height: 18px;
            background: var(--surface);
            border-radius: 50%;
            transition: var(--transition);
            box-shadow: var(--shadow-sm);
        }
        [data-theme="dark"] .sidebar-footer .theme-toggle-wrapper .theme-toggle-switch { background: var(--primary); }
        [data-theme="dark"] .sidebar-footer .theme-toggle-wrapper .theme-toggle-switch .toggle-slider {
            left: 20px;
            background: #fff;
        }

        .sidebar-footer .divider {
            height: 1px;
            background: var(--border);
            margin: 0.5rem 0;
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
        .sidebar.collapsed .sidebar-footer a { justify-content: center; }
        .sidebar.collapsed .sidebar-footer a span { display: none; }

        /* ========== CONTENT AREA ========== */
        .content-area {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            background: var(--canvas);
        }

        /* ========== HEADER ========== */
        .content-header {
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            padding: 0.75rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            min-height: var(--header-height);
            flex-shrink: 0;
            gap: 1rem;
        }
        .content-header .header-left {
            display: flex;
            align-items: center;
            gap: 1rem;
            flex: 1;
        }
        .content-header .header-toggle {
            background: none;
            border: none;
            font-size: 1.2rem;
            color: var(--ink-muted);
            cursor: pointer;
            padding: 0.4rem;
            border-radius: var(--radius);
            transition: var(--transition);
            display: none;
        }
        .content-header .header-toggle:hover { background: var(--canvas); color: var(--ink); }

        .content-header .header-search {
            display: flex;
            align-items: center;
            background: var(--canvas);
            border-radius: var(--radius);
            padding: 0.3rem 0.75rem;
            border: 1px solid var(--border);
            transition: var(--transition);
            flex: 1;
            max-width: 400px;
        }
        .content-header .header-search:focus-within {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(7, 142, 206, 0.1);
        }
        .content-header .header-search input {
            border: none;
            background: transparent;
            padding: 0.4rem 0.5rem;
            font-size: 0.82rem;
            color: var(--ink);
            width: 100%;
            outline: none;
        }
        .content-header .header-search input::placeholder { color: var(--ink-muted); }
        .content-header .header-search i { color: var(--ink-muted); font-size: 0.85rem; }

        .content-header .header-right {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            flex-shrink: 0;
        }
        .content-header .header-btn {
            background: none;
            border: none;
            color: var(--ink-muted);
            font-size: 1rem;
            cursor: pointer;
            padding: 0.4rem 0.6rem;
            border-radius: var(--radius);
            transition: var(--transition);
            position: relative;
        }
        .content-header .header-btn:hover { background: var(--canvas); color: var(--ink); }
        .content-header .header-btn .badge-dot {
            position: absolute;
            top: 4px;
            right: 4px;
            width: 8px;
            height: 8px;
            background: #c62828;
            border-radius: 50%;
            border: 2px solid var(--surface);
        }

        .content-header .header-profile {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
            padding: 0.3rem 0.6rem;
            border-radius: var(--radius);
            transition: var(--transition);
        }
        .content-header .header-profile:hover { background: var(--canvas); }
        .content-header .header-profile .avatar-sm {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: var(--primary-gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 700;
            font-size: 0.75rem;
            flex-shrink: 0;
        }
        .content-header .header-profile .profile-info {
            display: flex;
            flex-direction: column;
            line-height: 1.2;
        }
        .content-header .header-profile .profile-info .name {
            font-size: 0.78rem;
            font-weight: 600;
            color: var(--ink);
        }
        .content-header .header-profile .profile-info .role {
            font-size: 0.6rem;
            color: var(--ink-muted);
        }
        .content-header .header-profile .chevron-down { font-size: 0.7rem; color: var(--ink-muted); }

        /* ========== PAGE CONTENT ========== */
        .page-content {
            flex: 1;
            overflow-y: auto;
            padding: 1.5rem 2rem 2rem;
        }
        .page-content::-webkit-scrollbar { width: 6px; }
        .page-content::-webkit-scrollbar-track { background: var(--scrollbar-track); }
        .page-content::-webkit-scrollbar-thumb { background: var(--scrollbar-thumb); border-radius: 10px; }
        .page-content::-webkit-scrollbar-thumb:hover { background: var(--scrollbar-thumb-hover); }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
            gap: 1rem;
        }
        .page-header h1 {
            font-size: 1.3rem;
            font-weight: 800;
            letter-spacing: -0.02em;
        }
        .page-header .breadcrumb {
            font-size: 0.78rem;
            color: var(--ink-muted);
        }
        .page-header .breadcrumb span { color: var(--ink); }

        /* ========== FOOTER ========== */
        .content-footer {
            background: var(--surface);
            border-top: 1px solid var(--border);
            padding: 0.75rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-shrink: 0;
            min-height: var(--footer-height);
            font-size: 0.75rem;
            color: var(--ink-muted);
        }
        .content-footer .footer-links { display: flex; gap: 1.5rem; }
        .content-footer .footer-links a { color: var(--ink-muted); transition: var(--transition); }
        .content-footer .footer-links a:hover { color: var(--primary); }

        /* ========== SIDEBAR OVERLAY ========== */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: var(--overlay-bg);
            z-index: 998;
            backdrop-filter: var(--overlay-blur);
        }
        .sidebar-overlay.active { display: block; }

        /* ========== RESPONSIVE ========== */
        @media (max-width: 992px) {
            .sidebar {
                position: fixed;
                left: calc(-1 * var(--sidebar-width));
                top: var(--topbar-height);
                height: calc(100vh - var(--topbar-height));
                z-index: 999;
                box-shadow: var(--shadow-lg);
                transition: left 0.3s ease, width 0.3s ease;
                width: var(--sidebar-width);
            }
            .sidebar.open { left: 0; }
            .sidebar.collapsed { width: var(--sidebar-width); }
            .sidebar.collapsed .sidebar-brand .brand-text,
            .sidebar.collapsed .sidebar-nav .nav-link span,
            .sidebar.collapsed .sidebar-nav .nav-link .badge,
            .sidebar.collapsed .sidebar-nav .nav-link .toggle-icon,
            .sidebar.collapsed .sidebar-footer a span,
            .sidebar.collapsed .sidebar-footer .theme-toggle-wrapper .theme-label {
                display: inline;
            }
            .sidebar.collapsed .nav-link {
                justify-content: flex-start;
                padding: 0.5rem 0.75rem;
            }
            .sidebar.collapsed .nav-link i { width: 18px; font-size: 0.85rem; }
            .sidebar.collapsed .sidebar-brand .brand { justify-content: flex-start; }
            .sidebar.collapsed .sidebar-footer a { justify-content: flex-start; }
            .sidebar.collapsed .sidebar-footer .theme-toggle-wrapper { justify-content: flex-start; padding: 0.4rem 0.75rem; }
            .sidebar.collapsed .sidebar-footer .theme-toggle-wrapper .theme-toggle-switch { margin-left: auto; }
            .sidebar.collapsed .submenu-wrapper { max-height: 0 !important; }
            .sidebar.collapsed .submenu-wrapper.open { max-height: 0 !important; }
            .content-header .header-toggle { display: block; }
            .page-content { padding: 1rem; }
            .content-header { padding: 0.5rem 1rem; }
            .content-footer { padding: 0.5rem 1rem; flex-direction: column; gap: 0.5rem; text-align: center; }
        }

        @media (max-width: 768px) {
            .content-header { flex-wrap: wrap; gap: 0.5rem; padding: 0.5rem; }
            .content-header .header-search { max-width: 100%; order: 3; flex-basis: 100%; }
            .content-header .header-right { gap: 0.3rem; }
            .page-content { padding: 0.75rem; }
            .page-header { flex-direction: column; align-items: flex-start; }
            .top-bar-inner { padding: 0 0.5rem; }
            .top-bar-left span:not(:first-child) { display: none; }
            .content-footer { padding: 0.5rem; font-size: 0.65rem; }
        }

        @media (max-width: 480px) {
            .sidebar { width: 280px; left: calc(-1 * 280px); }
            .sidebar.open { left: 0; }
            .content-header .header-right .header-btn:not(.header-profile) { display: none; }
            .content-header .header-profile .profile-info { display: none !important; }
            .top-bar-right a:not(:first-child) { display: none; }
            .content-footer { flex-direction: column; gap: 0.5rem; }
        }

        <?= $this->renderSection('styles') ?>
    </style>
</head>
<body>

<!-- ========== APP CONTAINER ========== -->
<div class="app-container">

    <!-- ========== MAIN LAYOUT ========== -->
    <div class="main-layout">

        <!-- Sidebar Overlay -->
        <div class="sidebar-overlay" id="sidebarOverlay"></div>

        <!-- ========== SIDEBAR ========== -->
        <aside class="sidebar" id="sidebar">
            <!-- Sidebar Brand -->
            <div class="sidebar-brand">
                <div class="brand">
                    <div class="brand-icon">AI</div>
                    <div class="brand-text">AIIIIS<span>.</span></div>
                </div>
                <button class="collapse-toggle" id="sidebarCollapseToggle" title="Toggle Sidebar">
                    <div class="hamburger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </button>
            </div>

            <!-- ========== SIDEBAR NAVIGATION ========== -->
            <nav class="sidebar-nav" id="sidebarNav">
                <?php 
                $menus = $menus ?? $userMenus ?? [];
                $currentUri = current_url();
                
                if (empty($menus)) {
                    $role = $user['role'] ?? $currentUser['role'] ?? session()->get('role') ?? 'enterprise';
                    if (!function_exists('get_admin_menu')) {
                        helper('admin_menu');
                    }
                    $menus = get_admin_menu($role);
                }
                
                foreach ($menus as $menu): 
                    $hasSubmenus = isset($menu['submenus']) && !empty($menu['submenus']);
                    $activePaths = $menu['active'] ?? [];
                    if (is_string($activePaths)) {
                        $activePaths = [$activePaths];
                    }
                    $isActive = false;
                    foreach ($activePaths as $path) {
                        if (strpos($currentUri, $path) !== false) {
                            $isActive = true;
                            break;
                        }
                    }
                    
                    $hasActiveSubmenu = false;
                    if ($hasSubmenus) {
                        foreach ($menu['submenus'] as $submenu) {
                            if (strpos($currentUri, $submenu['route']) !== false) {
                                $hasActiveSubmenu = true;
                                break;
                            }
                        }
                    }
                ?>
                    <div class="nav-item">
                        <?php if ($hasSubmenus): ?>
                            <button class="nav-link <?= ($isActive || $hasActiveSubmenu) ? 'active' : '' ?>" 
                                    onclick="toggleSubmenu(this)" 
                                    data-tooltip="<?= $menu['label'] ?>">
                                <i class="fas <?= $menu['icon'] ?>"></i>
                                <span><?= $menu['label'] ?></span>
                                <?php if (isset($menu['badge'])): ?>
                                    <span class="badge"><?= $menu['badge'] ?></span>
                                <?php endif; ?>
                                <span class="toggle-icon <?= ($isActive || $hasActiveSubmenu) ? 'open' : '' ?>">
                                    <?= ($isActive || $hasActiveSubmenu) ? '−' : '+' ?>
                                </span>
                            </button>
                            <div class="submenu-wrapper <?= ($isActive || $hasActiveSubmenu) ? 'open' : '' ?>">
                                <ul class="submenu">
                                    <?php foreach ($menu['submenus'] as $submenu): ?>
                                        <li>
                                            <a href="<?= base_url($submenu['route']) ?>" 
                                               class="<?= strpos($currentUri, $submenu['route']) !== false ? 'active' : '' ?>">
                                                <i class="fas <?= $submenu['icon'] ?? 'fa-circle' ?>"></i>
                                                <?= $submenu['label'] ?>
                                                <?php if (isset($submenu['badge'])): ?>
                                                    <span class="sub-badge"><?= $submenu['badge'] ?></span>
                                                <?php endif; ?>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php else: ?>
                            <a href="<?= base_url($menu['route']) ?>" 
                               class="nav-link <?= $isActive ? 'active' : '' ?>"
                               data-tooltip="<?= $menu['label'] ?>">
                                <i class="fas <?= $menu['icon'] ?>"></i>
                                <span><?= $menu['label'] ?></span>
                                <?php if (isset($menu['badge'])): ?>
                                    <span class="badge"><?= $menu['badge'] ?></span>
                                <?php endif; ?>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </nav>

            <!-- Sidebar Footer -->
            <div class="sidebar-footer">
                <div class="theme-toggle-wrapper" id="themeToggleWrapper">
                    <span class="theme-icon" id="themeIcon">
                        <i class="fas fa-sun" id="themeIconSun"></i>
                        <i class="fas fa-moon" id="themeIconMoon" style="display: none;"></i>
                    </span>
                    <span class="theme-label" id="themeLabel">Light Mode</span>
                    <div class="theme-toggle-switch" id="themeToggleSwitch">
                        <div class="toggle-slider"></div>
                    </div>
                </div>
                <div class="divider"></div>
                <a href="<?= base_url('logout') ?>">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </div>
        </aside>

        <!-- ========== CONTENT AREA ========== -->
        <div class="content-area">

            <!-- ========== HEADER ========== -->
            <header class="content-header">
                <div class="header-left">
                    <button class="header-toggle" id="headerToggleSidebar" title="Toggle Sidebar">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="header-search">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Search..." id="globalSearch">
                    </div>
                </div>
                <div class="header-right">
                    <button class="header-btn" title="Notifications">
                        <i class="fas fa-bell"></i>
                        <?php if (($notificationCount ?? 0) > 0): ?>
                            <span class="badge-dot"></span>
                        <?php endif; ?>
                    </button>
                    <button class="header-btn" title="Messages">
                        <i class="fas fa-envelope"></i>
                    </button>
                    <button class="header-btn" title="Settings">
                        <i class="fas fa-cog"></i>
                    </button>
                    <div class="header-profile" id="profileDropdown">
                        <div class="avatar-sm"><?= strtoupper(substr($user['name'] ?? $currentUser['name'] ?? 'U', 0, 1)) ?></div>
                        <div class="profile-info">
                            <div class="name"><?= $user['name'] ?? $currentUser['name'] ?? 'User' ?></div>
                            <div class="role"><?= ucfirst(str_replace('_', ' ', $user['role'] ?? $currentUser['role'] ?? 'user')) ?></div>
                        </div>
                        <i class="fas fa-chevron-down chevron-down"></i>
                    </div>
                </div>
            </header>

            <!-- ========== PAGE CONTENT ========== -->
            <main class="page-content">
                <div class="page-header">
                    <div>
                        <h1><?= $page_title ?? 'Dashboard' ?></h1>
                        <div class="breadcrumb">
                            <?= $page_title ?? 'Dashboard' ?>
                            <?php if (isset($breadcrumb)): ?>
                                <span> / <?= $breadcrumb ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <?= $this->renderSection('content') ?>
            </main>

            <!-- ========== FOOTER ========== -->
            <footer class="content-footer">
                <span>&copy; <?= date('Y') ?> AIIIIS. All rights reserved.</span>
                <div class="footer-links">
                    <a href="#">Privacy</a>
                    <a href="#">Terms</a>
                    <a href="#">Help</a>
                </div>
            </footer>

        </div>
    </div>
</div>

<!-- ========== SCRIPTS ========== -->
<script>
    // ========== THEME MANAGEMENT ==========
    const htmlElement = document.documentElement;
    const themeToggleWrapper = document.getElementById('themeToggleWrapper');
    const themeToggleSwitch = document.getElementById('themeToggleSwitch');
    const themeIconSun = document.getElementById('themeIconSun');
    const themeIconMoon = document.getElementById('themeIconMoon');
    const themeLabel = document.getElementById('themeLabel');

    // Get initial theme from HTML attribute or localStorage
    let currentTheme = htmlElement.getAttribute('data-theme') || localStorage.getItem('theme') || 'light';

    // Function to set theme
    function setTheme(theme) {
        currentTheme = theme;
        htmlElement.setAttribute('data-theme', theme);
        localStorage.setItem('theme', theme);
        updateThemeUI(theme);
        saveThemeToDatabase(theme);
    }

    // Function to update UI elements
    function updateThemeUI(theme) {
        if (theme === 'dark') {
            themeIconSun.style.display = 'none';
            themeIconMoon.style.display = 'inline';
            themeLabel.textContent = 'Dark Mode';
        } else {
            themeIconSun.style.display = 'inline';
            themeIconMoon.style.display = 'none';
            themeLabel.textContent = 'Light Mode';
        }
    }

    // Function to save theme to database
    function saveThemeToDatabase(theme) {
        console.log('Saving theme:', theme);
        
        // Get CSRF token
        const metaCsrf = document.querySelector('meta[name="csrf-token"]');
        let csrfHash = metaCsrf ? metaCsrf.getAttribute('content') : '';
        
        // Create FormData
        const formData = new FormData();
        formData.append('theme', theme);
        
        if (csrfHash) {
            formData.append('csrf_test_name', csrfHash);
        }

        fetch('<?= base_url('user/update-theme') ?>', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                console.log('Theme preference saved successfully');
                // Set cookie as backup
                document.cookie = "theme_preference=" + theme + "; path=/; max-age=" + (60*60*24*30);
            } else {
                console.error('Failed to save theme:', data.message);
            }
        })
        .catch(error => {
            console.error('Error saving theme preference:', error.message);
        });
    }

    // Theme toggle click handler
    themeToggleSwitch.addEventListener('click', function(e) {
        e.stopPropagation();
        const newTheme = currentTheme === 'light' ? 'dark' : 'light';
        setTheme(newTheme);
    });

    // Also allow clicking on the wrapper
    themeToggleWrapper.addEventListener('click', function(e) {
        // Don't trigger if the switch was clicked directly (to avoid double trigger)
        if (e.target.closest('.theme-toggle-switch')) {
            return;
        }
        const newTheme = currentTheme === 'light' ? 'dark' : 'light';
        setTheme(newTheme);
    });

    // Initialize theme on page load
    document.addEventListener('DOMContentLoaded', function() {
        // Check if theme is stored in localStorage
        const storedTheme = localStorage.getItem('theme');
        if (storedTheme) {
            setTheme(storedTheme);
        } else {
            // Use the HTML attribute value or default to light
            const htmlTheme = htmlElement.getAttribute('data-theme') || 'light';
            setTheme(htmlTheme);
        }
        updateThemeUI(currentTheme);
    });

    // ========== SIDEBAR TOGGLES ==========
    const sidebar = document.getElementById('sidebar');
    const sidebarOverlay = document.getElementById('sidebarOverlay');
    const headerToggle = document.getElementById('headerToggleSidebar');
    const collapseToggle = document.getElementById('sidebarCollapseToggle');
    let isCollapsed = false;

    function toggleSidebar() {
        sidebar.classList.toggle('open');
        sidebarOverlay.classList.toggle('active');
        if (sidebar.classList.contains('open')) {
            sidebar.classList.remove('collapsed');
            isCollapsed = false;
        }
    }

    function toggleSidebarCollapse() {
        if (window.innerWidth > 992) {
            sidebar.classList.toggle('collapsed');
            isCollapsed = sidebar.classList.contains('collapsed');
            localStorage.setItem('sidebarCollapsed', isCollapsed);
        } else {
            toggleSidebar();
        }
    }

    function closeSidebar() {
        sidebar.classList.remove('open');
        sidebarOverlay.classList.remove('active');
    }

    if (headerToggle) {
        headerToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            toggleSidebar();
        });
    }

    if (collapseToggle) {
        collapseToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            toggleSidebarCollapse();
        });
    }

    if (sidebarOverlay) {
        sidebarOverlay.addEventListener('click', closeSidebar);
    }

    window.addEventListener('resize', function() {
        if (window.innerWidth > 992) {
            closeSidebar();
            const savedState = localStorage.getItem('sidebarCollapsed');
            if (savedState === 'true') {
                sidebar.classList.add('collapsed');
                isCollapsed = true;
            } else {
                sidebar.classList.remove('collapsed');
                isCollapsed = false;
            }
        } else {
            if (sidebar.classList.contains('open')) {
                sidebar.classList.remove('collapsed');
                isCollapsed = false;
            }
        }
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && window.innerWidth <= 992) {
            closeSidebar();
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        if (window.innerWidth > 992) {
            const savedState = localStorage.getItem('sidebarCollapsed');
            if (savedState === 'true') {
                sidebar.classList.add('collapsed');
                isCollapsed = true;
            }
        }
    });

    // ========== SUBMENU TOGGLES ==========
    function toggleSubmenu(element) {
        if (sidebar.classList.contains('collapsed')) {
            return;
        }

        const navItem = element.closest('.nav-item');
        const submenuWrapper = navItem.querySelector('.submenu-wrapper');
        const toggleIcon = element.querySelector('.toggle-icon');
        
        if (submenuWrapper.classList.contains('open')) {
            submenuWrapper.classList.remove('open');
            if (toggleIcon) {
                toggleIcon.textContent = '+';
                toggleIcon.classList.remove('open');
            }
            return;
        }

        document.querySelectorAll('.submenu-wrapper.open').forEach(function(wrapper) {
            wrapper.classList.remove('open');
            const parentNavItem = wrapper.closest('.nav-item');
            if (parentNavItem) {
                const icon = parentNavItem.querySelector('.toggle-icon');
                if (icon) {
                    icon.textContent = '+';
                    icon.classList.remove('open');
                }
            }
        });

        submenuWrapper.classList.add('open');
        if (toggleIcon) {
            toggleIcon.textContent = '−';
            toggleIcon.classList.add('open');
        }
    }

    // Auto-expand active submenu on page load
    document.addEventListener('DOMContentLoaded', function() {
        const activeSubmenus = document.querySelectorAll('.submenu-wrapper.open');
        if (activeSubmenus.length > 1) {
            activeSubmenus.forEach(function(wrapper, index) {
                if (index > 0) {
                    wrapper.classList.remove('open');
                    const parentNavItem = wrapper.closest('.nav-item');
                    if (parentNavItem) {
                        const icon = parentNavItem.querySelector('.toggle-icon');
                        if (icon) {
                            icon.textContent = '+';
                            icon.classList.remove('open');
                        }
                    }
                }
            });
        }
    });

    // ========== SEARCH ==========
    const searchInput = document.getElementById('globalSearch');
    if (searchInput) {
        searchInput.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                const query = this.value.trim();
                if (query.length > 0) {
                    window.location.href = '/search?q=' + encodeURIComponent(query);
                }
            }
        });
    }

    // ========== PROFILE DROPDOWN ==========
    const profileDropdown = document.getElementById('profileDropdown');
    if (profileDropdown) {
        profileDropdown.addEventListener('click', function() {
            console.log('Profile clicked');
        });
    }

    // ========== HEADER BUTTONS ==========
    document.querySelectorAll('.content-header .header-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            console.log('Header button clicked:', this.title || 'Unknown');
        });
    });

    console.log('Admin layout loaded successfully');
</script>

<?= $this->renderSection('scripts') ?>

</body>
</html>