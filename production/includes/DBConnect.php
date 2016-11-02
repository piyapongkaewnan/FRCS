<?php
###############################################
# Class for define Database Connection

###############################################
include("adodb/adodb-exceptions.inc.php"); 
require('adodb/adodb.inc.php');
#Define Valiable for DB Connection
define("DB_HOST","localhost");
define("DB_USER","catadmin");
define("DB_PASS","p@ssw0rd");
define("DB","true_db");

# Create DB Connecttion
try {
		//$db = new PDO('mysql:host='.DB_HOST.';dbname='.DB.';charset=utf8mb4', DB_USER, DB_PASS);	
		 $db = ADOnewConnection('pdo');
         $db->Connect('mysql:host='.DB_HOST.';dbname='.DB.';charset=utf8mb4', DB_USER, DB_PASS);
		 $db->SetFetchMode(ADODB_FETCH_ASSOC);
		# Sst Charaterset to Encode DB
		
		$db->Execute("SET NAMES utf8");
		$db->Execute("SET character_set_results=utf8");
		$db->Execute("SET character_set_client=utf8");
		$db->Execute("SET character_set_connection=utf8");
               
	} catch (exception $e) {
		print "<pre>";
		print_r($e); 
		print "</pre>";
       adodb_backtrace($e->gettrace());
	}

#$db->SetCharset("utf8");


# Set Debug Mode for Develope / In case on Site  set to false
$db->debug = 0; # Change to false for Production


?>
