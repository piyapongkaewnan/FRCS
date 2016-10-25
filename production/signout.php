<?php
@session_start();
include('./includes/config.inc.php');
require_once("./includes/functions.php");

$sql = "UPDATE tbl_stats_login SET logout_datetime = NOW() WHERE session_id = '".$_SESSION['sess_id']."' ";
$db->Execute($sql);

unset($_SESSION['sess_id']);
unset($_SESSION['sess_user_id']);
unset($_SESSION['sess_user_name']);
unset($_SESSION['sess_name']);
unset($_SESSION['sess_email']);
unset($_SESSION['timeout']);



$redirect = !isset($_SESSION['sess_bis_user']) ? "signin.php" : "https://bis.cattelecom.com";

unset($_SESSION['sess_bis_user']);
unset($_SESSION['sess_bis_pass']);
unset($_SESSION['sess_bis_name']);

pageback($redirect,'');
?>