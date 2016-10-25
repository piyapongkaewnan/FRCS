<?php
session_start();
include("../../includes/DBConnect.php");
include("../../includes/Class/Form.Class.php");
include("../../includes/Class/Auth.Class.php");
include("../../includes/Class/Main.Class.php");
/*print "<pre>";
print_r($_GET);
print "</pre>";*/

Auth::setDB($db);
Auth::setModule($_GET['modules']);
Auth::setPage($_GET['page']);


//Call MainWeb Class
MainWeb::GetSiteInfo(); // Get webpage variable
Auth::setLanguage(LANGUAGE);
MainWeb::getPageInfo();


if($_GET['action'] == 'actionUpdate'){
	$id = $_GET['id'];
	$sql_edit = "SELECT
					 a.menu_id,
					 a.menu_name_th,
					 a.menu_name_en,
					 a.menu_desc,
					 a.menu_file,
					 a.menu_param,
					 a.mgroup_id,
					 a.menu_order,
					 a.icon_id,
					 b.icon_name
				FROM menu AS a
					 LEFT JOIN icons b
					   ON a.icon_id = b.icon_id
					WHERE menu_id = $id;";
	$rs_edit = $db->GetRow($sql_edit);
	$mgroup_id = $rs_edit['mgroup_id'];
	
}else{
	$mgroup_id = $_GET['select_id'];
}

?>
<style type="text/css">
.fontawesome-icon-list .fa-hover1 a .fa {
	font-size:16px;
	padding: 5px 5px 5px 5px;
	-moz-border-radius: 2px;
	border-radius: 2px;
	text-align: center;
}
.fontawesome-icon-list .fa-hover1 a:hover .fa, .fa-active {
	border-color: #666;
	background-color: #CCC;
}
</style>
<script type="text/javascript" src="../vendors/parsleyjs/dist/parsley.min.js"></script>

<form  data-parsley-validate name="form_<?=$_GET['page']?>" id="form_<?=$_GET['page']?>" method="post">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
    <h4 class="modal-title" id="exampleModalLabel">
      <?=MainWeb::setTitleBar();?>
    </h4>
  </div>
  <div class="modal-body">
    <div class="form-group">
      <label for="mgroup_id" class="form-control-label">*Menu Group:</label>
      <select name="mgroup_id" id="mgroup_id" class="form-control input-sm">
          <?php
		  $sql_mgroup = "SELECT * FROM menu_group ORDER BY menu_group_en";
		  $rs_mgroup = $db->GetAll($sql_mgroup);
		  Form::genOptionSelect($rs_mgroup,'mgroup_id','menu_group_en',$mgroup_id);
		  ?>
        </select>
    </div>
    <div class="form-group">
      <label for="menu_name_en" class="form-control-label">*Menu Group EN:</label>
      <input type="text" class="form-control input-sm" id="menu_name_en" name="menu_name_en" required="required" value="<?=$rs_edit['menu_name_en']?>">
    </div>
    <div class="form-group">
      <label for="menu_name_th" class="form-control-label">*Menu Group TH:</label>
      <input type="text" class="form-control input-sm" id="menu_name_th" name="menu_name_th" required="required" value="<?=$rs_edit['menu_name_th']?>">
    </div>
    <div class="form-group">
      <label for="menu_desc" class="form-control-label">Menu Description :</label>
      <textarea name="menu_desc" rows="2"  class="form-control input-sm" id="menu_desc"><?=$rs_edit['menu_desc']?></textarea>
    </div>
    <div class="form-group">
      <label for="menu_file" class="form-control-label">*Menu File:</label>
      <input type="text" class="form-control input-sm" id="menu_file" name="menu_file" required="required" value="<?=$rs_edit['menu_file']?>">
    </div>
    <div class="form-group">
      <label for="menu_order" class="form-control-label">Menu order :</label>
      <input type="number" class="form-control input-sm" id="menu_order" name="menu_order" required="required" value="<?=$rs_edit['menu_order']?>">
    </div>
    <div class="form-group">
      <label for="message-text" class="form-control-label">Menu Icon : <i id="show_icon" class="<?=$rs_edit['icon_name']?>"></i>&nbsp;<a href="javascript:$('.fontawesome-icon-list').toggle();$('#btn-icon').toggleClass('fa-caret-up', 'fa-caret-down');" class="btn btn-primary btn-xs"> Selected Icon <i id="btn-icon" class="fa fa-caret-down"></i></a> </label>
      <div class="row fontawesome-icon-list" style="display:none">
        <?php
	  $sql_icon = "SELECT icon_id,icon_name FROM icons";
	  $rs_icons = $db->GetAll($sql_icon);
	  foreach($rs_icons as   $icons){
	  	echo "<div class='fa-hover1 col-md-2 col-sm-2 col-xs-2' rel='".$icons['icon_id']."|".$icons['icon_name']."' title='".$icons['icon_name']."' ><a href='javascript:void(0);'><i class='".$icons['icon_name']."'></i></a> </div>\n";
	  }
	  ?>
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>
    <button type="submit" class="btn btn-primary"><i class="fa fa-pencil-square-o"></i> Save</button>
  </div>
  <input type="hidden" name="id" id="id" value="<?=$_GET['id']?>">
  <input type="hidden" name="action" id="action" value="<?=$_GET['action']?>">
  <input type="hidden" name="icon_id" id="icon_id" value="<?=$rs_edit['icon_id']?>">
</form>
<script type="text/javascript">
$(document).ready(function() {
	// Trigger form submit
		
		//doAction
		var actions = '<?=$_GET['action']?>';				
		
		//Modules
		var modules = '<?=$_GET['modules']?>';
		//Page
		var page = '<?=$_GET['page']?>';		

	
		$.FormAction( actions ,modules  ,page , '<?=$_GET['id']?>' , false  );


//Set icon_id when click as icon list
$('.fa-hover1').click(function(){
		var Split = $(this).attr('rel').split('|');
		$('#icon_id').val(Split[0]);
		$('#show_icon').attr('class',Split[1]);	
		
});
		
		
});
</script>
