<?= $this->extend('layouts/main') ?>

<?= $this->section('styles') ?>
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
.page-header {
    padding: 2rem 0;
    border-bottom: 1px solid var(--border);
}
.page-header h1 {
    font-size: 1.8rem;
    font-weight: 800;
}
.page-header p {
    color: var(--ink-muted);
    font-size: 0.95rem;
}
.content-placeholder {
    padding: 4rem 0;
    text-align: center;
    color: var(--ink-muted);
}
.content-placeholder i {
    font-size: 3rem;
    color: var(--primary-light);
    margin-bottom: 1rem;
    display: block;
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
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="enterprise-nav">
    <div class="container">
        <div class="nav-items">
            <a href="<?= base_url('enterprises') ?>">Overview</a>
            <a href="<?= base_url('enterprises/directory') ?>">Enterprise Directory</a>
            <a href="<?= base_url('enterprises/verification') ?>">Verification Queue</a>
            <a href="<?= base_url('enterprises/gis') ?>">GIS Map View</a>
            <a href="<?= base_url('enterprises/clusters') ?>" class="active">Sector Clusters</a>
            <a href="<?= base_url('enterprises/ranking') ?>">Enterprise Ranking</a>
        </div>
    </div>
</section>

<section class="page-header">
    <div class="container">
        <h1>Sector Clusters</h1>
        <p>View and analyze industrial sector clusters across Rwanda.</p>
    </div>
</section>

<section class="content-placeholder">
    <div class="container">
        <i class="fas fa-chart-pie"></i>
        <h3>Sector Clusters Coming Soon</h3>
        <p>This feature is currently under development. Check back soon for detailed sector cluster analysis and visualization.</p>
    </div>
</section>
<?= $this->endSection() ?>