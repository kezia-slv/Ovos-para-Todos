</main>
</div><!-- .main-wrapper -->

<style>
    /* ── TABLE ── (shared across views) */
    .table-wrapper { overflow-x: auto; }

    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13.5px;
    }

    thead th {
        background: var(--slate-100);
        color: var(--slate-500);
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        padding: 11px 16px;
        text-align: left;
        border-bottom: 1px solid var(--slate-300);
        white-space: nowrap;
    }

    tbody tr {
        border-bottom: 1px solid var(--slate-100);
        transition: background .1s;
    }

    tbody tr:last-child { border-bottom: none; }
    tbody tr:hover { background: #FFFBEB; }

    tbody td {
        padding: 13px 16px;
        color: var(--slate-700);
        vertical-align: middle;
    }

    .td-mono {
        font-family: 'JetBrains Mono', monospace;
        font-size: 12px;
        color: var(--slate-500);
    }

    /* ── PAGINATION ── */
    .pagination {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 16px 24px;
        border-top: 1px solid var(--slate-100);
        font-size: 13px;
    }

    .pagination-info { color: var(--slate-500); }

    .pagination-links {
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .page-link {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 32px; height: 32px;
        border-radius: 6px;
        font-size: 13px;
        font-weight: 500;
        color: var(--slate-600, #475569);
        text-decoration: none;
        border: 1px solid transparent;
        transition: all .15s;
    }

    .page-link:hover { border-color: var(--slate-300); background: var(--slate-100); }
    .page-link.active { background: var(--amber); color: var(--slate-900); font-weight: 700; }
    .page-link.disabled { opacity: .4; pointer-events: none; }

    /* ── STAT CARDS ── */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 16px;
        margin-bottom: 28px;
    }

    .stat-card {
        background: var(--white);
        border: 1px solid var(--slate-300);
        border-radius: 12px;
        padding: 20px;
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .stat-card-label {
        font-size: 11.5px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--slate-500);
    }

    .stat-card-value {
        font-size: 28px;
        font-weight: 700;
        color: var(--slate-900);
        line-height: 1;
        font-family: 'JetBrains Mono', monospace;
    }

    .stat-card-icon {
        width: 36px; height: 36px;
        border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        font-size: 16px;
        margin-bottom: 4px;
    }

    /* ── EMPTY STATE ── */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: var(--slate-500);
    }

    .empty-state i {
        font-size: 40px;
        color: var(--slate-300);
        margin-bottom: 12px;
    }

    .empty-state p { font-size: 14px; }

    /* ── DELETE CONFIRM ── */
    .confirm-card {
        max-width: 520px;
        margin: 0 auto;
    }

    .danger-zone {
        background: #FEF2F2;
        border: 1.5px solid #FECACA;
        border-radius: 12px;
        padding: 20px 24px;
        margin-bottom: 24px;
    }

    .danger-zone h3 {
        color: #B91C1C;
        font-size: 14px;
        font-weight: 700;
        margin-bottom: 6px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .danger-zone p {
        color: #991B1B;
        font-size: 13px;
        line-height: 1.6;
    }

    /* ── USER DETAIL ROW ── */
    .detail-row {
        display: flex;
        padding: 12px 0;
        border-bottom: 1px solid var(--slate-100);
        font-size: 13.5px;
    }

    .detail-row:last-child { border-bottom: none; }
    .detail-label { width: 140px; color: var(--slate-500); font-weight: 600; flex-shrink: 0; }
    .detail-value { color: var(--slate-800); }
</style>

<script>
    // Auto-dismiss flash messages after 5s
    document.addEventListener('DOMContentLoaded', function () {
        const flash = document.querySelector('.flash');
        if (flash) {
            setTimeout(() => {
                flash.style.transition = 'opacity .4s, transform .4s';
                flash.style.opacity = '0';
                flash.style.transform = 'translateY(-8px)';
                setTimeout(() => flash.remove(), 400);
            }, 5000);
        }
    });
</script>
</body>
</html>