<?php

namespace Ovos\Ebenezer\Controllers;

use Ovos\Ebenezer\Models\Estoque;
use Ovos\Ebenezer\Database\Database;
use Ovos\Ebenezer\Core\View;
use Ovos\Ebenezer\Core\Redirect;

class EstoqueController {
    public $estoque;
    public $db;

    public function __construct() {
        $this->db = Database::getInstance();
        $this->estoque = new Estoque($this->db);
    }

    // index
    public function index() {
        $resultado = $this->estoque->buscarEstoque();
        var_dump($resultado);
    }

    public function viewListarEstoque() {
        $dados          = $this->estoque->buscarEstoque();
        $total_estoque  = $this->estoque->totalDeEstoque();
        $total_inativos = $this->estoque->totalDeEstoqueInativos();
        $total_ativos   = $this->estoque->totalDeEstoqueAtivos();

        View::render("estoque/index", [
            "estoque"        => $dados,
            "total_estoque"  => $total_estoque[0],
            "total_inativos" => $total_inativos[0],
            "total_ativos"   => $total_ativos[0]
        ]);
    }

    public function viewCriarEstoque() {
        View::render("estoque/create", []);
    }

    public function viewEditarEstoque($id_estoque) {
        $dados = $this->estoque->buscarEstoquePorID($id_estoque);
        View::render("estoque/edit", ["estoque" => $dados]);
    }

    public function viewExcluirEstoque($id_estoque) {
        View::render("estoque/delete", ["id_estoque" => $id_estoque]);
    }

    public function salvarEstoque() {
        $id_produtos             = (int)$_POST['id_produtos'];
        $quantidade_estoque      = (int)$_POST['quantidade_estoque'];
        $quantidade_min_reposicao = (int)$_POST['quantidade_min_reposicao'];

        $resultado = $this->estoque->inserirEstoque(
            $id_produtos,
            $quantidade_estoque,
            $quantidade_min_reposicao
        );

        if ($resultado) {
            Redirect::redirecionarComMensagem("/estoque/listar", "success", "Estoque inserido com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("/estoque/criar", "error", "Erro ao inserir estoque.");
        }
    }

    public function atualizarEstoque() {
        $id_estoque              = (int)$_POST['id_estoque'];
        $id_produtos             = (int)$_POST['id_produtos'];
        $quantidade_estoque      = (int)$_POST['quantidade_estoque'];
        $quantidade_min_reposicao = (int)$_POST['quantidade_min_reposicao'];

        if ($this->estoque->atualizar($id_estoque, $id_produtos, $quantidade_estoque, $quantidade_min_reposicao)) {
            Redirect::redirecionarComMensagem("/estoque/listar", "success", "Estoque atualizado com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("/estoque/editar/" . $id_estoque, "error", "Erro ao atualizar estoque.");
        }
    }

    public function excluirEstoque() {
        $id_estoque = (int)$_POST['id_estoque'];

        if ($this->estoque->excluirEstoque($id_estoque)) {
            Redirect::redirecionarComMensagem("/estoque/listar", "success", "Estoque excluído com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("/estoque/listar", "error", "Erro ao excluir estoque.");
        }
    }

    public function ativarEstoque() {
        $id_estoque = (int)$_POST['id_estoque'];

        if ($this->estoque->ativarEstoque($id_estoque)) {
            Redirect::redirecionarComMensagem("/estoque/listar", "success", "Estoque ativado com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("/estoque/listar", "error", "Erro ao ativar estoque.");
        }
    }

    public function viewEstoquePorProduto($id_produtos) {
        $dados = $this->estoque->buscarEstoquePorIDProduto($id_produtos);
        View::render("estoque/por-produto", ["estoque" => $dados]);
    }

    public function viewEstoquePorQuantidade($quantidade_estoque) {
        $dados = $this->estoque->buscarEstoquePorQuantidade($quantidade_estoque);
        View::render("estoque/por-quantidade", ["estoque" => $dados]);
    }
}