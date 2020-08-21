<?php


class home extends controller {
    function __construct()
    {
        if(isset($_COOKIE['CHECK_LOGIN']))
        {
            $_SESSION['Session_ID']     = $_COOKIE['id'];
            $_SESSION['Session_Name']   = $_COOKIE['email'];
            $_SESSION['Session_Email']  = $_COOKIE['password'];
            header('Location: /phpmvc/Blogcontroller/index');
            exit();
        }
    }

    function index(){
        $data =[];
        $this->view("login", $data);
    }
}


