<?php
// Variáveis: $produto (array), $categorias (array de strings)
$p = $produto;
?>

<div class="page-header">
    <div>
        <h1 class="page-title">Editar Produto</h1>
        <p class="page-subtitle">
            Editando: <strong><?= e($p['nome_produto']) ?></strong>
            <span class="td-mono" style="font-size:12px; color:var(--slate-500); margin-left:6px;">
                #<?= e($p['id_produto']) ?>
            </span>
        </p>
    </div>
    <a href="/produto/listar" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Voltar
    </a>
</div>

<div style="max-width:720px;">
    <form action="/produto/atualizar" method="POST" enctype="multipart/form-data" novalidate>
        <input type="hidden" name="id_produto"  value="<?= (int) $p['id_produto'] ?>">
        <input type="hidden" name="foto_atual"  value="<?= e($p['foto_produto'] ?? '') ?>">

        <!-- Informações básicas -->
        <div class="card" style="margin-bottom:20px;">
            <div class="card-header">
                <h2><i class="fas fa-tag" style="color:var(--amber); margin-right:8px;"></i>Informações Básicas</h2>
                <span class="badge <?= empty($p['excluido_em']) ? 'badge-green' : 'badge-red' ?>">
                    <?= empty($p['excluido_em']) ? 'Ativo' : 'Inativo' ?>
                </span>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label" for="nome_produto">
                        Nome do Produto <span class="required">*</span>
                    </label>
                    <input type="text" id="nome_produto" name="nome_produto"
                           class="form-control"
                           value="<?= e($p['nome_produto']) ?>"
                           required autofocus>
                </div>

                <div class="form-group">
                    <label class="form-label" for="descricao_produto">Descrição</label>
                    <textarea id="descricao_produto" name="descricao_produto"
                              class="form-control" rows="3"
                              style="resize:vertical;"><?= e($p['descricao_produto'] ?? '') ?></textarea>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label" for="categoria_produto">Categoria</label>
                        <select id="categoria_produto" name="categoria_produto" class="form-control">
                            <option value="">Sem categoria</option>
                            <?php foreach ($categorias as $cat): ?>
                                <option value="<?= e($cat) ?>"
                                    <?= ($p['categoria_produto'] ?? '') === $cat ? 'selected' : '' ?>>
                                    <?= e($cat) ?>
                                </option>
                            <?php endforeach; ?>
                            <?php
                            // Garante que a categoria atual aparece mesmo que não esteja na lista
                            if (!empty($p['categoria_produto']) && !in_array($p['categoria_produto'], $categorias)):
                            ?>
                                <option value="<?= e($p['categoria_produto']) ?>" selected>
                                    <?= e($p['categoria_produto']) ?>
                                </option>
                            <?php endif; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="tipo_produto">Tipo</label>
                        <input type="text" id="tipo_produto" name="tipo_produto"
                               class="form-control"
                               placeholder="Ex: Caipira, Orgânico..."
                               value="<?= e($p['tipo_produto'] ?? '') ?>">
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="unidade_produto">Unidade</label>
                        <select id="unidade_produto" name="unidade_produto" class="form-control">
                            <option value="">Selecione...</option>
                            <?php
                            $unidades = ['Unidade', 'Dúzia', 'Bandeja', 'Kg', 'Caixa', 'Pacote'];
                            foreach ($unidades as $un):
                            ?>
                                <option value="<?= $un ?>"
                                    <?= ($p['unidade_produto'] ?? '') === $un ? 'selected' : '' ?>>
                                    <?= $un ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Preço e Estoque -->
        <div class="card" style="margin-bottom:20px;">
            <div class="card-header">
                <h2><i class="fas fa-coins" style="color:var(--amber); margin-right:8px;"></i>Preço e Estoque</h2>
            </div>
            <div class="card-body">
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label" for="preco_produto">
                            Preço (R$) <span class="required">*</span>
                        </label>
                        <div style="position:relative;">
                            <span style="
                                position:absolute; left:12px; top:50%; transform:translateY(-50%);
                                color:var(--slate-500); font-size:13px; font-weight:600;">R$</span>
                            <input type="number" id="preco_produto" name="preco_produto"
                                   class="form-control"
                                   style="padding-left:36px;"
                                   step="0.01" min="0"
                                   value="<?= e($p['preco_produto'] ?? '0.00') ?>"
                                   required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="estoque_produto">
                            Estoque <span class="required">*</span>
                        </label>
                        <input type="number" id="estoque_produto" name="estoque_produto"
                               class="form-control"
                               min="0"
                               value="<?= e($p['estoque_produto'] ?? '0') ?>"
                               required>
                    </div>
                </div>
            </div>
        </div>

        <!-- Foto -->
        <div class="card" style="margin-bottom:24px;">
            <div class="card-header">
                <h2><i class="fas fa-image" style="color:var(--amber); margin-right:8px;"></i>Foto do Produto</h2>
            </div>
            <div class="card-body">
                <div style="display:flex; align-items:flex-start; gap:24px;">
                    <!-- Preview com foto atual -->
                    <?php
                    $temFoto = !empty($p['foto_produto']) && strpos($p['foto_produto'], 'placeholder') === false;
                    ?>
                    <div id="foto-preview" style="
                        width:100px; height:100px; border-radius:12px;
                        background:var(--slate-100);
                        border:2px <?= $temFoto ? 'solid var(--amber)' : 'dashed var(--slate-300)' ?>;
                        display:flex; align-items:center; justify-content:center;
                        overflow:hidden; flex-shrink:0;">
                        <?php if ($temFoto): ?>
                            <img src="<?= e($p['foto_produto']) ?>" alt="foto atual"
                                 style="width:100%; height:100%; object-fit:cover; border-radius:10px;">
                        <?php else: ?>
                            <i class="fas fa-egg" style="font-size:28px; color:var(--slate-300);"></i>
                        <?php endif; ?>
                    </div>
                    <div style="flex:1;">
                        <label for="foto_produto" class="btn btn-secondary" style="cursor:pointer; margin-bottom:8px;">
                            <i class="fas fa-upload"></i>
                            <?= $temFoto ? 'Trocar imagem' : 'Escolher imagem' ?>
                        </label>
                        <input type="file" id="foto_produto" name="foto_produto"
                               accept="image/jpeg,image/png,image/webp"
                               style="display:none;" onchange="previewFoto(this)">
                        <p class="form-hint">JPG, PNG ou WEBP. Máx. 2MB.</p>
                        <?php if ($temFoto): ?>
                            <p style="font-size:11.5px; color:var(--slate-400); margin-top:4px;">
                                <i class="fas fa-check-circle" style="color:var(--amber);"></i>
                                Foto atual salva. Escolha outra para substituir.
                            </p>
                        <?php endif; ?>
                        <p id="nome-arquivo" style="font-size:12px; color:var(--slate-500); margin-top:4px;"></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Info row -->
        <div style="background:var(--white); border:1px solid var(--slate-300); border-radius:10px;
                    padding:14px 18px; margin-bottom:20px; font-size:12.5px; color:var(--slate-500);
                    display:flex; gap:24px; flex-wrap:wrap;">
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
            <a href="/produto/listar" class="btn btn-secondary">Cancelar</a>
        </div>

    </form>
</div>

<script>
function previewFoto(input) {
    const preview = document.getElementById('foto-preview');
    const nomeEl  = document.getElementById('nome-arquivo');
    if (input.files && input.files[0]) {
        nomeEl.textContent = '📎 ' + input.files[0].name;
        const reader = new FileReader();
        reader.onload = e => {
            preview.innerHTML = `<img src="${e.target.result}"
                style="width:100%; height:100%; object-fit:cover; border-radius:10px;">`;
            preview.style.borderStyle = 'solid';
            preview.style.borderColor = 'var(--amber)';
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>