<?php

// แสดงรายละเอียด
  $sql_site = "SELECT
                        *						 
                       FROM configs ";                    
$rs_site =  $db ->GetRow($sql_site);

$maxlifetime = ini_get("session.gc_maxlifetime") / 60;
?>

<?=MainWeb::openTemplate();?> 
        <form id="form_<?=$Config['page']?>" name="form_<?=$Config['page']?>" method="post" data-parsley-validate class="form-horizontal form-label-left">
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="website_name">Site Name <span class="required">*</span> </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="website_name" name="website_name" value="<?=$rs_site['website_name']?>" required="required" class="form-control col-md-7 col-xs-12 has-feedback-left">
              <span class="fa fa-globe form-control-feedback left" aria-hidden="true"></span> </div>
          </div>
         <!-- <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="website_language">Language <span class="required">*</span> </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="website_language" name="website_language" required="required" value="<?=$rs_site['website_language']?>"  class="form-control col-md-7 col-xs-12 has-feedback-left">
              <span class="fa  fa-flag-checkered  form-control-feedback left" aria-hidden="true"></span> </div>
          </div>-->
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Language</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div id="gender" class="btn-group" data-toggle="buttons">
                <label class="btn btn-<?=$rs_site['website_language'] == 'en' ? 'primary' : 'default'?>" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                  <input type="radio" name="website_language" value="en" <?=$rs_site['website_language'] == 'en' ? 'checked' : ''?>>
                  English  </label>
                <label class="btn btn-<?=$rs_site['website_language'] == 'th' ? 'primary' : 'default'?>" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                  <input type="radio" name="website_language" value="th" <?=$rs_site['website_language'] == 'th' ? 'checked' : ''?>>
                 &nbsp; Thai &nbsp; </label>
              </div>
            </div>
          </div>
          
           <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="session_timeout">Session timeout <small>(n minute)</small> </label>
            <div class="col-md-3 col-sm-2 col-xs-12">
              <input type="number" id="session_timeout" name="session_timeout" value="<?=$rs_site['session_timeout']?>" class="form-control col-md-7 col-xs-12 has-feedback-left" required="required" max="<?=$maxlifetime?>">
              <span class="fa fa-clock-o form-control-feedback left" aria-hidden="true"></span> </div>
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


