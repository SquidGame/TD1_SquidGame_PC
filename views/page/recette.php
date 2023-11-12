<?php ob_start(); ?>

<!-- Style de la page -->
<style>
    .recipe-section:hover {
        background-color: #c5c7c5;
        color: #ffffff;
    }

    .load-more-button {
        display: block; 
        text-align: center;
        margin: 20px 20px 5rem 20px;
        padding: 10px;
        background-color: #4CAF50;
        color: white;
        text-decoration: none;
        border-radius: 5px;
    }

</style>

<!-- Permet d'afficher les recettes dans la page "Nos recettes" -->
<?php foreach ($allRecipes as $recipe) : ?>
    <section class="recipe-section" onclick="location.href='../index.php?action=recipe_details&recipe_id=<?php echo $recipe['RC_ID']; ?>';">
        <img alt="recipe-image-<?= $recipe['RC_ID'] ?>" src="../images/houmous.jpg" class="recipe-image">
        <article class="recipe-details">
            <h2 class="recipe-title"><?= $recipe['RC_TITRE'] ?></h2>
            <p class="recipe-content"><?= $recipe['RC_CONTENU'] ?></p>
            <p class="recipe-autor"> - Réalisé par : <?= $recipe['RC_AUTEUR'] ?></p>
        </article>
    </section>
<?php endforeach; ?>

<!-- Permet d'ajouter 4 recette à l'affichage de la page des recettes -->
<?php
    $newLimit = (isset($_GET['limit']) ? intval($_GET['limit']) : 4) + 4;
?>

<a href="../index.php?action=allrecipes&limit=<?php echo $newLimit; ?>" class="load-more-button">Voir plus</a>


<?php $content = ob_get_clean(); 
require('./views/template.php') ?>