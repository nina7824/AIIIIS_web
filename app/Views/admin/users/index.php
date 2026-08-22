<?= $this->extend('admin/layout') ?>

<?= $this->section('styles') ?>
<style>
/* ============================================================
   USER MANAGEMENT - COMPLETELY ISOLATED (uc- prefix)
   ============================================================ */

/* ---------- UC CONTAINER ---------- */
.uc-container {
    width: 100% !important;
    max-width: 100% !important;
    box-sizing: border-box !important;
    padding: 0 !important;
    margin: 0 !important;
}

/* ---------- UC STATS WRAPPER - 4 COLUMN GRID ---------- */
.uc-stats-wrapper {
    display: grid !important;
    grid-template-columns: repeat(4, 1fr) !important;
    gap: 0.75rem !important;
    margin-bottom: 1rem !important;
    width: 100% !important;
    max-width: 100% !important;
    box-sizing: border-box !important;
}

@media (max-width: 992px) {
    .uc-stats-wrapper {
        grid-template-columns: repeat(2, 1fr) !important;
    }
}

@media (max-width: 576px) {
    .uc-stats-wrapper {
        grid-template-columns: 1fr 1fr !important;
        gap: 0.5rem !important;
    }
}

@media (max-width: 400px) {
    .uc-stats-wrapper {
        grid-template-columns: 1fr !important;
    }
}

/* ---------- UC STAT CARD ---------- */
.uc-stat-card {
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

.uc-stat-card .uc-accent {
    position: absolute !important;
    top: 0 !important;
    left: 0 !important;
    right: 0 !important;
    height: 3px !important;
}

.uc-stat-card:hover {
    transform: translateY(-2px) !important;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08) !important;
    border-color: var(--primary, #078ece) !important;
}

/* Icon */
.uc-stat-card .uc-icon {
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

.uc-stat-card .uc-icon.uc-blue { background: #dbeafe !important; color: #2563eb !important; }
.uc-stat-card .uc-icon.uc-green { background: #d1fae5 !important; color: #059669 !important; }
.uc-stat-card .uc-icon.uc-red { background: #fee2e2 !important; color: #dc2626 !important; }
.uc-stat-card .uc-icon.uc-purple { background: #ede9fe !important; color: #7c3aed !important; }

[data-theme="dark"] .uc-stat-card .uc-icon.uc-blue { background: #1e293b !important; color: #60a5fa !important; }
[data-theme="dark"] .uc-stat-card .uc-icon.uc-green { background: #1a3a2a !important; color: #34d399 !important; }
[data-theme="dark"] .uc-stat-card .uc-icon.uc-red { background: #3a1a1a !important; color: #f87171 !important; }
[data-theme="dark"] .uc-stat-card .uc-icon.uc-purple { background: #2d1b4a !important; color: #a78bfa !important; }

/* Number */
.uc-stat-card .uc-number {
    font-size: 1.2rem !important;
    font-weight: 800 !important;
    color: var(--ink, #1a2332) !important;
    line-height: 1.2 !important;
    letter-spacing: -0.02em !important;
}

/* Label */
.uc-stat-card .uc-label {
    font-size: 0.6rem !important;
    font-weight: 500 !important;
    color: var(--ink-muted, #5c6b74) !important;
    text-transform: uppercase !important;
    letter-spacing: 0.04em !important;
    margin-top: 0.1rem !important;
}

/* Trend */
.uc-stat-card .uc-trend {
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

.uc-stat-card .uc-trend.uc-up { color: #059669 !important; }
.uc-stat-card .uc-trend.uc-down { color: #dc2626 !important; }
.uc-stat-card .uc-trend.uc-neutral { color: var(--ink-muted, #5c6b74) !important; }

/* Color variants */
.uc-stat-card.uc-primary .uc-accent { background: #2563eb !important; }
.uc-stat-card.uc-success .uc-accent { background: #059669 !important; }
.uc-stat-card.uc-danger .uc-accent { background: #dc2626 !important; }
.uc-stat-card.uc-purple .uc-accent { background: #7c3aed !important; }

/* ---------- UC ACTION BAR ---------- */
.uc-action-bar {
    display: flex !important;
    justify-content: flex-end !important;
    align-items: center !important;
    margin-bottom: 1rem !important;
    flex-wrap: wrap !important;
    gap: 0.5rem !important;
    width: 100% !important;
}

.uc-action-bar .uc-btn {
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

.uc-action-bar .uc-btn:hover {
    background: var(--primary-dark, #045a86) !important;
    transform: translateY(-1px) !important;
    box-shadow: 0 4px 12px rgba(7,142,206,0.3) !important;
}

/* ---------- UC TABLE ---------- */
.uc-table-wrap {
    background: var(--surface, #ffffff) !important;
    border: 1px solid var(--border, #e3e7ea) !important;
    border-radius: 8px !important;
    overflow: hidden !important;
    width: 100% !important;
}

.uc-table-wrap .uc-toolbar {
    padding: 0.5rem 1rem !important;
    border-bottom: 1px solid var(--border, #e3e7ea) !important;
    display: flex !important;
    justify-content: space-between !important;
    align-items: center !important;
    flex-wrap: wrap !important;
    gap: 0.5rem !important;
}

.uc-table-wrap .uc-search {
    display: flex !important;
    align-items: center !important;
    gap: 0.4rem !important;
    background: var(--canvas, #f4f5f6) !important;
    border: 1px solid var(--border, #e3e7ea) !important;
    border-radius: 6px !important;
    padding: 0.2rem 0.6rem !important;
}

.uc-table-wrap .uc-search input {
    border: none !important;
    background: transparent !important;
    padding: 0.3rem 0.2rem !important;
    font-size: 0.75rem !important;
    color: var(--ink, #1a2332) !important;
    width: 180px !important;
    outline: none !important;
    font-family: 'Inter', sans-serif !important;
}

.uc-table-wrap .uc-toolbar-right {
    display: flex !important;
    align-items: center !important;
    gap: 0.5rem !important;
}

.uc-table-wrap .uc-per-page {
    display: flex !important;
    align-items: center !important;
    gap: 0.3rem !important;
    font-size: 0.7rem !important;
    color: var(--ink-muted, #5c6b74) !important;
}

.uc-table-wrap .uc-per-page select {
    padding: 0.15rem 0.3rem !important;
    border: 1px solid var(--border, #e3e7ea) !important;
    border-radius: 4px !important;
    background: var(--surface, #ffffff) !important;
    color: var(--ink, #1a2332) !important;
    font-size: 0.7rem !important;
    cursor: pointer !important;
    font-family: 'Inter', sans-serif !important;
}

.uc-table-wrap .uc-refresh {
    padding: 0.2rem 0.5rem !important;
    border: 1px solid var(--border, #e3e7ea) !important;
    border-radius: 4px !important;
    background: var(--surface, #ffffff) !important;
    color: var(--ink-muted, #5c6b74) !important;
    cursor: pointer !important;
    font-size: 0.7rem !important;
}

.uc-table-wrap .uc-scroll {
    overflow-x: auto !important;
}

.uc-table-wrap table {
    width: 100% !important;
    border-collapse: collapse !important;
    font-size: 0.8rem !important;
}

.uc-table-wrap table thead {
    background: var(--canvas, #f4f5f6) !important;
}

.uc-table-wrap table th {
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

.uc-table-wrap table td {
    padding: 0.5rem 1rem !important;
    border-bottom: 1px solid var(--border, #e3e7ea) !important;
    vertical-align: middle !important;
}

.uc-table-wrap table tbody tr:hover {
    background: var(--surface-hover, #f8f9fa) !important;
}

.uc-table-wrap .uc-avatar {
    width: 32px !important;
    height: 32px !important;
    border-radius: 50% !important;
    background: var(--primary-gradient, linear-gradient(135deg, #078ece 0%, #045a86 100%)) !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    color: #fff !important;
    font-weight: 700 !important;
    font-size: 0.7rem !important;
    flex-shrink: 0 !important;
}

.uc-table-wrap .uc-user-cell {
    display: flex !important;
    align-items: center !important;
    gap: 0.65rem !important;
}

.uc-table-wrap .uc-user-cell .uc-name {
    font-weight: 600 !important;
    color: var(--ink, #1a2332) !important;
    font-size: 0.8rem !important;
}

.uc-table-wrap .uc-user-cell .uc-email {
    font-size: 0.65rem !important;
    color: var(--ink-muted, #5c6b74) !important;
}

.uc-table-wrap .uc-role-badge {
    display: inline-block !important;
    background: var(--primary-light, #e6f4fb) !important;
    color: var(--primary, #078ece) !important;
    padding: 0.05rem 0.5rem !important;
    border-radius: 10px !important;
    font-size: 0.6rem !important;
    font-weight: 500 !important;
    margin: 0.1rem !important;
}

.uc-table-wrap .uc-status {
    display: inline-block !important;
    padding: 0.05rem 0.6rem !important;
    border-radius: 20px !important;
    font-size: 0.5rem !important;
    font-weight: 600 !important;
    text-transform: uppercase !important;
    letter-spacing: 0.04em !important;
}

.uc-table-wrap .uc-status.uc-active {
    background: #d1fae5 !important;
    color: #059669 !important;
}
.uc-table-wrap .uc-status.uc-inactive {
    background: #fee2e2 !important;
    color: #dc2626 !important;
}

.uc-table-wrap .uc-actions {
    display: flex !important;
    justify-content: center !important;
    gap: 0.1rem !important;
    flex-wrap: wrap !important;
}

.uc-table-wrap .uc-actions .uc-act-btn {
    background: none !important;
    border: none !important;
    color: var(--ink-muted, #5c6b74) !important;
    padding: 0.2rem 0.35rem !important;
    border-radius: 4px !important;
    cursor: pointer !important;
    transition: all 0.2s ease !important;
    font-size: 0.8rem !important;
}

.uc-table-wrap .uc-actions .uc-act-btn:hover {
    background: var(--canvas, #f4f5f6) !important;
    color: var(--ink, #1a2332) !important;
}

.uc-table-wrap .uc-actions .uc-act-btn.uc-danger:hover {
    background: #fee2e2 !important;
    color: #dc2626 !important;
}

.uc-table-wrap .uc-actions .uc-act-btn.uc-primary:hover {
    background: var(--primary-light, #e6f4fb) !important;
    color: var(--primary, #078ece) !important;
}

.uc-table-wrap .uc-footer {
    padding: 0.5rem 1rem !important;
    border-top: 1px solid var(--border, #e3e7ea) !important;
    display: flex !important;
    justify-content: space-between !important;
    align-items: center !important;
    flex-wrap: wrap !important;
    gap: 0.5rem !important;
}

.uc-table-wrap .uc-info {
    font-size: 0.7rem !important;
    color: var(--ink-muted, #5c6b74) !important;
}

.uc-table-wrap .uc-pagination {
    display: flex !important;
    gap: 0.2rem !important;
}

.uc-table-wrap .uc-pagination button {
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

.uc-table-wrap .uc-pagination button:hover:not(:disabled) {
    background: var(--canvas, #f4f5f6) !important;
    color: var(--ink, #1a2332) !important;
}

.uc-table-wrap .uc-pagination button.uc-active {
    background: var(--primary, #078ece) !important;
    color: #fff !important;
    border-color: var(--primary, #078ece) !important;
}

.uc-table-wrap .uc-pagination button:disabled {
    opacity: 0.4 !important;
    cursor: not-allowed !important;
}

.uc-empty {
    padding: 2rem !important;
    text-align: center !important;
    color: var(--ink-muted, #5c6b74) !important;
}

.uc-empty i {
    font-size: 2rem !important;
    display: block !important;
    margin-bottom: 0.5rem !important;
    opacity: 0.3 !important;
}

/* ---------- UC MODAL ---------- */
.uc-modal-overlay {
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

.uc-modal-overlay.uc-show {
    display: flex !important;
}

.uc-modal {
    background: var(--surface, #ffffff) !important;
    border-radius: 14px !important;
    padding: 1.5rem 2rem !important;
    max-width: 640px !important;
    width: 100% !important;
    max-height: 85vh !important;
    overflow-y: auto !important;
    box-shadow: 0 20px 60px rgba(0,0,0,0.2) !important;
    animation: ucModalSlideIn 0.3s ease !important;
}

@keyframes ucModalSlideIn {
    from { opacity: 0; transform: translateY(-20px) scale(0.95); }
    to { opacity: 1; transform: translateY(0) scale(1); }
}

.uc-modal .uc-modal-header {
    display: flex !important;
    justify-content: space-between !important;
    align-items: center !important;
    margin-bottom: 1rem !important;
    padding-bottom: 0.5rem !important;
    border-bottom: 1px solid var(--border, #e3e7ea) !important;
}

.uc-modal .uc-modal-header h3 {
    font-size: 1.1rem !important;
    font-weight: 700 !important;
    color: var(--ink, #1a2332) !important;
}

.uc-modal .uc-modal-close {
    background: none !important;
    border: none !important;
    color: var(--ink-muted, #5c6b74) !important;
    font-size: 1.2rem !important;
    cursor: pointer !important;
    padding: 0.3rem !important;
    border-radius: 6px !important;
    transition: all 0.2s ease !important;
}

.uc-modal .uc-modal-close:hover {
    background: var(--canvas, #f4f5f6) !important;
    color: var(--ink, #1a2332) !important;
}

.uc-modal .uc-form-grid {
    display: grid !important;
    grid-template-columns: 1fr 1fr !important;
    gap: 1rem !important;
}

.uc-modal .uc-form-group {
    margin-bottom: 0.75rem !important;
}

.uc-modal .uc-form-group.uc-full {
    grid-column: span 2 !important;
}

.uc-modal .uc-form-group label {
    display: block !important;
    font-size: 0.75rem !important;
    font-weight: 600 !important;
    color: var(--ink, #1a2332) !important;
    margin-bottom: 0.2rem !important;
}

.uc-modal .uc-form-group label .uc-required {
    color: #dc2626 !important;
}

.uc-modal .uc-form-group input,
.uc-modal .uc-form-group select {
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

.uc-modal .uc-form-group input:focus,
.uc-modal .uc-form-group select:focus {
    border-color: var(--primary, #078ece) !important;
    outline: none !important;
    box-shadow: 0 0 0 3px rgba(7,142,206,0.1) !important;
}

.uc-modal .uc-form-group .uc-error {
    font-size: 0.65rem !important;
    color: #dc2626 !important;
    margin-top: 0.15rem !important;
    display: none !important;
}

.uc-modal .uc-form-group .uc-error.uc-show {
    display: block !important;
}

.uc-modal .uc-form-actions {
    display: flex !important;
    gap: 0.75rem !important;
    justify-content: flex-end !important;
    margin-top: 1rem !important;
    padding-top: 0.75rem !important;
    border-top: 1px solid var(--border, #e3e7ea) !important;
}

.uc-modal .uc-form-actions .uc-btn-secondary {
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

.uc-modal .uc-form-actions .uc-btn-secondary:hover {
    border-color: var(--primary, #078ece) !important;
    color: var(--ink, #1a2332) !important;
    background: var(--surface-hover, #f8f9fa) !important;
}

.uc-modal .uc-form-actions .uc-btn-primary {
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

.uc-modal .uc-form-actions .uc-btn-primary:hover {
    background: var(--primary-dark, #045a86) !important;
    transform: translateY(-1px) !important;
    box-shadow: 0 4px 12px rgba(7,142,206,0.3) !important;
}

/* ---------- UC CONFIRM ---------- */
.uc-confirm {
    max-width: 440px !important;
}

.uc-confirm .uc-confirm-icon {
    text-align: center !important;
    font-size: 2.5rem !important;
    margin-bottom: 0.75rem !important;
}

.uc-confirm .uc-confirm-icon.uc-warning { color: #f59e0b !important; }
.uc-confirm .uc-confirm-icon.uc-danger { color: #dc2626 !important; }

.uc-confirm .uc-confirm-title {
    text-align: center !important;
    font-size: 1.1rem !important;
    font-weight: 700 !important;
    color: var(--ink, #1a2332) !important;
    margin-bottom: 0.5rem !important;
}

.uc-confirm .uc-confirm-msg {
    text-align: center !important;
    font-size: 0.85rem !important;
    color: var(--ink-muted, #5c6b74) !important;
    margin-bottom: 1.5rem !important;
    line-height: 1.5 !important;
}

/* ---------- UC TOAST ---------- */
.uc-toast-container {
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

.uc-toast {
    background: var(--surface, #ffffff) !important;
    border-radius: 10px !important;
    padding: 0.75rem 1rem !important;
    box-shadow: 0 10px 40px rgba(0,0,0,0.15) !important;
    display: flex !important;
    align-items: center !important;
    gap: 0.75rem !important;
    animation: ucSlideInRight 0.4s ease !important;
    border-left: 4px solid var(--primary, #078ece) !important;
    min-width: 280px !important;
}

.uc-toast.uc-success { border-left-color: #059669 !important; }
.uc-toast.uc-error { border-left-color: #dc2626 !important; }
.uc-toast.uc-warning { border-left-color: #d97706 !important; }

.uc-toast .uc-toast-close {
    background: none !important;
    border: none !important;
    color: var(--ink-muted, #5c6b74) !important;
    cursor: pointer !important;
    font-size: 0.8rem !important;
    padding: 0.15rem !important;
}

@keyframes ucSlideInRight {
    from { transform: translateX(100%); opacity: 0; }
    to { transform: translateX(0); opacity: 1; }
}

/* ---------- RESPONSIVE ---------- */
@media (max-width: 768px) {
    .uc-modal .uc-form-grid {
        grid-template-columns: 1fr !important;
    }
    .uc-modal .uc-form-group.uc-full {
        grid-column: span 1 !important;
    }
    .uc-modal {
        padding: 1rem 1.25rem !important;
        max-width: 95% !important;
    }
}

@media (max-width: 480px) {
    .uc-modal {
        padding: 0.75rem 1rem !important;
        max-width: 98% !important;
    }
    .uc-modal .uc-form-actions {
        flex-direction: column !important;
    }
    .uc-modal .uc-form-actions .uc-btn-secondary,
    .uc-modal .uc-form-actions .uc-btn-primary {
        width: 100% !important;
        justify-content: center !important;
    }
}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="uc-container">

    <!-- STATS CARDS -->
    <div class="uc-stats-wrapper">
        <div class="uc-stat-card uc-primary">
            <div class="uc-accent"></div>
            <div class="uc-icon uc-blue">
                <i class="fas fa-users"></i>
            </div>
            <div class="uc-number" id="statTotal"><?= $total_users ?? 0 ?></div>
            <div class="uc-label">Total Users</div>
            <span class="uc-trend uc-up">
                <i class="fas fa-arrow-up"></i> 12%
            </span>
        </div>

        <div class="uc-stat-card uc-success">
            <div class="uc-accent"></div>
            <div class="uc-icon uc-green">
                <i class="fas fa-user-check"></i>
            </div>
            <div class="uc-number" id="statActive"><?= $active_users ?? 0 ?></div>
            <div class="uc-label">Active Users</div>
            <span class="uc-trend uc-up">
                <i class="fas fa-arrow-up"></i> 8%
            </span>
        </div>

        <div class="uc-stat-card uc-danger">
            <div class="uc-accent"></div>
            <div class="uc-icon uc-red">
                <i class="fas fa-user-times"></i>
            </div>
            <div class="uc-number" id="statInactive"><?= ($total_users ?? 0) - ($active_users ?? 0) ?></div>
            <div class="uc-label">Inactive Users</div>
            <span class="uc-trend uc-down">
                <i class="fas fa-arrow-down"></i> 3%
            </span>
        </div>

        <div class="uc-stat-card uc-purple">
            <div class="uc-accent"></div>
            <div class="uc-icon uc-purple">
                <i class="fas fa-user-tag"></i>
            </div>
            <div class="uc-number" id="statRoleCount"><?= $role_count ?? 0 ?></div>
            <div class="uc-label">Role Assignments</div>
            <span class="uc-trend uc-neutral">
                <i class="fas fa-minus"></i> 0%
            </span>
        </div>
    </div>

    <!-- ACTION BAR -->
    <div class="uc-action-bar">
        <button class="uc-btn" onclick="ucOpenAddModal()">
            <i class="fas fa-plus"></i> Add User
        </button>
    </div>

    <!-- TABLE -->
    <div class="uc-table-wrap">
        <div class="uc-toolbar">
            <div class="uc-search">
                <i class="fas fa-search" style="color: var(--ink-muted, #5c6b74); font-size: 0.75rem;"></i>
                <input type="text" id="ucDtSearch" placeholder="Search users...">
            </div>
            <div class="uc-toolbar-right">
                <div class="uc-per-page">
                    <label>Show</label>
                    <select id="ucDtPerPage">
                        <option value="10">10</option>
                        <option value="25" selected>25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <label>entries</label>
                </div>
                <button class="uc-refresh" onclick="ucRefreshTable()" title="Refresh">
                    <i class="fas fa-sync-alt"></i>
                </button>
            </div>
        </div>

        <div class="uc-scroll">
            <table id="ucUsersTable">
                <thead>
                    <tr>
                        <th data-sort="user_id" style="width: 50px;"># <span style="margin-left: 0.2rem; opacity: 0.3; font-size: 0.5rem;">⇅</span></th>
                        <th data-sort="name">User <span style="margin-left: 0.2rem; opacity: 0.3; font-size: 0.5rem;">⇅</span></th>
                        <th data-sort="email">Email <span style="margin-left: 0.2rem; opacity: 0.3; font-size: 0.5rem;">⇅</span></th>
                        <th data-sort="phone">Phone <span style="margin-left: 0.2rem; opacity: 0.3; font-size: 0.5rem;">⇅</span></th>
                        <th>Roles</th>
                        <th data-sort="is_active" style="text-align: center;">Status <span style="margin-left: 0.2rem; opacity: 0.3; font-size: 0.5rem;">⇅</span></th>
                        <th style="text-align: center; width: 140px;">Actions</th>
                    </tr>
                </thead>
                <tbody id="ucTableBody">
                    <!-- Data loaded via AJAX -->
                </tbody>
            </table>
        </div>

        <div class="uc-footer">
            <div class="uc-info">
                Showing <span id="ucDtStart">0</span> to <span id="ucDtEnd">0</span> of <span id="ucDtTotal">0</span> entries
            </div>
            <div class="uc-pagination" id="ucDtPagination">
                <!-- Pagination buttons rendered by JS -->
            </div>
        </div>
    </div>

</div>

<!-- ADD/EDIT USER MODAL -->
<div class="uc-modal-overlay" id="ucUserModal">
    <div class="uc-modal">
        <div class="uc-modal-header">
            <h3 id="ucModalTitle">Add User</h3>
            <button class="uc-modal-close" onclick="ucCloseModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <form id="ucUserForm" onsubmit="ucSaveUser(event)">
            <?= csrf_field() ?>
            <input type="hidden" id="ucFormUserId" name="user_id" value="">
            
            <div class="uc-form-grid">
                <div class="uc-form-group">
                    <label for="ucFormName">Full Name <span class="uc-required">*</span></label>
                    <input type="text" id="ucFormName" name="name" placeholder="e.g., John Doe" required>
                    <div class="uc-error" id="ucNameError">Please enter a name</div>
                </div>
                
                <div class="uc-form-group">
                    <label for="ucFormEmail">Email <span class="uc-required">*</span></label>
                    <input type="email" id="ucFormEmail" name="email" placeholder="john@example.com" required>
                    <div class="uc-error" id="ucEmailError">Please enter a valid email</div>
                </div>
                
                <div class="uc-form-group">
                    <label for="ucFormPhone">Phone</label>
                    <input type="text" id="ucFormPhone" name="phone" placeholder="+250 788 123 456">
                </div>
                
                <div class="uc-form-group">
                    <label for="ucFormRole">Role</label>
                    <select id="ucFormRole" name="role">
                        <option value="enterprise">Enterprise</option>
                        <option value="investor">Investor</option>
                        <option value="nirda_expert">NIRDA Expert</option>
                        <option value="government">Government</option>
                        <option value="analyst">Analyst</option>
                        <option value="administrator">Administrator</option>
                        <option value="super_admin">Super Admin</option>
                    </select>
                </div>
                
                <div class="uc-form-group" id="ucPasswordField">
                    <label for="ucFormPassword">Password</label>
                    <input type="password" id="ucFormPassword" name="password" placeholder="Leave blank to auto-generate">
                </div>
                
                <div class="uc-form-group">
                    <label for="ucFormStatus">Status</label>
                    <select id="ucFormStatus" name="is_active">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
            </div>
            
            <div class="uc-form-actions">
                <button type="button" class="uc-btn-secondary" onclick="ucCloseModal()">Cancel</button>
                <button type="submit" class="uc-btn-primary" id="ucFormSubmitBtn">
                    <i class="fas fa-save"></i> Save User
                </button>
            </div>
        </form>
    </div>
</div>

<!-- CONFIRM MODAL -->
<div class="uc-modal-overlay uc-confirm" id="ucConfirmModal">
    <div class="uc-modal">
        <div class="uc-modal-header">
            <h3 class="uc-confirm-title" id="ucConfirmTitle">Are you sure?</h3>
            <button class="uc-modal-close" onclick="ucCloseConfirmModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="uc-confirm-icon uc-warning" id="ucConfirmIcon">
            <i class="fas fa-exclamation-triangle"></i>
        </div>
        <p class="uc-confirm-msg" id="ucConfirmMessage">This action cannot be undone.</p>
        <div class="uc-form-actions">
            <button type="button" class="uc-btn-secondary" onclick="ucCloseConfirmModal()">Cancel</button>
            <button type="button" class="uc-btn-primary" id="ucConfirmBtn" style="background: #dc2626 !important;">
                <i class="fas fa-check"></i> Confirm
            </button>
        </div>
    </div>
</div>

<!-- TOAST CONTAINER -->
<div class="uc-toast-container" id="ucToastContainer"></div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
// ============================================================
// UC - CSRF MANAGEMENT - FIXED
// ============================================================
const ucCsrfName = '<?= csrf_token() ?>';
let ucCsrfHash = '<?= csrf_hash() ?>';

function ucUpdateCsrf(newToken) {
    if (newToken) { 
        ucCsrfHash = newToken; 
        // Update all forms with new CSRF token
        document.querySelectorAll('input[name="' + ucCsrfName + '"]').forEach(input => {
            input.value = newToken;
        });
    }
}

// ============================================================
// UC - TOAST NOTIFICATIONS
// ============================================================
function ucShowToast(message, title = '', type = 'success', duration = 4000) {
    const container = document.getElementById('ucToastContainer');
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
    toast.className = `uc-toast uc-${type}`;
    toast.innerHTML = `
        <div style="font-size: 1.1rem; flex-shrink: 0; color: ${type === 'success' ? '#059669' : type === 'error' ? '#dc2626' : type === 'warning' ? '#d97706' : 'var(--primary, #078ece)'};"><i class="fas ${icons[type] || icons.info}"></i></div>
        <div style="flex: 1;">
            <div style="font-weight: 600; font-size: 0.8rem; color: var(--ink, #1a2332);">${titles[type]}</div>
            <div style="font-size: 0.7rem; color: var(--ink-muted, #5c6b74);">${message}</div>
        </div>
        <button class="uc-toast-close" onclick="this.closest('.uc-toast').remove()">
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
        if (e.target.closest('.uc-toast-close')) return;
        toast.classList.add('hiding');
        setTimeout(() => { if (toast.parentNode) toast.remove(); }, 400);
    });
}

// ============================================================
// UC - MODAL FUNCTIONS
// ============================================================
function ucOpenModal() {
    document.getElementById('ucUserModal').classList.add('uc-show');
    document.body.style.overflow = 'hidden';
}

function ucCloseModal() {
    document.getElementById('ucUserModal').classList.remove('uc-show');
    document.body.style.overflow = '';
    document.getElementById('ucUserForm').reset();
    document.getElementById('ucFormUserId').value = '';
    document.getElementById('ucModalTitle').textContent = 'Add User';
    document.getElementById('ucFormSubmitBtn').innerHTML = '<i class="fas fa-save"></i> Save User';
    document.querySelectorAll('.uc-error').forEach(el => el.classList.remove('uc-show'));
}

function ucOpenConfirmModal(title, message, type = 'warning', callback) {
    document.getElementById('ucConfirmTitle').textContent = title;
    document.getElementById('ucConfirmMessage').textContent = message;
    const icon = document.getElementById('ucConfirmIcon');
    icon.className = `uc-confirm-icon uc-${type}`;
    icon.innerHTML = type === 'danger' ? '<i class="fas fa-exclamation-circle"></i>' : '<i class="fas fa-exclamation-triangle"></i>';
    document.getElementById('ucConfirmBtn').style.background = type === 'danger' ? '#dc2626 !important' : '#f59e0b !important';
    document.getElementById('ucConfirmModal').classList.add('uc-show');
    document.body.style.overflow = 'hidden';
    document.getElementById('ucConfirmBtn').onclick = function() {
        ucCloseConfirmModal();
        if (typeof callback === 'function') { callback(); }
    };
}

function ucCloseConfirmModal() {
    document.getElementById('ucConfirmModal').classList.remove('uc-show');
    document.body.style.overflow = '';
}

document.querySelectorAll('.uc-modal-overlay').forEach(modal => {
    modal.addEventListener('click', function(e) {
        if (e.target === this) {
            this.classList.remove('uc-show');
            document.body.style.overflow = '';
        }
    });
});
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        document.querySelectorAll('.uc-modal-overlay.uc-show').forEach(modal => {
            modal.classList.remove('uc-show');
            document.body.style.overflow = '';
        });
    }
});

// ============================================================
// UC - OPEN ADD MODAL
// ============================================================
function ucOpenAddModal() {
    document.getElementById('ucFormUserId').value = '';
    document.getElementById('ucFormName').value = '';
    document.getElementById('ucFormEmail').value = '';
    document.getElementById('ucFormPhone').value = '';
    document.getElementById('ucFormRole').value = 'enterprise';
    document.getElementById('ucFormPassword').value = '';
    document.getElementById('ucFormStatus').value = '1';
    document.getElementById('ucModalTitle').textContent = 'Add User';
    document.getElementById('ucFormSubmitBtn').innerHTML = '<i class="fas fa-save"></i> Add User';
    document.getElementById('ucPasswordField').style.display = 'block';
    document.querySelectorAll('.uc-error').forEach(el => el.classList.remove('uc-show'));
    ucOpenModal();
    setTimeout(() => { document.getElementById('ucFormName').focus(); }, 300);
}

// ============================================================
// UC - EDIT USER
// ============================================================
function ucEditUser(id) {
    fetch('<?= base_url('admin/users/get') ?>/' + id, {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            const user = data.data;
            document.getElementById('ucFormUserId').value = user.user_id;
            document.getElementById('ucFormName').value = user.name;
            document.getElementById('ucFormEmail').value = user.email;
            document.getElementById('ucFormPhone').value = user.phone || '';
            document.getElementById('ucFormRole').value = user.role || 'enterprise';
            document.getElementById('ucFormPassword').value = '';
            document.getElementById('ucFormStatus').value = user.is_active ? '1' : '0';
            document.getElementById('ucModalTitle').textContent = 'Edit User';
            document.getElementById('ucFormSubmitBtn').innerHTML = '<i class="fas fa-save"></i> Update User';
            document.getElementById('ucPasswordField').style.display = 'none';
            document.querySelectorAll('.uc-error').forEach(el => el.classList.remove('uc-show'));
            if (data.csrf_token) { ucUpdateCsrf(data.csrf_token); }
            ucOpenModal();
        } else {
            ucShowToast(data.message || 'Failed to load user data', 'Error', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        ucShowToast('Error loading user data', 'Error', 'error');
    });
}

// ============================================================
// UC - VIEW USER
// ============================================================
function ucViewUser(id) {
    fetch('<?= base_url('admin/users/get') ?>/' + id, {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            const user = data.data;
            const fields = [
                { label: 'Full Name', value: user.name },
                { label: 'Email', value: user.email },
                { label: 'Phone', value: user.phone || '-' },
                { label: 'Role', value: user.role || '-' },
                { label: 'Status', value: user.is_active ? 'Active' : 'Inactive' },
                { label: 'Created', value: user.created_at || '-' }
            ];
            alert(fields.map(f => `${f.label}: ${f.value}`).join('\n'));
        } else {
            ucShowToast(data.message || 'Failed to load user data', 'Error', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        ucShowToast('Error loading user data', 'Error', 'error');
    });
}

// ============================================================
// UC - SAVE USER - COMPLETELY FIXED
// ============================================================
function ucSaveUser(event) {
    event.preventDefault();
    
    const form = document.getElementById('ucUserForm');
    const formData = new FormData(form);
    
    // Get CSRF token from the hidden input
    const csrfInput = form.querySelector('input[name="' + ucCsrfName + '"]');
    const csrfToken = csrfInput ? csrfInput.value : ucCsrfHash;
    
    // Ensure CSRF token is set
    formData.set(ucCsrfName, csrfToken);
    
    const id = document.getElementById('ucFormUserId').value;
    const url = id ? '<?= base_url('admin/users/update') ?>/' + id : '<?= base_url('admin/users/create') ?>';
    
    // Clear previous errors
    document.querySelectorAll('.uc-error').forEach(el => el.classList.remove('uc-show'));
    
    const submitBtn = document.getElementById('ucFormSubmitBtn');
    const originalText = submitBtn.innerHTML;
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';
    
    fetch(url, {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': csrfToken
        }
    })
    .then(response => {
        if (response.status === 403) {
            throw new Error('CSRF token expired. Please refresh the page and try again.');
        }
        if (!response.ok) {
            throw new Error('Server error: ' + response.status);
        }
        return response.json();
    })
    .then(data => {
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalText;
        
        if (data.status === 'success') {
            if (data.csrf_token) { 
                ucUpdateCsrf(data.csrf_token);
            }
            ucCloseModal();
            ucLoadTableData();
            ucUpdateStats();
            
            if (data.generated_password) {
                ucShowToast('User created! Password: ' + data.generated_password, 'Success', 'success', 8000);
            } else {
                ucShowToast(data.message || 'User saved successfully!', 'Success', 'success');
            }
        } else {
            if (typeof data.message === 'object') {
                let hasError = false;
                for (const [key, messages] of Object.entries(data.message)) {
                    const errorEl = document.getElementById('uc' + key.charAt(0).toUpperCase() + key.slice(1) + 'Error');
                    if (errorEl) {
                        errorEl.textContent = Array.isArray(messages) ? messages.join(', ') : messages;
                        errorEl.classList.add('uc-show');
                        hasError = true;
                    }
                }
                if (!hasError) {
                    ucShowToast('Please fix the validation errors.', 'Error', 'error');
                }
            } else {
                ucShowToast(data.message || 'Failed to save user', 'Error', 'error');
            }
        }
    })
    .catch(error => {
        console.error('Error:', error);
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalText;
        ucShowToast(error.message || 'An error occurred while saving the user.', 'Error', 'error');
    });
}

// ============================================================
// UC - TOGGLE STATUS - FIXED
// ============================================================
function ucToggleStatus(id) {
    ucOpenConfirmModal(
        'Toggle User Status',
        'Are you sure you want to change this user\'s status?',
        'warning',
        function() {
            const formData = new FormData();
            formData.set(ucCsrfName, ucCsrfHash);
            
            fetch('<?= base_url('admin/users/toggle-status') ?>/' + id, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': ucCsrfHash
                }
            })
            .then(response => {
                if (response.status === 403) {
                    throw new Error('CSRF token expired. Please refresh.');
                }
                return response.json();
            })
            .then(data => {
                if (data.status === 'success') {
                    if (data.csrf_token) { ucUpdateCsrf(data.csrf_token); }
                    ucLoadTableData();
                    ucUpdateStats();
                    ucShowToast(data.message || 'Status updated!', 'Success', 'success');
                } else {
                    ucShowToast(data.message || 'Failed to update status', 'Error', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                ucShowToast(error.message || 'An error occurred while updating the status.', 'Error', 'error');
            });
        }
    );
}

// ============================================================
// UC - DELETE USER - FIXED
// ============================================================
function ucDeleteUser(id) {
    ucOpenConfirmModal(
        'Delete User',
        'Are you sure you want to delete this user? This action cannot be undone.',
        'danger',
        function() {
            const formData = new FormData();
            formData.set(ucCsrfName, ucCsrfHash);
            
            fetch('<?= base_url('admin/users/delete') ?>/' + id, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': ucCsrfHash
                }
            })
            .then(response => {
                if (response.status === 403) {
                    throw new Error('CSRF token expired. Please refresh.');
                }
                return response.json();
            })
            .then(data => {
                if (data.status === 'success') {
                    if (data.csrf_token) { ucUpdateCsrf(data.csrf_token); }
                    ucLoadTableData();
                    ucUpdateStats();
                    ucShowToast(data.message || 'User deleted!', 'Success', 'success');
                } else {
                    ucShowToast(data.message || 'Failed to delete user', 'Error', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                ucShowToast(error.message || 'An error occurred while deleting the user.', 'Error', 'error');
            });
        }
    );
}

// ============================================================
// UC - DATATABLE
// ============================================================
let ucCurrentPage = 1;
let ucPerPage = 25;
let ucSearchQuery = '';
let ucSortField = 'user_id';
let ucSortDirection = 'desc';
let ucTotalRecords = 0;

function ucLoadTableData() {
    const params = new URLSearchParams({
        page: ucCurrentPage,
        per_page: ucPerPage,
        search: ucSearchQuery,
        sort: ucSortField,
        direction: ucSortDirection
    });
    fetch('<?= base_url('admin/users/getData') ?>?' + params.toString(), {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            ucRenderTable(data.data);
            ucUpdatePagination(data.pagination);
            ucUpdateInfo(data.pagination);
            if (data.csrf_token) { ucUpdateCsrf(data.csrf_token); }
        }
    })
    .catch(error => console.error('Error loading table data:', error));
}

function ucRenderTable(users) {
    const tbody = document.getElementById('ucTableBody');
    if (!tbody) return;
    if (!users || users.length === 0) {
        tbody.innerHTML = `<tr><td colspan="7"><div class="uc-empty"><i class="fas fa-inbox"></i>No users found.</div></td></tr>`;
        return;
    }
    let html = '';
    users.forEach((user, index) => {
        const startIndex = (ucCurrentPage - 1) * ucPerPage;
        const rowNum = startIndex + index + 1;
        const isActive = user.is_active == 1 || user.is_active === true;
        const statusClass = isActive ? 'uc-active' : 'uc-inactive';
        const statusText = isActive ? 'Active' : 'Inactive';
        const eyeIcon = isActive ? 'fa-eye' : 'fa-eye-slash';
        const avatar = user.name ? user.name.charAt(0).toUpperCase() : 'U';
        let roles = [];
        if (user.role_names) { roles = user.role_names.split(', '); }
        else if (user.role) { roles = [user.role]; }
        html += `
            <tr data-id="${user.user_id}">
                <td style="color: var(--ink-muted);">${rowNum}</td>
                <td>
                    <div class="uc-user-cell">
                        <span class="uc-avatar">${ucEscapeHtml(avatar)}</span>
                        <div>
                            <div class="uc-name">${ucEscapeHtml(user.name)}</div>
                            <div class="uc-email">${ucEscapeHtml(user.email)}</div>
                        </div>
                    </div>
                </td>
                <td>${ucEscapeHtml(user.email)}</td>
                <td>${ucEscapeHtml(user.phone || '-')}</td>
                <td>${roles.map(role => `<span class="uc-role-badge">${ucEscapeHtml(role)}</span>`).join('')}</td>
                <td style="text-align: center;">
                    <span class="uc-status ${statusClass}">${statusText}</span>
                </td>
                <td style="text-align: center;">
                    <div class="uc-actions">
                        <button onclick="ucViewUser(${user.user_id})" class="uc-act-btn" title="View"><i class="fas fa-eye"></i></button>
                        <button onclick="ucEditUser(${user.user_id})" class="uc-act-btn uc-primary" title="Edit"><i class="fas fa-edit"></i></button>
                        <button onclick="ucToggleStatus(${user.user_id})" class="uc-act-btn" title="Toggle Status"><i class="fas ${eyeIcon}"></i></button>
                        <button onclick="ucDeleteUser(${user.user_id})" class="uc-act-btn uc-danger" title="Delete"><i class="fas fa-trash"></i></button>
                    </div>
                </td>
            </tr>
        `;
    });
    tbody.innerHTML = html;
}

function ucUpdatePagination(pagination) {
    ucTotalRecords = pagination.total;
    const totalPages = pagination.last_page;
    const current = pagination.current_page;
    const container = document.getElementById('ucDtPagination');
    if (!container) return;
    let html = '';
    html += `<button onclick="ucGoToPage(${current - 1})" ${current <= 1 ? 'disabled' : ''}><i class="fas fa-chevron-left"></i></button>`;
    let startPage = Math.max(1, current - 2);
    let endPage = Math.min(totalPages, current + 2);
    if (startPage > 1) {
        html += `<button onclick="ucGoToPage(1)">1</button>`;
        if (startPage > 2) html += `<button disabled>...</button>`;
    }
    for (let i = startPage; i <= endPage; i++) {
        html += `<button onclick="ucGoToPage(${i})" class="${i === current ? 'uc-active' : ''}">${i}</button>`;
    }
    if (endPage < totalPages) {
        if (endPage < totalPages - 1) html += `<button disabled>...</button>`;
        html += `<button onclick="ucGoToPage(${totalPages})">${totalPages}</button>`;
    }
    html += `<button onclick="ucGoToPage(${current + 1})" ${current >= totalPages ? 'disabled' : ''}><i class="fas fa-chevron-right"></i></button>`;
    container.innerHTML = html;
}

function ucUpdateInfo(pagination) {
    document.getElementById('ucDtStart').textContent = pagination.from || 0;
    document.getElementById('ucDtEnd').textContent = pagination.to || 0;
    document.getElementById('ucDtTotal').textContent = pagination.total || 0;
}

function ucGoToPage(page) {
    if (page < 1) return;
    const totalPages = Math.ceil(ucTotalRecords / ucPerPage);
    if (page > totalPages) return;
    ucCurrentPage = page;
    ucLoadTableData();
}

document.getElementById('ucDtSearch')?.addEventListener('input', function() {
    ucSearchQuery = this.value;
    ucCurrentPage = 1;
    ucLoadTableData();
});

document.getElementById('ucDtPerPage')?.addEventListener('change', function() {
    ucPerPage = parseInt(this.value);
    ucCurrentPage = 1;
    ucLoadTableData();
});

document.querySelectorAll('#ucUsersTable th[data-sort]').forEach(th => {
    th.addEventListener('click', function() {
        const field = this.dataset.sort;
        if (ucSortField === field) {
            ucSortDirection = ucSortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            ucSortField = field;
            ucSortDirection = 'asc';
        }
        document.querySelectorAll('#ucUsersTable th[data-sort]').forEach(h => h.style.color = 'var(--ink-muted)');
        this.style.color = 'var(--primary)';
        ucCurrentPage = 1;
        ucLoadTableData();
    });
});

function ucRefreshTable() { ucLoadTableData(); }

function ucEscapeHtml(text) {
    if (!text) return '';
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

// ============================================================
// UC - UPDATE STATS
// ============================================================
function ucUpdateStats() {
    fetch('<?= base_url('admin/users/getStats') ?>', {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            if (data.csrf_token) { ucUpdateCsrf(data.csrf_token); }
            const stats = data.data;
            document.getElementById('statTotal').textContent = stats.total || 0;
            document.getElementById('statActive').textContent = stats.active || 0;
            document.getElementById('statInactive').textContent = (stats.total || 0) - (stats.active || 0);
            document.getElementById('statRoleCount').textContent = stats.role_count || 0;
        }
    })
    .catch(error => console.error('Error updating stats:', error));
}

// ============================================================
// UC - INITIALIZE
// ============================================================
document.addEventListener('DOMContentLoaded', function() {
    ucLoadTableData();
});
</script>
<?= $this->endSection() ?>