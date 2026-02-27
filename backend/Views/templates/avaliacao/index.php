<?php
// views/avaliacao/index.php
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avaliações</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        :root {
            --laranja:        #F97316;
            --laranja-escuro: #EA6C0A;
            --laranja-claro:  #FEF3E2;
            --creme:          #FFFBF0;
            --texto-escuro:   #1A1A1A;
            --texto-medio:    #555;
            --borda:          #F0E0C8;
        }

        * { box-sizing: border-box; }

        body {
            background-color: var(--creme);
            font-family: 'Segoe UI', sans-serif;
            color: var(--texto-escuro);
        }

        /* ── Top banner ── */
        .top-banner {
            background-color: var(--laranja);
            color: #fff;
            font-size: .78rem;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
            padding: 8px 0;
            text-align: center;
        }

        /* ── Navbar ── */
        .navbar-site {
            background: #fff;
            border-bottom: 2px solid var(--borda);
            padding: 10px 0;
        }
        .navbar-site .brand-text {
            font-size: 1.25rem;
            font-weight: 800;
            color: var(--laranja);
            letter-spacing: -.5px;
        }
        .navbar-site .nav-link-item {
            color: var(--texto-escuro) !important;
            font-weight: 600;
            font-size: .9rem;
            letter-spacing: .03em;
            padding: 6px 14px;
            border-radius: 20px;
            transition: background .2s, color .2s;
            text-decoration: none;
        }
        .navbar-site .nav-link-item:hover,
        .navbar-site .nav-link-item.active {
            background: var(--laranja-claro);
            color: var(--laranja) !important;
        }
        .navbar-site .nav-icon {
            width: 36px; height: 36px;
            border-radius: 50%;
            border: 1.5px solid #ddd;
            display: inline-flex; align-items: center; justify-content: center;
            color: var(--texto-medio);
            transition: border-color .2s, color .2s;
            text-decoration: none;
        }
        .navbar-site .nav-icon:hover {
            border-color: var(--laranja);
            color: var(--laranja);
        }

        /* ── Page header ── */
        .page-header {
            background: linear-gradient(135deg, var(--laranja) 0%, var(--laranja-escuro) 100%);
            color: #fff;
            padding: 32px 0 28px;
            margin-bottom: 32px;
        }
        .page-header h2 { font-weight: 800; font-size: 1.6rem; margin: 0; }
        .page-header p  { opacity: .85; margin: 4px 0 0; font-size: .9rem; }

        /* ── Botão primário ── */
        .btn-laranja {
            background: #fff;
            color: var(--laranja);
            font-weight: 700;
            border: 2px solid #fff;
            border-radius: 25px;
            padding: 8px 22px;
            transition: background .2s, color .2s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .btn-laranja:hover {
            background: var(--laranja-claro);
            color: var(--laranja-escuro);
            border-color: var(--laranja-claro);
        }

        /* ── Cards de totais ── */
        .total-card {
            background: #fff;
            border: 1.5px solid var(--borda);
            border-radius: 16px;
            padding: 24px 16px;
            text-align: center;
            box-shadow: 0 2px 12px rgba(249,115,22,.08);
            transition: transform .2s, box-shadow .2s;
        }
        .total-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(249,115,22,.15);
        }
        .total-card .label {
            font-size: .78rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .08em;
            color: var(--texto-medio);
            margin-bottom: 6px;
        }
        .total-card .number {
            font-size: 2.4rem;
            font-weight: 900;
            line-height: 1;
        }
        .total-card .icon {
            font-size: 1.7rem;
            margin-bottom: 8px;
        }
        .total-card.total   .number,
        .total-card.total   .icon  { color: var(--laranja); }
        .total-card.ativos  .number,
        .total-card.ativos  .icon  { color: #16a34a; }
        .total-card.inativos .number,
        .total-card.inativos .icon { color: #dc2626; }

        /* ── Tabela ── */
        .table-card {
            background: #fff;
            border-radius: 16px;
            border: 1.5px solid var(--borda);
            overflow: hidden;
            box-shadow: 0 2px 12px rgba(249,115,22,.07);
        }
        .table-card .table { margin-bottom: 0; }
        .table-card thead tr {
            background: linear-gradient(90deg, var(--laranja) 0%, var(--laranja-escuro) 100%);
        }
        .table-card thead th {
            color: #fff;
            font-weight: 700;
            font-size: .78rem;
            letter-spacing: .07em;
            text-transform: uppercase;
            border: none;
            padding: 14px 16px;
        }
        .table-card tbody tr {
            border-bottom: 1px solid #fde8cc;
            transition: background .15s;
        }
        .table-card tbody tr:hover { background: var(--laranja-claro); }
        .table-card tbody td {
            padding: 12px 16px;
            vertical-align: middle;
            font-size: .88rem;
            border: none;
        }
        .table-card tbody tr:last-child { border-bottom: none; }

        /* ── Badges ── */
        .badge-ativo   { background: #dcfce7; color: #15803d; font-weight: 700; padding: 4px 10px; border-radius: 20px; font-size: .75rem; white-space: nowrap; }
        .badge-inativo { background: #fee2e2; color: #b91c1c; font-weight: 700; padding: 4px 10px; border-radius: 20px; font-size: .75rem; white-space: nowrap; }
        .badge-status  { font-weight: 700; padding: 4px 10px; border-radius: 20px; font-size: .75rem; white-space: nowrap; }
        .badge-status.ativo   { background: #fff7ed; color: var(--laranja); border: 1px solid #fed7aa; }
        .badge-status.inativo { background: #f1f5f9; color: #64748b; border: 1px solid #e2e8f0; }

        /* ── Botões de ação ── */
        .btn-acao {
            width: 32px; height: 32px;
            border-radius: 8px;
            display: inline-flex; align-items: center; justify-content: center;
            font-size: .85rem;
            border: 1.5px solid transparent;
            transition: all .2s;
            text-decoration: none;
            cursor: pointer;
            background: transparent;
        }
        .btn-acao.editar  { border-color: var(--laranja); color: var(--laranja); background: #fff7ed; }
        .btn-acao.editar:hover  { background: var(--laranja); color: #fff; }
        .btn-acao.excluir { border-color: #ef4444; color: #ef4444; background: #fef2f2; }
        .btn-acao.excluir:hover { background: #ef4444; color: #fff; }
        .btn-acao.ativar  { border-color: #22c55e; color: #22c55e; background: #f0fdf4; }
        .btn-acao.ativar:hover  { background: #22c55e; color: #fff; }

        /* ── Estrelas ── */
        .estrelas     { color: #d1d5db; font-size: .9rem; }
        .estrelas .filled { color: var(--laranja); }

        /* ── Estado vazio ── */
        .empty-state { padding: 52px 16px; text-align: center; color: var(--texto-medio); }
        .empty-state i { font-size: 2.8rem; color: #fcd9b0; margin-bottom: 12px; display: block; }

        /* ── Alertas ── */
        .alert-success { background: #f0fdf4; border-color: #bbf7d0; color: #15803d; border-radius: 10px; }
        .alert-danger  { background: #fef2f2; border-color: #fecaca; color: #b91c1c; border-radius: 10px; }

        /* ── Mobile ── */
        @media (max-width: 768px) {
            .page-header h2 { font-size: 1.3rem; }
            .navbar-site .d-none { display: none !important; }
            .table-card thead { display: none; }
            .table-card tbody td { display: block; padding: 6px 14px; }
            .table-card tbody td::before {
                content: attr(data-label) ": ";
                font-weight: 700;
                color: var(--laranja);
                font-size: .72rem;
                text-transform: uppercase;
            }
        }
    </style>
</head>
<body>


    <div class="page-header">
        <div class="container d-flex align-items-center justify-content-between flex-wrap gap-3">
            <div>
                <h2><i class="bi bi-star-half me-2"></i>Avaliações</h2>
                <p>Gerencie todas as avaliações dos clientes</p>
            </div>
            <a href="/avaliacao/criar" class="btn-laranja">
                <i class="bi bi-plus-lg"></i> Nova Avaliação
            </a>
        </div>
    </div>

    <div class="container pb-5">

        <!-- Mensagem de feedback -->
        <?php if (isset($_SESSION['mensagem'])): ?>
            <div class="alert alert-<?= $_SESSION['tipo_mensagem'] ?> alert-dismissible fade show mb-4" role="alert">
                <i class="bi bi-<?= $_SESSION['tipo_mensagem'] === 'success' ? 'check-circle' : 'exclamation-circle' ?> me-2"></i>
                <?= $_SESSION['mensagem'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php unset($_SESSION['mensagem'], $_SESSION['tipo_mensagem']); ?>
        <?php endif; ?>

        <!-- Cards de totais -->
        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <div class="total-card total">
                    <div class="icon"><i class="bi bi-bar-chart-fill"></i></div>
                    <div class="label">Total de Avaliações</div>
                    <div class="number"><?= $total_avaliacao ?? 0 ?></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="total-card ativos">
                    <div class="icon"><i class="bi bi-check-circle-fill"></i></div>
                    <div class="label">Ativos</div>
                    <div class="number"><?= $total_ativos ?? 0 ?></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="total-card inativos">
                    <div class="icon"><i class="bi bi-x-circle-fill"></i></div>
                    <div class="label">Inativos</div>
                    <div class="number"><?= $total_inativos ?? 0 ?></div>
                </div>
            </div>
        </div>

        <!-- Tabela -->
        <div class="table-card">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Usuário</th>
                            <th>Pedido</th>
                            <th>Nota</th>
                            <th>Comentário</th>
                            <th>Data</th>
                            <th>Status</th>
                            <th>Situação</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($avaliacao)): ?>
                            <?php foreach ($avaliacao as $item): ?>
                            <tr>
                                <td data-label="ID">
                                    <span style="font-weight:700; color:var(--laranja)">#<?= $item['id_avaliacao'] ?></span>
                                </td>
                                <td data-label="Usuário">
                                    <i class="bi bi-person-circle me-1 text-muted"></i><?= $item['id_usuario'] ?>
                                </td>
                                <td data-label="Pedido">
                                    <i class="bi bi-bag me-1 text-muted"></i><?= $item['id_pedidos'] ?>
                                </td>
                                <td data-label="Nota">
                                    <span class="estrelas">
                                        <?php for ($i = 1; $i <= 5; $i++): ?>
                                            <i class="bi bi-star<?= $i <= $item['nota_avaliacao'] ? '-fill filled' : '' ?>"></i>
                                        <?php endfor; ?>
                                    </span>
                                    <small class="text-muted ms-1">(<?= $item['nota_avaliacao'] ?>)</small>
                                </td>
                                <td data-label="Comentário">
                                    <?= htmlspecialchars(mb_strimwidth($item['comentario_avaliacao'], 0, 50, '...')) ?>
                                </td>
                                <td data-label="Data">
                                    <i class="bi bi-calendar3 me-1 text-muted"></i>
                                    <?= date('d/m/Y', strtotime($item['data_avaliacao'])) ?>
                                </td>
                                <td data-label="Status">
                                    <span class="badge-status <?= $item['status_avaliacao'] === 'ativo' ? 'ativo' : 'inativo' ?>">
                                        <?= ucfirst($item['status_avaliacao']) ?>
                                    </span>
                                </td>
                                <td data-label="Situação">
                                    <?php if (is_null($item['excluido_em'])): ?>
                                        <span class="badge-ativo"><i class="bi bi-check2 me-1"></i>Ativo</span>
                                    <?php else: ?>
                                        <span class="badge-inativo"><i class="bi bi-x me-1"></i>Inativo</span>
                                    <?php endif; ?>
                                </td>
                                <td data-label="Ações" class="text-center">
                                    <div class="d-flex gap-1 justify-content-center">
                                        <a href="/avaliacao/editar/<?= $item['id_avaliacao'] ?>" class="btn-acao editar" title="Editar">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <?php if (is_null($item['excluido_em'])): ?>
                                            <a href="/avaliacao/excluir/<?= $item['id_avaliacao'] ?>" class="btn-acao excluir" title="Excluir">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        <?php else: ?>
                                            <form action="/avaliacao/ativar" method="POST" class="d-inline">
                                                <input type="hidden" name="id_avaliacao" value="<?= $item['id_avaliacao'] ?>">
                                                <button type="submit" class="btn-acao ativar" title="Ativar">
                                                    <i class="bi bi-arrow-counterclockwise"></i>
                                                </button>
                                            </form>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="9">
                                    <div class="empty-state">
                                        <i class="bi bi-star"></i>
                                        <strong>Nenhuma avaliação encontrada.</strong><br>
                                        <small>Clique em "Nova Avaliação" para começar.</small>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>