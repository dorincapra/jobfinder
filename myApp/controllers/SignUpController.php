<?php

class SignUpController extends AppController
{
    public function __construct(){
        $this->init();
    }

    public function init(){
        
        $uName = $_POST['signUpName'];
        $uPass = $_POST['signUpPass1'];
        $accType = $_POST['signUpType'];
        $uEmail = $_POST['emailSignUp'];

        $user = new UsersModel;

        if($user->addUser($uEmail, $uName, $uPass, $accType)){
            
            
            session_start();            
            $_SESSION['user'] = $uName;
            $_SESSION['email'] = $uEmail;
            $_SESSION['pass'] = $uPass;
            $_SESSION['accType'] = $accType;


            header('Location: ?page=login');
        }
        else {
            var_dump( $user->addUser($uEmail, $uName, $uPass, $accType))  ;
        }



    }
}