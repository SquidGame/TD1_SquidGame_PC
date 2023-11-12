<?php
$databaseConfig = parse_ini_file('info.env');

$dbHost = $databaseConfig['DB_HOST'];
$dbName = $databaseConfig['DB_NAME'];
$dbUser = $databaseConfig['DB_USER'];
$dbPass = $databaseConfig['DB_PASS'];

try {
    $conn = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Erreur de connexion: " . $e->getMessage();
}
?>
