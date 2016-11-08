<?php
@session_start();

include('../../includes/DBConnect.php');


/*print_r($_POST);*/
//exit;
if(!$_POST) return;

$db->debug=0;

$user_id = $_SESSION['sess_user_id'];
$username = $_POST['username'];
$password_hash = $_POST['password_hash'];
$email = $_POST['email'];
$realname = $_POST['realname'];

$isChange = $_POST['isChange'];

$str = $isChange   == 'Y' ? "password_hash = PASSWORD('$password_hash'), " : "";

	//แก้ไขข้อมูล
	  	 $sql = "UPDATE user 
								SET 
										username = '".$username."' ,
										$str
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
