<?php

if($_GET['action'] == 'actionUpdate'){
	$id = $_GET['id'];
	$sql_edit = "SELECT * FROM user_group WHERE group_id = $id";
	$rs_edit = $db->GetRow($sql_edit);
}
?>
<?=MainWeb::openTemplate();?>

<br />
<form  data-parsley-validate name="form_<?=$_GET['page']?>" id="form_<?=$_GET['page']?>" method="post" class="form-horizontal form-label-left">
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="group_name">User Group Name <span class="required">*</span> </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <input type="text" id="group_name" name="group_name" value="<?=$rs_edit['group_name']?>" required="required "  class="form-control col-md-7 col-xs-12 has-feedback-left">
      <span class="fa fa-keyboard-o form-control-feedback left" aria-hidden="true"></span> </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="group_desc">User Group Description <span class="required">*</span> </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <input type="text" id="group_desc" name="group_desc" value="<?=$rs_edit['group_desc']?>" required="required "  class="form-control col-md-7 col-xs-12 has-feedback-left">
      <span class="fa fa-keyboard-o form-control-feedback left" aria-hidden="true"></span> </div>
  </div>
  <div class="ln_solid"></div>
  <div class="form-group">
    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
      <?=MENU_SUBMIT?>
      <input type="hidden" name="action" id="action" value="<?=$_GET['action']?>">
      <input type="hidden" name="id" id="id" value="<?=$_GET['id']?>">
    </div>
  </div>
</form>
<?=MainWeb::closeTemplate();?>
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
