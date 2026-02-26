<?php
// Variáveis: $enderecos, $total_endereco, $total_ativos, $total_inativos
?>

<div class="page-header">
    <div>
        <h1 class="page-title">Endereços</h1>
        <p class="page-subtitle">Gerencie os endereços cadastrados no sistema.</p>
    </div>
    <a href="/endereco/criar" class="btn btn-primary">
        <i class="fas fa-plus"></i> Novo Endereço
    </a>
</div>

<!-- Stats -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-card-icon" style="background:#FEF3C7;">
            <i class="fas fa-map-location-dot" style="color:var(--amber-dark);"></i>
        </div>
        <div class="stat-card-label">Total</div>
        <div class="stat-card-value"><?= $total_endereco ?? 0 ?></div>
    </div>
    <div class="stat-card">
        <div class="stat-card-icon" style="background:#DCFCE7;">
            <i class="fas fa-location-dot" style="color:#15803D;"></i>
        </div>
        <div class="stat-card-label">Ativos</div>
        <div class="stat-card-value" style="color:#15803D;"><?= $total_ativos ?? 0 ?></div>
    </div>
    <div class="stat-card">
        <div class="stat-card-icon" style="background:#FEE2E2;">
            <i class="fas fa-location-xmark" style="color:#B91C1C;"></i>
        </div>
        <div class="stat-card-label">Inativos</div>
        <div class="stat-card-value" style="color:#B91C1C;"><?= $total_inativos ?? 0 ?></div>
    </div>
</div>

<!-- Table Card -->
<div class="card">
    <div class="card-header">
        <h2><i class="fas fa-map" style="color:var(--amber); margin-right:8px;"></i>Lista de Endereços</h2>
        <span style="font-size:12px; color:var(--slate-500);">
            <?= count($enderecos ?? []) ?> registro(s)
        </span>
    </div>

    <div class="table-wrapper">
        <?php if (!empty($enderecos)): ?>
        <table>
            <thead>
                <tr>
                    <th style="width:50px;">#</th>
                    <th>Usuário</th>
                    <th>Logradouro</th>
                    <th>Bairro</th>
                    <th>Cidade / UF</th>
                    <th>CEP</th>
                    <th>Status</th>
                    <th style="width:130px; text-align:right;">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($enderecos as $e): ?>
                <tr>
                    <td class="td-mono"><?= e($e['id_endereco']) ?></td>
                    <td>
                        <div style="display:flex; align-items:center; gap:10px;">
                            <div style="
                                width:30px; height:30px; border-radius:50%;
                                background:var(--amber);
                                display:flex; align-items:center; justify-content:center;
                                font-size:12px; font-weight:700; color:var(--slate-900); flex-shrink:0;">
                                <?= strtoupper(substr($e['nome_usuario'] ?? '?', 0, 1)) ?>
                            </div>
                            <div>
                                <div style="font-weight:500; color:var(--slate-900); font-size:13.5px;">
                                    <?= e($e['nome_usuario'] ?? '—') ?>
                                </div>
                                <div class="td-mono" style="font-size:11px; color:var(--slate-400);">
                                    <?= e($e['email_usuario'] ?? '') ?>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span style="font-weight:500;">
                            <?= e($e['logradouro_endereco']) ?>, <?= e($e['numero_endereco']) ?>
                        </span>
                        <?php if (!empty($e['complemento'])): ?>
                            <div style="font-size:11.5px; color:var(--slate-400);">
                                <?= e($e['complemento']) ?>
                            </div>
                        <?php endif; ?>
                    </td>
                    <td><?= e($e['bairro_endereco'] ?? '—') ?></td>
                    <td>
                        <span><?= e($e['cidade_endereco'] ?? '—') ?></span>
                        <span class="badge badge-blue" style="margin-left:6px; font-size:10px;">
                            <?= e($e['uf_endereco'] ?? '') ?>
                        </span>
                    </td>
                    <td class="td-mono"><?= e($e['cep_endereco'] ?? '—') ?></td>
                    <td>
                        <?php if (empty($e['excluido_em'])): ?>
                            <span class="badge badge-green">
                                <i class="fas fa-circle" style="font-size:6px;"></i> Ativo
                            </span>
                        <?php else: ?>
                            <span class="badge badge-red">
                                <i class="fas fa-circle" style="font-size:6px;"></i> Inativo
                            </span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <div style="display:flex; align-items:center; gap:6px; justify-content:flex-end;">
                            <a href="/endereco/editar/<?= $e['id_endereco'] ?>"
                               class="btn btn-secondary btn-sm" title="Editar">
                                <i class="fas fa-pencil"></i>
                            </a>
                            <?php if (empty($e['excluido_em'])): ?>
                                <a href="/endereco/deletar/<?= $e['id_endereco'] ?>"
                                   class="btn btn-sm"
                                   style="background:#FEE2E2; color:#B91C1C;" title="Desativar">
                                    <i class="fas fa-ban"></i>
                                </a>
                            <?php else: ?>
                                <form action="/endereco/ativar" method="POST" style="display:inline;">
                                    <input type="hidden" name="id_endereco" value="<?= $e['id_endereco'] ?>">
                                    <button type="submit" class="btn btn-sm"
                                            style="background:#DCFCE7; color:#15803D;" title="Reativar">
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
        <?php else: ?>
        <div class="empty-state">
            <i class="fas fa-map-location-dot"></i>
            <p>Nenhum endereço cadastrado ainda.</p>
        </div>
        <?php endif; ?>
    </div>
</div>