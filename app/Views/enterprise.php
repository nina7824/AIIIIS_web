<?= $this->extend('layouts/main') ?>

<?= $this->section('styles') ?>
/* ========== ENTERPRISE PAGE STYLES ========== */
.enterprise-hero {
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    padding: 3rem 0 4rem;
    color: #fff;
    position: relative;
    overflow: hidden;
}
.enterprise-hero::before {
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
.enterprise-hero .container {
    position: relative;
    z-index: 1;
}
.enterprise-hero .breadcrumb {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.75rem;
    color: rgba(255,255,255,0.7);
    margin-bottom: 1rem;
}
.enterprise-hero .breadcrumb a {
    color: rgba(255,255,255,0.8);
    text-decoration: none;
}
.enterprise-hero .breadcrumb a:hover {
    color: #fff;
}
.enterprise-hero .breadcrumb i {
    font-size: 0.6rem;
}
.enterprise-hero h1 {
    font-size: 2.2rem;
    font-weight: 800;
    margin-bottom: 0.3rem;
    letter-spacing: -0.02em;
}
.enterprise-hero .enterprise-badge {
    display: inline-block;
    background: rgba(255,255,255,0.15);
    padding: 0.25rem 1rem;
    border-radius: 100px;
    font-size: 0.6rem;
    font-weight: 600;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.1);
    margin-bottom: 0.5rem;
}
.enterprise-hero .subtitle {
    font-size: 1rem;
    color: rgba(255,255,255,0.85);
    max-width: 32rem;
    line-height: 1.7;
    margin-top: 0.5rem;
}
.enterprise-hero .hero-stats {
    display: flex;
    gap: 2.5rem;
    margin-top: 1.5rem;
    flex-wrap: wrap;
}
.enterprise-hero .hero-stats .stat {
    display: flex;
    flex-direction: column;
}
.enterprise-hero .hero-stats .stat .number {
    font-size: 1.5rem;
    font-weight: 800;
}
.enterprise-hero .hero-stats .stat .label {
    font-size: 0.7rem;
    color: rgba(255,255,255,0.7);
}
@media (max-width: 640px) {
    .enterprise-hero { padding: 2.5rem 0; }
    .enterprise-hero h1 { font-size: 1.6rem; }
    .enterprise-hero .subtitle { max-width: 100%; }
    .enterprise-hero .hero-stats { gap: 1.5rem; }
    .enterprise-hero .hero-stats .stat .number { font-size: 1.2rem; }
}

/* ========== ENTERPRISE NAV ========== */
.enterprise-nav {
    background: var(--surface);
    border-bottom: 1px solid var(--border);
    padding: 0;
    position: sticky;
    top: 0;
    z-index: 100;
}
.enterprise-nav .nav-items {
    display: flex;
    gap: 0.25rem;
    padding: 0.75rem 0;
    flex-wrap: wrap;
}
.enterprise-nav .nav-items a {
    padding: 0.5rem 1.25rem;
    font-size: 0.82rem;
    font-weight: 500;
    color: var(--ink-muted);
    border-radius: var(--radius);
    transition: var(--transition);
    white-space: nowrap;
}
.enterprise-nav .nav-items a:hover {
    color: var(--ink);
    background: var(--canvas);
}
.enterprise-nav .nav-items a.active {
    color: var(--primary);
    background: var(--primary-light);
}
@media (max-width: 768px) {
    .enterprise-nav .nav-items {
        flex-wrap: nowrap;
        overflow-x: auto;
        padding: 0.5rem 0;
        gap: 0.1rem;
        -webkit-overflow-scrolling: touch;
    }
    .enterprise-nav .nav-items a {
        padding: 0.4rem 1rem;
        font-size: 0.75rem;
        flex-shrink: 0;
    }
}

/* ========== CONTENT SECTIONS ========== */
.content-section {
    padding: 3rem 0;
}

/* Overview Section */
.overview-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 3rem;
    align-items: start;
}
.overview-content h2 {
    font-size: 2rem;
    font-weight: 800;
    letter-spacing: -0.02em;
    margin-bottom: 1rem;
}
.overview-content h2 span { color: var(--primary); }
.overview-content p {
    color: var(--ink-muted);
    line-height: 1.8;
    margin-bottom: 1.5rem;
    font-size: 0.98rem;
}
.overview-content .benefits-list {
    list-style: none;
    padding: 0;
    margin-bottom: 2rem;
}
.overview-content .benefits-list li {
    padding: 0.5rem 0 0.5rem 2rem;
    position: relative;
    font-size: 0.92rem;
    color: var(--ink);
    border-bottom: 1px solid var(--border);
}
.overview-content .benefits-list li:last-child {
    border-bottom: none;
}
.overview-content .benefits-list li::before {
    content: '✓';
    position: absolute;
    left: 0;
    color: var(--primary);
    font-weight: 700;
    font-size: 1.1rem;
}
.overview-content .btn-register {
    padding: 0.8rem 2.5rem;
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    color: #fff;
    border: none;
    border-radius: var(--radius);
    font-weight: 600;
    font-size: 0.95rem;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 0.6rem;
    box-shadow: 0 4px 16px rgba(7, 142, 206, 0.3);
    transition: var(--transition);
    text-decoration: none;
}
.overview-content .btn-register:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 28px rgba(7, 142, 206, 0.4);
}

.overview-sidebar {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}
.overview-sidebar .card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 1.75rem;
    transition: var(--transition);
}
.overview-sidebar .card:hover {
    border-color: var(--primary);
    box-shadow: var(--shadow-md);
}
.overview-sidebar .card .card-icon {
    width: 48px;
    height: 48px;
    border-radius: var(--radius);
    background: var(--primary-light);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--primary);
    font-size: 1.2rem;
    margin-bottom: 1rem;
}
.overview-sidebar .card h4 {
    font-size: 1rem;
    font-weight: 700;
    margin-bottom: 0.3rem;
}
.overview-sidebar .card p {
    font-size: 0.85rem;
    color: var(--ink-muted);
    line-height: 1.6;
}
@media (max-width: 992px) {
    .overview-grid {
        grid-template-columns: 1fr;
        gap: 2rem;
    }
}
@media (max-width: 560px) {
    .overview-content h2 { font-size: 1.5rem; }
    .overview-content .btn-register { width: 100%; justify-content: center; }
}

/* Placeholder for other sections */
.content-placeholder {
    padding: 3rem 0;
    text-align: center;
}
.content-placeholder i {
    font-size: 3rem;
    color: var(--primary-light);
    margin-bottom: 1rem;
    display: block;
}
.content-placeholder h3 {
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
}
.content-placeholder p {
    color: var(--ink-muted);
    max-width: 32rem;
    margin: 0 auto;
}

/* ========== REGISTER CTA ========== */
.register-cta {
    background: var(--canvas);
    padding: 3rem 0;
    border-top: 1px solid var(--border);
}
.register-cta .cta-card {
    background: linear-gradient(160deg, var(--primary) 0%, var(--primary-dark) 100%);
    border-radius: var(--radius-lg);
    padding: 3rem 3.5rem;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 2.5rem;
    flex-wrap: wrap;
    box-shadow: var(--shadow-lg);
}
.register-cta .cta-card .cta-content h2 {
    font-size: 1.5rem;
    font-weight: 800;
    letter-spacing: -0.02em;
    margin-bottom: 0.3rem;
}
.register-cta .cta-card .cta-content p {
    color: rgba(255,255,255,0.85);
    font-size: 0.9rem;
}
.register-cta .cta-card .btn-cta-large {
    padding: 0.8rem 2.5rem;
    background: #fff;
    color: var(--primary-dark);
    border: none;
    border-radius: var(--radius);
    font-weight: 700;
    font-size: 0.95rem;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 0.6rem;
    flex-shrink: 0;
    box-shadow: 0 4px 16px rgba(0,0,0,0.1);
    transition: var(--transition);
    text-decoration: none;
}
.register-cta .cta-card .btn-cta-large:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 28px rgba(0,0,0,0.2);
}
@media (max-width: 860px) {
    .register-cta .cta-card {
        padding: 2rem 1.5rem;
        flex-direction: column;
        text-align: center;
    }
    .register-cta .cta-card .btn-cta-large {
        width: 100%;
        justify-content: center;
    }
}
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- ========== ENTERPRISE HERO ========== -->
<section class="enterprise-hero">
    <div class="container">
        <div class="breadcrumb">
            <a href="<?= base_url() ?>">Home</a>
            <i class="fas fa-chevron-right"></i>
            <span>Enterprises</span>
        </div>
        
        <div class="enterprise-badge">Enterprise Intelligence</div>
        <h1>
            <?php if ($section == 'overview'): ?>
                Enterprise Intelligence
            <?php elseif ($section == 'directory'): ?>
                Enterprise Directory
            <?php elseif ($section == 'verification'): ?>
                Verification Queue
            <?php elseif ($section == 'gis'): ?>
                GIS Map View
            <?php elseif ($section == 'clusters'): ?>
                Sector Clusters
            <?php elseif ($section == 'ranking'): ?>
                Enterprise Ranking
            <?php endif; ?>
        </h1>
        <p class="subtitle">
            <?php if ($section == 'overview'): ?>
                Complete visibility into Rwanda's industrial landscape — from individual enterprises to sector-wide trends.
            <?php elseif ($section == 'directory'): ?>
                Browse and search the complete directory of registered enterprises in Rwanda.
            <?php elseif ($section == 'verification'): ?>
                Manage and track enterprise verification requests.
            <?php elseif ($section == 'gis'): ?>
                Geographic visualization of enterprises across Rwanda by sector and cluster.
            <?php elseif ($section == 'clusters'): ?>
                View and analyze industrial sector clusters across Rwanda.
            <?php elseif ($section == 'ranking'): ?>
                AI-driven ranking of enterprises based on growth, innovation, and sustainability metrics.
            <?php endif; ?>
        </p>
        
        <?php if ($section == 'overview'): ?>
        <div class="hero-stats">
            <div class="stat">
                <span class="number">1,247+</span>
                <span class="label">Registered Enterprises</span>
            </div>
            <div class="stat">
                <span class="number">18</span>
                <span class="label">Industrial Sectors</span>
            </div>
            <div class="stat">
                <span class="number">92%</span>
                <span class="label">Data Accuracy Rate</span>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- ========== ENTERPRISE NAVIGATION ========== -->
<section class="enterprise-nav">
    <div class="container">
        <div class="nav-items">
            <a href="<?= base_url('enterprises') ?>" class="<?= $section == 'overview' ? 'active' : '' ?>">Overview</a>
            <a href="<?= base_url('enterprises/directory') ?>" class="<?= $section == 'directory' ? 'active' : '' ?>">Enterprise Directory</a>
            <a href="<?= base_url('enterprises/verification') ?>" class="<?= $section == 'verification' ? 'active' : '' ?>">Verification Queue</a>
            <a href="<?= base_url('enterprises/gis') ?>" class="<?= $section == 'gis' ? 'active' : '' ?>">GIS Map View</a>
            <a href="<?= base_url('enterprises/clusters') ?>" class="<?= $section == 'clusters' ? 'active' : '' ?>">Sector Clusters</a>
            <a href="<?= base_url('enterprises/ranking') ?>" class="<?= $section == 'ranking' ? 'active' : '' ?>">Enterprise Ranking</a>
        </div>
    </div>
</section>

<!-- ========== CONTENT ========== -->
<section class="content-section">
    <div class="container">
        <?php if ($section == 'overview'): ?>
        <!-- ===== OVERVIEW CONTENT ===== -->
        <div class="overview-grid">
            <div class="overview-content">
                <h2>How NIRDA Supports <span>Your Enterprise</span></h2>
                <p>
                    The National Industrial Research and Development Agency (NIRDA) is committed to driving 
                    Rwanda's industrial transformation through comprehensive enterprise support and strategic 
                    investment matchmaking.
                </p>
                
                <h3 style="font-size: 1.1rem; font-weight: 700; margin: 1.5rem 0 0.5rem;">Benefits of Working with NIRDA</h3>
                <ul class="benefits-list">
                    <li><strong>Investment Matchmaking:</strong> Get connected with the right investors through our AI-powered matchmaking engine</li>
                    <li><strong>Enterprise Visibility:</strong> Increase your enterprise's visibility to investors, partners, and government stakeholders</li>
                    <li><strong>Technical Assistance:</strong> Access expert technical support and advisory services</li>
                    <li><strong>Market Intelligence:</strong> Gain insights into market trends, sector performance, and investment opportunities</li>
                    <li><strong>Policy Support:</strong> Benefit from policy advocacy and government support programs</li>
                    <li><strong>Innovation Hub:</strong> Access R&D facilities and innovation programs</li>
                </ul>
                
                <a href="<?= base_url('register') ?>" class="btn-register">
                    <i class="fas fa-user-plus"></i> Register Now
                </a>
            </div>
            
            <div class="overview-sidebar">
                <div class="card">
                    <div class="card-icon"><i class="fas fa-handshake"></i></div>
                    <h4>Investor Matchmaking</h4>
                    <p>Our AI-powered matchmaking engine connects enterprises with investors based on sector, growth potential, and investment readiness.</p>
                </div>
                
                <div class="card">
                    <div class="card-icon"><i class="fas fa-rocket"></i></div>
                    <h4>What You Access When You Register</h4>
                    <p>
                        <strong>Enterprise Dashboard:</strong> Track your profile, ranking, and match recommendations<br>
                        <strong>Investor Connections:</strong> View and connect with potential investors<br>
                        <strong>Advisory Services:</strong> Request expert business and technical advisory<br>
                        <strong>Performance Analytics:</strong> Monitor your enterprise growth metrics<br>
                        <strong>Opportunity Alerts:</strong> Get notified about relevant opportunities
                    </p>
                </div>
            </div>
        </div>
        
        <?php elseif ($section == 'directory'): ?>
        <!-- ===== DIRECTORY CONTENT ===== -->
        <div class="content-placeholder">
            <i class="fas fa-building"></i>
            <h3>Enterprise Directory</h3>
            <p>Browse and search the complete directory of registered enterprises in Rwanda. Coming soon with advanced search and filtering capabilities.</p>
        </div>
        
        <?php elseif ($section == 'verification'): ?>
        <!-- ===== VERIFICATION CONTENT ===== -->
        <div class="content-placeholder">
            <i class="fas fa-check-circle"></i>
            <h3>Verification Queue</h3>
            <p>Manage and track enterprise verification requests. Coming soon with full verification management system.</p>
        </div>
        
        <?php elseif ($section == 'gis'): ?>
        <!-- ===== GIS CONTENT ===== -->
        <div class="content-placeholder">
            <i class="fas fa-map-marked-alt"></i>
            <h3>GIS Map View</h3>
            <p>Geographic visualization of enterprises across Rwanda. Coming soon with interactive mapping features.</p>
        </div>
        
        <?php elseif ($section == 'clusters'): ?>
        <!-- ===== CLUSTERS CONTENT ===== -->
        <div class="content-placeholder">
            <i class="fas fa-chart-pie"></i>
            <h3>Sector Clusters</h3>
            <p>View and analyze industrial sector clusters across Rwanda. Coming soon with detailed cluster analysis.</p>
        </div>
        
        <?php elseif ($section == 'ranking'): ?>
        <!-- ===== RANKING CONTENT ===== -->
        <div class="content-placeholder">
            <i class="fas fa-trophy"></i>
            <h3>Enterprise Ranking</h3>
            <p>AI-driven ranking of enterprises based on growth, innovation, and sustainability metrics. Coming soon.</p>
        </div>
        
        <?php endif; ?>
    </div>
</section>

<!-- ========== REGISTER CTA ========== -->
<section class="register-cta">
    <div class="container">
        <div class="cta-card">
            <div class="cta-content">
                <h2>Ready to Transform Your Enterprise?</h2>
                <p>Join the AIIIIS platform and unlock your enterprise's full potential.</p>
            </div>
            <a href="<?= base_url('register') ?>" class="btn-cta-large">
                <i class="fas fa-arrow-right"></i> Register Now
            </a>
        </div>
    </div>
</section>
<?= $this->endSection() ?>