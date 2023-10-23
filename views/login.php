<?php
    require_once("../controllers/loginController.php");
    require_once "../login/connexion.php";
    LoginController::showLoginApprovement($conn);
    require_once("../views/required/header.php");
?>

<link rel="stylesheet" href="../styles/login-page-style.css"> 

<main id="main-login">
    <body>
        <div class="login-container">
            <form method="post" action="" id="login-form">
                <?php if(isset($_GET['error'])){ ?>
                    <p class="error-message"><?php echo $_GET['error']; ?></p>
                <?php } ?>
                <label for="username" class="login-label">Email :</label>
                <input type="text" id="email" name="email" class="login-input">

                <label for="password" class="login-label">Mot de passe :</label>
                <input type="password" id="password" name="password" class="login-input">

                <button type="submit" name="loginBtn" class="login-btn">Connexion</button>
            </form>
            <div class="login-footer">
                <a href="chemin_vers_page_inscription.php" class="login-link">Créer un compte</a> | <a href="chemin_vers_mdp_oublie.php" class="login-link">Mot de passe oublié?</a>
            </div>
        </div>
    </body>
</main>

<?php
    require_once("../views/required/footer.php");
?>
