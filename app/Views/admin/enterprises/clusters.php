<?= $this->extend('admin/layout') ?>

<?= $this->section('styles') ?>
<style>
/* ============================================================
   CLUSTER MANAGEMENT - STYLES
   ============================================================ */

/* ---------- STATS CARDS ---------- */
.cluster-stats-wrapper {
    display: grid !important;
    grid-template-columns: repeat(4, 1fr) !important;
    gap: 1rem !important;
    margin-bottom: 1.5rem !important;
    width: 100% !important;
}

.cluster-stats-wrapper .stat-card {
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

.cluster-stats-wrapper .stat-card:hover {
    border-color: var(--primary);
    box-shadow: 0 4px 12px rgba(0,0,0,0.06);
    transform: translateY(-1px);
}

.cluster-stats-wrapper .stat-card .stat-icon-wrap {
    width: 44px;
    height: 44px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.1rem;
    flex-shrink: 0;
}

.cluster-stats-wrapper .stat-card .stat-icon-wrap.purple {
    background: #ede9fe;
    color: #7c3aed;
}
.cluster-stats-wrapper .stat-card .stat-icon-wrap.green {
    background: #d1fae5;
    color: #059669;
}
.cluster-stats-wrapper .stat-card .stat-icon-wrap.blue {
    background: #dbeafe;
    color: #2563eb;
}
.cluster-stats-wrapper .stat-card .stat-icon-wrap.orange {
    background: #fef3c7;
    color: #d97706;
}

[data-theme="dark"] .cluster-stats-wrapper .stat-card .stat-icon-wrap.purple {
    background: #2d1b4a;
    color: #a78bfa;
}
[data-theme="dark"] .cluster-stats-wrapper .stat-card .stat-icon-wrap.green {
    background: #1a3a2a;
    color: #34d399;
}
[data-theme="dark"] .cluster-stats-wrapper .stat-card .stat-icon-wrap.blue {
    background: #1e293b;
    color: #60a5fa;
}
[data-theme="dark"] .cluster-stats-wrapper .stat-card .stat-icon-wrap.orange {
    background: #3a2a1a;
    color: #fbbf24;
}

.cluster-stats-wrapper .stat-card .stat-info {
    flex: 1;
    min-width: 0;
    overflow: hidden;
}

.cluster-stats-wrapper .stat-card .stat-info .stat-number {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--ink);
    line-height: 1.2;
    letter-spacing: -0.02em;
}

.cluster-stats-wrapper .stat-card .stat-info .stat-label {
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
.cluster-action-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
    flex-wrap: wrap;
    gap: 0.75rem;
    width: 100% !important;
}

.cluster-action-bar .btn-group {
    display: flex;
    gap: 0.75rem;
    flex-wrap: wrap;
}

.cluster-action-bar .btn-primary {
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

.cluster-action-bar .btn-primary:hover {
    background: var(--primary-dark);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(7, 142, 206, 0.35);
}

.cluster-action-bar .btn-success {
    padding: 0.6rem 1.5rem;
    background: #059669;
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
    box-shadow: 0 2px 4px rgba(5, 150, 105, 0.2);
}

.cluster-action-bar .btn-success:hover {
    background: #047857;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(5, 150, 105, 0.35);
}

.cluster-action-bar .btn-outline {
    padding: 0.6rem 1.5rem;
    background: transparent;
    color: var(--ink-muted);
    border: 1.5px solid var(--border);
    border-radius: 8px;
    font-size: 0.85rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s ease;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    font-family: 'Inter', sans-serif;
}

.cluster-action-bar .btn-outline:hover {
    border-color: var(--primary);
    color: var(--ink);
    background: var(--surface-hover);
}

/* ---------- FILTER BAR ---------- */
.cluster-filter-bar {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 10px;
    padding: 0.75rem 1.25rem;
    margin-bottom: 1rem;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 0.75rem;
}

.cluster-filter-bar .filter-label {
    font-size: 0.78rem;
    font-weight: 600;
    color: var(--ink);
}

.cluster-filter-bar select {
    padding: 0.3rem 0.75rem;
    border: 1px solid var(--border);
    border-radius: 6px;
    background: var(--canvas);
    color: var(--ink);
    font-size: 0.78rem;
    cursor: pointer;
    font-family: 'Inter', sans-serif;
    min-width: 150px;
}

.cluster-filter-bar select:focus {
    border-color: var(--primary);
    outline: none;
    box-shadow: 0 0 0 3px rgba(7, 142, 206, 0.1);
}

.cluster-filter-bar .filter-btn {
    padding: 0.3rem 1rem;
    background: var(--primary);
    color: #fff;
    border: none;
    border-radius: 6px;
    font-size: 0.75rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s ease;
    font-family: 'Inter', sans-serif;
}

.cluster-filter-bar .filter-btn:hover {
    background: var(--primary-dark);
}

.cluster-filter-bar .filter-btn-outline {
    padding: 0.3rem 1rem;
    background: transparent;
    color: var(--ink-muted);
    border: 1px solid var(--border);
    border-radius: 6px;
    font-size: 0.75rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s ease;
    font-family: 'Inter', sans-serif;
}

.cluster-filter-bar .filter-btn-outline:hover {
    border-color: var(--primary);
    color: var(--ink);
}

/* ---------- DATATABLE ---------- */
.cluster-table-wrap {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 10px;
    overflow: hidden;
}

.cluster-table-wrap .table-toolbar {
    padding: 0.75rem 1.25rem;
    border-bottom: 1px solid var(--border);
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 0.75rem;
}

.cluster-table-wrap .table-toolbar .search-box {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    background: var(--canvas);
    border: 1px solid var(--border);
    border-radius: 8px;
    padding: 0.3rem 0.75rem;
    transition: all 0.2s ease;
}

.cluster-table-wrap .table-toolbar .search-box:focus-within {
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(7, 142, 206, 0.1);
}

.cluster-table-wrap .table-toolbar .search-box i {
    color: var(--ink-muted);
    font-size: 0.8rem;
}

.cluster-table-wrap .table-toolbar .search-box input {
    border: none;
    background: transparent;
    padding: 0.4rem 0.25rem;
    font-size: 0.8rem;
    color: var(--ink);
    width: 200px;
    outline: none;
    font-family: 'Inter', sans-serif;
}

.cluster-table-wrap .table-toolbar .search-box input::placeholder {
    color: var(--ink-muted);
}

.cluster-table-wrap .table-toolbar .toolbar-right {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.cluster-table-wrap .table-toolbar .per-page {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.78rem;
    color: var(--ink-muted);
}

.cluster-table-wrap .table-toolbar .per-page select {
    padding: 0.25rem 0.5rem;
    border: 1px solid var(--border);
    border-radius: 6px;
    background: var(--surface);
    color: var(--ink);
    font-size: 0.78rem;
    cursor: pointer;
    font-family: 'Inter', sans-serif;
}

.cluster-table-wrap .table-toolbar .refresh-btn {
    padding: 0.3rem 0.7rem;
    border: 1px solid var(--border);
    border-radius: 6px;
    background: var(--surface);
    color: var(--ink-muted);
    cursor: pointer;
    transition: all 0.2s ease;
    font-size: 0.78rem;
}

.cluster-table-wrap .table-toolbar .refresh-btn:hover {
    background: var(--canvas);
    color: var(--ink);
}

/* Table */
.cluster-table-wrap .table-scroll {
    overflow-x: auto;
}

.cluster-table-wrap table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.85rem;
}

.cluster-table-wrap table thead {
    background: var(--canvas);
}

.cluster-table-wrap table th {
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

.cluster-table-wrap table th .sort {
    margin-left: 0.25rem;
    opacity: 0.3;
    font-size: 0.55rem;
}

.cluster-table-wrap table th.active-sort .sort {
    opacity: 1;
    color: var(--primary);
}

.cluster-table-wrap table td {
    padding: 0.6rem 1.25rem;
    border-bottom: 1px solid var(--border);
    vertical-align: middle;
}

.cluster-table-wrap table tbody tr:hover {
    background: var(--surface-hover);
}

.cluster-table-wrap table .cluster-name {
    display: flex;
    align-items: center;
    gap: 0.65rem;
}

.cluster-table-wrap table .cluster-name .icon-box {
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

.cluster-table-wrap table .cluster-name .name-text {
    font-weight: 600;
    color: var(--ink);
}

.cluster-table-wrap table .cluster-name .slug-text {
    font-size: 0.65rem;
    color: var(--ink-muted);
    font-family: monospace;
}

.cluster-table-wrap table .type-badge {
    display: inline-block;
    padding: 0.1rem 0.6rem;
    border-radius: 12px;
    font-size: 0.65rem;
    font-weight: 500;
}

.cluster-table-wrap table .type-badge.sector {
    background: #dbeafe;
    color: #2563eb;
}
.cluster-table-wrap table .type-badge.location {
    background: #d1fae5;
    color: #059669;
}
.cluster-table-wrap table .type-badge.gender {
    background: #fce4ec;
    color: #dc2626;
}
.cluster-table-wrap table .type-badge.youth {
    background: #fef3c7;
    color: #d97706;
}
.cluster-table-wrap table .type-badge.women_led {
    background: #f3e8ff;
    color: #7c3aed;
}
.cluster-table-wrap table .type-badge.pwd {
    background: #e0f7fa;
    color: #0284c7;
}
.cluster-table-wrap table .type-badge.custom {
    background: #f5f5f5;
    color: #6b7280;
}

[data-theme="dark"] .cluster-table-wrap table .type-badge.sector {
    background: #1e293b;
    color: #60a5fa;
}
[data-theme="dark"] .cluster-table-wrap table .type-badge.location {
    background: #1a3a2a;
    color: #34d399;
}
[data-theme="dark"] .cluster-table-wrap table .type-badge.gender {
    background: #3a1a1a;
    color: #f87171;
}
[data-theme="dark"] .cluster-table-wrap table .type-badge.youth {
    background: #3a2a1a;
    color: #fbbf24;
}
[data-theme="dark"] .cluster-table-wrap table .type-badge.women_led {
    background: #2d1b4a;
    color: #a78bfa;
}
[data-theme="dark"] .cluster-table-wrap table .type-badge.pwd {
    background: #0a2a3a;
    color: #38bdf8;
}
[data-theme="dark"] .cluster-table-wrap table .type-badge.custom {
    background: #1a1d27;
    color: #8b95a9;
}

.cluster-table-wrap table .enterprise-count {
    font-weight: 600;
    color: var(--ink);
    font-size: 1rem;
}

.cluster-table-wrap table .status-badge {
    display: inline-block;
    padding: 0.1rem 0.7rem;
    border-radius: 20px;
    font-size: 0.55rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.04em;
}

.cluster-table-wrap table .status-badge.active {
    background: #d1fae5;
    color: #059669;
}
.cluster-table-wrap table .status-badge.inactive {
    background: #fee2e2;
    color: #dc2626;
}

[data-theme="dark"] .cluster-table-wrap table .status-badge.active {
    background: #1a3a2a;
    color: #34d399;
}
[data-theme="dark"] .cluster-table-wrap table .status-badge.inactive {
    background: #3a1a1a;
    color: #f87171;
}

.cluster-table-wrap table .action-group {
    display: flex;
    justify-content: center;
    gap: 0.15rem;
    flex-wrap: wrap;
}

.cluster-table-wrap table .action-group .act-btn {
    background: none;
    border: none;
    color: var(--ink-muted);
    padding: 0.25rem 0.4rem;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.2s ease;
}

.cluster-table-wrap table .action-group .act-btn:hover {
    background: var(--canvas);
    color: var(--ink);
}

.cluster-table-wrap table .action-group .act-btn.danger:hover {
    background: #fee2e2;
    color: #dc2626;
}

.cluster-table-wrap table .action-group .act-btn.primary:hover {
    background: var(--primary-light);
    color: var(--primary);
}

.cluster-table-wrap table .action-group .act-btn.green:hover {
    background: #d1fae5;
    color: #059669;
}

.cluster-table-wrap table .action-group .act-btn.purple:hover {
    background: #ede9fe;
    color: #7c3aed;
}

/* Table Footer */
.cluster-table-wrap .table-footer {
    padding: 0.6rem 1.25rem;
    border-top: 1px solid var(--border);
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 0.5rem;
}

.cluster-table-wrap .table-footer .info-text {
    font-size: 0.78rem;
    color: var(--ink-muted);
}

.cluster-table-wrap .table-footer .pagination {
    display: flex;
    gap: 0.25rem;
}

.cluster-table-wrap .table-footer .pagination button {
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

.cluster-table-wrap .table-footer .pagination button:hover:not(:disabled) {
    background: var(--canvas);
    color: var(--ink);
}

.cluster-table-wrap .table-footer .pagination button.active {
    background: var(--primary);
    color: #fff;
    border-color: var(--primary);
}

.cluster-table-wrap .table-footer .pagination button:disabled {
    opacity: 0.4;
    cursor: not-allowed;
}

/* Empty State */
.cluster-empty {
    padding: 3rem;
    text-align: center;
    color: var(--ink-muted);
}

.cluster-empty i {
    font-size: 2.5rem;
    display: block;
    margin-bottom: 0.75rem;
    opacity: 0.3;
}

/* ---------- MODALS ---------- */
.cluster-modal {
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

.cluster-modal.show {
    display: flex;
}

.cluster-modal .modal-box {
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

.cluster-modal .modal-box .modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
    padding-bottom: 0.75rem;
    border-bottom: 1px solid var(--border);
}

.cluster-modal .modal-box .modal-header h3 {
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--ink);
}

.cluster-modal .modal-box .modal-header .modal-close {
    background: none;
    border: none;
    color: var(--ink-muted);
    font-size: 1.2rem;
    cursor: pointer;
    padding: 0.3rem;
    border-radius: 6px;
    transition: all 0.2s ease;
}

.cluster-modal .modal-box .modal-header .modal-close:hover {
    background: var(--canvas);
    color: var(--ink);
}

.cluster-modal .modal-box .form-group {
    margin-bottom: 1rem;
}

.cluster-modal .modal-box .form-group label {
    display: block;
    font-size: 0.78rem;
    font-weight: 600;
    color: var(--ink);
    margin-bottom: 0.3rem;
}

.cluster-modal .modal-box .form-group input,
.cluster-modal .modal-box .form-group select,
.cluster-modal .modal-box .form-group textarea {
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

.cluster-modal .modal-box .form-group input:focus,
.cluster-modal .modal-box .form-group select:focus,
.cluster-modal .modal-box .form-group textarea:focus {
    border-color: var(--primary);
    outline: none;
    box-shadow: 0 0 0 3px rgba(7, 142, 206, 0.1);
}

.cluster-modal .modal-box .form-group textarea {
    resize: vertical;
    min-height: 80px;
}

.cluster-modal .modal-box .form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
}

.cluster-modal .modal-box .form-actions {
    display: flex;
    gap: 0.75rem;
    justify-content: flex-end;
    margin-top: 1.5rem;
    padding-top: 1rem;
    border-top: 1px solid var(--border);
}

.cluster-modal .modal-box .form-actions .btn-primary {
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

.cluster-modal .modal-box .form-actions .btn-primary:hover {
    background: var(--primary-dark);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(7, 142, 206, 0.3);
}

.cluster-modal .modal-box .form-actions .btn-secondary {
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

.cluster-modal .modal-box .form-actions .btn-secondary:hover {
    border-color: var(--primary);
    color: var(--ink);
    background: var(--surface-hover);
}

.cluster-modal .modal-box .form-actions .btn-danger {
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

.cluster-modal .modal-box .form-actions .btn-danger:hover {
    background: #b91c1c;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3);
}

/* View Cluster Modal */
.cluster-modal .modal-box .view-field {
    display: flex;
    padding: 0.5rem 0;
    border-bottom: 1px solid var(--border-light);
}

.cluster-modal .modal-box .view-field:last-child {
    border-bottom: none;
}

.cluster-modal .modal-box .view-field .view-label {
    font-weight: 600;
    color: var(--ink-muted);
    width: 140px;
    flex-shrink: 0;
    font-size: 0.78rem;
}

.cluster-modal .modal-box .view-field .view-value {
    color: var(--ink);
    font-size: 0.85rem;
}

/* ---------- AUTO-CLUSTER RESULT ---------- */
.auto-cluster-result {
    display: none;
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 10px;
    padding: 1rem 1.25rem;
    margin-bottom: 1rem;
}

.auto-cluster-result.show {
    display: block;
}

.auto-cluster-result .result-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 0.75rem;
}

.auto-cluster-result .result-header .result-title {
    font-weight: 600;
    color: var(--ink);
}

.auto-cluster-result .result-header .result-close {
    background: none;
    border: none;
    color: var(--ink-muted);
    cursor: pointer;
    font-size: 1.1rem;
}

.auto-cluster-result .result-body {
    color: var(--ink-muted);
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
    .cluster-stats-wrapper {
        grid-template-columns: repeat(2, 1fr) !important;
    }
    .cluster-table-wrap .table-toolbar {
        flex-direction: column;
        align-items: stretch;
    }
    .cluster-table-wrap .table-toolbar .search-box input {
        width: 100%;
    }
    .cluster-table-wrap .table-toolbar .toolbar-right {
        justify-content: space-between;
    }
    .cluster-modal .modal-box {
        max-width: 95%;
        margin: 1rem;
    }
    .cluster-action-bar {
        flex-direction: column;
        align-items: stretch;
    }
    .toast-container {
        max-width: 90%;
        right: 10px;
        top: 70px;
    }
}

@media (max-width: 768px) {
    .cluster-stats-wrapper {
        grid-template-columns: 1fr !important;
    }
    .cluster-action-bar .btn-group {
        flex-wrap: wrap;
        justify-content: stretch;
    }
    .cluster-action-bar .btn-primary,
    .cluster-action-bar .btn-success,
    .cluster-action-bar .btn-outline {
        width: 100%;
        justify-content: center;
    }
    .cluster-filter-bar {
        flex-direction: column;
        align-items: stretch;
    }
    .cluster-filter-bar select {
        width: 100%;
    }
    .cluster-table-wrap .table-footer {
        flex-direction: column;
        align-items: center;
        text-align: center;
    }
    .cluster-modal .modal-box .form-row {
        grid-template-columns: 1fr;
    }
    .cluster-modal .modal-box .view-field {
        flex-direction: column;
    }
    .cluster-modal .modal-box .view-field .view-label {
        width: 100%;
        margin-bottom: 0.2rem;
    }
    .cluster-modal .modal-box {
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
    .cluster-stats-wrapper .stat-card {
        padding: 0.75rem !important;
    }
    .cluster-stats-wrapper .stat-card .stat-info .stat-number {
        font-size: 1.25rem !important;
    }
    .cluster-stats-wrapper .stat-card .stat-icon-wrap {
        width: 36px !important;
        height: 36px !important;
        font-size: 0.9rem !important;
    }
    .cluster-table-wrap .table-toolbar .toolbar-right {
        flex-wrap: wrap;
    }
    .cluster-table-wrap .table-toolbar .per-page {
        flex: 1;
    }
}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- ============================================================
     STATS CARDS
     ============================================================ -->
<div class="cluster-stats-wrapper">
    <div class="stat-card">
        <div class="stat-icon-wrap purple">
            <i class="fas fa-layer-group"></i>
        </div>
        <div class="stat-info">
            <div class="stat-number" id="statTotal"><?= $total_clusters ?? 0 ?></div>
            <div class="stat-label">Total Clusters</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon-wrap green">
            <i class="fas fa-check-circle"></i>
        </div>
        <div class="stat-info">
            <div class="stat-number" id="statActive"><?= $active_clusters ?? 0 ?></div>
            <div class="stat-label">Active Clusters</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon-wrap blue">
            <i class="fas fa-building"></i>
        </div>
        <div class="stat-info">
            <div class="stat-number" id="statEnterprises">0</div>
            <div class="stat-label">Enterprises in Clusters</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon-wrap orange">
            <i class="fas fa-tag"></i>
        </div>
        <div class="stat-info">
            <div class="stat-number" id="statTypes">6</div>
            <div class="stat-label">Cluster Types</div>
        </div>
    </div>
</div>

<!-- ============================================================
     AUTO-CLUSTER RESULT
     ============================================================ -->
<div class="auto-cluster-result" id="autoClusterResult">
    <div class="result-header">
        <span class="result-title"><i class="fas fa-check-circle" style="color: #059669;"></i> Auto-Cluster Complete</span>
        <button class="result-close" onclick="document.getElementById('autoClusterResult').classList.remove('show')">
            <i class="fas fa-times"></i>
        </button>
    </div>
    <div class="result-body" id="autoClusterMessage">
        <!-- Result message will be inserted here -->
    </div>
</div>

<!-- ============================================================
     FILTER BAR
     ============================================================ -->
<div class="cluster-filter-bar">
    <span class="filter-label"><i class="fas fa-filter"></i> Filter by Type:</span>
    <select id="filterType">
        <option value="">All Types</option>
        <option value="sector">Sector Based</option>
        <option value="location">Location Based</option>
        <option value="gender">Gender Based</option>
        <
        