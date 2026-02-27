<?php

namespace Ovos\Ebenezer\Controllers;

use Ovos\Ebenezer\Models\Fornecedor;
use Ovos\Ebenezer\Database\Database;
use Ovos\Ebenezer\Core\View;
use Ovos\Ebenezer\Core\Redirect;

class FornecedorController {
    public $fornecedor;
    public $db;

    public function __construct() {
        $this->db = Database::getInstance();
        $this->fornecedor = new Fornecedor($this->db);
    }

    // index
    public function index() {
        $resultado = $this->fornecedor->buscarFornecedor();
        var_dump($resultado);
    }

    public function viewListarFornecedor() {
        $dados          = $this->fornecedor->buscarFornecedor();
        $total          = $this->fornecedor->totalDeFornecedor();
        $total_inativos = $this->fornecedor->totalDeFornecedorInativos();
        $total_ativos   = $this->fornecedor->totalDeFornecedorAtivos();

        View::render("fornecedor/index", [
            "fornecedor"     => $dados,
            "total"          => $total[0],
            "total_inativos" => $total_inativos[0],
            "total_ativos"   => $total_ativos[0]
        ]);
    }

    public function viewCriarFornecedor() {
        View::render("fornecedor/create", []);
    }

    public function viewEditarFornecedor($id_fornecedor) {
        $dados = $this->fornecedor->buscarFornecedorPorID($id_fornecedor);
        View::render("fornecedor/edit", ["fornecedor" => $dados]);
    }

    public function viewExcluirFornecedor($id_fornecedor) {
        View::render("fornecedor/delete", ["id_fornecedor" => $id_fornecedor]);
    }

    public function salvarFornecedor() {
        $nome     = $_POST['nome_fornecedor'];
        $cnpj     = $_POST['cnpj_fornecedor'];
        $telefone = $_POST['telefone_fornecedor'];
        $email    = $_POST['email_fornecedor'];
        $status   = $_POST['status_fornecedor'];

        $resultado = $this->fornecedor->inserirFornecedor(
            $nome,
            $cnpj,
            $telefone,
            $email,
            $status
        );

        if ($resultado) {
            Redirect::redirecionarComMensagem("/fornecedor/listar", "success", "Fornecedor cadastrado com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("/fornecedor/criar", "error", "Erro ao cadastrar fornecedor.");
        }
    }

    public function atualizarFornecedor() {
        $id_fornecedor = (int)$_POST['id_fornecedor'];
        $nome          = $_POST['nome_fornecedor'];
        $cnpj          = $_POST['cnpj_fornecedor'];
        $telefone      = $_POST['telefone_fornecedor'];
        $email         = $_POST['email_fornecedor'];
        $status        = $_POST['status_fornecedor'];

        if ($this->fornecedor->atualizar($id_fornecedor, $nome, $cnpj, $telefone, $email, $status)) {
            Redirect::redirecionarComMensagem("/fornecedor/listar", "success", "Fornecedor atualizado com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("/fornecedor/editar/" . $id_fornecedor, "error", "Erro ao atualizar fornecedor.");
        }
    }

    public function excluirFornecedor() {
        $id_fornecedor = (int)$_POST['id_fornecedor'];

        if ($this->fornecedor->excluirFornecedor($id_fornecedor)) {
            Redirect::redirecionarComMensagem("/fornecedor/listar", "success", "Fornecedor excluído com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("/fornecedor/listar", "error", "Erro ao excluir fornecedor.");
        }
    }

    public function ativarFornecedor() {
        $id_fornecedor = (int)$_POST['id_fornecedor'];

        if ($this->fornecedor->ativarFornecedor($id_fornecedor)) {
            Redirect::redirecionarComMensagem("/fornecedor/listar", "success", "Fornecedor ativado com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("/fornecedor/listar", "error", "Erro ao ativar fornecedor.");
        }
    }
}