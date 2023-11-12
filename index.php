<?php 
session_start();
ob_start();
require('./controllers/recetteController.php');
require('./controllers/loginController.php');
require('./controllers/membreController.php');

    if(isset($_GET['action'])) {
        //Vérifie si l'utilisateur veut se connecter avec un compte déjà existant
        if($_GET['action'] == "userlogin") {
            if (isset($_POST['username']) && isset($_POST['password'])) {
                $member = new loginController();
                $member->connexionUser($_POST['username'], $_POST['password']);
            } else {
                throw new Exception('Tous les champs ne sont pas remplis !');
            }
        }

        //Vérifie si l'utilisateur veut se créer un nouveau compte
        else if($_GET['action'] == "userregister"){
            if (isset($_POST['username']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['password']) && isset($_POST['password2']) && isset($_POST['email'])) {
                if($_POST['password'] == $_POST['password2']){
                    $member = new loginController();
                    $member->saveUser($_POST['username'], $_POST['nom'], $_POST['prenom'], $_POST['password'], $_POST['email']);
                } else {
                    throw new Exception('Les mots de passe ne correspondent pas !');
                }
            } else {
                throw new Exception('Tous les champs ne sont pas remplis !');
            }
        }

        //Vérifie les autres action possible par l'utilisateur depuis l'index.php
        else if($_GET['action'] == "allrecipes") {
            $allRecipe = new recetteController();
            $allRecipes = $allRecipe->showAllRecipes();
        }

        else if($_GET['action'] == "user_panel") {
            $panel = new MembreController();
            $panel->showMemberInformation();
        }

        else if($_GET['action'] == "cuisto_panel" && $_SESSION['type'] == "Cuisto" || $_GET['action'] == "cuisto_panel" && $_SESSION['type'] == "Administrateur") {
            $panel = new MembreController();
            $panel->showCuistoInformation();
        } 

        else if($_GET['action'] == "admin_panel" && $_SESSION['type'] == "Administrateur") {
            $panel = new MembreController();
            $panel->showAdminPanel();
        } 

        else if($_GET['action'] == "recipe_details") {
            $allRecipe = new recetteController();
            $allRecipe->showRecipeWithDetail();
        }

        else if($_GET['action'] == "delete_recipe") {
            $deleteRecipe = new recetteController();
            $deleteRecipe->deleteRecipeById();
        }

        else if($_GET['action'] == "delete_recipe_admin") {
            $deleteRecipe = new recetteController();
            $deleteRecipe->deleteRecipeByIdByAdmin();
        }

        else if($_GET['action'] == "modify_recipe") {
            $modifyRecipe = new recetteController();
            $modifyRecipe->modifyRecipeById();
        }

        else if($_GET['action'] == "modify_recipe_admin") {
            $modifyRecipe = new recetteController();
            $modifyRecipe->modifyRecipeByIdByAdmin();
        }
        
        else if($_GET['action'] == "add_recipe"){
            $addRecipe = new recetteController();
            $addRecipe->addRecipeByCuisto();
        }
        
        else if($_GET['action'] == "add_commentaire"){
            $commentaire = new recetteController();
            $commentaire->addCommentaireForRecipe();
        }

        else if($_GET['action'] == "modify_account"){
            $modify = new MembreController();
            $modify->modifyUserInformation();
        }

        else if($_GET['action'] == "delete_account"){
            $modify = new MembreController();
            $modify->deleteUser();
        }

        else if($_GET['action'] == "recipe_by_categorie"){
            $recipes = new recetteController();
            $recipes->showRecipesByCategory();
        }
        
        else if($_GET['action'] == "recipe_by_name"){
            $recipes = new recetteController();
            $recipes->showRecipesByName();
        }
        else if($_GET['action'] == "recipe_by_ingredient"){
            $recipes = new recetteController();
            $recipes->showRecipeByIngredients();
        }
        else if($_GET['action'] == "accept_recipe"){
            $accept = new membreController();
            $accept->acceptRecipe();
        }

        else if($_GET['action'] == "refuse_recipe"){
            $deny = new membreController();
            $deny->refuseRecipe();
        }

        else if($_GET['action'] == "accept_commentaire"){
            $accept = new membreController();
            $accept->acceptCommentaire();
        }

        else if($_GET['action'] == "refuse_commentaire"){
            $deny = new membreController();
            $deny->refuseCommentaire();
        }

        else if($_GET['action'] == "ban_user"){
            $ban = new membreController();
            $ban->banUser();
        }

        else if($_GET['action'] == "unban_user"){
            $unban = new membreController();
            $unban->unbanUser();
        }
        
    } else {
        $recette = new recetteController();
        $recettes = $recette->showLatestRecipes();    
    }
?>