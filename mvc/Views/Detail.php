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
            <?php while ($row = mysqli_fetch_object($data)){ ?>
            <div class="span9">
                <div class="content">
                    <div class="module">
                        <div class="module-head">
                            <h1 style="text-align: center; color: #0e90d2"><?php echo $row->title; ?></h1>
                        </div>
                        <div class="module-body table">
                            <div class="auth">
                                <p class="name-auth"><?php echo $row->name; ?></p>
                            </div>
                            <div class="image">
                                <img width="500px" height="500px" src="/phpmvc/mvc/public/images/<?php echo $row->link; ?>" title="image bai viet">
                            </div>
                            <div class="content">
                                <?php echo $row->content; ?>
                            </div>
                        </div>

                    </div>
                    <!--/.module-->
                </div>
                <!--/.content-->
            </div>
            <?php } ?>
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
