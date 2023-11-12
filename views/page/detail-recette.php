<?php ob_start();  ?>


<style>
    .dashboard {
        max-width: 800px;
        margin: 2rem auto;
        padding: 1rem;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .dashboard h2 {
        color: #333;
        border-bottom: 2px solid #4CAF50;
        padding-bottom: 0.5rem;
        margin-bottom: 1rem;
    }

    .dashboard p {
        font-size: 1rem;
        line-height: 1.5;
        color: #555;
    }

    .dashboard p strong {
        color: #4CAF50;
    }

    .recipe-detail {
        margin-bottom: 1rem;
        padding: 1rem;
        background-color: #f9f9f9;
        border-left: 4px solid #4CAF50;
    }

    .recipe-detail p {
        margin: 0.5rem 0;
    }

    #chat-container {
        width: 100%;
        background-color: #f2f2f2;
        padding: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        margin-top: 2rem;

    }

    #chat-box {
        height: 300px;
        overflow-y: scroll;
        background-color: #fff;
        padding: 10px;
        border: 1px solid #ccc;
    }

    #chat-message {
        width: calc(100% - 90px);
        padding: 10px;
        margin-right: 10px;
    }

    #send-message {
        width: 80px;
        border: 2px solid black;
        margin-bottom: 5rem;
    }


</style>

<div class="dashboard">
    <?php if(empty($detailsRecipe)): ?>
        <p>Aucune recette trouvée ou détails indisponibles.</p>
    <?php else: ?>
        <h2><?php echo htmlspecialchars($detailsRecipe[0]['RC_TITRE']); ?></h2>
        <p><strong>ID Recette:</strong> <?php echo htmlspecialchars($detailsRecipe[0]['RC_ID']); ?></p>
        <?php foreach ($detailsRecipe as $detail): ?>
            <div class="recipe-detail">
                <p><strong>Ingrédient:</strong> <?php echo htmlspecialchars($detail['INGR_INTITULE']); ?></p>
                <p><strong>Description:</strong> <?php echo htmlspecialchars($detail['INGR_DESC']); ?></p>
                <p><strong>Quantité:</strong> <?php echo htmlspecialchars($detail['RI_QUANTITE']); ?></p>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
        <div id="chat-container">
            <h3>Commentaire en direct</h3>
            <div id="chat-box">
                <?php if (isset($commentaires)): ?>
                    <?php foreach ($commentaires as $comment): ?>
                        <p><strong><?php echo htmlspecialchars($comment['COM_USER']); ?></strong>: <?php echo htmlspecialchars($comment['COM_CONTENU']); ?></p>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <form method="post" action="index.php?action=add_commentaire&recipe_id=<?php echo $recetteId; ?>">
                <input name="contenu" type="text" id="chat-message" placeholder="Tapez votre message ici..." />
                <button id="send-message" type="submit">Envoyer</button>
            </form>
        </div>
</div>

<?php $content = ob_get_clean(); 
require('./views/template.php') ?>
