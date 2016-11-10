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
$APIRefCode = $_POST['APIRefCode'];
$APIName = $_POST['APIName'];
$APIUrl = $_POST['APIUrl'];
$UserName = $_POST['UserName'];
$Password = $_POST['Password'];
$DataSourceType = $_POST['DataSourceType'];
$IsActive = $_POST['IsActive'] ? $_POST['IsActive'] : '0';
$user_id = $_SESSION['sess_user_id'];
//$paramName = $_POST['paramName'];
//$paramValue = $_POST['paramValue'];
$user_id = $_SESSION['sess_user_id'];

$isChange = $_POST['isChange'];

$db->debug = 0;

// Function for set API Detail 
function setAPIDetail() {
    global $db, $user_id, $action, $id, $isChange;

    /*     * ********************************************* */
    # Add dataapidetail
    // Clear data on table dataapidetail where  id  when action = actionCreate ,  actionUpdate

    if ($action <> "actionCreate" && $isChange == "1") {
        $sqlDelData = "DELETE FROM dataapidetail WHERE APIID = $id ";
        $db->Execute($sqlDelData);
    }

    if ($action == "actionCreate" && isset($_POST['paramName'])) {
        // Get MAX from  tbl_users จากค่า auto increatment
        $rs_get_lastID = $db->GetRow("SELECT MAX(id) as MAXID FROM  dataapi ");
        $APIID = $rs_get_lastID['MAXID'];
    } else if ($action == "actionUpdate") {  //APIID = $_POST['id']
        $APIID = $id;
    }

    // Loop for insert data to dataapidetail		
    if (isset($_POST['paramName']) && $isChange == "1") {
        for ($i = 0; $i < sizeof($_POST['paramName']); $i++) {
            $sqladdParam = "INSERT INTO dataapidetail (
                                            APIID,
                                            ParameterName,
                                            ParameterValue) 
                                    VALUES (	
                                            $APIID ,
                                            '" . $_POST['paramName'][$i] . "' ,
                                            '" . $_POST['paramValue'][$i] . "' 														
                                    );";
            $rsActionParam = $db->Execute($sqladdParam);
        }

        return $rsActionParam ? '1' : '0';
    } else {
        
    } return '1';
}

// End function



if ($action == "actionCreate") {
    //CASE  Partner2 WHEN  '' THEN NULL ELSE '$Partner2' END,
    $sqlAction = "INSERT INTO dataapi  (
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
    /* 	$resultCreate = $db->Execute($sqlCreate);

      if($resultCreate &&  isset($_POST['paramName'])){
      setAPIDetail(); // function API Detail
      }else if($resultCreate){
      echo '1';
      }else{
      echo '0';
      }
     */
} else if ($action == "actionUpdate") {
    $sqlAction = "UPDATE 	dataapi 
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

    //	$resultUpdate = $db->Execute($sqlAction);

    /* 	if($resultUpdate){
      setAPIDetail(); // function API Detail

      }else{
      echo '0';
      } */
} else if ($action == "actionDelete") {
    $sqlAction = "UPDATE dataapi
                SET  				
                    IsDelete = 1,
                    IsActive = CASE IsDelete WHEN 1 THEN 0 WHEN 0 THEN 1 END,
                    DeletedBy = $user_id, 
                    DeletedOn = NOW() 										
                WHERE id IN ( $id ) ;";
    //$resultAction = $db->Execute($sql);

    /* 		//echo $resultAction ? '1' : '0';	
      //	if($action <> "actionCreate"){
      $sqlDelData = "DELETE FROM dataapidetail WHERE APIID IN ( $id ) ";
      $db->Execute($sqlDelData);
      //	}
     */
}

$resultAction = $db->Execute($sqlAction);

if ($resultAction && $action <> 'actionDelete') {    // In case create or Update	
    echo setAPIDetail(); // function API Detail			
} else if ($resultAction) {
    echo '1';
} else {
    echo '0';
}
?>