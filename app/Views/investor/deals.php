<?= $this->extend('layouts/admin') ?>

<?= $this->section('styles') ?>
.deal-status {
    display: inline-block;
    padding: 0.1rem 0.6rem;
    border-radius: 20px;
    font-size: 0.6rem;
    font-weight: 600;
}
.deal-negotiating { background: #fff3cd; color: #856404; }
.deal-agreed { background: #e3f2fd; color: #0d47a1; }
.deal-signed { background: #e6f7ef; color: #22a67e; }
.deal-completed { background: #e8f5e9; color: #2e7d32; }
.deal-cancelled { background: #fde8e8; color: #c62828; }
.stats-mini-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 1rem;
    margin-bottom: 1.5rem;
}
.stats-mini-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 0.75rem 1rem;
    text-align: center;
}
.stats-mini-card .number {
    font-size: 1.2rem;
    font-weight: 800;
    color: var(--ink);
}
.stats-mini-card .label {
    font-size: 0.6rem;
    color: var(--ink-muted);
    text-transform: uppercase;
    letter-spacing: 0.05em;
}
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="stats-mini-grid">
    <div class="stats-mini-card">
        <div class="number"><?= count($deals) ?></div>
        <div class="label">Total Deals</div>
    </div>
    <div class="stats-mini-card">
        <div class="number">
            <?php 
            $active = array_filter($deals, function($d) { 
                return !in_array($d['status'] ?? '', ['completed', 'cancelled']); 
            });
            echo count($active);
            ?>
        </div>
        <div class="label">Active Deals</div>
    </div>
    <div class="stats-mini-card">
        <div class="number">
            <?php 
            $completed = array_filter($deals, function($d) { return ($d['status'] ?? '') == 'completed'; });
            echo count($completed);
            ?>
        </div>
        <div class="label">Completed</div>
    </div>
    <div class="stats-mini-card">
        <div class="number">
            <?php 
            $totalAmount = array_sum(array_column($deals, 'deal_amount'));
            echo '$' . number_format($totalAmount);
            ?>
        </div>
        <div class="label">Total Investment</div>
    </div>
</div>

<div class="table-container">
    <div class="table-header">
        <h3><i class="fas fa-file-signature" style="color:var(--primary);margin-right:0.5rem;"></i> My Deals</h3>
        <span style="background:var(--primary);color:#fff;padding:0.3rem 0.8rem;border-radius:var(--radius);font-size:0.7rem;font-weight:600;">
            Total: <?= count($deals) ?>
        </span>
    </div>
    <table>
        <thead>
            <tr>
                <th>Enterprise</th>
                <th>Sector</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Expected Close</th>
                <th>Date</th>
                <th style="text-align:center;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($deals)): ?>
                <?php foreach ($deals as $deal): ?>
                    <tr>
                        <td><strong><?= esc($deal['enterprise_name'] ?? 'N/A') ?></strong></td>
                        <td><?= esc($deal['sector'] ?? 'N/A') ?></td>
                        <td>$<?= number_format($deal['deal_amount'] ?? 0) ?></td>
                        <td>
                            <span class="deal-status deal-<?= $deal['status'] ?? 'negotiating' ?>">
                                <?= ucfirst($deal['status'] ?? 'Negotiating') ?>
                            </span>
                        </td>
                        <td><?= $deal['expected_close_date'] ? date('M d, Y', strtotime($deal['expected_close_date'])) : 'N/A' ?></td>
                        <td><?= date('M d, Y', strtotime($deal['created_at'])) ?></td>
                        <td style="text-align:center;">
                            <button class="btn-sm btn-primary-sm" onclick="alert('View deal details for <?= $deal['enterprise_name'] ?>')">
                                <i class="fas fa-eye"></i>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="7" style="text-align:center;padding:2rem;color:var(--ink-muted);">No deals found</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>