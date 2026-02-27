
<div class="container mt-4">

    <!-- Cabeçalho -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Gerenciar Estoque</h2>
        <a href="/estoque/criar" class="btn btn-primary">
            <i class="fas fa-plus"></i> Novo Registro
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
                    <h5 class="card-title">Total de Registros</h5>
                    <p class="card-text fs-3"><?= $total_estoque ?? 0 ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title">Ativos</h5>
                    <p class="card-text fs-3"><?= $total_ativos ?? 0 ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-danger">
                <div class="card-body">
                    <h5 class="card-title">Inativos</h5>
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
                            <th>ID Produto</th>
                            <th>Quantidade em Estoque</th>
                            <th>Qtd. Mínima Reposição</th>
                            <th>Situação</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($estoque)): ?>
                            <?php foreach ($estoque as $item): ?>
                                <tr>
                                    <td><?= htmlspecialchars($item['id_estoque']) ?></td>
                                    <td><?= htmlspecialchars($item['id_produtos']) ?></td>
                                    <td>
                                        <?php
                                            $qtd = $item['quantidade_estoque'];
                                            $min = $item['quantidade_min_reposicao'];
                                            $badge = $qtd <= $min ? 'bg-danger' : 'bg-success';
                                        ?>
                                        <span class="badge <?= $badge ?>"><?= htmlspecialchars($qtd) ?></span>
                                        <?php if ($qtd <= $min): ?>
                                            <small class="text-danger ms-1"><i class="fas fa-exclamation-triangle"></i> Repor!</small>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= htmlspecialchars($min) ?></td>
                                    <td>
                                        <?php if (is_null($item['excluido_em'])): ?>
                                            <span class="badge bg-success">Ativo</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">Inativo</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="d-flex gap-1">
                                        <a href="/estoque/editar/<?= $item['id_estoque'] ?>" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <?php if (is_null($item['excluido_em'])): ?>
                                            <a href="/estoque/excluir/<?= $item['id_estoque'] ?>" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        <?php else: ?>
                                            <form action="/estoque/ativar" method="POST" class="d-inline">
                                                <input type="hidden" name="id_estoque" value="<?= $item['id_estoque'] ?>">
                                                <button type="submit" class="btn btn-sm btn-success">
                                                    <i class="fas fa-redo"></i>
                                                </button>
                                            </form>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center text-muted">Nenhum registro de estoque encontrado.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>