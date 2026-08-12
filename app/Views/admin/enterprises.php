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
    width: 150px;
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
.badge-inactive { background: #fde8e8; color: #c62828; }
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
    <select id="filterSector">
        <option value="all">All Sectors</option>
        <?php foreach ($sectors as $sector): ?>
            <option value="<?= $sector['sector'] ?>"><?= $sector['sector'] ?></option>
        <?php endforeach; ?>
    </select>
    <select id="filterLocation">
        <option value="all">All Locations</option>
        <?php foreach ($locations as $location): ?>
            <option value="<?= $location['location'] ?>"><?= $location['location'] ?></option>
        <?php endforeach; ?>
    </select>
    <select id="filterStatus">
        <option value="all">All Status</option>
        <option value="active">Active</option>
        <option value="pending">Pending</option>
        <option value="inactive">Inactive</option>
    </select>
    <input type="text" id="filterSearch" placeholder="Search enterprises..." style="flex:1;min-width:200px;">
    <button class="btn-filter" id="btnFilter"><i class="fas fa-search"></i> Filter</button>
    <button class="btn-reset" id="btnReset"><i class="fas fa-times"></i> Reset</button>
</div>

<!-- Table -->
<div class="table-container">
    <div class="table-header">
        <h3><i class="fas fa-building" style="color:var(--primary);margin-right:0.5rem;"></i> All Enterprises</h3>
        <button class="btn-sm btn-primary-sm" id="btnAddEnterprise" style="padding:0.5rem 1.2rem;font-size:0.82rem;">
            <i class="fas fa-plus"></i> Add Enterprise
        </button>
    </div>
    <table id="enterprisesTable" class="display" style="width:100%;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Sector</th>
                <th>Location</th>
                <th>Contact</th>
                <th>Status</th>
                <th>Verified</th>
                <th style="text-align:center;width:120px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($enterprises)): ?>
                <?php foreach ($enterprises as $enterprise): ?>
                    <tr data-id="<?= $enterprise['enterprise_id'] ?>">
                        <td>#<?= $enterprise['enterprise_id'] ?></td>
                        <td><strong><?= esc($enterprise['name']) ?></strong></td>
                        <td><?= esc($enterprise['sector'] ?? 'N/A') ?></td>
                        <td><?= esc($enterprise['location'] ?? 'N/A') ?></td>
                        <td><?= esc($enterprise['contact_person'] ?? 'N/A') ?></td>
                        <td>
                            <span class="badge-status <?= $enterprise['status'] === 'active' ? 'badge-active' : ($enterprise['status'] === 'pending' ? 'badge-pending' : 'badge-inactive') ?>">
                                <?= ucfirst($enterprise['status'] ?? 'pending') ?>
                            </span>
                        </td>
                        <td>
                            <span class="badge-status <?= $enterprise['is_verified'] ? 'badge-active' : 'badge-pending' ?>">
                                <?= $enterprise['is_verified'] ? 'Yes' : 'Pending' ?>
                            </span>
                        </td>
                        <td style="text-align:center;">
                            <button class="btn-sm btn-primary-sm view-btn" data-id="<?= $enterprise['enterprise_id'] ?>" title="View">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="btn-sm btn-primary-sm edit-btn" data-id="<?= $enterprise['enterprise_id'] ?>" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn-sm btn-danger-sm delete-btn" data-id="<?= $enterprise['enterprise_id'] ?>" data-name="<?= esc($enterprise['name']) ?>" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="8" style="text-align:center;padding:2rem;color:var(--ink-muted);">No enterprises found</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- ========== ADD ENTERPRISE MODAL ========== -->
<div class="modal fade" id="enterpriseModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle"><i class="fas fa-plus-circle" style="color:var(--primary);margin-right:0.5rem;"></i> Add Enterprise</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <form id="enterpriseForm">
                    <?= csrf_field() ?>
                    <input type="hidden" id="enterprise_id" name="enterprise_id" value="">
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="name">Enterprise Name <span class="required">*</span></label>
                            <input type="text" id="name" name="name" placeholder="Enter enterprise name" required>
                        </div>
                        <div class="form-group">
                            <label for="registration_number">Registration Number <span class="required">*</span></label>
                            <input type="text" id="registration_number" name="registration_number" placeholder="e.g. REG-001" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="sector">Sector <span class="required">*</span></label>
                            <select id="sector" name="sector" required>
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
                            <label for="sub_sector">Sub Sector</label>
                            <input type="text" id="sub_sector" name="sub_sector" placeholder="e.g. Textile, Software">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="location">Location <span class="required">*</span></label>
                            <input type="text" id="location" name="location" placeholder="e.g. Kigali" required>
                        </div>
                        <div class="form-row" style="gap:0.5rem;">
                            <div class="form-group">
                                <label for="latitude">Latitude</label>
                                <input type="text" id="latitude" name="latitude" placeholder="-1.9441">
                            </div>
                            <div class="form-group">
                                <label for="longitude">Longitude</label>
                                <input type="text" id="longitude" name="longitude" placeholder="30.0619">
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="contact_person">Contact Person <span class="required">*</span></label>
                            <input type="text" id="contact_person" name="contact_person" placeholder="Full name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email <span class="required">*</span></label>
                            <input type="email" id="email" name="email" placeholder="email@example.com" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="phone">Phone <span class="required">*</span></label>
                            <input type="text" id="phone" name="phone" placeholder="+250 788 123 456" required>
                        </div>
                        <div class="form-group">
                            <label for="website">Website</label>
                            <input type="text" id="website" name="website" placeholder="www.example.com">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="products_services">Products / Services</label>
                        <textarea id="products_services" name="products_services" rows="2" placeholder="Describe products or services"></textarea>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="employees">Number of Employees</label>
                            <input type="number" id="employees" name="employees" placeholder="0">
                        </div>
                        <div class="form-group">
                            <label for="revenue">Revenue (USD)</label>
                            <input type="number" id="revenue" name="revenue" placeholder="0">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="investment_requirements">Investment Requirements</label>
                        <textarea id="investment_requirements" name="investment_requirements" rows="2" placeholder="Describe investment needs"></textarea>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select id="status" name="status">
                                <option value="pending">Pending</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="form-group" style="display:flex;align-items:center;gap:0.5rem;padding-top:1.5rem;">
                            <input type="checkbox" id="is_verified" name="is_verified" value="1">
                            <label for="is_verified" style="margin-bottom:0;">Verified</label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="saveEnterpriseBtn" style="background:var(--primary);color:#fff;border:none;">
                    <i class="fas fa-save"></i> Save Enterprise
                </button>
            </div>
        </div>
    </div>
</div>

<!-- ========== VIEW MODAL ========== -->
<div class="modal fade" id="viewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-eye" style="color:var(--primary);margin-right:0.5rem;"></i> Enterprise Details</h5>
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
    var table = $('#enterprisesTable').DataTable({
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
        "columnDefs": [{ "orderable": false, "targets": [7] }]
    });

    function applyFilters() {
        var sector = $('#filterSector').val();
        var location = $('#filterLocation').val();
        var status = $('#filterStatus').val();
        var search = $('#filterSearch').val().toLowerCase();

        table.rows().every(function() {
            var row = this.node();
            var show = true;
            if (sector !== 'all') {
                var rowSector = $(row).find('td:eq(2)').text().trim();
                if (rowSector !== sector) show = false;
            }
            if (location !== 'all' && show) {
                var rowLocation = $(row).find('td:eq(3)').text().trim();
                if (rowLocation !== location) show = false;
            }
            if (status !== 'all' && show) {
                var rowStatus = $(row).find('td:eq(5)').text().trim().toLowerCase();
                if (rowStatus !== status) show = false;
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
        $('#filterSector').val('all');
        $('#filterLocation').val('all');
        $('#filterStatus').val('all');
        $('#filterSearch').val('');
        applyFilters();
    });
    $('#filterSearch').on('keyup', function(e) {
        if (e.key === 'Enter') applyFilters();
    });

    var modal = new bootstrap.Modal(document.getElementById('enterpriseModal'));
    var viewModal = new bootstrap.Modal(document.getElementById('viewModal'));

    // ADD - Opens Modal Popup (NO SCROLLING)
    $('#btnAddEnterprise').on('click', function() {
        $('#modalTitle').html('<i class="fas fa-plus-circle" style="color:var(--primary);margin-right:0.5rem;"></i> Add Enterprise');
        $('#enterpriseForm')[0].reset();
        $('#enterprise_id').val('');
        $('#saveEnterpriseBtn').html('<i class="fas fa-save"></i> Create Enterprise');
        modal.show();
    });

    // VIEW
    $(document).on('click', '.view-btn', function() {
        var id = $(this).data('id');
        viewModal.show();
        $('#viewModalBody').html('<div class="text-center py-4"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div></div>');
        $.ajax({
            url: '<?= base_url('admin/enterprises/get') ?>/' + id,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    var d = response.data;
                    var html = `
                        <div class="view-detail"><span class="label">ID</span><span class="value"><strong>#${d.enterprise_id}</strong></span></div>
                        <div class="view-detail"><span class="label">Name</span><span class="value"><strong>${d.name}</strong></span></div>
                        <div class="view-detail"><span class="label">Registration</span><span class="value">${d.registration_number || 'N/A'}</span></div>
                        <div class="view-detail"><span class="label">Sector</span><span class="value">${d.sector || 'N/A'}</span></div>
                        <div class="view-detail"><span class="label">Location</span><span class="value">${d.location || 'N/A'}</span></div>
                        <div class="view-detail"><span class="label">Contact Person</span><span class="value">${d.contact_person || 'N/A'}</span></div>
                        <div class="view-detail"><span class="label">Email</span><span class="value">${d.email || 'N/A'}</span></div>
                        <div class="view-detail"><span class="label">Phone</span><span class="value">${d.phone || 'N/A'}</span></div>
                        <div class="view-detail"><span class="label">Employees</span><span class="value">${d.employees || 0}</span></div>
                        <div class="view-detail"><span class="label">Revenue</span><span class="value">$${Number(d.revenue || 0).toLocaleString()}</span></div>
                        <div class="view-detail"><span class="label">Status</span><span class="value"><span class="badge-status ${d.status === 'active' ? 'badge-active' : (d.status === 'pending' ? 'badge-pending' : 'badge-inactive')}">${ucfirst(d.status || 'pending')}</span></span></div>
                        <div class="view-detail"><span class="label">Verified</span><span class="value"><span class="badge-status ${d.is_verified ? 'badge-active' : 'badge-pending'}">${d.is_verified ? 'Yes' : 'Pending'}</span></span></div>
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
        $('#modalTitle').html('<i class="fas fa-edit" style="color:var(--primary);margin-right:0.5rem;"></i> Edit Enterprise');
        $('#saveEnterpriseBtn').html('<i class="fas fa-save"></i> Update Enterprise');
        $.ajax({
            url: '<?= base_url('admin/enterprises/get') ?>/' + id,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    var d = response.data;
                    $('#enterprise_id').val(d.enterprise_id);
                    $('#name').val(d.name);
                    $('#registration_number').val(d.registration_number);
                    $('#sector').val(d.sector);
                    $('#sub_sector').val(d.sub_sector);
                    $('#location').val(d.location);
                    $('#latitude').val(d.latitude);
                    $('#longitude').val(d.longitude);
                    $('#contact_person').val(d.contact_person);
                    $('#email').val(d.email);
                    $('#phone').val(d.phone);
                    $('#website').val(d.website);
                    $('#products_services').val(d.products_services);
                    $('#employees').val(d.employees);
                    $('#revenue').val(d.revenue);
                    $('#investment_requirements').val(d.investment_requirements);
                    $('#status').val(d.status || 'pending');
                    $('#is_verified').prop('checked', d.is_verified == 1);
                    modal.show();
                } else {
                    Swal.fire({ icon: 'error', title: 'Error!', text: response.message });
                }
            }
        });
    });

    // SAVE
    $('#saveEnterpriseBtn').on('click', function() {
        var id = $('#enterprise_id').val();
        var url = id ? '<?= base_url('admin/enterprises/update') ?>/' + id : '<?= base_url('admin/enterprises/store') ?>';
        var formData = $('#enterpriseForm').serialize();
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
                        var newRow = [
                            '#' + response.id,
                            '<strong>' + $('#name').val() + '</strong>',
                            $('#sector').val(),
                            $('#location').val(),
                            $('#contact_person').val(),
                            '<span class="badge-status ' + ($('#status').val() === 'active' ? 'badge-active' : ($('#status').val() === 'pending' ? 'badge-pending' : 'badge-inactive')) + '">' + ucfirst($('#status').val()) + '</span>',
                            '<span class="badge-status ' + ($('#is_verified').is(':checked') ? 'badge-active' : 'badge-pending') + '">' + ($('#is_verified').is(':checked') ? 'Yes' : 'Pending') + '</span>',
                            '<button class="btn-sm btn-primary-sm view-btn" data-id="' + response.id + '" title="View"><i class="fas fa-eye"></i></button> ' +
                            '<button class="btn-sm btn-primary-sm edit-btn" data-id="' + response.id + '" title="Edit"><i class="fas fa-edit"></i></button> ' +
                            '<button class="btn-sm btn-danger-sm delete-btn" data-id="' + response.id + '" data-name="' + $('#name').val() + '" title="Delete"><i class="fas fa-trash"></i></button>'
                        ];
                        table.row.add(newRow).draw();
                    } else {
                        var row = table.row($('#enterprisesTable tbody tr[data-id="' + id + '"]'));
                        var rowData = [
                            '#' + id,
                            '<strong>' + $('#name').val() + '</strong>',
                            $('#sector').val(),
                            $('#location').val(),
                            $('#contact_person').val(),
                            '<span class="badge-status ' + ($('#status').val() === 'active' ? 'badge-active' : ($('#status').val() === 'pending' ? 'badge-pending' : 'badge-inactive')) + '">' + ucfirst($('#status').val()) + '</span>',
                            '<span class="badge-status ' + ($('#is_verified').is(':checked') ? 'badge-active' : 'badge-pending') + '">' + ($('#is_verified').is(':checked') ? 'Yes' : 'Pending') + '</span>',
                            '<button class="btn-sm btn-primary-sm view-btn" data-id="' + id + '" title="View"><i class="fas fa-eye"></i></button> ' +
                            '<button class="btn-sm btn-primary-sm edit-btn" data-id="' + id + '" title="Edit"><i class="fas fa-edit"></i></button> ' +
                            '<button class="btn-sm btn-danger-sm delete-btn" data-id="' + id + '" data-name="' + $('#name').val() + '" title="Delete"><i class="fas fa-trash"></i></button>'
                        ];
                        row.data(rowData).draw();
                    }
                    Swal.fire({ icon: 'success', title: 'Success!', text: response.message, timer: 1500, showConfirmButton: false });
                    btn.prop('disabled', false).html('<i class="fas fa-save"></i> ' + (id ? 'Update Enterprise' : 'Create Enterprise'));
                } else {
                    Swal.fire({ icon: 'error', title: 'Error!', text: response.message });
                    btn.prop('disabled', false).html('<i class="fas fa-save"></i> ' + (id ? 'Update Enterprise' : 'Create Enterprise'));
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
            title: 'Delete Enterprise?',
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
                    url: '<?= base_url('admin/enterprises/delete') ?>/' + id,
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