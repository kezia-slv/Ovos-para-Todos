<?php
// Variável: $perfil (array com dados do perfil + join com usuário)
$p = $perfil;
?>

<div class="page-header">
    <div>
        <h1 class="page-title">Desativar Perfil</h1>
        <p class="page-subtitle">Confirme a desativação do perfil abaixo.</p>
    </div>
    <a href="/perfil/listar" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Voltar
    </a>
</div>

<div class="confirm-card">

    <!-- Perfil Summary -->
    <div class="card" style="margin-bottom:20px;">
        <div class="card-header">
            <h2><i class="fas fa-id-card" style="color:var(--amber); margin-right:8px;"></i>Dados do Perfil</h2>
        </div>
        <div class="card-body">
            <!-- Avatar + Nome -->
            <div style="display:flex; align-items:center; gap:16px; margin-bottom:20px; padding-bottom:20px; border-bottom:1px solid var(--slate-100);">
                <?php if (!empty($p['foto_usuario'])): ?>
                    <img src="<?= asset_path($p['foto_usuario']) ?>"
                         alt="foto"
                         style="width:56px; height:56px; border-radius:50%; object-fit:cover; flex-shrink:0; border:2px solid var(--amber);">
                <?php else: ?>
                    <div style="
                        width:56px; height:56px; border-radius:50%;
                        background:var(--amber);
                        display:flex; align-items:center; justify-content:center;
                        font-size:22px; font-weight:700; color:var(--slate-900); flex-shrink:0;">
                        <?= strtoupper(substr($p['nome_usuario'] ?? '?', 0, 1)) ?>
                    </div>
                <?php endif; ?>
                <div>
                    <div style="font-size:16px; font-weight:700; color:var(--slate-900);">
                        <?= e($p['nome_usuario'] ?? 'Usuário desconhecido') ?>
                    </div>
                    <div style="font-size:13px; color:var(--slate-500); margin-top:2px;">
                        <?= e($p['email_usuario'] ?? '—') ?>
                    </div>
                </div>
            </div>

            <div class="detail-row">
                <span class="detail-label"><i class="fas fa-hashtag" style="width:16px;"></i> ID Perfil</span>
                <span class="detail-value td-mono">#<?= e($p['id_perfil_usuario']) ?></span>
            </div>
            <div class="detail-row">
                <span class="detail-label"><i class="fas fa-phone" style="width:16px;"></i> Telefone</span>
                <span class="detail-value td-mono"><?= e($p['telefone_usuario'] ?? '—') ?></span>
            </div>
            <div class="detail-row">
                <span class="detail-label"><i class="fas fa-cake-candles" style="width:16px;"></i> Nascimento</span>
                <span class="detail-value">
                    <?= !empty($p['data_nascimento_usuario'])
                        ? date('d/m/Y', strtotime($p['data_nascimento_usuario']))
                        : '—' ?>
                </span>
            </div>
            <div class="detail-row">
                <span class="detail-label"><i class="fas fa-venus-mars" style="width:16px;"></i> Gênero</span>
                <span class="detail-value"><?= e($p['genero_usuario'] ?? '—') ?></span>
            </div>
            <div class="detail-row">
                <span class="detail-label"><i class="fas fa-image" style="width:16px;"></i> Foto</span>
                <span class="detail-value">
                    <?php if (!empty($p['foto_usuario'])): ?>
                        <span class="badge badge-green"><i class="fas fa-check"></i> Cadastrada</span>
                    <?php else: ?>
                        <span style="color:var(--slate-400);">Sem foto</span>
                    <?php endif; ?>
                </span>
            </div>
        </div>
    </div>

    <!-- Warning -->
    <div class="danger-zone">
        <h3>
            <i class="fas fa-triangle-exclamation"></i>
            Atenção: Esta ação desativará o perfil
        </h3>
        <p>
            O perfil de <strong><?= e($p['nome_usuario'] ?? 'este usuário') ?></strong> será desativado.
            Os dados serão preservados e o perfil poderá ser
            <strong>reativado</strong> a qualquer momento pela lista de perfis.
        </p>
    </div>

    <!-- Actions -->
    <div style="display:flex; gap:12px;">
        <form action="/perfil/deletar" method="POST" style="flex:1;">
            <input type="hidden" name="id_perfil_usuario" value="<?= (int) $p['id_perfil_usuario'] ?>">
            <button type="submit" class="btn btn-danger" style="width:100%;">
                <i class="fas fa-ban"></i> Confirmar Desativação
            </button>
        </form>
        <a href="/perfil/listar" class="btn btn-secondary" style="flex:1; justify-content:center;">
            <i class="fas fa-xmark"></i> Cancelar
        </a>
    </div>

</div>