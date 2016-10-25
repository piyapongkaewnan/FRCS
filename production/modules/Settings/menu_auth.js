// JavaScript Document
$(function(){
	

			//Button
				$(".doAction button:first").button({
				icons: {
					primary: 'ui-icon-disk'
				},				
				}).click( function() {
					$('#doAction').val('Save');
					
					
					
					var options = { 					 
						url : './modules/Admin/menu_auth_code.php',
						type : 'post',						
						success: function(data){
							$('#divMsg').html(' บันทึกข้อมูลเรียบร้อย !!').fadeIn();							
							//$('#msg').html(data).fadeIn();
						},// post-submit callback 
						 complete: function(){
							 $.loading("unload");
							 $('#divMsg').fadeOut(2000);
							setTimeout("window.location.reload(true)",2000);						
						 }
					}; 
				 
					// bind to the form's submit event 
					$('#form_menu_auth').submit(function() { 
					$.loading("load");
						$(this).ajaxSubmit(options); 
						return false; 
					}); 
					
				})
					//.buttonset();	
				
				
				// เลือกเมนู
				$('#group_id').change(function(){
					window.location = '?setModule=Admin&setPage=menu_auth&group_id='+$(this).val();
				});
				
  });

