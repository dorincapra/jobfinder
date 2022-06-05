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


    public function getJobDetails($id){
        $q = "SELECT * FROM `jobs` WHERE `id`=?;";
        $myPrep = $this->db()->prepare($q);
        $myPrep->bind_param("i", $id);
        $myPrep->execute();
        return $result = $myPrep->get_result()->fetch_all(MYSQLI_ASSOC);
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



    public function deleteJob($jobId){
        //delete job based on id - through Delete button that is only in the employer's menu
        $q = "DELETE from `jobs` WHERE `id` = ?";
        $myPrep = $this->db()->prepare($q);
        $myPrep->bind_param("i", $jobId);
        return $myPrep->execute();
    }


    //add in the application DB the details of who applied and for what job
    public function applyToJob($employerId, $applicantId, $jobId){
        $q = "INSERT INTO `applications`(`employerId`,`applicantId`, `jobId`) VALUES (?,?,?);";
        $myPrep = $this->db()->prepare($q);
        $myPrep->bind_param("iii", $employerId, $applicantId, $jobId);
        return $myPrep->execute();
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