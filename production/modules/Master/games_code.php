<?php
@session_start();


include('../../includes/DBConnect.php');

$action = $_POST['action'];
$id = $_POST['id'];
$RefCode = $_POST['RefCode'];
$GroupCode = $_POST['GroupCode'];
$GameName = $_POST['GameName'];
$GameType = $_POST['GameType'];
$Territory = $_POST['Territory'];
$Partner1 = $_POST['Partner1'];
$Partner2 = $_POST['Partner2'];
$PercentShare = $_POST['PercentShare'];
$Publisher = $_POST['Publisher'];
$PaymentChannel = $_POST['PaymentChannel'];
$DataSourceRemarks = $_POST['DataSourceRemarks'];
$IsActive = $_POST['IsActive']  ?  $_POST['IsActive'] : '0';
$user_id = $_SESSION['sess_user_id'];

$db->debug =1;

if($action == "actionCreate"){     
		$sql = "INSERT INTO game  (
									  RefCode,
									  GroupCode,
									  GameName,
									  GameType,
									  Partner1,
									  Partner2,
									  PercentShare,
									  Territory,
									  Publisher,
									  PaymentChannel,
									  DataSourceRemarks,
									  IsActive,
									  CreatedBy, 
									  CreatedOn 
									  )
						VALUES (
									 '$RefCode',
									 '$GroupCode', 
									 '$GameName',	
									 '$GameType',	
									 '$Partner1',
									 '$Partner2',
									 '$PercentShare', 
									 '$Territory',	
									 '$Publisher',	
									 '$PaymentChannel',		
									 '$DataSourceRemarks',								
									 $IsActive,
									 $user_id,
									 NOW()
									 );";
		
}else if($action == "actionUpdate"){  //>> if game type = MarketPlace (3) , then Publisher value is Blank and Field is readonly
		$sql = "UPDATE 	game 
								SET
										RefCode = '$RefCode',
										GroupCode = '$GroupCode', 
										GameName = '$GameName',
										GameType = '$GameType',
										Partner1 = '$Partner1',
										Partner2 = '$Partner2',
										PercentShare = '$PercentShare', 
										Territory = '$Territory',
										Publisher = CASE GameType WHEN 3 THEN NULL ELSE '$Publisher' END ,
										PaymentChannel = '$PaymentChannel',
										DataSourceRemarks = '$DataSourceRemarks',
										IsActive = $IsActive,
										IsDelete = CASE IsActive WHEN 1 THEN 0 WHEN 0 THEN 0 END,
										ModifiedBy = $user_id, 
										ModifiedOn = NOW() 																		
					WHERE id = $id ";


}else if($action == "actionDelete"){
		$sql = "UPDATE game
								SET  				
										IsDelete = 1,
										IsActive = CASE IsDelete WHEN 1 THEN 0 WHEN 0 THEN 1 END,
										DeletedBy = $user_id, 
										DeletedOn = NOW() 										
					WHERE id = $id " ;
}

	$result = $db->Execute($sql);
	if($result){
			echo  "1";
	}else{
			echo "0";
}

?>