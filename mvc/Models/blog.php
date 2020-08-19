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
        $sql = "SELECT b.id,b.title,b.link,u.name FROM blog AS b
                INNER JOIN user AS u ON u.id = b.user_id
                WHERE b.id = '$id'
        ";
        $data = mysqli_query($this->connect,$sql);
        return $data;
    }

    public function Update($title, $content, $user_id, $link, $id){
        $sql = " UPDATE blog
                SET title = '$title', content = '$content', user_id = 'user_id', link = '$link'
                WHERE id = '$id";
        $check = mysqli_query($this->connect, $sql);
        return $check;
    }
    public function Delete($id, $user_id){
        $sql = "DELETE FROM blog WHERE id = '$id' AND user_id = '$user_id'";
        $check = mysqli_query($this->connect, $sql);
        return $check;
    }
    public function Insert( $title, $content, $user_id, $link){
        $sql = "INSERT INTO blog (title, content, user_id, link)
                VALUES ('$title', '$content', '$user_id','$link');";
        $check = mysqli_query($this->connect, $sql);
        return $check;
    }
}
