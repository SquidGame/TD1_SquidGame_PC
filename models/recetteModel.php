<?php

class RecetteModel {
    public $id;
    public $titre;
    public $description;
    public $auteur;

    public function __construct($id, $titre, $description, $auteur) {
        $this->id = $id;
        $this->titre = $titre;
        $this->description = $description;
        $this->auteur = $auteur;
    }

    public static function getLatestRecipes($conn) {
        $query = "SELECT * FROM RECETTE ORDER BY rc_recette_date_inscription DESC LIMIT 4";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}


?>

