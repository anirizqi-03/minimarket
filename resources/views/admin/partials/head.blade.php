<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="csrf-token" content="{{ csrf_token() }}" />

<link rel="shortcut icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🛒</text></svg>" />

<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.46.0/tabler-icons.min.css" />

<link rel="stylesheet" href="{{ asset('customer/css/theme.css') }}"/>

<style>
/* ============================================================
   RESET & TOKENS
============================================================ */
*, *::before, *::after { box-sizing: border-box; }

html, body {
    margin: 0 !important;
    padding: 0 !important;
    width: 100% !important;
    overflow-x: hidden !important;
}

:root {
    --primary: #0aad0a;
    --primary-dark: #088a08;
    --primary-soft: #dcfce7;
    --primary-light: #e8ffe6;

    --surface: #ffffff;
    --surface-2: #f8fafc;
    --surface-3: #f1f5f9;

    --border: #e5e7eb;
    --border-soft: #edf0f2;

    --text: #1f2937;
    --text-2: #4b5563;
    --text-3: #6b7280;
    --text-4: #9ca3af;

    --blue: #0284c7;
    --blue-soft: #e0f2fe;
    --indigo: #4338ca;
    --indigo-soft: #eef2ff;
    --orange: #ea580c;
    --orange-soft: #ffedd5;
    --purple: #7c3aed;
    --purple-soft: #f3e8ff;
    --teal: #0d9488;
    --teal-soft: #ccfbf1;
    --red: #dc2626;
    --red-soft: #fee2e2;
    --yellow: #d97706;
    --yellow-soft: #fef3c7;

    --radius: 14px;
    --radius-sm: 10px;
    --radius-lg: 18px;
    --shadow-sm: 0 1px 2px rgba(0, 0, 0, 0.04);
    --shadow: 0 4px 12px rgba(0, 0, 0, 0.06);

    --sidebar-width: 260px;
    --topbar-height: 68px;
}

body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif !important;
    font-size: 14px;
    line-height: 1.5;
    color: var(--text);
    background: var(--surface-2);
    -webkit-font-smoothing: antialiased;
}

a { color: inherit; text-decoration: none; }
button { font-family: inherit; cursor: pointer; border: none; background: none; }
img, canvas { max-width: 100%; display: block; }
h1, h2, h3, h4, h5, h6 { margin: 0; font-weight: 700; color: var(--text); }
p { margin: 0; }
input, select, textarea { font-family: inherit; font-size: 14px; }

/* ============================================================
   APP SHELL — KUNCI UTAMA
============================================================ */
.app-shell {
    display: flex !important;
    min-height: 100vh;
    width: 100%;
}

.app-main {
    flex: 1 !important;
    min-width: 0 !important;
    display: flex;
    flex-direction: column;
    margin-left: var(--sidebar-width) !important;
    width: calc(100% - var(--sidebar-width)) !important;
}

.app-content {
    flex: 1;
    padding: 24px !important;
    width: 100% !important;
    max-width: 100% !important;
    min-width: 0 !important;
}

@media (max-width: 1024px) {
    .app-main {
        margin-left: 0 !important;
        width: 100% !important;
    }
}

/* ============================================================
   SIDEBAR
============================================================ */
.sidebar {
    position: fixed !important;
    top: 0;
    left: 0;
    bottom: 0;
    width: var(--sidebar-width) !important;
    background: var(--surface);
    border-right: 1px solid var(--border);
    display: flex;
    flex-direction: column;
    z-index: 100;
    transition: transform 0.3s ease;
}

.sidebar-brand {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 18px 20px;
    border-bottom: 1px solid var(--border);
    min-height: var(--topbar-height);
}

.sidebar-brand-icon {
    width: 40px;
    height: 40px;
    border-radius: 12px;
    /* background: linear-gradient(135deg, var(--primary), var(--primary-dark)); */
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 22px;
    flex-shrink: 0;
}

.sidebar-brand-text h1 {
    font-size: 16px;
    font-weight: 800;
    color: var(--text);
    line-height: 1.2;
}

.sidebar-brand-text span {
    font-size: 11px;
    color: var(--text-3);
    font-weight: 500;
}

.sidebar-nav {
    flex: 1;
    overflow-y: auto;
    padding: 16px 12px;
}

.sidebar-nav::-webkit-scrollbar { width: 6px; }
.sidebar-nav::-webkit-scrollbar-thumb {
    background: var(--border);
    border-radius: 3px;
}

.nav-label {
    display: block;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.06em;
    color: var(--text-4);
    padding: 16px 12px 8px;
}

.nav-label:first-child { padding-top: 4px; }

.nav-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 10px 12px;
    border-radius: var(--radius-sm);
    font-size: 13.5px;
    font-weight: 500;
    color: var(--text-2);
    margin-bottom: 2px;
    transition: all 0.15s;
    cursor: pointer;
}

.nav-item:hover { background: var(--surface-3); color: var(--text); }
.nav-item.active {
    background: var(--primary-light);
    color: var(--primary-dark);
    font-weight: 600;
}

.nav-item i { font-size: 18px; flex-shrink: 0; }

.nav-item .nav-badge {
    margin-left: auto;
    font-size: 10px;
    font-weight: 700;
    padding: 2px 7px;
    border-radius: 20px;
    background: var(--red-soft);
    color: var(--red);
}

.nav-item.active .nav-badge { background: var(--primary); color: white; }

.sidebar-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.5);
    z-index: 99;
}

@media (max-width: 1024px) {
    .sidebar { transform: translateX(-100%); }
    .sidebar.open { transform: translateX(0); }
    .sidebar-overlay.show { display: block; }
}

/* ============================================================
   TOPBAR — FIX FULL WIDTH
============================================================ */
.topbar {
    position: sticky !important;
    top: 0;
    z-index: 50;
    height: var(--topbar-height);
    background: var(--surface) !important;
    border-bottom: 1px solid var(--border);
    display: flex !important;
    align-items: center;
    justify-content: space-between;
    padding: 0 24px !important;
    gap: 16px;
    width: 100% !important;
    box-sizing: border-box;
}

.topbar-left {
    display: flex;
    align-items: center;
    gap: 12px;
    flex: 1;
    min-width: 0;
}

.hamburger {
    display: none;
    width: 40px;
    height: 40px;
    border-radius: 10px;
    align-items: center;
    justify-content: center;
    color: var(--text-2);
    font-size: 22px;
}

.hamburger:hover { background: var(--surface-3); }

@media (max-width: 1024px) {
    .hamburger { display: flex; }
}

.search-box {
    position: relative;
    max-width: 380px;
    width: 100%;
}

.search-box input {
    width: 100%;
    padding: 10px 14px 10px 40px;
    border-radius: 10px;
    border: 1px solid var(--border);
    background: var(--surface-2);
    outline: none;
    transition: all 0.15s;
}

.search-box input:focus {
    border-color: var(--primary);
    background: var(--surface);
    box-shadow: 0 0 0 3px rgba(10, 173, 10, 0.12);
}

.search-box i {
    position: absolute;
    left: 13px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--text-4);
    font-size: 18px;
}

.topbar-right {
    display: flex;
    align-items: center;
    gap: 8px;
}

.icon-btn {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--text-2);
    font-size: 20px;
    position: relative;
    transition: all 0.15s;
}

.icon-btn:hover { background: var(--surface-3); color: var(--primary); }

.icon-btn .dot {
    position: absolute;
    top: 8px;
    right: 8px;
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: var(--red);
    border: 2px solid var(--surface);
}

.user-menu {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 5px;
    border-radius: 10px;
    cursor: pointer;
    transition: background 0.15s;
}

.user-menu:hover { background: var(--surface-3); }

.user-dropdown:hover {
    display: block !important;
}

.user-avatar {
    width: 36px;
    height: 36px;
    border-radius: 10px;
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 700;
    font-size: 13px;
    flex-shrink: 0;
}

.user-info { display: none; }
.user-info strong { display: block; font-size: 13px; color: var(--text); }
.user-info span { font-size: 11px; color: var(--text-3); }

@media (min-width: 640px) {
    .user-info { display: block; }
    .user-menu { padding: 5px 12px 5px 5px; }
}

/* ============================================================
   PAGE HEADER
============================================================ */
.page-header {
    display: flex;
    flex-wrap: wrap;
    align-items: flex-start;
    justify-content: space-between;
    gap: 16px;
    margin-bottom: 24px;
}

.page-title {
    font-size: 24px;
    font-weight: 800;
    color: var(--text);
    margin-bottom: 4px;
    letter-spacing: -0.02em;
}

.page-sub { font-size: 13.5px; color: var(--text-3); }
.page-actions { display: flex; flex-wrap: wrap; gap: 8px; }

/* ============================================================
   BUTTONS
============================================================ */
.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    padding: 9px 16px;
    border-radius: 10px;
    font-size: 13.5px;
    font-weight: 600;
    border: 1px solid transparent;
    transition: all 0.15s;
    white-space: nowrap;
    line-height: 1.4;
    cursor: pointer;
}

.btn i { font-size: 16px; }

.btn-primary { background: var(--primary); color: white; }
.btn-primary:hover {
    background: var(--primary-dark);
    box-shadow: 0 4px 12px rgba(10, 173, 10, 0.3);
}

.btn-outline {
    background: var(--surface);
    color: var(--text-2);
    border-color: var(--border);
}
.btn-outline:hover {
    background: var(--surface-3);
    color: var(--text);
    border-color: var(--text-4);
}

.btn-ghost { background: transparent; color: var(--text-2); }
.btn-ghost:hover { background: var(--surface-3); }

.btn-danger { background: var(--red); color: white; }
.btn-danger:hover { background: #b91c1c; }

.btn-sm { padding: 6px 12px; font-size: 12.5px; }
.btn-icon { width: 34px; height: 34px; padding: 0; border-radius: 8px; }

/* ============================================================
   CARDS
============================================================ */
.card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    overflow: hidden;
    min-width: 0;
}

.card-head {
    padding: 18px 20px;
    border-bottom: 1px solid var(--border-soft);
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    flex-wrap: wrap;
}

.card-title { font-size: 15px; font-weight: 700; color: var(--text); margin: 0 0 3px; }
.card-sub { font-size: 12.5px; color: var(--text-3); margin: 0; }
.card-body { padding: 20px; }

/* ============================================================
   STAT CARDS — FIX WRAP
============================================================ */
.stat-grid {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 12px;
    margin-bottom: 20px;
}

@media (max-width: 1200px) {
    .stat-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
}
@media (max-width: 560px) {
    .stat-grid { grid-template-columns: 1fr; }
}

.stat-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 16px;
    display: flex;
    align-items: center;
    gap: 12px;
    min-width: 0 !important;
    transition: all 0.2s;
}

.stat-card:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow);
}

.stat-icon {
    width: 44px;
    height: 44px;
    flex: 0 0 44px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.stat-icon i { font-size: 22px; }

.stat-icon--green  { background: var(--primary-soft); color: var(--primary-dark); }
.stat-icon--blue   { background: var(--blue-soft); color: var(--blue); }
.stat-icon--indigo { background: var(--indigo-soft); color: var(--indigo); }
.stat-icon--orange { background: var(--orange-soft); color: var(--orange); }
.stat-icon--purple { background: var(--purple-soft); color: var(--purple); }
.stat-icon--teal   { background: var(--teal-soft); color: var(--teal); }
.stat-icon--red    { background: var(--red-soft); color: var(--red); }
.stat-icon--yellow { background: var(--yellow-soft); color: var(--yellow); }

.stat-info {
    min-width: 0 !important;
    flex: 1;
    overflow: hidden;
}

.stat-label {
    font-size: 12px;
    color: var(--text-3);
    margin: 0 0 4px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

/* FIX — value tidak terpotong, turun baris kalau panjang */
.stat-value {
    font-size: 18px;
    font-weight: 800;
    color: var(--text);
    line-height: 1.2;
    letter-spacing: -0.01em;
    word-break: break-word;
    overflow-wrap: anywhere;
}

.stat-value .unit {
    font-size: 11px;
    font-weight: 500;
    color: var(--text-3);
    margin-left: 2px;
    white-space: nowrap;
}

.stat-trend {
    display: inline-flex;
    align-items: center;
    gap: 3px;
    margin-top: 4px;
    font-size: 11px;
    font-weight: 600;
    padding: 2px 7px;
    border-radius: 20px;
}

.stat-trend.up   { background: var(--primary-soft); color: var(--primary-dark); }
.stat-trend.down { background: var(--red-soft); color: var(--red); }

/* ============================================================
   GRID
============================================================ */
.grid-2 {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 16px;
    margin-bottom: 20px;
}

.grid-2-even {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
    margin-bottom: 20px;
}

.grid-2 > *, .grid-2-even > * { min-width: 0; }

@media (max-width: 900px) {
    .grid-2, .grid-2-even { grid-template-columns: 1fr; }
}

/* ============================================================
   TABLE
============================================================ */
.table-wrap { width: 100%; overflow-x: auto; }

.data-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 13px;
}

.data-table thead th {
    background: var(--surface-2);
    color: var(--text-3);
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    padding: 12px 16px;
    text-align: left;
    border-bottom: 1px solid var(--border);
    white-space: nowrap;
}

.data-table tbody td {
    padding: 14px 16px;
    border-bottom: 1px solid var(--border-soft);
    color: var(--text-2);
    vertical-align: middle;
}

.data-table tbody tr:hover { background: var(--surface-2); }
.data-table tbody tr:last-child td { border-bottom: none; }
.data-table .text-right { text-align: right; }
.data-table .text-center { text-align: center; }

/* ============================================================
   BADGE
============================================================ */
.badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 600;
    line-height: 1.4;
    white-space: nowrap;
}

.badge--success { background: var(--primary-soft); color: var(--primary-dark); }
.badge--warning { background: var(--yellow-soft); color: var(--yellow); }
.badge--danger  { background: var(--red-soft); color: var(--red); }
.badge--info    { background: var(--blue-soft); color: var(--blue); }
.badge--gray    { background: var(--surface-3); color: var(--text-3); }
.badge--purple  { background: var(--purple-soft); color: var(--purple); }

/* ============================================================
   AVATAR
============================================================ */
.avatar {
    width: 36px;
    height: 36px;
    border-radius: 10px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 12px;
    color: white;
    flex-shrink: 0;
}

.avatar--green  { background: linear-gradient(135deg, #22c55e, #16a34a); }
.avatar--blue   { background: linear-gradient(135deg, #3b82f6, #2563eb); }
.avatar--purple { background: linear-gradient(135deg, #a855f7, #7c3aed); }
.avatar--orange { background: linear-gradient(135deg, #fb923c, #ea580c); }
.avatar--teal   { background: linear-gradient(135deg, #14b8a6, #0d9488); }
.avatar--indigo { background: linear-gradient(135deg, #6366f1, #4338ca); }
.avatar--red    { background: linear-gradient(135deg, #f87171, #dc2626); }

.avatar-lg { width: 44px; height: 44px; border-radius: 12px; font-size: 14px; }
.avatar-sm { width: 30px; height: 30px; border-radius: 8px; font-size: 11px; }

/* ============================================================
   FORM
============================================================ */
.form-group { margin-bottom: 16px; }
.form-label {
    display: block;
    font-size: 13px;
    font-weight: 600;
    color: var(--text);
    margin-bottom: 6px;
}
.form-label .required { color: var(--red); margin-left: 2px; }

.form-control {
    width: 100%;
    padding: 10px 14px;
    border-radius: 10px;
    border: 1px solid var(--border);
    background: var(--surface);
    color: var(--text);
    outline: none;
    transition: all 0.15s;
}

.form-control:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(10, 173, 10, 0.12);
}
.form-control::placeholder { color: var(--text-4); }
textarea.form-control { resize: vertical; min-height: 90px; }

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 14px;
}
@media (max-width: 560px) {
    .form-row { grid-template-columns: 1fr; }
}
.form-hint { display: block; font-size: 12px; color: var(--text-3); margin-top: 4px; }

/* ============================================================
   FILTER BAR
============================================================ */
.filter-bar {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 12px;
    padding: 16px 20px;
    background: var(--surface-2);
    border-bottom: 1px solid var(--border-soft);
}

/* ============================================================
   PAGINATION
============================================================ */
.pagination {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    padding: 14px 20px;
    border-top: 1px solid var(--border-soft);
    flex-wrap: wrap;
}
.pagination-info { font-size: 12.5px; color: var(--text-3); }
.pagination-controls { display: flex; gap: 4px; }

.page-btn {
    min-width: 34px;
    height: 34px;
    padding: 0 10px;
    border-radius: 8px;
    background: var(--surface);
    border: 1px solid var(--border);
    color: var(--text-2);
    font-size: 13px;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}
.page-btn:hover { background: var(--surface-3); color: var(--text); }
.page-btn.active {
    background: var(--primary);
    color: white;
    border-color: var(--primary);
}

/* ============================================================
   MODAL
============================================================ */
.modal {
    position: fixed;
    inset: 0;
    z-index: 999;
    display: none;
    align-items: center;
    justify-content: center;
    padding: 20px;
    background: rgba(15, 23, 42, 0.5);
    backdrop-filter: blur(2px);
}

.modal.show { display: flex; animation: fadeIn 0.15s ease; }

.modal-dialog {
    width: 100%;
    max-width: 520px;
    max-height: 90vh;
    background: var(--surface);
    border-radius: var(--radius-lg);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    display: flex;
    flex-direction: column;
    animation: slideUp 0.2s ease;
}

.modal-dialog.modal-lg { max-width: 720px; }

.modal-head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 20px 22px;
    border-bottom: 1px solid var(--border-soft);
}
.modal-head h3 { font-size: 16px; font-weight: 700; }

.modal-close {
    width: 32px;
    height: 32px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--text-3);
    font-size: 20px;
}
.modal-close:hover { background: var(--surface-3); color: var(--text); }

.modal-body { padding: 22px; overflow-y: auto; }
.modal-foot {
    display: flex;
    justify-content: flex-end;
    gap: 8px;
    padding: 16px 22px;
    border-top: 1px solid var(--border-soft);
    background: var(--surface-2);
    border-radius: 0 0 var(--radius-lg) var(--radius-lg);
}

@keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
@keyframes slideUp {
    from { transform: translateY(15px); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
}

/* ============================================================
   CHART — FIX KEPOTONG
============================================================ */
.chart-wrap {
    position: relative;
    height: 280px;
    width: 100%;
    padding: 8px;
}

.chart-wrap.sm {
    height: 220px;
    padding: 0;
}

.chart-wrap canvas {
    width: 100% !important;
    height: 100% !important;
    max-width: 100% !important;
}

/* ============================================================
   FOOTER
============================================================ */
.app-footer {
    padding: 18px 24px;
    border-top: 1px solid var(--border);
    background: var(--surface);
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    flex-wrap: wrap;
    font-size: 12.5px;
    color: var(--text-3);
}
.app-footer .links { display: flex; gap: 16px; }
.app-footer a:hover { color: var(--primary); }

/* ============================================================
   UTILS
============================================================ */
.flex { display: flex; }
.items-center { align-items: center; }
.justify-between { justify-content: space-between; }
.justify-center { justify-content: center; }
.gap-2 { gap: 8px; }
.gap-3 { gap: 12px; }
.gap-4 { gap: 16px; }
.mb-4 { margin-bottom: 16px; }
.mb-5 { margin-bottom: 20px; }
.mb-6 { margin-bottom: 24px; }
.text-truncate { overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
.text-muted { color: var(--text-3); }
.text-bold { font-weight: 700; }
.text-right { text-align: right; }
.text-center { text-align: center; }
</style>

<title>@yield('title', 'Admin Dashboard') — Minimarket</title>
