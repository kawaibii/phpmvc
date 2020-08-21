<?php


class home extends controller {
    function index(){
        $data =[];
        $this->view("login", $data);
    }
    function show(){
        $student = $this->model("studentmodel");
        $this->view("ao");
    }
}


