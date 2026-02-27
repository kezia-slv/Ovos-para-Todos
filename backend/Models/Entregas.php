<?php

namespace Ovos\Ebenezer\Models;

use PDO;

class Entregas {
    private $db;
    private $id_entrega;
    private $id_usuario;
    private $id_pedidos;
    private $status_entrega;
    private $previsao_entrega;
    private $entregue_em;
    private $criado_em;
    private $atualizado_em;
    private $excluido_em;

    public function __construct($db) {
        $this->db = $db;
    }

    function buscarEntregas(){
        $sql = "SELECT * FROM tbl_entregas";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function buscarEntregasPorID($id_entrega) {
        $sql = "SELECT * FROM tbl_entregas WHERE id_entrega = :id_entrega";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_entrega', $id_entrega, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function buscarEntregasPorIDUsuario($id_usuario) {
        $sql = "SELECT * FROM tbl_entregas WHERE id_usuario = :id_usuario";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function buscarEntregasPorIDPedidos($id_pedidos) {
        $sql = "SELECT * FROM tbl_entregas WHERE id_pedidos = :id_pedidos";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_pedidos', $id_pedidos, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function buscarEntregasPorStatus($status_entrega){
        $sql = "SELECT * FROM tbl_entregas where status_entrega = :status";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':status', $status_entrega); 
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function buscarEntregasPorPrevisao($previsao_entrega){
        $sql = "SELECT * FROM tbl_entregas where previsao_entrega = :previsao";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':previsao', $previsao_entrega); 
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function buscarEntregasPorEntregueEm($entregue_em){
        $sql = "SELECT * FROM tbl_entregas where entregue_em = :entregue";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':entregue', $entregue_em); 
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
    function totalDeEntregas(){
        $sql = "SELECT count(*) as total FROM tbl_entregas";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    function totalDeEntregasInativas(){
        $sql = "SELECT count(*) as total_inativos FROM tbl_entregas where excluido_em is NOT NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    function totalDeEntregasAtivas(){
        $sql = "SELECT count(*) as total_ativos FROM tbl_entregas where excluido_em is NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }


    // metodo de buscar todos usuario por email read
    
    function inserirEntregas($id_usuario, $id_pedidos, $status_entrega, $previsao_entrega, $entregue_em) {
        $sql = "INSERT INTO tbl_entregas (id_usuario, id_pedidos, status_entrega, previsao_entrega, entregue_em) 
                VALUES (:id_usuario, :id_pedidos, :status_entrega, :previsao_entrega, :entregue_em)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->bindParam(':id_pedidos', $id_pedidos, PDO::PARAM_INT);
        $stmt->bindParam(':status_entrega', $status_entrega);
        $stmt->bindParam(':previsao_entrega', $previsao_entrega);
        $stmt->bindParam(':entregue_em', $entregue_em);

        if($stmt->execute()){
            return $this->db->lastInsertId();
        }else{
            return false;
        }
    }

    function atualizar($id_entrega, $id_usuario, $id_pedidos, $status_entrega, $previsao_entrega, $entregue_em) {
        $sql = "UPDATE tbl_entregas 
                SET id_usuario = :id_usuario, id_pedidos = :id_pedidos, status_entrega = :status_entrega, previsao_entrega = :previsao_entrega, entregue_em = :entregue_em
                WHERE id_entrega = :id_entrega";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_entrega', $id_entrega, PDO::PARAM_INT);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->bindParam(':id_pedidos', $id_pedidos, PDO::PARAM_INT);
        $stmt->bindParam(':status_entrega', $status_entrega);
        $stmt->bindParam(':previsao_entrega', $previsao_entrega);
        $stmt->bindParam(':entregue_em', $entregue_em);

        return $stmt->execute();
    }

    function excluirEntregas($id_entrega){
        $dataatual = date('Y-m-d H:i:s');
        $sql = "UPDATE tbl_entregas SET
         excluido_em = :atual
         WHERE id_entrega = :id_entrega";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_entrega', $id_entrega, PDO::PARAM_INT);
        $stmt->bindParam(':atual', $dataatual);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    function ativarEntregas($id_entrega){
        $sql = "UPDATE tbl_entregas SET
         excluido_em = NULL
         WHERE id_entrega = :id_entrega";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_entrega', $id_entrega, PDO::PARAM_INT);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
    
}