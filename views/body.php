<?php
    require_once './login/connexion.php';
    require_once("./views/required/header.php");
?>

<main>
    <div class="page-container">
        <div class="top-container">
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed euismod, nisl quis tincidunt aliquam, nunc nisl ultrices odio, quis aliquam nunc nisl ut nunc. Sed euismod, nisl quis tincidunt aliquam, nunc nisl ultrices odio, quis aliquam nunc nisl ut nunc.
            </p>
        </div>
        <div class="container-wrapper">
            <div class="latest-recipes-container">
                <h1 class="latest-recipe-title">LES DERNIERES RECETTES</h1>
                
                <?php foreach ($latestRecipes as $recipe) : ?>
                    <section class="recipe-section">
                        <img alt="recipe-image-<?= $recipe['RC_ID'] ?>" src="../images/houmous.jpg" class="recipe-image">
                        <article class="recipe-details">
                            <h2 class="recipe-title"><?= $recipe['RC_TITRE'] ?></h2>
                            <p class="recipe-content"><?= $recipe['RC_CONTENU'] ?></p>
                            <p class="recipe-autor"> - Réalisé par : <?= $recipe['RC_AUTEUR'] ?></p>
                        </article>
                    </section>
                <?php endforeach; ?>
            
            </div>
            <div class="aside-container">
                <aside class="edito-aside">
                    <img alt="edito-image" src="../images/pticuisto.png" class="edito-image">
                    <h2 class="edito-title">Edito</h2>
                    <p class="edito-content">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    </p>
                </aside>
            </div>
        </div>
    </div>
</main>

<?php
    require_once("./views/required/footer.php");
?>