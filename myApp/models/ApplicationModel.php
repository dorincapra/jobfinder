<?php

class ApplicationModel extends AppController
{
    public function __construct($employerId = ".", $applicantId=".", $jobId="."){
        $this->applicantId = $applicantId; 
        $this->employerId = $employerId; 
        $this->jobId = $jobId; 
    }

    public function filterApplications($employerId, $applicantId){
        $q = "SELECT * FROM `applications` WHERE `id`";

        if($employerId){
            $q .= " AND `employerId` = $employerId";
        }

        if($applicantId){
            $q .= " AND `applicantId` = $applicantId";
        }

        $myPrep = $this->db()->prepare($q);
        $myPrep->execute();
        return  $result = $myPrep->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function displayApplication($employerId, $applicantId, $jobId){
        //make design pls
        // $displayString = "<p>$employerId" . " ";
        // $displayString .= "$applicantId" . " "; // get applicant id 
        // $displayString .= "$jobId</p>"; //get job details

        // return $displayString;
        

    }
}