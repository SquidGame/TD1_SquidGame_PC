<?php ob_start(); ?>

<div class="admin-panel">
    <section>
        <h2>Gestion des recettes</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom de la recette</th>
                    <th>Date de création</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if(is_array($recipes)): ?>
                    <?php foreach ($recipes as $recipe): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($recipe['RC_ID']); ?></td>
                            <td><?php echo htmlspecialchars($recipe['RC_TITRE']); ?></td>
                            <td><?php echo htmlspecialchars($recipe['RC_RECETTE_DATE_CREATION']); ?></td>
                        
                            <td>
                                <button class="btn btn-red" onclick="location.href='../index.php?action=delete_recipe_admin&recipe_id=<?php echo $recipe['RC_ID']; ?>';">Suppimer</button>
                                <!-- Bouton pour ouvrir la modale -->
                            <button class="btn btn-yellow" onclick="openModal()">Modifier</button>

                            <!-- La modale -->
                            <div id="editRecipeModal" class="modal">
                                <!-- Contenu de la modale -->
                                <div class="modal-content">
                                    <span class="close-button" onclick="closeModal()">&times;</span>
                                    <h2>Modifier la Recette</h2>
                                    <form id="editRecipeForm" method="post" action="../index.php?action=modify_recipe_admin&recipe_id=<?php echo $recipe['RC_ID']; ?>">
                                        <input type="text" id="modalTitle" name="RC_TITRE" placeholder="Titre de la recette">

                                        <label for="RC_CONTENU_A">Contenu de la recette</label>
                                        <select multiple name="ingredients_add[]">
                                            <?php foreach($ingredients as $ingredient): ?>
                                                <option value="<?php echo $ingredient['INGR_ID']; ?>">
                                                    <?php echo $ingredient['INGR_INTITULE']; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>

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
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </section>

    <section>
        <h2>Recettes en attente de confirmation</h2>
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
            <!-- Permet d'afficher la liste des recette dans le pannel admin -->
            <?php if(is_array($recettes)): ?>
                    <?php foreach ($recettes as $recette): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($recette['RC_ID']); ?></td>
                        <td><?php echo htmlspecialchars($recette['RC_TITRE']); ?></td>
                        <td><?php echo htmlspecialchars($recette['RC_RECETTE_DATE_CREATION']); ?></td>
                        <td><?php
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
                        ?></td>
                        <td>
                            <button class="btn btn-blue" onclick="location.href='../index.php?action=recipe_details&recipe_id=<?php echo $recette['RC_ID']; ?>';">Voir</button>
                            
                            <form method="post" action="../index.php?action=accept_recipe">
                                <input type="hidden" name="recipe_id" value="<?php echo $recette['RC_ID']; ?>">
                                <button class="btn btn-green">Accepter</button>
                            </form>

                            <form method="post" action="../index.php?action=refuse_recipe">
                                <input type="hidden" name="recipe_id" value="<?php echo $recette['RC_ID']; ?>">
                                <button class="btn btn-red">Refuser</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="5">Aucune recette trouvée.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </section>

    <section>
        <h2>Commentaires en attente de confirmation</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom de l'utilisateur</th>
                    <th>Contenu du commentaire</th>
                    <th>Status commentaire</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php if(is_array($commentaires)): ?>
                <?php foreach ($commentaires as $commentaire): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($commentaire['COM_ID']); ?></td>
                        <td><?php echo htmlspecialchars($commentaire['COM_USER']); ?></td>
                        <td><?php echo htmlspecialchars($commentaire['COM_CONTENU']); ?></td>
                        <td><?php
                            switch ($commentaire['COM_STATUS']) {
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
                        ?></td>
                        <td>
                            <form method="post" action="../index.php?action=accept_commentaire">
                                <input type="hidden" name="comment_id" value="<?php echo $commentaire['COM_ID']; ?>">
                                <button class="btn btn-green">Accepter</button>
                            </form>

                            <form method="post" action="../index.php?action=refuse_commentaire">
                                <input type="hidden" name="comment_id" value="<?php echo $commentaire['COM_ID']; ?>">
                                <button class="btn btn-red">Refuser</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </section>

    <section>
        <h2>Gestion des comptes utilisateurs</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Email</th>
                    <th>Date création</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php if(is_array($users)): ?>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($user['USR_ID']); ?></td>
                        <td><?php echo htmlspecialchars($user['USR_NOM']); ?></td>
                        <td><?php echo htmlspecialchars($user['USR_PRENOM']); ?></td>
                        <td><?php echo htmlspecialchars($user['USR_EMAIL']); ?></td>
                        <td><?php echo htmlspecialchars($user['USR_DATE_INSCRIPTION']); ?></td>
                        <td><?php
                            switch ($user['USR_STATUT']) {
                                case 0:
                                    echo 'Banni';
                                    break;
                                case 1:
                                    echo 'Actif';
                                    break;
                                default:
                                    echo 'Indéfini';
                            }
                        ?></td>
                        <td>
                        <?php if ($user['USR_STATUT'] == 0) : ?>
                            <form method="post" action="../index.php?action=unban_user">
                                <input type="hidden" name="user_id" value="<?php echo $user['USR_ID']; ?>">
                                <button class="btn btn-green">Débannir</button>
                            </form>
                        <?php elseif ($user['USR_STATUT'] == 1) : ?>
                            <form method="post" action="../index.php?action=ban_user">
                                <input type="hidden" name="user_id" value="<?php echo $user['USR_ID']; ?>">
                                <button class="btn btn-red">Bannir</button>
                            </form>
                        <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
    </section>
</div>

<style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .admin-panel {
            width: 85%;
            margin: 20px 20px 5rem 20px;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
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

        h2 {
            margin: 20px;
            color: #0275d8;
            font-weight: bold;
            font-size: 1.5em;
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
    </style>
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
    </script>
<?php $content = ob_get_clean(); 
require('./views/template.php'); ?>
