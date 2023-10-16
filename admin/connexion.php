<?php
// Charger les informations de connexion depuis le fichier info.ini
$databaseConfig = parse_ini_file('./env/info.env');

// Accéder aux variables d'environnement
$dbHost = $databaseConfig['DB_HOST'];
$dbName = $databaseConfig['DB_NAME'];
$dbUser = $databaseConfig['DB_USER'];
$dbPass = $databaseConfig['DB_PASS'];

try { // Connexion à la base de données
    $bdd = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $dbUser, $dbPass);
} catch (Exception $e) { // En cas d'erreur, afficher un message et arrêter tout
    die('Erreur : ' . $e->getMessage());
}
?>
