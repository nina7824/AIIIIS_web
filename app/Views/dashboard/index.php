<?= $this->extend('admin/layout') ?>

<?= $this->section('styles') ?>
<style>
/* ========== DASHBOARD CUSTOM STYLES ========== */

/* Welcome Section */
.dashboard-welcome {
    background: var(--surface);
    padding: 1.25rem 1.75rem;
    border-radius: var(--radius-lg);
    margin-bottom: 1rem;
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
    height: 3px;
    background: var(--primary-gradient);
}

.dashboard-welcome h2 {
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--ink);
    margin-bottom: 0.1rem;
}

.dashboard-welcome p {
    color: var(--ink-muted);
    font-size: 0.8rem;
    max-width: 600px;
    line-height: 1.5;
    margin-bottom: 0.5rem;
}

.dashboard-welcome .role-badge {
    display: inline-block;
    padding: 0.15rem 0.85rem;
    border-radius: 20px;
    font-size: 0.6rem;
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

/* ========== ROLE-SPECIFIC CARDS - 4 COLUMN GRID ========== */
.dashboard-role-cards {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 0.75rem;
    margin-bottom: 1rem;
}

@media (max-width: 1200px) {
    .dashboard-role-cards {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .dashboard-role-cards {
        grid-template-columns: 1fr 1fr;
        gap: 0.5rem;
    }
}

@media (max-width: 480px) {
    .dashboard-role-cards {
        grid-template-columns: 1fr;
    }
}

/* ========== TOP ROW: METRIC CARDS - 4 COLUMN GRID ========== */
.dashboard-stats-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 0.75rem;
    margin-bottom: 1rem;
}

@media (max-width: 1200px) {
    .dashboard-stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .dashboard-stats-grid {
        grid-template-columns: 1fr 1fr;
        gap: 0.5rem;
    }
}

@media (max-width: 480px) {
    .dashboard-stats-grid {
        grid-template-columns: 1fr;
    }
}

.dashboard-stat-card {
    background: var(--surface);
    border-radius: var(--radius);
    padding: 0.75rem 1rem;
    border: 1px solid var(--border);
    box-shadow: var(--shadow-sm);
    transition: var(--transition);
    position: relative;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
}

.dashboard-stat-card .accent-bar {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 2.5px;
    background: var(--primary-gradient);
}

.dashboard-stat-card:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
    border-color: var(--primary);
}

.dashboard-stat-card .stat-icon {
    width: 32px;
    height: 32px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.8rem;
    margin-bottom: 0.3rem;
    background: var(--primary-light);
    color: var(--primary);
    transition: var(--transition);
}

.dashboard-stat-card:hover .stat-icon {
    background: var(--primary);
    color: #fff;
}

.dashboard-stat-card .stat-number {
    font-size: 1.2rem;
    font-weight: 800;
    color: var(--ink);
    line-height: 1.2;
    letter-spacing: -0.02em;
}

.dashboard-stat-card .stat-label {
    font-size: 0.6rem;
    font-weight: 500;
    color: var(--ink-muted);
    text-transform: uppercase;
    letter-spacing: 0.04em;
    margin-top: 0.1rem;
}

.dashboard-stat-card .stat-trend {
    font-size: 0.55rem;
    font-weight: 600;
    margin-top: 0.25rem;
    padding: 0.05rem 0.4rem;
    border-radius: 10px;
    display: inline-flex;
    align-items: center;
    gap: 0.2rem;
    background: var(--canvas);
}

.dashboard-stat-card .stat-trend.up { color: #059669; }
.dashboard-stat-card .stat-trend.down { color: #dc2626; }
.dashboard-stat-card .stat-trend.neutral { color: var(--ink-muted); }

/* Card color variants */
.dashboard-stat-card.color-primary .stat-icon { background: #e3f2fd; color: #1a73e8; }
.dashboard-stat-card.color-primary:hover .stat-icon { background: #1a73e8; color: #fff; }
.dashboard-stat-card.color-primary .accent-bar { background: #1a73e8; }

.dashboard-stat-card.color-success .stat-icon { background: #e6f4ea; color: #1e7e34; }
.dashboard-stat-card.color-success:hover .stat-icon { background: #1e7e34; color: #fff; }
.dashboard-stat-card.color-success .accent-bar { background: #1e7e34; }

.dashboard-stat-card.color-warning .stat-icon { background: #fef3e2; color: #e37400; }
.dashboard-stat-card.color-warning:hover .stat-icon { background: #e37400; color: #fff; }
.dashboard-stat-card.color-warning .accent-bar { background: #e37400; }

.dashboard-stat-card.color-danger .stat-icon { background: #fce4ec; color: #c62828; }
.dashboard-stat-card.color-danger:hover .stat-icon { background: #c62828; color: #fff; }
.dashboard-stat-card.color-danger .accent-bar { background: #c62828; }

.dashboard-stat-card.color-purple .stat-icon { background: #f3e5f5; color: #6a1b9a; }
.dashboard-stat-card.color-purple:hover .stat-icon { background: #6a1b9a; color: #fff; }
.dashboard-stat-card.color-purple .accent-bar { background: #6a1b9a; }

.dashboard-stat-card.color-teal .stat-icon { background: #e0f2f1; color: #00695c; }
.dashboard-stat-card.color-teal:hover .stat-icon { background: #00695c; color: #fff; }
.dashboard-stat-card.color-teal .accent-bar { background: #00695c; }

[data-theme="dark"] .dashboard-stat-card.color-primary .stat-icon { background: #1a2a4a; color: #64b5f6; }
[data-theme="dark"] .dashboard-stat-card.color-success .stat-icon { background: #1a3a2a; color: #66bb6a; }
[data-theme="dark"] .dashboard-stat-card.color-warning .stat-icon { background: #3a2a1a; color: #ffa726; }
[data-theme="dark"] .dashboard-stat-card.color-danger .stat-icon { background: #3a1a1a; color: #ef5350; }
[data-theme="dark"] .dashboard-stat-card.color-purple .stat-icon { background: #2a1a3a; color: #ab47bc; }
[data-theme="dark"] .dashboard-stat-card.color-teal .stat-icon { background: #1a2a2a; color: #4db6ac; }

/* ========== MIDDLE ROW: 3-COLUMN PANELS ========== */
.dashboard-panels {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    gap: 0.75rem;
    margin-bottom: 1rem;
}

@media (max-width: 992px) {
    .dashboard-panels {
        grid-template-columns: 1fr 1fr;
    }
    .dashboard-panels .panel-card:last-child {
        grid-column: span 2;
    }
}

@media (max-width: 768px) {
    .dashboard-panels {
        grid-template-columns: 1fr;
    }
    .dashboard-panels .panel-card:last-child {
        grid-column: span 1;
    }
}

.panel-card {
    background: var(--surface);
    border-radius: var(--radius);
    border: 1px solid var(--border);
    box-shadow: var(--shadow-sm);
    overflow: hidden;
}

.panel-card .panel-header {
    padding: 0.5rem 0.85rem;
    border-bottom: 1px solid var(--border);
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.panel-card .panel-header .panel-title {
    font-size: 0.6rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.06em;
    color: var(--ink-muted);
    display: flex;
    align-items: center;
    gap: 0.4rem;
}

.panel-card .panel-header .panel-title i {
    color: var(--primary);
}

.panel-card .panel-header .panel-action {
    font-size: 0.55rem;
    color: var(--primary);
    cursor: pointer;
    font-weight: 500;
    text-decoration: none;
}

.panel-card .panel-header .panel-action:hover {
    text-decoration: underline;
}

.panel-card .panel-body {
    padding: 0.5rem 0.85rem;
}

/* List Items */
.list-item {
    display: flex;
    align-items: center;
    padding: 0.35rem 0;
    border-bottom: 1px solid var(--border-light);
    gap: 0.5rem;
}

.list-item:last-child {
    border-bottom: none;
}

.list-item .item-icon {
    width: 28px;
    height: 28px;
    border-radius: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.65rem;
    flex-shrink: 0;
    background: var(--canvas);
    color: var(--ink-muted);
}

.list-item .item-icon.blue { background: #dbeafe; color: #2563eb; }
.list-item .item-icon.green { background: #d1fae5; color: #059669; }
.list-item .item-icon.purple { background: #ede9fe; color: #7c3aed; }
.list-item .item-icon.orange { background: #fef3c7; color: #d97706; }
.list-item .item-icon.red { background: #fee2e2; color: #dc2626; }
.list-item .item-icon.teal { background: #ccfbf1; color: #0d9488; }

.list-item .item-content {
    flex: 1;
    min-width: 0;
}

.list-item .item-content .item-title {
    font-size: 0.75rem;
    font-weight: 600;
    color: var(--ink);
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.list-item .item-content .item-sub {
    font-size: 0.6rem;
    color: var(--ink-muted);
}

.list-item .item-value {
    font-size: 0.75rem;
    font-weight: 600;
    color: var(--ink);
    flex-shrink: 0;
}

.list-item .item-badge {
    font-size: 0.5rem;
    font-weight: 600;
    padding: 0.05rem 0.5rem;
    border-radius: 10px;
    flex-shrink: 0;
}

.list-item .item-badge.success { background: #d1fae5; color: #059669; }
.list-item .item-badge.warning { background: #fef3c7; color: #d97706; }
.list-item .item-badge.danger { background: #fee2e2; color: #dc2626; }
.list-item .item-badge.info { background: #dbeafe; color: #2563eb; }

[data-theme="dark"] .list-item .item-icon.blue { background: #1a2a4a; color: #60a5fa; }
[data-theme="dark"] .list-item .item-icon.green { background: #1a3a2a; color: #34d399; }
[data-theme="dark"] .list-item .item-icon.purple { background: #2d1b4a; color: #a78bfa; }
[data-theme="dark"] .list-item .item-icon.orange { background: #3a2a1a; color: #fbbf24; }
[data-theme="dark"] .list-item .item-icon.red { background: #3a1a1a; color: #f87171; }
[data-theme="dark"] .list-item .item-icon.teal { background: #1a3a3a; color: #2dd4bf; }

/* ========== TREND CHART ========== */
.trend-chart {
    margin-top: 0.5rem;
    display: flex;
    align-items: flex-end;
    gap: 0.4rem;
    height: 60px;
    padding-top: 0.3rem;
}

.trend-chart .bar-group {
    flex: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.15rem;
}

.trend-chart .bar-group .bar {
    width: 100%;
    max-width: 24px;
    border-radius: 3px 3px 0 0;
    transition: height 0.5s ease;
    min-height: 3px;
}

.trend-chart .bar-group .bar-label {
    font-size: 0.45rem;
    color: var(--ink-muted);
    text-transform: uppercase;
}

.trend-chart .bar-group .bar-value {
    font-size: 0.5rem;
    font-weight: 600;
    color: var(--ink);
}

/* ========== SPLIT STATS ========== */
.split-stats {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 0.75rem;
}

.split-stats .stat-item {
    text-align: center;
    padding: 0.4rem;
    border-radius: 6px;
    background: var(--canvas);
}

.split-stats .stat-item .stat-number {
    font-size: 1.2rem;
    font-weight: 800;
    color: var(--ink);
}

.split-stats .stat-item .stat-label {
    font-size: 0.55rem;
    color: var(--ink-muted);
    font-weight: 500;
}

.split-stats .stat-item .stat-icon {
    display: block;
    font-size: 0.7rem;
    margin-bottom: 0.15rem;
}

/* ========== BOTTOM ROW: WIDGETS ========== */
.dashboard-widgets {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 0.75rem;
    margin-top: 0.5rem;
}

@media (max-width: 768px) {
    .dashboard-widgets {
        grid-template-columns: 1fr;
    }
}

.dashboard-widget {
    background: var(--surface);
    border-radius: var(--radius);
    border: 1px solid var(--border);
    box-shadow: var(--shadow-sm);
    overflow: hidden;
}

.dashboard-widget .widget-header {
    padding: 0.5rem 0.85rem;
    border-bottom: 1px solid var(--border);
    font-weight: 600;
    font-size: 0.75rem;
    color: var(--ink);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.dashboard-widget .widget-header .widget-count {
    font-size: 0.6rem;
    font-weight: 500;
    color: var(--ink-muted);
    background: var(--canvas);
    padding: 0.05rem 0.5rem;
    border-radius: 10px;
}

.dashboard-widget .widget-body {
    padding: 0.15rem 0;
    max-height: 240px;
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
    padding: 0.35rem 0.85rem;
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
    font-size: 0.75rem;
    color: var(--ink);
    font-weight: 500;
}

.dashboard-widget .widget-item .item-title .item-sub {
    font-weight: 400;
    color: var(--ink-muted);
    font-size: 0.6rem;
}

.dashboard-widget .widget-item .item-date {
    font-size: 0.55rem;
    color: var(--ink-muted);
    flex-shrink: 0;
    margin-left: 0.4rem;
}

.dashboard-widget .widget-item .item-status {
    font-size: 0.5rem;
    font-weight: 600;
    padding: 0.05rem 0.4rem;
    border-radius: 10px;
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

/* ========== QUICK ACTIONS ========== */
.dashboard-quick-actions {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
    gap: 0.5rem;
    margin-bottom: 1rem;
}

.dashboard-quick-action {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 0.75rem 0.5rem;
    transition: var(--transition);
    text-decoration: none;
    color: var(--ink);
    gap: 0.35rem;
}

.dashboard-quick-action:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
    border-color: var(--primary);
    background: var(--surface-hover);
}

.dashboard-quick-action .icon-wrapper {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
}

.dashboard-quick-action .icon-wrapper.bg-primary-light { background: #e3f2fd; }
.dashboard-quick-action .icon-wrapper.bg-success-light { background: #e6f4ea; }
.dashboard-quick-action .icon-wrapper.bg-warning-light { background: #fef3e2; }
.dashboard-quick-action .icon-wrapper.bg-danger-light { background: #fce4ec; }
.dashboard-quick-action .icon-wrapper.bg-purple-light { background: #f3e5f5; }
.dashboard-quick-action .icon-wrapper.bg-teal-light { background: #e0f2f1; }

.dashboard-quick-action .text-primary { color: #1a73e8; }
.dashboard-quick-action .text-success { color: #1e7e34; }
.dashboard-quick-action .text-warning { color: #e37400; }
.dashboard-quick-action .text-danger { color: #c62828; }
.dashboard-quick-action .text-purple { color: #6a1b9a; }
.dashboard-quick-action .text-teal { color: #00695c; }

.dashboard-quick-action .action-label {
    font-size: 0.7rem;
    font-weight: 500;
    text-align: center;
}

[data-theme="dark"] .dashboard-quick-action .icon-wrapper.bg-primary-light { background: #1a2a4a; }
[data-theme="dark"] .dashboard-quick-action .icon-wrapper.bg-success-light { background: #1a3a2a; }
[data-theme="dark"] .dashboard-quick-action .icon-wrapper.bg-warning-light { background: #3a2a1a; }
[data-theme="dark"] .dashboard-quick-action .icon-wrapper.bg-danger-light { background: #3a1a1a; }
[data-theme="dark"] .dashboard-quick-action .icon-wrapper.bg-purple-light { background: #2a1a3a; }
[data-theme="dark"] .dashboard-quick-action .icon-wrapper.bg-teal-light { background: #1a2a2a; }

/* ========== EMPTY STATE ========== */
.empty-state {
    text-align: center;
    padding: 1rem;
    color: var(--ink-muted);
}

.empty-state i {
    font-size: 1.2rem;
    display: block;
    margin-bottom: 0.3rem;
    opacity: 0.3;
}

.empty-state p {
    font-size: 0.75rem;
}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>



<!-- ============================================================
     ROLE-SPECIFIC CARDS (4 Cards)
     ============================================================ -->
<?php if (!empty($role_specific_cards)): ?>
<div class="dashboard-role-cards">
    <?php foreach ($role_specific_cards as $card): ?>
        <div class="dashboard-stat-card color-<?= $card['color'] ?? 'primary' ?>">
            <div class="accent-bar" style="background: <?= $role_color ?? 'var(--primary)' ?>;"></div>
            <div class="stat-icon">
                <i class="fas <?= $card['icon'] ?? 'fa-chart-line' ?>"></i>
            </div>
            <div class="stat-number"><?= $card['value'] ?? 0 ?></div>
            <div class="stat-label"><?= $card['label'] ?? '' ?></div>
            <?php if (isset($card['trend'])): ?>
                <span class="stat-trend up">
                    <i class="fas fa-arrow-up"></i> <?= $card['trend'] ?>
                </span>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</div>
<?php endif; ?>

<!-- ============================================================
     TOP ROW: METRIC CARDS (4 Columns)
     ============================================================ -->
<div class="dashboard-stats-grid" id="statsContainer">
    <?php if (!empty($stats)): ?>
        <?php 
        // Define which stats to skip
        $skipStats = [
            'enterprise_name', 'role', 'welcome', 
            'advisory_requests', 'pending_advisory',
            'enterprise', 'role_name'
        ];
        
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
        
        $trends = [
            'total_users' => ['up', '12%'],
            'total_enterprises' => ['up', '8%'],
            'total_investors' => ['neutral', '0%'],
            'pending_verifications' => ['down', '3%']
        ];
        ?>
        <?php foreach ($stats as $key => $value): ?>
            <?php 
            // Skip unwanted stats
            if (in_array($key, $skipStats)) {
                continue;
            }
            // Also skip by label
            $label = ucwords(str_replace('_', ' ', $key));
            $skipLabels = ['Enterprise', 'Role', 'Welcome', 'My Enterprise', 'Advisory Requests', 'Pending Advisory'];
            if (in_array($label, $skipLabels)) {
                continue;
            }
            ?>
            <?php if (is_numeric($value) || is_string($value)): ?>
                <?php 
                $color = $colorMap[$key] ?? 'color-primary';
                $icon = $icons[$key] ?? 'fa-chart-line';
                $trend = $trends[$key] ?? ['neutral', '0%'];
                $trendClass = $trend[0];
                $trendIcon = $trend[0] === 'up' ? 'fa-arrow-up' : ($trend[0] === 'down' ? 'fa-arrow-down' : 'fa-minus');
                ?>
                <div class="dashboard-stat-card <?= $color ?>">
                    <div class="accent-bar"></div>
                    <div class="stat-icon"><i class="fas <?= $icon ?>"></i></div>
                    <div class="stat-number"><?= is_numeric($value) ? number_format($value) : $value ?></div>
                    <div class="stat-label"><?= $label ?></div>
                    <span class="stat-trend <?= $trendClass ?>">
                        <i class="fas <?= $trendIcon ?>"></i> <?= $trend[1] ?>
                    </span>
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
<!-- ============================================================
     QUICK ACTIONS (Moved Below Cards)
     ============================================================ -->
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

<!-- ============================================================
     MIDDLE ROW: 3-COLUMN PANELS
     ============================================================ -->
<div class="dashboard-panels">

    <!-- Panel 1: Enterprise/Sector Distribution -->
    <div class="panel-card">
        <div class="panel-header">
            <span class="panel-title"><i class="fas fa-map-marker-alt"></i> Enterprise Distribution</span>
            <a href="#" class="panel-action">View All</a>
        </div>
        <div class="panel-body">
            <?php if (!empty($distribution_data)): ?>
                <?php foreach ($distribution_data as $item): ?>
                    <div class="list-item">
                        <div class="item-icon <?= $item['color'] ?? 'blue' ?>">
                            <i class="fas <?= $item['icon'] ?? 'fa-building' ?>"></i>
                        </div>
                        <div class="item-content">
                            <div class="item-title"><?= esc($item['name']) ?></div>
                            <div class="item-sub"><?= esc($item['sub'] ?? 'Enterprises') ?></div>
                        </div>
                        <div class="item-value"><?= $item['value'] ?? 0 ?></div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="empty-state">
                    <i class="fas fa-inbox"></i>
                    <p>No distribution data available</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Panel 2: Top Services/Commodities -->
    <div class="panel-card">
        <div class="panel-header">
            <span class="panel-title"><i class="fas fa-chart-pie"></i> Top Services</span>
            <a href="#" class="panel-action">View All</a>
        </div>
        <div class="panel-body">
            <?php if (!empty($top_services)): ?>
                <?php foreach ($top_services as $item): ?>
                    <div class="list-item">
                        <div class="item-icon <?= $item['color'] ?? 'purple' ?>">
                            <i class="fas <?= $item['icon'] ?? 'fa-concierge-bell' ?>"></i>
                        </div>
                        <div class="item-content">
                            <div class="item-title"><?= esc($item['name']) ?></div>
                            <div class="item-sub"><?= esc($item['sub'] ?? 'Active') ?></div>
                        </div>
                        <div class="item-value"><?= $item['value'] ?? 0 ?></div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="empty-state">
                    <i class="fas fa-inbox"></i>
                    <p>No services data available</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Panel 3: Registration Trend -->
   <!-- Panel 3: Registration Trend -->
<div class="panel-card">
    <div class="panel-header">
        <span class="panel-title"><i class="fas fa-chart-line"></i> Registration Trend</span>
        <a href="#" class="panel-action">View All</a>
    </div>
    <div class="panel-body">
        <?php if (!empty($trend_data)): ?>
            <div style="text-align: center; margin-bottom: 0.3rem;">
                <div style="font-size: 1rem; font-weight: 700; color: var(--ink);">
                    <?= array_sum(array_column($trend_data, 'value')) ?>
                </div>
                <div style="font-size: 0.55rem; color: var(--ink-muted); text-transform: uppercase; letter-spacing: 0.04em;">
                    Total Registered
                </div>
            </div>
            <div style="position: relative; height: 100px; width: 100%;">
                <canvas id="trendChart"></canvas>
            </div>
        <?php else: ?>
            <div class="empty-state">
                <i class="fas fa-inbox"></i>
                <p>No trend data available</p>
            </div>
        <?php endif; ?>
    </div>
</div>
</div>

<!-- ============================================================
     BOTTOM ROW: WIDGETS
     ============================================================ -->
<div class="dashboard-widgets">
    <!-- Widget 1: Recent Activity -->
    <?php if (!empty($recent_activity)): ?>
    <div class="dashboard-widget">
        <div class="widget-header">
            <span><i class="fas fa-clock" style="color: var(--primary);"></i> Recent Activity</span>
            <span class="widget-count"><?= count($recent_activity) ?></span>
        </div>
        <div class="widget-body">
            <?php foreach (array_slice($recent_activity, 0, 5) as $activity): ?>
                <div class="widget-item">
                    <div class="item-title">
                        <?= $activity['message'] ?>
                        <span class="item-sub">· <?= date('M d', strtotime($activity['time'] ?? 'now')) ?></span>
                    </div>
                    <span class="item-date"><?= date('H:i', strtotime($activity['time'] ?? 'now')) ?></span>
                </div>
            <?php endforeach; ?>
            <?php if (count($recent_activity) > 5): ?>
                <div style="text-align: center; padding: 0.35rem;">
                    <a href="#" style="font-size: 0.65rem; color: var(--primary); font-weight: 500;">View all <?= count($recent_activity) ?> activities →</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>

    <!-- Widget 2: Security Alerts -->
    <?php if (!empty($security_alerts)): ?>
    <div class="dashboard-widget">
        <div class="widget-header">
            <span><i class="fas fa-shield-alt" style="color: #f59e0b;"></i> Security Alerts</span>
            <span class="widget-count"><?= count($security_alerts) ?></span>
        </div>
        <div class="widget-body">
            <?php foreach (array_slice($security_alerts, 0, 5) as $alert): ?>
                <div class="widget-item">
                    <div class="item-title">
                        <?= $alert['title'] ?>
                        <span class="item-status status-<?= $alert['status'] ?? 'pending' ?>">
                            <?= $alert['status'] ?? 'New' ?>
                        </span>
                    </div>
                    <span class="item-date"><?= $alert['time'] ?? 'Just now' ?></span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>

    <!-- Widget 3: Verification Status -->
    <?php if (!empty($verification_stats)): ?>
    <div class="dashboard-widget">
        <div class="widget-header">
            <span><i class="fas fa-check-double" style="color: #22c55e;"></i> Verification Status</span>
            <span class="widget-count">
                <?= ($verification_stats['verified'] ?? 0) + ($verification_stats['pending'] ?? 0) ?>
            </span>
        </div>
        <div class="widget-body">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.5rem; padding: 0.5rem 0.85rem;">
                <div style="text-align: center; padding: 0.5rem; background: var(--canvas); border-radius: 6px;">
                    <div style="font-size: 1.2rem; font-weight: 800; color: #22c55e;"><?= $verification_stats['verified'] ?? 0 ?></div>
                    <div style="font-size: 0.55rem; color: var(--ink-muted);">Verified</div>
                </div>
                <div style="text-align: center; padding: 0.5rem; background: var(--canvas); border-radius: 6px;">
                    <div style="font-size: 1.2rem; font-weight: 800; color: #f59e0b;"><?= $verification_stats['pending'] ?? 0 ?></div>
                    <div style="font-size: 0.55rem; color: var(--ink-muted);">Pending</div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>

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
                const trends = {
                    'total_users': ['up', '12%'],
                    'total_enterprises': ['up', '8%'],
                    'total_investors': ['neutral', '0%'],
                    'pending_verifications': ['down', '3%']
                };
                
                for (const [key, value] of Object.entries(data)) {
                    if (typeof value === 'number') {
                        const label = key.replace(/_/g, ' ').replace(/\b\w/g, l => l.toUpperCase());
                        const icon = icons[key] || 'fa-chart-line';
                        const color = colorMap[key] || 'color-primary';
                        const trend = trends[key] || ['neutral', '0%'];
                        const trendIcon = trend[0] === 'up' ? 'fa-arrow-up' : (trend[0] === 'down' ? 'fa-arrow-down' : 'fa-minus');
                        html += `
                            <div class="dashboard-stat-card ${color}">
                                <div class="accent-bar"></div>
                                <div class="stat-icon"><i class="fas ${icon}"></i></div>
                                <div class="stat-number">${value.toLocaleString()}</div>
                                <div class="stat-label">${label}</div>
                                <span class="stat-trend ${trend[0]}">
                                    <i class="fas ${trendIcon}"></i> ${trend[1]}
                                </span>
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

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const trendData = <?= json_encode($trend_data ?? []) ?>;
    
    if (trendData.length > 0) {
        const ctx = document.getElementById('trendChart');
        
        if (ctx) {
            const labels = trendData.map(item => item.label);
            const values = trendData.map(item => item.value);
            const colors = trendData.map(item => item.color || '#078ece');
            
            // Get theme colors
            const isDark = document.documentElement.getAttribute('data-theme') === 'dark';
            const textColor = isDark ? '#8b95a9' : '#5c6b74';
            const borderColor = isDark ? '#2d3344' : '#eef0f2';
            
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Registrations',
                        data: values,
                        borderColor: '#078ece',
                        backgroundColor: 'rgba(7, 142, 206, 0.1)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.3,
                        pointBackgroundColor: colors,
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: isDark ? '#1a1d27' : '#ffffff',
                            titleColor: isDark ? '#e8edf5' : '#1a2332',
                            bodyColor: isDark ? '#8b95a9' : '#5c6b74',
                            borderColor: isDark ? '#2d3344' : '#e3e7ea',
                            borderWidth: 1,
                            cornerRadius: 8,
                            padding: 10,
                            callbacks: {
                                label: function(context) {
                                    return context.parsed.y + ' registrations';
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: borderColor,
                                drawBorder: false,
                            },
                            ticks: {
                                color: textColor,
                                font: {
                                    size: 8,
                                },
                                stepSize: Math.ceil(Math.max(...values) / 5) || 1,
                            }
                        },
                        x: {
                            grid: {
                                display: false,
                            },
                            ticks: {
                                color: textColor,
                                font: {
                                    size: 8,
                                },
                            }
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index',
                    },
                }
            });
        }
    }
});

// Update chart on theme change
document.addEventListener('DOMContentLoaded', function() {
    const observer = new MutationObserver(function() {
        // Re-create chart when theme changes
        const chartCanvas = document.getElementById('trendChart');
        if (chartCanvas && chartCanvas.chart) {
            chartCanvas.chart.destroy();
            // Re-initialize chart (call the chart creation code again)
            const event = new Event('DOMContentLoaded');
            document.dispatchEvent(event);
        }
    });
    
    observer.observe(document.documentElement, {
        attributes: true,
        attributeFilter: ['data-theme']
    });
});
</script>
<?= $this->endSection() ?>