<?php
// Variables injected: $usuario (array with user data)
$u = $usuario;
?>

<div class="page-header">
    <div>
        <h1 class="page-title">Desativar Usuário</h1>
        <p class="page-subtitle">Confirme a desativação do usuário abaixo.</p>
    </div>
    <a href="/usuario/listar" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Voltar
    </a>
</div>

<div class="confirm-card">

    <!-- User Summary Card -->
    <div class="card" style="margin-bottom: 20px;">
        <div class="card-header">
            <h2><i class="fas fa-user" style="color:var(--amber); margin-right:8px;"></i>Dados do Usuário</h2>
        </div>
        <div class="card-body">
            <div style="display:flex; align-items:center; gap:16px; margin-bottom:20px; padding-bottom:20px; border-bottom:1px solid var(--slate-100);">
                <div style="
                    width:52px; height:52px;
                    border-radius:50%;
                    background: var(--amber);
                    display:flex; align-items:center; justify-content:center;
                    font-size:20px; font-weight:700;
                    color: var(--slate-900);
                    flex-shrink:0;
                ">
                    <?= strtoupper(substr($u['nome_usuario'], 0, 1)) ?>
                </div>
                <div>
                    <div style="font-size:16px; font-weight:700; color:var(--slate-900);">
                        <?= htmlspecialchars($u['nome_usuario']) ?>
                    </div>
                    <div style="font-size:13px; color:var(--slate-500); margin-top:2px;">
                        <?= htmlspecialchars($u['email_usuario']) ?>
                    </div>
                </div>
                <div style="margin-left:auto;">
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
                </div>
            </div>

            <div class="detail-row">
                <span class="detail-label"><i class="fas fa-hashtag" style="width:16px;"></i> ID</span>
                <span class="detail-value td-mono">#<?= htmlspecialchars($u['id_usuario']) ?></span>
            </div>
            <div class="detail-row">
                <span class="detail-label"><i class="fas fa-envelope" style="width:16px;"></i> E-mail</span>
                <span class="detail-value td-mono"><?= htmlspecialchars($u['email_usuario']) ?></span>
            </div>
            <div class="detail-row">
                <span class="detail-label"><i class="fas fa-calendar" style="width:16px;"></i> Cadastrado</span>
                <span class="detail-value">
                    <?= isset($u['criado_em']) ? date('d/m/Y \à\s H:i', strtotime($u['criado_em'])) : '—' ?>
                </span>
            </div>
            <div class="detail-row">
                <span class="detail-label"><i class="fas fa-circle-dot" style="width:16px;"></i> Status</span>
                <span class="detail-value">
                    <span class="badge badge-green">
                        <i class="fas fa-circle" style="font-size:6px;"></i> Ativo
                    </span>
                </span>
            </div>
        </div>
    </div>

    <!-- Warning Zone -->
    <div class="danger-zone">
        <h3>
            <i class="fas fa-triangle-exclamation"></i>
            Atenção: Esta ação desativará o usuário
        </h3>
        <p>
            O usuário <strong><?= htmlspecialchars($u['nome_usuario']) ?></strong> será desativado
            e não poderá mais acessar o sistema. Seus dados serão preservados e
            o usuário poderá ser <strong>reativado</strong> a qualquer momento pela lista de usuários.
        </p>
    </div>

    <!-- Actions -->
    <div style="display:flex; gap:12px;">
        <form action="/usuario/deletar" method="POST" style="flex:1;">
            <input type="hidden" name="id_usuario" value="<?= (int) $u['id_usuario'] ?>">
            <button type="submit" class="btn btn-danger" style="width:100%;">
                <i class="fas fa-ban"></i> Confirmar Desativação
            </button>
        </form>
        <a href="/usuario/listar" class="btn btn-secondary" style="flex:1; justify-content:center;">
            <i class="fas fa-xmark"></i> Cancelar
        </a>
    </div>

</div>