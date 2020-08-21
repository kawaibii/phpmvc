<!DOCTYPE html>
<html lang="en">
<head>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edmin</title>
        <link type="text/css" href="http://localhost/phpmvc/mvc/public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="http://localhost/phpmvc/mvc/public/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link type="text/css" href="http://localhost/phpmvc/mvc/public/css/theme.css" rel="stylesheet">
        <link type="text/css" href="http://localhost/phpmvc/mvc/public/images/icons/css/font-awesome.css" rel="stylesheet">
        <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'
              rel='stylesheet'>
        <script type="text/javascript" src="http://localhost/phpmvc/mvc/public/ckeditor/ckeditor.js"></script>
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
                               <div class="col-sm-4">
                                <h1> <div id="success" class="alert-success"></div></h1>

                              </div>


                               <form class="form-horizontal row-fluid"  method="POST" enctype="multipart/form-data" action="http://localhost/phpmvc/Blogcontroller/editblog">
                                  <input type="hidden" id="id" placeholder="Type something here..." class="span8" name="id" value="<?php echo $data['id'] ?>">
                                   <div class="control-group">
                                       <label class="control-label" for="basicinput">Tiêu đề bài viết</label>
                                       <div class="controls">
                                           <input type="text" id="title" placeholder="Type something here..." class="span8" name="title"  value="<?php echo $data['title'] ?>">
                                            <div id="showerrortitle" class="alert-error"></div>
                                       </div>
                                   </div>

                                   <div class="control-group">
                                       <label class="control-label" for="basicinput">Hình ảnh</label>
                                       <div class="controls">
                                          <img src="/phpmvc/mvc/public/images/<?php echo $data['link'] ?>">
                                          <input type="hidden" id="link" placeholder="Type something here..." class="span8" name="link" value="<?php echo $data['link'] ?>">
                                           <input data-title="A tooltip for the input" type="file"  class="span8 tip" name="fileUpload" id="fileUpload">
                                            <div id="showerrorfileUbload" class="alert-error"></div>
                                       </div>
                                   </div>
                                   <div class="control-group">
                                       <label class="control-label" for="basicinput">Nội dung</label>
                                       <div class="controls">
                                           <!-- <textarea class="span8" rows="5" name="content" id="content"></textarea> -->
                                           <textarea name="content" id="editor1" rows="10" cols="80" ><?php echo $data['content']; ?></textarea>
                                            <div id="showerrorcontent" class="alert-error"></div>
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

        <script language="javascript">
            $('form').submit(function (){
              let img = $(".fileUpload");
               var form = new FormData();
               form.append("fileUpload", $('input[type=file]')[0].files[0]);
              form.append("title", $('#title').val());
              form.append("content", CKEDITOR.instances.editor1.getData());
              form.append("id", $('#id').val());
              form.append("link", $('#link').val());
                  // console.log(form);

                 $('#showerror').html('');
                  $.ajax({
            type: "POST",
            url: "http://localhost/phpmvc/Blogcontroller/editblog",
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
            data = JSON.parse(result);
            var errortitle = '';
            var errorfileUpload = '';
            var errorcontent = '';

            // Lấy thông tin lỗi username
            // console.log($.trim(data.fileUpload));
            if ($.trim(data.title) != ''){
                errortitle += data.title ;

            }

            // Lấy thông tin lỗi email
            if ($.trim(data.content) != ''){
                errorcontent += data.content;
                  // $('#showerror').append(html);
            }
             if ($.trim(data.fileUpload) != ''){
                errorfileUpload += data.fileUpload;
                 // console.log(html);
            }

            // Cuối cùng kiểm tra xem có lỗi không
            // Nếu có thì xuất hiện lỗi
            if ($.trim(data.error)!= ''){
                $('#showerrortitle').html(errortitle);
                $('#showerrorfileUbload').html(errorfileUpload);
                $('#showerrorcontent').html(errorcontent);
            }
            else {
                $('#showerrortitle').html('');
                $('#showerrorfileUbload').html('');
                $('#showerrorcontent').html('');
                $('#success').html('');
                $('#success').html('Thêm thành công');
            }
         }
    });

                return false;
            });
        </script>
</body>
</html>
