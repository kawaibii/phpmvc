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

    public function edit()
    {
        $this->view("update", []);
    }

    public function update($id)
    {

    }

    public function create()
    {
        $this->view("create", []);
    }

    public function show($id)
    {
        $blogs = $this->model("blog");
        $data = $blogs->FindByID($id);
        $this->view("Detail", $data);
    }

    public function destroy($id)
    {
        $blog       = $this->model("blog");
        $user_id    = $_SESSION['Session_ID'];
        $blogs      = $blog->FindByID($id);
        $image      = "";
        $check_blog = ""; // ham de kiem tra blog co ton tai hay khong
        while ($row = mysqli_fetch_object($blogs)) {
            $image      = $row->link;
            $User_id    = $row->user_id;
            $checks     = $row->title;
        }
//        echo $id." ".$user_id . " " . $image ." ". $checks . " ";
//        if(!empty($checks)){
//            echo "dung";
//        }else{
//            echo "sai";
//        }
        // kiem tra bai viet co tồn tại hay không
        if (!empty($checks)) {
            // kiem tra nguoi dang nhap va nguoi tao ra bai viet
            if($user_id != $User_id){
                $_SESSION['Message_Errors'] = "Bạn không phải chủ bài viết";
                header('Location: /phpmvc/Blogcontroller/index');
                exit();
            }
            $check = $blog->Delete($id, $user_id);
            if ($check) {
                if (file_exists("./mvc/public/images/" . $image)) {
                    unlink("./mvc/public/images/" . $image);
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
