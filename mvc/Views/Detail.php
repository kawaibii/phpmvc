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
                            <h1 style="text-align: center; color: #0e90d2"><?php echo $data['title']; ?></h1>
                        </div>
                        <div class="module-body table">
                            <div class="auth">
                                <p class="name-auth" style="text-align: right; margin-right: 40px"> Tác giả : <?php echo $data['name']; ?></p>
                            </div>
                            <div class="image center" style="margin: 20px; justify-content: center">
                                <img width="500px" height="500px" style="display: block;margin-left: auto;margin-right: auto;" src="/phpmvc/mvc/public/images/<?php echo $data['link']; ?>" title="image bai viet">
                            </div>
                            <div class="content" style="margin-top: 40px; text-align: center">
                                <?php echo $data['content']; ?>
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
