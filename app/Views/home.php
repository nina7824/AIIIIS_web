<?= $this->extend('layouts/main') ?>

<?= $this->section('styles') ?>
/* ========== HERO ========== */
.hero {
    background: var(--canvas);
    padding: 4.5rem 0 4rem;
    border-bottom: 1px solid var(--border);
}
.hero-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 4rem;
    align-items: center;
}
.hero-content .badge {
    display: inline-block;
    background: var(--primary-light);
    color: var(--primary-dark);
    padding: 0.25rem 1rem;
    border-radius: 100px;
    font-size: 0.65rem;
    font-weight: 600;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    margin-bottom: 1.25rem;
}
.hero-content h1 {
    font-size: 2.8rem;
    font-weight: 900;
    line-height: 1.1;
    letter-spacing: -0.03em;
    margin-bottom: 1.25rem;
}
.hero-content h1 .highlight {
    color: var(--primary);
    position: relative;
}
.hero-content h1 .highlight::after {
    content: '';
    position: absolute;
    bottom: 2px;
    left: 0;
    right: 0;
    height: 4px;
    background: var(--primary);
    border-radius: 4px;
    opacity: 0.25;
}
.hero-content p {
    font-size: 1.05rem;
    color: var(--ink-muted);
    line-height: 1.8;
    max-width: 32rem;
    margin-bottom: 2rem;
}
.hero-actions {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
    margin-bottom: 2.5rem;
}
.btn-hero-primary {
    padding: 0.8rem 2rem;
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    color: #fff;
    border: none;
    border-radius: var(--radius);
    font-weight: 600;
    font-size: 0.88rem;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 0.6rem;
    box-shadow: 0 4px 16px rgba(7, 142, 206, 0.3);
}
.btn-hero-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 28px rgba(7, 142, 206, 0.4);
}
.btn-hero-secondary {
    padding: 0.8rem 2rem;
    background: transparent;
    color: var(--ink);
    border: 1.5px solid var(--border);
    border-radius: var(--radius);
    font-weight: 600;
    font-size: 0.88rem;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 0.6rem;
}
.btn-hero-secondary:hover {
    border-color: var(--primary);
    color: var(--primary);
    background: var(--primary-light);
}
.hero-meta {
    display: flex;
    gap: 2.5rem;
    flex-wrap: wrap;
    padding-top: 1.75rem;
    border-top: 1px solid var(--border);
}
.hero-meta-item {
    display: flex;
    align-items: center;
    gap: 0.6rem;
    font-size: 0.78rem;
    color: var(--ink-muted);
    font-weight: 500;
}
.hero-meta-item i { color: var(--primary); font-size: 0.75rem; }

/* Hero Visual - Statistical Card */
.hero-visual { display: flex; align-items: center; justify-content: center; }
.stat-card {
    background: var(--surface);
    border-radius: var(--radius-lg);
    padding: 2rem 2rem 1.75rem;
    box-shadow: var(--shadow-lg);
    border: 1px solid var(--border);
    width: 100%;
    max-width: 520px;
}
.stat-card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
}
.stat-card-header .label {
    font-family: 'IBM Plex Mono', monospace;
    font-size: 0.6rem;
    font-weight: 600;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: var(--ink-muted);
}
.stat-card-header .period {
    font-size: 0.6rem;
    color: var(--ink-muted);
    background: var(--canvas);
    padding: 0.15rem 0.6rem;
    border-radius: 100px;
    font-weight: 500;
}
.stat-chart { margin-bottom: 1.5rem; }
.stat-chart svg { width: 100%; height: auto; }
.stat-legend {
    display: flex;
    justify-content: center;
    gap: 1.5rem;
    margin-top: 0.75rem;
}
.stat-legend-item {
    display: flex;
    align-items: center;
    gap: 0.4rem;
    font-size: 0.65rem;
    font-weight: 500;
    color: var(--ink-muted);
}
.stat-legend-item .dot { width: 8px; height: 8px; border-radius: 50%; }
.stat-legend-item .dot.primary { background: var(--primary); }
.stat-legend-item .dot.secondary { background: #22a67e; }
.stat-summary {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1rem;
    padding-top: 1.25rem;
    border-top: 1px solid var(--border);
    margin-top: 0.5rem;
}
.stat-summary-item { text-align: center; }
.stat-summary-item .number {
    font-size: 1.2rem;
    font-weight: 800;
    color: var(--primary);
    display: block;
}
.stat-summary-item .label {
    font-size: 0.6rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.04em;
    color: var(--ink-muted);
}

@media (max-width: 1024px) {
    .hero-content h1 { font-size: 2.3rem; }
    .hero-grid { gap: 2.5rem; }
}
@media (max-width: 860px) {
    .hero-grid { grid-template-columns: 1fr; gap: 2.5rem; }
    .hero-content h1 { font-size: 2rem; }
    .hero-content p { max-width: 100%; }
    .stat-card { max-width: 100%; }
}
@media (max-width: 480px) {
    .hero { padding: 3rem 0 2.5rem; }
    .hero-content h1 { font-size: 1.6rem; }
    .hero-actions { flex-direction: column; }
    .hero-actions a { width: 100%; justify-content: center; }
    .hero-meta { gap: 1rem; }
    .stat-summary { grid-template-columns: 1fr; gap: 0.75rem; }
}

/* ========== STATS BAR ========== */
.stats-bar {
    background: var(--surface);
    border-bottom: 1px solid var(--border);
}
.stats-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    padding: 2rem 0;
}
.stat-item {
    text-align: center;
    border-left: 1px solid var(--border);
    padding: 0 1.5rem;
}
.stat-item:first-child { border-left: none; }
.stat-item .number {
    font-size: 1.8rem;
    font-weight: 900;
    letter-spacing: -0.02em;
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}
.stat-item .label {
    font-size: 0.68rem;
    font-weight: 600;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    color: var(--ink-muted);
    margin-top: 0.25rem;
}
@media (max-width: 700px) {
    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem 0;
        padding: 1.75rem 0;
    }
    .stat-item:nth-child(2) { border-left: none; }
    .stat-item .number { font-size: 1.4rem; }
}
@media (max-width: 480px) { .stat-item { padding: 0 0.75rem; } }

/* ========== MODULES ========== */
.module-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 1.25rem;
}
.module-card {
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 1.5rem 1.5rem 1.75rem;
    background: var(--surface);
    transition: var(--transition);
}
.module-card:hover {
    border-color: var(--primary);
    box-shadow: var(--shadow-md);
    transform: translateY(-3px);
}
.module-card .icon {
    width: 40px;
    height: 40px;
    border-radius: var(--radius);
    background: var(--primary-light);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 0.85rem;
    color: var(--primary);
    font-size: 0.95rem;
}
.module-card:hover .icon {
    background: var(--primary);
    color: #fff;
}
.module-card h4 { font-size: 0.88rem; font-weight: 700; margin-bottom: 0.3rem; }
.module-card p { font-size: 0.8rem; color: var(--ink-muted); line-height: 1.6; }
@media (max-width: 992px) { .module-grid { grid-template-columns: repeat(2, 1fr); } }
@media (max-width: 560px) { .module-grid { grid-template-columns: 1fr; } }

/* ========== PARTNERS ========== */
.partners-section {
    background: var(--surface);
    border-top: 1px solid var(--border);
    border-bottom: 1px solid var(--border);
    padding: 3.5rem 0;
}
.partners-header {
    text-align: center;
    margin-bottom: 2.5rem;
}
.partners-header .eyebrow {
    font-family: 'IBM Plex Mono', monospace;
    font-size: 0.62rem;
    font-weight: 600;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--primary);
    display: inline-block;
    margin-bottom: 0.3rem;
}
.partners-header h2 { font-size: 1.6rem; font-weight: 700; letter-spacing: -0.02em; margin: 0.3rem 0 0.5rem; }
.partners-header p { color: var(--ink-muted); font-size: 0.92rem; }
.partners-grid {
    display: grid;
    grid-template-columns: repeat(6, 1fr);
    gap: 2rem;
    align-items: center;
}
.partner-logo {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 1rem;
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    height: 100px;
    min-height: 80px;
}
.partner-logo:hover {
    border-color: var(--primary);
    box-shadow: var(--shadow-sm);
    transform: translateY(-2px);
}
.partner-logo img {
    max-width: 100%;
    max-height: 60px;
    object-fit: contain;
}
@media (max-width: 1024px) { .partners-grid { grid-template-columns: repeat(3, 1fr); gap: 1.5rem; } }
@media (max-width: 560px) {
    .partners-grid { grid-template-columns: repeat(2, 1fr); gap: 1rem; }
    .partner-logo { height: 80px; min-height: 60px; padding: 0.75rem; }
    .partner-logo img { max-height: 45px; }
}

/* ========== AUDIENCES ========== */
.audience-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1.5rem;
}
.audience-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 2rem 2rem 1.75rem;
}
.audience-card:hover {
    border-color: var(--primary);
    box-shadow: var(--shadow-md);
    transform: translateY(-3px);
}
.audience-card .tag {
    display: inline-block;
    font-family: 'IBM Plex Mono', monospace;
    font-size: 0.55rem;
    font-weight: 600;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: var(--primary-dark);
    background: var(--primary-light);
    padding: 0.2rem 0.8rem;
    border-radius: 100px;
    margin-bottom: 0.8rem;
}
.audience-card h3 { font-size: 1.05rem; font-weight: 700; margin-bottom: 0.4rem; }
.audience-card p {
    font-size: 0.85rem;
    color: var(--ink-muted);
    line-height: 1.6;
    margin-bottom: 0.85rem;
}
.audience-card ul { list-style: none; padding: 0; }
.audience-card ul li {
    font-size: 0.8rem;
    color: var(--ink);
    padding: 0.3rem 0 0.3rem 1.3rem;
    position: relative;
    border-bottom: 1px solid var(--border);
}
.audience-card ul li:last-child { border-bottom: none; }
.audience-card ul li::before {
    content: '›';
    position: absolute;
    left: 0;
    color: var(--primary);
    font-weight: 700;
    font-size: 1.1rem;
}
@media (max-width: 860px) { .audience-grid { grid-template-columns: 1fr; gap: 1rem; } }

/* ========== CTA ========== */
.cta-block {
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
.cta-block h2 { font-size: 1.5rem; font-weight: 800; letter-spacing: -0.02em; }
.cta-block p { color: rgba(255,255,255,0.85); font-size: 0.9rem; margin-top: 0.2rem; }
.cta-block .btn-cta {
    padding: 0.7rem 2rem;
    background: #fff;
    color: var(--primary-dark);
    border: none;
    border-radius: var(--radius);
    font-weight: 700;
    font-size: 0.88rem;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 0.6rem;
    flex-shrink: 0;
    box-shadow: 0 4px 16px rgba(0,0,0,0.1);
}
.cta-block .btn-cta:hover {
    background: var(--primary-light);
    transform: translateY(-2px);
    box-shadow: 0 8px 28px rgba(0,0,0,0.2);
}
@media (max-width: 700px) {
    .cta-block { padding: 2rem 1.5rem; text-align: center; justify-content: center; }
    .cta-block h2 { font-size: 1.2rem; }
}
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- ========== HERO ========== -->
<section class="hero">
    <div class="container">
        <div class="hero-grid">
            <div class="hero-content">
                <div class="badge">National Industrial Intelligence</div>
                <h1>Industrial innovation meets <span class="highlight">strategic investment</span></h1>
                <p>A unified platform for enterprise mapping, AI-driven ranking, investment matchmaking, and policy intelligence — supporting Rwanda's industrial transformation.</p>
                <div class="hero-actions">
                    <a href="<?= base_url('register') ?>" class="btn-hero-primary">
                        <i class="fas fa-arrow-right"></i> Get started
                    </a>
                    <a href="#" class="btn-hero-secondary">
                        <i class="fas fa-play-circle"></i> Explore platform
                    </a>
                </div>
                <div class="hero-meta">
                    <span class="hero-meta-item"><i class="fas fa-check-circle"></i> 1,200+ enterprises mapped</span>
                    <span class="hero-meta-item"><i class="fas fa-check-circle"></i> AI-powered matchmaking</span>
                    <span class="hero-meta-item"><i class="fas fa-check-circle"></i> Live GIS mapping</span>
                </div>
            </div>

            <div class="hero-visual">
                <div class="stat-card">
                    <div class="stat-card-header">
                        <span class="label">Enterprise & Investment Statistics</span>
                        <span class="period">Q3 2026</span>
                    </div>
                    <div class="stat-chart">
                        <svg viewBox="0 0 460 200" xmlns="http://www.w3.org/2000/svg">
                            <line x1="40" y1="175" x2="440" y2="175" stroke="#e3e7ea" stroke-width="1"/>
                            <line x1="40" y1="140" x2="440" y2="140" stroke="#e3e7ea" stroke-width="1" stroke-dasharray="4 4"/>
                            <line x1="40" y1="105" x2="440" y2="105" stroke="#e3e7ea" stroke-width="1" stroke-dasharray="4 4"/>
                            <line x1="40" y1="70" x2="440" y2="70" stroke="#e3e7ea" stroke-width="1" stroke-dasharray="4 4"/>
                            <line x1="40" y1="35" x2="440" y2="35" stroke="#e3e7ea" stroke-width="1" stroke-dasharray="4 4"/>
                            <rect x="55" y="115" width="28" height="60" rx="3" fill="#078ece" opacity="0.8"/>
                            <rect x="95" y="85" width="28" height="90" rx="3" fill="#078ece" opacity="0.85"/>
                            <rect x="135" y="130" width="28" height="45" rx="3" fill="#078ece" opacity="0.75"/>
                            <rect x="175" y="145" width="28" height="30" rx="3" fill="#078ece" opacity="0.7"/>
                            <rect x="215" y="55" width="28" height="120" rx="3" fill="#078ece" opacity="0.9"/>
                            <rect x="255" y="100" width="28" height="75" rx="3" fill="#078ece" opacity="0.8"/>
                            <rect x="295" y="135" width="28" height="40" rx="3" fill="#078ece" opacity="0.7"/>
                            <rect x="335" y="70" width="28" height="105" rx="3" fill="#078ece" opacity="0.85"/>
                            <rect x="375" y="115" width="28" height="60" rx="3" fill="#078ece" opacity="0.75"/>
                            <polyline points="69,90 109,55 149,110 189,135 229,30 269,80 309,120 349,50 389,90" fill="none" stroke="#22a67e" stroke-width="2.5" stroke-linecap="round"/>
                            <circle cx="69" cy="90" r="4" fill="#22a67e"/>
                            <circle cx="109" cy="55" r="4" fill="#22a67e"/>
                            <circle cx="149" cy="110" r="4" fill="#22a67e"/>
                            <circle cx="189" cy="135" r="4" fill="#22a67e"/>
                            <circle cx="229" cy="30" r="4" fill="#22a67e"/>
                            <circle cx="269" cy="80" r="4" fill="#22a67e"/>
                            <circle cx="309" cy="120" r="4" fill="#22a67e"/>
                            <circle cx="349" cy="50" r="4" fill="#22a67e"/>
                            <circle cx="389" cy="90" r="4" fill="#22a67e"/>
                            <text x="69" y="190" font-family="IBM Plex Mono, monospace" font-size="7" fill="#5c6b74" text-anchor="middle">Agri</text>
                            <text x="109" y="190" font-family="IBM Plex Mono, monospace" font-size="7" fill="#5c6b74" text-anchor="middle">Manu</text>
                            <text x="149" y="190" font-family="IBM Plex Mono, monospace" font-size="7" fill="#5c6b74" text-anchor="middle">Tech</text>
                            <text x="189" y="190" font-family="IBM Plex Mono, monospace" font-size="7" fill="#5c6b74" text-anchor="middle">Constr</text>
                            <text x="229" y="190" font-family="IBM Plex Mono, monospace" font-size="7" fill="#5c6b74" text-anchor="middle">Energy</text>
                            <text x="269" y="190" font-family="IBM Plex Mono, monospace" font-size="7" fill="#5c6b74" text-anchor="middle">Mining</text>
                            <text x="309" y="190" font-family="IBM Plex Mono, monospace" font-size="7" fill="#5c6b74" text-anchor="middle">Tourism</text>
                            <text x="349" y="190" font-family="IBM Plex Mono, monospace" font-size="7" fill="#5c6b74" text-anchor="middle">Finance</text>
                            <text x="389" y="190" font-family="IBM Plex Mono, monospace" font-size="7" fill="#5c6b74" text-anchor="middle">Other</text>
                        </svg>
                    </div>
                    <div class="stat-legend">
                        <span class="stat-legend-item"><span class="dot primary"></span> Enterprises by sector</span>
                        <span class="stat-legend-item"><span class="dot secondary"></span> Investment growth trend</span>
                    </div>
                    <div class="stat-summary">
                        <div class="stat-summary-item"><span class="number">1,247</span><span class="label">Total enterprises</span></div>
                        <div class="stat-summary-item"><span class="number">348</span><span class="label">Active investors</span></div>
                        <div class="stat-summary-item"><span class="number">92%</span><span class="label">Match accuracy</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ========== STATS ========== -->
<section class="stats-bar">
    <div class="container">
        <div class="stats-grid">
            <div class="stat-item"><div class="number">1,247</div><div class="label">Enterprises registered</div></div>
            <div class="stat-item"><div class="number">348</div><div class="label">Active investors</div></div>
            <div class="stat-item"><div class="number">18</div><div class="label">Industrial sectors</div></div>
            <div class="stat-item"><div class="number">92%</div><div class="label">Match accuracy rate</div></div>
        </div>
    </div>
</section>

<!-- ========== MODULES ========== -->
<section class="section">
    <div class="container">
        <div class="section-header">
            <div class="eyebrow">Platform modules</div>
            <h2>Complete industrial intelligence stack</h2>
            <p>From enterprise registration to policy reporting — every tool needed to drive industrial growth.</p>
        </div>
        <div class="module-grid">
            <div class="module-card">
                <div class="icon"><i class="fas fa-building"></i></div>
                <h4>Enterprise Management</h4>
                <p>Comprehensive enterprise profiles with registration, sector, location, and performance data.</p>
            </div>
            <div class="module-card">
                <div class="icon"><i class="fas fa-map-marked-alt"></i></div>
                <h4>GIS Mapping</h4>
                <p>Geographic visualization of enterprises by sector, cluster, and investment readiness.</p>
            </div>
            <div class="module-card">
                <div class="icon"><i class="fas fa-chart-line"></i></div>
                <h4>Enterprise Ranking</h4>
                <p>AI-driven scoring based on growth, innovation, technology, and sustainability metrics.</p>
            </div>
            <div class="module-card">
                <div class="icon"><i class="fas fa-handshake"></i></div>
                <h4>Investment Matchmaking</h4>
                <p>Intelligent matching between enterprises and investors using multi-factor scoring.</p>
            </div>
            <div class="module-card">
                <div class="icon"><i class="fas fa-users"></i></div>
                <h4>Investor Management</h4>
                <p>Investor profiles with sector preferences, investment criteria, and deal tracking.</p>
            </div>
            <div class="module-card">
                <div class="icon"><i class="fas fa-chart-pie"></i></div>
                <h4>Analytics Dashboards</h4>
                <p>Role-specific dashboards for enterprises, investors, and government stakeholders.</p>
            </div>
            <div class="module-card">
                <div class="icon"><i class="fas fa-headset"></i></div>
                <h4>Stakeholder Engagement</h4>
                <p>Expert directory, advisory requests, helpdesk, and engagement tracking.</p>
            </div>
            <div class="module-card">
                <div class="icon"><i class="fas fa-microchip"></i></div>
                <h4>IoT Integration</h4>
                <p>Real-time industrial sensor data integration for operational intelligence.</p>
            </div>
        </div>
    </div>
</section>

<!-- ========== PARTNERS ========== 
<section class="partners-section">
    <div class="container">
        <div class="partners-header">
            <div class="eyebrow">Our Partners</div>
            <h2>Collaborating for industrial transformation</h2>
            <p>Working together with leading institutions to drive Rwanda's industrial development.</p>
        </div>
        <div class="partners-grid">
            <div class="partner-logo">
                <img src="<?= base_url('assets/images/partners/GIZ_Rwanda.png') ?>" alt="GIZ Rwanda">
            </div>
            <div class="partner-logo">
                <img src="<?= base_url('assets/images/partners/KOICA.png') ?>" alt="KOICA">
            </div>
            <div class="partner-logo">
                <img src="<?= base_url('assets/images/partners/MINICOM_Logo.jpg') ?>" alt="MINICOM">
            </div>
            <div class="partner-logo">
                <img src="<?= base_url('assets/images/partners/NCST.png') ?>" alt="NCST">
            </div>
            <div class="partner-logo">
                <img src="<?= base_url('assets/images/partners/UNIDO.png') ?>" alt="UNIDO">
            </div>
            <div class="partner-logo">
                <img src="<?= base_url('assets/images/partners/BRD.jpg') ?>" alt="BRD">
            </div>
        </div>
    </div>
</section>
-->
<!-- ========== AUDIENCES ========== -->
<section class="section section-alt">
    <div class="container">
        <div class="section-header">
            <div class="eyebrow">Audience</div>
            <h2>One platform, three perspectives</h2>
            <p>Each stakeholder sees the intelligence they need — from discovery to decision.</p>
        </div>
        <div class="audience-grid">
            <div class="audience-card">
                <div class="tag">Enterprise</div>
                <h3>Get discovered, get ranked</h3>
                <p>Build your profile and let the AI ranking and investment matches do the introducing.</p>
                <ul>
                    <li>Track your growth and innovation score</li>
                    <li>Receive investor match recommendations</li>
                    <li>Request support from NIRDA experts</li>
                    <li>View investment opportunities</li>
                </ul>
            </div>
            <div class="audience-card">
                <div class="tag">Investor</div>
                <h3>Find fit, not just leads</h3>
                <p>Filter by sector, geography, and sustainability — see match scores before the meeting.</p>
                <ul>
                    <li>AI-recommended enterprises</li>
                    <li>Track deals in progress</li>
                    <li>Portfolio view by sector and stage</li>
                    <li>Save and compare opportunities</li>
                </ul>
            </div>
            <div class="audience-card">
                <div class="tag">Government · NIRDA</div>
                <h3>See the whole industrial base</h3>
                <p>Live, data-backed intelligence for policy decisions and industrial development.</p>
                <ul>
                    <li>National GIS view by sector</li>
                    <li>Matchmaking and engagement statistics</li>
                    <li>Enterprise verification tools</li>
                    <li>Policy intelligence reports</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- ========== CTA ========== -->
<section class="section">
    <div class="container">
        <div class="cta-block">
            <div>
                <h2>Ready to transform industrial intelligence?</h2>
                <p>Join the platform and get your AI ranking and investor matches within minutes.</p>
            </div>
            <a href="<?= base_url('register') ?>" class="btn-cta">
                <i class="fas fa-arrow-right"></i> Register now
            </a>
        </div>
    </div>
</section>
<?= $this->endSection() ?>