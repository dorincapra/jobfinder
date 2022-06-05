<?php

class ApplicationsDisplayController extends AppController 
{
    public function __construct(){
        $this->init();
    }

    public function init(){

        session_start();
        $userId = $_SESSION['userId'];
        $accType = $_SESSION['accType'];
        $job = new JobModel;
        $application = new ApplicationModel;
        $user = new UsersModel;
        $cv = new CVModel;
        $displayString = '';
        $resultJobs = '';
        $jobName = '';
        $data['mainContent'] ='';

        if($accType == "applicant"){
            //show jobs where this $userId applied
            //$application ->  displayApps
            if($application-> filterApplications(NULL,$userId)){
                $resultApplications = $application-> filterApplications(NULL, $userId);
                foreach($resultApplications as $applications){
                    $resultJobs = $job->getJobDetails($applications['jobId']);
                    foreach($resultJobs as $jobs){
                        echo "ai aplicat la urmatoarele job-uri";
                        echo $this->displayJob($jobs['jobName'], $jobs['salary'], $jobs['location'], $jobs['schedule'], $jobs['id']);
                    }
                }
              //  echo $this->render(APP_PATH.VIEWS.'appApps.html', $data);
            }

        } else if($accType == "employer") {
            if($application-> filterApplications($userId, NULL)){
                $resultApplications = $application-> filterApplications($userId,NULL);
                foreach($resultApplications as $applications){
                    $resultJobs = $job->getJobDetails($applications['jobId']);
                    foreach($resultJobs as $jobs){
                        $displayString .= "Job-ul la care s-a aplicat:";
                      $displayString .=$job->displayJob($jobs['jobName'], $jobs['salary'], $jobs['location'], $jobs['schedule'], $jobs['id']);
                       
                       $cvs = $cv->filterCVs($_SESSION['user'],Null, NULL, NULL);
                       foreach($cvs as $cvs){
                            $displayString .= $cv->displayCVs($cvs['age'], $cvs['lastSch'], $cvs['experience']);
                       }
                    }
                }
            }

            $data['mainContent'] = $displayString;
            echo $this->render(APP_PATH.VIEWS.'applicationsView.html', $data);
        }


    }

}