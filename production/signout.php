<?php
session_start();

#############################
# Section : Includes Files
require_once(".//includes/DBConnect.php");
require_once("./includes/Class/Auth.Class.php");
require_once("./includes/Class/Main.Class.php");
//require_once("./includes/functions.php");

//Call Auth Class
$user_id =  $_SESSION['sess_user_id'];
$sess_id = $_SESSION['sess_id'];
$realname = $_SESSION['sess_realname'];

!$_SESSION['sess_user_id'] ?  MainWeb::redirect('signin.php') : '';

$timeCountDown = 10; // Set time countdown x secound

Auth::setDB($db);
Auth::setUserID($user_id);

$sqlUpdateStat = "UPDATE stats_login SET logout_datetime = Now() WHERE session_id = '$sess_id' ";
$db->Execute($sqlUpdateStat);

 $sqlSummary = "SELECT
							  c.menu_name_en,
							  b.event_datetime
							FROM stats_login a
							  JOIN stats_events b
								ON a.session_id = b.session_id
							  JOIN menu c
								ON b.menu_id = c.menu_id
							WHERE a.user_id = $user_id
								AND a.session_id = '$sess_id'
							ORDER BY b.event_datetime ";
$rsSummary = $db->GetAll($sqlSummary);
//$rememberRealName = $_SESSION['sess_realname'];
//$sesToUnset = array('sess_id','sess_user_id','sess_user_name','sess_email','sess_realname');

//show_session();
foreach($_SESSION as  $key => $val){
	unset($_SESSION[$key]);
}

// Store realname for Display login page
//$_SESSION['sess_realname'] = $rememberRealName;

// Redirect
//MainWeb::redirect('login.php');


$db->debug=0;

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
<title><?=SITE_NAME?> | Logout</title>

<!-- Custom Theme Style -->
<!-- Bootstrap -->
<link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome -->
<link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<script type="text/javascript" src="../vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script type="text/javascript" src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../vendors/moment/min/moment.min.js"></script> 
</head>
<style type="text/css">
body {
	font-size:12px;
}
</style>

<!-- // Set redirect URL for redirect after Sign On	 -->

<script type="text/javascript">
    if(supportsHTML5Storage()) {
		localStorage.setItem("APPS.SITE.URL_REDIRECT", '<?=$_SERVER['HTTP_REFERER']?>'); 	
	}
	
function supportsHTML5Storage() {
    try {
        return 'localStorage' in window && window['localStorage'] !== null;
    } catch (e) {
        return false;
    }
}	
	
</script>
<!-- // Set redirect URL for redirect after Sign On	 -->


<script type="text/javascript">
$(function(){
	
// Countdown time	
var time = <?=$timeCountDown?>; // Secound
var duration = moment.duration(time * 1000, 'milliseconds');
var interval = 1000;

setInterval(function(){
  duration = moment.duration(duration.asMilliseconds() - interval, 'milliseconds');
 
  
	if(duration.asSeconds() <= 0){
       // console.log("STOP!");
       // console.log(duration.asSeconds());
        //clearInterval(timerID);
		window.location = 'signin.php';
    }  else{  
	  //show how many hours, minutes and seconds are left

	$('.countdown').html('('+ moment(duration.asMilliseconds()).format('s')+')');
    }	
}, interval);


});

</script>
<body class="logout">
<div class="container container-fluid">
  <p>&nbsp;</p>
  <div class="alert alert-success alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <strong><i class="fa fa-sign-out"></i> Sign Out Success !! </strong>&nbsp;&nbsp; Please wait <span class="countdown"></span> second, for see more activity below Or don't wait click <label class="label label-primary">Sign In</label> button </div>
  <div class="panel panel-default "> 
    <!-- Default panel contents -->
    <div class="panel-heading"><strong><i class="fa fa-line-chart"></i> Activity Summary :
      <?=$realname?>
      </strong></div>
    
    <!-- Table -->
    <table cellpadding="0" cellspacing="0" class="table table-hover">
      <thead class="text-success">
        <tr>
          <th width="9%">No.</th>
          <th width="42%">Program</th>
          <th width="49%">Activity Time</th>
        </tr>
      </thead>
      <tbody>
        <?php
	  if(sizeof($rsSummary)>0){
	  	for($i=0;$i<count($rsSummary);$i++){
	  ?>
        <tr>
          <th scope=row><?=($i+1)?></th>
          <td><?=($rsSummary[$i]['menu_name_en'])?></td>
          <td><?=($rsSummary[$i]['event_datetime'])?></td>
        </tr>
        <?php
		} 
	  }else{
		?>
        <tr>
          <td colspan="3" align="center"><span class="text-danger">No activity !</span></td>
        </tr>
        <?php	
		}
		?>
      </tbody>
    </table>
  </div>
  <div class="text-center"><a href="signin.php" class="btn btn-primary btn-sm"><i class="fa fa-sign-in"></i> Sign In <span class="countdown"></span></a> </div>
</div>
<br>
</body>
</html>