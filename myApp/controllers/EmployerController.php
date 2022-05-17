<?php

class EmployerController extends AppController
{
    public function __construct(){
        $this->init();
    }

    public function init(){
        session_start();
        $cv = new CVModel;

        if(isset($_SESSION['user'])){
            $hm = "Bine ai venit " . $_SESSION['user'] . "!";
            $data['mainContent'] = $hm;


        }
        
        $data['mainContent'] .= "nu a mers(sa faci o pagina cu eroare)";
        
        echo $this->render(APP_PATH.VIEWS.'baseLayout.html', $data);

        }


}
