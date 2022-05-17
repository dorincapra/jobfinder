<?php

class LoginController extends AppController
{
    public function __construct(){
        $this->init();
    }

    public function init(){
        

        //if there is an email set in the session - use it, otherwise take it from the Login form.
        if(isset($_SESSION['email'])){
            $uEmail = $_SESSION['email'];
        } else {
            $uEmail = $_POST['userEmail'];
        }
        
        //if there is a password set in the session - use it, otherwise take it from the Login form.
        if(isset($_SESSION['pass'])){
            $uPass = $_SESSION['pass'];
        } else {
            $uPass = $_POST['userPass'];
        }
        


    
        $user = new UsersModel;

      
        if($user->isAuth($uEmail, $uPass)){
            session_start();
            $data['mainContent'] = '<h1 style="color:green">Welcome!</h1>';
            $userDetails = $user->isAuth($uEmail, $uPass);
            $_SESSION['accType'] = $userDetails[0];
            $_SESSION['email'] = $uEmail;
            $_SESSION['user'] = $userDetails[1];
            $_SESSION['userId'] = $userDetails[2];

            //verifica daca userul e logat si ce fel de user este
            if(isset($_SESSION['user'])){ 

                if($_SESSION['accType'] == 'applicant'){
                    //route to applicantController
                    header('Location: ?page=applicant');     
                }
                else if($_SESSION['accType'] == 'employer') {
                    //redirect to employerController
                    header('Location: ?page=employer');                   
                }
            }
        }
        else {
            echo '<h1 style="color:red">You are NOT allowed!</h1>';
            header('Location: ?page=home');
        }
    }
}