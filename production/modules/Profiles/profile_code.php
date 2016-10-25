<?php
@session_start();

include('../../includes/DBConnect.php');

if(!$_POST) return;

$user_id = $_SESSION['sess_user_id'];
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$realname = $_POST['realname'];

	//แก้ไขข้อมูล
	  	 $sql = "UPDATE user 
								SET 
										username = '".$username."' ,
										password_hash = PASSWORD('".$password."'),
										email = '".$email."',
										realname = '$realname',
										update_by = $user_id 									
					WHERE user_id = $user_id ";
			$result = $db->Execute($sql);		

if($result){
			echo  true;
	}else{
			echo false;
}

?>
