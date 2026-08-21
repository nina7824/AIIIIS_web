<?= $this->extend('admin/layout') ?>

<?= $this->section('styles') ?>
<style>
/* ========== DASHBOARD CUSTOM STYLES ========== */

/* Welcome Section */
.dashboard-welcome {
    background: var(--surface);
    padding: 1.5rem 2rem;
    border-radius: var(--radius-lg);
    margin-bottom: 1.5rem;
    border: 1px solid var(--border);
    box-shadow: var(--shadow-sm);
    transition: var(--transition);
    position: relative;
    overflow: hidden;
}

.dashboard-welcome::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: var(--primary-gradient);
}

.dashboard-welcome h2 {
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--ink);
    margin-bottom: 0.25rem;
}

.dashboard-welcome p {
    color: var(--ink-muted);
    font-size: 0.85rem;
    max-width: 600px;
    line-height: 1.5;
    margin-bottom: 0.75rem;
}

.dashboard-welcome .role-badge {
    display: inline-block;
    padding: 0.2rem 1rem;
    border-radius: 20px;
    font-size: 0.7rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.04em;
}

.role-badge.badge-super_admin,
.role-badge.badge-administrator {
    background: #e8f0fe;
    color: #1a73e8;
}

.role-badge.badge-nirda_expert {
    background: #e6f4ea;
    color: #1e7e34;
}

.role-badge.badge-enterprise {
    background: #fef3e2;
    color: #e37400;
}

.role-badge.badge-investor {
    background: #fce4ec;
    color: #c62828;
}

.role-badge.badge-government {
    background: #e8eaf6;
    color: #283593;
}

.role-badge.badge-analyst {
    background: #f3e5f5;
    color: #6a1b9a;
}

[data-theme="dark"] .role-badge.badge-super_admin,
[data-theme="dark"] .role-badge.badge-administrator {
    background: #1a2a4a;
    color: #64b5f6;
}

[data-theme="dark"] .role-badge.badge-nirda_expert {
    background: #1a3a2a;
    color: #66bb6a;
}

[data-theme="dark"] .role-badge.badge-enterprise {
    background: #3a2a1a;
    color: #ffa726;
}

[data-theme="dark"] .role-badge.badge-investor {
    background: #3a1a1a;
    color: #ef5350;
}

[data-theme="dark"] .role-badge.badge-government {
    background: #1a1a3a;
    color: #7986cb;
}

[data-theme="dark"] .role-badge.badge-analyst {
    background: #2a1a3a;
    color: #ab47bc;
}

/* ========== STATS CARDS - 4 COLUMN GRID ========== */
.dashboard-stats-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 1rem;
    margin-bottom: 1.5rem;
}

@media (max-width: 1200px) {
    .dashboard-stats-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}

@media (max-width: 992px) {
    .dashboard-stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 576px) {
    .dashboard-stats-grid {
        grid-template-columns: 1fr;
    }
}

.dashboard-stat-card {
    background: var(--surface);
    border-radius: var(--radius-lg);
    padding: 1.25rem 1.5rem;
    border: 1px solid var(--border);
    box-shadow: var(--shadow-sm);
    transition: var(--transition);
    position: relative;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
}

.dashboard-stat-card:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
    border-color: var(--primary);
}

.dashboard-stat-card .stat-icon {
    width: 44px;
    height: 44px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.1rem;
    margin-bottom: 0.75rem;
    background: var(--primary-light);
    color: var(--primary);
    transition: var(--transition);
}

.dashboard-stat-card:hover .stat-icon {
    background: var(--primary);
    color: #fff;
}

.dashboard-stat-card .stat-number {
    font-size: 1.75rem;
    font-weight: 800;
    color: var(--ink);
    line-height: 1.2;
    letter-spacing: -0.02em;
}

.dashboard-stat-card .stat-label {
    font-size: 0.75rem;
    font-weight: 500;
    color: var(--ink-muted);
    text-transform: uppercase;
    letter-spacing: 0.04em;
    margin-top: 0.15rem;
}

.dashboard-stat-card .stat-change {
    font-size: 0.7rem;
    font-weight: 600;
    margin-top: 0.5rem;
    padding: 0.1rem 0.6rem;
    border-radius: 12px;
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
}

.dashboard-stat-card .stat-change.positive {
    color: #1e7e34;
    background: #e6f4ea;
}

.dashboard-stat-card .stat-change.negative {
    color: #c62828;
    background: #fce4ec;
}

[data-theme="dark"] .dashboard-stat-card .stat-change.positive {
    color: #66bb6a;
    background: #1a3a2a;
}

[data-theme="dark"] .dashboard-stat-card .stat-change.negative {
    color: #ef5350;
    background: #3a1a1a;
}

/* Card color variants */
.dashboard-stat-card.color-primary .stat-icon {
    background: #e3f2fd;
    color: #1a73e8;
}

.dashboard-stat-card.color-primary:hover .stat-icon {
    background: #1a73e8;
    color: #fff;
}

.dashboard-stat-card.color-success .stat-icon {
    background: #e6f4ea;
    color: #1e7e34;
}

.dashboard-stat-card.color-success:hover .stat-icon {
    background: #1e7e34;
    color: #fff;
}

.dashboard-stat-card.color-warning .stat-icon {
    background: #fef3e2;
    color: #e37400;
}

.dashboard-stat-card.color-warning:hover .stat-icon {
    background: #e37400;
    color: #fff;
}

.dashboard-stat-card.color-danger .stat-icon {
    background: #fce4ec;
    color: #c62828;
}

.dashboard-stat-card.color-danger:hover .stat-icon {
    background: #c62828;
    color: #fff;
}

.dashboard-stat-card.color-purple .stat-icon {
    background: #f3e5f5;
    color: #6a1b9a;
}

.dashboard-stat-card.color-purple:hover .stat-icon {
    background: #6a1b9a;
    color: #fff;
}

.dashboard-stat-card.color-teal .stat-icon {
    background: #e0f2f1;
    color: #00695c;
}

.dashboard-stat-card.color-teal:hover .stat-icon {
    background: #00695c;
    color: #fff;
}

/* ========== QUICK ACTIONS ========== */
.dashboard-quick-actions {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
    gap: 0.75rem;
    margin-bottom: 1.5rem;
}

.dashboard-quick-action {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 1rem 0.75rem;
    transition: var(--transition);
    text-decoration: none;
    color: var(--ink);
    gap: 0.5rem;
}

.dashboard-quick-action:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
    border-color: var(--primary);
    background: var(--surface-hover);
}

.dashboard-quick-action .icon-wrapper {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
}

.dashboard-quick-action .icon-wrapper.bg-primary-light {
    background: #e3f2fd;
}

.dashboard-quick-action .icon-wrapper.bg-success-light {
    background: #e6f4ea;
}

.dashboard-quick-action .icon-wrapper.bg-warning-light {
    background: #fef3e2;
}

.dashboard-quick-action .icon-wrapper.bg-danger-light {
    background: #fce4ec;
}

.dashboard-quick-action .icon-wrapper.bg-purple-light {
    background: #f3e5f5;
}

.dashboard-quick-action .icon-wrapper.bg-teal-light {
    background: #e0f2f1;
}

.dashboard-quick-action .text-primary { color: #1a73e8; }
.dashboard-quick-action .text-success { color: #1e7e34; }
.dashboard-quick-action .text-warning { color: #e37400; }
.dashboard-quick-action .text-danger { color: #c62828; }
.dashboard-quick-action .text-purple { color: #6a1b9a; }
.dashboard-quick-action .text-teal { color: #00695c; }

.dashboard-quick-action .action-label {
    font-size: 0.78rem;
    font-weight: 500;
    text-align: center;
}

[data-theme="dark"] .dashboard-quick-action .icon-wrapper.bg-primary-light {
    background: #1a2a4a;
}
[data-theme="dark"] .dashboard-quick-action .icon-wrapper.bg-success-light {
    background: #1a3a2a;
}
[data-theme="dark"] .dashboard-quick-action .icon-wrapper.bg-warning-light {
    background: #3a2a1a;
}
[data-theme="dark"] .dashboard-quick-action .icon-wrapper.bg-danger-light {
    background: #3a1a1a;
}
[data-theme="dark"] .dashboard-quick-action .icon-wrapper.bg-purple-light {
    background: #2a1a3a;
}
[data-theme="dark"] .dashboard-quick-action .icon-wrapper.bg-teal-light {
    background: #1a2a2a;
}

/* ========== TWO COLUMN LAYOUT ========== */
.dashboard-two-col {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 1.5rem;
    margin-bottom: 1.5rem;
}

@media (max-width: 992px) {
    .dashboard-two-col {
        grid-template-columns: 1fr;
    }
}

/* ========== RECENT ACTIVITY ========== */
.dashboard-activity {
    background: var(--surface);
    border-radius: var(--radius-lg);
    border: 1px solid var(--border);
    box-shadow: var(--shadow-sm);
    overflow: hidden;
}

.dashboard-activity .activity-header {
    padding: 1rem 1.5rem;
    border-bottom: 1px solid var(--border);
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-weight: 600;
    font-size: 0.9rem;
    color: var(--ink);
}

.dashboard-activity .activity-header a {
    font-size: 0.75rem;
    font-weight: 500;
    color: var(--primary);
    text-decoration: none;
    transition: var(--transition);
}

.dashboard-activity .activity-header a:hover {
    text-decoration: underline;
}

.dashboard-activity .activity-body {
    padding: 0.5rem 0;
    max-height: 380px;
    overflow-y: auto;
}

.dashboard-activity .activity-body::-webkit-scrollbar {
    width: 4px;
}

.dashboard-activity .activity-body::-webkit-scrollbar-track {
    background: var(--scrollbar-track);
}

.dashboard-activity .activity-body::-webkit-scrollbar-thumb {
    background: var(--scrollbar-thumb);
    border-radius: 10px;
}

.dashboard-activity-item {
    display: flex;
    align-items: flex-start;
    gap: 0.75rem;
    padding: 0.75rem 1.5rem;
    transition: var(--transition);
    border-bottom: 1px solid var(--border-light);
}

.dashboard-activity-item:last-child {
    border-bottom: none;
}

.dashboard-activity-item:hover {
    background: var(--surface-hover);
}

.dashboard-activity-item .activity-icon {
    width: 36px;
    height: 36px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.85rem;
    flex-shrink: 0;
    margin-top: 0.1rem;
}

.dashboard-activity-item .activity-icon.bg-primary-light {
    background: #e3f2fd;
}
.dashboard-activity-item .activity-icon.bg-success-light {
    background: #e6f4ea;
}
.dashboard-activity-item .activity-icon.bg-warning-light {
    background: #fef3e2;
}
.dashboard-activity-item .activity-icon.bg-danger-light {
    background: #fce4ec;
}
.dashboard-activity-item .activity-icon.bg-purple-light {
    background: #f3e5f5;
}
.dashboard-activity-item .activity-icon.bg-teal-light {
    background: #e0f2f1;
}

.dashboard-activity-item .activity-icon .text-primary { color: #1a73e8; }
.dashboard-activity-item .activity-icon .text-success { color: #1e7e34; }
.dashboard-activity-item .activity-icon .text-warning { color: #e37400; }
.dashboard-activity-item .activity-icon .text-danger { color: #c62828; }
.dashboard-activity-item .activity-icon .text-purple { color: #6a1b9a; }
.dashboard-activity-item .activity-icon .text-teal { color: #00695c; }

.dashboard-activity-item .activity-content {
    flex: 1;
}

.dashboard-activity-item .activity-content p {
    font-size: 0.82rem;
    color: var(--ink);
    margin: 0;
    line-height: 1.4;
}

.dashboard-activity-item .activity-content small {
    font-size: 0.65rem;
    color: var(--ink-muted);
    display: block;
    margin-top: 0.1rem;
}

.dashboard-activity-item .activity-badge {
    font-size: 0.55rem;
    font-weight: 600;
    padding: 0.1rem 0.6rem;
    border-radius: 12px;
    text-transform: uppercase;
    letter-spacing: 0.04em;
    flex-shrink: 0;
    margin-top: 0.1rem;
}

.dashboard-activity-item .activity-badge.bg-primary-light {
    background: #e3f2fd;
    color: #1a73e8;
}
.dashboard-activity-item .activity-badge.bg-success-light {
    background: #e6f4ea;
    color: #1e7e34;
}
.dashboard-activity-item .activity-badge.bg-warning-light {
    background: #fef3e2;
    color: #e37400;
}
.dashboard-activity-item .activity-badge.bg-danger-light {
    background: #fce4ec;
    color: #c62828;
}
.dashboard-activity-item .activity-badge.bg-purple-light {
    background: #f3e5f5;
    color: #6a1b9a;
}
.dashboard-activity-item .activity-badge.bg-teal-light {
    background: #e0f2f1;
    color: #00695c;
}

[data-theme="dark"] .dashboard-activity-item .activity-icon.bg-primary-light {
    background: #1a2a4a;
}
[data-theme="dark"] .dashboard-activity-item .activity-icon.bg-success-light {
    background: #1a3a2a;
}
[data-theme="dark"] .dashboard-activity-item .activity-icon.bg-warning-light {
    background: #3a2a1a;
}
[data-theme="dark"] .dashboard-activity-item .activity-icon.bg-danger-light {
    background: #3a1a1a;
}
[data-theme="dark"] .dashboard-activity-item .activity-icon.bg-purple-light {
    background: #2a1a3a;
}
[data-theme="dark"] .dashboard-activity-item .activity-icon.bg-teal-light {
    background: #1a2a2a;
}

[data-theme="dark"] .dashboard-activity-item .activity-badge.bg-primary-light {
    background: #1a2a4a;
    color: #64b5f6;
}
[data-theme="dark"] .dashboard-activity-item .activity-badge.bg-success-light {
    background: #1a3a2a;
    color: #66bb6a;
}
[data-theme="dark"] .dashboard-activity-item .activity-badge.bg-warning-light {
    background: #3a2a1a;
    color: #ffa726;
}
[data-theme="dark"] .dashboard-activity-item .activity-badge.bg-danger-light {
    background: #3a1a1a;
    color: #ef5350;
}
[data-theme="dark"] .dashboard-activity-item .activity-badge.bg-purple-light {
    background: #2a1a3a;
    color: #ab47bc;
}
[data-theme="dark"] .dashboard-activity-item .activity-badge.bg-teal-light {
    background: #1a2a2a;
    color: #4db6ac;
}

/* ========== WIDGETS ========== */
.dashboard-widget {
    background: var(--surface);
    border-radius: var(--radius-lg);
    border: 1px solid var(--border);
    box-shadow: var(--shadow-sm);
    overflow: hidden;
    margin-bottom: 0;
}

.dashboard-widget .widget-header {
    padding: 0.75rem 1.25rem;
    border-bottom: 1px solid var(--border);
    font-weight: 600;
    font-size: 0.85rem;
    color: var(--ink);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.dashboard-widget .widget-header .widget-count {
    font-size: 0.7rem;
    font-weight: 500;
    color: var(--ink-muted);
    background: var(--canvas);
    padding: 0.1rem 0.6rem;
    border-radius: 12px;
}

.dashboard-widget .widget-body {
    padding: 0.25rem 0;
    max-height: 280px;
    overflow-y: auto;
}

.dashboard-widget .widget-body::-webkit-scrollbar {
    width: 4px;
}

.dashboard-widget .widget-body::-webkit-scrollbar-track {
    background: var(--scrollbar-track);
}

.dashboard-widget .widget-body::-webkit-scrollbar-thumb {
    background: var(--scrollbar-thumb);
    border-radius: 10px;
}

.dashboard-widget .widget-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.5rem 1.25rem;
    border-bottom: 1px solid var(--border-light);
    transition: var(--transition);
}

.dashboard-widget .widget-item:last-child {
    border-bottom: none;
}

.dashboard-widget .widget-item:hover {
    background: var(--surface-hover);
}

.dashboard-widget .widget-item .item-title {
    font-size: 0.82rem;
    color: var(--ink);
    font-weight: 500;
}

.dashboard-widget .widget-item .item-title .item-sub {
    font-weight: 400;
    color: var(--ink-muted);
    font-size: 0.7rem;
}

.dashboard-widget .widget-item .item-date {
    font-size: 0.65rem;
    color: var(--ink-muted);
    flex-shrink: 0;
    margin-left: 0.5rem;
}

.dashboard-widget .widget-item .item-status {
    font-size: 0.55rem;
    font-weight: 600;
    padding: 0.05rem 0.5rem;
    border-radius: 12px;
    text-transform: uppercase;
    letter-spacing: 0.04em;
    flex-shrink: 0;
}

.dashboard-widget .widget-item .item-status.status-pending {
    background: #fef3e2;
    color: #e37400;
}

.dashboard-widget .widget-item .item-status.status-approved {
    background: #e6f4ea;
    color: #1e7e34;
}

.dashboard-widget .widget-item .item-status.status-rejected {
    background: #fce4ec;
    color: #c62828;
}

.dashboard-widget .widget-item .item-status.status-active {
    background: #e3f2fd;
    color: #1a73e8;
}

[data-theme="dark"] .dashboard-widget .widget-item .item-status.status-pending {
    background: #3a2a1a;
    color: #ffa726;
}

[data-theme="dark"] .dashboard-widget .widget-item .item-status.status-approved {
    background: #1a3a2a;
    color: #66bb6a;
}

[data-theme="dark"] .dashboard-widget .widget-item .item-status.status-rejected {
    background: #3a1a1a;
    color: #ef5350;
}

[data-theme="dark"] .dashboard-widget .widget-item .item-status.status-active {
    background: #1a2a4a;
    color: #64b5f6;
}

/* ========== WIDGETS GRID (Bottom) ========== */
.dashboard-widgets {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1.25rem;
    margin-top: 1.5rem;
}

@media (max-width: 992px) {
    .dashboard-widgets {
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    }
}

@media (max-width: 576px) {
    .dashboard-widgets {
        grid-template-columns: 1fr;
    }
}

/* ========== RESPONSIVE TWEAKS ========== */
@media (max-width: 768px) {
    .dashboard-welcome {
        padding: 1rem 1.25rem;
    }
    
    .dashboard-welcome h2 {
        font-size: 1.1rem;
    }
    
    .dashboard-stat-card {
        padding: 1rem 1.25rem;
    }
    
    .dashboard-stat-card .stat-number {
        font-size: 1.4rem;
    }
    
    .dashboard-quick-actions {
        grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
    }
}

@media (max-width: 480px) {
    .dashboard-welcome {
        padding: 0.75rem 1rem;
    }
    
    .dashboard-stat-card {
        padding: 0.75rem 1rem;
    }
    
    .dashboard-stat-card .stat-number {
        font-size: 1.2rem;
    }
    
    .dashboard-stat-card .stat-icon {
        width: 36px;
        height: 36px;
        font-size: 0.9rem;
    }
    
    .dashboard-activity-item {
        padding: 0.5rem 1rem;
    }
    
    .dashboard-widget .widget-item {
        padding: 0.4rem 1rem;
    }
}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>


<!-- Stats Grid - 4 Columns -->
<div class="dashboard-stats-grid" id="statsContainer">
    <?php if (!empty($stats)): ?>
        <?php 
        $colorMap = [
            'total_users' => 'color-primary',
            'total_enterprises' => 'color-success',
            'total_investors' => 'color-purple',
            'pending_verifications' => 'color-warning',
            'total_deals' => 'color-teal',
            'matches' => 'color-primary',
            'deals' => 'color-success',
            'advisory' => 'color-purple',
            'assigned_enterprises' => 'color-teal',
            'pending_advisory' => 'color-warning',
            'total_reports' => 'color-primary',
            'pending_reports' => 'color-danger',
            'analytics_data' => 'color-purple'
        ];
        
        $icons = [
            'total_users' => 'fa-users',
            'total_enterprises' => 'fa-building',
            'total_investors' => 'fa-user-tie',
            'pending_verifications' => 'fa-clock',
            'total_deals' => 'fa-money-bill-wave',
            'matches' => 'fa-handshake',
            'deals' => 'fa-file-signature',
            'advisory' => 'fa-comment-dots',
            'assigned_enterprises' => 'fa-building',
            'pending_advisory' => 'fa-clock',
            'total_reports' => 'fa-chart-bar',
            'pending_reports' => 'fa-clock',
            'analytics_data' => 'fa-chart-line'
        ];
        ?>
        <?php foreach ($stats as $key => $value): ?>
            <?php if (is_numeric($value)): ?>
                <div class="dashboard-stat-card <?= $colorMap[$key] ?? 'color-primary' ?>">
                    <div class="stat-icon">
                        <i class="fas <?= $icons[$key] ?? 'fa-chart-line' ?>"></i>
                    </div>
                    <div class="stat-number"><?= number_format($value) ?></div>
                    <div class="stat-label"><?= ucwords(str_replace('_', ' ', $key)) ?></div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="dashboard-stat-card">
            <div class="stat-icon"><i class="fas fa-spinner fa-spin"></i></div>
            <div class="stat-number">Loading...</div>
            <div class="stat-label">Loading statistics</div>
        </div>
    <?php endif; ?>
</div>

<!-- Quick Actions -->
<?php if (!empty($quick_actions)): ?>
<div class="dashboard-quick-actions">
    <?php foreach ($quick_actions as $action): ?>
        <a href="<?= base_url($action['route']) ?>" class="dashboard-quick-action">
            <div class="icon-wrapper bg-<?= $action['color'] ?? 'primary' ?>-light">
                <i class="fas <?= $action['icon'] ?> text-<?= $action['color'] ?? 'primary' ?>"></i>
            </div>
            <div class="action-label"><?= $action['label'] ?></div>
        </a>
    <?php endforeach; ?>
</div>
<?php endif; ?>

<!-- Two Column Layout: Activity & Quick Stats -->
<div class="dashboard-two-col">
    <!-- Recent Activity -->
    <?php if (!empty($recent_activity)): ?>
    <div class="dashboard-activity">
        <div class="activity-header">
            <span>Recent Activity</span>
            <a href="#">View All</a>
        </div>
        <div class="activity-body">
            <?php foreach ($recent_activity as $activity): ?>
                <div class="dashboard-activity-item">
                    <div class="activity-icon bg-<?= $activity['color'] ?? 'primary' ?>-light">
                        <i class="fas <?= $activity['icon'] ?? 'fa-circle' ?> text-<?= $activity['color'] ?? 'primary' ?>"></i>
                    </div>
                    <div class="activity-content">
                        <p><?= $activity['message'] ?></p>
                        <small><?= date('M d, Y H:i', strtotime($activity['time'])) ?></small>
                    </div>
                    <span class="activity-badge bg-<?= $activity['color'] ?? 'primary' ?>-light text-<?= $activity['color'] ?? 'primary' ?>">
                        <?= ucfirst($activity['type'] ?? 'activity') ?>
                    </span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>

    <!-- Right Column Widgets -->
    <div style="display: flex; flex-direction: column; gap: 1.25rem;">
        <?php if (!empty($widgets)): ?>
            <?php 
            $firstWidgets = array_slice($widgets, 0, 2);
            foreach ($firstWidgets as $widgetKey => $widgetData): 
            ?>
                <?php if (!empty($widgetData) && is_array($widgetData)): ?>
                    <div class="dashboard-widget">
                        <div class="widget-header">
                            <?= ucwords(str_replace('_', ' ', $widgetKey)) ?>
                            <span class="widget-count"><?= count($widgetData) ?></span>
                        </div>
                        <div class="widget-body">
                            <?php foreach (array_slice($widgetData, 0, 5) as $item): ?>
                                <div class="widget-item">
                                    <div class="item-title">
                                        <?= $item['name'] ?? $item['title'] ?? $item['enterprise_name'] ?? 'Item' ?>
                                        <?php if (isset($item['status'])): ?>
                                            <span class="item-sub">· <?= ucfirst($item['status']) ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="item-date"><?= date('M d, Y', strtotime($item['created_at'] ?? 'now')) ?></div>
                                </div>
                            <?php endforeach; ?>
                            <?php if (count($widgetData) > 5): ?>
                                <div style="text-align: center; padding: 0.5rem;">
                                    <a href="#" style="font-size: 0.75rem; color: var(--primary); font-weight: 500;">View all <?= count($widgetData) ?> items →</a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<!-- Widgets Grid (bottom) -->
<?php if (!empty($widgets) && count($widgets) > 2): ?>
<div class="dashboard-widgets">
    <?php 
    $remainingWidgets = array_slice($widgets, 2);
    foreach ($remainingWidgets as $widgetKey => $widgetData): 
    ?>
        <?php if (!empty($widgetData) && is_array($widgetData)): ?>
            <div class="dashboard-widget">
                <div class="widget-header">
                    <?= ucwords(str_replace('_', ' ', $widgetKey)) ?>
                    <span class="widget-count"><?= count($widgetData) ?></span>
                </div>
                <div class="widget-body">
                    <?php foreach (array_slice($widgetData, 0, 5) as $item): ?>
                        <div class="widget-item">
                            <div class="item-title">
                                <?= $item['name'] ?? $item['title'] ?? $item['enterprise_name'] ?? 'Item' ?>
                                <?php if (isset($item['status'])): ?>
                                    <span class="item-sub">· <?= ucfirst($item['status']) ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="item-date"><?= date('M d, Y', strtotime($item['created_at'] ?? 'now')) ?></div>
                        </div>
                    <?php endforeach; ?>
                    <?php if (count($widgetData) > 5): ?>
                        <div style="text-align: center; padding: 0.5rem;">
                            <a href="#" style="font-size: 0.75rem; color: var(--primary); font-weight: 500;">View all <?= count($widgetData) ?> items →</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
</div>
<?php endif; ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Load stats via AJAX if not already loaded
    const statsContainer = document.getElementById('statsContainer');
    if (statsContainer && statsContainer.querySelector('.fa-spin')) {
        fetch('<?= base_url("dashboard/getStats") ?>')
            .then(response => response.json())
            .then(data => {
                let html = '';
                const colorMap = {
                    'total_users': 'color-primary',
                    'total_enterprises': 'color-success',
                    'total_investors': 'color-purple',
                    'pending_verifications': 'color-warning',
                    'total_deals': 'color-teal',
                    'matches': 'color-primary',
                    'deals': 'color-success',
                    'advisory': 'color-purple',
                    'assigned_enterprises': 'color-teal',
                    'pending_advisory': 'color-warning',
                    'total_reports': 'color-primary',
                    'pending_reports': 'color-danger',
                    'analytics_data': 'color-purple'
                };
                const icons = {
                    'total_users': 'fa-users',
                    'total_enterprises': 'fa-building',
                    'total_investors': 'fa-user-tie',
                    'pending_verifications': 'fa-clock',
                    'total_deals': 'fa-money-bill-wave',
                    'matches': 'fa-handshake',
                    'deals': 'fa-file-signature',
                    'advisory': 'fa-comment-dots',
                    'assigned_enterprises': 'fa-building',
                    'pending_advisory': 'fa-clock',
                    'total_reports': 'fa-chart-bar',
                    'pending_reports': 'fa-clock',
                    'analytics_data': 'fa-chart-line'
                };
                
                for (const [key, value] of Object.entries(data)) {
                    if (typeof value === 'number') {
                        const label = key.replace(/_/g, ' ').replace(/\b\w/g, l => l.toUpperCase());
                        const icon = icons[key] || 'fa-chart-line';
                        const color = colorMap[key] || 'color-primary';
                        html += `
                            <div class="dashboard-stat-card ${color}">
                                <div class="stat-icon"><i class="fas ${icon}"></i></div>
                                <div class="stat-number">${value.toLocaleString()}</div>
                                <div class="stat-label">${label}</div>
                            </div>
                        `;
                    }
                }
                
                if (html) {
                    statsContainer.innerHTML = html;
                }
            })
            .catch(error => {
                console.error('Error loading stats:', error);
            });
    }
});
</script>

<?= $this->endSection() ?>