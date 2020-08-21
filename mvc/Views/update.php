<!DOCTYPE html>
<html lang="en">
<head>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edmin</title>
        <link type="text/css" href="/phpmvc/mvc/public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="/phpmvc/mvc/public/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link type="text/css" href="/phpmvc/mvc/public/css/theme.css" rel="stylesheet">
        <link type="text/css" href="/phpmvc/mvc/public/images/icons/css/font-awesome.css" rel="stylesheet">
        <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'
              rel='stylesheet'>
    </head>
<body>
<?php include "layout/Menu.php"?>
<!-- /navbar -->
<div class="wrapper">
    <div class="container">
        <div class="row">
            <?php include "layout/menuleft.php" ?>
            <!--/.span3-->
            <div class="span9">
                <div class="content">
                    <div class="module">
                        <div class="module-head">
                            <h1>Thêm bài viết</h1>
                            <?php
                            // hien thi thong bao thanh cong
                            if(isset($_SESSION['Message_Success'])){
                            ?>
                            <div class="alert alert-success">
                                <?php echo $_SESSION['Message_Success'];  unset($_SESSION['Message_Success'])?>
                                <?php
                                }
                                ?>
                            </div>
                            <?php
                            // hien thi thong bao loi
                            if(isset($_SESSION['Message_Errors'])){
                                ?>
                                <div class="alert alert-error">
                                    <?php echo $_SESSION['Message_Errors']; unset($_SESSION['Message_Errors']) ?>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="module-body table">
                            <div class="content">
                                <form class="form-horizontal row-fluid">
                                    <div class="control-group">
                                        <label class="control-label" for="basicinput">Tiêu đề bài viết</label>
                                        <div class="controls">
                                            <input type="text" id="basicinput" placeholder="Type something here..." class="span8">
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="basicinput">Hình ảnh</label>
                                        <div class="controls">
                                            <input data-title="A tooltip for the input" type="file"  class="span8 tip">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="basicinput">Nội dung</label>
                                        <div class="controls">
                                            <textarea class="span8" rows="5"></textarea>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <div class="controls">
                                            <button type="submit" class="btn">Submit Form</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                    <!--/.module-->
                </div>
                <!--/.content-->
            </div>
            <!--/.span9-->
        </div>
    </div>
    <!--/.container-->
</div>
<!--/.wrapper-->
<?php
include 'layout/script.php';
?>
</body>
</html>
