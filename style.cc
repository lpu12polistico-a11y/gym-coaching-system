/* ==================== RESET & BASE STYLES ==================== */

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

html {
    font-size: 16px;
    scroll-behavior: smooth;
}

body {
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    color: #333;
    line-height: 1.6;
    min-height: 100vh;
}

/* ==================== CONTAINER ==================== */

.container-main {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

/* ==================== HEADER ==================== */

.header {
    background: white;
    padding: 40px 20px;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    margin-bottom: 30px;
    text-align: center;
}

.header-content h1 {
    font-size: 2.5rem;
    color: #1a1a1a;
    margin-bottom: 8px;
    font-weight: 700;
}

.subtitle {
    color: #666;
    font-size: 1.1rem;
    font-weight: 300;
}

/* ==================== DASHBOARD STATS ==================== */

.dashboard {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.stat-card {
    background: white;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    border-left: 4px solid #007bff;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
}

.stat-card h2 {
    font-size: 0.95rem;
    color: #666;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 15px;
}

.stat-value {
    font-size: 2.5rem;
    font-weight: 700;
    color: #007bff;
}

/* ==================== ALERTS ==================== */

.alert {
    padding: 15px 20px;
    border-radius: 8px;
    margin-bottom: 20px;
    border-left: 4px solid;
}

.alert-error {
    background: #f8d7da;
    color: #721c24;
    border-color: #f5c6cb;
}

/* ==================== DATA SECTIONS ==================== */

.data-section {
    background: white;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    margin-bottom: 30px;
}

.section-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 25px;
    gap: 20px;
}

.section-header h2 {
    font-size: 1.75rem;
    color: #1a1a1a;
    margin-bottom: 5px;
}

.section-description {
    color: #999;
    font-size: 0.95rem;
}

/* ==================== BUTTONS ==================== */

.btn {
    display: inline-block;
    padding: 10px 20px;
    text-decoration: none;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s ease;
    cursor: pointer;
    border: none;
    font-size: 0.95rem;
}

.btn-primary {
    background: #007bff;
    color: white;
    white-space: nowrap;
}

.btn-primary:hover {
    background: #0056b3;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 123, 255, 0.3);
}

.btn-action {
    font-size: 0.85rem;
    padding: 6px 12px;
    margin-right: 8px;
    text-decoration: none;
    border-radius: 4px;
    transition: all 0.2s ease;
}

.btn-edit {
    color: #007bff;
    font-weight: 600;
}

.btn-edit:hover {
    color: #0056b3;
    text-decoration: underline;
}

.btn-delete {
    color: #dc3545;
    font-weight: 600;
}

.btn-delete:hover {
    color: #c82333;
    text-decoration: underline;
}

/* ==================== TABLE STYLES ==================== */

.table-wrapper {
    overflow-x: auto;
    border-radius: 8px;
    border: 1px solid #e9ecef;
}

.data-table {
    width: 100%;
    border-collapse: collapse;
    background: white;
}

.data-table thead {
    background: #f8f9fa;
    border-bottom: 2px solid #e9ecef;
}

.data-table th {
    padding: 15px;
    text-align: left;
    font-weight: 600;
    color: #495057;
    text-transform: uppercase;
    font-size: 0.85rem;
    letter-spacing: 0.5px;
}

.data-table td {
    padding: 15px;
    border-bottom: 1px solid #e9ecef;
    color: #333;
}

.data-table tbody tr:hover {
    background: #f8f9fa;
    transition: background 0.2s ease;
}

.data-table tbody tr:last-child td {
    border-bottom: none;
}

/* ==================== BADGES ==================== */

.badge {
    display: inline-block;
    padding: 4px 12px;
    border-radius: 20px;
    background: #e7f3ff;
    color: #0056b3;
    font-size: 0.85rem;
    font-weight: 500;
}

/* ==================== UTILITY CLASSES ==================== */

.text-center {
    text-align: center;
}

.text-muted {
    color: #999;
}

.text-muted a {
    color: #007bff;
    text-decoration: none;
}

.text-muted a:hover {
    text-decoration: underline;
}

/* ==================== RESPONSIVE DESIGN ==================== */

@media (max-width: 768px) {
    .container-main {
        padding: 15px;
    }

    .header {
        padding: 25px 15px;
    }

    .header-content h1 {
        font-size: 1.75rem;
    }

    .section-header {
        flex-direction: column;
        align-items: stretch;
    }

    .btn-primary {
        width: 100%;
        text-align: center;
    }

    .data-section {
        padding: 15px;
    }

    .data-table th,
    .data-table td {
        padding: 10px;
        font-size: 0.85rem;
    }

    .stat-card {
        padding: 20px;
    }

    .stat-value {
        font-size: 2rem;
    }
}

@media (max-width: 480px) {
    .header-content h1 {
        font-size: 1.5rem;
    }

    .dashboard {
        grid-template-columns: 1fr;
    }

    .btn-action {
        display: block;
        margin-bottom: 8px;
    }
}