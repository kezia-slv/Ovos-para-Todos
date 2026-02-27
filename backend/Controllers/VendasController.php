<?php

namespace Ovos\Ebenezer\Controllers;

use Ovos\Ebenezer\Models\Vendas;
use Ovos\Ebenezer\Database\Database;
use Ovos\Ebenezer\Core\View;
use Ovos\Ebenezer\Core\Redirect;

class VendasController {
    public $vendas;
    public $db;

    public function __construct() {
        $this->db = Database::getInstance();
        $this->vendas = new Vendas($this->db);
    }

    // index
    public function index() {
        $resultado = $this->vendas->buscarVendas();
        var_dump($resultado);
    }

    public function viewListarVendas() {
        $dados          = $this->vendas->buscarVendas();
        $total          = $this->vendas->totalDeVendas();
        $total_inativos = $this->vendas->totalDeVendasInativas();
        $total_ativos   = $this->vendas->totalDeVendasAtivas();

        View::render("vendas/index", [
            "vendas"         => $dados,
            "total"          => $total[0],
            "total_inativos" => $total_inativos[0],
            "total_ativos"   => $total_ativos[0]
        ]);
    }

    public function viewCriarVenda() {
        View::render("vendas/create", []);
    }

    public function viewEditarVenda($id_vendas) {
        $dados = $this->vendas->buscarVendasPorID($id_vendas);
        View::render("vendas/edit", ["venda" => $dados]);
    }

    public function viewExcluirVenda($id_vendas) {
        View::render("vendas/delete", ["id_vendas" => $id_vendas]);
    }

    public function salvarVenda() {
        $id_usuario      = (int)$_POST['id_usuario'];
        $id_pedidos      = (int)$_POST['id_pedidos'];
        $valor_total     = $_POST['valor_total'];
        $forma_pagamento = $_POST['forma_pagamento'];

        $resultado = $this->vendas->inserirVendas(
            $id_usuario,
            $id_pedidos,
            $valor_total,
            $forma_pagamento
        );

        if ($resultado) {
            Redirect::redirecionarComMensagem("/vendas/listar", "success", "Venda registrada com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("/vendas/criar", "error", "Erro ao registrar venda.");
        }
    }

    public function atualizarVenda() {
        $id_vendas       = (int)$_POST['id_vendas'];
        $id_usuario      = (int)$_POST['id_usuario'];
        $id_pedidos      = (int)$_POST['id_pedidos'];
        $valor_total     = $_POST['valor_total'];
        $forma_pagamento = $_POST['forma_pagamento'];

        if ($this->vendas->atualizar($id_vendas, $id_usuario, $id_pedidos, $valor_total, $forma_pagamento)) {
            Redirect::redirecionarComMensagem("/vendas/listar", "success", "Venda atualizada com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("/vendas/editar/" . $id_vendas, "error", "Erro ao atualizar venda.");
        }
    }

    public function excluirVenda() {
        $id_vendas = (int)$_POST['id_vendas'];

        if ($this->vendas->excluirVendas($id_vendas)) {
            Redirect::redirecionarComMensagem("/vendas/listar", "success", "Venda excluída com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("/vendas/listar", "error", "Erro ao excluir venda.");
        }
    }

    public function ativarVenda() {
        $id_vendas = (int)$_POST['id_vendas'];

        if ($this->vendas->ativarVendas($id_vendas)) {
            Redirect::redirecionarComMensagem("/vendas/listar", "success", "Venda ativada com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("/vendas/listar", "error", "Erro ao ativar venda.");
        }
    }

    public function viewVendasPorUsuario($id_usuario) {
        $dados = $this->vendas->buscarVendasPorIDUsuario($id_usuario);
        View::render("vendas/por-usuario", ["venda" => $dados]);
    }

    public function viewVendasPorPedido($id_pedidos) {
        $dados = $this->vendas->buscarVendasPorIDPedidos($id_pedidos);
        View::render("vendas/por-pedido", ["venda" => $dados]);
    }
}