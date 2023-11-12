<?php ob_start(); ?>

<style>
@import url('https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700&display=swap');
/* Style de l'accueil */
*{
  margin: 0;
  padding: 0;
  outline: none;
  box-sizing: border-box;
  font-family: 'Montserrat', sans-serif;
}

main {
    display: flex;
    flex-wrap: wrap;
    flex-direction: column;
    align-items: stretch;
    justify-content: center;
    gap: 10px;
}

.top-container {
    color: #7890cd;
    border: 1px #7890cd solid;
    flex-basis: 100%;
    margin: 10px;
    padding: 10px;
}

.container-wrapper {
    display: flex;
    flex-wrap: wrap;
}

.latest-recipes-container,
.aside-container {
    flex: 1;
    flex-basis: 45%;
}

.latest-recipes-container {
    border: 1px #7890cd solid;
    margin: 10px;
}

.recipe-image {
    max-width: 100px;
    height: auto;
    margin: 0 10px;
}

.recipe-section {
    display: flex;
    align-items: center; 
    border: 1px solid #7890cd;
    margin: 15px 10px 15px 10px;
    color: #7890cd;
}

.recipe-section:hover {
    background-color: #c5c7c5;
    color: #ffffff;
}

.recipe-details {
    flex: 1;
    padding: 4px;
    font-size: 17px;
}

.recipe-title {
    font-size: 23px;
    font-weight: bold;
    padding: 2px 2px 2px 0;
}

.latest-recipe-title {
    font-size: 50px;
    font-weight: bold;
    color: #7890cd;
    text-align: center;
}

.recipe-autor {
    font-size: 13px;
    font-weight: bold;
    padding: 5px 2px 2px 0;
    text-decoration: underline;
}

.edito-aside {
    text-align: center;
    background-color: #2a3990;
    border: 1px black solid;
    margin: 10px;
    padding: 20px;
    display: flex;
    flex-direction: column;
    align-items: center; 
}

.edito-image {
    max-width: 100%;
    display: block;
    margin: 0 auto;
}

.edito-title {
    font-size: 24px;
    font-weight: bold;
    color: #fff;
    padding: 10px;
    margin-top: 20px;
}

.edito-content {
    font-size: 16px;
    color: #fff;
}
</style>

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
                <!-- Permet d'afficher la liste des recettes sur la page d'accueil -->
                <?php foreach ($latestRecipes as $recipe) : ?> 
                    <section class="recipe-section" onclick="location.href='../index.php?action=recipe_details&recipe_id=<?php echo $recipe['RC_ID']; ?>';">
                        <!-- Mettez à jour l'attribut src pour pointer vers get_image.php avec l'ID de l'image -->
                        <img alt="recipe-image" src="../images/<?php echo $recipe['IMG_NOM']; ?>" class="recipe-image">
                        <article class="recipe-details">
                            <h2 class="recipe-title"><?= htmlspecialchars($recipe['RC_TITRE']) ?></h2>
                            <p class="recipe-content"><?= htmlspecialchars($recipe['RC_CONTENU']) ?></p>
                            <p class="recipe-autor"> - Réalisé par : <?= htmlspecialchars($recipe['RC_AUTEUR']) ?></p>
                        </article>
                    </section>
                <?php endforeach; ?>
            </div>
            <!-- Affichage de l'image à droite de la page d'accueil -->
            <div class="aside-container">
                <aside class="edito-aside">
                    <img alt="edito-image" src="../images/Pticuisto.png" class="edito-image">
                    <h2 class="edito-title">Edito</h2>
                    <p class="edito-content">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    </p>
                </aside>
            </div>
        </div>
    </div>
</main>

<?php $content = ob_get_clean(); 
require('./views/template.php') ?>
