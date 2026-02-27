<?php defined('APP') or die('Acesso negado'); ?>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Novo Registro de Estoque</h2>
        <a href="/estoque/listar" class="btn btn-secondary">
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
            <form action="/estoque/salvar" method="POST">

                <div class="row g-3">

                    <div class="col-md-4">
                        <label for="id_produtos" class="form-label">ID do Produto <span class="text-danger">*</span></label>
                        <input type="number" name="id_produtos" id="id_produtos" class="form-control" min="1" required>
                        <div class="form-text">Informe o ID do produto cadastrado.</div>
                    </div>

                    <div class="col-md-4">
                        <label for="quantidade_estoque" class="form-label">Quantidade em Estoque <span class="text-danger">*</span></label>
                        <input type="number" name="quantidade_estoque" id="quantidade_estoque" class="form-control" min="0" required>
                    </div>

                    <div class="col-md-4">
                        <label for="quantidade_min_reposicao" class="form-label">Quantidade Mínima para Reposição <span class="text-danger">*</span></label>
                        <input type="number" name="quantidade_min_reposicao" id="quantidade_min_reposicao" class="form-control" min="0" required>
                        <div class="form-text">Alerta será exibido quando o estoque atingir esse valor.</div>
                    </div>

                </div>

                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Salvar Estoque
                    </button>
                    <a href="/estoque/listar" class="btn btn-secondary">Cancelar</a>
                </div>

            </form>
        </div>
    </div>

</div>