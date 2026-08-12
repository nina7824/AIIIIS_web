

<?= $this->section('content') ?>
<!-- ========== REGISTER HERO ========== -->
<section class="register-hero">
    <div class="container">
        <div class="breadcrumb">
            <a href="<?= base_url() ?>">Home</a>
            <i class="fas fa-chevron-right"></i>
            <span>Register</span>
        </div>
        <h1>Join the AIIIIS Platform</h1>
        <p class="subtitle">Register as an Enterprise or Investor to unlock the full potential of Rwanda's industrial intelligence ecosystem.</p>
    </div>
</section>

<!-- ========== ALERTS ========== -->
<section class="register-section" style="padding-top: 0;">
    <div class="container">
        <?php if (session()->getFlashdata('error')): ?>
            <div style="background: #fde8e8; color: #c0392b; padding: 0.75rem 1rem; border-radius: var(--radius); margin-bottom: 1rem; border-left: 4px solid #e74c3c;">
                <i class="fas fa-exclamation-circle"></i> <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>
        
        <?php if (session()->getFlashdata('errors')): ?>
            <div style="background: #fde8e8; color: #c0392b; padding: 0.75rem 1rem; border-radius: var(--radius); margin-bottom: 1rem; border-left: 4px solid #e74c3c;">
                <i class="fas fa-exclamation-circle"></i> Please fix the following errors:
                <ul style="margin: 0.5rem 0 0 1.5rem;">
                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                        <li><?= $error ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        
        <?php if (session()->getFlashdata('success')): ?>
            <div style="background: #e8f5e9; color: #2e7d32; padding: 0.75rem 1rem; border-radius: var(--radius); margin-bottom: 1rem; border-left: 4px solid #4caf50;">
                <i class="fas fa-check-circle"></i> <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>
        
        <?php if (session()->getFlashdata('info')): ?>
            <div style="background: #e6f4fb; color: #045a86; padding: 0.75rem 1rem; border-radius: var(--radius); margin-bottom: 1rem; border-left: 4px solid var(--primary);">
                <i class="fas fa-info-circle"></i> <?= session()->getFlashdata('info') ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- ========== REGISTER TABS ========== -->
<!-- Rest of your register content... -->
<?= $this->section('styles') ?>
/* ========== REGISTER PAGE STYLES ========== */
.register-hero {
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    padding: 3rem 0 4rem;
    color: #fff;
    position: relative;
    overflow: hidden;
}
.register-hero::before {
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
.register-hero .container {
    position: relative;
    z-index: 1;
}
.register-hero .breadcrumb {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.75rem;
    color: rgba(255,255,255,0.7);
    margin-bottom: 1rem;
}
.register-hero .breadcrumb a {
    color: rgba(255,255,255,0.8);
    text-decoration: none;
}
.register-hero .breadcrumb a:hover {
    color: #fff;
}
.register-hero .breadcrumb i {
    font-size: 0.6rem;
}
.register-hero h1 {
    font-size: 2.2rem;
    font-weight: 800;
    margin-bottom: 0.3rem;
    letter-spacing: -0.02em;
}
.register-hero .subtitle {
    font-size: 1rem;
    color: rgba(255,255,255,0.85);
    max-width: 32rem;
    line-height: 1.7;
}
@media (max-width: 640px) {
    .register-hero { padding: 2.5rem 0; }
    .register-hero h1 { font-size: 1.6rem; }
    .register-hero .subtitle { max-width: 100%; }
}

/* ========== REGISTER TABS ========== */
.register-tabs {
    background: var(--surface);
    border-bottom: 1px solid var(--border);
    padding: 0;
    position: sticky;
    top: 0;
    z-index: 100;
}
.register-tabs .tab-items {
    display: flex;
    gap: 0.25rem;
    padding: 0.75rem 0;
    flex-wrap: wrap;
}
.register-tabs .tab-items a {
    padding: 0.5rem 1.25rem;
    font-size: 0.82rem;
    font-weight: 500;
    color: var(--ink-muted);
    border-radius: var(--radius);
    transition: var(--transition);
    white-space: nowrap;
    cursor: pointer;
}
.register-tabs .tab-items a:hover {
    color: var(--ink);
    background: var(--canvas);
}
.register-tabs .tab-items a.active {
    color: var(--primary);
    background: var(--primary-light);
}
@media (max-width: 768px) {
    .register-tabs .tab-items {
        flex-wrap: nowrap;
        overflow-x: auto;
        padding: 0.5rem 0;
        gap: 0.1rem;
        -webkit-overflow-scrolling: touch;
    }
    .register-tabs .tab-items a {
        padding: 0.4rem 1rem;
        font-size: 0.75rem;
        flex-shrink: 0;
    }
}

/* ========== REGISTER FORM ========== */
.register-section {
    padding: 3rem 0 4rem;
}
.register-section .form-container {
    max-width: 800px;
    margin: 0 auto;
}
.register-section .form-container .form-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 2.5rem;
    box-shadow: var(--shadow-sm);
}
.register-section .form-container .form-card h2 {
    font-size: 1.4rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
}
.register-section .form-container .form-card .form-subtitle {
    color: var(--ink-muted);
    font-size: 0.9rem;
    margin-bottom: 1.5rem;
}
.register-section .form-container .form-card .form-group {
    margin-bottom: 1.25rem;
}
.register-section .form-container .form-card .form-group label {
    display: block;
    font-size: 0.82rem;
    font-weight: 600;
    margin-bottom: 0.3rem;
    color: var(--ink);
}
.register-section .form-container .form-card .form-group label .required {
    color: #e74c3c;
    margin-left: 0.2rem;
}
.register-section .form-container .form-card .form-group input,
.register-section .form-container .form-card .form-group select,
.register-section .form-container .form-card .form-group textarea {
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
.register-section .form-container .form-card .form-group input:focus,
.register-section .form-container .form-card .form-group select:focus,
.register-section .form-container .form-card .form-group textarea:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(7, 142, 206, 0.1);
    background: var(--surface);
}
.register-section .form-container .form-card .form-group textarea {
    resize: vertical;
    min-height: 80px;
}
.register-section .form-container .form-card .form-group .help-text {
    font-size: 0.7rem;
    color: var(--ink-muted);
    margin-top: 0.2rem;
}
.register-section .form-container .form-card .form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
}
.register-section .form-container .form-card .form-group .file-upload {
    border: 2px dashed var(--border);
    padding: 1.5rem;
    text-align: center;
    border-radius: var(--radius);
    cursor: pointer;
    transition: var(--transition);
}
.register-section .form-container .form-card .form-group .file-upload:hover {
    border-color: var(--primary);
    background: var(--primary-light);
}
.register-section .form-container .form-card .form-group .file-upload i {
    font-size: 2rem;
    color: var(--primary);
    display: block;
    margin-bottom: 0.5rem;
}
.register-section .form-container .form-card .form-group .file-upload p {
    font-size: 0.8rem;
    color: var(--ink-muted);
    margin: 0;
}
.register-section .form-container .form-card .form-group .file-upload input[type="file"] {
    display: none;
}
.register-section .form-container .form-card .checkbox-group {
    display: flex;
    align-items: flex-start;
    gap: 0.6rem;
    margin-bottom: 1rem;
}
.register-section .form-container .form-card .checkbox-group input[type="checkbox"] {
    width: 18px;
    height: 18px;
    margin-top: 0.2rem;
    accent-color: var(--primary);
    flex-shrink: 0;
}
.register-section .form-container .form-card .checkbox-group label {
    font-size: 0.82rem;
    color: var(--ink-muted);
}
.register-section .form-container .form-card .checkbox-group label a {
    color: var(--primary);
    text-decoration: underline;
}
.register-section .form-container .form-card .btn-submit {
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
.register-section .form-container .form-card .btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 28px rgba(7, 142, 206, 0.4);
}
.register-section .form-container .form-card .form-footer {
    text-align: center;
    margin-top: 1.25rem;
    font-size: 0.85rem;
    color: var(--ink-muted);
}
.register-section .form-container .form-card .form-footer a {
    color: var(--primary);
    font-weight: 600;
}
.register-section .form-container .form-card .form-footer a:hover {
    text-decoration: underline;
}
@media (max-width: 768px) {
    .register-section .form-container .form-card {
        padding: 1.5rem;
    }
    .register-section .form-container .form-card .form-row {
        grid-template-columns: 1fr;
    }
}
.hidden {
    display: none;
}
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- ========== REGISTER HERO ========== -->
<section class="register-hero">
    <div class="container">
        <div class="breadcrumb">
            <a href="<?= base_url() ?>">Home</a>
            <i class="fas fa-chevron-right"></i>
            <span>Register</span>
        </div>
        <h1>Join the AIIIIS Platform</h1>
        <p class="subtitle">Register as an Enterprise or Investor to unlock the full potential of Rwanda's industrial intelligence ecosystem.</p>
    </div>
</section>

<!-- ========== REGISTER TABS ========== -->
<section class="register-tabs">
    <div class="container">
        <div class="tab-items">
            <a class="active" onclick="showTab('enterprise')">Enterprise Registration</a>
            <a onclick="showTab('investor')">Investor Registration</a>
        </div>
    </div>
</section>

<!-- ========== REGISTER FORMS ========== -->
<section class="register-section">
    <div class="container">
        <div class="form-container">
            
            <!-- ===== ENTERPRISE REGISTRATION FORM ===== -->
            <div id="enterprise-form" class="form-card">
                <h2>Enterprise Registration</h2>
                <p class="form-subtitle">Register your enterprise to access investment opportunities, AI-powered matchmaking, and industrial intelligence.</p>
                
                <form action="<?= base_url('register') ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <input type="hidden" name="user_type" value="enterprise">
                    
                    <!-- Basic Information -->
                    <div class="form-group">
                        <label>Enterprise Name <span class="required">*</span></label>
                        <input type="text" name="enterprise_name" placeholder="Enter your enterprise name" required>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label>Sector <span class="required">*</span></label>
                            <select name="sector" required>
                                <option value="">Select Sector</option>
                                <option value="agriculture">Agriculture</option>
                                <option value="manufacturing">Manufacturing</option>
                                <option value="technology">Technology</option>
                                <option value="construction">Construction</option>
                                <option value="energy">Energy</option>
                                <option value="mining">Mining</option>
                                <option value="tourism">Tourism</option>
                                <option value="finance">Finance</option>
                                <option value="healthcare">Healthcare</option>
                                <option value="education">Education</option>
                                <option value="transport">Transport & Logistics</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Location <span class="required">*</span></label>
                            <input type="text" name="location" placeholder="City, District, Province" required>
                        </div>
                    </div>
                    
                    <!-- Contact Information -->
                    <div class="form-group">
                        <label>Contact Information <span class="required">*</span></label>
                        <input type="text" name="contact_info" placeholder="Phone number, email address" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Products / Services <span class="required">*</span></label>
                        <textarea name="products_services" placeholder="Describe your products or services" required></textarea>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label>Number of Employees <span class="required">*</span></label>
                            <input type="number" name="employees" placeholder="e.g., 50" required>
                        </div>
                        <div class="form-group">
                            <label>Revenue Information</label>
                            <input type="text" name="revenue" placeholder="Annual revenue (e.g., $500,000)">
                        </div>
                    </div>
                    
                    <!-- Growth & Technology -->
                    <div class="form-group">
                        <label>Growth Information</label>
                        <textarea name="growth_info" placeholder="Describe your growth trajectory, expansion plans, or recent achievements"></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label>Technology Information</label>
                        <textarea name="technology_info" placeholder="Describe your technology stack, digital transformation, or tech adoption"></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label>Innovation Information</label>
                        <textarea name="innovation_info" placeholder="Describe your innovation initiatives, R&D activities, or unique solutions"></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label>Environmental Information</label>
                        <textarea name="environmental_info" placeholder="Describe your environmental practices, sustainability initiatives, or green certifications"></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label>Investment Requirements</label>
                        <textarea name="investment_requirements" placeholder="Describe your investment needs, funding requirements, or partnership opportunities"></textarea>
                    </div>
                    
                    <!-- RDB Certificate Upload -->
                    <div class="form-group">
                        <label>Upload RDB Certificate <span class="required">*</span></label>
                        <div class="file-upload" onclick="document.getElementById('rdb_certificate').click()">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <p>Click to upload your RDB registration certificate</p>
                            <p style="font-size: 0.65rem; color: var(--ink-muted);">Supported formats: PDF, JPG, PNG (Max 5MB)</p>
                            <input type="file" id="rdb_certificate" name="rdb_certificate" accept=".pdf,.jpg,.jpeg,.png" required>
                        </div>
                    </div>
                    
                    <div class="checkbox-group">
                        <input type="checkbox" id="enterprise_terms" name="terms" required>
                        <label for="enterprise_terms">I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a> <span class="required">*</span></label>
                    </div>
                    
                    <button type="submit" class="btn-submit">
                        <i class="fas fa-user-plus"></i> Register Enterprise
                    </button>
                    
                    <div class="form-footer">
                        Already have an account? <a href="<?= base_url('login') ?>">Sign in</a>
                    </div>
                </form>
            </div>
            
            <!-- ===== INVESTOR REGISTRATION FORM ===== -->
            <div id="investor-form" class="form-card hidden">
                <h2>Investor Registration</h2>
                <p class="form-subtitle">Register as an investor to discover investment opportunities, access AI-powered matchmaking, and connect with enterprises.</p>
                
                <form action="<?= base_url('register') ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <input type="hidden" name="user_type" value="investor">
                    
                    <!-- Personal Information -->
                    <div class="form-group">
                        <label>Legal Full Name <span class="required">*</span></label>
                        <input type="text" name="full_name" placeholder="Enter your legal full name" required>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label>Email Address <span class="required">*</span></label>
                            <input type="email" name="email" placeholder="your@email.com" required>
                        </div>
                        <div class="form-group">
                            <label>Country <span class="required">*</span></label>
                            <input type="text" name="country" placeholder="Your country" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>ID Card or Passport <span class="required">*</span></label>
                        <div class="file-upload" onclick="document.getElementById('id_document').click()">
                            <i class="fas fa-id-card"></i>
                            <p>Click to upload your ID card or passport</p>
                            <p style="font-size: 0.65rem; color: var(--ink-muted);">Supported formats: PDF, JPG, PNG (Max 5MB)</p>
                            <input type="file" id="id_document" name="id_document" accept=".pdf,.jpg,.jpeg,.png" required>
                        </div>
                    </div>
                    
                    <!-- Investment Preferences -->
                    <div class="form-group">
                        <label>Investment Sector <span class="required">*</span></label>
                        <select name="investment_sector" required>
                            <option value="">Select Sector</option>
                            <option value="agriculture">Agriculture</option>
                            <option value="manufacturing">Manufacturing</option>
                            <option value="technology">Technology</option>
                            <option value="construction">Construction</option>
                            <option value="energy">Energy</option>
                            <option value="mining">Mining</option>
                            <option value="tourism">Tourism</option>
                            <option value="finance">Finance</option>
                            <option value="healthcare">Healthcare</option>
                            <option value="education">Education</option>
                            <option value="transport">Transport & Logistics</option>
                            <option value="all">All Sectors</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Preferred Enterprise Type <span class="required">*</span></label>
                        <select name="preferred_enterprise_type" required>
                            <option value="">Select Enterprise Type</option>
                            <option value="startup">Startup</option>
                            <option value="sme">SME</option>
                            <option value="large_enterprise">Large Enterprise</option>
                            <option value="all">All Types</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Geographic Preferences</label>
                        <input type="text" name="geographic_preferences" placeholder="Preferred locations (e.g., Kigali, Eastern Province, All Rwanda)">
                    </div>
                    
                    <div class="form-group">
                        <label>Technology Interests</label>
                        <textarea name="technology_interests" placeholder="Describe your technology interests or areas of focus"></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label>Sustainability Preferences</label>
                        <textarea name="sustainability_preferences" placeholder="Describe your sustainability preferences or ESG criteria"></textarea>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label>Investment Stage <span class="required">*</span></label>
                            <select name="investment_stage" required>
                                <option value="">Select Stage</option>
                                <option value="seed">Seed</option>
                                <option value="early">Early Stage</option>
                                <option value="growth">Growth</option>
                                <option value="expansion">Expansion</option>
                                <option value="all">All Stages</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Expected Returns</label>
                            <input type="text" name="expected_returns" placeholder="e.g., 20-30% ROI">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>Investment Criteria</label>
                        <textarea name="investment_criteria" placeholder="Describe your investment criteria, requirements, or preferences"></textarea>
                    </div>
                    
                    <div class="checkbox-group">
                        <input type="checkbox" id="investor_terms" name="terms" required>
                        <label for="investor_terms">I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a> <span class="required">*</span></label>
                    </div>
                    
                    <button type="submit" class="btn-submit">
                        <i class="fas fa-user-plus"></i> Register as Investor
                    </button>
                    
                    <div class="form-footer">
                        Already have an account? <a href="<?= base_url('login') ?>">Sign in</a>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
</section>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
function showTab(tab) {
    // Hide both forms
    document.getElementById('enterprise-form').classList.add('hidden');
    document.getElementById('investor-form').classList.add('hidden');
    
    // Show selected form
    if (tab === 'enterprise') {
        document.getElementById('enterprise-form').classList.remove('hidden');
    } else {
        document.getElementById('investor-form').classList.remove('hidden');
    }
    
    // Update active tab
    document.querySelectorAll('.tab-items a').forEach(el => {
        el.classList.remove('active');
    });
    event.target.classList.add('active');
}

// File upload display
document.addEventListener('DOMContentLoaded', function() {
    // Enterprise file upload
    const rdbInput = document.getElementById('rdb_certificate');
    if (rdbInput) {
        rdbInput.addEventListener('change', function() {
            const label = this.closest('.file-upload').querySelector('p');
            if (this.files && this.files[0]) {
                label.textContent = this.files[0].name;
            }
        });
    }
    
    // Investor file upload
    const idInput = document.getElementById('id_document');
    if (idInput) {
        idInput.addEventListener('change', function() {
            const label = this.closest('.file-upload').querySelector('p');
            if (this.files && this.files[0]) {
                label.textContent = this.files[0].name;
            }
        });
    }
});
</script>
<?= $this->endSection() ?>