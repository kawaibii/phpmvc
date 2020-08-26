<?php
class UserController extends controller{

    public function login(){
        $email      = $_POST['email'];
        $password   = $_POST['password'];
        $remember   = $_POST['remember'];
        $users      = $this->model("user");
        $this->validateLogin($password);
        $password = md5($_POST['password']);
        $user       = $users->login($email, $password);


        if($user){
            // tao session
            $_SESSION['Session_ID']     = $user['id'];
            $_SESSION['Session_Name']   = $user['name'];
            $_SESSION['Session_Email']  = $user['email'];
            // tao cookie
            if($remember == "on"){
                setcookie('CHECK_LOGIN', $user['remember_me'], time() + 30*60, "/");
            }
            header('Location: /phpmvc/Blogcontroller/index');
            exit();
        }
        $_SESSION['Error_Login'] = "Sai tên tài khoản hoặc mật khẩu";
        header('Location:/phpmvc');
        exit();
    }

    public function dangky(){
      $data['name'] = $_POST['name'];
      $data['email'] = $_POST['email'];
      $data['password'] = $_POST['password'];
      $data['repassword'] = $_POST['repassword'];
      $data['remember_me'] = md5($_POST['password']);
      var_dump($data);
      $user = $this->model("user");
        $checkEmail = $user->getemail($data['email']);
        $this->validateRegister($data['password']);
        $this->validateRegister($data['repassword']);
        // var_dump($checkEmail);

        if($checkEmail){
            $_SESSION['Error_Login'] = "Email Đã sử  ";
            header('Location:/phpmvc/home/register');
            exit();
        }

        if($data['password'] != $data['repassword']){
            $_SESSION['Error_Login'] = "Mật khẩu không khớp ";
            header('Location:/phpmvc/home/register');
            exit();
        }
        $data['password'] = md5($_POST['password']);
        $check = $user->Save($data);

        if($check == true){
            $myuser = $user->findbyemail($data['email']);
            $_SESSION['Session_ID']     = $myuser['id'];
            $_SESSION['Session_Name']   = $myuser['name'];
            $_SESSION['Session_Email']  = $myuser['email'];
            if($_POST['remember'] == true){
                setcookie("CHECK_LOGIN", $myuser['remember_me'], time() + 30 * 60, "/");
            }
            header("Location: /phpmvc/Blogcontroller/index");
            exit();
        }

    }

    public function logout(){
        setcookie('CHECK_LOGIN', true, time()-30*60, "/");
        session_destroy();
        header("Location:/phpmvc");
       // echo $_COOKIE['CHECK_LOGIN'];
    }

    public function validateLogin($data){
        $pattern = '/[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/';

        if (preg_match($pattern, $data)){
            $_SESSION['Error_Login'] = "Mật khẩu không được có kí tự đặc biệt";
            header('Location:/phpmvc');
            exit();
        }
        if($data = ''){
            $_SESSION['Error_Login'] = "Mật khẩu không được bỏ trống ";
            header('Location:/phpmvc');
            exit();
        }
    }
    public function validateRegister($data){
        $pattern = '/[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/';
        $error = "";
        if(preg_match($pattern, $data)){
            $_SESSION['Error_Login'] = "Mật khẩu không được có kí tự đặc biệt";
            header('Location:/phpmvc/home/register');
            exit();
        }
        if($data = ''){
            $_SESSION['Error_Login'] = "Mật khẩu không được bỏ trống ";
            header('Location:/phpmvc/home/register');
            exit();
        }
    }

}
