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
         $this->view("update",$data);

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

        $pattern = "/^[A-Za-z0-9_]/";

        if ($content=="") {
            $error['content'] = "content không được bỏ trống ";
            $error['error'] = "1";
        }
        if(!preg_match($pattern,$title)){
            $error['title'] = "title không được chứa kí tự đặc biệt  ";
            $error['error'] = "1";
        }
        if ($title=="") {
            $error['title'] = "Title không được bỏ trống ";
            $error['error'] = "1";
        }
        $findblog = $blog->FindByTitle($title);
        if($findblog!=null){
            $error['title'] = "title đã tồn tại vui lòng nhập mới ";
            $error['error'] = "1";
        }
        if(!isset($_FILES['fileUpload'])){
            $error['fileUpload'] = "file không được bỏ trống ";
            $error['error'] = "1";
        }else {
            $filePath = $_FILES['fileUpload']['name'];
            $filetype = pathinfo($filePath, PATHINFO_EXTENSION);
               if (!in_array($filetype,$allowfiletype )) {
                $error['fileUpload'] = "file được upload không phải là ảnh ";
                $error['error'] = "1";

            }
        }
        if ($error['error']!="1") {
            $time = time();
                $direct = $_SERVER['DOCUMENT_ROOT']."/phpmvc/mvc/public/images/";
                move_uploaded_file($_FILES['fileUpload']['tmp_name'],$direct . $_FILES['fileUpload']['name'].$time);
                $link = $_FILES['fileUpload']['name'].$time;

            $ins = $blog->Insert($title,$content,$user_id,$link);

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
        $allowfiletype = array('jpg', 'png', 'jpeg', 'gif');
        $user_id  = 1;


       $error = array(
        'success'=> '',
        'error' => '',
        'title' => '',
        'content' => '',
        'user_id'=>'',
        'fileUpload'=>'',
        'id'=>$id

        );

        $pattern = "/^[A-Za-z0-9_]/";

        if ($content=="") {
            $error['content'] = "content không được bỏ trống ";
            $error['error'] = "1";
        }
        if(!preg_match($pattern,$title)){
            $error['title'] = "title không được chứa kí tự đặc biệt  ";
            $error['error'] = "1";
        }
        if ($title=="") {
            $error['title'] = "Title không được bỏ trống ";
            $error['error'] = "1";
        }
        // $findblog = $blog->FindByTitle($title);
        // if($findblog!=null){
        //     $error['title'] = "title đã tồn tại vui lòng nhập mới ";
        //     $error['error'] = "1";
        // }
        if(isset($_FILES['fileUpload'])){

            $filePath = $_FILES['fileUpload']['name'];
            $filetype = pathinfo($filePath, PATHINFO_EXTENSION);
               if (!in_array($filetype,$allowfiletype )) {
                $error['fileUpload'] = "file được upload không phải là ảnh ";
                $error['error'] = "1";


            }
        }
        if ($error['error']!="1") {
            if (isset($_FILES['fileUpload'])) {

                $time = time();
                $direct = $_SERVER['DOCUMENT_ROOT']."/phpmvc/mvc/public/images/";
                 unlink($direct.$link);
                move_uploaded_file($_FILES['fileUpload']['tmp_name'],$direct . $_FILES['fileUpload']['name'].$time);
                $link2 = $_FILES['fileUpload']['name'].$time;

            }


           $ins = $blog->Update($title,$content,$user_id,$link2,$id);

        }


        die (json_encode($error));
    }

    public function store(){

    }
    public function show($id){

        $blogs  = $this->model("blog");
        $data   = $blogs->FindByID($id);
        //var_dump($data) ;
        $this->view("Detail",$data);
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
//           echo $id." ".$user_id . " " . $image ." ". $checks . " ";
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
