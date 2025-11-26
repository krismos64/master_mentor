<?php
/**
 * Router PHP pour développement local
 * Simule le comportement du .htaccess (URLs propres)
 *
 * Usage: php -S localhost:8000 router.php
 */

$uri = $_SERVER['REQUEST_URI'];
$path = parse_url($uri, PHP_URL_PATH);

// Si c'est un fichier existant (CSS, JS, images), le servir directement
if ($path !== '/' && file_exists(__DIR__ . $path)) {
    return false;
}

// Accueil
if ($path === '/') {
    require __DIR__ . '/index.php';
    return true;
}

// Nettoyer le path (enlever le / initial et trailing slash)
$slug = trim($path, '/');

// Si le fichier .php correspondant existe
$phpFile = __DIR__ . '/' . $slug . '.php';
if (file_exists($phpFile)) {
    require $phpFile;
    return true;
}

// Sinon, page 404 → rediriger vers accueil
require __DIR__ . '/index.php';
return true;
