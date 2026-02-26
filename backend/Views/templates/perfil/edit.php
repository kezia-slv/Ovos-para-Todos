<?php
// Variável: $perfil (array com dados do perfil + join com usuário)
$p = $perfil;
?>

<div class="page-header">
    <div>
        <h1 class="page-title">Editar Perfil</h1>
        <p class="page-subtitle">
            Editando perfil de
            <strong><?= e($p['nome_usuario'] ?? 'Usuário') ?></strong>
            <span class="td-mono" style="font-size:12px; color:var(--slate-500); margin-left:6px;">
                #<?= e($p['id_perfil_usuario']) ?>
            </span>
        </p>
    </div>
    <a href="/perfil/listar" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Voltar
    </a>
</div>

<div style="max-width:640px;">
    <div class="card">
        <div class="card-header">
            <h2><i class="fas fa-user-pen" style="color:var(--amber); margin-right:8px;"></i>Dados do Perfil</h2>
            <span class="badge <?= empty($p['excluido_em']) ? 'badge-green' : 'badge-red' ?>">
                <?= empty($p['excluido_em']) ? 'Ativo' : 'Inativo' ?>
            </span>
        </div>
        <div class="card-body">
            <form action="/perfil/atualizar" method="POST" enctype="multipart/form-data" novalidate>
                <input type="hidden" name="id_perfil_usuario" value="<?= (int) $p['id_perfil_usuario'] ?>">
                <input type="hidden" name="foto_atual"        value="<?= e($p['foto_usuario'] ?? '') ?>">

                <!-- Foto preview -->
                <div class="form-group" style="text-align:center; margin-bottom:28px;">
                    <div id="foto-preview" style="
                        width:90px; height:90px; border-radius:50%;
                        background:var(--slate-100);
                        border:2px solid <?= !empty($p['foto_usuario']) ? 'var(--amber)' : 'var(--slate-300)' ?>;
                        display:flex; align-items:center; justify-content:center;
                        margin:0 auto 12px; overflow:hidden; cursor:pointer;">
                        <?php if (!empty($p['foto_usuario'])): ?>
                            <img src="<?= asset_path($p['foto_usuario']) ?>"
                                 style="width:100%; height:100%; object-fit:cover;"
                                 alt="foto atual">
                        <?php else: ?>
                            <i class="fas fa-camera" style="font-size:24px; color:var(--slate-400);"></i>
                        <?php endif; ?>
                    </div>
                    <label for="foto_usuario" class="btn btn-secondary btn-sm" style="cursor:pointer;">
                        <i class="fas fa-upload"></i>
                        <?= !empty($p['foto_usuario']) ? 'Trocar foto' : 'Escolher foto' ?>
                    </label>
                    <input type="file" id="foto_usuario" name="foto_usuario"
                           accept="image/jpeg,image/png,image/webp"
                           style="display:none;" onchange="previewFoto(this)">
                    <p class="form-hint" style="margin-top:6px;">JPG, PNG ou WEBP — máx. 2MB</p>
                </div>

                <div class="form-grid">
                    <!-- Usuário vinculado (somente leitura) -->
                    <div class="form-group" style="grid-column:1/-1;">
                        <label class="form-label">Usuário Vinculado</label>
                        <div style="
                            padding:10px 14px;
                            background:var(--slate-100);
                            border:1.5px solid var(--slate-200, #E2E8F0);
                            border-radius:8px;
                            font-size:14px;
                            color:var(--slate-600, #475569);
                            display:flex; align-items:center; gap:8px;">
                            <i class="fas fa-lock" style="font-size:12px; color:var(--slate-400);"></i>
                            <?= e($p['nome_usuario'] ?? '—') ?>
                            <span class="td-mono" style="font-size:12px; color:var(--slate-400);">
                                (<?= e($p['email_usuario'] ?? '') ?>)
                            </span>
                        </div>
                        <p class="form-hint">O vínculo com o usuário não pode ser alterado.</p>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="telefone_usuario">Telefone</label>
                        <input type="text" id="telefone_usuario" name="telefone_usuario"
                               class="form-control"
                               placeholder="(11) 99999-9999"
                               value="<?= e($p['telefone_usuario'] ?? '') ?>">
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="data_nascimento_usuario">Data de Nascimento</label>
                        <input type="date" id="data_nascimento_usuario" name="data_nascimento_usuario"
                               class="form-control"
                               value="<?= e($p['data_nascimento_usuario'] ?? '') ?>">
                    </div>

                    <div class="form-group" style="grid-column:1/-1;">
                        <label class="form-label" for="genero_usuario">Gênero</label>
                        <select id="genero_usuario" name="genero_usuario" class="form-control">
                            <option value="">Não informado</option>
                            <?php foreach (['Masculino', 'Feminino', 'Outro'] as $g): ?>
                                <option value="<?= $g ?>"
                                    <?= ($p['genero_usuario'] ?? '') === $g ? 'selected' : '' ?>>
                                    <?= $g ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <!-- Info row -->
                <div style="background:var(--slate-100); border-radius:8px; padding:14px 16px; margin-bottom:20px; font-size:12.5px; color:var(--slate-500); display:flex; gap:24px; flex-wrap:wrap;">
                    <?php if (!empty($p['criado_em'])): ?>
                    <span><i class="fas fa-calendar-plus" style="margin-right:5px;"></i>
                        Criado: <strong><?= date('d/m/Y H:i', strtotime($p['criado_em'])) ?></strong>
                    </span>
                    <?php endif; ?>
                    <?php if (!empty($p['atualizado_em'])): ?>
                    <span><i class="fas fa-calendar-check" style="margin-right:5px;"></i>
                        Atualizado: <strong><?= date('d/m/Y H:i', strtotime($p['atualizado_em'])) ?></strong>
                    </span>
                    <?php endif; ?>
                </div>

                <div style="display:flex; gap:12px;">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-floppy-disk"></i> Salvar Alterações
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
                style="width:100%; height:100%; object-fit:cover;">`;
            preview.style.borderColor = 'var(--amber)';
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>