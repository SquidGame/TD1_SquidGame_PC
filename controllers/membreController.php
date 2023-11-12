<?php

require('./models/membreModel.php');

class MembreController {
    public function showMemberInformation() {
        $userId = $_SESSION['id']; 
        $userInfo = MembreModel::getAllUserInfo($userId);
        require_once './views/page/user-panel.php';
    }

    public function showCuistoInformation() {
        $cuistoId = $_SESSION['id'];
        $userInfo = MembreModel::getAllRecipesFromUser($cuistoId);
        require_once './views/page/cuisto-panel.php';
    }

    public function showAdminPanel() {
        $adminId = $_SESSION['id'];
        $recettes = MembreModel::getAllAwaitingRecipe();
        $commentaires = MembreModel::getAllAwaitingComment();
        $users = MembreModel::getAllUser();
        require_once './views/page/admin-panel.php';
    }

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

    public function acceptRecipe(){
        $recipeId = isset($_POST['recipe_id']) ? $_POST['recipe_id'] : null;
        MembreModel::acceptRecipe($recipeId);
        header('Location: index.php?action=admin_panel');
    }

    public function refuseRecipe(){
        $recipeId = isset($_POST['recipe_id']) ? $_POST['recipe_id'] : null;
        MembreModel::refuseRecipe($recipeId);
        header('Location: index.php?action=admin_panel');
    }

    public function acceptCommentaire(){
        $commentId = isset($_POST['comment_id']) ? $_POST['comment_id'] : null;
        MembreModel::acceptCommentaire($commentId);
        header('Location: index.php?action=admin_panel');
    }

    public function refuseCommentaire(){
        $commentId = isset($_POST['comment_id']) ? $_POST['comment_id'] : null;
        MembreModel::refuseCommentaire($commentId);
        header('Location: index.php?action=admin_panel');
    }

    public function banUser(){
        $userId = isset($_POST['user_id']) ? $_POST['user_id'] : null;
        MembreModel::banUser($userId);
        header('Location: index.php?action=admin_panel');
    }

    public function unbanUser(){
        $userId = isset($_POST['user_id']) ? $_POST['user_id'] : null;
        MembreModel::unbanUser($userId);
        header('Location: index.php?action=admin_panel');
    }
}

?>