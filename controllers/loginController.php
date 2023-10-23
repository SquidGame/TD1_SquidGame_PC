<?php
require_once '../models/loginModel.php';

class LoginController {
    public static function showLoginApprovement($conn) {
        function validate($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        
        $email = isset($_POST['email']) ? validate($_POST['email']) : '';
        $password = isset($_POST['password']) ? validate($_POST['password']) : '';

        if($email && $password && isset($_POST['loginBtn'])) {
            if(empty($password)){
                header('Location: ../views/login.php?error=' . 'Please fill password field!');
                exit();
            } else if (empty($email)) {
                header('Location: ../views/login.php?error=' . 'Please fill email field!');
                exit();
            } else {
                $login = new LoginModel($email, $password);
                if($login->checkUser($conn)) {
                    echo 'b';
                } else {
                    echo 'a';
                }
            }
        }
    }
}
?>
