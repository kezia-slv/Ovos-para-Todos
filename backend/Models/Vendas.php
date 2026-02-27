<?php

namespace Ovos\Ebenezer\Models;

use PDO;

class Vendas {
    private $db;
    private $id_vendas;
    private $id_usuario;
    private $id_pedidos;
    private $valor_total;
    private $forma_pagamento;
    private $criado_em;
    private $atualizado_em;
    private $excluido_em;

    public function __construct($db) {
        $this->db = $db;
    }

    function buscarVendas(){
        $sql = "SELECT * FROM tbl_vendas";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function buscarVendasPorID($id_vendas) {
        $sql = "SELECT * FROM tbl_vendas WHERE id_vendas = :id_vendas";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_vendas', $id_vendas, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function buscarVendasPorIDUsuario($id_usuario) {
        $sql = "SELECT * FROM tbl_vendas WHERE id_usuario = :id_usuario";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function buscarVendasPorIDPedidos($id_pedidos) {
        $sql = "SELECT * FROM tbl_vendas WHERE id_pedidos = :id_pedidos";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_pedidos', $id_pedidos, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    function totalDeVendas(){
        $sql = "SELECT count(*) as total FROM tbl_vendas";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    function totalDeVendasInativas(){
        $sql = "SELECT count(*) as total_inativos FROM tbl_vendas where excluido_em is NOT NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    function totalDeVendasAtivas(){
        $sql = "SELECT count(*) as total_ativos FROM tbl_vendas where excluido_em is NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }


    // metodo de buscar todos usuario por email read
    
    function inserirVendas($id_usuario, $id_pedidos, $valor_total, $forma_pagamento) {
        $sql = "INSERT INTO tbl_vendas (id_usuario, id_pedidos, valor_total, forma_pagamento) 
                VALUES (:id_usuario, :id_pedidos, :valor_total, :forma_pagamento)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->bindParam(':id_pedidos', $id_pedidos, PDO::PARAM_INT);
        $stmt->bindParam(':valor_total', $valor_total);
        $stmt->bindParam(':forma_pagamento', $forma_pagamento);

        if($stmt->execute()){
            return $this->db->lastInsertId();
        }else{
            return false;
        }
    }

    function atualizar($id_vendas, $id_usuario, $id_pedidos, $valor_total, $forma_pagamento) {
        $sql = "UPDATE tbl_vendas 
                SET id_usuario = :id_usuario, id_pedidos = :id_pedidos, valor_total = :valor_total, forma_pagamento = :forma_pagamento
                WHERE id_vendas = :id_vendas";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_vendas', $id_vendas, PDO::PARAM_INT);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->bindParam(':id_pedidos', $id_pedidos, PDO::PARAM_INT);
        $stmt->bindParam(':valor_total', $valor_total);
        $stmt->bindParam(':forma_pagamento', $forma_pagamento);

        return $stmt->execute();
    }

    function excluirVendas($id_vendas){
        $dataatual = date('Y-m-d H:i:s');
        $sql = "UPDATE tbl_vendas SET
         excluido_em = :atual
         WHERE id_vendas = :id_vendas";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_vendas', $id_vendas, PDO::PARAM_INT);
        $stmt->bindParam(':atual', $dataatual);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    function ativarVendas($id_vendas){
        $sql = "UPDATE tbl_vendas SET
         excluido_em = NULL
         WHERE id_vendas = :id_vendas";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_vendas', $id_vendas, PDO::PARAM_INT);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
    
}