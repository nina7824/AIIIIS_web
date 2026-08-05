<?= $this->extend('layouts/admin') ?>

<?= $this->section('styles') ?>
/* Investors page custom styles */
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="table-container">
    <div class="table-header">
        <h3><i class="fas fa-user-tie" style="color:var(--primary);margin-right:0.5rem;"></i> All Investors</h3>
        <div>
            <a href="<?= base_url('admin/investors/create') ?>" style="background:var(--primary);color:#fff;padding:0.4rem 1rem;border-radius:var(--radius);font-size:0.78rem;font-weight:600;text-decoration:none;display:inline-block;">
                <i class="fas fa-plus"></i> Add Investor
            </a>
        </div>
    </div>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Type</th>
                <th>Investment Sector</th>
                <th>Amount Range</th>
                <th>Stage</th>
                <th style="text-align:center;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($investors)): ?>
                <?php foreach ($investors as $investor): ?>
                    <tr>
                        <td>#<?= $investor['investor_id'] ?></td>
                        <td><strong><?= esc($investor['name']) ?></strong></td>
                        <td><?= ucfirst(str_replace('_', ' ', $investor['type'] ?? 'N/A')) ?></td>
                        <td><?= esc(substr($investor['investment_sector'] ?? 'N/A', 0, 30)) ?></td>
                        <td>
                            <?php if ($investor['investment_amount_min'] && $investor['investment_amount_max']): ?>
                                $<?= number_format($investor['investment_amount_min']) ?> - $<?= number_format($investor['investment_amount_max']) ?>
                            <?php else: ?>
                                N/A
                            <?php endif; ?>
                        </td>
                        <td><?= ucfirst($investor['investment_stage'] ?? 'N/A') ?></td>
                        <td style="text-align:center;">
                            <button class="btn-sm btn-primary-sm" onclick="alert('View investor: <?= $investor['name'] ?>')">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="btn-sm btn-primary-sm" onclick="alert('Edit investor: <?= $investor['name'] ?>')">
                                <i class="fas fa-edit"></i>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="7" style="text-align:center;padding:2rem;color:var(--ink-muted);">No investors found</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>