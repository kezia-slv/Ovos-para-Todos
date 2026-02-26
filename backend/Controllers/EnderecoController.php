<?php
namespace Ovos\Ebenezer\Controllers;

use Ovos\Ebenezer\Models\Endereco;
use Ovos\Ebenezer\Database\Database;
use Ovos\Ebenezer\Core\View;
use Ovos\Ebenezer\Core\Redirect;
use Ovos\Ebenezer\Validadores\PerfilValidador;
use Ovos\Ebenezer\Core\FileManager;


class EnderecoController {
    public $endereco;
    public $db;
    public $gerenciarImagem;
    public function __construct() {
        $this->db = Database::getInstance();
        $this->endereco = new Endereco($this->db);
        $this->gerenciarImagem = new FileManager('upload');
    }

      // index
      public function index() {
        $resultado = $this->endereco->buscarEndereco();
        var_dump($resultado);
    }
    public function viewListarEndereco(){
        $dados = $this->endereco->buscarEndereco();
        $total_endereco = $this->endereco->totalDeEndereco();
        $total_inativos = $this->endereco->totalDeEnderecoInativos();
        $total_ativos = $this->endereco->totalDeEnderecoAtivos();

        View::render("endereco/index", 
        [
            "endereco"=> $dados, 
            "total_endereco"=> $total_endereco[0],
            "total_inativos"=> $total_inativos[0],
            "total_ativos"=> $total_ativos[0]
        ]
    );
    }

    public function viewCriarEndereco(){
        View::render("endereco/create", []);
    }

    public function viewEditarEndereco($id_endereco){
        $dados = $this->endereco->buscarEnderecoPorID($id_endereco);
        foreach($dados as $endereco){

            $dados = $endereco;
        }
        View::render("endereco/edit", ["endereco" => $dados]);
    }

    public function viewExcluirEndereco($id_endereco){
        View::render("endereco/delete", ["id_endereco" => $id_endereco]);
    }


    

    public function atualizarEndereco(){
    $id = (int)$_POST['id_endereco'];
    $cep = $_POST['cep_endereco'];
    $logradouro = $_POST['logradouro_endereco'];
    $numero = $_POST['numero_endereco'];
    $bairro = $_POST['bairro_endereco'];
    $cidade = $_POST['cidade_endereco'];
    $uf = $_POST['uf_endereco'];
    $complemento = $_POST['complemento'];

    if ($this->endereco->atualizar($id, $cep, $logradouro, $numero, $bairro, $cidade, $uf, $complemento)) {
        Redirect::redirecionarComMensagem("/endereco/listar", "success", "Endereço atualizado com sucesso!");
    } else {
        Redirect::redirecionarComMensagem("/endereco/editar/".$id, "error", "Erro ao atualizar endereço.");
    }
}

public function excluirEndereco(){
    $id = (int)$_POST['id_endereco'];

    if ($this->endereco->excluirEndereco($id)) {
        Redirect::redirecionarComMensagem("/endereco/listar", "success", "Endereço excluído com sucesso!");
    } else {
        Redirect::redirecionarComMensagem("/endereco/listar", "error", "Erro ao excluir endereço.");
    }
}
}
