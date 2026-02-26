<?php

namespace Ovos\Ebenezer\Controllers;

use Ovos\Ebenezer\Models\Produto;
use Ovos\Ebenezer\Database\Database;
use Ovos\Ebenezer\Core\View;
use Ovos\Ebenezer\Core\Redirect;
use Ovos\Ebenezer\Core\FileManager;
use Ovos\Ebenezer\Controllers\Admin\AdminController;

class ProdutoController extends AdminController
{
    private $db;
    private $produto;
    private $fileManager;

    public function __construct()
    {
        parent::__construct();
        $this->db          = Database::getInstance();
        $this->produto     = new Produto($this->db);
        $this->fileManager = new FileManager('uploads');
    }

    // =========================================================
    // VIEWS (GET)
    // =========================================================

    public function viewListarProdutos($pagina = 1)
    {
        if (empty($pagina) || $pagina <= 0) $pagina = 1;

        $termoPesquisa = $_GET['search'] ?? null;

        if ($termoPesquisa) {
            // Pesquisa simples: retorna array flat, envolve no formato de paginação
            $resultados = $this->produto->pesquisarProdutosSimples($termoPesquisa);
            $dados = [
                'data'          => $resultados,
                'total'         => count($resultados),
                'por_pagina'    => count($resultados),
                'pagina_atual'  => 1,
                'ultima_pagina' => 1,
                'de'            => 1,
                'para'          => count($resultados),
            ];
        } else {
            $dados = $this->produto->paginacao($pagina, 10);
        }

        View::render("produto/index", [
            "produtos"         => $dados['data'],
            "total_produtos"   => $this->produto->totalDeProdutos(),
            "total_ativos"     => $this->produto->totalDeProdutosAtivos(),
            "total_inativos"   => $this->produto->totalDeProdutosInativos(),
            "sem_estoque"      => $this->produto->totalDeProdutosSemEstoque(),
            "paginacao"        => $dados,
            "termo_pesquisa"   => $termoPesquisa,
        ]);
    }

    public function viewCriarProduto()
    {
        View::render("produto/create", [
            "categorias" => $this->produto->categorias(),
        ]);
    }

    public function viewEditarProduto(int $id)
    {
        $produto = $this->produto->buscarProdutoPorID($id);
        if (!$produto) {
            Redirect::redirecionarComMensagem("/produto/listar", "error", "Produto não encontrado.");
            return;
        }

        View::render("produto/edit", [
            "produto"    => $produto,
            "categorias" => $this->produto->categorias(),
        ]);
    }

    public function viewExcluirProduto(int $id)
    {
        $produto = $this->produto->buscarProdutoPorID($id);
        if (!$produto) {
            Redirect::redirecionarComMensagem("/produto/listar", "error", "Produto não encontrado.");
            return;
        }

        View::render("produto/delete", ["produto" => $produto]);
    }

    // =========================================================
    // PROCESSAMENTO (POST)
    // =========================================================

    public function salvarProduto()
    {
        $erros = $this->validarEntradas($_POST);
        if (!empty($erros)) {
            Redirect::redirecionarComMensagem("/produto/criar", "error", implode("<br>", $erros));
        }

        $fotoPath = $this->processarUpload($_FILES['foto_produto'] ?? null);

        $dados = [
            'nome_produto'      => $_POST['nome_produto'],
            'descricao_produto' => $_POST['descricao_produto']  ?? null,
            'preco_produto'     => (float) ($_POST['preco_produto'] ?? 0),
            'categoria_produto' => $_POST['categoria_produto']  ?? null,
            'tipo_produto'      => $_POST['tipo_produto']       ?? null,
            'unidade_produto'   => $_POST['unidade_produto']    ?? null,
            'estoque_produto'   => (int)   ($_POST['estoque_produto'] ?? 0),
            'foto_produto'      => $fotoPath,
        ];

        $id = $this->produto->inserirProduto($dados);

        if ($id) {
            error_log("Produto ID {$id} criado.");
            Redirect::redirecionarComMensagem("/produto/listar", "success", "Produto #{$id} cadastrado!");
        } else {
            if ($fotoPath) $this->fileManager->delete($this->caminhoRelativo($fotoPath));
            Redirect::redirecionarComMensagem("/produto/criar", "error", "Erro ao cadastrar produto.");
        }
    }

    public function atualizarProduto()
    {
        $id = (int) ($_POST['id_produto'] ?? 0);
        if ($id <= 0) {
            Redirect::redirecionarComMensagem("/produto/listar", "error", "ID inválido.");
            return;
        }

        $erros = $this->validarEntradas($_POST);
        if (!empty($erros)) {
            Redirect::redirecionarComMensagem("/produto/editar/{$id}", "error", implode("<br>", $erros));
        }

        $fotoAtual = $_POST['foto_atual'] ?? null;
        $fotoPath  = $fotoAtual;

        // Novo upload enviado
        if (!empty($_FILES['foto_produto']['name'])) {
            $novaFoto = $this->processarUpload($_FILES['foto_produto'] ?? null, "/produto/editar/{$id}");
            if ($novaFoto) {
                // Remove foto antiga
                if ($fotoAtual) {
                    $this->fileManager->delete($this->caminhoRelativo($fotoAtual));
                }
                $fotoPath = $novaFoto;
            }
        }

        $dados = [
            'nome_produto'      => $_POST['nome_produto'],
            'descricao_produto' => $_POST['descricao_produto']  ?? null,
            'preco_produto'     => (float) ($_POST['preco_produto'] ?? 0),
            'categoria_produto' => $_POST['categoria_produto']  ?? null,
            'tipo_produto'      => $_POST['tipo_produto']       ?? null,
            'unidade_produto'   => $_POST['unidade_produto']    ?? null,
            'estoque_produto'   => (int)   ($_POST['estoque_produto'] ?? 0),
            'foto_produto'      => $fotoPath,
        ];

        if ($this->produto->atualizarProduto($id, $dados)) {
            Redirect::redirecionarComMensagem("/produto/listar", "success", "Produto #{$id} atualizado!");
        } else {
            Redirect::redirecionarComMensagem("/produto/editar/{$id}", "error", "Erro ao atualizar produto.");
        }
    }

    public function deletarProduto()
    {
        $id = (int) ($_POST['id_produto'] ?? 0);
        if ($this->produto->excluirProduto($id)) {
            Redirect::redirecionarComMensagem("/produto/listar", "success", "Produto #{$id} desativado!");
        } else {
            Redirect::redirecionarComMensagem("/produto/listar", "error", "Erro ao desativar produto.");
        }
    }

    public function ativarProduto()
    {
        $id = (int) ($_POST['id_produto'] ?? 0);
        if ($this->produto->ativarProduto($id)) {
            Redirect::redirecionarComMensagem("/produto/listar", "success", "Produto #{$id} reativado!");
        } else {
            Redirect::redirecionarComMensagem("/produto/listar", "error", "Erro ao reativar produto.");
        }
    }

    // =========================================================
    // AJAX
    // =========================================================

    public function ajaxPesquisarProdutos()
    {
        $termo = $_GET['term'] ?? '';

        if (strlen($termo) < 2) {
            header('Content-Type: application/json');
            echo json_encode([]);
            exit;
        }

        $resultados = $this->produto->pesquisarProdutosSimples($termo);
        header('Content-Type: application/json');
        echo json_encode($resultados);
        exit;
    }

    // =========================================================
    // HELPERS PRIVADOS
    // =========================================================

    /**
     * Valida campos obrigatórios do produto.
     */
    private function validarEntradas(array $dados): array
    {
        $erros = [];

        if (empty($dados['nome_produto'])) {
            $erros[] = "Nome do produto é obrigatório.";
        }

        if (!isset($dados['preco_produto']) || $dados['preco_produto'] === '') {
            $erros[] = "Preço é obrigatório.";
        } elseif (!is_numeric($dados['preco_produto']) || (float) $dados['preco_produto'] < 0) {
            $erros[] = "Preço inválido.";
        }

        if (!isset($dados['estoque_produto']) || $dados['estoque_produto'] === '') {
            $erros[] = "Estoque é obrigatório.";
        } elseif (!ctype_digit((string) $dados['estoque_produto'])) {
            $erros[] = "Estoque deve ser um número inteiro.";
        }

        return $erros;
    }

    /**
     * Processa o upload da foto do produto.
     * Retorna o caminho relativo salvo ou null.
     */
    private function processarUpload(?array $file, string $redirecionarErroEm = '/produto/criar'): ?string
    {
        if (empty($file) || $file['error'] === UPLOAD_ERR_NO_FILE) {
            return null;
        }

        try {
            $caminhoRelativo = $this->fileManager->salvarArquivo(
                $file,
                'produtos',
                ['image/jpeg', 'image/png', 'image/webp'],
                2097152
            );
            return '/uploads/' . $caminhoRelativo;
        } catch (\Exception $e) {
            error_log("Erro no upload de produto: " . $e->getMessage());
            Redirect::redirecionarComMensagem($redirecionarErroEm, "error", $e->getMessage());
        }

        return null;
    }

    /**
     * Remove o prefixo '/uploads/' do caminho para usar no FileManager.
     */
    private function caminhoRelativo(string $caminho): string
    {
        return ltrim(str_replace('/uploads/', '', $caminho), '/');
    }
}