<?php
// Variáveis: $produtos, $total_produtos, $total_ativos, $total_inativos, $sem_estoque, $paginacao, $termo_pesquisa
?>

<div class="page-header">
    <div>
        <h1 class="page-title">Produtos</h1>
        <p class="page-subtitle">Gerencie o catálogo de produtos cadastrados.</p>
    </div>
    <a href="/produto/criar" class="btn btn-primary">
        <i class="fas fa-plus"></i> Novo Produto
    </a>
</div>

<!-- Stats -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-card-icon" style="background:#FEF3C7;">
            <i class="fas fa-box" style="color:var(--amber-dark);"></i>
        </div>
        <div class="stat-card-label">Total</div>
        <div class="stat-card-value"><?= $total_produtos ?? 0 ?></div>
    </div>
    <div class="stat-card">
        <div class="stat-card-icon" style="background:#DCFCE7;">
            <i class="fas fa-box-open" style="color:#15803D;"></i>
        </div>
        <div class="stat-card-label">Ativos</div>
        <div class="stat-card-value" style="color:#15803D;"><?= $total_ativos ?? 0 ?></div>
    </div>
    <div class="stat-card">
        <div class="stat-card-icon" style="background:#FEE2E2;">
            <i class="fas fa-box-archive" style="color:#B91C1C;"></i>
        </div>
        <div class="stat-card-label">Inativos</div>
        <div class="stat-card-value" style="color:#B91C1C;"><?= $total_inativos ?? 0 ?></div>
    </div>
    <div class="stat-card">
        <div class="stat-card-icon" style="background:#FFF7ED;">
            <i class="fas fa-triangle-exclamation" style="color:#EA580C;"></i>
        </div>
        <div class="stat-card-label">Sem Estoque</div>
        <div class="stat-card-value" style="color:#EA580C;"><?= $sem_estoque ?? 0 ?></div>
    </div>
</div>

<!-- Search + Table -->
<div class="card">
    <div class="card-header">
        <h2><i class="fas fa-boxes-stacked" style="color:var(--amber); margin-right:8px;"></i>Lista de Produtos</h2>
        <span style="font-size:12px; color:var(--slate-500);">
            <?php if (isset($paginacao)): ?>
                <?= $paginacao['de'] ?>–<?= $paginacao['para'] ?> de <?= $paginacao['total'] ?>
            <?php endif; ?>
        </span>
    </div>

    <!-- Barra de pesquisa -->
    <div style="padding:16px 24px; border-bottom:1px solid var(--slate-100);">
        <form action="/produto/listar" method="GET" style="display:flex; gap:10px; max-width:400px;">
            <div style="position:relative; flex:1;">
                <i class="fas fa-magnifying-glass" style="
                    position:absolute; left:12px; top:50%; transform:translateY(-50%);
                    color:var(--slate-400); font-size:13px;"></i>
                <input
                    type="text"
                    name="search"
                    class="form-control"
                    style="padding-left:36px;"
                    placeholder="Buscar produto..."
                    value="<?= e($termo_pesquisa ?? '') ?>"
                >
            </div>
            <button type="submit" class="btn btn-secondary">Buscar</button>
            <?php if (!empty($termo_pesquisa)): ?>
                <a href="/produto/listar" class="btn btn-secondary" title="Limpar busca">
                    <i class="fas fa-xmark"></i>
                </a>
            <?php endif; ?>
        </form>
    </div>

    <div class="table-wrapper">
        <?php if (!empty($produtos)): ?>
        <table>
            <thead>
                <tr>
                    <th style="width:50px;">#</th>
                    <th>Produto</th>
                    <th>Categoria</th>
                    <th>Unidade</th>
                    <th>Preço</th>
                    <th>Estoque</th>
                    <th>Status</th>
                    <th style="width:140px; text-align:right;">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($produtos as $p): ?>
                <tr>
                    <td class="td-mono"><?= e($p['id_produto']) ?></td>
                    <td>
                        <div style="display:flex; align-items:center; gap:12px;">
                            <!-- Foto ou placeholder -->
                            <?php
                            $foto = $p['foto_produto'] ?? null;
                            $placeholder = strpos($foto ?? '', 'placeholder') !== false || empty($foto);
                            ?>
                            <div style="
                                width:40px; height:40px; border-radius:8px; overflow:hidden;
                                background:var(--slate-100); flex-shrink:0;
                                display:flex; align-items:center; justify-content:center;
                                border:1px solid var(--slate-200, #E2E8F0);">
                                <?php if (!$placeholder): ?>
                                    <img src="<?= e($foto) ?>" alt="foto"
                                         style="width:100%; height:100%; object-fit:cover;">
                                <?php else: ?>
                                    <i class="fas fa-egg" style="color:var(--amber); font-size:16px;"></i>
                                <?php endif; ?>
                            </div>
                            <div>
                                <div style="font-weight:600; color:var(--slate-900);">
                                    <?= e($p['nome_produto']) ?>
                                </div>
                                <?php if (!empty($p['tipo_produto'])): ?>
                                <div style="font-size:11.5px; color:var(--slate-400);">
                                    <?= e($p['tipo_produto']) ?>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </td>
                    <td>
                        <?php if (!empty($p['categoria_produto'])): ?>
                            <span class="badge badge-amber">
                                <?= e($p['categoria_produto']) ?>
                            </span>
                        <?php else: ?>
                            <span style="color:var(--slate-300);">—</span>
                        <?php endif; ?>
                    </td>
                    <td style="color:var(--slate-500); font-size:13px;">
                        <?= e($p['unidade_produto'] ?? '—') ?>
                    </td>
                    <td>
                        <span style="font-weight:600; font-family:'JetBrains Mono',monospace; font-size:13px;">
                            R$ <?= number_format((float)($p['preco_produto'] ?? 0), 2, ',', '.') ?>
                        </span>
                    </td>
                    <td>
                        <?php $estoque = (int)($p['estoque_produto'] ?? 0); ?>
                        <span class="badge <?= $estoque > 0 ? 'badge-green' : 'badge-red' ?>">
                            <?= $estoque > 0 ? $estoque . ' un.' : 'Esgotado' ?>
                        </span>
                    </td>
                    <td>
                        <?php if (empty($p['excluido_em'])): ?>
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
                            <a href="/produto/editar/<?= $p['id_produto'] ?>"
                               class="btn btn-secondary btn-sm" title="Editar">
                                <i class="fas fa-pencil"></i>
                            </a>

                            <?php if (empty($p['excluido_em'])): ?>
                                <a href="/produto/deletar/<?= $p['id_produto'] ?>"
                                   class="btn btn-sm"
                                   style="background:#FEE2E2; color:#B91C1C;" title="Desativar">
                                    <i class="fas fa-ban"></i>
                                </a>
                            <?php else: ?>
                                <form action="/produto/ativar" method="POST" style="display:inline;">
                                    <input type="hidden" name="id_produto" value="<?= $p['id_produto'] ?>">
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

        <!-- Paginação -->
        <?php if (isset($paginacao) && $paginacao['ultima_pagina'] > 1): ?>
        <div class="pagination">
            <span class="pagination-info">
                <?= $paginacao['de'] ?>–<?= $paginacao['para'] ?> de <?= $paginacao['total'] ?> produtos
            </span>
            <div class="pagination-links">
                <?php $atual = $paginacao['pagina_atual']; $ultima = $paginacao['ultima_pagina']; ?>
                <a href="/produto/listar/<?= max(1, $atual - 1) ?>"
                   class="page-link <?= $atual <= 1 ? 'disabled' : '' ?>">
                    <i class="fas fa-chevron-left" style="font-size:11px;"></i>
                </a>
                <?php for ($pg = max(1, $atual - 2); $pg <= min($ultima, $atual + 2); $pg++): ?>
                    <a href="/produto/listar/<?= $pg ?>"
                       class="page-link <?= $pg === $atual ? 'active' : '' ?>"><?= $pg ?></a>
                <?php endfor; ?>
                <a href="/produto/listar/<?= min($ultima, $atual + 1) ?>"
                   class="page-link <?= $atual >= $ultima ? 'disabled' : '' ?>">
                    <i class="fas fa-chevron-right" style="font-size:11px;"></i>
                </a>
            </div>
        </div>
        <?php endif; ?>

        <?php else: ?>
        <div class="empty-state">
            <i class="fas fa-box-open"></i>
            <p><?= !empty($termo_pesquisa) ? "Nenhum produto encontrado para \"" . e($termo_pesquisa) . "\"." : "Nenhum produto cadastrado ainda." ?></p>
        </div>
        <?php endif; ?>
    </div>
</div>