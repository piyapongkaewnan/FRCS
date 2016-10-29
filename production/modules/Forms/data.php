<?php
#############################
# Section : Includes Files
require_once("../../includes/DBConnect.php");

$rs = $db->GetAll("select countryCode , countryName from country");

echo json_encode($rs);
?>