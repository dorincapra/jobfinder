<?php

class JobController extends AppController
{
    public function __construct(){
        $this->init();
    }

    public function init(){

        session_start();
        $userId = $_SESSION['userId'];

        $job = new JobModel;
    
        $data[] = "";




       if(isset($_POST['jobName']) && isset($_POST['salary']) && isset($_POST['location']) && isset($_POST['jobDescription']) && isset($_POST['schedule'])){
            if($job->addJob($userId, $_POST['jobName'], $_POST['salary'], $_POST['location'],$_POST['jobDescription'], $_POST['schedule'])){
                $data["mainContent"] = "Job-ul a fost adaugat cu success";
            }
       }


        echo $this->render(APP_PATH.VIEWS.'jobView.html', $data);

    }



}