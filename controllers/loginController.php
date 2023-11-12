<?php
require('./models/loginModel.php');

class loginController 
{
    public function connexionUser($pseudo, $pass)
    {
        $memberManager = new loginModel();
    
        $resultat = $memberManager->connexionUser($pseudo, $pass);
    
        if (!$resultat) { 
            $_SESSION['error_message'] = 'Erreur d\'identifiant ou mot de passe';
            header('location: index.php');
        } 
        else { 
            $isPasswordCorrect = password_verify($pass, $resultat['usr_password']);
    
            if (!$isPasswordCorrect) { 
                $_SESSION['error_message'] = 'Erreur d\'identifiant ou mot de passe';
            } else { 
                $_SESSION['type'] = $resultat['usr_type']; 
                $_SESSION['id'] = $resultat['usr_id'];	
                $_SESSION['pseudo'] = $pseudo;
                header('location: index.php');
                exit();
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
