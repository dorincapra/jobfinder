<?php

class ApplyController extends AppController 
{
    public function __construct(){
        $this->init();
    }

    public function init(){

        session_start();
        $applicantId = $_SESSION['userId'];

        $job = new JobModel;

        $jobId = $_GET['jobId'];
        $employerId = $job->getJobDetails($jobId)["0"]["employerId"];

        if($job->applyToJob($employerId, $applicantId, $jobId)){
           // alert("ai aplicat cu succes");
            header('Location: ?page=applicant');
        } else {
            //alert - ceva nu a mers la aplicarea job-ului
        }
         

    }

}