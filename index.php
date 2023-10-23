<link rel="stylesheet" href="../styles/index-style.css">

<script src="https://kit.fontawesome.com/1db8493fd9.js" crossorigin="anonymous"></script>
<script src="https://cdn.tailwindcss.com"></script>

<?php
    require_once './login/connexion.php';

    require_once './controllers/recetteController.php';
    RecetteController::showLatestRecipes($conn);

?>
