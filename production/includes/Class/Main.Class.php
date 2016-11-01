<?php
#######################################
# Class : Main
# Description : Main Class
#######################################

//Class for Webpage Control
class MainWeb extends Auth {

	protected static   $SiteName;
	protected static   $isActive;
	protected static   $titleVal;	
	
	// Get Site Title
	public function GetSiteInfo(){

			$rs_config =  Auth::$db ->GetRow("SELECT * FROM configs");
			/*$stmt->execute();
			//$stmt->debugDumpParams();
			$rs_config = $stmt->fetch(PDO::FETCH_ASSOC);*/
			
			/* Site Name*/
			define("SITE_NAME",$rs_config['website_name']);
		
			/* Language*/
			define("LANGUAGE",$rs_config['website_language']);
			
			/* Session timeout*/
			define("SESSION_TIMEOUT",$rs_config['session_timeout']);
			
			define("COPYRIGHT"," &copy;".date('Y')."  ".$rs_config['website_name']);
			
			/* Menu Action*/
			define("MENU_ACTION","<div class='doActionModal toolbarGroup'><div class='btn-group' role='group' aria-label='...'><button type='button' class='btn btn-success btn-sm' data-toggle='tooltip' data-placement='top' title='Create Data' id='btnCreate' rel='actionCreate'><i class='fa fa-plus'></i> Create</button><button type='button' class='btn  btn-primary  btn-sm'  data-toggle='tooltip' data-placement='top' title='Update Data' id='btnUpdate' rel='actionUpdate' disabled><i class='fa fa-edit'></i> Update</button><button type='button' class='btn  btn-danger  btn-sm' data-toggle='tooltip' data-placement='top' title='Delete Data' id='btnDelete' rel='actionDelete' disabled><i class='fa fa-trash'></i> Delete </button></div></div>");
			/*define("MENU_ACTION_PAGE","<div class='doActionModal toolbarGroup'><div class='btn-group' role='group' aria-label='...'><button type='button' class='btn btn-success btn-sm' data-toggle='tooltip' data-placement='top' title='Create Data' id='btnCreate' rel='actionCreate'><i class='fa fa-plus'></i> Create</button><button type='button' class='btn  btn-primary  btn-sm'  data-toggle='tooltip' data-placement='top' title='Update Data' id='btnUpdate' rel='actionUpdate'><i class='fa fa-edit'></i> Update</button><button type='button' class='btn  btn-danger  btn-sm' data-toggle='tooltip' data-placement='top' title='Delete Data' id='btnDelete' rel='actionDelete'><i class='fa fa-trash'></i> Delete </button></div></div>");*/
			define("MENU_SAVE_ONLY","<span class='doAction'><button type='submit' class='btn btn-primary' data-toggle='tooltip' data-placement='top' title='Save Data' id='btnSave' rel='actionSave'><i class='fa fa-save'></i> Save</button></span>");
			define("MENU_SAVE","<span class='doAction'><div class='btn-group' role='group' aria-label='...'><button type='button' class='btn btn-success btn-sm' data-toggle='tooltip' data-placement='top' title='Save'><i class='fa fa-save'></i> Save </button></div></span>");
			define("MENU_ADD","<button type='button' class='btn btn-success btn-sm' data-toggle='tooltip' data-placement='top' title='Create Data' id='btnCreate' rel='actionCreate'><i class='fa fa-plus'></i> Create</button>");
			define("MENU_BACK","<span class='back'><button type='button' class='btn btn-info btn-sm' data-toggle='tooltip' data-placement='top' title='Back menu'><i class='fa fa-arrow-left'></i> Back </button></span>");
			define("MENU_TOOLS","<span class='doAction'><button>แก้ไข</button><button>ลบ</button></span>");
			define("MENU_SUBMIT","<button type='button' name='cancel' class='btn btn-primary'><i class='fa fa-close'></i> Cancel</button>
<button type='submit' class='btn btn-success'><i class='fa fa-pencil-square-o'></i> Submit</button>
");
			//return true;
			
			self::$SiteName =  SITE_NAME;
	}
	

	// Get title from URL
	public function getPageInfo($param = ""){
	
			$str = $param == "" ? " AND a.menu_file  = '".Auth::$page."' " : "AND a.menu_param  = '$param' ";	
		
			$sql_title = "SELECT
									  a.menu_name_th,
									  a.menu_name_en,
									  a.menu_desc,
									  b.menu_group_en,
									  b.menu_group_th,
									  b.module_name,
									  (SELECT
										 icon_name
									   FROM icons
									   WHERE icon_id = a.icon_id) AS icon_name_menu,
									  (SELECT
										 icon_name
									   FROM icons
									   WHERE icon_id = b.icon_id) AS icon_name_gmenu
									FROM menu a,
									  menu_group b
									WHERE a.mgroup_id = b.mgroup_id
										$str ";
								
			$rs_title =  Auth::$db ->GetRow($sql_title);
			//$stmt->execute();
			//$rs_title  = $stmt->fetch(PDO::FETCH_ASSOC);
						
			self::seTtitleVars($rs_title);
}

	// Functio for Set title Valriable
	 public function seTtitleVars($rsTitle){
				 self::$titleVal = $rsTitle;
	 }
	 
	 // Function get Title var
	 public function getTitleVal(){
				return  self::$titleVal;
	 }

	// Set Title Bar
	public function setTitleBar(){
				if(self::$page){
					$title = self::$titleVal;
					return  $title['menu_group_'.self::$language] ." - ".$title['menu_name_'.self::$language]; 
				}else{
					return  "Home";	
				}
	}
	
	// Set App Title 
	public function setAppTitle(){
				if(self::$page){
					$title = self::$titleVal;
					$do = isset($_GET['form'])  ? " (".$_GET['form'].") " : "";
					// <i class='fa fa-question' data-toggle='tooltip' data-placement='right' title='".$title['menu_desc']."' style='cursor:pointer'></i>
					return  "<i class='".$title['icon_name_menu']."'></i> <a href=\"?modules=".self::$modules."&page=".self::$page."\"\n>".$title['menu_name_'.self::$language]."</a> $do  &raquo; <small>".$title['menu_desc']."</small>\n"; 
				}else{
					return  "Home";	
				}
	}
	
	// function set 
	public function setBreadcrumb(){
			$title = self::$titleVal;	
			$str ='';
			$str .= "<ol class=\"breadcrumb container\" style=\"margin-bottom:10px;\">";	
        	$str .= "<li><i class=\"glyphicon glyphicon-home\"></i> <a href=\"./index.php\">Home</a></li>";
			if(isset(self::$modules)){
				//$str .=  "<li class=\"active\"><i class='".$title['icon_name_gmenu']."'></i> <a href=\"?modules=".$title['module_name']."&listModule=true\"\n>".$title['menu_group_'.self::$language]."</a></li>";	
				$str .=  "<li class=\"active\"><i class='".$title['icon_name_gmenu']."'></i> ".$title['menu_group_'.self::$language]."</li>";	
			}
			if(isset(self::$page)){
				$str .=  "<li class=\"active\"><i class='".$title['icon_name_menu']."'></i> ".$title['menu_name_'.self::$language]."</li>\n";	
			}
			
      		$str .=  "</ol>";		
			
			echo $str;
	}
	
	//Open Web Content Template
	public function openTemplate(){
					$str = "<!-- open Template -->\n";
					$str .= "     <script type='text/javascript' src='../vendors/parsleyjs/dist/parsley.min.js'></script> \n";
					/*$str .= "     <script type='text/javascript' src='../vendors/parsleyjs/src/i18n/th.js'></script> \n";*/
					$str .= "     <link rel='stylesheet' type='text/css' href='../vendors/parsleyjs/src/parsley.css'/> \n";
					$str .= "<div class='row'>\n";
					$str .= "  <div class='col-md-12 col-sm-12 col-xs-12'>\n";
					$str .= "    <div class='x_panel'>\n";
					$str .= "      <div class='x_title'>\n";
					$str .= "        <h2>".self::setAppTitle()."</h2>\n";
					$str .= "        <ul class='nav navbar-right panel_toolbox'>\n";
					$str .= "          <li><a class='collapse-link'><i class='fa fa-chevron-up'></i></a> </li>\n";
					$str .= "          <li class='dropdown'> <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-expanded='false'><i class='fa fa-wrench'></i></a>\n";
					$str .= "            <ul class='dropdown-menu' role='menu'>\n";
					
					if(self::getFavoriteStatus()){ 
					$str .= "			<li><a href='javascript:void(0);' class='actionFavorites' rel='".self::getMenuID()."' rule='remove_favorites'><i class='fa fa-thumb-tack'></i> Remove favorite</a> </li>\n";
					}else{
					$str .= "			<li><a href='javascript:void(0);' class='actionFavorites' rel='".self::getMenuID()."'  rule='add_favorites'><i class='fa fa-thumb-tack'></i> Add to favorite</a> </li>\n";
					}
					//$str .= "              <li><a href='#'>Settings 2</a> </li>\n";
					$str .= "            </ul>\n";
					$str .= "          </li>\n";
					$str .= "          <li><a class='close-link'><i class='fa fa-close'></i></a> </li>\n";
					$str .= "        </ul>\n";
					$str .= "        <div class='clearfix'></div>\n";
					$str .= "      </div>\n";
					$str .= "      <div class='x_content'> \n";
					return $str;
	}

// Close Web Content Template
	public function closeTemplate(){	
					$str = "      </div> \n";
					$str .= "         </div> \n";
					$str .= "       </div> \n";
					$str .= "     </div> \n";
					$str .= "<!-- open Template -->\n";
					
					/*$str .= "    <script src='./modules/".Auth::$modules."/".Auth::$page.".js'></script>\n";*/
				return $str;
	}

// Function for setting Modal Ready for call	
	public function setModal(){
				echo "	<div class='modal fade' id='FormModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true' data-keyboard='false' data-backdrop='static'>\n";
				echo "    <div class='modal-dialog' role='document'>\n";
				echo "      <div class='modal-content'></div>\n";
				echo "    </div>\n";
				echo "  </div>\n";
	}
	
	
// Function for setting Modal Delete confirm Ready for call	
	public function setModalDelete(){
				echo "	<div class='modal fade' id='FormModalDelete' tabindex='-1' role='dialog' aria-labelledby='ModalLabel' aria-hidden='true' data-keyboard='false' data-backdrop='static'>\n";
				echo "    <div class='modal-dialog' role='document'>\n";
				echo "      <div class='modal-content'>\n";
				echo "      <div class='modal-header'>\n";
				echo "      <button type='button' class='close' data-dismiss='modal' aria-label='Close'> <span aria-hidden='true'>&times;</span> </button>\n";
				echo "      <h4 class='modal-title' id='ModalLabel'>Confirm!</h4>\n";
				echo "      </div>\n";
				echo "      <div class='modal-body'>Do you want to delete?</div>\n";
				echo "      <div class='modal-footer'>\n";
				echo "      <button type='button' class='btn btn-default' data-dismiss='modal'><i class='fa fa-close'></i> Cancel</button>\n";
				echo "      <button type='button' class='btn btn-danger' id='actionDelete'><i class='fa fa-trash'></i> Delete</button>\n";
				echo "      </div>\n";
				echo "   </div>\n";
				echo "    </div>\n";
				echo "  </div>\n";
	}	
	
	
	// Function for Favorite Status
	public function getFavoriteStatus(){
			if(!self::$page){ return; } 
			$sql = "SELECT menu_id FROM favorites WHERE user_id  = ".Auth::$user_id." AND menu_id = ".self::getMenuID();
			$rs = Auth::$db->GetAll($sql);
			
			if(sizeof($rs) > 0){
				
				return true;
			}else{
				return false;
			}
	}
	
	
	// Function for Get Menu id from menu_file
	public function getMenuID(){
			$sql = "SELECT menu_id FROM menu WHERE menu_file = '".Auth::$page."'";
			$rs = Auth::$db->GetRow($sql);
		return $rs['menu_id'];	
	}
	

	
	// function hightlight word 
public function highlight($str, $keywords = ''){
			$keywords = preg_replace('/\s\s+/', ' ', strip_tags(trim($keywords))); // filter
			 
			$style = 'highlight';
			$style_i = 'highlight_important';
			 
			/* Apply Style */			 
			$var = '';
			 
			foreach(explode(',', $keywords) as $keyword){
			$replacement = "<span class='".$style."'>".$keyword."</span>";
			$var .= $replacement." ";			 
			$str = str_ireplace($keyword, $replacement, $str);
			}
			 
			/* Apply Important Style */			 
			$str = str_ireplace(rtrim($var), "<span class='".$style_i."'>".$keywords."</span>", $str);
			 
			return $str;
}

	
	// Show Active Icon	
	public function ShowActiveIcon($status){
			if($status == "Y"){
				$img = "<img src='".$this->IconPath."/on.gif'>";
			}else{
				$img = "<img src='".$this->IconPath."/off.gif'>";				
			}
			
			return $img;
	}


	
		 //#######################################################
	// ฟังก์ชันในการสร้าง Radom ตัวอักษรตามจำนวนที่ระบุมา
	public function random_gen($length){
			  $random= "";
			  srand((double)microtime()*1000000);
			  $char_list = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
			  $char_list .= "abcdefghijklmnopqrstuvwxyz";
			  $char_list .= "1234567890";
			  // Add the special characters to $char_list if needed
			
			  for($i = 0; $i < $length; $i++)  { 
				$random .= substr($char_list,(rand()%(strlen($char_list))), 1);
			  }
			  return $random;
	} 

//echo $random_string = random_gen(30); //This will return a random 10 character string


	 //#######################################################
	// ฟังก์ชันในการ Substring ตามจำนวนที่รุะบุมา หากเกิน ให้ใส่ ...
	public function subString($tring , $length){
	  
	  return $random;
	} 

	#######################################################
//echo Functio for Scan Dir
 public function ScanDir($dir){
		$listDir = array();
		if ($handle = opendir($dir )) {
		
			while (false !== ($entry = readdir($handle))) {
		
				if ($entry != "." && $entry != "..") {
		
					if(is_dir($dir.'/'.$entry)){  
							$listDir[$entry] = $entry; 	
					}				
				}
			}
		
			closedir($handle);
			
			asort($listDir);
			return $listDir;
		}		
 	}
	#######################################################



###########################################
//Set Page goto
function redirect($backStep) 
{
	
	echo "<script language=\"javascript\">";
	if($backStep == -1){
		echo "	history.back($backStep);";
	}else if($backStep == "x"){
		echo "window.close();";
	}else if($backStep != ""){
		echo "window.location = '".$backStep."';";
	}
	echo "</script>";
}


}




?>