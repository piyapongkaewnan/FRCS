<?php
#############################
# Section : Includes Files
require_once("../../includes/DBConnect.php");

$rs = $db->GetAll("select FXCode,FxName,RateToBase from fx limit 1,10");

echo json_encode($rs);
?>