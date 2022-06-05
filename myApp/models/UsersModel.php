<?php

class UsersModel extends DBModel
{
    protected $name;
    protected $email;
    protected $password;

    public function __construct($uName='.', $uEmail='.', $uPass='.'){
        $this->name = $uName;
        $this->email = $uEmail;
        $this->password = $uPass;
    }

    //verifica userul si parola, iar in caz ca sunt corecte salveaza datele necesare in sesiune
    public function isAuth($uEmail, $uPass){

        //cautarea userului in baza de date
        $q = "SELECT * FROM `users` WHERE `email`= ? ";
        $myPrep = $this->db()->prepare($q);
        $myPrep->bind_param("s", $uEmail);
        $myPrep->execute();
        $result = $myPrep->get_result()->fetch_assoc();

        //verificarea parolei si returnarea tipului de cont si numelui
        if($result){
            if(password_verify($uPass, $result['pass'])){
                $userDetails[0] = $result['accType'];
                $userDetails[1] = $result['name'];
                $userDetails[2] = $result['id'];
                return $userDetails;
            }
            else return false;
        }
        else {
            return false;
        }
    }


        public function addUser($email, $user, $pass, $type){
        $hash = password_hash($pass, PASSWORD_DEFAULT);

        // prepared statements

        $q = "INSERT INTO `users`(`email`, `name`, `pass`, `accType`) VALUES (?, ?, ?, ?);";
        $myPrep = $this->db()->prepare($q);

        $myPrep->bind_param("ssss", $email, $user, $hash, $type);

        return $myPrep->execute();
    }



    public function getUserDetails($userId){
        $q = "SELECT * FROM `users` where `id` = ?";
        $myPrep = $this->db()->prepare($q);
        $myPrep->bind_param("i", $userId);
        $myPrep->execute();

        return $result=$myPrep->get_result()->fetch_all(MYSQLI_ASSOC);
    }

   




}