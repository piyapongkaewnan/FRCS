<?php
#######################################
# Class : MENU
# Description : Generate Left Menu
#######################################

class MENU extends Auth {


		public function showMenu(){
			 
				$menu = "<ul class=\"nav side-menu\">";
            	$menu .= "<li  class=\"MenuHome\"><a href=\"./index.php\"><i class=\"fa fa-home\"></i> Home</a> </li>";
			
			// Title Menu from : tbl_menu_group
				if(LANGUAGE == "en"){
					$menu_group_lange = "menu_group_en";
					$menu_lange = "menu_name_en";	
				}else{
					$menu_group_lange = "menu_group_th";
					$menu_lange = "menu_name_th";
				}
			
				$sqlMenuGroup = "SELECT
										  b.mgroup_id,
										  b.menu_group_th,
										  b.menu_group_en,
										  b.menu_order,
										  b.module_name,
										  c.icon_name
										FROM menu a,
										  menu_group b,
										  icons c
										WHERE a.mgroup_id = b.mgroup_id
											AND b.icon_id = c.icon_id
											AND menu_id IN(SELECT
															 menu_id
														   FROM menu_auth
														   WHERE group_id IN(SELECT
																			   group_id
																			 FROM user_auth
																			 WHERE user_id = :user_id))
										GROUP BY a.mgroup_id
										ORDER BY b.menu_order ASC";									
				try 
				{
					$stmt =  self::$db ->prepare($sqlMenuGroup);
					$stmt->bindParam(':user_id', self::$user_id);
					$stmt->execute();
					$rsMenuGroup  = $stmt->fetchAll(PDO::FETCH_ASSOC);
				} catch (PDOException $e) {
				print "Error!: " . $e->getMessage() . "<br/>";
				die();
			}			
			//$rs =  self::$db->query($sqlMenuGroup);		
			//$rsMenuGroup = $rs->fetchAll();
			foreach($rsMenuGroup as $rsMenuGroup){
		
				$menu .= "<li><a><i class=\"".$rsMenuGroup['icon_name']."\"></i> ".$rsMenuGroup['menu_group_en']."<span class=\"fa fa-chevron-down\"></span></a>";
				 $sqlMenu = "SELECT
									  a.menu_id,
									  a.menu_name_th,
									  a.menu_name_en,
									  a.menu_desc,
									  a.menu_file,
									  a.menu_param,
									  a.mgroup_id,
									  b.icon_name
									FROM menu a,
									  icons b
									WHERE a.icon_id = b.icon_id
										AND a.mgroup_id = :mgroup_id 
										AND a.menu_id IN(SELECT
														   menu_id
														 FROM menu_auth
														 WHERE group_id IN(SELECT
																			 group_id
																		   FROM user_auth
																		   WHERE user_id = :user_id))
									ORDER BY a.menu_order";
	
			try {
				$stmt =  self::$db ->prepare($sqlMenu);
				$stmt->bindParam(':mgroup_id', $rsMenuGroup['mgroup_id']);
				$stmt->bindParam(':user_id', self::$user_id);
				$stmt->execute();
				//$r = $stmt->debugDumpParams();				
				$rsMenu  = $stmt->fetchAll(PDO::FETCH_ASSOC);
			} catch (PDOException $e) {
				print "Error!: " . $e->getMessage() . "<br/>";
				die();
			}
				  $menu .= "<ul class=\"nav child_menu\">";
		  	
				foreach($rsMenu as $rsMenu){
				
                 $menu .= " <li><a href=\"?modules=".$rsMenuGroup['module_name']."&page=".$rsMenu['menu_file']."\" data-toggle=\"tooltip\" data-placement=\"right\" title=\"".$rsMenu['menu_desc']."\"> ".$rsMenu[$menu_lange]."</a></li>\n";
              
			}
				$menu .=  " </ul>\n";
				$menu .=  "</li>\n";
			}

				$menu .= "</ul>\n";
				$menu .= "</div>\n";
				$menu .= "</div>\n";
				$menu .= "<!-- /sidebar menu --> ";
				
				$menu .= "<!-- /menu footer buttons -->";
				$menu .= "<div class=\"sidebar-footer hidden-small\">";
				$menu .= "<a data-toggle=\"tooltip\" data-placement=\"top\" title=\"Settings\"> <span class=\"glyphicon glyphicon-cog\" aria-hidden=\"true\"></span> </a>";
				$menu .= " <a data-toggle=\"tooltip\" data-placement=\"top\" title=\"FullScreen\"> <span class=\"glyphicon glyphicon-fullscreen\" aria-hidden=\"true\"></span> </a>";
				$menu .= "<a data-toggle=\"tooltip\" data-placement=\"top\" title=\"Lock\"> <span class=\"glyphicon glyphicon-eye-close\" aria-hidden=\"true\"></span> </a>";
				$menu .= " <a  href=\"logout.php\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Logout\"> <span class=\"glyphicon glyphicon-off\" aria-hidden=\"true\"></span> </a>";
				$menu .= " </div>";
				$menu .= "<!-- /menu footer buttons --> 			";
	
		return $menu;
		
		}


}
?>