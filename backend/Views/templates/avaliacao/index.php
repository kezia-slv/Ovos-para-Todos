<?php
// views/avaliacao/index.php
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avaliações</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body class="bg-light">

<div class="container py-4">

    <!-- Cabeçalho -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0"><i class="bi bi-star-half me-2"></i>Avaliações</h2>
        <a href="/avaliacao/criar" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Nova Avaliação
        </a>
    </div>

    <!-- Mensagem de feedback -->
    <?php if (isset($_SESSION['mensagem'])): ?>
        <div class="alert alert-<?= $_SESSION['tipo_mensagem'] ?> alert-dismissible fade show" role="alert">
            <?= $_SESSION['mensagem'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php unset($_SESSION['mensagem'], $_SESSION['tipo_mensagem']); ?>
    <?php endif; ?>

    <!-- Cards de totais -->
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm text-center py-3">
                <div class="card-body">
                    <h5 class="text-muted mb-1">Total</h5>
                    <h2 class="fw-bold text-primary"><?= $total_avaliacao ?? 0 ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm text-center py-3">
                <div class="card-body">
                    <h5 class="text-muted mb-1">Ativos</h5>
                    <h2 class="fw-bold text-success"><?= $total_ativos ?? 0 ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm text-center py-3">
                <div class="card-body">
                    <h5 class="text-muted mb-1">Inativos</h5>
                    <h2 class="fw-bold text-danger"><?= $total_inativos ?? 0 ?></h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabela -->
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Usuário</th>
                            <th>Pedido</th>
                            <th>Nota</th>
                            <th>Comentário</th>
                            <th>Data</th>
                            <th>Status</th>
                            <th>Situação</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($avaliacao)): ?>
                            <?php foreach ($avaliacao as $item): ?>
                            <tr>
                                <td><?= $item['id_avaliacao'] ?></td>
                                <td><?= $item['id_usuario'] ?></td>
                                <td><?= $item['id_pedidos'] ?></td>
                                <td>
                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                        <i class="bi bi-star<?= $i <= $item['nota_avaliacao'] ? '-fill text-warning' : '' ?>"></i>
                                    <?php endfor; ?>
                                    <small class="text-muted ms-1">(<?= $item['nota_avaliacao'] ?>)</small>
                                </td>
                                <td><?= htmlspecialchars(mb_strimwidth($item['comentario_avaliacao'], 0, 50, '...')) ?></td>
                                <td><?= date('d/m/Y', strtotime($item['data_avaliacao'])) ?></td>
                                <td>
                                    <span class="badge <?= $item['status_avaliacao'] === 'ativo' ? 'bg-success' : 'bg-secondary' ?>">
                                        <?= ucfirst($item['status_avaliacao']) ?>
                                    </span>
                                </td>
                                <td>
                                    <?php if (is_null($item['excluido_em'])): ?>
                                        <span class="badge bg-success">Ativo</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">Inativo</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <a href="/avaliacao/editar/<?= $item['id_avaliacao'] ?>" class="btn btn-sm btn-outline-primary me-1" title="Editar">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <?php if (is_null($item['excluido_em'])): ?>
                                        <a href="/avaliacao/excluir/<?= $item['id_avaliacao'] ?>" class="btn btn-sm btn-outline-danger" title="Excluir">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    <?php else: ?>
                                        <form action="/avaliacao/ativar" method="POST" class="d-inline">
                                            <input type="hidden" name="id_avaliacao" value="<?= $item['id_avaliacao'] ?>">
                                            <button type="submit" class="btn btn-sm btn-outline-success" title="Ativar">
                                                <i class="bi bi-arrow-counterclockwise"></i>
                                            </button>
                                        </form>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="9" class="text-center text-muted py-4">Nenhuma avaliação encontrada.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>