<?php

require('./models/recetteModel.php');

class RecetteController {

    public function showLatestRecipes() {
        $latestRecipes = RecetteModel::getLatestRecipes();
        require_once './views/page/accueil.php';
    }

    //Fait appel à la fonction getAllRecipes dans le modèle pour montrer toutes les recettes
    public function showAllRecipes() {
        $limit = isset($_GET['limit']) ? $_GET['limit'] : 4;
        $allRecipes = RecetteModel::getAllRecipes($limit);
        require_once './views/page/recette.php';
    }
    
    //Fait appel à la fonction getIngredientFromRecipes et getCommentaireByRecip dans le modèle pour afficer une recette en détail
    public function showRecipeWithDetail(){
        $recetteId = isset($_GET['recipe_id']) ? $_GET['recipe_id'] : null;
        
        if ($recetteId === null) {
            throw new Exception('Aucune recette n\'a été sélectionnée !');
        } else {
            $detailsRecipe = RecetteModel::getIngredientFromRecipes($recetteId);
            $image = RecetteModel::getImagesByRecipe($recetteId);
            $commentaires = RecetteModel::getCommentaireByRecipe($recetteId);
            require_once './views/page/detail-recette.php';
        }
    }

    //Fait appel à la fonction getRecipeByCategory dans le modèle pour afficher une recette en fonction de la catégorie
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

    //Fait appel à la fonction getRecipeByName dans le modèle pour afficher une recette par son nom
    public function showRecipesByName(){
        $name = isset($_GET['name']) ? $_GET['name'] : null;
        
        if ($name === null) {
            throw new Exception('Aucune nom n\'a été sélectionnée !');
        } else {
            $recipesByCategory = RecetteModel::getRecipeByName($name);
            require_once './views/page/recette.php';
        }
    }
    
    //Fait appel à la fonction getRecipesByIngredients dans le modèle pour filtrer les recettes par ingrédients
    public function showRecipeByIngredients(){
        $ingredients = isset($_GET['ingredients']) ? $_GET['ingredients'] : null;
        
        if ($ingredients === null) {
            throw new Exception('Aucun ingredients n\'a été sélectionnée !');
        } else {
            $recipesByCategory = RecetteModel::getRecipesByIngredients($ingredients);
            require_once './views/page/recette.php';
        }
    }

    //Fait appel à la fonction deleteRecipe dans le modèle pour supprimer une recette
    public function deleteRecipeById(){
        $recetteId = isset($_GET['recipe_id']) ? $_GET['recipe_id'] : null;
        
        if ($recetteId === null) {
            throw new Exception('Aucune recette n\'a été sélectionnée !');
        } else {
            RecetteModel::deleteRecipe($recetteId);
            header('Location: index.php?action=cuisto_panel');
        }
    } 

        //Fait appel à la fonction deleteRecipe dans le modèle pour supprimer une recette
        public function deleteRecipeByIdByAdmin(){
            $recetteId = isset($_GET['recipe_id']) ? $_GET['recipe_id'] : null;
            
            if ($recetteId === null) {
                throw new Exception('Aucune recette n\'a été sélectionnée !');
            } else {
                RecetteModel::deleteRecipe($recetteId);
                header('Location: index.php?action=admin_panel');
            }
        } 

    //Fait appel à la fonction modifyRecipe dans le modèle pour modifier une recette
    public function modifyRecipeById(){
        $recetteId = isset($_GET['recipe_id']) ? $_GET['recipe_id'] : null;
        
        $selectedIngredients = isset($_POST['ingredients']) ? $_POST['ingredients'] : [];
        $recetteContenu = implode(", ", $selectedIngredients);

        if ($recetteId === null) {
            throw new Exception('Aucune recette n\'a été sélectionnée !');
        } else {
            RecetteModel::modifyRecipe($_POST['RC_TITRE'], $recetteContenu, $_POST['RC_RESUME'], $_POST['RC_CATEGORIE'], $recetteId);
            header('Location: index.php?action=cuisto_panel');
        }
    }

    //Fait appel à la fonction addRecipe dans le modèle pour ajouter une recette
    public function addRecipeByCuisto(){
        $recetteTitre = isset($_POST['RC_TITRE_A']) ? $_POST['RC_TITRE_A'] : null;
        $selectedIngredients = isset($_POST['ingredients_add']) ? $_POST['ingredients_add'] : [];
        $recetteContenu = implode(", ", $selectedIngredients);
        $recetteResume = isset($_POST['RC_RESUME_A']) ? $_POST['RC_RESUME_A'] : null;
        $recetteCategorie = isset($_POST['RC_CATEGORIE_A']) ? $_POST['RC_CATEGORIE_A'] : null;
        $recetteImage = isset($_FILES['RC_IMAGE_A']) && $_FILES['RC_IMAGE_A']['error'] == 0;
        $recetteAuteur = isset($_SESSION['id']) ? $_SESSION['id'] : null;
        
        if ($recetteTitre === null || $recetteContenu === null || $recetteResume === null || $recetteCategorie === null || !$recetteImage || $recetteAuteur === null) {
            throw new Exception('Tous les champs ne sont pas remplis !');
        } else {
            RecetteModel::addRecipe($recetteTitre, $recetteContenu, $recetteResume, $recetteCategorie, $recetteImage, $recetteAuteur, $selectedIngredients);
            header('Location: index.php?action=cuisto_panel');
        }
    }

    //Fait appel à la fonction addCommentaireForRecipe dans le modèle pour ajouter un commentaire à une recette
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