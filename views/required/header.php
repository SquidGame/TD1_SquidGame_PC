<nav class="bg-[#7890cd] flex flex-wrap	items-center justify-between ">
    <link rel="stylesheet" href="./styles/header-style.css">
    <div class="logo">
        <img class="image-navbar cursor-pointer	" alt="logo PtitCuisto" src="../images/logo.png">
    </div>
    <div class="nav-items flex flex-1 justify-end list-none text-[#fff] ">
        <li><a class="hover:text-[#ff3d00]" href="../index.php">Accueil</a></li>
        <li><a class="hover:text-[#ff3d00]" href="../index.php?action=allrecipes&limit=4">Nos recettes</a></li>
        <li class="submenu-parent relative">
            <a class="hover:text-[#ff3d00]" href="#">
                <span class="filter-text">Filtres</span>
                <span id="fleche" class="arrow-down fas fa-angle-down"></span>
            </a>
            <ul class="submenu" id="submenu">
                <li><a class="hover:text-[#ff3d00]" href="#" onclick="openModalCate()">Catégorie</a></li>
                <li><a class="hover:text-[#ff3d00]" href="#" onclick="openModalName()">Titre</a></li>
                <li><a class="hover:text-[#ff3d00]" href="#" onclick="openModalIng()">Ingrédients</a></li>
            </ul>
            
                <!-- Modales -->
                <div id="categorieModal" class="modal-filtre">
                    <div class="modal-content-filtre">
                        <span class="close-filtre" onclick="closeModalCate()">&times;</span>
                        <form action="../index.php?action=recipe_by_categorie" method="post">
                            <label for="categorie">Catégorie :</label>
                            <select name="category" id="categorie">
                                <option value="1">Entrée</option>
                                <option value="2">Plat</option>
                                <option value="3">Dessert</option>
                            </select>
                            <input type="submit" value="| Valider"/>
                        </form>
                    </div>
                </div>

                <div id="nameModal" class="modal-filtre">
                    <div class="modal-content-filtre">
                        <span class="close-filtre" onclick="closeModalName()">&times;</span>
                        <form action="../index.php?action=recipe_by_name" method="post">
                            <label for="titre">Titre :</label>
                            <select>
                                <?php foreach($recipesTitle as $recipeTitle): ?>
                                    <option value="<?php echo $recipeTitle['RC_ID']; ?>"><?php echo $recipeTitle['RC_TITRE']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <input type="submit" value="| Valider"/>
                        </form>
                    </div>
                </div>

                <div id="ingredientModal" class="modal-filtre">
                    <div class="modal-content-filtre">
                        <span class="close-filtre" onclick="closeModalIng()">&times;</span>
                        <form action="../index.php?action=recipe_by_ingredient" method="post">
                            <label for="ingredient">Ingredient :</label>
                            <select>
                                <?php foreach($ingredientsName as $ingredientName): ?>
                                    <option value="<?php echo $ingredientName['INGR_ID']; ?>"><?php echo $ingredientName['INGR_INTITULE']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <input type="submit" value="| Valider"/>
                        </form>
                    </div>
                </div>

                <script>
                    let openModalCate = () => {
                        document.getElementById('categorieModal').style.display = 'block';
                        document.getElementById('ingredientModal').style.display = 'none';
                        document.getElementById('nameModal').style.display = 'none';

                    }

                    let closeModalCate = () => {
                        document.getElementById('categorieModal').style.display = 'none';
                    }

                    let openModalName = () => {
                        document.getElementById('nameModal').style.display = 'block';
                        document.getElementById('categorieModal').style.display = 'none';
                        document.getElementById('ingredientModal').style.display = 'none';
                    }

                    let closeModalName = () => {
                        document.getElementById('nameModal').style.display = 'none';
                    }

                    let openModalIng = () => {
                        document.getElementById('ingredientModal').style.display = 'block';
                        document.getElementById('nameModal').style.display = 'none';
                        document.getElementById('categorieModal').style.display = 'none';
                    }

                    let closeModalIng = () => {
                        document.getElementById('ingredientModal').style.display = 'none';
                    }

                    window.onclick = (event) => {
                        if (event.target == document.getElementById('categorieModal')) {
                            document.getElementById('categorieModal').style.display = 'none';
                        }
                    }

                    window.onclick = (event) => {
                        if (event.target == document.getElementById('nameModal')) {
                            document.getElementById('nameModal').style.display = 'none';
                        }
                    }

                    window.onclick = (event) => {
                        if (event.target == document.getElementById('ingredientModal')) {
                            document.getElementById('ingredientModal').style.display = 'none';
                        }
                    }
                </script>
        </li>
        <li><a> | </a></li>
        <?php if (isset($_SESSION['type']) && $_SESSION['type'] == 'Administrateur'): ?>
            <li><a class="hover:text-[#ff3d00]" href="../index.php?action=admin_panel">Admin</a></li>
            <li><a class="hover:text-[#ff3d00]" href="../index.php?action=cuisto_panel">Cuisto</a></li>
        <?php endif; ?>
        <?php if (isset($_SESSION['type']) && $_SESSION['type'] == 'Cuisto'): ?>
            <li><a class="hover:text-[#ff3d00]" href="../index.php?action=cuisto_panel">Cuisto</a></li>
        <?php endif; ?>
        <li>
            <!-- Bouton de connexion dans la barre de navigation -->
            <?php if (isset($_SESSION['pseudo'])): ?>
                <li><a class="hover:text-[#ff3d00]" href="../index.php?action=user_panel"><?php echo htmlspecialchars($_SESSION['pseudo']); ?></a></li>
                <li><a class="hover:text-[#ff3d00]" href="./views/page/logout.php">Déconnexion</a></li>
            <?php else: ?>
                <li><a id="login-btn" class="hover:text-[#ff3d00]" type="submit">Connexion</a></li>
                <li><p>/</p></li>
                <li><a id="register-btn" class="hover:text-[#ff3d00]" type="submit">S'inscrire</a></li>
            <?php endif; ?>
        </li>
    </div>

    <!-- Modal de Connexion -->
    <div id="login-modal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full" style="z-index: 1000;">
        <!-- Modal content -->
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <!-- Modal header -->
            <div class="flex justify-between items-center mb-4">
                <h4 class="text-lg text-gray-900">Connexion</h4>
                <button id="close-modal" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm2-9H8v2h4V9z" clip-rule="evenodd"></path></svg>
                </button>
            </div>

            <?php if (isset($_SESSION['error_message'])): ?>
                <div class="error-message">
                    <?php echo htmlspecialchars($_SESSION['error_message']); ?>
                    <?php unset($_SESSION['error_message']); // Effacer le message après l'affichage ?>
                </div>
            <?php endif; ?>

            <!-- Modal body -->
            <form id="login-form" method="post" action="index.php?action=userlogin">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">Nom d'utilisateur</label>
                    <input name="username" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" placeholder="Entrez votre nom d'utilisateur">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">Mot de passe</label>
                    <input name="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" placeholder="Entrez votre mot de passe">
                </div>
                <div class="flex items-center justify-between">
                    <li><button id="login-btn" class="hover:text-[#ff3d00]" type="submit">Se connecter</button></li>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal d'Inscription -->
    <div id="register-modal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full" style="z-index: 1000;">
        <!-- Modal content -->
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <!-- Modal header -->
            <div class="flex justify-between items-center mb-4">
                <h4 class="text-lg text-gray-900">Inscription</h4>
                <button id="close-register-modal" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm2-9H8v2h4V9z" clip-rule="evenodd"></path></svg>
                </button>
            </div>
            <!-- Modal body -->
            <form id="register-form" method="post" action="index.php?action=userregister">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="register-username">Nom d'utilisateur</label>
                    <input name="username" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="register-username" type="text" placeholder="Choisissez un nom d'utilisateur">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="register-nom">Nom</label>
                    <input name="nom" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="register-nom" type="nom" placeholder="Entrez votre nom">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="register-prenom">Prenom</label>
                    <input name="prenom" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="register-prenom" type="prenom" placeholder="Entrez votre prenom">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="register-email">Email</label>
                    <input name="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="register-email" type="email" placeholder="Entrez votre email">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="register-password">Mot de passe</label>
                    <input name="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="register-password" type="password" placeholder="Choisissez un mot de passe">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="register-password">Confirmer votre mot de passe</label>
                    <input name="password2" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="register-password2" type="password" placeholder="Confirmer le mot de passe">
                </div>
                <div class="flex items-center justify-between">
                    <li><button id="register-btn" class="hover:text-[#ff3d00]" type="submit">S'inscrire</button></li>
                </div>
            </form>
        </div>
    </div>


    <div class="cancel-icon text-center text-[#fff] cursor-pointer">
        <span class="fas fa-times"></span>
    </div>
    <div class="menu-icon text-center text-[#fff] cursor-pointer">
        <span class="fas fa-bars"></span>
    </div>
    <script src="../app/header.js"></script>
</nav>

<style>
        /* Styles de la modale */
        .modal-filtre {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content-filtre {
            background-color: #7890cd;
            padding: 20px;
            border-radius: 5px;
            width: 50%;
            margin: 15% auto;
        }

        /* Styles pour le bouton de fermeture */
        .close-filtre {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close-filtre:hover,
        .close-filtre:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        #categorie{
            background-color: #2a3990;
        }
    </style>

<script>
    document.addEventListener('DOMContentLoaded', (event) => { // Permets de check que la page  bien été afficher avant qu'il soit traité par le Javascript.
        var modal = document.getElementById('login-modal');
        var btn = document.getElementById('login-btn');
        var span = document.getElementById('close-modal');
        
        btn.addEventListener('click', function(event) {
            event.preventDefault(); // Prévenir le comportement par défaut du lien
            modal.classList.remove('hidden');
        });
        
        span.addEventListener('click', function() {
            modal.classList.add('hidden');
        });

        window.addEventListener('click', function(event) {
            if (event.target == modal) {
                modal.classList.add('hidden');
            }
        });

        var modalr = document.getElementById('register-modal');
        var btnr = document.getElementById('register-btn');
        var spanr = document.getElementById('close-register-modal');

        btnr.addEventListener('click', function(event) {
            event.preventDefault(); // Prévenir le comportement par défaut du lien
            modalr.classList.remove('hidden');
        });

        spanr.addEventListener('click', function() {
            modalr.classList.add('hidden');
        });

        window.addEventListener('click', function(event) {
            if (event.target == modalr) {
                modalr.classList.add('hidden');
            }
        });
    });





</script>

