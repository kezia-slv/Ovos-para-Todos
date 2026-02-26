<?php

namespace Ovos\Ebenezer\Rotas;

class Rotas
{
    public static function get()
    {
        return [
            'GET' => [
                '/usuario'               => 'UsuarioController@index',
                '/usuario/listar'        => 'UsuarioController@viewListarUsuarios',
                '/usuario/listar/{pagina}' => 'UsuarioController@viewListarUsuarios',
                '/usuario/criar'         => 'UsuarioController@viewCriarUsuarios',  
                '/usuario/editar/{id}'   => 'UsuarioController@viewEditarUsuarios',  
                '/usuario/deletar/{id}'  => 'UsuarioController@viewExcluirUsuarios', 

                '/perfil'               => 'PerfilController@index',
                '/perfil/listar'        => 'PerfilController@viewListarPerfil',
                '/perfil/criar'         => 'PerfilController@viewCriarPerfil',
                '/perfil/editar/{id}'   => 'PerfilController@viewEditarPerfil',
                '/perfil/deletar/{id}'  => 'PerfilController@viewExcluirPerfil',
                '/perfil/relatorio/{id}/{data1}/{data2}'  => 'PerfilController@relatorioPerfil',

                '/endereco'               => 'EnderecoController@index',
                '/endereco/listar'        => 'EnderecoController@viewListarEndereco',
                '/endereco/criar'         => 'EnderecoController@viewCriarEndereco',
                '/endereco/editar/{id}'   => 'EnderecoController@viewEditarEndereco',  
                '/endereco/deletar/{id}'  => 'EnderecoController@viewExcluirEndereco',

                '/pedidos'              => 'PedidosController@index',
                '/pedidos/listar'       => 'PedidosController@viewListarPedidos',
                '/pedidos/criar'        => 'PedidosController@viewCriarPedido',
                '/pedidos/editar/{id}'  => 'PedidosController@viewEditarPedido',
                '/pedidos/deletar/{id}' => 'PedidosController@viewExcluirPedido',
            ],

            'POST' => [
                '/usuario/salvar'    => 'UsuarioController@salvarUsuario',
                '/usuario/atualizar' => 'UsuarioController@atualizarUsuario',
                '/usuario/deletar'   => 'UsuarioController@deletarUsuario',
                '/usuario/ativar'    => 'UsuarioController@ativarUsuario',        


                '/perfil/salvar'    => 'PerfilController@salvarPerfil',
                '/perfil/atualizar' => 'PerfilController@atualizarPerfil',
                '/perfil/deletar'   => 'PerfilController@deletarPerfil',

                '/endereco/salvar'    => 'EnderecoController@salvarEndereco',
                '/endereco/atualizar' => 'EnderecoController@atualizarEndereco',
                '/endereco/deletar'   => 'EnderecoController@deletarEndereco',

                'pedidos/salvar'    => 'PedidosController@salvarPedido',
                'pedidos/atualizar' => 'PedidosController@atualizarPedido', 
                'pedidos/deletar'   => 'PedidosController@excluirPedido',
                'pedidos/ativar'    => 'PedidosController@ativarPedido',
            ],
        ];
    }
}