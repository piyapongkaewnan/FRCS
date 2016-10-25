<?php
#######################################
# Class : Main
# Description : Main Class
#######################################

//Class for Webpage Control
class MainWeb extends Auth {

	protected static   $SiteName;
	protected static   $isActive;
	protected static   $IconPath = "./images/";
	protected static   $titleVal;	
	
	// Get Site Title
	public function GetSiteInfo(){

			$stmt =  Auth::$db ->prepare("SELECT * FROM configs");
			$stmt->execute();
			//$stmt->debugDumpParams();
			$rs_config = $stmt->fetch(PDO::FETCH_ASSOC);
			
			/* Site Name*/
			define("SITE_NAME",$rs_config['website_name']);
		
			/* Language*/
			define("LANGUAGE",$rs_config['website_language']);
			
			define("COPYRIGHT"," &copy;".date('Y')."  ".$rs_config['website_name']);
			
			/* Menu Action*/
			define("MENU_ACTION","<span class='doAction'><div class='btn-group' role='group' aria-label='...'><button type='button' class='btn btn-default btn-sm' data-toggle='tooltip' data-placement='top' title='Crate'><i class='fa fa-plus'></i> Create</button><button type='button' class='btn  btn-default  btn-sm'  data-toggle='tooltip' data-placement='top' title='Edit'><i class='fa fa-edit'></i> Edit</button><button type='button' class='btn  btn-default  btn-sm' data-toggle='tooltip' data-placement='top' title='Delete'><i class='fa fa-trash'></i> Delete </button></div></span>");
			define("MENU_SAVE","<span class='doAction'><div class='btn-group' role='group' aria-label='...'><button type='button' class='btn btn-success btn-sm' data-toggle='tooltip' data-placement='top' title='Save'><i class='fa fa-save'></i> Save </button></div></span>");
			define("MENU_ADD","<span class='doAction'><button>เพิ่ม</button></span>");
			define("MENU_BACK","<span class='back'><button type='button' class='btn btn-info btn-sm' data-toggle='tooltip' data-placement='top' title='Back menu'><i class='fa fa-arrow-left'></i> Back </button></span>");
			define("MENU_TOOLS","<span class='doAction'><button>แก้ไข</button><button>ลบ</button></span>");
			define("MENU_SUBMIT","<input type='submit' name='btnSave' id='btnSave' value='บันทึก'  /><input type='reset' name='btnReset' id='btnReset' value='ล้างค่า' /> <span id='ajaxloading'>Loading..</span><span id='divMsgDiag'></span>");
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
								
			$stmt =  Auth::$db ->prepare($sql_title);
			$stmt->execute();
			$rs_title  = $stmt->fetch(PDO::FETCH_ASSOC);
						
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
					return  "<i class='".$title['icon_name_menu']."'></i> ".$title['menu_name_'.self::$language]." &raquo; <small>".$title['menu_desc']."</small>"; 
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
				$str .=  "<li class=\"active\"><i class='".$title['icon_name_gmenu']."'></i> <a href=\"?modules=".$title['module_name']."&listModule=true\">".$title['menu_group_'.self::$language]."</a></li>";	
			}
			if(isset(self::$page)){
				$str .=  "<li class=\"active\"><i class='".$title['icon_name_menu']."'></i> ".$title['menu_name_'.self::$language]."</li>";	
			}
			
      		$str .=  "</ol>";		
			
			echo $str;
	}
	
	// Initial Page
	
	
	
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
}


?>