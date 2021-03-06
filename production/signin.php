<?php
session_start();
//unset($_SESSION);
#############################
# Section : Includes Files
require_once("./includes/DBConnect.php");
require_once("./includes/Class/Auth.Class.php");
require_once("./includes/Class/Main.Class.php");
//show_session();
//print_r($_SESSION);
$user_id = $_SESSION['sess_user_id'];

//Set Variable to Class Auth
Auth::setDB($db);
Auth::setUserID($user_id);

//Call MainWeb Class
MainWeb::GetSiteInfo(); // Get webpage variable
//Check user signin  <> isGuest ->index 
if (!Auth::isGuest()) {
    MainWeb::redirect('index.php');
}
//show_session();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="./images/favicon.ico" />
        <title><?= SITE_NAME ?> | Sign In</title>

        <!-- Bootstrap -->
        <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- NProgress -->
        <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
        <!-- Animate.css -->
        <!--<link href="../vendors/animate.css/animate.min.css" rel="stylesheet">-->
        <!-- PNotify -->
        <link href="../vendors/pnotify/dist/pnotify.css" rel="stylesheet">
        <link href="../vendors/pnotify/dist/pnotify.buttons.css" rel="stylesheet">
        <link href="../vendors/pnotify/dist/pnotify.nonblock.css" rel="stylesheet">

        <!-- Custom Theme Style -->
        <link href="css/signin.css" rel="stylesheet">
        <script type="text/javascript" src="../vendors/jquery/dist/jquery.min.js"></script>
        <script type="text/javascript" src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../vendors/parsleyjs/dist/parsley.min.js"></script>

        <!-- NProgress -->
        <script type="text/javascript" src="../vendors/nprogress/nprogress.js"></script>
        <!-- PNotify -->
        <script type="text/javascript" src="../vendors/pnotify/dist/pnotify.js"></script>
        <script type="text/javascript" src="../vendors/pnotify/dist/pnotify.buttons.js"></script>
        <script type="text/javascript" src="../vendors/pnotify/dist/pnotify.nonblock.js"></script>
    </head>
    <body class="signin">

        <!--
            you can substitue the span of reauth email for a input with the email and
            include the remember me checkbox
        -->
        <div class="container">
            <div class="card card-container"> 
              <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
                <h3>
                    <div style="text-align:center">
                        <?= SITE_NAME ?>
                    </div>
                </h3>
                <hr>
                <img  src="./images/user.png" id="profile-img"  alt="..." class="profile-img-card"> 
                <p id="profile-name" class="profile-name-card"><?= $_SESSION['sess_realname'] ?></p>
                <form class="form-signin" name="form-signin" id="form-signin" method="post">
                    <div id="reauth-username" class="reauth-username"></div> <div id="reauth-last-signin" style="font-weight:normal; font-size:11px; margin:5px; display:none;text-align:center"></div>
                    <input type="text" name="inputUsername" id="inputUsername" class="form-control" placeholder="Username" required autofocus value="">
                    <input type="password" name="inputPassword" id="inputPassword" class="form-control" placeholder="Password" required value="">
                    <div id="remember" class="checkbox">
                        <label>
                            <input type="checkbox" name="inputRemember" id="inputRemember" value="TRUE">
                            Remember me </label>
                    </div>
                    <button class="btn btn-lg btn-primary btn-signin" type="submit"><i class="fa fa-sign-in"></i> Sign in</button>
                </form>
                <div id="message"></div>
                <!-- /form --> 
                <!--<a href="javascript:void(0);" class="forgot-password">&raquo; Forgot the password ?</a> <br>-->
                <a href="javascript:void(0);" class="sign-other-account" id="SignDiffAccount">&raquo; Sign in with a different account ?</a> </div>
            <!-- /card-container --> 
        </div>
        <!-- /container --> 
        <script type="text/javascript" src="../vendors/moment/min/moment.min.js"></script> 
        <script type="text/javascript" src="js/signin.js"></script>

        <script type="text/javascript">
            $(function () {

            });
        </script>
        <!-- PNotify -->
        <script>
            $(document).ready(function () {
                new PNotify({
                    title: "Users information",
                    type: "info",
                    text: "Admin Group\n***************************\nUser : admin\nPassword : 123456\n\n\
                            Operation Group\n***************************\nUser : oper\nPassword : 123456\n\n\
                            Viewer Group\n***************************\nUser : view\nPassword : 123456",
                    addclass: 'dark',
                    styling: 'bootstrap3',
                    hide: true,
                    before_close: function (PNotify) {
                        PNotify.update({
                            title: PNotify.options.title + " - Enjoy your Stay",
                            before_close: null
                        });

                        PNotify.queueRemove();

                        return false;
                    }
                });

            });
        </script>
        <!-- /PNotify -->


    </body>
</html>