<?= $this->extend('admin/layout') ?>

<?= $this->section('styles') ?>
<style>
/* ============================================================
   ROLE MANAGEMENT - STYLES
   ============================================================ */

.role-stats-wrapper {
    display: grid !important;
    grid-template-columns: repeat(3, 1fr) !important;
    gap: 1rem !important;
    margin-bottom: 1.5rem !important;
    width: 100% !important;
}

.role-stats-wrapper .stat-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 10px;
    padding: 1rem 1.25rem;
    transition: all 0.2s ease;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    box-shadow: 0 1px 3px rgba(0,0,0,0.04);
    min-width: 0;
}

.role-stats-wrapper .stat-card:hover {
    border-color: var(--primary);
    box-shadow: 0 4px 12px rgba(0,0,0,0.06);
    transform: translateY(-1px);
}

.role-stats-wrapper .stat-card .stat-icon-wrap {
    width: 44px;
    height: 44px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.1rem;
    flex-shrink: 0;
}

.role-stats-wrapper .stat-card .stat-icon-wrap.purple {
    background: #ede9fe;
    color: #7c3aed;
}
.role-stats-wrapper .stat-card .stat-icon-wrap.green {
    background: #d1fae5;
    color: #059669;
}
.role-stats-wrapper .stat-card .stat-icon-wrap.red {
    background: #fee2e2;
    color: #dc2626;
}

[data-theme="dark"] .role-stats-wrapper .stat-card .stat-icon-wrap.purple {
    background: #2d1b4a;
    color: #a78bfa;
}
[data-theme="dark"] .role-stats-wrapper .stat-card .stat-icon-wrap.green {
    background: #1a3a2a;
    color: #34d399;
}
[data-theme="dark"] .role-stats-wrapper .stat-card .stat-icon-wrap.red {
    background: #3a1a1a;
    color: #f87171;
}

.role-stats-wrapper .stat-card .stat-info {
    flex: 1;
    min-width: 0;
    overflow: hidden;
}

.role-stats-wrapper .stat-card .stat-info .stat-number {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--ink);
    line-height: 1.2;
    letter-spacing: -0.02em;
}

.role-stats-wrapper .stat-card .stat-info .stat-label {
    font-size: 0.7rem;
    font-weight: 500;
    color: var(--ink-muted);
    text-transform: uppercase;
    letter-spacing: 0.04em;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.role-action-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
    flex-wrap: wrap;
    gap: 0.5rem;
}

.role-action-bar .btn-group {
    display: flex;
    gap: 0.5rem;
}

.role-action-bar .btn-primary {
    padding: 0.5rem 1.25rem;
    background: var(--primary);
    color: #fff;
    border: none;
    border-radius: 8px;
    font-size: 0.8rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s ease;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    font-family: 'Inter', sans-serif;
}

.role-action-bar .btn-primary:hover {
    background: var(--primary-dark);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(7, 142, 206, 0.3);
}

.role-table-wrap {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 10px;
    overflow: hidden;
}

.role-table-wrap .table-toolbar {
    padding: 0.75rem 1.25rem;
    border-bottom: 1px solid var(--border);
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 0.75rem;
}

.role-table-wrap .table-toolbar .search-box {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    background: var(--canvas);
    border: 1px solid var(--border);
    border-radius: 8px;
    padding: 0.3rem 0.75rem;
    transition: all 0.2s ease;
}

.role-table-wrap .table-toolbar .search-box:focus-within {
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(7, 142, 206, 0.1);
}

.role-table-wrap .table-toolbar .search-box i {
    color: var(--ink-muted);
    font-size: 0.8rem;
}

.role-table-wrap .table-toolbar .search-box input {
    border: none;
    background: transparent;
    padding: 0.4rem 0.25rem;
    font-size: 0.8rem;
    color: var(--ink);
    width: 200px;
    outline: none;
    font-family: 'Inter', sans-serif;
}

.role-table-wrap .table-toolbar .search-box input::placeholder {
    color: var(--ink-muted);
}

.role-table-wrap .table-toolbar .toolbar-right {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.role-table-wrap .table-toolbar .per-page {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.78rem;
    color: var(--ink-muted);
}

.role-table-wrap .table-toolbar .per-page select {
    padding: 0.25rem 0.5rem;
    border: 1px solid var(--border);
    border-radius: 6px;
    background: var(--surface);
    color: var(--ink);
    font-size: 0.78rem;
    cursor: pointer;
    font-family: 'Inter', sans-serif;
}

.role-table-wrap .table-toolbar .refresh-btn {
    padding: 0.3rem 0.7rem;
    border: 1px solid var(--border);
    border-radius: 6px;
    background: var(--surface);
    color: var(--ink-muted);
    cursor: pointer;
    transition: all 0.2s ease;
    font-size: 0.78rem;
}

.role-table-wrap .table-toolbar .refresh-btn:hover {
    background: var(--canvas);
    color: var(--ink);
}

.role-table-wrap .table-scroll {
    overflow-x: auto;
}

.role-table-wrap table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.85rem;
}

.role-table-wrap table thead {
    background: var(--canvas);
}

.role-table-wrap table th {
    padding: 0.6rem 1.25rem;
    text-align: left;
    font-weight: 600;
    color: var(--ink-muted);
    font-size: 0.65rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    border-bottom: 2px solid var(--border);
    cursor: pointer;
    user-select: none;
    white-space: nowrap;
}

.role-table-wrap table th .sort {
    margin-left: 0.25rem;
    opacity: 0.3;
    font-size: 0.55rem;
}

.role-table-wrap table th.active-sort .sort {
    opacity: 1;
    color: var(--primary);
}

.role-table-wrap table td {
    padding: 0.6rem 1.25rem;
    border-bottom: 1px solid var(--border);
    vertical-align: middle;
}

.role-table-wrap table tbody tr:hover {
    background: var(--surface-hover);
}

.role-table-wrap table .system-badge {
    display: inline-block;
    background: var(--primary-light);
    color: var(--primary);
    padding: 0.1rem 0.6rem;
    border-radius: 12px;
    font-size: 0.65rem;
    font-weight: 500;
}

.role-table-wrap table .status-badge {
    display: inline-block;
    padding: 0.1rem 0.7rem;
    border-radius: 20px;
    font-size: 0.55rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.04em;
}

.role-table-wrap table .status-badge.active {
    background: #d1fae5;
    color: #059669;
}
.role-table-wrap table .status-badge.inactive {
    background: #fee2e2;
    color: #dc2626;
}

[data-theme="dark"] .role-table-wrap table .status-badge.active {
    background: #1a3a2a;
    color: #34d399;
}
[data-theme="dark"] .role-table-wrap table .status-badge.inactive {
    background: #3a1a1a;
    color: #f87171;
}

.role-table-wrap table .action-group {
    display: flex;
    justify-content: center;
    gap: 0.15rem;
    flex-wrap: wrap;
}

.role-table-wrap table .action-group .act-btn {
    background: none;
    border: none;
    color: var(--ink-muted);
    padding: 0.25rem 0.4rem;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.2s ease;
}

.role-table-wrap table .action-group .act-btn:hover {
    background: var(--canvas);
    color: var(--ink);
}

.role-table-wrap table .action-group .act-btn.danger:hover {
    background: #fee2e2;
    color: #dc2626;
}

.role-table-wrap table .action-group .act-btn.primary:hover {
    background: var(--primary-light);
    color: var(--primary);
}

.role-table-wrap table .action-group .act-btn.purple:hover {
    background: #ede9fe;
    color: #7c3aed;
}

.role-table-wrap .table-footer {
    padding: 0.6rem 1.25rem;
    border-top: 1px solid var(--border);
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 0.5rem;
}

.role-table-wrap .table-footer .info-text {
    font-size: 0.78rem;
    color: var(--ink-muted);
}

.role-table-wrap .table-footer .pagination {
    display: flex;
    gap: 0.25rem;
}

.role-table-wrap .table-footer .pagination button {
    padding: 0.2rem 0.6rem;
    border: 1px solid var(--border);
    border-radius: 6px;
    background: var(--surface);
    color: var(--ink-muted);
    cursor: pointer;
    transition: all 0.2s ease;
    font-size: 0.75rem;
    min-width: 30px;
    font-family: 'Inter', sans-serif;
}

.role-table-wrap .table-footer .pagination button:hover:not(:disabled) {
    background: var(--canvas);
    color: var(--ink);
}

.role-table-wrap .table-footer .pagination button.active {
    background: var(--primary);
    color: #fff;
    border-color: var(--primary);
}

.role-table-wrap .table-footer .pagination button:disabled {
    opacity: 0.4;
    cursor: not-allowed;
}

.role-empty {
    padding: 3rem;
    text-align: center;
    color: var(--ink-muted);
}

.role-empty i {
    font-size: 2.5rem;
    display: block;
    margin-bottom: 0.75rem;
    opacity: 0.3;
}

.toast-container {
    position: fixed;
    top: 80px;
    right: 20px;
    z-index: 99999;
    display: flex;
    flex-direction: column;
    gap: 10px;
    max-width: 400px;
    width: 100%;
}

.toast {
    background: var(--surface);
    border-radius: 10px;
    padding: 1rem 1.25rem;
    box-shadow: 0 10px 40px rgba(0,0,0,0.15);
    display: flex;
    align-items: center;
    gap: 0.75rem;
    animation: slideInRight 0.4s ease;
    border-left: 4px solid var(--primary);
    min-width: 300px;
    transition: all 0.3s ease;
}

.toast.hiding {
    animation: slideOutRight 0.4s ease forwards;
}

.toast .toast-icon {
    font-size: 1.2rem;
    flex-shrink: 0;
}

.toast .toast-content {
    flex: 1;
}

.toast .toast-content .toast-title {
    font-weight: 600;
    font-size: 0.85rem;
    color: var(--ink);
}

.toast .toast-content .toast-message {
    font-size: 0.78rem;
    color: var(--ink-muted);
}

.toast .toast-close {
    background: none;
    border: none;
    color: var(--ink-muted);
    cursor: pointer;
    font-size: 0.9rem;
    padding: 0.2rem;
    transition: all 0.2s ease;
}

.toast .toast-close:hover {
    color: var(--ink);
}

.toast.success {
    border-left-color: #059669;
}
.toast.success .toast-icon { color: #059669; }
.toast.error {
    border-left-color: #dc2626;
}
.toast.error .toast-icon { color: #dc2626; }
.toast.warning {
    border-left-color: #d97706;
}
.toast.warning .toast-icon { color: #d97706; }
.toast.info {
    border-left-color: var(--primary);
}
.toast.info .toast-icon { color: var(--primary); }

[data-theme="dark"] .toast {
    background: #1a1d27;
    border: 1px solid #2d3344;
}

@keyframes slideInRight {
    from { transform: translateX(100%); opacity: 0; }
    to { transform: translateX(0); opacity: 1; }
}

@keyframes slideOutRight {
    from { transform: translateX(0); opacity: 1; }
    to { transform: translateX(100%); opacity: 0; }
}

@media (max-width: 992px) {
    .role-stats-wrapper {
        grid-template-columns: repeat(3, 1fr) !important;
        gap: 0.75rem !important;
    }
    .role-stats-wrapper .stat-card {
        padding: 0.75rem 0.75rem !important;
    }
    .role-stats-wrapper .stat-card .stat-info .stat-number {
        font-size: 1.25rem !important;
    }
    .role-stats-wrapper .stat-card .stat-icon-wrap {
        width: 36px !important;
        height: 36px !important;
        font-size: 0.9rem !important;
    }
    .role-table-wrap .table-toolbar {
        flex-direction: column;
        align-items: stretch;
    }
    .role-table-wrap .table-toolbar .search-box input {
        width: 100%;
    }
    .role-table-wrap .table-toolbar .toolbar-right {
        justify-content: space-between;
    }
    .toast-container {
        max-width: 90%;
        right: 10px;
        top: 70px;
    }
}

@media (max-width: 768px) {
    .role-stats-wrapper {
        grid-template-columns: repeat(3, 1fr) !important;
        gap: 0.5rem !important;
    }
    .role-stats-wrapper .stat-card {
        padding: 0.5rem 0.5rem !important;
        gap: 0.5rem !important;
    }
    .role-stats-wrapper .stat-card .stat-info .stat-number {
        font-size: 1rem !important;
    }
    .role-stats-wrapper .stat-card .stat-info .stat-label {
        font-size: 0.55rem !important;
        letter-spacing: 0.02em !important;
    }
    .role-stats-wrapper .stat-card .stat-icon-wrap {
        width: 28px !important;
        height: 28px !important;
        font-size: 0.7rem !important;
        border-radius: 6px !important;
    }
    .role-action-bar {
        flex-direction: column;
        align-items: stretch;
    }
    .role-action-bar .btn-group {
        flex-wrap: wrap;
    }
    .role-table-wrap .table-footer {
        flex-direction: column;
        align-items: center;
        text-align: center;
    }
    .toast-container {
        max-width: 95%;
        right: 5px;
        top: 60px;
    }
    .toast {
        min-width: auto;
        padding: 0.75rem 1rem;
    }
}

@media (max-width: 576px) {
    .role-stats-wrapper {
        grid-template-columns: repeat(3, 1fr) !important;
        gap: 0.35rem !important;
    }
    .role-stats-wrapper .stat-card {
        padding: 0.4rem 0.4rem !important;
        gap: 0.35rem !important;
        border-radius: 6px !important;
    }
    .role-stats-wrapper .stat-card .stat-info .stat-number {
        font-size: 0.85rem !important;
    }
    .role-stats-wrapper .stat-card .stat-info .stat-label {
        font-size: 0.45rem !important;
        letter-spacing: 0.02em !important;
        white-space: nowrap !important;
    }
    .role-stats-wrapper .stat-card .stat-icon-wrap {
        width: 22px !important;
        height: 22px !important;
        font-size: 0.55rem !important;
        border-radius: 4px !important;
    }
    .role-table-wrap .table-toolbar .toolbar-right {
        flex-wrap: wrap;
    }
    .role-table-wrap .table-toolbar .per-page {
        flex: 1;
    }
}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Stats Cards -->
<div class="role-stats-wrapper">
    <div class="stat-card">
        <div class="stat-icon-wrap purple">
            <i class="fas fa-user-tag"></i>
        </div>
        <div class="stat-info">
            <div class="stat-number" id="statTotal"><?= $total_roles ?? 0 ?></div>
            <div class="stat-label">Total Roles</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon-wrap green">
            <i class="fas fa-check-circle"></i>
        </div>
        <div class="stat-info">
            <div class="stat-number" id="statActive"><?= $active_roles ?? 0 ?></div>
            <div class="stat-label">Active Roles</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon-wrap red">
            <i class="fas fa-times-circle"></i>
        </div>
        <div class="stat-info">
            <div class="stat-number" id="statInactive"><?= ($total_roles ?? 0) - ($active_roles ?? 0) ?></div>
            <div class="stat-label">Inactive Roles</div>
        </div>
    </div>
</div>

<!-- Action Bar -->
<div class="role-action-bar">
    <div class="btn-group">
        <a href="<?= base_url('admin/roles/create') ?>" class="btn-primary">
            <i class="fas fa-plus"></i> Add Role
        </a>
    </div>
</div>

<!-- Table -->
<div class="role-table-wrap">
    <div class="table-toolbar">
        <div class="search-box">
            <i class="fas fa-search"></i>
            <input type="text" id="dtSearch" placeholder="Search roles...">
        </div>
        <div class="toolbar-right">
            <div class="per-page">
                <label>Show</label>
                <select id="dtPerPage">
                    <option value="10">10</option>
                    <option value="25" selected>25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
                <label>entries</label>
            </div>
            <button class="refresh-btn" onclick="refreshTable()" title="Refresh">
                <i class="fas fa-sync-alt"></i>
            </button>
        </div>
    </div>

    <div class="table-scroll">
        <table id="rolesTable">
            <thead>
                <tr>
                    <th data-sort="role_id" style="width: 50px;"># <span class="sort">⇅</span></th>
                    <th data-sort="name">Role <span class="sort">⇅</span></th>
                    <th data-sort="slug">Slug <span class="sort">⇅</span></th>
                    <th data-sort="description">Description <span class="sort">⇅</span></th>
                    <th style="text-align: center;">System</th>
                    <th data-sort="is_active" style="text-align: center;">Status <span class="sort">⇅</span></th>
                    <th style="text-align: center; width: 180px;">Actions</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                <!-- Data loaded via AJAX -->
            </tbody>
        </table>
    </div>

    <div class="table-footer">
        <div class="info-text">
            Showing <span id="dtStart">0</span> to <span id="dtEnd">0</span> of <span id="dtTotal">0</span> entries
        </div>
        <div class="pagination" id="dtPagination">
            <!-- Pagination buttons rendered by JS -->
        </div>
    </div>
</div>

<!-- Toast Container -->
<div class="toast-container" id="toastContainer"></div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
// ============================================================
// TOAST NOTIFICATIONS
// ============================================================
function showToast(message, title = '', type = 'success', duration = 4000) {
    const container = document.getElementById('toastContainer');
    
    const icons = {
        success: 'fa-check-circle',
        error: 'fa-exclamation-circle',
        warning: 'fa-exclamation-triangle',
        info: 'fa-info-circle'
    };
    
    const titles = {
        success: title || 'Success',
        error: title || 'Error',
        warning: title || 'Warning',
        info: title || 'Information'
    };
    
    const toast = document.createElement('div');
    toast.className = `toast ${type}`;
    toast.innerHTML = `
        <div class="toast-icon">
            <i class="fas ${icons[type] || icons.info}"></i>
        </div>
        <div class="toast-content">
            <div class="toast-title">${titles[type]}</div>
            <div class="toast-message">${message}</div>
        </div>
        <button class="toast-close" onclick="this.closest('.toast').remove()">
            <i class="fas fa-times"></i>
        </button>
    `;
    
    container.appendChild(toast);
    
    setTimeout(() => {
        if (toast.parentNode) {
            toast.classList.add('hiding');
            setTimeout(() => {
                if (toast.parentNode) {
                    toast.remove();
                }
            }, 400);
        }
    }, duration);
    
    toast.addEventListener('click', function(e) {
        if (e.target.closest('.toast-close')) return;
        toast.classList.add('hiding');
        setTimeout(() => {
            if (toast.parentNode) {
                toast.remove();
            }
        }, 400);
    });
    
    return toast;
}

// ============================================================
// CSRF token management
// ============================================================
const csrfName = '<?= csrf_token() ?>';
let csrfHash = '<?= csrf_hash() ?>';

function updateCsrfToken(newToken) {
    if (newToken) {
        csrfHash = newToken;
    }
}

// ============================================================
// DATATABLE
// ============================================================
let currentPage = 1;
let perPage = 25;
let searchQuery = '';
let sortField = 'role_id';
let sortDirection = 'asc';
let totalRecords = 0;

function loadTableData() {
    const params = new URLSearchParams({
        page: currentPage,
        per_page: perPage,
        search: searchQuery,
        sort: sortField,
        direction: sortDirection
    });

    fetch('<?= base_url('admin/roles/getData') ?>?' + params.toString(), {
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                renderTable(data.data);
                updatePagination(data.pagination);
                updateInfo(data.pagination);
                if (data.csrf_token) {
                    updateCsrfToken(data.csrf_token);
                }
            }
        })
        .catch(error => console.error('Error loading table data:', error));
}

function renderTable(roles) {
    const tbody = document.getElementById('tableBody');
    
    if (!tbody) return;
    
    if (!roles || roles.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td colspan="7">
                    <div class="role-empty">
                        <i class="fas fa-inbox"></i>
                        No roles found.
                    </div>
                </td>
            </tr>
        `;
        return;
    }

    let html = '';
    roles.forEach((role, index) => {
        const startIndex = (currentPage - 1) * perPage;
        const rowNum = startIndex + index + 1;
        const statusClass = role.is_active ? 'active' : 'inactive';
        const statusText = role.is_active ? 'Active' : 'Inactive';
        const eyeIcon = role.is_active ? 'fa-eye' : 'fa-eye-slash';
        const isSystem = role.is_system == 1 ? 'Yes' : 'No';

        html += `
            <tr data-id="${role.role_id}">
                <td style="color: var(--ink-muted);">${rowNum}</td>
                <td>
                    <div class="role-name">
                        <div>
                            <div class="name-text" style="font-weight: 600; color: var(--ink);">${escapeHtml(role.name)}</div>
                        </div>
                    </div>
                </td>
                <td class="slug-text" style="color: var(--ink-muted); font-family: monospace; font-size: 0.75rem;">${escapeHtml(role.slug)}</td>
                <td class="desc-text" style="color: var(--ink-muted); font-size: 0.78rem; max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">${escapeHtml(role.description || '-')}</td>
                <td style="text-align: center;">
                    <span class="system-badge">${isSystem}</span>
                </td>
                <td style="text-align: center;">
                    <span class="status-badge ${statusClass}">${statusText}</span>
                </td>
                <td style="text-align: center;">
                    <div class="action-group">
                        <!-- Permission Button - Links to dedicated permissions page -->
                        <a href="<?= base_url('admin/roles/permissions') ?>/${role.role_id}" class="act-btn purple" title="Set Permissions">
                            <i class="fas fa-key"></i>
                        </a>
                        <button onclick="viewRole(${role.role_id})" class="act-btn" title="View">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button onclick="editRole(${role.role_id})" class="act-btn primary" title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>
                        ${role.is_system == 1 ? '' : `
                            <button onclick="toggleStatus(${role.role_id})" class="act-btn" title="Toggle Status">
                                <i class="fas ${eyeIcon}"></i>
                            </button>
                            <button onclick="deleteRole(${role.role_id})" class="act-btn danger" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        `}
                    </div>
                </td>
            </tr>
        `;
    });

    tbody.innerHTML = html;
}

function updatePagination(pagination) {
    totalRecords = pagination.total;
    const totalPages = pagination.last_page;
    const current = pagination.current_page;

    const container = document.getElementById('dtPagination');
    if (!container) return;
    
    let html = '';

    html += `<button onclick="goToPage(${current - 1})" ${current <= 1 ? 'disabled' : ''}>
        <i class="fas fa-chevron-left"></i>
    </button>`;

    let startPage = Math.max(1, current - 2);
    let endPage = Math.min(totalPages, current + 2);

    if (startPage > 1) {
        html += `<button onclick="goToPage(1)">1</button>`;
        if (startPage > 2) html += `<button disabled>...</button>`;
    }

    for (let i = startPage; i <= endPage; i++) {
        html += `<button onclick="goToPage(${i})" class="${i === current ? 'active' : ''}">${i}</button>`;
    }

    if (endPage < totalPages) {
        if (endPage < totalPages - 1) html += `<button disabled>...</button>`;
        html += `<button onclick="goToPage(${totalPages})">${totalPages}</button>`;
    }

    html += `<button onclick="goToPage(${current + 1})" ${current >= totalPages ? 'disabled' : ''}>
        <i class="fas fa-chevron-right"></i>
    </button>`;

    container.innerHTML = html;
}

function updateInfo(pagination) {
    const startEl = document.getElementById('dtStart');
    const endEl = document.getElementById('dtEnd');
    const totalEl = document.getElementById('dtTotal');
    
    if (startEl) startEl.textContent = pagination.from || 0;
    if (endEl) endEl.textContent = pagination.to || 0;
    if (totalEl) totalEl.textContent = pagination.total || 0;
}

function goToPage(page) {
    if (page < 1) return;
    const totalPages = Math.ceil(totalRecords / perPage);
    if (page > totalPages) return;
    currentPage = page;
    loadTableData();
}

document.getElementById('dtSearch')?.addEventListener('input', function() {
    searchQuery = this.value;
    currentPage = 1;
    loadTableData();
});

document.getElementById('dtPerPage')?.addEventListener('change', function() {
    perPage = parseInt(this.value);
    currentPage = 1;
    loadTableData();
});

document.querySelectorAll('#rolesTable th[data-sort]').forEach(th => {
    th.addEventListener('click', function() {
        const field = this.dataset.sort;
        if (sortField === field) {
            sortDirection = sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            sortField = field;
            sortDirection = 'asc';
        }
        document.querySelectorAll('#rolesTable th[data-sort]').forEach(h => {
            h.classList.remove('active-sort');
        });
        this.classList.add('active-sort');
        currentPage = 1;
        loadTableData();
    });
});

function refreshTable() { loadTableData(); }

function escapeHtml(text) {
    if (!text) return '';
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

// ============================================================
// ROLE ACTIONS
// ============================================================
function viewRole(id) {
    showToast('View role functionality coming soon', 'Info', 'info');
}

function editRole(id) {
    window.location.href = '<?= base_url('admin/roles/edit') ?>/' + id;
}

function toggleStatus(id) {
    if (confirm('Are you sure you want to toggle this role\'s status?')) {
        const formData = new FormData();
        formData.set(csrfName, csrfHash);

        fetch('<?= base_url('admin/roles/toggle-status') ?>/' + id, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                if (data.csrf_token) {
                    updateCsrfToken(data.csrf_token);
                }
                loadTableData();
                updateStats();
                showToast(data.message || 'Status updated!', 'Success', 'success');
            } else {
                showToast(data.message || 'Failed to update status', 'Error', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('An error occurred while updating the status.', 'Error', 'error');
        });
    }
}

function deleteRole(id) {
    if (confirm('Are you sure you want to delete this role? This action cannot be undone.')) {
        const formData = new FormData();
        formData.set(csrfName, csrfHash);

        fetch('<?= base_url('admin/roles/delete') ?>/' + id, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                if (data.csrf_token) {
                    updateCsrfToken(data.csrf_token);
                }
                loadTableData();
                updateStats();
                showToast(data.message || 'Role deleted!', 'Success', 'success');
            } else {
                showToast(data.message || 'Failed to delete role', 'Error', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('An error occurred while deleting the role.', 'Error', 'error');
        });
    }
}

// ============================================================
// UPDATE STATS
// ============================================================
function updateStats() {
    fetch('<?= base_url('admin/roles/getStats') ?>', {
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            if (data.csrf_token) {
                updateCsrfToken(data.csrf_token);
            }
            const stats = data.data;
            const totalEl = document.getElementById('statTotal');
            const activeEl = document.getElementById('statActive');
            const inactiveEl = document.getElementById('statInactive');
            
            if (totalEl) totalEl.textContent = stats.total || 0;
            if (activeEl) activeEl.textContent = stats.active || 0;
            if (inactiveEl) inactiveEl.textContent = (stats.total || 0) - (stats.active || 0);
        }
    })
    .catch(error => console.error('Error updating stats:', error));
}

// ============================================================
// INITIALIZE
// ============================================================
document.addEventListener('DOMContentLoaded', function() {
    loadTableData();
});
</script>
<?= $this->endSection() ?>