<!-- Select2 -->
<link href="../vendors/select2/dist/css/select2.min.css" rel="stylesheet">
<?php
include("./includes/Class/Form.Class.php");

if($_GET['action'] ==  'actionUpdate'){
// แสดงรายละเอียด
  $sql_edit = "SELECT
                        *						 
                       FROM dataapi WHERE id = ".$_GET['id'];                    
$rs_edit =  $db ->GetRow($sql_edit);

}

// Get Data from datasourcetype
$sqlSourceType= 'SELECT
					  id,
					 type
					FROM datasourcetype
					ORDER BY type ';
$rsSourceType = $db->GetAll($sqlSourceType);	


if ( $rs_edit['IsActive'] == "1" ||  $_GET['action'] ==  'actionCreate'){
	$strIsActive =  "checked";
}
/*

id
APIRefCode
APIName
APIUrl
UserName
Password
DataSourceType
IsActive
IsDelete
DeletedBy
DeletedOn
CreatedBy
CreatedOn
ModifiedBy
ModifiedOn

*/
?>
<?=MainWeb::openTemplate();?>
<style type="text/css">
	form {
		padding:0px;
		margin:0px;	
	}

</style>
<form id="form_<?=$Config['page']?>" name="form_<?=$Config['page']?>" method="post" data-parsley-validate class="form-horizontal form-label-left">
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="APIRefCode">API Ref Code <span class="required">*</span> </label>
    <div class="col-md-4 col-sm-3 col-xs-12">
      <input type="text" id="APIRefCode" name="APIRefCode" value="<?=$rs_edit['APIRefCode']?>" required="required "  class="form-control col-md-7 col-xs-12 has-feedback-left">
      <span class="fa fa-globe form-control-feedback left" aria-hidden="true"></span> </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="APIName">API Name <span class="required">*</span> </label>
    <div class="col-md-4 col-sm-3 col-xs-12">
      <input class="form-control  col-md-7 col-xs-12 has-feedback-left" id="APIName" name="APIName" type="text"  value="<?=$rs_edit['APIName']?>" required="required"/>
      <span class="fa fa-edit  form-control-feedback left" aria-hidden="true"></span> </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="APIUrl">API Url <span class="required">*</span> </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <input class="form-control  col-md-7 col-xs-12 has-feedback-left" id="APIUrl" name="APIUrl" type="url"  value="<?=$rs_edit['APIUrl']?>" required="required"/>
      <span class="fa fa-edit  form-control-feedback left" aria-hidden="true"></span> </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="UserName">UserName <span class="required">*</span> </label>
    <div class="col-md-4 col-sm-3 col-xs-12">
      <input class="form-control  col-md-7 col-xs-12 has-feedback-left" id="UserName" name="UserName" type="text"  value="<?=$rs_edit['UserName']?>" required="required"/>
      <span class="fa fa-edit  form-control-feedback left" aria-hidden="true"></span> </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Password">Password <span class="required">*</span> </label>
    <div class="col-md-4 col-sm-3 col-xs-12">
      <input class="form-control  col-md-7 col-xs-12 has-feedback-left" id="Password" name="Password" type="text"  value="<?=$rs_edit['Password']?>" required="required"/>
      <span class="fa fa-edit  form-control-feedback left" aria-hidden="true"></span> </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12"  for="DataSourceType">DataSourceType <span class="required">*</span></label>
    <div class="col-md-4 col-sm-3 col-xs-12">
      <select class="form-control col-md-7 col-xs-12 input-sm" name="DataSourceType" id="DataSourceType" tabindex="-1" required>
        <option></option>
        <?=Form::genOptionSelect($rsSourceType,'id','type',$rs_edit['DataSourceType']);?>
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
      <?=MENU_SUBMIT?>
      <input type="hidden" name="action" id="action" value="<?=$_GET['action']?>">
      <input type="hidden" name="id" id="id" value="<?=$_GET['id']?>">
    </div>
  </div>
</form>
<?=MainWeb::closeTemplate();?>
<form id="form_Param" name="form_Param" method="post" data-parsley-validate class="form-horizontal form-label-left">
<div class='row'>
  <div class='col-md-12 col-sm-12 col-xs-12'>
    <div class='x_panel'>
      <div class='x_title'>
        <h2><i class="fa fa-bolt"></i> API Parameters</h2>
        <ul class='nav navbar-right panel_toolbox'>
          <li><a class='collapse-link'><i class='fa fa-chevron-up'></i></a> </li>
          <li><a class='close-link'><i class='fa fa-close'></i></a> </li>
        </ul>
        <div class='clearfix'></div>
      </div>
      <div class='x_content'>
        <div class="x_content" id="APIParam">
          <div class="form-group  pull-left">
            <label class="control-label col-md-12 col-sm-12 col-xs-12">
            <button id="b1" class="btn btn-warning addMore" type="button"><i class="fa fa-plus"></i> Add Parammeter</button>
           </label>
          </div>
          <table class="table table-striped table-hover table-responsive" id="tableParam">
            <thead>
              <tr>
                <th>#</th>
                <th>Parameter Name</th>
                <th>Parameter Value</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
           <!--   <tr>
                <th scope=row><i class="fa fa-magic"></i></th>
                <td><input type="text" name="paramName[]" id="paramName" class="form-control input-sm" required="required" /></td>
                <td><input type="text" name="paramValue[]" id="paramValue" class="form-control input-sm" required="required" /></td>
                <td><button type="submit" class="btn btn-success btn-xs"> Save</button>  
                		<a href="javascript:void(0);" class="btn btn-danger btn-xs">Remove</a></td>
              </tr>-->
              <tr>
                <th scope=row>1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td><a href="javascript:void(0);" class="btn btn-info btn-xs">Edit</a>  <a href="javascript:void(0);" class="btn btn-danger btn-xs"> Remove</a></td>
              </tr>
              <tr>
                <th scope=row>2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td><a href="javascript:void(0);" class="btn btn-info btn-xs">Edit</a>  <a href="javascript:void(0);" class="btn btn-danger btn-xs"> Remove</a></td>
              </tr>
              <tr>
                <th scope=row>3</th>
                <td>Larry</td>
                <td>the Bird</td>
                <td><a href="javascript:void(0);" class="btn btn-info btn-xs">Edit</a> <a href="javascript:void(0);" class="btn btn-danger btn-xs"> Remove</a></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
          </form>
<!-- Form Custom Core JS --> 
<script type="text/javascript" src="js/form.js"></script> 
<script  type="text/javascript" src="./modules/<?=$Config['modules']?>/<?=$Config['page']?>.js"></script> 

<!-- Select2 --> 
<script src="../vendors/select2/dist/js/select2.full.min.js"></script> 
<script type="text/javascript">
$(function(){
	
	//doAction
		var actions = '<?=$_GET['action']?>';				
		
		//Modules
		var modules = '<?=$_GET['modules']?>';
		//Page
		var page = '<?=$_GET['page']?>';		

	
		$.FormAction( actions ,modules  ,page , '<?=$_GET['id']?>' , false  );

		 $("#DataSourceType").select2({
          placeholder: "Select a option..",
          allowClear: true
        });
	

	$('.addMore').click(function(){
		var input = '<tr>                <th scope=row><i class="fa fa-magic"></i></th>                <td><input type="text" name="paramName[]" id="paramName" class="form-control input-sm" required="required" /></td>                <td><input type="text" name="paramValue[]" id="paramValue" class="form-control input-sm" required="required" /></td>                <td><button type="submit" class="btn btn-success btn-xs"> Save</button>                 		<a href="javascript:void(0);" class="btn btn-danger btn-xs">Remove</a></td>              </tr>';
		$('#tableParam tbody:parent').append(input);
	});

});
</script>
