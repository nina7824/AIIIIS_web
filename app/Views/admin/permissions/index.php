<?= $this->extend('admin/layout') ?>

<?= $this->section('styles') ?>
<style>
/* ============================================================
   PERMISSION MANAGEMENT - STYLES
   ============================================================ */

/* ---------- STATS CARDS - GRID LAYOUT ---------- */
.permission-stats-wrapper {
    display: grid !important;
    grid-template-columns: repeat(3, 1fr) !important;
    gap: 1rem !important;
    margin-bottom: 1.5rem !important;
    width: 100% !important;
}

.permission-stats-wrapper .stat-card {
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

.permission-stats-wrapper .stat-card:hover {
    border-color: var(--primary);
    box-shadow: 0 4px 12px rgba(0,0,0,0.06);
    transform: translateY(-1px);
}

.permission-stats-wrapper .stat-card .stat-icon-wrap {
    width: 44px;
    height: 44px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.1rem;
    flex-shrink: 0;
}

.permission-stats-wrapper .stat-card .stat-icon-wrap.purple {
    background: #ede9fe;
    color: #7c3aed;
}
.permission-stats-wrapper .stat-card .stat-icon-wrap.green {
    background: #d1fae5;
    color: #059669;
}
.permission-stats-wrapper .stat-card .stat-icon-wrap.red {
    background: #fee2e2;
    color: #dc2626;
}

[data-theme="dark"] .permission-stats-wrapper .stat-card .stat-icon-wrap.purple {
    background: #2d1b4a;
    color: #a78bfa;
}
[data-theme="dark"] .permission-stats-wrapper .stat-card .stat-icon-wrap.green {
    background: #1a3a2a;
    color: #34d399;
}
[data-theme="dark"] .permission-stats-wrapper .stat-card .stat-icon-wrap.red {
    background: #3a1a1a;
    color: #f87171;
}

.permission-stats-wrapper .stat-card .stat-info {
    flex: 1;
    min-width: 0;
    overflow: hidden;
}

.permission-stats-wrapper .stat-card .stat-info .stat-number {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--ink);
    line-height: 1.2;
    letter-spacing: -0.02em;
}

.permission-stats-wrapper .stat-card .stat-info .stat-label {
    font-size: 0.7rem;
    font-weight: 500;
    color: var(--ink-muted);
    text-transform: uppercase;
    letter-spacing: 0.04em;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

/* ---------- ACTION BAR ---------- */
.permission-action-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
    flex-wrap: wrap;
    gap: 0.5rem;
}

.permission-action-bar .btn-group {
    display: flex;
    gap: 0.5rem;
}

.permission-action-bar .btn-primary {
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

.permission-action-bar .btn-primary:hover {
    background: var(--primary-dark);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(7, 142, 206, 0.3);
}

/* ---------- DATATABLE ---------- */
.permission-table-wrap {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 10px;
    overflow: hidden;
}

.permission-table-wrap .table-toolbar {
    padding: 0.75rem 1.25rem;
    border-bottom: 1px solid var(--border);
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 0.75rem;
}

.permission-table-wrap .table-toolbar .search-box {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    background: var(--canvas);
    border: 1px solid var(--border);
    border-radius: 8px;
    padding: 0.3rem 0.75rem;
    transition: all 0.2s ease;
}

.permission-table-wrap .table-toolbar .search-box:focus-within {
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(7, 142, 206, 0.1);
}

.permission-table-wrap .table-toolbar .search-box i {
    color: var(--ink-muted);
    font-size: 0.8rem;
}

.permission-table-wrap .table-toolbar .search-box input {
    border: none;
    background: transparent;
    padding: 0.4rem 0.25rem;
    font-size: 0.8rem;
    color: var(--ink);
    width: 200px;
    outline: none;
    font-family: 'Inter', sans-serif;
}

.permission-table-wrap .table-toolbar .search-box input::placeholder {
    color: var(--ink-muted);
}

.permission-table-wrap .table-toolbar .toolbar-right {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.permission-table-wrap .table-toolbar .per-page {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.78rem;
    color: var(--ink-muted);
}

.permission-table-wrap .table-toolbar .per-page select {
    padding: 0.25rem 0.5rem;
    border: 1px solid var(--border);
    border-radius: 6px;
    background: var(--surface);
    color: var(--ink);
    font-size: 0.78rem;
    cursor: pointer;
    font-family: 'Inter', sans-serif;
}

.permission-table-wrap .table-toolbar .refresh-btn {
    padding: 0.3rem 0.7rem;
    border: 1px solid var(--border);
    border-radius: 6px;
    background: var(--surface);
    color: var(--ink-muted);
    cursor: pointer;
    transition: all 0.2s ease;
    font-size: 0.78rem;
}

.permission-table-wrap .table-toolbar .refresh-btn:hover {
    background: var(--canvas);
    color: var(--ink);
}

/* Table */
.permission-table-wrap .table-scroll {
    overflow-x: auto;
}

.permission-table-wrap table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.85rem;
}

.permission-table-wrap table thead {
    background: var(--canvas);
}

.permission-table-wrap table th {
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

.permission-table-wrap table th .sort {
    margin-left: 0.25rem;
    opacity: 0.3;
    font-size: 0.55rem;
}

.permission-table-wrap table th.active-sort .sort {
    opacity: 1;
    color: var(--primary);
}

.permission-table-wrap table td {
    padding: 0.6rem 1.25rem;
    border-bottom: 1px solid var(--border);
    vertical-align: middle;
}

.permission-table-wrap table tbody tr:hover {
    background: var(--surface-hover);
}

.permission-table-wrap table .permission-name {
    display: flex;
    align-items: center;
    gap: 0.65rem;
}

.permission-table-wrap table .permission-name .icon-box {
    width: 34px;
    height: 34px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.9rem;
    background: var(--primary-light);
    color: var(--primary);
    flex-shrink: 0;
}

.permission-table-wrap table .permission-name .name-text {
    font-weight: 600;
    color: var(--ink);
}

.permission-table-wrap table .module-badge {
    display: inline-block;
    background: var(--primary-light);
    color: var(--primary);
    padding: 0.1rem 0.6rem;
    border-radius: 12px;
    font-size: 0.65rem;
    font-weight: 500;
}

.permission-table-wrap table .slug-text {
    color: var(--ink-muted);
    font-family: monospace;
    font-size: 0.75rem;
}

.permission-table-wrap table .desc-text {
    color: var(--ink-muted);
    font-size: 0.78rem;
    max-width: 200px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.permission-table-wrap table .status-badge {
    display: inline-block;
    padding: 0.1rem 0.7rem;
    border-radius: 20px;
    font-size: 0.55rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.04em;
}

.permission-table-wrap table .status-badge.active {
    background: #d1fae5;
    color: #059669;
}
.permission-table-wrap table .status-badge.inactive {
    background: #fee2e2;
    color: #dc2626;
}

[data-theme="dark"] .permission-table-wrap table .status-badge.active {
    background: #1a3a2a;
    color: #34d399;
}
[data-theme="dark"] .permission-table-wrap table .status-badge.inactive {
    background: #3a1a1a;
    color: #f87171;
}

.permission-table-wrap table .action-group {
    display: flex;
    justify-content: center;
    gap: 0.15rem;
}

.permission-table-wrap table .action-group .act-btn {
    background: none;
    border: none;
    color: var(--ink-muted);
    padding: 0.25rem 0.4rem;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.2s ease;
}

.permission-table-wrap table .action-group .act-btn:hover {
    background: var(--canvas);
    color: var(--ink);
}

.permission-table-wrap table .action-group .act-btn.danger:hover {
    background: #fee2e2;
    color: #dc2626;
}

.permission-table-wrap table .action-group .act-btn.primary:hover {
    background: var(--primary-light);
    color: var(--primary);
}

/* Table Footer */
.permission-table-wrap .table-footer {
    padding: 0.6rem 1.25rem;
    border-top: 1px solid var(--border);
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 0.5rem;
}

.permission-table-wrap .table-footer .info-text {
    font-size: 0.78rem;
    color: var(--ink-muted);
}

.permission-table-wrap .table-footer .pagination {
    display: flex;
    gap: 0.25rem;
}

.permission-table-wrap .table-footer .pagination button {
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

.permission-table-wrap .table-footer .pagination button:hover:not(:disabled) {
    background: var(--canvas);
    color: var(--ink);
}

.permission-table-wrap .table-footer .pagination button.active {
    background: var(--primary);
    color: #fff;
    border-color: var(--primary);
}

.permission-table-wrap .table-footer .pagination button:disabled {
    opacity: 0.4;
    cursor: not-allowed;
}

/* Empty State */
.permission-empty {
    padding: 3rem;
    text-align: center;
    color: var(--ink-muted);
}

.permission-empty i {
    font-size: 2.5rem;
    display: block;
    margin-bottom: 0.75rem;
    opacity: 0.3;
}

/* ---------- MODALS ---------- */
.permission-modal {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.5);
    z-index: 9999;
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(4px);
    padding: 1rem;
}

.permission-modal.show {
    display: flex;
}

.permission-modal .modal-box {
    background: var(--surface);
    border-radius: 14px;
    padding: 2rem;
    max-width: 600px;
    width: 100%;
    max-height: 90vh;
    overflow-y: auto;
    box-shadow: 0 20px 60px rgba(0,0,0,0.2);
    animation: modalSlideIn 0.3s ease;
}

@keyframes modalSlideIn {
    from {
        opacity: 0;
        transform: translateY(-20px) scale(0.95);
    }
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

.permission-modal .modal-box .modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
    padding-bottom: 0.75rem;
    border-bottom: 1px solid var(--border);
}

.permission-modal .modal-box .modal-header h3 {
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--ink);
}

.permission-modal .modal-box .modal-header .modal-close {
    background: none;
    border: none;
    color: var(--ink-muted);
    font-size: 1.2rem;
    cursor: pointer;
    padding: 0.3rem;
    border-radius: 6px;
    transition: all 0.2s ease;
}

.permission-modal .modal-box .modal-header .modal-close:hover {
    background: var(--canvas);
    color: var(--ink);
}

.permission-modal .modal-box .form-group {
    margin-bottom: 1rem;
}

.permission-modal .modal-box .form-group label {
    display: block;
    font-size: 0.78rem;
    font-weight: 600;
    color: var(--ink);
    margin-bottom: 0.3rem;
}

.permission-modal .modal-box .form-group input,
.permission-modal .modal-box .form-group select,
.permission-modal .modal-box .form-group textarea {
    width: 100%;
    padding: 0.5rem 0.75rem;
    border: 1px solid var(--border);
    border-radius: 8px;
    background: var(--canvas);
    color: var(--ink);
    font-size: 0.85rem;
    font-family: 'Inter', sans-serif;
    transition: all 0.2s ease;
}

.permission-modal .modal-box .form-group input:focus,
.permission-modal .modal-box .form-group select:focus,
.permission-modal .modal-box .form-group textarea:focus {
    border-color: var(--primary);
    outline: none;
    box-shadow: 0 0 0 3px rgba(7, 142, 206, 0.1);
}

.permission-modal .modal-box .form-group textarea {
    resize: vertical;
    min-height: 80px;
}

.permission-modal .modal-box .form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
}

.permission-modal .modal-box .form-actions {
    display: flex;
    gap: 0.75rem;
    justify-content: flex-end;
    margin-top: 1.5rem;
    padding-top: 1rem;
    border-top: 1px solid var(--border);
}

.permission-modal .modal-box .form-actions .btn-primary {
    padding: 0.5rem 1.5rem;
    background: var(--primary);
    color: #fff;
    border: none;
    border-radius: 8px;
    font-size: 0.8rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s ease;
    font-family: 'Inter', sans-serif;
}

.permission-modal .modal-box .form-actions .btn-primary:hover {
    background: var(--primary-dark);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(7, 142, 206, 0.3);
}

.permission-modal .modal-box .form-actions .btn-secondary {
    padding: 0.5rem 1.5rem;
    background: transparent;
    color: var(--ink-muted);
    border: 1.5px solid var(--border);
    border-radius: 8px;
    font-size: 0.8rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s ease;
    font-family: 'Inter', sans-serif;
}

.permission-modal .modal-box .form-actions .btn-secondary:hover {
    border-color: var(--primary);
    color: var(--ink);
    background: var(--surface-hover);
}

.permission-modal .modal-box .form-actions .btn-danger {
    padding: 0.5rem 1.5rem;
    background: #dc2626;
    color: #fff;
    border: none;
    border-radius: 8px;
    font-size: 0.8rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s ease;
    font-family: 'Inter', sans-serif;
}

.permission-modal .modal-box .form-actions .btn-danger:hover {
    background: #b91c1c;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3);
}

/* ---------- TOAST NOTIFICATIONS ---------- */
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

.toast.success .toast-icon {
    color: #059669;
}

.toast.error {
    border-left-color: #dc2626;
}

.toast.error .toast-icon {
    color: #dc2626;
}

.toast.warning {
    border-left-color: #d97706;
}

.toast.warning .toast-icon {
    color: #d97706;
}

.toast.info {
    border-left-color: var(--primary);
}

.toast.info .toast-icon {
    color: var(--primary);
}

[data-theme="dark"] .toast {
    background: #1a1d27;
    border: 1px solid #2d3344;
}

@keyframes slideInRight {
    from {
        transform: translateX(100%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

@keyframes slideOutRight {
    from {
        transform: translateX(0);
        opacity: 1;
    }
    to {
        transform: translateX(100%);
        opacity: 0;
    }
}

/* ---------- RESPONSIVE ---------- */
@media (max-width: 992px) {
    .permission-stats-wrapper {
        grid-template-columns: repeat(3, 1fr) !important;
        gap: 0.75rem !important;
    }
    .permission-stats-wrapper .stat-card {
        padding: 0.75rem 0.75rem !important;
    }
    .permission-stats-wrapper .stat-card .stat-info .stat-number {
        font-size: 1.25rem !important;
    }
    .permission-stats-wrapper .stat-card .stat-icon-wrap {
        width: 36px !important;
        height: 36px !important;
        font-size: 0.9rem !important;
    }
    .permission-table-wrap .table-toolbar {
        flex-direction: column;
        align-items: stretch;
    }
    .permission-table-wrap .table-toolbar .search-box input {
        width: 100%;
    }
    .permission-table-wrap .table-toolbar .toolbar-right {
        justify-content: space-between;
    }
    .permission-modal .modal-box {
        max-width: 90%;
        margin: 1rem;
    }
    .toast-container {
        max-width: 90%;
        right: 10px;
        top: 70px;
    }
}

@media (max-width: 768px) {
    .permission-stats-wrapper {
        grid-template-columns: repeat(3, 1fr) !important;
        gap: 0.5rem !important;
    }
    .permission-stats-wrapper .stat-card {
        padding: 0.5rem 0.5rem !important;
        gap: 0.5rem !important;
    }
    .permission-stats-wrapper .stat-card .stat-info .stat-number {
        font-size: 1rem !important;
    }
    .permission-stats-wrapper .stat-card .stat-info .stat-label {
        font-size: 0.55rem !important;
        letter-spacing: 0.02em !important;
    }
    .permission-stats-wrapper .stat-card .stat-icon-wrap {
        width: 28px !important;
        height: 28px !important;
        font-size: 0.7rem !important;
        border-radius: 6px !important;
    }
    .permission-action-bar {
        flex-direction: column;
        align-items: stretch;
    }
    .permission-action-bar .btn-group {
        flex-wrap: wrap;
    }
    .permission-table-wrap .table-footer {
        flex-direction: column;
        align-items: center;
        text-align: center;
    }
    .permission-table-wrap table .desc-text {
        max-width: 100px;
    }
    .permission-modal .modal-box .form-row {
        grid-template-columns: 1fr;
    }
    .permission-modal .modal-box {
        padding: 1.25rem;
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
    .permission-stats-wrapper {
        grid-template-columns: repeat(3, 1fr) !important;
        gap: 0.35rem !important;
    }
    .permission-stats-wrapper .stat-card {
        padding: 0.4rem 0.4rem !important;
        gap: 0.35rem !important;
        border-radius: 6px !important;
    }
    .permission-stats-wrapper .stat-card .stat-info .stat-number {
        font-size: 0.85rem !important;
    }
    .permission-stats-wrapper .stat-card .stat-info .stat-label {
        font-size: 0.45rem !important;
        letter-spacing: 0.02em !important;
        white-space: nowrap !important;
    }
    .permission-stats-wrapper .stat-card .stat-icon-wrap {
        width: 22px !important;
        height: 22px !important;
        font-size: 0.55rem !important;
        border-radius: 4px !important;
    }
    .permission-table-wrap .table-toolbar .toolbar-right {
        flex-wrap: wrap;
    }
    .permission-table-wrap .table-toolbar .per-page {
        flex: 1;
    }
    .permission-table-wrap table .desc-text {
        display: none;
    }
}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- ============================================================
     STATS CARDS - GRID LAYOUT (3 IN A ROW)
     ============================================================ -->
<div class="permission-stats-wrapper">
    <div class="stat-card">
        <div class="stat-icon-wrap purple">
            <i class="fas fa-lock"></i>
        </div>
        <div class="stat-info">
            <div class="stat-number" id="statTotal"><?= $total_permissions ?? 0 ?></div>
            <div class="stat-label">Total Permissions</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon-wrap green">
            <i class="fas fa-check-circle"></i>
        </div>
        <div class="stat-info">
            <div class="stat-number" id="statActive"><?= $active_permissions ?? 0 ?></div>
            <div class="stat-label">Active Permissions</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon-wrap red">
            <i class="fas fa-times-circle"></i>
        </div>
        <div class="stat-info">
            <div class="stat-number" id="statInactive"><?= ($total_permissions ?? 0) - ($active_permissions ?? 0) ?></div>
            <div class="stat-label">Inactive Permissions</div>
        </div>
    </div>
</div>

<!-- ============================================================
     ACTION BAR
     ============================================================ -->
<div class="permission-action-bar">
    <div class="btn-group">
        <button onclick="openAddModal()" class="btn-primary">
            <i class="fas fa-plus"></i> Add Permission
        </button>
    </div>
</div>

<!-- ============================================================
     DATATABLE
     ============================================================ -->
<div class="permission-table-wrap">
    <div class="table-toolbar">
        <div class="search-box">
            <i class="fas fa-search"></i>
            <input type="text" id="dtSearch" placeholder="Search permissions...">
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
        <table id="permissionsTable">
            <thead>
                <tr>
                    <th data-sort="permission_id" style="width: 50px;"># <span class="sort">⇅</span></th>
                    <th data-sort="name">Permission <span class="sort">⇅</span></th>
                    <th data-sort="slug">Slug <span class="sort">⇅</span></th>
                    <th data-sort="module">Module <span class="sort">⇅</span></th>
                    <th data-sort="description">Description <span class="sort">⇅</span></th>
                    <th data-sort="is_active" style="text-align: center;">Status <span class="sort">⇅</span></th>
                    <th style="text-align: center; width: 120px;">Actions</th>
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

<!-- ============================================================
     ADD/EDIT MODAL
     ============================================================ -->
<div class="permission-modal" id="permissionFormModal">
    <div class="modal-box">
        <div class="modal-header">
            <h3 id="formModalTitle">Add Permission</h3>
            <button class="modal-close" onclick="closeModal('permissionFormModal')">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <form id="permissionForm" onsubmit="savePermission(event)">
            <?= csrf_field() ?>
            <input type="hidden" id="formPermissionId" name="permission_id" value="">
            
            <div class="form-group">
                <label for="formName">Permission Name *</label>
                <input type="text" id="formName" name="name" placeholder="Enter permission name" required>
            </div>
            
            <div class="form-group">
                <label for="formSlug">Slug *</label>
                <input type="text" id="formSlug" name="slug" placeholder="Enter permission slug (e.g., users_manage)" required>
            </div>
            
            <div class="form-group">
                <label for="formModule">Module *</label>
                <select id="formModule" name="module" required>
                    <option value="">Select Module</option>
                    <?php foreach ($modules as $module): ?>
                        <option value="<?= $module['slug'] ?>"><?= $module['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="form-group">
                <label for="formDescription">Description</label>
                <textarea id="formDescription" name="description" placeholder="Enter permission description" rows="3"></textarea>
            </div>
            
            <div class="form-group">
                <label for="formStatus">Status</label>
                <select id="formStatus" name="is_active">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>
            
            <div class="form-actions">
                <button type="button" class="btn-secondary" onclick="closeModal('permissionFormModal')">Cancel</button>
                <button type="submit" class="btn-primary" id="formSubmitBtn">Save Permission</button>
            </div>
        </form>
    </div>
</div>

<!-- ============================================================
     VIEW MODAL
     ============================================================ -->
<div class="permission-modal" id="permissionViewModal">
    <div class="modal-box">
        <div class="modal-header">
            <h3>Permission Details</h3>
            <button class="modal-close" onclick="closeModal('permissionViewModal')">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div id="viewContent">
            <div class="view-field" style="display: flex; padding: 0.5rem 0; border-bottom: 1px solid var(--border-light);">
                <span style="font-weight: 600; color: var(--ink-muted); width: 120px; flex-shrink: 0; font-size: 0.78rem;">Permission Name</span>
                <span style="color: var(--ink); font-size: 0.85rem;" id="viewName">-</span>
            </div>
            <div class="view-field" style="display: flex; padding: 0.5rem 0; border-bottom: 1px solid var(--border-light);">
                <span style="font-weight: 600; color: var(--ink-muted); width: 120px; flex-shrink: 0; font-size: 0.78rem;">Slug</span>
                <span style="color: var(--ink); font-size: 0.85rem;" id="viewSlug">-</span>
            </div>
            <div class="view-field" style="display: flex; padding: 0.5rem 0; border-bottom: 1px solid var(--border-light);">
                <span style="font-weight: 600; color: var(--ink-muted); width: 120px; flex-shrink: 0; font-size: 0.78rem;">Module</span>
                <span style="color: var(--ink); font-size: 0.85rem;" id="viewModule">-</span>
            </div>
            <div class="view-field" style="display: flex; padding: 0.5rem 0; border-bottom: 1px solid var(--border-light);">
                <span style="font-weight: 600; color: var(--ink-muted); width: 120px; flex-shrink: 0; font-size: 0.78rem;">Description</span>
                <span style="color: var(--ink); font-size: 0.85rem;" id="viewDescription">-</span>
            </div>
            <div class="view-field" style="display: flex; padding: 0.5rem 0; border-bottom: 1px solid var(--border-light);">
                <span style="font-weight: 600; color: var(--ink-muted); width: 120px; flex-shrink: 0; font-size: 0.78rem;">Status</span>
                <span style="color: var(--ink); font-size: 0.85rem;" id="viewStatus">-</span>
            </div>
            <div class="view-field" style="display: flex; padding: 0.5rem 0; border-bottom: 1px solid var(--border-light);">
                <span style="font-weight: 600; color: var(--ink-muted); width: 120px; flex-shrink: 0; font-size: 0.78rem;">Created</span>
                <span style="color: var(--ink); font-size: 0.85rem;" id="viewCreated">-</span>
            </div>
            <div class="view-field" style="display: flex; padding: 0.5rem 0;">
                <span style="font-weight: 600; color: var(--ink-muted); width: 120px; flex-shrink: 0; font-size: 0.78rem;">Updated</span>
                <span style="color: var(--ink); font-size: 0.85rem;" id="viewUpdated">-</span>
            </div>
        </div>
        <div class="form-actions">
            <button type="button" class="btn-secondary" onclick="closeModal('permissionViewModal')">Close</button>
        </div>
    </div>
</div>

<!-- ============================================================
     DELETE CONFIRM MODAL
     ============================================================ -->
<div class="permission-modal" id="deleteModal">
    <div class="modal-box" style="max-width: 400px;">
        <div class="modal-header">
            <h3>Confirm Delete</h3>
            <button class="modal-close" onclick="closeModal('deleteModal')">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <?= csrf_field() ?>
        <input type="hidden" id="deletePermissionId" value="">
        <p style="color: var(--ink-muted); margin-bottom: 1.5rem; font-size: 0.9rem;">
            Are you sure you want to delete this permission? This action cannot be undone.
        </p>
        <div class="form-actions">
            <button type="button" class="btn-secondary" onclick="closeModal('deleteModal')">Cancel</button>
            <button type="button" class="btn-danger" onclick="confirmDeletePermission()">
                <i class="fas fa-trash"></i> Delete
            </button>
        </div>
    </div>
</div>

<!-- ============================================================
     TOAST CONTAINER
     ============================================================ -->
<div class="toast-container" id="toastContainer"></div>

<!-- ============================================================
     SCRIPTS
     ============================================================ -->
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

function getCsrfData() {
    return {
        [csrfName]: csrfHash
    };
}

function getCsrfHeaders() {
    return {
        'X-Requested-With': 'XMLHttpRequest',
        'X-CSRF-TOKEN': csrfHash
    };
}

function updateCsrfToken(newToken) {
    if (newToken) {
        csrfHash = newToken;
        document.querySelectorAll('input[name="' + csrfName + '"]').forEach(input => {
            input.value = newToken;
        });
    }
}

// ============================================================
// DATATABLE
// ============================================================
let currentPage = 1;
let perPage = 25;
let searchQuery = '';
let sortField = 'name';
let sortDirection = 'asc';
let totalRecords = 0;
let deleteId = null;

function loadTableData() {
    const params = new URLSearchParams({
        page: currentPage,
        per_page: perPage,
        search: searchQuery,
        sort: sortField,
        direction: sortDirection
    });

    fetch('<?= base_url('admin/permissions/getData') ?>?' + params.toString(), {
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

function renderTable(permissions) {
    const tbody = document.getElementById('tableBody');
    
    if (!permissions || permissions.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td colspan="7">
                    <div class="permission-empty">
                        <i class="fas fa-inbox"></i>
                        No permissions found. 
                        <button onclick="openAddModal()" style="color: var(--primary); background: none; border: none; cursor: pointer; font-family: 'Inter', sans-serif; font-size: 0.85rem;">Create your first permission</button>
                    </div>
                </td>
            </tr>
        `;
        return;
    }

    let html = '';
    permissions.forEach((permission, index) => {
        const startIndex = (currentPage - 1) * perPage;
        const rowNum = startIndex + index + 1;
        const statusClass = permission.is_active ? 'active' : 'inactive';
        const statusText = permission.is_active ? 'Active' : 'Inactive';
        const eyeIcon = permission.is_active ? 'fa-eye' : 'fa-eye-slash';

        html += `
            <tr data-id="${permission.permission_id}">
                <td style="color: var(--ink-muted);">${rowNum}</td>
                <td>
                    <div class="permission-name">
                        <div class="icon-box">
                            <i class="fas ${permission.module_icon || 'fa-key'}"></i>
                        </div>
                        <div>
                            <div class="name-text">${escapeHtml(permission.name)}</div>
                        </div>
                    </div>
                </td>
                <td class="slug-text">${escapeHtml(permission.slug)}</td>
                <td>
                    <span class="module-badge">${escapeHtml(permission.module_name || permission.module)}</span>
                </td>
                <td class="desc-text">${escapeHtml(permission.description || '-')}</td>
                <td style="text-align: center;">
                    <span class="status-badge ${statusClass}">${statusText}</span>
                </td>
                <td style="text-align: center;">
                    <div class="action-group">
                        <button onclick="viewPermission(${permission.permission_id})" class="act-btn" title="View">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button onclick="editPermission(${permission.permission_id})" class="act-btn primary" title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button onclick="toggleStatus(${permission.permission_id})" class="act-btn" title="Toggle Status">
                            <i class="fas ${eyeIcon}"></i>
                        </button>
                        <button onclick="openDeleteModal(${permission.permission_id})" class="act-btn danger" title="Delete">
                            <i class="fas fa-trash"></i>
                        </button>
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
    document.getElementById('dtStart').textContent = pagination.from || 0;
    document.getElementById('dtEnd').textContent = pagination.to || 0;
    document.getElementById('dtTotal').textContent = pagination.total || 0;
}

function goToPage(page) {
    if (page < 1) return;
    const totalPages = Math.ceil(totalRecords / perPage);
    if (page > totalPages) return;
    currentPage = page;
    loadTableData();
}

document.getElementById('dtSearch').addEventListener('input', function() {
    searchQuery = this.value;
    currentPage = 1;
    loadTableData();
});

document.getElementById('dtPerPage').addEventListener('change', function() {
    perPage = parseInt(this.value);
    currentPage = 1;
    loadTableData();
});

document.querySelectorAll('#permissionsTable th[data-sort]').forEach(th => {
    th.addEventListener('click', function() {
        const field = this.dataset.sort;
        if (sortField === field) {
            sortDirection = sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            sortField = field;
            sortDirection = 'asc';
        }
        document.querySelectorAll('#permissionsTable th[data-sort]').forEach(h => {
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
// MODAL HELPERS
// ============================================================
function openModal(id) {
    document.getElementById(id).classList.add('show');
    document.body.style.overflow = 'hidden';
}

function closeModal(id) {
    document.getElementById(id).classList.remove('show');
    document.body.style.overflow = '';
}

document.querySelectorAll('.permission-modal').forEach(modal => {
    modal.addEventListener('click', function(e) {
        if (e.target === this) {
            this.classList.remove('show');
            document.body.style.overflow = '';
        }
    });
});

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        document.querySelectorAll('.permission-modal.show').forEach(modal => {
            modal.classList.remove('show');
            document.body.style.overflow = '';
        });
    }
});

// ============================================================
// ADD PERMISSION
// ============================================================
function openAddModal() {
    document.getElementById('formPermissionId').value = '';
    document.getElementById('formName').value = '';
    document.getElementById('formSlug').value = '';
    document.getElementById('formModule').value = '';
    document.getElementById('formDescription').value = '';
    document.getElementById('formStatus').value = '1';
    document.getElementById('formModalTitle').textContent = 'Add Permission';
    document.getElementById('formSubmitBtn').textContent = 'Save Permission';
    openModal('permissionFormModal');
}

function editPermission(id) {
    fetch('<?= base_url('admin/permissions/get') ?>/' + id, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            const permission = data.data;
            document.getElementById('formPermissionId').value = permission.permission_id;
            document.getElementById('formName').value = permission.name;
            document.getElementById('formSlug').value = permission.slug;
            document.getElementById('formModule').value = permission.module;
            document.getElementById('formDescription').value = permission.description || '';
            document.getElementById('formStatus').value = permission.is_active ? '1' : '0';
            document.getElementById('formModalTitle').textContent = 'Edit Permission';
            document.getElementById('formSubmitBtn').textContent = 'Update Permission';
            if (data.csrf_token) {
                updateCsrfToken(data.csrf_token);
            }
            openModal('permissionFormModal');
        } else {
            showToast(data.message || 'Failed to load permission data', 'Error', 'error');
        }
    })
    .catch(error => {
        console.error('Error loading permission:', error);
        showToast('Error loading permission data', 'Error', 'error');
    });
}

function savePermission(event) {
    event.preventDefault();
    const form = document.getElementById('permissionForm');
    const formData = new FormData(form);
    const id = document.getElementById('formPermissionId').value;
    const url = id ? '<?= base_url('admin/permissions/update') ?>/' + id : '<?= base_url('admin/permissions/create') ?>';

    fetch(url, {
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
            closeModal('permissionFormModal');
            loadTableData();
            updateStats();
            showToast(data.message || 'Permission saved successfully!', 'Success', 'success');
        } else {
            showToast(data.message || 'Failed to save permission', 'Error', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('An error occurred while saving the permission.', 'Error', 'error');
    });
}

// ============================================================
// VIEW PERMISSION
// ============================================================
function viewPermission(id) {
    fetch('<?= base_url('admin/permissions/get') ?>/' + id, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            const permission = data.data;
            document.getElementById('viewName').textContent = permission.name;
            document.getElementById('viewSlug').textContent = permission.slug;
            document.getElementById('viewModule').textContent = permission.module;
            document.getElementById('viewDescription').textContent = permission.description || 'No description';
            document.getElementById('viewStatus').textContent = permission.is_active ? 'Active' : 'Inactive';
            document.getElementById('viewCreated').textContent = permission.created_at || '-';
            document.getElementById('viewUpdated').textContent = permission.updated_at || '-';
            if (data.csrf_token) {
                updateCsrfToken(data.csrf_token);
            }
            openModal('permissionViewModal');
        } else {
            showToast(data.message || 'Failed to load permission data', 'Error', 'error');
        }
    })
    .catch(error => {
        console.error('Error loading permission:', error);
        showToast('Error loading permission data', 'Error', 'error');
    });
}

// ============================================================
// STATUS TOGGLE
// ============================================================
function toggleStatus(id) {
    if (confirm('Are you sure you want to toggle the status of this permission?')) {
        const formData = new FormData();
        formData.set(csrfName, csrfHash);

        fetch('<?= base_url('admin/permissions/toggle-status') ?>/' + id, {
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
                showToast(data.message || 'Status updated successfully!', 'Success', 'success');
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

// ============================================================
// DELETE PERMISSION
// ============================================================
function openDeleteModal(id) {
    deleteId = id;
    document.getElementById('deletePermissionId').value = id;
    openModal('deleteModal');
}

function confirmDeletePermission() {
    if (!deleteId) return;
    const formData = new FormData();
    formData.set(csrfName, csrfHash);

    fetch('<?= base_url('admin/permissions/delete') ?>/' + deleteId, {
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
            closeModal('deleteModal');
            deleteId = null;
            loadTableData();
            updateStats();
            showToast(data.message || 'Permission deleted successfully!', 'Success', 'success');
        } else {
            showToast(data.message || 'Failed to delete permission', 'Error', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('An error occurred while deleting the permission.', 'Error', 'error');
    });
}

// ============================================================
// UPDATE STATS
// ============================================================
function updateStats() {
    fetch('<?= base_url('admin/permissions/getStats') ?>', {
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
                document.getElementById('statTotal').textContent = stats.total || 0;
                document.getElementById('statActive').textContent = stats.active || 0;
                document.getElementById('statInactive').textContent = (stats.total || 0) - (stats.active || 0);
            }
        })
        .catch(error => console.error('Error updating stats:', error));
}

// ============================================================
// INITIALIZE
// ============================================================
document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('#permissionsTable th[data-sort="name"]')?.classList.add('active-sort');
    loadTableData();
});
</script>

<?= $this->endSection() ?>