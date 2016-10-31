<?php

if($_GET['action'] ==  'actionUpdate'){
// แสดงรายละเอียด
  $sql_edit = "SELECT
                        *						 
                       FROM fx WHERE id = ".$_GET['id'];                    
$rs_edit =  $db ->GetRow($sql_edit);

}
if ( $rs_edit['IsActive'] == "1" ||  $_GET['action'] ==  'actionCreate'){
	$strIsActive =  "checked";
}
?>
<?=MainWeb::openTemplate();?>

<br />
<form id="form_<?=$Config['page']?>" name="form_<?=$Config['page']?>" method="post" data-parsley-validate class="form-horizontal form-label-left">
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="FXCode">FX Code <span class="required">*</span> </label>
    <div class="col-md-4 col-sm-3 col-xs-12">
      <input type="text" id="FXCode" name="FXCode" value="<?=$rs_edit['FXCode']?>" required="required "  class="form-control col-md-7 col-xs-12 has-feedback-left">
      <span class="fa fa-keyboard-o form-control-feedback left" aria-hidden="true"></span> </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="FXSymbol">FX Symbol </label>
    <div class="col-md-4 col-sm-3 col-xs-12">
      <input class="form-control  col-md-7 col-xs-12 has-feedback-left" id="FXSymbol" name="FXSymbol" type="text"  value="<?=$rs_edit['FXSymbol']?>"/>
      <span class="fa fa-dollar  form-control-feedback left" aria-hidden="true"></span> </div>
  </div>
  <div class="form-group">
    <label  class="control-label col-md-3 col-sm-3 col-xs-12"  for="FxName">Fx Name *</label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <input class="form-control col-md-7 col-xs-12 has-feedback-left" id="FxName" name="FxName" type="text" value="<?=$rs_edit['FxName']?>"  required="required"/>
      <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span> </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="IsBase">Is Base </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <input type="checkbox" class=" input-sm" name="IsBase" id="IsBase" value="1" <?=$rs_edit['IsBase'] == "1"  ? "checked" : ""?>/>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="RateToBase">Rate To Base <span class="required">*</span> </label>
    <div class="col-md-4 col-sm-3 col-xs-12">
      <input class="form-control col-md-7 col-xs-12 has-feedback-left" id="RateToBase" name="RateToBase" value="<?=number_format($rs_edit['RateToBase'],8);?>" type="text" required="required"/>
      <span class="fa fa-calculator form-control-feedback left" aria-hidden="true"></span> </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12"  for="IsActive">IsActive <span class="required"></span> </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <input type="checkbox" class=" input-sm" name="IsActive" id="IsActive" value="1"  <?=$strIsActive?>  />
    </div>
  </div>
  <div class="ln_solid"></div>
  <div class="form-group">
    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
      <button type="reset" class="btn btn-primary"><i class="fa fa-close"></i> Cancel</button>
      <button type="submit" class="btn btn-success"><i class="fa fa-pencil-square-o "></i> Submit</button>
      <input type="hidden" name="action" id="action" value="<?=$_GET['action']?>">
      <input type="hidden" name="id" id="id" value="<?=$_GET['id']?>">
    </div>
  </div>
</form>
<?=MainWeb::closeTemplate();?>

<!-- Form Custom Core JS -->
<script type="text/javascript" src="js/form.js"></script>

<script  type="text/javascript" src="./modules/<?=$Config['modules']?>/<?=$Config['page']?>.js"></script> 

<script type="text/javascript">
$(function(){
	
	//doAction
		var actions = '<?=$_GET['action']?>';				
		
		//Modules
		var modules = '<?=$_GET['modules']?>';
		//Page
		var page = '<?=$_GET['page']?>';		

	
		$.FormAction( actions ,modules  ,page , '<?=$_GET['id']?>' , false  );

	

});
</script>