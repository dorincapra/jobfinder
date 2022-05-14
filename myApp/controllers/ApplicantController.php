<?php

class ApplicantController extends AppController
{
    public function __construct(){
        $this->init();
    }

    public function init(){
        session_start();
        $jobModel = new JobModel;

        if(isset($_SESSION['user'])){
            $hm = "Bine ai venit " . $_SESSION['user'] . "!";
            $data['mainContent'] = $hm;

            //show a list of jobs - from jobModel->showJobs();
            $showJobs = "<div class='container-fluid my-2'>";
            $showJobs .= "<h1>Lapte</h1>";
            $showJobs .= "</div>";

            if($jobModel->showJobs()){
                $result = $jobModel->showJobs();
                $displayString = '';
              

                foreach($result as $result){
                  //display each job
                  $displayString .= $jobModel->displayJob($result);
                }
                $data['mainContent'] .= $displayString;
            }
            else $data['mainContent'] .= "nu a mers(sa faci o pagina cu eroare)";

        }

        echo $this->render(APP_PATH.VIEWS.'baseLayout.html', $data);

    }
}