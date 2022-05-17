<?php

class CVModel extends AppController
{
    
    protected $applicantId; 
    protected $age;
    protected $lastSch; 
    protected $experience; 

    public function __construct($applicantId=".", $age=".", $lastSch=".", $experience="."){
        $this->applicantId = $applicantId; 
        $this->age = $age; 
        $this->lastSch = $lastSch; 
        $this->experience = $experience;
    }

    //add cv in DB
    public function addCV($userId, $age, $lastSch, $experience){
         $q = "INSERT INTO `cvs`(`applicantId`, `age`, `lastSch`, `experience`) VALUES (?, ?, ?, ?)";
         $myPrep = $this->db()->prepare($q);
         $myPrep->bind_param("ssss", $userId, $age, $lastSch, $experience);
         return $myPrep->execute();
    }

    //update cv in DB
    public function updateCV($userId, $age, $lastSch, $experience){    
        $q = "UPDATE `cvs` SET `age` = ?, `lastSch` = ?, `experience` = ? WHERE `applicantId` = ?;";
        $myPrep = $this->db()->prepare($q);
        $myPrep->bind_param("ssss", $age, $lastSch, $experience, $userId);
        return $myPrep->execute();
    }

    //check if the user already has CV and add or update it
    public function findCV($applicantId, $age, $lastSch, $experience){

        //user already have a CV and on submit the CV is updated
        if($this->userHasCV($applicantId)){
            $this->updateCV($applicantId, $age, $lastSch, $experience);
        } 

        //user does not have a CV and it will create a new one 
        else if (!$this->userHasCV($applicantId)) {
            $this->addCV($applicantId, $age, $lastSch, $experience);
        }

    }

    //verifies if the user has a CV and if "Yes" pass the details
    public function userHasCV($userId){
        $q = "SELECT * FROM `cvs` WHERE `applicantId` = ?";
        $myPrep = $this->db()->prepare($q);
        $myPrep->bind_param("s", $userId);
        $myPrep->execute();
        return $result = $myPrep->get_result()->fetch_assoc();
    }


    public function showCVs(){
        //get first 10 CVs from DB, for that specific employer and display them
    }

    public function displayCVs(){
        //pretty template for CVs
    }

    public function filterCVs($jobName){
        //add params to this function and filter by them
    }
}