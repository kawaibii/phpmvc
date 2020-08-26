<?php


class user extends connectDB
{
    function login($email, $password)
    {
        $sql = "SELECT * FROM user WHERE email='$email' and password = '$password'";
        //echo $sql;
        $data = mysqli_query($this->connect, $sql);
        $user= array();

        //var_dump($row);
        while ($row = mysqli_fetch_object($data)){
        $user['id']     = $row->id;
        $user['email']  = $row->email;
        $user['name']   = $row->name;
        $user['remember_me'] = $row->remember_me;
        }
        return $user;

    }
    function save($data){
        $name           = $data['name'];
        $email          = $data['email'];
        $password       = $data['password'];
        $remember_me    = $data['remember_me'];
        var_dump($data);
        $sql = "INSERT INTO user (name, email, password, remember_me) 
                VALUES ('$name', '$email', '$password', '$remember_me');";
        echo $sql;
        $check = mysqli_query($this->connect, $sql);

        return $check;
    }
    function getemail($email){
        $sql = "SELECT email FROM user WHERE email = '$email'";
        $data = mysqli_query($this->connect, $sql);
        $emailsql = "";
         while ($row = mysqli_fetch_object($data)){
             $emailsql = $row->email;
         }
         //var_dump($emailsql);
         if(!empty($emailsql)){
             return true;
         }
         return false;
    }
    function findbyemail($email){
        $sql = "SELECT * FROM user WHERE email = '$email' LIMIT 1";
        $data = mysqli_query($this->connect, $sql);
        $user = array();
        while ($row = mysqli_fetch_object($data)){
            $user['id'] = $row->id;
            $user['name'] = $row->name;
            $user['email'] = $row->email;
            $user['remember_me'] = $row->remember_me;
        }
        return $user;
    }
    function findbyRememberme($data){
        $sql = "SELECT * FROM user WHERE remember_me = '$data'";
        $data = mysqli_query($this->connect, $sql);
        $user = array();
        while ($row = mysqli_fetch_object($data)){
            $user['id'] = $row->id;
            $user['name'] = $row->name;
            $user['email'] = $row->email;
            $user['remember_me'] = $row->remember_me;
        }
        return $user;
    }
}
