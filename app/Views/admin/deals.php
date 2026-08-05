<?= $this->extend('layouts/admin') ?>

<?= $this->section('styles') ?>
.deal-status {
    display: inline-block;
    padding: 0.15rem 0.7rem;
    border-radius: 20px;
    font-size: 0.65rem;
    font-weight: 600;
}
.deal-negotiating { background: #fff3cd; color: #856404; }
.deal-agreed { background: #e3f2fd; color: #0d47a1; }
.deal-signed { background: #e6f7ef; color: #22a67e; }
.deal-completed { background: #e8f5e9; color: #2e7d32; }
.deal-cancelled { background: #fde8e8; color: #c62828; }
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="table-container">
    <div class="table-header">
        <h3><i class="fas fa-file-signature" style="color:var(--primary);margin-right:0.5rem;"></i> Deal Tracking</h3>
        <div>
            <span style="background:var(--primary);color:#fff;padding:0.3rem 0.8rem;border-radius:var(--radius);font-size:0.7rem;font-weight:600;">
                Total: <?= count($deals) ?>
            </span>
        </div>
    </div>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Enterprise</th>
                <th>Investor</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Expected Close</th>
                <th style="text-align:center;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($deals)): ?>
                <?php foreach ($deals as $deal): ?>
                    <tr>
                        <td>#<?= $deal['deal_id'] ?></td>
                        <td><strong><?= esc($deal['enterprise_name'] ?? 'N/A') ?></strong></td>
                        <td><?= esc($deal['investor_name'] ?? 'N/A') ?></td>
                        <td>$<?= number_format($deal['deal_amount'] ?? 0) ?></td>
                        <td>
                            <span class="deal-status deal-<?= $deal['status'] ?? 'negotiating' ?>">
                                <?= ucfirst($deal['status'] ?? 'Negotiating') ?>
                            </span>
                        </td>
                        <td><?= $deal['expected_close_date'] ? date('M d, Y', strtotime($deal['expected_close_date'])) : 'N/A' ?></td>
                        <td style="text-align:center;">
                            <button class="btn-sm btn-primary-sm" onclick="alert('View deal: <?= $deal['deal_id'] ?>')">
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