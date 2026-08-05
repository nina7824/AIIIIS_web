<?= $this->extend('layouts/admin') ?>

<?= $this->section('styles') ?>
.match-detail-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 1.5rem;
    margin-bottom: 1.5rem;
}
.match-detail-card h3 {
    font-size: 0.95rem;
    font-weight: 700;
    margin-bottom: 1rem;
    padding-bottom: 0.5rem;
    border-bottom: 1px solid var(--border);
}
.match-detail-row {
    display: flex;
    padding: 0.4rem 0;
    border-bottom: 1px solid var(--border);
}
.match-detail-row:last-child {
    border-bottom: none;
}
.match-detail-row .label {
    width: 150px;
    font-weight: 600;
    color: var(--ink-muted);
    font-size: 0.82rem;
    flex-shrink: 0;
}
.match-detail-row .value {
    flex: 1;
    font-size: 0.82rem;
    color: var(--ink);
}
.match-score-large {
    font-size: 2.5rem;
    font-weight: 900;
    text-align: center;
    padding: 1rem;
}
.match-score-large.high { color: #22a67e; }
.match-score-large.medium { color: #f5a623; }
.match-score-large.low { color: #c62828; }

.status-update-form {
    display: flex;
    gap: 1rem;
    align-items: center;
    flex-wrap: wrap;
}
.status-update-form select {
    padding: 0.4rem 1rem;
    border: 1px solid var(--border);
    border-radius: var(--radius);
    font-size: 0.82rem;
    font-family: 'Inter', sans-serif;
}
.status-update-form textarea {
    flex: 1;
    min-width: 200px;
    padding: 0.4rem 0.75rem;
    border: 1px solid var(--border);
    border-radius: var(--radius);
    font-size: 0.82rem;
    font-family: 'Inter', sans-serif;
    resize: vertical;
}
.status-update-form button {
    padding: 0.4rem 1.5rem;
    background: var(--primary);
    color: #fff;
    border: none;
    border-radius: var(--radius);
    font-weight: 600;
    cursor: pointer;
    transition: var(--transition);
}
.status-update-form button:hover {
    background: var(--primary-dark);
}

@media (max-width: 768px) {
    .match-detail-row {
        flex-direction: column;
        padding: 0.6rem 0;
    }
    .match-detail-row .label {
        width: 100%;
        margin-bottom: 0.2rem;
    }
    .status-update-form {
        flex-direction: column;
        align-items: stretch;
    }
}
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="match-detail-card">
    <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:0.5rem;margin-bottom:0.5rem;">
        <h2 style="font-size:1.1rem;font-weight:700;">Match #<?= $match['match_id'] ?></h2>
        <span class="status-badge status-<?= $match['status'] ?? 'pending' ?>" style="font-size:0.8rem;padding:0.3rem 1rem;">
            <?= ucfirst($match['status'] ?? 'Pending') ?>
        </span>
    </div>
    
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem;margin-top:1rem;">
        <div>
            <h3 style="font-size:0.9rem;font-weight:700;color:var(--primary);margin-bottom:0.5rem;">
                <i class="fas fa-building"></i> Enterprise
            </h3>
            <div class="match-detail-row">
                <span class="label">Name</span>
                <span class="value"><strong><?= esc($match['enterprise_name'] ?? 'N/A') ?></strong></span>
            </div>
            <div class="match-detail-row">
                <span class="label">Sector</span>
                <span class="value"><?= esc($match['sector'] ?? 'N/A') ?></span>
            </div>
            <div class="match-detail-row">
                <span class="label">Location</span>
                <span class="value"><?= esc($match['location'] ?? 'N/A') ?></span>
            </div>
        </div>
        
        <div>
            <h3 style="font-size:0.9rem;font-weight:700;color:var(--primary);margin-bottom:0.5rem;">
                <i class="fas fa-user-tie"></i> Investor
            </h3>
            <div class="match-detail-row">
                <span class="label">Name</span>
                <span class="value"><strong><?= esc($match['investor_name'] ?? 'N/A') ?></strong></span>
            </div>
            <div class="match-detail-row">
                <span class="label">Type</span>
                <span class="value"><?= ucfirst(str_replace('_', ' ', $match['investor_type'] ?? 'N/A')) ?></span>
            </div>
            <div class="match-detail-row">
                <span class="label">Investment Sector</span>
                <span class="value"><?= esc($match['investment_sector'] ?? 'N/A') ?></span>
            </div>
        </div>
    </div>
</div>

<div class="match-detail-card" style="text-align:center;">
    <h3>Match Score Breakdown</h3>
    <?php 
    $score = $match['match_score'] ?? 0;
    $class = $score >= 80 ? 'high' : ($score >= 60 ? 'medium' : 'low');
    ?>
    <div class="match-score-large <?= $class ?>"><?= $score ?>%</div>
    <div style="display:grid;grid-template-columns:repeat(5,1fr);gap:0.5rem;margin-top:0.5rem;">
        <div>
            <div style="font-size:0.7rem;color:var(--ink-muted);">Sector</div>
            <div style="font-weight:700;font-size:1rem;"><?= $match['sector_match'] ?? 0 ?>%</div>
        </div>
        <div>
            <div style="font-size:0.7rem;color:var(--ink-muted);">Investment</div>
            <div style="font-weight:700;font-size:1rem;"><?= $match['investment_match'] ?? 0 ?>%</div>
        </div>
        <div>
            <div style="font-size:0.7rem;color:var(--ink-muted);">Technology</div>
            <div style="font-weight:700;font-size:1rem;"><?= $match['technology_match'] ?? 0 ?>%</div>
        </div>
        <div>
            <div style="font-size:0.7rem;color:var(--ink-muted);">Growth</div>
            <div style="font-weight:700;font-size:1rem;"><?= $match['growth_match'] ?? 0 ?>%</div>
        </div>
        <div>
            <div style="font-size:0.7rem;color:var(--ink-muted);">Sustainability</div>
            <div style="font-weight:700;font-size:1rem;"><?= $match['sustainability_match'] ?? 0 ?>%</div>
        </div>
    </div>
</div>

<div class="match-detail-card">
    <h3>Update Match Status</h3>
    <form action="<?= base_url('admin/matches/update/' . $match['match_id']) ?>" method="post" class="status-update-form">
        <?= csrf_field() ?>
        <select name="status" required>
            <option value="pending" <?= ($match['status'] ?? '') == 'pending' ? 'selected' : '' ?>>Pending</option>
            <option value="accepted" <?= ($match['status'] ?? '') == 'accepted' ? 'selected' : '' ?>>Accepted</option>
            <option value="rejected" <?= ($match['status'] ?? '') == 'rejected' ? 'selected' : '' ?>>Rejected</option>
            <option value="introduced" <?= ($match['status'] ?? '') == 'introduced' ? 'selected' : '' ?>>Introduced</option>
            <option value="negotiating" <?= ($match['status'] ?? '') == 'negotiating' ? 'selected' : '' ?>>Negotiating</option>
            <option value="closed" <?= ($match['status'] ?? '') == 'closed' ? 'selected' : '' ?>>Closed</option>
        </select>
        <textarea name="notes" placeholder="Add notes about this match..."><?= esc($match['notes'] ?? '') ?></textarea>
        <button type="submit">Update Status</button>
    </form>
</div>

<div style="margin-top:1rem;">
    <a href="<?= base_url('admin/matches') ?>" style="color:var(--primary);font-weight:600;">← Back to Matches</a>
</div>

<?= $this->endSection() ?>