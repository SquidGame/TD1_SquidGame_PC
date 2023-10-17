<?php
    require_once('./admin/connexion.php');
?>

<link rel="stylesheet" href="../styles/style.css">

<main>
    <div class="page-container">
        <div class="top-container">
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                Nec ullamcorper sit amet risus nullam. Sem integer vitae justo eget magna. 
                Senectus et netus et malesuada fames. Consectetur lorem donec massa sapien faucibus et molestie ac feugiat. 
                Venenatis cras sed felis eget. Libero id faucibus nisl tincidunt eget nullam. In ante metus dictum at. 
                Molestie ac feugiat sed lectus. At in tellus integer feugiat scelerisque varius morbi enim. 
                Tortor posuere ac ut consequat semper. Morbi tristique senectus et netus.
            </p>
        </div>
        <div class="container-wrapper">
            <div class="latest-recipes-container">
                    <h1 class="page-title">LES DERNIERES RECETTES</h1>
                    <?php
                    $query = "SELECT * FROM (
                        SELECT * FROM RECETTE
                        ORDER BY RC_ID DESC
                        LIMIT 4
                    ) AS Subquery;
                    ";
                    $result = $bdd->query($query);
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        echo '<section class="recipe-section">';
                        echo '<img alt="recipe-image-' . $row['RC_ID'] . '" src="../images/houmous.jpg" class="recipe-image">';
                        echo '<article class="recipe-details">';
                        echo '<h2 class="recipe-title">' . $row['RC_TITRE'] . '</h2>';
                        echo '<p class="recipe-content">' . $row['RC_CONTENU'] . '</p>';
                        echo '</article>';
                        echo '</section>';
                    }
                    $result->closeCursor();
                    ?>
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
