<?php
@session_start();

#############################
# Section : Includes Files
require_once("../includes/config.inc.php");
require_once("../includes/Class/DataTable.Class.php");
require_once("../includes/Class/Main.Class.php");
require_once("../includes/Class/Auth.Class.php");
require_once("../page_auth.php");

include("../session_timeout.php");

// Close Database
if(!$_SESSION['sess_user_id']){ pageback('signin.php',''); }


############################

?>
<!DOCTYPE HTML>
<html lang="th-th">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="refresh" content="<?=$inactive;?>;">
 <!--Let browser know website is optimized for mobile-->
 <meta http-equiv="X-UA-Compatible" content="IE=11,chrome=1">
 <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>
<?=SITE_NAME;?>
</title>
  <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>-->
  <script src="../vendor/components/jquery/jquery.min.js"></script>

  <!--<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>-->
<!-- <script src="vendor/components/jqueryui/jquery-ui.min.js"></script> -->
<script type="text/javascript" src="css/<?=THEMES?>/jquery-ui.min.js"></script>

<script type="text/javascript" src="../js/jquery.form.js"></script>
<script type="text/javascript" src="../js/modules.core.js"></script>
<!--Import Google Icon Font-->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
   

<link type="text/css" href="../css/main.css" rel="stylesheet" />
<link type="text/css" href="../css/materialize.css" rel="stylesheet" />

<link type="text/css" href="css/<?=THEMES?>/jquery-ui.css" rel="stylesheet" />
<link rel="stylesheet" href="../css/tipsy.css" type="text/css" />
<link rel="stylesheet" href="../css/loading.css" type="text/css" />

<script type="text/javascript" src="../js/jquery.tipsy.js"></script>
<!--<script type="text/javascript" src="js/jquery.ui.datepicker-th.js"></script>-->
<script type="text/javascript" src="../js/main_index.js"></script>

<link rel="stylesheet" href="../js/lightbox/colorbox.css" />
<script src="../js/lightbox/jquery.colorbox.js"></script>

<link rel="stylesheet" type="text/css" href="../js/datetimepicker/jquery.datetimepicker.css"/ >
<script src="../js/datetimepicker/jquery.datetimepicker.js"></script>

<script src="../includes/SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="../includes/SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<link href="../includes/SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="../includes/SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<script src="../includes/SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="../includes/SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="../images/favicon.ico" />
<!--<link rel="stylesheet" type="text/css" href="./js/jquery.dataTables/css/jquery.dataTables_themeroller.css">-->
<link rel="stylesheet" type="text/css" href="../vendor/datatables/datatables/media/css/jquery.dataTables_themeroller.css">
<!--<script src="./js/jquery.dataTables/js/jquery.dataTables.min.js" charset="utf8" ></script>    -->   
<script src="../vendor/datatables/datatables/media/js/jquery.dataTables.min.js" charset="utf8" ></script>    
<link rel="stylesheet" type="text/css" href="../vendor/fortawesome/font-awesome/css/font-awesome.min.css">


</head>
<body>
<div id="page">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="4px"></td>
    </tr>
  </table>
  <table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="4"><table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr  class="ui-state-active">
            <td height="39" align="left">&nbsp;<span style="font-size:22px;font-weight:bold"><a href="./"><?=SITE_NAME;?></a></span></td>
          </tr>
          <tr>
            <td align="left"><?php require_once("../main_menu.php");?></td>
          </tr>
        </table>
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td height="0px"></td>
          </tr>
        </table></td>
    </tr>
    <tr style="height:4px">
      <td></td>
    </tr>
    <tr align="left" valign="top">
      <td colspan="5"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="left" valign="top"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td valign="top"><div id="divPage">
                      <?php

				$setPage = isset($_GET['setPage']) ? $_GET['setPage'] : "";
		if(isset($_GET['setModule'])){
				$setModule = $_GET['setModule'];
				include("../modules/$setModule/$setPage".".php");
		}else if(isset($_GET['setPage'])){
				include("../$setPage".".php");	
		}else{				
				include('../main.php');	
		}
		
    ?>
                    </div></td>
                </tr>
              </table></td>
          </tr>
        </table></td>
    </tr>
  </table>
  <hr width="99%" style="border-style:solid 1px; border-color:#eee; opacity:.4" >
  <section>
  <footer>
  <div id="footer" style="text-align:right; width:99%; " class="font-small"><?=SITE_NAME." ".COPYRIGHT?></div>
  </footer>
  </section>
</div>
<input name="chkMenuAuth" id="chkMenuAuth" type="hidden" value="<?=$chkMenuAuth?>">
<div class="modal"><!-- Place at bottom of page --></div>
<div id="divMsg"></div>
<br>
</body>
</html>
<?php
$db->Close();
?>