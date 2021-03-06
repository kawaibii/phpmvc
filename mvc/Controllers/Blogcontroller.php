<?php


class blogcontroller extends controller
{
    function __construct()
    {


        if (empty($_SESSION['Session_Name'])) {
            $_SESSION['Error_Login'] = "Bạn chưa đăng nhập ";
            header("Location: /phpmvc");
            exit();
        }

    }

    public function index()
    {
        $bloges = $this->model("blog");
        $data = $bloges->All();
        $this->view("master", $data);
    }
    public function edit($id){
            $blog      = $this->model("blog");
           $data      = $blog->FindByID($id);
           $user_id = $_SESSION['Session_ID'];
           if($data!=null){
               if($user_id != $data['user_id']){
                   header("Location: /phpmvc/Blogcontroller/index");
                   $_SESSION['Message_Errors'] = "Bạn không có quyền để sửa bài viết";
                   exit();
               }
            $this->view("update",$data);
           }
           $this->view("404notfound",[]);


    }


    public function create(){


            $this->view("create",[]);


    }


    public function update($id)
    {

    }
    public function createblog()
    {
        $blog      = $this->model("blog");
        $title      = $_POST['title'];
        $content   = $_POST['content'];
        $user_id  = $_SESSION['Session_ID'] ;


       $error = array(
        'error' => '',
        'title' => '',
        );



        $findblog = $blog->FindByTitle($title);
        if($findblog!=null){
            $error['title'] = "title đã tồn tại vui lòng nhập mới ";
            $error['error'] = "1";
        }
        if ($error['error']!="1") {
            $time = time();
                $direct = $_SERVER['DOCUMENT_ROOT']."/phpmvc/mvc/public/images/";
                move_uploaded_file($_FILES['fileUpload']['tmp_name'],$direct . $time . $_FILES['fileUpload']['name']);
                $link = $time . $_FILES['fileUpload']['name'];
               // echo $title . $content . $user_id . $link;

           $blog->Insert($title,$content,$user_id,$link);
            $_SESSION['Message_Success']= "Thêm thành công blog  ";

        }


        die (json_encode($error));

    }


    public function editblog ()
    {
        $blog      = $this->model("blog");
        $title      = $_POST['title'];
        $content   = $_POST['content'];
        $link = $_POST['link'];
        $id = $_POST['id'];
        $user_id  = $_SESSION['Session_ID'] ;


       $error = array(
        'title' => '',
        'error' => '',
        );

        $findblog = $blog->FindByTitle($title);
        if($findblog!=null&& $findblog['id']!=$id){
            $error['title'] = "title đã tồn tại vui lòng nhập mới ";
            $error['error'] = "1";
        }

        if ($error['error']!="1") {
            $link2= $link;
            if (isset($_FILES['fileUpload'])) {


                $time = time();
                $direct = $_SERVER['DOCUMENT_ROOT']."/phpmvc/mvc/public/images/";
                if(file_exists($direct . $link)){
                 unlink($direct.$link);
                }
                move_uploaded_file($_FILES['fileUpload']['tmp_name'],$direct . $time . $_FILES['fileUpload']['name']);
                $link2 = $time . $_FILES['fileUpload']['name'];

            }


          $blog->Update($title,$content,$user_id,$link2,$id);
           $_SESSION['Message_Success']= "Sửa thành công blog  ";

        }


        die (json_encode($error));
    }

    public function store(){

    }
    public function show($id){

        $blogs  = $this->model("blog");
        $data   = $blogs->FindByID($id);
//        var_dump($data);
        if(!empty($data)) {
            $this->view("Detail", $data);
        }else {
            header("Location: /phpmvc/Blogcontroller/index");
            $_SESSION['Message_Errors'] = "Bài viết không tồn tại";
            exit();
        }
    }


    public function destroy($id)
    {
        $blogs       = $this->model("blog");
        $user_id    = $_SESSION['Session_ID'];
        $blog      = $blogs->FindByID($id);
        if(empty($blog)){
            header("Location: /phpmvc/Blogcontroller/index");
            $_SESSION['Message_Errors'] = "Bài viết không tồn tại";
            exit();
        }
        $image      = "";
        $user_id_blog = $blog['user_id'];
        $checks = $blog['title'];
        $image = $blog['link'];

        // kiem tra bai viet co tồn tại hay không
        if (!empty($checks)) {
            // kiem tra nguoi dang nhap va nguoi tao ra bai viet
            if($user_id != $user_id_blog){
                $_SESSION['Message_Errors'] = "Bạn không phải chủ bài viết";
                header('Location: /phpmvc/Blogcontroller/index');
                exit();
            }
            $check = $blogs->Delete($id, $user_id);
            if ($check) {
                $direct = $_SERVER['DOCUMENT_ROOT']."/phpmvc/mvc/public/images/";
                if (file_exists($direct . $image)) {
                    unlink($direct . $image);
                }
                $_SESSION['Message_Success'] = "Bạn đã xóa thành công";
                header("Location: /phpmvc/Blogcontroller/index");
                exit();
            }
        }

            $_SESSION['Message_Errors'] = "bài viết không có hoặc bạn không phải chủ bài viết";
            header('Location: /phpmvc/Blogcontroller/index');
            exit();

}
}
