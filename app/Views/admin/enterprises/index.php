<?= $this->extend('admin/layout') ?>

<?= $this->section('styles') ?>
<style>
/* ============================================================
   ENTERPRISE MANAGEMENT - STYLES
   ============================================================ */

/* ---------- STATS CARDS ---------- */
.enterprise-stats-wrapper {
    display: grid !important;
    grid-template-columns: repeat(4, 1fr) !important;
    gap: 1rem !important;
    margin-bottom: 1.5rem !important;
    width: 100% !important;
}

.enterprise-stats-wrapper .stat-card {
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

.enterprise-stats-wrapper .stat-card:hover {
    border-color: var(--primary);
    box-shadow: 0 4px 12px rgba(0,0,0,0.06);
    transform: translateY(-1px);
}

.enterprise-stats-wrapper .stat-card .stat-icon-wrap {
    width: 44px;
    height: 44px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.1rem;
    flex-shrink: 0;
}

.enterprise-stats-wrapper .stat-card .stat-icon-wrap.blue {
    background: #dbeafe;
    color: #2563eb;
}
.enterprise-stats-wrapper .stat-card .stat-icon-wrap.green {
    background: #d1fae5;
    color: #059669;
}
.enterprise-stats-wrapper .stat-card .stat-icon-wrap.orange {
    background: #fef3c7;
    color: #d97706;
}
.enterprise-stats-wrapper .stat-card .stat-icon-wrap.red {
    background: #fee2e2;
    color: #dc2626;
}

[data-theme="dark"] .enterprise-stats-wrapper .stat-card .stat-icon-wrap.blue {
    background: #1e293b;
    color: #60a5fa;
}
[data-theme="dark"] .enterprise-stats-wrapper .stat-card .stat-icon-wrap.green {
    background: #1a3a2a;
    color: #34d399;
}
[data-theme="dark"] .enterprise-stats-wrapper .stat-card .stat-icon-wrap.orange {
    background: #3a2a1a;
    color: #fbbf24;
}
[data-theme="dark"] .enterprise-stats-wrapper .stat-card .stat-icon-wrap.red {
    background: #3a1a1a;
    color: #f87171;
}

.enterprise-stats-wrapper .stat-card .stat-info {
    flex: 1;
    min-width: 0;
    overflow: hidden;
}

.enterprise-stats-wrapper .stat-card .stat-info .stat-number {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--ink);
    line-height: 1.2;
    letter-spacing: -0.02em;
}

.enterprise-stats-wrapper .stat-card .stat-info .stat-label {
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
.enterprise-action-bar {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    margin-bottom: 1.5rem;
    flex-wrap: wrap;
    gap: 0.75rem;
    width: 100% !important;
}

.enterprise-action-bar .btn-group {
    display: flex;
    gap: 0.75rem;
}

.enterprise-action-bar .btn-primary {
    padding: 0.6rem 1.5rem;
    background: var(--primary);
    color: #fff;
    border: none;
    border-radius: 8px;
    font-size: 0.85rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s ease;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    font-family: 'Inter', sans-serif;
    box-shadow: 0 2px 4px rgba(7, 142, 206, 0.2);
}

.enterprise-action-bar .btn-primary:hover {
    background: var(--primary-dark);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(7, 142, 206, 0.35);
}

/* ---------- DATATABLE ---------- */
.enterprise-table-wrap {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 10px;
    overflow: hidden;
}

.enterprise-table-wrap .table-toolbar {
    padding: 0.75rem 1.25rem;
    border-bottom: 1px solid var(--border);
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 0.75rem;
}

.enterprise-table-wrap .table-toolbar .search-box {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    background: var(--canvas);
    border: 1px solid var(--border);
    border-radius: 8px;
    padding: 0.3rem 0.75rem;
    transition: all 0.2s ease;
}

.enterprise-table-wrap .table-toolbar .search-box:focus-within {
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(7, 142, 206, 0.1);
}

.enterprise-table-wrap .table-toolbar .search-box i {
    color: var(--ink-muted);
    font-size: 0.8rem;
}

.enterprise-table-wrap .table-toolbar .search-box input {
    border: none;
    background: transparent;
    padding: 0.4rem 0.25rem;
    font-size: 0.8rem;
    color: var(--ink);
    width: 200px;
    outline: none;
    font-family: 'Inter', sans-serif;
}

.enterprise-table-wrap .table-toolbar .search-box input::placeholder {
    color: var(--ink-muted);
}

.enterprise-table-wrap .table-toolbar .toolbar-right {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.enterprise-table-wrap .table-toolbar .per-page {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.78rem;
    color: var(--ink-muted);
}

.enterprise-table-wrap .table-toolbar .per-page select {
    padding: 0.25rem 0.5rem;
    border: 1px solid var(--border);
    border-radius: 6px;
    background: var(--surface);
    color: var(--ink);
    font-size: 0.78rem;
    cursor: pointer;
    font-family: 'Inter', sans-serif;
}

.enterprise-table-wrap .table-toolbar .refresh-btn {
    padding: 0.3rem 0.7rem;
    border: 1px solid var(--border);
    border-radius: 6px;
    background: var(--surface);
    color: var(--ink-muted);
    cursor: pointer;
    transition: all 0.2s ease;
    font-size: 0.78rem;
}

.enterprise-table-wrap .table-toolbar .refresh-btn:hover {
    background: var(--canvas);
    color: var(--ink);
}

/* Table */
.enterprise-table-wrap .table-scroll {
    overflow-x: auto;
}

.enterprise-table-wrap table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.85rem;
}

.enterprise-table-wrap table thead {
    background: var(--canvas);
}

.enterprise-table-wrap table th {
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

.enterprise-table-wrap table th .sort {
    margin-left: 0.25rem;
    opacity: 0.3;
    font-size: 0.55rem;
}

.enterprise-table-wrap table th.active-sort .sort {
    opacity: 1;
    color: var(--primary);
}

.enterprise-table-wrap table td {
    padding: 0.6rem 1.25rem;
    border-bottom: 1px solid var(--border);
    vertical-align: middle;
}

.enterprise-table-wrap table tbody tr:hover {
    background: var(--surface-hover);
}

.enterprise-table-wrap table .enterprise-name {
    display: flex;
    align-items: center;
    gap: 0.65rem;
}

.enterprise-table-wrap table .enterprise-name .icon-box {
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

.enterprise-table-wrap table .enterprise-name .name-text {
    font-weight: 600;
    color: var(--ink);
}

.enterprise-table-wrap table .enterprise-name .email-text {
    font-size: 0.7rem;
    color: var(--ink-muted);
}

.enterprise-table-wrap table .sector-badge {
    display: inline-block;
    background: var(--primary-light);
    color: var(--primary);
    padding: 0.1rem 0.6rem;
    border-radius: 12px;
    font-size: 0.65rem;
    font-weight: 500;
}

.enterprise-table-wrap table .cluster-badge {
    display: inline-block;
    background: #ede9fe;
    color: #7c3aed;
    padding: 0.1rem 0.6rem;
    border-radius: 12px;
    font-size: 0.65rem;
    font-weight: 500;
}

[data-theme="dark"] .enterprise-table-wrap table .cluster-badge {
    background: #2d1b4a;
    color: #a78bfa;
}

.enterprise-table-wrap table .status-badge {
    display: inline-block;
    padding: 0.1rem 0.7rem;
    border-radius: 20px;
    font-size: 0.55rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.04em;
}

.enterprise-table-wrap table .status-badge.active {
    background: #d1fae5;
    color: #059669;
}
.enterprise-table-wrap table .status-badge.inactive {
    background: #fee2e2;
    color: #dc2626;
}
.enterprise-table-wrap table .status-badge.verified {
    background: #dbeafe;
    color: #2563eb;
}
.enterprise-table-wrap table .status-badge.unverified {
    background: #fef3c7;
    color: #d97706;
}

[data-theme="dark"] .enterprise-table-wrap table .status-badge.active {
    background: #1a3a2a;
    color: #34d399;
}
[data-theme="dark"] .enterprise-table-wrap table .status-badge.inactive {
    background: #3a1a1a;
    color: #f87171;
}
[data-theme="dark"] .enterprise-table-wrap table .status-badge.verified {
    background: #1e293b;
    color: #60a5fa;
}
[data-theme="dark"] .enterprise-table-wrap table .status-badge.unverified {
    background: #3a2a1a;
    color: #fbbf24;
}

.enterprise-table-wrap table .action-group {
    display: flex;
    justify-content: center;
    gap: 0.15rem;
    flex-wrap: wrap;
}

.enterprise-table-wrap table .action-group .act-btn {
    background: none;
    border: none;
    color: var(--ink-muted);
    padding: 0.25rem 0.4rem;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.2s ease;
}

.enterprise-table-wrap table .action-group .act-btn:hover {
    background: var(--canvas);
    color: var(--ink);
}

.enterprise-table-wrap table .action-group .act-btn.danger:hover {
    background: #fee2e2;
    color: #dc2626;
}

.enterprise-table-wrap table .action-group .act-btn.primary:hover {
    background: var(--primary-light);
    color: var(--primary);
}

.enterprise-table-wrap table .action-group .act-btn.green:hover {
    background: #d1fae5;
    color: #059669;
}

/* Table Footer */
.enterprise-table-wrap .table-footer {
    padding: 0.6rem 1.25rem;
    border-top: 1px solid var(--border);
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 0.5rem;
}

.enterprise-table-wrap .table-footer .info-text {
    font-size: 0.78rem;
    color: var(--ink-muted);
}

.enterprise-table-wrap .table-footer .pagination {
    display: flex;
    gap: 0.25rem;
}

.enterprise-table-wrap .table-footer .pagination button {
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

.enterprise-table-wrap .table-footer .pagination button:hover:not(:disabled) {
    background: var(--canvas);
    color: var(--ink);
}

.enterprise-table-wrap .table-footer .pagination button.active {
    background: var(--primary);
    color: #fff;
    border-color: var(--primary);
}

.enterprise-table-wrap .table-footer .pagination button:disabled {
    opacity: 0.4;
    cursor: not-allowed;
}

/* Empty State */
.enterprise-empty {
    padding: 3rem;
    text-align: center;
    color: var(--ink-muted);
}

.enterprise-empty i {
    font-size: 2.5rem;
    display: block;
    margin-bottom: 0.75rem;
    opacity: 0.3;
}

/* ---------- MODALS ---------- */
.enterprise-modal {
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

.enterprise-modal.show {
    display: flex;
}

.enterprise-modal .modal-box {
    background: var(--surface);
    border-radius: 14px;
    padding: 2rem;
    max-width: 700px;
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

.enterprise-modal .modal-box .modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
    padding-bottom: 0.75rem;
    border-bottom: 1px solid var(--border);
}

.enterprise-modal .modal-box .modal-header h3 {
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--ink);
}

.enterprise-modal .modal-box .modal-header .modal-close {
    background: none;
    border: none;
    color: var(--ink-muted);
    font-size: 1.2rem;
    cursor: pointer;
    padding: 0.3rem;
    border-radius: 6px;
    transition: all 0.2s ease;
}

.enterprise-modal .modal-box .modal-header .modal-close:hover {
    background: var(--canvas);
    color: var(--ink);
}

.enterprise-modal .modal-box .form-group {
    margin-bottom: 1rem;
}

.enterprise-modal .modal-box .form-group label {
    display: block;
    font-size: 0.78rem;
    font-weight: 600;
    color: var(--ink);
    margin-bottom: 0.3rem;
}

.enterprise-modal .modal-box .form-group input,
.enterprise-modal .modal-box .form-group select,
.enterprise-modal .modal-box .form-group textarea {
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

.enterprise-modal .modal-box .form-group input:focus,
.enterprise-modal .modal-box .form-group select:focus,
.enterprise-modal .modal-box .form-group textarea:focus {
    border-color: var(--primary);
    outline: none;
    box-shadow: 0 0 0 3px rgba(7, 142, 206, 0.1);
}

.enterprise-modal .modal-box .form-group textarea {
    resize: vertical;
    min-height: 80px;
}

.enterprise-modal .modal-box .form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
}

.enterprise-modal .modal-box .form-actions {
    display: flex;
    gap: 0.75rem;
    justify-content: flex-end;
    margin-top: 1.5rem;
    padding-top: 1rem;
    border-top: 1px solid var(--border);
}

.enterprise-modal .modal-box .form-actions .btn-primary {
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

.enterprise-modal .modal-box .form-actions .btn-primary:hover {
    background: var(--primary-dark);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(7, 142, 206, 0.3);
}

.enterprise-modal .modal-box .form-actions .btn-secondary {
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

.enterprise-modal .modal-box .form-actions .btn-secondary:hover {
    border-color: var(--primary);
    color: var(--ink);
    background: var(--surface-hover);
}

.enterprise-modal .modal-box .form-actions .btn-danger {
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

.enterprise-modal .modal-box .form-actions .btn-danger:hover {
    background: #b91c1c;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3);
}

/* View Modal */
.enterprise-modal .modal-box .view-field {
    display: flex;
    padding: 0.5rem 0;
    border-bottom: 1px solid var(--border-light);
}

.enterprise-modal .modal-box .view-field:last-child {
    border-bottom: none;
}

.enterprise-modal .modal-box .view-field .view-label {
    font-weight: 600;
    color: var(--ink-muted);
    width: 140px;
    flex-shrink: 0;
    font-size: 0.78rem;
}

.enterprise-modal .modal-box .view-field .view-value {
    color: var(--ink);
    font-size: 0.85rem;
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

/* ---------- RESPONSIVE ---------- */
@media (max-width: 992px) {
    .enterprise-stats-wrapper {
        grid-template-columns: repeat(2, 1fr) !important;
    }
    .enterprise-table-wrap .table-toolbar {
        flex-direction: column;
        align-items: stretch;
    }
    .enterprise-table-wrap .table-toolbar .search-box input {
        width: 100%;
    }
    .enterprise-table-wrap .table-toolbar .toolbar-right {
        justify-content: space-between;
    }
    .enterprise-modal .modal-box {
        max-width: 95%;
        margin: 1rem;
    }
    .toast-container {
        max-width: 90%;
        right: 10px;
        top: 70px;
    }
}

@media (max-width: 768px) {
    .enterprise-stats-wrapper {
        grid-template-columns: 1fr !important;
    }
    .enterprise-action-bar {
        flex-direction: column;
        align-items: stretch;
    }
    .enterprise-action-bar .btn-group {
        flex-wrap: wrap;
        justify-content: stretch;
    }
    .enterprise-action-bar .btn-primary {
        width: 100%;
        justify-content: center;
    }
    .enterprise-table-wrap .table-footer {
        flex-direction: column;
        align-items: center;
        text-align: center;
    }
    .enterprise-modal .modal-box .form-row {
        grid-template-columns: 1fr;
    }
    .enterprise-modal .modal-box .view-field {
        flex-direction: column;
    }
    .enterprise-modal .modal-box .view-field .view-label {
        width: 100%;
        margin-bottom: 0.2rem;
    }
    .enterprise-modal .modal-box {
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
    .enterprise-stats-wrapper .stat-card {
        padding: 0.75rem !important;
    }
    .enterprise-stats-wrapper .stat-card .stat-info .stat-number {
        font-size: 1.25rem !important;
    }
    .enterprise-stats-wrapper .stat-card .stat-icon-wrap {
        width: 36px !important;
        height: 36px !important;
        font-size: 0.9rem !important;
    }
    .enterprise-table-wrap .table-toolbar .toolbar-right {
        flex-wrap: wrap;
    }
    .enterprise-table-wrap .table-toolbar .per-page {
        flex: 1;
    }
}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- ============================================================
     STATS CARDS
     ============================================================ -->
<div class="enterprise-stats-wrapper">
    <div class="stat-card">
        <div class="stat-icon-wrap blue">
            <i class="fas fa-building"></i>
        </div>
        <div class="stat-info">
            <div class="stat-number" id="statTotal"><?= $total_enterprises ?? 0 ?></div>
            <div class="stat-label">Total Enterprises</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon-wrap green">
            <i class="fas fa-check-circle"></i>
        </div>
        <div class="stat-info">
            <div class="stat-number" id="statActive"><?= $active_enterprises ?? 0 ?></div>
            <div class="stat-label">Active Enterprises</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon-wrap orange">
            <i class="fas fa-clock"></i>
        </div>
        <div class="stat-info">
            <div class="stat-number" id="statPending"><?= $pending_verifications ?? 0 ?></div>
            <div class="stat-label">Pending Verification</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon-wrap red">
            <i class="fas fa-times-circle"></i>
        </div>
        <div class="stat-info">
            <div class="stat-number" id="statInactive"><?= ($total_enterprises ?? 0) - ($active_enterprises ?? 0) ?></div>
            <div class="stat-label">Inactive Enterprises</div>
        </div>
    </div>
</div>

<!-- ============================================================
     ACTION BAR
     ============================================================ -->
<div class="enterprise-action-bar">
    <div class="btn-group">
        <button onclick="openAddEnterpriseModal()" class="btn-primary">
            <i class="fas fa-plus"></i> Add Enterprise
        </button>
    </div>
</div>

<!-- ============================================================
     DATATABLE
     ============================================================ -->
<div class="enterprise-table-wrap">
    <div class="table-toolbar">
        <div class="search-box">
            <i class="fas fa-search"></i>
            <input type="text" id="dtSearch" placeholder="Search enterprises...">
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
        <table id="enterprisesTable">
            <thead>
                <tr>
                    <th data-sort="enterprise_id" style="width: 50px;"># <span class="sort">⇅</span></th>
                    <th data-sort="enterprise_name">Enterprise <span class="sort">⇅</span></th>
                    <th data-sort="email">Email <span class="sort">⇅</span></th>
                    <th data-sort="location">Location <span class="sort">⇅</span></th>
                    <th>Sector</th>
                    <th style="text-align: center;">Clusters</th>
                    <th data-sort="is_active" style="text-align: center;">Status <span class="sort">⇅</span></th>
                    <th style="text-align: center; width: 200px;">Actions</th>
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
     ADD/EDIT ENTERPRISE MODAL
     ============================================================ -->
<div class="enterprise-modal" id="enterpriseFormModal">
    <div class="modal-box">
        <div class="modal-header">
            <h3 id="formModalTitle">Add Enterprise</h3>
            <button class="modal-close" onclick="closeModal('enterpriseFormModal')">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <form id="enterpriseForm" onsubmit="saveEnterprise(event)">
            <?= csrf_field() ?>
            <input type="hidden" id="formEnterpriseId" name="enterprise_id" value="">
            
            <div class="form-group">
                <label for="formEnterpriseName">Enterprise Name *</label>
                <input type="text" id="formEnterpriseName" name="enterprise_name" placeholder="Enter enterprise name" required>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="formEmail">Email *</label>
                    <input type="email" id="formEmail" name="email" placeholder="Enter email" required>
                </div>
                <div class="form-group">
                    <label for="formPhone">Phone</label>
                    <input type="text" id="formPhone" name="phone" placeholder="Enter phone number">
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="formLocation">Location</label>
                    <input type="text" id="formLocation" name="location" placeholder="Enter location">
                </div>
                <div class="form-group">
                    <label for="formSector">Sector</label>
                    <select id="formSector" name="sector_id">
                        <option value="">Select Sector</option>
                    </select>
                </div>
            </div>
            
            <div class="form-group">
                <label for="formDescription">Description</label>
                <textarea id="formDescription" name="description" placeholder="Enter enterprise description" rows="3"></textarea>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="formWebsite">Website</label>
                    <input type="url" id="formWebsite" name="website" placeholder="https://example.com">
                </div>
                <div class="form-group">
                    <label for="formUser">Associated User</label>
                    <select id="formUser" name="user_id">
                        <option value="">Select User</option>
                    </select>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="formStatus">Status</label>
                    <select id="formStatus" name="is_active">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="formVerified">Verification</label>
                    <select id="formVerified" name="is_verified">
                        <option value="0">Unverified</option>
                        <option value="1">Verified</option>
                    </select>
                </div>
            </div>
            
            <div class="form-actions">
                <button type="button" class="btn-secondary" onclick="closeModal('enterpriseFormModal')">Cancel</button>
                <button type="submit" class="btn-primary" id="formSubmitBtn">Save Enterprise</button>
            </div>
        </form>
    </div>
</div>

<!-- ============================================================
     VIEW ENTERPRISE MODAL
     ============================================================ -->
<div class="enterprise-modal" id="enterpriseViewModal">
    <div class="modal-box">
        <div class="modal-header">
            <h3>Enterprise Details</h3>
            <button class="modal-close" onclick="closeModal('enterpriseViewModal')">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div id="viewContent">
            <div class="view-field">
                <span class="view-label">Enterprise Name</span>
                <span class="view-value" id="viewEnterpriseName">-</span>
            </div>
            <div class="view-field">
                <span class="view-label">Email</span>
                <span class="view-value" id="viewEmail">-</span>
            </div>
            <div class="view-field">
                <span class="view-label">Phone</span>
                <span class="view-value" id="viewPhone">-</span>
            </div>
            <div class="view-field">
                <span class="view-label">Location</span>
                <span class="view-value" id="viewLocation">-</span>
            </div>
            <div class="view-field">
                <span class="view-label">Sector</span>
                <span class="view-value" id="viewSector">-</span>
            </div>
            <div class="view-field">
                <span class="view-label">Description</span>
                <span class="view-value" id="viewDescription">-</span>
            </div>
            <div class="view-field">
                <span class="view-label">Website</span>
                <span class="view-value" id="viewWebsite">-</span>
            </div>
            <div class="view-field">
                <span class="view-label">Status</span>
                <span class="view-value" id="viewStatus">-</span>
            </div>
            <div class="view-field">
                <span class="view-label">Verified</span>
                <span class="view-value" id="viewVerified">-</span>
            </div>
            <div class="view-field">
                <span class="view-label">Created</span>
                <span class="view-value" id="viewCreated">-</span>
            </div>
            <div class="view-field">
                <span class="view-label">Updated</span>
                <span class="view-value" id="viewUpdated">-</span>
            </div>
        </div>
        <div class="form-actions">
            <button type="button" class="btn-secondary" onclick="closeModal('enterpriseViewModal')">Close</button>
        </div>
    </div>
</div>

<!-- ============================================================
     DELETE CONFIRM MODAL
     ============================================================ -->
<div class="enterprise-modal" id="deleteEnterpriseModal">
    <div class="modal-box" style="max-width: 400px;">
        <div class="modal-header">
            <h3>Confirm Delete</h3>
            <button class="modal-close" onclick="closeModal('deleteEnterpriseModal')">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <?= csrf_field() ?>
        <input type="hidden" id="deleteEnterpriseId" value="">
        <p style="color: var(--ink-muted); margin-bottom: 1.5rem; font-size: 0.9rem;">
            Are you sure you want to delete this enterprise? This action cannot be undone.
        </p>
        <div class="form-actions">
            <button type="button" class="btn-secondary" onclick="closeModal('deleteEnterpriseModal')">Cancel</button>
            <button type="button" class="btn-danger" onclick="confirmDeleteEnterprise()">
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
let sortField = 'enterprise_id';
let sortDirection = 'desc';
let totalRecords = 0;
let deleteEnterpriseId = null;

function loadTableData() {
    const params = new URLSearchParams({
        page: currentPage,
        per_page: perPage,
        search: searchQuery,
        sort: sortField,
        direction: sortDirection
    });

    fetch('<?= base_url('admin/enterprises/getData') ?>?' + params.toString(), {
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

function renderTable(enterprises) {
    const tbody = document.getElementById('tableBody');
    
    if (!enterprises || enterprises.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td colspan="8">
                    <div class="enterprise-empty">
                        <i class="fas fa-building"></i>
                        No enterprises found.
                        <button onclick="openAddEnterpriseModal()" style="color: var(--primary); background: none; border: none; cursor: pointer; font-family: 'Inter', sans-serif; font-size: 0.85rem;">Create your first enterprise</button>
                    </div>
                </td>
            </tr>
        `;
        return;
    }

    let html = '';
    enterprises.forEach((enterprise, index) => {
        const startIndex = (currentPage - 1) * perPage;
        const rowNum = startIndex + index + 1;
        
        const statusClass = enterprise.is_active ? 'active' : 'inactive';
        const statusText = enterprise.is_active ? 'Active' : 'Inactive';
        const eyeIcon = enterprise.is_active ? 'fa-eye' : 'fa-eye-slash';
        
        const verifiedClass = enterprise.is_verified ? 'verified' : 'unverified';
        const verifiedText = enterprise.is_verified ? 'Verified' : 'Unverified';
        const verifyIcon = enterprise.is_verified ? 'fa-check-circle' : 'fa-times-circle';
        
        const sectorName = enterprise.sector_name || 'N/A';
        const clusterCount = enterprise.cluster_count || 0;

        html += `
            <tr data-id="${enterprise.enterprise_id}">
                <td style="color: var(--ink-muted);">${rowNum}</td>
                <td>
                    <div class="enterprise-name">
                        <div class="icon-box">
                            <i class="fas fa-building"></i>
                        </div>
                        <div>
                            <div class="name-text">${escapeHtml(enterprise.enterprise_name)}</div>
                            <div class="email-text">${escapeHtml(enterprise.email)}</div>
                        </div>
                    </div>
                </td>
                <td class="slug-text">${escapeHtml(enterprise.email)}</td>
                <td class="slug-text">${escapeHtml(enterprise.location || '-')}</td>
                <td><span class="sector-badge">${escapeHtml(sectorName)}</span></td>
                <td style="text-align: center;">
                    <span class="cluster-badge">
                        <i class="fas fa-layer-group"></i> ${clusterCount}
                    </span>
                </td>
                <td style="text-align: center;">
                    <span class="status-badge ${statusClass}">${statusText}</span>
                    <span class="status-badge ${verifiedClass}" style="margin-left: 0.25rem;">${verifiedText}</span>
                </td>
                <td style="text-align: center;">
                    <div class="action-group">
                        <button onclick="viewEnterprise(${enterprise.enterprise_id})" class="act-btn" title="View">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button onclick="editEnterprise(${enterprise.enterprise_id})" class="act-btn primary" title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button onclick="toggleStatus(${enterprise.enterprise_id})" class="act-btn" title="Toggle Status">
                            <i class="fas ${eyeIcon}"></i>
                        </button>
                        <button onclick="toggleVerification(${enterprise.enterprise_id})" class="act-btn green" title="Toggle Verification">
                            <i class="fas ${verifyIcon}"></i>
                        </button>
                        <button onclick="openDeleteEnterpriseModal(${enterprise.enterprise_id})" class="act-btn danger" title="Delete">
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

document.querySelectorAll('#enterprisesTable th[data-sort]').forEach(th => {
    th.addEventListener('click', function() {
        const field = this.dataset.sort;
        if (sortField === field) {
            sortDirection = sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            sortField = field;
            sortDirection = 'asc';
        }
        document.querySelectorAll('#enterprisesTable th[data-sort]').forEach(h => {
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

document.querySelectorAll('.enterprise-modal').forEach(modal => {
    modal.addEventListener('click', function(e) {
        if (e.target === this) {
            this.classList.remove('show');
            document.body.style.overflow = '';
        }
    });
});

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        document.querySelectorAll('.enterprise-modal.show').forEach(modal => {
            modal.classList.remove('show');
            document.body.style.overflow = '';
        });
    }
});

// ============================================================
// LOAD SECTORS AND USERS
// ============================================================
function loadSectors() {
    fetch('<?= base_url('admin/enterprises/getSectors') ?>', {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            const select = document.getElementById('formSector');
            select.innerHTML = '<option value="">Select Sector</option>';
            data.data.forEach(sector => {
                select.innerHTML += `<option value="${sector.sector_id}">${escapeHtml(sector.name)}</option>`;
            });
            if (data.csrf_token) updateCsrfToken(data.csrf_token);
        }
    })
    .catch(error => console.error('Error loading sectors:', error));
}

function loadUsers() {
    fetch('<?= base_url('admin/users/getData') ?>?per_page=1000', {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            const select = document.getElementById('formUser');
            select.innerHTML = '<option value="">Select User</option>';
            data.data.forEach(user => {
                select.innerHTML += `<option value="${user.user_id}">${escapeHtml(user.name)} (${escapeHtml(user.email)})</option>`;
            });
            if (data.csrf_token) updateCsrfToken(data.csrf_token);
        }
    })
    .catch(error => console.error('Error loading users:', error));
}

// ============================================================
// ADD/EDIT ENTERPRISE
// ============================================================
function openAddEnterpriseModal() {
    document.getElementById('formEnterpriseId').value = '';
    document.getElementById('formEnterpriseName').value = '';
    document.getElementById('formEmail').value = '';
    document.getElementById('formPhone').value = '';
    document.getElementById('formLocation').value = '';
    document.getElementById('formSector').value = '';
    document.getElementById('formDescription').value = '';
    document.getElementById('formWebsite').value = '';
    document.getElementById('formUser').value = '';
    document.getElementById('formStatus').value = '1';
    document.getElementById('formVerified').value = '0';
    document.getElementById('formModalTitle').textContent = 'Add Enterprise';
    document.getElementById('formSubmitBtn').textContent = 'Add Enterprise';
    loadSectors();
    loadUsers();
    openModal('enterpriseFormModal');
}

function editEnterprise(id) {
    fetch('<?= base_url('admin/enterprises/get') ?>/' + id, {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            const enterprise = data.data;
            document.getElementById('formEnterpriseId').value = enterprise.enterprise_id;
            document.getElementById('formEnterpriseName').value = enterprise.enterprise_name;
            document.getElementById('formEmail').value = enterprise.email;
            document.getElementById('formPhone').value = enterprise.phone || '';
            document.getElementById('formLocation').value = enterprise.location || '';
            document.getElementById('formSector').value = enterprise.sector_id || '';
            document.getElementById('formDescription').value = enterprise.description || '';
            document.getElementById('formWebsite').value = enterprise.website || '';
            document.getElementById('formUser').value = enterprise.user_id || '';
            document.getElementById('formStatus').value = enterprise.is_active ? '1' : '0';
            document.getElementById('formVerified').value = enterprise.is_verified ? '1' : '0';
            document.getElementById('formModalTitle').textContent = 'Edit Enterprise';
            document.getElementById('formSubmitBtn').textContent = 'Update Enterprise';
            if (data.csrf_token) updateCsrfToken(data.csrf_token);
            loadSectors();
            loadUsers();
            openModal('enterpriseFormModal');
        } else {
            showToast(data.message || 'Failed to load enterprise data', 'Error', 'error');
        }
    })
    .catch(error => {
        console.error('Error loading enterprise:', error);
        showToast('Error loading enterprise data', 'Error', 'error');
    });
}

function saveEnterprise(event) {
    event.preventDefault();
    const form = document.getElementById('enterpriseForm');
    const formData = new FormData(form);
    const id = document.getElementById('formEnterpriseId').value;
    const url = id ? '<?= base_url('admin/enterprises/update') ?>/' + id : '<?= base_url('admin/enterprises/create') ?>';

    fetch(url, {
        method: 'POST',
        body: formData,
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            if (data.csrf_token) updateCsrfToken(data.csrf_token);
            closeModal('enterpriseFormModal');
            loadTableData();
            updateStats();
            showToast(data.message || 'Enterprise saved successfully!', 'Success', 'success');
        } else {
            showToast(data.message || 'Failed to save enterprise', 'Error', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('An error occurred while saving the enterprise.', 'Error', 'error');
    });
}

// ============================================================
// VIEW ENTERPRISE
// ============================================================
function viewEnterprise(id) {
    fetch('<?= base_url('admin/enterprises/get') ?>/' + id, {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            const enterprise = data.data;
            document.getElementById('viewEnterpriseName').textContent = enterprise.enterprise_name;
            document.getElementById('viewEmail').textContent = enterprise.email;
            document.getElementById('viewPhone').textContent = enterprise.phone || '-';
            document.getElementById('viewLocation').textContent = enterprise.location || '-';
            document.getElementById('viewSector').textContent = enterprise.sector_name || 'N/A';
            document.getElementById('viewDescription').textContent = enterprise.description || 'No description';
            document.getElementById('viewWebsite').textContent = enterprise.website || '-';
            document.getElementById('viewStatus').textContent = enterprise.is_active ? 'Active' : 'Inactive';
            document.getElementById('viewVerified').textContent = enterprise.is_verified ? 'Verified' : 'Unverified';
            document.getElementById('viewCreated').textContent = enterprise.created_at || '-';
            document.getElementById('viewUpdated').textContent = enterprise.updated_at || '-';
            if (data.csrf_token) updateCsrfToken(data.csrf_token);
            openModal('enterpriseViewModal');
        } else {
            showToast(data.message || 'Failed to load enterprise data', 'Error', 'error');
        }
    })
    .catch(error => {
        console.error('Error loading enterprise:', error);
        showToast('Error loading enterprise data', 'Error', 'error');
    });
}

// ============================================================
// TOGGLE STATUS & VERIFICATION
// ============================================================
function toggleStatus(id) {
    if (confirm('Are you sure you want to toggle this enterprise\'s status?')) {
        const formData = new FormData();
        formData.set(csrfName, csrfHash);

        fetch('<?= base_url('admin/enterprises/toggle-status') ?>/' + id, {
            method: 'POST',
            body: formData,
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                if (data.csrf_token) updateCsrfToken(data.csrf_token);
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

function toggleVerification(id) {
    if (confirm('Are you sure you want to toggle this enterprise\'s verification status?')) {
        const formData = new FormData();
        formData.set(csrfName, csrfHash);

        fetch('<?= base_url('admin/enterprises/verify') ?>/' + id, {
            method: 'POST',
            body: formData,
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                if (data.csrf_token) updateCsrfToken(data.csrf_token);
                loadTableData();
                updateStats();
                showToast(data.message || 'Verification updated!', 'Success', 'success');
            } else {
                showToast(data.message || 'Failed to update verification', 'Error', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('An error occurred while updating verification.', 'Error', 'error');
        });
    }
}

// ============================================================
// DELETE ENTERPRISE
// ============================================================
function openDeleteEnterpriseModal(id) {
    deleteEnterpriseId = id;
    document.getElementById('deleteEnterpriseId').value = id;
    openModal('deleteEnterpriseModal');
}

function confirmDeleteEnterprise() {
    if (!deleteEnterpriseId) return;
    const formData = new FormData();
    formData.set(csrfName, csrfHash);

    fetch('<?= base_url('admin/enterprises/delete') ?>/' + deleteEnterpriseId, {
        method: 'POST',
        body: formData,
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            if (data.csrf_token) updateCsrfToken(data.csrf_token);
            closeModal('deleteEnterpriseModal');
            deleteEnterpriseId = null;
            loadTableData();
            updateStats();
            showToast(data.message || 'Enterprise deleted successfully!', 'Success', 'success');
        } else {
            showToast(data.message || 'Failed to delete enterprise', 'Error', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('An error occurred while deleting the enterprise.', 'Error', 'error');
    });
}

// ============================================================
// UPDATE STATS
// ============================================================
function updateStats() {
    fetch('<?= base_url('admin/enterprises/getStats') ?>', {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            if (data.csrf_token) updateCsrfToken(data.csrf_token);
            const stats = data.data;
            document.getElementById('statTotal').textContent = stats.total || 0;
            document.getElementById('statActive').textContent = stats.active || 0;
            document.getElementById('statPending').textContent = stats.pending || 0;
            document.getElementById('statInactive').textContent = (stats.total || 0) - (stats.active || 0);
        }
    })
    .catch(error => console.error('Error updating stats:', error));
}

// ============================================================
// INITIALIZE
// ============================================================
document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('#enterprisesTable th[data-sort="enterprise_id"]')?.classList.add('active-sort');
    loadTableData();
});
</script>

<?= $this->endSection() ?>