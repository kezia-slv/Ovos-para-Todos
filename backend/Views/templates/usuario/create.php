<?php
// No variables needed for create form
?>

<div class="page-header">
    <div>
        <h1 class="page-title">Novo Usuário</h1>
        <p class="page-subtitle">Preencha os dados para cadastrar um novo usuário.</p>
    </div>
    <a href="/usuario/listar" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Voltar
    </a>
</div>

<div style="max-width: 640px;">
    <div class="card">
        <div class="card-header">
            <h2><i class="fas fa-user-plus" style="color:var(--amber); margin-right:8px;"></i>Dados do Usuário</h2>
        </div>
        <div class="card-body">
            <form action="/usuario/salvar" method="POST" novalidate>

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
                            placeholder="Ex: João da Silva"
                            value="<?= htmlspecialchars($_POST['nome_usuario'] ?? '') ?>"
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
                            placeholder="exemplo@email.com"
                            value="<?= htmlspecialchars($_POST['email_usuario'] ?? '') ?>"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="senha_usuario">
                            Senha <span class="required">*</span>
                        </label>
                        <div style="position:relative;">
                            <input
                                type="password"
                                id="senha_usuario"
                                name="senha_usuario"
                                class="form-control"
                                placeholder="Mínimo 6 caracteres"
                                style="padding-right: 42px;"
                                required
                            >
                            <button type="button"
                                    onclick="toggleSenha('senha_usuario', this)"
                                    style="position:absolute; right:12px; top:50%; transform:translateY(-50%);
                                           background:none; border:none; cursor:pointer;
                                           color:var(--slate-500); font-size:14px;">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <p class="form-hint">Mínimo de 6 caracteres.</p>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="tipo_usuario">
                            Perfil <span class="required">*</span>
                        </label>
                        <select id="tipo_usuario" name="tipo_usuario" class="form-control" required>
                            <option value="" disabled selected>Selecione...</option>
                            <?php
                            $tipos = ['Cliente', 'Funcionario', 'Motorista', 'Admin'];
                            $selecionado = $_POST['tipo_usuario'] ?? '';
                            foreach ($tipos as $tipo):
                            ?>
                                <option value="<?= $tipo ?>" <?= $selecionado === $tipo ? 'selected' : '' ?>>
                                    <?= $tipo ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div style="display:flex; gap:12px; margin-top:8px;">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-floppy-disk"></i> Cadastrar Usuário
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