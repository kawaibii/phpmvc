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
        }
        return $user;

    }
}
