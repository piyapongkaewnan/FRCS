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
																			 WHERE user_id = ".Auth::$user_id."))
										GROUP BY a.mgroup_id
										ORDER BY b.menu_order ASC";									
				
					$rsMenuGroup =  Auth::$db ->GetAll($sqlMenuGroup);
				
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
										AND a.mgroup_id = ".$rsMenuGroup['mgroup_id']." 
										AND a.menu_id IN(SELECT
														   menu_id
														 FROM menu_auth
														 WHERE group_id IN(SELECT
																			 group_id
																		   FROM user_auth
																		   WHERE user_id =  ".Auth::$user_id."))
									ORDER BY a.menu_order";
	
				$rsMenu =  Auth::$db ->GetAll($sqlMenu);
				
				  $menu .= "<ul class=\"nav child_menu\">";
		  	
				foreach($rsMenu as $rsMenu){
				
                 $menu .= " <li class='clickMenu' rel='".$rsMenu['menu_id']."'><a href=\"?modules=".$rsMenuGroup['module_name']."&page=".$rsMenu['menu_file']."\" data-toggle=\"tooltip\" data-placement=\"right\" title=\"".$rsMenu['menu_desc']."\"> ".$rsMenu[$menu_lange]."</a></li>\n";
              
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
				$menu .= " <a  href=\"signout.php\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Logout\"> <span class=\"glyphicon glyphicon-off\" aria-hidden=\"true\"></span> </a>";
				$menu .= " </div>";
				$menu .= "<!-- /menu footer buttons --> 			";
	
		return $menu;
		
		}
		
		
		// Function for Show Top Nav Bar		
		public function showTopNavBar(){
		
						echo "		<div class='top_nav navbar-fixed-top'>\n";
						echo "          <div class='nav_menu'>\n";
						echo "            <nav>\n";
						echo "              <div class='nav toggle'> <a id='menu_toggle'><i class='fa fa-bars'></i></a> </div>\n";
						echo "              <ul class='nav navbar-nav navbar-right'>\n";
						echo "                <li class=''> <a href='javascript:;' class='user-profile dropdown-toggle' data-toggle='dropdown' aria-expanded='false'> <img src='".Auth::getProfilePicture()."' alt=''>".Auth::getRealName()."&nbsp;<span class=' fa fa-angle-down'></span> </a>\n";
						echo "                  <ul class='dropdown-menu dropdown-usermenu pull-right'>\n";
						echo "                    <li class='clickMenu' rel='3'><a href='?modules=Profiles&page=profile'><i class='fa fa-edit'></i> Profile</a></li>\n";
						echo "                    <!--                <li> <a href='javascript:;'> <i class='fa fa-edit'></i><span class='badge bg-red pull-right'>50%</span> <span>Settings</span> </a> </li>\n";
						echo "-->\n";
						//echo "                    <li><a href='javascript:;'><i class='fa fa-question'></i> Help</a></li>\n";
						echo "                    <li><a href='signout.php'><i class='fa fa-power-off pull-left'></i> Log Out</a></li>\n";
						echo "                  </ul>\n";
						echo "                </li>\n";
						//						self::showMessage();												
						echo "                  </ul>\n";
						echo "                </li>\n";
						echo "              </ul>\n";
						echo "            </nav>\n";
						echo "          </div>\n";
						echo "        </div>\n";
		
		}
		
		
		// Function show Message on Navbar
		public function showMessage(){
			
			echo "<li role='presentation' class='dropdown'> <a href='javascript:;' class='dropdown-toggle info-number' data-toggle='dropdown' aria-expanded='false'> <i class='fa fa-envelope-o'></i> <span class='badge bg-green'>4</span> </a>\n";
			echo "<ul id='menu1' class='dropdown-menu list-unstyled msg_list' role='menu'>\n";
			self::listMessage();
			echo "<li>\n";
			echo "<div class='text-center'> <a> <strong>See All Alerts</strong> <i class='fa fa-angle-right'></i> </a> </div>\n";
			echo "</li>\n";
			echo "		}\n";
		
}
   // Function List Message > showMessage on NavBar
	public function listMessage(){
			echo "<li> <a> <span class='image'><img src='images/img.jpg' alt='Profile Image' /></span> <span> <span>John Smith</span> <span class='time'>3 mins ago</span> </span> <span class='message'> Film festivals used to be do-or-die moments for movie makers. They were where... </span> </a> </li>\n";
			echo "<li> <a> <span class='image'><img src='images/img.jpg' alt='Profile Image' /></span> <span> <span>John Smith</span> <span class='time'>3 mins ago</span> </span> <span class='message'> Film festivals used to be do-or-die moments for movie makers. They were where... </span> </a> </li>\n";
			echo "<li> <a> <span class='image'><img src='images/img.jpg' alt='Profile Image' /></span> <span> <span>John Smith</span> <span class='time'>3 mins ago</span> </span> <span class='message'> Film festivals used to be do-or-die moments for movie makers. They were where... </span> </a> </li>\n";
			echo "<li> <a> <span class='image'><img src='images/img.jpg' alt='Profile Image' /></span> <span> <span>John Smith</span> <span class='time'>3 mins ago</span> </span> <span class='message'> Film festivals used to be do-or-die moments for movie makers. They were where... </span> </a> </li>\n";	
	}

}
?>