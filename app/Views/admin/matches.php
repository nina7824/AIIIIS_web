<?= $this->extend('layouts/admin') ?>

<?= $this->section('styles') ?>
/* Matches page custom styles */
.match-score {
    font-weight: 700;
    font-size: 0.9rem;
}
.match-score.high { color: #22a67e; }
.match-score.medium { color: #f5a623; }
.match-score.low { color: #c62828; }

.status-badge {
    display: inline-block;
    padding: 0.15rem 0.7rem;
    border-radius: 20px;
    font-size: 0.65rem;
    font-weight: 600;
}
.status-pending { background: #fff3cd; color: #856404; }
.status-accepted { background: #e6f7ef; color: #22a67e; }
.status-rejected { background: #fde8e8; color: #c62828; }
.status-introduced { background: #e3f2fd; color: #0d47a1; }
.status-negotiating { background: #f3e5f5; color: #6a1b9a; }
.status-closed { background: #e8eaf6; color: #283593; }

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

.filter-bar {
    display: flex;
    gap: 0.75rem;
    flex-wrap: wrap;
    margin-bottom: 1rem;
    align-items: center;
}
.filter-bar select,
.filter-bar input {
    padding: 0.3rem 0.75rem;
    border: 1px solid var(--border);
    border-radius: var(--radius);
    font-size: 0.78rem;
    font-family: 'Inter', sans-serif;
    background: var(--surface);
    color: var(--ink);
}
.filter-bar select:focus,
.filter-bar input:focus {
    outline: none;
    border-color: var(--primary);
}

@media (max-width: 768px) {
    .stats-mini-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    .filter-bar {
        flex-direction: column;
        align-items: stretch;
    }
}
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Stats Mini Grid -->
<div class="stats-mini-grid">
    <div class="stats-mini-card">
        <div class="number"><?= $stats['total'] ?? 0 ?></div>
        <div class="label">Total Matches</div>
    </div>
    <div class="stats-mini-card">
        <div class="number"><?= $stats['pending'] ?? 0 ?></div>
        <div class="label">Pending</div>
    </div>
    <div class="stats-mini-card">
        <div class="number"><?= $stats['accepted'] ?? 0 ?></div>
        <div class="label">Accepted</div>
    </div>
    <div class="stats-mini-card">
        <div class="number"><?= $stats['avg_score'] ?? 0 ?>%</div>
        <div class="label">Avg Match Score</div>
    </div>
</div>

<!-- Filter Bar -->
<div class="filter-bar">
    <select id="statusFilter" onchange="filterMatches()">
        <option value="all">All Status</option>
        <option value="pending">Pending</option>
        <option value="accepted">Accepted</option>
        <option value="rejected">Rejected</option>
        <option value="introduced">Introduced</option>
        <option value="negotiating">Negotiating</option>
        <option value="closed">Closed</option>
    </select>
    <input type="text" id="searchFilter" placeholder="Search enterprise or investor..." onkeyup="filterMatches()">
    <span style="font-size:0.7rem;color:var(--ink-muted);">Showing: <span id="matchCount"><?= count($matches) ?></span> matches</span>
</div>

<!-- Matches Table -->
<div class="table-container">
    <div class="table-header">
        <h3><i class="fas fa-handshake" style="color:var(--primary);margin-right:0.5rem;"></i> Investment Matches</h3>
        <div>
            <span style="background:var(--primary);color:#fff;padding:0.3rem 0.8rem;border-radius:var(--radius);font-size:0.7rem;font-weight:600;">
                Total: <?= count($matches) ?>
            </span>
        </div>
    </div>
    <table id="matchesTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Enterprise</th>
                <th>Investor</th>
                <th>Score</th>
                <th>Status</th>
                <th>Created</th>
                <th style="text-align:center;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($matches)): ?>
                <?php foreach ($matches as $match): ?>
                    <tr data-status="<?= $match['status'] ?? 'pending' ?>" data-search="<?= strtolower(($match['enterprise_name'] ?? '') . ' ' . ($match['investor_name'] ?? '')) ?>">
                        <td>#<?= $match['match_id'] ?></td>
                        <td>
                            <strong><?= esc($match['enterprise_name'] ?? 'N/A') ?></strong>
                            <br><span style="font-size:0.65rem;color:var(--ink-muted);"><?= esc($match['sector'] ?? '') ?></span>
                        </td>
                        <td>
                            <strong><?= esc($match['investor_name'] ?? 'N/A') ?></strong>
                            <br><span style="font-size:0.65rem;color:var(--ink-muted);"><?= ucfirst(str_replace('_', ' ', $match['investor_type'] ?? '')) ?></span>
                        </td>
                        <td>
                            <?php 
                            $score = $match['match_score'] ?? 0;
                            $class = $score >= 80 ? 'high' : ($score >= 60 ? 'medium' : 'low');
                            ?>
                            <span class="match-score <?= $class ?>">
                                <?= $score ?>%
                            </span>
                        </td>
                        <td>
                            <span class="status-badge status-<?= $match['status'] ?? 'pending' ?>">
                                <?= ucfirst($match['status'] ?? 'Pending') ?>
                            </span>
                        </td>
                        <td><?= date('M d, Y', strtotime($match['created_at'])) ?></td>
                        <td style="text-align:center;">
                            <a href="<?= base_url('admin/matches/view/' . $match['match_id']) ?>" class="btn-sm btn-primary-sm" style="display:inline-block;padding:0.2rem 0.6rem;border-radius:4px;font-size:0.7rem;font-weight:600;border:none;cursor:pointer;background:var(--primary);color:#fff;text-decoration:none;">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="<?= base_url('admin/matches/delete/' . $match['match_id']) ?>" class="btn-sm btn-danger-sm" style="display:inline-block;padding:0.2rem 0.6rem;border-radius:4px;font-size:0.7rem;font-weight:600;border:none;cursor:pointer;background:#c62828;color:#fff;text-decoration:none;" onclick="return confirm('Delete this match?')">
                                <i class="fas fa-trash"></i>
                            </a>
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
function filterMatches() {
    const status = document.getElementById('statusFilter').value;
    const search = document.getElementById('searchFilter').value.toLowerCase();
    const rows = document.querySelectorAll('#matchesTable tbody tr');
    let visibleCount = 0;
    
    rows.forEach(row => {
        const rowStatus = row.dataset.status || 'pending';
        const rowSearch = row.dataset.search || '';
        
        const statusMatch = status === 'all' || rowStatus === status;
        const searchMatch = search === '' || rowSearch.includes(search);
        
        if (statusMatch && searchMatch) {
            row.style.display = '';
            visibleCount++;
        } else {
            row.style.display = 'none';
        }
    });
    
    document.getElementById('matchCount').textContent = visibleCount;
}
</script>

<?= $this->endSection() ?>