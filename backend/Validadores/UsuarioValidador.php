<?php
namespace Ovos\Ebenezer\Validadores;

class UsuarioValidador {
    public static function ValidarEntradas($dados) {
        $erros = [];

        if (empty($dados['nome_usuario'])) {
            $erros[] = "Nome do usuário é obrigatório.";
        }

        if (empty($dados['email_usuario'])) {
            $erros[] = "Email do usuário é obrigatório.";
        } else {
            if (!filter_var($dados['email_usuario'], FILTER_VALIDATE_EMAIL)) {
                $erros[] = "Email inválido.";
            }
        }

        if (empty($dados['senha_usuario'])) {
            $erros[] = "Senha do usuário é obrigatória.";
        } else {
            if (strlen($dados['senha_usuario']) < 6) {
                $erros[] = "Senha deve ter no mínimo 6 caracteres.";
            }
        }

        return $erros;
    }
}