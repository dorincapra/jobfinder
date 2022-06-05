<?php

class DeleteJobController extends JobController{
    public function __construct(){
        $this->init();
    }

    public function init(){


        $job = new JobModel;


        if(isset($_GET['id'])){
            $jobId = $_GET['id'];
            if($job->deleteJob($jobId)){
                header("Location: ?page=employer");
            }
        }
     }
}