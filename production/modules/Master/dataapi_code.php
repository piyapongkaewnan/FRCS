<?php
@session_start();
/*print "<pre>";
print_r($_POST);
print "</pre>";
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
//$paramName = $_POST['paramName'];
//$paramValue = $_POST['paramValue'];
$user_id = $_SESSION['sess_user_id'];

$db->debug =0;

// Function for set API Detail 
function setAPIDetail(){
global $db ,$user_id,$action ,$id;			
				
		/************************************************/
		# Add dataapidetail
		// Clear data on table dataapidetail where  id  when action = actionCreate ,  actionUpdate
	 	
		if($action <> "actionCreate"){ 
		$sqlDelData = "DELETE FROM dataapidetail WHERE APIID = $id ";			
		$db->Execute($sqlDelData);
		}
		
		if($action == "actionCreate"){ 
			// Get MAX from  tbl_users จากค่า auto increatment
			$rs_get_lastID = $db->GetRow("SELECT MAX(id) as MAXID FROM  dataapi ");
			$APIID = $rs_get_lastID['MAXID'];	
			
		}else if($action == "actionUpdate"){  //APIID = $_POST['id']
			$APIID = $id;
		}
	
		// Loop for insert data to dataapidetail		
		if($_POST['paramName']){ 
				for($i=0;$i<sizeof($_POST['paramName']);$i++){
							$sqladdParam = "INSERT INTO dataapidetail (
																		APIID,
																		ParameterName,
																		ParameterValue) 
														VALUES (	
																	$APIID ,
																	'".$_POST['paramName'][$i]."' ,
																	'".$_POST['paramValue'][$i]."' 														
														);";
								$rsActionParam = $db->Execute($sqladdParam);
					}
					
		}
		
			echo $rsActionParam ? '1' : '0';
		
} // End function



if($action == "actionCreate"){     
	  //CASE  Partner2 WHEN  '' THEN NULL ELSE '$Partner2' END,
		$sqlCreate = "INSERT INTO dataapi  (
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
		$resultCreate = $db->Execute($sqlCreate);
		
		if($resultCreate){	 			
				setAPIDetail(); // function API Detail			
		}else{
				echo '0';	
		}

		
}else if($action == "actionUpdate"){  
		$sqlUpdate = "UPDATE 	dataapi 
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
					WHERE id = $id ; ";
					
					$resultUpdate = $db->Execute($sqlUpdate);
		
		if($resultUpdate){
			setAPIDetail(); // function API Detail			
			
		}else{
			echo '0';	
		}


}else if($action == "actionDelete"){
		$sql = "UPDATE dataapi
								SET  				
										IsDelete = 1,
										IsActive = CASE IsDelete WHEN 1 THEN 0 WHEN 0 THEN 1 END,
										DeletedBy = $user_id, 
										DeletedOn = NOW() 										
					WHERE id IN ( $id ) ;" ;
		$result = $db->Execute($sql);
	
		echo $result ? '1' : '0';	
					
}

	

?>