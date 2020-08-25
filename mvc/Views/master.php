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
                            <h3>Danh sách bài viết</h3>
                            <?php
                            // hien thi thong bao thanh cong
                            //echo $_SESSION['Session_ID'];
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
                        <a href="/phpmvc/Blogcontroller/create">
                            <button style="margin: auto" type="button" class="btn btn-info">Thêm vài viết</button>
                        </a>
                        <div class="module-body table">
                            <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display"
                                   width="100%">
                                <thead>
                                <tr>
                                    <th>
                                        STT
                                    </th>
                                    <th>
                                        Tiêu đề
                                    </th>
                                    <th>
                                        Hình ảnh
                                    </th>
                                    <th>
                                        Người tạo
                                    </th>
                                    <th>
                                        Hành động
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 1; ?>
                                <?php while ($row = $data->fetch_object()){ ?>
                                <tr class="odd gradeX">
                                    <td>
                                       <?php echo $i; ?>
                                    </td>
                                    <td>
                                        <?php echo $row->title; ?>
                                    </td>
                                    <td>

                                        <img src="/phpmvc/mvc/public/images/<?php echo $row->link; ?>" >


                                    </td>
                                    <td class="center">
                                        <?php echo $row->name; ?>
                                    </td>
                                    <td class="center">
                                        <a href="/phpmvc/Blogcontroller/show/<?php echo $row->id; ?>"><button class ="alert alert-danger">Chi tiết</button></a>
                                        <a href="/phpmvc/Blogcontroller/edit/<?php echo $row->id; ?>"><button class="btn btn-block">Sửa</button></a>
                                        <a href="#"><button data-url="/phpmvc/Blogcontroller/destroy/<?php echo $row->id; ?>" onclick="show(this)" data-title="<?php echo $row->title;?>" class="btn btn-block">Xóa</button></a>
                                    </td>
                                </tr>
                                <?php $i++; } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!--/.module-->
                </div>
                <!--/.content-->
            </div>
            <!--/.span9-->
        </div>
    </div>
     <!-- Modal them them-->
</div>
    <!--/.container-->
<!--/.wrapper-->
<?php
include 'layout/script.php';
?>
<script>
    function show(a){
        console.log(a);
        let title   = a.getAttribute('data-title');
        let url     = a.getAttribute('data-url');
        let check   = confirm("Bạn có muốn xóa bài viết : " + title);
        if(check == true ){
            window.location.replace(url);
        }else {
            return false;
        }
    }
</script>
</body>
</html>
