<?php defined('APP') or die('Acesso negado'); ?>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Editar Venda #<?= htmlspecialchars($venda['id_vendas']) ?></h2>
        <a href="/vendas/listar" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Voltar
        </a>
    </div>

    <!-- Mensagens de feedback -->
    <?php if (isset($_SESSION['mensagem'])): ?>
        <div class="alert alert-<?= $_SESSION['tipo_mensagem'] ?> alert-dismissible fade show" role="alert">
            <?= $_SESSION['mensagem'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php unset($_SESSION['mensagem'], $_SESSION['tipo_mensagem']); ?>
    <?php endif; ?>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="/vendas/atualizar" method="POST">

                <input type="hidden" name="id_vendas" value="<?= htmlspecialchars($venda['id_vendas']) ?>">

                <div class="row g-3">

                    <div class="col-md-6">
                        <label for="id_usuario" class="form-label">ID do Usuário <span class="text-danger">*</span></label>
                        <input type="number" name="id_usuario" id="id_usuario" class="form-control" min="1"
                            value="<?= htmlspecialchars($venda['id_usuario']) ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label for="id_pedidos" class="form-label">ID do Pedido <span class="text-danger">*</span></label>
                        <input type="number" name="id_pedidos" id="id_pedidos" class="form-control" min="1"
                            value="<?= htmlspecialchars($venda['id_pedidos']) ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label for="valor_total" class="form-label">Valor Total (R$) <span class="text-danger">*</span></label>
                        <input type="number" name="valor_total" id="valor_total" class="form-control"
                            step="0.01" min="0"
                            value="<?= htmlspecialchars($venda['valor_total']) ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label for="forma_pagamento" class="form-label">Forma de Pagamento <span class="text-danger">*</span></label>
                        <select name="forma_pagamento" id="forma_pagamento" class="form-select" required>
                            <option value="pix"            <?= $venda['forma_pagamento'] === 'pix'            ? 'selected' : '' ?>>Pix</option>
                            <option value="cartao_credito" <?= $venda['forma_pagamento'] === 'cartao_credito' ? 'selected' : '' ?>>Cartão de Crédito</option>
                            <option value="cartao_debito"  <?= $venda['forma_pagamento'] === 'cartao_debito'  ? 'selected' : '' ?>>Cartão de Débito</option>
                            <option value="boleto"         <?= $venda['forma_pagamento'] === 'boleto'         ? 'selected' : '' ?>>Boleto</option>
                            <option value="dinheiro"       <?= $venda['forma_pagamento'] === 'dinheiro'       ? 'selected' : '' ?>>Dinheiro</option>
                        </select>
                    </div>

                </div>

                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-save"></i> Atualizar Venda
                    </button>
                    <a href="/vendas/listar" class="btn btn-secondary">Cancelar</a>
                </div>

            </form>
        </div>
    </div>

</div>