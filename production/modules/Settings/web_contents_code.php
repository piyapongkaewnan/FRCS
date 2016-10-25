<?php
include('../../includes/config.inc.php');

$action = $_POST['doAction'];
$id = $_POST['id'];
$name = $_POST['content_name'];
$desc = $_POST['content_desc'];


$update_by = $_POST['update_by'];

$db->debug = 0;


if($action == "new"){     
	
		
		$sql = "INSERT INTO tbl_contents
								(
								content_name,								
								content_desc	,
								update_by							
								 )
					VALUES (
								 '$name',								 
								  '".nl2br ($desc)."'	,
								  	'$update_by'							 
								 );";
		
}else if($action == "edit"){ 
		
			 $sql = "UPDATE tbl_contents
								SET  																				
										content_name = '$name' , 										
										content_desc ='".nl2br ($desc)."'	,
										update_by = '$update_by'									
					WHERE id = $id ";
		

}else if($_GET['doAction'] == "delete"){
	$sql = "DELETE FROM tbl_contents WHERE id = ".$_GET['id'];

}
	$result = $db->Execute($sql);
	if($result){
			echo  "1";
	}else{
			echo "0";
			
}

?>