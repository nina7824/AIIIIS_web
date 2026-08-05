<?= $this->extend('layouts/admin') ?>

<?= $this->section('styles') ?>
/* Users page custom styles */
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="table-container">
    <div class="table-header">
        <h3><i class="fas fa-users" style="color:var(--primary);margin-right:0.5rem;"></i> All Users</h3>
        <div>
            <a href="<?= base_url('admin/users/create') ?>" style="background:var(--primary);color:#fff;padding:0.4rem 1rem;border-radius:var(--radius);font-size:0.78rem;font-weight:600;text-decoration:none;display:inline-block;">
                <i class="fas fa-plus"></i> Add User
            </a>
        </div>
    </div>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Role</th>
                <th>Status</th>
                <th>Joined</th>
                <th style="text-align:center;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($users)): ?>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td>#<?= $user['user_id'] ?></td>
                        <td><strong><?= esc($user['name']) ?></strong></td>
                        <td><?= esc($user['email']) ?></td>
                        <td><?= esc($user['phone'] ?? 'N/A') ?></td>
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
                        <td style="text-align:center;">
                            <button class="btn-sm btn-primary-sm" onclick="alert('Edit user: <?= $user['user_id'] ?>')">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn-sm btn-danger-sm" onclick="if(confirm('Delete user: <?= $user['name'] ?>?')){alert('Deleted');}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="8" style="text-align:center;padding:2rem;color:var(--ink-muted);">No users found</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>