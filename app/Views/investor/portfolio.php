<?= $this->extend('layouts/admin') ?>

<?= $this->section('styles') ?>
.portfolio-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 1.25rem;
    margin-bottom: 2rem;
}
.portfolio-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 1.25rem 1.5rem;
    text-align: center;
    transition: all 0.3s ease;
}
.portfolio-card:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
}
.portfolio-card .number {
    font-size: 1.8rem;
    font-weight: 800;
    color: var(--primary);
}
.portfolio-card .label {
    font-size: 0.72rem;
    color: var(--ink-muted);
    font-weight: 500;
}
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="portfolio-grid">
    <div class="portfolio-card">
        <div class="number"><?= $portfolio_summary['total_deals'] ?? 0 ?></div>
        <div class="label">Total Deals</div>
    </div>
    <div class="portfolio-card">
        <div class="number"><?= $portfolio_summary['completed_deals'] ?? 0 ?></div>
        <div class="label">Completed</div>
    </div>
    <div class="portfolio-card">
        <div class="number"><?= $portfolio_summary['signed_deals'] ?? 0 ?></div>
        <div class="label">Signed</div>
    </div>
    <div class="portfolio-card">
        <div class="number">$<?= number_format($portfolio_summary['total_investment'] ?? 0) ?></div>
        <div class="label">Total Investment</div>
    </div>
</div>

<?php if (!empty($portfolio_by_sector)): ?>
    <div style="background:var(--surface);border:1px solid var(--border);border-radius:var(--radius);padding:1.5rem;">
        <h3 style="font-size:1rem;font-weight:700;margin-bottom:1rem;">Portfolio by Sector</h3>
        <div style="display:grid;grid-template-columns:repeat(auto-fill, minmax(200px, 1fr));gap:1rem;">
            <?php foreach ($portfolio_by_sector as $sector): ?>
                <div style="background:var(--canvas);padding:1rem;border-radius:var(--radius);text-align:center;border-left:3px solid var(--primary);">
                    <div style="font-weight:700;"><?= esc($sector['sector'] ?? 'Other') ?></div>
                    <div style="font-size:0.8rem;color:var(--ink-muted);"><?= $sector['count'] ?> deals</div>
                    <div style="font-weight:700;color:var(--primary);">$<?= number_format($sector['total'] ?? 0) ?></div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php else: ?>
    <div style="text-align:center;padding:2rem;color:var(--ink-muted);">
        <i class="fas fa-chart-pie" style="font-size:2rem;display:block;margin-bottom:0.5rem;opacity:0.3;"></i>
        No portfolio data available
    </div>
<?php endif; ?>

<?= $this->endSection() ?>