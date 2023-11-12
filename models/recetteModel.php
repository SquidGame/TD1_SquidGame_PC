<?php

require_once('model.php');

class RecetteModel extends model {

    // Permet de récupérer les 5 dernières recettes qui ont été acceptées avec leurs images
    public static function getLatestRecipes() {
        $conn = self::connexion();
        // Ajouter une jointure avec la table des images
        $query = "SELECT RECETTE.*, IMAGE.IMG_NOM FROM RECETTE
                LEFT JOIN IMAGE ON RECETTE.RC_IMAGE = IMAGE.IMG_ID
                WHERE RECETTE.RC_STATUS = 1
                ORDER BY RECETTE.RC_RECETTE_DATE_INSCRIPTION DESC LIMIT 5"; // Utilisez DESC pour les plus récentes
        $stmt = $conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function getImageById($imageId) {
        $conn = self::connexion();
        $stmt = $conn->prepare("SELECT IMG_TYPE, IMG_BIN FROM image WHERE IMG_ID = ?");
        $stmt->execute(array($imageId));
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    //Permets de récupérer toutes les recettes qui ont été acceptée
    public static function getAllRecipes($limit) {
        $conn = self::connexion();
        $limitInt = intval($limit); 
        $query = "SELECT RECETTE.*, IMAGE.IMG_NOM FROM RECETTE
        LEFT JOIN IMAGE ON RECETTE.RC_IMAGE = IMAGE.IMG_ID
        WHERE RECETTE.RC_STATUS = 1
        ORDER BY RECETTE.RC_RECETTE_DATE_INSCRIPTION DESC LIMIT $limitInt"; 
        $stmt = $conn->prepare($query);
        $stmt->execute(); 
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    //Fonction de récupérer les ingrédients d'une recette
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

    //Permets de récupérer les ingrédients par catégorie d'ingrédients
    public static function getRecipesByCategory($category){
        $conn = self::connexion();
        $query = "SELECT * FROM RECETTE WHERE RC_CATEGORIE = ? AND RC_STATUS = 1";
        $stmt = $conn->prepare($query);
        $stmt->execute(array($category));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //Permets de récupérer les recettes par leur nom
    public static function getRecipeByName($recipeName) {
        $conn = self::connexion();
        $query = "SELECT * FROM RECETTE WHERE RC_TITRE = ? AND RC_STATUS = 1";
        $stmt = $conn->prepare($query);
        $stmt->execute(array($recipeName));
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    //Permets de récupérer les recettes par ingrédients
    public static function getRecipesByIngredients($ingredientId) {
        $conn = self::connexion();
        $query = "SELECT * FROM RECETTE WHERE RC_ID IN (SELECT RI_RECETTE FROM RECETTE_INGREDIENT WHERE RI_INGREDIENT = ?) AND RC_STATUS = 1";
        $stmt = $conn->prepare($query);
        $stmt->execute(array($ingredientId));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //Permets de récupérer les commentaires d'une recette
    public static function getCommentaireByRecipe($recetteId){
        $conn = self::connexion();
        $query = "SELECT * FROM COMMENTAIRE WHERE COM_RECETTE_ID = ? AND COM_STATUS = 1";
        $stmt = $conn->prepare($query);
        $stmt->execute(array($recetteId));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //Permets de récupérer le titre d'une recette
    public static function getTitleRecipe(){
        $conn = self::connexion();
        $query = "SELECT RC_TITRE FROM RECETTE WHERE RC_STATUS = 1";
        $stmt->execute($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    //Permets de supprimer une recette
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

    //Permets de modifier une recette
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
    
    public static function addRecipe($recetteTitre, $recetteContenu, $recetteResume, $recetteCategorie, $recetteImage, $recetteAuteur){
        $conn = self::connexion();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Vérifier si un fichier a été téléchargé et est une image
        if (isset($_FILES['RC_IMAGE_A']) && $_FILES['RC_IMAGE_A']['error'] == 0) {
            $img_nom = $_FILES['RC_IMAGE_A']['name'];
            $upload = "images/".$img_nom;

            // Déplacer le fichier téléchargé vers son emplacement final
            move_uploaded_file($_FILES['RC_IMAGE_A']['tmp_name'], $upload);

            // Préparer et exécuter la requête d'insertion pour la table 'image'
            $insertImage = "INSERT INTO IMAGE (IMG_NOM, IMG_DATE_AJOUT) VALUES (?, NOW())";
            $stmtImg = $conn->prepare($insertImage);
            $stmtImg->execute(array($img_nom));
    
            // Récupérer l'ID de l'image insérée
            $img_id = $conn->lastInsertId(); 
    
            // Utiliser l'ID de l'image pour la colonne RC_IMAGE dans la table 'RECETTE'
            $query = "INSERT INTO RECETTE (
                RC_ID, 
                RC_TITRE, 
                RC_CONTENU, 
                RC_RESUME, 
                RC_CATEGORIE, 
                RC_IMAGE, 
                RC_RECETTE_DATE_CREATION, 
                RC_RECETTE_DATE_MODIFICATION, 
                RC_RECETTE_DATE_INSCRIPTION, 
                RC_STATUS, 
                RC_AUTEUR
            ) SELECT 
                COALESCE(MAX(RC_ID), 0) + 1, 
                ?, ?, ?, ?, ?, 
                NOW(), NOW(), NOW(), 
                0, ?
            FROM 
                RECETTE";
            
        
            // Préparer et exécuter la requête d'insertion pour la table 'RECETTE'
            $stmt = $conn->prepare($query);
            $stmt->execute(array($recetteTitre, $recetteContenu, $recetteResume, $recetteCategorie, $img_id, $recetteAuteur));
            return $stmt->rowCount();
    
        } else {
            // Si aucun fichier n'a été téléchargé ou s'il y a une erreur, enregistrer l'erreur
            error_log("Erreur de téléchargement de fichier ou aucun fichier fourni.");
            return "Erreur lors de l'ajout de la recette.";
        }
    }
    
    //Permets d'ajouter un commentaire a une recette
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

