<?php

namespace Ovos\Ebenezer\Models;

use PDO;

class Endereco {
    private $db;
    private $id_endereco;
    private $id_usuario;
    private $cep_endereco;
    private $logradouro_endereco;
    private $numero_endereco;
    private $bairro_endereco;
    private $cidade_endereco;
    private $uf_endereco;
    private $complemento;
    private $criado_em;
    private $atualizado_em;
    private $excluido_em;

    public function __construct($db) {
        $this->db = $db;
    }

    function buscarEndereco(){
        $sql = "SELECT * FROM tbl_endereco";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function buscarEnderecoPorID($id_endereco) {
        $sql = "SELECT * FROM tbl_endereco WHERE id_endereco = :id_endereco";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_endereco', $id_endereco, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function buscarEnderecoPorIDUsuario($id_usuario) {
        $sql = "SELECT * FROM tbl_endereco WHERE id_usuario = :id_usuario";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    
    function totalDeEndereco(){
        $sql = "SELECT count(*) as total FROM tbl_endereco";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    function totalDeEnderecoInativos(){
        $sql = "SELECT count(*) as total_inativos FROM tbl_endereco where excluido_em is NOT NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    function totalDeEnderecoAtivos(){
        $sql = "SELECT count(*) as total_ativos FROM tbl_endereco where excluido_em is NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }


    // metodo de buscar todos usuario por email read
    function buscarEnderecoPorCep($cep_endereco){
        $sql = "SELECT * FROM tbl_endereco where cep_endereco = :cep";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':cep', $cep_endereco); 
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    function inserirEndereco($id_usuario, $cep_endereco, $logradouro_endereco, $numero_endereco, $bairro_endereco, $cidade_endereco, $uf_endereco, $complemento) {
        $sql = "INSERT INTO tbl_endereco (id_usuario, cep_endereco, logradouro_endereco, numero_endereco, bairro_endereco, cidade_endereco, uf_endereco, complemento) 
                VALUES (:id_usuario, :cep, :logradouro, :numero, :bairro, :cidade, :uf, :complemento)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->bindParam(':cep', $cep_endereco);
        $stmt->bindParam(':logradouro', $logradouro_endereco);
        $stmt->bindParam(':numero', $numero_endereco);
        $stmt->bindParam(':bairro', $bairro_endereco);
        $stmt->bindParam(':cidade', $cidade_endereco);
        $stmt->bindParam(':uf', $uf_endereco);
        $stmt->bindParam(':complemento', $complemento);

        if($stmt->execute()){
            return $this->db->lastInsertId();
        }else{
            return false;
        }
    }

    function atualizar($id_endereco, $cep_endereco, $logradouro_endereco, $numero_endereco, $bairro_endereco, $cidade_endereco, $uf_endereco, $complemento) {
        $sql = "UPDATE tbl_endereco 
                SET cep_endereco = :cep, logradouro_endereco = :logradouro, numero_endereco = :numero, bairro_endereco = :bairro, cidade_endereco = :cidade, uf_endereco = :uf, complemento = :complemento
                WHERE id_endereco = :id_endereco";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_endereco', $id_endereco, PDO::PARAM_INT);
        $stmt->bindParam(':cep', $cep_endereco);
        $stmt->bindParam(':logradouro', $logradouro_endereco);
        $stmt->bindParam(':numero', $numero_endereco);
        $stmt->bindParam(':bairro', $bairro_endereco);
        $stmt->bindParam(':cidade', $cidade_endereco);
        $stmt->bindParam(':uf', $uf_endereco);
        $stmt->bindParam(':complemento', $complemento);

        return $stmt->execute();
    }

    function excluirEndereco($id_endereco){
        $dataatual = date('Y-m-d H:i:s');
        $sql = "UPDATE tbl_endereco SET
         excluido_em = :atual
         WHERE id_endereco = :id_endereco";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_endereco', $id_endereco, PDO::PARAM_INT);
        $stmt->bindParam(':atual', $dataatual);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    function ativarEndereco($id_endereco){
        $sql = "UPDATE tbl_endereco SET
         excluido_em = NULL
         WHERE id_endereco = :id_endereco";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_endereco', $id_endereco, PDO::PARAM_INT);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
    
}