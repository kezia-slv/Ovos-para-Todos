<?php
// Variável: $produto (array)
$p = $produto;
$temFoto = !empty($p['foto_produto']) && strpos($p['foto_produto'], 'placeholder') === false;
?>

<div class="page-header">
    <div>
        <h1 class="page-title">Desativar Produto</h1>
        <p class="page-subtitle">Confirme a desativação do produto abaixo.</p>
    </div>
    <a href="/produto/listar" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Voltar
    </a>
</div>

<div class="confirm-card">

    <!-- Produto Summary -->
    <div class="card" style="margin-bottom:20px;">
        <div class="card-header">
            <h2><i class="fas fa-box" style="color:var(--amber); margin-right:8px;"></i>Dados do Produto</h2>
        </div>
        <div class="card-body">

            <!-- Foto + Nome -->
            <div style="display:flex; align-items:center; gap:16px;
                        margin-bottom:20px; padding-bottom:20px;
                        border-bottom:1px solid var(--slate-100);">
                <div style="
                    width:64px; height:64px; border-radius:12px; overflow:hidden;
                    background:var(--slate-100); flex-shrink:0;
                    display:flex; align-items:center; justify-content:center;
                    border:2px solid <?= $temFoto ? 'var(--amber)' : 'var(--slate-200, #E2E8F0)' ?>;">
                    <?php if ($temFoto): ?>
                        <img src="<?= e($p['foto_produto']) ?>" alt="foto"
                             style="width:100%; height:100%; object-fit:cover;">
                    <?php else: ?>
                        <i class="fas fa-egg" style="font-size:22px; color:var(--slate-300);"></i>
                    <?php endif; ?>
                </div>
                <div style="flex:1;">
                    <div style="font-size:17px; font-weight:700; color:var(--slate-900);">
                        <?= e($p['nome_produto']) ?>
                    </div>
                    <?php if (!empty($p['tipo_produto'])): ?>
                    <div style="font-size:13px; color:var(--slate-500); margin-top:2px;">
                        <?= e($p['tipo_produto']) ?>
                    </div>
                    <?php endif; ?>
                </div>
                <?php if (!empty($p['categoria_produto'])): ?>
                    <span class="badge badge-amber"><?= e($p['categoria_produto']) ?></span>
                <?php endif; ?>
            </div>

            <div class="detail-row">
                <span class="detail-label"><i class="fas fa-hashtag" style="width:16px;"></i> ID</span>
                <span class="detail-value td-mono">#<?= e($p['id_produto']) ?></span>
            </div>
            <div class="detail-row">
                <span class="detail-label"><i class="fas fa-brazilian-real-sign" style="width:16px;"></i> Preço</span>
                <span class="detail-value" style="font-weight:600; font-family:'JetBrains Mono',monospace;">
                    R$ <?= number_format((float)($p['preco_produto'] ?? 0), 2, ',', '.') ?>
                </span>
            </div>
            <div class="detail-row">
                <span class="detail-label"><i class="fas fa-cubes" style="width:16px;"></i> Estoque</span>
                <span class="detail-value">
                    <?php $estoque = (int)($p['estoque_produto'] ?? 0); ?>
                    <span class="badge <?= $estoque > 0 ? 'badge-green' : 'badge-red' ?>">
                        <?= $estoque > 0 ? $estoque . ' unidade(s)' : 'Esgotado' ?>
                    </span>
                </span>
            </div>
            <div class="detail-row">
                <span class="detail-label"><i class="fas fa-ruler" style="width:16px;"></i> Unidade</span>
                <span class="detail-value"><?= e($p['unidade_produto'] ?? '—') ?></span>
            </div>
            <div class="detail-row">
                <span class="detail-label"><i class="fas fa-circle-dot" style="width:16px;"></i> Status</span>
                <span class="detail-value">
                    <span class="badge badge-green">
                        <i class="fas fa-circle" style="font-size:6px;"></i> Ativo
                    </span>
                </span>
            </div>
            <?php if (!empty($p['criado_em'])): ?>
            <div class="detail-row">
                <span class="detail-label"><i class="fas fa-calendar" style="width:16px;"></i> Cadastrado</span>
                <span class="detail-value"><?= date('d/m/Y \à\s H:i', strtotime($p['criado_em'])) ?></span>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Warning -->
    <div class="danger-zone">
        <h3>
            <i class="fas fa-triangle-exclamation"></i>
            Atenção: Esta ação desativará o produto
        </h3>
        <p>
            O produto <strong><?= e($p['nome_produto']) ?></strong> será desativado e
            não aparecerá mais nas listagens. Seus dados serão preservados e o produto
            poderá ser <strong>reativado</strong> a qualquer momento.
        </p>
    </div>

    <!-- Actions -->
    <div style="display:flex; gap:12px;">
        <form action="/produto/deletar" method="POST" style="flex:1;">
            <input type="hidden" name="id_produto" value="<?= (int) $p['id_produto'] ?>">
            <button type="submit" class="btn btn-danger" style="width:100%;">
                <i class="fas fa-ban"></i> Confirmar Desativação
            </button>
        </form>
        <a href="/produto/listar" class="btn btn-secondary" style="flex:1; justify-content:center;">
            <i class="fas fa-xmark"></i> Cancelar
        </a>
    </div>

</div>