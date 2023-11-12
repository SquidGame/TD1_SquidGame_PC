<?php
require('./models/loginModel.php');

class loginController 
{
    public function connexionUser($pseudo, $pass)
    {
        $memberManager = new loginModel();
        
        $resultat = $memberManager->connexionUser($pseudo, $pass);
        
        if (!$resultat) { 
            $errorPseudo = 'Erreur d\'identifiant ou mot de passe';
        } 
        
        else { 
            $isPasswordCorrect = password_verify($pass, $resultat['usr_password']);

            if (!$isPasswordCorrect) { 
                $errorPassword = 'Erreur d\'identifiant ou mot de passe';
            } else { 
                $_SESSION['type'] = $resultat['usr_type']; 
                $_SESSION['id'] = $resultat['usr_id'];	
                $_SESSION['pseudo'] = $_POST['username'];
                header('location: index.php');
            }
        }
    } 

    public function saveUser($pseudo, $nom, $prenom, $pass, $email)
    {
        $memberManager = new loginModel();
        $passHache = password_hash($pass, PASSWORD_DEFAULT);
            
        $memberManager->saveUser($pseudo, $nom, $prenom, $passHache, $email);
        header('location: index.php');
    }

    public function deconnexion()
    {
        $_SESSION = array();
        session_destroy();
        header('location: index.php');
    }
}
?>
