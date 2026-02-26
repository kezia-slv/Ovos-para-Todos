<?php

namespace Ovos\Ebenezer\Models;

use PDO;
use Exception;

/**
 * Model para gerenciar a tabela tbl_produtos
 * Schema: id_produto, nome_produto, descricao_produto, preco_produto,
 *         foto_produto, categoria_produto, tipo_produto, unidade_produto,
 *         estoque_produto, criado_em, atualizado_em, excluido_em
 */
class Produto
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    // =========================================================
    // CRIAÇÃO (CREATE)
    // =========================================================

    public function inserirProduto(array $dados): int|false
    {
        // Garante campos com defaults
        $dados['estoque_produto'] = $dados['estoque_produto'] ?? 0;

        $colunas      = implode(', ', array_keys($dados));
        $placeholders = ':' . implode(', :', array_keys($dados));

        $sql = "INSERT INTO tbl_produtos ($colunas) VALUES ($placeholders)";

        try {
            $stmt = $this->db->prepare($sql);
            foreach ($dados as $coluna => &$valor) {
                $stmt->bindValue(":{$coluna}", $valor);
            }
            if ($stmt->execute()) {
                return (int) $this->db->lastInsertId();
            }
            return false;
        } catch (Exception $e) {
            error_log("ERRO ao inserir produto: " . $e->getMessage());
            return false;
        }
    }

    // =========================================================
    // ATUALIZAÇÃO (UPDATE)
    // =========================================================

    public function atualizarProduto(int $id_produto, array $dados): bool
    {
        $dados['atualizado_em'] = date('Y-m-d H:i:s');

        $setParts = [];
        foreach ($dados as $coluna => $valor) {
            $setParts[] = "{$coluna} = :{$coluna}";
        }
        $setString = implode(', ', $setParts);

        $sql = "UPDATE tbl_produtos SET {$setString} WHERE id_produto = :id_produto";

        try {
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id_produto', $id_produto, PDO::PARAM_INT);
            foreach ($dados as $coluna => &$valor) {
                $stmt->bindValue(":{$coluna}", $valor);
            }
            return $stmt->execute();
        } catch (Exception $e) {
            error_log("ERRO ao atualizar produto #{$id_produto}: " . $e->getMessage());
            return false;
        }
    }

    // =========================================================
    // EXCLUSÃO SOFT DELETE
    // =========================================================

    public function excluirProduto(int $id_produto): bool
    {
        $dataAtual = date('Y-m-d H:i:s');
        $sql = "UPDATE tbl_produtos SET excluido_em = :atual WHERE id_produto = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id',    $id_produto, PDO::PARAM_INT);
        $stmt->bindParam(':atual', $dataAtual);

        try {
            return $stmt->execute();
        } catch (Exception $e) {
            error_log("ERRO ao excluir produto #{$id_produto}: " . $e->getMessage());
            return false;
        }
    }

    public function ativarProduto(int $id_produto): bool
    {
        $sql = "UPDATE tbl_produtos SET excluido_em = NULL WHERE id_produto = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id_produto, PDO::PARAM_INT);

        try {
            return $stmt->execute();
        } catch (Exception $e) {
            error_log("ERRO ao ativar produto #{$id_produto}: " . $e->getMessage());
            return false;
        }
    }

    // =========================================================
    // LEITURA (READ)
    // =========================================================

    public function buscarProdutos(): array
    {
        $sql = "SELECT * FROM tbl_produtos
                WHERE excluido_em IS NULL
                ORDER BY id_produto DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($dados as &$d) {
            $d['foto_produto'] = self::corrigirCaminhoImagem($d['foto_produto'] ?? null);
        }
        return $dados;
    }

    public function buscarProdutoPorID(int $id_produto): array|false
    {
        $sql = "SELECT * FROM tbl_produtos WHERE id_produto = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id_produto, PDO::PARAM_INT);
        $stmt->execute();
        $produto = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($produto) {
            $produto['foto_produto'] = self::corrigirCaminhoImagem($produto['foto_produto'] ?? null);
        }
        return $produto;
    }

    public function buscarProdutosPorCategoria(string $categoria): array
    {
        $sql = "SELECT * FROM tbl_produtos
                WHERE categoria_produto = :categoria AND excluido_em IS NULL
                ORDER BY nome_produto ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':categoria', $categoria);
        $stmt->execute();
        $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($dados as &$d) {
            $d['foto_produto'] = self::corrigirCaminhoImagem($d['foto_produto'] ?? null);
        }
        return $dados;
    }

    public function pesquisarProdutosSimples(string $termo): array
    {
        $like = "%{$termo}%";
        $sql = "SELECT id_produto, nome_produto, preco_produto, estoque_produto
                FROM tbl_produtos
                WHERE nome_produto LIKE :termo AND excluido_em IS NULL
                LIMIT 10";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':termo', $like);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // =========================================================
    // PAGINAÇÃO
    // =========================================================

    public function paginacao(int $pagina = 1, int $por_pagina = 10, ?string $categoria = null): array
    {
        $where  = "excluido_em IS NULL";
        $params = [];

        if ($categoria) {
            $where .= " AND categoria_produto = :categoria";
            $params[':categoria'] = $categoria;
        }

        // Total
        $totalStmt = $this->db->prepare("SELECT COUNT(*) FROM tbl_produtos WHERE {$where}");
        $totalStmt->execute($params);
        $total = (int) $totalStmt->fetchColumn();

        // Dados paginados
        $offset = ($pagina - 1) * $por_pagina;
        $sql = "SELECT * FROM tbl_produtos
                WHERE {$where}
                ORDER BY id_produto DESC
                LIMIT :limit OFFSET :offset";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limit',  $por_pagina, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset,     PDO::PARAM_INT);
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }
        $stmt->execute();
        $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($dados as &$d) {
            $d['foto_produto'] = self::corrigirCaminhoImagem($d['foto_produto'] ?? null);
        }

        $lastPage = (int) ceil($total / $por_pagina);

        return [
            'data'         => $dados,
            'total'        => $total,
            'por_pagina'   => $por_pagina,
            'pagina_atual' => $pagina,
            'ultima_pagina'=> $lastPage,
            'de'           => $total > 0 ? $offset + 1 : 0,
            'para'         => $offset + count($dados),
        ];
    }

    // =========================================================
    // CONTADORES (STATS)
    // =========================================================

    public function totalDeProdutos(): int
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM tbl_produtos");
        $stmt->execute();
        return (int) $stmt->fetchColumn();
    }

    public function totalDeProdutosAtivos(): int
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM tbl_produtos WHERE excluido_em IS NULL");
        $stmt->execute();
        return (int) $stmt->fetchColumn();
    }

    public function totalDeProdutosInativos(): int
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM tbl_produtos WHERE excluido_em IS NOT NULL");
        $stmt->execute();
        return (int) $stmt->fetchColumn();
    }

    public function totalDeProdutosSemEstoque(): int
    {
        $stmt = $this->db->prepare(
            "SELECT COUNT(*) FROM tbl_produtos WHERE estoque_produto = 0 AND excluido_em IS NULL"
        );
        $stmt->execute();
        return (int) $stmt->fetchColumn();
    }

    public function categorias(): array
    {
        $stmt = $this->db->prepare(
            "SELECT DISTINCT categoria_produto FROM tbl_produtos
             WHERE categoria_produto IS NOT NULL AND excluido_em IS NULL
             ORDER BY categoria_produto ASC"
        );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    // =========================================================
    // HELPER — NORMALIZA CAMINHO DA IMAGEM
    // =========================================================

    public static function corrigirCaminhoImagem(?string $foto): string
    {
        if (empty($foto)) {
            return '/img/produto-placeholder.webp';
        }

        // URL completa: retorna como está
        if (filter_var($foto, FILTER_VALIDATE_URL)) {
            return $foto;
        }

        // Já tem caminho base correto
        if (strpos($foto, '/backend/uploads/') !== false) {
            return $foto;
        }

        $caminhoLimpo = ltrim($foto, '/');

        if (strpos($caminhoLimpo, 'uploads/') === 0) {
            return '/backend/' . $caminhoLimpo;
        }

        return '/backend/uploads/' . $caminhoLimpo;
    }
}