<?php

namespace Ovos\Ebenezer\Models;

class Pedidos{
    private $db;
    private $id_pedidos;
    private $id_endereco;
    private $id_usuario;
    private $data_pedido;
    private $status_pedido;
    private $total_pedido;
    private $forma_pagamento;
    private $status_pagamento;
    private $observacoes;
    private $criado_em;
    private $atualizado_em;
    private $excluido_em;

    public function __construct($db) {
        $this->db = $db;
    }

    function buscarPedidos(){
        $sql = "SELECT * FROM tbl_pedidos";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function buscarPedidosPorID($id_pedidos) {
        $sql = "SELECT * FROM tbl_pedidos WHERE id_pedidos = :id_pedidos";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_pedidos', $id_pedidos, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function buscarPedidosPorIDUsuario($id_usuario) {
        $sql = "SELECT * FROM tbl_pedidos WHERE id_usuario = :id_usuario";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    
    function totalDePedidos(){
        $sql = "SELECT count(*) as total FROM tbl_pedidos";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    function totalDePedidosInativos(){
        $sql = "SELECT count(*) as total_inativos FROM tbl_pedidos where excluido_em is NOT NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    function totalDePedidosAtivos(){
        $sql = "SELECT count(*) as total_ativos FROM tbl_pedidos where excluido_em is NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }


    // metodo de buscar todos usuario por email read
    function buscarPedidosPorEndereco($id_endereco){
        $sql = "SELECT * FROM tbl_pedidos where id_endereco = :id_endereco";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_endereco', $id_endereco, PDO::PARAM_INT); 
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function inserirPedido($id_endereco, $id_usuario, $data_pedido, $status_pedido, $total_pedido, $forma_pagamento, $status_pagamento, $observacoes) {
        $sql = "INSERT INTO tbl_pedidos (id_endereco, id_usuario, data_pedido, status_pedido, total_pedido, forma_pagamento, status_pagamento, observacoes) 
                VALUES (:id_endereco, :id_usuario, :data_pedido, :status_pedido, :total_pedido, :forma_pagamento, :status_pagamento, :observacoes)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_endereco', $id_endereco, PDO::PARAM_INT);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->bindParam(':data_pedido', $data_pedido);
        $stmt->bindParam(':status_pedido', $status_pedido);
        $stmt->bindParam(':total_pedido', $total_pedido, PDO::PARAM_STR);
        $stmt->bindParam(':forma_pagamento', $forma_pagamento);
        $stmt->bindParam(':status_pagamento', $status_pagamento);
        $stmt->bindParam(':observacoes', $observacoes);

        if($stmt->execute()){
            return $this->db->lastInsertId();
        }else{
            return false;
        }
    }

    function atualizarPedidos($id_pedido, $id_endereco, $id_usuario, $data_pedido, $status_pedido, $total_pedido, $forma_pagamento, $status_pagamento, $observacoes) {
        $sql = "UPDATE tbl_pedidos 
                SET id_endereco = :id_endereco, id_usuario = :id_usuario, data_pedido = :data_pedido, status_pedido = :status_pedido, total_pedido = :total_pedido, forma_pagamento = :forma_pagamento, status_pagamento = :status_pagamento, observacoes = :observacoes
                WHERE id_pedidos = :id_pedidos";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_pedidos', $id_pedido, PDO::PARAM_INT);
        $stmt->bindParam(':id_endereco', $id_endereco, PDO::PARAM_INT);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->bindParam(':data_pedido', $data_pedido);
        $stmt->bindParam(':status_pedido', $status_pedido);
        $stmt->bindParam(':total_pedido', $total_pedido, PDO::PARAM_STR);
        $stmt->bindParam(':forma_pagamento', $forma_pagamento);
        $stmt->bindParam(':status_pagamento', $status_pagamento);
        $stmt->bindParam(':observacoes', $observacoes);

        return $stmt->execute();
    }

    function excluirPedidos($id_pedido){
        $dataatual = date('Y-m-d H:i:s');
        $sql = "UPDATE tbl_pedidos SET
         excluido_em = :atual
         WHERE id_pedidos = :id_pedidos";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_pedidos', $id_pedido, PDO::PARAM_INT);
        $stmt->bindParam(':atual', $dataatual);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    function ativarPedidos($id_pedido){
        $sql = "UPDATE tbl_pedidos SET
         excluido_em = NULL
         WHERE id_pedidos = :id_pedidos";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_pedidos', $id_pedido, PDO::PARAM_INT);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

}