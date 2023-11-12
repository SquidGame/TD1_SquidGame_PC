<?php ob_start(); ?>

<style>
    .user-form {
        max-width: 500px;
        margin: 10rem auto;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .user-form h2 {
        text-align: center;
        margin-bottom: 20px;
    }

    .user-form input, .user-form button {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 5px;
        border: 1px solid #ddd;
    }

    .user-form button {
        background-color: #5cb85c;
        color: white;
        font-size: 16px;
        cursor: pointer;
    }

    .user-form button:hover {
        background-color: #4cae4c;
    }

    #delete-acc {
        background-color: #d9534f;
    }

    .modal-delete-acc{
        display: none;
    }

    #cancel-delete {
        background-color: #d9534f;
    }
</style>

<div class="user-form">
    <h2>Modifier vos informations</h2>
    <?php if (is_array($userInfo)): ?>
        <form action="../index.php?action=modify_account" method="post">
            <input type="text" name="USR_PSEUDO" placeholder="Pseudo" required value="<?php echo htmlspecialchars($userInfo['USR_PSEUDO'] ?? ''); ?>">
            <input type="email" name="USR_EMAIL" placeholder="Email" required value="<?php echo htmlspecialchars($userInfo['USR_EMAIL'] ?? ''); ?>">
            <input type="text" name="USR_PRENOM" placeholder="Prénom" value="<?php echo htmlspecialchars($userInfo['USR_PRENOM'] ?? ''); ?>">
            <input type="text" name="USR_NOM" placeholder="Nom" value="<?php echo htmlspecialchars($userInfo['USR_NOM'] ?? ''); ?>">
            <input type="password" name="password" placeholder="Nouveau mot de passe">
            <button type="submit">Mettre à jour</button>
        </form>

        <button id="delete-acc" type="submit" onclick="openModalDeleteAcc()">Supprimer le compte</button>

        <form action="../index.php?action=delete_account" method="post"> 
            <div class="modal-delete-acc">
                <p>Attention, cette action est irréversible.</p>
                <p>Si vous supprimez votre compte, vous ne pourrez plus vous connecter.</p>
                <p>Êtes-vous sûr de vouloir supprimer votre compte ?</p>
                <button id="confirm-delete" type="submit">Oui</button>
                <button id="cancel-delete" type="submit">Non</button</a>
            </div>
            <script>
                let modal = document.querySelector('.modal-delete-acc');
                let confirmDelete = document.querySelector('#confirm-delete');
                let cancelDelete = document.querySelector('#cancel-delete');
                let deleteAcc = document.querySelector('#delete-acc');

                function openModalDeleteAcc() {
                    modal.style.display = 'block';
                }

                confirmDelete.addEventListener('click', function() {
                    window.location.href = '../index.php?action=delete_account';
                });

                cancelDelete.addEventListener('click', function() {
                    modal.style.display = 'none';
                });

                window.addEventListener('click', function(event) {
                    if (event.target == modal) {
                        modal.style.display = 'none';
                    }
                });
            </script>
        </form>
    <?php else: ?>
        <p>Informations utilisateur non disponibles.</p>
    <?php endif; ?>
</div>


<?php $content = ob_get_clean(); 
require('./views/template.php') ?>
