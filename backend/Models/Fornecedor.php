<?php

namespace Ovos\Ebenezer\Models;

use PDO;

class Fornecedor {
    private $db;
    private $id_fornecedor;
    private $nome_fornecedor;
    private $cnpj_fornecedor;
    private $telefone_fornecedor;
    private $email_fornecedor;
    private $status_fornecedor;
    private $criado_em;
    private $atualizado_em;
    private $excluido_em;

    public function __construct($db) {
        $this->db = $db;
    }

    function buscarFornecedor(){
        $sql = "SELECT * FROM tbl_fornecedor";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function buscarFornecedorPorID($id_fornecedor) {
        $sql = "SELECT * FROM tbl_fornecedor WHERE id_fornecedor = :id_fornecedor";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_fornecedor', $id_fornecedor, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    
    function totalDeFornecedor(){
        $sql = "SELECT count(*) as total FROM tbl_fornecedor";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    function totalDeFornecedorInativos(){
        $sql = "SELECT count(*) as total_inativos FROM tbl_fornecedor where excluido_em is NOT NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    function totalDeFornecedorAtivos(){
        $sql = "SELECT count(*) as total_ativos FROM tbl_fornecedor where excluido_em is NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    function inserirFornecedor($nome_fornecedor, $cnpj_fornecedor, $telefone_fornecedor, $email_fornecedor, $status_fornecedor) {
        $sql = "INSERT INTO tbl_fornecedor (nome_fornecedor, cnpj_fornecedor, telefone_fornecedor, email_fornecedor, status_fornecedor) 
                VALUES (:nome, :cnpj, :telefone, :email, :status)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':nome', $nome_fornecedor);
        $stmt->bindParam(':cnpj', $cnpj_fornecedor);
        $stmt->bindParam(':telefone', $telefone_fornecedor);
        $stmt->bindParam(':email', $email_fornecedor);
        $stmt->bindParam(':status', $status_fornecedor);

        if($stmt->execute()){
            return $this->db->lastInsertId();
        }else{
            return false;
        }
    }

    function atualizar($id_fornecedor, $nome_fornecedor, $cnpj_fornecedor, $telefone_fornecedor, $email_fornecedor, $status_fornecedor) {
        $sql = "UPDATE tbl_fornecedor 
                SET nome_fornecedor = :nome, cnpj_fornecedor = :cnpj, telefone_fornecedor = :telefone, email_fornecedor = :email, status_fornecedor = :status
                WHERE id_fornecedor = :id_fornecedor";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_fornecedor', $id_fornecedor, PDO::PARAM_INT);
        $stmt->bindParam(':nome', $nome_fornecedor);
        $stmt->bindParam(':cnpj', $cnpj_fornecedor);
        $stmt->bindParam(':telefone', $telefone_fornecedor);
        $stmt->bindParam(':email', $email_fornecedor);
        $stmt->bindParam(':status', $status_fornecedor);

        return $stmt->execute();
    }

    function excluirFornecedor($id_fornecedor){
        $dataatual = date('Y-m-d H:i:s');
        $sql = "UPDATE tbl_fornecedor SET
         excluido_em = :atual
         WHERE id_fornecedor = :id_fornecedor";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_fornecedor', $id_fornecedor, PDO::PARAM_INT);
        $stmt->bindParam(':atual', $dataatual);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    function ativarFornecedor($id_fornecedor){
        $sql = "UPDATE tbl_fornecedor SET
         excluido_em = NULL
         WHERE id_fornecedor = :id_fornecedor";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_fornecedor', $id_fornecedor, PDO::PARAM_INT);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
}