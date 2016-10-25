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
	$sql_edit = "SELECT  *  FROM user WHERE user_id = '$id';";
	$rs_edit = $db->GetRow($sql_edit);

}

?>


<!-- Custom Theme Style -->
<script type="text/javascript" src="../vendors/parsleyjs/dist/parsley.min.js"></script>
<!-- Dropzone.js -->
<script src="../vendors/dropzone/dist/min/dropzone.min.js"></script>

<form  data-parsley-validate name="form_<?=$_GET['page']?>" enctype="multipart/form-data" id="form_<?=$_GET['page']?>" method="post"  class="dropzone">
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
  <h4 class="modal-title" id="exampleModalLabel">
    <?=MainWeb::setTitleBar();?>
  </h4>
</div>
<div class="modal-body">
<div class="row">
<div class="col-xs-7">
<div class="form-group">
  <label for="username" class="form-control-label">*Username :</label>
  <input name="username" type="text" id="username" size="20" class="form-control input-sm " value="<?=$rs_edit['username']?>" required="required" />
  </div>
  <div class="form-group">
  <label for="password_hash" class="form-control-label">*Password : <?=$_GET['action'] == 'actionUpdate' ? "<input type='checkbox' id='rememPass' name='rememPass' value='Y'/> Not Change" : ""?></label>
  <input name="password_hash" type="password" id="password_hash" size="20" class="form-control input-sm " value="<?=$rs_edit['password_hash']?>"/>
  <!--   required="required" data-parsley-equalto="#re_password"  data-parsley-length="[6, 50]" pattern="[a-zA-Z0-9\s]+"  -->
  </div>
  <div class="form-group">
  <label for="re_password" class="form-control-label">*Re-Password :</label>
  <input name="re_password" type="password" id="re_password" size="20" class="form-control input-sm " value="<?=$rs_edit['password_hash']?>" />
  <!-- required="required" data-parsley-equalto="#password_hash"  data-parsley-length="[6, 50]" pattern="[a-zA-Z0-9\s]+" -->
</div>
<div class="form-group">
  <label for="realname" class="form-control-label">*Real Name :</label>
  <input name="realname" type="text" id="realname" size="20" class="form-control input-sm " value="<?=$rs_edit['realname']?>" required="required" />
  </div>
  <div class="form-group">
  <label for="email" class="form-control-label">*Email :</label>
  <input name="email" type="email" id="email" size="20" class="form-control input-sm " value="<?=$rs_edit['email']?>" required="required" />
  </div>
  </div>
<div class="col-xs-5">
  <div class="form-group">
<!--  data:image/jpeg;base64,<? //=base64_encode($rs_edit['picture'])?>-->
<div class=" text-center">
  <img  src="./images/img.jpg"  alt="..." width="150" height="150" id="profile-img" class="img-thumbnail">
<div style="height:5px"></div>
  <button type="button" class="btn btn-xs btn-danger">Remove Picture</button> <span class="btn btn-xs btn-info" id="newPic">New Picture</span>
</div>
</div>

  <div class="form-group">
  <label for="user_group" class="form-control-label">*User Group :</label>
  <select name="user_group[]" size="6" multiple="multiple" id="user_group" class="form-control  input-sm" required="required">
    <?php
			// ถ้าเลือกแก้ไขให้ slect group_id ใน tbl_user_auth

if($_GET['action'] == 'actionUpdate'){
				$sql_group = "SELECT  a.group_id,  a.group_name, b.group_id   AS group_id_chk,  b.user_id
									FROM user_group a
										 LEFT JOIN user_auth b
										   ON a.group_id = b.group_id
											 AND b.user_id = $id 
									ORDER BY a.group_name";
				$rs_group = $db->GetAll($sql_group);
				 for($i=0;$i<count($rs_group);$i++){
					 $group_id = $rs_group[$i]['group_id'];
					 	$sel = $group_id ==  $rs_group[$i]['group_id_chk'] ? 'selected' : '';
					 
						echo "<option value='$group_id' $sel>".$rs_group[$i]['group_name']."</option>\n";
				 }
				
			  }else{
					  $sql_group = "SELECT * FROM user_group ORDER BY group_name";
					  $rs_group = $db->GetAll($sql_group);
					  Form::genOptionSelect($rs_group,'group_id','group_name');
			  }
			  ?>
  </select>
  <span class="font-small">*Press Ctrl to select multiple</span> 
  </div>

</div>


</div>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>
  <button type="submit" class="btn btn-primary"><i class="fa fa-pencil-square-o"></i> Save</button>
</div>
<input type="hidden" name="id" id="id" value="<?=$_GET['id']?>">
<input type="hidden" name="action" id="action" value="<?=$_GET['action']?>">
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

	
		$.FormAction( actions ,modules  ,page , '<?=$_GET['id']?>' , true  );
	
		// jQuery
		
		
		var myDropzone = new Dropzone("#profile-img", { 
    url: 'test.php',
    autoProcessQueue:true
  });

  $('#newPic').on('click',function(e){
    e.preventDefault();
    myDropzone.processQueue();  
  });   
		
	if(actions == 'actionUpdate'){
		$('#rememPass').prop( "checked", true );
		$('#password_hash').prop( "disabled", "disabled" );
		$('#re_password').prop( "disabled", "disabled" );
		
	}else{
		$('#password_hash').removeAttr( "disabled");
		 $('#re_password').removeAttr( "disabled");
		 $('#re_password').attr("required","required");
			$('#password_hash').attr("required","required");
	}
	
	
	
	$('#rememPass').click(function(){
		if ($('#rememPass').is(':checked')){
			$('#password_hash').prop( "disabled", "disabled" );
		    $('#re_password').prop( "disabled", "disabled" );
			$('#password_hash').removeAttr('required');
			$('#re_password').removeAttr('required');
		}else{
			$('#password_hash').removeAttr( "disabled");
		    $('#re_password').removeAttr( "disabled");
			$('#re_password').attr("required","required");
			$('#password_hash').attr("required","required");
		}
	});
});
</script> 