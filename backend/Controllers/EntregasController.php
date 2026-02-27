<?php

namespace Ovos\Ebenezer\Controllers;

use Ovos\Ebenezer\Models\Entregas;
use Ovos\Ebenezer\Database\Database;
use Ovos\Ebenezer\Core\View;
use Ovos\Ebenezer\Core\Redirect;

class EntregasController {
    public $entregas;
    public $db;

    public function __construct() {
        $this->db = Database::getInstance();
        $this->entregas = new Entregas($this->db);
    }

    // index
    public function index() {
        $resultado = $this->entregas->buscarEntregas();
        var_dump($resultado);
    }

    public function viewListarEntregas() {
        $dados          = $this->entregas->buscarEntregas();
        $total          = $this->entregas->totalDeEntregas();
        $total_inativos = $this->entregas->totalDeEntregasInativas();
        $total_ativos   = $this->entregas->totalDeEntregasAtivas();

        View::render("entregas/index", [
            "entregas"       => $dados,
            "total"          => $total[0],
            "total_inativos" => $total_inativos[0],
            "total_ativos"   => $total_ativos[0]
        ]);
    }

    public function viewCriarEntrega() {
        View::render("entregas/create", []);
    }

    public function viewEditarEntrega($id_entrega) {
        $dados = $this->entregas->buscarEntregasPorID($id_entrega);
        View::render("entregas/edit", ["entrega" => $dados]);
    }

    public function viewExcluirEntrega($id_entrega) {
        View::render("entregas/delete", ["id_entrega" => $id_entrega]);
    }

    public function salvarEntrega() {
        $id_usuario      = (int)$_POST['id_usuario'];
        $id_pedidos      = (int)$_POST['id_pedidos'];
        $status_entrega  = $_POST['status_entrega'];
        $previsao        = $_POST['previsao_entrega'];
        $entregue_em     = !empty($_POST['entregue_em']) ? $_POST['entregue_em'] : null;

        // ⚠️ Corrigir o nome do método na model de inserirEndereco para inserirEntrega
        $resultado = $this->entregas->inserirEntregas(
            $id_usuario,
            $id_pedidos,
            $status_entrega,
            $previsao,
            $entregue_em
        );

        if ($resultado) {
            Redirect::redirecionarComMensagem("/entregas/listar", "success", "Entrega cadastrada com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("/entregas/criar", "error", "Erro ao cadastrar entrega.");
        }
    }

    public function atualizarEntrega() {
        $id_entrega     = (int)$_POST['id_entrega'];
        $id_usuario     = (int)$_POST['id_usuario'];
        $id_pedidos     = (int)$_POST['id_pedidos'];
        $status_entrega = $_POST['status_entrega'];
        $previsao       = $_POST['previsao_entrega'];
        $entregue_em    = !empty($_POST['entregue_em']) ? $_POST['entregue_em'] : null;

        // ⚠️ Corrigir o método atualizar na model para usar tbl_entregas
        if ($this->entregas->atualizar($id_entrega, $id_usuario, $id_pedidos, $status_entrega, $previsao, $entregue_em)) {
            Redirect::redirecionarComMensagem("/entregas/listar", "success", "Entrega atualizada com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("/entregas/editar/" . $id_entrega, "error", "Erro ao atualizar entrega.");
        }
    }

    public function excluirEntrega() {
        $id_entrega = (int)$_POST['id_entrega'];

        // ⚠️ Corrigir o método excluirEndereco para excluirEntrega na model
        if ($this->entregas->excluirEntregas($id_entrega)) {
            Redirect::redirecionarComMensagem("/entregas/listar", "success", "Entrega excluída com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("/entregas/listar", "error", "Erro ao excluir entrega.");
        }
    }

    public function ativarEntrega() {
        $id_entrega = (int)$_POST['id_entrega'];

        // ⚠️ Corrigir o método ativarEndereco para ativarEntrega na model
        if ($this->entregas->ativarEntregas($id_entrega)) {
            Redirect::redirecionarComMensagem("/entregas/listar", "success", "Entrega ativada com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("/entregas/listar", "error", "Erro ao ativar entrega.");
        }
    }

    // Filtros
    public function viewEntregasPorUsuario($id_usuario) {
        $dados = $this->entregas->buscarEntregasPorIDUsuario($id_usuario);
        View::render("entregas/por-usuario", ["entrega" => $dados]);
    }

    public function viewEntregasPorPedido($id_pedidos) {
        $dados = $this->entregas->buscarEntregasPorIDPedidos($id_pedidos);
        View::render("entregas/por-pedido", ["entrega" => $dados]);
    }

    public function viewEntregasPorStatus($status_entrega) {
        $dados = $this->entregas->buscarEntregasPorStatus($status_entrega);
        View::render("entregas/por-status", ["entregas" => $dados, "status" => $status_entrega]);
    }

    public function viewEntregasPorPrevisao($previsao_entrega) {
        $dados = $this->entregas->buscarEntregasPorPrevisao($previsao_entrega);
        View::render("entregas/por-previsao", ["entregas" => $dados, "previsao" => $previsao_entrega]);
    }

    public function viewEntregasPorEntregueEm($entregue_em) {
        $dados = $this->entregas->buscarEntregasPorEntregueEm($entregue_em);
        View::render("entregas/por-entregue-em", ["entregas" => $dados, "entregue_em" => $entregue_em]);
    }
}