<?php
if($_GET['action'] == 'actionUpdate'){
	$id = $_GET['id'];
	$sql_edit = "SELECT  *  FROM user WHERE user_id = '$id';";
	$rs_edit = $db->GetRow($sql_edit);

}

$avatar = $_GET['action'] == 'actionUpdate' ? $rs_edit['avatar'] : 'user.png';
?>

<!--
<div class="container">
    <div class="row">
    <?php //for($i=0;$i<12;$i++){ ?>
        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6"><p>Box <?=($i+1) ?></p></div>
       <?php// } ?>
    </div>
</div>
-->
<?=MainWeb::openTemplate();?>
<!-- Cropper -->
<link rel="stylesheet" type="text/css" href="./css/crop-avatar.css">
<!-- dropzone -->
<br />
<form  data-parsley-validate name="form_<?=$_GET['page']?>" id="form_<?=$_GET['page']?>" method="post" class="form-horizontal " enctype="multipart/form-data"  action="">
  <div class="row">
    <div class="col-xs-12 col-sm-8 col-md-8">
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-4 col-xs-12" for="username">Username <span class="required">*</span> </label>
        <div class="col-md-8 col-sm-8 col-xs-12">
          <input type="text" id="username" name="username" value="<?=$rs_edit['username']?>" required="required "  class="form-control col-md-7 col-xs-12 has-feedback-left">
          <span class="fa fa-user-o form-control-feedback left" aria-hidden="true"></span> </div>
      </div>
      <?php if($_GET['action'] == 'actionUpdate') { ?>
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-4 col-xs-12" for="isChange"><span class="rememLabel">Change password</span></label>
        <div class="col-md-8 col-sm-8 col-xs-12">
          <input type='checkbox' id='isChange' name='isChange' value='Y'/>
        </div>
      </div>
      <?php } ?>
      <div class="form-group divChange">
        <label class="control-label col-md-3 col-sm-4 col-xs-12" for="password_hash">Password <span class="required">*</span> </label>
        <div class="col-md-8 col-sm-8 col-xs-12">
          <input type="password" id="password_hash" name="password_hash" required="required" value="" data-parsley-equalto="#re_password"   data-parsley-length="[6, 50]"    class="form-control col-md-7 col-xs-12 has-feedback-left">
          <span class="fa fa-lock  form-control-feedback left" aria-hidden="true"></span> </div>
      </div>
      <div class="form-group divChange">
        <label for="re_password" class="control-label col-md-3 col-sm-4 col-xs-12">Retry Password *</label>
        <div class="col-md-8 col-sm-8 col-xs-12">
          <input id="re_password"  name="re_password" class="form-control col-md-7 col-xs-12 has-feedback-left" type="password" data-parsley-equalto="#password_hash"  data-parsley-length="[6, 50]" value=""  required="required" >
          <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span> </div>
      </div>
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-4 col-xs-12" for="realname">Real Name <span class="required">*</span> </label>
        <div class="col-md-8 col-sm-8 col-xs-12">
          <input type="text" id="realname" name="realname" value="<?=$rs_edit['realname']?>" required="required "  class="form-control col-md-7 col-xs-12 has-feedback-left">
          <span class="fa fa-user-o form-control-feedback left" aria-hidden="true"></span> </div>
      </div>
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-4 col-xs-12" for="email">Email <span class="required">*</span> </label>
        <div class="col-md-8 col-sm-8 col-xs-12">
          <input type="email" id="email" name="email" value="<?=$rs_edit['email']?>" required="required "  class="form-control col-md-7 col-xs-12 has-feedback-left">
          <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span> </div>
      </div>
    </div>
    <div class="col-xs-12 col-sm-4 col-md-3">
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
        <?php
if($_GET['action'] == 'actionUpdate'){
				$sql_group = "SELECT  a.group_id,  a.group_name, b.group_id   AS group_id_chk,  b.user_id
									FROM user_group a
										 LEFT JOIN user_auth b
										   ON a.group_id = b.group_id
											 AND b.user_id = $id 
									ORDER BY a.group_name";
}else{
			 $sql_group = "SELECT * FROM user_group ORDER BY group_name";
}
			$rs_group = $db->GetAll($sql_group);
			
						 for($i=0;$i<count($rs_group);$i++){
					 			$group_id = $rs_group[$i]['group_id'];
					 			$_chk = $group_id ==  $rs_group[$i]['group_id_chk'] ? 'checked' : '';
								echo "      <div class='checkbox'>\n";
								echo "  <label><input type=\"checkbox\" name=\"user_group[]\" value=\"$group_id\" required=\"required\" class=\"flat\" $_chk> ".$rs_group[$i]['group_name']."</label>\n";
								echo "</div>\n";			
						 }
					
				
//}
?>
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
  
  


		// Call function setPassSelect 
		setPassSelect();
	
	
	$('#isChange').click(function(){
		setPassSelect();
	});
	
	
	// Function for check change password select
	function setPassSelect(){
		if ($('#isChange').is(':checked') ||  actions =='actionCreate'){
			$('#password_hash').removeAttr( "disabled");
		    $('#re_password').removeAttr( "disabled");
			$('#re_password').attr("required","required");
			$('#password_hash').attr("required","required");
			 $('#re_password').attr("required","required");
		 	$('#password_hash').attr("required","required");
			//$('.divChange').show();
		 
		}else{
			$('#password_hash').prop( "disabled", "disabled" );
		    $('#re_password').prop( "disabled", "disabled" );
			$('#password_hash').removeAttr('required');
			$('#re_password').removeAttr('required');
			//$('.divChange').hide();
		}	
	}

  
});
</script> 