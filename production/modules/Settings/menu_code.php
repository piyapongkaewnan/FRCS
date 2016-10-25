<?php
@session_start();
include('../../includes/DBConnect.php');


//menu_id , menu_name_th, menu_name_th,menu_file,mgroup_id,icon_id
$action = $_POST['action'];
$menu_id = $_POST['id'];
$menu_name_th = $_POST['menu_name_th'];
$menu_name_en = $_POST['menu_name_en'];
$menu_desc = $_POST['menu_desc'];
$menu_file = $_POST['menu_file'];
$mgroup_id = $_POST['mgroup_id'];
$menu_order = $_POST['menu_order'];
$menu_param = $_POST['menu_param'];
$icon_id = $_POST['icon_id'] =="" ? "1" : $_POST['icon_id'];
$user_id = $_SESSION['sess_user_id'];


$db->debug =0;


if($action == "actionCreate"){     
		$sql = "INSERT INTO menu 
								(  menu_name_th, menu_name_en,menu_desc,menu_file,menu_param,mgroup_id,menu_order,icon_id , update_by )
					VALUES ( '$menu_name_th',
								 '$menu_name_en', 
								 '$menu_desc',
								 '$menu_file',
								 '$menu_param',
								  $mgroup_id, 
								 $menu_order, 
								 $icon_id ,
								 '$user_id'
								 );";
								 
						//	CopyTemplate();	 
		
}else if($action == "actionUpdate"){ 
		 $sql = "UPDATE menu 
								SET   
										menu_name_th = '$menu_name_th', 
										menu_name_en='$menu_name_en',  
										menu_desc ='$menu_desc',  
										menu_file='$menu_file',  
										menu_param ='$menu_param', 
										mgroup_id = $mgroup_id,  
										menu_order = $menu_order,
										icon_id = $icon_id ,
										update_by = $user_id
					WHERE menu_id = $menu_id ";

}else if($action == "actionDelete"){
	 $sql = "DELETE FROM menu WHERE menu_id = ".$_POST['id'];
}
	$result = $db->Execute($sql);
	if($result){
			echo  "1";
	}else{
			echo "0";
}

?>