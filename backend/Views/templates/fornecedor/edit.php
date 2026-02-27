<?php defined('APP') or die('Acesso negado'); ?>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Editar Fornecedor #<?= htmlspecialchars($fornecedor['id_fornecedor']) ?></h2>
        <a href="/fornecedor/listar" class="btn btn-secondary">
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
            <form action="/fornecedor/atualizar" method="POST">

                <!-- Campo hidden com o ID -->
                <input type="hidden" name="id_fornecedor" value="<?= htmlspecialchars($fornecedor['id_fornecedor']) ?>">

                <div class="row g-3">

                    <div class="col-md-6">
                        <label for="nome_fornecedor" class="form-label">Nome do Fornecedor <span class="text-danger">*</span></label>
                        <input type="text" name="nome_fornecedor" id="nome_fornecedor" class="form-control"
                            value="<?= htmlspecialchars($fornecedor['nome_fornecedor']) ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label for="cnpj_fornecedor" class="form-label">CNPJ <span class="text-danger">*</span></label>
                        <input type="text" name="cnpj_fornecedor" id="cnpj_fornecedor" class="form-control"
                            value="<?= htmlspecialchars($fornecedor['cnpj_fornecedor']) ?>" maxlength="18" required>
                    </div>

                    <div class="col-md-6">
                        <label for="telefone_fornecedor" class="form-label">Telefone <span class="text-danger">*</span></label>
                        <input type="text" name="telefone_fornecedor" id="telefone_fornecedor" class="form-control"
                            value="<?= htmlspecialchars($fornecedor['telefone_fornecedor']) ?>" maxlength="15" required>
                    </div>

                    <div class="col-md-6">
                        <label for="email_fornecedor" class="form-label">E-mail <span class="text-danger">*</span></label>
                        <input type="email" name="email_fornecedor" id="email_fornecedor" class="form-control"
                            value="<?= htmlspecialchars($fornecedor['email_fornecedor']) ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label for="status_fornecedor" class="form-label">Status <span class="text-danger">*</span></label>
                        <select name="status_fornecedor" id="status_fornecedor" class="form-select" required>
                            <option value="ativo"     <?= $fornecedor['status_fornecedor'] === 'ativo'     ? 'selected' : '' ?>>Ativo</option>
                            <option value="inativo"   <?= $fornecedor['status_fornecedor'] === 'inativo'   ? 'selected' : '' ?>>Inativo</option>
                            <option value="suspenso"  <?= $fornecedor['status_fornecedor'] === 'suspenso'  ? 'selected' : '' ?>>Suspenso</option>
                        </select>
                    </div>

                </div>

                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-save"></i> Atualizar Fornecedor
                    </button>
                    <a href="/fornecedor/listar" class="btn btn-secondary">Cancelar</a>
                </div>

            </form>
        </div>
    </div>

</div>