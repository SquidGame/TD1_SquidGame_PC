<?php

require('./models/membreModel.php');

class MembreController {

    //Montre les information d'un membre
    public function showMemberInformation() {
        $userId = $_SESSION['id']; 
        $userInfo = MembreModel::getAllUserInfo($userId);
        require_once './views/page/user-panel.php';
    }

    //Montre les informations d'un cuisto
    public function showCuistoInformation() {
        $cuistoId = $_SESSION['id'];
        $userInfo = MembreModel::getAllRecipesFromUser($cuistoId);
        $ingredients = MembreModel::getAllIngredients();
        require_once './views/page/cuisto-panel.php';
    }

    //Affiche le panel admin
    public function showAdminPanel() {
        $adminId = $_SESSION['id'];
        $recettes = MembreModel::getAllAwaitingRecipe();
        $commentaires = MembreModel::getAllAwaitingComment();
        $users = MembreModel::getAllUser();
        $recipes = MembreModel::getAllRecipes();
        $ingredients = MembreModel::getAllIngredients();
        require_once './views/page/admin-panel.php';
    }

    //Fait appel à la fonction modifyUserInformation dans le modèle pour modifier les informations d'un utilisateur
    public function modifyUserInformation() {
        $userId = $_SESSION['id'];
        $pseudo = $_POST['USR_PSEUDO'];
        $email = $_POST['USR_EMAIL'];
        $prenom = $_POST['USR_PRENOM'];
        $nom = $_POST['USR_NOM'];
        $password = $_POST['password'];
        $_SESSION['pseudo'] = $pseudo;
    
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
        MembreModel::modifyUserInformation($userId, $pseudo, $email, $prenom, $nom, $hashedPassword);
        header('Location: index.php?action=user_panel');
    }

    //Fait appel à la fonction acceptRecipe dans le modèle pour accepter une recette
    public function acceptRecipe(){
        $recipeId = isset($_POST['recipe_id']) ? $_POST['recipe_id'] : null;
        MembreModel::acceptRecipe($recipeId);
        header('Location: index.php?action=admin_panel');
    }

    //Fait appel à la fonction refuseRecipe dans le modèle pour supprimer une recette
    public function refuseRecipe(){
        $recipeId = isset($_POST['recipe_id']) ? $_POST['recipe_id'] : null;
        MembreModel::refuseRecipe($recipeId);
        header('Location: index.php?action=admin_panel');
    }

    //Fait appel à la fonction acceptCommentaire dans le modèle pour accepter un commentaire
    public function acceptCommentaire(){
        $commentId = isset($_POST['comment_id']) ? $_POST['comment_id'] : null;
        MembreModel::acceptCommentaire($commentId);
        header('Location: index.php?action=admin_panel');
    }

    //Fait appel à la fonction refuseCommentaire dans le modèle pour refuser un commentaire
    public function refuseCommentaire(){
        $commentId = isset($_POST['comment_id']) ? $_POST['comment_id'] : null;
        MembreModel::refuseCommentaire($commentId);
        header('Location: index.php?action=admin_panel');
    }

    //Fait appel à la fonction banUser dans le modèle pour banir un utilisateur
    public function banUser(){
        $userId = isset($_POST['user_id']) ? $_POST['user_id'] : null;
        MembreModel::banUser($userId);
        header('Location: index.php?action=admin_panel');
    }

    //Fait appel à la fonction unbanUser dans le modèle pour débannir un utilisateur
    public function unbanUser(){
        $userId = isset($_POST['user_id']) ? $_POST['user_id'] : null;
        MembreModel::unbanUser($userId);
        header('Location: index.php?action=admin_panel');
    }

    //Fait appel à la fonction deleteUser dans le modèle pour supprimer un utilisateur
    public function deleteUser(){
        $userId = $_SESSION['id'] ? $_SESSION['id'] : null;
        $pseudo = $_SESSION['pseudo'] ? $_SESSION['pseudo'] : null;

        MembreModel::deleteUserInformation($userId, $pseudo);
        header('Location: ../views/page/logout.php');
    }
}

?>