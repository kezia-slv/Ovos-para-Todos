<?php
// Variável: $endereco (array com dados do endereço + join com usuário)
$en = $endereco;
?>

<div class="page-header">
    <div>
        <h1 class="page-title">Desativar Endereço</h1>
        <p class="page-subtitle">Confirme a desativação do endereço abaixo.</p>
    </div>
    <a href="/endereco/listar" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Voltar
    </a>
</div>

<div class="confirm-card">

    <!-- Endereço Summary -->
    <div class="card" style="margin-bottom:20px;">
        <div class="card-header">
            <h2><i class="fas fa-map-location-dot" style="color:var(--amber); margin-right:8px;"></i>Dados do Endereço</h2>
        </div>
        <div class="card-body">

            <!-- Usuário -->
            <div style="display:flex; align-items:center; gap:14px;
                        margin-bottom:20px; padding-bottom:20px;
                        border-bottom:1px solid var(--slate-100);">
                <div style="
                    width:44px; height:44px; border-radius:50%;
                    background:var(--amber);
                    display:flex; align-items:center; justify-content:center;
                    font-size:18px; font-weight:700; color:var(--slate-900); flex-shrink:0;">
                    <?= strtoupper(substr($en['nome_usuario'] ?? '?', 0, 1)) ?>
                </div>
                <div>
                    <div style="font-size:15px; font-weight:700; color:var(--slate-900);">
                        <?= e($en['nome_usuario'] ?? 'Usuário desconhecido') ?>
                    </div>
                    <div style="font-size:12.5px; color:var(--slate-500);">
                        <?= e($en['email_usuario'] ?? '—') ?>
                    </div>
                </div>
            </div>

            <!-- Mapa visual do endereço -->
            <div style="
                background:var(--slate-100);
                border-radius:10px;
                padding:16px 18px;
                margin-bottom:16px;
                display:flex; align-items:flex-start; gap:12px;">
                <i class="fas fa-location-dot" style="color:var(--amber); font-size:20px; margin-top:2px; flex-shrink:0;"></i>
                <div>
                    <div style="font-size:15px; font-weight:600; color:var(--slate-900); line-height:1.5;">
                        <?= e($en['logradouro_endereco']) ?>, <?= e($en['numero_endereco']) ?>
                        <?php if (!empty($en['complemento'])): ?>
                            — <?= e($en['complemento']) ?>
                        <?php endif; ?>
                    </div>
                    <div style="font-size:13px; color:var(--slate-600, #475569); margin-top:2px;">
                        <?= e($en['bairro_endereco']) ?> · <?= e($en['cidade_endereco']) ?>/<?= e($en['uf_endereco']) ?>
                    </div>
                    <div class="td-mono" style="font-size:12px; color:var(--slate-400); margin-top:3px;">
                        CEP <?= e($en['cep_endereco']) ?>
                    </div>
                </div>
            </div>

            <div class="detail-row">
                <span class="detail-label"><i class="fas fa-hashtag" style="width:16px;"></i> ID</span>
                <span class="detail-value td-mono">#<?= e($en['id_endereco']) ?></span>
            </div>
            <div class="detail-row">
                <span class="detail-label"><i class="fas fa-circle-dot" style="width:16px;"></i> Status</span>
                <span class="detail-value">
                    <span class="badge badge-green">
                        <i class="fas fa-circle" style="font-size:6px;"></i> Ativo
                    </span>
                </span>
            </div>
            <?php if (!empty($en['criado_em'])): ?>
            <div class="detail-row">
                <span class="detail-label"><i class="fas fa-calendar" style="width:16px;"></i> Cadastrado</span>
                <span class="detail-value">
                    <?= date('d/m/Y \à\s H:i', strtotime($en['criado_em'])) ?>
                </span>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Warning -->
    <div class="danger-zone">
        <h3>
            <i class="fas fa-triangle-exclamation"></i>
            Atenção: Esta ação desativará o endereço
        </h3>
        <p>
            O endereço de <strong><?= e($en['nome_usuario'] ?? 'este usuário') ?></strong> será
            desativado. Os dados serão preservados e o endereço poderá ser
            <strong>reativado</strong> a qualquer momento.
        </p>
    </div>

    <!-- Actions -->
    <div style="display:flex; gap:12px;">
        <form action="/endereco/deletar" method="POST" style="flex:1;">
            <input type="hidden" name="id_endereco" value="<?= (int) $en['id_endereco'] ?>">
            <button type="submit" class="btn btn-danger" style="width:100%;">
                <i class="fas fa-ban"></i> Confirmar Desativação
            </button>
        </form>
        <a href="/endereco/listar" class="btn btn-secondary" style="flex:1; justify-content:center;">
            <i class="fas fa-xmark"></i> Cancelar
        </a>
    </div>

</div>