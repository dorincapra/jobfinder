<?php

class JobModel extends AppController
{
    protected $employerId;
    protected $jobName;
    protected $salary;
    protected $location; 
    protected $jobDescription; 
    protected $schedule; 
    

    public function __construct($jobName=".", $salary=".", $location=".", $jobDescription=".", $schedule="."){
        $this->jobName = $jobName;
        $this->salary = $salary;
        $this->location = $location;
        $this->jobDescription = $jobDescription;
        $this->schedule = $schedule;        
    }


    // public function init(){
    //     //if we have details about a job, display -> filterJobs
    //     //if not, display first 10 -> showJobs
    // }



        //add job in DB through a form in the website
    public function addJob($employerId, $jobName, $salary, $location, $jobDescription, $schedule){
        $q = "INSERT INTO `jobs`(`employerId`, `jobName`, `salary`, `location`, `jobDescription`, `schedule`) VALUES (?, ?, ?, ?, ?, ?);";
        $myPrep = $this->db()->prepare($q);
        $myPrep->bind_param("isssss",$employerId, $jobName, $salary, $location, $jobDescription, $schedule);
        return $myPrep->execute();
    }



    public function filterJobs($jobName, $salary, $location, $schedule, $employerId){
        $q = "SELECT * FROM `jobs` WHERE `id` IS NOT NULL";
        //if any of them isset, add them in the query
        if($jobName){
            $q .= " AND `jobName` = $jobName";
        }
        if($salary){
            $q .= " AND `salary` > $salary";
        }
        if($location){
            $q .= " AND `location` = $location";
        }
        if($employerId){
            $q .= " AND `employerID` = $employerId";
        }
        $myPrep = $this->db()->prepare($q);
        $myPrep->execute();
        return $result = $myPrep->get_result()->fetch_all(MYSQLI_ASSOC);

    }

    public function showJobs(){
        $q = "SELECT * FROM `jobs` LIMIT 10";
        $myPrep = $this->db()->prepare($q);
        $myPrep->execute();

        return $result = $myPrep->get_result()->fetch_all(MYSQLI_ASSOC);
    }


        //design for one job div
    public function displayJob($jobName, $salary, $location, $schedule, $jobId){

        //displays the job depending of the user type
        if($_SESSION['accType'] == "applicant"){
            $buttons = "<a class='btn btn-primary' href='#'>Apply</a>";
        } else if($_SESSION['accType'] == "employer") {
            $buttons = "<a class='btn btn-danger' href='#'>Delete</a>";
        }

        $displayString = "<div id='$jobId' class='container bg-dark text-light m-4'>";
        $displayString .= "<br>Position name: " . $jobName;
        $displayString .= "<br>Salary: " . $salary;
        $displayString .= "<br>Location: " . $location;
        $displayString .= "<br>Schedule: " . $schedule;
        $displayString .= $buttons;
        $displayString .= "</div>";
                
        return $displayString;
    }

    public function deleteJob($id){
        //delete job based on id - through Delete button that is only in the employer's menu
    }

    public function applyToJob($jobId){

        //locate in db the job based on jobId - get from there employerId 
        //locate in the db the cV based on userId
        //insert into `applications` jobid, applicantId, employerId
        
        $userId = $_SESSION(['userId']);
        echo $jobId;
        
    }


    //not tested
    public function displayEmployerApplications($employerId){
        //display all applications from DB for that specific employer
        $q = "SELECT * FROM `applications` WHERE `employerId` = ?";
        $myPrep = $this->db()->prepare($q);
        $myPrep->bind_param("s", $employerId);
        $myPrep->execute();
        $result = $myPrep->get_result()->fetch_all(MYSQLI_ASSOC);
        //add return design
    }


}