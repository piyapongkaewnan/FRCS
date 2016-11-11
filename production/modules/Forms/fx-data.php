<?php

#############################
# Section : Includes Files
require_once("../../includes/DBConnect.php");

$limit = !isset($_GET['limit']) ? 20 : $_GET['limit'];
$rs = $db->GetAll("select FXCode,FxName,RateToBase from fx limit 1,$limit");

echo json_encode($rs);
?>