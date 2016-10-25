<?php
@session_start();

include('../../includes/DBConnect.php');

if(!$_POST) return;

$user_id = $_SESSION['sess_user_id'];

$website_name = $_POST['website_name'];
$website_language = $_POST['website_language'];

	//แก้ไขข้อมูล
	  	 $sql = "UPDATE configs 
								SET 
										website_name = '".$website_name."' ,
										website_language = '".$website_language."',										
										update_by = $user_id  ";
			$result =  $db ->Execute($sql);

if($result){
			echo  true;
	}else{
			echo false;
}

?>
