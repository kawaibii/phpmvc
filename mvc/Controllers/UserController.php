<?php
class UserController extends controller{
    public function login(){
        $email      = $_POST['email'];
        $password   = $_POST['password'];
        $users      = $this->model("user");
        $user       = $users->login($email, $password);
        if($user){
            // tao session
            $_SESSION['Session_ID']     = $user['id'];
            $_SESSION['Session_Name']   = $user['name'];
            $_SESSION['Session_Email']  = $user['email'];
            // tao cookie
            setcookie('email', $email, time() + 30*60, "/");
            setcookie('password', $password, time() + 30*60, "/");
            header('Location: /phpmvc/Blogcontroller/index');
            exit();
        }else{
            $_SESSION['Error_Login'] = "Sai tên tài khoản hoặc mật khẩu";
            header('Location:/phpmvc');
            exit();
        }
    }

    public function logout(){
        session_destroy();
        header("Location:/phpmvc");
    }
    
}
