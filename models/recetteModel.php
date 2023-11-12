<?php

require_once('model.php');

class RecetteModel extends model {
    public static function getLatestRecipes() {
        $conn = self::connexion();
        $query = "SELECT * FROM RECETTE WHERE RC_STATUS = 1 ORDER BY rc_recette_date_inscription ASC LIMIT 5";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getAllRecipes($limit) {
        $conn = self::connexion();
        $limitInt = intval($limit); 
        $query = "SELECT * FROM RECETTE WHERE RC_STATUS = 1 LIMIT $limitInt"; 
        $stmt = $conn->prepare($query);
        $stmt->execute(); 
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public static function getIngredientFromRecipes($recetteId) {
        $conn = self::connexion();
        $query = "SELECT 
            RECETTE.RC_ID,
            RECETTE.RC_TITRE,
            INGREDIENT.INGR_INTITULE,
            INGREDIENT.INGR_DESC,
            RECETTE_INGREDIENT.RI_QUANTITE
        FROM RECETTE_INGREDIENT
        JOIN INGREDIENT ON RECETTE_INGREDIENT.RI_INGREDIENT = INGREDIENT.INGR_ID
        JOIN RECETTE ON RECETTE_INGREDIENT.RI_RECETTE = RECETTE.RC_ID
        WHERE RECETTE.RC_ID = ?
        ";

        $stmt = $conn->prepare($query);
    
        $stmt->execute(array($recetteId));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getRecipesByCategory($category){
        $conn = self::connexion();
        $query = "SELECT * FROM RECETTE WHERE RC_CATEGORIE = ? AND RC_STATUS = 1";
        $stmt = $conn->prepare($query);
        $stmt->execute(array($category));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getRecipeByName($recipeName) {
        $conn = self::connexion();
        $query = "SELECT * FROM RECETTE WHERE RC_TITRE = ? AND RC_STATUS = 1";
        $stmt = $conn->prepare($query);
        $stmt->execute(array($recipeName));
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getRecipesByIngredients($ingredientId) {
        $conn = self::connexion();
        $query = "SELECT * FROM RECETTE WHERE RC_ID IN (SELECT RI_RECETTE FROM RECETTE_INGREDIENT WHERE RI_INGREDIENT = ?) AND RC_STATUS = 1";
        $stmt = $conn->prepare($query);
        $stmt->execute(array($ingredientId));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getCommentaireByRecipe($recetteId){
        $conn = self::connexion();
        $query = "SELECT * FROM COMMENTAIRE WHERE COM_RECETTE_ID = ? AND COM_STATUS = 1";
        $stmt = $conn->prepare($query);
        $stmt->execute(array($recetteId));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getTitleRecipe(){
        $conn = self::connexion();
        $query = "SELECT RC_TITRE FROM RECETTE WHERE RC_STATUS = 1";
        $stmt->execute($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public static function deleteRecipe($recetteId) {
        try {
            $conn = self::connexion();
        
            $deleteIngredients = $conn->prepare('DELETE FROM RECETTE_INGREDIENT WHERE RI_RECETTE = ?');
            $deleteIngredients->execute([$recetteId]);
        
            $deleteRecette = $conn->prepare('DELETE FROM RECETTE WHERE RC_ID = ?');
            $deleteRecette->execute([$recetteId]);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        } 
    }

    public static function modifyRecipe($recetteTitre, $recetteContenu, $recetteResume, $recetteCategorie, $recetteId) {
        $conn = self::connexion();
        $query = "UPDATE RECETTE SET 
            RC_TITRE = ?,
            RC_CONTENU = ?,
            RC_RESUME = ?,
            RC_CATEGORIE = ?,
            RC_RECETTE_DATE_MODIFICATION = NOW()
            RC_STATUS = 0,
            WHERE RC_ID = ?";
        $stmt = $conn->prepare($query);
        
        try {
            $stmt->execute(array($recetteTitre, $recetteContenu, $recetteResume, $recetteCategorie, $recetteId));
            return $stmt->rowCount(); 
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }
    
    public static function addRecipe(){
        $conn = self::connexion();
        $query = "INSERT INTO RECETTE (RC_ID, RC_TITRE, RC_CONTENU, RC_RESUME, RC_CATEGORIE, RC_IMAGE, RC_RECETTE_DATE_CREATION, RC_RECETTE_DATE_MODIFICATION, RC_RECETTE_DATE_INSCRIPTION, RC_STATUS, RC_AUTEUR) 
        SELECT max_rc_id + 1, ?, ?, ?, ?, ?, NOW(), NOW(), NOW(), 0, ?
        FROM (SELECT MAX(rc_id) as max_rc_id FROM RECETTE) as sub";
        ;

        $stmt = $conn->prepare($query);

        try {
            $stmt->execute(array($_POST['RC_TITRE_A'], $_POST['RC_CONTENU_A'], $_POST['RC_RESUME_A'], $_POST['RC_CATEGORIE_A'], $_POST['RC_IMAGE_A'], $_SESSION['id']));
            return $stmt->rowCount();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return "Erreur lors de l'ajout de la recette.";
        }
    }
    
    public static function addCommentaireForRecipe($contenu, $pseudo, $recetteId){
        $conn = self::connexion();
        $query = "INSERT INTO COMMENTAIRE (COM_ID, COM_CONTENU, COM_USER, COM_RECETTE_ID, COM_STATUS) 
        SELECT max_com_id + 1, ?, ?, ?, 0 FROM (SELECT MAX(com_id) as max_com_id FROM COMMENTAIRE) as sub";

        $stmt = $conn->prepare($query);

        try {
            $stmt->execute(array($contenu, $pseudo, $recetteId));
            return $stmt->rowCount();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return "Erreur lors de l'ajout du commentaire.";
        }
    }
}


?>

