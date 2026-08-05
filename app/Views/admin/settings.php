<?= $this->extend('layouts/admin') ?>

<?= $this->section('styles') ?>
.settings-container {
    max-width: 800px;
    margin: 0 auto;
}
.settings-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 1.5rem;
    margin-bottom: 1.5rem;
}
.settings-card h3 {
    font-size: 1rem;
    font-weight: 700;
    margin-bottom: 1rem;
    padding-bottom: 0.5rem;
    border-bottom: 1px solid var(--border);
}
.setting-row {
    display: flex;
    justify-content: space-between;
    padding: 0.5rem 0;
    border-bottom: 1px solid var(--border);
}
.setting-row:last-child {
    border-bottom: none;
}
.setting-label {
    font-weight: 500;
    color: var(--ink);
}
.setting-value {
    color: var(--ink-muted);
}
.badge {
    display: inline-block;
    padding: 0.15rem 0.6rem;
    border-radius: 20px;
    font-size: 0.65rem;
    font-weight: 600;
}
.badge-success { background: #e6f7ef; color: #22a67e; }
.badge-danger { background: #fde8e8; color: #c62828; }
.badge-warning { background: #fff3cd; color: #856404; }

.form-group {
    margin-bottom: 1rem;
}
.form-group label {
    display: block;
    font-size: 0.85rem;
    font-weight: 600;
    margin-bottom: 0.3rem;
    color: var(--ink);
}
.form-group input,
.form-group select {
    width: 100%;
    padding: 0.5rem 0.75rem;
    border: 1px solid var(--border);
    border-radius: var(--radius);
    font-size: 0.85rem;
    font-family: 'Inter', sans-serif;
    background: var(--surface);
    color: var(--ink);
}
.form-group input:focus,
.form-group select:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(7, 142, 206, 0.1);
}
.btn-save {
    padding: 0.5rem 2rem;
    background: var(--primary);
    color: #fff;
    border: none;
    border-radius: var(--radius);
    font-weight: 600;
    cursor: pointer;
    transition: var(--transition);
}
.btn-save:hover {
    background: var(--primary-dark);
    transform: translateY(-1px);
}
.alert {
    padding: 0.75rem 1rem;
    border-radius: var(--radius);
    margin-bottom: 1rem;
}
.alert-success {
    background: #e6f7ef;
    color: #22a67e;
    border: 1px solid #c8e6c9;
}
.alert-danger {
    background: #fde8e8;
    color: #c62828;
    border: 1px solid #f5c6cb;
}
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="settings-container">
    <h2 style="font-size:1.3rem;font-weight:800;margin-bottom:1.5rem;">System Settings</h2>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-circle"></i> <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <!-- System Information -->
    <div class="settings-card">
        <h3><i class="fas fa-info-circle" style="color:var(--primary);margin-right:0.5rem;"></i> System Information</h3>
        <div class="setting-row">
            <span class="setting-label">Site Name</span>
            <span class="setting-value">AIIIIS Platform</span>
        </div>
        <div class="setting-row">
            <span class="setting-label">Site URL</span>
            <span class="setting-value"><?= base_url() ?></span>
        </div>
        <div class="setting-row">
            <span class="setting-label">Environment</span>
            <span class="setting-value"><span class="badge badge-success">Development</span></span>
        </div>
        <div class="setting-row">
            <span class="setting-label">PHP Version</span>
            <span class="setting-value"><?= phpversion() ?></span>
        </div>
        <div class="setting-row">
            <span class="setting-label">CodeIgniter</span>
            <span class="setting-value">4.7.4</span>
        </div>
    </div>

    <!-- System Status -->
    <div class="settings-card">
        <h3><i class="fas fa-server" style="color:var(--primary);margin-right:0.5rem;"></i> System Status</h3>
        <div class="setting-row">
            <span class="setting-label">Database</span>
            <span class="setting-value"><span class="badge badge-success">Connected</span></span>
        </div>
        <div class="setting-row">
            <span class="setting-label">Session</span>
            <span class="setting-value"><span class="badge badge-success">Active</span></span>
        </div>
        <div class="setting-row">
            <span class="setting-label">Debug Mode</span>
            <span class="setting-value"><span class="badge badge-success">Enabled</span></span>
        </div>
        <div class="setting-row">
            <span class="setting-label">Maintenance Mode</span>
            <span class="setting-value"><span class="badge badge-danger">Disabled</span></span>
        </div>
    </div>

    <!-- Update Settings -->
    <div class="settings-card">
        <h3><i class="fas fa-edit" style="color:var(--primary);margin-right:0.5rem;"></i> Update Settings</h3>
        
        <form action="<?= base_url('admin/settings/update') ?>" method="post">
            <?= csrf_field() ?>
            
            <div class="form-group">
                <label for="site_name">Site Name</label>
                <input type="text" id="site_name" name="site_name" value="AIIIIS Platform">
            </div>
            
            <div class="form-group">
                <label for="site_url">Site URL</label>
                <input type="text" id="site_url" name="site_url" value="<?= base_url() ?>">
            </div>
            
            <div class="form-group">
                <label for="maintenance_mode">Maintenance Mode</label>
                <select id="maintenance_mode" name="maintenance_mode">
                    <option value="0">Disabled</option>
                    <option value="1">Enabled</option>
                </select>
            </div>
            
            <button type="submit" class="btn-save">
                <i class="fas fa-save"></i> Save Settings
            </button>
        </form>
    </div>
</div>

<?= $this->endSection() ?>