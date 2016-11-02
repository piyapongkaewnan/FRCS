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

/*$sql_user_gruop = "SELECT
                        b.*
               FROM user_auth a,
                        user_group b
               WHERE a.group_id = b.group_id
                          AND a.user_id = ".$Config['user_id'];

$rs_user_group =  $db->GetAll($sql_user_gruop);*/

?>
<?=MainWeb::openTemplate();?>
<br />
<form id="form_<?=$Config['page']?>" name="form_<?=$Config['page']?>" method="post" data-parsley-validate class="form-horizontal form-label-left">
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">User Name <span class="required">*</span> </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <input type="text" id="username" name="username" value="<?=$rs_profile['username']?>" required="required" class="form-control col-md-7 col-xs-12 has-feedback-left">
      <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span> </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="old_password">Password <span class="required">*</span> </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <input type="password" id="password" name="password" required="required" value="<?=$rs_profile['password_hash']?>" data-parsley-equalto="#re_password"   data-parsley-length="[6, 50]"  pattern="[a-zA-Z0-9\s]+"  class="form-control col-md-7 col-xs-12 has-feedback-left">
      <span class="fa fa-lock  form-control-feedback left" aria-hidden="true"></span> </div>
  </div>
  <div class="form-group">
    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Retry Password *</label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <input id="re_password"  name="re_password" class="form-control col-md-7 col-xs-12 has-feedback-left" type="password" data-parsley-equalto="#password"  data-parsley-length="[6, 50]" pattern="[a-zA-Z0-9\s]+" value="<?=$rs_profile['password_hash']?>"  required="required" >
      <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span> </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Real Name <span class="required"></span> </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <input type="text" id="realname" name="realname" value="<?=$rs_profile['realname']?>" required="required" class="form-control col-md-7 col-xs-12 has-feedback-left">
      <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span> </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">E-Mail <span class="required">*</span> </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <input id="email" name="email" value="<?=$rs_profile['email']?>" class="form-control col-md-7 col-xs-12 has-feedback-left" required="required" type="email">
      <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span> </div>
  </div>
  <div class="ln_solid"></div>
  <div class="form-group">
    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
      <button type="reset" class="btn btn-primary"><i class="fa fa-close"></i> Cancel</button>
      <button type="submit" class="btn btn-success"><i class="fa fa-pencil-square-o"></i> Submit</button>
    </div>
  </div>
</form>
<?=MainWeb::closeTemplate();?>

<!-- Form Custom Core JS -->
<script type="text/javascript" src="js/form.js"></script>

<script  type="text/javascript" src="./modules/<?=$Config['modules']?>/<?=$Config['page']?>.js"></script> 