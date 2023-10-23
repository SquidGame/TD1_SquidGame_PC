<?php

class LoginModel {
    public $email;
    public $password;

    public function __construct($email, $password) {
        $this->email = $email;
        $this->password = $password;
    }

    public function checkUser($conn) {
        $query = "SELECT * FROM UTILISATEUR WHERE usr_email = :email AND usr_password = :password";
        $stmt = $conn->prepare($query);
        $stmt->bindValue(':email', $this->email);
        $stmt->bindValue(':password', $this->password);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }    
}

?>