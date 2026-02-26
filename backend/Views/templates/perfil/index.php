<?php
// Variáveis: $perfis, $total_perfil, $total_ativos, $total_inativos
?>

<div class="page-header">
    <div>
        <h1 class="page-title">Perfis de Usuário</h1>
        <p class="page-subtitle">Dados complementares dos usuários cadastrados.</p>
    </div>
    <a href="/perfil/criar" class="btn btn-primary">
        <i class="fas fa-plus"></i> Novo Perfil
    </a>
</div>

<!-- Stats -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-card-icon" style="background:#FEF3C7;">
            <i class="fas fa-id-card" style="color:var(--amber-dark);"></i>
        </div>
        <div class="stat-card-label">Total</div>
        <div class="stat-card-value"><?= $total_perfil ?? 0 ?></div>
    </div>
    <div class="stat-card">
        <div class="stat-card-icon" style="background:#DCFCE7;">
            <i class="fas fa-circle-check" style="color:#15803D;"></i>
        </div>
        <div class="stat-card-label">Ativos</div>
        <div class="stat-card-value" style="color:#15803D;"><?= $total_ativos ?? 0 ?></div>
    </div>
    <div class="stat-card">
        <div class="stat-card-icon" style="background:#FEE2E2;">
            <i class="fas fa-circle-xmark" style="color:#B91C1C;"></i>
        </div>
        <div class="stat-card-label">Inativos</div>
        <div class="stat-card-value" style="color:#B91C1C;"><?= $total_inativos ?? 0 ?></div>
    </div>
</div>

<!-- Table Card -->
<div class="card">
    <div class="card-header">
        <h2><i class="fas fa-id-card" style="color:var(--amber); margin-right:8px;"></i>Lista de Perfis</h2>
        <span style="font-size:12px; color:var(--slate-500);">
            <?= count($perfis ?? []) ?> registro(s) encontrado(s)
        </span>
    </div>

    <div class="table-wrapper">
        <?php if (!empty($perfis)): ?>
        <table>
            <thead>
                <tr>
                    <th style="width:50px;">#</th>
                    <th>Usuário</th>
                    <th>Telefone</th>
                    <th>Nascimento</th>
                    <th>Gênero</th>
                    <th>Foto</th>
                    <th>Status</th>
                    <th style="width:140px; text-align:right;">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($perfis as $p): ?>
                <tr>
                    <td class="td-mono"><?= e($p['id_perfil_usuario']) ?></td>
                    <td>
                        <div style="display:flex; align-items:center; gap:10px;">
                            <?php if (!empty($p['foto_usuario'])): ?>
                                <img src="<?= asset_path($p['foto_usuario']) ?>"
                                     alt="foto"
                                     style="width:32px; height:32px; border-radius:50%; object-fit:cover; flex-shrink:0;">
                            <?php else: ?>
                                <div style="
                                    width:32px; height:32px; border-radius:50%;
                                    background:var(--amber);
                                    display:flex; align-items:center; justify-content:center;
                                    font-size:13px; font-weight:700; color:var(--slate-900); flex-shrink:0;">
                                    <?= strtoupper(substr($p['nome_usuario'] ?? '?', 0, 1)) ?>
                                </div>
                            <?php endif; ?>
                            <div>
                                <div style="font-weight:500; color:var(--slate-900);">
                                    <?= e($p['nome_usuario'] ?? '—') ?>
                                </div>
                                <div class="td-mono" style="font-size:11px;">
                                    <?= e($p['email_usuario'] ?? '') ?>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="td-mono"><?= e($p['telefone_usuario'] ?? '—') ?></td>
                    <td>
                        <?= !empty($p['data_nascimento_usuario'])
                            ? date('d/m/Y', strtotime($p['data_nascimento_usuario']))
                            : '—' ?>
                    </td>
                    <td>
                        <?php if (!empty($p['genero_usuario'])): ?>
                            <?php
                            $icones = [
                                'Masculino'  => ['fas fa-mars',  '#3B82F6', '#DBEAFE'],
                                'Feminino'   => ['fas fa-venus', '#EC4899', '#FCE7F3'],
                                'Outro'      => ['fas fa-genderless', '#8B5CF6', '#EDE9FE'],
                            ];
                            $ic = $icones[$p['genero_usuario']] ?? ['fas fa-circle', '#64748B', '#F1F5F9'];
                            ?>
                            <span class="badge" style="background:<?= $ic[2] ?>; color:<?= $ic[1] ?>;">
                                <i class="<?= $ic[0] ?>"></i> <?= e($p['genero_usuario']) ?>
                            </span>
                        <?php else: ?>
                            <span style="color:var(--slate-400);">—</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if (!empty($p['foto_usuario'])): ?>
                            <span class="badge badge-green">
                                <i class="fas fa-image"></i> Sim
                            </span>
                        <?php else: ?>
                            <span class="badge" style="background:var(--slate-100); color:var(--slate-500);">
                                Sem foto
                            </span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if (empty($p['excluido_em'])): ?>
                            <span class="badge badge-green">
                                <i class="fas fa-circle" style="font-size:6px;"></i> Ativo
                            </span>
                        <?php else: ?>
                            <span class="badge badge-red">
                                <i class="fas fa-circle" style="font-size:6px;"></i> Inativo
                            </span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <div style="display:flex; align-items:center; gap:6px; justify-content:flex-end;">
                            <a href="/perfil/editar/<?= $p['id_perfil_usuario'] ?>"
                               class="btn btn-secondary btn-sm" title="Editar">
                                <i class="fas fa-pencil"></i>
                            </a>

                            <?php if (empty($p['excluido_em'])): ?>
                                <a href="/perfil/deletar/<?= $p['id_perfil_usuario'] ?>"
                                   class="btn btn-sm"
                                   style="background:#FEE2E2; color:#B91C1C;" title="Desativar">
                                    <i class="fas fa-ban"></i>
                                </a>
                            <?php else: ?>
                                <form action="/perfil/ativar" method="POST" style="display:inline;">
                                    <input type="hidden" name="id_perfil_usuario" value="<?= $p['id_perfil_usuario'] ?>">
                                    <button type="submit" class="btn btn-sm"
                                            style="background:#DCFCE7; color:#15803D;" title="Reativar">
                                        <i class="fas fa-rotate-right"></i>
                                    </button>
                                </form>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php else: ?>
        <div class="empty-state">
            <i class="fas fa-id-card-clip"></i>
            <p>Nenhum perfil cadastrado ainda.</p>
        </div>
        <?php endif; ?>
    </div>
</div>