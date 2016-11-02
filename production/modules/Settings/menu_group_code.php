<?php
@session_start();

/*print "<pre>";
print_r($_POST);
print "</pre>";
*/
include('../../includes/DBConnect.php');


$action = $_POST['action'];
$mgroup_id = $_POST['id'];
$menu_group_th = $_POST['menu_group_th'];
$menu_group_en = $_POST['menu_group_en'];
$module_name = $_POST['module_name'];
$menu_order = $_POST['menu_order'];
$icon_id = $_POST['icon_id'] =="" ? "1" : $_POST['icon_id'];
$user_id = $_SESSION['sess_user_id'];

$db->debug =0;

if($action == "actionCreate"){     
		$sql = "INSERT INTO menu_group 
								(  menu_group_th, menu_group_en, module_name,menu_order, icon_id ,update_by )
					VALUES ( '$menu_group_th',
								 '$menu_group_en', 
								'$module_name',
								 $menu_order, 
								 $icon_id,
								 $user_id
								 );";
		
}else if($action == "actionUpdate"){ 
		$sql = "UPDATE menu_group 
								SET   
										menu_group_th = '$menu_group_th', 
										menu_group_en='$menu_group_en',  
										module_name= '$module_name',  
										menu_order = $menu_order,  
										icon_id = $icon_id ,
										update_by  = $user_id 										
					WHERE mgroup_id = $mgroup_id ";

}else if($action == "actionDelete"){
		$sql = "DELETE FROM menu_group WHERE mgroup_id IN ($mgroup_id) " ;
}

	$result = $db->Execute($sql);
	if($result){
			echo  "1";
	}else{
			echo "0";
}

?>