<?php
// Nenhuma variável necessária
?>

<div class="page-header">
    <div>
        <h1 class="page-title">Novo Endereço</h1>
        <p class="page-subtitle">Preencha os dados do endereço. Digite o CEP para preenchimento automático.</p>
    </div>
    <a href="/endereco/listar" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Voltar
    </a>
</div>

<div style="max-width:640px;">
    <div class="card">
        <div class="card-header">
            <h2><i class="fas fa-map-location-dot" style="color:var(--amber); margin-right:8px;"></i>Dados do Endereço</h2>
        </div>
        <div class="card-body">
            <form action="/endereco/salvar" method="POST" novalidate>

                <!-- Usuário vinculado -->
                <div class="form-group">
                    <label class="form-label" for="id_usuario">
                        ID do Usuário <span class="required">*</span>
                    </label>
                    <input type="number" id="id_usuario" name="id_usuario"
                           class="form-control"
                           placeholder="Ex: 5"
                           value="<?= e($_POST['id_usuario'] ?? '') ?>"
                           required autofocus>
                    <p class="form-hint">Informe o ID do usuário ao qual este endereço pertence.</p>
                </div>

                <hr style="border:none; border-top:1px solid var(--slate-100); margin:4px 0 20px;">

                <!-- CEP com busca automática -->
                <div class="form-group">
                    <label class="form-label" for="cep_endereco">
                        CEP <span class="required">*</span>
                    </label>
                    <div style="display:flex; gap:10px;">
                        <input type="text" id="cep_endereco" name="cep_endereco"
                               class="form-control"
                               placeholder="00000-000"
                               maxlength="9"
                               value="<?= e($_POST['cep_endereco'] ?? '') ?>"
                               oninput="mascaraCep(this)"
                               required>
                        <button type="button" id="btn-buscar-cep"
                                class="btn btn-secondary" onclick="buscarCep()"
                                style="white-space:nowrap;">
                            <i class="fas fa-magnifying-glass"></i> Buscar
                        </button>
                    </div>
                    <p id="cep-status" class="form-hint"></p>
                </div>

                <div class="form-grid">
                    <div class="form-group" style="grid-column:1/-1;">
                        <label class="form-label" for="logradouro_endereco">
                            Logradouro <span class="required">*</span>
                        </label>
                        <input type="text" id="logradouro_endereco" name="logradouro_endereco"
                               class="form-control"
                               placeholder="Rua, Avenida, Travessa..."
                               value="<?= e($_POST['logradouro_endereco'] ?? '') ?>"
                               required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="numero_endereco">
                            Número <span class="required">*</span>
                        </label>
                        <input type="text" id="numero_endereco" name="numero_endereco"
                               class="form-control"
                               placeholder="Ex: 123 ou S/N"
                               value="<?= e($_POST['numero_endereco'] ?? '') ?>"
                               required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="complemento">Complemento</label>
                        <input type="text" id="complemento" name="complemento"
                               class="form-control"
                               placeholder="Apto, Bloco, Casa..."
                               value="<?= e($_POST['complemento'] ?? '') ?>">
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="bairro_endereco">
                            Bairro <span class="required">*</span>
                        </label>
                        <input type="text" id="bairro_endereco" name="bairro_endereco"
                               class="form-control"
                               placeholder="Nome do bairro"
                               value="<?= e($_POST['bairro_endereco'] ?? '') ?>"
                               required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="cidade_endereco">
                            Cidade <span class="required">*</span>
                        </label>
                        <input type="text" id="cidade_endereco" name="cidade_endereco"
                               class="form-control"
                               placeholder="Nome da cidade"
                               value="<?= e($_POST['cidade_endereco'] ?? '') ?>"
                               required>
                    </div>

                    <div class="form-group" style="grid-column:1/-1;">
                        <label class="form-label" for="uf_endereco">
                            UF <span class="required">*</span>
                        </label>
                        <select id="uf_endereco" name="uf_endereco" class="form-control" required
                                style="max-width:160px;">
                            <option value="">Selecione...</option>
                            <?php
                            $ufs = ['AC','AL','AP','AM','BA','CE','DF','ES','GO','MA','MT','MS','MG',
                                    'PA','PB','PR','PE','PI','RJ','RN','RS','RO','RR','SC','SP','SE','TO'];
                            $ufSelecionada = $_POST['uf_endereco'] ?? '';
                            foreach ($ufs as $uf):
                            ?>
                                <option value="<?= $uf ?>" <?= $ufSelecionada === $uf ? 'selected' : '' ?>>
                                    <?= $uf ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div style="display:flex; gap:12px; margin-top:8px;">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-floppy-disk"></i> Cadastrar Endereço
                    </button>
                    <a href="/endereco/listar" class="btn btn-secondary">Cancelar</a>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
function mascaraCep(input) {
    let v = input.value.replace(/\D/g, '').slice(0, 8);
    if (v.length > 5) v = v.slice(0, 5) + '-' + v.slice(5);
    input.value = v;
}

async function buscarCep() {
    const cep    = document.getElementById('cep_endereco').value.replace(/\D/g, '');
    const status = document.getElementById('cep-status');
    const btn    = document.getElementById('btn-buscar-cep');

    if (cep.length !== 8) {
        status.style.color = '#B91C1C';
        status.textContent = 'Digite um CEP válido com 8 dígitos.';
        return;
    }

    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Buscando...';
    btn.disabled  = true;
    status.textContent = '';

    try {
        const res  = await fetch(`https://viacep.com.br/ws/${cep}/json/`);
        const data = await res.json();

        if (data.erro) {
            status.style.color   = '#B91C1C';
            status.textContent   = 'CEP não encontrado.';
        } else {
            document.getElementById('logradouro_endereco').value = data.logradouro || '';
            document.getElementById('bairro_endereco').value     = data.bairro     || '';
            document.getElementById('cidade_endereco').value     = data.localidade || '';

            const ufSelect = document.getElementById('uf_endereco');
            for (let opt of ufSelect.options) {
                if (opt.value === data.uf) { opt.selected = true; break; }
            }

            status.style.color   = '#15803D';
            status.textContent   = '✓ Endereço preenchido automaticamente.';
            document.getElementById('numero_endereco').focus();
        }
    } catch (err) {
        status.style.color = '#B91C1C';
        status.textContent = 'Erro ao buscar CEP. Verifique sua conexão.';
    } finally {
        btn.innerHTML = '<i class="fas fa-magnifying-glass"></i> Buscar';
        btn.disabled  = false;
    }
}

// Busca automática ao completar 9 caracteres (com traço)
document.getElementById('cep_endereco').addEventListener('input', function () {
    if (this.value.length === 9) buscarCep();
});
</script>