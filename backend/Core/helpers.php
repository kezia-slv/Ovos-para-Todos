<?php

if (!function_exists('base_path')) {
    /**
     * Retorna o caminho base do projeto.
     */
    function base_path($path = '')
    {
        // Sobe de backend/Core até a raiz do projeto
        return __DIR__ . '/../../' . ($path ? ltrim($path, '/') : '');
    }
}

if (!function_exists('public_path')) {
    /**
     * Retorna o caminho público (raiz do projeto ou pasta public).
     */
    function public_path($path = '')
    {
        return base_path($path);
    }
}

if (!function_exists('storage_path')) {
    /**
     * Retorna o caminho para a pasta de uploads.
     */
    function storage_path($path = '')
    {
        return base_path('backend/uploads/' . ($path ? ltrim($path, '/') : ''));
    }
}

if (!function_exists('view')) {
    /**
     * Helper para renderizar views.
     */
    function view($name, $data = [])
    {
        \Ovos\Ebenezer\Core\View::render($name, $data);
    }
}

if (!function_exists('url')) {
    /**
     * Retorna URL absoluta baseada em APP_URL ou HTTP_HOST.
     */
    function url($path = '')
    {
        $baseUrl = getenv('APP_URL');
        if (!$baseUrl) {
            $scheme = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
            $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
            $baseUrl = $scheme . '://' . $host;
        }
        $baseUrl = rtrim($baseUrl, '/');
        return $baseUrl . '/' . ltrim($path, '/');
    }
}

if (!function_exists('base_url')) {
    /**
     * Retorna o caminho base relativo para assets (sem domínio).
     */
    function base_url($path = '')
    {
        $appUrl = getenv('APP_URL');
        if (!$appUrl) {
            $scheme = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
            $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
            $appUrl = $scheme . '://' . $host;
        }
        $parsedUrl = parse_url($appUrl);
        $basePath = $parsedUrl['path'] ?? '';
        return rtrim($basePath, '/') . '/' . ltrim($path, '/');
    }
}

if (!function_exists('dd')) {
    /**
     * Dump and Die para debug.
     */
    function dd(...$vars)
    {
        foreach ($vars as $var) {
            echo '<pre>';
            var_dump($var);
            echo '</pre>';
        }
        die();
    }
}

if (!function_exists('calcularTempoDecorrido')) {
    /**
     * Calcula o tempo decorrido de uma data até agora.
     */
    function calcularTempoDecorrido($data)
    {
        if (!$data)
            return 'Data não informada';

        $timestamp = is_numeric($data) ? $data : strtotime($data);
        if (!$timestamp)
            return $data;

        $agora = time();
        $diferenca = $agora - $timestamp;

        if ($diferenca < 60)
            return "agora mesmo";

        $minutos = round($diferenca / 60);
        if ($minutos < 60)
            return "há $minutos " . ($minutos == 1 ? "minuto" : "minutos");

        $horas = round($diferenca / 3600);
        if ($horas < 24)
            return "há $horas " . ($horas == 1 ? "hora" : "horas");

        $dias = round($diferenca / 86400);
        if ($dias < 30)
            return "há $dias " . ($dias == 1 ? "dia" : "dias");

        $meses = round($diferenca / 2592000);
        if ($meses < 12)
            return "há $meses " . ($meses == 1 ? "mês" : "meses");

        return date('d/m/Y', $timestamp);
    }
}

if (!function_exists('e')) {
    /**
     * Escapa string para saída HTML segura (prevenção de XSS).
     * Uso nas Views: <?= e($variavel) ?>
     */
    function e($value): string
    {
        return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
    }
}

if (!function_exists('asset_path')) {
    /**
     * Normaliza e retorna o caminho de um asset (imagem, etc).
     */
    function asset_path($path, $default = '/img/placeholder.svg')
    {
        if (empty($path)) {
            return $default;
        }

        if (strpos($path, 'http') === 0) {
            return $path;
        }

        if (strpos($path, '/') === 0) {
            if (strpos($path, '/backend') === 0) {
                return $path;
            }
            return '/backend' . $path;
        }

        return '/backend/' . $path;
    }
}