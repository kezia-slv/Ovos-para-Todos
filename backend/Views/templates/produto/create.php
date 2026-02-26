<?php
// Variáveis: $categorias (array de strings)
?>

<div class="page-header">
    <div>
        <h1 class="page-title">Novo Produto</h1>
        <p class="page-subtitle">Preencha os dados para cadastrar um novo produto.</p>
    </div>
    <a href="/produto/listar" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Voltar
    </a>
</div>

<div style="max-width:720px;">
    <form action="/produto/salvar" method="POST" enctype="multipart/form-data" novalidate>

        <!-- Informações básicas -->
        <div class="card" style="margin-bottom:20px;">
            <div class="card-header">
                <h2><i class="fas fa-tag" style="color:var(--amber); margin-right:8px;"></i>Informações Básicas</h2>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label" for="nome_produto">
                        Nome do Produto <span class="required">*</span>
                    </label>
                    <input type="text" id="nome_produto" name="nome_produto"
                           class="form-control"
                           placeholder="Ex: Ovos Caipira Dúzia"
                           value="<?= e($_POST['nome_produto'] ?? '') ?>"
                           required autofocus>
                </div>

                <div class="form-group">
                    <label class="form-label" for="descricao_produto">Descrição</label>
                    <textarea id="descricao_produto" name="descricao_produto"
                              class="form-control"
                              rows="3"
                              placeholder="Descreva o produto..."
                              style="resize:vertical;"><?= e($_POST['descricao_produto'] ?? '') ?></textarea>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label" for="categoria_produto">Categoria</label>
                        <select id="categoria_produto" name="categoria_produto" class="form-control">
                            <option value="">Sem categoria</option>
                            <?php foreach ($categorias as $cat): ?>
                                <option value="<?= e($cat) ?>"
                                    <?= ($_POST['categoria_produto'] ?? '') === $cat ? 'selected' : '' ?>>
                                    <?= e($cat) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <p class="form-hint">Ou digite uma nova categoria abaixo.</p>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="nova_categoria">Nova Categoria</label>
                        <input type="text" id="nova_categoria" name="nova_categoria"
                               class="form-control"
                               placeholder="Ex: Ovos Especiais"
                               oninput="sincronizarCategoria(this)">
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="tipo_produto">Tipo</label>
                        <input type="text" id="tipo_produto" name="tipo_produto"
                               class="form-control"
                               placeholder="Ex: Caipira, Orgânico..."
                               value="<?= e($_POST['tipo_produto'] ?? '') ?>">
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
                                    <?= ($_POST['unidade_produto'] ?? '') === $un ? 'selected' : '' ?>>
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
                                   placeholder="0,00"
                                   step="0.01" min="0"
                                   value="<?= e($_POST['preco_produto'] ?? '') ?>"
                                   required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="estoque_produto">
                            Estoque <span class="required">*</span>
                        </label>
                        <input type="number" id="estoque_produto" name="estoque_produto"
                               class="form-control"
                               placeholder="0"
                               min="0"
                               value="<?= e($_POST['estoque_produto'] ?? '0') ?>"
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
                    <!-- Preview -->
                    <div id="foto-preview" style="
                        width:100px; height:100px; border-radius:12px;
                        background:var(--slate-100);
                        border:2px dashed var(--slate-300);
                        display:flex; align-items:center; justify-content:center;
                        overflow:hidden; flex-shrink:0; transition:border-color .2s;">
                        <i class="fas fa-egg" style="font-size:28px; color:var(--slate-300);"></i>
                    </div>
                    <div style="flex:1;">
                        <label for="foto_produto" class="btn btn-secondary" style="cursor:pointer; margin-bottom:8px;">
                            <i class="fas fa-upload"></i> Escolher imagem
                        </label>
                        <input type="file" id="foto_produto" name="foto_produto"
                               accept="image/jpeg,image/png,image/webp"
                               style="display:none;" onchange="previewFoto(this)">
                        <p class="form-hint">JPG, PNG ou WEBP. Tamanho máximo: 2MB.</p>
                        <p id="nome-arquivo" style="font-size:12px; color:var(--slate-500); margin-top:4px;"></p>
                    </div>
                </div>
            </div>
        </div>

        <div style="display:flex; gap:12px;">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-floppy-disk"></i> Cadastrar Produto
            </button>
            <a href="/produto/listar" class="btn btn-secondary">Cancelar</a>
        </div>

    </form>
</div>

<script>
function previewFoto(input) {
    const preview  = document.getElementById('foto-preview');
    const nomeEl   = document.getElementById('nome-arquivo');
    if (input.files && input.files[0]) {
        nomeEl.textContent = input.files[0].name;
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

function sincronizarCategoria(input) {
    const select = document.getElementById('categoria_produto');
    if (input.value.trim()) {
        // Desabilita o select enquanto há texto no campo livre
        select.disabled = true;
        select.value = '';
        // Transfere o valor para o name correto
        select.name = '';
        input.name  = 'categoria_produto';
    } else {
        select.disabled = false;
        select.name = 'categoria_produto';
        input.name  = 'nova_categoria';
    }
}
</script>