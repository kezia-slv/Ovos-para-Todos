<?php
namespace Ovos\Ebenezer\Controllers\Admin;

use Ovos\Ebenezer\Core\Session;
use Ovos\Ebenezer\Core\Redirect;

abstract class AuthenticatedController
{
    protected Session $session;
    public function __construct()
    {
        $this->session = new Session();
        if (!$this->session->has('usuario_id')) {
            Redirect::redirecionarComMensagem(
                '/backend/login',
                'error',
                'Você precisa estar logado para acessar esta página.'
            );
        }
    }
}


