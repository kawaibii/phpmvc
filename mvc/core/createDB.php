<?php
class createDB {
    function __construct()
    {
        $connect = new mysqli("localhost","root","","phpmvc");

            $sql1 = "CREATE TABLE user(
                id INT(6) AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(50) NOT NULL,
                email VARCHAR(50) UNIQUE ,
                password VARCHAR(50) NOT NULL
)";
            if($connect->query($sql1) == true){
                echo "tao user thanh cong";
            }else{
                echo $connect->error;
            }

            $sql2 = "CREATE TABLE blog(
                id INT(6) AUTO_INCREMENT PRIMARY KEY,
                title VARCHAR(256) NOT NULL,
                content TEXT,
                user_id INT(6),
                link varchar(50)
)";
            if($connect->query($sql2) == true){
                echo "tao blog thanh cong";
            }else{
                echo $connect->error;
            }
        }

}

