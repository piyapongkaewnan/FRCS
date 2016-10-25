<?php
#################################
#Configuration Section
#################################

date_default_timezone_set('Asia/Bangkok');

include_once("dbConnect.php");
include_once("functions.php");


$sql_config = "SELECT * FROM configs";
$rs_config = $db->GetRow($sql_config);

/* Site Name*/
define("SITE_NAME",$rs_config['website_name']);

/* Language*/
define("LANGUAGE",$rs_config['website_language']);

/* Themes : */
$arr_theme = array("cupertino-theme" , "flick-theme" , "smoothness-theme" , "ui.lightness-theme");
define("THEMES",$arr_theme[$rs_config['website_theme']]);

/* Upload Path*/
define("UPLOADS_DIR","uploads_dir");

/* Copy Right*/
define("COPYRIGHT"," &copy;2014-".date('Y')."  ".$rs_config['website_name']);




$checklist_status = array(	"P" =>array("icon"=>"icons-info.png",
														  "title"=>"ยังไม่มีการบันทึกข้อมูล"),
										"K"=>array("icon"=>"icons-keyboard.png",
										 				 "title"=>"อยู่ระหว่างบันทึกข้อมูล"),
										"A" =>array("icon"=>"icon-approved.gif",
														  "title"=>"ผ่านการตรวจสอบแล้ว"),
										"S" =>array("icon"=>"icons-wait.png",
														  "title"=>"รอการอนุมัติ"),
										"U" =>array("icon"=>"icons-unlock.png",
														  "title"=>"ส่งกลับแก้ไข"));

/* Menu Action*/
define("MENU_ACTION","<span class='doAction'><button>เพิ่ม</button><button>แก้ไข</button><button>&nbsp;ลบ&nbsp;</button></span>");
define("MENU_SAVE_ONLY","<span class='doAction'><button>บันทึก</button></span>");
define("MENU_ADD","<span class='doAction'><button>เพิ่ม</button></span>");
define("MENU_BACK","<span class='back'><button>ย้อนกลับ</button></span>");
define("MENU_TOOLS","<span class='doAction'><button>แก้ไข</button><button>ลบ</button></span>");
define("MENU_SUBMIT","<input type='submit' name='btnSave' id='btnSave' value='บันทึก'  /><input type='reset' name='btnReset' id='btnReset' value='ล้างค่า' /> <span id='ajaxloading'>Loading..</span><span id='divMsgDiag'></span>");

define("DOACION_G",isset($_GET['doAction']) ? $_GET['doAction'] : "");
define("MODULES_G",isset($_GET['modules']) ? $_GET['modules'] : "");
define("PAGES_G",isset($_GET['pages']) ? $_GET['pages'] : "" );
define("SELECT_ID_G",isset($_GET['select_id']) ? $_GET['select_id'] : "");

define("DOACION_P",isset($_POST['doAction']) ? $_POST['doAction'] : "");
define("MODULES_P",isset($_POST['modules']) ? $_POST['modules'] : "");
define("PAGES_P",isset($_POST['pages']) ? $_POST['pages'] : "");
define("SELECT_ID_P",isset($_POST['select_id']) ? $_POST['select_id'] : "");


?>