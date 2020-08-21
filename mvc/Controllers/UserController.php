<?php
class UserController extends controller{

    public function login(){
        $email      = $_POST['email'];
        $password   = $_POST['password'];
        $remember   = $_POST['remember'];
        $users      = $this->model("user");
        $user       = $users->login($email, $password);
        if($user){
            // tao session
            $_SESSION['Session_ID']     = $user['id'];
            $_SESSION['Session_Name']   = $user['name'];
            $_SESSION['Session_Email']  = $user['email'];
            // tao cookie
            if($remember == "on"){
                setcookie('id', $email, time() + 30*60, "/");
                setcookie('email', $email, time() + 30*60, "/");
                setcookie('password', $password, time() + 30*60, "/");
                setcookie('CHECK_LOGIN', $email, time() + 30*60, "/");
            }
            header('Location: /phpmvc/Blogcontroller/index');
            exit();
        }
        $_SESSION['Error_Login'] = "Sai tên tài khoản hoặc mật khẩu";
        header('Location:/phpmvc');
        exit();
    }

    public function logout(){
        setcookie('CHECK_LOGIN', true, time()-30*60, "/");
        session_destroy();
        header("Location:/phpmvc");
       // echo $_COOKIE['CHECK_LOGIN'];
    }
    
}
