<?php

class AppController extends DBModel
{

    protected $routes = [
                            'home' => 'HomeController',
                            'contact' => 'ContactController',
                            'about' => 'AboutController',
                            'login' => 'LoginController',
                            'signup' => 'SignUpController',
                            'logout' => 'LogoutController',
                            'applicant' => 'ApplicantController',
                            'employer' => 'EmployerController',
                            'cv'=> 'CVController' ,
                            'job' => 'JobController',
                            'apply' => 'ApplyController',
                            'applications' => 'ApplicationsDisplayController', 
                            'addJob' => 'AddJobController',
                            'deleteJob' => 'DeleteJobController'
                        ];

    public function __construct(){
        $this->init();
    }

    public function init(){
        // redirectarea, navigarea între pagini
        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }
        else {
            $page = '?page=home';
        }

        if(array_key_exists($page, $this->routes)){
            $className = $this->routes[$page];
        }
        else {
            $className = $this->routes['home'];
        }
        new $className;
    }

    public function render($page, $data=array()){
        $template = file_get_contents($page);
            
        // caută toate placeholerele
        preg_match_all("[{{\w+}}]", $template, $matches);


        foreach($matches[0] as $value){
            // scoate toate acoladele
            // înlocuiește-le cu informația din array-ul data
            $item = str_replace('{{', '', $value);
            $item = str_replace('}}', '', $item);

            if(array_key_exists($item, $data)){
                $template = str_replace($value, $data[$item], $template);
            }
        }
        return $template;
    }

            //design for one job div - move it to controller (AppController)
            public function displayJob($jobName, $salary, $location, $schedule, $jobId){

                //displays the job depending of the user type
                if($_SESSION['accType'] == "applicant"){
                    $buttons = "<a class='btn btn-primary' href='?page=apply&jobId=$jobId'>Apply</a>";
                } else if($_SESSION['accType'] == "employer") {
                    $buttons = "<a class='btn btn-danger' href='?page=deleteJob&id=$jobId'>Delete</a>";
                }
        
                $displayString = "<div id='$jobId' class='container bg-dark text-light m-4'>";
                $displayString .= "<br>Position name: " . $jobName;
                $displayString .= "<br>Salary: " . $salary;
                $displayString .= "<br>Location: " . $location;
                $displayString .= "<br>Schedule: " . $schedule;
                $displayString .= $buttons;
                $displayString .= "</div><br>";
                        
                return $displayString;
            }
        

}