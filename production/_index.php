<?php
session_start();

#############################
# Section : Includes Files
require_once("./includes/DBConnect.php");
require_once("./includes/Class/Auth.Class.php");
require_once("./includes/Class/Menu.Class.php");
require_once("./includes/Class/Main.Class.php");

require_once("./includes/functions.php");

# Check Session Timeout
include("./session_timeout.php");


if(!isset($_SESSION['sess_user_id'])){ pageback('login.php',''); }

//Assign Variable

//$_SESSION['sess_user_name'] = "Administrator";


$Config['user_id'] =  $_SESSION['sess_user_id'];
$Config['realname'] = $_SESSION['sess_realname'];
$Config['modules'] = $_GET['modules'];
$Config['page'] = $_GET['page'];



//Call Auth Class
Auth::setDB($db);
Auth::setUserID($Config['user_id']);
Auth::setRealName($Config['realname']);
Auth::setModule($Config['modules']);
Auth::setPage($Config['page']);


//Call MainWeb Class
MainWeb::GetSiteInfo(); // Get webpage variable
Auth::setLanguage(LANGUAGE);
MainWeb::getPageInfo();


$titleVal = MainWeb::getTitleVal();

$chkMenuAuth = Auth::isAllowPage();

if(!$chkMenuAuth){ pageback('page_403.php',''); }

//Check is Guest = to login page
if(Auth::isGuest()){ pageback('login.php',''); }


$db->debug= false;

?>
<!DOCTYPE html>
<html lang="en" ng-app>
<head>
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

<!-- bootstrap-progressbar -->
<link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
<!-- JQVMap -->
<!--<link href="../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>-->

<!-- PNotify -->
<link href="../vendors/pnotify/dist/pnotify.css" rel="stylesheet">
<link href="../vendors/pnotify/dist/pnotify.buttons.css" rel="stylesheet">
<link href="../vendors/pnotify/dist/pnotify.nonblock.css" rel="stylesheet">

<!-- jQuery custom content scroller -->
<link href="../vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" rel="stylesheet"/>

<!-- Custom Theme Style -->
<link href="../build/css/custom.min.css" rel="stylesheet">

<!-- jQuery -->
<script src="../vendors/jquery/dist/jquery.min.js"></script>

<!-- Angular -->
<script src="../vendors/angular/angular.min.js"></script>

<!-- PNotify --> 
<script src="../vendors/pnotify/dist/pnotify.js"></script> 
<script src="../vendors/pnotify/dist/pnotify.buttons.js"></script> 
<script src="../vendors/pnotify/dist/pnotify.nonblock.js"></script> 

<!-- My Custom Core JS -->
<script src="js/main.core.js"></script>

<title><?=SITE_NAME;?> | <?=MainWeb::setTitleBar();?></title>
<style type="text/css">
body {
	color : #444;
}
</style>
</head>
<body class="nav-md main_body">
<div class="container body">
  <div class="main_container">
    <div class="col-md-3 left_col menu_fixed"> <!--  -->
      <div class="left_col scroll-view">
        <div class="navbar nav_title"><a href="index.php" class="site_title"><i class="fa fa-paw"></i> <span>
          <?=SITE_NAME?>
          </span></a> </div>
        <div class="clearfix"></div>
        
        <!-- menu profile quick info -->
        <div class="profile">
          <div class="profile_pic"> <img src="images/img.jpg" alt="..." class="img-circle profile_img"> </div>
          <div class="profile_info"> <span>Welcome,</span>
            <h2>
              <span id="show_realname"><?=Auth::getRealName()?></span>
            </h2>
          </div>
        </div>
        <!-- /menu profile quick info --> 
               
        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
          <div class="menu_section">
            <h3>General</h3>
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
              <!-- top tiles --> 
              <!--
          <div class="row tile_count">
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Users</span>
              <div class="count">2500</div>
              <span class="count_bottom"><i class="green">4% </i> From last Week</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-clock-o"></i> Average Time</span>
              <div class="count">123.50</div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> From last Week</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Males</span>
              <div class="count green">2,500</div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Females</span>
              <div class="count">4,567</div>
              <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>12% </i> From last Week</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Collections</span>
              <div class="count">2,315</div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Connections</span>
              <div class="count">7,325</div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
            </div>
          </div>
--> 
              <!-- /top tiles -->
              
              <div id="divPage">
                <?php
				// Setup Route to call mpdule & page
                    if(isset($Config['modules']) && isset($Config['page'])){
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
          <div class="pull-right"> <?=COPYRIGHT?> <br>          
          <?=SITE_NAME?></div>
          <div class="clearfix"></div>
        </footer>        
        <!-- /footer content --> 
        
      </div>
    </div>
  </div>
</div>
<input name="modules" id="modules" type="hidden" value="<?=$Config['modules']?>">
<input name="page" id="page" type="hidden" value="<?=$Config['page']?>">
<input name="chkMenuAuth" id="chkMenuAuth" type="text" value="<?=$chkMenuAuth?>">
<div id="divMsg"></div>
<!-- Modal -->
<!--<div class="modal fade" id="PermissionModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content alert alert-danger">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h5 class="modal-title" id="myModalLabel"><img src='images/iconError.gif' align='absmiddle'><strong > Warning!!</strong></h5>
      </div>
      <div class="modal-body">
        <p><strong> You Do Not Have Sufficient Permission to Access This Page!!</strong><br>
          Please contact your administrator..</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>-->

<!-- Bootstrap --> 
<script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script> 

<!-- FastClick --> 
<!--<script src="../vendors/fastclick/lib/fastclick.js"></script> --> 
<!-- NProgress --> 
<script src="../vendors/nprogress/nprogress.js"></script> 
<!-- Chart.js --> 
<!--<script src="../vendors/Chart.js/dist/Chart.min.js"></script> --> 
<!-- gauge.js --> 
<!--<script src="../vendors/gauge.js/dist/gauge.min.js"></script> --> 
<!-- bootstrap-progressbar --> 
<script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script> 

<!-- Skycons --> 
<!--<script src="../vendors/skycons/skycons.js"></script> --> 
<!-- Flot --> 
<!--<script src="../vendors/Flot/jquery.flot.js"></script> 
<script src="../vendors/Flot/jquery.flot.pie.js"></script> 
<script src="../vendors/Flot/jquery.flot.time.js"></script> 
<script src="../vendors/Flot/jquery.flot.stack.js"></script> 
<script src="../vendors/Flot/jquery.flot.resize.js"></script> --> 
<!-- Flot plugins --> 
<!--<script src="../vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script> 
<script src="../vendors/flot-spline/js/jquery.flot.spline.min.js"></script> 
<script src="../vendors/flot.curvedlines/curvedLines.js"></script> --> 
<!-- DateJS --> 
<!--<script src="../vendors/DateJS/build/date.js"></script> -->
<!-- JQVMap --> 
<!--<script src="../vendors/jqvmap/dist/jquery.vmap.js"></script> 
<script src="../vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script> 
<script src="../vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script> --> 
<!-- jQuery custom content scroller --> 
<script src="../vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script> 

<!-- bootstrap-daterangepicker --> 
<script src="js/moment/moment.min.js"></script> 
<script src="js/datepicker/daterangepicker.js"></script> 

<script src="../build/js/custom.min.js"></script> 
</body>
</html>
<?php
$db->null;
?>