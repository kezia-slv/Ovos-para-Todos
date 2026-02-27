<?php
// views/avaliacao/edit.php
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Avaliação</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        .star-rating { display: flex; flex-direction: row-reverse; justify-content: flex-end; gap: 4px; }
        .star-rating input { display: none; }
        .star-rating label { font-size: 2rem; color: #ccc; cursor: pointer; transition: color .2s; }
        .star-rating input:checked ~ label,
        .star-rating label:hover,
        .star-rating label:hover ~ label { color: #ffc107; }
    </style>
</head>
<body class="bg-light">

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-7">

            <!-- Cabeçalho -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold mb-0">
                    <i class="bi bi-pencil-square text-primary me-2"></i>
                    Editar Avaliação <small class="text-muted fs-5">#<?= $avaliacao['id_avaliacao'] ?></small>
                </h2>
                <a href="/avaliacao/listar" class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-arrow-left me-1"></i> Voltar
                </a>
            </div>

            <!-- Mensagem de erro -->
            <?php if (isset($_SESSION['mensagem']) && $_SESSION['tipo_mensagem'] === 'error'): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= $_SESSION['mensagem'] ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php unset($_SESSION['mensagem'], $_SESSION['tipo_mensagem']); ?>
            <?php endif; ?>

            <!-- Formulário -->
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <form action="/avaliacao/atualizar" method="POST">

                        <!-- ID oculto -->
                        <input type="hidden" name="id_avaliacao" value="<?= $avaliacao['id_avaliacao'] ?>">

                        <div class="row g-3">

                            <!-- ID Usuário -->
                            <div class="col-md-6">
                                <label for="id_usuario" class="form-label fw-semibold">ID do Usuário <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="id_usuario" name="id_usuario"
                                       value="<?= $avaliacao['id_usuario'] ?>" min="1" required>
                            </div>

                            <!-- ID Pedido -->
                            <div class="col-md-6">
                                <label for="id_pedidos" class="form-label fw-semibold">ID do Pedido <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="id_pedidos" name="id_pedidos"
                                       value="<?= $avaliacao['id_pedidos'] ?>" min="1" required>
                            </div>

                            <!-- Nota (estrelas) -->
                            <div class="col-12">
                                <label class="form-label fw-semibold">Nota <span class="text-danger">*</span></label>
                                <div class="star-rating">
                                    <?php for ($i = 5; $i >= 1; $i--): ?>
                                        <input type="radio" id="star<?= $i ?>" name="nota_avaliacao" value="<?= $i ?>"
                                               <?= (int)$avaliacao['nota_avaliacao'] === $i ? 'checked' : '' ?> required>
                                        <label for="star<?= $i ?>" title="<?= $i ?> estrela(s)"><i class="bi bi-star-fill"></i></label>
                                    <?php endfor; ?>
                                </div>
                                <div class="form-text">Nota atual: <?= $avaliacao['nota_avaliacao'] ?> estrela(s).</div>
                            </div>

                            <!-- Comentário -->
                            <div class="col-12">
                                <label for="comentario_avaliacao" class="form-label fw-semibold">Comentário</label>
                                <textarea class="form-control" id="comentario_avaliacao" name="comentario_avaliacao"
                                          rows="4"><?= htmlspecialchars($avaliacao['comentario_avaliacao']) ?></textarea>
                            </div>

                            <!-- Data -->
                            <div class="col-md-6">
                                <label for="data_avaliacao" class="form-label fw-semibold">Data <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="data_avaliacao" name="data_avaliacao"
                                       value="<?= $avaliacao['data_avaliacao'] ?>" required>
                            </div>

                            <!-- Status -->
                            <div class="col-md-6">
                                <label for="status_avaliacao" class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
                                <select class="form-select" id="status_avaliacao" name="status_avaliacao" required>
                                    <option value="ativo"   <?= $avaliacao['status_avaliacao'] === 'ativo'   ? 'selected' : '' ?>>Ativo</option>
                                    <option value="inativo" <?= $avaliacao['status_avaliacao'] === 'inativo' ? 'selected' : '' ?>>Inativo</option>
                                </select>
                            </div>

                            <!-- Info de auditoria (somente leitura) -->
                            <?php if (!empty($avaliacao['criado_em'])): ?>
                            <div class="col-12">
                                <div class="alert alert-light border mb-0 py-2 small">
                                    <i class="bi bi-info-circle me-1"></i>
                                    Criado em: <strong><?= date('d/m/Y H:i', strtotime($avaliacao['criado_em'])) ?></strong>
                                    <?php if (!empty($avaliacao['atualizado_em'])): ?>
                                        &nbsp;|&nbsp; Atualizado em: <strong><?= date('d/m/Y H:i', strtotime($avaliacao['atualizado_em'])) ?></strong>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php endif; ?>

                        </div>

                        <hr class="my-4">

                        <div class="d-flex justify-content-end gap-2">
                            <a href="/avaliacao/listar" class="btn btn-outline-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-lg me-1"></i> Atualizar Avaliação
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>