// JavaScript Document
$(function(){
			
			ajaxLoading();
			
			//Button
				$('#btnReset ,#btnSave').button();
			
		
	/*	function LoadContent(){
				 var getData=$.ajax({ // ใช้ ajax ด้วย jQuery ดึงข้อมูลจากฐานข้อมูล  
                url:"./modules/Admin/config.php",  
                data: { load_form : true },  
                async:false,  
				type : 'get',
                success:function(getData){  
                    $("#dialog-form-config").html(getData); // ส่วนที่ 3 นำข้อมูลมาแสดง  
        	        }  
        		}); 
		} // Function
		
		LoadContent();*/
		
			// Submit Form
				 var options = { 
					  // other available options: 
						//url:       url         // override for form's 'action' attribute 
						//type:      type        // 'get' or 'post', override for form's 'method' attribute 
						//dataType:  null        // 'xml', 'script', or 'json' (expected server response type) 
						//clearForm: true        // clear all form fields after successful submit 
						//resetForm: true        // reset the form after successful submit 
				 
						// $.ajax options can be used here too, for example: 
						//timeout:   3000 
						
						//target:    '#output',   // target element(s) to be updated with server response 
						url : './modules/Admin/config_code.php',
						type : 'post',
						beforeSubmit: function(formData, jqForm, options){
						if (Spry) { // checks if Spry is used in your page
							var r = Spry.Widget.Form.validate(jqForm[0]); // validates the form
							if (!r)
								return r;
						}
					},
						success: function(data){
							/*var str;
							if(data == "1"){
								$('#divMsgDiag').addClass('OKMsg');								
								str = " บันทึกข้อมูลเรียบร้อย !!";
							}else{
								$('#divMsgDiag').addClass('ErrorMsg');
								str = " เกิดข้อผิดพลาด !!";
								return false;
							}*/
							$('#divMsgDiag').html(' บันทึกข้อมูลเรียบร้อย !!').fadeIn();
						},// post-submit callback 
						 complete: function(){
							 $('#divMsgDiag').fadeOut(2000);
							setTimeout("window.location.reload(true)",2000);						
							 
						 }
					}; 
				 
					// bind to the form's submit event 
					$('#form_config').submit(function() { 
						$(this).ajaxSubmit(options); 
						return false; 
					}); 
				
				
				 
});

