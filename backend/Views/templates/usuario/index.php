<?php
// Variables injected: $usuarios, $total_usuarios, $total_ativos, $total_inativos, $paginacao
?>

<div class="page-header">
    <div>
        <h1 class="page-title">Usuários</h1>
        <p class="page-subtitle">Gerencie todos os usuários cadastrados no sistema.</p>
    </div>
    <a href="/usuario/criar" class="btn btn-primary">
        <i class="fas fa-plus"></i> Novo Usuário
    </a>
</div>

<!-- Stats -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-card-icon" style="background:#FEF3C7;">
            <i class="fas fa-users" style="color:var(--amber-dark);"></i>
        </div>
        <div class="stat-card-label">Total</div>
        <div class="stat-card-value"><?= $total_usuarios ?? 0 ?></div>
    </div>
    <div class="stat-card">
        <div class="stat-card-icon" style="background:#DCFCE7;">
            <i class="fas fa-user-check" style="color:#15803D;"></i>
        </div>
        <div class="stat-card-label">Ativos</div>
        <div class="stat-card-value" style="color:#15803D;"><?= $total_ativos ?? 0 ?></div>
    </div>
    <div class="stat-card">
        <div class="stat-card-icon" style="background:#FEE2E2;">
            <i class="fas fa-user-slash" style="color:#B91C1C;"></i>
        </div>
        <div class="stat-card-label">Inativos</div>
        <div class="stat-card-value" style="color:#B91C1C;"><?= $total_inativos ?? 0 ?></div>
    </div>
</div>

<!-- Table Card -->
<div class="card">
    <div class="card-header">
        <h2><i class="fas fa-list" style="color:var(--amber); margin-right:8px;"></i>Lista de Usuários</h2>
        <span style="font-size:12px; color:var(--slate-500);">
            <?= isset($paginacao) ? "Mostrando {$paginacao['de']}–{$paginacao['para']} de {$paginacao['total']}" : '' ?>
        </span>
    </div>

    <div class="table-wrapper">
        <?php if (!empty($usuarios)): ?>
        <table>
            <thead>
                <tr>
                    <th style="width:50px;">#</th>
                    <th>Usuário</th>
                    <th>E-mail</th>
                    <th>Perfil</th>
                    <th>Status</th>
                    <th>Cadastrado em</th>
                    <th style="width:140px; text-align:right;">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $u): ?>
                <tr>
                    <td class="td-mono"><?= htmlspecialchars($u['id_usuario']) ?></td>
                    <td>
                        <div style="display:flex; align-items:center; gap:10px;">
                            <div style="
                                width:32px; height:32px;
                                border-radius:50%;
                                background: var(--amber);
                                display:flex; align-items:center; justify-content:center;
                                font-size:13px; font-weight:700;
                                color: var(--slate-900);
                                flex-shrink:0;
                            ">
                                <?= strtoupper(substr($u['nome_usuario'], 0, 1)) ?>
                            </div>
                            <span style="font-weight:500; color:var(--slate-900);">
                                <?= htmlspecialchars($u['nome_usuario']) ?>
                            </span>
                        </div>
                    </td>
                    <td class="td-mono"><?= htmlspecialchars($u['email_usuario']) ?></td>
                    <td>
                        <?php
                        $tipoBadge = [
                            'Admin'       => 'badge-purple',
                            'Funcionario' => 'badge-blue',
                            'Motorista'   => 'badge-amber',
                            'Cliente'     => 'badge-green',
                        ];
                        $tipoClass = $tipoBadge[$u['tipo_usuario']] ?? 'badge-green';
                        ?>
                        <span class="badge <?= $tipoClass ?>">
                            <?= htmlspecialchars($u['tipo_usuario']) ?>
                        </span>
                    </td>
                    <td>
                        <?php if (empty($u['excluido_em'])): ?>
                            <span class="badge badge-green">
                                <i class="fas fa-circle" style="font-size:6px;"></i> Ativo
                            </span>
                        <?php else: ?>
                            <span class="badge badge-red">
                                <i class="fas fa-circle" style="font-size:6px;"></i> Inativo
                            </span>
                        <?php endif; ?>
                    </td>
                    <td class="td-mono" style="font-size:12px;">
                        <?= isset($u['criado_em']) ? date('d/m/Y', strtotime($u['criado_em'])) : '—' ?>
                    </td>
                    <td>
                        <div style="display:flex; align-items:center; gap:6px; justify-content:flex-end;">
                            <a href="/usuario/editar/<?= $u['id_usuario'] ?>"
                               class="btn btn-secondary btn-sm"
                               title="Editar">
                                <i class="fas fa-pencil"></i>
                            </a>

                            <?php if (empty($u['excluido_em'])): ?>
                                <a href="/usuario/deletar/<?= $u['id_usuario'] ?>"
                                   class="btn btn-sm"
                                   style="background:#FEE2E2; color:#B91C1C;"
                                   title="Desativar">
                                    <i class="fas fa-ban"></i>
                                </a>
                            <?php else: ?>
                                <form action="/usuario/ativar" method="POST" style="display:inline;">
                                    <input type="hidden" name="id_usuario" value="<?= $u['id_usuario'] ?>">
                                    <button type="submit"
                                            class="btn btn-sm"
                                            style="background:#DCFCE7; color:#15803D;"
                                            title="Reativar">
                                        <i class="fas fa-rotate-right"></i>
                                    </button>
                                </form>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Pagination -->
        <?php if (isset($paginacao) && $paginacao['ultima_pagina'] > 1): ?>
        <div class="pagination">
            <span class="pagination-info">
                <?= $paginacao['de'] ?>–<?= $paginacao['para'] ?> de <?= $paginacao['total'] ?> usuários
            </span>
            <div class="pagination-links">
                <?php $atual = $paginacao['pagina_atual']; $ultima = $paginacao['ultima_pagina']; ?>

                <a href="/usuario/listar/<?= max(1, $atual - 1) ?>"
                   class="page-link <?= $atual <= 1 ? 'disabled' : '' ?>">
                    <i class="fas fa-chevron-left" style="font-size:11px;"></i>
                </a>

                <?php for ($p = max(1, $atual - 2); $p <= min($ultima, $atual + 2); $p++): ?>
                    <a href="/usuario/listar/<?= $p ?>"
                       class="page-link <?= $p === $atual ? 'active' : '' ?>">
                        <?= $p ?>
                    </a>
                <?php endfor; ?>

                <a href="/usuario/listar/<?= min($ultima, $atual + 1) ?>"
                   class="page-link <?= $atual >= $ultima ? 'disabled' : '' ?>">
                    <i class="fas fa-chevron-right" style="font-size:11px;"></i>
                </a>
            </div>
        </div>
        <?php endif; ?>

        <?php else: ?>
        <div class="empty-state">
            <i class="fas fa-users-slash"></i>
            <p>Nenhum usuário encontrado.</p>
        </div>
        <?php endif; ?>
    </div>
</div>