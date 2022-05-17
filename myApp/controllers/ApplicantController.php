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
            $data['mainContent'] .= $this->render(APP_PATH.VIEWS.'applicantView.html', $data);


            //show a list of jobs - from jobModel->showJobs();
            if($jobModel->showJobs()){
                $result = $jobModel->showJobs();
                $displayString = '';
              
                foreach($result as $result){
                  //display each job
                  $displayString .= $jobModel->displayJob($result);
                }
                $data['mainContent'] .= $displayString;
            }
            else $data['mainContent'] .= "it did not work(handle the errors)";

        }

        echo $this->render(APP_PATH.VIEWS.'baseLayout.html', $data);

    }
}