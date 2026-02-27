<?php
/**
 * Router script for PHP's built-in development server.
 *
 * Usage: php -S localhost:3020 router.php
 *
 * Routes all /backend/* requests to backend/index.php
 * and serves static files (CSS, JS, images, HTML) normally.
 */

$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

// If the request is for a real file (CSS, JS, images, etc.), serve it directly
if ($uri !== '/' && file_exists(__DIR__ . $uri)) {
    // Let PHP serve static files normally, but exclude directories
    // (we don't want directory listing, we want index.php routing)
    if (!is_dir(__DIR__ . $uri)) {
        return false;
    }
}

// If it's a /backend route, route to backend/index.php
if (str_starts_with($uri, '/backend')) {
    $_SERVER['SCRIPT_NAME'] = '/backend/index.php';
    require __DIR__ . '/backend/index.php';
    return;
}

// For everything else (public site), serve index.html
if (file_exists(__DIR__ . '/index.html')) {
    readfile(__DIR__ . '/index.html');
    return;
}

// Fallback 404
http_response_code(404);
echo '404 - Page not found';
