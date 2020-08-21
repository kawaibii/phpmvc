<?php
class studentmodel extends connectDB {

    public function getAll(){
        $sql = "SELECT *FROM user";
//        if($this->connect){
//            echo "da ket noi";
//        }else{
//            echo "khong ket noi";
//        }
        $data = $this->connect->query($sql);
//        var_dump($data);
       // $data->fetch_object()
        return $data;

    }
}
