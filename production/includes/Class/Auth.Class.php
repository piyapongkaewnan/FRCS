<?php
#######################################
# Class : Authen
# Description : Web Authentication
#######################################

//require_once("./includes/DBConnect.php");

class Auth {
		
	protected static  $db;
	protected static  $language;	
	protected static  $user_id;	
	protected static  $realname;
	protected static  $avatar;
	protected static  $modules;	
	protected static  $page;
	protected static  $picPath = "./images/avatar";
	
	// Function for Set Database Object
	public static function setDB($db) {
        self::$db = $db;
    }
	
	// Function for Get Database Object
	public static function getDB() {
       return  self::$db ;
    }
	
	// Function for Set Language 
	public static function setLanguage($language) {
        self::$language = $language;
    }
	
	// Function for Get Language 
	public static function getLanguage() {
       return  self::$language ;
    }

	// Function for Set User ID
	public static function setUserID($user_id) {
        self::$user_id = $user_id;
    }
	
	// Function for Get User ID
	public static function getUserID() {
        return self::$user_id;
    }
	
	// Function for Set Real Name
	public static function setRealName($realname) {
        self::$realname = $realname;
    }
	
	// Function for Get Real Name
	public static function getRealName() {
        return self::$realname;
    }
	
	// Function for Set Profile avatar
	public static function setProfileAvatar($avatar) {
        self::$avatar = $avatar;
    }
	
	// Function for Get Profile avatar
	public static function getProfileAvatar() {
		if(file_exists(self::$picPath."/".self::$avatar)) {   
			return self::$picPath."/".self::$avatar; 
		}else{ 
			return self::$picPath."/".'user.png';
		}
    }
	
	// Function for Set Modules from Get $_GET['modules']
	public static function setModule($modules) {
        self::$modules = $modules;
    }
	
	// Function for Get Modules from Get $_GET['modules']
	public static function getModule() {
        return self::$modules;
    }
	
	// Function for Set Page from Get $_GET['page']
	public static function setPage($page) {
        self::$page = $page;
    }

	// Function for Get Page from Get $_GET['page']
	public static function getPage() {
        return self::$page;
    }
	
	//Check login state
	public static function isGuest(){
		return  self::getUserID() == "" ? true : false;
	}
		
	
		// function ในการตรวจสอบสิทธิ์การเข้าถึงหน้าเพจ
		public static function checkPageAuth(){
			$sql = "	SELECT
								  COUNT(*) AS count_menu
								FROM menu_auth a,
								  menu b
								WHERE a.menu_id = b.menu_id
									AND b.menu_file = '".self::$page."'
									AND a.group_id IN(SELECT
														group_id
													  FROM user_auth
													  WHERE user_id =  ".self::$user_id." ) ";
				
					$result =  self::$db ->GetRow($sql);
						if($result['count_menu'] > 0){
							return true;	
						}else{
							return false;
						}				
				
			} // End function
			
			// function ในการตรวจสอบกลุ่มผู้ใช้งาน
		public static function checkUserAuth($group_id){
				$sql = "	SELECT
							  COUNT(*) as counts
							FROM tbl_user_auth a
							WHERE a.user_id = ".self::$user_id."
								AND a.group_id = $group_id ";				
				$result =  self::$db ->GetRow($sql);				
						if($result['counts'] > 0){
							return true;	
						}else{
							return false;
						}				
				
			} // End function
			
		
		//Function check Page Allow
		public static function isAllowPage(){ 			
				if(!isset(self::$page)){
						return true;
				}else{	
						return self::checkPageAuth();
				}
		}
			
			
		
			// ฟังก์ชั่นในการหาหมวดหมู่ตามสิทธิ์
			public static function getKnowledgeCate(){
					$sql = "SELECT
								  DISTINCT b.*
								FROM tbl_knowledge_auth a
								   JOIN tbl_knowledge_cate b
									ON a.knowledge_cate_id = b.id
								WHERE group_id IN(SELECT
													group_id
												  FROM tbl_user_auth
												  WHERE user_id = ".self::$user_id.")
								AND active = 'Y' 
								ORDER BY b.menu_order";
					 
				return self::$db ->GetAll($sql);
				
			} // End function 
		
		
	} // End Class

?>