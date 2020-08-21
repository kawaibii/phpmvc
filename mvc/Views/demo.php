<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script language="javascript" src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
    </head>
    <body>
        <form method="post" action="">
            <table border="0" cellpadding="10" cellspacing="0">
                <tr>
                    <td>Username</td>
                    <td><input type="text" id="username" name="username" value=""/></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><input type="text" id="email" name="email" value=""/></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" value="Register"/>
                        <input type="reset" name="submit" value="Clear"/>
                    </td>
                </tr>
            </table>
        </form>
        <div id="showerror"></div>
        <script language="javascript">
            $('form').submit(function (){
                alert('Bạn đã click đăng ký');
                return false;
            });
        </script>
    </body>
</html>