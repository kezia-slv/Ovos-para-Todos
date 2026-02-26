<?php

namespace Ovos\Ebenezer\Controllers;

use Ovos\Ebenezer\Models\Pedidos;
use Ovos\Ebenezer\Database\Database;
use Ovos\Ebenezer\Core\View;
use Ovos\Ebenezer\Core\Redirect;

class PedidosController {
    public $pedidos;
    public $db;

    public function __construct() {
        $this->db = Database::getInstance();
        $this->pedidos = new Pedidos($this->db);
    }

    // index
    public function index() {
        $resultado = $this->pedidos->buscarPedidos();
        var_dump($resultado);
    }

    public function viewListarPedidos() {
        $dados           = $this->pedidos->buscarPedidos();
        $total_pedidos   = $this->pedidos->totalDePedidos();
        $total_inativos  = $this->pedidos->totalDePedidosInativos();
        $total_ativos    = $this->pedidos->totalDePedidosAtivos();

        View::render("pedidos/index", [
            "pedidos"        => $dados,
            "total_pedidos"  => $total_pedidos[0],
            "total_inativos" => $total_inativos[0],
            "total_ativos"   => $total_ativos[0]
        ]);
    }

    public function viewCriarPedido() {
        View::render("pedidos/create", []);
    }

    public function viewEditarPedido($id_pedido) {
        $dados = $this->pedidos->buscarPedidosPorID($id_pedido);
        View::render("pedidos/edit", ["pedido" => $dados]);
    }

    public function viewExcluirPedido($id_pedido) {
        View::render("pedidos/delete", ["id_pedido" => $id_pedido]);
    }

    public function salvarPedido() {
        $id_endereco      = (int)$_POST['id_endereco'];
        $id_usuario       = (int)$_POST['id_usuario'];
        $data_pedido      = $_POST['data_pedido'];
        $status_pedido    = $_POST['status_pedido'];
        $total_pedido     = $_POST['total_pedido'];
        $forma_pagamento  = $_POST['forma_pagamento'];
        $status_pagamento = $_POST['status_pagamento'];
        $observacoes      = $_POST['observacoes'];

        $resultado = $this->pedidos->inserirPedido(
            $id_endereco,
            $id_usuario,
            $data_pedido,
            $status_pedido,
            $total_pedido,
            $forma_pagamento,
            $status_pagamento,
            $observacoes
        );

        if ($resultado) {
            Redirect::redirecionarComMensagem("/pedidos/listar", "success", "Pedido criado com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("/pedidos/criar", "error", "Erro ao criar pedido.");
        }
    }

    public function atualizarPedido() {
        $id_pedido        = (int)$_POST['id_pedidos'];
        $id_endereco      = (int)$_POST['id_endereco'];
        $id_usuario       = (int)$_POST['id_usuario'];
        $data_pedido      = $_POST['data_pedido'];
        $status_pedido    = $_POST['status_pedido'];
        $total_pedido     = $_POST['total_pedido'];
        $forma_pagamento  = $_POST['forma_pagamento'];
        $status_pagamento = $_POST['status_pagamento'];
        $observacoes      = $_POST['observacoes'];

        if ($this->pedidos->atualizarPedidos(
            $id_pedido,
            $id_endereco,
            $id_usuario,
            $data_pedido,
            $status_pedido,
            $total_pedido,
            $forma_pagamento,
            $status_pagamento,
            $observacoes
        )) {
            Redirect::redirecionarComMensagem("/pedidos/listar", "success", "Pedido atualizado com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("/pedidos/editar/" . $id_pedido, "error", "Erro ao atualizar pedido.");
        }
    }

    public function excluirPedido() {
        $id_pedido = (int)$_POST['id_pedidos'];

        if ($this->pedidos->excluirPedidos($id_pedido)) {
            Redirect::redirecionarComMensagem("/pedidos/listar", "success", "Pedido excluído com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("/pedidos/listar", "error", "Erro ao excluir pedido.");
        }
    }

    public function ativarPedido() {
        $id_pedido = (int)$_POST['id_pedidos'];

        if ($this->pedidos->ativarPedidos($id_pedido)) {
            Redirect::redirecionarComMensagem("/pedidos/listar", "success", "Pedido ativado com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("/pedidos/listar", "error", "Erro ao ativar pedido.");
        }
    }

    public function viewPedidosPorUsuario($id_usuario) {
        $dados = $this->pedidos->buscarPedidosPorIDUsuario($id_usuario);
        View::render("pedidos/por-usuario", ["pedidos" => $dados]);
    }

    public function viewPedidosPorEndereco($id_endereco) {
        $dados = $this->pedidos->buscarPedidosPorEndereco($id_endereco);
        View::render("pedidos/por-endereco", ["pedidos" => $dados]);
    }
}