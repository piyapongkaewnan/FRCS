<?php
@session_start();
include('../../includes/config.inc.php');

$web_name = $_POST['web_name'];
$lang = $_POST['lang'];
$theme = $_POST['theme'];
$user = $_SESSION['sess_name'];

// Update Config Table
$sql = "UPDATE tbl_configs SET website_name = '$web_name',website_theme = '$theme', website_language= '$lang' , update_by = '$user' ;";
$result = $db->Execute($sql);
if($result){
		echo  "1";
}else{
		echo "0";
}

?>