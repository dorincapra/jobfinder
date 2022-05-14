<?php

class CVModel extends DBModel
{
    
    protected $applicantId; 
    protected $age;
    protected $lastSch; 
    protected $experience; 

    public function __construct($applicantId, $age, $lastSch, $experience){
        $this->applicantId = $applicantId; 
        $this->age = $age; 
        $this->lastSch = $lastSch; 
        $this->experience = $experience;
    }

    public function addCV{
        //adaugare CV in baza de date
    }

    public function showCV{
        //display CVs from DB (eventually filtered?)
    }





}