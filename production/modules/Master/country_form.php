<!-- Select2 -->
<link href="../vendors/select2/dist/css/select2.min.css" rel="stylesheet">
<?php
include("./includes/Class/Form.Class.php");

if($_GET['action'] ==  'actionUpdate'){
// แสดงรายละเอียด
  $sql_edit = "SELECT
                        *						 
                       FROM country WHERE id = ".$_GET['id'];                    
$rs_edit =  $db ->GetRow($sql_edit);

}

// Get data from fa table to select2
$sqlFx = 'SELECT
					  id,
					  CONCAT(FxName," (", FXCode,")") AS FxName
					FROM fx
					ORDER BY FxName ';
$rsFx = $db->GetAll($sqlFx);					

if ( $rs_edit['IsActive'] == "1" ||  $_GET['action'] ==  'actionCreate'){
	$strIsActive =  "checked";
}
	
					

?>
<?=MainWeb::openTemplate();?>

<br />
<form id="form_<?=$Config['page']?>" name="form_<?=$Config['page']?>" method="post" data-parsley-validate class="form-horizontal form-label-left">
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="CountryCode">Country Code <span class="required">*</span> </label>
    <div class="col-md-4 col-sm-3 col-xs-12">
      <input type="text" id="CountryCode" name="CountryCode" value="<?=$rs_edit['CountryCode']?>" required="required "  class="form-control col-md-7 col-xs-12 has-feedback-left">
      <span class="fa fa-globe form-control-feedback left" aria-hidden="true"></span> </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="CountryName">Country Name <span class="required">*</span> </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <input class="form-control  col-md-7 col-xs-12 has-feedback-left" id="CountryName" name="CountryName" type="text"  value="<?=$rs_edit['CountryName']?>" required="required"/>
      <span class="fa fa-edit  form-control-feedback left" aria-hidden="true"></span> </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12"  for="FxId">Fx Name  <span class="required">*</span></label>
    <div class="col-md-4 col-sm-3 col-xs-12">
      <select class="form-control col-md-7 col-xs-12 input-sm" name="FxId" id="FxId" tabindex="-1" required>
        <option></option>
        <?=Form::genOptionSelect($rsFx,'id','FxName',$rs_edit['FxId']);?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12"  for="IsActive">IsActive <span class="required"></span> </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <input type="checkbox" class=" input-sm" name="IsActive" id="IsActive" value="1"  <?=$strIsActive?> />
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

<script type="text/javascript"  src="./modules/<?=$Config['modules']?>/<?=$Config['page']?>.js"></script> 

<!-- Select2 --> 
<script type="text/javascript"  src="../vendors/select2/dist/js/select2.full.min.js"></script> 
<script type="text/javascript">
$(function(){
	
	//doAction
		var actions = '<?=$_GET['action']?>';				
		
		//Modules
		var modules = '<?=$_GET['modules']?>';
		//Page
		var page = '<?=$_GET['page']?>';		

	
		$.FormAction( actions ,modules  ,page , '<?=$_GET['id']?>' , false  );

		 $("#FxId").select2({
          placeholder: "Select a FX",
          allowClear: true
        });
	
	

});
</script>