<?php defined('APP') or die('Acesso negado'); ?>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Editar Estoque #<?= htmlspecialchars($estoque['id_estoque']) ?></h2>
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

    <!-- Alerta de reposição -->
    <?php if ($estoque['quantidade_estoque'] <= $estoque['quantidade_min_reposicao']): ?>
        <div class="alert alert-warning d-flex align-items-center mb-4" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>
            <span>Atenção! A quantidade em estoque está abaixo ou igual ao mínimo para reposição.</span>
        </div>
    <?php endif; ?>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="/estoque/atualizar" method="POST">

                <!-- Campo hidden com o ID -->
                <input type="hidden" name="id_estoque" value="<?= htmlspecialchars($estoque['id_estoque']) ?>">

                <div class="row g-3">

                    <div class="col-md-4">
                        <label for="id_produtos" class="form-label">ID do Produto <span class="text-danger">*</span></label>
                        <input type="number" name="id_produtos" id="id_produtos" class="form-control" min="1"
                            value="<?= htmlspecialchars($estoque['id_produtos']) ?>" required>
                    </div>

                    <div class="col-md-4">
                        <label for="quantidade_estoque" class="form-label">Quantidade em Estoque <span class="text-danger">*</span></label>
                        <input type="number" name="quantidade_estoque" id="quantidade_estoque" class="form-control" min="0"
                            value="<?= htmlspecialchars($estoque['quantidade_estoque']) ?>" required>
                    </div>

                    <div class="col-md-4">
                        <label for="quantidade_min_reposicao" class="form-label">Quantidade Mínima para Reposição <span class="text-danger">*</span></label>
                        <input type="number" name="quantidade_min_reposicao" id="quantidade_min_reposicao" class="form-control" min="0"
                            value="<?= htmlspecialchars($estoque['quantidade_min_reposicao']) ?>" required>
                    </div>

                </div>

                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-save"></i> Atualizar Estoque
                    </button>
                    <a href="/estoque/listar" class="btn btn-secondary">Cancelar</a>
                </div>

            </form>
        </div>
    </div>

</div>