<?= $this->extend('layouts/admin') ?>

<?= $this->section('styles') ?>
.profile-container {
    max-width: 900px;
    margin: 0 auto;
}
.profile-header {
    display: flex;
    align-items: center;
    gap: 1.5rem;
    padding: 1.5rem;
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    margin-bottom: 1.5rem;
}
.profile-avatar {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    font-weight: 700;
    color: #fff;
    flex-shrink: 0;
}
.profile-info h2 {
    font-size: 1.2rem;
    font-weight: 700;
    margin-bottom: 0.25rem;
}
.profile-info .role {
    color: var(--ink-muted);
    font-size: 0.85rem;
}
.profile-info .email {
    font-size: 0.8rem;
    color: var(--ink-muted);
}
.profile-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 1.5rem;
    margin-bottom: 1.5rem;
}
.profile-card h3 {
    font-size: 1rem;
    font-weight: 700;
    margin-bottom: 1rem;
    padding-bottom: 0.5rem;
    border-bottom: 1px solid var(--border);
    display: flex;
    align-items: center;
    gap: 0.5rem;
}
.profile-card h3 i {
    color: var(--primary);
}
.profile-row {
    display: flex;
    padding: 0.5rem 0;
    border-bottom: 1px solid var(--border);
}
.profile-row:last-child {
    border-bottom: none;
}
.profile-row .label {
    width: 200px;
    font-weight: 600;
    color: var(--ink-muted);
    font-size: 0.85rem;
    flex-shrink: 0;
}
.profile-row .value {
    flex: 1;
    font-size: 0.85rem;
    color: var(--ink);
}
.badge-status {
    display: inline-block;
    padding: 0.15rem 0.7rem;
    border-radius: 20px;
    font-size: 0.65rem;
    font-weight: 600;
}
.badge-verified { background: #e6f7ef; color: #22a67e; }
.badge-pending { background: #fff3cd; color: #856404; }
.badge-investor { background: #e3f2fd; color: #0d47a1; }
.action-buttons {
    display: flex;
    gap: 0.75rem;
    flex-wrap: wrap;
    margin-top: 1rem;
}
.btn-edit {
    padding: 0.5rem 1.5rem;
    background: var(--primary);
    color: #fff;
    border: none;
    border-radius: var(--radius);
    font-weight: 600;
    cursor: pointer;
    transition: var(--transition);
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}
.btn-edit:hover {
    background: var(--primary-dark);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(7, 142, 206, 0.3);
}
.btn-back {
    padding: 0.5rem 1.5rem;
    background: var(--canvas);
    color: var(--ink);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    font-weight: 600;
    cursor: pointer;
    transition: var(--transition);
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}
.btn-back:hover {
    background: var(--border);
}
@media (max-width: 768px) {
    .profile-row {
        flex-direction: column;
        padding: 0.6rem 0;
    }
    .profile-row .label {
        width: 100%;
        margin-bottom: 0.2rem;
    }
    .profile-header {
        flex-direction: column;
        text-align: center;
    }
}
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="profile-container">

    <!-- Profile Header -->
    <div class="profile-header">
        <div class="profile-avatar"><?= strtoupper(substr($user['name'] ?? 'U', 0, 1)) ?></div>
        <div class="profile-info">
            <h2><?= $user['name'] ?? 'Investor' ?></h2>
            <div class="role">
                <span class="badge-status badge-investor">Investor</span>
                <span class="badge-status <?= ($investor['is_verified'] ?? 0) ? 'badge-verified' : 'badge-pending' ?>">
                    <?= ($investor['is_verified'] ?? 0) ? 'Verified' : 'Pending Verification' ?>
                </span>
            </div>
            <div class="email"><i class="fas fa-envelope"></i> <?= $user['email'] ?? '' ?></div>
        </div>
    </div>

    <?php if ($investor): ?>
        <!-- Investor Information -->
        <div class="profile-card">
            <h3><i class="fas fa-user-tie"></i> Investor Information</h3>
            
            <div class="profile-row">
                <span class="label">Full Name</span>
                <span class="value"><strong><?= esc($investor['name'] ?? 'N/A') ?></strong></span>
            </div>
            <div class="profile-row">
                <span class="label">Investor Type</span>
                <span class="value">
                    <span class="badge-status" style="background:#e3f2fd;color:#0d47a1;">
                        <?= ucfirst(str_replace('_', ' ', $investor['type'] ?? 'Not Specified')) ?>
                    </span>
                </span>
            </div>
            <div class="profile-row">
                <span class="label">Investment Sector</span>
                <span class="value"><?= esc($investor['investment_sector'] ?? 'Not Specified') ?></span>
            </div>
            <div class="profile-row">
                <span class="label">Preferred Enterprise Type</span>
                <span class="value"><?= esc($investor['preferred_enterprise_type'] ?? 'Not Specified') ?></span>
            </div>
            <div class="profile-row">
                <span class="label">Investment Amount</span>
                <span class="value">
                    <?php if ($investor['investment_amount_min'] && $investor['investment_amount_max']): ?>
                        <strong>$<?= number_format($investor['investment_amount_min']) ?></strong> – <strong>$<?= number_format($investor['investment_amount_max']) ?></strong>
                    <?php else: ?>
                        Not Specified
                    <?php endif; ?>
                </span>
            </div>
            <div class="profile-row">
                <span class="label">Geographic Preferences</span>
                <span class="value"><?= esc($investor['geographic_preferences'] ?? 'Not Specified') ?></span>
            </div>
            <div class="profile-row">
                <span class="label">Technology Interests</span>
                <span class="value"><?= esc($investor['technology_interests'] ?? 'Not Specified') ?></span>
            </div>
            <div class="profile-row">
                <span class="label">Sustainability Preferences</span>
                <span class="value"><?= esc($investor['sustainability_preferences'] ?? 'Not Specified') ?></span>
            </div>
            <div class="profile-row">
                <span class="label">Investment Stage</span>
                <span class="value">
                    <span class="badge-status" style="background:#f3e5f5;color:#6a1b9a;">
                        <?= ucfirst($investor['investment_stage'] ?? 'Not Specified') ?>
                    </span>
                </span>
            </div>
            <div class="profile-row">
                <span class="label">Expected Returns</span>
                <span class="value">
                    <?php if ($investor['expected_returns']): ?>
                        <strong><?= $investor['expected_returns'] ?>%</strong> per annum
                    <?php else: ?>
                        Not Specified
                    <?php endif; ?>
                </span>
            </div>
            <div class="profile-row">
                <span class="label">Investment Criteria</span>
                <span class="value"><?= nl2br(esc($investor['investment_criteria'] ?? 'Not Specified')) ?></span>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons">
            <a href="<?= base_url('investor/edit-profile') ?>" class="btn-edit">
                <i class="fas fa-edit"></i> Edit Profile
            </a>
            <a href="<?= base_url('investor/dashboard') ?>" class="btn-back">
                <i class="fas fa-arrow-left"></i> Back to Dashboard
            </a>
        </div>

    <?php else: ?>
        <!-- No Profile Found -->
        <div class="profile-card" style="text-align:center;padding:3rem;">
            <i class="fas fa-user-tie" style="font-size:3rem;color:var(--ink-muted);opacity:0.3;display:block;margin-bottom:1rem;"></i>
            <h3 style="font-size:1.1rem;">No Investor Profile Found</h3>
            <p style="color:var(--ink-muted);margin-bottom:1rem;">Please create your investor profile to get started.</p>
            <a href="<?= base_url('investor/edit-profile') ?>" class="btn-edit" style="display:inline-block;">
                <i class="fas fa-plus"></i> Create Profile
            </a>
        </div>
    <?php endif; ?>

</div>

<?= $this->endSection() ?>