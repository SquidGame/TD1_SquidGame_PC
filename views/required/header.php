<nav class="bg-[#7890cd] flex flex-wrap	items-center justify-between ">
    <link rel="stylesheet" href="../styles/header-style.css">
    <div class="logo">
        <img class="image-navbar cursor-pointer	" alt="logo PtitCuisto" src="../images/logo.png">
    </div>
    <div class="nav-items flex flex-1 justify-end list-none text-[#fff] ">
        <li><a class="hover:text-[#ff3d00]" href="../index.php">Accueil</a></li>
        <li><a class="hover:text-[#ff3d00]" href="#">Nos recettes</a></li>
        <li class="submenu-parent relative">
            <a class="hover:text-[#ff3d00]" href="#">
                <span class="filter-text">Filtres</span>
                <span id="fleche" class="arrow-down fas fa-angle-down"></span>
            </a>
            <ul class="submenu" id="submenu">
                <li><a class="hover:text-[#ff3d00]" href="#">Catégorie</a></li>
                <li><a class="hover:text-[#ff3d00]" href="#">Titre</a></li>
                <li><a class="hover:text-[#ff3d00]" href="#">Ingrédient</a></li>
            </ul>
        </li>


        <li><a class="hover:text-[#ff3d00]" href="./views/login.php">Connexion</a></li>
    </div>
    <div class="cancel-icon text-center text-[#fff] cursor-pointer">
        <span class="fas fa-times"></span>
    </div>
    <div class="menu-icon text-center text-[#fff] cursor-pointer">
        <span class="fas fa-bars"></span>
    </div>
    <script src="../app/header.js"></script>
</nav>