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

            //verifica daca userul e logat si ce fel de user este
            if(isset($_SESSION['user'])){ 

                if($_SESSION['accType'] == 'applicant'){
                    
                    //route to applicantController
                    header('Location: ?page=applicant');

                    
                    //$data['mainContent'] = $this->render(APP_PATH.VIEWS.'applicantView.html');

                    // $q = "SELECT * FROM `users` WHERE `name`= ? ";
                    // $myPrep = $this->db()->prepare($q);
                    // $myPrep->bind_param("s", $_SESSION['user']);
                    // $myPrep->execute();
                    // $result = $myPrep->get_result()->fetch_assoc();


                    //$data['details'] = var_dump($result);
                   // $data['details'] =  $result;

                   

                }
                else if($_SESSION['accType'] == 'employer') {
                    //identify the employer in the DB and show their details

                    $q = "SELECT * FROM `users` WHERE `name`= ? ";
                    $myPrep = $this->db()->prepare($q);
                    $myPrep->bind_param("s", $_SESSION['user']);
                    $myPrep->execute();
                    $result = $myPrep->get_result()->fetch_assoc();

                    $data['details'] = $result;

                    $data['mainContent'] = $this->render(APP_PATH.VIEWS.'employerView.html');
                }
            }
            
        }
        else {
            echo '<h1 style="color:red">You are NOT allowed!</h1>';
            header('Location: ?page=home');
        }



    }
}