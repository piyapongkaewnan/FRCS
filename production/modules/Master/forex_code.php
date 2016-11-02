<?php
@session_start();
/*
print "<pre>";
print_r($_POST);
print "</pre>";
*/

include('../../includes/DBConnect.php');


$action = $_POST['action'];
$id = $_POST['id'];
$FXCode = $_POST['FXCode'];
$FXSymbol = $_POST['FXSymbol'];
$FxName = $_POST['FxName'];
$IsBase = $_POST['IsBase']  ?  $_POST['IsBase'] : 'NULL';
$RateToBase = $IsBase == "1" ? "1" : $_POST['RateToBase']; //(if True, RateToBase is automatically set to 1)
$IsActive = $_POST['IsActive']  ?  $_POST['IsActive'] : 'NULL';
$user_id = $_SESSION['sess_user_id'];

$db->debug =0;

if($action == "actionCreate"){     
		$sql = "INSERT INTO fx 
								(  FXCode,FXSymbol,FxName,IsBase,RateToBase,IsActive,CreatedBy,CreatedOn )
					VALUES ( '$FXCode',
								 '$FXSymbol', 
								 '$FxName',
								 $IsBase,
								 $RateToBase, 
								 $IsActive,
								 $user_id,
								 NOW()
								 );";
		
}else if($action == "actionUpdate"){ 
		$sql = "UPDATE fx
								SET   
										FXCode ='$FXCode',
										FXSymbol = '$FXSymbol', 
										FxName='$FxName',
										IsBase=$IsBase,
										RateToBase = $RateToBase,
										IsActive = $IsActive,
										IsDelete = CASE IsActive WHEN 1 THEN 0 WHEN 0 THEN 0 END,
										ModifiedBy = $user_id, 
										ModifiedOn = NOW() 										
					WHERE id = $id ";

}else if($action == "actionDelete"){
		$sql = "UPDATE fx
								SET  														
										IsDelete = 1,
										IsActive = CASE IsDelete WHEN 1 THEN 0 WHEN 0 THEN 1 END,
										DeletedBy = $user_id, 
										DeletedOn = NOW() 										
					WHERE id IN ($id) " ;
}

	$result = $db->Execute($sql);
	if($result){
			echo  "1";
	}else{
			echo "0";
}

?>