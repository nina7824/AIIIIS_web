<?= $this->extend('layouts/admin') ?>

<?= $this->section('styles') ?>
/* Dashboard Styles */
.dashboard-grid {
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
    transition: all 0.3s ease;
}
.stat-card:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
}
.stat-card .stat-icon {
    font-size: 1.3rem;
    color: var(--primary);
    margin-bottom: 0.3rem;
}
.stat-card .stat-number {
    font-size: 1.8rem;
    font-weight: 800;
    color: var(--ink);
}
.stat-card .stat-label {
    font-size: 0.72rem;
    color: var(--ink-muted);
    font-weight: 500;
}
.two-col-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.5rem;
    margin-bottom: 1.5rem;
}
.chart-container {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 1.5rem;
    margin-bottom: 1.5rem;
}
.chart-container h3 {
    font-size: 0.95rem;
    font-weight: 700;
    margin-bottom: 0.75rem;
}
.chart-bars {
    display: flex;
    align-items: flex-end;
    gap: 0.75rem;
    height: 150px;
    padding-top: 0.5rem;
}
.chart-bar {
    flex: 1;
    background: var(--primary);
    border-radius: 4px 4px 0 0;
    min-height: 10px;
    transition: all 0.3s ease;
    position: relative;
    display: flex;
    flex-direction: column;
    align-items: center;
}
.chart-bar:hover {
    opacity: 0.8;
    transform: scaleY(1.02);
}
.chart-bar .bar-label {
    position: absolute;
    bottom: -20px;
    font-size: 0.55rem;
    color: var(--ink-muted);
    text-align: center;
    white-space: nowrap;
}
.chart-bar .bar-value {
    position: absolute;
    top: -18px;
    font-size: 0.6rem;
    font-weight: 700;
    color: var(--primary);
}
.table-container {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    overflow: hidden;
}
.table-container .table-header {
    padding: 0.75rem 1.5rem;
    border-bottom: 1px solid var(--border);
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 0.5rem;
}
.table-container .table-header h3 {
    font-size: 0.9rem;
    font-weight: 700;
}
.table-container table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.82rem;
}
.table-container th {
    text-align: left;
    padding: 0.5rem 1.5rem;
    font-weight: 600;
    color: var(--ink-muted);
    border-bottom: 1px solid var(--border);
    background: var(--canvas);
    font-size: 0.65rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}
.table-container td {
    padding: 0.5rem 1.5rem;
    border-bottom: 1px solid var(--border);
}
.table-container tr:hover td {
    background: var(--canvas);
}
.badge-status {
    display: inline-block;
    padding: 0.1rem 0.6rem;
    border-radius: 20px;
    font-size: 0.6rem;
    font-weight: 600;
}
.badge-active { background: #e6f7ef; color: #22a67e; }
.badge-pending { background: #fff3cd; color: #856404; }
.badge-high { background: #e6f7ef; color: #22a67e; }
.badge-medium { background: #fff3cd; color: #856404; }
.badge-low { background: #fde8e8; color: #c62828; }
.rank-medal { font-size: 1.1rem; }
.rank-1 { color: #ffd700; }
.rank-2 { color: #c0c0c0; }
.rank-3 { color: #cd7f32; }
.iot-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 0.75rem 1rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 0.5rem;
}
.iot-card .sensor-name {
    font-weight: 600;
    font-size: 0.82rem;
}
.iot-card .sensor-value {
    font-size: 0.82rem;
    font-weight: 700;
    color: var(--primary);
}
.iot-card .sensor-time {
    font-size: 0.65rem;
    color: var(--ink-muted);
}
@media (max-width: 992px) {
    .dashboard-grid { grid-template-columns: repeat(2, 1fr); }
    .two-col-grid { grid-template-columns: 1fr; }
}
@media (max-width: 480px) {
    .dashboard-grid { grid-template-columns: 1fr; }
}
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?php
// Ensure all variables exist with default values
$sector_distribution = $sector_distribution ?? [];
$location_distribution = $location_distribution ?? [];
$top_rankings = $top_rankings ?? [];
$clusters = $clusters ?? [];
$investment_opportunities = $investment_opportunities ?? [];
$recent_investors = $recent_investors ?? [];
$match_stats = $match_stats ?? ['total' => 0, 'pending' => 0, 'accepted' => 0, 'rejected' => 0, 'introduced' => 0, 'negotiating' => 0, 'closed' => 0, 'avg_score' => 0];
$engagement_stats = $engagement_stats ?? ['total' => 0, 'visits' => 0, 'meetings' => 0, 'advisory' => 0, 'training' => 0, 'support' => 0, 'follow_up' => 0];
$iot_data = $iot_data ?? [];
$recent_users = $recent_users ?? [];
$recent_enterprises = $recent_enterprises ?? [];
$stats = $stats ?? ['total_enterprises' => 0, 'total_investors' => 0, 'total_matches' => 0, 'pending_verifications' => 0, 'active_deals' => 0];
?>

<!-- ========== STATS CARDS ========== -->
<div class="dashboard-grid">
    <div class="stat-card">
        <div class="stat-icon"><i class="fas fa-building"></i></div>
        <div class="stat-number"><?= $stats['total_enterprises'] ?? 0 ?></div>
        <div class="stat-label">Total Enterprises</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon"><i class="fas fa-user-tie"></i></div>
        <div class="stat-number"><?= $stats['total_investors'] ?? 0 ?></div>
        <div class="stat-label">Total Investors</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon"><i class="fas fa-handshake"></i></div>
        <div class="stat-number"><?= $stats['total_matches'] ?? 0 ?></div>
        <div class="stat-label">Total Matches</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon"><i class="fas fa-clock"></i></div>
        <div class="stat-number"><?= $stats['pending_verifications'] ?? 0 ?></div>
        <div class="stat-label">Pending Verifications</div>
    </div>
</div>

<!-- ========== SECTOR & LOCATION CHARTS ========== -->
<div class="two-col-grid">
    <div class="chart-container">
        <h3><i class="fas fa-chart-pie" style="color:var(--primary);margin-right:0.5rem;"></i> Enterprises by Sector</h3>
        <?php if (!empty($sector_distribution)): ?>
        <div class="chart-bars">
            <?php 
            $maxCount = max(array_column($sector_distribution, 'count')) ?: 1;
            $colors = ['#078ece', '#045a86', '#22a67e', '#f5a623', '#c62828', '#6a1b9a', '#2e7d32', '#e65100'];
            ?>
            <?php foreach ($sector_distribution as $index => $sector): ?>
                <?php $height = max(($sector['count'] / $maxCount) * 130, 15); ?>
                <div style="flex:1;display:flex;flex-direction:column;align-items:center;height:100%;justify-content:flex-end;">
                    <div class="chart-bar" style="height:<?= $height ?>px;background:<?= $colors[$index % count($colors)] ?>;width:100%;max-width:40px;">
                        <span class="bar-value"><?= $sector['count'] ?></span>
                        <span class="bar-label"><?= esc(substr($sector['sector'] ?? 'Other', 0, 8)) ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <div style="text-align:center;padding:2rem;color:var(--ink-muted);">No sector data available</div>
        <?php endif; ?>
    </div>

    <div class="chart-container">
        <h3><i class="fas fa-map-marker-alt" style="color:var(--primary);margin-right:0.5rem;"></i> Enterprises by Location</h3>
        <?php if (!empty($location_distribution)): ?>
        <div class="chart-bars">
            <?php 
            $maxCount = max(array_column($location_distribution, 'count')) ?: 1;
            $colors = ['#078ece', '#045a86', '#22a67e', '#f5a623', '#c62828', '#6a1b9a', '#2e7d32', '#e65100'];
            ?>
            <?php foreach ($location_distribution as $index => $loc): ?>
                <?php $height = max(($loc['count'] / $maxCount) * 130, 15); ?>
                <div style="flex:1;display:flex;flex-direction:column;align-items:center;height:100%;justify-content:flex-end;">
                    <div class="chart-bar" style="height:<?= $height ?>px;background:<?= $colors[($index + 3) % count($colors)] ?>;width:100%;max-width:40px;">
                        <span class="bar-value"><?= $loc['count'] ?></span>
                        <span class="bar-label"><?= esc(substr($loc['location'] ?? 'Other', 0, 8)) ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <div style="text-align:center;padding:2rem;color:var(--ink-muted);">No location data available</div>
        <?php endif; ?>
    </div>
</div>

<!-- ========== INDUSTRIAL CLUSTERS ========== -->
<div class="chart-container">
    <h3><i class="fas fa-network-wired" style="color:var(--primary);margin-right:0.5rem;"></i> Industrial Clusters</h3>
    <?php if (!empty($clusters)): ?>
    <div style="display:grid;grid-template-columns:repeat(auto-fill, minmax(200px, 1fr));gap:0.75rem;">
        <?php $clusterColors = ['#078ece', '#22a67e', '#f5a623', '#c62828', '#6a1b9a', '#2e7d32', '#e65100', '#0d47a1']; ?>
        <?php foreach ($clusters as $index => $cluster): ?>
            <div style="background:var(--canvas);border:1px solid var(--border);border-radius:var(--radius);padding:0.75rem;text-align:center;">
                <div style="font-weight:700;font-size:0.85rem;color:<?= $clusterColors[$index % count($clusterColors)] ?>;">
                    <?= esc($cluster['sector'] ?? 'Unknown') ?>
                </div>
                <div style="font-size:0.7rem;color:var(--ink-muted);"><?= esc($cluster['location'] ?? 'Unknown') ?></div>
                <div style="font-weight:700;font-size:1rem;color:var(--primary);"><?= $cluster['count'] ?> enterprises</div>
            </div>
        <?php endforeach; ?>
    </div>
    <?php else: ?>
    <div style="text-align:center;padding:2rem;color:var(--ink-muted);">No clusters found</div>
    <?php endif; ?>
</div>

<!-- ========== ENTERPRISE RANKINGS ========== -->
<div class="table-container" style="margin-bottom:1.5rem;">
    <div class="table-header">
        <h3><i class="fas fa-trophy" style="color:var(--primary);margin-right:0.5rem;"></i> Enterprise Rankings</h3>
        <a href="<?= base_url('admin/enterprises') ?>" style="color:var(--primary);font-size:0.78rem;font-weight:600;">View All →</a>
    </div>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Enterprise</th>
                <th>Sector</th>
                <th>Growth</th>
                <th>Innovation</th>
                <th>Sustainability</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($top_rankings)): ?>
                <?php foreach ($top_rankings as $index => $rank): ?>
                    <tr>
                        <td>
                            <?php if ($index == 0): ?>🥇
                            <?php elseif ($index == 1): ?>🥈
                            <?php elseif ($index == 2): ?>🥉
                            <?php else: ?>#<?= $index + 1 ?><?php endif; ?>
                        </td>
                        <td><strong><?= esc($rank['enterprise_name'] ?? 'N/A') ?></strong></td>
                        <td><?= esc($rank['sector'] ?? 'N/A') ?></td>
                        <td><?= $rank['growth_score'] ?? 0 ?>%</td>
                        <td><?= $rank['innovation_score'] ?? 0 ?>%</td>
                        <td><?= $rank['sustainability_score'] ?? 0 ?>%</td>
                        <td>
                            <span class="badge-status <?= ($rank['total_score'] ?? 0) >= 80 ? 'badge-high' : (($rank['total_score'] ?? 0) >= 60 ? 'badge-medium' : 'badge-low') ?>">
                                <?= $rank['total_score'] ?? 0 ?>%
                            </span>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="7" style="text-align:center;padding:2rem;color:var(--ink-muted);">No rankings available</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- ========== INVESTMENT OPPORTUNITIES & MATCH STATS ========== -->
<div class="two-col-grid">
    <div class="table-container">
        <div class="table-header">
            <h3><i class="fas fa-rocket" style="color:var(--primary);margin-right:0.5rem;"></i> Investment Opportunities</h3>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Enterprise</th>
                    <th>Sector</th>
                    <th>Investment Need</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($investment_opportunities)): ?>
                    <?php foreach ($investment_opportunities as $opp): ?>
                        <tr>
                            <td><strong><?= esc($opp['name'] ?? 'N/A') ?></strong></td>
                            <td><?= esc($opp['sector'] ?? 'N/A') ?></td>
                            <td style="color:var(--primary);font-weight:600;">
                                <?= esc(substr($opp['investment_requirements'] ?? 'N/A', 0, 30)) ?>...
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="3" style="text-align:center;padding:2rem;color:var(--ink-muted);">No investment opportunities found</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="chart-container">
        <h3><i class="fas fa-handshake" style="color:var(--primary);margin-right:0.5rem;"></i> Matchmaking Statistics</h3>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:0.5rem;">
            <div style="background:var(--canvas);padding:0.75rem;border-radius:var(--radius);text-align:center;">
                <div style="font-size:0.65rem;color:var(--ink-muted);">Total Matches</div>
                <div style="font-weight:800;font-size:1.2rem;color:var(--primary);"><?= $match_stats['total'] ?? 0 ?></div>
            </div>
            <div style="background:var(--canvas);padding:0.75rem;border-radius:var(--radius);text-align:center;">
                <div style="font-size:0.65rem;color:var(--ink-muted);">Avg Score</div>
                <div style="font-weight:800;font-size:1.2rem;color:var(--primary);"><?= $match_stats['avg_score'] ?? 0 ?>%</div>
            </div>
            <div style="background:var(--canvas);padding:0.75rem;border-radius:var(--radius);text-align:center;">
                <div style="font-size:0.65rem;color:var(--ink-muted);">Pending</div>
                <div style="font-weight:800;font-size:1rem;color:#856404;"><?= $match_stats['pending'] ?? 0 ?></div>
            </div>
            <div style="background:var(--canvas);padding:0.75rem;border-radius:var(--radius);text-align:center;">
                <div style="font-size:0.65rem;color:var(--ink-muted);">Accepted</div>
                <div style="font-weight:800;font-size:1rem;color:#22a67e;"><?= $match_stats['accepted'] ?? 0 ?></div>
            </div>
            <div style="background:var(--canvas);padding:0.75rem;border-radius:var(--radius);text-align:center;">
                <div style="font-size:0.65rem;color:var(--ink-muted);">Introduced</div>
                <div style="font-weight:800;font-size:1rem;color:#0d47a1;"><?= $match_stats['introduced'] ?? 0 ?></div>
            </div>
            <div style="background:var(--canvas);padding:0.75rem;border-radius:var(--radius);text-align:center;">
                <div style="font-size:0.65rem;color:var(--ink-muted);">Negotiating</div>
                <div style="font-weight:800;font-size:1rem;color:#6a1b9a;"><?= $match_stats['negotiating'] ?? 0 ?></div>
            </div>
        </div>
    </div>
</div>

<!-- ========== INVESTOR ACTIVITY & ENGAGEMENT STATS ========== -->
<div class="two-col-grid">
    <div class="table-container">
        <div class="table-header">
            <h3><i class="fas fa-user-tie" style="color:var(--primary);margin-right:0.5rem;"></i> Recent Investor Activity</h3>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Investment Sector</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($recent_investors)): ?>
                    <?php foreach ($recent_investors as $investor): ?>
                        <tr>
                            <td><strong><?= esc($investor['name'] ?? 'N/A') ?></strong></td>
                            <td><?= ucfirst(str_replace('_', ' ', $investor['type'] ?? 'N/A')) ?></td>
                            <td><?= esc(substr($investor['investment_sector'] ?? 'N/A', 0, 25)) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="3" style="text-align:center;padding:2rem;color:var(--ink-muted);">No investors found</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="chart-container">
        <h3><i class="fas fa-comments" style="color:var(--primary);margin-right:0.5rem;"></i> Engagement Statistics</h3>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:0.5rem;">
            <?php 
            $engagementTypes = [
                'visits' => ['icon' => 'fa-walking', 'label' => 'Visits', 'color' => '#078ece'],
                'meetings' => ['icon' => 'fa-handshake', 'label' => 'Meetings', 'color' => '#22a67e'],
                'advisory' => ['icon' => 'fa-chalkboard-teacher', 'label' => 'Advisory', 'color' => '#f5a623'],
                'training' => ['icon' => 'fa-graduation-cap', 'label' => 'Training', 'color' => '#6a1b9a'],
                'support' => ['icon' => 'fa-headset', 'label' => 'Support', 'color' => '#0d47a1'],
                'follow_up' => ['icon' => 'fa-phone', 'label' => 'Follow-ups', 'color' => '#e65100']
            ];
            ?>
            <?php foreach ($engagementTypes as $key => $type): ?>
                <div style="background:var(--canvas);padding:0.5rem 0.75rem;border-radius:var(--radius);display:flex;justify-content:space-between;align-items:center;">
                    <span style="font-size:0.7rem;color:var(--ink-muted);">
                        <i class="fas <?= $type['icon'] ?>" style="color:<?= $type['color'] ?>;width:16px;"></i>
                        <?= $type['label'] ?>
                    </span>
                    <span style="font-weight:700;font-size:0.9rem;color:<?= $type['color'] ?>;">
                        <?= $engagement_stats[$key] ?? 0 ?>
                    </span>
                </div>
            <?php endforeach; ?>
        </div>
        <div style="margin-top:0.75rem;padding-top:0.75rem;border-top:1px solid var(--border);display:flex;justify-content:space-between;">
            <span style="font-weight:600;">Total Engagements</span>
            <span style="font-weight:800;font-size:1.1rem;color:var(--primary);"><?= $engagement_stats['total'] ?? 0 ?></span>
        </div>
    </div>
</div>

<!-- ========== IoT DATA ========== -->
<div class="chart-container">
    <h3><i class="fas fa-microchip" style="color:var(--primary);margin-right:0.5rem;"></i> IoT Sensor Data</h3>
    <?php if (!empty($iot_data)): ?>
        <div style="display:grid;grid-template-columns:repeat(auto-fill, minmax(250px, 1fr));gap:0.75rem;">
            <?php foreach ($iot_data as $sensor): ?>
                <div class="iot-card">
                    <div>
                        <div class="sensor-name"><?= esc($sensor['sensor_name'] ?? 'Unknown') ?></div>
                        <div class="sensor-time"><i class="far fa-clock"></i> <?= date('M d, H:i', strtotime($sensor['timestamp'])) ?></div>
                    </div>
                    <div style="text-align:right;">
                        <div class="sensor-value"><?= esc($sensor['value'] ?? 'N/A') ?> <?= esc($sensor['unit'] ?? '') ?></div>
                        <div style="font-size:0.6rem;color:var(--ink-muted);"><?= esc($sensor['parameter'] ?? '') ?></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div style="text-align:center;padding:2rem;color:var(--ink-muted);">
            <i class="fas fa-microchip" style="font-size:2rem;display:block;margin-bottom:0.5rem;opacity:0.3;"></i>
            No IoT data available
        </div>
    <?php endif; ?>
</div>

<!-- ========== RECENT USERS ========== -->
<div class="table-container" style="margin-bottom:1.5rem;">
    <div class="table-header">
        <h3><i class="fas fa-users" style="color:var(--primary);margin-right:0.5rem;"></i> Recent Users</h3>
        <a href="<?= base_url('admin/users') ?>" style="color:var(--primary);font-size:0.78rem;font-weight:600;">View All →</a>
    </div>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Status</th>
                <th>Joined</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($recent_users)): ?>
                <?php foreach ($recent_users as $user): ?>
                    <tr>
                        <td>#<?= $user['user_id'] ?></td>
                        <td><strong><?= esc($user['name']) ?></strong></td>
                        <td><?= esc($user['email']) ?></td>
                        <td>
                            <span class="badge-status badge-<?= str_replace('_', '', $user['role']) ?>">
                                <?= ucfirst(str_replace('_', ' ', $user['role'])) ?>
                            </span>
                        </td>
                        <td>
                            <span class="badge-status <?= $user['is_active'] ? 'badge-active' : 'badge-inactive' ?>">
                                <?= $user['is_active'] ? 'Active' : 'Inactive' ?>
                            </span>
                        </td>
                        <td><?= date('M d, Y', strtotime($user['created_at'])) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="6" style="text-align:center;padding:2rem;color:var(--ink-muted);">No users found</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- ========== RECENT ENTERPRISES ========== -->
<div class="table-container">
    <div class="table-header">
        <h3><i class="fas fa-building" style="color:var(--primary);margin-right:0.5rem;"></i> Recent Enterprises</h3>
        <a href="<?= base_url('admin/enterprises') ?>" style="color:var(--primary);font-size:0.78rem;font-weight:600;">View All →</a>
    </div>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Sector</th>
                <th>Location</th>
                <th>Status</th>
                <th>Verified</th>
                <th>Joined</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($recent_enterprises)): ?>
                <?php foreach ($recent_enterprises as $enterprise): ?>
                    <tr>
                        <td>#<?= $enterprise['enterprise_id'] ?></td>
                        <td><strong><?= esc($enterprise['name']) ?></strong></td>
                        <td><?= esc($enterprise['sector'] ?? 'N/A') ?></td>
                        <td><?= esc($enterprise['location'] ?? 'N/A') ?></td>
                        <td>
                            <span class="badge-status <?= $enterprise['status'] === 'active' ? 'badge-active' : ($enterprise['status'] === 'pending' ? 'badge-pending' : 'badge-inactive') ?>">
                                <?= ucfirst($enterprise['status'] ?? 'pending') ?>
                            </span>
                        </td>
                        <td>
                            <span class="badge-status <?= $enterprise['is_verified'] ? 'badge-active' : 'badge-pending' ?>">
                                <?= $enterprise['is_verified'] ? 'Yes' : 'Pending' ?>
                            </span>
                        </td>
                        <td><?= date('M d, Y', strtotime($enterprise['created_at'])) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="7" style="text-align:center;padding:2rem;color:var(--ink-muted);">No enterprises found</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>