<?php
@session_start();
include('../../includes/DBConnect.php');

$action = $_POST['action'];
$user_id = $_POST['id'];
$username = trim($_POST['username']);
$password_hash = trim($_POST['password_hash']);
$realname = trim($_POST['realname']);
$email = $_POST['email'];
$rememPass = $_POST['rememPass'];
$avatar = basename($_POST['avatar']);

$update_user_id = $_SESSION['sess_user_id'];
/*print "<pre>";
print_r($_POST);
print "</pre>";*/

$db->debug = 0;
/************************************************/

function set_authorize(){
global $db ,$update_user_id,$action ,$user_id;			
				
		/************************************************/
		# เพิ่มค่าที่ tbl_user_auth
		// ทำการเคลียร์ค่าใน table tbl_user_auth ตามรหัส user_id	 ทุกครั้ง
	 	
		if($action <> "actionCreate"){ 
		$sql_del_group = "DELETE FROM user_auth WHERE user_id = $user_id ";			
		$db->Execute($sql_del_group);
		}
		
		// ทำการเคลียร์ค่าใน table tbl_module_auth ตามรหัส user_id	 ทุกครั้ง
	 	//$sql_del_module = "DELETE FROM module_auth WHERE user_id = $id ";			
		//$db->Execute($sql_del_module);
		
		if($action == "actionCreate"){ 
			// หาค่าล่าสุดจาก tbl_users จากค่า auto increatment
			$rs_get_lastID = $db->GetRow("SELECT MAX(user_id) as MAXID FROM  user ");
			$getMaxID = $rs_get_lastID['MAXID'];	
			$set_user_id = $getMaxID;
		}else if($action == "actionUpdate"){ 
			$set_user_id = $user_id;
		}
	
		// วนเพิ่มข้อมูลใน Table tbl_user_auth
		
		if($_POST['user_group']){ // ถ้าไม่มีการเลือกกลุ่มผู้ใช้งานให้ค่าเริ่มต้นเป็น User/Requester group_id =4						
					//	echo	$sql_add_ugroup = "INSERT INTO tbl_user_auth (group_id,user_id) VALUES (4,$set_user_id); ";			
					//	$db->Execute($sql_add_ugroup);
				foreach($_POST['user_group'] as $v){
					 	$sql_add_ugroup = "INSERT INTO user_auth (group_id,user_id , update_by) VALUES ($v,$set_user_id , $update_user_id); ";			
						$db->Execute($sql_add_ugroup);
				}
		}
		
		
		// วนเพิ่มข้อมูลใน Table tbl_module_auth
		
		/*if($_POST['module_name']){
					
				foreach($_POST['module_name'] as $v){
					 	$sql_add_module = "INSERT INTO tbl_module_auth (user_id , module_name) VALUES ($set_user_id ,  '$v'); ";			
						$db->Execute($sql_add_module);
				}
		}*/
		

		
} // End function


if($action == "actionCreate"){     
	 	 $sql = "INSERT INTO user
								( username, password_hash,  realname  , email ,avatar , update_by  )
					VALUES ( '$username',PASSWORD('$password_hash'),'$realname','$email' , '$avatar', $update_user_id);";
		$result = $db->Execute($sql);
		
			
		set_authorize(); // เรียกใช้การ update ค่าในตาราง  tbl_user_auth
		
		
}else if($action == "actionUpdate"){ 
	
	$str = $rememPass  <> 'Y' ? "password_hash = PASSWORD('$password_hash'), " : "";
	
	 $sql = "UPDATE user
								SET  username ='".$username."', 
										$str
										realname='$realname',															
										update_by = '$update_user_id',
										email = '$email'	,
										avatar = '$avatar' 
					WHERE user_id = $user_id ;";
		$result = $db->Execute($sql);
		
		set_authorize(); // เรียกใช้การ update ค่าในตาราง tbl_user_on_site และ tbl_user_auth

}else if($action == "actionDelete"){
	$sql = "DELETE FROM user WHERE user_id IN ($user_id);";
	$result = $db->Execute($sql);
	
}
	
	
	if($result){
			echo  "1";
	}else{
			echo "0";
}

?>