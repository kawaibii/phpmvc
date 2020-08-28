<?php
class UserController extends controller{

    public function login(){
        $email      = $_POST['email'];
        $password   = $_POST['password'];
        $remember   = $_POST['remember'];
        $remember_me = md5(time() . $password);
        $users      = $this->model("user");
        $this->validatePasswordLogin($password);
        $this->validatorEmail($email,"");
        $password = md5($_POST['password']);
        $user       = $users->login($email, $password);


        if($user){
            // tao session
            $_SESSION['Session_ID']     = $user['id'];
            $_SESSION['Session_Name']   = $user['name'];
            $_SESSION['Session_Email']  = $user['email'];
            // tao cookie
            if($remember == "on"){
                $check = $users->updateOneValue($remember_me, $_SESSION['Session_ID']);
                setcookie('CHECK_LOGIN', $remember_me, time() + 30*60, "/");
//                print_r($user);
//                die();
            }
            header('Location: /phpmvc/Blogcontroller/index');
            exit();
        }
        $_SESSION['Error_Login'] = "Sai tên tài khoản hoặc mật khẩu";
        header('Location:/phpmvc');
        exit();
    }

    public function dangky(){
      $data['name']             = $_POST['name'];
      $data['email']            = $_POST['email'];
      $data['password']         = $_POST['password'];
      $data['repassword']       = $_POST['repassword'];
        $this->validatorFullname($data['name']);
        $this->validatorEmail($data['email'], "home/register");
        $this->validatePasswordRegister($data['password']);
        $this->validatePasswordRegister($data['repassword']);
        if($data['password']    != $data['repassword']){
            $_SESSION['Error_Login'] = "Mật khẩu không khớp ";
            header('Location:/phpmvc/home/register');
            exit();
        }

      $user = $this->model("user");
        $checkEmail             = $user->getemail($data['email']);
        // var_dump($checkEmail);

        if($checkEmail){
            $_SESSION['Error_Login'] = "Email Đã sử  ";
            header('Location:/phpmvc/home/register');
            exit();
        }
        $data['password'] = md5($_POST['password']);
        $check = $user->Save($data);

        if($check == true){
            $_SESSION['Message_Success'] = "Đăng ký tài khoản thành công ";
            header("Location: /phpmvc");
            exit();
        }

    }

    public function logout(){
        setcookie('CHECK_LOGIN', true, time()-30*60, "/");
        session_destroy();
        header("Location:/phpmvc");
       // echo $_COOKIE['CHECK_LOGIN'];
    }






    // validator du lieu
    public function validatePasswordLogin($data){
        $pattern = '/[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/';
        $datas = $this->converPasswordNoSpace($data);

//        var_dump((string)$datas);
//        die();
        if (preg_match($pattern, $data)){
            $_SESSION['Error_Login'] = "Mật khẩu không được có kí tự đặc biệt";
            header('Location:/phpmvc');
            exit();
        }

        if(strlen($datas) < 8 || $datas == ''){
            $_SESSION['Error_Login'] = "Mật khẩu không được bỏ trống hoặc ký tự phải lớn hơn 8 ";
            header('Location:/phpmvc');
            exit();
        }
    }




    public function validatePasswordRegister($data){
        $pattern = '/[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/';
        $datas = $this->converPasswordNoSpace($data);
        if(preg_match($pattern, $data)){
            $_SESSION['Error_Login'] = "Mật khẩu không được có kí tự đặc biệt";
            header('Location:/phpmvc/home/register');
            exit();
        }

        if(strlen($datas) < 8 || $datas == ''){
            $_SESSION['Error_Login'] = "Mật khẩu không được bỏ trống hoặc ký tự phải lớn hơn 8 ";
            header('Location:/phpmvc/home/register');
            exit();
        }

    }


    // kiểm tra full name trong đăng kí có khoảng trắng và kí tự đặc biệt
    public function validatorFullname($data){
        $regex = '/[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/';
        $fullname = $this->convertDataName($data);
        // kiem tra ten co phai la 1 chuoi hay khong
        if(preg_match($regex, $data)) {
            $_SESSION['Error_Login'] = "Tên đầy đủ không được có kí tự đặc biệt ";
            header('Location:/phpmvc/home/register');
            exit();
        }
        if(strlen($fullname) < 8 || $fullname ==''){
            $_SESSION['Error_Login'] = "Tên đầy đủ không được có khoảng trắng và kí tự phải lớn hơn 8 ";
            header('Location:/phpmvc/home/register');
            exit();
        }
    }

    public function validatorEmail($data, $redirect){
        if (!filter_var($data, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['Error_Login'] = "Email không đúng định dạng";
            header('Location:/phpmvc/' . $redirect);
            exit();
        }
    }





    // ham convert data
    public function convertDataName($data){
        echo $data;
        $strs = explode(" ", $data);
        $arr= "";
        foreach ($strs as $str){
            if($str !='') {
                $arr = $arr . " " . $str;
            }
        }
        $arr = trim($arr);
        return $arr;
    }
    public function converPasswordNoSpace($data){
        $a=explode(" ", $data);
        $arr = "";
        $count=count($a);
        for($i=0;$i<$count; $i++){

            $arr =  $arr . $a[$i];
        }
        return $arr;
    }
}
