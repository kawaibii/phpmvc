<?php


class blogcontroller extends controller
{
    function __construct()
    {
        if(empty($_SESSION['Session_Name'])){
            $_SESSION['Error_Login'] = "Bạn chưa đăng nhập ";
            header("Location: /phpmvc");
            exit();
        }

    }

    public function index(){
        $bloges = $this->model("blog");
        $data = $bloges->All();
        $this->view("master", $data);
    }
    public function edit(){
        $this->view("update",[]);
    }

    public function update(){
        $id = $_POST['id'];
        $title      = $_POST['title'];
        $content   = $_POST['content'];
        $user_id  = $_POST['user_id'];
        $linkfile = $_POST['linkfile']
        $link = "";
        if (isset($_FILES['fileUpload'])) {
            if ($_FILES['fileUpload']['error'] > 0)
                echo "Lỗi upload";
            else {
                $time = time();
                unlink($linkfile);
                move_uploaded_file($_FILES['fileUpload']['tmp_name'], 'upload/' . $_FILES['fileUpload']['name'].$time);
                $link = "upload/" . $_FILES['fileUpload']['name'].$time;

            }
        }else $link = $linkfile

        $blog      = $this->model("user");
        $blog->update($title,$content,$user_id,$link,$id);
    }

    public function create(){

        $title      = $_POST['title'];
        $content   = $_POST['content'];
        $user_id  = $_POST['user_id'];
        if (isset($_FILES['fileUpload'])) {
            if ($_FILES['fileUpload']['error'] > 0)
                echo "Lỗi upload";
            else {
                $time = time();
                move_uploaded_file($_FILES['fileUpload']['tmp_name'], 'upload/' . $_FILES['fileUpload']['name'].$time);
                $link = "upload/" . $_FILES['fileUpload']['name'].$time;

            }
        }

        $blog      = $this->model("user");
        $blog->Insert($title,$content,$user_id,$link);

           $error = array(
            'success'=> '',
            'error' => '',
            'title' => '',
            'content' => '',
            'user_id'=>'',
            'fileUpload'=>''

        );
         
           if (!isset($_POST['title'])) {
               $error['title'] ="Title không được bỏ trống";
           }
           if (!isset($_POST['content'])) {
               $error['content'] ="content không được bỏ trống";
           }
           if (!isset($_POST['user_id'])) {
               $error['user_id'] ="user_id không được bỏ trống";
           }
           if (!isset($_POST['fileUpload'])) {
               $error['fileUpload'] ="fileUpload không được bỏ trống";
           }


        $this->view("create",[]);

    }

    public function show($id){


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
