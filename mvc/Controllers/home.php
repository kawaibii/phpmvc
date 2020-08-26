<?php


class home extends controller {
    function __construct()
    {
        if(isset($_COOKIE['CHECK_LOGIN']))
        {
            $user = $this->model("user");
            $myuser = $user->findbyRememberme($_COOKIE['CHECK_LOGIN']);
          //  var_dump($myuser);
            if(!empty($myuser)) {
                $_SESSION['Session_ID']     = $myuser['id'];
                $_SESSION['Session_Name']   = $myuser['name'];
                $_SESSION['Session_Email']  = $myuser['email'];
                header('Location: /phpmvc/Blogcontroller/index');
                exit();
            }
        }
    }

    function index(){
        $data =[];
        $this->view("login", $data);
    }
    function register(){
        $data = [];
        $this->view("register", $data);
    }
}


