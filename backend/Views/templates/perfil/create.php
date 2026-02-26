<?php
// Nenhuma variável necessária
?>

<div class="page-header">
    <div>
        <h1 class="page-title">Novo Perfil</h1>
        <p class="page-subtitle">Preencha os dados complementares do usuário.</p>
    </div>
    <a href="/perfil/listar" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Voltar
    </a>
</div>

<div style="max-width:640px;">
    <div class="card">
        <div class="card-header">
            <h2><i class="fas fa-id-card" style="color:var(--amber); margin-right:8px;"></i>Dados do Perfil</h2>
        </div>
        <div class="card-body">
            <form action="/perfil/salvar" method="POST" enctype="multipart/form-data" novalidate>

                <!-- Foto preview -->
                <div class="form-group" style="text-align:center; margin-bottom:28px;">
                    <div id="foto-preview" style="
                        width:90px; height:90px; border-radius:50%;
                        background:var(--slate-100);
                        border:2px dashed var(--slate-300);
                        display:flex; align-items:center; justify-content:center;
                        margin:0 auto 12px;
                        overflow:hidden; cursor:pointer;
                        transition:border-color .2s;">
                        <i class="fas fa-camera" style="font-size:24px; color:var(--slate-400);"></i>
                    </div>
                    <label for="foto_usuario" class="btn btn-secondary btn-sm" style="cursor:pointer;">
                        <i class="fas fa-upload"></i> Escolher foto
                    </label>
                    <input type="file" id="foto_usuario" name="foto_usuario"
                           accept="image/jpeg,image/png,image/webp"
                           style="display:none;" onchange="previewFoto(this)">
                    <p class="form-hint" style="margin-top:6px;">JPG, PNG ou WEBP — máx. 2MB</p>
                </div>

                <div class="form-grid">
                    <div class="form-group" style="grid-column:1/-1;">
                        <label class="form-label" for="id_usuario">
                            ID do Usuário <span class="required">*</span>
                        </label>
                        <input type="number" id="id_usuario" name="id_usuario"
                               class="form-control"
                               placeholder="Ex: 5"
                               value="<?= e($_POST['id_usuario'] ?? '') ?>"
                               required>
                        <p class="form-hint">Informe o ID do usuário ao qual este perfil pertence.</p>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="telefone_usuario">Telefone</label>
                        <input type="text" id="telefone_usuario" name="telefone_usuario"
                               class="form-control"
                               placeholder="(11) 99999-9999"
                               value="<?= e($_POST['telefone_usuario'] ?? '') ?>">
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="data_nascimento_usuario">Data de Nascimento</label>
                        <input type="date" id="data_nascimento_usuario" name="data_nascimento_usuario"
                               class="form-control"
                               value="<?= e($_POST['data_nascimento_usuario'] ?? '') ?>">
                    </div>

                    <div class="form-group" style="grid-column:1/-1;">
                        <label class="form-label" for="genero_usuario">Gênero</label>
                        <select id="genero_usuario" name="genero_usuario" class="form-control">
                            <option value="" disabled selected>Selecione...</option>
                            <?php foreach (['Masculino', 'Feminino', 'Outro'] as $g): ?>
                                <option value="<?= $g ?>"
                                    <?= ($_POST['genero_usuario'] ?? '') === $g ? 'selected' : '' ?>>
                                    <?= $g ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div style="display:flex; gap:12px; margin-top:8px;">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-floppy-disk"></i> Cadastrar Perfil
                    </button>
                    <a href="/perfil/listar" class="btn btn-secondary">Cancelar</a>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
function previewFoto(input) {
    const preview = document.getElementById('foto-preview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            preview.innerHTML = `<img src="${e.target.result}"
                style="width:100%; height:100%; object-fit:cover; border-radius:50%;">`;
            preview.style.borderStyle = 'solid';
            preview.style.borderColor = 'var(--amber)';
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>