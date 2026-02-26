<?php
// Variável: $endereco (array com dados do endereço + join com usuário)
$en = $endereco;
?>

<div class="page-header">
    <div>
        <h1 class="page-title">Editar Endereço</h1>
        <p class="page-subtitle">
            Editando endereço de
            <strong><?= e($en['nome_usuario'] ?? 'Usuário') ?></strong>
            <span class="td-mono" style="font-size:12px; color:var(--slate-500); margin-left:6px;">
                #<?= e($en['id_endereco']) ?>
            </span>
        </p>
    </div>
    <a href="/endereco/listar" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Voltar
    </a>
</div>

<div style="max-width:640px;">
    <div class="card">
        <div class="card-header">
            <h2><i class="fas fa-pen-to-square" style="color:var(--amber); margin-right:8px;"></i>Dados do Endereço</h2>
            <span class="badge <?= empty($en['excluido_em']) ? 'badge-green' : 'badge-red' ?>">
                <?= empty($en['excluido_em']) ? 'Ativo' : 'Inativo' ?>
            </span>
        </div>
        <div class="card-body">
            <form action="/endereco/atualizar" method="POST" novalidate>
                <input type="hidden" name="id_endereco" value="<?= (int) $en['id_endereco'] ?>">

                <!-- Usuário vinculado (somente leitura) -->
                <div class="form-group">
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
                        <?= e($en['nome_usuario'] ?? '—') ?>
                        <?php if (!empty($en['email_usuario'])): ?>
                            <span class="td-mono" style="font-size:11px; color:var(--slate-400);">
                                (<?= e($en['email_usuario']) ?>)
                            </span>
                        <?php endif; ?>
                    </div>
                    <p class="form-hint">O vínculo com o usuário não pode ser alterado.</p>
                    <!-- Mantém o id_usuario no POST -->
                    <input type="hidden" name="id_usuario" value="<?= (int) $en['id_usuario'] ?>">
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
                               value="<?= e($en['cep_endereco']) ?>"
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
                               value="<?= e($en['logradouro_endereco']) ?>"
                               required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="numero_endereco">
                            Número <span class="required">*</span>
                        </label>
                        <input type="text" id="numero_endereco" name="numero_endereco"
                               class="form-control"
                               value="<?= e($en['numero_endereco']) ?>"
                               required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="complemento">Complemento</label>
                        <input type="text" id="complemento" name="complemento"
                               class="form-control"
                               placeholder="Apto, Bloco, Casa..."
                               value="<?= e($en['complemento'] ?? '') ?>">
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="bairro_endereco">
                            Bairro <span class="required">*</span>
                        </label>
                        <input type="text" id="bairro_endereco" name="bairro_endereco"
                               class="form-control"
                               value="<?= e($en['bairro_endereco']) ?>"
                               required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="cidade_endereco">
                            Cidade <span class="required">*</span>
                        </label>
                        <input type="text" id="cidade_endereco" name="cidade_endereco"
                               class="form-control"
                               value="<?= e($en['cidade_endereco']) ?>"
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
                            foreach ($ufs as $uf):
                            ?>
                                <option value="<?= $uf ?>"
                                    <?= ($en['uf_endereco'] ?? '') === $uf ? 'selected' : '' ?>>
                                    <?= $uf ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <!-- Info row -->
                <?php if (!empty($en['criado_em'])): ?>
                <div style="background:var(--slate-100); border-radius:8px; padding:14px 16px;
                            margin-bottom:20px; font-size:12.5px; color:var(--slate-500); display:flex; gap:24px;">
                    <span><i class="fas fa-calendar-plus" style="margin-right:5px;"></i>
                        Criado: <strong><?= date('d/m/Y H:i', strtotime($en['criado_em'])) ?></strong>
                    </span>
                    <?php if (!empty($en['atualizado_em'])): ?>
                    <span><i class="fas fa-calendar-check" style="margin-right:5px;"></i>
                        Atualizado: <strong><?= date('d/m/Y H:i', strtotime($en['atualizado_em'])) ?></strong>
                    </span>
                    <?php endif; ?>
                </div>
                <?php endif; ?>

                <div style="display:flex; gap:12px;">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-floppy-disk"></i> Salvar Alterações
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

    try {
        const res  = await fetch(`https://viacep.com.br/ws/${cep}/json/`);
        const data = await res.json();

        if (data.erro) {
            status.style.color = '#B91C1C';
            status.textContent = 'CEP não encontrado.';
        } else {
            document.getElementById('logradouro_endereco').value = data.logradouro || '';
            document.getElementById('bairro_endereco').value     = data.bairro     || '';
            document.getElementById('cidade_endereco').value     = data.localidade || '';

            const ufSelect = document.getElementById('uf_endereco');
            for (let opt of ufSelect.options) {
                if (opt.value === data.uf) { opt.selected = true; break; }
            }

            status.style.color = '#15803D';
            status.textContent = '✓ Endereço atualizado pela busca do CEP.';
            document.getElementById('numero_endereco').focus();
        }
    } catch (err) {
        status.style.color = '#B91C1C';
        status.textContent = 'Erro ao buscar CEP.';
    } finally {
        btn.innerHTML = '<i class="fas fa-magnifying-glass"></i> Buscar';
        btn.disabled  = false;
    }
}

document.getElementById('cep_endereco').addEventListener('input', function () {
    if (this.value.length === 9) buscarCep();
});
</script>