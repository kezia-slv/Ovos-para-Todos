<?php

namespace Ovos\Ebenezer\Controllers;

use Ovos\Ebenezer\Models\TipoOvo;
use Ovos\Ebenezer\Database\Database;
use Ovos\Ebenezer\Core\View;
use Ovos\Ebenezer\Core\Redirect;

class TipoOvoController {
    public $tipoOvo;
    public $db;

    public function __construct() {
        $this->db = Database::getInstance();
        $this->tipoOvo = new TipoOvo($this->db);
    }

    // index
    public function index() {
        $resultado = $this->tipoOvo->buscarTipoOvo();
        var_dump($resultado);
    }

    public function viewListarTipoOvo() {
        $dados          = $this->tipoOvo->buscarTipoOvo();
        $total          = $this->tipoOvo->totalDeTipoOvo();
        $total_inativos = $this->tipoOvo->totalDeTipoOvoInativos();
        $total_ativos   = $this->tipoOvo->totalDeTipoOvoAtivos();

        View::render("tipo-ovo/index", [
            "tipos"          => $dados,
            "total"          => $total[0],
            "total_inativos" => $total_inativos[0],
            "total_ativos"   => $total_ativos[0]
        ]);
    }

    public function viewCriarTipoOvo() {
        View::render("tipo-ovo/create", []);
    }

    public function viewEditarTipoOvo($id_tipo_ovo) {
        $dados = $this->tipoOvo->buscarTipoOvoPorID($id_tipo_ovo);
        View::render("tipo-ovo/edit", ["tipo" => $dados]);
    }

    public function viewExcluirTipoOvo($id_tipo_ovo) {
        View::render("tipo-ovo/delete", ["id_tipo_ovo" => $id_tipo_ovo]);
    }

    public function salvarTipoOvo() {
        $nome = $_POST['nome_tipo_ovo'];

        $resultado = $this->tipoOvo->inserirTipoOvo($nome);

        if ($resultado) {
            Redirect::redirecionarComMensagem("/tipo-ovo/listar", "success", "Tipo de ovo cadastrado com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("/tipo-ovo/criar", "error", "Erro ao cadastrar tipo de ovo.");
        }
    }

    public function atualizarTipoOvo() {
        $id_tipo_ovo   = (int)$_POST['id_tipo_ovo'];
        $nome          = $_POST['nome_tipo_ovo'];

        if ($this->tipoOvo->atualizar($id_tipo_ovo, $nome)) {
            Redirect::redirecionarComMensagem("/tipo-ovo/listar", "success", "Tipo de ovo atualizado com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("/tipo-ovo/editar/" . $id_tipo_ovo, "error", "Erro ao atualizar tipo de ovo.");
        }
    }

    public function excluirTipoOvo() {
        $id_tipo_ovo = (int)$_POST['id_tipo_ovo'];

        if ($this->tipoOvo->excluirTipoOvo($id_tipo_ovo)) {
            Redirect::redirecionarComMensagem("/tipo-ovo/listar", "success", "Tipo de ovo excluído com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("/tipo-ovo/listar", "error", "Erro ao excluir tipo de ovo.");
        }
    }

    public function ativarTipoOvo() {
        $id_tipo_ovo = (int)$_POST['id_tipo_ovo'];

        if ($this->tipoOvo->ativarTipoOvo($id_tipo_ovo)) {
            Redirect::redirecionarComMensagem("/tipo-ovo/listar", "success", "Tipo de ovo ativado com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("/tipo-ovo/listar", "error", "Erro ao ativar tipo de ovo.");
        }
    }
}