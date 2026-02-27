<?php defined('APP') or die('Acesso negado'); ?>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Excluir Tipo de Ovo</h2>
        <a href="/tipo-ovo/listar" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Voltar
        </a>
    </div>

    <div class="card shadow-sm border-danger">
        <div class="card-header bg-danger text-white">
            <i class="fas fa-exclamation-triangle"></i> Confirmação de Exclusão
        </div>
        <div class="card-body text-center py-5">

            <i class="fas fa-egg fa-4x text-danger mb-3"></i>
            <h4 class="mb-2">Tem certeza que deseja excluir o tipo de ovo <strong>#<?= htmlspecialchars($id_tipo_ovo) ?></strong>?</h4>
            <p class="text-muted mb-4">O registro não será removido permanentemente, mas ficará marcado como inativo.</p>

            <form action="/tipo-ovo/excluir" method="POST" class="d-inline">
                <input type="hidden" name="id_tipo_ovo" value="<?= htmlspecialchars($id_tipo_ovo) ?>">
                <button type="submit" class="btn btn-danger me-2">
                    <i class="fas fa-trash"></i> Sim, excluir
                </button>
            </form>

            <a href="/tipo-ovo/listar" class="btn btn-secondary">
                <i class="fas fa-times"></i> Cancelar
            </a>

        </div>
    </div>

</div>