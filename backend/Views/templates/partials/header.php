<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ovos Ebenezer - Painel</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="/css/admin-styles.css">

    <style>
    /* â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
       DESIGN TOKENS
    â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• */
    :root {
        /* Marca */
        --brand:          #F97316;
        --brand-dark:     #C2540A;
        --brand-deep:     #7C2D12;
        --brand-light:    #FFF7ED;
        --brand-muted:    #FED7AA;

        /* Sidebar */
        --sidebar-bg:     #1C0F06;
        --sidebar-bg2:    #2C1A0E;
        --sidebar-w:      245px;

        /* SuperfÃ­cies */
        --bg:             #F5F0EB;
        --card:           #FFFFFF;
        --card-border:    #EDE5DC;

        /* Texto */
        --text-primary:   #1A1208;
        --text-secondary: #7C6A5A;
        --text-muted:     #B5A090;

        /* UtilitÃ¡rios */
        --green:          #16A34A;
        --green-bg:       #DCFCE7;
        --red:            #DC2626;
        --red-bg:         #FEE2E2;
        --blue:           #2563EB;
        --blue-bg:        #DBEAFE;
        --purple:         #7C3AED;
        --purple-bg:      #EDE9FE;
        --amber:          #D97706;
        --amber-bg:       #FEF3C7;
        --amber-dark:     #B45309;

        /* Layout */
        --topbar-h:       64px;
        --radius-sm:      8px;
        --radius:         14px;
        --radius-lg:      20px;
        --shadow-xs:      0 1px 3px rgba(0,0,0,.06), 0 1px 2px rgba(0,0,0,.04);
        --shadow-sm:      0 4px 16px rgba(0,0,0,.06);
        --shadow-md:      0 8px 32px rgba(0,0,0,.08);
        --shadow-brand:   0 6px 20px rgba(249,115,22,.25);
    }

    /* â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
       RESET
    â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• */
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    body {
        font-family: 'Sora', sans-serif;
        background: var(--bg);
        color: var(--text-primary);
        display: flex;
        min-height: 100vh;
        overflow-x: hidden;
    }
    a { text-decoration: none; color: inherit; }
    img { display: block; max-width: 100%; }

    /* â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
       SIDEBAR
    â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• */
    .sidebar {
        width: var(--sidebar-w);
        min-height: 100vh;
        background: linear-gradient(175deg, var(--sidebar-bg) 0%, var(--sidebar-bg2) 55%, #3D1F0A 100%);
        display: flex;
        flex-direction: column;
        position: fixed;
        top: 0; left: 0;
        z-index: 300;
        transition: transform .3s cubic-bezier(.4,0,.2,1);
    }
    /* Orbe decorativo no sidebar */
    .sidebar::before {
        content: '';
        position: absolute;
        top: -60px; right: -60px;
        width: 220px; height: 220px;
        background: radial-gradient(circle, rgba(249,115,22,.10) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
    }
    .sidebar::after {
        content: '';
        position: absolute;
        bottom: 40px; left: -40px;
        width: 160px; height: 160px;
        background: radial-gradient(circle, rgba(249,115,22,.07) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
    }

    /* â”€â”€ Perfil (topo da sidebar) â”€â”€ */
    .sidebar-profile {
        padding: 24px 20px 18px;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 8px;
        position: relative;
        flex-shrink: 0;
    }
    .sidebar-profile::after {
        content: '';
        position: absolute;
        bottom: 0; left: 16px; right: 16px;
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(249,115,22,.35), transparent);
    }
    .profile-avatar-wrap {
        position: relative;
        margin-bottom: 2px;
    }
    .profile-avatar {
        width: 62px; height: 62px;
        background: linear-gradient(135deg, var(--brand) 0%, var(--brand-dark) 100%);
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.5rem;
        font-weight: 800;
        color: #fff;
        border: 2px solid rgba(249,115,22,.3);
        box-shadow: 0 0 0 5px rgba(249,115,22,.07), var(--shadow-brand);
        letter-spacing: -.5px;
        position: relative;
        z-index: 1;
    }
    .profile-dot {
        width: 12px; height: 12px;
        background: #4ADE80;
        border-radius: 50%;
        border: 2px solid var(--sidebar-bg);
        position: absolute;
        bottom: 1px; right: 1px;
        z-index: 2;
        box-shadow: 0 0 8px rgba(74,222,128,.5);
        animation: dotPulse 2.5s ease-in-out infinite;
    }
    @keyframes dotPulse {
        0%, 100% { box-shadow: 0 0 8px rgba(74,222,128,.5); }
        50%       { box-shadow: 0 0 14px rgba(74,222,128,.8), 0 0 4px rgba(74,222,128,.4); }
    }
    .profile-name {
        font-size: .88rem;
        font-weight: 700;
        color: #fff;
        text-align: center;
        line-height: 1.2;
    }
    .profile-role {
        font-size: .65rem;
        color: rgba(255,255,255,.38);
        text-transform: uppercase;
        letter-spacing: .12em;
        font-weight: 600;
    }
    .sidebar-logo-mini {
        display: flex;
        align-items: center;
        gap: 6px;
        margin-top: 4px;
        padding: 5px 10px;
        background: rgba(249,115,22,.08);
        border: 1px solid rgba(249,115,22,.12);
        border-radius: 20px;
    }
    .sidebar-logo-mini .logo-badge {
        width: 18px; height: 18px;
        display: flex; align-items: center; justify-content: center;
        font-size: .75rem;
    }
    .sidebar-logo-mini span {
        font-size: .68rem;
        font-weight: 700;
        color: rgba(255,255,255,.45);
        letter-spacing: .04em;
    }

    /* â”€â”€ NavegaÃ§Ã£o â”€â”€ */
    .sidebar-nav {
        flex: 1;
        padding: 12px 10px;
        overflow-y: auto;
        scrollbar-width: none;
        position: relative; /* necessÃ¡rio para o indicador deslizante */
    }
    .sidebar-nav::-webkit-scrollbar { display: none; }

    /* â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
       SLIDING INDICATOR (animaÃ§Ã£o principal)
       Painel laranja que desliza entre itens
    â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• */
    .nav-indicator {
        position: absolute;
        left: 10px;
        right: 10px;
        border-radius: var(--radius-sm);
        background: linear-gradient(90deg, rgba(249,115,22,.22) 0%, rgba(249,115,22,.07) 100%);
        border-left: 3px solid var(--brand);
        pointer-events: none;
        opacity: 0;
        z-index: 0;
        /* TransiÃ§Ã£o suave â€” cubic-bezier com leve "mola" */
        transition:
            top    0.32s cubic-bezier(0.34, 1.42, 0.64, 1),
            height 0.28s cubic-bezier(0.34, 1.2,  0.64, 1),
            opacity 0.18s ease;
        box-shadow: inset 0 0 16px rgba(249,115,22,.06);
    }

    .nav-section-label {
        font-size: .57rem;
        font-weight: 700;
        letter-spacing: .15em;
        text-transform: uppercase;
        color: rgba(255,255,255,.2);
        padding: 14px 10px 5px;
        position: relative;
        z-index: 1;
    }

    .nav-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 9px 11px;
        border-radius: var(--radius-sm);
        font-size: .82rem;
        font-weight: 500;
        color: rgba(255,255,255,.48);
        transition: color .2s ease;
        margin-bottom: 1px;
        position: relative;
        z-index: 1;        /* acima do indicador */
        overflow: hidden;  /* para o ripple */
        cursor: pointer;
    }
    .nav-item .nav-icon {
        width: 28px; height: 28px;
        border-radius: 7px;
        display: flex; align-items: center; justify-content: center;
        font-size: .78rem;
        flex-shrink: 0;
        background: rgba(255,255,255,.05);
        transition: background .22s ease, color .22s ease, box-shadow .22s ease, transform .18s ease;
    }
    /* Estado hover â€” apenas a cor muda, o slide acontece via JS */
    .nav-item:hover {
        color: rgba(255,255,255,.88);
    }
    .nav-item:hover .nav-icon {
        background: rgba(249,115,22,.18);
        color: var(--brand);
        transform: scale(1.08);
    }
    /* Estado ativo â€” sem border-left aqui (o indicador jÃ¡ faz isso) */
    .nav-item.active {
        color: #fff;
    }
    .nav-item.active .nav-icon {
        background: var(--brand);
        color: #fff;
        box-shadow: 0 3px 10px rgba(249,115,22,.45);
    }
    /* Perigo */
    .nav-item.nav-danger { color: rgba(248,113,113,.48); }
    .nav-item.nav-danger:hover {
        color: #FCA5A5;
        background: rgba(220,38,38,.10);
    }
    .nav-item.nav-danger .nav-icon { background: rgba(220,38,38,.08); }

    /* â”€â”€ RodapÃ© sidebar â”€â”€ */
    .sidebar-footer {
        padding: 12px 14px;
        border-top: 1px solid rgba(255,255,255,.04);
        flex-shrink: 0;
    }
    .sidebar-version {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        font-size: .63rem;
        color: rgba(255,255,255,.18);
        font-family: 'JetBrains Mono', monospace;
    }
    .sidebar-version span {
        background: rgba(249,115,22,.12);
        color: rgba(249,115,22,.55);
        padding: 2px 8px;
        border-radius: 20px;
        border: 1px solid rgba(249,115,22,.12);
    }

    /* â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
       MAIN WRAPPER
    â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• */
    .main-wrapper {
        margin-left: var(--sidebar-w);
        flex: 1;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    /* â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
       TOPBAR
    â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• */
    .topbar {
        height: var(--topbar-h);
        background: var(--card);
        border-bottom: 1px solid var(--card-border);
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 28px;
        position: sticky;
        top: 0; z-index: 200;
        box-shadow: var(--shadow-xs);
    }
    .topbar-left {
        display: flex;
        align-items: center;
        gap: 14px;
    }
    /* BotÃ£o hamburguer (mobile) */
    .topbar-menu-btn {
        display: none;
        width: 36px; height: 36px;
        border-radius: var(--radius-sm);
        background: var(--bg);
        border: 1px solid var(--card-border);
        align-items: center; justify-content: center;
        cursor: pointer;
        font-size: .9rem;
        color: var(--text-secondary);
        transition: all .2s;
        flex-shrink: 0;
    }
    .topbar-menu-btn:hover {
        background: var(--brand-light);
        color: var(--brand);
        border-color: var(--brand-muted);
    }
    /* Divisor vertical */
    .topbar-divider {
        width: 1px; height: 24px;
        background: var(--card-border);
    }
    .topbar-page-name {
        font-size: 1rem;
        font-weight: 700;
        color: var(--text-primary);
        line-height: 1.2;
    }
    .topbar-breadcrumb {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: .73rem;
        color: var(--text-muted);
    }
    .topbar-breadcrumb a {
        color: var(--brand);
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 4px;
        transition: opacity .2s;
    }
    .topbar-breadcrumb a:hover { opacity: .75; }
    .topbar-breadcrumb .sep { color: var(--card-border); }

    .topbar-right {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .topbar-date-pill {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: .73rem;
        color: var(--text-secondary);
        background: var(--brand-light);
        border: 1px solid var(--brand-muted);
        padding: 5px 13px;
        border-radius: 20px;
        font-weight: 600;
        white-space: nowrap;
    }
    .topbar-date-pill i { color: var(--brand); font-size: .68rem; }
    .topbar-btn {
        width: 36px; height: 36px;
        border-radius: var(--radius-sm);
        background: var(--bg);
        border: 1px solid var(--card-border);
        display: flex; align-items: center; justify-content: center;
        font-size: .83rem;
        color: var(--text-secondary);
        cursor: pointer;
        transition: all .2s;
        text-decoration: none;
    }
    .topbar-btn:hover {
        background: var(--brand-light);
        border-color: var(--brand-muted);
        color: var(--brand);
    }
    .topbar-avatar-sm {
        width: 36px; height: 36px;
        background: linear-gradient(135deg, var(--brand) 0%, var(--brand-dark) 100%);
        border-radius: var(--radius-sm);
        display: flex; align-items: center; justify-content: center;
        font-size: .8rem;
        font-weight: 800;
        color: #fff;
        box-shadow: var(--shadow-brand);
        cursor: pointer;
        letter-spacing: -.3px;
        border: 2px solid rgba(249,115,22,.3);
    }

    /* â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
       PAGE CONTENT
    â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• */
    .page-content {
        padding: 28px;
        flex: 1;
    }

    /* â”€â”€ Page header â”€â”€ */
    .page-header {
        margin-bottom: 24px;
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
    }
    .page-title {
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--text-primary);
        letter-spacing: -.4px;
        line-height: 1.2;
    }
    .page-subtitle {
        font-size: .83rem;
        color: var(--text-secondary);
        margin-top: 4px;
        font-weight: 400;
    }

    /* â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
       CARDS GENÃ‰RICOS
    â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• */
    .card {
        background: var(--card);
        border-radius: var(--radius);
        border: 1px solid var(--card-border);
        box-shadow: var(--shadow-xs);
        overflow: hidden;
    }
    .card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 18px 22px;
        border-bottom: 1px solid var(--card-border);
        gap: 12px;
    }
    .card-header h2 {
        font-size: .92rem;
        font-weight: 700;
        color: var(--text-primary);
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .card-body { padding: 20px 22px; }

    /* â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
       STAT CARDS
    â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• */
    .stats-grid {
        display: grid;
        gap: 16px;
        margin-bottom: 24px;
    }
    .stat-card {
        background: var(--card);
        border-radius: var(--radius);
        border: 1px solid var(--card-border);
        padding: 20px;
        box-shadow: var(--shadow-xs);
        position: relative;
        overflow: hidden;
        transition: transform .22s ease, box-shadow .22s ease;
    }
    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-sm);
    }
    .stat-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 3px;
        border-radius: var(--radius) var(--radius) 0 0;
    }
    .stat-card:nth-child(1)::before { background: linear-gradient(90deg, var(--brand), var(--brand-dark)); }
    .stat-card:nth-child(2)::before { background: linear-gradient(90deg, #7C3AED, #5B21B6); }
    .stat-card:nth-child(3)::before { background: linear-gradient(90deg, var(--green), #15803D); }
    .stat-card:nth-child(4)::before { background: linear-gradient(90deg, var(--blue), #1D4ED8); }
    .stat-card:nth-child(5)::before { background: linear-gradient(90deg, var(--amber), var(--amber-dark)); }

    .stat-card-icon {
        width: 44px; height: 44px;
        border-radius: var(--radius-sm);
        display: flex; align-items: center; justify-content: center;
        font-size: 1.1rem;
        margin-bottom: 14px;
    }
    .stat-card-label {
        font-size: .68rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .1em;
        color: var(--text-muted);
        margin-bottom: 6px;
    }
    .stat-card-value {
        font-size: 1.9rem;
        font-weight: 800;
        color: var(--text-primary);
        line-height: 1;
        letter-spacing: -.5px;
        font-family: 'JetBrains Mono', monospace;
    }

    /* â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
       TABELA
    â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• */
    .table-wrapper { overflow-x: auto; }
    table {
        width: 100%;
        border-collapse: collapse;
        font-size: .83rem;
    }
    thead tr { background: var(--bg); }
    thead th {
        padding: 11px 16px;
        text-align: left;
        font-size: .68rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .1em;
        color: var(--text-muted);
        border-bottom: 1px solid var(--card-border);
        white-space: nowrap;
    }
    tbody tr {
        border-bottom: 1px solid rgba(237,229,220,.7);
        transition: background .15s;
    }
    tbody tr:last-child { border-bottom: none; }
    tbody tr:hover { background: var(--brand-light); }
    tbody td {
        padding: 12px 16px;
        vertical-align: middle;
        color: var(--text-primary);
    }
    .td-mono {
        font-family: 'JetBrains Mono', monospace;
        font-size: .78rem;
        color: var(--text-muted);
        font-weight: 500;
    }

    /* â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
       BADGES
    â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• */
    .badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 3px 10px;
        border-radius: 20px;
        font-size: .68rem;
        font-weight: 700;
    }
    .badge-green  { background: var(--green-bg);  color: var(--green);  }
    .badge-red    { background: var(--red-bg);    color: var(--red);    }
    .badge-amber  { background: var(--amber-bg);  color: var(--amber-dark); }
    .badge-blue   { background: var(--blue-bg);   color: var(--blue);   }
    .badge-purple { background: var(--purple-bg); color: var(--purple); }

    /* â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
       BOTÃ•ES
    â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• */
    .btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 18px;
        border-radius: var(--radius-sm);
        font-size: .8rem;
        font-weight: 600;
        cursor: pointer;
        border: 1px solid transparent;
        transition: all .2s;
        white-space: nowrap;
        font-family: 'Sora', sans-serif;
    }
    .btn-primary {
        background: linear-gradient(135deg, var(--brand) 0%, var(--brand-dark) 100%);
        color: #fff;
        box-shadow: var(--shadow-brand);
    }
    .btn-primary:hover {
        box-shadow: 0 8px 24px rgba(249,115,22,.35);
        transform: translateY(-1px);
    }
    .btn-secondary {
        background: var(--bg);
        color: var(--text-secondary);
        border-color: var(--card-border);
    }
    .btn-secondary:hover {
        background: var(--brand-light);
        color: var(--brand);
        border-color: var(--brand-muted);
    }
    .btn-sm { padding: 5px 12px; font-size: .74rem; }

    /* â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
       EMPTY STATE
    â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• */
    .empty-state {
        text-align: center;
        padding: 52px 20px;
        color: var(--text-muted);
    }
    .empty-state i {
        font-size: 2.4rem;
        color: var(--brand-muted);
        margin-bottom: 12px;
        display: block;
        opacity: .6;
    }
    .empty-state p { font-size: .85rem; font-weight: 500; }

    /* â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
       FLASH MESSAGES
    â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• */
    .flash {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px 20px;
        border-radius: var(--radius);
        font-size: .84rem;
        font-weight: 600;
        margin-bottom: 24px;
        border: 1.5px solid;
        animation: slideDown .3s ease both;
    }
    @keyframes slideDown {
        from { opacity:0; transform: translateY(-8px); }
        to   { opacity:1; transform: translateY(0); }
    }
    .flash-success { background: var(--green-bg); color: var(--green); border-color: #86EFAC; }
    .flash-error   { background: var(--red-bg);   color: var(--red);   border-color: #FCA5A5; }

    /* â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
       RESPONSIVE
    â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• */
    @media (max-width: 960px) {
        .sidebar { transform: translateX(calc(-1 * var(--sidebar-w))); }
        .sidebar.open { transform: translateX(0); }
        .main-wrapper { margin-left: 0; }
        .page-content { padding: 18px; }
        .topbar { padding: 0 18px; }
        .topbar-menu-btn { display: flex; }
        /* Overlay escuro ao abrir sidebar no mobile */
        .sidebar-backdrop {
            display: block;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,.5);
            z-index: 299;
            animation: fadeIn .2s ease;
        }
        @keyframes fadeIn { from { opacity:0; } to { opacity:1; } }
    }
    @media (max-width: 600px) {
        .topbar-date-pill { display: none; }
        .page-title { font-size: 1.2rem; }
    }

    /* â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
       PAGE TRANSITIONS
    â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• */

    /* Overlay: dois painÃ©is laranja como "cortina dupla" */
    #page-transition-overlay {
        position: fixed;
        inset: 0;
        z-index: 9999;
        pointer-events: none;
        display: flex;
    }
    #page-transition-overlay .panel {
        flex: 1;
        background: linear-gradient(160deg, var(--brand) 0%, var(--brand-dark) 60%, var(--brand-deep) 100%);
        transform: scaleY(0);
        transform-origin: bottom;
        will-change: transform;
    }
    #page-transition-overlay .panel:nth-child(2) {
        background: linear-gradient(160deg, var(--brand-deep) 0%, var(--brand-dark) 50%, var(--brand) 100%);
    }
    #page-transition-overlay.entering .panel {
        animation: curtainIn 0.45s cubic-bezier(0.76, 0, 0.24, 1) forwards;
    }
    #page-transition-overlay.entering .panel:nth-child(2) { animation-delay: 0.04s; }
    #page-transition-overlay.leaving .panel {
        transform: scaleY(1);
        transform-origin: top;
        animation: curtainOut 0.4s cubic-bezier(0.76, 0, 0.24, 1) forwards;
    }
    #page-transition-overlay.leaving .panel:nth-child(2) { animation-delay: 0.04s; }

    @keyframes curtainIn {
        from { transform: scaleY(0); transform-origin: bottom; }
        to   { transform: scaleY(1); transform-origin: bottom; }
    }
    @keyframes curtainOut {
        from { transform: scaleY(1); transform-origin: top; }
        to   { transform: scaleY(0); transform-origin: top; }
    }

    /* Logo no centro do overlay */
    #page-transition-overlay .overlay-logo {
        position: absolute; inset: 0;
        display: flex;
        flex-direction: column;
        align-items: center; justify-content: center;
        gap: 10px;
        opacity: 0;
        pointer-events: none;
        z-index: 1;
    }
    #page-transition-overlay.entering .overlay-logo {
        animation: logoFadeIn 0.25s ease 0.25s forwards;
    }
    #page-transition-overlay.leaving .overlay-logo {
        animation: logoFadeOut 0.2s ease forwards;
    }
    @keyframes logoFadeIn  { to   { opacity: 1; } }
    @keyframes logoFadeOut { from { opacity: 1; } to { opacity: 0; } }

    .overlay-logo .overlay-egg {
        font-size: 2.2rem;
        animation: overlayPulse 0.6s ease infinite alternate;
    }
    .overlay-logo .overlay-text {
        font-size: .78rem;
        font-weight: 700;
        color: rgba(255,255,255,.72);
        letter-spacing: .14em;
        text-transform: uppercase;
    }
    @keyframes overlayPulse {
        from { transform: scale(1);    opacity: .8; }
        to   { transform: scale(1.12); opacity: 1;  }
    }

    /* Barra de progresso NProgress */
    #nprogress-bar {
        position: fixed;
        top: 0; left: 0;
        height: 3px;
        background: linear-gradient(90deg, var(--brand) 0%, #FCD34D 50%, var(--brand) 100%);
        background-size: 200% 100%;
        z-index: 10000;
        border-radius: 0 3px 3px 0;
        width: 0%; opacity: 0;
        box-shadow: 0 0 10px rgba(249,115,22,.7);
        animation: progressShimmer 1.2s linear infinite;
        transition: opacity .2s;
    }
    @keyframes progressShimmer {
        0%   { background-position: 200% 0; }
        100% { background-position: -200% 0; }
    }

    /* Ripple no nav-item clicado */
    .nav-ripple {
        position: absolute;
        border-radius: 50%;
        background: rgba(249,115,22,.3);
        transform: scale(0);
        animation: ripple 0.55s ease-out forwards;
        pointer-events: none;
        z-index: 2;
    }
    @keyframes ripple { to { transform: scale(4); opacity: 0; } }

    /* Entrada do conteÃºdo da pÃ¡gina */
    .page-content {
        animation: pageContentIn 0.38s cubic-bezier(0.22, 1, 0.36, 1) both;
    }
    @keyframes pageContentIn {
        from { opacity: 0; transform: translateY(12px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    /* Entrada escalonada dos cards */
    .stat-card, .card, .table-card, .total-card {
        animation: cardStaggerIn 0.42s cubic-bezier(0.22, 1, 0.36, 1) both;
    }
    .stat-card:nth-child(1), .card:nth-child(1) { animation-delay: .04s; }
    .stat-card:nth-child(2), .card:nth-child(2) { animation-delay: .09s; }
    .stat-card:nth-child(3), .card:nth-child(3) { animation-delay: .14s; }
    .stat-card:nth-child(4), .card:nth-child(4) { animation-delay: .19s; }
    .stat-card:nth-child(5), .card:nth-child(5) { animation-delay: .24s; }
    @keyframes cardStaggerIn {
        from { opacity: 0; transform: translateY(18px) scale(.98); }
        to   { opacity: 1; transform: translateY(0)    scale(1);   }
    }

    /* Ãcone gira no item clicado */
    .nav-item.nav-loading .nav-icon {
        animation: navIconSpin 0.5s cubic-bezier(.4,0,.2,1);
    }
    @keyframes navIconSpin {
        0%   { transform: rotate(0deg)   scale(1);   }
        40%  { transform: rotate(180deg) scale(0.75); }
        100% { transform: rotate(360deg) scale(1);   }
    }
    </style>
</head>
<body>

<!-- â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
     PAGE TRANSITION OVERLAY
â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• -->
<div id="page-transition-overlay" aria-hidden="true">
    <div class="panel"></div>
    <div class="panel"></div>
    <div class="overlay-logo">
        <span class="overlay-egg">🥚</span>
        <span class="overlay-text">Ovos Ebenezer</span>
    </div>
</div>

<!-- Barra de progresso -->
<div id="nprogress-bar"></div>

<!-- â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
     SIDEBAR
â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• -->
<aside class="sidebar" id="sidebar">

    <!-- Perfil no topo -->
    <div class="sidebar-profile">
        <div class="profile-avatar-wrap">
            <div class="profile-avatar">
                <?= strtoupper(substr($_SESSION['usuario_nome'] ?? 'A', 0, 1)) ?>
            </div>
            <div class="profile-dot"></div>
        </div>
        <div class="profile-name"><?= htmlspecialchars($_SESSION['usuario_nome'] ?? 'Admin') ?></div>
        <div class="profile-role"><?= htmlspecialchars($_SESSION['usuario_tipo'] ?? 'Administrador') ?></div>
        <div class="sidebar-logo-mini">
            <div class="logo-badge">ðŸ¥š</div>
            <span>Ovos Ebenezer</span>
        </div>
    </div>

    <!-- NavegaÃ§Ã£o -->
    <nav class="sidebar-nav" id="sidebar-nav">

        <!-- Indicador deslizante (posicionado via JS) -->
        <div class="nav-indicator" id="nav-indicator"></div>

        <div class="nav-section-label">Principal</div>
        <a href="/backend/dashboard" class="nav-item <?= (strpos($_SERVER['REQUEST_URI'], '/dashboard') !== false) ? 'active' : '' ?>">
            <span class="nav-icon"><i class="fas fa-chart-line"></i></span>
            Dashboard
        </a>

        <div class="nav-section-label">Cadastros</div>
        <a href="/backend/usuario/listar" class="nav-item <?= (strpos($_SERVER['REQUEST_URI'], '/usuario') !== false) ? 'active' : '' ?>">
            <span class="nav-icon"><i class="fas fa-users"></i></span>
            Usuários
        </a>
        <a href="/backend/produto/listar" class="nav-item <?= (strpos($_SERVER['REQUEST_URI'], '/produto') !== false) ? 'active' : '' ?>">
            <span class="nav-icon"><i class="fas fa-box"></i></span>
            Produtos
        </a>
        <a href="/backend/pedidos/listar" class="nav-item <?= (strpos($_SERVER['REQUEST_URI'], '/pedido') !== false) ? 'active' : '' ?>">
            <span class="nav-icon"><i class="fas fa-receipt"></i></span>
            Pedidos
        </a>
        <a href="/backend/endereco/listar" class="nav-item <?= (strpos($_SERVER['REQUEST_URI'], '/endereco') !== false) ? 'active' : '' ?>">
            <span class="nav-icon"><i class="fas fa-map-marker-alt"></i></span>
            Endereços
        </a>
        <a href="/backend/estoque/listar" class="nav-item <?= (strpos($_SERVER['REQUEST_URI'], '/estoque') !== false) ? 'active' : '' ?>">
            <span class="nav-icon"><i class="fas fa-boxes"></i></span>
            Estoque
        </a>
        <a href="/backend/avaliacao/listar" class="nav-item <?= (strpos($_SERVER['REQUEST_URI'], '/avaliacao') !== false) ? 'active' : '' ?>">
            <span class="nav-icon"><i class="fas fa-star"></i></span>
            Avaliações
        </a>

        <a href="/backend/fornecedor/listar" class="nav-item <?= (strpos($_SERVER['REQUEST_URI'], '/fornecedor') !== false) ? 'active' : '' ?>">
            <span class="nav-icon"><i class="fas fa-truck"></i></span>
            Fornecedores
        </a>

        <a href="/backend/entregas/listar" class="nav-item <?= (strpos($_SERVER['REQUEST_URI'], '/entregas') !== false) ? 'active' : '' ?>">
            <span class="nav-icon"><i class="fas fa-truck"></i></span>
            Entregas
        </a>
        <a href="/backend/tipo-ovo/listar" class="nav-item <?= (strpos($_SERVER['REQUEST_URI'], '/tipo-ovo') !== false) ? 'active' : '' ?>">
            <span class="nav-icon"><i class="fas fa-egg"></i></span>
            Tipos de Ovo
        </a>
        <a href="/backend/vendas/listar" class="nav-item <?= (strpos($_SERVER['REQUEST_URI'], '/vendas') !== false) ? 'active' : '' ?>">
            <span class="nav-icon"><i class="fas fa-chart-line"></i></span>
            Vendas
        </a>

        <div class="nav-section-label">Sistema</div>
        <a href="/backend/configuracoes" class="nav-item <?= (strpos($_SERVER['REQUEST_URI'], '/configuracoes') !== false) ? 'active' : '' ?>">
            <span class="nav-icon"><i class="fas fa-gear"></i></span>
            Configurações
        </a>
        <a href="/backend/logout" class="nav-item nav-danger">
            <span class="nav-icon"><i class="fas fa-right-from-bracket"></i></span>
            Sair
        </a>

    </nav>

    <div class="sidebar-footer">
        <div class="sidebar-version">
            Ovos Ebenezer <span>v1.0.0</span>
        </div>
    </div>
</aside>

<!-- â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
     CONTEÃšDO PRINCIPAL
â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• -->
<div class="main-wrapper">

    <!-- Topbar -->
    <header class="topbar">
        <div class="topbar-left">
            <!-- Hamburguer (mobile) -->
            <button class="topbar-menu-btn" id="sidebar-toggle" aria-label="Abrir menu">
                <i class="fas fa-bars"></i>
            </button>
            <div class="topbar-divider"></div>
            <div>
                <div class="topbar-page-name">
                    <?php
                    $uri = $_SERVER['REQUEST_URI'];
                    if (str_contains($uri, '/dashboard'))         echo 'Dashboard';
                    elseif (str_contains($uri, '/usuario'))       echo 'Usuarios';
                    elseif (str_contains($uri, '/produto'))       echo 'Produtos';
                    elseif (str_contains($uri, '/pedido'))        echo 'Pedidos';
                    elseif (str_contains($uri, '/endereco'))      echo 'Endereços';
                    elseif (str_contains($uri, '/estoque'))       echo 'Estoque';
                    elseif (str_contains($uri, '/avaliacao'))     echo 'Avaliações';
                    elseif (str_contains($uri, '/configuracoes')) echo 'Configurações';
                    else echo 'Painel';
                    ?>
                </div>
                <div class="topbar-breadcrumb">
                    <a href="/backend/dashboard"><i class="fas fa-house"></i> Início</a>
                    <span class="sep">/</span>
                    <span><?php
                        if (str_contains($uri, '/backend/dashboard'))         echo 'Dashboard';
                        elseif (str_contains($uri, '/usuario'))       echo 'Usuarios';
                        elseif (str_contains($uri, '/produto'))       echo 'Produtos';
                        elseif (str_contains($uri, '/pedido'))        echo 'Pedidos';
                        elseif (str_contains($uri, '/endereco'))      echo 'Endereços';
                        elseif (str_contains($uri, '/estoque'))       echo 'Estoque';
                        elseif (str_contains($uri, '/avaliacao'))     echo 'Avaliações';
                        else echo 'Painel';
                    ?></span>
                </div>
            </div>
        </div>

        <div class="topbar-right">
            <div class="topbar-date-pill">
                <i class="fas fa-calendar-day"></i>
                <?= date('d/m/Y') ?>
            </div>
            <a href="/backend/configuracoes" class="topbar-btn" title="Configurações">
                <i class="fas fa-gear"></i>
            </a>
            <div class="topbar-avatar-sm" title="<?= htmlspecialchars($_SESSION['usuario_nome'] ?? 'Admin') ?>">
                <?= strtoupper(substr($_SESSION['usuario_nome'] ?? 'A', 0, 1)) ?>
            </div>
        </div>
    </header>

    <!-- ConteÃºdo da pÃ¡gina -->
    <main class="page-content">

<!-- â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
     PAGE TRANSITION + SLIDING NAV ENGINE
â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• -->
<script>
(function () {

    /* â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
       1. SLIDING NAV INDICATOR
    â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• */
    function initSlidingNav() {
        const nav       = document.getElementById('sidebar-nav');
        const indicator = document.getElementById('nav-indicator');
        if (!nav || !indicator) return;

        /* Posiciona o indicador em cima de um elemento */
        function moveTo(el, instant) {
            const navRect = nav.getBoundingClientRect();
            const elRect  = el.getBoundingClientRect();
            const top     = elRect.top - navRect.top + nav.scrollTop;

            if (instant) {
                /* Sem transiÃ§Ã£o na primeira carga */
                indicator.style.transition = 'none';
                indicator.style.top        = top + 'px';
                indicator.style.height     = elRect.height + 'px';
                indicator.style.opacity    = '1';
                /* Reativa transiÃ§Ã£o no prÃ³ximo frame */
                requestAnimationFrame(() => {
                    indicator.style.transition = '';
                });
            } else {
                indicator.style.top    = top + 'px';
                indicator.style.height = elRect.height + 'px';
                indicator.style.opacity = '1';
            }
        }

        const activeItem = nav.querySelector('.nav-item.active');
        if (activeItem) moveTo(activeItem, true);

        /* Hover: desliza para o item */
        nav.querySelectorAll('.nav-item:not(.nav-danger)').forEach(item => {
            item.addEventListener('mouseenter', () => moveTo(item, false));
        });

        /* Mouse sai da nav: volta para o ativo */
        nav.addEventListener('mouseleave', () => {
            if (activeItem) moveTo(activeItem, false);
            else indicator.style.opacity = '0';
        });

        /* Clique: trava no item clicado antes de navegar */
        nav.querySelectorAll('.nav-item:not(.nav-danger):not([href="#"])').forEach(item => {
            item.addEventListener('mousedown', () => moveTo(item, false));
        });
    }

    /* â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
       2. PAGE TRANSITION ENGINE
    â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• */
    const overlay  = document.getElementById('page-transition-overlay');
    const bar      = document.getElementById('nprogress-bar');
    let   barTimer = null;

    function barStart() {
        bar.style.opacity    = '1';
        bar.style.width      = '0%';
        bar.style.transition = 'width 0.3s ease';
        clearTimeout(barTimer);
        requestAnimationFrame(() => { bar.style.width = '70%'; });
    }
    function barFinish() {
        bar.style.transition = 'width 0.15s ease, opacity 0.3s ease 0.15s';
        bar.style.width      = '100%';
        barTimer = setTimeout(() => { bar.style.opacity = '0'; bar.style.width = '0%'; }, 500);
    }

    function spawnRipple(el, e) {
        const r    = document.createElement('span');
        const rect = el.getBoundingClientRect();
        const size = Math.max(rect.width, rect.height) * 2;
        r.className   = 'nav-ripple';
        r.style.cssText = `width:${size}px;height:${size}px;left:${e.clientX-rect.left-size/2}px;top:${e.clientY-rect.top-size/2}px`;
        el.appendChild(r);
        r.addEventListener('animationend', () => r.remove());
    }

    function playExit(cb) {
        overlay.className = '';
        void overlay.offsetWidth;
        overlay.classList.add('entering');
        setTimeout(cb, 540);
    }

    function playEnter() {
        overlay.classList.remove('entering');
        void overlay.offsetWidth;
        overlay.classList.add('leaving');
        overlay.addEventListener('animationend', () => { overlay.className = ''; }, { once: true });
    }

    /* â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
       3. DOM READY
    â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• */
    document.addEventListener('DOMContentLoaded', function () {

        /* Inicializa o indicador deslizante */
        initSlidingNav();

        /* AnimaÃ§Ã£o de entrada */
        playEnter();
        barFinish();

        /* Intercept cliques nos nav-items */
        document.querySelectorAll('.nav-item:not(.nav-danger):not([href="#"])').forEach(link => {
            link.addEventListener('click', function (e) {
                const href = this.getAttribute('href');
                if (!href || href === '#' || href === window.location.pathname) return;
                e.preventDefault();
                spawnRipple(this, e);
                this.classList.add('nav-loading');
                setTimeout(() => this.classList.remove('nav-loading'), 500);
                barStart();
                playExit(() => { window.location.href = href; });
            });
        });

        /* Breadcrumb e topbar */
        document.querySelectorAll('.topbar-breadcrumb a, .topbar-btn[href]').forEach(link => {
            link.addEventListener('click', function (e) {
                const href = this.getAttribute('href');
                if (!href || href === '#' || href === window.location.pathname) return;
                e.preventDefault();
                barStart();
                playExit(() => { window.location.href = href; });
            });
        });

        /* Links com .btn */
        document.querySelectorAll('a.btn').forEach(link => {
            link.addEventListener('click', function (e) {
                const href = this.getAttribute('href');
                if (!href || href === '#' || href.startsWith('?') || href === window.location.pathname) return;
                e.preventDefault();
                barStart();
                playExit(() => { window.location.href = href; });
            });
        });

        /* FormulÃ¡rios */
        document.querySelectorAll('form[action]').forEach(form => {
            form.addEventListener('submit', () => barStart());
        });

        /* â”€â”€ Mobile sidebar toggle â”€â”€ */
        const sidebarEl = document.getElementById('sidebar');
        const toggleBtn = document.getElementById('sidebar-toggle');
        if (toggleBtn && sidebarEl) {
            toggleBtn.addEventListener('click', () => {
                const isOpen = sidebarEl.classList.toggle('open');
                if (isOpen) {
                    const backdrop = document.createElement('div');
                    backdrop.className = 'sidebar-backdrop';
                    backdrop.id = 'sidebar-backdrop';
                    document.body.appendChild(backdrop);
                    backdrop.addEventListener('click', () => {
                        sidebarEl.classList.remove('open');
                        backdrop.remove();
                    });
                } else {
                    document.getElementById('sidebar-backdrop')?.remove();
                }
            });
        }
    });

})();
</script>

<?php
use Ovos\Ebenezer\Core\Flash;
$flash = Flash::get();
if ($flash): ?>
    <div class="flash flash-<?= htmlspecialchars($flash['type']) ?>">
        <i class="fas fa-<?= $flash['type'] === 'success' ? 'circle-check' : 'circle-exclamation' ?>"></i>
        <span><?= $flash['message'] ?></span>
    </div>
<?php endif; ?>
