<?= $this->extend('admin/layout') ?>

<?= $this->section('styles') ?>
<style>
/* ============================================================
   USER MANAGEMENT - COMPLETE REDESIGN
   ============================================================ */

/* ---------- STATS CARDS ---------- */
.user-stats-wrapper {
    display: grid !important;
    grid-template-columns: repeat(3, 1fr) !important;
    gap: 1rem !important;
    margin-bottom: 1.5rem !important;
    width: 100% !important;
}

.user-stats-wrapper .stat-card {
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

.user-stats-wrapper .stat-card:hover {
    border-color: var(--primary);
    box-shadow: 0 4px 12px rgba(0,0,0,0.06);
    transform: translateY(-1px);
}

.user-stats-wrapper .stat-card .stat-icon-wrap {
    width: 44px;
    height: 44px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.1rem;
    flex-shrink: 0;
}

.user-stats-wrapper .stat-card .stat-icon-wrap.blue {
    background: #dbeafe;
    color: #2563eb;
}
.user-stats-wrapper .stat-card .stat-icon-wrap.green {
    background: #d1fae5;
    color: #059669;
}
.user-stats-wrapper .stat-card .stat-icon-wrap.red {
    background: #fee2e2;
    color: #dc2626;
}

[data-theme="dark"] .user-stats-wrapper .stat-card .stat-icon-wrap.blue {
    background: #1e293b;
    color: #60a5fa;
}
[data-theme="dark"] .user-stats-wrapper .stat-card .stat-icon-wrap.green {
    background: #1a3a2a;
    color: #34d399;
}
[data-theme="dark"] .user-stats-wrapper .stat-card .stat-icon-wrap.red {
    background: #3a1a1a;
    color: #f87171;
}

.user-stats-wrapper .stat-card .stat-info {
    flex: 1;
    min-width: 0;
    overflow: hidden;
}

.user-stats-wrapper .stat-card .stat-info .stat-number {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--ink);
    line-height: 1.2;
    letter-spacing: -0.02em;
}

.user-stats-wrapper .stat-card .stat-info .stat-label {
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
.user-action-bar {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    margin-bottom: 1.5rem;
    flex-wrap: wrap;
    gap: 0.75rem;
    width: 100% !important;
}

.user-action-bar .btn-group {
    display: flex;
    gap: 0.75rem;
}

.user-action-bar .btn-primary {
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

.user-action-bar .btn-primary:hover {
    background: var(--primary-dark);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(7, 142, 206, 0.35);
}

/* ---------- DATATABLE ---------- */
.user-table-wrap {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 10px;
    overflow: hidden;
}

.user-table-wrap .table-toolbar {
    padding: 0.75rem 1.25rem;
    border-bottom: 1px solid var(--border);
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 0.75rem;
}

.user-table-wrap .table-toolbar .search-box {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    background: var(--canvas);
    border: 1px solid var(--border);
    border-radius: 8px;
    padding: 0.3rem 0.75rem;
    transition: all 0.2s ease;
}

.user-table-wrap .table-toolbar .search-box:focus-within {
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(7, 142, 206, 0.1);
}

.user-table-wrap .table-toolbar .search-box i {
    color: var(--ink-muted);
    font-size: 0.8rem;
}

.user-table-wrap .table-toolbar .search-box input {
    border: none;
    background: transparent;
    padding: 0.4rem 0.25rem;
    font-size: 0.8rem;
    color: var(--ink);
    width: 200px;
    outline: none;
    font-family: 'Inter', sans-serif;
}

.user-table-wrap .table-toolbar .search-box input::placeholder {
    color: var(--ink-muted);
}

.user-table-wrap .table-toolbar .toolbar-right {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.user-table-wrap .table-toolbar .per-page {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.78rem;
    color: var(--ink-muted);
}

.user-table-wrap .table-toolbar .per-page select {
    padding: 0.25rem 0.5rem;
    border: 1px solid var(--border);
    border-radius: 6px;
    background: var(--surface);
    color: var(--ink);
    font-size: 0.78rem;
    cursor: pointer;
    font-family: 'Inter', sans-serif;
}

.user-table-wrap .table-toolbar .refresh-btn {
    padding: 0.3rem 0.7rem;
    border: 1px solid var(--border);
    border-radius: 6px;
    background: var(--surface);
    color: var(--ink-muted);
    cursor: pointer;
    transition: all 0.2s ease;
    font-size: 0.78rem;
}

.user-table-wrap .table-toolbar .refresh-btn:hover {
    background: var(--canvas);
    color: var(--ink);
}

/* Table */
.user-table-wrap .table-scroll {
    overflow-x: auto;
}

.user-table-wrap table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.85rem;
}

.user-table-wrap table thead {
    background: var(--canvas);
}

.user-table-wrap table th {
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

.user-table-wrap table th .sort {
    margin-left: 0.25rem;
    opacity: 0.3;
    font-size: 0.55rem;
}

.user-table-wrap table th.active-sort .sort {
    opacity: 1;
    color: var(--primary);
}

.user-table-wrap table td {
    padding: 0.6rem 1.25rem;
    border-bottom: 1px solid var(--border);
    vertical-align: middle;
}

.user-table-wrap table tbody tr:hover {
    background: var(--surface-hover);
}

.user-table-wrap table .user-name {
    display: flex;
    align-items: center;
    gap: 0.65rem;
}

.user-table-wrap table .user-name .avatar {
    width: 34px;
    height: 34px;
    border-radius: 50%;
    background: var(--primary-gradient);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-weight: 700;
    font-size: 0.8rem;
    flex-shrink: 0;
}

.user-table-wrap table .user-name .name-text {
    font-weight: 600;
    color: var(--ink);
}

.user-table-wrap table .user-name .email-text {
    font-size: 0.7rem;
    color: var(--ink-muted);
}

.user-table-wrap table .role-badge {
    display: inline-block;
    background: var(--primary-light);
    color: var(--primary);
    padding: 0.1rem 0.6rem;
    border-radius: 12px;
    font-size: 0.65rem;
    font-weight: 500;
    margin: 0.1rem;
}

.user-table-wrap table .status-badge {
    display: inline-block;
    padding: 0.1rem 0.7rem;
    border-radius: 20px;
    font-size: 0.55rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.04em;
}

.user-table-wrap table .status-badge.active {
    background: #d1fae5;
    color: #059669;
}
.user-table-wrap table .status-badge.inactive {
    background: #fee2e2;
    color: #dc2626;
}

[data-theme="dark"] .user-table-wrap table .status-badge.active {
    background: #1a3a2a;
    color: #34d399;
}
[data-theme="dark"] .user-table-wrap table .status-badge.inactive {
    background: #3a1a1a;
    color: #f87171;
}

.user-table-wrap table .action-group {
    display: flex;
    justify-content: center;
    gap: 0.15rem;
    flex-wrap: wrap;
}

.user-table-wrap table .action-group .act-btn {
    background: none;
    border: none;
    color: var(--ink-muted);
    padding: 0.25rem 0.4rem;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.2s ease;
}

.user-table-wrap table .action-group .act-btn:hover {
    background: var(--canvas);
    color: var(--ink);
}

.user-table-wrap table .action-group .act-btn.danger:hover {
    background: #fee2e2;
    color: #dc2626;
}

.user-table-wrap table .action-group .act-btn.primary:hover {
    background: var(--primary-light);
    color: var(--primary);
}

.user-table-wrap table .action-group .act-btn.purple:hover {
    background: #ede9fe;
    color: #7c3aed;
}

/* Table Footer */
.user-table-wrap .table-footer {
    padding: 0.6rem 1.25rem;
    border-top: 1px solid var(--border);
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 0.5rem;
}

.user-table-wrap .table-footer .info-text {
    font-size: 0.78rem;
    color: var(--ink-muted);
}

.user-table-wrap .table-footer .pagination {
    display: flex;
    gap: 0.25rem;
}

.user-table-wrap .table-footer .pagination button {
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

.user-table-wrap .table-footer .pagination button:hover:not(:disabled) {
    background: var(--canvas);
    color: var(--ink);
}

.user-table-wrap .table-footer .pagination button.active {
    background: var(--primary);
    color: #fff;
    border-color: var(--primary);
}

.user-table-wrap .table-footer .pagination button:disabled {
    opacity: 0.4;
    cursor: not-allowed;
}

/* Empty State */
.user-empty {
    padding: 3rem;
    text-align: center;
    color: var(--ink-muted);
}

.user-empty i {
    font-size: 2.5rem;
    display: block;
    margin-bottom: 0.75rem;
    opacity: 0.3;
}

/* ---------- ADD/EDIT USER MODAL ---------- */
.user-modal {
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

.user-modal.show {
    display: flex;
}

.user-modal .modal-box {
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

.user-modal .modal-box .modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
    padding-bottom: 0.75rem;
    border-bottom: 1px solid var(--border);
}

.user-modal .modal-box .modal-header h3 {
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--ink);
}

.user-modal .modal-box .modal-header .modal-close {
    background: none;
    border: none;
    color: var(--ink-muted);
    font-size: 1.2rem;
    cursor: pointer;
    padding: 0.3rem;
    border-radius: 6px;
    transition: all 0.2s ease;
}

.user-modal .modal-box .modal-header .modal-close:hover {
    background: var(--canvas);
    color: var(--ink);
}

.user-modal .modal-box .form-group {
    margin-bottom: 1rem;
}

.user-modal .modal-box .form-group label {
    display: block;
    font-size: 0.78rem;
    font-weight: 600;
    color: var(--ink);
    margin-bottom: 0.3rem;
}

.user-modal .modal-box .form-group input,
.user-modal .modal-box .form-group select,
.user-modal .modal-box .form-group textarea {
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

.user-modal .modal-box .form-group input:focus,
.user-modal .modal-box .form-group select:focus,
.user-modal .modal-box .form-group textarea:focus {
    border-color: var(--primary);
    outline: none;
    box-shadow: 0 0 0 3px rgba(7, 142, 206, 0.1);
}

.user-modal .modal-box .form-group textarea {
    resize: vertical;
    min-height: 80px;
}

.user-modal .modal-box .form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
}

.user-modal .modal-box .form-actions {
    display: flex;
    gap: 0.75rem;
    justify-content: flex-end;
    margin-top: 1.5rem;
    padding-top: 1rem;
    border-top: 1px solid var(--border);
}

.user-modal .modal-box .form-actions .btn-primary {
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

.user-modal .modal-box .form-actions .btn-primary:hover {
    background: var(--primary-dark);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(7, 142, 206, 0.3);
}

.user-modal .modal-box .form-actions .btn-secondary {
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

.user-modal .modal-box .form-actions .btn-secondary:hover {
    border-color: var(--primary);
    color: var(--ink);
    background: var(--surface-hover);
}

.user-modal .modal-box .form-actions .btn-danger {
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

.user-modal .modal-box .form-actions .btn-danger:hover {
    background: #b91c1c;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3);
}

/* View User Modal */
.user-modal .modal-box .view-field {
    display: flex;
    padding: 0.5rem 0;
    border-bottom: 1px solid var(--border-light);
}

.user-modal .modal-box .view-field:last-child {
    border-bottom: none;
}

.user-modal .modal-box .view-field .view-label {
    font-weight: 600;
    color: var(--ink-muted);
    width: 120px;
    flex-shrink: 0;
    font-size: 0.78rem;
}

.user-modal .modal-box .view-field .view-value {
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
    .user-stats-wrapper {
        grid-template-columns: repeat(3, 1fr) !important;
        gap: 0.75rem !important;
    }
    .user-stats-wrapper .stat-card {
        padding: 0.75rem 0.75rem !important;
    }
    .user-stats-wrapper .stat-card .stat-info .stat-number {
        font-size: 1.25rem !important;
    }
    .user-stats-wrapper .stat-card .stat-icon-wrap {
        width: 36px !important;
        height: 36px !important;
        font-size: 0.9rem !important;
    }
    .user-table-wrap .table-toolbar {
        flex-direction: column;
        align-items: stretch;
    }
    .user-table-wrap .table-toolbar .search-box input {
        width: 100%;
    }
    .user-table-wrap .table-toolbar .toolbar-right {
        justify-content: space-between;
    }
    .user-modal .modal-box {
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
    .user-stats-wrapper {
        grid-template-columns: repeat(3, 1fr) !important;
        gap: 0.5rem !important;
    }
    .user-stats-wrapper .stat-card {
        padding: 0.5rem 0.5rem !important;
        gap: 0.5rem !important;
    }
    .user-stats-wrapper .stat-card .stat-info .stat-number {
        font-size: 1rem !important;
    }
    .user-stats-wrapper .stat-card .stat-info .stat-label {
        font-size: 0.55rem !important;
        letter-spacing: 0.02em !important;
    }
    .user-stats-wrapper .stat-card .stat-icon-wrap {
        width: 28px !important;
        height: 28px !important;
        font-size: 0.7rem !important;
        border-radius: 6px !important;
    }
    .user-action-bar {
        flex-direction: column;
        align-items: stretch;
    }
    .user-action-bar .btn-group {
        flex-wrap: wrap;
        justify-content: flex-end;
    }
    .user-table-wrap .table-footer {
        flex-direction: column;
        align-items: center;
        text-align: center;
    }
    .user-modal .modal-box .form-row {
        grid-template-columns: 1fr;
    }
    .user-modal .modal-box .view-field {
        flex-direction: column;
    }
    .user-modal .modal-box .view-field .view-label {
        width: 100%;
        margin-bottom: 0.2rem;
    }
    .user-modal .modal-box {
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
    .user-stats-wrapper {
        grid-template-columns: repeat(3, 1fr) !important;
        gap: 0.35rem !important;
    }
    .user-stats-wrapper .stat-card {
        padding: 0.4rem 0.4rem !important;
        gap: 0.35rem !important;
        border-radius: 6px !important;
    }
    .user-stats-wrapper .stat-card .stat-info .stat-number {
        font-size: 0.85rem !important;
    }
    .user-stats-wrapper .stat-card .stat-info .stat-label {
        font-size: 0.45rem !important;
        letter-spacing: 0.02em !important;
        white-space: nowrap !important;
    }
    .user-stats-wrapper .stat-card .stat-icon-wrap {
        width: 22px !important;
        height: 22px !important;
        font-size: 0.55rem !important;
        border-radius: 4px !important;
    }
    .user-table-wrap .table-toolbar .toolbar-right {
        flex-wrap: wrap;
    }
    .user-table-wrap .table-toolbar .per-page {
        flex: 1;
    }
}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- ============================================================
     STATS CARDS - 3 IN A ROW
     ============================================================ -->
<div style="
    display: grid !important;
    grid-template-columns: repeat(3, 1fr) !important;
    gap: 1rem !important;
    margin-bottom: 1.5rem !important;
    width: 100% !important;
">
    <div style="background: var(--surface, #ffffff) !important; border: 1px solid var(--border, #e3e7ea) !important; border-radius: 10px !important; padding: 1rem 1.25rem !important; transition: all 0.2s ease !important; display: flex !important; align-items: center !important; gap: 0.75rem !important; box-shadow: 0 1px 3px rgba(0,0,0,0.04) !important; min-width: 0 !important; cursor: default !important;">
        <div style="width: 44px !important; height: 44px !important; border-radius: 10px !important; display: flex !important; align-items: center !important; justify-content: center !important; font-size: 1.1rem !important; flex-shrink: 0 !important; background: #dbeafe !important; color: #2563eb !important;">
            <i class="fas fa-users"></i>
        </div>
        <div style="flex: 1 !important; min-width: 0 !important; overflow: hidden !important;">
            <div style="font-size: 1.5rem !important; font-weight: 700 !important; color: var(--ink, #1a2332) !important; line-height: 1.2 !important; letter-spacing: -0.02em !important;" id="statTotal"><?= $total_users ?? 0 ?></div>
            <div style="font-size: 0.7rem !important; font-weight: 500 !important; color: var(--ink-muted, #5c6b74) !important; text-transform: uppercase !important; letter-spacing: 0.04em !important; white-space: nowrap !important; overflow: hidden !important; text-overflow: ellipsis !important;">Total Users</div>
        </div>
    </div>
    <div style="background: var(--surface, #ffffff) !important; border: 1px solid var(--border, #e3e7ea) !important; border-radius: 10px !important; padding: 1rem 1.25rem !important; transition: all 0.2s ease !important; display: flex !important; align-items: center !important; gap: 0.75rem !important; box-shadow: 0 1px 3px rgba(0,0,0,0.04) !important; min-width: 0 !important; cursor: default !important;">
        <div style="width: 44px !important; height: 44px !important; border-radius: 10px !important; display: flex !important; align-items: center !important; justify-content: center !important; font-size: 1.1rem !important; flex-shrink: 0 !important; background: #d1fae5 !important; color: #059669 !important;">
            <i class="fas fa-user-check"></i>
        </div>
        <div style="flex: 1 !important; min-width: 0 !important; overflow: hidden !important;">
            <div style="font-size: 1.5rem !important; font-weight: 700 !important; color: var(--ink, #1a2332) !important; line-height: 1.2 !important; letter-spacing: -0.02em !important;" id="statActive"><?= $active_users ?? 0 ?></div>
            <div style="font-size: 0.7rem !important; font-weight: 500 !important; color: var(--ink-muted, #5c6b74) !important; text-transform: uppercase !important; letter-spacing: 0.04em !important; white-space: nowrap !important; overflow: hidden !important; text-overflow: ellipsis !important;">Active Users</div>
        </div>
    </div>
    <div style="background: var(--surface, #ffffff) !important; border: 1px solid var(--border, #e3e7ea) !important; border-radius: 10px !important; padding: 1rem 1.25rem !important; transition: all 0.2s ease !important; display: flex !important; align-items: center !important; gap: 0.75rem !important; box-shadow: 0 1px 3px rgba(0,0,0,0.04) !important; min-width: 0 !important; cursor: default !important;">
        <div style="width: 44px !important; height: 44px !important; border-radius: 10px !important; display: flex !important; align-items: center !important; justify-content: center !important; font-size: 1.1rem !important; flex-shrink: 0 !important; background: #fee2e2 !important; color: #dc2626 !important;">
            <i class="fas fa-user-times"></i>
        </div>
        <div style="flex: 1 !important; min-width: 0 !important; overflow: hidden !important;">
            <div style="font-size: 1.5rem !important; font-weight: 700 !important; color: var(--ink, #1a2332) !important; line-height: 1.2 !important; letter-spacing: -0.02em !important;" id="statInactive"><?= ($total_users ?? 0) - ($active_users ?? 0) ?></div>
            <div style="font-size: 0.7rem !important; font-weight: 500 !important; color: var(--ink-muted, #5c6b74) !important; text-transform: uppercase !important; letter-spacing: 0.04em !important; white-space: nowrap !important; overflow: hidden !important; text-overflow: ellipsis !important;">Inactive Users</div>
        </div>
    </div>
</div>

<!-- ============================================================
     ACTION BAR - ALIGNED RIGHT
     ============================================================ -->
<div style="
    display: flex !important;
    justify-content: flex-end !important;
    align-items: center !important;
    margin-bottom: 1.5rem !important;
    flex-wrap: wrap !important;
    gap: 0.75rem !important;
    width: 100% !important;
">
    <button onclick="openAddUserModal()" style="
        padding: 0.6rem 1.5rem !important;
        background: var(--primary, #078ece) !important;
        color: #fff !important;
        border: none !important;
        border-radius: 8px !important;
        font-size: 0.85rem !important;
        font-weight: 600 !important;
        cursor: pointer !important;
        transition: all 0.2s ease !important;
        display: inline-flex !important;
        align-items: center !important;
        gap: 0.5rem !important;
        font-family: 'Inter', sans-serif !important;
        box-shadow: 0 2px 4px rgba(7, 142, 206, 0.2) !important;
    ">
        <i class="fas fa-plus"></i> Add User
    </button>
</div>

<!-- ============================================================
     DATATABLE
     ============================================================ -->
<div class="user-table-wrap">
    <div class="table-toolbar">
        <div class="search-box">
            <i class="fas fa-search"></i>
            <input type="text" id="dtSearch" placeholder="Search users...">
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
        <table id="usersTable">
            <thead>
                <tr>
                    <th data-sort="user_id" style="width: 50px;"># <span class="sort">⇅</span></th>
                    <th data-sort="name">User <span class="sort">⇅</span></th>
                    <th data-sort="email">Email <span class="sort">⇅</span></th>
                    <th data-sort="phone">Phone <span class="sort">⇅</span></th>
                    <th>Roles</th>
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

<!-- ============================================================
     ADD/EDIT USER MODAL
     ============================================================ -->
<div class="user-modal" id="userFormModal">
    <div class="modal-box">
        <div class="modal-header">
            <h3 id="formModalTitle">Add User</h3>
            <button class="modal-close" onclick="closeModal('userFormModal')">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <form id="userForm" onsubmit="saveUser(event)">
            <?= csrf_field() ?>
            <input type="hidden" id="formUserId" name="user_id" value="">
            
            <div class="form-group">
                <label for="formName">Full Name *</label>
                <input type="text" id="formName" name="name" placeholder="Enter full name" required>
            </div>
            
            <div class="form-group">
                <label for="formEmail">Email *</label>
                <input type="email" id="formEmail" name="email" placeholder="Enter email address" required>
            </div>
            
            <div class="form-group">
                <label for="formPhone">Phone</label>
                <input type="text" id="formPhone" name="phone" placeholder="Enter phone number">
            </div>
            
            <div class="form-group">
                <label for="formRole">Role</label>
                <select id="formRole" name="role">
                    <option value="enterprise">Enterprise</option>
                    <option value="investor">Investor</option>
                    <option value="nirda_expert">NIRDA Expert</option>
                    <option value="government">Government</option>
                    <option value="analyst">Analyst</option>
                    <option value="administrator">Administrator</option>
                    <option value="super_admin">Super Admin</option>
                </select>
            </div>
            
            <div class="form-group" id="passwordField">
                <label for="formPassword">Password</label>
                <input type="password" id="formPassword" name="password" placeholder="Leave blank to auto-generate">
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
                    <label for="formVerified">Verified</label>
                    <select id="formVerified" name="is_verified">
                        <option value="1">Verified</option>
                        <option value="0">Unverified</option>
                    </select>
                </div>
            </div>
            
            <div class="form-actions">
                <button type="button" class="btn-secondary" onclick="closeModal('userFormModal')">Cancel</button>
                <button type="submit" class="btn-primary" id="formSubmitBtn">Save User</button>
            </div>
        </form>
    </div>
</div>

<!-- ============================================================
     VIEW USER MODAL
     ============================================================ -->
<div class="user-modal" id="userViewModal">
    <div class="modal-box">
        <div class="modal-header">
            <h3>User Details</h3>
            <button class="modal-close" onclick="closeModal('userViewModal')">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div id="viewContent">
            <div class="view-field">
                <span class="view-label">Full Name</span>
                <span class="view-value" id="viewName">-</span>
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
                <span class="view-label">Role</span>
                <span class="view-value" id="viewRole">-</span>
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
            <button type="button" class="btn-secondary" onclick="closeModal('userViewModal')">Close</button>
        </div>
    </div>
</div>

<!-- ============================================================
     DELETE CONFIRM MODAL
     ============================================================ -->
<div class="user-modal" id="deleteUserModal">
    <div class="modal-box" style="max-width: 400px;">
        <div class="modal-header">
            <h3>Confirm Delete</h3>
            <button class="modal-close" onclick="closeModal('deleteUserModal')">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <?= csrf_field() ?>
        <input type="hidden" id="deleteUserId" value="">
        <p style="color: var(--ink-muted); margin-bottom: 1.5rem; font-size: 0.9rem;">
            Are you sure you want to delete this user? This action cannot be undone.
        </p>
        <div class="form-actions">
            <button type="button" class="btn-secondary" onclick="closeModal('deleteUserModal')">Cancel</button>
            <button type="button" class="btn-danger" onclick="confirmDeleteUser()">
                <i class="fas fa-trash"></i> Delete
            </button>
        </div>
    </div>
</div>

<!-- ============================================================
     PERMISSION MODAL
     ============================================================ -->
<div class="user-modal" id="permissionModal">
    <div class="modal-box" style="max-width: 800px;">
        <div class="modal-header">
            <h3 id="permissionModalTitle">User Permissions <small id="permissionUserInfo"></small></h3>
            <button class="modal-close" onclick="closeModal('permissionModal')">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <input type="hidden" id="permissionUserId" value="">
        
        <!-- User Roles Section -->
        <div class="user-roles-section" style="margin-bottom: 1.5rem; padding: 1rem; background: var(--canvas); border-radius: 10px; border: 1px solid var(--border);">
            <h4 style="font-size: 0.85rem; font-weight: 600; color: var(--ink); margin-bottom: 0.75rem;">Assign Roles</h4>
            <div class="role-chips" id="roleChips" style="display: flex; flex-wrap: wrap; gap: 0.5rem;">
                <!-- Roles loaded via AJAX -->
            </div>
        </div>
        
        <!-- Permissions Section -->
        <div class="permission-grid" id="permissionGrid" style="display: grid; grid-template-columns: 1fr; gap: 1rem; margin-bottom: 1.5rem;">
            <!-- Permissions loaded via AJAX -->
        </div>
        
        <div class="form-actions" style="display: flex; gap: 0.75rem; justify-content: flex-end; margin-top: 1.5rem; padding-top: 1rem; border-top: 1px solid var(--border);">
            <button type="button" class="btn-secondary" onclick="closeModal('permissionModal')">Cancel</button>
            <button type="button" class="btn-primary" onclick="saveUserPermissions()">Save Permissions</button>
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
let sortField = 'user_id';
let sortDirection = 'desc';
let totalRecords = 0;
let deleteUserId = null;

function loadTableData() {
    const params = new URLSearchParams({
        page: currentPage,
        per_page: perPage,
        search: searchQuery,
        sort: sortField,
        direction: sortDirection
    });

    fetch('<?= base_url('admin/users/getData') ?>?' + params.toString(), {
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

function renderTable(users) {
    const tbody = document.getElementById('tableBody');
    
    if (!users || users.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td colspan="7">
                    <div class="user-empty">
                        <i class="fas fa-inbox"></i>
                        No users found.
                        <button onclick="openAddUserModal()" style="color: var(--primary); background: none; border: none; cursor: pointer; font-family: 'Inter', sans-serif; font-size: 0.85rem;">Create your first user</button>
                    </div>
                </td>
            </tr>
        `;
        return;
    }

    let html = '';
    users.forEach((user, index) => {
        const startIndex = (currentPage - 1) * perPage;
        const rowNum = startIndex + index + 1;
        const statusClass = user.is_active ? 'active' : 'inactive';
        const statusText = user.is_active ? 'Active' : 'Inactive';
        const eyeIcon = user.is_active ? 'fa-eye' : 'fa-eye-slash';
        const avatar = user.name ? user.name.charAt(0).toUpperCase() : 'U';
        
        let roles = [];
        if (user.role_names) {
            roles = user.role_names.split(', ');
        }

        html += `
            <tr data-id="${user.user_id}">
                <td style="color: var(--ink-muted);">${rowNum}</td>
                <td>
                    <div class="user-name">
                        <div class="avatar">${escapeHtml(avatar)}</div>
                        <div>
                            <div class="name-text">${escapeHtml(user.name)}</div>
                            <div class="email-text">${escapeHtml(user.email)}</div>
                        </div>
                    </div>
                </td>
                <td class="slug-text">${escapeHtml(user.email)}</td>
                <td class="slug-text">${escapeHtml(user.phone || '-')}</td>
                <td>
                    ${roles.map(role => `<span class="role-badge">${escapeHtml(role)}</span>`).join('')}
                </td>
                <td style="text-align: center;">
                    <span class="status-badge ${statusClass}">${statusText}</span>
                </td>
                <td style="text-align: center;">
                    <div class="action-group">
                        <button onclick="openPermissions(${user.user_id}, '${escapeHtml(user.name)}')" class="act-btn purple" title="Set Permissions">
                            <i class="fas fa-key"></i>
                        </button>
                        <button onclick="viewUser(${user.user_id})" class="act-btn" title="View">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button onclick="editUser(${user.user_id})" class="act-btn primary" title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button onclick="toggleStatus(${user.user_id})" class="act-btn" title="Toggle Status">
                            <i class="fas ${eyeIcon}"></i>
                        </button>
                        <button onclick="openDeleteUserModal(${user.user_id})" class="act-btn danger" title="Delete">
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

document.querySelectorAll('#usersTable th[data-sort]').forEach(th => {
    th.addEventListener('click', function() {
        const field = this.dataset.sort;
        if (sortField === field) {
            sortDirection = sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            sortField = field;
            sortDirection = 'asc';
        }
        document.querySelectorAll('#usersTable th[data-sort]').forEach(h => {
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

document.querySelectorAll('.user-modal').forEach(modal => {
    modal.addEventListener('click', function(e) {
        if (e.target === this) {
            this.classList.remove('show');
            document.body.style.overflow = '';
        }
    });
});

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        document.querySelectorAll('.user-modal.show').forEach(modal => {
            modal.classList.remove('show');
            document.body.style.overflow = '';
        });
    }
});

// ============================================================
// ADD/EDIT USER
// ============================================================
function openAddUserModal() {
    document.getElementById('formUserId').value = '';
    document.getElementById('formName').value = '';
    document.getElementById('formEmail').value = '';
    document.getElementById('formPhone').value = '';
    document.getElementById('formRole').value = 'enterprise';
    document.getElementById('formPassword').value = '';
    document.getElementById('formStatus').value = '1';
    document.getElementById('formVerified').value = '1';
    document.getElementById('formModalTitle').textContent = 'Add User';
    document.getElementById('formSubmitBtn').textContent = 'Add User';
    document.getElementById('passwordField').style.display = 'block';
    openModal('userFormModal');
}

function editUser(id) {
    fetch('<?= base_url('admin/users/get') ?>/' + id, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            const user = data.data;
            document.getElementById('formUserId').value = user.user_id;
            document.getElementById('formName').value = user.name;
            document.getElementById('formEmail').value = user.email;
            document.getElementById('formPhone').value = user.phone || '';
            document.getElementById('formRole').value = user.role || 'enterprise';
            document.getElementById('formPassword').value = '';
            document.getElementById('formStatus').value = user.is_active ? '1' : '0';
            document.getElementById('formVerified').value = user.is_verified ? '1' : '0';
            document.getElementById('formModalTitle').textContent = 'Edit User';
            document.getElementById('formSubmitBtn').textContent = 'Update User';
            document.getElementById('passwordField').style.display = 'none';
            if (data.csrf_token) {
                updateCsrfToken(data.csrf_token);
            }
            openModal('userFormModal');
        } else {
            showToast(data.message || 'Failed to load user data', 'Error', 'error');
        }
    })
    .catch(error => {
        console.error('Error loading user:', error);
        showToast('Error loading user data', 'Error', 'error');
    });
}

function saveUser(event) {
    event.preventDefault();
    const form = document.getElementById('userForm');
    const formData = new FormData(form);
    const id = document.getElementById('formUserId').value;
    const url = id ? '<?= base_url('admin/users/update') ?>/' + id : '<?= base_url('admin/users/create') ?>';

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
            closeModal('userFormModal');
            loadTableData();
            updateStats();
            showToast(data.message || 'User saved successfully!', 'Success', 'success');
        } else {
            showToast(data.message || 'Failed to save user', 'Error', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('An error occurred while saving the user.', 'Error', 'error');
    });
}

// ============================================================
// VIEW USER
// ============================================================
function viewUser(id) {
    fetch('<?= base_url('admin/users/get') ?>/' + id, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            const user = data.data;
            document.getElementById('viewName').textContent = user.name;
            document.getElementById('viewEmail').textContent = user.email;
            document.getElementById('viewPhone').textContent = user.phone || '-';
            document.getElementById('viewRole').textContent = user.role || '-';
            document.getElementById('viewStatus').textContent = user.is_active ? 'Active' : 'Inactive';
            document.getElementById('viewVerified').textContent = user.is_verified ? 'Yes' : 'No';
            document.getElementById('viewCreated').textContent = user.created_at || '-';
            document.getElementById('viewUpdated').textContent = user.updated_at || '-';
            if (data.csrf_token) {
                updateCsrfToken(data.csrf_token);
            }
            openModal('userViewModal');
        } else {
            showToast(data.message || 'Failed to load user data', 'Error', 'error');
        }
    })
    .catch(error => {
        console.error('Error loading user:', error);
        showToast('Error loading user data', 'Error', 'error');
    });
}

// ============================================================
// STATUS TOGGLE
// ============================================================
function toggleStatus(id) {
    if (confirm('Are you sure you want to toggle this user\'s status?')) {
        const formData = new FormData();
        formData.set(csrfName, csrfHash);

        fetch('<?= base_url('admin/users/toggle-status') ?>/' + id, {
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

// ============================================================
// DELETE USER
// ============================================================
function openDeleteUserModal(id) {
    deleteUserId = id;
    document.getElementById('deleteUserId').value = id;
    openModal('deleteUserModal');
}

function confirmDeleteUser() {
    if (!deleteUserId) return;
    const formData = new FormData();
    formData.set(csrfName, csrfHash);

    fetch('<?= base_url('admin/users/delete') ?>/' + deleteUserId, {
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
            closeModal('deleteUserModal');
            deleteUserId = null;
            loadTableData();
            updateStats();
            showToast(data.message || 'User deleted successfully!', 'Success', 'success');
        } else {
            showToast(data.message || 'Failed to delete user', 'Error', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('An error occurred while deleting the user.', 'Error', 'error');
    });
}

// ============================================================
// USER PERMISSIONS
// ============================================================
let currentUserId = null;
let allPermissions = [];
let allModules = [];
let currentUserPermissions = [];
let currentUserRoles = [];
let allRoles = [];

function openPermissions(userId, userName) {
    currentUserId = userId;
    document.getElementById('permissionUserId').value = userId;
    document.getElementById('permissionUserInfo').textContent = `- ${escapeHtml(userName)}`;
    document.getElementById('permissionModalTitle').innerHTML = `User Permissions <small>- ${escapeHtml(userName)}</small>`;
    
    document.getElementById('roleChips').innerHTML = '<p style="color: var(--ink-muted);">Loading roles...</p>';
    document.getElementById('permissionGrid').innerHTML = '<p style="color: var(--ink-muted);">Loading permissions...</p>';
    
    openModal('permissionModal');
    loadUserPermissions(userId);
}

function loadUserPermissions(userId) {
    fetch('<?= base_url('admin/users/getUserPermissions') ?>/' + userId, {
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
            
            const result = data.data;
            allModules = result.modules;
            allPermissions = result.all_permissions;
            currentUserPermissions = result.user_permissions || [];
            currentUserRoles = result.user_roles || [];
            
            loadRoles();
            renderPermissions(result);
            renderRoleChips(result);
        } else {
            showToast(data.message || 'Failed to load permissions', 'Error', 'error');
        }
    })
    .catch(error => {
        console.error('Error loading permissions:', error);
        showToast('Error loading permissions', 'Error', 'error');
    });
}

function loadRoles() {
    fetch('<?= base_url('admin/roles/getData') ?>?per_page=100', {
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            allRoles = data.data;
            renderRoleChips({ user_roles: currentUserRoles });
        }
    })
    .catch(error => console.error('Error loading roles:', error));
}

function renderRoleChips(data) {
    const container = document.getElementById('roleChips');
    const userRoles = data.user_roles || [];
    
    if (!allRoles || allRoles.length === 0) {
        container.innerHTML = '<p style="color: var(--ink-muted);">No roles available</p>';
        return;
    }
    
    let html = '';
    allRoles.forEach(role => {
        const checked = userRoles.includes(role.role_id) ? 'checked' : '';
        html += `
            <div class="role-chip" style="display: flex; align-items: center; gap: 0.5rem; padding: 0.3rem 0.75rem; border-radius: 20px; background: var(--primary-light); color: var(--primary); font-size: 0.75rem; font-weight: 500; border: 1px solid var(--primary);">
                <input type="checkbox" id="role_${role.role_id}" value="${role.role_id}" ${checked} onchange="updateRoleSelection()" style="width: 14px; height: 14px; cursor: pointer; accent-color: var(--primary);">
                <label for="role_${role.role_id}">${escapeHtml(role.name)}</label>
            </div>
        `;
    });
    
    container.innerHTML = html;
}

function updateRoleSelection() {
    const selectedRoles = [];
    document.querySelectorAll('#roleChips input[type="checkbox"]:checked').forEach(cb => {
        selectedRoles.push(parseInt(cb.value));
    });
    currentUserRoles = selectedRoles;
}

function renderPermissions(data) {
    const container = document.getElementById('permissionGrid');
    const modules = data.modules || [];
    const userPerms = data.user_permissions || [];
    
    if (!modules || modules.length === 0) {
        container.innerHTML = '<p style="color: var(--ink-muted);">No modules found. Please create modules first.</p>';
        return;
    }
    
    let html = '';
    modules.forEach(module => {
        const modulePerms = allPermissions.filter(p => p.module === module.slug);
        
        if (modulePerms.length === 0) {
            return;
        }
        
        html += `
            <div class="permission-module" style="border: 1px solid var(--border); border-radius: 10px; overflow: hidden;">
                <div class="module-header" onclick="toggleModule(this)" style="background: var(--canvas); padding: 0.75rem 1rem; display: flex; align-items: center; justify-content: space-between; cursor: pointer; transition: all 0.2s ease;">
                    <div class="module-title" style="display: flex; align-items: center; gap: 0.75rem; font-weight: 600; color: var(--ink);">
                        <i class="fas ${module.icon || 'fa-cube'}" style="color: var(--primary);"></i>
                        <span>${escapeHtml(module.name)}</span>
                    </div>
                    <div class="module-actions" style="display: flex; gap: 0.5rem; align-items: center;">
                        <span class="select-all" onclick="event.stopPropagation(); toggleModuleAll(this, '${module.slug}')" style="font-size: 0.7rem; color: var(--ink-muted); cursor: pointer; padding: 0.2rem 0.5rem; border-radius: 4px; border: 1px solid var(--border); background: var(--surface); transition: all 0.2s ease;">Select All</span>
                    </div>
                </div>
                <div class="module-body" style="padding: 0.75rem 1rem; display: grid; grid-template-columns: repeat(4, 1fr); gap: 0.5rem;">
        `;
        
        const permIcons = {
            'view': 'fa-eye',
            'add': 'fa-plus',
            'edit': 'fa-edit',
            'delete': 'fa-trash',
            'manage': 'fa-cogs'
        };
        
        modulePerms.forEach(perm => {
            const isChecked = userPerms.includes(perm.permission_id) ? 'checked' : '';
            const icon = permIcons[perm.slug.split('_').pop()] || 'fa-check';
            let label = perm.name;
            if (label.startsWith(module.name + ' ')) {
                label = label.substring(module.name.length + 1);
            }
            
            html += `
                <div class="perm-check" data-permission-id="${perm.permission_id}" style="display: flex; align-items: center; gap: 0.5rem; padding: 0.3rem 0.5rem; border-radius: 6px; transition: all 0.2s ease;">
                    <input type="checkbox" id="perm_${perm.permission_id}" value="${perm.permission_id}" ${isChecked} 
                           onchange="updatePermissionSelection()" style="width: 16px; height: 16px; cursor: pointer; accent-color: var(--primary);">
                    <label for="perm_${perm.permission_id}" style="font-size: 0.78rem; color: var(--ink); cursor: pointer; user-select: none;">
                        <i class="fas ${icon} perm-icon" style="font-size: 0.7rem; width: 20px; text-align: center; color: var(--primary);"></i>
                        ${escapeHtml(label)}
                    </label>
                </div>
            `;
        });
        
        html += `
                </div>
            </div>
        `;
    });
    
    container.innerHTML = html;
}

function toggleModule(header) {
    const body = header.nextElementSibling;
    if (body) {
        body.style.display = body.style.display === 'none' ? 'grid' : 'none';
    }
}

function toggleModuleAll(element, moduleSlug) {
    const moduleDiv = element.closest('.permission-module');
    const checkboxes = moduleDiv.querySelectorAll('.module-body input[type="checkbox"]');
    const allChecked = Array.from(checkboxes).every(cb => cb.checked);
    checkboxes.forEach(cb => {
        cb.checked = !allChecked;
    });
    updatePermissionSelection();
}

function updatePermissionSelection() {
    const selectedPerms = [];
    document.querySelectorAll('#permissionGrid input[type="checkbox"]:checked').forEach(cb => {
        selectedPerms.push(parseInt(cb.value));
    });
    currentUserPermissions = selectedPerms;
}

function saveUserPermissions() {
    if (!currentUserId) {
        showToast('No user selected', 'Error', 'error');
        return;
    }
    
    const selectedRoles = [];
    document.querySelectorAll('#roleChips input[type="checkbox"]:checked').forEach(cb => {
        selectedRoles.push(parseInt(cb.value));
    });
    
    const saveBtn = document.querySelector('#permissionModal .btn-primary');
    const originalText = saveBtn.innerHTML;
    saveBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';
    saveBtn.disabled = true;
    
    fetch('<?= base_url('admin/users/updateUserPermissions') ?>/' + currentUserId, {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({
            [csrfName]: csrfHash,
            roles: JSON.stringify(selectedRoles)
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            if (data.csrf_token) {
                updateCsrfToken(data.csrf_token);
            }
            showToast('User permissions updated successfully!', 'Success', 'success');
            closeModal('permissionModal');
            loadTableData();
            updateStats();
        } else {
            showToast(data.message || 'Failed to update permissions', 'Error', 'error');
        }
    })
    .catch(error => {
        console.error('Error saving permissions:', error);
        showToast('Error saving permissions', 'Error', 'error');
    })
    .finally(() => {
        saveBtn.innerHTML = originalText;
        saveBtn.disabled = false;
    });
}

// ============================================================
// UPDATE STATS
// ============================================================
function updateStats() {
    fetch('<?= base_url('admin/users/getStats') ?>', {
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
    document.querySelector('#usersTable th[data-sort="user_id"]')?.classList.add('active-sort');
    loadTableData();
});
</script>

<?= $this->endSection() ?>