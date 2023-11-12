<?php

require_once('model.php');

class LoginModel extends model {
    // Requête connexion utilisateur
    public function connexionUser($pseudo, $pass)
    {
        $db = $this->connexion();
        $req = $db->prepare('SELECT usr_id, usr_pseudo, usr_password, usr_type FROM UTILISATEUR WHERE usr_pseudo = ? AND usr_statut = 1');
        $req->execute(array($pseudo));
        return $req->fetch();
    }
    
    public function saveUser($pseudo, $nom, $prenom, $pass, $email) {
        $db = $this->connexion();
    
        // Obtenir le maximum usr_id
        $queryMaxId = 'SELECT MAX(usr_id) as max_id FROM UTILISATEUR';
        $maxIdResult = $db->query($queryMaxId);
        $maxIdRow = $maxIdResult->fetch(PDO::FETCH_ASSOC);
        $maxId = $maxIdRow['max_id'] + 1;
    
        // Préparation de la requête d'insertion
        $req = $db->prepare('INSERT INTO UTILISATEUR (usr_id, usr_pseudo, usr_nom, usr_prenom, usr_password, usr_email, USR_DATE_INSCRIPTION, usr_type, usr_statut) VALUES (?, ?, ?, ?, ?, ?, NOW(), \'Visiteur\', 1)');
    
        // Exécuter la requête avec le nouvel usr_id
        $req->execute(array($maxId, $pseudo, $nom, $prenom, $pass, $email));
    }
    
}

?>