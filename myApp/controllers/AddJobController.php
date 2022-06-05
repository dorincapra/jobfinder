<?php

class AddJobController extends JobController{
    public function __construct(){
        $this->init();
    }

    public function init(){

        session_start();

        $job = new JobModel;
        $employerId = $_SESSION['userId'];
        
        if(isset($_POST["jobName"])&& isset($_POST["salary"]) && isset($_POST["location"]) && isset($_POST["jobDescription"]) && isset($_POST["schedule"])){
            if($job->addJob($employerId, $_POST["jobName"], $_POST["salary"], $_POST["location"], $_POST["jobDescription"], $_POST["schedule"])){
                header('Location: ?page=employer');
            }
        }
     }
}