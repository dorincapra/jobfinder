<?php

class CVController extends AppController
{
    public function __construct(){
        $this->init();
    }

    public function init(){
        //show the fields of the CV completed if completed 

        $data['mainContent'] = '';

        session_start();
        
        if(isset($_SESSION['user'])){



            $cv = new CVModel;


            if(isset($_SESSION['userId'])){

                $userId = $_SESSION['userId'];

                $hm = "Hello " . $_SESSION['user'] . ", you can edit your CV here";
                $data['mainContent'] .= $hm;



                //if the user already has a CV - populate the inputs with the values from DB
                if($cv->userHasCV($userId)){
                    $result = $cv->userHasCV($userId);
                    $data["age"] = $result['age'];
                    $data["experience"] = $result['experience'];
                    $data["lastSch"] = $result['lastSch'];
                    $data["title"] = "haha";
                }

            
                //get the userId from session to identify the correct CV in DB
                $userId = strval($_SESSION['userId']);

                if(isset($_POST['cvAge']) && isset($_POST['lastSch']) && $_POST['experience']){
                    $data["age"] = strval($_POST['cvAge']);
                    $data["lastSch"] = $_POST['lastSch'];
                    $data["experience"] = $_POST['experience'];

                    
                } else {
                    $age = '';
                    $lastSch = " ";
                    $experience = '';
                }
                $cv->findCV($userId, $data["age"], $data["lastSch"], $data["experience"]);
                //header('Location: ?page=applicant');  
            } 
        } else {
            //please login
        }

        echo $this->render(APP_PATH.VIEWS.'CVView.html', $data);

    }



}