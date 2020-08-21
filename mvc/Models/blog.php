<?php


class blog extends connectDB
{
    public function All(){
        $sql = "SELECT b.id,b.title,b.link,u.name FROM blog AS b
                INNER JOIN user AS u ON u.id = b.user_id
    ";
        $data = mysqli_query($this->connect,$sql);
        return $data;
    }
    public function FindByID($id){
        $sql = "SELECT b.id, b.title, b.content, b.link, u.name FROM blog AS b
                INNER JOIN user AS u ON u.id = b.user_id
                WHERE b.id = '$id'
        ";
        $data = mysqli_query($this->connect,$sql);
        return $data;
    }

    public function Update($data, $id){
        return "cap nhat thanh cong".$data.  " " . $id;
    }
    public function Delete($id, $user_id){
        $sql = "DELETE FROM blog WHERE id = '$id' AND user_id = '$user_id'";
        $check = mysqli_query($this->connect, $sql);
        return $check;
    }
}
