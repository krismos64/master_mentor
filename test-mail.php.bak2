<?php
/**
 * Script de test envoi email - MasterMentor
 * À SUPPRIMER après diagnostic
 */

header('Content-Type: text/html; charset=utf-8');

echo "<h1>Test envoi email PHP</h1>";
echo "<p><strong>Serveur:</strong> " . $_SERVER['SERVER_NAME'] . "</p>";
echo "<p><strong>PHP Version:</strong> " . phpversion() . "</p>";

// Test 1 : Fonction mail() existe ?
echo "<h2>Test 1 : Fonction mail() disponible</h2>";
if (function_exists('mail')) {
    echo "✅ La fonction mail() est disponible<br>";
} else {
    echo "❌ La fonction mail() n'est PAS disponible<br>";
    exit;
}

// Test 2 : Envoi email simple
echo "<h2>Test 2 : Envoi email simple</h2>";
$to = 'c.mostefaoui@yahoo.fr';
$subject = 'Test email depuis ' . $_SERVER['SERVER_NAME'];
$message = 'Ceci est un email de test envoyé depuis mastermentor.fr le ' . date('Y-m-d H:i:s');
$headers = 'From: noreply@mastermentor.fr' . "\r\n" .
           'Reply-To: noreply@mastermentor.fr' . "\r\n" .
           'X-Mailer: PHP/' . phpversion();

$result = mail($to, $subject, $message, $headers);

if ($result) {
    echo "✅ mail() a retourné TRUE (email envoyé selon PHP)<br>";
    echo "<p><strong>Destinataire:</strong> $to</p>";
    echo "<p><strong>Sujet:</strong> $subject</p>";
    echo "<p><strong>Vérifiez votre boîte mail (et SPAM) dans 2-5 minutes.</strong></p>";
} else {
    echo "❌ mail() a retourné FALSE (échec d'envoi)<br>";
    echo "<p>Vérifiez la configuration PHP du serveur.</p>";
}

// Test 3 : Envoi avec From différent
echo "<h2>Test 3 : Envoi avec From Yahoo</h2>";
$headers2 = 'From: c.mostefaoui@yahoo.fr' . "\r\n" .
            'Reply-To: c.mostefaoui@yahoo.fr' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

$result2 = mail($to, $subject . ' (From Yahoo)', $message, $headers2);

if ($result2) {
    echo "✅ Envoi réussi avec From: yahoo.fr<br>";
} else {
    echo "❌ Échec avec From: yahoo.fr<br>";
}

// Test 4 : Configuration PHP mail
echo "<h2>Test 4 : Configuration PHP mail</h2>";
echo "<pre>";
echo "sendmail_path: " . ini_get('sendmail_path') . "\n";
echo "SMTP: " . ini_get('SMTP') . "\n";
echo "smtp_port: " . ini_get('smtp_port') . "\n";
echo "</pre>";

echo "<hr>";
echo "<p><strong>🔍 Diagnostic :</strong></p>";
echo "<ul>";
echo "<li>Si vous recevez les emails : ✅ tout fonctionne</li>";
echo "<li>Si emails dans SPAM : problème SPF/DKIM du serveur</li>";
echo "<li>Si aucun email reçu : fonction mail() bloquée ou mal configurée</li>";
echo "</ul>";

echo "<p><strong>⚠️ IMPORTANT : Supprimez ce fichier après diagnostic pour des raisons de sécurité !</strong></p>";
?>
