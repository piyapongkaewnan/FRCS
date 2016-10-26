<?php

// แสดงรายละเอียด
  $sql_site = "SELECT
                        *						 
                       FROM configs ";                    
$rs_site =  $db ->GetRow($sql_site);

?>

<?=MainWeb::openTemplate();?> 
      <form  data-parsley-validate name="form_<?=$_GET['page']?>" enctype="multipart/form-data" id="form_<?=$_GET['page']?>" method="post" >

    <div class="row">
      <div class="col-xs-6">
        <div class="form-group">
          <label for="username" class="form-control-label">*Username :</label>
          <input name="username" type="text" id="username" size="20" class="form-control input-sm " value="<?=$rs_edit['username']?>" required="required" />
        </div>
        <div class="form-group">
          <label for="password_hash" class="form-control-label">*Password :
            <?=$_GET['action'] == 'actionUpdate' ? "<label><input type='checkbox' id='rememPass' name='rememPass' value='Y'/> Not Change</label>" : ""?>
          </label>
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
      <div class="col-xs-6">
        <div class="form-group"> 
          <!--  data:image/jpeg;base64,<? //=base64_encode($rs_edit['picture'])?>-->
          <div class=" text-center"> <img  src="./images/img.jpg"  alt="..." width="150" height="150" id="profile-img" class="img-thumbnail" style="cursor:pointer" data-toggle="tooltip" data-placement="top" title="Click for change profile picture">
            <div style="height:5px"></div>
            <button type="button" class="btn btn-xs btn-danger">Remove Picture</button>
            <span class="btn btn-xs btn-info" id="newPic">New Picture</span> </div>
        </div>
        <div class="form-group">
          <label for="user_group" class="form-control-label">*User Group :</label>
          
        </div>
      </div>
    </div>
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
<script src="./modules/<?=$Config['modules']?>/<?=$Config['page']?>.js"></script>


