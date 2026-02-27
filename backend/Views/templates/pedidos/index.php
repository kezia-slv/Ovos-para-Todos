<div class="container mt-4">

    <!-- Cabeçalho -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Gerenciar Pedidos</h2>
        <a href="/pedidos/criar" class="btn btn-primary">
            <i class="fas fa-plus"></i> Novo Pedido
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

    <!-- Cards de totais -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">Total de Pedidos</h5>
                    <p class="card-text fs-3"><?= $total_pedidos ?? 0 ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title">Pedidos Ativos</h5>
                    <p class="card-text fs-3"><?= $total_ativos ?? 0 ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-danger">
                <div class="card-body">
                    <h5 class="card-title">Pedidos Inativos</h5>
                    <p class="card-text fs-3"><?= $total_inativos ?? 0 ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabela de pedidos -->
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>#ID</th>
                            <th>Usuário</th>
                            <th>Data do Pedido</th>
                            <th>Total</th>
                            <th>Forma Pagamento</th>
                            <th>Status Pedido</th>
                            <th>Status Pagamento</th>
                            <th>Situação</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($pedidos)): ?>
                            <?php foreach ($pedidos as $pedido): ?>
                                <tr>
                                    <td><?= htmlspecialchars($pedido['id_pedidos']) ?></td>
                                    <td><?= htmlspecialchars($pedido['id_usuario']) ?></td>
                                    <td><?= htmlspecialchars($pedido['data_pedido']) ?></td>
                                    <td>R$ <?= number_format($pedido['total_pedido'], 2, ',', '.') ?></td>
                                    <td><?= htmlspecialchars($pedido['forma_pagamento']) ?></td>
                                    <td>
                                        <span class="badge bg-info"><?= htmlspecialchars($pedido['status_pedido']) ?></span>
                                    </td>
                                    <td>
                                        <span class="badge bg-warning text-dark"><?= htmlspecialchars($pedido['status_pagamento']) ?></span>
                                    </td>
                                    <td>
                                        <?php if (is_null($pedido['excluido_em'])): ?>
                                            <span class="badge bg-success">Ativo</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">Inativo</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="/pedidos/editar/<?= $pedido['id_pedidos'] ?>" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="/pedidos/excluir/<?= $pedido['id_pedidos'] ?>" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="9" class="text-center text-muted">Nenhum pedido encontrado.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>