<?php

class HomeController extends AppController
{
    public function __construct(){
        $this->init();
    }

    public function init(){

            session_start();
            $data['title'] = 'Home';
            $data['mainContent'] = $this->render(APP_PATH.VIEWS.'homeView.html');
            echo $this->render(APP_PATH.VIEWS.'baseLayout.html', $data);   
        }
    }
