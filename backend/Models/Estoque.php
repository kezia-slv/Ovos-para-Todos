<?php

namespace Ovos\Ebenezer\Models;

use PDO;

class Estoque {
    private $db;
    private $id_estoque;
    private $id_produtos;
    private $quantidade_estoque;
    private $quantidade_min_reposicao;
    private $criado_em;
    private $atualizado_em;
    private $excluido_em;

    public function __construct($db) {
        $this->db = $db;
    }

    function buscarEstoque(){
        $sql = "SELECT * FROM tbl_estoque";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function buscarEstoquePorID($id_estoque) {
        $sql = "SELECT * FROM tbl_estoque WHERE id_estoque = :id_estoque";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_estoque', $id_estoque, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function buscarEstoquePorIDProduto($id_produtos) {
        $sql = "SELECT * FROM tbl_estoque WHERE id_produtos = :id_produtos";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_produtos', $id_produtos, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    
    function totalDeEstoque(){
        $sql = "SELECT count(*) as total FROM tbl_estoque";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    function totalDeEstoqueInativos(){
        $sql = "SELECT count(*) as total_inativos FROM tbl_estoque where excluido_em is NOT NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    function totalDeEstoqueAtivos(){
        $sql = "SELECT count(*) as total_ativos FROM tbl_estoque where excluido_em is NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    
    function buscarEstoquePorQuantidade($quantidade_estoque){
        $sql = "SELECT * FROM tbl_estoque where quantidade_estoque = :quantidade";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':quantidade', $quantidade_estoque); 
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    function inserirEstoque($id_produtos, $quantidade_estoque, $quantidade_min_reposicao) {
        $sql = "INSERT INTO tbl_estoque (id_produtos, quantidade_estoque, quantidade_min_reposicao) 
                VALUES (:id_produtos, :quantidade, :minimo)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_produtos', $id_produtos, PDO::PARAM_INT);
        $stmt->bindParam(':quantidade', $quantidade_estoque, PDO::PARAM_INT);
        $stmt->bindParam(':minimo', $quantidade_min_reposicao, PDO::PARAM_INT);

        if($stmt->execute()){
            return $this->db->lastInsertId();
        }else{
            return false;
        }
    }

    function atualizar($id_estoque, $id_produtos, $quantidade_estoque, $quantidade_min_reposicao) {
        $sql = "UPDATE tbl_estoque 
                SET id_produtos = :id_produtos, quantidade_estoque = :quantidade, quantidade_min_reposicao = :minimo
                WHERE id_estoque = :id_estoque";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_estoque', $id_estoque, PDO::PARAM_INT);
        $stmt->bindParam(':id_produtos', $id_produtos, PDO::PARAM_INT);
        $stmt->bindParam(':quantidade', $quantidade_estoque, PDO::PARAM_INT);
        $stmt->bindParam(':minimo', $quantidade_min_reposicao, PDO::PARAM_INT);

        return $stmt->execute();
    }

    function excluirEstoque($id_estoque){
        $dataatual = date('Y-m-d H:i:s');
        $sql = "UPDATE tbl_estoque SET
         excluido_em = :atual
         WHERE id_estoque = :id_estoque";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_estoque', $id_estoque, PDO::PARAM_INT);
        $stmt->bindParam(':atual', $dataatual);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    function ativarEstoque($id_estoque){
        $sql = "UPDATE tbl_estoque SET
         excluido_em = NULL
         WHERE id_estoque = :id_estoque";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_estoque', $id_estoque, PDO::PARAM_INT);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
    }