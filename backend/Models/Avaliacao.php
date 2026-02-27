<?php

namespace Ovos\Ebenezer\Models;

use PDO;

class Avaliacao {
    private $db;
    private $id_avaliacao;
    private $id_usuario;
    private $id_pedidos;
    private $nota_avaliacao;
    private $comentario_avaliacao;
    private $data_avaliacao;
    private $status_avaliacao;
    private $criado_em;
    private $atualizado_em;
    private $excluido_em;

    public function __construct($db) {
        $this->db = $db;
    }

    function buscarAvaliacao(){
        $sql = "SELECT * FROM tbl_avaliacao";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function buscarAvaliacaoPorID($id_avaliacao) {
        $sql = "SELECT * FROM tbl_avaliacao WHERE id_avaliacao = :id_avaliacao";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_avaliacao', $id_avaliacao, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function buscarAvaliacaoPorIDUsuario($id_usuario) {
        $sql = "SELECT * FROM tbl_avaliacao WHERE id_usuario = :id_usuario";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    
    function totalDeAvaliacao(){
        $sql = "SELECT count(*) as total FROM tbl_avaliacao";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    function totalDeAvaliacaoInativos(){
        $sql = "SELECT count(*) as total_inativos FROM tbl_avaliacao where excluido_em is NOT NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    function totalDeAvaliacaoAtivos(){
        $sql = "SELECT count(*) as total_ativos FROM tbl_avaliacao where excluido_em is NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }


    // metodo de buscar todos usuario por email read
    function buscarAvaliacaoPorStatus($status_avaliacao){
        $sql = "SELECT * FROM tbl_avaliacao where status_avaliacao = :status";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':status', $status_avaliacao); 
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    function inserirAvaliacao($id_usuario, $id_pedidos, $nota_avaliacao, $comentario_avaliacao, $data_avaliacao, $status_avaliacao) {
        $sql = "INSERT INTO tbl_avaliacao (id_usuario, id_pedidos, nota_avaliacao, comentario_avaliacao, data_avaliacao, status_avaliacao) 
                VALUES (:id_usuario, :id_pedidos, :nota, :comentario, :data, :status)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->bindParam(':id_pedidos', $id_pedidos, PDO::PARAM_INT);
        $stmt->bindParam(':nota', $nota_avaliacao);
        $stmt->bindParam(':comentario', $comentario_avaliacao);
        $stmt->bindParam(':data', $data_avaliacao);
        $stmt->bindParam(':status', $status_avaliacao);

        if($stmt->execute()){
            return $this->db->lastInsertId();
        }else{
            return false;
        }
    }

    function atualizar($id_avaliacao, $id_usuario, $id_pedidos, $nota_avaliacao, $comentario_avaliacao, $data_avaliacao, $status_avaliacao) {
        $sql = "UPDATE tbl_avaliacao 
                SET id_usuario = :id_usuario, id_pedidos = :id_pedidos, nota_avaliacao = :nota, comentario_avaliacao = :comentario, data_avaliacao = :data, status_avaliacao = :status
                WHERE id_avaliacao = :id_avaliacao";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_avaliacao', $id_avaliacao, PDO::PARAM_INT);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->bindParam(':id_pedidos', $id_pedidos, PDO::PARAM_INT);
        $stmt->bindParam(':nota', $nota_avaliacao);
        $stmt->bindParam(':comentario', $comentario_avaliacao);
        $stmt->bindParam(':data', $data_avaliacao);
        $stmt->bindParam(':status', $status_avaliacao);

        return $stmt->execute();
    }

    function excluirAvaliacao($id_avaliacao){
        $dataatual = date('Y-m-d H:i:s');
        $sql = "UPDATE tbl_avaliacao SET
         excluido_em = :atual
         WHERE id_avaliacao = :id_avaliacao";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_avaliacao', $id_avaliacao, PDO::PARAM_INT);
        $stmt->bindParam(':atual', $dataatual);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    function ativarAvaliacao($id_avaliacao){
        $sql = "UPDATE tbl_avaliacao SET
         excluido_em = NULL
         WHERE id_avaliacao = :id_avaliacao";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_avaliacao', $id_avaliacao, PDO::PARAM_INT);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
    
}