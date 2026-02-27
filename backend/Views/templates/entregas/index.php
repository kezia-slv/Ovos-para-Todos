<?php defined('APP') or die('Acesso negado'); ?>

<div class="container mt-4">

    <!-- Cabeçalho -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Gerenciar Entregas</h2>
        <a href="/entregas/criar" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nova Entrega
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
                    <h5 class="card-title">Total de Entregas</h5>
                    <p class="card-text fs-3"><?= $total ?? 0 ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title">Ativas</h5>
                    <p class="card-text fs-3"><?= $total_ativos ?? 0 ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-danger">
                <div class="card-body">
                    <h5 class="card-title">Inativas</h5>
                    <p class="card-text fs-3"><?= $total_inativos ?? 0 ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabela -->
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>#ID</th>
                            <th>ID Pedido</th>
                            <th>ID Usuário</th>
                            <th>Status</th>
                            <th>Previsão</th>
                            <th>Entregue em</th>
                            <th>Situação</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($entregas)): ?>
                            <?php foreach ($entregas as $item): ?>
                                <tr>
                                    <td><?= htmlspecialchars($item['id_entrega']) ?></td>
                                    <td><?= htmlspecialchars($item['id_pedidos']) ?></td>
                                    <td><?= htmlspecialchars($item['id_usuario']) ?></td>
                                    <td>
                                        <?php
                                            $statusMap = [
                                                'pendente'    => 'bg-warning text-dark',
                                                'em_rota'     => 'bg-info text-white',
                                                'entregue'    => 'bg-success',
                                                'cancelado'   => 'bg-danger',
                                            ];
                                            $badgeClass = $statusMap[$item['status_entrega']] ?? 'bg-secondary';
                                        ?>
                                        <span class="badge <?= $badgeClass ?>"><?= htmlspecialchars($item['status_entrega']) ?></span>
                                    </td>
                                    <td><?= htmlspecialchars($item['previsao_entrega']) ?></td>
                                    <td><?= !empty($item['entregue_em']) ? htmlspecialchars($item['entregue_em']) : '<span class="text-muted">—</span>' ?></td>
                                    <td>
                                        <?php if (is_null($item['excluido_em'])): ?>
                                            <span class="badge bg-success">Ativa</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">Inativa</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="d-flex gap-1">
                                        <a href="/entregas/editar/<?= $item['id_entrega'] ?>" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <?php if (is_null($item['excluido_em'])): ?>
                                            <a href="/entregas/excluir/<?= $item['id_entrega'] ?>" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        <?php else: ?>
                                            <form action="/entregas/ativar" method="POST" class="d-inline">
                                                <input type="hidden" name="id_entrega" value="<?= $item['id_entrega'] ?>">
                                                <button type="submit" class="btn btn-sm btn-success" title="Reativar">
                                                    <i class="fas fa-redo"></i>
                                                </button>
                                            </form>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="text-center text-muted">Nenhuma entrega encontrada.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>