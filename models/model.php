<?php
class model {

    //Fonction permettant l'accès à la base de données
    protected static function connexion(){
        $env = parse_ini_file('./login/info.env');
        $dbHost = $env['DB_HOST'];
        $dbName = $env['DB_NAME'];
        $dbUser = $env['DB_USER'];
        $dbPassword = $env['DB_PASS'];


        try {
            $conn = new PDO("mysql:host=$dbHost; dbname=$dbName", $dbUser, $dbPassword);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }
}
?>