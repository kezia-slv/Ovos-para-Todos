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

                '/produto'              => 'ProdutoController@index',
                '/produto/listar'       => 'ProdutoController@viewListarProduto',
                '/produto/criar'        => 'ProdutoController@viewCriarProduto',
                '/produto/editar/{id}'  => 'ProdutoController@viewEditarProduto',
                '/produto/deletar/{id}' => 'ProdutoController@viewExcluirProduto',

                '/estoque'              => 'EstoqueController@index',
                '/estoque/listar'       => 'EstoqueController@viewListarEstoque',
                '/estoque/criar'        => 'EstoqueController@viewCriarEstoque',
                '/estoque/editar/{id}'  => 'EstoqueController@viewEditarEstoque',
                '/estoque/deletar/{id}' => 'EstoqueController@viewExcluirEstoque',

                '/fornecedor'              => 'FornecedorController@index',
                '/fornecedor/listar'       => 'FornecedorController@viewListarFornecedor',
                '/fornecedor/criar'        => 'FornecedorController@viewCriarFornecedor',
                '/fornecedor/editar/{id}'  => 'FornecedorController@viewEditarFornecedor',
                '/fornecedor/deletar/{id}' => 'FornecedorController@viewExcluirFornecedor',

                '/tipo-ovo'              => 'TipoOvoController@index',
                '/tipo-ovo/listar'       => 'TipoOvoController@viewListarTipoOvo',
                '/tipo-ovo/criar'        => 'TipoOvoController@viewCriarTipoOvo',
                '/tipo-ovo/editar/{id}'  => 'TipoOvoController@viewEditarTipoOvo',
                '/tipo-ovo/deletar/{id}' => 'TipoOvoController@viewExcluirTipoOvo',

                '/entregas'              => 'EntregasController@index',
                '/entregas/listar'       => 'EntregasController@viewListarEntregas',
                '/entregas/criar'        => 'EntregasController@viewCriarEntregas',
                '/entregas/editar/{id}'  => 'EntregasController@viewEditarEntregas',
                '/entregas/deletar/{id}' => 'EntregasController@viewExcluirEntregas',

                '/vendas'              => 'VendasController@index',
                '/vendas/listar'       => 'VendasController@viewListarVendas',
                '/vendas/criar'        => 'VendasController@viewCriarVendas',
                '/vendas/editar/{id}'  => 'VendasController@viewEditarVendas',
                '/vendas/deletar/{id}' => 'VendasController@viewExcluirVendas',

                '/avaliacao'              => 'AvaliacaoController@index',
                '/avaliacao/listar'       => 'AvaliacaoController@viewListarAvaliacao',
                '/avaliacao/criar'        => 'AvaliacaoController@viewCriarAvaliacao',
                '/avaliacao/editar/{id}'  => 'AvaliacaoController@viewEditarAvaliacao',
                '/avaliacao/deletar/{id}' => 'AvaliacaoController@viewExcluirAvaliacao',
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

                '/pedidos/salvar'    => 'PedidosController@salvarPedido',
                '/pedidos/atualizar' => 'PedidosController@atualizarPedido', 
                '/pedidos/deletar'   => 'PedidosController@excluirPedido',
                '/pedidos/ativar'    => 'PedidosController@ativarPedido',

                '/produto/salvar'    => 'ProdutoController@salvarProduto',
                '/produto/atualizar' => 'ProdutoController@atualizarProduto',
                '/produto/deletar'   => 'ProdutoController@excluirProduto',
                '/produto/ativar'    => 'ProdutoController@ativarProduto',

                '/estoque/salvar'    => 'EstoqueController@salvarEstoque',
                '/estoque/atualizar' => 'EstoqueController@atualizarEstoque',
                '/estoque/deletar'   => 'EstoqueController@excluirEstoque',
                '/estoque/ativar'    => 'EstoqueController@ativarEstoque',

                '/fornecedor/salvar'    => 'FornecedorController@salvarFornecedor',
                '/fornecedor/atualizar' => 'FornecedorController@atualizarFornecedor',
                '/fornecedor/deletar'   => 'FornecedorController@excluirFornecedor',
                '/fornecedor/ativar'    => 'FornecedorController@ativarFornecedor',

                '/tipo-ovo/salvar'    => 'TipoOvoController@salvarTipoOvo',
                '/tipo-ovo/atualizar' => 'TipoOvoController@atualizarTipoOvo',
                '/tipo-ovo/deletar'   => 'TipoOvoController@excluirTipoOvo',
                '/tipo-ovo/ativar'    => 'TipoOvoController@ativarTipoOvo',

                '/entregas/salvar'    => 'EntregasController@salvarEntregas',
                '/entregas/atualizar' => 'EntregasController@atualizarEntregas',
                '/entregas/deletar'   => 'EntregasController@excluirEntregas',
                '/entregas/ativar'    => 'EntregasController@ativarEntregas',

                '/vendas/salvar'    => 'VendasController@salvarVendas',
                '/vendas/atualizar' => 'VendasController@atualizarVendas',
                '/vendas/deletar'   => 'VendasController@excluirVendas',
                '/vendas/ativar'    => 'VendasController@ativarVendas',

                '/avaliacao/salvar'    => 'AvaliacaoController@salvarAvaliacao',
                '/avaliacao/atualizar' => 'AvaliacaoController@atualizarAvaliacao',
                '/avaliacao/deletar'   => 'AvaliacaoController@excluirAvaliacao',
                '/avaliacao/ativar'    => 'AvaliacaoController@ativarAvaliacao',
            ],
        ];
    }
}