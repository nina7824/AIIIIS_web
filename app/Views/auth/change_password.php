<?= $this->extend('layouts/main') ?>

<?= $this->section('styles') ?>
/* ========== CHANGE PASSWORD STYLES ========== */
.change-password-hero {
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    padding: 3rem 0 4rem;
    color: #fff;
    position: relative;
    overflow: hidden;
}
.change-password-hero::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -20%;
    width: 500px;
    height: 500px;
    background: rgba(255,255,255,0.05);
    border-radius: 50%;
    pointer-events: none;
}
.change-password-hero .container {
    position: relative;
    z-index: 1;
}
.change-password-hero h1 {
    font-size: 2.2rem;
    font-weight: 800;
    margin-bottom: 0.3rem;
    letter-spacing: -0.02em;
}
.change-password-hero .subtitle {
    font-size: 1rem;
    color: rgba(255,255,255,0.85);
    max-width: 32rem;
    line-height: 1.7;
}
.change-password-section {
    padding: 3rem 0 4rem;
}
.change-password-section .form-container {
    max-width: 500px;
    margin: 0 auto;
}
.change-password-section .form-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 2.5rem;
    box-shadow: var(--shadow-sm);
}
.change-password-section .form-card .form-group {
    margin-bottom: 1.25rem;
}
.change-password-section .form-card .form-group label {
    display: block;
    font-size: 0.82rem;
    font-weight: 600;
    margin-bottom: 0.3rem;
    color: var(--ink);
}
.change-password-section .form-card .form-group label .required {
    color: #e74c3c;
    margin-left: 0.2rem;
}
.change-password-section .form-card .form-group input {
    width: 100%;
    padding: 0.6rem 0.9rem;
    border: 1px solid var(--border);
    border-radius: var(--radius);
    font-family: 'Inter', sans-serif;
    font-size: 0.88rem;
    transition: var(--transition);
    background: var(--canvas);
    color: var(--ink);
}
.change-password-section .form-card .form-group input:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(7, 142, 206, 0.1);
    background: var(--surface);
}
.change-password-section .form-card .btn-submit {
    width: 100%;
    padding: 0.8rem;
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    color: #fff;
    border: none;
    border-radius: var(--radius);
    font-weight: 600;
    font-size: 1rem;
    cursor: pointer;
    transition: var(--transition);
    box-shadow: 0 4px 16px rgba(7, 142, 206, 0.3);
}
.change-password-section .form-card .btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 28px rgba(7, 142, 206, 0.4);
}
.password-requirements {
    background: var(--canvas);
    padding: 1rem;
    border-radius: var(--radius);
    margin-bottom: 1rem;
}
.password-requirements h4 {
    font-size: 0.85rem;
    margin-bottom: 0.5rem;
}
.password-requirements ul {
    list-style: none;
    padding: 0;
    margin: 0;
}
.password-requirements ul li {
    font-size: 0.8rem;
    color: var(--ink-muted);
    padding: 0.2rem 0;
}
.password-requirements ul li i {
    margin-right: 0.5rem;
}
.password-requirements ul li.valid {
    color: #22a67e;
}
.password-requirements ul li.invalid {
    color: #e74c3c;
}
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- ========== CHANGE PASSWORD HERO ========== -->
<section class="change-password-hero">
    <div class="container">
        <h1>Change Password</h1>
        <p class="subtitle">You must change your default password to continue using the platform.</p>
    </div>
</section>

<!-- ========== CHANGE PASSWORD FORM ========== -->
<section class="change-password-section">
    <div class="container">
        <div class="form-container">
            <div class="form-card">
                <?php if (session()->getFlashdata('info')): ?>
                    <div style="background: #e6f4fb; color: #045a86; padding: 0.75rem 1rem; border-radius: var(--radius); margin-bottom: 1.5rem; border-left: 4px solid var(--primary);">
                        <?= session()->getFlashdata('info') ?>
                    </div>
                <?php endif; ?>
                
                <?php if (session()->getFlashdata('error')): ?>
                    <div style="background: #fde8e8; color: #c0392b; padding: 0.75rem 1rem; border-radius: var(--radius); margin-bottom: 1.5rem; border-left: 4px solid #e74c3c;">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>
                
                <form action="<?= base_url('update-password') ?>" method="post">
                    <?= csrf_field() ?>
                    
                    <div class="form-group">
                        <label>Current Password <span class="required">*</span></label>
                        <input type="password" name="current_password" placeholder="Enter your current password" required>
                    </div>
                    
                    <div class="form-group">
                        <label>New Password <span class="required">*</span></label>
                        <input type="password" id="new_password" name="new_password" placeholder="Enter new password" required>
                    </div>
                    
                    <div class="password-requirements">
                        <h4>Password Requirements:</h4>
                        <ul>
                            <li id="length"><i class="fas fa-circle"></i> At least 8 characters</li>
                            <li id="uppercase"><i class="fas fa-circle"></i> At least one uppercase letter</li>
                            <li id="lowercase"><i class="fas fa-circle"></i> At least one lowercase letter</li>
                            <li id="number"><i class="fas fa-circle"></i> At least one number</li>
                            <li id="special"><i class="fas fa-circle"></i> At least one special character</li>
                        </ul>
                    </div>
                    
                    <div class="form-group">
                        <label>Confirm New Password <span class="required">*</span></label>
                        <input type="password" name="confirm_password" placeholder="Confirm new password" required>
                    </div>
                    
                    <button type="submit" class="btn-submit">
                        <i class="fas fa-key"></i> Update Password
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
document.getElementById('new_password').addEventListener('input', function() {
    const password = this.value;
    
    // Length check
    const lengthCheck = document.getElementById('length');
    if (password.length >= 8) {
        lengthCheck.className = 'valid';
        lengthCheck.innerHTML = '<i class="fas fa-check-circle"></i> At least 8 characters';
    } else {
        lengthCheck.className = 'invalid';
        lengthCheck.innerHTML = '<i class="fas fa-times-circle"></i> At least 8 characters';
    }
    
    // Uppercase check
    const uppercaseCheck = document.getElementById('uppercase');
    if (/[A-Z]/.test(password)) {
        uppercaseCheck.className = 'valid';
        uppercaseCheck.innerHTML = '<i class="fas fa-check-circle"></i> At least one uppercase letter';
    } else {
        uppercaseCheck.className = 'invalid';
        uppercaseCheck.innerHTML = '<i class="fas fa-times-circle"></i> At least one uppercase letter';
    }
    
    // Lowercase check
    const lowercaseCheck = document.getElementById('lowercase');
    if (/[a-z]/.test(password)) {
        lowercaseCheck.className = 'valid';
        lowercaseCheck.innerHTML = '<i class="fas fa-check-circle"></i> At least one lowercase letter';
    } else {
        lowercaseCheck.className = 'invalid';
        lowercaseCheck.innerHTML = '<i class="fas fa-times-circle"></i> At least one lowercase letter';
    }
    
    // Number check
    const numberCheck = document.getElementById('number');
    if (/[0-9]/.test(password)) {
        numberCheck.className = 'valid';
        numberCheck.innerHTML = '<i class="fas fa-check-circle"></i> At least one number';
    } else {
        numberCheck.className = 'invalid';
        numberCheck.innerHTML = '<i class="fas fa-times-circle"></i> At least one number';
    }
    
    // Special character check
    const specialCheck = document.getElementById('special');
    if (/[!@#$%^&*(),.?":{}|<>]/.test(password)) {
        specialCheck.className = 'valid';
        specialCheck.innerHTML = '<i class="fas fa-check-circle"></i> At least one special character';
    } else {
        specialCheck.className = 'invalid';
        specialCheck.innerHTML = '<i class="fas fa-times-circle"></i> At least one special character';
    }
});
</script>
<?= $this->endSection() ?>