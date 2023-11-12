<?php

require('./models/recetteModel.php');

class RecetteController {
    public function showLatestRecipes() {
        $latestRecipes = RecetteModel::getLatestRecipes();
        require_once './views/page/accueil.php';
    }

    public function showAllRecipes() {
        $limit = isset($_GET['limit']) ? $_GET['limit'] : 4;
        $allRecipes = RecetteModel::getAllRecipes($limit);
        require_once './views/page/recette.php';
    }
    

    public function showRecipeWithDetail(){
        $recetteId = isset($_GET['recipe_id']) ? $_GET['recipe_id'] : null;
        
        if ($recetteId === null) {
            throw new Exception('Aucune recette n\'a été sélectionnée !');
        } else {
            $detailsRecipe = RecetteModel::getIngredientFromRecipes($recetteId);
            $commentaires = RecetteModel::getCommentaireByRecipe($recetteId);
            require_once './views/page/detail-recette.php';
        }
    }

    public function showRecipesByCategory(){
        $category = isset($_POST['category']) ? $_POST['category'] : null;
        
        if ($category === null) {
            throw new Exception('Aucune catégorie n\'a été sélectionnée !');
        } else {
            $recipesByCategory = RecetteModel::getRecipesByCategory($category);
            $allRecipes = $recipesByCategory;
            require_once './views/page/recette.php';
        }
    }

    public function showRecipesByName(){
        $name = isset($_GET['name']) ? $_GET['name'] : null;
        
        if ($name === null) {
            throw new Exception('Aucune nom n\'a été sélectionnée !');
        } else {
            $recipesByCategory = RecetteModel::getRecipeByName($name);
            require_once './views/page/recette.php';
        }
    }
    
    public function showRecipeByIngredients(){
        $ingredients = isset($_GET['ingredients']) ? $_GET['ingredients'] : null;
        
        if ($ingredients === null) {
            throw new Exception('Aucun ingredients n\'a été sélectionnée !');
        } else {
            $recipesByCategory = RecetteModel::getRecipesByIngredients($ingredients);
            require_once './views/page/recette.php';
        }
    }

    public function deleteRecipeById(){
        $recetteId = isset($_GET['recipe_id']) ? $_GET['recipe_id'] : null;
        
        if ($recetteId === null) {
            throw new Exception('Aucune recette n\'a été sélectionnée !');
        } else {
            RecetteModel::deleteRecipe($recetteId);
            header('Location: index.php?action=cuisto_panel');
        }
    } 
    
    public function modifyRecipeById(){
        $recetteId = isset($_GET['recipe_id']) ? $_GET['recipe_id'] : null;
        
        if ($recetteId === null) {
            throw new Exception('Aucune recette n\'a été sélectionnée !');
        } else {
            RecetteModel::modifyRecipe($_POST['RC_TITRE'], $_POST['RC_CONTENU'], $_POST['RC_RESUME'], $_POST['RC_CATEGORIE'], $recetteId);
            header('Location: index.php?action=cuisto_panel');
        }
    }

    public function addRecipeByCuisto(){
        $recetteTitre = isset($_POST['RC_TITRE_A']) ? $_POST['RC_TITRE_A'] : null;
        $recetteContenu = isset($_POST['RC_CONTENU_A']) ? $_POST['RC_CONTENU_A'] : null;
        $recetteResume = isset($_POST['RC_RESUME_A']) ? $_POST['RC_RESUME_A'] : null;
        $recetteCategorie = isset($_POST['RC_CATEGORIE_A']) ? $_POST['RC_CATEGORIE_A'] : null;
        $recetteImage = isset($_POST['RC_IMAGE_A']) ? $_POST['RC_IMAGE_A'] : null;
        $recetteAuteur = isset($_SESSION['id']) ? $_SESSION['id'] : null;
        
        if ($recetteTitre === null || $recetteContenu === null || $recetteResume === null || $recetteCategorie === null || $recetteImage === null || $recetteAuteur === null) {
            throw new Exception('Tous les champs ne sont pas remplis !');
        } else {
            RecetteModel::addRecipe($recetteTitre, $recetteContenu, $recetteResume, $recetteCategorie, $recetteImage, $recetteAuteur);
            header('Location: index.php?action=cuisto_panel');
        }
    }

    public function addCommentaireForRecipe(){
        $contenu = isset($_POST['contenu']) ? $_POST['contenu'] : null;
        $pseudo = isset($_SESSION['pseudo']) ? $_SESSION['pseudo'] : null;
        $recetteId = isset($_GET['recipe_id']) ? $_GET['recipe_id'] : null;
        
        if ($contenu === null || $pseudo === null || $recetteId === null) {
            throw new Exception('Tous les champs ne sont pas remplis !');
        } else {
            RecetteModel::addCommentaireForRecipe($contenu, $pseudo, $recetteId);
            header('Location: index.php?action=recipe_details&recipe_id='.$recetteId);
        }
    }
}

?>