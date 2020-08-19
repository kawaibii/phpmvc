<?php

class App {
    // tao defaul value truoc
    protected $controller = "home";
    protected $action = "index";
    protected $param = [];

    function __construct()
    {
        $arr = $this->UrlProcess();

        if(!empty($arr)){
            if(file_exists( "./mvc/Controllers/".$arr[0].".php")){
                $this->controller = $arr[0];
                unset($arr[0]);
            }
            require_once "./mvc/Controllers/".$this->controller.".php";
            $this->controller = new $this->controller;

            // xu ly action
            if (isset($arr[1])){
                if(method_exists( $this->controller, $arr[1])){
                    $this->action = $arr[1];
                }
                unset($arr[1]);
            }

            // xu ly param
            if(isset($arr)){
                $this->param = $arr;
            }

        }else
            {
            require_once "./mvc/Controllers/".$this->controller.".php";
            $this->controller = new $this->controller;
        }
        call_user_func_array([$this->controller, $this->action], $this->param);
    }

    // xu ly url
    function UrlProcess(){
        if(isset($_GET['url'])){
            $url = explode("/", filter_var(trim($_GET['url'], "/")));
            return $url;
        }

    }
}
?>
