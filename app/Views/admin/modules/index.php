<?= $this->extend('admin/layout') ?>

<?= $this->section('styles') ?>
<style>
/* ============================================================
   MODULE MANAGEMENT - COMPLETE STYLES
   ============================================================ */

.module-stats-wrapper {
    display: grid !important;
    grid-template-columns: repeat(4, 1fr) !important;
    gap: 1rem !important;
    margin-bottom: 1.5rem !important;
    width: 100% !important;
}

.module-stats-wrapper .stat-card {
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

.module-stats-wrapper .stat-card:hover {
    border-color: var(--primary);
    box-shadow: 0 4px 12px rgba(0,0,0,0.06);
    transform: translateY(-1px);
}

.module-stats-wrapper .stat-card .stat-icon-wrap {
    width: 44px;
    height: 44px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.1rem;
    flex-shrink: 0;
}

.module-stats-wrapper .stat-card .stat-icon-wrap.blue {
    background: #dbeafe;
    color: #2563eb;
}
.module-stats-wrapper .stat-card .stat-icon-wrap.green {
    background: #d1fae5;
    color: #059669;
}
.module-stats-wrapper .stat-card .stat-icon-wrap.red {
    background: #fee2e2;
    color: #dc2626;
}
.module-stats-wrapper .stat-card .stat-icon-wrap.purple {
    background: #ede9fe;
    color: #7c3aed;
}

[data-theme="dark"] .module-stats-wrapper .stat-card .stat-icon-wrap.blue {
    background: #1e293b;
    color: #60a5fa;
}
[data-theme="dark"] .module-stats-wrapper .stat-card .stat-icon-wrap.green {
    background: #1a3a2a;
    color: #34d399;
}
[data-theme="dark"] .module-stats-wrapper .stat-card .stat-icon-wrap.red {
    background: #3a1a1a;
    color: #f87171;
}
[data-theme="dark"] .module-stats-wrapper .stat-card .stat-icon-wrap.purple {
    background: #2a1a3a;
    color: #a78bfa;
}

.module-stats-wrapper .stat-card .stat-info {
    flex: 1;
    min-width: 0;
    overflow: hidden;
}

.module-stats-wrapper .stat-card .stat-info .stat-number {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--ink);
    line-height: 1.2;
    letter-spacing: -0.02em;
}

.module-stats-wrapper .stat-card .stat-info .stat-label {
    font-size: 0.7rem;
    font-weight: 500;
    color: var(--ink-muted);
    text-transform: uppercase;
    letter-spacing: 0.04em;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.module-action-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
    flex-wrap: wrap;
    gap: 0.5rem;
}

.module-action-bar .btn-group {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.module-action-bar .btn-primary {
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

.module-action-bar .btn-primary:hover {
    background: var(--primary-dark);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(7, 142, 206, 0.3);
}

.module-action-bar .btn-success {
    padding: 0.5rem 1.25rem;
    background: #059669;
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

.module-action-bar .btn-success:hover {
    background: #047857;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(5, 150, 105, 0.3);
}

.module-action-bar .btn-outline {
    padding: 0.5rem 1.25rem;
    background: transparent;
    color: var(--ink-muted);
    border: 1.5px solid var(--border);
    border-radius: 8px;
    font-size: 0.8rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s ease;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    font-family: 'Inter', sans-serif;
}

.module-action-bar .btn-outline:hover {
    border-color: var(--primary);
    color: var(--ink);
    background: var(--surface-hover);
}

.module-table-wrap {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 10px;
    overflow: hidden;
}

.module-table-wrap .table-toolbar {
    padding: 0.75rem 1.25rem;
    border-bottom: 1px solid var(--border);
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 0.75rem;
}

.module-table-wrap .table-toolbar .search-box {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    background: var(--canvas);
    border: 1px solid var(--border);
    border-radius: 8px;
    padding: 0.3rem 0.75rem;
    transition: all 0.2s ease;
}

.module-table-wrap .table-toolbar .search-box:focus-within {
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(7, 142, 206, 0.1);
}

.module-table-wrap .table-toolbar .search-box i {
    color: var(--ink-muted);
    font-size: 0.8rem;
}

.module-table-wrap .table-toolbar .search-box input {
    border: none;
    background: transparent;
    padding: 0.4rem 0.25rem;
    font-size: 0.8rem;
    color: var(--ink);
    width: 200px;
    outline: none;
    font-family: 'Inter', sans-serif;
}

.module-table-wrap .table-toolbar .search-box input::placeholder {
    color: var(--ink-muted);
}

.module-table-wrap .table-toolbar .toolbar-right {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    flex-wrap: wrap;
}

.module-table-wrap .table-toolbar .per-page {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.78rem;
    color: var(--ink-muted);
}

.module-table-wrap .table-toolbar .per-page select {
    padding: 0.25rem 0.5rem;
    border: 1px solid var(--border);
    border-radius: 6px;
    background: var(--surface);
    color: var(--ink);
    font-size: 0.78rem;
    cursor: pointer;
    font-family: 'Inter', sans-serif;
}

.module-table-wrap .table-toolbar .refresh-btn {
    padding: 0.3rem 0.7rem;
    border: 1px solid var(--border);
    border-radius: 6px;
    background: var(--surface);
    color: var(--ink-muted);
    cursor: pointer;
    transition: all 0.2s ease;
    font-size: 0.78rem;
}

.module-table-wrap .table-toolbar .refresh-btn:hover {
    background: var(--canvas);
    color: var(--ink);
}

.module-table-wrap .table-scroll {
    overflow-x: auto;
}

.module-table-wrap table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.85rem;
}

.module-table-wrap table thead {
    background: var(--canvas);
}

.module-table-wrap table th {
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

.module-table-wrap table th .sort {
    margin-left: 0.25rem;
    opacity: 0.3;
    font-size: 0.55rem;
}

.module-table-wrap table th.active-sort .sort {
    opacity: 1;
    color: var(--primary);
}

.module-table-wrap table td {
    padding: 0.6rem 1.25rem;
    border-bottom: 1px solid var(--border);
    vertical-align: middle;
}

.module-table-wrap table tbody tr:hover {
    background: var(--surface-hover);
}

.module-table-wrap table .module-name {
    display: flex;
    align-items: center;
    gap: 0.65rem;
}

.module-table-wrap table .module-name .icon-box {
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

.module-table-wrap table .module-name .name-text {
    font-weight: 600;
    color: var(--ink);
}

.module-table-wrap table .module-name .order-text {
    font-size: 0.6rem;
    color: var(--ink-muted);
}

.module-table-wrap table .module-name .category-badge {
    font-size: 0.55rem;
    font-weight: 600;
    padding: 0.05rem 0.5rem;
    border-radius: 10px;
    background: #ede9fe;
    color: #7c3aed;
}

.module-table-wrap table .slug-text {
    color: var(--ink-muted);
    font-family: monospace;
    font-size: 0.75rem;
}

.module-table-wrap table .desc-text {
    color: var(--ink-muted);
    font-size: 0.78rem;
    max-width: 200px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.module-table-wrap table .perm-badge {
    display: inline-block;
    background: var(--primary-light);
    color: var(--primary);
    padding: 0.1rem 0.6rem;
    border-radius: 12px;
    font-size: 0.7rem;
    font-weight: 600;
}

.module-table-wrap table .status-badge {
    display: inline-block;
    padding: 0.1rem 0.7rem;
    border-radius: 20px;
    font-size: 0.55rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.04em;
}

.module-table-wrap table .status-badge.active {
    background: #d1fae5;
    color: #059669;
}
.module-table-wrap table .status-badge.inactive {
    background: #fee2e2;
    color: #dc2626;
}

[data-theme="dark"] .module-table-wrap table .status-badge.active {
    background: #1a3a2a;
    color: #34d399;
}
[data-theme="dark"] .module-table-wrap table .status-badge.inactive {
    background: #3a1a1a;
    color: #f87171;
}

.module-table-wrap table .action-group {
    display: flex;
    justify-content: center;
    gap: 0.15rem;
}

.module-table-wrap table .action-group .act-btn {
    background: none;
    border: none;
    color: var(--ink-muted);
    padding: 0.25rem 0.4rem;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.2s ease;
}

.module-table-wrap table .action-group .act-btn:hover {
    background: var(--canvas);
    color: var(--ink);
}

.module-table-wrap table .action-group .act-btn.danger:hover {
    background: #fee2e2;
    color: #dc2626;
}

.module-table-wrap table .action-group .act-btn.primary:hover {
    background: var(--primary-light);
    color: var(--primary);
}

.module-table-wrap table .category-row td {
    background: var(--canvas);
    font-weight: 600;
}

.module-table-wrap .table-footer {
    padding: 0.6rem 1.25rem;
    border-top: 1px solid var(--border);
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 0.5rem;
}

.module-table-wrap .table-footer .info-text {
    font-size: 0.78rem;
    color: var(--ink-muted);
}

.module-table-wrap .table-footer .pagination {
    display: flex;
    gap: 0.25rem;
}

.module-table-wrap .table-footer .pagination button {
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

.module-table-wrap .table-footer .pagination button:hover:not(:disabled) {
    background: var(--canvas);
    color: var(--ink);
}

.module-table-wrap .table-footer .pagination button.active {
    background: var(--primary);
    color: #fff;
    border-color: var(--primary);
}

.module-table-wrap .table-footer .pagination button:disabled {
    opacity: 0.4;
    cursor: not-allowed;
}

.module-empty {
    padding: 3rem;
    text-align: center;
    color: var(--ink-muted);
}

.module-empty i {
    font-size: 2.5rem;
    display: block;
    margin-bottom: 0.75rem;
    opacity: 0.3;
}

.module-empty button {
    color: var(--primary);
    background: none;
    border: none;
    cursor: pointer;
    font-family: 'Inter', sans-serif;
    font-size: 0.85rem;
    text-decoration: underline;
}

.module-empty button:hover {
    color: var(--primary-dark);
}

/* Icon Dropdown */
.icon-dropdown-wrapper {
    position: relative;
}

.icon-dropdown-wrapper .icon-preview {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.4rem 0.75rem;
    border: 1px solid var(--border);
    border-radius: 8px;
    background: var(--canvas);
    cursor: pointer;
    transition: all 0.2s ease;
}

.icon-dropdown-wrapper .icon-preview:hover {
    border-color: var(--primary);
}

.icon-dropdown-wrapper .icon-preview .preview-icon {
    width: 32px;
    height: 32px;
    border-radius: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: var(--primary-light);
    color: var(--primary);
    font-size: 0.9rem;
}

.icon-dropdown-wrapper .icon-preview .preview-text {
    flex: 1;
    font-size: 0.85rem;
    color: var(--ink-muted);
}

.icon-dropdown-wrapper .icon-preview .preview-text .selected-icon-name {
    color: var(--ink);
    font-weight: 500;
}

.icon-dropdown-wrapper .icon-preview .preview-arrow {
    color: var(--ink-muted);
    font-size: 0.7rem;
    transition: transform 0.3s ease;
}

.icon-dropdown-wrapper .icon-preview .preview-arrow.open {
    transform: rotate(180deg);
}

.icon-dropdown-wrapper .icon-options {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    max-height: 300px;
    overflow-y: auto;
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 8px;
    margin-top: 0.25rem;
    z-index: 1000;
    box-shadow: 0 10px 40px rgba(0,0,0,0.15);
    display: none;
}

.icon-dropdown-wrapper .icon-options.show {
    display: block;
}

.icon-dropdown-wrapper .icon-search-wrapper {
    position: sticky;
    top: 0;
    background: var(--surface);
    padding: 0.5rem;
    border-bottom: 1px solid var(--border);
    z-index: 1;
}

.icon-dropdown-wrapper .icon-search-wrapper .icon-search-input {
    width: 100%;
    padding: 0.35rem 0.75rem 0.35rem 2.2rem;
    border: 1px solid var(--border);
    border-radius: 6px;
    background: var(--canvas);
    color: var(--ink);
    font-size: 0.8rem;
    font-family: 'Inter', sans-serif;
    transition: all 0.2s ease;
}

.icon-dropdown-wrapper .icon-search-wrapper .icon-search-input:focus {
    border-color: var(--primary);
    outline: none;
    box-shadow: 0 0 0 3px rgba(7, 142, 206, 0.1);
}

.icon-dropdown-wrapper .icon-search-wrapper .icon-search-icon {
    position: absolute;
    top: 0.7rem;
    left: 1.2rem;
    color: var(--ink-muted);
    font-size: 0.8rem;
}

.icon-dropdown-wrapper .icon-options .icon-option {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.4rem 0.75rem;
    cursor: pointer;
    transition: all 0.2s ease;
    font-size: 0.85rem;
    color: var(--ink);
}

.icon-dropdown-wrapper .icon-options .icon-option:hover {
    background: var(--canvas);
}

.icon-dropdown-wrapper .icon-options .icon-option.selected {
    background: var(--primary-light);
    color: var(--primary);
}

.icon-dropdown-wrapper .icon-options .icon-option i {
    width: 20px;
    text-align: center;
    font-size: 0.9rem;
    color: var(--primary);
}

.icon-dropdown-wrapper .icon-options .icon-option .icon-label {
    flex: 1;
}

.icon-dropdown-wrapper .icon-options .icon-option .icon-class {
    font-size: 0.6rem;
    color: var(--ink-muted);
    font-family: monospace;
}

.icon-dropdown-wrapper .icon-options .icon-option .icon-check {
    color: var(--primary);
}

[data-theme="dark"] .icon-dropdown-wrapper .icon-options {
    background: #1a1d27;
    border-color: #2d3344;
}
[data-theme="dark"] .icon-dropdown-wrapper .icon-options .icon-option:hover {
    background: #242836;
}
[data-theme="dark"] .icon-dropdown-wrapper .icon-options .icon-option.selected {
    background: #0a2a3a;
}

/* Modals */
.module-modal {
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

.module-modal.show {
    display: flex;
}

.module-modal .modal-box {
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
    from { opacity: 0; transform: translateY(-20px) scale(0.95); }
    to { opacity: 1; transform: translateY(0) scale(1); }
}

.module-modal .modal-box .modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
    padding-bottom: 0.75rem;
    border-bottom: 1px solid var(--border);
}

.module-modal .modal-box .modal-header h3 {
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--ink);
}

.module-modal .modal-box .modal-header .modal-close {
    background: none;
    border: none;
    color: var(--ink-muted);
    font-size: 1.2rem;
    cursor: pointer;
    padding: 0.3rem;
    border-radius: 6px;
    transition: all 0.2s ease;
}

.module-modal .modal-box .modal-header .modal-close:hover {
    background: var(--canvas);
    color: var(--ink);
}

.module-modal .modal-box .form-group {
    margin-bottom: 1rem;
}

.module-modal .modal-box .form-group label {
    display: block;
    font-size: 0.78rem;
    font-weight: 600;
    color: var(--ink);
    margin-bottom: 0.3rem;
}

.module-modal .modal-box .form-group input,
.module-modal .modal-box .form-group select,
.module-modal .modal-box .form-group textarea {
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

.module-modal .modal-box .form-group input:focus,
.module-modal .modal-box .form-group select:focus,
.module-modal .modal-box .form-group textarea:focus {
    border-color: var(--primary);
    outline: none;
    box-shadow: 0 0 0 3px rgba(7, 142, 206, 0.1);
}

.module-modal .modal-box .form-group .hint {
    font-size: 0.7rem;
    color: var(--ink-muted);
    margin-top: 0.25rem;
}

.module-modal .modal-box .form-group .hint i {
    margin-right: 0.25rem;
}

.module-modal .modal-box .form-group textarea {
    resize: vertical;
    min-height: 80px;
}

.module-modal .modal-box .form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
}

.module-modal .modal-box .form-actions {
    display: flex;
    gap: 0.75rem;
    justify-content: flex-end;
    margin-top: 1.5rem;
    padding-top: 1rem;
    border-top: 1px solid var(--border);
}

.module-modal .modal-box .form-actions .btn-primary {
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

.module-modal .modal-box .form-actions .btn-primary:hover {
    background: var(--primary-dark);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(7, 142, 206, 0.3);
}

.module-modal .modal-box .form-actions .btn-secondary {
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

.module-modal .modal-box .form-actions .btn-secondary:hover {
    border-color: var(--primary);
    color: var(--ink);
    background: var(--surface-hover);
}

.module-modal .modal-box .form-actions .btn-danger {
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

.module-modal .modal-box .form-actions .btn-danger:hover {
    background: #b91c1c;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3);
}

/* Permission Question */
.permission-question {
    background: var(--primary-light);
    padding: 1rem;
    border-radius: 8px;
    margin-bottom: 1rem;
    border: 1px solid var(--primary);
    display: none;
}

.permission-question .pq-header {
    display: flex;
    align-items: flex-start;
    gap: 0.75rem;
}

.permission-question .pq-icon {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: var(--primary);
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    margin-top: 0.1rem;
}

.permission-question .pq-title {
    font-weight: 600;
    color: var(--ink);
    font-size: 0.9rem;
    margin-bottom: 0.2rem;
}

.permission-question .pq-desc {
    font-size: 0.8rem;
    color: var(--ink-muted);
    margin-bottom: 0.75rem;
}

.permission-question .pq-options {
    display: flex;
    gap: 1.5rem;
    flex-wrap: wrap;
}

.permission-question .pq-options label {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    cursor: pointer;
    font-size: 0.85rem;
    padding: 0.3rem 0.8rem;
    border-radius: 6px;
    background: var(--surface);
    border: 1px solid var(--border);
}

.permission-question .pq-options label .label-yes {
    color: var(--ink);
    font-weight: 500;
}

.permission-question .pq-options label .label-no {
    color: var(--ink-muted);
}

.permission-question .pq-options label .hint-text {
    color: var(--ink-muted);
    font-size: 0.7rem;
}

.permission-question .pq-options input[type="radio"] {
    accent-color: var(--primary);
    width: 16px;
    height: 16px;
}

/* View Modal */
.module-modal .modal-box .view-field {
    display: flex;
    padding: 0.5rem 0;
    border-bottom: 1px solid var(--border-light);
}

.module-modal .modal-box .view-field:last-child {
    border-bottom: none;
}

.module-modal .modal-box .view-field .view-label {
    font-weight: 600;
    color: var(--ink-muted);
    width: 120px;
    flex-shrink: 0;
    font-size: 0.78rem;
}

.module-modal .modal-box .view-field .view-value {
    color: var(--ink);
    font-size: 0.85rem;
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

@keyframes slideOutRight {
    from { transform: translateX(0); opacity: 1; }
    to { transform: translateX(100%); opacity: 0; }
}

/* Responsive */
@media (max-width: 992px) {
    .module-stats-wrapper {
        grid-template-columns: repeat(2, 1fr) !important;
    }
    .module-table-wrap .table-toolbar {
        flex-direction: column;
        align-items: stretch;
    }
    .module-table-wrap .table-toolbar .search-box input {
        width: 100%;
    }
    .module-table-wrap .table-toolbar .toolbar-right {
        justify-content: space-between;
    }
    .module-modal .modal-box {
        max-width: 90%;
        margin: 1rem;
    }
}

@media (max-width: 768px) {
    .module-stats-wrapper {
        grid-template-columns: 1fr 1fr !important;
        gap: 0.5rem !important;
    }
    .module-stats-wrapper .stat-card {
        padding: 0.75rem 0.75rem !important;
    }
    .module-stats-wrapper .stat-card .stat-info .stat-number {
        font-size: 1.25rem !important;
    }
    .module-stats-wrapper .stat-card .stat-icon-wrap {
        width: 36px !important;
        height: 36px !important;
        font-size: 0.9rem !important;
    }
    .module-action-bar {
        flex-direction: column;
        align-items: stretch;
    }
    .module-action-bar .btn-group {
        flex-wrap: wrap;
    }
    .module-table-wrap .table-footer {
        flex-direction: column;
        align-items: center;
        text-align: center;
    }
    .module-modal .modal-box .form-row {
        grid-template-columns: 1fr;
    }
    .module-modal .modal-box .view-field {
        flex-direction: column;
    }
    .module-modal .modal-box .view-field .view-label {
        width: 100%;
        margin-bottom: 0.2rem;
    }
    .module-modal .modal-box {
        padding: 1.25rem;
    }
}

@media (max-width: 576px) {
    .module-stats-wrapper {
        grid-template-columns: 1fr 1fr !important;
        gap: 0.35rem !important;
    }
    .module-stats-wrapper .stat-card {
        padding: 0.5rem 0.5rem !important;
        gap: 0.5rem !important;
    }
    .module-stats-wrapper .stat-card .stat-info .stat-number {
        font-size: 1rem !important;
    }
    .module-stats-wrapper .stat-card .stat-info .stat-label {
        font-size: 0.55rem !important;
    }
    .module-stats-wrapper .stat-card .stat-icon-wrap {
        width: 28px !important;
        height: 28px !important;
        font-size: 0.7rem !important;
        border-radius: 6px !important;
    }
    .module-table-wrap table .desc-text {
        display: none;
    }
}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Stats Cards -->
<div class="module-stats-wrapper">
    <div class="stat-card">
        <div class="stat-icon-wrap blue"><i class="fas fa-cubes"></i></div>
        <div class="stat-info">
            <div class="stat-number" id="statTotal"><?= $total_modules ?? 0 ?></div>
            <div class="stat-label">Total Modules</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon-wrap green"><i class="fas fa-check-circle"></i></div>
        <div class="stat-info">
            <div class="stat-number" id="statActive"><?= $active_modules ?? 0 ?></div>
            <div class="stat-label">Active Modules</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon-wrap red"><i class="fas fa-times-circle"></i></div>
        <div class="stat-info">
            <div class="stat-number" id="statInactive"><?= ($total_modules ?? 0) - ($active_modules ?? 0) ?></div>
            <div class="stat-label">Inactive Modules</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon-wrap purple"><i class="fas fa-folder-tree"></i></div>
        <div class="stat-info">
            <div class="stat-number" id="statCategories"><?= $category_count ?? 0 ?></div>
            <div class="stat-label">Categories</div>
        </div>
    </div>
</div>

<!-- Action Bar -->
<div class="module-action-bar">
    <div class="btn-group">
        <button onclick="openAddModal()" class="btn-primary">
            <i class="fas fa-plus"></i> Add Module
        </button>
        <button onclick="openAddCategoryModal()" class="btn-success">
            <i class="fas fa-folder-plus"></i> Add Category
        </button>
        <button onclick="enableReorder()" class="btn-outline" id="reorderBtn">
            <i class="fas fa-arrows-alt"></i> Reorder
        </button>
    </div>
</div>

<!-- Data Table -->
<div class="module-table-wrap">
    <div class="table-toolbar">
        <div class="search-box">
            <i class="fas fa-search"></i>
            <input type="text" id="dtSearch" placeholder="Search modules...">
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
        <table id="modulesTable">
            <thead>
                <tr>
                    <th data-sort="sort_order" style="width: 50px;"># <span class="sort">⇅</span></th>
                    <th data-sort="name">Module <span class="sort">⇅</span></th>
                    <th data-sort="slug">Slug <span class="sort">⇅</span></th>
                    <th data-sort="description">Description <span class="sort">⇅</span></th>
                    <th data-sort="permission_count" style="text-align: center;">Permissions <span class="sort">⇅</span></th>
                    <th data-sort="is_active" style="text-align: center;">Status <span class="sort">⇅</span></th>
                    <th style="text-align: center; width: 120px;">Actions</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                <!-- Loaded via AJAX -->
            </tbody>
        </table>
    </div>

    <div class="table-footer">
        <div class="info-text">
            Showing <span id="dtStart">0</span> to <span id="dtEnd">0</span> of <span id="dtTotal">0</span> entries
        </div>
        <div class="pagination" id="dtPagination">
            <!-- Rendered by JS -->
        </div>
    </div>
</div>

<!-- ============================================================
     ADD/EDIT MODULE MODAL
     ============================================================ -->
<div class="module-modal" id="moduleFormModal">
    <div class="modal-box">
        <div class="modal-header">
            <h3 id="formModalTitle">Add Module</h3>
            <button class="modal-close" onclick="closeModal('moduleFormModal')">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <form id="moduleForm" onsubmit="saveModule(event)">
            <?= csrf_field() ?>
            <input type="hidden" id="formModuleId" name="module_id" value="">
            
            <div class="form-group">
                <label for="formName">Module Name *</label>
                <input type="text" id="formName" name="name" placeholder="Enter module name" required>
                <div class="hint"><i class="fas fa-magic"></i> Slug will be auto-generated from the name</div>
            </div>
            
            <div class="form-group">
                <label for="formSlug">Slug</label>
                <div style="display: flex; gap: 0.5rem;">
                    <input type="text" id="formSlug" name="slug" placeholder="Auto-generated from name" style="flex: 1;">
                    <button type="button" onclick="generateSlugManually()" class="btn-outline" style="padding: 0.3rem 0.8rem; font-size: 0.75rem; white-space: nowrap; border-color: var(--border);">
                        <i class="fas fa-magic"></i> Generate
                    </button>
                </div>
                <div class="hint"><i class="fas fa-edit"></i> Slug will be auto-generated from the name, or click Generate</div>
            </div>

            <div class="form-group">
                <label for="formParentId">Parent Category</label>
                <select id="formParentId" name="parent_id">
                    <option value="">None (Standalone)</option>
                    <?php if (!empty($categories)): ?>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= $category['module_id'] ?>"><?= $category['name'] ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>
            
            <div class="form-group">
                <label for="formIsCategory">Type</label>
                <select id="formIsCategory" name="is_category" onchange="togglePermissionQuestion()">
                    <option value="0">Module (Sub-menu)</option>
                    <option value="1">Category (Parent)</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="formIcon">Icon</label>
                <div class="icon-dropdown-wrapper" id="iconDropdown">
                    <div class="icon-preview" onclick="toggleIconDropdown()">
                        <div class="preview-icon" id="previewIcon"><i class="fas fa-cube"></i></div>
                        <div class="preview-text">
                            <span class="selected-icon-name" id="selectedIconName">Select an icon</span>
                            <span style="color: var(--ink-muted); font-size: 0.7rem; display: block;">Click to browse icons</span>
                        </div>
                        <div class="preview-arrow" id="dropdownArrow"><i class="fas fa-chevron-down"></i></div>
                    </div>
                    <div class="icon-options" id="iconOptions">
                        <div class="icon-search-wrapper" style="position: relative;">
                            <i class="fas fa-search icon-search-icon"></i>
                            <input type="text" class="icon-search-input" id="iconSearch" placeholder="Search icons..." oninput="filterIcons(this.value)">
                        </div>
                        <div id="iconList" style="max-height: 250px; overflow-y: auto;">
                            <!-- Icons will be rendered by JS -->
                        </div>
                    </div>
                    <input type="hidden" id="formIcon" name="icon" value="fa-cube">
                </div>
                <div class="hint"><i class="fas fa-icons"></i> Search and select a FontAwesome icon</div>
            </div>
            
            <div class="form-group">
                <label for="formDescription">Description</label>
                <textarea id="formDescription" name="description" placeholder="Enter module description" rows="3"></textarea>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="formSortOrder">Sort Order</label>
                    <input type="number" id="formSortOrder" name="sort_order" value="0" min="0">
                    <div class="hint"><i class="fas fa-arrow-up"></i> Auto-generated, you can change it</div>
                </div>
                <div class="form-group">
                    <label for="formStatus">Status</label>
                    <select id="formStatus" name="is_active">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
            </div>

            <!-- Permission Question -->
            <div class="permission-question" id="permissionQuestion">
                <div class="pq-header">
                    <div class="pq-icon"><i class="fas fa-shield-alt"></i></div>
                    <div style="flex: 1;">
                        <div class="pq-title">Create default permissions?</div>
                        <div class="pq-desc">
                            Automatically create <strong>View</strong>, <strong>Add</strong>, <strong>Edit</strong>, and <strong>Delete</strong> permissions for this module.
                        </div>
                        <div class="pq-options">
                            <label>
                                <input type="radio" name="create_permissions" value="1" checked>
                                <span class="label-yes">✅ Yes</span>
                                <span class="hint-text">(Recommended)</span>
                            </label>
                            <label>
                                <input type="radio" name="create_permissions" value="0">
                                <span class="label-no">❌ No</span>
                                <span class="hint-text">(I'll add later)</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="form-actions">
                <button type="button" class="btn-secondary" onclick="closeModal('moduleFormModal')">Cancel</button>
                <button type="submit" class="btn-primary" id="formSubmitBtn">Save Module</button>
            </div>
        </form>
    </div>
</div>

<!-- View Modal -->
<div class="module-modal" id="moduleViewModal">
    <div class="modal-box">
        <div class="modal-header">
            <h3>Module Details</h3>
            <button class="modal-close" onclick="closeModal('moduleViewModal')">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div id="viewContent">
            <div class="view-field"><span class="view-label">Module Name</span><span class="view-value" id="viewName">-</span></div>
            <div class="view-field"><span class="view-label">Slug</span><span class="view-value" id="viewSlug">-</span></div>
            <div class="view-field"><span class="view-label">Parent Category</span><span class="view-value" id="viewParent">-</span></div>
            <div class="view-field"><span class="view-label">Type</span><span class="view-value" id="viewType">-</span></div>
            <div class="view-field"><span class="view-label">Icon</span><span class="view-value" id="viewIcon">-</span></div>
            <div class="view-field"><span class="view-label">Description</span><span class="view-value" id="viewDescription">-</span></div>
            <div class="view-field"><span class="view-label">Sort Order</span><span class="view-value" id="viewSortOrder">-</span></div>
            <div class="view-field"><span class="view-label">Status</span><span class="view-value" id="viewStatus">-</span></div>
            <div class="view-field"><span class="view-label">Permissions</span><span class="view-value" id="viewPermissions">-</span></div>
            <div class="view-field"><span class="view-label">Created</span><span class="view-value" id="viewCreated">-</span></div>
            <div class="view-field"><span class="view-label">Updated</span><span class="view-value" id="viewUpdated">-</span></div>
        </div>
        <div class="form-actions">
            <button type="button" class="btn-secondary" onclick="closeModal('moduleViewModal')">Close</button>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="module-modal" id="deleteModal">
    <div class="modal-box" style="max-width: 400px;">
        <div class="modal-header">
            <h3>Confirm Delete</h3>
            <button class="modal-close" onclick="closeModal('deleteModal')">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <input type="hidden" id="deleteModuleId" value="">
        <p style="color: var(--ink-muted); margin-bottom: 1.5rem; font-size: 0.9rem;">
            Are you sure you want to delete this module? This action cannot be undone.
        </p>
        <div class="form-actions">
            <button type="button" class="btn-secondary" onclick="closeModal('deleteModal')">Cancel</button>
            <button type="button" class="btn-danger" onclick="confirmDeleteModule()">
                <i class="fas fa-trash"></i> Delete
            </button>
        </div>
    </div>
</div>

<!-- Reorder Modal -->
<div class="module-modal" id="reorderModal">
    <div class="modal-box">
        <div class="modal-header">
            <h3>Reorder Modules</h3>
            <button class="modal-close" onclick="closeModal('reorderModal')">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <p style="color: var(--ink-muted); margin-bottom: 1rem; font-size: 0.85rem;">
            Drag and drop modules to reorder them. Click "Save Order" to apply changes.
        </p>
        <div id="reorderList" style="margin-bottom: 1rem; max-height: 400px; overflow-y: auto;">
            <!-- Rendered by JS -->
        </div>
        <div class="form-actions">
            <button type="button" class="btn-secondary" onclick="closeModal('reorderModal')">Cancel</button>
            <button type="button" class="btn-primary" onclick="saveReorder()">Save Order</button>
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
        <div class="toast-icon"><i class="fas ${icons[type] || icons.info}"></i></div>
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
            setTimeout(() => { if (toast.parentNode) toast.remove(); }, 400);
        }
    }, duration);
    toast.addEventListener('click', function(e) {
        if (e.target.closest('.toast-close')) return;
        toast.classList.add('hiding');
        setTimeout(() => { if (toast.parentNode) toast.remove(); }, 400);
    });
    return toast;
}

// ============================================================
// CSRF TOKEN MANAGEMENT
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
let sortField = 'sort_order';
let sortDirection = 'asc';
let totalRecords = 0;
let deleteId = null;
let isReorderMode = false;

function loadTableData() {
    const params = new URLSearchParams({
        page: currentPage,
        per_page: perPage,
        search: searchQuery,
        sort: sortField,
        direction: sortDirection
    });
    fetch('<?= base_url('admin/modules/getData') ?>?' + params.toString(), {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            renderTable(data.data);
            updatePagination(data.pagination);
            updateInfo(data.pagination);
            if (data.csrf_token) updateCsrfToken(data.csrf_token);
        }
    })
    .catch(error => console.error('Error loading table data:', error));
}

function renderTable(modules) {
    const tbody = document.getElementById('tableBody');
    if (!modules || modules.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td colspan="7">
                    <div class="module-empty">
                        <i class="fas fa-inbox"></i>
                        No modules found.
                        <button onclick="openAddModal()">Create your first module</button>
                    </div>
                </td>
            </tr>
        `;
        return;
    }
    let html = '';
    modules.forEach((module, index) => {
        const startIndex = (currentPage - 1) * perPage;
        const rowNum = startIndex + index + 1;
        const statusClass = module.is_active ? 'active' : 'inactive';
        const statusText = module.is_active ? 'Active' : 'Inactive';
        const eyeIcon = module.is_active ? 'fa-eye' : 'fa-eye-slash';
        const desc = module.description ? module.description.substring(0, 60) : '';
        const descSuffix = (module.description && module.description.length > 60) ? '...' : '';
        const isCategory = module.is_category == 1;
        const parentName = module.parent_name || 'None';
        const typeLabel = isCategory ? 'Category' : 'Module';

        html += `
            <tr data-id="${module.module_id}" data-order="${module.sort_order || 0}" class="${isCategory ? 'category-row' : ''}">
                <td style="color: var(--ink-muted);">
                    ${isReorderMode ? '<i class="fas fa-grip-lines" style="cursor: grab; color: var(--primary);"></i>' : rowNum}
                </td>
                <td>
                    <div class="module-name">
                        <div class="icon-box"><i class="fas ${module.icon || 'fa-cube'}"></i></div>
                        <div>
                            <div class="name-text">${escapeHtml(module.name)}</div>
                            <div style="display: flex; align-items: center; gap: 0.5rem; flex-wrap: wrap;">
                                <span class="order-text">Order: ${module.sort_order || 0}</span>
                                <span class="category-badge">${typeLabel}</span>
                                <span class="order-text">Parent: ${escapeHtml(parentName)}</span>
                            </div>
                        </div>
                    </div>
                </td>
                <td class="slug-text">${escapeHtml(module.slug)}</td>
                <td class="desc-text">${escapeHtml(desc)}${descSuffix}</td>
                <td style="text-align: center;"><span class="perm-badge">${module.permission_count || 0}</span></td>
                <td style="text-align: center;"><span class="status-badge ${statusClass}">${statusText}</span></td>
                <td style="text-align: center;">
                    <div class="action-group">
                        <button onclick="viewModule(${module.module_id})" class="act-btn" title="View"><i class="fas fa-eye"></i></button>
                        <button onclick="editModule(${module.module_id})" class="act-btn primary" title="Edit"><i class="fas fa-edit"></i></button>
                        <button onclick="toggleStatus(${module.module_id})" class="act-btn" title="Toggle Status"><i class="fas ${eyeIcon}"></i></button>
                        <button onclick="openDeleteModal(${module.module_id})" class="act-btn danger" title="Delete"><i class="fas fa-trash"></i></button>
                    </div>
                </td>
            </tr>
        `;
    });
    tbody.innerHTML = html;
    if (isReorderMode) makeRowsDraggable();
}

function makeRowsDraggable() {
    const tbody = document.getElementById('tableBody');
    let dragItem = null;
    tbody.addEventListener('dragstart', function(e) {
        if (!isReorderMode) return;
        const tr = e.target.closest('tr');
        if (!tr) return;
        dragItem = tr;
        tr.style.opacity = '0.5';
        e.dataTransfer.effectAllowed = 'move';
        e.dataTransfer.setData('text/html', tr.innerHTML);
    });
    tbody.addEventListener('dragend', function(e) {
        const tr = e.target.closest('tr');
        if (tr) tr.style.opacity = '';
        dragItem = null;
    });
    tbody.addEventListener('dragover', function(e) {
        if (!isReorderMode) return;
        e.preventDefault();
        const tr = e.target.closest('tr');
        if (!tr || tr === dragItem) return;
        const rect = tr.getBoundingClientRect();
        const y = e.clientY - rect.top;
        if (y < rect.height / 2) {
            tr.parentNode.insertBefore(dragItem, tr);
        } else {
            tr.parentNode.insertBefore(dragItem, tr.nextSibling);
        }
    });
}

function updatePagination(pagination) {
    totalRecords = pagination.total;
    const totalPages = pagination.last_page;
    const current = pagination.current_page;
    const container = document.getElementById('dtPagination');
    let html = '';
    html += `<button onclick="goToPage(${current - 1})" ${current <= 1 ? 'disabled' : ''}><i class="fas fa-chevron-left"></i></button>`;
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
    html += `<button onclick="goToPage(${current + 1})" ${current >= totalPages ? 'disabled' : ''}><i class="fas fa-chevron-right"></i></button>`;
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

document.querySelectorAll('#modulesTable th[data-sort]').forEach(th => {
    th.addEventListener('click', function() {
        const field = this.dataset.sort;
        if (sortField === field) {
            sortDirection = sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            sortField = field;
            sortDirection = 'asc';
        }
        document.querySelectorAll('#modulesTable th[data-sort]').forEach(h => h.classList.remove('active-sort'));
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
// ICON DROPDOWN
// ============================================================
const fontAwesomeIcons = [
    // Common Icons
    { class: 'fa-cube', label: 'Cube' },
    { class: 'fa-cubes', label: 'Cubes' },
    { class: 'fa-folder', label: 'Folder' },
    { class: 'fa-folder-open', label: 'Folder Open' },
    { class: 'fa-file', label: 'File' },
    { class: 'fa-file-alt', label: 'File Alt' },
    { class: 'fa-list', label: 'List' },
    { class: 'fa-list-alt', label: 'List Alt' },
    { class: 'fa-tag', label: 'Tag' },
    { class: 'fa-tags', label: 'Tags' },
    { class: 'fa-search', label: 'Search' },
    { class: 'fa-plus', label: 'Plus' },
    { class: 'fa-edit', label: 'Edit' },
    { class: 'fa-trash', label: 'Trash' },
    { class: 'fa-eye', label: 'Eye' },
    { class: 'fa-eye-slash', label: 'Eye Slash' },
    { class: 'fa-save', label: 'Save' },
    { class: 'fa-cog', label: 'Cog' },
    { class: 'fa-cogs', label: 'Cogs' },
    { class: 'fa-wrench', label: 'Wrench' },
    { class: 'fa-tools', label: 'Tools' },
    { class: 'fa-pencil-alt', label: 'Pencil Alt' },
    
    // Dashboard
    { class: 'fa-tachometer-alt', label: 'Dashboard' },
    { class: 'fa-chart-pie', label: 'Chart Pie' },
    { class: 'fa-chart-bar', label: 'Chart Bar' },
    { class: 'fa-chart-line', label: 'Chart Line' },
    { class: 'fa-chart-area', label: 'Chart Area' },
    { class: 'fa-chart-simple', label: 'Chart Simple' },
    
    // Users
    { class: 'fa-users', label: 'Users' },
    { class: 'fa-user', label: 'User' },
    { class: 'fa-user-plus', label: 'User Plus' },
    { class: 'fa-user-minus', label: 'User Minus' },
    { class: 'fa-user-times', label: 'User Times' },
    { class: 'fa-user-check', label: 'User Check' },
    { class: 'fa-user-cog', label: 'User Cog' },
    { class: 'fa-user-shield', label: 'User Shield' },
    { class: 'fa-user-tie', label: 'User Tie' },
    { class: 'fa-user-astronaut', label: 'User Astronaut' },
    { class: 'fa-user-graduate', label: 'User Graduate' },
    { class: 'fa-user-md', label: 'User MD' },
    { class: 'fa-user-nurse', label: 'User Nurse' },
    { class: 'fa-user-secret', label: 'User Secret' },
    { class: 'fa-users-cog', label: 'Users Cog' },
    { class: 'fa-user-friends', label: 'User Friends' },
    
    // Business
    { class: 'fa-building', label: 'Building' },
    { class: 'fa-city', label: 'City' },
    { class: 'fa-warehouse', label: 'Warehouse' },
    { class: 'fa-store', label: 'Store' },
    { class: 'fa-store-alt', label: 'Store Alt' },
    { class: 'fa-industry', label: 'Industry' },
    { class: 'fa-factory', label: 'Factory' },
    { class: 'fa-university', label: 'University' },
    { class: 'fa-bank', label: 'Bank' },
    
    // Data
    { class: 'fa-database', label: 'Database' },
    { class: 'fa-server', label: 'Server' },
    { class: 'fa-cloud', label: 'Cloud' },
    { class: 'fa-cloud-upload-alt', label: 'Cloud Upload' },
    { class: 'fa-cloud-download-alt', label: 'Cloud Download' },
    { class: 'fa-file-code', label: 'File Code' },
    { class: 'fa-file-excel', label: 'File Excel' },
    { class: 'fa-file-pdf', label: 'File PDF' },
    { class: 'fa-file-word', label: 'File Word' },
    { class: 'fa-file-export', label: 'File Export' },
    { class: 'fa-file-import', label: 'File Import' },
    
    // Communication
    { class: 'fa-comment', label: 'Comment' },
    { class: 'fa-comment-dots', label: 'Comment Dots' },
    { class: 'fa-comments', label: 'Comments' },
    { class: 'fa-commenting', label: 'Commenting' },
    { class: 'fa-envelope', label: 'Envelope' },
    { class: 'fa-envelope-open', label: 'Envelope Open' },
    { class: 'fa-phone', label: 'Phone' },
    { class: 'fa-phone-alt', label: 'Phone Alt' },
    { class: 'fa-phone-square', label: 'Phone Square' },
    { class: 'fa-headset', label: 'Headset' },
    { class: 'fa-bullhorn', label: 'Bullhorn' },
    { class: 'fa-bell', label: 'Bell' },
    { class: 'fa-bell-slash', label: 'Bell Slash' },
    
    // Support
    { class: 'fa-life-ring', label: 'Life Ring' },
    { class: 'fa-question-circle', label: 'Question Circle' },
    { class: 'fa-info-circle', label: 'Info Circle' },
    { class: 'fa-exclamation-circle', label: 'Exclamation Circle' },
    { class: 'fa-exclamation-triangle', label: 'Exclamation Triangle' },
    { class: 'fa-ticket-alt', label: 'Ticket Alt' },
    { class: 'fa-support', label: 'Support' },
    
    // Content
    { class: 'fa-file-alt', label: 'File Alt' },
    { class: 'fa-file-powerpoint', label: 'File PowerPoint' },
    { class: 'fa-file-image', label: 'File Image' },
    { class: 'fa-file-audio', label: 'File Audio' },
    { class: 'fa-file-video', label: 'File Video' },
    { class: 'fa-newspaper', label: 'Newspaper' },
    { class: 'fa-book', label: 'Book' },
    { class: 'fa-book-open', label: 'Book Open' },
    { class: 'fa-pen-fancy', label: 'Pen Fancy' },
    { class: 'fa-pen-nib', label: 'Pen Nib' },
    { class: 'fa-pen-square', label: 'Pen Square' },
    { class: 'fa-edit', label: 'Edit' },
    
    // Actions
    { class: 'fa-plus-circle', label: 'Plus Circle' },
    { class: 'fa-plus-square', label: 'Plus Square' },
    { class: 'fa-minus-circle', label: 'Minus Circle' },
    { class: 'fa-minus-square', label: 'Minus Square' },
    { class: 'fa-times-circle', label: 'Times Circle' },
    { class: 'fa-check-circle', label: 'Check Circle' },
    { class: 'fa-check-square', label: 'Check Square' },
    { class: 'fa-arrow-left', label: 'Arrow Left' },
    { class: 'fa-arrow-right', label: 'Arrow Right' },
    { class: 'fa-arrow-up', label: 'Arrow Up' },
    { class: 'fa-arrow-down', label: 'Arrow Down' },
    { class: 'fa-arrows-alt', label: 'Arrows Alt' },
    { class: 'fa-sync', label: 'Sync' },
    { class: 'fa-sync-alt', label: 'Sync Alt' },
    { class: 'fa-refresh', label: 'Refresh' },
    { class: 'fa-undo', label: 'Undo' },
    { class: 'fa-redo', label: 'Redo' },
    { class: 'fa-filter', label: 'Filter' },
    { class: 'fa-sliders-h', label: 'Sliders H' },
    
    // Security
    { class: 'fa-lock', label: 'Lock' },
    { class: 'fa-lock-open', label: 'Lock Open' },
    { class: 'fa-unlock', label: 'Unlock' },
    { class: 'fa-unlock-alt', label: 'Unlock Alt' },
    { class: 'fa-shield-alt', label: 'Shield Alt' },
    { class: 'fa-shield-virus', label: 'Shield Virus' },
    { class: 'fa-key', label: 'Key' },
    { class: 'fa-keyboard', label: 'Keyboard' },
    { class: 'fa-id-card', label: 'ID Card' },
    { class: 'fa-id-badge', label: 'ID Badge' },
    
    // Services
    { class: 'fa-concierge-bell', label: 'Concierge Bell' },
    { class: 'fa-handshake', label: 'Handshake' },
    { class: 'fa-star', label: 'Star' },
    { class: 'fa-star-half', label: 'Star Half' },
    { class: 'fa-star-half-alt', label: 'Star Half Alt' },
    { class: 'fa-clock', label: 'Clock' },
    { class: 'fa-calendar', label: 'Calendar' },
    { class: 'fa-calendar-check', label: 'Calendar Check' },
    { class: 'fa-calendar-times', label: 'Calendar Times' },
    { class: 'fa-calendar-plus', label: 'Calendar Plus' },
    
    // Deals
    { class: 'fa-handshake', label: 'Handshake' },
    { class: 'fa-handshake-alt', label: 'Handshake Alt' },
    { class: 'fa-hand-holding', label: 'Hand Holding' },
    { class: 'fa-hand-holding-heart', label: 'Hand Holding Heart' },
    { class: 'fa-hand-holding-usd', label: 'Hand Holding USD' },
    { class: 'fa-money-bill', label: 'Money Bill' },
    { class: 'fa-money-bill-wave', label: 'Money Bill Wave' },
    { class: 'fa-money-bill-alt', label: 'Money Bill Alt' },
    { class: 'fa-file-signature', label: 'File Signature' },
    { class: 'fa-signature', label: 'Signature' },
    { class: 'fa-tasks', label: 'Tasks' },
    { class: 'fa-clipboard', label: 'Clipboard' },
    { class: 'fa-clipboard-list', label: 'Clipboard List' },
    { class: 'fa-clipboard-check', label: 'Clipboard Check' },
    
    // Strategy
    { class: 'fa-clipboard-list', label: 'Clipboard List' },
    { class: 'fa-rocket', label: 'Rocket' },
    { class: 'fa-space-shuttle', label: 'Space Shuttle' },
    { class: 'fa-crown', label: 'Crown' },
    { class: 'fa-trophy', label: 'Trophy' },
    { class: 'fa-medal', label: 'Medal' },
    { class: 'fa-award', label: 'Award' },
    { class: 'fa-check-double', label: 'Check Double' },
    { class: 'fa-object-group', label: 'Object Group' },
    { class: 'fa-object-ungroup', label: 'Object Ungroup' },
    { class: 'fa-code-branch', label: 'Code Branch' },
    
    // Knowledge
    { class: 'fa-book', label: 'Book' },
    { class: 'fa-book-open', label: 'Book Open' },
    { class: 'fa-book-reader', label: 'Book Reader' },
    { class: 'fa-graduation-cap', label: 'Graduation Cap' },
    { class: 'fa-university', label: 'University' },
    { class: 'fa-school', label: 'School' },
    { class: 'fa-brain', label: 'Brain' },
    { class: 'fa-lightbulb', label: 'Lightbulb' },
    
    // Technology
    { class: 'fa-robot', label: 'Robot' },
    { class: 'fa-microchip', label: 'Microchip' },
    { class: 'fa-code', label: 'Code' },
    { class: 'fa-terminal', label: 'Terminal' },
    { class: 'fa-laptop', label: 'Laptop' },
    { class: 'fa-laptop-code', label: 'Laptop Code' },
    { class: 'fa-desktop', label: 'Desktop' },
    { class: 'fa-server', label: 'Server' },
    { class: 'fa-globe', label: 'Globe' },
    { class: 'fa-network-wired', label: 'Network Wired' },
    { class: 'fa-wifi', label: 'WiFi' },
    { class: 'fa-bolt', label: 'Bolt' },
    { class: 'fa-cogs', label: 'Cogs' },
    { class: 'fa-microscope', label: 'Microscope' },
    { class: 'fa-flask', label: 'Flask' },
    
    // Notifications
    { class: 'fa-bell', label: 'Bell' },
    { class: 'fa-bell-slash', label: 'Bell Slash' },
    { class: 'fa-bell-ring', label: 'Bell Ring' },
    { class: 'fa-envelope', label: 'Envelope' },
    { class: 'fa-sms', label: 'SMS' },
    { class: 'fa-inbox', label: 'Inbox' },
    
    // Settings
    { class: 'fa-cog', label: 'Cog' },
    { class: 'fa-cogs', label: 'Cogs' },
    { class: 'fa-sliders-h', label: 'Sliders H' },
    { class: 'fa-sliders-v', label: 'Sliders V' },
    { class: 'fa-toggle-on', label: 'Toggle On' },
    { class: 'fa-toggle-off', label: 'Toggle Off' },
    
    // Finance
    { class: 'fa-credit-card', label: 'Credit Card' },
    { class: 'fa-wallet', label: 'Wallet' },
    { class: 'fa-coins', label: 'Coins' },
    { class: 'fa-sack-dollar', label: 'Sack Dollar' },
    { class: 'fa-chart-line', label: 'Chart Line' },
    { class: 'fa-arrow-trend-up', label: 'Arrow Trend Up' },
    { class: 'fa-arrow-trend-down', label: 'Arrow Trend Down' },
    
    // Category
    { class: 'fa-folder', label: 'Folder' },
    { class: 'fa-folder-open', label: 'Folder Open' },
    { class: 'fa-folder-plus', label: 'Folder Plus' },
    { class: 'fa-folder-minus', label: 'Folder Minus' },
    { class: 'fa-folder-tree', label: 'Folder Tree' },
    { class: 'fa-sitemap', label: 'Sitemap' },
    
    // More
    { class: 'fa-grip-lines', label: 'Grip Lines' },
    { class: 'fa-grip-lines-vertical', label: 'Grip Lines Vertical' },
    { class: 'fa-grip-horizontal', label: 'Grip Horizontal' },
    { class: 'fa-grip-vertical', label: 'Grip Vertical' },
    { class: 'fa-ellipsis-h', label: 'Ellipsis H' },
    { class: 'fa-ellipsis-v', label: 'Ellipsis V' },
    { class: 'fa-th', label: 'Th' },
    { class: 'fa-th-large', label: 'Th Large' },
    { class: 'fa-th-list', label: 'Th List' }
];

let selectedIcon = 'fa-cube';
let iconDropdownOpen = false;

function renderIcons(filter = '') {
    const container = document.getElementById('iconList');
    let html = '';
    const filtered = fontAwesomeIcons.filter(icon => 
        icon.label.toLowerCase().includes(filter.toLowerCase()) ||
        icon.class.toLowerCase().includes(filter.toLowerCase())
    );
    
    if (filtered.length === 0) {
        html = `<div style="padding: 0.75rem; text-align: center; color: var(--ink-muted); font-size: 0.8rem;">No icons found</div>`;
    } else {
        filtered.forEach(icon => {
            const isSelected = selectedIcon === icon.class;
            html += `
                <div class="icon-option ${isSelected ? 'selected' : ''}" onclick="selectIcon('${icon.class}')">
                    <i class="fas ${icon.class}"></i>
                    <span class="icon-label">${icon.label}</span>
                    <span class="icon-class">${icon.class}</span>
                    ${isSelected ? '<span class="icon-check"><i class="fas fa-check"></i></span>' : ''}
                </div>
            `;
        });
    }
    container.innerHTML = html;
}

function toggleIconDropdown() {
    iconDropdownOpen = !iconDropdownOpen;
    const options = document.getElementById('iconOptions');
    const arrow = document.getElementById('dropdownArrow');
    if (iconDropdownOpen) {
        options.classList.add('show');
        arrow.classList.add('open');
        document.getElementById('iconSearch').value = '';
        renderIcons('');
        setTimeout(() => document.getElementById('iconSearch').focus(), 100);
    } else {
        options.classList.remove('show');
        arrow.classList.remove('open');
    }
}

function selectIcon(iconClass) {
    selectedIcon = iconClass;
    document.getElementById('formIcon').value = iconClass;
    document.getElementById('previewIcon').innerHTML = `<i class="fas ${iconClass}"></i>`;
    const selected = fontAwesomeIcons.find(i => i.class === iconClass);
    document.getElementById('selectedIconName').textContent = selected ? selected.label : iconClass;
    iconDropdownOpen = false;
    document.getElementById('iconOptions').classList.remove('show');
    document.getElementById('dropdownArrow').classList.remove('open');
}

function filterIcons(value) {
    renderIcons(value);
}

// Close dropdown when clicking outside
document.addEventListener('click', function(e) {
    const wrapper = document.getElementById('iconDropdown');
    if (wrapper && !wrapper.contains(e.target)) {
        iconDropdownOpen = false;
        document.getElementById('iconOptions').classList.remove('show');
        document.getElementById('dropdownArrow').classList.remove('open');
    }
});

// ============================================================
// SLUG GENERATION
// ============================================================
function generateSlugFromName(name) {
    if (!name || name.length < 3) return '';
    let slug = name.toLowerCase()
        .replace(/[^a-z0-9\s]/g, '')
        .replace(/\s+/g, '_')
        .trim('_');
    return slug;
}

function generateSlugManually() {
    const name = document.getElementById('formName').value;
    if (name.length < 3) {
        showToast('Module name must be at least 3 characters', 'Error', 'error');
        return;
    }
    const slug = generateSlugFromName(name);
    document.getElementById('formSlug').value = slug;
    document.getElementById('formSlug').dataset.manual = 'true';
}

// Auto-generate slug on name input
let slugTimeout = null;
document.addEventListener('DOMContentLoaded', function() {
    const nameInput = document.getElementById('formName');
    const slugInput = document.getElementById('formSlug');
    
    if (nameInput) {
        nameInput.addEventListener('input', function() {
            const name = this.value;
            const isEditing = document.getElementById('formModuleId').value !== '';
            
            if (!slugInput.dataset.manual && !isEditing && name.length >= 3) {
                clearTimeout(slugTimeout);
                slugTimeout = setTimeout(() => {
                    const slug = generateSlugFromName(name);
                    if (slug) {
                        slugInput.value = slug;
                    }
                }, 300);
            }
        });
    }

    if (slugInput) {
        slugInput.addEventListener('input', function() {
            this.dataset.manual = 'true';
        });
    }
});

// Reset manual flag when modal opens
function resetSlugField() {
    const slugInput = document.getElementById('formSlug');
    if (slugInput) {
        slugInput.value = '';
        slugInput.dataset.manual = '';
    }
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

document.querySelectorAll('.module-modal').forEach(modal => {
    modal.addEventListener('click', function(e) {
        if (e.target === this) {
            this.classList.remove('show');
            document.body.style.overflow = '';
        }
    });
});

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        document.querySelectorAll('.module-modal.show').forEach(modal => {
            modal.classList.remove('show');
            document.body.style.overflow = '';
        });
    }
});

// ============================================================
// TOGGLE PERMISSION QUESTION
// ============================================================
function togglePermissionQuestion() {
    const isCategory = document.getElementById('formIsCategory').value === '1';
    const isEditing = document.getElementById('formModuleId').value !== '';
    const questionDiv = document.getElementById('permissionQuestion');
    if (!isCategory && !isEditing) {
        questionDiv.style.display = 'block';
    } else {
        questionDiv.style.display = 'none';
    }
}

document.getElementById('formIsCategory').addEventListener('change', togglePermissionQuestion);

// ============================================================
// ADD/EDIT MODULE
// ============================================================
function openAddModal() {
    document.getElementById('formModuleId').value = '';
    document.getElementById('formName').value = '';
    resetSlugField();
    document.getElementById('formParentId').value = '';
    document.getElementById('formIsCategory').value = '0';
    // Reset icon
    selectedIcon = 'fa-cube';
    document.getElementById('formIcon').value = 'fa-cube';
    document.getElementById('previewIcon').innerHTML = '<i class="fas fa-cube"></i>';
    document.getElementById('selectedIconName').textContent = 'Select an icon';
    document.getElementById('formDescription').value = '';
    document.getElementById('formSortOrder').value = '0';
    document.getElementById('formStatus').value = '1';
    document.getElementById('formModalTitle').textContent = 'Add Module';
    document.getElementById('formSubmitBtn').textContent = 'Add Module';
    
    document.getElementById('permissionQuestion').style.display = 'block';
    document.querySelectorAll('input[name="create_permissions"]').forEach(r => r.checked = r.value === '1');
    
    fetch('<?= base_url('admin/modules/getNextSortOrder') ?>', {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            document.getElementById('formSortOrder').value = data.sort_order;
            if (data.csrf_token) updateCsrfToken(data.csrf_token);
        }
    })
    .catch(error => console.error('Error getting sort order:', error));
    
    openModal('moduleFormModal');
}

function openAddCategoryModal() {
    document.getElementById('formModuleId').value = '';
    document.getElementById('formName').value = '';
    resetSlugField();
    document.getElementById('formParentId').value = '';
    document.getElementById('formIsCategory').value = '1';
    // Set default icon for category
    selectedIcon = 'fa-folder';
    document.getElementById('formIcon').value = 'fa-folder';
    document.getElementById('previewIcon').innerHTML = '<i class="fas fa-folder"></i>';
    document.getElementById('selectedIconName').textContent = 'Folder';
    document.getElementById('formDescription').value = '';
    document.getElementById('formSortOrder').value = '0';
    document.getElementById('formStatus').value = '1';
    document.getElementById('formModalTitle').textContent = 'Add Category';
    document.getElementById('formSubmitBtn').textContent = 'Add Category';
    document.getElementById('permissionQuestion').style.display = 'none';
    
    fetch('<?= base_url('admin/modules/getNextSortOrder') ?>', {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            document.getElementById('formSortOrder').value = data.sort_order;
            if (data.csrf_token) updateCsrfToken(data.csrf_token);
        }
    })
    .catch(error => console.error('Error getting sort order:', error));
    
    openModal('moduleFormModal');
}

function editModule(id) {
    document.getElementById('permissionQuestion').style.display = 'none';
    fetch('<?= base_url('admin/modules/get') ?>/' + id, {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            const module = data.data;
            document.getElementById('formModuleId').value = module.module_id;
            document.getElementById('formName').value = module.name;
            document.getElementById('formSlug').value = module.slug;
            document.getElementById('formSlug').dataset.manual = 'true';
            document.getElementById('formParentId').value = module.parent_id || '';
            document.getElementById('formIsCategory').value = module.is_category || '0';
            // Set icon
            const iconClass = module.icon || 'fa-cube';
            selectedIcon = iconClass;
            document.getElementById('formIcon').value = iconClass;
            document.getElementById('previewIcon').innerHTML = `<i class="fas ${iconClass}"></i>`;
            const iconName = fontAwesomeIcons.find(i => i.class === iconClass);
            document.getElementById('selectedIconName').textContent = iconName ? iconName.label : iconClass;
            document.getElementById('formDescription').value = module.description || '';
            document.getElementById('formSortOrder').value = module.sort_order || 0;
            document.getElementById('formStatus').value = module.is_active ? '1' : '0';
            document.getElementById('formModalTitle').textContent = module.is_category ? 'Edit Category' : 'Edit Module';
            document.getElementById('formSubmitBtn').textContent = 'Update';
            if (data.csrf_token) updateCsrfToken(data.csrf_token);
            openModal('moduleFormModal');
        } else {
            showToast(data.message || 'Failed to load module data', 'Error', 'error');
        }
    })
    .catch(error => {
        console.error('Error loading module:', error);
        showToast('Error loading module data.', 'Error', 'error');
    });
}

function saveModule(event) {
    event.preventDefault();
    const form = document.getElementById('moduleForm');
    const formData = new FormData(form);
    const id = document.getElementById('formModuleId').value;
    const isCategory = document.getElementById('formIsCategory').value === '1';
    if (!id && !isCategory) {
        const createPerms = document.querySelector('input[name="create_permissions"]:checked');
        if (createPerms) formData.append('create_permissions', createPerms.value);
    }
    const url = id ? '<?= base_url('admin/modules/update') ?>/' + id : '<?= base_url('admin/modules/create') ?>';
    fetch(url, {
        method: 'POST',
        body: formData,
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            if (data.csrf_token) updateCsrfToken(data.csrf_token);
            closeModal('moduleFormModal');
            loadTableData();
            updateStats();
            let msg = data.message || 'Module saved successfully!';
            if (data.permissions_created) msg += ' ' + data.permissions_message;
            showToast(msg, 'Success', 'success');
        } else {
            let errorMsg = typeof data.message === 'object' ? Object.values(data.message).join(', ') : data.message;
            showToast(errorMsg || 'Failed to save module', 'Error', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('An error occurred while saving the module.', 'Error', 'error');
    });
}

// ============================================================
// VIEW MODULE
// ============================================================
function viewModule(id) {
    fetch('<?= base_url('admin/modules/get') ?>/' + id, {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            const module = data.data;
            document.getElementById('viewName').textContent = module.name;
            document.getElementById('viewSlug').textContent = module.slug;
            document.getElementById('viewParent').textContent = module.parent_name || 'None (Standalone)';
            document.getElementById('viewType').textContent = module.is_category ? 'Category' : 'Module';
            const iconClass = module.icon || 'fa-cube';
            document.getElementById('viewIcon').innerHTML = `<i class="fas ${iconClass}"></i> ${iconClass}`;
            document.getElementById('viewDescription').textContent = module.description || 'No description';
            document.getElementById('viewSortOrder').textContent = module.sort_order || 0;
            document.getElementById('viewStatus').textContent = module.is_active ? 'Active' : 'Inactive';
            document.getElementById('viewPermissions').textContent = module.permission_count || 0;
            document.getElementById('viewCreated').textContent = module.created_at || '-';
            document.getElementById('viewUpdated').textContent = module.updated_at || '-';
            if (data.csrf_token) updateCsrfToken(data.csrf_token);
            openModal('moduleViewModal');
        } else {
            showToast(data.message || 'Failed to load module data', 'Error', 'error');
        }
    })
    .catch(error => {
        console.error('Error loading module:', error);
        showToast('Error loading module data.', 'Error', 'error');
    });
}

// ============================================================
// STATUS TOGGLE
// ============================================================
function toggleStatus(id) {
    if (confirm('Are you sure you want to toggle the status of this module?')) {
        const formData = new FormData();
        formData.set(csrfName, csrfHash);
        fetch('<?= base_url('admin/modules/toggle-status') ?>/' + id, {
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
// DELETE MODULE
// ============================================================
function openDeleteModal(id) {
    deleteId = id;
    document.getElementById('deleteModuleId').value = id;
    openModal('deleteModal');
}

function confirmDeleteModule() {
    if (!deleteId) return;
    const formData = new FormData();
    formData.set(csrfName, csrfHash);
    fetch('<?= base_url('admin/modules/delete') ?>/' + deleteId, {
        method: 'POST',
        body: formData,
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            if (data.csrf_token) updateCsrfToken(data.csrf_token);
            closeModal('deleteModal');
            deleteId = null;
            loadTableData();
            updateStats();
            showToast(data.message || 'Module deleted successfully!', 'Success', 'success');
        } else {
            showToast(data.message || 'Failed to delete module', 'Error', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('An error occurred while deleting the module.', 'Error', 'error');
    });
}

// ============================================================
// REORDER
// ============================================================
function enableReorder() {
    isReorderMode = !isReorderMode;
    const btn = document.getElementById('reorderBtn');
    if (isReorderMode) {
        btn.innerHTML = '<i class="fas fa-save"></i> Save Order';
        btn.classList.remove('btn-outline');
        btn.classList.add('btn-success');
        openModal('reorderModal');
        loadReorderList();
    } else {
        btn.innerHTML = '<i class="fas fa-arrows-alt"></i> Reorder';
        btn.classList.remove('btn-success');
        btn.classList.add('btn-outline');
        closeModal('reorderModal');
        loadTableData();
    }
}

function loadReorderList() {
    fetch('<?= base_url('admin/modules/getData') ?>?per_page=1000&sort=sort_order&direction=asc', {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            if (data.csrf_token) updateCsrfToken(data.csrf_token);
            const container = document.getElementById('reorderList');
            if (!container) { setTimeout(() => loadReorderList(), 100); return; }
            let html = '<ul style="list-style: none; padding: 0; margin: 0;">';
            data.data.forEach((module, index) => {
                html += `
                    <li draggable="true" data-id="${module.module_id}" data-order="${index + 1}" 
                        style="display: flex; align-items: center; gap: 0.75rem; padding: 0.5rem 0.75rem; 
                        background: var(--surface); border: 1px solid var(--border); 
                        border-radius: 8px; margin-bottom: 0.5rem; cursor: grab;">
                        <i class="fas fa-grip-lines" style="color: var(--ink-muted);"></i>
                        <i class="fas ${module.icon || 'fa-cube'}" style="color: var(--primary);"></i>
                        <span style="flex: 1; font-weight: 500;">${escapeHtml(module.name)}</span>
                        ${module.is_category ? '<span style="font-size: 0.6rem; background: #ede9fe; color: #7c3aed; padding: 0.05rem 0.5rem; border-radius: 10px;">Category</span>' : ''}
                        <span style="color: var(--ink-muted); font-size: 0.75rem;">Order: ${index + 1}</span>
                    </li>
                `;
            });
            html += '</ul>';
            container.innerHTML = html;
            makeReorderListDraggable();
        }
    })
    .catch(error => console.error('Error loading reorder list:', error));
}

function makeReorderListDraggable() {
    const container = document.getElementById('reorderList');
    let dragItem = null;
    container.addEventListener('dragstart', function(e) {
        const li = e.target.closest('li');
        if (!li) return;
        dragItem = li;
        li.style.opacity = '0.5';
        e.dataTransfer.effectAllowed = 'move';
        e.dataTransfer.setData('text/html', li.innerHTML);
    });
    container.addEventListener('dragend', function(e) {
        const li = e.target.closest('li');
        if (li) li.style.opacity = '';
        dragItem = null;
    });
    container.addEventListener('dragover', function(e) {
        e.preventDefault();
        const li = e.target.closest('li');
        if (!li || li === dragItem) return;
        const rect = li.getBoundingClientRect();
        const y = e.clientY - rect.top;
        if (y < rect.height / 2) {
            li.parentNode.insertBefore(dragItem, li);
        } else {
            li.parentNode.insertBefore(dragItem, li.nextSibling);
        }
        updateReorderNumbers();
    });
}

function updateReorderNumbers() {
    const items = document.querySelectorAll('#reorderList li');
    items.forEach((item, index) => {
        const orderSpan = item.querySelector('span:last-child');
        if (orderSpan) orderSpan.textContent = 'Order: ' + (index + 1);
        item.dataset.order = index + 1;
    });
}

function saveReorder() {
    const items = document.querySelectorAll('#reorderList li');
    const orders = [];
    items.forEach((item, index) => {
        orders.push({ id: parseInt(item.dataset.id), order: index + 1 });
    });
    const formData = new URLSearchParams();
    formData.append(csrfName, csrfHash);
    formData.append('orders', JSON.stringify(orders));
    fetch('<?= base_url('admin/modules/reorder') ?>', {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Content-Type': 'application/x-www-form-urlencoded',
            'X-CSRF-TOKEN': csrfHash
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            if (data.csrf_token) updateCsrfToken(data.csrf_token);
            closeModal('reorderModal');
            isReorderMode = false;
            const btn = document.getElementById('reorderBtn');
            btn.innerHTML = '<i class="fas fa-arrows-alt"></i> Reorder';
            btn.classList.remove('btn-success');
            btn.classList.add('btn-outline');
            loadTableData();
            showToast(data.message || 'Module order updated successfully!', 'Success', 'success');
        } else {
            showToast(data.message || 'Failed to update order', 'Error', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('An error occurred while updating the order.', 'Error', 'error');
    });
}

// ============================================================
// UPDATE STATS
// ============================================================
function updateStats() {
    fetch('<?= base_url('admin/modules/getStats') ?>', {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            if (data.csrf_token) updateCsrfToken(data.csrf_token);
            const stats = data.data;
            document.getElementById('statTotal').textContent = stats.total || 0;
            document.getElementById('statActive').textContent = stats.active || 0;
            document.getElementById('statInactive').textContent = (stats.total || 0) - (stats.active || 0);
            document.getElementById('statCategories').textContent = stats.categories || 0;
        }
    })
    .catch(error => console.error('Error updating stats:', error));
}

// ============================================================
// INITIALIZE
// ============================================================
document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('#modulesTable th[data-sort="sort_order"]')?.classList.add('active-sort');
    loadTableData();
    renderIcons('');
});
</script>
<?= $this->endSection() ?>