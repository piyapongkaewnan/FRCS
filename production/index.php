<?php
session_start();

#############################
# Section : Includes Files
require_once("./includes/DBConnect.php");
require_once("./includes/Class/Auth.Class.php");
require_once("./includes/Class/Menu.Class.php");
require_once("./includes/Class/Main.Class.php");
require_once("./includes/Class/Form.Class.php");

//require_once("./includes/Class/Form.Class.php");

//print_r($_SESSION);

$Config['user_id'] =  $_SESSION['sess_user_id'];
$Config['user_name'] =  $_SESSION['sess_user_name'];
$Config['realname'] = $_SESSION['sess_realname'];
$Config['picture'] = $_SESSION['sess_picture'];
$Config['email'] =  $_SESSION['sess_email'];
$Config['modules'] = $_GET['modules'];
$Config['page'] = $_GET['page'];

//if(!isset($_SESSION['sess_user_id'])){ MainWeb::redirect('login.php'); }
if(!isset($_SESSION['sess_user_id'])) {  MainWeb::redirect('signin.php');}

//Call Auth Class
Auth::setDB($db);
Auth::setUserID($Config['user_id']);
Auth::setRealName($Config['realname']);
Auth::setProfilePicture($Config['picture']);
Auth::setModule($Config['modules']);
Auth::setPage($Config['page']);

//Call MainWeb Class
MainWeb::GetSiteInfo(); // Get webpage variable
Auth::setLanguage(LANGUAGE);
MainWeb::getPageInfo();

$titleVal = MainWeb::getTitleVal();
$chkMenuAuth = Auth::isAllowPage();

//Check is Guest = to login page
//if(Auth::isGuest()){ pageback('login.php',''); }
if(!$chkMenuAuth){ include('page_403.php'); return; }

# Check Session Timeout
include("./sessionTimeout.php");

$db->debug= false;

?>
<!DOCTYPE html>
<html lang="en" ng-app="apps">
<head>
<title><?=SITE_NAME;?> | <?=MainWeb::setTitleBar();?>
</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="refresh" content="<?=$inactive;?>;">
<link rel="shortcut icon" href="./images/favicon.ico" />

<!-- Meta, title, CSS, favicons, etc. -->
<!-- Bootstrap -->
<link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome -->
<link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<!-- NProgress -->
<link href="../vendors/nprogress/nprogress.css" rel="stylesheet">

 <!-- Dropzone.js -->
 <link href="../vendors/dropzone/dist/min/dropzone.min.css" rel="stylesheet">

<!-- bootstrap-progressbar -->
<link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">

<!-- PNotify -->
<link href="../vendors/pnotify/dist/pnotify.css" rel="stylesheet">
<link href="../vendors/pnotify/dist/pnotify.buttons.css" rel="stylesheet">
<link href="../vendors/pnotify/dist/pnotify.nonblock.css" rel="stylesheet">

<!--  parsley -->
<!--<link rel='stylesheet' type='text/css' href='../vendors/parsleyjs/src/parsley.css'/>
-->
<!-- iCheck -->
<link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">

<!-- jQuery custom content scroller -->
<link href="../vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" rel="stylesheet"/>

<!-- Custom Theme Style -->
<link href="../build/css/custom.css" rel="stylesheet">

<!-- Datatable CSS -->
<link href="../vendors/datatables/media/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
<link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">

<!-- jQuery -->
<script type="text/javascript" src="../vendors/jquery/dist/jquery.min.js"></script>

<!-- parsley -->
<script type='text/javascript' src='../vendors/parsleyjs/dist/parsley.min.js'></script>

<!-- Bootstrap -->
<script type="text/javascript" src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- NProgress -->
<script type="text/javascript" src="../vendors/nprogress/nprogress.js"></script>

<!-- Dropzone.js --> 
<script src="../vendors/dropzone/dist/min/dropzone.min.js"></script>

<!-- bootstrap-progressbar -->
<script type="text/javascript" src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>

<!-- jQuery custom content scroller -->
<script type="text/javascript" src="../vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>

<!-- Angular -->
<script type="text/javascript" src="../vendors/angular/angular.min.js"></script>

<!-- PNotify -->
<script type="text/javascript" src="../vendors/pnotify/dist/pnotify.js"></script>
<script type="text/javascript" src="../vendors/pnotify/dist/pnotify.buttons.js"></script>
<script type="text/javascript" src="../vendors/pnotify/dist/pnotify.nonblock.js"></script>

<!-- iCheck -->
<script src="../vendors/iCheck/icheck.min.js"></script>

<!-- bootstrap-daterangepicker -->
<!--<script type="text/javascript" src="js/moment/moment.min.js"></script> -->
<script type="text/javascript" src="../vendors/moment/min/moment.min.js"></script>
<!--<script type="text/javascript" src="js/datepicker/daterangepicker.js"></script> -->
<script type="text/javascript" src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

<!-- Datatables -->
<script type='text/javascript' src='../vendors/datatables/media/js/jquery.dataTables.min.js'></script>
<script type='text/javascript' src='../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js'></script>
<script type='text/javascript' src='../vendors/datatables.net-responsive/js/dataTables.responsive.min.js'></script>
<script type='text/javascript' src='../vendors/datatables.net-buttons/js/dataTables.buttons.min.js'></script>
<script type='text/javascript' src='../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js'></script>
<script type='text/javascript' src='../vendors/datatables.net-buttons/js/buttons.html5.min.js'></script>
<script type='text/javascript' src='../vendors/datatables.net-buttons/js/buttons.print.min.js'></script>
<script type='text/javascript' src='../vendors/jszip/dist/jszip.min.js'></script>
<script type='text/javascript' src='../vendors/pdfmake/build/pdfmake.min.js'></script>
<script type='text/javascript' src='../vendors/pdfmake/build/vfs_fonts.js'></script>

<!-- My Custom Core JS -->
<script type="text/javascript" src="./js/datatable.custom.js"></script>
<script type="text/javascript" src="js/main.core.js"></script>
<script type="text/javascript" src="./js/form.js"></script>
<script type="text/javascript" src="./js/apps.js"></script>
<style type="text/css">
body {
	color:#444;
}
.form-control, select {
	font-size:12px;
}
</style>
</head>
<body class="nav-md main_body">
<div class="container body">
  <div class="main_container">
    <div class="col-md-3 left_col menu_fixed"> <!--  -->
      <div class="left_col scroll-view">
        <div class="navbar nav_title"><a href="index.php" class="site_title"><i class="fa fa-globe"></i> <span>
          <?=SITE_NAME?>
          </span></a> </div>
        <div class="clearfix"></div>
        
        <!-- menu profile quick info -->
        <div class="profile">
          <div class="profile_pic"> <img src="<?=Auth::getProfilePicture()?>" alt="..." class="img-circle profile_img"> </div>
          <div class="profile_info"> <span>Welcome,</span>
            <h2> <span id="show_realname">
              <?=Auth::getRealName()?>
              </span> </h2>
          </div>
        </div>
        <!-- /menu profile quick info --> 
        
        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
          <div class="menu_section">
            <h6>&nbsp;</h6>
            <?=MENU::showMenu();?>
          </div>
        </div>
        
        <!-- top navigation -->
        <?=Menu::showTopNavBar();?>
        <!-- /top navigation --> 
        
        <!-- page content -->
        <div class="right_col" role="main">
          <div style="margin-top:60px;"></div>
          <?=MainWeb::setBreadcrumb();?>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div id="divPage">
                <?php

				// Setup Route to call mpdule & page
					 if(isset($_GET['form']) && isset($Config['modules']) && isset($Config['page'])){
                        include("./modules/".$Config['modules']."/".$Config['page']."_form.php");
                    }else if(isset($Config['modules']) && isset($Config['page'])){
                        include("./modules/".$Config['modules']."/".$Config['page'].".php");
                    }else if(isset($Config['modules']) && !isset($Config['page'])){
                        include("./modules/".$Config['modules']."/index.php");
                    }else{
						 include("main.php");						
					}					
					?>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content --> 
        
        <!-- footer content -->
        <footer>
          <div class="pull-right">
            <?=COPYRIGHT?>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content --> 
      </div>
    </div>
  </div>
</div>
<input name="modules" id="modules" type="hidden" value="<?=$Config['modules']?>">
<input name="page" id="page" type="hidden" value="<?=$Config['page']?>">
<input name="chkMenuAuth" id="chkMenuAuth" type="hidden" value="<?=$chkMenuAuth?>">
<input name="pageRedirect" id="pageRedirect" type="hidden" value="<?=$_SERVER['HTTP_REFERER']?>">
<div id="divMsg"></div>
<!-- JS Custom --> 
<script type="text/javascript" src="../build/js/custom.min.js"></script>
</body>
</html>
<?php
$db->null;
?>