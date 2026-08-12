<?= $this->extend('layouts/admin') ?>

<?= $this->section('styles') ?>
.match-score {
    font-weight: 700;
    font-size: 0.9rem;
}
.match-score.high { color: #22a67e; }
.match-score.medium { color: #f5a623; }
.match-score.low { color: #c62828; }
.badge-status {
    display: inline-block;
    padding: 0.1rem 0.6rem;
    border-radius: 20px;
    font-size: 0.6rem;
    font-weight: 600;
}
.badge-pending { background: #fff3cd; color: #856404; }
.badge-accepted { background: #e6f7ef; color: #22a67e; }
.badge-rejected { background: #fde8e8; color: #c62828; }
.badge-introduced { background: #e3f2fd; color: #0d47a1; }
.badge-negotiating { background: #f3e5f5; color: #6a1b9a; }
.badge-closed { background: #e8eaf6; color: #283593; }
.stats-mini-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 1rem;
    margin-bottom: 1.5rem;
}
.stats-mini-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 0.75rem 1rem;
    text-align: center;
}
.stats-mini-card .number {
    font-size: 1.2rem;
    font-weight: 800;
    color: var(--ink);
}
.stats-mini-card .label {
    font-size: 0.6rem;
    color: var(--ink-muted);
    text-transform: uppercase;
    letter-spacing: 0.05em;
}
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="stats-mini-grid">
    <div class="stats-mini-card">
        <div class="number"><?= count($matches) ?></div>
        <div class="label">Total Matches</div>
    </div>
    <div class="stats-mini-card">
        <div class="number">
            <?php 
            $accepted = array_filter($matches, function($m) { return ($m['status'] ?? '') == 'accepted'; });
            echo count($accepted);
            ?>
        </div>
        <div class="label">Accepted</div>
    </div>
    <div class="stats-mini-card">
        <div class="number">
            <?php 
            $pending = array_filter($matches, function($m) { return ($m['status'] ?? '') == 'pending'; });
            echo count($pending);
            ?>
        </div>
        <div class="label">Pending</div>
    </div>
    <div class="stats-mini-card">
        <div class="number">
            <?php 
            $introduced = array_filter($matches, function($m) { return ($m['status'] ?? '') == 'introduced'; });
            echo count($introduced);
            ?>
        </div>
        <div class="label">Introduced</div>
    </div>
</div>

<div class="table-container">
    <div class="table-header">
        <h3><i class="fas fa-handshake" style="color:var(--primary);margin-right:0.5rem;"></i> My Matches</h3>
        <span style="background:var(--primary);color:#fff;padding:0.3rem 0.8rem;border-radius:var(--radius);font-size:0.7rem;font-weight:600;">
            Total: <?= count($matches) ?>
        </span>
    </div>
    <table>
        <thead>
            <tr>
                <th>Enterprise</th>
                <th>Sector</th>
                <th>Location</th>
                <th>Score</th>
                <th>Status</th>
                <th>Date</th>
                <th style="text-align:center;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($matches)): ?>
                <?php foreach ($matches as $match): ?>
                    <tr>
                        <td><strong><?= esc($match['enterprise_name'] ?? 'N/A') ?></strong></td>
                        <td><?= esc($match['sector'] ?? 'N/A') ?></td>
                        <td><?= esc($match['location'] ?? 'N/A') ?></td>
                        <td>
                            <span class="match-score <?= ($match['match_score'] ?? 0) >= 80 ? 'high' : (($match['match_score'] ?? 0) >= 60 ? 'medium' : 'low') ?>">
                                <?= $match['match_score'] ?? 0 ?>%
                            </span>
                        </td>
                        <td>
                            <span class="badge-status badge-<?= $match['status'] ?? 'pending' ?>">
                                <?= ucfirst($match['status'] ?? 'Pending') ?>
                            </span>
                        </td>
                        <td><?= date('M d, Y', strtotime($match['created_at'])) ?></td>
                        <td style="text-align:center;">
                            <button class="btn-sm btn-primary-sm" onclick="alert('View match details for <?= $match['enterprise_name'] ?>')">
                                <i class="fas fa-eye"></i>
                            </button>
                            <?php if (($match['status'] ?? '') == 'pending'): ?>
                                <button class="btn-sm btn-primary-sm" onclick="requestIntroduction(<?= $match['match_id'] ?>, this)">
                                    <i class="fas fa-user-plus"></i>
                                </button>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="7" style="text-align:center;padding:2rem;color:var(--ink-muted);">No matches found</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script>
function requestIntroduction(matchId, button) {
    if (!confirm('Request introduction with this enterprise?')) return;
    
    fetch('<?= base_url('investor/request-introduction') ?>', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: 'match_id=' + matchId
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Introduction request sent successfully!');
            location.reload();
        } else {
            alert(data.message || 'Error requesting introduction');
        }
    })
    .catch(error => console.error('Error:', error));
}
</script>

<?= $this->endSection() ?>