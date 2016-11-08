<!-- Cropper -->
<link rel="stylesheet" type="text/css" href="./css/crop-avatar.css">
<?php

// Title Menu from function.php

// แสดงรายละเอียด
  $sql_profile = "SELECT
                        *						 
                       FROM user 
                       WHERE user_id =  ".$Config['user_id'];
$rs_profile =  $db ->GetRow($sql_profile);

// หาค่ากลุ่มผู้ใช้งาน
if(!$rs_profile) return;


?>
<?=MainWeb::openTemplate();?>
<br />
<form id="form_<?=$Config['page']?>" name="form_<?=$Config['page']?>" method="post" data-parsley-validate class="form-horizontal form-label-left">
  <div class="row">
    <div class="col-xs-12 col-sm-8 col-md-8">
      <div class="form-group">
        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="username">User Name <span class="required">*</span> </label>
        <div class="col-md-8 col-sm-8 col-xs-12">
          <input type="text" id="username" name="username" value="<?=$rs_profile['username']?>" required="required" class="form-control col-md-7 col-xs-12 has-feedback-left">
          <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span> </div>
      </div>
      <div class="form-group">
        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="isChange"><span class="rememLabel">Change password</span></label>
        <div class="col-md-8 col-sm-8 col-xs-12">
          <input type='checkbox' id='isChange' name='isChange' value='Y'/>
        </div>
      </div>
      <div class="form-group divChange">
        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="password_hash">Password <span class="required">*</span> </label>
        <div class="col-md-8 col-sm-8 col-xs-12">
          <input type="password" id="password_hash" name="password_hash" required="required" value="" data-parsley-equalto="#re_password"   data-parsley-length="[6, 50]"    class="form-control col-md-7 col-xs-12 has-feedback-left">
          <span class="fa fa-lock  form-control-feedback left" aria-hidden="true"></span> </div>
      </div>
      <div class="form-group divChange">
        <label for="re_password" class="control-label col-md-4 col-sm-4 col-xs-12">Retry Password *</label>
        <div class="col-md-8 col-sm-8 col-xs-12">
          <input id="re_password"  name="re_password" class="form-control col-md-7 col-xs-12 has-feedback-left" type="password" data-parsley-equalto="#password_hash"  data-parsley-length="[6, 50]" value=""  required="required" >
          <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span> </div>
      </div>
      <div class="form-group">
        <label class="control-label col-md-4 col-sm-4col-xs-12" for="realname">Real Name <span class="required"></span> </label>
        <div class="col-md-8 col-sm-8 col-xs-12">
          <input type="text" id="realname" name="realname" value="<?=$rs_profile['realname']?>" required="required" class="form-control col-md-7 col-xs-12 has-feedback-left">
          <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span> </div>
      </div>
      <div class="form-group">
        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="email">E-Mail <span class="required">*</span> </label>
        <div class="col-md-8 col-sm-8 col-xs-12">
          <input id="email" name="email" value="<?=$rs_profile['email']?>" class="form-control col-md-7 col-xs-12 has-feedback-left" required="required" type="email">
          <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span> </div>
      </div>
    </div>
    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
      <div class="form-group"> 
        <!-- Crop Avatar -->
        <div  id="crop-avatar"> 
          <!-- Current avatar -->
          <div class="avatar-view" title="Change the avatar"> <img src="./images/avatar/<?=$rs_profile['avatar']?>" alt="Avatar" class="img-thumbnail pic-avatar"> </div>
          <!-- Loading state -->
          <div class="loading" aria-label="Loading" role="img" tabindex="-1"></div>
        </div>
        <!-- Crop Avatar --> 
      </div>
    </div>
  </div>
  <div class="ln_solid"></div>
  <div class="form-group">
    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
      <?=MENU_SUBMIT2?>
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
<script  type="text/javascript" src="./modules/<?=$Config['modules']?>/<?=$Config['page']?>.js"></script> 