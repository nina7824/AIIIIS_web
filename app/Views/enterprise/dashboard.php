<?= $this->extend('layouts/admin') ?>

<?= $this->section('styles') ?>
/* Enterprise Dashboard Styles */
.enterprise-dashboard {
    max-width: 1400px;
    margin: 0 auto;
}

/* Stats Grid */
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
    position: relative;
    overflow: hidden;
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
    letter-spacing: -0.02em;
}
.stat-card .stat-label {
    font-size: 0.72rem;
    color: var(--ink-muted);
    font-weight: 500;
}
.stat-card .stat-progress {
    margin-top: 0.5rem;
    height: 4px;
    background: var(--border);
    border-radius: 4px;
    overflow: hidden;
}
.stat-card .stat-progress .fill {
    height: 100%;
    background: linear-gradient(90deg, var(--primary) 0%, var(--primary-dark) 100%);
    border-radius: 4px;
    transition: width 0.6s ease;
}
.stat-card .stat-trend {
    display: inline-flex;
    align-items: center;
    gap: 0.3rem;
    font-size: 0.6rem;
    font-weight: 600;
    margin-top: 0.3rem;
    padding: 0.1rem 0.5rem;
    border-radius: 20px;
}
.stat-trend.up { background: #e6f7ef; color: #22a67e; }
.stat-trend.down { background: #fde8e8; color: #c62828; }

/* Quick Actions Grid */
.quick-actions {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 1rem;
    margin-bottom: 1.5rem;
}
.quick-action {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 1rem;
    text-align: center;
    transition: all 0.3s ease;
    cursor: pointer;
    text-decoration: none;
    color: var(--ink);
}
.quick-action:hover {
    border-color: var(--primary);
    transform: translateY(-2px);
    box-shadow: var(--shadow-sm);
}
.quick-action .icon {
    font-size: 1.5rem;
    color: var(--primary);
    display: block;
    margin-bottom: 0.3rem;
}
.quick-action .label {
    font-size: 0.78rem;
    font-weight: 600;
}

/* Two Column Grid */
.two-col-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.5rem;
    margin-bottom: 1.5rem;
}

/* Table Container */
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
.table-container tr:last-child td {
    border-bottom: none;
}

/* Badge Status */
.badge-status {
    display: inline-block;
    padding: 0.1rem 0.6rem;
    border-radius: 20px;
    font-size: 0.6rem;
    font-weight: 600;
}
.badge-pending { background: #fff3cd; color: #856404; }
.badge-accepted { background: #e6f7ef; color: #22a67e; }
.badge-rejected { background: #fde8e8; color: #c62828; }
.badge-introduced { background: #e3f2fd; color: #0d47a1; }
.badge-negotiating { background: #f3e5f5; color: #6a1b9a; }
.badge-closed { background: #e8eaf6; color: #283593; }
.badge-open { background: #e3f2fd; color: #0d47a1; }
.badge-in_progress { background: #fff3cd; color: #856404; }
.badge-resolved { background: #e6f7ef; color: #22a67e; }
.badge-approved { background: #e6f7ef; color: #22a67e; }
.badge-high { background: #e6f7ef; color: #22a67e; }
.badge-medium { background: #fff3cd; color: #856404; }
.badge-low { background: #fde8e8; color: #c62828; }
.badge-available { background: #e6f7ef; color: #22a67e; }
.badge-busy { background: #fff3cd; color: #856404; }
.badge-unavailable { background: #fde8e8; color: #c62828; }
.badge-active { background: #e6f7ef; color: #22a67e; }
.badge-verified { background: #e6f7ef; color: #22a67e; }
.badge-women { background: #f3e5f5; color: #6a1b9a; }

/* Notification Item */
.notification-item {
    display: flex;
    align-items: flex-start;
    gap: 0.75rem;
    padding: 0.6rem 1.5rem;
    border-bottom: 1px solid var(--border);
    transition: var(--transition);
}
.notification-item:last-child {
    border-bottom: none;
}
.notification-item:hover {
    background: var(--canvas);
}
.notification-item .icon {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.7rem;
    flex-shrink: 0;
}
.notification-item .icon.match { background: #e3f2fd; color: #0d47a1; }
.notification-item .icon.investor { background: #f3e5f5; color: #6a1b9a; }
.notification-item .icon.advisory { background: #fff3e0; color: #e65100; }
.notification-item .icon.system { background: #e8eaf6; color: #283593; }
.notification-item .icon.deal { background: #e8f5e9; color: #2e7d32; }
.notification-item .icon.meeting { background: #fce4ec; color: #880e4f; }
.notification-item .content {
    flex: 1;
}
.notification-item .content .title {
    font-weight: 600;
    font-size: 0.85rem;
}
.notification-item .content .message {
    font-size: 0.78rem;
    color: var(--ink-muted);
}
.notification-item .time {
    font-size: 0.65rem;
    color: var(--ink-muted);
    white-space: nowrap;
}
.notification-item.unread {
    background: var(--primary-light);
    border-left: 3px solid var(--primary);
}
.notification-item .btn-dismiss {
    background: none;
    border: none;
    color: var(--ink-muted);
    cursor: pointer;
    font-size: 0.7rem;
    padding: 0.2rem 0.5rem;
    border-radius: var(--radius);
    transition: var(--transition);
}
.notification-item .btn-dismiss:hover {
    background: var(--canvas);
    color: var(--ink);
}

/* Responsive */
@media (max-width: 992px) {
    .dashboard-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    .quick-actions {
        grid-template-columns: repeat(2, 1fr);
    }
    .two-col-grid {
        grid-template-columns: 1fr;
    }
}
@media (max-width: 480px) {
    .dashboard-grid {
        grid-template-columns: 1fr;
    }
    .quick-actions {
        grid-template-columns: 1fr;
    }
}
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="enterprise-dashboard">

    <!-- ========== WELCOME SECTION ========== -->
    <div style="background:linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);border-radius:var(--radius-lg);padding:1.75rem 2rem;margin-bottom:1.5rem;color:#fff;">
        <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:1rem;">
            <div>
                <h2 style="font-size:1.3rem;font-weight:800;margin-bottom:0.25rem;">
                    Welcome, <?= $enterprise['name'] ?? 'Enterprise' ?>! 👋
                </h2>
                <p style="opacity:0.85;font-size:0.9rem;">
                    <?php if (($stats['profile_complete'] ?? 0) < 100): ?>
                        <i class="fas fa-info-circle"></i> 
                        Complete your profile (<strong><?= $stats['profile_complete'] ?? 0 ?>%</strong>) to improve your ranking and attract more investors.
                        <a href="<?= base_url('enterprise/edit-profile') ?>" style="color:#fff;text-decoration:underline;font-weight:600;">
                            Update Profile <i class="fas fa-arrow-right"></i>
                        </a>
                    <?php else: ?>
                        Your profile is complete! You're ready to attract investors.
                    <?php endif; ?>
                </p>
            </div>
            <div style="background:rgba(255,255,255,0.15);padding:0.5rem 1rem;border-radius:var(--radius);text-align:center;">
                <div style="font-size:0.65rem;opacity:0.7;">AI Ranking Score</div>
                <div style="font-size:1.5rem;font-weight:800;"><?= $stats['ranking'] ?? 0 ?>%</div>
            </div>
        </div>
    </div>

    <!-- ========== STATS CARDS ========== -->
    <div class="dashboard-grid">
        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-trophy"></i></div>
            <div class="stat-number"><?= $stats['ranking'] ?? 0 ?>%</div>
            <div class="stat-label">Enterprise Ranking</div>
            <div class="stat-progress">
                <div class="fill" style="width:<?= $stats['ranking'] ?? 0 ?>%;"></div>
            </div>
            <?php if ($stats['ranking'] >= 80): ?>
                <span class="stat-trend up"><i class="fas fa-arrow-up"></i> Excellent</span>
            <?php elseif ($stats['ranking'] >= 60): ?>
                <span class="stat-trend up"><i class="fas fa-arrow-up"></i> Good</span>
            <?php else: ?>
                <span class="stat-trend down"><i class="fas fa-arrow-down"></i> Needs Improvement</span>
            <?php endif; ?>
        </div>
        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-handshake"></i></div>
            <div class="stat-number"><?= $stats['total_matches'] ?? 0 ?></div>
            <div class="stat-label">Total Matches</div>
            <?php if (($stats['pending_matches'] ?? 0) > 0): ?>
                <div style="font-size:0.65rem;color:var(--ink-muted);margin-top:0.2rem;">
                    <?= $stats['pending_matches'] ?? 0 ?> pending
                </div>
            <?php endif; ?>
        </div>
        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-user-tie"></i></div>
            <div class="stat-number"><?= $stats['investor_interest'] ?? 0 ?></div>
            <div class="stat-label">Investor Interest</div>
            <?php if (($stats['investor_interest'] ?? 0) > 0): ?>
                <span class="stat-trend up"><i class="fas fa-arrow-up"></i> New interest</span>
            <?php endif; ?>
        </div>
        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-bell"></i></div>
            <div class="stat-number"><?= $stats['unread_notifications'] ?? 0 ?></div>
            <div class="stat-label">Unread Notifications</div>
            <?php if (($stats['unread_notifications'] ?? 0) > 0): ?>
                <a href="<?= base_url('enterprise/notifications') ?>" style="font-size:0.65rem;color:var(--primary);font-weight:600;">
                    View all <i class="fas fa-arrow-right"></i>
                </a>
            <?php endif; ?>
        </div>
    </div>

    <!-- ========== QUICK ACTIONS ========== -->
    <div class="quick-actions">
        <a href="<?= base_url('enterprise/investment') ?>" class="quick-action">
            <span class="icon"><i class="fas fa-rocket"></i></span>
            <span class="label">Submit Investment</span>
        </a>
        <a href="<?= base_url('enterprise/advisory') ?>" class="quick-action">
            <span class="icon"><i class="fas fa-chalkboard-teacher"></i></span>
            <span class="label">Request Advisory</span>
        </a>
        <a href="<?= base_url('enterprise/helpdesk') ?>" class="quick-action">
            <span class="icon"><i class="fas fa-headset"></i></span>
            <span class="label">Helpdesk</span>
        </a>
        <a href="<?= base_url('enterprise/matches') ?>" class="quick-action">
            <span class="icon"><i class="fas fa-handshake"></i></span>
            <span class="label">View Matches</span>
        </a>
    </div>

    <!-- ========== MATCHES & INVESTMENT OPPORTUNITIES ========== -->
    <div class="two-col-grid">
        <!-- Recent Investor Matches -->
        <div class="table-container">
            <div class="table-header">
                <h3><i class="fas fa-handshake" style="color:var(--primary);margin-right:0.5rem;"></i> Recent Investor Matches</h3>
                <a href="<?= base_url('enterprise/matches') ?>" style="color:var(--primary);font-size:0.78rem;font-weight:600;">View All →</a>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Investor</th>
                        <th>Score</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($matches)): ?>
                        <?php foreach (array_slice($matches, 0, 5) as $match): ?>
                            <tr>
                                <td><strong><?= esc($match['investor_name'] ?? 'N/A') ?></strong></td>
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
                                <td><?= date('M d', strtotime($match['created_at'])) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="4" style="text-align:center;padding:1.5rem;color:var(--ink-muted);">No matches yet</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Investment Opportunities -->
        <div class="table-container">
            <div class="table-header">
                <h3><i class="fas fa-rocket" style="color:var(--primary);margin-right:0.5rem;"></i> Investment Opportunities</h3>
                <a href="<?= base_url('enterprise/investment') ?>" style="color:var(--primary);font-size:0.78rem;font-weight:600;">View All →</a>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($investment_opportunities)): ?>
                        <?php foreach (array_slice($investment_opportunities, 0, 5) as $opp): ?>
                            <tr>
                                <td><strong><?= esc($opp['title'] ?? 'N/A') ?></strong></td>
                                <td>$<?= number_format($opp['funding_required'] ?? 0) ?></td>
                                <td>
                                    <span class="badge-status badge-<?= $opp['status'] ?? 'pending' ?>">
                                        <?= ucfirst($opp['status'] ?? 'Pending') ?>
                                    </span>
                                </td>
                                <td><?= date('M d', strtotime($opp['created_at'])) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="4" style="text-align:center;padding:1.5rem;color:var(--ink-muted);">No opportunities yet</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- ========== ADVISORY REQUESTS & NOTIFICATIONS ========== -->
    <div class="two-col-grid">
        <!-- Advisory Requests -->
        <div class="table-container">
            <div class="table-header">
                <h3><i class="fas fa-chalkboard-teacher" style="color:var(--primary);margin-right:0.5rem;"></i> Advisory Requests</h3>
                <a href="<?= base_url('enterprise/advisory') ?>" style="color:var(--primary);font-size:0.78rem;font-weight:600;">View All →</a>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Subject</th>
                        <th>Expert</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($advisory_requests)): ?>
                        <?php foreach (array_slice($advisory_requests, 0, 5) as $req): ?>
                            <tr>
                                <td><strong><?= esc($req['subject'] ?? 'N/A') ?></strong></td>
                                <td><?= esc($req['expert_name'] ?? 'Not Assigned') ?></td>
                                <td>
                                    <span class="badge-status badge-<?= $req['status'] ?? 'pending' ?>">
                                        <?= ucfirst($req['status'] ?? 'Pending') ?>
                                    </span>
                                </td>
                                <td><?= date('M d', strtotime($req['created_at'])) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="4" style="text-align:center;padding:1.5rem;color:var(--ink-muted);">No advisory requests</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Notifications -->
        <div class="table-container">
            <div class="table-header">
                <h3><i class="fas fa-bell" style="color:var(--primary);margin-right:0.5rem;"></i> Recent Notifications</h3>
                <a href="<?= base_url('enterprise/notifications') ?>" style="color:var(--primary);font-size:0.78rem;font-weight:600;">View All →</a>
            </div>
            <div>
                <?php if (!empty($notifications)): ?>
                    <?php foreach (array_slice($notifications, 0, 5) as $notif): ?>
                        <div class="notification-item <?= $notif['is_read'] ? '' : 'unread' ?>">
                            <div class="icon <?= $notif['type'] ?? 'system' ?>">
                                <i class="fas <?= $notif['type'] == 'match' ? 'fa-handshake' : ($notif['type'] == 'investor' ? 'fa-user-tie' : ($notif['type'] == 'advisory' ? 'fa-chalkboard-teacher' : ($notif['type'] == 'deal' ? 'fa-file-signature' : ($notif['type'] == 'meeting' ? 'fa-calendar-check' : 'fa-bell')))) ?>"></i>
                            </div>
                            <div class="content">
                                <div class="title"><?= esc($notif['title'] ?? 'Notification') ?></div>
                                <div class="message"><?= esc($notif['message'] ?? '') ?></div>
                            </div>
                            <div class="time"><?= date('M d, H:i', strtotime($notif['created_at'])) ?></div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div style="text-align:center;padding:2rem;color:var(--ink-muted);">
                        <i class="fas fa-bell-slash" style="font-size:1.5rem;display:block;margin-bottom:0.5rem;opacity:0.3;"></i>
                        No notifications
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- ========== ENGAGEMENT HISTORY ========== -->
    <div class="table-container">
        <div class="table-header">
            <h3><i class="fas fa-calendar-check" style="color:var(--primary);margin-right:0.5rem;"></i> Engagement History</h3>
            <a href="<?= base_url('enterprise/engagements') ?>" style="color:var(--primary);font-size:0.78rem;font-weight:600;">View All →</a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Type</th>
                    <th>Expert</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($engagements)): ?>
                    <?php foreach (array_slice($engagements, 0, 5) as $engagement): ?>
                        <tr>
                            <td>
                                <span class="badge-status" style="background:#e3f2fd;color:#0d47a1;">
                                    <?= ucfirst($engagement['type'] ?? 'Meeting') ?>
                                </span>
                            </td>
                            <td><strong><?= esc($engagement['expert_name'] ?? 'N/A') ?></strong></td>
                            <td><?= esc(substr($engagement['description'] ?? '', 0, 50)) ?>...</td>
                            <td><?= date('M d, Y', strtotime($engagement['date'])) ?></td>
                            <td>
                                <span class="badge-status <?= $engagement['outcome'] ? 'badge-resolved' : 'badge-pending' ?>">
                                    <?= $engagement['outcome'] ? 'Completed' : 'Pending' ?>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="5" style="text-align:center;padding:1.5rem;color:var(--ink-muted);">No engagement history</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>

<?= $this->endSection() ?>