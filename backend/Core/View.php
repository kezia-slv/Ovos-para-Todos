<?php
namespace Ovos\Ebenezer\Core;
class View
{
    /**
     * Renderiza uma view.
     * @param string $nomeView Nome da view (ex: 'home/index')
     * @param array $dados Dados a serem passados para a view.
     */
    public static function render(string $nomeView, array $dados = [])
    {
        // Proteção contra LFI: Sanitiza o nome da view removendo tentativas de traversal
        $nomeView = str_replace(['../', '..\\'], '', $nomeView);
        $caminhoView = __DIR__ . "/../Views/templates/{$nomeView}.php";

        if (!file_exists($caminhoView)) {
            throw new \Exception("A view '{$nomeView}' não foi encontrada.");
        }

        extract($dados);

        $isAuthPage = strpos($nomeView, 'auth/') !== false;

        // Verifica tipo de usuário para carregar o header correto
        if (!$isAuthPage) {
            if (isset($_SESSION['usuario_tipo']) && $_SESSION['usuario_tipo'] === 'Cliente') {
                require_once __DIR__ . "/../Views/templates/admin/cliente/partials/header.php";
            }
            else {
                require_once __DIR__ . "/../Views/templates/partials/header.php";
            }
        }
        else {
            // Para as páginas de auth, carrega apenas o CSS base e FontAwesome
            echo '<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ovos Ebenezer - Autenticação</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f6f5f7;
            font-family: \'Sora\', sans-serif;
        }
    </style>
</head>
<body>';
        }

        require_once $caminhoView;

        if (!$isAuthPage) {
            require_once __DIR__ . "/../Views/templates/partials/footer.php";
        }
        else {
            echo '</body></html>';
        }
    }

}
