<?php

class EmployerController extends AppController
{
    public function __construct(){
        $this->init();
    }

    public function init(){
        session_start();
        $job = new JobModel;
        
        $hm = "Bine ai venit " . $_SESSION['user'] . "!";
        $data['mainContent'] = $hm;
        $employerId = $_SESSION['userId'];
        $displayString = "";
        
        //get the employer id and display it's jobs to be displayed in {{employerContent}}
        $result = $job->filterJobs("", "", "", "", $employerId);


        foreach ($result as $result){
            $displayString .= $job->displayJob($result['jobName'],$result['salary'],$result['location'],$result['schedule'], $result['id']);
        }
        
        $data['employerContent'] = $displayString;




        $data['mainContent'] .= $this->render(APP_PATH.VIEWS.'employerView.html', $data);
        echo $this->render(APP_PATH.VIEWS.'baseLayout.html', $data);

        }


}
