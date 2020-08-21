<?php


class blogcontroller extends controller
{
    function __construct()
    {
        // if(empty($_SESSION['Session_Name'])){
        //     $_SESSION['Error_Login'] = "Bạn chưa đăng nhập ";
        //     header("Location: /phpmvc");
        //     exit();
        // }
        if(empty($_SESSION['Session_Name'])){
            $_SESSION['Error_Login'] = "Bạn chưa đăng nhập ";
            header("Location: /phpmvc");
            exit();
        }
        else{

        }

    }

    public function index(){
        $bloges = $this->model("blog");
        $data = $bloges->All();
        $this->view("master", $data);
    }
    public function edit($id){
        echo " day la sua ". $id;
        $blog = $this->model("blog");
        echo $blog->Update("123",1);
    }

    public function update(){
        // $id = $_POST['id'];
        // $title      = $_POST['title'];
        // $content   = $_POST['content'];
        // $user_id  = $_POST['user_id'];
        // $linkfile = $_POST['linkfile']
        // $link = "";
        // if (isset($_FILES['fileUpload'])) {
        //     if ($_FILES['fileUpload']['error'] > 0)
        //         echo "Lỗi upload";
        //     else {
        //         $time = time();
        //         unlink($linkfile);
        //         move_uploaded_file($_FILES['fileUpload']['tmp_name'], 'upload/' . $_FILES['fileUpload']['name'].$time);
        //         $link = "upload/" . $_FILES['fileUpload']['name'].$time;

        //     }
        // }else $link = $linkfile

        // $blog      = $this->model("user");
        // $blog->update($title,$content,$user_id,$link,$id);
    }

    public function create(){
 
           
            $this->view("create",[]);


    }
    public function createblog()
    {
        $blog      = $this->model("blog");
        $title      = $_POST['title'];
        $content   = $_POST['content'];
        $allowfiletype = array('jpg', 'png', 'jpeg', 'gif');
        $user_id  = 1;


       $error = array(
        'success'=> '',
        'error' => '',
        'title' => '',
        'content' => '',
        'user_id'=>'',
        'fileUpload'=>''

        );
         
        $pattern = "/^[A-Za-z0-9_]{3,32}$/";
        
        if ($content=="") {
            $error['content'] = "content khong duoc bo trong";
            $error['error'] = "1";
        }
        if(!preg_match($pattern,$title)){
            $error['title'] = "title ko duoc chua ki tu dac biet ";
            $error['error'] = "1";
        }
        if ($title=="") {
            $error['title'] = "Title khong duoc bo trong";
            $error['error'] = "1";
        }
        $blog = $blog->FindByTitle($title);
        if($blog!=null){
            $error['title'] = "title da ton tai vui long nhap moi";
            $error['error'] = "1";
        }
        if(!isset($_FILES['fileUpload'])){
            $error['fileUpload'] = "file ko duoc bo trong";
            $error['error'] = "1";
        }else {
            $filePath = $_FILES['fileUpload']['name'];
            $filetype = pathinfo($filePath, PATHINFO_EXTENSION);
               if (!in_array($filetype,$allowfiletype )) {
                $error['fileUpload'] = "file duoc up load ko phai la anh";
                $error['error'] = "1";

            }
        } 
        // echo $filePath = $_FILES['fileUpload']['name'];
        // if ($error['error']=='') {
        //     if ($_FILES['fileUpload']['error'] > 0)
        //         echo "Lỗi upload";
        //     else {
        //         $time = time();
        //         $direct = $_SERVER['DOCUMENT_ROOT']."/phpmvc/mvc/public/upload/";
        //         move_uploaded_file($_FILES['fileUpload']['tmp_name'],$direct . $_FILES['fileUpload']['name'].$time);
        //         $link = "public/upload/" . $_FILES['fileUpload']['name'].$time;

        //     }
        //     $blog->Insert($title,$content,$user_id,$link); 
        // }



        die (json_encode($error));


    }

    public function store(){

    }
    public function show($id){

        $blogs  = $this->model("blog");
        $data   = $blogs->FindByID($id);
        $this->view("Detail",$data);
    }

    public function destroy($id){
        $blog           = $this->model("blog");
        $user_id        = $_SESSION['Session_ID'];
        $blogs          = $blog->FindByID($id);
        $image          = "";
        $check_blog     =""; // ham de kiem tra blog co ton tai hay khong
        while ($row = mysqli_fetch_object($blogs)){
            $image  = $row->link;
            $checks = $row->title;
        }

        if( !empty( $check_blog ) ){
            $check      = $blog->Delete($id, $user_id);
            if(file_exists("./mvc/public/images/" . $image)){
                unlink("./mvc/public/images/" . $image);
            }
            $_SESSION['Message_Success'] = "Bạn đã xóa thành công";
            header("Location: /phpmvc/Blogcontroller/index");
            exit();
        }

        $_SESSION['Message_Errors'] = "bài viết không có hoặc bạn không phải chủ bài viết";
        header('Location: /phpmvc/Blogcontroller/index');
        exit();
    }
}
