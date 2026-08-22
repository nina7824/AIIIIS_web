<?= $this->extend('admin/layout') ?>

<?= $this->section('styles') ?>
<style>
/* ============================================================
   MODULE MANAGEMENT - COMPLETELY ISOLATED (mc- prefix)
   ============================================================ */

.mc-container {
    width: 100% !important;
    max-width: 100% !important;
    box-sizing: border-box !important;
    padding: 0 !important;
    margin: 0 !important;
}

/* ---------- MC STATS WRAPPER ---------- */
.mc-stats-wrapper {
    display: grid !important;
    grid-template-columns: repeat(4, 1fr) !important;
    gap: 0.75rem !important;
    margin-bottom: 1rem !important;
    width: 100% !important;
    max-width: 100% !important;
    box-sizing: border-box !important;
}

@media (max-width: 992px) {
    .mc-stats-wrapper {
        grid-template-columns: repeat(2, 1fr) !important;
    }
}

@media (max-width: 576px) {
    .mc-stats-wrapper {
        grid-template-columns: 1fr 1fr !important;
        gap: 0.5rem !important;
    }
}

@media (max-width: 400px) {
    .mc-stats-wrapper {
        grid-template-columns: 1fr !important;
    }
}

/* ---------- MC STAT CARD ---------- */
.mc-stat-card {
    background: var(--surface, #ffffff) !important;
    border: 1px solid var(--border, #e3e7ea) !important;
    border-radius: 8px !important;
    padding: 0.75rem 1rem !important;
    transition: all 0.2s ease !important;
    display: flex !important;
    flex-direction: column !important;
    align-items: flex-start !important;
    box-shadow: 0 1px 3px rgba(0,0,0,0.06) !important;
    position: relative !important;
    overflow: hidden !important;
    min-width: 0 !important;
    width: 100% !important;
    max-width: 100% !important;
}

.mc-stat-card .mc-accent {
    position: absolute !important;
    top: 0 !important;
    left: 0 !important;
    right: 0 !important;
    height: 3px !important;
}

.mc-stat-card:hover {
    transform: translateY(-2px) !important;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08) !important;
    border-color: var(--primary, #078ece) !important;
}

.mc-stat-card .mc-icon {
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

.mc-stat-card .mc-icon.mc-blue { background: #dbeafe !important; color: #2563eb !important; }
.mc-stat-card .mc-icon.mc-green { background: #d1fae5 !important; color: #059669 !important; }
.mc-stat-card .mc-icon.mc-red { background: #fee2e2 !important; color: #dc2626 !important; }
.mc-stat-card .mc-icon.mc-purple { background: #ede9fe !important; color: #7c3aed !important; }

[data-theme="dark"] .mc-stat-card .mc-icon.mc-blue { background: #1e293b !important; color: #60a5fa !important; }
[data-theme="dark"] .mc-stat-card .mc-icon.mc-green { background: #1a3a2a !important; color: #34d399 !important; }
[data-theme="dark"] .mc-stat-card .mc-icon.mc-red { background: #3a1a1a !important; color: #f87171 !important; }
[data-theme="dark"] .mc-stat-card .mc-icon.mc-purple { background: #2d1b4a !important; color: #a78bfa !important; }

.mc-stat-card .mc-number {
    font-size: 1.2rem !important;
    font-weight: 800 !important;
    color: var(--ink, #1a2332) !important;
    line-height: 1.2 !important;
    letter-spacing: -0.02em !important;
}

.mc-stat-card .mc-label {
    font-size: 0.6rem !important;
    font-weight: 500 !important;
    color: var(--ink-muted, #5c6b74) !important;
    text-transform: uppercase !important;
    letter-spacing: 0.04em !important;
    margin-top: 0.1rem !important;
}

.mc-stat-card .mc-trend {
    font-size: 0.55rem !important;
    font-weight: 600 !important;
    margin-top: 0.25rem !important;
    padding: 0.05rem 0.4rem !important;
    border-radius: 10px !important;
    display: inline-flex !important;
    align-items: center !important;
    gap: 0.2rem !important;
    background: var(--canvas, #f4f5f6) !important;
}

.mc-stat-card .mc-trend.mc-up { color: #059669 !important; }
.mc-stat-card .mc-trend.mc-down { color: #dc2626 !important; }
.mc-stat-card .mc-trend.mc-neutral { color: var(--ink-muted, #5c6b74) !important; }

.mc-stat-card.mc-primary .mc-accent { background: #2563eb !important; }
.mc-stat-card.mc-success .mc-accent { background: #059669 !important; }
.mc-stat-card.mc-danger .mc-accent { background: #dc2626 !important; }
.mc-stat-card.mc-purple .mc-accent { background: #7c3aed !important; }

/* ---------- MC ACTION BAR ---------- */
.mc-action-bar {
    display: flex !important;
    justify-content: flex-end !important;
    align-items: center !important;
    margin-bottom: 1rem !important;
    flex-wrap: wrap !important;
    gap: 0.5rem !important;
    width: 100% !important;
}


/* Add to your styles */
.mc-btn-primary:disabled {
    opacity: 0.6 !important;
    cursor: not-allowed !important;
    transform: none !important;
}

.mc-btn-primary .fa-spinner {
    margin-right: 0.5rem !important;
}

.mc-action-bar .mc-btn {
    padding: 0.4rem 1.2rem !important;
    background: var(--primary, #078ece) !important;
    color: #fff !important;
    border: none !important;
    border-radius: 8px !important;
    font-size: 0.78rem !important;
    font-weight: 600 !important;
    cursor: pointer !important;
    transition: all 0.2s ease !important;
    display: inline-flex !important;
    align-items: center !important;
    gap: 0.4rem !important;
    font-family: 'Inter', sans-serif !important;
}

.mc-action-bar .mc-btn:hover {
    background: var(--primary-dark, #045a86) !important;
    transform: translateY(-1px) !important;
    box-shadow: 0 4px 12px rgba(7,142,206,0.3) !important;
}

/* ---------- MC TABLE ---------- */
.mc-table-wrap {
    background: var(--surface, #ffffff) !important;
    border: 1px solid var(--border, #e3e7ea) !important;
    border-radius: 8px !important;
    overflow: hidden !important;
    width: 100% !important;
}

.mc-table-wrap .mc-toolbar {
    padding: 0.5rem 1rem !important;
    border-bottom: 1px solid var(--border, #e3e7ea) !important;
    display: flex !important;
    justify-content: space-between !important;
    align-items: center !important;
    flex-wrap: wrap !important;
    gap: 0.5rem !important;
}

.mc-table-wrap .mc-search {
    display: flex !important;
    align-items: center !important;
    gap: 0.4rem !important;
    background: var(--canvas, #f4f5f6) !important;
    border: 1px solid var(--border, #e3e7ea) !important;
    border-radius: 6px !important;
    padding: 0.2rem 0.6rem !important;
}

.mc-table-wrap .mc-search input {
    border: none !important;
    background: transparent !important;
    padding: 0.3rem 0.2rem !important;
    font-size: 0.75rem !important;
    color: var(--ink, #1a2332) !important;
    width: 180px !important;
    outline: none !important;
    font-family: 'Inter', sans-serif !important;
}

.mc-table-wrap .mc-toolbar-right {
    display: flex !important;
    align-items: center !important;
    gap: 0.5rem !important;
}

.mc-table-wrap .mc-per-page {
    display: flex !important;
    align-items: center !important;
    gap: 0.3rem !important;
    font-size: 0.7rem !important;
    color: var(--ink-muted, #5c6b74) !important;
}

.mc-table-wrap .mc-per-page select {
    padding: 0.15rem 0.3rem !important;
    border: 1px solid var(--border, #e3e7ea) !important;
    border-radius: 4px !important;
    background: var(--surface, #ffffff) !important;
    color: var(--ink, #1a2332) !important;
    font-size: 0.7rem !important;
    cursor: pointer !important;
    font-family: 'Inter', sans-serif !important;
}

.mc-table-wrap .mc-refresh {
    padding: 0.2rem 0.5rem !important;
    border: 1px solid var(--border, #e3e7ea) !important;
    border-radius: 4px !important;
    background: var(--surface, #ffffff) !important;
    color: var(--ink-muted, #5c6b74) !important;
    cursor: pointer !important;
    font-size: 0.7rem !important;
}

.mc-table-wrap .mc-scroll {
    overflow-x: auto !important;
}

.mc-table-wrap table {
    width: 100% !important;
    border-collapse: collapse !important;
    font-size: 0.8rem !important;
}

.mc-table-wrap table thead {
    background: var(--canvas, #f4f5f6) !important;
}

.mc-table-wrap table th {
    padding: 0.5rem 1rem !important;
    text-align: left !important;
    font-weight: 600 !important;
    color: var(--ink-muted, #5c6b74) !important;
    font-size: 0.6rem !important;
    text-transform: uppercase !important;
    letter-spacing: 0.05em !important;
    border-bottom: 2px solid var(--border, #e3e7ea) !important;
    cursor: pointer !important;
    white-space: nowrap !important;
}

.mc-table-wrap table td {
    padding: 0.5rem 1rem !important;
    border-bottom: 1px solid var(--border, #e3e7ea) !important;
    vertical-align: middle !important;
}

.mc-table-wrap table tbody tr:hover {
    background: var(--surface-hover, #f8f9fa) !important;
}

.mc-table-wrap .mc-type-badge {
    display: inline-block !important;
    background: var(--primary-light, #e6f4fb) !important;
    color: var(--primary, #078ece) !important;
    padding: 0.05rem 0.5rem !important;
    border-radius: 10px !important;
    font-size: 0.6rem !important;
    font-weight: 500 !important;
}

.mc-table-wrap .mc-type-badge.mc-category {
    background: #ede9fe !important;
    color: #7c3aed !important;
}

.mc-table-wrap .mc-status {
    display: inline-block !important;
    padding: 0.05rem 0.6rem !important;
    border-radius: 20px !important;
    font-size: 0.5rem !important;
    font-weight: 600 !important;
    text-transform: uppercase !important;
    letter-spacing: 0.04em !important;
}

.mc-table-wrap .mc-status.mc-active {
    background: #d1fae5 !important;
    color: #059669 !important;
}
.mc-table-wrap .mc-status.mc-inactive {
    background: #fee2e2 !important;
    color: #dc2626 !important;
}

.mc-table-wrap .mc-actions {
    display: flex !important;
    justify-content: center !important;
    gap: 0.1rem !important;
    flex-wrap: wrap !important;
}

.mc-table-wrap .mc-actions .mc-act-btn {
    background: none !important;
    border: none !important;
    color: var(--ink-muted, #5c6b74) !important;
    padding: 0.2rem 0.35rem !important;
    border-radius: 4px !important;
    cursor: pointer !important;
    transition: all 0.2s ease !important;
    font-size: 0.8rem !important;
}

.mc-table-wrap .mc-actions .mc-act-btn:hover {
    background: var(--canvas, #f4f5f6) !important;
    color: var(--ink, #1a2332) !important;
}

.mc-table-wrap .mc-actions .mc-act-btn.mc-danger:hover {
    background: #fee2e2 !important;
    color: #dc2626 !important;
}

.mc-table-wrap .mc-actions .mc-act-btn.mc-primary:hover {
    background: var(--primary-light, #e6f4fb) !important;
    color: var(--primary, #078ece) !important;
}

.mc-table-wrap .mc-footer {
    padding: 0.5rem 1rem !important;
    border-top: 1px solid var(--border, #e3e7ea) !important;
    display: flex !important;
    justify-content: space-between !important;
    align-items: center !important;
    flex-wrap: wrap !important;
    gap: 0.5rem !important;
}

.mc-table-wrap .mc-info {
    font-size: 0.7rem !important;
    color: var(--ink-muted, #5c6b74) !important;
}

.mc-table-wrap .mc-pagination {
    display: flex !important;
    gap: 0.2rem !important;
}

.mc-table-wrap .mc-pagination button {
    padding: 0.15rem 0.5rem !important;
    border: 1px solid var(--border, #e3e7ea) !important;
    border-radius: 4px !important;
    background: var(--surface, #ffffff) !important;
    color: var(--ink-muted, #5c6b74) !important;
    cursor: pointer !important;
    transition: all 0.2s ease !important;
    font-size: 0.7rem !important;
    min-width: 28px !important;
    font-family: 'Inter', sans-serif !important;
}

.mc-table-wrap .mc-pagination button:hover:not(:disabled) {
    background: var(--canvas, #f4f5f6) !important;
    color: var(--ink, #1a2332) !important;
}

.mc-table-wrap .mc-pagination button.mc-active {
    background: var(--primary, #078ece) !important;
    color: #fff !important;
    border-color: var(--primary, #078ece) !important;
}

.mc-table-wrap .mc-pagination button:disabled {
    opacity: 0.4 !important;
    cursor: not-allowed !important;
}

.mc-empty {
    padding: 2rem !important;
    text-align: center !important;
    color: var(--ink-muted, #5c6b74) !important;
}

.mc-empty i {
    font-size: 2rem !important;
    display: block !important;
    margin-bottom: 0.5rem !important;
    opacity: 0.3 !important;
}

/* ---------- MC MODAL ---------- */
.mc-modal-overlay {
    display: none !important;
    position: fixed !important;
    inset: 0 !important;
    background: rgba(0,0,0,0.5) !important;
    z-index: 9999 !important;
    align-items: center !important;
    justify-content: center !important;
    backdrop-filter: blur(4px) !important;
    padding: 1rem !important;
}

.mc-modal-overlay.mc-show {
    display: flex !important;
}

.mc-modal {
    background: var(--surface, #ffffff) !important;
    border-radius: 14px !important;
    padding: 1.5rem 2rem !important;
    max-width: 640px !important;
    width: 100% !important;
    max-height: 85vh !important;
    overflow-y: auto !important;
    box-shadow: 0 20px 60px rgba(0,0,0,0.2) !important;
    animation: mcModalSlideIn 0.3s ease !important;
}

@keyframes mcModalSlideIn {
    from { opacity: 0; transform: translateY(-20px) scale(0.95); }
    to { opacity: 1; transform: translateY(0) scale(1); }
}

.mc-modal .mc-modal-header {
    display: flex !important;
    justify-content: space-between !important;
    align-items: center !important;
    margin-bottom: 1rem !important;
    padding-bottom: 0.5rem !important;
    border-bottom: 1px solid var(--border, #e3e7ea) !important;
}

.mc-modal .mc-modal-header h3 {
    font-size: 1.1rem !important;
    font-weight: 700 !important;
    color: var(--ink, #1a2332) !important;
}

.mc-modal .mc-modal-close {
    background: none !important;
    border: none !important;
    color: var(--ink-muted, #5c6b74) !important;
    font-size: 1.2rem !important;
    cursor: pointer !important;
    padding: 0.3rem !important;
    border-radius: 6px !important;
    transition: all 0.2s ease !important;
}

.mc-modal .mc-modal-close:hover {
    background: var(--canvas, #f4f5f6) !important;
    color: var(--ink, #1a2332) !important;
}

.mc-modal .mc-form-grid {
    display: grid !important;
    grid-template-columns: 1fr 1fr !important;
    gap: 1rem !important;
}

.mc-modal .mc-form-group {
    margin-bottom: 0.75rem !important;
}

.mc-modal .mc-form-group.mc-full {
    grid-column: span 2 !important;
}

.mc-modal .mc-form-group label {
    display: block !important;
    font-size: 0.75rem !important;
    font-weight: 600 !important;
    color: var(--ink, #1a2332) !important;
    margin-bottom: 0.2rem !important;
}

.mc-modal .mc-form-group label .mc-required {
    color: #dc2626 !important;
}

.mc-modal .mc-form-group input,
.mc-modal .mc-form-group textarea,
.mc-modal .mc-form-group select {
    width: 100% !important;
    padding: 0.4rem 0.6rem !important;
    border: 1px solid var(--border, #e3e7ea) !important;
    border-radius: 8px !important;
    background: var(--surface, #ffffff) !important;
    color: var(--ink, #1a2332) !important;
    font-size: 0.8rem !important;
    font-family: 'Inter', sans-serif !important;
    transition: all 0.2s ease !important;
}

.mc-modal .mc-form-group input:focus,
.mc-modal .mc-form-group textarea:focus,
.mc-modal .mc-form-group select:focus {
    border-color: var(--primary, #078ece) !important;
    outline: none !important;
    box-shadow: 0 0 0 3px rgba(7,142,206,0.1) !important;
}

.mc-modal .mc-form-group .mc-error {
    font-size: 0.65rem !important;
    color: #dc2626 !important;
    margin-top: 0.15rem !important;
    display: none !important;
}

.mc-modal .mc-form-group .mc-error.mc-show {
    display: block !important;
}

.mc-modal .mc-form-actions {
    display: flex !important;
    gap: 0.75rem !important;
    justify-content: flex-end !important;
    margin-top: 1rem !important;
    padding-top: 0.75rem !important;
    border-top: 1px solid var(--border, #e3e7ea) !important;
}

.mc-modal .mc-form-actions .mc-btn-secondary {
    padding: 0.4rem 1.2rem !important;
    background: transparent !important;
    color: var(--ink-muted, #5c6b74) !important;
    border: 1.5px solid var(--border, #e3e7ea) !important;
    border-radius: 8px !important;
    font-size: 0.78rem !important;
    font-weight: 500 !important;
    cursor: pointer !important;
    font-family: 'Inter', sans-serif !important;
}

.mc-modal .mc-form-actions .mc-btn-secondary:hover {
    border-color: var(--primary, #078ece) !important;
    color: var(--ink, #1a2332) !important;
    background: var(--surface-hover, #f8f9fa) !important;
}

.mc-modal .mc-form-actions .mc-btn-primary {
    padding: 0.4rem 1.2rem !important;
    background: var(--primary, #078ece) !important;
    color: #fff !important;
    border: none !important;
    border-radius: 8px !important;
    font-size: 0.78rem !important;
    font-weight: 600 !important;
    cursor: pointer !important;
    font-family: 'Inter', sans-serif !important;
}

.mc-modal .mc-form-actions .mc-btn-primary:hover {
    background: var(--primary-dark, #045a86) !important;
    transform: translateY(-1px) !important;
    box-shadow: 0 4px 12px rgba(7,142,206,0.3) !important;
}

/* ---------- MC ICON SELECT WRAPPER ---------- */
.mc-icon-select-wrapper {
    display: flex !important;
    align-items: center !important;
    gap: 0.75rem !important;
    position: relative !important;
}

.mc-icon-select {
    flex: 1 !important;
    padding: 0.4rem 2rem 0.4rem 0.6rem !important;
    border: 1px solid var(--border, #e3e7ea) !important;
    border-radius: 8px !important;
    background: var(--surface, #ffffff) !important;
    color: var(--ink, #1a2332) !important;
    font-size: 0.8rem !important;
    font-family: 'Inter', sans-serif !important;
    appearance: none !important;
    -webkit-appearance: none !important;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%235c6b74' d='M6 8L1 3h10z'/%3E%3C/svg%3E") !important;
    background-repeat: no-repeat !important;
    background-position: right 0.6rem center !important;
    background-size: 10px !important;
    cursor: pointer !important;
}

.mc-icon-select:focus {
    border-color: var(--primary, #078ece) !important;
    outline: none !important;
    box-shadow: 0 0 0 3px rgba(7,142,206,0.1) !important;
}

.mc-icon-preview {
    width: 40px !important;
    height: 40px !important;
    border-radius: 8px !important;
    border: 1px solid var(--border, #e3e7ea) !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    font-size: 1.2rem !important;
    background: var(--canvas, #f4f5f6) !important;
    color: var(--primary, #078ece) !important;
    flex-shrink: 0 !important;
    transition: all 0.3s ease !important;
}

.mc-icon-preview i {
    transition: transform 0.3s ease !important;
}

.mc-icon-preview:hover i {
    transform: scale(1.2) !important;
}

[data-theme="dark"] .mc-icon-preview {
    background: var(--surface-hover, #1e293b) !important;
}

/* ---------- MC CHECKBOX STYLES ---------- */
.mc-checkbox-group {
    display: flex !important;
    align-items: center !important;
    gap: 0.5rem !important;
    padding: 0.3rem 0 !important;
}

.mc-checkbox-group input[type="checkbox"] {
    width: 18px !important;
    height: 18px !important;
    cursor: pointer !important;
    accent-color: var(--primary, #078ece) !important;
}

.mc-checkbox-group label {
    margin-bottom: 0 !important;
    font-weight: 500 !important;
    font-size: 0.8rem !important;
    cursor: pointer !important;
}

.mc-checkbox-group .mc-hint {
    font-size: 0.65rem !important;
    color: var(--ink-muted, #5c6b74) !important;
    font-weight: 400 !important;
}

/* ---------- MC CONFIRM ---------- */
.mc-confirm {
    max-width: 440px !important;
}

.mc-confirm .mc-confirm-icon {
    text-align: center !important;
    font-size: 2.5rem !important;
    margin-bottom: 0.75rem !important;
}

.mc-confirm .mc-confirm-icon.mc-warning { color: #f59e0b !important; }
.mc-confirm .mc-confirm-icon.mc-danger { color: #dc2626 !important; }

.mc-confirm .mc-confirm-title {
    text-align: center !important;
    font-size: 1.1rem !important;
    font-weight: 700 !important;
    color: var(--ink, #1a2332) !important;
    margin-bottom: 0.5rem !important;
}

.mc-confirm .mc-confirm-msg {
    text-align: center !important;
    font-size: 0.85rem !important;
    color: var(--ink-muted, #5c6b74) !important;
    margin-bottom: 1.5rem !important;
    line-height: 1.5 !important;
}

/* ---------- MC TOAST ---------- */
.mc-toast-container {
    position: fixed !important;
    top: 80px !important;
    right: 20px !important;
    z-index: 99999 !important;
    display: flex !important;
    flex-direction: column !important;
    gap: 10px !important;
    max-width: 400px !important;
    width: 100% !important;
}

.mc-toast {
    background: var(--surface, #ffffff) !important;
    border-radius: 10px !important;
    padding: 0.75rem 1rem !important;
    box-shadow: 0 10px 40px rgba(0,0,0,0.15) !important;
    display: flex !important;
    align-items: center !important;
    gap: 0.75rem !important;
    animation: mcSlideInRight 0.4s ease !important;
    border-left: 4px solid var(--primary, #078ece) !important;
    min-width: 280px !important;
}

.mc-toast.mc-success { border-left-color: #059669 !important; }
.mc-toast.mc-error { border-left-color: #dc2626 !important; }
.mc-toast.mc-warning { border-left-color: #d97706 !important; }

.mc-toast .mc-toast-close {
    background: none !important;
    border: none !important;
    color: var(--ink-muted, #5c6b74) !important;
    cursor: pointer !important;
    font-size: 0.8rem !important;
    padding: 0.15rem !important;
}

@keyframes mcSlideInRight {
    from { transform: translateX(100%); opacity: 0; }
    to { transform: translateX(0); opacity: 1; }
}

/* ---------- RESPONSIVE ---------- */
@media (max-width: 768px) {
    .mc-modal .mc-form-grid {
        grid-template-columns: 1fr !important;
    }
    .mc-modal .mc-form-group.mc-full {
        grid-column: span 1 !important;
    }
    .mc-modal {
        padding: 1rem 1.25rem !important;
        max-width: 95% !important;
    }
}

@media (max-width: 480px) {
    .mc-modal {
        padding: 0.75rem 1rem !important;
        max-width: 98% !important;
    }
    .mc-modal .mc-form-actions {
        flex-direction: column !important;
    }
    .mc-modal .mc-form-actions .mc-btn-secondary,
    .mc-modal .mc-form-actions .mc-btn-primary {
        width: 100% !important;
        justify-content: center !important;
    }
}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="mc-container">

    <!-- Stats Cards -->
    <div class="mc-stats-wrapper">
        <div class="mc-stat-card mc-primary">
            <div class="mc-accent"></div>
            <div class="mc-icon mc-blue">
                <i class="fas fa-cubes"></i>
            </div>
            <div class="mc-number" id="statTotal"><?= $total_modules ?? 0 ?></div>
            <div class="mc-label">Total Modules</div>
            <span class="mc-trend mc-up">
                <i class="fas fa-arrow-up"></i> 12%
            </span>
        </div>
        <div class="mc-stat-card mc-success">
            <div class="mc-accent"></div>
            <div class="mc-icon mc-green">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="mc-number" id="statActive"><?= $active_modules ?? 0 ?></div>
            <div class="mc-label">Active Modules</div>
            <span class="mc-trend mc-up">
                <i class="fas fa-arrow-up"></i> 8%
            </span>
        </div>
        <div class="mc-stat-card mc-danger">
            <div class="mc-accent"></div>
            <div class="mc-icon mc-red">
                <i class="fas fa-times-circle"></i>
            </div>
            <div class="mc-number" id="statInactive"><?= ($total_modules ?? 0) - ($active_modules ?? 0) ?></div>
            <div class="mc-label">Inactive Modules</div>
            <span class="mc-trend mc-down">
                <i class="fas fa-arrow-down"></i> 3%
            </span>
        </div>
        <div class="mc-stat-card mc-purple">
            <div class="mc-accent"></div>
            <div class="mc-icon mc-purple">
                <i class="fas fa-folder-tree"></i>
            </div>
            <div class="mc-number" id="statCategories"><?= $category_count ?? 0 ?></div>
            <div class="mc-label">Categories</div>
            <span class="mc-trend mc-neutral">
                <i class="fas fa-minus"></i> 0%
            </span>
        </div>
    </div>

    <!-- Action Bar -->
    <div class="mc-action-bar">
        <button class="mc-btn" onclick="mcOpenAddModal()">
            <i class="fas fa-plus"></i> Add Module
        </button>
    </div>

    <!-- Table -->
    <div class="mc-table-wrap">
        <div class="mc-toolbar">
            <div class="mc-search">
                <i class="fas fa-search" style="color: var(--ink-muted, #5c6b74); font-size: 0.75rem;"></i>
                <input type="text" id="mcDtSearch" placeholder="Search modules...">
            </div>
            <div class="mc-toolbar-right">
                <div class="mc-per-page">
                    <label>Show</label>
                    <select id="mcDtPerPage">
                        <option value="10">10</option>
                        <option value="25" selected>25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <label>entries</label>
                </div>
                <button class="mc-refresh" onclick="mcRefreshTable()" title="Refresh">
                    <i class="fas fa-sync-alt"></i>
                </button>
            </div>
        </div>

        <div class="mc-scroll">
            <table id="mcModulesTable">
                <thead>
                    <tr>
                        <th data-sort="module_id" style="width: 50px;"># <span style="margin-left: 0.2rem; opacity: 0.3; font-size: 0.5rem;">⇅</span></th>
                        <th data-sort="name">Module <span style="margin-left: 0.2rem; opacity: 0.3; font-size: 0.5rem;">⇅</span></th>
                        <th data-sort="slug">Slug <span style="margin-left: 0.2rem; opacity: 0.3; font-size: 0.5rem;">⇅</span></th>
                        <th data-sort="description">Description <span style="margin-left: 0.2rem; opacity: 0.3; font-size: 0.5rem;">⇅</span></th>
                        <th style="text-align: center;">Parent</th>
                        <th style="text-align: center;">Type</th>
                        <th data-sort="is_active" style="text-align: center;">Status <span style="margin-left: 0.2rem; opacity: 0.3; font-size: 0.5rem;">⇅</span></th>
                        <th style="text-align: center; width: 140px;">Actions</th>
                    </tr>
                </thead>
                <tbody id="mcTableBody">
                    <!-- Data loaded via AJAX -->
                </tbody>
            </table>
        </div>

        <div class="mc-footer">
            <div class="mc-info">
                Showing <span id="mcDtStart">0</span> to <span id="mcDtEnd">0</span> of <span id="mcDtTotal">0</span> entries
            </div>
            <div class="mc-pagination" id="mcDtPagination">
                <!-- Pagination buttons rendered by JS -->
            </div>
        </div>
    </div>

</div>

<!-- ============================================================
     ADD/EDIT MODULE MODAL WITH PARENT SELECTION & ICON DROPDOWN
     ============================================================ -->
<div class="mc-modal-overlay" id="mcModuleModal">
    <div class="mc-modal">
        <div class="mc-modal-header">
            <h3 id="mcModalTitle">Add Module</h3>
            <button class="mc-modal-close" onclick="mcCloseModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <form id="mcModuleForm" onsubmit="mcSaveModule(event)">
            <?= csrf_field() ?>
            <input type="hidden" id="mcFormModuleId" name="module_id" value="">
            
            <div class="mc-form-grid">
                <div class="mc-form-group">
                    <label for="mcFormName">Module Name <span class="mc-required">*</span></label>
                    <input type="text" id="mcFormName" name="name" placeholder="e.g., AI Agent" required oninput="mcGenerateSlug()">
                    <div class="mc-error" id="mcNameError">Please enter a module name</div>
                </div>
                
                <div class="mc-form-group">
                    <label for="mcFormSlug">Slug <span class="mc-required">*</span></label>
                    <input type="text" id="mcFormSlug" name="slug" placeholder="Auto-generated" required>
                    <div class="mc-error" id="mcSlugError">Please enter a slug</div>
                </div>
                
                <div class="mc-form-group mc-full">
                    <label for="mcFormDescription">Description</label>
                    <textarea id="mcFormDescription" name="description" placeholder="Enter module description" rows="2"></textarea>
                </div>
                
                <div class="mc-form-group">
                    <label for="mcFormParentId">Parent Category</label>
                    <select id="mcFormParentId" name="parent_id">
                        <option value="">None (Root Category)</option>
                        <!-- Categories loaded via AJAX -->
                    </select>
                    <div class="mc-error" id="mcParentError">Please select a valid parent</div>
                </div>
                
                <!-- ============================================================
                     ICON DROPDOWN WITH PREVIEW
                     ============================================================ -->
                <div class="mc-form-group">
                    <label for="mcFormIcon">Icon</label>
                    <div class="mc-icon-select-wrapper">
                        <select id="mcFormIcon" name="icon" class="mc-icon-select">
                            <option value="fa-cube">fa-cube</option>
                            <option value="fa-folder">fa-folder</option>
                            <option value="fa-headset">fa-headset</option>
                            <option value="fa-book-open">fa-book-open</option>
                            <option value="fa-users">fa-users</option>
                            <option value="fa-user-tie">fa-user-tie</option>
                            <option value="fa-bullhorn">fa-bullhorn</option>
                            <option value="fa-handshake">fa-handshake</option>
                            <option value="fa-file-contract">fa-file-contract</option>
                            <option value="fa-chart-line">fa-chart-line</option>
                            <option value="fa-building">fa-building</option>
                            <option value="fa-concierge-bell">fa-concierge-bell</option>
                            <option value="fa-industry">fa-industry</option>
                            <option value="fa-file-signature">fa-file-signature</option>
                            <option value="fa-cog">fa-cog</option>
                            <option value="fa-cogs">fa-cogs</option>
                            <option value="fa-robot">fa-robot</option>
                            <option value="fa-newspaper">fa-newspaper</option>
                            <option value="fa-rocket">fa-rocket</option>
                            <option value="fa-comment-dots">fa-comment-dots</option>
                            <option value="fa-ticket-alt">fa-ticket-alt</option>
                            <option value="fa-question-circle">fa-question-circle</option>
                            <option value="fa-database">fa-database</option>
                            <option value="fa-user-edit">fa-user-edit</option>
                            <option value="fa-user-plus">fa-user-plus</option>
                            <option value="fa-user-minus">fa-user-minus</option>
                            <option value="fa-user-check">fa-user-check</option>
                            <option value="fa-users-cog">fa-users-cog</option>
                            <option value="fa-shield-alt">fa-shield-alt</option>
                            <option value="fa-lock">fa-lock</option>
                            <option value="fa-unlock">fa-unlock</option>
                            <option value="fa-key">fa-key</option>
                            <option value="fa-envelope">fa-envelope</option>
                            <option value="fa-phone">fa-phone</option>
                            <option value="fa-globe">fa-globe</option>
                            <option value="fa-map-marker-alt">fa-map-marker-alt</option>
                            <option value="fa-clock">fa-clock</option>
                            <option value="fa-calendar">fa-calendar</option>
                            <option value="fa-upload">fa-upload</option>
                            <option value="fa-download">fa-download</option>
                            <option value="fa-print">fa-print</option>
                            <option value="fa-search">fa-search</option>
                            <option value="fa-filter">fa-filter</option>
                            <option value="fa-sort">fa-sort</option>
                            <option value="fa-export">fa-export</option>
                            <option value="fa-import">fa-import</option>
                            <option value="fa-file-alt">fa-file-alt</option>
                            <option value="fa-file-pdf">fa-file-pdf</option>
                            <option value="fa-file-word">fa-file-word</option>
                            <option value="fa-file-excel">fa-file-excel</option>
                            <option value="fa-file-image">fa-file-image</option>
                            <option value="fa-file-archive">fa-file-archive</option>
                            <option value="fa-file-code">fa-file-code</option>
                            <option value="fa-chart-pie">fa-chart-pie</option>
                            <option value="fa-chart-bar">fa-chart-bar</option>
                            <option value="fa-chart-area">fa-chart-area</option>
                            <option value="fa-wallet">fa-wallet</option>
                            <option value="fa-credit-card">fa-credit-card</option>
                            <option value="fa-money-bill">fa-money-bill</option>
                            <option value="fa-piggy-bank">fa-piggy-bank</option>
                        </select>
                        <div class="mc-icon-preview" id="mcIconPreview">
                            <i class="fas fa-cube"></i>
                        </div>
                    </div>
                </div>
                
                <div class="mc-form-group mc-full">
                    <label for="mcFormStatus">Status</label>
                    <select id="mcFormStatus" name="is_active">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
                
                <div class="mc-form-group mc-full">
                    <div class="mc-checkbox-group">
                        <input type="checkbox" id="mcFormIsCategory" name="is_category" value="1" onchange="mcToggleCategoryMode()">
                        <label for="mcFormIsCategory">This is a Category (Parent)</label>
                        <span class="mc-hint">— Categories can have sub-modules</span>
                    </div>
                </div>
                
                <div class="mc-form-group mc-full">
                    <div class="mc-checkbox-group">
                        <input type="checkbox" id="mcFormCreatePermissions" name="create_permissions" value="1" checked>
                        <label for="mcFormCreatePermissions">Auto-create default permissions</label>
                        <span class="mc-hint">— View, Add, Edit, Delete, Manage</span>
                    </div>
                </div>
            </div>
            
            <div class="mc-form-actions">
                <button type="button" class="mc-btn-secondary" onclick="mcCloseModal()">Cancel</button>
                <button type="submit" class="mc-btn-primary" id="mcFormSubmitBtn">
                    <i class="fas fa-save"></i> Save Module
                </button>
            </div>
        </form>
    </div>
</div>


<!-- ============================================================
     CONFIRMATION MODAL
     ============================================================ -->
<div class="mc-modal-overlay mc-confirm" id="mcConfirmModal">
    <div class="mc-modal">
        <div class="mc-modal-header">
            <h3 class="mc-confirm-title" id="mcConfirmTitle">Are you sure?</h3>
            <button class="mc-modal-close" onclick="mcCloseConfirmModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="mc-confirm-icon mc-warning" id="mcConfirmIcon">
            <i class="fas fa-exclamation-triangle"></i>
        </div>
        <p class="mc-confirm-msg" id="mcConfirmMessage">This action cannot be undone.</p>
        <div class="mc-form-actions">
            <button type="button" class="mc-btn-secondary" onclick="mcCloseConfirmModal()">Cancel</button>
            <button type="button" class="mc-btn-primary" id="mcConfirmBtn" style="background: #dc2626 !important; border-color: #dc2626 !important;">
                <i class="fas fa-check"></i> Confirm Delete
            </button>
        </div>
    </div>
</div>

<!-- Toast Container -->
<div class="mc-toast-container" id="mcToastContainer"></div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
// ============================================================
// MC - TOAST NOTIFICATIONS
// ============================================================
function mcShowToast(message, title = '', type = 'success', duration = 4000) {
    const container = document.getElementById('mcToastContainer');
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
    toast.className = 'mc-toast mc-' + type;
    toast.innerHTML = `
        <div style="font-size: 1.1rem; flex-shrink: 0; color: ${type === 'success' ? '#059669' : type === 'error' ? '#dc2626' : type === 'warning' ? '#d97706' : 'var(--primary, #078ece)'};"><i class="fas ${icons[type] || icons.info}"></i></div>
        <div style="flex: 1;">
            <div style="font-weight: 600; font-size: 0.8rem; color: var(--ink, #1a2332);">${titles[type]}</div>
            <div style="font-size: 0.7rem; color: var(--ink-muted, #5c6b74);">${message}</div>
        </div>
        <button class="mc-toast-close" onclick="this.closest('.mc-toast').remove()">
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
        if (e.target.closest('.mc-toast-close')) return;
        toast.classList.add('hiding');
        setTimeout(() => { if (toast.parentNode) toast.remove(); }, 400);
    });
}

// ============================================================
// MC - CSRF MANAGEMENT
// ============================================================
const mcCsrfName = '<?= csrf_token() ?>';
let mcCsrfHash = '<?= csrf_hash() ?>';

function mcUpdateCsrf(newToken) {
    if (newToken) { mcCsrfHash = newToken; }
}

// ============================================================
// MC - AUTO-GENERATE SLUG
// ============================================================
function mcGenerateSlug() {
    const name = document.getElementById('mcFormName').value;
    const slugField = document.getElementById('mcFormSlug');
    
    if (name && name.trim().length > 0) {
        const slug = name.trim()
            .toLowerCase()
            .replace(/[^a-z0-9\s-]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-');
        
        slugField.value = slug;
    } else {
        slugField.value = '';
    }
}

// ============================================================
// MC - UPDATE ICON PREVIEW
// ============================================================
function mcUpdateIconPreview(iconClass) {
    const preview = document.getElementById('mcIconPreview');
    if (!preview) return;
    
    preview.innerHTML = '';
    const icon = document.createElement('i');
    icon.className = 'fas ' + iconClass;
    preview.appendChild(icon);
}

// ============================================================
// MC - TOGGLE CATEGORY MODE
// ============================================================
function mcToggleCategoryMode() {
    const isCategory = document.getElementById('mcFormIsCategory').checked;
    const parentSelect = document.getElementById('mcFormParentId');
    const iconSelect = document.getElementById('mcFormIcon');
    
    if (isCategory) {
        parentSelect.value = '';
        parentSelect.disabled = true;
        if (iconSelect.value === 'fa-cube' || iconSelect.value === '') {
            iconSelect.value = 'fa-folder';
            mcUpdateIconPreview('fa-folder');
        }
        document.getElementById('mcFormCreatePermissions').disabled = true;
        document.getElementById('mcFormCreatePermissions').checked = false;
    } else {
        parentSelect.disabled = false;
        if (iconSelect.value === 'fa-folder') {
            iconSelect.value = 'fa-cube';
            mcUpdateIconPreview('fa-cube');
        }
        document.getElementById('mcFormCreatePermissions').disabled = false;
        document.getElementById('mcFormCreatePermissions').checked = true;
    }
}

// ============================================================
// MC - LOAD CATEGORIES
// ============================================================
function mcLoadCategories() {
    const select = document.getElementById('mcFormParentId');
    if (!select) {
        console.error('Parent select element not found');
        return;
    }
    
    select.innerHTML = '<option value="">Loading categories...</option>';
    select.disabled = true;
    
    fetch('<?= base_url('admin/modules/getCategories') ?>', {
        headers: { 
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('HTTP error! status: ' + response.status);
        }
        return response.json();
    })
    .then(data => {
        if (data.status === 'success') {
            const currentValue = select.value;
            let options = '<option value="">None (Root Category)</option>';
            
            if (data.data && data.data.length > 0) {
                data.data.forEach(category => {
                    const icon = category.icon ? '<i class="fas ' + category.icon + '"></i> ' : '';
                    options += '<option value="' + category.module_id + '">' + icon + category.name + ' (ID: ' + category.module_id + ')</option>';
                });
            } else {
                options = '<option value="">No categories available</option>';
            }
            
            select.innerHTML = options;
            if (currentValue) {
                select.value = currentValue;
            }
            select.disabled = false;
            
            if (data.csrf_token) {
                mcUpdateCsrf(data.csrf_token);
            }
        } else {
            select.innerHTML = '<option value="">Error loading categories</option>';
            select.disabled = false;
            mcShowToast('Failed to load categories: ' + (data.message || 'Unknown error'), 'Error', 'error');
        }
    })
    .catch(error => {
        console.error('Error loading categories:', error);
        select.innerHTML = '<option value="">Error loading categories</option>';
        select.disabled = false;
        mcShowToast('Failed to load categories: ' + error.message, 'Error', 'error');
    });
}

// ============================================================
// MC - MODAL FUNCTIONS
// ============================================================
function mcOpenModal() {
    document.getElementById('mcModuleModal').classList.add('mc-show');
    document.body.style.overflow = 'hidden';
    mcLoadCategories();
}

function mcCloseModal() {
    document.getElementById('mcModuleModal').classList.remove('mc-show');
    document.body.style.overflow = '';
    document.getElementById('mcModuleForm').reset();
    document.getElementById('mcFormModuleId').value = '';
    document.getElementById('mcModalTitle').textContent = 'Add Module';
    document.getElementById('mcFormSubmitBtn').innerHTML = '<i class="fas fa-save"></i> Save Module';
    document.querySelectorAll('.mc-error').forEach(el => el.classList.remove('mc-show'));
    document.getElementById('mcFormParentId').disabled = false;
    document.getElementById('mcFormCreatePermissions').disabled = false;
    document.getElementById('mcFormCreatePermissions').checked = true;
    mcUpdateIconPreview('fa-cube');
}

function mcOpenConfirmModal(title, message, type = 'warning', callback, data = null) {
    const modal = document.getElementById('mcConfirmModal');
    const icon = document.getElementById('mcConfirmIcon');
    const titleEl = document.getElementById('mcConfirmTitle');
    const msgEl = document.getElementById('mcConfirmMessage');
    const btn = document.getElementById('mcConfirmBtn');
    
    // Set icon
    icon.className = 'mc-confirm-icon mc-' + type;
    if (type === 'danger') {
        icon.innerHTML = '<i class="fas fa-exclamation-circle"></i>';
        btn.style.background = '#dc2626 !important';
        btn.style.borderColor = '#dc2626 !important';
    } else if (type === 'warning') {
        icon.innerHTML = '<i class="fas fa-exclamation-triangle"></i>';
        btn.style.background = '#f59e0b !important';
        btn.style.borderColor = '#f59e0b !important';
    } else {
        icon.innerHTML = '<i class="fas fa-info-circle"></i>';
        btn.style.background = 'var(--primary, #078ece) !important';
        btn.style.borderColor = 'var(--primary, #078ece) !important';
    }
    
    titleEl.textContent = title;
    msgEl.textContent = message;
    
    // Store callback and data
    confirmCallback = callback;
    confirmData = data;
    
    // Remove old event listeners by cloning the button
    const newBtn = btn.cloneNode(true);
    btn.parentNode.replaceChild(newBtn, btn);
    
    // Add click event to the new button
    newBtn.addEventListener('click', function() {
        mcExecuteConfirm();
    });
    
    modal.classList.add('mc-show');
    document.body.style.overflow = 'hidden';
}

function mcCloseConfirmModal() {
    document.getElementById('mcConfirmModal').classList.remove('mc-show');
    document.body.style.overflow = '';
    // Don't clear callback here - let it be cleared after execution
}
function mcCloseConfirmModal() {
    document.getElementById('mcConfirmModal').classList.remove('mc-show');
    document.body.style.overflow = '';
    confirmCallback = null;
    confirmData = null;
}
function mcExecuteConfirm() {
    if (typeof confirmCallback === 'function') {
        // Call the callback with the stored data
        confirmCallback(confirmData);
    }
    // Close the modal after execution
    mcCloseConfirmModal();
    // Clear callback after execution
    confirmCallback = null;
    confirmData = null;
}
document.getElementById('mcConfirmModal').addEventListener('click', function(e) {
    if (e.target === this) {
        mcCloseConfirmModal();
    }
});

document.querySelectorAll('.mc-modal-overlay').forEach(modal => {
    modal.addEventListener('click', function(e) {
        if (e.target === this) {
            this.classList.remove('mc-show');
            document.body.style.overflow = '';
        }
    });
});

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        document.querySelectorAll('.mc-modal-overlay.mc-show').forEach(modal => {
            modal.classList.remove('mc-show');
            document.body.style.overflow = '';
        });
    }
});

// ============================================================
// MC - OPEN ADD MODAL
// ============================================================
function mcOpenAddModal() {
    document.getElementById('mcFormModuleId').value = '';
    document.getElementById('mcFormName').value = '';
    document.getElementById('mcFormSlug').value = '';
    document.getElementById('mcFormDescription').value = '';
    document.getElementById('mcFormParentId').value = '';
    document.getElementById('mcFormIcon').value = 'fa-cube';
    document.getElementById('mcFormStatus').value = '1';
    document.getElementById('mcFormIsCategory').checked = false;
    document.getElementById('mcFormCreatePermissions').checked = true;
    document.getElementById('mcFormCreatePermissions').disabled = false;
    document.getElementById('mcFormParentId').disabled = false;
    document.getElementById('mcModalTitle').textContent = 'Add Module';
    document.getElementById('mcFormSubmitBtn').innerHTML = '<i class="fas fa-save"></i> Save Module';
    document.querySelectorAll('.mc-error').forEach(el => el.classList.remove('mc-show'));
    mcUpdateIconPreview('fa-cube');
    mcOpenModal();
    setTimeout(() => {
        document.getElementById('mcFormName').focus();
    }, 300);
}

// ============================================================
// MC - EDIT MODULE
// ============================================================
function mcEditModule(id) {
    fetch('<?= base_url('admin/modules/get') ?>/' + id, {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            const module = data.data;
            document.getElementById('mcFormModuleId').value = module.module_id;
            document.getElementById('mcFormName').value = module.name;
            document.getElementById('mcFormSlug').value = module.slug;
            document.getElementById('mcFormDescription').value = module.description || '';
            document.getElementById('mcFormParentId').value = module.parent_id || '';
            document.getElementById('mcFormIcon').value = module.icon || 'fa-cube';
            document.getElementById('mcFormStatus').value = module.is_active ? '1' : '0';
            document.getElementById('mcFormIsCategory').checked = module.is_category == 1;
            document.getElementById('mcFormCreatePermissions').checked = false;
            document.getElementById('mcFormCreatePermissions').disabled = true;
            
            mcUpdateIconPreview(module.icon || 'fa-cube');
            
            if (module.is_category == 1) {
                document.getElementById('mcFormParentId').disabled = true;
                document.getElementById('mcFormParentId').value = '';
            } else {
                document.getElementById('mcFormParentId').disabled = false;
            }
            
            document.getElementById('mcModalTitle').textContent = 'Edit Module';
            document.getElementById('mcFormSubmitBtn').innerHTML = '<i class="fas fa-save"></i> Update Module';
            document.querySelectorAll('.mc-error').forEach(el => el.classList.remove('mc-show'));
            
            if (data.csrf_token) {
                mcUpdateCsrf(data.csrf_token);
            }
            mcOpenModal();
        } else {
            mcShowToast(data.message || 'Failed to load module data', 'Error', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        mcShowToast('An error occurred while loading the module.', 'Error', 'error');
    });
}

// ============================================================
// MC - SAVE MODULE
// ============================================================
function mcSaveModule(event) {
    event.preventDefault();
    
    const form = document.getElementById('mcModuleForm');
    const formData = new FormData(form);
    const id = document.getElementById('mcFormModuleId').value;
    const isCategory = document.getElementById('mcFormIsCategory').checked;
    
    if (isCategory) {
        formData.set('parent_id', '');
    }
    
    const url = id ? '<?= base_url('admin/modules/update') ?>/' + id : '<?= base_url('admin/modules/store') ?>';
    
    document.querySelectorAll('.mc-error').forEach(el => el.classList.remove('mc-show'));
    
    const submitBtn = document.getElementById('mcFormSubmitBtn');
    const originalText = submitBtn.innerHTML;
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';
    
    fetch(url, {
        method: 'POST',
        body: formData,
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(response => response.json())
    .then(data => {
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalText;
        
        if (data.status === 'success') {
            if (data.csrf_token) {
                mcUpdateCsrf(data.csrf_token);
            }
            mcCloseModal();
            mcLoadTableData();
            mcUpdateStats();
            let message = data.message || 'Module saved successfully!';
            if (data.permissions_created) {
                message += ' ' + (data.permissions_message || '');
            }
            mcShowToast(message, 'Success', 'success');
        } else {
            if (typeof data.message === 'object') {
                let hasError = false;
                for (const [key, messages] of Object.entries(data.message)) {
                    const errorEl = document.getElementById('mc' + key.charAt(0).toUpperCase() + key.slice(1) + 'Error');
                    if (errorEl) {
                        errorEl.textContent = Array.isArray(messages) ? messages.join(', ') : messages;
                        errorEl.classList.add('mc-show');
                        hasError = true;
                    }
                }
                if (!hasError) {
                    mcShowToast('Please fix the validation errors.', 'Error', 'error');
                }
            } else {
                mcShowToast(data.message || 'Failed to save module', 'Error', 'error');
            }
        }
    })
    .catch(error => {
        console.error('Error:', error);
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalText;
        mcShowToast('An error occurred while saving the module.', 'Error', 'error');
    });
}

// ============================================================
// MC - TOGGLE STATUS WITH CONFIRMATION
// ============================================================
function mcToggleStatus(id) {
    mcOpenConfirmModal(
        'Toggle Module Status',
        'Are you sure you want to change this module\'s status?',
        'warning',
        function(moduleId) {
            const formData = new FormData();
            formData.set(mcCsrfName, mcCsrfHash);

            fetch('<?= base_url('admin/modules/toggleStatus') ?>/' + moduleId, {
                method: 'POST',
                body: formData,
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    if (data.csrf_token) {
                        mcUpdateCsrf(data.csrf_token);
                    }
                    mcLoadTableData();
                    mcUpdateStats();
                    mcShowToast(data.message || 'Status updated!', 'Success', 'success');
                } else {
                    mcShowToast(data.message || 'Failed to update status', 'Error', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                mcShowToast('An error occurred while updating the status.', 'Error', 'error');
            });
        },
        id
    );
}

// ============================================================
// MC - DELETE MODULE WITH CONFIRMATION
// ============================================================
function mcDeleteModule(id) {
    console.log('Delete called for module ID:', id);
    
    // Get module name for better message
    const row = document.querySelector('tr[data-id="' + id + '"]');
    const nameCell = row ? row.querySelector('td:nth-child(2)') : null;
    const moduleName = nameCell ? nameCell.textContent.trim() : 'this module';
    
    mcOpenConfirmModal(
        'Delete Module',
        'Are you sure you want to delete "' + moduleName + '"? This action cannot be undone.',
        'danger',
        function(moduleId) {
            console.log('Executing delete for module ID:', moduleId);
            
            // Show loading state
            const btn = document.getElementById('mcConfirmBtn');
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Deleting...';
            btn.disabled = true;
            
            // Get CSRF token
            const csrfToken = document.querySelector('input[name="' + mcCsrfName + '"]')?.value || mcCsrfHash;
            
            // Create form data
            const formData = new FormData();
            formData.set(mcCsrfName, csrfToken);
            
            const url = '<?= base_url('admin/modules/delete') ?>/' + moduleId;
            console.log('Delete URL:', url);
            
            fetch(url, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                console.log('Response status:', response.status);
                if (!response.ok) {
                    throw new Error('HTTP error! status: ' + response.status);
                }
                return response.json();
            })
            .then(data => {
                console.log('Delete response:', data);
                
                // Reset button
                btn.innerHTML = originalText;
                btn.disabled = false;
                
                if (data.status === 'success') {
                    if (data.csrf_token) {
                        mcUpdateCsrf(data.csrf_token);
                    }
                    mcLoadTableData();
                    mcUpdateStats();
                    mcShowToast(data.message || 'Module deleted successfully!', 'Success', 'success');
                } else {
                    mcShowToast(data.message || 'Failed to delete module', 'Error', 'error');
                }
            })
            .catch(error => {
                console.error('Delete error:', error);
                
                // Reset button
                btn.innerHTML = originalText;
                btn.disabled = false;
                
                mcShowToast('An error occurred while deleting the module: ' + error.message, 'Error', 'error');
            });
        },
        id
    );
}
// ============================================================
// MC - DATATABLE
// ============================================================
let mcCurrentPage = 1;
let mcPerPage = 25;
let mcSearchQuery = '';
let mcSortField = 'module_id';
let mcSortDirection = 'asc';
let mcTotalRecords = 0;
let confirmCallback = null;
let confirmData = null;

function mcLoadTableData() {
    const params = new URLSearchParams({
        page: mcCurrentPage,
        per_page: mcPerPage,
        search: mcSearchQuery,
        sort: mcSortField,
        direction: mcSortDirection
    });

    fetch('<?= base_url('admin/modules/getData') ?>?' + params.toString(), {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            mcRenderTable(data.data);
            mcUpdatePagination(data.pagination);
            mcUpdateInfo(data.pagination);
            if (data.csrf_token) {
                mcUpdateCsrf(data.csrf_token);
            }
        }
    })
    .catch(error => console.error('Error loading table data:', error));
}

function mcRenderTable(modules) {
    const tbody = document.getElementById('mcTableBody');
    
    if (!tbody) return;
    
    if (!modules || modules.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td colspan="8">
                    <div class="mc-empty">
                        <i class="fas fa-inbox"></i>
                        No modules found.
                    </div>
                </td>
            </tr>
        `;
        return;
    }

    let html = '';
    modules.forEach((module, index) => {
        const startIndex = (mcCurrentPage - 1) * mcPerPage;
        const rowNum = startIndex + index + 1;
        const isActive = module.is_active == 1 || module.is_active === true;
        const statusClass = isActive ? 'mc-active' : 'mc-inactive';
        const statusText = isActive ? 'Active' : 'Inactive';
        const eyeIcon = isActive ? 'fa-eye' : 'fa-eye-slash';
        const isCategory = module.is_category == 1 ? 'Category' : 'Module';
        const typeClass = module.is_category == 1 ? 'mc-category' : '';

        html += `
            <tr data-id="${module.module_id}">
                <td style="color: var(--ink-muted);">${rowNum}</td>
                <td>
                    <div>
                        <div style="font-weight: 600; color: var(--ink);">${mcEscapeHtml(module.name)}</div>
                        ${module.icon ? `<div style="font-size: 0.6rem; color: var(--ink-muted);"><i class="fas ${mcEscapeHtml(module.icon)}"></i> ${mcEscapeHtml(module.icon)}</div>` : ''}
                    </div>
                </td>
                <td style="color: var(--ink-muted); font-family: monospace; font-size: 0.7rem;">${mcEscapeHtml(module.slug)}</td>
                <td style="color: var(--ink-muted); font-size: 0.75rem; max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">${mcEscapeHtml(module.description || '-')}</td>
                <td style="text-align: center; font-size: 0.75rem; color: var(--ink-muted);">${mcEscapeHtml(module.parent_name || '-')}</td>
                <td style="text-align: center;">
                    <span class="mc-type-badge ${typeClass}">${isCategory}</span>
                </td>
                <td style="text-align: center;">
                    <span class="mc-status ${statusClass}" id="mc-status-${module.module_id}">${statusText}</span>
                </td>
                <td style="text-align: center;">
                    <div class="mc-actions">
                        <button onclick="mcEditModule(${module.module_id})" class="mc-act-btn mc-primary" title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button onclick="mcToggleStatus(${module.module_id})" class="mc-act-btn" title="Toggle Status">
                            <i class="fas ${eyeIcon}" id="mc-status-icon-${module.module_id}"></i>
                        </button>
                        <button onclick="mcDeleteModule(${module.module_id})" class="mc-act-btn mc-danger" title="Delete">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>
        `;
    });

    tbody.innerHTML = html;
}

function mcUpdatePagination(pagination) {
    mcTotalRecords = pagination.total;
    const totalPages = pagination.last_page;
    const current = pagination.current_page;

    const container = document.getElementById('mcDtPagination');
    if (!container) return;
    
    let html = '';

    html += `<button onclick="mcGoToPage(${current - 1})" ${current <= 1 ? 'disabled' : ''}>
        <i class="fas fa-chevron-left"></i>
    </button>`;

    let startPage = Math.max(1, current - 2);
    let endPage = Math.min(totalPages, current + 2);

    if (startPage > 1) {
        html += `<button onclick="mcGoToPage(1)">1</button>`;
        if (startPage > 2) html += `<button disabled>...</button>`;
    }

    for (let i = startPage; i <= endPage; i++) {
        html += `<button onclick="mcGoToPage(${i})" class="${i === current ? 'mc-active' : ''}">${i}</button>`;
    }

    if (endPage < totalPages) {
        if (endPage < totalPages - 1) html += `<button disabled>...</button>`;
        html += `<button onclick="mcGoToPage(${totalPages})">${totalPages}</button>`;
    }

    html += `<button onclick="mcGoToPage(${current + 1})" ${current >= totalPages ? 'disabled' : ''}>
        <i class="fas fa-chevron-right"></i>
    </button>`;

    container.innerHTML = html;
}

function mcUpdateInfo(pagination) {
    document.getElementById('mcDtStart').textContent = pagination.from || 0;
    document.getElementById('mcDtEnd').textContent = pagination.to || 0;
    document.getElementById('mcDtTotal').textContent = pagination.total || 0;
}

function mcGoToPage(page) {
    if (page < 1) return;
    const totalPages = Math.ceil(mcTotalRecords / mcPerPage);
    if (page > totalPages) return;
    mcCurrentPage = page;
    mcLoadTableData();
}

document.getElementById('mcDtSearch')?.addEventListener('input', function() {
    mcSearchQuery = this.value;
    mcCurrentPage = 1;
    mcLoadTableData();
});

document.getElementById('mcDtPerPage')?.addEventListener('change', function() {
    mcPerPage = parseInt(this.value);
    mcCurrentPage = 1;
    mcLoadTableData();
});

document.querySelectorAll('#mcModulesTable th[data-sort]').forEach(th => {
    th.addEventListener('click', function() {
        const field = this.dataset.sort;
        if (mcSortField === field) {
            mcSortDirection = mcSortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            mcSortField = field;
            mcSortDirection = 'asc';
        }
        document.querySelectorAll('#mcModulesTable th[data-sort]').forEach(h => h.style.color = 'var(--ink-muted)');
        this.style.color = 'var(--primary)';
        mcCurrentPage = 1;
        mcLoadTableData();
    });
});

function mcRefreshTable() { mcLoadTableData(); }

function mcEscapeHtml(text) {
    if (!text) return '';
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

// ============================================================
// MC - UPDATE STATS
// ============================================================
function mcUpdateStats() {
    fetch('<?= base_url('admin/modules/getStats') ?>', {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            if (data.csrf_token) {
                mcUpdateCsrf(data.csrf_token);
            }
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
// MC - INITIALIZE
// ============================================================
document.addEventListener('DOMContentLoaded', function() {
    mcLoadTableData();
    
    // Icon select change handler
    const iconSelect = document.getElementById('mcFormIcon');
    if (iconSelect) {
        iconSelect.addEventListener('change', function() {
            mcUpdateIconPreview(this.value);
        });
    }
});

// Make functions globally available for onclick attributes
window.mcOpenAddModal = mcOpenAddModal;
window.mcEditModule = mcEditModule;
window.mcDeleteModule = mcDeleteModule;
window.mcToggleStatus = mcToggleStatus;
window.mcRefreshTable = mcRefreshTable;
window.mcCloseModal = mcCloseModal;
window.mcCloseConfirmModal = mcCloseConfirmModal;
window.mcExecuteConfirm = mcExecuteConfirm;
window.mcSaveModule = mcSaveModule;
</script>
<?= $this->endSection() ?>