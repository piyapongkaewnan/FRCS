<?php
if($_GET['action'] == 'actionUpdate'){
	$id = $_GET['id'];
	$sql_edit = "SELECT  *  FROM user WHERE user_id = '$id';";
	$rs_edit = $db->GetRow($sql_edit);

}

$avatar = $_GET['action'] == 'actionUpdate' ? $rs_edit['avatar'] : 'user.png';
?>
<?=MainWeb::openTemplate();?>
<!-- Cropper -->
<link rel="stylesheet" type="text/css" href="./css/crop-avatar.css">
<!-- dropzone -->
<br />
<form  data-parsley-validate name="form_<?=$_GET['page']?>" id="form_<?=$_GET['page']?>" method="post" class="form-horizontal " enctype="multipart/form-data"  action="">
  <div class="row">
    <div class="col-xs-8">
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="username">Username <span class="required">*</span> </label>
        <div class="col-md-8 col-sm-8 col-xs-12">
          <input type="text" id="username" name="username" value="<?=$rs_edit['username']?>" required="required "  class="form-control col-md-7 col-xs-12 has-feedback-left">
          <span class="fa fa-user-o form-control-feedback left" aria-hidden="true"></span> </div>
      </div>
      <div class="form-group">
        <label for="password_hash" class="control-label col-md-3 col-sm-3 col-xs-12">Password <span class="required">*</span>
          <?=$_GET['action'] == 'actionUpdate' ? "<label><input type='checkbox' id='rememPass' name='rememPass' value='Y'/> Not Change</label>" : ""?>
        </label>
        <div class="col-md-8 col-sm-8 col-xs-12">
          <input type="password" id="password_hash" name="password_hash" value="<?=$rs_edit['password_hash']?>" required="required "  class="form-control col-md-7 col-xs-12 has-feedback-left">
          <!--   required="required" data-parsley-equalto="#re_password"  data-parsley-length="[6, 50]" pattern="[a-zA-Z0-9\s]+"  --> 
          <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span> </div>
      </div>
      <div class="form-group">
        <label for="re_password" class="control-label col-md-3 col-sm-3 col-xs-12">Re-Password <span class="required">*</span> </label>
        <div class="col-md-8 col-sm-8 col-xs-12">
          <input type="password" id="re_password" name="re_password" value="<?=$rs_edit['password_hash']?>" required="required "  class="form-control col-md-7 col-xs-12 has-feedback-left">
          <!-- required="required" data-parsley-equalto="#password_hash"  data-parsley-length="[6, 50]" pattern="[a-zA-Z0-9\s]+" --> 
          <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span> </div>
      </div>
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="realname">Real Name <span class="required">*</span> </label>
        <div class="col-md-8 col-sm-8 col-xs-12">
          <input type="text" id="realname" name="realname" value="<?=$rs_edit['realname']?>" required="required "  class="form-control col-md-7 col-xs-12 has-feedback-left">
          <span class="fa fa-user-o form-control-feedback left" aria-hidden="true"></span> </div>
      </div>
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email <span class="required">*</span> </label>
        <div class="col-md-8 col-sm-8 col-xs-12">
          <input type="email" id="email" name="email" value="<?=$rs_edit['email']?>" required="required "  class="form-control col-md-7 col-xs-12 has-feedback-left">
          <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span> </div>
      </div>
    </div>
    <div class="col-xs-4">
      <div class="form-group">
        <div  id="crop-avatar"> 
          <!-- Current avatar -->
          <div class="avatar-view" title="Change the avatar"> <img src="./images/avatar/<?=$avatar?>" alt="Avatar" class="img-thumbnail pic-avatar"> </div>
          <!-- Loading state -->
          <div class="loading" aria-label="Loading" role="img" tabindex="-1"></div>
        </div>
        
        <!--  data:image/jpeg;base64,<? //=base64_encode($rs_edit['picture'])?>--> 
        <!--  <div class=" text-center"> <img  src="./images/img.jpg"  alt="..." width="130" height="130" id="profile-img" class="img-circle" style="cursor:pointer" data-toggle="tooltip" data-placement="top" title="Click for change profile picture">
          <div style="height:5px"></div>
          <button type="button" class="btn btn-xs btn-danger" alt="Click me to remove the file." data-dz-remove>Remove Picture</button>
         <span class="btn btn-xs btn-info" id="newPic">New Picture</span></div>--> 
      </div>
      <div class="form-group">
        <div class="col-md-8 col-sm-12 col-xs-12">
          <select name="user_group[]" size="5" multiple="multiple" id="user_group" class="form-control  input-sm" required="required">
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
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12"> <span class="font-small">*Press Ctrl to select multiple</span></div>
      </div>
    </div>
  </div>
  <div class="ln_solid"></div>
  <div class="form-group">
    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-2">
      <?=MENU_SUBMIT?>
      <input type="hidden" name="action" id="action" value="<?=$_GET['action']?>">
      <input type="hidden" name="id" id="id" value="<?=$_GET['id']?>">
       <input type="hidden" name="avatar" id="avatar" value="<?=$avatar?>">
    </div>
  </div>
</form>


<?=MainWeb::closeTemplate();?>

<!-- Cropping modal -->
<div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form class="avatar-form" action="crop-avatar-code.php" enctype="multipart/form-data" method="post">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="avatar-modal-label">Change Avatar</h4>
        </div>
        <div class="modal-body">
          <div class="avatar-body"> 
            
            <!-- Upload image and data -->
            <div class="avatar-upload">
              <input type="hidden" class="avatar-src" name="avatar_src">
              <input type="hidden" class="avatar-data" name="avatar_data">
              <label for="avatarInput">Local upload</label>
              <input type="file" class="avatar-input" id="avatarInput" name="avatar_file">
            </div>
            
            <!-- Crop and preview -->
            <div class="row">
              <div class="col-md-9">
                <div class="avatar-wrapper"></div>
              </div>
              <div class="col-md-3">
                <div class="avatar-preview preview-lg "></div>
                <!--<div class="avatar-preview preview-md img-thumbnail"></div>--> 
                <br>
                 <button type="submit" class="btn btn-success btn-block avatar-save btn-lg"><i class="fa fa-check"></i> Done</button>
              </div>
            </div>
            <div class="row avatar-btns">
              <div class="col-md-9">
                <div class="btn-group">
                  <button type="button" class="btn btn-primary" data-method="rotate" data-option="-90" title="Rotate -90 degrees"><i class="fa fa-undo"></i> Rotate Left</button>
                  <!--                      <button type="button" class="btn btn-primary" data-method="rotate" data-option="-15">-15deg</button>
                      <button type="button" class="btn btn-primary" data-method="rotate" data-option="-30">-30deg</button>
                      <button type="button" class="btn btn-primary" data-method="rotate" data-option="-45">-45deg</button>
--> </div>
                <div class="btn-group">
                  <button type="button" class="btn btn-primary" data-method="rotate" data-option="90" title="Rotate 90 degrees"><i class="fa fa-repeat"></i> Rotate Right</button>
                  <!--                      <button type="button" class="btn btn-primary" data-method="rotate" data-option="15">15deg</button>
                      <button type="button" class="btn btn-primary" data-method="rotate" data-option="30">30deg</button>
                      <button type="button" class="btn btn-primary" data-method="rotate" data-option="45">45deg</button>
--> </div>
              </div>
              <div class="col-md-3">
               <!-- <button type="submit" class="btn btn-success btn-block avatar-save btn-lg"><i class="fa fa-check"></i> Done</button>-->
              </div>
            </div>
          </div>
        </div>
        <!-- <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div> -->
      </form>
    </div>
  </div>
</div>
<!-- /.modal -->
<!-- Cropper --> 
<script src="./js/crop-avatar.js"></script> 
<script type="text/javascript">
$(document).ready(function() {
	// Trigger form submit
		
		//doAction
		var actions = '<?=$_GET['action']?>';				
		
		//Modules
		var modules = '<?=$_GET['modules']?>';
		//Page
		var page = '<?=$_GET['page']?>';		

	
		//  actions , modules  ,page , selected , debug , isCurrentPage
		$.FormAction(actions ,modules  ,page ,  '<?=$_GET['id']?>' , false ,  false );

		
      //$.CropAvatar($('#crop-avatar'));
  

		
		
/*var myfile = $("#profile-img").dropzone({
				url: 'modules/Settings/user_upload.php',
				autoProcessQueue:true ,
				});
console.log(myfile);	

  $('#profile-img').on('click',function(e){
    e.preventDefault();
    myDropzone.processQueue();  
  });   
  	*/
  /*
  // instantiate the uploader
 var myDropzone =  $('#profile-img ').dropzone({ 
    url: "modules/Settings/user_upload.php",
    maxFilesize: 100,
   // paramName: "uploadfile",
    maxThumbnailFilesize: 1,
    init: function() {
      
      this.on('success', function(file, json) {
		  console.log(file.name);	
		   $('#profile-img').attr('src' , './images/avatar/tmp/'+file.name);
      });
      
      this.on('addedfile', function(file) {
         console.log(file);	
      });
      
      this.on('drop', function(file) {
         console.log(file);	
      }); 
    }
  });*/
  
  
  
		
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