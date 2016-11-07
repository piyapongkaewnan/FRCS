<?php
session_start();

include('./includes/DBConnect.php');
include("./includes/Class/Auth.Class.php");
include("./includes/Class/Main.Class.php");

$db->debug=0;

//$main = new MainWeb();
//$rendom_text = MainWeb::random_gen(64);


//print_r($_POST);

if(!$_POST) return;
$username = trim($_POST['inputUsername']);
$password = trim($_POST['inputPassword']);

  $sqlUser = "SELECT
                        *						 
                       FROM user WHERE username = '$username'  AND password_hash = PASSWORD('$password'); "; 
$rsUser =  $db ->GetRow($sqlUser);

//show_post();
if(sizeof($rsUser)>0){
	// หาหน่วยงานแรกที่สังกัดเพื่อกำหนดเป็นค่าแรกใน Session
	
	$_SESSION['sess_id'] = MainWeb::random_gen(64); // session_id();
	$_SESSION['sess_user_id'] = $rsUser['user_id'];
	$_SESSION['sess_user_name'] = $rsUser['username'];
	$_SESSION['sess_email'] = $rsUser['email'];
	$_SESSION['sess_realname'] = $rsUser['realname'];
	$_SESSION['sess_avatar'] = $rsUser['avatar'];
	
	// หาค่า IP Address
	if($_SERVER['HTTP_X_FORWARDED_FOR'] == ""){
		$IP = $_SERVER['REMOTE_ADDR'];
	}else{
		$IP = $_SERVER['HTTP_X_FORWARDED_FOR'];
	}

 	$sql_stat = "INSERT INTO 
								stats_login 
										(user_id,
										session_id,
										login_datetime,
										ip_address) 
							VALUES (
										".$rsUser['user_id'].",
										'".$_SESSION['sess_id']."',
										NOW(),							
										'".$IP."'										
										) ";
	$db ->Execute($sql_stat);
	
	echo  true;
}else{
	echo false;
}
?>