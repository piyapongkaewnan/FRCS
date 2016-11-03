<?php
@session_start();
/*print "<pre>";
print_r($_POST);
print "</pre>";
exit;
*/
include('../../includes/DBConnect.php');

$action = $_POST['action'];
$id = $_POST['id'];
$APIRefCode = $_POST['APIRefCode'];
$APIName = $_POST['APIName'];
$APIUrl = $_POST['APIUrl'];
$UserName = $_POST['UserName'];
$Password = $_POST['Password'];
$DataSourceType = $_POST['DataSourceType'];
$IsActive = $_POST['IsActive']  ?  $_POST['IsActive'] : '0';
$user_id = $_SESSION['sess_user_id'];

$db->debug =0;

$strPartner2 = $Partner2 == '' ? 'NULL' : $Partner2;

if($action == "actionCreate"){     
	  //CASE  Partner2 WHEN  '' THEN NULL ELSE '$Partner2' END,
		$sql = "INSERT INTO dataapi  (
									APIRefCode,
									APIName,
									APIUrl,
									UserName,
									Password,
									DataSourceType,
									IsActive,
									CreatedBy, 
									CreatedOn 
									  )
						VALUES (
									 '$APIRefCode',
									'$APIName',
									'$APIUrl',
									'$UserName',
									'$Password',
									'$DataSourceType',
									$IsActive ,
									 $user_id,
									 NOW()
									 );";
		
}else if($action == "actionUpdate"){  
		$sql = "UPDATE 	dataapi 
								SET
										APIRefCode	 =	'$APIRefCode',
										APIName	 =	'$APIName',
										APIUrl	 =	'$APIUrl',
										UserName	 =	'$UserName',
										Password	 =	'$Password',
										DataSourceType	 =	'$DataSourceType',
										IsActive	 =	$IsActive,
										IsDelete = CASE IsActive WHEN 1 THEN 0 WHEN 0 THEN 0 END,
										ModifiedBy = $user_id, 
										ModifiedOn = NOW() 																		
					WHERE id = $id ";


}else if($action == "actionDelete"){
		$sql = "UPDATE dataapi
								SET  				
										IsDelete = 1,
										IsActive = CASE IsDelete WHEN 1 THEN 0 WHEN 0 THEN 1 END,
										DeletedBy = $user_id, 
										DeletedOn = NOW() 										
					WHERE id IN ( $id ) " ;
}

	$result = $db->Execute($sql);
	if($result){
			echo  "1";
	}else{
			echo "0";
}

?>