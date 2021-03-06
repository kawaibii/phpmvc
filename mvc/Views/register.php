<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link type="text/css" href="/phpmvc/mvc/public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="/phpmvc/mvc/public/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link type="text/css" href="/phpmvc/mvc/public/css/theme.css" rel="stylesheet">
    <link type="text/css" href="/phpmvc/mvc/public/images/icons/css/font-awesome.css" rel="stylesheet">
    <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
</head>
<body>
<div class="wrapper">
    <div class="container">
        <div class="row">
            <div class="module module-login span4 offset4">

                <?php
                if(isset($_SESSION['Error_Login'])){
                    ?>
                    <div class="alert alert-error">
                        <?php   echo $_SESSION['Error_Login'];
                        unset($_SESSION['Error_Login']) ?>
                    </div>
                    <?php
                }

                ?>

                <form class="form-vertical" method="post" action="/phpmvc/UserController/dangky">
                    <div class="module-head">
                        <h3>Đăng kí</h3>
                    </div>
                    <div class="module-body">
                        <div class="control-group">
                            <div class="controls row-fluid">
                                <input class="span12" type="text" id="inputEmail" placeholder="fullname" name="name" required>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls row-fluid">
                                <input class="span12" type="email" id="inputEmail" placeholder="Email" name="email" required>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls row-fluid">
                                <input class="span12" type="password" id="inputPassword" placeholder="Password" name="password" required>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls row-fluid">
                                <input class="span12" type="password" id="inputPassword" placeholder=" Repassword" name="repassword" required>
                            </div>
                        </div>
                    </div>
                    <div class="module-foot">
                        <div class="control-group">
                            <div class="controls clearfix">
                                <button type="submit" class="btn btn-primary pull-right">Đăng ký</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div><!--/.wrapper-->
<script src="/phpmvc/mvc/public/scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="/phpmvc/mvc/public/scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
<script src="/phpmvc/mvc/public/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
</body>
