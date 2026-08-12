<?= $this->extend('layouts/admin') ?>

<?= $this->section('styles') ?>
.dataTables_wrapper {
    padding: 0.5rem 0;
}
.dataTables_filter input {
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 0.3rem 0.75rem;
    margin-left: 0.5rem;
}
.dataTables_length select {
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 0.3rem 0.5rem;
}
.dataTables_info {
    font-size: 0.82rem;
    color: var(--ink-muted);
    padding-top: 0.75rem;
}
.dataTables_paginate {
    padding-top: 0.75rem;
}
.dataTables_paginate a {
    padding: 0.25rem 0.6rem;
    border: 1px solid var(--border);
    border-radius: var(--radius);
    margin: 0 0.1rem;
    color: var(--ink);
    text-decoration: none;
    font-size: 0.8rem;
}
.dataTables_paginate a.current {
    background: var(--primary);
    color: #fff;
    border-color: var(--primary);
}
.dataTables_paginate a:hover {
    background: var(--canvas);
}
.filter-bar {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
    margin-bottom: 1rem;
    padding: 1rem;
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    align-items: center;
}
.filter-bar select,
.filter-bar input {
    padding: 0.35rem 0.75rem;
    border: 1px solid var(--border);
    border-radius: var(--radius);
    font-size: 0.82rem;
    background: var(--surface);
    color: var(--ink);
    min-width: 150px;
}
.filter-bar select:focus,
.filter-bar input:focus {
    outline: none;
    border-color: var(--primary);
}
.filter-bar .btn-filter {
    padding: 0.35rem 1.5rem;
    background: var(--primary);
    color: #fff;
    border: none;
    border-radius: var(--radius);
    font-weight: 600;
    cursor: pointer;
}
.filter-bar .btn-filter:hover {
    background: var(--primary-dark);
}
.filter-bar .btn-reset {
    padding: 0.35rem 1.5rem;
    background: var(--canvas);
    color: var(--ink);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    font-weight: 600;
    cursor: pointer;
}
.filter-bar .btn-reset:hover {
    background: var(--border);
}
.modal-content {
    border: none;
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-lg);
}
.modal-header {
    border-bottom: 1px solid var(--border);
    padding: 1rem 1.5rem;
    background: var(--canvas);
    border-radius: var(--radius-lg) var(--radius-lg) 0 0;
}
.modal-header .modal-title {
    font-weight: 700;
    font-size: 1.1rem;
}
.modal-header .btn-close {
    background: transparent;
    border: none;
    font-size: 1.2rem;
    cursor: pointer;
    color: var(--ink-muted);
}
.modal-body {
    padding: 1.5rem;
    max-height: 70vh;
    overflow-y: auto;
}
.modal-footer {
    border-top: 1px solid var(--border);
    padding: 1rem 1.5rem;
    background: var(--canvas);
    border-radius: 0 0 var(--radius-lg) var(--radius-lg);
}
.modal-footer .btn {
    padding: 0.4rem 1.2rem;
    border-radius: var(--radius);
    font-weight: 600;
}
.form-group {
    margin-bottom: 1rem;
}
.form-group label {
    display: block;
    font-size: 0.82rem;
    font-weight: 600;
    color: var(--ink);
    margin-bottom: 0.3rem;
}
.form-group label .required {
    color: #c62828;
}
.form-group input,
.form-group select,
.form-group textarea {
    width: 100%;
    padding: 0.5rem 0.75rem;
    border: 1px solid var(--border);
    border-radius: var(--radius);
    font-size: 0.85rem;
    font-family: 'Inter', sans-serif;
    background: var(--surface);
    color: var(--ink);
}
.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(7, 142, 206, 0.1);
}
.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
}
.view-detail {
    display: flex;
    padding: 0.4rem 0;
    border-bottom: 1px solid var(--border);
}
.view-detail:last-child {
    border-bottom: none;
}
.view-detail .label {
    width: 180px;
    font-weight: 600;
    color: var(--ink-muted);
    font-size: 0.82rem;
    flex-shrink: 0;
}
.view-detail .value {
    flex: 1;
    font-size: 0.82rem;
    color: var(--ink);
}
.badge-status {
    display: inline-block;
    padding: 0.1rem 0.6rem;
    border-radius: 20px;
    font-size: 0.6rem;
    font-weight: 600;
}
.badge-active { background: #e6f7ef; color: #22a67e; }
.badge-pending { background: #fff3cd; color: #856404; }
.badge-verified { background: #e6f7ef; color: #22a67e; }
.badge-unverified { background: #fde8e8; color: #c62828; }
.badge-individual { background: #e3f2fd; color: #0d47a1; }
.badge-institutional { background: #f3e5f5; color: #6a1b9a; }
.badge-venture_capital { background: #fff3e0; color: #e65100; }
.badge-angel { background: #e8f5e9; color: #2e7d32; }
.badge-government { background: #e8eaf6; color: #283593; }
.btn-sm {
    padding: 0.2rem 0.6rem;
    border-radius: 4px;
    font-size: 0.7rem;
    font-weight: 600;
    border: none;
    cursor: pointer;
}
.btn-primary-sm {
    background: var(--primary);
    color: #fff;
}
.btn-primary-sm:hover {
    background: var(--primary-dark);
}
.btn-danger-sm {
    background: #c62828;
    color: #fff;
}
.btn-danger-sm:hover {
    background: #b71c1c;
}
.swal2-popup {
    font-family: 'Inter', sans-serif;
}
.swal2-title {
    font-weight: 700;
}
.amount-range {
    font-weight: 600;
    color: var(--primary);
}
@media (max-width: 768px) {
    .form-row {
        grid-template-columns: 1fr;
    }
    .view-detail {
        flex-direction: column;
        padding: 0.6rem 0;
    }
    .view-detail .label {
        width: 100%;
        margin-bottom: 0.2rem;
    }
    .filter-bar {
        flex-direction: column;
        align-items: stretch;
    }
    .filter-bar select,
    .filter-bar input {
        width: 100%;
        min-width: auto;
    }
}
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Filter Bar -->
<div class="filter-bar">
    <select id="filterType">
        <option value="all">All Types</option>
        <?php foreach ($types as $type): ?>
            <option value="<?= $type['type'] ?>"><?= ucfirst(str_replace('_', ' ', $type['type'])) ?></option>
        <?php endforeach; ?>
    </select>
    <select id="filterSector">
        <option value="all">All Sectors</option>
        <?php foreach ($sectors as $sector): ?>
            <option value="<?= $sector['investment_sector'] ?>"><?= $sector['investment_sector'] ?></option>
        <?php endforeach; ?>
    </select>
    <select id="filterStage">
        <option value="all">All Stages</option>
        <?php foreach ($stages as $stage): ?>
            <option value="<?= $stage['investment_stage'] ?>"><?= ucfirst($stage['investment_stage']) ?></option>
        <?php endforeach; ?>
    </select>
    <input type="text" id="filterSearch" placeholder="Search investors..." style="flex:1;min-width:200px;">
    <button class="btn-filter" id="btnFilter"><i class="fas fa-search"></i> Filter</button>
    <button class="btn-reset" id="btnReset"><i class="fas fa-times"></i> Reset</button>
</div>

<!-- Table -->
<div class="table-container">
    <div class="table-header">
        <h3><i class="fas fa-user-tie" style="color:var(--primary);margin-right:0.5rem;"></i> All Investors</h3>
        <button class="btn-sm btn-primary-sm" id="btnAddInvestor" style="padding:0.5rem 1.2rem;font-size:0.82rem;">
            <i class="fas fa-plus"></i> Add Investor
        </button>
    </div>
    <table id="investorsTable" class="display" style="width:100%;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Type</th>
                <th>Investment Sector</th>
                <th>Amount Range</th>
                <th>Stage</th>
                <th style="text-align:center;width:120px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($investors)): ?>
                <?php foreach ($investors as $investor): ?>
                    <tr data-id="<?= $investor['investor_id'] ?>">
                        <td>#<?= $investor['investor_id'] ?></td>
                        <td><strong><?= esc($investor['name']) ?></strong></td>
                        <td>
                            <span class="badge-status badge-<?= $investor['type'] ?? 'individual' ?>">
                                <?= ucfirst(str_replace('_', ' ', $investor['type'] ?? 'Individual')) ?>
                            </span>
                        </td>
                        <td><?= esc(substr($investor['investment_sector'] ?? 'N/A', 0, 30)) ?></td>
                        <td>
                            <?php if ($investor['investment_amount_min'] && $investor['investment_amount_max']): ?>
                                <span class="amount-range">
                                    $<?= number_format($investor['investment_amount_min']) ?> - $<?= number_format($investor['investment_amount_max']) ?>
                                </span>
                            <?php else: ?>
                                N/A
                            <?php endif; ?>
                        </td>
                        <td>
                            <span class="badge-status" style="background:#f3e5f5;color:#6a1b9a;">
                                <?= ucfirst($investor['investment_stage'] ?? 'N/A') ?>
                            </span>
                        </td>
                        <td style="text-align:center;">
                            <button class="btn-sm btn-primary-sm view-btn" data-id="<?= $investor['investor_id'] ?>" title="View">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="btn-sm btn-primary-sm edit-btn" data-id="<?= $investor['investor_id'] ?>" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn-sm btn-danger-sm delete-btn" data-id="<?= $investor['investor_id'] ?>" data-name="<?= esc($investor['name']) ?>" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="7" style="text-align:center;padding:2rem;color:var(--ink-muted);">No investors found</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- ========== ADD/EDIT MODAL (POPUP) ========== -->
<div class="modal fade" id="investorModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle"><i class="fas fa-user-tie" style="color:var(--primary);margin-right:0.5rem;"></i> Add Investor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <form id="investorForm">
                    <?= csrf_field() ?>
                    <input type="hidden" id="investor_id" name="investor_id" value="">
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="name">Investor Name <span class="required">*</span></label>
                            <input type="text" id="name" name="name" placeholder="Enter investor name" required>
                        </div>
                        <div class="form-group">
                            <label for="type">Investor Type <span class="required">*</span></label>
                            <select id="type" name="type" required>
                                <option value="">Select type</option>
                                <option value="individual">Individual</option>
                                <option value="institutional">Institutional</option>
                                <option value="venture_capital">Venture Capital</option>
                                <option value="angel">Angel Investor</option>
                                <option value="government">Government</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="investment_sector">Investment Sector <span class="required">*</span></label>
                        <select id="investment_sector" name="investment_sector" required>
                            <option value="">Select sector</option>
                            <option value="Agribusiness">Agribusiness</option>
                            <option value="Manufacturing">Manufacturing</option>
                            <option value="Technology">Technology</option>
                            <option value="Construction">Construction</option>
                            <option value="Energy">Energy</option>
                            <option value="Mining">Mining</option>
                            <option value="Tourism">Tourism</option>
                            <option value="Financial Services">Financial Services</option>
                            <option value="Healthcare">Healthcare</option>
                            <option value="Education">Education</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="preferred_enterprise_type">Preferred Enterprise Type</label>
                        <select id="preferred_enterprise_type" name="preferred_enterprise_type">
                            <option value="">Select preferred type</option>
                            <option value="Startup">Startup</option>
                            <option value="SME">SME</option>
                            <option value="Large Enterprise">Large Enterprise</option>
                            <option value="All">All Types</option>
                        </select>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="investment_amount_min">Min Investment ($) <span class="required">*</span></label>
                            <input type="number" id="investment_amount_min" name="investment_amount_min" placeholder="100000" required>
                        </div>
                        <div class="form-group">
                            <label for="investment_amount_max">Max Investment ($) <span class="required">*</span></label>
                            <input type="number" id="investment_amount_max" name="investment_amount_max" placeholder="10000000" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="geographic_preferences">Geographic Preferences</label>
                        <input type="text" id="geographic_preferences" name="geographic_preferences" placeholder="e.g. Kigali, Musanze, Rubavu">
                    </div>

                    <div class="form-group">
                        <label for="technology_interests">Technology Interests</label>
                        <input type="text" id="technology_interests" name="technology_interests" placeholder="e.g. AI, IoT, Blockchain, Clean Tech">
                    </div>

                    <div class="form-group">
                        <label for="sustainability_preferences">Sustainability Preferences</label>
                        <select id="sustainability_preferences" name="sustainability_preferences">
                            <option value="">Select preference</option>
                            <option value="High sustainability focus">High Sustainability Focus</option>
                            <option value="Moderate sustainability">Moderate Sustainability</option>
                            <option value="Sustainability required">Sustainability Required</option>
                            <option value="Not a priority">Not a Priority</option>
                        </select>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="investment_stage">Investment Stage <span class="required">*</span></label>
                            <select id="investment_stage" name="investment_stage" required>
                                <option value="">Select stage</option>
                                <option value="seed">Seed</option>
                                <option value="early">Early Stage</option>
                                <option value="growth">Growth</option>
                                <option value="expansion">Expansion</option>
                                <option value="mature">Mature</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="expected_returns">Expected Returns (%)</label>
                            <input type="number" id="expected_returns" name="expected_returns" step="0.1" placeholder="20.5">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="investment_criteria">Investment Criteria</label>
                        <textarea id="investment_criteria" name="investment_criteria" rows="3" placeholder="Describe your investment criteria..."></textarea>
                    </div>

                    <div class="form-group" style="display:flex;align-items:center;gap:0.5rem;">
                        <input type="checkbox" id="is_verified" name="is_verified" value="1">
                        <label for="is_verified" style="margin-bottom:0;">Verified</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="saveInvestorBtn" style="background:var(--primary);color:#fff;border:none;">
                    <i class="fas fa-save"></i> Save Investor
                </button>
            </div>
        </div>
    </div>
</div>

<!-- ========== VIEW MODAL (POPUP) ========== -->
<div class="modal fade" id="viewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-eye" style="color:var(--primary);margin-right:0.5rem;"></i> Investor Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body" id="viewModalBody">
                <div class="text-center py-4">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- ========== SCRIPTS ========== -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function() {
    var table = $('#investorsTable').DataTable({
        "pageLength": 10,
        "language": {
            "search": "Search:",
            "lengthMenu": "Show _MENU_ entries",
            "info": "Showing _START_ to _END_ of _TOTAL_ entries",
            "infoEmpty": "No entries found",
            "infoFiltered": "(filtered from _MAX_ total entries)",
            "zeroRecords": "No matching records found"
        },
        "order": [[0, 'desc']],
        "columnDefs": [{ "orderable": false, "targets": [6] }]
    });

    function applyFilters() {
        var type = $('#filterType').val();
        var sector = $('#filterSector').val();
        var stage = $('#filterStage').val();
        var search = $('#filterSearch').val().toLowerCase();

        table.rows().every(function() {
            var row = this.node();
            var show = true;
            
            if (type !== 'all') {
                var rowType = $(row).find('td:eq(2)').text().trim().toLowerCase();
                var typeMap = {
                    'individual': 'individual',
                    'institutional': 'institutional',
                    'venture_capital': 'venture capital',
                    'angel': 'angel investor',
                    'government': 'government'
                };
                if (typeMap[rowType] !== type) show = false;
            }
            
            if (sector !== 'all' && show) {
                var rowSector = $(row).find('td:eq(3)').text().trim();
                if (rowSector !== sector) show = false;
            }
            
            if (stage !== 'all' && show) {
                var rowStage = $(row).find('td:eq(5)').text().trim().toLowerCase();
                if (rowStage !== stage) show = false;
            }
            
            if (search !== '' && show) {
                var rowText = $(row).text().toLowerCase();
                if (rowText.indexOf(search) === -1) show = false;
            }
            
            $(row).toggle(show);
        });
        table.draw();
    }

    $('#btnFilter').on('click', applyFilters);
    $('#btnReset').on('click', function() {
        $('#filterType').val('all');
        $('#filterSector').val('all');
        $('#filterStage').val('all');
        $('#filterSearch').val('');
        applyFilters();
    });
    $('#filterSearch').on('keyup', function(e) {
        if (e.key === 'Enter') applyFilters();
    });

    var modal = new bootstrap.Modal(document.getElementById('investorModal'));
    var viewModal = new bootstrap.Modal(document.getElementById('viewModal'));

    // ADD - Opens Modal Popup (NO SCROLLING)
    $('#btnAddInvestor').on('click', function() {
        $('#modalTitle').html('<i class="fas fa-plus-circle" style="color:var(--primary);margin-right:0.5rem;"></i> Add Investor');
        $('#investorForm')[0].reset();
        $('#investor_id').val('');
        $('#saveInvestorBtn').html('<i class="fas fa-save"></i> Create Investor');
        modal.show();
    });

    // VIEW
    $(document).on('click', '.view-btn', function() {
        var id = $(this).data('id');
        viewModal.show();
        $('#viewModalBody').html('<div class="text-center py-4"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div></div>');
        $.ajax({
            url: '<?= base_url('admin/investors/get') ?>/' + id,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    var d = response.data;
                    var html = `
                        <div class="view-detail"><span class="label">ID</span><span class="value"><strong>#${d.investor_id}</strong></span></div>
                        <div class="view-detail"><span class="label">Name</span><span class="value"><strong>${d.name}</strong></span></div>
                        <div class="view-detail"><span class="label">Type</span><span class="value"><span class="badge-status badge-${d.type}">${ucfirst(d.type || 'Individual')}</span></span></div>
                        <div class="view-detail"><span class="label">Investment Sector</span><span class="value">${d.investment_sector || 'N/A'}</span></div>
                        <div class="view-detail"><span class="label">Preferred Enterprise Type</span><span class="value">${d.preferred_enterprise_type || 'N/A'}</span></div>
                        <div class="view-detail"><span class="label">Investment Amount</span><span class="value"><strong>$${Number(d.investment_amount_min || 0).toLocaleString()} - $${Number(d.investment_amount_max || 0).toLocaleString()}</strong></span></div>
                        <div class="view-detail"><span class="label">Geographic Preferences</span><span class="value">${d.geographic_preferences || 'N/A'}</span></div>
                        <div class="view-detail"><span class="label">Technology Interests</span><span class="value">${d.technology_interests || 'N/A'}</span></div>
                        <div class="view-detail"><span class="label">Sustainability Preferences</span><span class="value">${d.sustainability_preferences || 'N/A'}</span></div>
                        <div class="view-detail"><span class="label">Investment Stage</span><span class="value"><span class="badge-status" style="background:#f3e5f5;color:#6a1b9a;">${ucfirst(d.investment_stage || 'N/A')}</span></span></div>
                        <div class="view-detail"><span class="label">Expected Returns</span><span class="value">${d.expected_returns || 0}%</span></div>
                        <div class="view-detail"><span class="label">Investment Criteria</span><span class="value">${d.investment_criteria || 'N/A'}</span></div>
                        <div class="view-detail"><span class="label">Status</span><span class="value"><span class="badge-status ${d.is_verified ? 'badge-verified' : 'badge-unverified'}">${d.is_verified ? 'Verified' : 'Pending'}</span></span></div>
                        <div class="view-detail"><span class="label">Created</span><span class="value">${d.created_at ? new Date(d.created_at).toLocaleDateString() : 'N/A'}</span></div>
                    `;
                    $('#viewModalBody').html(html);
                } else {
                    $('#viewModalBody').html('<div class="text-center py-4 text-danger">' + response.message + '</div>');
                }
            }
        });
    });

    // EDIT
    $(document).on('click', '.edit-btn', function() {
        var id = $(this).data('id');
        $('#modalTitle').html('<i class="fas fa-edit" style="color:var(--primary);margin-right:0.5rem;"></i> Edit Investor');
        $('#saveInvestorBtn').html('<i class="fas fa-save"></i> Update Investor');
        $.ajax({
            url: '<?= base_url('admin/investors/get') ?>/' + id,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    var d = response.data;
                    $('#investor_id').val(d.investor_id);
                    $('#name').val(d.name);
                    $('#type').val(d.type);
                    $('#investment_sector').val(d.investment_sector);
                    $('#preferred_enterprise_type').val(d.preferred_enterprise_type);
                    $('#investment_amount_min').val(d.investment_amount_min);
                    $('#investment_amount_max').val(d.investment_amount_max);
                    $('#geographic_preferences').val(d.geographic_preferences);
                    $('#technology_interests').val(d.technology_interests);
                    $('#sustainability_preferences').val(d.sustainability_preferences);
                    $('#investment_stage').val(d.investment_stage);
                    $('#expected_returns').val(d.expected_returns);
                    $('#investment_criteria').val(d.investment_criteria);
                    $('#is_verified').prop('checked', d.is_verified == 1);
                    modal.show();
                } else {
                    Swal.fire({ icon: 'error', title: 'Error!', text: response.message });
                }
            }
        });
    });

    // SAVE
    $('#saveInvestorBtn').on('click', function() {
        var id = $('#investor_id').val();
        var url = id ? '<?= base_url('admin/investors/update') ?>/' + id : '<?= base_url('admin/investors/store') ?>';
        var formData = $('#investorForm').serialize();
        var btn = $(this);
        btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Saving...');
        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    modal.hide();
                    if (!id) {
                        var typeMap = {
                            'individual': 'Individual',
                            'institutional': 'Institutional',
                            'venture_capital': 'Venture Capital',
                            'angel': 'Angel Investor',
                            'government': 'Government'
                        };
                        var newRow = [
                            '#' + response.id,
                            '<strong>' + $('#name').val() + '</strong>',
                            '<span class="badge-status badge-' + $('#type').val() + '">' + (typeMap[$('#type').val()] || $('#type').val()) + '</span>',
                            $('#investment_sector').val(),
                            '<span class="amount-range">$' + Number($('#investment_amount_min').val()).toLocaleString() + ' - $' + Number($('#investment_amount_max').val()).toLocaleString() + '</span>',
                            '<span class="badge-status" style="background:#f3e5f5;color:#6a1b9a;">' + ucfirst($('#investment_stage').val()) + '</span>',
                            '<button class="btn-sm btn-primary-sm view-btn" data-id="' + response.id + '" title="View"><i class="fas fa-eye"></i></button> ' +
                            '<button class="btn-sm btn-primary-sm edit-btn" data-id="' + response.id + '" title="Edit"><i class="fas fa-edit"></i></button> ' +
                            '<button class="btn-sm btn-danger-sm delete-btn" data-id="' + response.id + '" data-name="' + $('#name').val() + '" title="Delete"><i class="fas fa-trash"></i></button>'
                        ];
                        table.row.add(newRow).draw();
                    } else {
                        var row = table.row($('#investorsTable tbody tr[data-id="' + id + '"]'));
                        var rowData = [
                            '#' + id,
                            '<strong>' + $('#name').val() + '</strong>',
                            '<span class="badge-status badge-' + $('#type').val() + '">' + (typeMap[$('#type').val()] || $('#type').val()) + '</span>',
                            $('#investment_sector').val(),
                            '<span class="amount-range">$' + Number($('#investment_amount_min').val()).toLocaleString() + ' - $' + Number($('#investment_amount_max').val()).toLocaleString() + '</span>',
                            '<span class="badge-status" style="background:#f3e5f5;color:#6a1b9a;">' + ucfirst($('#investment_stage').val()) + '</span>',
                            '<button class="btn-sm btn-primary-sm view-btn" data-id="' + id + '" title="View"><i class="fas fa-eye"></i></button> ' +
                            '<button class="btn-sm btn-primary-sm edit-btn" data-id="' + id + '" title="Edit"><i class="fas fa-edit"></i></button> ' +
                            '<button class="btn-sm btn-danger-sm delete-btn" data-id="' + id + '" data-name="' + $('#name').val() + '" title="Delete"><i class="fas fa-trash"></i></button>'
                        ];
                        row.data(rowData).draw();
                    }
                    Swal.fire({ icon: 'success', title: 'Success!', text: response.message, timer: 1500, showConfirmButton: false });
                    btn.prop('disabled', false).html('<i class="fas fa-save"></i> ' + (id ? 'Update Investor' : 'Create Investor'));
                } else {
                    Swal.fire({ icon: 'error', title: 'Error!', text: response.message });
                    btn.prop('disabled', false).html('<i class="fas fa-save"></i> ' + (id ? 'Update Investor' : 'Create Investor'));
                }
            }
        });
    });

    // DELETE
    $(document).on('click', '.delete-btn', function() {
        var id = $(this).data('id');
        var name = $(this).data('name');
        var row = $(this).closest('tr');
        Swal.fire({
            title: 'Delete Investor?',
            html: 'Are you sure you want to delete <strong>' + name + '</strong>?<br><br>This action cannot be undone.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#c62828',
            cancelButtonColor: '#5c6b74',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url('admin/investors/delete') ?>/' + id,
                    type: 'DELETE',
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            table.row(row).remove().draw();
                            Swal.fire({ icon: 'success', title: 'Deleted!', text: response.message, timer: 1500, showConfirmButton: false });
                        } else {
                            Swal.fire({ icon: 'error', title: 'Error!', text: response.message });
                        }
                    }
                });
            }
        });
    });

    <?php if (session()->getFlashdata('success')): ?>
        Swal.fire({ icon: 'success', title: 'Success!', text: '<?= session()->getFlashdata('success') ?>', timer: 3000, showConfirmButton: false });
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        Swal.fire({ icon: 'error', title: 'Error!', text: '<?= session()->getFlashdata('error') ?>' });
    <?php endif; ?>

    function ucfirst(str) {
        if (!str) return '';
        return str.charAt(0).toUpperCase() + str.slice(1);
    }
});
</script>

<?= $this->endSection() ?>