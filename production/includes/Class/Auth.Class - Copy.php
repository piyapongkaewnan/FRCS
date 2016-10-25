<?php
#######################################
# Class : Authen
# Description : Web Authentication
#######################################
require_once("./includes/DBConnect.php");

class Auth {
		
	protected static  $db;
	protected static  $language;	
	protected static  $user_id;	
	protected static  $modules;	
	protected static  $page;
	
	// Function for Set Database Object
	public static function setDB($db) {
        self::$db = $db;
    }
	
	// Function for Set Language 
	public static function setLanguage($language) {
        self::$language = $language;
    }

	// Function for Set User ID
	public static function setUserID($user_id) {
        self::$user_id = $user_id;
    }
	
	
	// Function for Set Modules from Get $_GET['modules']
	public static function setModule($modules) {
        self::$modules = $modules;
    }
	
	// Function for Set Page from Get $_GET['page']
	public static function setPage($page) {
        self::$page = $page;
    }
	
	//Check login state
	public static function isGuest(){
		return self::$user_id == '' ? ture : false;
	}
	
		// function ในการตรวจสอบสิทธิ์การเข้าถึงหน้าเพจ
		public static function checkPageAuth(){
			$sql = "	SELECT
								  COUNT(*) AS count_menu
								FROM menu_auth a,
								  menu b
								WHERE a.menu_id = b.menu_id
									AND b.menu_file = self::$page
									AND a.group_id IN(SELECT
														group_id
													  FROM user_auth
													  WHERE user_id =  :user_id) ";
				
					$stmt =  self::$db ->prepare($sql);
					$stmt->bindParam(':page', self::$page);
					$stmt->bindParam(':user_id', self::$user_id);
					$stmt->execute();					
					$result = $stmt->fetch(PDO::FETCH_ASSOC);
						if($result['count_menu'] > 0){
							return 1;	
						}else{
							return 0;
						}				
				
			} // End function
			
			// function ในการตรวจสอบกลุ่มผู้ใช้งาน
		public static function checkUserAuth($group_id){
				$sql = "	SELECT
							  COUNT(*) as counts
							FROM tbl_user_auth a
							WHERE a.user_id = :user_id
								AND a.group_id = :group_id ";				
				$stmt =  self::$db ->prepare($sql);
				$stmt->bindParam(':user_id', self::$user_id);
				$stmt->bindParam(':group_id', $group_id);
				$stmt->execute();
				
				//$rs = self::$db->query($sql);
				$result = $stmt->fetch(PDO::FETCH_ASSOC);
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
												  WHERE user_id = :user_id)
								AND active = 'Y' 
								ORDER BY b.menu_order";
					 
				$stmt =  self::$db ->prepare($sql);
				$stmt->bindParam(':user_id', self::$user_id);
				$stmt->execute();
				return $stmt->fetchAll(PDO::FETCH_ASSOC);
			
			} // End function 
		
		
	} // End Class

?>