<?php
/**
 * MasterMentor - Formulaire de Contact
 * Version: 2.0
 * Description: Backend PHP sécurisé pour envoi d'emails
 * Auteur: Christophe https://christophe-dev-freelance.fr/
 */

// Configuration
header('Content-Type: application/json; charset=utf-8');
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');
header('X-XSS-Protection: 1; mode=block');

// Autoriser uniquement les requêtes POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        'success' => false,
        'message' => 'Méthode non autorisée. Utilisez POST.'
    ]);
    exit;
}

// Configuration email
define('EMAIL_TO', 'contact@staka.fr');
define('EMAIL_SUBJECT', '🎓 Nouveau diagnostic MasterMentor');
define('EMAIL_FROM', 'noreply@mastermentor.fr'); 
// Rate limiting : 1 envoi par minute par IP
$ipAddress = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
$rateLimitFile = sys_get_temp_dir() . '/mm_ratelimit_' . md5($ipAddress) . '.txt';

if (file_exists($rateLimitFile)) {
    $lastSubmit = (int)file_get_contents($rateLimitFile);
    if (time() - $lastSubmit < 60) {
        http_response_code(429);
        echo json_encode([
            'success' => false,
            'message' => 'Trop de tentatives. Veuillez patienter 1 minute.'
        ]);
        exit;
    }
}

// Récupération et sanitization des données
$nom = isset($_POST['nom']) ? trim(htmlspecialchars($_POST['nom'], ENT_QUOTES, 'UTF-8')) : '';
$email = isset($_POST['email']) ? trim(htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8')) : '';
$telephone = isset($_POST['telephone']) ? trim(htmlspecialchars($_POST['telephone'], ENT_QUOTES, 'UTF-8')) : '';
$discipline = isset($_POST['discipline']) ? trim(htmlspecialchars($_POST['discipline'], ENT_QUOTES, 'UTF-8')) : '';
$message = isset($_POST['message']) ? trim(htmlspecialchars($_POST['message'], ENT_QUOTES, 'UTF-8')) : '';
$honeypot = isset($_POST['website']) ? trim($_POST['website']) : '';

// Protection honeypot (anti-bots)
if (!empty($honeypot)) {
    // Bot détecté, on fait semblant de réussir mais on n'envoie rien
    echo json_encode([
        'success' => true,
        'message' => 'Merci ! Nous vous contactons sous 24h.'
    ]);
    exit;
}

// Validation des champs requis
$errors = [];

if (empty($nom) || strlen($nom) < 2) {
    $errors[] = 'Le nom et prénom sont requis (minimum 2 caractères).';
}

if (empty($email)) {
    $errors[] = 'L\'email est requis.';
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'L\'email n\'est pas valide.';
}

if (empty($telephone)) {
    $errors[] = 'Le téléphone est requis.';
} elseif (!preg_match('/^[0-9\s\+\-\.\(\)]{8,20}$/', $telephone)) {
    $errors[] = 'Le téléphone n\'est pas valide (minimum 8 chiffres).';
}

if (empty($discipline)) {
    $errors[] = 'La discipline est requise.';
}

// Si erreurs, retourner
if (!empty($errors)) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => implode(' ', $errors)
    ]);
    exit;
}

// Composition de l'email HTML
$emailBody = "
<!DOCTYPE html>
<html lang='fr'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px 20px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }
        .content {
            padding: 30px 20px;
        }
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        .info-table td {
            padding: 12px;
            border-bottom: 1px solid #e0e0e0;
        }
        .info-table td:first-child {
            font-weight: 600;
            color: #667eea;
            width: 40%;
        }
        .info-table tr:last-child td {
            border-bottom: none;
        }
        .message-box {
            background: #f8f9fa;
            border-left: 4px solid #667eea;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .footer {
            background: #f8f9fa;
            padding: 20px;
            text-align: center;
            font-size: 14px;
            color: #666;
        }
        .btn {
            display: inline-block;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class='container'>
        <div class='header'>
            <h1>🎓 Nouveau Diagnostic MasterMentor</h1>
        </div>
        <div class='content'>
            <p>Bonjour,</p>
            <p>Une nouvelle demande de diagnostic gratuit a été soumise via le formulaire de contact.</p>

            <table class='info-table'>
                <tr>
                    <td>Nom et Prénom</td>
                    <td><strong>{$nom}</strong></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><a href='mailto:{$email}'>{$email}</a></td>
                </tr>
                <tr>
                    <td>Téléphone</td>
                    <td><a href='tel:{$telephone}'>{$telephone}</a></td>
                </tr>
                <tr>
                    <td>Discipline</td>
                    <td>{$discipline}</td>
                </tr>
            </table>

            " . (!empty($message) ? "
            <div class='message-box'>
                <strong>Message du client :</strong><br>
                " . nl2br($message) . "
            </div>
            " : "") . "

            <center>
                <a href='mailto:{$email}' class='btn'>Répondre au Client</a>
            </center>
        </div>
        <div class='footer'>
            <p><strong>MasterMentor</strong> - Coaching Mémoire Master 2</p>
            <p>📞 +33 6 15 07 81 52 | 📧 c.mostefaoui@yahoo.fr</p>
            <p style='font-size: 12px; color: #999;'>Email automatique généré le " . date('d/m/Y à H:i') . "</p>
        </div>
    </div>
</body>
</html>
";

// Headers pour email HTML
$headers = [
    'MIME-Version: 1.0',
    'Content-Type: text/html; charset=UTF-8',
    'From: MasterMentor <' . EMAIL_FROM . '>',
    'Reply-To: ' . $email,
    'X-Mailer: PHP/' . phpversion(),
    'Message-ID: <' . md5(uniqid(time())) . '@mastermentor.fr>',
    'List-Unsubscribe: <mailto:' . EMAIL_FROM . '?subject=unsubscribe>',
    'Precedence: bulk',
    'X-Auto-Response-Suppress: All'
];

// Envoi de l'email
$mailSent = mail(
    EMAIL_TO,
    EMAIL_SUBJECT,
    $emailBody,
    implode("\r\n", $headers)
);

if ($mailSent) {
    // Enregistrer le timestamp pour rate limiting
    file_put_contents($rateLimitFile, time());

    // Email de confirmation automatique au client (optionnel)
    $clientEmailBody = "
    <!DOCTYPE html>
    <html lang='fr'>
    <head>
        <meta charset='UTF-8'>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px; }
            .header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 30px 20px; text-align: center; border-radius: 8px 8px 0 0; }
            .content { background: #ffffff; padding: 30px 20px; border: 1px solid #e0e0e0; }
            .footer { background: #f8f9fa; padding: 20px; text-align: center; font-size: 14px; color: #666; border-radius: 0 0 8px 8px; }
        </style>
    </head>
    <body>
        <div class='header'>
            <h1>✅ Demande Bien Reçue !</h1>
        </div>
        <div class='content'>
            <p>Bonjour <strong>{$nom}</strong>,</p>
            <p>Merci pour votre demande de diagnostic gratuit !</p>
            <p>Nous avons bien reçu vos informations et nous vous contacterons <strong>sous 24 heures</strong> pour planifier votre consultation gratuite de 30 minutes.</p>
            <p>En attendant, n'hésitez pas à nous contacter directement :</p>
            <ul>
                <li>📞 Téléphone : <a href='tel:+33615078152'>+33 6 15 07 81 52</a></li>
                <li>💬 WhatsApp : <a href='https://wa.me/33615078152'>Cliquez ici</a></li>
            </ul>
            <p>À très bientôt,<br><strong>L'équipe MasterMentor</strong></p>
        </div>
        <div class='footer'>
            <p><strong>MasterMentor</strong> - Coaching Mémoire Master 2 par Docteurs</p>
            <p>98% de réussite | 17 ans d'expérience</p>
        </div>
    </body>
    </html>
    ";

    $clientHeaders = [
        'MIME-Version: 1.0',
        'Content-Type: text/html; charset=UTF-8',
        'From: MasterMentor <' . EMAIL_FROM . '>',
        'Reply-To: ' . EMAIL_TO,
        'X-Mailer: PHP/' . phpversion()
    ];

    // Envoi email de confirmation au client
    mail(
        $email,
        '✅ Demande reçue - MasterMentor',
        $clientEmailBody,
        implode("\r\n", $clientHeaders)
    );

    // Réponse succès
    echo json_encode([
        'success' => true,
        'message' => 'Merci ! Nous vous contactons sous 24h.'
    ]);
} else {
    // Erreur d'envoi
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Erreur lors de l\'envoi. Veuillez réessayer ou nous contacter directement.'
    ]);
}
