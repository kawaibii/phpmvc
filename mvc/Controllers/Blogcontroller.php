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

    public function update($id){

    }

    public function create(){
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
