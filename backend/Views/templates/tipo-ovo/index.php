<?php defined('APP') or die('Acesso negado'); ?>

<div class="container mt-4">

    <!-- Cabeçalho -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Gerenciar Tipos de Ovo</h2>
        <a href="/tipo-ovo/criar" class="btn btn-primary">
            <i class="fas fa-plus"></i> Novo Tipo
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
                    <h5 class="card-title">Total de Tipos</h5>
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
                            <th>Nome do Tipo</th>
                            <th>Criado em</th>
                            <th>Situação</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($tipos)): ?>
                            <?php foreach ($tipos as $item): ?>
                                <tr>
                                    <td><?= htmlspecialchars($item['id_tipo_ovo']) ?></td>
                                    <td><?= htmlspecialchars($item['nome_tipo_ovo']) ?></td>
                                    <td><?= htmlspecialchars($item['criado_em']) ?></td>
                                    <td>
                                        <?php if (is_null($item['excluido_em'])): ?>
                                            <span class="badge bg-success">Ativo</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">Inativo</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="d-flex gap-1">
                                        <a href="/tipo-ovo/editar/<?= $item['id_tipo_ovo'] ?>" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <?php if (is_null($item['excluido_em'])): ?>
                                            <a href="/tipo-ovo/excluir/<?= $item['id_tipo_ovo'] ?>" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        <?php else: ?>
                                            <form action="/tipo-ovo/ativar" method="POST" class="d-inline">
                                                <input type="hidden" name="id_tipo_ovo" value="<?= $item['id_tipo_ovo'] ?>">
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
                                <td colspan="5" class="text-center text-muted">Nenhum tipo de ovo encontrado.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>