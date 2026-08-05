<?= $this->extend('layouts/admin') ?>

<?= $this->section('styles') ?>
/* Enterprises page custom styles */
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="table-container">
    <div class="table-header">
        <h3><i class="fas fa-building" style="color:var(--primary);margin-right:0.5rem;"></i> All Enterprises</h3>
        <div>
            <a href="<?= base_url('admin/enterprises/create') ?>" style="background:var(--primary);color:#fff;padding:0.4rem 1rem;border-radius:var(--radius);font-size:0.78rem;font-weight:600;text-decoration:none;display:inline-block;">
                <i class="fas fa-plus"></i> Add Enterprise
            </a>
        </div>
    </div>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Sector</th>
                <th>Location</th>
                <th>Contact</th>
                <th>Status</th>
                <th>Verified</th>
                <th style="text-align:center;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($enterprises)): ?>
                <?php foreach ($enterprises as $enterprise): ?>
                    <tr>
                        <td>#<?= $enterprise['enterprise_id'] ?></td>
                        <td><strong><?= esc($enterprise['name']) ?></strong></td>
                        <td><?= esc($enterprise['sector'] ?? 'N/A') ?></td>
                        <td><?= esc($enterprise['location'] ?? 'N/A') ?></td>
                        <td><?= esc($enterprise['contact_person'] ?? 'N/A') ?></td>
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
                        <td style="text-align:center;">
                            <button class="btn-sm btn-primary-sm" onclick="alert('View enterprise: <?= $enterprise['name'] ?>')">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="btn-sm btn-primary-sm" onclick="alert('Edit enterprise: <?= $enterprise['name'] ?>')">
                                <i class="fas fa-edit"></i>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="8" style="text-align:center;padding:2rem;color:var(--ink-muted);">No enterprises found</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>