<?php defined('APP') or die('Acesso negado'); ?>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Nova Entrega</h2>
        <a href="/entregas/listar" class="btn btn-secondary">
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
            <form action="/entregas/salvar" method="POST">

                <div class="row g-3">

                    <div class="col-md-6">
                        <label for="id_usuario" class="form-label">ID do Usuário <span class="text-danger">*</span></label>
                        <input type="number" name="id_usuario" id="id_usuario" class="form-control" min="1" required>
                    </div>

                    <div class="col-md-6">
                        <label for="id_pedidos" class="form-label">ID do Pedido <span class="text-danger">*</span></label>
                        <input type="number" name="id_pedidos" id="id_pedidos" class="form-control" min="1" required>
                    </div>

                    <div class="col-md-4">
                        <label for="status_entrega" class="form-label">Status da Entrega <span class="text-danger">*</span></label>
                        <select name="status_entrega" id="status_entrega" class="form-select" required>
                            <option value="" disabled selected>Selecione...</option>
                            <option value="pendente">Pendente</option>
                            <option value="em_rota">Em Rota</option>
                            <option value="entregue">Entregue</option>
                            <option value="cancelado">Cancelado</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="previsao_entrega" class="form-label">Previsão de Entrega <span class="text-danger">*</span></label>
                        <input type="date" name="previsao_entrega" id="previsao_entrega" class="form-control" required>
                    </div>

                    <div class="col-md-4">
                        <label for="entregue_em" class="form-label">Entregue em</label>
                        <input type="datetime-local" name="entregue_em" id="entregue_em" class="form-control">
                        <div class="form-text">Preencha apenas quando a entrega for concluída.</div>
                    </div>

                </div>

                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Salvar Entrega
                    </button>
                    <a href="/entregas/listar" class="btn btn-secondary">Cancelar</a>
                </div>

            </form>
        </div>
    </div>

</div>