<?php

require_once('model.php');

class MembreModel extends model {
    //Fonction qui permet de récupérer toutes les informations d'un utilisateur
    public static function getAllUserInfo($userId) {
        $conn = self::connexion();

        $req = $conn->prepare('SELECT 
        USR_ID, USR_PSEUDO, 
        USR_EMAIL, 
        USR_PRENOM, 
        USR_NOM, 
        USR_DATE_INSCRIPTION, 
        USR_TYPE,
        USR_STATUT 
        FROM UTILISATEUR
        WHERE USR_ID = ?');

        $req->execute(array($_SESSION['id']));
        return $req->fetch();
    }

    public static function getAllRecipes(){
        $conn = self::connexion();

        $req = $conn->prepare('SELECT 	
        RC_ID,
        RC_TITRE,
        RC_CONTENU,
        RC_RESUME,
        RC_CATEGORIE,
        RC_RECETTE_DATE_INSCRIPTION,
        RC_IMAGE,
        RC_RECETTE_DATE_CREATION,
        RC_RECETTE_DATE_MODIFICATION,
        RC_STATUS,
        RC_AUTEUR
        FROM RECETTE
        WHERE RC_STATUS = 1');

        $req->execute();
        return $req->fetchAll();
    }

    //Fonction qui permet de récupérer les informations de tous les utilisateurs
    public static function getAllUser(){
        $conn = self::connexion();

        $req = $conn->prepare('SELECT 
        USR_ID, USR_PSEUDO, 
        USR_EMAIL, 
        USR_PRENOM, 
        USR_NOM, 
        USR_DATE_INSCRIPTION, 
        USR_TYPE,
        USR_STATUT 
        FROM UTILISATEUR');

        $req->execute();
        return $req->fetchAll();
    }

    //Fonction qui permet de ban un utilisateur
    public static function banUser($userId){
        $conn = self::connexion();

        $req = $conn->prepare('UPDATE UTILISATEUR
        SET USR_STATUT = 0
        WHERE USR_ID = ?');

        $req->execute(array($userId));
    }

    //Fonction qui permet de débannir un utilisateur
    public static function unbanUser($userId){
        $conn = self::connexion();

        $req = $conn->prepare('UPDATE UTILISATEUR
        SET USR_STATUT = 1
        WHERE USR_ID = ?');

        $req->execute(array($userId));
    }

    //Fonction qui permet de récupérer toutes les recettes provenant du même utilisateur
    public static function getAllRecipesFromUser($cuistoId){
        $conn = self::connexion();

        $req = $conn->prepare('SELECT 	
        RC_ID,
        RC_TITRE,
        RC_CONTENU,
        RC_RESUME,
        RC_CATEGORIE,
        RC_RECETTE_DATE_INSCRIPTION,
        RC_IMAGE,
        RC_RECETTE_DATE_CREATION,
        RC_RECETTE_DATE_MODIFICATION,
        RC_STATUS,
        RC_AUTEUR
        FROM RECETTE
        WHERE RC_AUTEUR = ?');

        $req->execute(array($_SESSION['id']));
        return $req->fetchAll();
    }

    //Fonction qui permet de modifier les information d'un utilisateur
    public static function modifyUserInformation($userId, $pseudo, $email, $prenom, $nom, $password) {
        $conn = self::connexion();

        $req = $conn->prepare('UPDATE UTILISATEUR
        SET USR_PSEUDO = ?, USR_EMAIL = ?, USR_PRENOM = ?, USR_NOM = ?, USR_PASSWORD = ?
        WHERE USR_ID = ?');

        $req->execute(array($pseudo, $email, $prenom, $nom, $password, $_SESSION['id']));
    }

    //Fonction qui permet de récupérer toutes les recettes qui sont "En attente"
    public static function getAllAwaitingRecipe(){
        $conn = self::connexion();
        $query = "SELECT * FROM RECETTE WHERE RC_STATUS = 0 ORDER BY rc_recette_date_inscription DESC";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //Fonction qui permet de récupérer toutes les commentaires qui sont en attente de vérification
    public static function getAllAwaitingComment(){
        $conn = self::connexion();
        $query = "SELECT * FROM COMMENTAIRE WHERE COM_STATUS = 0";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //Fonction qui permet de valider une recette
    public static function acceptRecipe($recipeId){
        $conn = self::connexion();
        $query = "UPDATE RECETTE SET RC_STATUS = 1 WHERE RC_ID = ?";
        $stmt = $conn->prepare($query);
        $stmt->execute(array($recipeId));
    }

    //Fonction qui permet de refuser une recette
    public static function refuseRecipe($recipeId){
        $conn = self::connexion();
        $query = "UPDATE RECETTE SET RC_STATUS = 2 WHERE RC_ID = ?";
        $stmt = $conn->prepare($query);
        $stmt->execute(array($recipeId));
    }

    //Fonction qui permet d'accepter un commentaire
    public static function acceptCommentaire($commentId){
        $conn = self::connexion();
        $query = "UPDATE COMMENTAIRE SET COM_STATUS = 1 WHERE COM_ID = ?";
        $stmt = $conn->prepare($query);
        $stmt->execute(array($commentId));
    }

    //Fonction qui permet de refuser un commentaire
    public static function refuseCommentaire($commentId){
        $conn = self::connexion();
        $query = "UPDATE COMMENTAIRE SET COM_STATUS = 2 WHERE COM_ID = ?";
        $stmt = $conn->prepare($query);
        $stmt->execute(array($commentId));
    }

    public static function getAllIngredients(){
        $conn = self::connexion();

        $req = $conn->prepare('SELECT 
        INGR_ID, INGR_INTITULE
        FROM INGREDIENT');

        $req->execute();
        return $req->fetchAll();
    }

    public static function deleteUserInformation($id, $pseudo){
        $conn = self::connexion();

        $req = $conn->prepare('DELETE FROM COMMENTAIRE WHERE COM_USER = ?');
        $req->execute(array($pseudo));

        $req = $conn->prepare('DELETE FROM RECETTE_INGREDIENT WHERE RI_RECETTE = (
            SELECT RC_ID FROM RECETTE WHERE RC_AUTEUR = ?)');
        $req->execute(array($id));

        $req = $conn->prepare('DELETE FROM RECETTE WHERE RC_AUTEUR = ?');
        $req->execute(array($id));

        $req = $conn->prepare('DELETE FROM UTILISATEUR WHERE USR_ID = ?');
        $req->execute(array($id));
    }
}
?>

