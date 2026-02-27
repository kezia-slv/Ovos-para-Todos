<?php

namespace Ovos\Ebenezer\Models;

use PDO;

class TipoOvo {
    private $db;
    private $id_tipo_ovo;
    private $nome_tipo_ovo;    
    private $criado_em;
    private $atualizado_em;
    private $excluido_em;

    public function __construct($db) {
        $this->db = $db;
    }

    function buscarTipoOvo(){
        $sql = "SELECT * FROM tbl_tipo_ovo";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function buscarTipoOvoPorID($id_tipo_ovo) {
        $sql = "SELECT * FROM tbl_tipo_ovo WHERE id_tipo_ovo = :id_tipo_ovo";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_tipo_ovo', $id_tipo_ovo, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    
    function totalDeTipoOvo(){
        $sql = "SELECT count(*) as total FROM tbl_tipo_ovo";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    function totalDeTipoOvoInativos(){
        $sql = "SELECT count(*) as total_inativos FROM tbl_tipo_ovo where excluido_em is NOT NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    function totalDeTipoOvoAtivos(){
        $sql = "SELECT count(*) as total_ativos FROM tbl_tipo_ovo where excluido_em is NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    function inserirTipoOvo($nome_tipo_ovo) {
        $sql = "INSERT INTO tbl_tipo_ovo (nome_tipo_ovo) 
                VALUES (:nome)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':nome', $nome_tipo_ovo);

        if($stmt->execute()){
            return $this->db->lastInsertId();
        }else{
            return false;
        }
    }

    function atualizar($id_tipo_ovo, $nome_tipo_ovo) {
        $sql = "UPDATE tbl_tipo_ovo 
                SET nome_tipo_ovo = :nome
                WHERE id_tipo_ovo = :id_tipo_ovo";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_tipo_ovo', $id_tipo_ovo, PDO::PARAM_INT);
        $stmt->bindParam(':nome', $nome_tipo_ovo);

        return $stmt->execute();
    }

    function excluirTipoOvo($id_tipo_ovo){
        $dataatual = date('Y-m-d H:i:s');
        $sql = "UPDATE tbl_tipo_ovo SET
         excluido_em = :atual
         WHERE id_tipo_ovo = :id_tipo_ovo";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_tipo_ovo', $id_tipo_ovo, PDO::PARAM_INT);
        $stmt->bindParam(':atual', $dataatual);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    function ativarTipoOvo($id_tipo_ovo){
        $sql = "UPDATE tbl_tipo_ovo SET
         excluido_em = NULL
         WHERE id_tipo_ovo = :id_tipo_ovo";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_tipo_ovo', $id_tipo_ovo, PDO::PARAM_INT);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
}