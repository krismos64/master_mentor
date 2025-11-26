<?php
/**
 * Configuration globale MasterMentor
 *
 * Ce fichier centralise la version des assets pour le cache-busting.
 * À inclure au début de chaque page PHP.
 */

// ===========================================
// VERSION DES ASSETS (Cache-Busting)
// ===========================================

// Option 1 : Version manuelle (à incrémenter à chaque déploiement)
// Décommentez cette ligne et commentez l'Option 2 si vous préférez le contrôle manuel
// define('ASSETS_VERSION', '2.7.1');

// Option 2 : Version automatique basée sur le dernier fichier modifié (RECOMMANDÉ)
// Détecte automatiquement les changements CSS/JS sans intervention manuelle
$css_dir = __DIR__ . '/../assets/css/';
$js_dir = __DIR__ . '/../assets/js/';

$last_modified = 0;

// Parcourir les fichiers CSS
if (is_dir($css_dir)) {
    foreach (glob($css_dir . '*.css') as $file) {
        $mtime = filemtime($file);
        if ($mtime > $last_modified) {
            $last_modified = $mtime;
        }
    }
}

// Parcourir les fichiers JS
if (is_dir($js_dir)) {
    foreach (glob($js_dir . '*.js') as $file) {
        $mtime = filemtime($file);
        if ($mtime > $last_modified) {
            $last_modified = $mtime;
        }
    }
}

// Définir la version basée sur le timestamp du dernier fichier modifié
// Format: YYYYMMDD.HHMMSS pour lisibilité dans les DevTools
define('ASSETS_VERSION', date('Ymd.His', $last_modified ?: time()));

// ===========================================
// FONCTIONS UTILITAIRES
// ===========================================

/**
 * Génère un lien CSS avec versioning automatique
 * @param string $path Chemin relatif du fichier CSS (ex: /assets/css/styles.min.css)
 * @return string Balise <link> complète
 */
function css($path) {
    return '<link rel="stylesheet" href="' . $path . '?v=' . ASSETS_VERSION . '">';
}

/**
 * Génère un script JS avec versioning automatique
 * @param string $path Chemin relatif du fichier JS (ex: /assets/js/main.min.js)
 * @param bool $defer Ajouter l'attribut defer (défaut: true)
 * @return string Balise <script> complète
 */
function js($path, $defer = true) {
    $deferAttr = $defer ? ' defer' : '';
    return '<script' . $deferAttr . ' src="' . $path . '?v=' . ASSETS_VERSION . '"></script>';
}
