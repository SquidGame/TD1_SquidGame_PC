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
        <!-- Assurez-vous que 'RC_IMAGE' contient l'ID de l'image de la recette -->
        <img alt="recipe-image" src="../images/<?php echo $recipe['IMG_NOM']; ?>" class="recipe-image">
        <article class="recipe-details">
            <h2 class="recipe-title"><?= htmlspecialchars($recipe['RC_TITRE']) ?></h2>
            <p class="recipe-content"><?= htmlspecialchars($recipe['RC_CONTENU']) ?></p>
            <p class="recipe-autor"> - Réalisé par : <?= htmlspecialchars($recipe['RC_AUTEUR']) ?></p>
        </article>
    </section>
<?php endforeach; ?>


<?php
// Vérifiez si le paramètre 'action' est présent dans l'URL et s'il est égal à 'allrecipes'
if (isset($_GET['action']) && $_GET['action'] == 'allrecipes') {
    // Récupérez la valeur de 'limit' si elle est définie, sinon utilisez une valeur par défaut
    $newLimit = (isset($_GET['limit']) ? intval($_GET['limit']) : 4) + 4
    ?>

    <!-- Affichez le bouton 'Voir plus' -->
    <a href="../index.php?action=allrecipes&limit=<?php echo htmlspecialchars($newLimit); ?>" class="load-more-button">Voir plus</a>

<?php
}
?>


<?php $content = ob_get_clean(); 
require('./views/template.php') ?>