<?php
// Variables injected: $usuario (array with user data)
$u = $usuario;
?>

<div class="page-header">
    <div>
        <h1 class="page-title">Editar Usuário</h1>
        <p class="page-subtitle">
            Editando:
            <strong><?= htmlspecialchars($u['nome_usuario']) ?></strong>
            <span class="td-mono" style="font-size:12px; color:var(--slate-500); margin-left:6px;">
                #<?= $u['id_usuario'] ?>
            </span>
        </p>
    </div>
    <a href="/usuario/listar" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Voltar
    </a>
</div>

<div style="max-width: 640px;">
    <div class="card">
        <div class="card-header">
            <h2><i class="fas fa-user-pen" style="color:var(--amber); margin-right:8px;"></i>Dados do Usuário</h2>
            <span class="badge <?= empty($u['excluido_em']) ? 'badge-green' : 'badge-red' ?>">
                <?= empty($u['excluido_em']) ? 'Ativo' : 'Inativo' ?>
            </span>
        </div>
        <div class="card-body">
            <form action="/usuario/atualizar" method="POST" novalidate>
                <input type="hidden" name="id_usuario" value="<?= (int) $u['id_usuario'] ?>">

                <div class="form-grid">
                    <div class="form-group" style="grid-column: 1 / -1;">
                        <label class="form-label" for="nome_usuario">
                            Nome completo <span class="required">*</span>
                        </label>
                        <input
                            type="text"
                            id="nome_usuario"
                            name="nome_usuario"
                            class="form-control"
                            value="<?= htmlspecialchars($u['nome_usuario']) ?>"
                            required
                            autofocus
                        >
                    </div>

                    <div class="form-group" style="grid-column: 1 / -1;">
                        <label class="form-label" for="email_usuario">
                            E-mail <span class="required">*</span>
                        </label>
                        <input
                            type="email"
                            id="email_usuario"
                            name="email_usuario"
                            class="form-control"
                            value="<?= htmlspecialchars($u['email_usuario']) ?>"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="senha_usuario">
                            Nova Senha
                        </label>
                        <div style="position:relative;">
                            <input
                                type="password"
                                id="senha_usuario"
                                name="senha_usuario"
                                class="form-control"
                                placeholder="Deixe em branco para manter"
                                style="padding-right: 42px;"
                            >
                            <button type="button"
                                    onclick="toggleSenha('senha_usuario', this)"
                                    style="position:absolute; right:12px; top:50%; transform:translateY(-50%);
                                           background:none; border:none; cursor:pointer;
                                           color:var(--slate-500); font-size:14px;">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <p class="form-hint">Deixe em branco para não alterar a senha atual.</p>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="tipo_usuario">
                            Perfil <span class="required">*</span>
                        </label>
                        <select id="tipo_usuario" name="tipo_usuario" class="form-control" required>
                            <?php
                            $tipos = ['Cliente', 'Funcionario', 'Motorista', 'Admin'];
                            foreach ($tipos as $tipo):
                            ?>
                                <option value="<?= $tipo ?>"
                                    <?= $u['tipo_usuario'] === $tipo ? 'selected' : '' ?>>
                                    <?= $tipo ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <!-- Info row -->
                <div style="background:var(--slate-100); border-radius:8px; padding:14px 16px; margin-bottom:20px; font-size:12.5px; color:var(--slate-500); display:flex; gap:24px;">
                    <span><i class="fas fa-calendar-plus" style="margin-right:5px;"></i>
                        Criado em: <strong><?= isset($u['criado_em']) ? date('d/m/Y H:i', strtotime($u['criado_em'])) : '—' ?></strong>
                    </span>
                    <?php if (!empty($u['atualizado_em'])): ?>
                    <span><i class="fas fa-calendar-check" style="margin-right:5px;"></i>
                        Atualizado: <strong><?= date('d/m/Y H:i', strtotime($u['atualizado_em'])) ?></strong>
                    </span>
                    <?php endif; ?>
                </div>

                <div style="display:flex; gap:12px;">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-floppy-disk"></i> Salvar Alterações
                    </button>
                    <a href="/usuario/listar" class="btn btn-secondary">Cancelar</a>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
function toggleSenha(inputId, btn) {
    const input = document.getElementById(inputId);
    const icon  = btn.querySelector('i');
    if (input.type === 'password') {
        input.type = 'text';
        icon.className = 'fas fa-eye-slash';
    } else {
        input.type = 'password';
        icon.className = 'fas fa-eye';
    }
}
</script>