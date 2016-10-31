<?php
session_start();
include("../../includes/DBConnect.php");
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
	$sql_edit = "SELECT * FROM user_group WHERE group_id = $id";
	$rs_edit = $db->GetRow($sql_edit);
}
?>
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
      <label for="group_name" class="form-control-label">*User Group Name:</label>
      <input type="text" class="form-control input-sm" id="group_name" name="group_name" required="required" value="<?=$rs_edit['group_name']?>">
    </div>
    <div class="form-group">
      <label for="group_desc" class="form-control-label">*User Group Description:</label>
      <input type="text" class="form-control input-sm" id="group_desc" name="group_desc" required="required" value="<?=$rs_edit['group_desc']?>">
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
				

		
});
</script>
