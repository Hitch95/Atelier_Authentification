<?php
// Nom d'utilisateur et mot de passe corrects
$admin_username = 'admin';
$admin_password = 'secret';

$simple_user_username = 'user';
$simple_user_password = 'utilisateur';

// Vérifier si l'utilisateur a envoyé des identifiants
if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])) {
    // Envoyer un header HTTP pour demander les informations
    header('WWW-Authenticate: Basic realm="Zone Protégée"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'Vous devez entrer un nom d\'utilisateur et un mot de passe pour accéder à cette page.';
    exit;
}

// Vérifier les identifiants envoyés
if ($_SERVER['PHP_AUTH_USER'] === $admin_username && $_SERVER['PHP_AUTH_PW'] === $admin_password) {
    // Authentification réussie pour l'admin
} elseif ($_SERVER['PHP_AUTH_USER'] === $simple_user_username && $_SERVER['PHP_AUTH_PW'] === $simple_user_password) {
    // Authentification réussie pour l'utilisateur simple
} else {
    // Si les identifiants sont incorrects
    header('WWW-Authenticate: Basic realm="Zone Protégée"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'Nom d\'utilisateur ou mot de passe incorrect.';
    exit;
}

// Si les identifiants sont corrects
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page protégée</title>
</head>
<body>
    <?php if ($_SERVER['PHP_AUTH_USER'] === $admin_username) { ?>
        <h1>Seul les élus peuvent voir ce message</h1>
    <?php } ?>
    <h1>Bienvenue sur la page protégée</h1>
    <p>Ceci est une page protégée par une authentification simple via le header HTTP</p>
    <p>C'est le serveur qui vous demande un nom d'utilisateur et un mot de passe via le header WWW-Authenticate</p>
    <p>Aucun système de session ou cookie n'est utilisé pour cet atelier</p>
    <p>Vous êtes connecté en tant que : <?php echo htmlspecialchars($_SERVER['PHP_AUTH_USER']); ?></p>
    <a href="../index.html">Retour à l'accueil</a>  
</body>
</html>
