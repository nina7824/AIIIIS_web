<?= $this->extend('layouts/admin') ?>

<?= $this->section('styles') ?>
.profile-form-container {
    max-width: 800px;
    margin: 0 auto;
}
.profile-form {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 2rem;
}
.profile-form h2 {
    font-size: 1.3rem;
    font-weight: 700;
    margin-bottom: 0.25rem;
}
.profile-form .subtitle {
    color: var(--ink-muted);
    font-size: 0.9rem;
    margin-bottom: 1.5rem;
}
.form-group {
    margin-bottom: 1.25rem;
}
.form-group label {
    display: block;
    font-size: 0.85rem;
    font-weight: 600;
    color: var(--ink);
    margin-bottom: 0.4rem;
}
.form-group label .required {
    color: #c62828;
}
.form-group input,
.form-group select,
.form-group textarea {
    width: 100%;
    padding: 0.6rem 0.75rem;
    border: 1px solid var(--border);
    border-radius: var(--radius);
    font-size: 0.85rem;
    font-family: 'Inter', sans-serif;
    background: var(--surface);
    color: var(--ink);
    transition: var(--transition);
}
.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(7, 142, 206, 0.1);
}
.form-group .help-text {
    font-size: 0.7rem;
    color: var(--ink-muted);
    margin-top: 0.2rem;
}
.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
}
.form-actions {
    display: flex;
    gap: 1rem;
    margin-top: 1.5rem;
    padding-top: 1.5rem;
    border-top: 1px solid var(--border);
}
.btn-save {
    padding: 0.6rem 2rem;
    background: var(--primary);
    color: #fff;
    border: none;
    border-radius: var(--radius);
    font-weight: 600;
    font-size: 0.9rem;
    cursor: pointer;
    transition: var(--transition);
}
.btn-save:hover {
    background: var(--primary-dark);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(7, 142, 206, 0.3);
}
.btn-cancel {
    padding: 0.6rem 2rem;
    background: var(--canvas);
    color: var(--ink);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    font-weight: 600;
    font-size: 0.9rem;
    cursor: pointer;
    transition: var(--transition);
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}
.btn-cancel:hover {
    background: var(--border);
}
.alert {
    padding: 0.75rem 1rem;
    border-radius: var(--radius);
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}
.alert-success {
    background: #e6f7ef;
    color: #22a67e;
    border: 1px solid #c8e6c9;
}
.alert-error {
    background: #fde8e8;
    color: #c62828;
    border: 1px solid #f5c6cb;
}
@media (max-width: 768px) {
    .form-row {
        grid-template-columns: 1fr;
    }
    .profile-form {
        padding: 1.5rem;
    }
    .form-actions {
        flex-direction: column;
    }
}
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="profile-form-container">

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-error">
            <i class="fas fa-exclamation-circle"></i> <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <div class="profile-form">
        <h2><?= $investor ? 'Edit Investor Profile' : 'Create Investor Profile' ?></h2>
        <p class="subtitle">Complete your profile to get matched with the best investment opportunities.</p>

        <form action="<?= base_url('investor/update-profile') ?>" method="post">
            <?= csrf_field() ?>

            <!-- Personal Information -->
            <div class="form-group">
                <label for="name">Full Name <span class="required">*</span></label>
                <input type="text" id="name" name="name" value="<?= old('name', $investor['name'] ?? $user['name'] ?? '') ?>" required placeholder="Enter your full name">
            </div>

            <!-- Investor Type -->
            <div class="form-group">
                <label for="type">Investor Type <span class="required">*</span></label>
                <select id="type" name="type" required>
                    <option value="">Select investor type</option>
                    <option value="individual" <?= (old('type', $investor['type'] ?? '') == 'individual') ? 'selected' : '' ?>>Individual</option>
                    <option value="institutional" <?= (old('type', $investor['type'] ?? '') == 'institutional') ? 'selected' : '' ?>>Institutional</option>
                    <option value="venture_capital" <?= (old('type', $investor['type'] ?? '') == 'venture_capital') ? 'selected' : '' ?>>Venture Capital</option>
                    <option value="angel" <?= (old('type', $investor['type'] ?? '') == 'angel') ? 'selected' : '' ?>>Angel Investor</option>
                    <option value="government" <?= (old('type', $investor['type'] ?? '') == 'government') ? 'selected' : '' ?>>Government</option>
                </select>
                <div class="help-text">Select the type of investor you are.</div>
            </div>

            <!-- Investment Sector -->
            <div class="form-group">
                <label for="investment_sector">Investment Sector <span class="required">*</span></label>
                <select id="investment_sector" name="investment_sector" required>
                    <option value="">Select sectors</option>
                    <option value="Agribusiness" <?= (old('investment_sector', $investor['investment_sector'] ?? '') == 'Agribusiness') ? 'selected' : '' ?>>Agribusiness</option>
                    <option value="Manufacturing" <?= (old('investment_sector', $investor['investment_sector'] ?? '') == 'Manufacturing') ? 'selected' : '' ?>>Manufacturing</option>
                    <option value="Technology" <?= (old('investment_sector', $investor['investment_sector'] ?? '') == 'Technology') ? 'selected' : '' ?>>Technology</option>
                    <option value="Construction" <?= (old('investment_sector', $investor['investment_sector'] ?? '') == 'Construction') ? 'selected' : '' ?>>Construction</option>
                    <option value="Energy" <?= (old('investment_sector', $investor['investment_sector'] ?? '') == 'Energy') ? 'selected' : '' ?>>Energy</option>
                    <option value="Mining" <?= (old('investment_sector', $investor['investment_sector'] ?? '') == 'Mining') ? 'selected' : '' ?>>Mining</option>
                    <option value="Tourism" <?= (old('investment_sector', $investor['investment_sector'] ?? '') == 'Tourism') ? 'selected' : '' ?>>Tourism</option>
                    <option value="Financial Services" <?= (old('investment_sector', $investor['investment_sector'] ?? '') == 'Financial Services') ? 'selected' : '' ?>>Financial Services</option>
                    <option value="Healthcare" <?= (old('investment_sector', $investor['investment_sector'] ?? '') == 'Healthcare') ? 'selected' : '' ?>>Healthcare</option>
                    <option value="Education" <?= (old('investment_sector', $investor['investment_sector'] ?? '') == 'Education') ? 'selected' : '' ?>>Education</option>
                </select>
                <div class="help-text">Select the primary sector you want to invest in.</div>
            </div>

            <!-- Preferred Enterprise Type -->
            <div class="form-group">
                <label for="preferred_enterprise_type">Preferred Enterprise Type</label>
                <select id="preferred_enterprise_type" name="preferred_enterprise_type">
                    <option value="">Select preferred type</option>
                    <option value="Startup" <?= (old('preferred_enterprise_type', $investor['preferred_enterprise_type'] ?? '') == 'Startup') ? 'selected' : '' ?>>Startup</option>
                    <option value="SME" <?= (old('preferred_enterprise_type', $investor['preferred_enterprise_type'] ?? '') == 'SME') ? 'selected' : '' ?>>SME (Small/Medium Enterprise)</option>
                    <option value="Large Enterprise" <?= (old('preferred_enterprise_type', $investor['preferred_enterprise_type'] ?? '') == 'Large Enterprise') ? 'selected' : '' ?>>Large Enterprise</option>
                    <option value="All" <?= (old('preferred_enterprise_type', $investor['preferred_enterprise_type'] ?? '') == 'All') ? 'selected' : '' ?>>All Types</option>
                </select>
                <div class="help-text">Specify the type of enterprises you prefer to invest in.</div>
            </div>

            <!-- Investment Amount -->
            <div class="form-row">
                <div class="form-group">
                    <label for="investment_amount_min">Min Investment <span class="required">*</span></label>
                    <input type="number" id="investment_amount_min" name="investment_amount_min" value="<?= old('investment_amount_min', $investor['investment_amount_min'] ?? '') ?>" placeholder="e.g. 100000" required>
                    <div class="help-text">Minimum amount in USD.</div>
                </div>
                <div class="form-group">
                    <label for="investment_amount_max">Max Investment <span class="required">*</span></label>
                    <input type="number" id="investment_amount_max" name="investment_amount_max" value="<?= old('investment_amount_max', $investor['investment_amount_max'] ?? '') ?>" placeholder="e.g. 1000000" required>
                    <div class="help-text">Maximum amount in USD.</div>
                </div>
            </div>

            <!-- Geographic Preferences -->
            <div class="form-group">
                <label for="geographic_preferences">Geographic Preferences</label>
                <input type="text" id="geographic_preferences" name="geographic_preferences" value="<?= old('geographic_preferences', $investor['geographic_preferences'] ?? '') ?>" placeholder="e.g. Kigali, Musanze, Rubavu">
                <div class="help-text">Specify preferred locations for investment (comma separated).</div>
            </div>

            <!-- Technology Interests -->
            <div class="form-group">
                <label for="technology_interests">Technology Interests</label>
                <input type="text" id="technology_interests" name="technology_interests" value="<?= old('technology_interests', $investor['technology_interests'] ?? '') ?>" placeholder="e.g. AI, IoT, Blockchain, Clean Tech">
                <div class="help-text">List the technologies you're interested in.</div>
            </div>

            <!-- Sustainability Preferences -->
            <div class="form-group">
                <label for="sustainability_preferences">Sustainability Preferences</label>
                <select id="sustainability_preferences" name="sustainability_preferences">
                    <option value="">Select preference</option>
                    <option value="High sustainability focus" <?= (old('sustainability_preferences', $investor['sustainability_preferences'] ?? '') == 'High sustainability focus') ? 'selected' : '' ?>>High Sustainability Focus</option>
                    <option value="Moderate sustainability" <?= (old('sustainability_preferences', $investor['sustainability_preferences'] ?? '') == 'Moderate sustainability') ? 'selected' : '' ?>>Moderate Sustainability</option>
                    <option value="Sustainability required" <?= (old('sustainability_preferences', $investor['sustainability_preferences'] ?? '') == 'Sustainability required') ? 'selected' : '' ?>>Sustainability Required</option>
                    <option value="Not a priority" <?= (old('sustainability_preferences', $investor['sustainability_preferences'] ?? '') == 'Not a priority') ? 'selected' : '' ?>>Not a Priority</option>
                </select>
                <div class="help-text">Indicate your sustainability and ESG preferences.</div>
            </div>

            <!-- Investment Stage -->
            <div class="form-group">
                <label for="investment_stage">Investment Stage <span class="required">*</span></label>
                <select id="investment_stage" name="investment_stage" required>
                    <option value="">Select investment stage</option>
                    <option value="seed" <?= (old('investment_stage', $investor['investment_stage'] ?? '') == 'seed') ? 'selected' : '' ?>>Seed</option>
                    <option value="early" <?= (old('investment_stage', $investor['investment_stage'] ?? '') == 'early') ? 'selected' : '' ?>>Early Stage</option>
                    <option value="growth" <?= (old('investment_stage', $investor['investment_stage'] ?? '') == 'growth') ? 'selected' : '' ?>>Growth</option>
                    <option value="expansion" <?= (old('investment_stage', $investor['investment_stage'] ?? '') == 'expansion') ? 'selected' : '' ?>>Expansion</option>
                    <option value="mature" <?= (old('investment_stage', $investor['investment_stage'] ?? '') == 'mature') ? 'selected' : '' ?>>Mature</option>
                </select>
                <div class="help-text">Select the stage of enterprises you prefer to invest in.</div>
            </div>

            <!-- Expected Returns -->
            <div class="form-group">
                <label for="expected_returns">Expected Returns (%)</label>
                <input type="number" id="expected_returns" name="expected_returns" step="0.1" value="<?= old('expected_returns', $investor['expected_returns'] ?? '') ?>" placeholder="e.g. 20.5">
                <div class="help-text">Expected annual return percentage.</div>
            </div>

            <!-- Investment Criteria -->
            <div class="form-group">
                <label for="investment_criteria">Investment Criteria</label>
                <textarea id="investment_criteria" name="investment_criteria" rows="4" placeholder="Describe your investment criteria, preferences, and requirements..."><?= old('investment_criteria', $investor['investment_criteria'] ?? '') ?></textarea>
                <div class="help-text">Describe your investment criteria and what you look for in enterprises.</div>
            </div>

            <!-- Form Actions -->
            <div class="form-actions">
                <button type="submit" class="btn-save">
                    <i class="fas fa-save"></i> <?= $investor ? 'Update Profile' : 'Create Profile' ?>
                </button>
                <a href="<?= base_url('investor/profile') ?>" class="btn-cancel">
                    <i class="fas fa-times"></i> Cancel
                </a>
            </div>

        </form>
    </div>
</div>

<?= $this->endSection() ?>