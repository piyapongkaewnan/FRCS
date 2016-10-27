<?php
session_start();

//Call Auth Class
$user_id =  $_SESSION['sess_user_id'];
$sess_id = $_SESSION['sess_id'];

#############################
# Section : Includes Files
require_once(".//includes/DBConnect.php");
require_once("./includes/Class/Auth.Class.php");
require_once("./includes/Class/Main.Class.php");
require_once("./includes/functions.php");

Auth::setDB($db);
Auth::setUserID($user_id);

$sqlUpdateStat = "UPDATE stats_login SET logout_datetime = Now() WHERE session_id = '$sess_id' ";
$db->Execute($sqlUpdateStat);

//$rememberRealName = $_SESSION['sess_realname'];
$sesToUnset = array('sess_id','sess_user_id','sess_user_name','sess_email','sess_realname');

//show_session();
foreach($sesToUnset as  $sess){
	unset($_SESSION[$sess]);
}

// Store realname for Display login page
//$_SESSION['sess_realname'] = $rememberRealName;

// Redirect
MainWeb::redirect('login.php');


?>