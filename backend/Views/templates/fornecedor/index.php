<div class="container mt-4">

    <!-- Cabeçalho -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Gerenciar Fornecedores</h2>
        <a href="/fornecedor/criar" class="btn btn-primary">
            <i class="fas fa-plus"></i> Novo Fornecedor
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
                    <h5 class="card-title">Total de Fornecedores</h5>
                    <p class="card-text fs-3"><?= $total ?? 0 ?></p>
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
                            <th>Nome</th>
                            <th>CNPJ</th>
                            <th>Telefone</th>
                            <th>E-mail</th>
                            <th>Status</th>
                            <th>Situação</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($fornecedor)): ?>
                            <?php foreach ($fornecedor as $item): ?>
                                <tr>
                                    <td><?= htmlspecialchars($item['id_fornecedor']) ?></td>
                                    <td><?= htmlspecialchars($item['nome_fornecedor']) ?></td>
                                    <td><?= htmlspecialchars($item['cnpj_fornecedor']) ?></td>
                                    <td><?= htmlspecialchars($item['telefone_fornecedor']) ?></td>
                                    <td><?= htmlspecialchars($item['email_fornecedor']) ?></td>
                                    <td>
                                        <?php if ($item['status_fornecedor'] === 'ativo'): ?>
                                            <span class="badge bg-success"><?= htmlspecialchars($item['status_fornecedor']) ?></span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary"><?= htmlspecialchars($item['status_fornecedor']) ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if (is_null($item['excluido_em'])): ?>
                                            <span class="badge bg-success">Ativo</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">Inativo</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="d-flex gap-1">
                                        <a href="/fornecedor/editar/<?= $item['id_fornecedor'] ?>" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <?php if (is_null($item['excluido_em'])): ?>
                                            <a href="/fornecedor/excluir/<?= $item['id_fornecedor'] ?>" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        <?php else: ?>
                                            <form action="/fornecedor/ativar" method="POST" class="d-inline">
                                                <input type="hidden" name="id_fornecedor" value="<?= $item['id_fornecedor'] ?>">
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
                                <td colspan="8" class="text-center text-muted">Nenhum fornecedor encontrado.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>