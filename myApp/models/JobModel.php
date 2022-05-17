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


    public function init(){
        //if we have details about a job, display -> filterJobs
        //if not, display first 10 -> showJobs
    }


    public function addJob($employerId, $jobName, $salary, $location, $jobDescription, $schedule){
       
        //add job in DB through a form in the website
        $q = "INSERT INTO `jobs`(`employerId`, `jobName`, `salary`, `location`, `jobDescription`, `schedule`) VALUES (?, ?, ?, ?, ?, ?);";
        $myPrep = $this->db()->prepare($q);
        $myPrep->bind_param("isssss", $email, $user, $hash, $type);
        return $myPrep->execute();
    }



    public function filterJobs($jobName, $salary, $location, $schedule){
        //show job filtered
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
        return $result = $q->get_result()->fetch_assoc();
    }

    public function showJobs(){
        $q = "SELECT * FROM `jobs` LIMIT 10";
        $myPrep = $this->db()->prepare($q);
        $myPrep->execute();

        //returns array with # of elements = # of jobs in DB
        return $result = $myPrep->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function displayJob($result){

        //design for one job div
        $displayString = "<div class='container bg-dark text-light m-4'>";
        $displayString .= "<br>Position name: " . $result['jobName'];
        $displayString .= "<br>Salary: " . $result['salary'];
        $displayString .= "<br>Location: " . $result['location'];
        $displayString .= "<br>Schedule: " . $result['schedule'];
        $displayString .= "<button class='btn btn-primary'>Apply</button>";
        $displayString .= "</div>";
                
        return $displayString;
    }

    public function deleteJob($id){
        //delete job based on id - through Delete button that is only in the employer's menu
    }



}