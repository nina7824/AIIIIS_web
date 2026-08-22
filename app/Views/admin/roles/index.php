<?= $this->extend('admin/layout') ?>

<?= $this->section('styles') ?>
<style>
/* ============================================================
   ROLE MANAGEMENT - STYLES
   ============================================================ */

/* Stats Cards - 4 Column Grid */
.role-stats-wrapper {
    display: grid !important;
    grid-template-columns: repeat(4, 1fr) !important;
    gap: 0.75rem !important;
    margin-bottom: 1rem !important;
    width: 100% !important;
    box-sizing: border-box !important;
}

@media (max-width: 992px) {
    .role-stats-wrapper {
        grid-template-columns: repeat(2, 1fr) !important;
    }
}

@media (max-width: 576px) {
    .role-stats-wrapper {
        grid-template-columns: 1fr 1fr !important;
        gap: 0.5rem !important;
    }
}

@media (max-width: 400px) {
    .role-stats-wrapper {
        grid-template-columns: 1fr !important;
    }
}

/* Dashboard-Style Stat Card */
.role-stat-card {
    background: var(--surface) !important;
    border: 1px solid var(--border) !important;
    border-radius: var(--radius) !important;
    padding: 0.75rem 1rem !important;
    transition: all 0.2s ease !important;
    display: flex !important;
    flex-direction: column !important;
    align-items: flex-start !important;
    box-shadow: var(--shadow-sm) !important;
    position: relative !important;
    overflow: hidden !important;
    min-width: 0 !important;
    width: 100% !important;
}

.role-stat-card .accent-bar {
    position: absolute !important;
    top: 0 !important;
    left: 0 !important;
    right: 0 !important;
    height: 3px !important;
}

.role-stat-card:hover {
    transform: translateY(-2px) !important;
    box-shadow: var(--shadow-md) !important;
    border-color: var(--primary) !important;
}

.role-stat-card .stat-icon-wrap {
    width: 32px !important;
    height: 32px !important;
    border-radius: 8px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    font-size: 0.8rem !important;
    margin-bottom: 0.3rem !important;
    flex-shrink: 0 !important;
}

.role-stat-card .stat-icon-wrap.purple { background: #ede9fe !important; color: #7c3aed !important; }
.role-stat-card .stat-icon-wrap.green { background: #d1fae5 !important; color: #059669 !important; }
.role-stat-card .stat-icon-wrap.red { background: #fee2e2 !important; color: #dc2626 !important; }
.role-stat-card .stat-icon-wrap.blue { background: #dbeafe !important; color: #2563eb !important; }

[data-theme="dark"] .role-stat-card .stat-icon-wrap.purple { background: #2d1b4a !important; color: #a78bfa !important; }
[data-theme="dark"] .role-stat-card .stat-icon-wrap.green { background: #1a3a2a !important; color: #34d399 !important; }
[data-theme="dark"] .role-stat-card .stat-icon-wrap.red { background: #3a1a1a !important; color: #f87171 !important; }
[data-theme="dark"] .role-stat-card .stat-icon-wrap.blue { background: #1a2a4a !important; color: #60a5fa !important; }

.role-stat-card .stat-number {
    font-size: 1.2rem !important;
    font-weight: 800 !important;
    color: var(--ink) !important;
    line-height: 1.2 !important;
    letter-spacing: -0.02em !important;
}

.role-stat-card .stat-label {
    font-size: 0.6rem !important;
    font-weight: 500 !important;
    color: var(--ink-muted) !important;
    text-transform: uppercase !important;
    letter-spacing: 0.04em !important;
    margin-top: 0.1rem !important;
}

.role-stat-card .stat-trend {
    font-size: 0.55rem !important;
    font-weight: 600 !important;
    margin-top: 0.25rem !important;
    padding: 0.05rem 0.4rem !important;
    border-radius: 10px !important;
    display: inline-flex !important;
    align-items: center !important;
    gap: 0.2rem !important;
    background: var(--canvas) !important;
}

.role-stat-card .stat-trend.up { color: #059669 !important; }
.role-stat-card .stat-trend.down { color: #dc2626 !important; }
.role-stat-card .stat-trend.neutral { color: var(--ink-muted) !important; }

.role-stat-card.color-primary .accent-bar { background: #2563eb !important; }
.role-stat-card.color-success .accent-bar { background: #059669 !important; }
.role-stat-card.color-danger .accent-bar { background: #dc2626 !important; }
.role-stat-card.color-purple .accent-bar { background: #7c3aed !important; }

/* Action Bar */
.role-action-bar {
    display: flex !important;
    justify-content: flex-end !important;
    align-items: center !important;
    margin-bottom: 1rem !important;
    flex-wrap: wrap !important;
    gap: 0.5rem !important;
    width: 100% !important;
}

.role-action-bar .btn-primary {
    padding: 0.4rem 1.2rem !important;
    background: var(--primary) !important;
    color: #fff !important;
    border: none !important;
    border-radius: 8px !important;
    font-size: 0.78rem !important;
    font-weight: 600 !important;
    cursor: pointer !important;
    transition: all 0.2s ease !important;
    text-decoration: none !important;
    display: inline-flex !important;
    align-items: center !important;
    gap: 0.4rem !important;
    font-family: 'Inter', sans-serif !important;
}

.role-action-bar .btn-primary:hover {
    background: var(--primary-dark) !important;
    transform: translateY(-1px) !important;
    box-shadow: 0 4px 12px rgba(7, 142, 206, 0.3) !important;
}

/* Table */
.role-table-wrap {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    overflow: hidden;
}

.role-table-wrap .table-toolbar {
    padding: 0.5rem 1rem;
    border-bottom: 1px solid var(--border);
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 0.5rem;
}

.role-table-wrap .table-toolbar .search-box {
    display: flex;
    align-items: center;
    gap: 0.4rem;
    background: var(--canvas);
    border: 1px solid var(--border);
    border-radius: 6px;
    padding: 0.2rem 0.6rem;
    transition: all 0.2s ease;
}

.role-table-wrap .table-toolbar .search-box:focus-within {
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(7, 142, 206, 0.1);
}

.role-table-wrap .table-toolbar .search-box i {
    color: var(--ink-muted);
    font-size: 0.75rem;
}

.role-table-wrap .table-toolbar .search-box input {
    border: none;
    background: transparent;
    padding: 0.3rem 0.2rem;
    font-size: 0.75rem;
    color: var(--ink);
    width: 180px;
    outline: none;
    font-family: 'Inter', sans-serif;
}

.role-table-wrap .table-toolbar .search-box input::placeholder {
    color: var(--ink-muted);
}

.role-table-wrap .table-toolbar .toolbar-right {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.role-table-wrap .table-toolbar .per-page {
    display: flex;
    align-items: center;
    gap: 0.3rem;
    font-size: 0.7rem;
    color: var(--ink-muted);
}

.role-table-wrap .table-toolbar .per-page select {
    padding: 0.15rem 0.3rem;
    border: 1px solid var(--border);
    border-radius: 4px;
    background: var(--surface);
    color: var(--ink);
    font-size: 0.7rem;
    cursor: pointer;
    font-family: 'Inter', sans-serif;
}

.role-table-wrap .table-toolbar .refresh-btn {
    padding: 0.2rem 0.5rem;
    border: 1px solid var(--border);
    border-radius: 4px;
    background: var(--surface);
    color: var(--ink-muted);
    cursor: pointer;
    transition: all 0.2s ease;
    font-size: 0.7rem;
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
    font-size: 0.8rem;
}

.role-table-wrap table thead {
    background: var(--canvas);
}

.role-table-wrap table th {
    padding: 0.5rem 1rem;
    text-align: left;
    font-weight: 600;
    color: var(--ink-muted);
    font-size: 0.6rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    border-bottom: 2px solid var(--border);
    cursor: pointer;
    user-select: none;
    white-space: nowrap;
}

.role-table-wrap table th .sort {
    margin-left: 0.2rem;
    opacity: 0.3;
    font-size: 0.5rem;
}

.role-table-wrap table th.active-sort .sort {
    opacity: 1;
    color: var(--primary);
}

.role-table-wrap table td {
    padding: 0.5rem 1rem;
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
    padding: 0.05rem 0.5rem;
    border-radius: 10px;
    font-size: 0.6rem;
    font-weight: 500;
}

.role-table-wrap table .status-badge {
    display: inline-block;
    padding: 0.05rem 0.6rem;
    border-radius: 20px;
    font-size: 0.5rem;
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
    gap: 0.1rem;
    flex-wrap: wrap;
}

.role-table-wrap table .action-group .act-btn {
    background: none;
    border: none;
    color: var(--ink-muted);
    padding: 0.2rem 0.35rem;
    border-radius: 4px;
    cursor: pointer;
    transition: all 0.2s ease;
    font-size: 0.8rem;
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
    padding: 0.5rem 1rem;
    border-top: 1px solid var(--border);
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 0.5rem;
}

.role-table-wrap .table-footer .info-text {
    font-size: 0.7rem;
    color: var(--ink-muted);
}

.role-table-wrap .table-footer .pagination {
    display: flex;
    gap: 0.2rem;
}

.role-table-wrap .table-footer .pagination button {
    padding: 0.15rem 0.5rem;
    border: 1px solid var(--border);
    border-radius: 4px;
    background: var(--surface);
    color: var(--ink-muted);
    cursor: pointer;
    transition: all 0.2s ease;
    font-size: 0.7rem;
    min-width: 28px;
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
    padding: 2rem;
    text-align: center;
    color: var(--ink-muted);
}

.role-empty i {
    font-size: 2rem;
    display: block;
    margin-bottom: 0.5rem;
    opacity: 0.3;
}

/* ============================================================
   MODAL STYLES
   ============================================================ */
.role-modal-overlay {
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

.role-modal-overlay.show {
    display: flex;
}

.role-modal {
    background: var(--surface);
    border-radius: var(--radius-lg);
    padding: 1.5rem 2rem;
    max-width: 640px;
    width: 100%;
    max-height: 85vh;
    overflow-y: auto;
    box-shadow: 0 20px 60px rgba(0,0,0,0.2);
    animation: modalSlideIn 0.3s ease;
}

.role-modal .modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
    padding-bottom: 0.5rem;
    border-bottom: 1px solid var(--border);
}

.role-modal .modal-header h3 {
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--ink);
}

.role-modal .modal-header .modal-close {
    background: none;
    border: none;
    color: var(--ink-muted);
    font-size: 1.2rem;
    cursor: pointer;
    padding: 0.3rem;
    border-radius: 6px;
    transition: all 0.2s ease;
}

.role-modal .modal-header .modal-close:hover {
    background: var(--canvas);
    color: var(--ink);
}

.role-modal .form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
}

.role-modal .form-group {
    margin-bottom: 0.75rem;
}

.role-modal .form-group.full-width {
    grid-column: span 2;
}

.role-modal .form-group label {
    display: block;
    font-size: 0.75rem;
    font-weight: 600;
    color: var(--ink);
    margin-bottom: 0.2rem;
}

.role-modal .form-group label .required {
    color: #dc2626;
}

.role-modal .form-group input,
.role-modal .form-group textarea,
.role-modal .form-group select {
    width: 100%;
    padding: 0.4rem 0.6rem;
    border: 1px solid var(--border);
    border-radius: var(--radius);
    background: var(--surface);
    color: var(--ink);
    font-size: 0.8rem;
    font-family: 'Inter', sans-serif;
    transition: all 0.2s ease;
}

.role-modal .form-group input:focus,
.role-modal .form-group textarea:focus,
.role-modal .form-group select:focus {
    border-color: var(--primary);
    outline: none;
    box-shadow: 0 0 0 3px rgba(7, 142, 206, 0.1);
}

.role-modal .form-group .helper-text {
    font-size: 0.6rem;
    color: var(--ink-muted);
    margin-top: 0.15rem;
}

.role-modal .form-group .error-text {
    font-size: 0.65rem;
    color: #dc2626;
    margin-top: 0.15rem;
    display: none;
}

.role-modal .form-group .error-text.show {
    display: block;
}

.role-modal .form-group input.error,
.role-modal .form-group textarea.error,
.role-modal .form-group select.error {
    border-color: #dc2626;
}

.role-modal .form-group textarea {
    resize: vertical;
    min-height: 60px;
}

.role-modal .form-actions {
    display: flex;
    gap: 0.75rem;
    justify-content: flex-end;
    margin-top: 1rem;
    padding-top: 0.75rem;
    border-top: 1px solid var(--border);
}

.role-modal .form-actions .btn-secondary {
    padding: 0.4rem 1.2rem;
    background: transparent;
    color: var(--ink-muted);
    border: 1.5px solid var(--border);
    border-radius: var(--radius);
    font-size: 0.78rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s ease;
    font-family: 'Inter', sans-serif;
}

.role-modal .form-actions .btn-secondary:hover {
    border-color: var(--primary);
    color: var(--ink);
    background: var(--surface-hover);
}

.role-modal .form-actions .btn-primary {
    padding: 0.4rem 1.2rem;
    background: var(--primary);
    color: #fff;
    border: none;
    border-radius: var(--radius);
    font-size: 0.78rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s ease;
    font-family: 'Inter', sans-serif;
}

.role-modal .form-actions .btn-primary:hover {
    background: var(--primary-dark);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(7, 142, 206, 0.3);
}

.role-modal .form-actions .btn-primary:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    transform: none !important;
}

/* ============================================================
   CONFIRMATION MODAL
   ============================================================ */
.confirm-modal-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.5);
    z-index: 10000;
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(4px);
    padding: 1rem;
}

.confirm-modal-overlay.show {
    display: flex;
}

.confirm-modal {
    background: var(--surface);
    border-radius: var(--radius-lg);
    padding: 1.5rem 2rem;
    max-width: 440px;
    width: 100%;
    box-shadow: 0 20px 60px rgba(0,0,0,0.2);
    animation: modalSlideIn 0.3s ease;
}

.confirm-modal .confirm-icon {
    text-align: center;
    font-size: 2.5rem;
    margin-bottom: 0.75rem;
}

.confirm-modal .confirm-icon.warning {
    color: #f59e0b;
}

.confirm-modal .confirm-icon.danger {
    color: #dc2626;
}

.confirm-modal .confirm-title {
    text-align: center;
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--ink);
    margin-bottom: 0.5rem;
}

.confirm-modal .confirm-message {
    text-align: center;
    font-size: 0.85rem;
    color: var(--ink-muted);
    margin-bottom: 1.5rem;
    line-height: 1.5;
}

.confirm-modal .confirm-actions {
    display: flex;
    gap: 0.75rem;
    justify-content: center;
}

.confirm-modal .confirm-actions .btn-secondary {
    padding: 0.4rem 1.5rem;
    background: transparent;
    color: var(--ink-muted);
    border: 1.5px solid var(--border);
    border-radius: var(--radius);
    font-size: 0.78rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s ease;
    font-family: 'Inter', sans-serif;
}

.confirm-modal .confirm-actions .btn-secondary:hover {
    border-color: var(--primary);
    color: var(--ink);
    background: var(--surface-hover);
}

.confirm-modal .confirm-actions .btn-danger {
    padding: 0.4rem 1.5rem;
    background: #dc2626;
    color: #fff;
    border: none;
    border-radius: var(--radius);
    font-size: 0.78rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s ease;
    font-family: 'Inter', sans-serif;
}

.confirm-modal .confirm-actions .btn-danger:hover {
    background: #b91c1c;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3);
}

.confirm-modal .confirm-actions .btn-warning {
    padding: 0.4rem 1.5rem;
    background: #f59e0b;
    color: #fff;
    border: none;
    border-radius: var(--radius);
    font-size: 0.78rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s ease;
    font-family: 'Inter', sans-serif;
}

.confirm-modal .confirm-actions .btn-warning:hover {
    background: #d97706;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
}

/* Toast */
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
    padding: 0.75rem 1rem;
    box-shadow: 0 10px 40px rgba(0,0,0,0.15);
    display: flex;
    align-items: center;
    gap: 0.75rem;
    animation: slideInRight 0.4s ease;
    border-left: 4px solid var(--primary);
    min-width: 280px;
}

.toast .toast-icon { font-size: 1.1rem; flex-shrink: 0; }
.toast .toast-content { flex: 1; }
.toast .toast-content .toast-title { font-weight: 600; font-size: 0.8rem; color: var(--ink); }
.toast .toast-content .toast-message { font-size: 0.7rem; color: var(--ink-muted); }
.toast .toast-close {
    background: none;
    border: none;
    color: var(--ink-muted);
    cursor: pointer;
    font-size: 0.8rem;
    padding: 0.15rem;
}

.toast.success { border-left-color: #059669; }
.toast.success .toast-icon { color: #059669; }
.toast.error { border-left-color: #dc2626; }
.toast.error .toast-icon { color: #dc2626; }
.toast.warning { border-left-color: #d97706; }
.toast.warning .toast-icon { color: #d97706; }
.toast.info { border-left-color: var(--primary); }
.toast.info .toast-icon { color: var(--primary); }

[data-theme="dark"] .toast {
    background: #1a1d27;
    border: 1px solid #2d3344;
}

@keyframes slideInRight {
    from { transform: translateX(100%); opacity: 0; }
    to { transform: translateX(0); opacity: 1; }
}

@media (max-width: 768px) {
    .role-modal .form-grid {
        grid-template-columns: 1fr;
    }
    .role-modal .form-group.full-width {
        grid-column: span 1;
    }
    .role-modal {
        padding: 1rem 1.25rem;
        max-width: 95%;
    }
    .confirm-modal {
        max-width: 95%;
        padding: 1.25rem;
    }
}

@media (max-width: 480px) {
    .role-modal {
        padding: 0.75rem 1rem;
        max-width: 98%;
    }
    .role-modal .form-actions {
        flex-direction: column;
    }
    .role-modal .form-actions .btn-secondary,
    .role-modal .form-actions .btn-primary {
        width: 100%;
        justify-content: center;
    }
    .confirm-modal .confirm-actions {
        flex-direction: column;
    }
    .confirm-modal .confirm-actions .btn-secondary,
    .confirm-modal .confirm-actions .btn-danger,
    .confirm-modal .confirm-actions .btn-warning {
        width: 100%;
        justify-content: center;
    }
}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Stats Cards -->
<div class="role-stats-wrapper">
    <div class="role-stat-card color-primary">
        <div class="accent-bar"></div>
        <div class="stat-icon-wrap blue">
            <i class="fas fa-user-tag"></i>
        </div>
        <div class="stat-number" id="statTotal"><?= $total_roles ?? 0 ?></div>
        <div class="stat-label">Total Roles</div>
        <span class="stat-trend up">
            <i class="fas fa-arrow-up"></i> 12%
        </span>
    </div>
    <div class="role-stat-card color-success">
        <div class="accent-bar"></div>
        <div class="stat-icon-wrap green">
            <i class="fas fa-check-circle"></i>
        </div>
        <div class="stat-number" id="statActive"><?= $active_roles ?? 0 ?></div>
        <div class="stat-label">Active Roles</div>
        <span class="stat-trend up">
            <i class="fas fa-arrow-up"></i> 8%
        </span>
    </div>
    <div class="role-stat-card color-danger">
        <div class="accent-bar"></div>
        <div class="stat-icon-wrap red">
            <i class="fas fa-times-circle"></i>
        </div>
        <div class="stat-number" id="statInactive"><?= ($total_roles ?? 0) - ($active_roles ?? 0) ?></div>
        <div class="stat-label">Inactive Roles</div>
        <span class="stat-trend down">
            <i class="fas fa-arrow-down"></i> 3%
        </span>
    </div>
    <div class="role-stat-card color-purple">
        <div class="accent-bar"></div>
        <div class="stat-icon-wrap purple">
            <i class="fas fa-shield-alt"></i>
        </div>
        <div class="stat-number" id="statSystem"><?= $system_roles ?? 0 ?></div>
        <div class="stat-label">System Roles</div>
        <span class="stat-trend neutral">
            <i class="fas fa-minus"></i> 0%
        </span>
    </div>
</div>

<!-- Action Bar -->
<div class="role-action-bar">
    <button class="btn-primary" onclick="openAddModal()">
        <i class="fas fa-plus"></i> Add Role
    </button>
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
                    <th style="text-align: center; width: 140px;">Actions</th>
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
     ADD/EDIT ROLE MODAL
     ============================================================ -->
<div class="role-modal-overlay" id="roleModal">
    <div class="role-modal">
        <div class="modal-header">
            <h3 id="modalTitle">Add Role</h3>
            <button class="modal-close" onclick="closeModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <form id="roleForm" onsubmit="saveRole(event)">
            <?= csrf_field() ?>
            <input type="hidden" id="formRoleId" name="role_id" value="">
            
            <div class="form-grid">
                <div class="form-group">
                    <label for="formName">Role Name <span class="required">*</span></label>
                    <input type="text" id="formName" name="name" placeholder="e.g., Manager" required oninput="generateSlug()">
                    <div class="error-text" id="nameError">Please enter a role name</div>
                </div>
                
                <div class="form-group">
                    <label for="formSlug">Slug <span class="required">*</span></label>
                    <input type="text" id="formSlug" name="slug" placeholder="Auto-generated" required>
                    <div class="helper-text">Auto-generated from role name</div>
                    <div class="error-text" id="slugError">Please enter a slug</div>
                </div>
                
                <div class="form-group full-width">
                    <label for="formDescription">Description</label>
                    <textarea id="formDescription" name="description" placeholder="Enter role description" rows="2"></textarea>
                </div>
                
                <div class="form-group">
                    <label for="formStatus">Status</label>
                    <select id="formStatus" name="is_active">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label>&nbsp;</label>
                    <div style="display: flex; align-items: center; gap: 0.5rem; padding: 0.3rem 0.6rem; background: var(--canvas); border-radius: var(--radius);">
                        <i class="fas fa-link" style="color: var(--ink-muted); font-size: 0.8rem;"></i>
                        <span style="font-size: 0.8rem; color: var(--ink-muted);">Slug:</span>
                        <span id="slugPreview" class="slug-preview" style="font-size: 0.7rem; color: var(--primary); background: var(--primary-light); padding: 0.1rem 0.5rem; border-radius: 4px;">role-name</span>
                    </div>
                </div>
            </div>
            
            <div class="form-actions">
                <button type="button" class="btn-secondary" onclick="closeModal()">Cancel</button>
                <button type="submit" class="btn-primary" id="formSubmitBtn">
                    <i class="fas fa-save"></i> Save Role
                </button>
            </div>
        </form>
    </div>
</div>

<!-- ============================================================
     CONFIRMATION MODAL
     ============================================================ -->
<div class="confirm-modal-overlay" id="confirmModal">
    <div class="confirm-modal">
        <div class="confirm-icon warning" id="confirmIcon">
            <i class="fas fa-exclamation-triangle"></i>
        </div>
        <div class="confirm-title" id="confirmTitle">Are you sure?</div>
        <div class="confirm-message" id="confirmMessage">This action cannot be undone.</div>
        <div class="confirm-actions">
            <button class="btn-secondary" onclick="closeConfirmModal()">Cancel</button>
            <button class="btn-danger" id="confirmBtn" onclick="executeConfirm()">
                <i class="fas fa-check"></i> Confirm
            </button>
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
// AUTO-GENERATE SLUG
// ============================================================
function generateSlug() {
    const name = document.getElementById('formName').value;
    const slugField = document.getElementById('formSlug');
    const preview = document.getElementById('slugPreview');
    
    if (name && name.trim().length > 0) {
        const slug = name.trim()
            .toLowerCase()
            .replace(/[^a-z0-9\s-]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-');
        
        slugField.value = slug;
        preview.textContent = slug;
    } else {
        slugField.value = '';
        preview.textContent = 'role-name';
    }
}

// ============================================================
// MODAL FUNCTIONS
// ============================================================
function openModal() {
    document.getElementById('roleModal').classList.add('show');
    document.body.style.overflow = 'hidden';
}

function closeModal() {
    document.getElementById('roleModal').classList.remove('show');
    document.body.style.overflow = '';
    document.getElementById('roleForm').reset();
    document.getElementById('formRoleId').value = '';
    document.getElementById('modalTitle').textContent = 'Add Role';
    document.getElementById('formSubmitBtn').innerHTML = '<i class="fas fa-save"></i> Save Role';
    document.getElementById('slugPreview').textContent = 'role-name';
    document.querySelectorAll('.error-text').forEach(el => el.classList.remove('show'));
    document.querySelectorAll('.form-group input, .form-group textarea, .form-group select').forEach(el => el.classList.remove('error'));
}

// ============================================================
// CONFIRMATION MODAL
// ============================================================
let confirmCallback = null;
let confirmData = null;

function openConfirmModal(title, message, type = 'warning', callback, data = null) {
    const modal = document.getElementById('confirmModal');
    const icon = document.getElementById('confirmIcon');
    const titleEl = document.getElementById('confirmTitle');
    const msgEl = document.getElementById('confirmMessage');
    const btn = document.getElementById('confirmBtn');
    
    icon.className = `confirm-icon ${type}`;
    if (type === 'danger') {
        icon.innerHTML = '<i class="fas fa-exclamation-circle"></i>';
        btn.className = 'btn-danger';
    } else if (type === 'warning') {
        icon.innerHTML = '<i class="fas fa-exclamation-triangle"></i>';
        btn.className = 'btn-warning';
    } else {
        icon.innerHTML = '<i class="fas fa-info-circle"></i>';
        btn.className = 'btn-primary';
    }
    
    titleEl.textContent = title;
    msgEl.textContent = message;
    confirmCallback = callback;
    confirmData = data;
    
    modal.classList.add('show');
    document.body.style.overflow = 'hidden';
}

function closeConfirmModal() {
    document.getElementById('confirmModal').classList.remove('show');
    document.body.style.overflow = '';
    confirmCallback = null;
    confirmData = null;
}

function executeConfirm() {
    if (typeof confirmCallback === 'function') {
        confirmCallback(confirmData);
    }
    closeConfirmModal();
}

// Click outside to close
document.getElementById('confirmModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeConfirmModal();
    }
});

// Escape key to close
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeConfirmModal();
        closeModal();
    }
});

// ============================================================
// OPEN ADD MODAL
// ============================================================
function openAddModal() {
    document.getElementById('formRoleId').value = '';
    document.getElementById('formName').value = '';
    document.getElementById('formSlug').value = '';
    document.getElementById('formDescription').value = '';
    document.getElementById('formStatus').value = '1';
    document.getElementById('modalTitle').textContent = 'Add Role';
    document.getElementById('formSubmitBtn').innerHTML = '<i class="fas fa-save"></i> Save Role';
    document.getElementById('slugPreview').textContent = 'role-name';
    document.querySelectorAll('.error-text').forEach(el => el.classList.remove('show'));
    document.querySelectorAll('.form-group input, .form-group textarea, .form-group select').forEach(el => el.classList.remove('error'));
    openModal();
    setTimeout(() => {
        document.getElementById('formName').focus();
    }, 300);
}

// ============================================================
// OPEN EDIT MODAL
// ============================================================
function editRole(id) {
    fetch('<?= base_url('admin/roles/get') ?>/' + id, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            const role = data.data;
            document.getElementById('formRoleId').value = role.role_id;
            document.getElementById('formName').value = role.name;
            document.getElementById('formSlug').value = role.slug;
            document.getElementById('formDescription').value = role.description || '';
            document.getElementById('formStatus').value = role.is_active ? '1' : '0';
            document.getElementById('slugPreview').textContent = role.slug || 'role-name';
            document.getElementById('modalTitle').textContent = 'Edit Role';
            document.getElementById('formSubmitBtn').innerHTML = '<i class="fas fa-save"></i> Update Role';
            document.querySelectorAll('.error-text').forEach(el => el.classList.remove('show'));
            document.querySelectorAll('.form-group input, .form-group textarea, .form-group select').forEach(el => el.classList.remove('error'));
            if (data.csrf_token) {
                updateCsrfToken(data.csrf_token);
            }
            openModal();
        } else {
            showToast(data.message || 'Failed to load role data', 'Error', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('An error occurred while loading the role.', 'Error', 'error');
    });
}

// ============================================================
// SAVE ROLE
// ============================================================
function saveRole(event) {
    event.preventDefault();
    
    const form = document.getElementById('roleForm');
    const formData = new FormData(form);
    const id = document.getElementById('formRoleId').value;
    const url = id ? '<?= base_url('admin/roles/update') ?>/' + id : '<?= base_url('admin/roles/create') ?>';
    
    document.querySelectorAll('.error-text').forEach(el => el.classList.remove('show'));
    document.querySelectorAll('.form-group input, .form-group textarea, .form-group select').forEach(el => el.classList.remove('error'));
    
    const submitBtn = document.getElementById('formSubmitBtn');
    const originalText = submitBtn.innerHTML;
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';
    
    fetch(url, {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalText;
        
        if (data.status === 'success') {
            if (data.csrf_token) {
                updateCsrfToken(data.csrf_token);
            }
            closeModal();
            loadTableData();
            updateStats();
            showToast(data.message || 'Role saved successfully!', 'Success', 'success');
        } else {
            if (typeof data.message === 'object') {
                let hasError = false;
                for (const [key, messages] of Object.entries(data.message)) {
                    const errorEl = document.getElementById(key + 'Error');
                    const inputEl = document.getElementById('form' + key.charAt(0).toUpperCase() + key.slice(1));
                    if (errorEl) {
                        errorEl.textContent = Array.isArray(messages) ? messages.join(', ') : messages;
                        errorEl.classList.add('show');
                        hasError = true;
                    }
                    if (inputEl) {
                        inputEl.classList.add('error');
                    }
                }
                if (!hasError) {
                    showToast('Please fix the validation errors.', 'Error', 'error');
                }
            } else {
                showToast(data.message || 'Failed to save role', 'Error', 'error');
            }
        }
    })
    .catch(error => {
        console.error('Error:', error);
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalText;
        showToast('An error occurred while saving the role.', 'Error', 'error');
    });
}

// ============================================================
// TOGGLE STATUS WITH CONFIRMATION MODAL
// ============================================================
function toggleStatus(id) {
    openConfirmModal(
        'Toggle Role Status',
        'Are you sure you want to change this role\'s status?',
        'warning',
        function(roleId) {
            const formData = new FormData();
            formData.set(csrfName, csrfHash);

            fetch('<?= base_url('admin/roles/toggle-status') ?>/' + roleId, {
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
                    const statusBadge = document.getElementById('status-' + roleId);
                    const statusIcon = document.getElementById('status-icon-' + roleId);
                    
                    if (statusBadge) {
                        const isActive = data.is_active == 1;
                        statusBadge.textContent = isActive ? 'Active' : 'Inactive';
                        statusBadge.className = `status-badge ${isActive ? 'active' : 'inactive'}`;
                    }
                    
                    if (statusIcon) {
                        statusIcon.className = `fas ${data.is_active == 1 ? 'fa-eye' : 'fa-eye-slash'}`;
                    }
                    
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
        },
        id
    );
}

// ============================================================
// DELETE ROLE WITH CONFIRMATION MODAL
// ============================================================
function deleteRole(id) {
    openConfirmModal(
        'Delete Role',
        'Are you sure you want to delete this role? This action cannot be undone and may affect users assigned to this role.',
        'danger',
        function(roleId) {
            const formData = new FormData();
            formData.set(csrfName, csrfHash);

            fetch('<?= base_url('admin/roles/delete') ?>/' + roleId, {
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
        },
        id
    );
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
        const isActive = role.is_active == 1 || role.is_active === true;
        const statusClass = isActive ? 'active' : 'inactive';
        const statusText = isActive ? 'Active' : 'Inactive';
        const eyeIcon = isActive ? 'fa-eye' : 'fa-eye-slash';
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
                <td class="slug-text" style="color: var(--ink-muted); font-family: monospace; font-size: 0.7rem;">${escapeHtml(role.slug)}</td>
                <td class="desc-text" style="color: var(--ink-muted); font-size: 0.75rem; max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">${escapeHtml(role.description || '-')}</td>
                <td style="text-align: center;">
                    <span class="system-badge">${isSystem}</span>
                </td>
                <td style="text-align: center;">
                    <span class="status-badge ${statusClass}" id="status-${role.role_id}">${statusText}</span>
                </td>
                <td style="text-align: center;">
                    <div class="action-group">
                        <a href="<?= base_url('admin/roles/permissions') ?>/${role.role_id}" class="act-btn purple" title="Set Permissions">
                            <i class="fas fa-key"></i>
                        </a>
                        ${role.is_system == 1 ? '' : `
                            <button onclick="editRole(${role.role_id})" class="act-btn primary" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button onclick="toggleStatus(${role.role_id})" class="act-btn" title="Toggle Status">
                                <i class="fas ${eyeIcon}" id="status-icon-${role.role_id}"></i>
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
            const systemEl = document.getElementById('statSystem');
            
            if (totalEl) totalEl.textContent = stats.total || 0;
            if (activeEl) activeEl.textContent = stats.active || 0;
            if (inactiveEl) inactiveEl.textContent = (stats.total || 0) - (stats.active || 0);
            if (systemEl) systemEl.textContent = stats.system || 0;
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