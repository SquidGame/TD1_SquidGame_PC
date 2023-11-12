<?php ob_start(); ?>

<!-- Ajout de style pour le formulaire -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .dashboard {
            width: 85%;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .btn {
            display: inline-block;
            padding: 5px 10px;
            margin: 5px;
            border-radius: 5px;
            text-decoration: none;
            color: white;
        }
        .btn-green {
            background-color: #5cb85c;
        }
        .btn-red {
            background-color: #d9534f;
        }
        .btn-blue {
            background-color: #0275d8;
        }
        .btn-yellow {
            background-color: #f0ad4e;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 10% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 50%;
        }

        .close-button {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close-button:hover,
        .close-button:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        input[type=text],
        input[type=date],
        textarea {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type=submit] {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type=submit]:hover {
            background-color: #45a049;
        }

        label {
            margin-top: 10px;
        }

        select {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        select:focus {
            border-color: #4CAF50;
            outline: none;
        }

    </style>

    <div class="dashboard">
        <h1>Liste des Recettes</h1>
        <button class="btn btn-green" onclick="openModalA()">Ajouter une recette</button>

        <!-- La Modale -->
        <div id="addRecipeModal" class="modal">
            <div class="modal-content">
                <span class="close-button" onclick="closeModalA()">&times;</span>
                <form enctype="multipart/form-data" action="../index.php?action=add_recipe" method="post">
                    <label for="RC_TITRE_A">Titre de la recette</label>
                    <input type="text" id="RC_TITRE_A" name="RC_TITRE_A" required>

                    <label for="RC_CONTENU_A">Contenu de la recette</label>
                    <textarea id="RC_CONTENU_A" name="RC_CONTENU_A" required></textarea>

                    <label for="RC_RESUME_A">Résumé de la recette</label>
                    <textarea id="RC_RESUME_A" name="RC_RESUME_A" required></textarea>

                    <label for="RC_CATEGORIE_A">Catégorie de la recette</label>
                    <select id="RC_CATEGORIE_A" name="RC_CATEGORIE_A" required>
                        <option value="1">Entrée</option>
                        <option value="2">Plat</option>
                        <option value="3">Dessert</option>
                    </select>

                    <label for="RC_IMAGE_A">Image de la recette</label>
                    <input type="file" id="RC_IMAGE_A" name="RC_IMAGE_A" required>

                    <input type="submit" value="Ajouter la recette">
                </form>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom de la recette</th>
                    <th>Date de création</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if(is_array($userInfo)): ?>
                    <?php foreach ($userInfo as $recette): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($recette['RC_ID']); ?></td>
                        <td><?php echo htmlspecialchars($recette['RC_TITRE']); ?></td>
                        <td><?php echo htmlspecialchars($recette['RC_RECETTE_DATE_CREATION']); ?></td>
                        <td>
                            <?php
                                switch ($recette['RC_STATUS']) {
                                    case 0:
                                        echo 'En attente de confirmation';
                                        break;
                                    case 1:
                                        echo 'Confirmé';
                                        break;
                                    case 2:
                                        echo 'Refusé';
                                        break;
                                    default:
                                        echo 'Indéfini';
                                }
                            ?>
                        </td>
                        <td>
                            <button class="btn btn-blue" onclick="location.href='../index.php?action=recipe_details&recipe_id=<?php echo $recette['RC_ID']; ?>';">Voir</button>
                            <!-- Bouton pour ouvrir la modale -->
                            <button class="btn btn-yellow" onclick="openModal()">Modifier</button>

                            <!-- La modale -->
                            <div id="editRecipeModal" class="modal">
                                <!-- Contenu de la modale -->
                                <div class="modal-content">
                                    <span class="close-button" onclick="closeModal()">&times;</span>
                                    <h2>Modifier la Recette</h2>
                                    <form id="editRecipeForm" method="post" action="../index.php?action=modify_recipe&recipe_id=<?php echo $recette['RC_ID']; ?>">
                                        <input type="text" id="modalTitle" name="RC_TITRE" placeholder="Titre de la recette">

                                        <label for="modalContent">Contenu</label>
                                        <textarea id="modalContent" name="RC_CONTENU" placeholder="Contenu de la recette"></textarea>

                                        <label for="modalSummary">Résumé</label>
                                        <textarea id="modalSummary" name="RC_RESUME" placeholder="Résumé de la recette"></textarea>

                                        <label for="modalCategory">Catégorie</label>
                                        <select id="modalCategory" name="RC_CATEGORIE">
                                            <option value="1">Entrée</option>
                                            <option value="2">Plat</option>
                                            <option value="3">Dessert</option>
                                        </select>

                                        <input type="submit" value="Enregistrer les modifications">
                                    </form>
                                </div>
                            </div>

                            <button class="btn btn-red" onclick="location.href='../index.php?action=delete_recipe&recipe_id=<?php echo $recette['RC_ID']; ?>';">Delete</button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="5">Aucune recette trouvée.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <script>
        function openModal() {
            document.getElementById('editRecipeModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('editRecipeModal').style.display = 'none';
        }

        window.onclick = function(event) {
            if (event.target == document.getElementById('editRecipeModal')) {
                closeModal();
            }
        }

        function openModalA() {
            document.getElementById('addRecipeModal').style.display = 'block';
        }

        function closeModalA() {
            document.getElementById('addRecipeModal').style.display = 'none';
        }

    </script>

<?php $content = ob_get_clean(); 
require('./views/template.php') ?>

