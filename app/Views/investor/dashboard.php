<?= $this->extend('layouts/admin') ?>

<?= $this->section('styles') ?>
/* Investor Dashboard Styles */
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
.badge-rejected { background: #fde8e8; color: #c62828; }
.badge-introduced { background: #e3f2fd; color: #0d47a1; }
.badge-negotiating { background: #f3e5f5; color: #6a1b9a; }
.badge-closed { background: #e8eaf6; color: #283593; }
.badge-high { background: #e6f7ef; color: #22a67e; }
.badge-medium { background: #fff3cd; color: #856404; }
.badge-low { background: #fde8e8; color: #c62828; }
.progress-bar {
    height: 6px;
    background: var(--border);
    border-radius: 4px;
    overflow: hidden;
    margin-top: 0.25rem;
}
.progress-bar .progress-fill {
    height: 100%;
    border-radius: 4px;
    transition: width 0.6s ease;
}
.progress-fill.negotiating { background: #f5a623; }
.progress-fill.agreed { background: #0d47a1; }
.progress-fill.signed { background: #6a1b9a; }
.progress-fill.completed { background: #22a67e; }
.enterprise-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 1rem;
    transition: all 0.3s ease;
}
.enterprise-card:hover {
    border-color: var(--primary);
    box-shadow: var(--shadow-sm);
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

<!-- Welcome Section -->
<div style="background:var(--surface);border:1px solid var(--border);border-radius:var(--radius);padding:1.5rem;margin-bottom:1.5rem;">
    <h2 style="font-size:1.2rem;font-weight:700;margin-bottom:0.25rem;">Welcome back, <?= $user['name'] ?>! 👋</h2>
    <p style="color:var(--ink-muted);font-size:0.9rem;">
        Here's an overview of your investment activity, matches, and opportunities.
    </p>
</div>

<!-- ========== STATS CARDS ========== -->
<div class="dashboard-grid">
    <div class="stat-card">
        <div class="stat-icon"><i class="fas fa-handshake"></i></div>
        <div class="stat-number"><?= $stats['total_matches'] ?? 0 ?></div>
        <div class="stat-label">Total Matches</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon"><i class="fas fa-check-circle"></i></div>
        <div class="stat-number"><?= $stats['accepted_matches'] ?? 0 ?></div>
        <div class="stat-label">Accepted Matches</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon"><i class="fas fa-users"></i></div>
        <div class="stat-number"><?= $stats['introductions'] ?? 0 ?></div>
        <div class="stat-label">Introductions</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon"><i class="fas fa-bookmark"></i></div>
        <div class="stat-number"><?= $stats['saved_enterprises'] ?? 0 ?></div>
        <div class="stat-label">Saved Enterprises</div>
    </div>
</div>

<!-- Investment Summary -->
<div class="two-col-grid">
    <div class="stat-card" style="margin-bottom:0;">
        <div class="stat-icon"><i class="fas fa-dollar-sign" style="color:#22a67e;"></i></div>
        <div class="stat-number" style="color:#22a67e;">$<?= number_format($stats['total_investment'] ?? 0) ?></div>
        <div class="stat-label">Total Investment</div>
    </div>
    <div class="stat-card" style="margin-bottom:0;">
        <div class="stat-icon"><i class="fas fa-file-signature" style="color:#f5a623;"></i></div>
        <div class="stat-number" style="color:#f5a623;"><?= $stats['active_deals'] ?? 0 ?></div>
        <div class="stat-label">Active Deals</div>
    </div>
</div>

<!-- ========== RECOMMENDED ENTERPRISES ========== -->
<div class="chart-container">
    <h3><i class="fas fa-star" style="color:var(--primary);margin-right:0.5rem;"></i> Recommended Enterprises</h3>
    <div style="display:grid;grid-template-columns:repeat(auto-fill, minmax(280px, 1fr));gap:1rem;">
        <?php if (!empty($recommended_enterprises)): ?>
            <?php foreach ($recommended_enterprises as $enterprise): ?>
                <div class="enterprise-card">
                    <div style="display:flex;justify-content:space-between;align-items:flex-start;">
                        <div>
                            <div style="font-weight:700;font-size:0.9rem;"><?= esc($enterprise['name'] ?? 'N/A') ?></div>
                            <div style="font-size:0.7rem;color:var(--ink-muted);"><?= esc($enterprise['sector'] ?? 'N/A') ?></div>
                            <div style="font-size:0.7rem;color:var(--ink-muted);">📍 <?= esc($enterprise['location'] ?? 'N/A') ?></div>
                        </div>
                        <span class="badge-status <?= ($enterprise['total_score'] ?? 0) >= 80 ? 'badge-high' : (($enterprise['total_score'] ?? 0) >= 60 ? 'badge-medium' : 'badge-low') ?>">
                            <?= $enterprise['total_score'] ?? 0 ?>%
                        </span>
                    </div>
                    <div style="margin-top:0.5rem;display:flex;gap:0.5rem;flex-wrap:wrap;">
                        <span style="font-size:0.6rem;color:var(--ink-muted);">💡 Innovation: <?= $enterprise['innovation_score'] ?? 0 ?>%</span>
                        <span style="font-size:0.6rem;color:var(--ink-muted);">📈 Growth: <?= $enterprise['growth_score'] ?? 0 ?>%</span>
                        <span style="font-size:0.6rem;color:var(--ink-muted);">🌱 Sustainability: <?= $enterprise['sustainability_score'] ?? 0 ?>%</span>
                    </div>
                    <div style="margin-top:0.5rem;display:flex;gap:0.5rem;">
                        <button class="btn-sm btn-primary-sm" onclick="alert('Connect with <?= $enterprise['name'] ?>')" style="flex:1;">
                            <i class="fas fa-handshake"></i> Connect
                        </button>
                        <button class="btn-sm" style="background:var(--canvas);color:var(--ink);flex:1;" onclick="saveEnterprise(<?= $enterprise['enterprise_id'] ?>, this)">
                            <i class="fas fa-bookmark"></i> Save
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div style="text-align:center;padding:2rem;color:var(--ink-muted);grid-column:1/-1;">No recommendations available</div>
        <?php endif; ?>
    </div>
</div>

<!-- ========== MATCHES WITH SCORES ========== -->
<div class="table-container" style="margin-bottom:1.5rem;">
    <div class="table-header">
        <h3><i class="fas fa-handshake" style="color:var(--primary);margin-right:0.5rem;"></i> My Matches</h3>
        <a href="<?= base_url('investor/matches') ?>" style="color:var(--primary);font-size:0.78rem;font-weight:600;">View All →</a>
    </div>
    <table>
        <thead>
            <tr>
                <th>Enterprise</th>
                <th>Sector</th>
                <th>Match Score</th>
                <th>Status</th>
                <th>Date</th>
                <th style="text-align:center;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($matches)): ?>
                <?php foreach ($matches as $match): ?>
                    <tr>
                        <td><strong><?= esc($match['enterprise_name'] ?? 'N/A') ?></strong></td>
                        <td><?= esc($match['sector'] ?? 'N/A') ?></td>
                        <td>
                            <span class="badge-status <?= ($match['match_score'] ?? 0) >= 80 ? 'badge-high' : (($match['match_score'] ?? 0) >= 60 ? 'badge-medium' : 'badge-low') ?>">
                                <?= $match['match_score'] ?? 0 ?>%
                            </span>
                        </td>
                        <td>
                            <span class="badge-status badge-<?= $match['status'] ?? 'pending' ?>">
                                <?= ucfirst($match['status'] ?? 'Pending') ?>
                            </span>
                        </td>
                        <td><?= date('M d, Y', strtotime($match['created_at'])) ?></td>
                        <td style="text-align:center;">
                            <button class="btn-sm btn-primary-sm" onclick="alert('View match details for <?= $match['enterprise_name'] ?>')">
                                <i class="fas fa-eye"></i>
                            </button>
                            <?php if ($match['status'] == 'pending'): ?>
                                <button class="btn-sm btn-primary-sm" onclick="requestIntroduction(<?= $match['match_id'] ?>, this)">
                                    <i class="fas fa-user-plus"></i>
                                </button>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="6" style="text-align:center;padding:2rem;color:var(--ink-muted);">No matches found</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- ========== INVESTMENT OPPORTUNITIES ========== -->
<div class="table-container" style="margin-bottom:1.5rem;">
    <div class="table-header">
        <h3><i class="fas fa-rocket" style="color:var(--primary);margin-right:0.5rem;"></i> Investment Opportunities</h3>
    </div>
    <table>
        <thead>
            <tr>
                <th>Enterprise</th>
                <th>Sector</th>
                <th>Location</th>
                <th>Score</th>
                <th>Investment Need</th>
                <th style="text-align:center;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($investment_opportunities)): ?>
                <?php foreach ($investment_opportunities as $opp): ?>
                    <tr>
                        <td><strong><?= esc($opp['name'] ?? 'N/A') ?></strong></td>
                        <td><?= esc($opp['sector'] ?? 'N/A') ?></td>
                        <td><?= esc($opp['location'] ?? 'N/A') ?></td>
                        <td>
                            <span class="badge-status <?= ($opp['total_score'] ?? 0) >= 80 ? 'badge-high' : (($opp['total_score'] ?? 0) >= 60 ? 'badge-medium' : 'badge-low') ?>">
                                <?= $opp['total_score'] ?? 0 ?>%
                            </span>
                        </td>
                        <td style="color:var(--primary);font-weight:600;max-width:150px;word-wrap:break-word;">
                            <?= esc(substr($opp['investment_requirements'] ?? 'N/A', 0, 50)) ?>...
                        </td>
                        <td style="text-align:center;">
                            <button class="btn-sm btn-primary-sm" onclick="alert('Connect with <?= $opp['name'] ?> for investment opportunity')">
                                <i class="fas fa-handshake"></i>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="6" style="text-align:center;padding:2rem;color:var(--ink-muted);">No investment opportunities found</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- ========== SAVED ENTERPRISES & INTRODUCTIONS ========== -->
<div class="two-col-grid">
    <!-- Saved Enterprises -->
    <div class="table-container">
        <div class="table-header">
            <h3><i class="fas fa-bookmark" style="color:var(--primary);margin-right:0.5rem;"></i> Saved Enterprises</h3>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Sector</th>
                    <th>Location</th>
                    <th style="text-align:center;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($saved_enterprises)): ?>
                    <?php foreach ($saved_enterprises as $saved): ?>
                        <tr>
                            <td><strong><?= esc($saved['enterprise_name'] ?? 'N/A') ?></strong></td>
                            <td><?= esc($saved['sector'] ?? 'N/A') ?></td>
                            <td><?= esc($saved['location'] ?? 'N/A') ?></td>
                            <td style="text-align:center;">
                                <button class="btn-sm btn-primary-sm" onclick="alert('View <?= $saved['enterprise_name'] ?>')">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn-sm btn-danger-sm" onclick="saveEnterprise(<?= $saved['enterprise_id'] ?>, this)">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="4" style="text-align:center;padding:2rem;color:var(--ink-muted);">No saved enterprises</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Introductions -->
    <div class="table-container">
        <div class="table-header">
            <h3><i class="fas fa-user-plus" style="color:var(--primary);margin-right:0.5rem;"></i> Introductions</h3>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Enterprise</th>
                    <th>Sector</th>
                    <th>Date</th>
                    <th style="text-align:center;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($introductions)): ?>
                    <?php foreach ($introductions as $intro): ?>
                        <tr>
                            <td><strong><?= esc($intro['enterprise_name'] ?? 'N/A') ?></strong></td>
                            <td><?= esc($intro['sector'] ?? 'N/A') ?></td>
                            <td><?= date('M d, Y', strtotime($intro['introduced_date'] ?? $intro['created_at'])) ?></td>
                            <td style="text-align:center;">
                                <button class="btn-sm btn-primary-sm" onclick="alert('Contact <?= $intro['enterprise_name'] ?>')">
                                    <i class="fas fa-phone"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="4" style="text-align:center;padding:2rem;color:var(--ink-muted);">No introductions yet</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- ========== DEAL PROGRESS ========== -->
<div class="chart-container">
    <h3><i class="fas fa-chart-line" style="color:var(--primary);margin-right:0.5rem;"></i> Deal Progress</h3>
    <?php if (!empty($deal_progress)): ?>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
            <?php foreach ($deal_progress as $deal): ?>
                <div style="background:var(--canvas);border:1px solid var(--border);border-radius:var(--radius);padding:1rem;">
                    <div style="display:flex;justify-content:space-between;align-items:center;">
                        <div>
                            <div style="font-weight:600;font-size:0.9rem;"><?= esc($deal['enterprise_name'] ?? 'N/A') ?></div>
                            <div style="font-size:0.7rem;color:var(--ink-muted);"><?= esc($deal['sector'] ?? 'N/A') ?></div>
                        </div>
                        <span class="badge-status badge-<?= $deal['status'] ?? 'negotiating' ?>">
                            <?= ucfirst($deal['status'] ?? 'Negotiating') ?>
                        </span>
                    </div>
                    <div style="margin-top:0.5rem;">
                        <div style="display:flex;justify-content:space-between;font-size:0.7rem;">
                            <span>Progress</span>
                            <span style="font-weight:600;"><?= $deal['progress_percentage'] ?? 0 ?>%</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill <?= $deal['status'] ?? 'negotiating' ?>" style="width:<?= $deal['progress_percentage'] ?? 0 ?>%;"></div>
                        </div>
                    </div>
                    <?php if ($deal['deal_amount']): ?>
                        <div style="margin-top:0.5rem;font-size:0.7rem;color:var(--ink-muted);">
                            💰 Amount: $<?= number_format($deal['deal_amount'] ?? 0) ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($deal['expected_close_date']): ?>
                        <div style="font-size:0.7rem;color:var(--ink-muted);">
                            📅 Expected Close: <?= date('M d, Y', strtotime($deal['expected_close_date'])) ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div style="text-align:center;padding:2rem;color:var(--ink-muted);">No active deals</div>
    <?php endif; ?>
</div>

<!-- ========== MATCH STATUS DISTRIBUTION ========== -->
<div class="chart-container" style="margin-bottom:0;">
    <h3><i class="fas fa-chart-pie" style="color:var(--primary);margin-right:0.5rem;"></i> Match Status Distribution</h3>
    <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(120px, 1fr));gap:0.75rem;">
        <?php 
        $statusColors = [
            'pending' => '#856404',
            'accepted' => '#22a67e',
            'rejected' => '#c62828',
            'introduced' => '#0d47a1',
            'negotiating' => '#6a1b9a',
            'closed' => '#283593'
        ];
        $statusLabels = [
            'pending' => 'Pending',
            'accepted' => 'Accepted',
            'rejected' => 'Rejected',
            'introduced' => 'Introduced',
            'negotiating' => 'Negotiating',
            'closed' => 'Closed'
        ];
        ?>
        <?php foreach ($match_status_distribution as $status): ?>
            <?php if (isset($statusColors[$status['status']])): ?>
                <div style="background:var(--canvas);padding:0.75rem;border-radius:var(--radius);text-align:center;border-left:3px solid <?= $statusColors[$status['status']] ?>;">
                    <div style="font-size:0.65rem;color:var(--ink-muted);"><?= $statusLabels[$status['status']] ?? $status['status'] ?></div>
                    <div style="font-weight:800;font-size:1.2rem;color:<?= $statusColors[$status['status']] ?>;"><?= $status['count'] ?></div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>

<script>
function saveEnterprise(enterpriseId, button) {
    fetch('<?= base_url('investor/save-enterprise') ?>', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: 'enterprise_id=' + enterpriseId
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            if (data.action === 'saved') {
                button.innerHTML = '<i class="fas fa-bookmark"></i> Saved';
                button.style.background = '#22a67e';
                button.style.color = '#fff';
            } else {
                button.innerHTML = '<i class="fas fa-bookmark"></i> Save';
                button.style.background = 'var(--canvas)';
                button.style.color = 'var(--ink)';
            }
            // Refresh the page to update saved count
            setTimeout(() => location.reload(), 1000);
        }
    })
    .catch(error => console.error('Error:', error));
}

function requestIntroduction(matchId, button) {
    if (!confirm('Request introduction with this enterprise?')) return;
    
    fetch('<?= base_url('investor/request-introduction') ?>', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: 'match_id=' + matchId
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Introduction request sent successfully!');
            location.reload();
        } else {
            alert(data.message || 'Error requesting introduction');
        }
    })
    .catch(error => console.error('Error:', error));
}
</script>

<?= $this->endSection() ?>