<?= $this->extend('layouts/main') ?>

<?= $this->section('styles') ?>
/* ========== DASHBOARD STYLES ========== */
.dashboard-container {
    display: flex;
    min-height: calc(100vh - 70px);
}

/* Sidebar */
.dashboard-sidebar {
    width: 280px;
    background: var(--surface);
    border-right: 1px solid var(--border);
    padding: 2rem 0;
    flex-shrink: 0;
    position: sticky;
    top: 70px;
    height: calc(100vh - 70px);
    overflow-y: auto;
}

.sidebar-user {
    padding: 0 1.5rem 1.5rem;
    border-bottom: 1px solid var(--border);
    margin-bottom: 1rem;
}

.sidebar-user .avatar {
    width: 56px;
    height: 56px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-weight: 700;
    font-size: 1.2rem;
    margin-bottom: 0.75rem;
}

.sidebar-user .user-name {
    font-weight: 700;
    font-size: 0.95rem;
    color: var(--ink);
}

.sidebar-user .user-role {
    font-size: 0.75rem;
    color: var(--ink-muted);
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.sidebar-menu {
    list-style: none;
    padding: 0;
}

.sidebar-menu li {
    margin-bottom: 0.25rem;
}

.sidebar-menu li a {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.6rem 1.5rem;
    color: var(--ink-muted);
    font-size: 0.85rem;
    font-weight: 500;
    transition: var(--transition);
    text-decoration: none;
    border-left: 3px solid transparent;
}

.sidebar-menu li a:hover {
    color: var(--ink);
    background: var(--canvas);
}

.sidebar-menu li a.active {
    color: var(--primary);
    background: var(--primary-light);
    border-left-color: var(--primary);
}

.sidebar-menu li a i {
    width: 20px;
    font-size: 0.9rem;
    text-align: center;
}

/* Main Content */
.dashboard-content {
    flex: 1;
    padding: 2rem;
    background: var(--canvas);
}

.dashboard-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
}

.dashboard-header h1 {
    font-size: 1.5rem;
    font-weight: 800;
    letter-spacing: -0.02em;
}

.dashboard-header .date {
    color: var(--ink-muted);
    font-size: 0.85rem;
}

/* Stats Grid */
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
    font-size: 1.5rem;
    color: var(--primary);
    margin-bottom: 0.5rem;
}

.stat-card .stat-number {
    font-size: 1.8rem;
    font-weight: 800;
    color: var(--ink);
    letter-spacing: -0.02em;
}

.stat-card .stat-label {
    font-size: 0.78rem;
    color: var(--ink-muted);
    font-weight: 500;
}

.stat-card .stat-change {
    display: inline-block;
    font-size: 0.7rem;
    font-weight: 600;
    padding: 0.15rem 0.5rem;
    border-radius: 20px;
    margin-top: 0.25rem;
}

.stat-change.positive {
    background: #e6f7ef;
    color: #22a67e;
}

.stat-change.negative {
    background: #fde8e8;
    color: #c62828;
}

@media (max-width: 992px) {
    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .dashboard-container {
        flex-direction: column;
    }
    
    .dashboard-sidebar {
        width: 100%;
        position: static;
        height: auto;
        border-right: none;
        border-bottom: 1px solid var(--border);
        padding: 1rem 0;
    }
    
    .sidebar-user {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 0 1.5rem;
        border-bottom: none;
        margin-bottom: 0.5rem;
    }
    
    .sidebar-user .avatar {
        width: 40px;
        height: 40px;
        font-size: 0.9rem;
        margin-bottom: 0;
    }
    
    .sidebar-menu {
        display: flex;
        overflow-x: auto;
        padding: 0 1rem;
        gap: 0.25rem;
    }
    
    .sidebar-menu li {
        margin-bottom: 0;
        white-space: nowrap;
    }
    
    .sidebar-menu li a {
        padding: 0.4rem 1rem;
        border-left: none;
        border-bottom: 3px solid transparent;
    }
    
    .sidebar-menu li a.active {
        border-left-color: transparent;
        border-bottom-color: var(--primary);
    }
    
    .dashboard-content {
        padding: 1.5rem;
    }
    
    .stats-grid {
        grid-template-columns: 1fr;
    }
}
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="dashboard-container">
    <!-- Sidebar -->
    <aside class="dashboard-sidebar">
        <div class="sidebar-user">
            <div class="avatar"><?= strtoupper(substr($name ?? 'U', 0, 1)) ?></div>
            <div class="user-name"><?= $name ?? 'User' ?></div>
            <div class="user-role"><?= ucfirst(str_replace('_', ' ', $role ?? 'user')) ?></div>
        </div>

        <ul class="sidebar-menu">
            <?php 
            $menuHelper = helper('menu');
            $menus = get_user_menu($role ?? 'enterprise');
            $currentUri = current_url();
            
            foreach ($menus as $menu): 
                $isActive = strpos($currentUri, $menu['route']) !== false;
            ?>
                <li>
                    <a href="<?= base_url($menu['route']) ?>" class="<?= $isActive ? 'active' : '' ?>">
                        <i class="fas <?= $menu['icon'] ?>"></i>
                        <?= $menu['label'] ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </aside>

    <!-- Main Content -->
    <main class="dashboard-content">
        <div class="dashboard-header">
            <h1>Dashboard</h1>
            <span class="date"><?= date('l, F d, Y') ?></span>
        </div>

        <!-- Stats Cards -->
        <div class="stats-grid" id="statsContainer">
            <!-- Stats will be loaded via AJAX -->
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-spinner fa-spin"></i></div>
                <div class="stat-number">Loading...</div>
                <div class="stat-label">Loading statistics</div>
            </div>
        </div>

        <!-- Welcome Section -->
        <div class="welcome-section" style="background:var(--surface);border:1px solid var(--border);border-radius:var(--radius);padding:2rem;">
            <h2 style="font-size:1.2rem;font-weight:700;margin-bottom:0.5rem;">Welcome back, <?= $name ?? 'User' ?>!</h2>
            <p style="color:var(--ink-muted);font-size:0.9rem;">
                <?php
                $roleGreetings = [
                    'administrator' => 'You have full access to manage the system, users, and all platform features.',
                    'nirda_expert' => 'You can manage enterprises, verify profiles, and track engagement activities.',
                    'enterprise' => 'Manage your profile, track your ranking, and explore investment opportunities.',
                    'investor' => 'Discover investment opportunities, track matches, and manage your portfolio.',
                    'government' => 'Access policy intelligence, sector reports, and industrial mapping.',
                    'analyst' => 'Analyze data, generate reports, and export insights.'
                ];
                echo $roleGreetings[$role ?? 'enterprise'] ?? 'Welcome to the AIIIIS platform.';
                ?>
            </p>
        </div>
    </main>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Load stats via AJAX
    fetch('<?= base_url("dashboard/getStats") ?>')
        .then(response => response.json())
        .then(data => {
            const container = document.getElementById('statsContainer');
            let html = '';
            
            // Generate stat cards based on data
            for (const [key, value] of Object.entries(data)) {
                const label = key.replace(/_/g, ' ').replace(/\b\w/g, l => l.toUpperCase());
                html += `
                    <div class="stat-card">
                        <div class="stat-icon"><i class="fas fa-${getIcon(key)}"></i></div>
                        <div class="stat-number">${value}</div>
                        <div class="stat-label">${label}</div>
                    </div>
                `;
            }
            
            container.innerHTML = html;
        })
        .catch(error => {
            console.error('Error loading stats:', error);
        });
});

function getIcon(key) {
    const icons = {
        'total_users': 'users',
        'total_enterprises': 'building',
        'total_investors': 'user-tie',
        'pending_verifications': 'clock',
        'total_matches': 'handshake',
        'deals_completed': 'check-circle',
        'active_engagements': 'calendar-check',
        'profile_complete': 'id-card',
        'matches': 'handshake',
        'engagements': 'comments',
        'ranking': 'trophy',
        'deals': 'file-signature',
        'portfolio_value': 'chart-pie',
        'sectors': 'industry',
        'avg_match_score': 'star'
    };
    return icons[key] || 'chart-line';
}
</script>

<?= $this->endSection() ?>