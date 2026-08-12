<?= $this->extend('layouts/admin') ?>

<?= $this->section('styles') ?>
.search-container {
    max-width: 1400px;
    margin: 0 auto;
}
.search-filters {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 1.5rem;
    margin-bottom: 1.5rem;
}
.search-filters .filter-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
    margin-bottom: 1rem;
}
.search-filters .filter-row:last-child {
    margin-bottom: 0;
}
.search-filters .filter-group label {
    display: block;
    font-size: 0.7rem;
    font-weight: 600;
    color: var(--ink-muted);
    margin-bottom: 0.2rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}
.search-filters .filter-group input,
.search-filters .filter-group select {
    width: 100%;
    padding: 0.4rem 0.75rem;
    border: 1px solid var(--border);
    border-radius: var(--radius);
    font-size: 0.82rem;
    font-family: 'Inter', sans-serif;
    background: var(--surface);
    color: var(--ink);
    transition: var(--transition);
}
.search-filters .filter-group input:focus,
.search-filters .filter-group select:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(7, 142, 206, 0.1);
}
.search-filters .filter-group .checkbox-group {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding-top: 0.3rem;
}
.search-filters .filter-group .checkbox-group input[type="checkbox"] {
    width: 18px;
    height: 18px;
    accent-color: var(--primary);
    cursor: pointer;
}
.search-filters .filter-group .checkbox-group label {
    text-transform: none;
    font-size: 0.82rem;
    color: var(--ink);
    margin-bottom: 0;
    cursor: pointer;
}
.filter-actions {
    display: flex;
    gap: 0.75rem;
    align-items: center;
    flex-wrap: wrap;
    padding-top: 1rem;
    border-top: 1px solid var(--border);
}
.btn-search {
    padding: 0.5rem 2rem;
    background: var(--primary);
    color: #fff;
    border: none;
    border-radius: var(--radius);
    font-weight: 600;
    cursor: pointer;
    transition: var(--transition);
    font-size: 0.85rem;
}
.btn-search:hover {
    background: var(--primary-dark);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(7, 142, 206, 0.3);
}
.btn-clear {
    padding: 0.5rem 1.5rem;
    background: var(--canvas);
    color: var(--ink);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    font-weight: 600;
    cursor: pointer;
    transition: var(--transition);
    font-size: 0.85rem;
    text-decoration: none;
}
.btn-clear:hover {
    background: var(--border);
}
.results-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 1rem;
    margin-bottom: 1rem;
}
.results-count {
    font-size: 0.85rem;
    color: var(--ink-muted);
}
.results-count strong {
    color: var(--ink);
}
.sort-dropdown {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}
.sort-dropdown label {
    font-size: 0.78rem;
    color: var(--ink-muted);
}
.sort-dropdown select {
    padding: 0.3rem 0.75rem;
    border: 1px solid var(--border);
    border-radius: var(--radius);
    font-size: 0.78rem;
    font-family: 'Inter', sans-serif;
    background: var(--surface);
    color: var(--ink);
    cursor: pointer;
}
.enterprise-result {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 1.25rem;
    margin-bottom: 1rem;
    transition: all 0.3s ease;
}
.enterprise-result:hover {
    border-color: var(--primary);
    box-shadow: var(--shadow-sm);
}
.enterprise-result .header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    flex-wrap: wrap;
    gap: 0.5rem;
}
.enterprise-result .name {
    font-weight: 700;
    font-size: 1.05rem;
    color: var(--ink);
}
.enterprise-result .sector {
    font-size: 0.8rem;
    color: var(--ink-muted);
}
.enterprise-result .location {
    font-size: 0.8rem;
    color: var(--ink-muted);
}
.enterprise-result .badge-women {
    display: inline-block;
    background: #e8f5e9;
    color: #2e7d32;
    padding: 0.1rem 0.5rem;
    border-radius: 20px;
    font-size: 0.6rem;
    font-weight: 600;
    margin-left: 0.5rem;
}
.enterprise-result .score {
    font-size: 1.2rem;
    font-weight: 800;
    color: var(--primary);
    text-align: center;
}
.enterprise-result .score-label {
    font-size: 0.6rem;
    color: var(--ink-muted);
    text-transform: uppercase;
    letter-spacing: 0.05em;
}
.enterprise-result .details {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 0.5rem;
    margin-top: 0.75rem;
    padding-top: 0.75rem;
    border-top: 1px solid var(--border);
}
.enterprise-result .detail-item {
    text-align: center;
}
.enterprise-result .detail-item .value {
    font-weight: 700;
    font-size: 0.9rem;
    color: var(--ink);
}
.enterprise-result .detail-item .label {
    font-size: 0.55rem;
    color: var(--ink-muted);
    text-transform: uppercase;
    letter-spacing: 0.05em;
}
.enterprise-result .actions {
    display: flex;
    gap: 0.5rem;
    margin-top: 0.75rem;
    padding-top: 0.75rem;
    border-top: 1px solid var(--border);
}
.enterprise-result .actions .btn-connect {
    padding: 0.3rem 1rem;
    background: var(--primary);
    color: #fff;
    border: none;
    border-radius: var(--radius);
    font-weight: 600;
    font-size: 0.78rem;
    cursor: pointer;
    transition: var(--transition);
}
.enterprise-result .actions .btn-connect:hover {
    background: var(--primary-dark);
}
.enterprise-result .actions .btn-save {
    padding: 0.3rem 1rem;
    background: var(--canvas);
    color: var(--ink);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    font-weight: 600;
    font-size: 0.78rem;
    cursor: pointer;
    transition: var(--transition);
}
.enterprise-result .actions .btn-save:hover {
    border-color: var(--primary);
    color: var(--primary);
}
.enterprise-result .actions .btn-details {
    padding: 0.3rem 1rem;
    background: transparent;
    color: var(--primary);
    border: none;
    border-radius: var(--radius);
    font-weight: 600;
    font-size: 0.78rem;
    cursor: pointer;
    transition: var(--transition);
    margin-left: auto;
}
.enterprise-result .actions .btn-details:hover {
    background: var(--primary-light);
}
.no-results {
    text-align: center;
    padding: 3rem;
    color: var(--ink-muted);
}
.no-results i {
    font-size: 3rem;
    display: block;
    margin-bottom: 1rem;
    opacity: 0.3;
}
@media (max-width: 768px) {
    .search-filters .filter-row {
        grid-template-columns: 1fr;
    }
    .enterprise-result .header {
        flex-direction: column;
    }
    .enterprise-result .details {
        grid-template-columns: repeat(3, 1fr);
    }
    .enterprise-result .actions {
        flex-wrap: wrap;
    }
    .results-header {
        flex-direction: column;
        align-items: stretch;
    }
}
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="search-container">

    <!-- Search Filters -->
    <div class="search-filters">
        <form method="GET" action="<?= base_url('investor/search') ?>">
            <div class="filter-row">
                <div class="filter-group">
                    <label for="search">Search</label>
                    <input type="text" id="search" name="search" placeholder="Enterprise name, sector..." value="<?= $filters['search'] ?? '' ?>">
                </div>
                <div class="filter-group">
                    <label for="sector">Sector</label>
                    <select id="sector" name="sector">
                        <option value="">All Sectors</option>
                        <?php foreach ($sectors as $s): ?>
                            <option value="<?= $s['sector'] ?>" <?= ($filters['sector'] ?? '') == $s['sector'] ? 'selected' : '' ?>>
                                <?= $s['sector'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="location">Location</label>
                    <select id="location" name="location">
                        <option value="">All Locations</option>
                        <?php foreach ($locations as $l): ?>
                            <option value="<?= $l['location'] ?>" <?= ($filters['location'] ?? '') == $l['location'] ? 'selected' : '' ?>>
                                <?= $l['location'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="filter-row">
                <div class="filter-group">
                    <label for="min_score">Min. Enterprise Ranking</label>
                    <select id="min_score" name="min_score">
                        <option value="">Any Score</option>
                        <option value="90" <?= ($filters['min_score'] ?? '') == '90' ? 'selected' : '' ?>>90%+ (Excellent)</option>
                        <option value="80" <?= ($filters['min_score'] ?? '') == '80' ? 'selected' : '' ?>>80%+ (Very Good)</option>
                        <option value="70" <?= ($filters['min_score'] ?? '') == '70' ? 'selected' : '' ?>>70%+ (Good)</option>
                        <option value="60" <?= ($filters['min_score'] ?? '') == '60' ? 'selected' : '' ?>>60%+ (Average)</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="min_growth">Min. Growth Potential</label>
                    <select id="min_growth" name="min_growth">
                        <option value="">Any</option>
                        <option value="80" <?= ($filters['min_growth'] ?? '') == '80' ? 'selected' : '' ?>>80%+</option>
                        <option value="70" <?= ($filters['min_growth'] ?? '') == '70' ? 'selected' : '' ?>>70%+</option>
                        <option value="60" <?= ($filters['min_growth'] ?? '') == '60' ? 'selected' : '' ?>>60%+</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="min_innovation">Min. Innovation Capacity</label>
                    <select id="min_innovation" name="min_innovation">
                        <option value="">Any</option>
                        <option value="80" <?= ($filters['min_innovation'] ?? '') == '80' ? 'selected' : '' ?>>80%+</option>
                        <option value="70" <?= ($filters['min_innovation'] ?? '') == '70' ? 'selected' : '' ?>>70%+</option>
                        <option value="60" <?= ($filters['min_innovation'] ?? '') == '60' ? 'selected' : '' ?>>60%+</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="min_sustainability">Min. Sustainability</label>
                    <select id="min_sustainability" name="min_sustainability">
                        <option value="">Any</option>
                        <option value="80" <?= ($filters['min_sustainability'] ?? '') == '80' ? 'selected' : '' ?>>80%+</option>
                        <option value="70" <?= ($filters['min_sustainability'] ?? '') == '70' ? 'selected' : '' ?>>70%+</option>
                        <option value="60" <?= ($filters['min_sustainability'] ?? '') == '60' ? 'selected' : '' ?>>60%+</option>
                    </select>
                </div>
            </div>

            <div class="filter-row">
                <div class="filter-group">
                    <label>Women-Owned Enterprise</label>
                    <div class="checkbox-group">
                        <input type="checkbox" id="women_owned" name="women_owned" value="1" <?= ($filters['women_owned'] ?? '') ? 'checked' : '' ?>>
                        <label for="women_owned">Show only women-owned enterprises</label>
                    </div>
                </div>
                <div class="filter-group">
                    <label for="sort_by">Sort By</label>
                    <select id="sort_by" name="sort_by">
                        <option value="ranking" <?= ($filters['sort_by'] ?? '') == 'ranking' ? 'selected' : '' ?>>AI Ranking</option>
                        <option value="growth" <?= ($filters['sort_by'] ?? '') == 'growth' ? 'selected' : '' ?>>Growth Potential</option>
                        <option value="innovation" <?= ($filters['sort_by'] ?? '') == 'innovation' ? 'selected' : '' ?>>Innovation</option>
                        <option value="sustainability" <?= ($filters['sort_by'] ?? '') == 'sustainability' ? 'selected' : '' ?>>Sustainability</option>
                        <option value="employees" <?= ($filters['sort_by'] ?? '') == 'employees' ? 'selected' : '' ?>>Employees</option>
                        <option value="revenue" <?= ($filters['sort_by'] ?? '') == 'revenue' ? 'selected' : '' ?>>Revenue</option>
                        <option value="name" <?= ($filters['sort_by'] ?? '') == 'name' ? 'selected' : '' ?>>Name (A-Z)</option>
                    </select>
                </div>
            </div>

            <div class="filter-actions">
                <button type="submit" class="btn-search">
                    <i class="fas fa-search"></i> Search
                </button>
                <a href="<?= base_url('investor/search') ?>" class="btn-clear">
                    <i class="fas fa-times"></i> Clear All
                </a>
                <span style="font-size:0.8rem;color:var(--ink-muted);margin-left:auto;">
                    <?= count($enterprises) ?> enterprises found
                </span>
            </div>
        </form>
    </div>

    <!-- Results Header -->
    <div class="results-header">
        <div class="results-count">
            <strong><?= count($enterprises) ?></strong> enterprises found
            <?php if ($filters['women_owned'] ?? false): ?>
                <span class="badge-women" style="display:inline-block;background:#e8f5e9;color:#2e7d32;padding:0.1rem 0.5rem;border-radius:20px;font-size:0.65rem;font-weight:600;margin-left:0.5rem;">
                    <i class="fas fa-female"></i> Women-Owned
                </span>
            <?php endif; ?>
        </div>
    </div>

    <!-- Results -->
    <?php if (!empty($enterprises)): ?>
        <?php foreach ($enterprises as $enterprise): ?>
            <div class="enterprise-result">
                <div class="header">
                    <div>
                        <div class="name">
                            <?= esc($enterprise['name'] ?? 'N/A') ?>
                            <?php if ($enterprise['is_women_owned'] ?? false): ?>
                                <span class="badge-women"><i class="fas fa-female"></i> Women-Owned</span>
                            <?php endif; ?>
                        </div>
                        <div class="sector"><i class="fas fa-industry"></i> <?= esc($enterprise['sector'] ?? 'N/A') ?></div>
                        <div class="location"><i class="fas fa-map-marker-alt"></i> <?= esc($enterprise['location'] ?? 'N/A') ?></div>
                        <?php if ($enterprise['investment_requirements']): ?>
                            <div style="font-size:0.8rem;color:var(--primary);margin-top:0.25rem;">
                                <i class="fas fa-info-circle"></i> <?= esc(substr($enterprise['investment_requirements'], 0, 100)) ?>...
                            </div>
                        <?php endif; ?>
                    </div>
                    <div style="text-align:center;">
                        <div class="score"><?= $enterprise['total_score'] ?? 0 ?>%</div>
                        <div class="score-label">AI Ranking</div>
                        <?php if ($enterprise['rank_position']): ?>
                            <div style="font-size:0.7rem;color:var(--ink-muted);">#<?= $enterprise['rank_position'] ?> overall</div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="details">
                    <div class="detail-item">
                        <div class="value"><?= $enterprise['growth_score'] ?? 0 ?>%</div>
                        <div class="label">Growth</div>
                    </div>
                    <div class="detail-item">
                        <div class="value"><?= $enterprise['innovation_score'] ?? 0 ?>%</div>
                        <div class="label">Innovation</div>
                    </div>
                    <div class="detail-item">
                        <div class="value"><?= $enterprise['technology_score'] ?? 0 ?>%</div>
                        <div class="label">Technology</div>
                    </div>
                    <div class="detail-item">
                        <div class="value"><?= $enterprise['sustainability_score'] ?? 0 ?>%</div>
                        <div class="label">Sustainability</div>
                    </div>
                    <div class="detail-item">
                        <div class="value"><?= $enterprise['investment_potential_score'] ?? 0 ?>%</div>
                        <div class="label">Investment Potential</div>
                    </div>
                </div>

                <div class="actions">
                    <button class="btn-connect" onclick="alert('Connect with <?= $enterprise['name'] ?>')">
                        <i class="fas fa-handshake"></i> Connect
                    </button>
                    <button class="btn-save" onclick="saveEnterprise(<?= $enterprise['enterprise_id'] ?>, this)">
                        <i class="fas fa-bookmark"></i> Save
                    </button>
                    <button class="btn-details" onclick="alert('View details for <?= $enterprise['name'] ?>')">
                        View Details <i class="fas fa-arrow-right" style="margin-left:0.3rem;"></i>
                    </button>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="no-results">
            <i class="fas fa-search"></i>
            <h3>No enterprises found</h3>
            <p>Try adjusting your search filters or criteria.</p>
            <a href="<?= base_url('investor/search') ?>" class="btn-search" style="display:inline-block;margin-top:1rem;">
                <i class="fas fa-times"></i> Clear Filters
            </a>
        </div>
    <?php endif; ?>

</div>

<script>
function saveEnterprise(enterpriseId, button) {
    fetch('<?= base_url('investor/save-enterprise') ?>', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: 'enterprise_id=' + enterpriseId
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            if (data.action === 'saved') {
                button.innerHTML = '<i class="fas fa-bookmark"></i> Saved';
                button.style.background = '#22a67e';
                button.style.color = '#fff';
            } else {
                button.innerHTML = '<i class="fas fa-bookmark"></i> Save';
                button.style.background = 'var(--canvas)';
                button.style.color = 'var(--ink)';
            }
            alert(data.message);
        }
    })
    .catch(error => console.error('Error:', error));
}

// Auto-submit on checkbox change
document.getElementById('women_owned')?.addEventListener('change', function() {
    this.closest('form').submit();
});

// Auto-submit on sort change
document.getElementById('sort_by')?.addEventListener('change', function() {
    this.closest('form').submit();
});
</script>

<?= $this->endSection() ?>