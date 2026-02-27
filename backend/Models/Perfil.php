<?php

namespace Ovos\Ebenezer\Models;

use PDO;

class Perfil{
    private $db;
    private $id_perfil_usuario;
    private $id_usuario;
    private $telefone_usuario;
    private $foto_perfil_usuario;
    private $data_nascimento;
    private $genero_usuario;
    private $criado_em;
    private $atualizado_em;
    private $excluido_em;

    public function __construct($db) {
        $this->db = $db;
    }

    function buscarPerfilUsuario(){
        $sql = "SELECT * FROM tbl_perfil_usuario";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function buscarPerfilUsuarioPorID($id_perfil_usuario) {
        $sql = "SELECT * FROM tbl_perfil_usuario WHERE id_perfil_usuario = :id_perfil_usuario";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_perfil_usuario', $id_perfil_usuario, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function buscarPerfilUsuarioPorIDUsuario($id_usuario) {
        $sql = "SELECT * FROM tbl_perfil_usuario WHERE id_usuario = :id_usuario";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    
    function totalDePerfil(){
        $sql = "SELECT count(*) as total FROM tbl_perfil_usuario";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    function totalDePerfilInativos(){
        $sql = "SELECT count(*) as total_inativos FROM tbl_perfil_usuario where excluido_em is NOT NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    function totalDePerfilAtivos(){
        $sql = "SELECT count(*) as total_ativos FROM tbl_perfil_usuario where excluido_em is NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }


    // metodo de buscar todos usuario por email read
    function buscarPerfilPorTelefone($telefone_usuario){
        $sql = "SELECT * FROM tbl_perfil_usuario where telefone_usuario = :telefone";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':telefone', $telefone_usuario); 
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function inserirPerfil($telefone_usuario, $foto_perfil_usuario, $data_nascimento, $genero_usuario) {
        $sql = "INSERT INTO tbl_perfil_usuario (telefone_usuario, foto_usuario, data_nascimento_usuario, genero_usuario) 
                VALUES (:telefone, :foto, :data_nascimento, :genero)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':telefone', $telefone_usuario);
        $stmt->bindParam(':foto', $foto_perfil_usuario);
        $stmt->bindParam(':data_nascimento', $data_nascimento);
        $stmt->bindParam(':genero', $genero_usuario);

        if($stmt->execute()){
            return $this->db->lastInsertId();
        }else{
            return false;
        }
    }

    function atualizarPerfil($id_perfil_usuario, $telefone_usuario, $foto_perfil_usuario, $data_nascimento, $genero_usuario) {
        $sql = "UPDATE tbl_perfil_usuario 
                SET telefone_usuario = :telefone, foto_usuario = :foto, data_nascimento_usuario = :data_nascimento, genero_usuario = :genero
                WHERE id_perfil_usuario = :id_perfil_usuario";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_perfil_usuario', $id_perfil_usuario, PDO::PARAM_INT);
        $stmt->bindParam(':telefone', $telefone_usuario);
        $stmt->bindParam(':foto', $foto_perfil_usuario);
        $stmt->bindParam(':data_nascimento', $data_nascimento);
        $stmt->bindParam(':genero', $genero_usuario);

        return $stmt->execute();
    }

    function excluirPerfil($id_perfil_usuario){
        $dataatual = date('Y-m-d H:i:s');
        $sql = "UPDATE tbl_perfil_usuario SET
         excluido_em = :atual
         WHERE id_perfil_usuario = :id_perfil_usuario";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_perfil_usuario', $id_perfil_usuario);
        $stmt->bindParam(':atual', $dataatual);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    function ativarPerfil($id_perfil_usuario){
        $sql = "UPDATE tbl_perfil_usuario SET
         excluido_em = NULL
         WHERE id_perfil_usuario = :id_perfil_usuario";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_perfil_usuario', $id_perfil_usuario);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

}