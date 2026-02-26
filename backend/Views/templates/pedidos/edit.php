<?php defined('APP') or die('Acesso negado'); ?>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Editar Pedido #<?= htmlspecialchars($pedido['id_pedidos']) ?></h2>
        <a href="/pedidos/listar" class="btn btn-secondary">
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
            <form action="/pedidos/atualizar" method="POST">

                <!-- Campo hidden com o ID -->
                <input type="hidden" name="id_pedidos" value="<?= htmlspecialchars($pedido['id_pedidos']) ?>">

                <div class="row g-3">

                    <div class="col-md-6">
                        <label for="id_usuario" class="form-label">ID do Usuário <span class="text-danger">*</span></label>
                        <input type="number" name="id_usuario" id="id_usuario" class="form-control"
                            value="<?= htmlspecialchars($pedido['id_usuario']) ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label for="id_endereco" class="form-label">ID do Endereço <span class="text-danger">*</span></label>
                        <input type="number" name="id_endereco" id="id_endereco" class="form-control"
                            value="<?= htmlspecialchars($pedido['id_endereco']) ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label for="data_pedido" class="form-label">Data do Pedido <span class="text-danger">*</span></label>
                        <input type="datetime-local" name="data_pedido" id="data_pedido" class="form-control"
                            value="<?= date('Y-m-d\TH:i', strtotime($pedido['data_pedido'])) ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label for="total_pedido" class="form-label">Total do Pedido (R$) <span class="text-danger">*</span></label>
                        <input type="number" step="0.01" min="0" name="total_pedido" id="total_pedido" class="form-control"
                            value="<?= htmlspecialchars($pedido['total_pedido']) ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label for="status_pedido" class="form-label">Status do Pedido <span class="text-danger">*</span></label>
                        <select name="status_pedido" id="status_pedido" class="form-select" required>
                            <option value="pendente"           <?= $pedido['status_pedido'] === 'pendente'          ? 'selected' : '' ?>>Pendente</option>
                            <option value="em_processamento"   <?= $pedido['status_pedido'] === 'em_processamento'  ? 'selected' : '' ?>>Em Processamento</option>
                            <option value="enviado"            <?= $pedido['status_pedido'] === 'enviado'           ? 'selected' : '' ?>>Enviado</option>
                            <option value="entregue"           <?= $pedido['status_pedido'] === 'entregue'          ? 'selected' : '' ?>>Entregue</option>
                            <option value="cancelado"          <?= $pedido['status_pedido'] === 'cancelado'         ? 'selected' : '' ?>>Cancelado</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="forma_pagamento" class="form-label">Forma de Pagamento <span class="text-danger">*</span></label>
                        <select name="forma_pagamento" id="forma_pagamento" class="form-select" required>
                            <option value="pix"            <?= $pedido['forma_pagamento'] === 'pix'            ? 'selected' : '' ?>>Pix</option>
                            <option value="cartao_credito" <?= $pedido['forma_pagamento'] === 'cartao_credito' ? 'selected' : '' ?>>Cartão de Crédito</option>
                            <option value="cartao_debito"  <?= $pedido['forma_pagamento'] === 'cartao_debito'  ? 'selected' : '' ?>>Cartão de Débito</option>
                            <option value="boleto"         <?= $pedido['forma_pagamento'] === 'boleto'         ? 'selected' : '' ?>>Boleto</option>
                            <option value="dinheiro"       <?= $pedido['forma_pagamento'] === 'dinheiro'       ? 'selected' : '' ?>>Dinheiro</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="status_pagamento" class="form-label">Status do Pagamento <span class="text-danger">*</span></label>
                        <select name="status_pagamento" id="status_pagamento" class="form-select" required>
                            <option value="aguardando" <?= $pedido['status_pagamento'] === 'aguardando' ? 'selected' : '' ?>>Aguardando</option>
                            <option value="aprovado"   <?= $pedido['status_pagamento'] === 'aprovado'   ? 'selected' : '' ?>>Aprovado</option>
                            <option value="recusado"   <?= $pedido['status_pagamento'] === 'recusado'   ? 'selected' : '' ?>>Recusado</option>
                            <option value="estornado"  <?= $pedido['status_pagamento'] === 'estornado'  ? 'selected' : '' ?>>Estornado</option>
                        </select>
                    </div>

                    <div class="col-12">
                        <label for="observacoes" class="form-label">Observações</label>
                        <textarea name="observacoes" id="observacoes" class="form-control" rows="3"><?= htmlspecialchars($pedido['observacoes'] ?? '') ?></textarea>
                    </div>

                </div>

                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-save"></i> Atualizar Pedido
                    </button>
                    <a href="/pedidos/listar" class="btn btn-secondary">Cancelar</a>
                </div>

            </form>
        </div>
    </div>

</div>