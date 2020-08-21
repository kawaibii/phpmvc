<!DOCTYPE html>
<html lang="en">
<head>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edmin</title>
        <link type="text/css" href="../mvc/public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="../mvc/public/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link type="text/css" href="../mvc/public/css/theme.css" rel="stylesheet">
        <link type="text/css" href="../mvc/public/images/icons/css/font-awesome.css" rel="stylesheet">
        <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'
              rel='stylesheet'>
        <script type="text/javascript" src="../mvc/public/ckeditor/ckeditor.js"></script>
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
                            <div id="showerror"></div>
                               <form class="form-horizontal row-fluid"  method="POST" enctype="multipart/form-data" action="http://localhost/phpmvc/Blogcontroller/createblog">
                                   <div class="control-group">
                                       <label class="control-label" for="basicinput">Tiêu đề bài viết</label>
                                       <div class="controls">
                                           <input type="text" id="title" placeholder="Type something here..." class="span8" name="title" >
                                       </div>
                                   </div>

                                   <div class="control-group">
                                       <label class="control-label" for="basicinput">Hình ảnh</label>
                                       <div class="controls">
                                           <input data-title="A tooltip for the input" type="file"  class="span8 tip" name="fileUpload" id="fileUpload">
                                       </div>
                                   </div>
                                   <div class="control-group">
                                       <label class="control-label" for="basicinput">Nội dung</label>
                                       <div class="controls">
                                           <!-- <textarea class="span8" rows="5" name="content" id="content"></textarea> -->
                                           <textarea name="content" id="editor1" rows="10" cols="80" ></textarea>
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
<script>    CKEDITOR.replace( 'editor1' );</script>
  <!-- <div id="showerror"></div> -->

        <script language="javascript">
            $('form').submit(function (){
              let img = $(".fileUpload");
               var form = new FormData();
               form.append("fileUpload", $('input[type=file]')[0].files[0]);
              form.append("title", $('#title').val());
              form.append("content", CKEDITOR.instances.editor1.getData());
  
                  // console.log(form);
       
                 $('#showerror').html('');
                  $.ajax({
            type: "POST",
            url: "http://localhost/phpmvc/Blogcontroller/createblog",
            processData: false,
            mimeType: "multipart/form-data",
            contentType: false,
            data: form,
        success : function (result)
        {
            // Kiểm tra xem thông tin gửi lên có bị lỗi hay không
            // Đây là kết quả trả về từ file do_validate.php
            // if (!result.hasOwnProperty('error') || result['error'] != 'success')
            // {
            //     alert('Có vẻ như bạn đang hack website của tôi');
            //     return false;
            // }
            console.log(result);
            var html = '';
            
            // Lấy thông tin lỗi username
            if ($.trim(result.title) != ''){
                html += result.title + '<br/>';
            }
 
            // Lấy thông tin lỗi email
            if ($.trim(result.content) != ''){
                html += result.content;
            }
             if ($.trim(result.fileUpload) != ''){
                html += result.fileUpload;
            }
 
            // Cuối cùng kiểm tra xem có lỗi không
            // Nếu có thì xuất hiện lỗi
            if (html != ''){
                $('#showerror').append(html);
            }
            else {
                // Thành công
                $('#showerror').append('Thêm thành công');
            }
        }
    });
 
                return false;
            });
        </script>
</body>
</html>
