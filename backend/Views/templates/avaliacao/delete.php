<?php
// views/avaliacao/delete.php
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Avaliação</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body class="bg-light">

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-5">

            <!-- Cabeçalho -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold mb-0 text-danger">
                    <i class="bi bi-trash me-2"></i>Excluir Avaliação
                </h2>
                <a href="/avaliacao/listar" class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-arrow-left me-1"></i> Voltar
                </a>
            </div>

            <!-- Card de confirmação -->
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4 text-center">

                    <div class="mb-3">
                        <span class="display-3 text-danger"><i class="bi bi-exclamation-triangle-fill"></i></span>
                    </div>

                    <h5 class="fw-bold">Tem certeza que deseja excluir?</h5>
                    <p class="text-muted mb-1">
                        Você está prestes a excluir a avaliação de ID <strong>#<?= $id_avaliacao ?></strong>.
                    </p>
                    <p class="text-muted small">
                        Essa ação realizará uma <strong>exclusão lógica</strong> (soft delete) — o registro poderá ser reativado posteriormente.
                    </p>

                    <hr>

                    <div class="d-flex justify-content-center gap-3 mt-3">

                        <!-- Cancelar -->
                        <a href="/avaliacao/listar" class="btn btn-outline-secondary px-4">
                            <i class="bi bi-x-lg me-1"></i> Cancelar
                        </a>

                        <!-- Confirmar exclusão -->
                        <form action="/avaliacao/excluir" method="POST">
                            <input type="hidden" name="id_avaliacao" value="<?= $id_avaliacao ?>">
                            <button type="submit" class="btn btn-danger px-4">
                                <i class="bi bi-trash me-1"></i> Confirmar Exclusão
                            </button>
                        </form>

                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>