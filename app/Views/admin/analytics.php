<?= $this->extend('layouts/admin') ?>

<?= $this->section('styles') ?>
.analytics-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.5rem;
}
.analytics-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 1.5rem;
}
.analytics-card h3 {
    font-size: 0.95rem;
    font-weight: 700;
    margin-bottom: 1rem;
}
.analytics-card .chart-placeholder {
    height: 200px;
    display: flex;
    align-items: flex-end;
    gap: 0.5rem;
    padding: 1rem 0;
}
.chart-bar {
    flex: 1;
    background: var(--primary);
    border-radius: 4px 4px 0 0;
    min-height: 20px;
    transition: var(--transition);
    position: relative;
}
.chart-bar:hover {
    opacity: 0.8;
    transform: scaleY(1.02);
}
.chart-bar .bar-label {
    position: absolute;
    bottom: -20px;
    left: 50%;
    transform: translateX(-50%);
    font-size: 0.6rem;
    color: var(--ink-muted);
    white-space: nowrap;
}
@media (max-width: 768px) {
    .analytics-grid {
        grid-template-columns: 1fr;
    }
}
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="analytics-grid">
    <div class="analytics-card">
        <h3><i class="fas fa-chart-pie" style="color:var(--primary);margin-right:0.5rem;"></i> Sector Distribution</h3>
        <div class="chart-placeholder">
            <?php 
            $maxCount = 0;
            foreach ($sector_distribution as $sector) {
                if ($sector['count'] > $maxCount) $maxCount = $sector['count'];
            }
            if ($maxCount == 0) $maxCount = 1;
            ?>
            <?php foreach ($sector_distribution as $sector): ?>
                <?php 
                $height = ($sector['count'] / $maxCount) * 150;
                $colors = ['#078ece', '#045a86', '#22a67e', '#f5a623', '#c62828', '#6a1b9a', '#2e7d32', '#e65100'];
                $colorIndex = array_search($sector['sector'], array_column($sector_distribution, 'sector')) % count($colors);
                ?>
                <div style="flex:1;display:flex;flex-direction:column;align-items:center;height:100%;justify-content:flex-end;">
                    <div class="chart-bar" style="height:<?= max($height, 20) ?>px;background:<?= $colors[$colorIndex] ?>;width:100%;max-width:40px;">
                        <span class="bar-label"><?= esc(substr($sector['sector'] ?? 'Other', 0, 6)) ?></span>
                    </div>
                    <span style="font-size:0.6rem;font-weight:600;color:var(--ink);margin-top:0.25rem;"><?= $sector['count'] ?></span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="analytics-card">
        <h3><i class="fas fa-chart-line" style="color:var(--primary);margin-right:0.5rem;"></i> Monthly Registrations</h3>
        <div class="chart-placeholder">
            <?php 
            $maxCount = 0;
            foreach ($monthly_registrations as $month) {
                if ($month['count'] > $maxCount) $maxCount = $month['count'];
            }
            if ($maxCount == 0) $maxCount = 1;
            ?>
            <?php foreach (array_reverse($monthly_registrations) as $month): ?>
                <?php 
                $height = ($month['count'] / $maxCount) * 150;
                ?>
                <div style="flex:1;display:flex;flex-direction:column;align-items:center;height:100%;justify-content:flex-end;">
                    <div class="chart-bar" style="height:<?= max($height, 20) ?>px;background:var(--primary);width:100%;max-width:40px;">
                        <span class="bar-label"><?= date('M', strtotime($month['month'] . '-01')) ?></span>
                    </div>
                    <span style="font-size:0.6rem;font-weight:600;color:var(--ink);margin-top:0.25rem;"><?= $month['count'] ?></span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?= $this->endSection() ?>