<?php
@session_start();

/* print "<pre>";
  print_r($_POST);
  print "</pre>";
  exit;
 */
include('../../includes/DBConnect.php');

$action = $_POST['action'];
$id = $_POST['id'];
$CountryCode = $_POST['CountryCode'];
$CountryName = $_POST['CountryName'];
$FxId = $_POST['FxId'];
$IsActive = $_POST['IsActive'] ? $_POST['IsActive'] : '0';
$user_id = $_SESSION['sess_user_id'];

$db->debug = 0;

if ($action == "actionCreate") {
    $sql = "INSERT INTO country 
                            (  CountryCode,CountryName,FxId,IsActive,CreatedBy,CreatedOn )
            VALUES ( '$CountryCode',
                            '$CountryName', 
                            '$FxId',								
                            $IsActive,
                            $user_id,
                            NOW()
                            );";
} else if ($action == "actionUpdate") {
    $sql = "UPDATE country 
            SET
                CountryCode ='$CountryCode',
                CountryName = '$CountryName', 									
                FxId='$FxId',
                IsActive = $IsActive,
                IsDelete = CASE IsActive WHEN 1 THEN 0 WHEN 0 THEN 0 END,
                ModifiedBy = $user_id, 
                ModifiedOn = NOW() 																		
            WHERE id = $id ";
} else if ($action == "actionDelete") {
    $sql = "UPDATE country
            SET  				
                IsDelete = 1,
                IsActive = CASE IsDelete WHEN 1 THEN 0 WHEN 0 THEN 1 END,
                DeletedBy = $user_id, 
                DeletedOn = NOW() 										
            WHERE id IN ( $id  );";
}

$result = $db->Execute($sql);
if ($result) {
    echo "1";
} else {
    echo "0";
}
?>