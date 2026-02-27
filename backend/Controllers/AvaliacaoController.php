<?php
namespace Ovos\Ebenezer\Controllers;

use Ovos\Ebenezer\Models\Avaliacao;
use Ovos\Ebenezer\Database\Database;
use Ovos\Ebenezer\Core\View;
use Ovos\Ebenezer\Core\Redirect;

class AvaliacaoController {
    public $avaliacao;
    public $db;

    public function __construct() {
        $this->db = Database::getInstance();
        $this->avaliacao = new Avaliacao($this->db);
    }

    // index
    public function index() {
        $resultado = $this->avaliacao->buscarAvaliacao();
        var_dump($resultado);
    }

    public function viewListarAvaliacao() {
        $dados = $this->avaliacao->buscarAvaliacao();
        $total_avaliacao = $this->avaliacao->totalDeAvaliacao();
        $total_inativos = $this->avaliacao->totalDeAvaliacaoInativos();
        $total_ativos = $this->avaliacao->totalDeAvaliacaoAtivos();

        View::render("avaliacao/index", [
            "avaliacao"      => $dados,
            "total_avaliacao" => $total_avaliacao[0],
            "total_inativos" => $total_inativos[0],
            "total_ativos"   => $total_ativos[0]
        ]);
    }

    public function viewCriarAvaliacao() {
        View::render("avaliacao/create", []);
    }

    public function viewEditarAvaliacao($id_avaliacao) {
        $dados = $this->avaliacao->buscarAvaliacaoPorID($id_avaliacao);
        View::render("avaliacao/edit", ["avaliacao" => $dados]);
    }

    public function viewExcluirAvaliacao($id_avaliacao) {
        View::render("avaliacao/delete", ["id_avaliacao" => $id_avaliacao]);
    }

    public function criarAvaliacao() {
        $id_usuario            = (int)$_POST['id_usuario'];
        $id_pedidos            = (int)$_POST['id_pedidos'];
        $nota_avaliacao        = $_POST['nota_avaliacao'];
        $comentario_avaliacao  = $_POST['comentario_avaliacao'];
        $data_avaliacao        = $_POST['data_avaliacao'];
        $status_avaliacao      = $_POST['status_avaliacao'];

        $resultado = $this->avaliacao->inserirAvaliacao(
            $id_usuario,
            $id_pedidos,
            $nota_avaliacao,
            $comentario_avaliacao,
            $data_avaliacao,
            $status_avaliacao
        );

        if ($resultado) {
            Redirect::redirecionarComMensagem("/avaliacao/listar", "success", "Avaliação criada com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("/avaliacao/criar", "error", "Erro ao criar avaliação.");
        }
    }

    public function atualizarAvaliacao() {
        $id_avaliacao          = (int)$_POST['id_avaliacao'];
        $id_usuario            = (int)$_POST['id_usuario'];
        $id_pedidos            = (int)$_POST['id_pedidos'];
        $nota_avaliacao        = $_POST['nota_avaliacao'];
        $comentario_avaliacao  = $_POST['comentario_avaliacao'];
        $data_avaliacao        = $_POST['data_avaliacao'];
        $status_avaliacao      = $_POST['status_avaliacao'];

        if ($this->avaliacao->atualizar(
            $id_avaliacao,
            $id_usuario,
            $id_pedidos,
            $nota_avaliacao,
            $comentario_avaliacao,
            $data_avaliacao,
            $status_avaliacao
        )) {
            Redirect::redirecionarComMensagem("/avaliacao/listar", "success", "Avaliação atualizada com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("/avaliacao/editar/" . $id_avaliacao, "error", "Erro ao atualizar avaliação.");
        }
    }

    public function excluirAvaliacao() {
        $id_avaliacao = (int)$_POST['id_avaliacao'];

        if ($this->avaliacao->excluirAvaliacao($id_avaliacao)) {
            Redirect::redirecionarComMensagem("/avaliacao/listar", "success", "Avaliação excluída com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("/avaliacao/listar", "error", "Erro ao excluir avaliação.");
        }
    }

    public function ativarAvaliacao() {
        $id_avaliacao = (int)$_POST['id_avaliacao'];

        if ($this->avaliacao->ativarAvaliacao($id_avaliacao)) {
            Redirect::redirecionarComMensagem("/avaliacao/listar", "success", "Avaliação ativada com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("/avaliacao/listar", "error", "Erro ao ativar avaliação.");
        }
    }
}