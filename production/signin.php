<?php
@session_start();
include('./includes/config.inc.php');

if($_SESSION['sess_user_id']) pageback('index.php','');

?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>
<?=SITE_NAME;?>
</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script type="text/javascript" src="js/jquery.form.js"></script>
<link type="text/css" href="css/main.css" rel="stylesheet" />
<link type="text/css" href="css/<?=THEMES?>/jquery-ui.css" rel="stylesheet" />
<link rel="stylesheet" href="css/tipsy.css" type="text/css" />


<script type="text/javascript" src="js/jquery.tipsy.js"></script>
<!--<script type="text/javascript" src="js/jquery.ui.datepicker-th.js"></script>-->
<script type="text/javascript" src="js/main_index.js"></script>
<script src="./includes/SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="./includes/SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<link href="./includes/SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="./images/favicon.ico" />
<script language="javascript">
/******************************************/		
// Ajax loading image
function ajaxLoading(){
		// Show loading image
				$('#ajaxloading')
				.ajaxStart(function() {
				$(this).show();
				})
				.ajaxStop(function() {
				$(this).hide();
				});
		}



$(function(){
	
	ajaxLoading();
	
	$("#username,#password,#txt_captcha").tipsy({trigger: "hover",gravity: "w"});	

/*	$("#btn_recode").tipsy({trigger: "hover",gravity: "w"});
	$("#txt_captcha").tipsy({trigger: "hover",gravity: "s"});		
*/	
	$("#usename").focus();
	
	// Button
	$("#btn_reset").button();
	$("#btn_login,#btn_reset,#btn_recode").css("cursor","pointer");
	
	
	$("#btn_login").button({
				icons: {
					primary: 'ui-icon-locked'
				}				
				})	;
	
	/******************************************/
		// Dialog Login		
		$("#dialog-login").dialog({
			autoOpen: true,
			draggable: false,
			resizable: false,
			closeOnEscape: false,
			disabled:true,
			height: 280,
			width: 440,
			modal: true,
			show: 'highlight',
			hide: 'fade',
			closeOnEscape: false,
			 open: function(event, ui) {
				  $(this).closest('.ui-dialog').find('.ui-dialog-titlebar-close').hide();
				},
			close: function() {
                    //window.location.reload(true);
              }
		});		
		
	

	
	$('#btn_reset').click(function(){
			$("#dialog-login").dialog("open");
			
	});
	
	
		
// From Submit Login
		 var options = { 
						url : 'checkuser.php?'+$.now(),
						type : 'post',
						data : {doAction : 'Access' },
						beforeSubmit: function(formData, jqForm, options){
						if (Spry) { // checks if Spry is used in your page
							var r = Spry.Widget.Form.validate(jqForm[0]); // validates the form
							//alert($("#secuecode").text());
							if (!r)
								return r;
						}
					},
					
					
				/*	if(($("#secuecode").text() == $("#captcha").val() ) && r == true){
								
									return true;
								
							}else{
								r = false;
								$('#ErrorMsg2').show('bounce');
								$('#ErrorMsg2').hide('clip');	
								$('#captcha').css({'background-color':'#FF9F9F'});
								return false;	
								
							}			
						}
					},*/
						success: function(data){							
						//$('#footer').html(data);

							if($.trim(data) == '1'){
								setTimeout("window.location='index.php';",0);	
							}else{
								//$('#divMsgDiag').html(data).fadeIn();
								$('#ErrorMsg').show('bounce');
								$('#ErrorMsg').hide('clip');	
								
							}

						}
					}; 
				 
					// bind to the form's submit event 
					$('#frm_login').submit(function() { 
						$(this).ajaxSubmit(options); 
						return false; 
					}); 
	
	
		/*
		getCodeImage();
	
		$("#btn_recode").click(function(){
				getCodeImage();
		});
*/

});


function getCodeImage(){

	$("#imgCode").remove();
	
	$.get("captcha.php?"+Math.random(),function(data){
		$("#secuecode").text(data);
	});
	
//	$("#secuecode").after("captcha.php?"+Math.random()+"\" ");
	
}
</script>
</head>
<style type="text/css">
	#btn_recode {
		height:20px;	
	}
	
	#secuecode {
		font-size:14px;
		font-weight:bold;
		text-shadow:#666;		
		color:#000;
		margin:10px;
	
	}
	
	#box_secuecode {		
		padding:8px 0 8px;
		background-color:#CCC;
		background-image:url(images/captcha_bg.png);
		-moz-border-radius: 5px;
		-webkit-border-radius: 5px;
	}
	
	#captcha {
		text-align:center;	
	}
</style>
<body>
<div id="dialog-login" title="Sign In...">
  <form name="frm_login" id="frm_login" method="post" action="">
    <table width="100%" border="0" align="center" cellpadding="1" cellspacing="0">
      <tr>
        <td><table width="100%" border="0" align="center" cellpadding="4" cellspacing="0">
            <tr>
              <td width="16%" rowspan="4" align="right" valign="top"><img src="images/login_new.png"></td>
              <td width="84%"  valign="top"><div class="ui-widget" style="display:none" id="ErrorMsg">
                  <div class="ui-state-highlight ui-corner-all" style="padding: .01em;">
                    <p> &nbsp;<span class="ui-icon ui-icon-alert" style="float: left"></span> <strong>  ชื่อ/รหัสผ่าน ไม่ถูกต้อง !!</strong></p>
                  </div>
                </div></td>
            </tr>
            <tr>
              <td width="84%">Username&nbsp;:<br />
                <span id="sprytextfield1">
                <input name="username" type="text" id="username" title="กรอกชื่อผู้ใช้งาน" value="" size="20"/>
                <span class="textfieldRequiredMsg">A value is required.</span></span></td>
            </tr>
            <tr>
              <td>Password&nbsp;:<br />
                <span id="sprytextfield2">
                <input name="password" type="password" id="password"  title="กรอกรหัสผ่าน" value="" size="20"/>
                <span class="textfieldRequiredMsg">A value is required.</span></span></td>
            </tr>  
            <!--
            <tr>
              <td><label id="box_secuecode"><span id="secuecode"></span></label>&nbsp;<img src="images/recaptcha-sprite.png" width="20" height="18" align="absmiddle" class="tooltips"  id="btn_recode" title="Re-Capcha"><div class="ui-widget" style="display:none" id="ErrorMsg2">
                  <div class="ui-state-highlight ui-corner-all" style="padding: .01em;">
                    <p> &nbsp;<span class="ui-icon ui-icon-alert" style="float: left"></span> <strong>  รหัสความปลอดภัยไม่ถูกต้อง !!</strong></p>
                  </div>
              </div></td>
            </tr>
          <tr>
            <td></td>
              <td height="31">รหัสความปลอดภัย :<br><span id="sprytextfield3">
              <label for="captcha"></label>
              <input name="captcha" type="text" id="captcha" size="10" maxlength="4" class="tooltips" title="กรอก Re-Captcha" >
              <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldMinCharsMsg">Minimum number of characters not met.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span></td>
            </tr>
            -->
            <tr>         
              <td height="31">  <br><button type="submit" name="Submit" id="btn_login" value="" /> Sign In &raquo;</button>    
              <input name="redirect" id="redirect" type="hidden" value="<?=$_GET['redirect']?>">          
                <span id='ajaxloading'>Loading..</span>&nbsp;
              </td>
            </tr>
                 <tr>
                   <td height="45" colspan="2" align="center" valign="bottom"> <hr width="100%" style="border-style:solid 1px; border-color:#eee; opacity:.4" >
                   <div id="footer" style="text-align:right; width:99%" class="font-small"><?=SITE_NAME." ".COPYRIGHT?></div></td>
                 </tr>
        </table></td>
      </tr>
    </table>
  </form>
</div>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["blur"]});
<!--var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "none", {validateOn:["blur"]});-->
</script>
</body>
</html>