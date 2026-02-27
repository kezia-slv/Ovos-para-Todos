<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ovos Ebenezer — Painel</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --amber:       #F59E0B;
            --amber-light: #FCD34D;
            --amber-dark:  #D97706;
            --slate-900:   #0F172A;
            --slate-800:   #1E293B;
            --slate-700:   #334155;
            --slate-500:   #64748B;
            --slate-300:   #CBD5E1;
            --slate-100:   #F1F5F9;
            --white:       #FFFFFF;
            --red:         #EF4444;
            --green:       #22C55E;
            --sidebar-w:   260px;
        }

        body {
            font-family: 'Sora', sans-serif;
            background: var(--slate-100);
            color: var(--slate-800);
            min-height: 100vh;
            display: flex;
        }

        /* ── SIDEBAR ── */
        .sidebar {
            width: var(--sidebar-w);
            background: var(--slate-900);
            min-height: 100vh;
            position: fixed;
            top: 0; left: 0;
            display: flex;
            flex-direction: column;
            z-index: 100;
            box-shadow: 4px 0 20px rgba(0,0,0,.3);
        }

        .sidebar-brand {
            padding: 28px 24px 20px;
            border-bottom: 1px solid var(--slate-700);
        }

        .sidebar-brand .logo-icon {
            width: 40px; height: 40px;
            background: var(--amber);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 20px;
            margin-bottom: 10px;
        }

        .sidebar-brand h1 {
            font-size: 15px;
            font-weight: 700;
            color: var(--white);
            letter-spacing: .5px;
        }

        .sidebar-brand p {
            font-size: 11px;
            color: var(--slate-500);
            margin-top: 2px;
            font-weight: 300;
        }

        .sidebar-nav {
            padding: 20px 12px;
            flex: 1;
        }

        .nav-section-label {
            font-size: 10px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: var(--slate-500);
            padding: 0 12px;
            margin-bottom: 8px;
            margin-top: 16px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 12px;
            border-radius: 8px;
            color: var(--slate-300);
            text-decoration: none;
            font-size: 13.5px;
            font-weight: 400;
            transition: all .15s;
            margin-bottom: 2px;
        }

        .nav-item i {
            width: 18px;
            text-align: center;
            font-size: 14px;
            color: var(--slate-500);
            transition: color .15s;
        }

        .nav-item:hover,
        .nav-item.active {
            background: rgba(245,158,11,.12);
            color: var(--amber-light);
        }

        .nav-item:hover i,
        .nav-item.active i {
            color: var(--amber);
        }

        .nav-item.active {
            font-weight: 600;
        }

        .sidebar-footer {
            padding: 16px 12px;
            border-top: 1px solid var(--slate-700);
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: 8px;
        }

        .user-avatar {
            width: 32px; height: 32px;
            background: var(--amber);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 13px;
            font-weight: 700;
            color: var(--slate-900);
            flex-shrink: 0;
        }

        .user-name {
            font-size: 12.5px;
            font-weight: 600;
            color: var(--white);
        }

        .user-role {
            font-size: 11px;
            color: var(--slate-500);
        }

        /* ── MAIN ── */
        .main-wrapper {
            margin-left: var(--sidebar-w);
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .topbar {
            background: var(--white);
            border-bottom: 1px solid var(--slate-300);
            padding: 0 32px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .topbar-breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            color: var(--slate-500);
        }

        .topbar-breadcrumb a {
            color: var(--slate-500);
            text-decoration: none;
        }

        .topbar-breadcrumb a:hover { color: var(--amber-dark); }
        .topbar-breadcrumb .sep { color: var(--slate-300); }
        .topbar-breadcrumb .current { color: var(--slate-800); font-weight: 600; }

        .topbar-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .page-content {
            padding: 32px;
            flex: 1;
        }

        /* ── FLASH MESSAGES ── */
        .flash {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 14px 18px;
            border-radius: 10px;
            margin-bottom: 24px;
            font-size: 13.5px;
            font-weight: 500;
            animation: slideIn .3s ease;
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateY(-8px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .flash-success {
            background: #F0FDF4;
            border: 1px solid #BBF7D0;
            color: #166534;
        }

        .flash-error {
            background: #FEF2F2;
            border: 1px solid #FECACA;
            color: #991B1B;
        }

        .flash i { margin-top: 1px; }

        /* ── SHARED COMPONENTS ── */
        .page-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 28px;
        }

        .page-title {
            font-size: 22px;
            font-weight: 700;
            color: var(--slate-900);
            letter-spacing: -.3px;
        }

        .page-subtitle {
            font-size: 13px;
            color: var(--slate-500);
            margin-top: 4px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 9px 18px;
            border-radius: 8px;
            font-size: 13.5px;
            font-weight: 600;
            font-family: 'Sora', sans-serif;
            cursor: pointer;
            border: none;
            text-decoration: none;
            transition: all .15s;
            white-space: nowrap;
        }

        .btn-primary {
            background: var(--amber);
            color: var(--slate-900);
        }

        .btn-primary:hover {
            background: var(--amber-dark);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(245,158,11,.35);
        }

        .btn-secondary {
            background: var(--slate-100);
            color: var(--slate-700);
            border: 1px solid var(--slate-300);
        }

        .btn-secondary:hover {
            background: var(--slate-200, #E2E8F0);
            border-color: var(--slate-400, #94A3B8);
        }

        .btn-danger {
            background: var(--red);
            color: var(--white);
        }

        .btn-danger:hover {
            background: #DC2626;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(239,68,68,.35);
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 12px;
        }

        .card {
            background: var(--white);
            border-radius: 14px;
            border: 1px solid var(--slate-300);
            overflow: hidden;
        }

        .card-header {
            padding: 18px 24px;
            border-bottom: 1px solid var(--slate-100);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .card-header h2 {
            font-size: 15px;
            font-weight: 600;
            color: var(--slate-800);
        }

        .card-body {
            padding: 24px;
        }

        /* ── BADGE ── */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 3px 10px;
            border-radius: 99px;
            font-size: 11.5px;
            font-weight: 600;
        }

        .badge-green  { background: #DCFCE7; color: #15803D; }
        .badge-red    { background: #FEE2E2; color: #B91C1C; }
        .badge-amber  { background: #FEF3C7; color: #92400E; }
        .badge-blue   { background: #DBEAFE; color: #1D4ED8; }
        .badge-purple { background: #EDE9FE; color: #6D28D9; }

        /* ── FORM ── */
        .form-group { margin-bottom: 20px; }

        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: var(--slate-700);
            margin-bottom: 6px;
        }

        .form-label .required { color: var(--red); margin-left: 3px; }

        .form-control {
            width: 100%;
            padding: 10px 14px;
            border: 1.5px solid var(--slate-300);
            border-radius: 8px;
            font-size: 14px;
            font-family: 'Sora', sans-serif;
            color: var(--slate-800);
            background: var(--white);
            transition: border-color .15s, box-shadow .15s;
            outline: none;
        }

        .form-control:focus {
            border-color: var(--amber);
            box-shadow: 0 0 0 3px rgba(245,158,11,.15);
        }

        .form-hint {
            font-size: 11.5px;
            color: var(--slate-500);
            margin-top: 5px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0 20px;
        }
    </style>
</head>
<body>

<aside class="sidebar">
    <div class="sidebar-brand">
        <div class="logo-icon">🥚</div>
        <h1>Ovos Ebenezer</h1>
        <p>Painel Administrativo</p>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-section-label">Principal</div>
        <a href="/dashboard" class="nav-item <?= (strpos($_SERVER['REQUEST_URI'], '/dashboard') !== false) ? 'active' : '' ?>">
            <i class="fas fa-chart-line"></i> Dashboard
        </a>

        <div class="nav-section-label">Cadastros</div>
        <a href="/usuario/listar" class="nav-item <?= (strpos($_SERVER['REQUEST_URI'], '/usuario') !== false) ? 'active' : '' ?>">
            <i class="fas fa-users"></i> Usuários
        </a>
        <a href="/produto/listar" class="nav-item <?= (strpos($_SERVER['REQUEST_URI'], '/produto') !== false) ? 'active' : '' ?>">
            <i class="fas fa-box"></i> Produtos
        </a>
        <a href="/pedido/listar" class="nav-item <?= (strpos($_SERVER['REQUEST_URI'], '/pedido') !== false) ? 'active' : '' ?>">
            <i class="fas fa-receipt"></i> Pedidos
        </a>
        <a href="/endereco/listar" class="nav-item <?= (strpos($_SERVER['REQUEST_URI'], '/endereco') !== false) ? 'active' : '' ?>">
            <i class="fas fa-map-marker-alt"></i> Endereços
        </a>
        <a href="/estoque/listar" class="nav-item <?= (strpos($_SERVER['REQUEST_URI'], '/estoque') !== false) ? 'active' : '' ?>">
            <i class="fas fa-boxes"></i> Estoque
        </a>

        <div class="nav-section-label">Sistema</div>
        <a href="/configuracoes" class="nav-item">
            <i class="fas fa-gear"></i> Configurações
        </a>
        <a href="/logout" class="nav-item">
            <i class="fas fa-right-from-bracket"></i> Sair
        </a>
    </nav>

    <div class="sidebar-footer">
        <div class="user-info">
            <div class="user-avatar">
                <?= strtoupper(substr($_SESSION['usuario_nome'] ?? 'A', 0, 1)) ?>
            </div>
            <div>
                <div class="user-name"><?= htmlspecialchars($_SESSION['usuario_nome'] ?? 'Admin') ?></div>
                <div class="user-role"><?= htmlspecialchars($_SESSION['usuario_tipo'] ?? 'Administrador') ?></div>
            </div>
        </div>
    </div>
</aside>

<div class="main-wrapper">
    <header class="topbar">
        <div class="topbar-breadcrumb">
            <a href="/dashboard"><i class="fas fa-house"></i></a>
        </div>
        <div class="topbar-actions">
            <span style="font-size:12px; color:var(--slate-500);">
                <?= date('d/m/Y') ?>
            </span>
        </div>
    </header>

    <main class="page-content">

<?php
use Ovos\Ebenezer\Core\Flash;
$flash = Flash::get();
if ($flash): ?>
    <div class="flash flash-<?= htmlspecialchars($flash['type']) ?>">
        <i class="fas fa-<?= $flash['type'] === 'success' ? 'circle-check' : 'circle-exclamation' ?>"></i>
        <span><?= $flash['message'] ?></span>
    </div>
<?php endif; ?>