<<<<<<< HEAD
<?= $this->extend('admin/layout') ?>
=======
﻿<?= $this->extend('layouts/admin') ?>

<?= $this->section('styles') ?>
/* Dashboard Styles */
.dashboard-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 1.25rem;
    margin-bottom: 2rem;
}
.stat-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 1.25rem 1.5rem;
    transition: all 0.3s ease;
}
.stat-card:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
}
.stat-card .stat-icon {
    font-size: 1.3rem;
    color: var(--primary);
    margin-bottom: 0.3rem;
}
.stat-card .stat-number {
    font-size: 1.8rem;
    font-weight: 800;
    color: var(--ink);
}
.stat-card .stat-label {
    font-size: 0.72rem;
    color: var(--ink-muted);
    font-weight: 500;
}
.two-col-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.5rem;
    margin-bottom: 1.5rem;
}
.chart-container {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 1.5rem;
    margin-bottom: 1.5rem;
}
.chart-container h3 {
    font-size: 0.95rem;
    font-weight: 700;
    margin-bottom: 0.75rem;
}
.chart-bars {
    display: flex;
    align-items: flex-end;
    gap: 0.75rem;
    height: 150px;
    padding-top: 0.5rem;
}
.chart-bar {
    flex: 1;
    background: var(--primary);
    border-radius: 4px 4px 0 0;
    min-height: 10px;
    transition: all 0.3s ease;
    position: relative;
    display: flex;
    flex-direction: column;
    align-items: center;
}
.chart-bar:hover {
    opacity: 0.8;
    transform: scaleY(1.02);
}
.chart-bar .bar-label {
    position: absolute;
    bottom: -20px;
    font-size: 0.55rem;
    color: var(--ink-muted);
    text-align: center;
    white-space: nowrap;
}
.chart-bar .bar-value {
    position: absolute;
    top: -18px;
    font-size: 0.6rem;
    font-weight: 700;
    color: var(--primary);
}
.table-container {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    overflow: hidden;
}
.table-container .table-header {
    padding: 0.75rem 1.5rem;
    border-bottom: 1px solid var(--border);
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 0.5rem;
}
.table-container .table-header h3 {
    font-size: 0.9rem;
    font-weight: 700;
}
.table-container table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.82rem;
}
.table-container th {
    text-align: left;
    padding: 0.5rem 1.5rem;
    font-weight: 600;
    color: var(--ink-muted);
    border-bottom: 1px solid var(--border);
    background: var(--canvas);
    font-size: 0.65rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}
.table-container td {
    padding: 0.5rem 1.5rem;
    border-bottom: 1px solid var(--border);
}
.table-container tr:hover td {
    background: var(--canvas);
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
.badge-high { background: #e6f7ef; color: #22a67e; }
.badge-medium { background: #fff3cd; color: #856404; }
.badge-low { background: #fde8e8; color: #c62828; }
.rank-medal { font-size: 1.1rem; }
.rank-1 { color: #ffd700; }
.rank-2 { color: #c0c0c0; }
.rank-3 { color: #cd7f32; }
.iot-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 0.75rem 1rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 0.5rem;
}
.iot-card .sensor-name {
    font-weight: 600;
    font-size: 0.82rem;
}
.iot-card .sensor-value {
    font-size: 0.82rem;
    font-weight: 700;
    color: var(--primary);
}
.iot-card .sensor-time {
    font-size: 0.65rem;
    color: var(--ink-muted);
}
@media (max-width: 992px) {
    .dashboard-grid { grid-template-columns: repeat(2, 1fr); }
    .two-col-grid { grid-template-columns: 1fr; }
}
@media (max-width: 480px) {
    .dashboard-grid { grid-template-columns: 1fr; }
}
<?= $this->endSection() ?>
>>>>>>> 17d626c23e0645a5cbe7ac5719106e0bfa1bc3e1

<?= $this->section('content') ?>





<?= $this->endSection() ?>