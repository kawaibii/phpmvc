<?php
class connectDB {
    public $connect;
    public $server      = "localhost";
    public $username    = "root";
    public $password    = "root";
    public $database    = "phpmvc";
    function __construct()
    {
        $this->connect = mysqli_connect($this->server,$this->username,$this->password,$this->database);
        $this->connect->set_charset("utf8");
    }
}
