// JavaScript Document
$(function(){

	
		// Get modules name
	var modules = $('#modules').val();
	
	// Get page name
	var page = $('#page').val();	



	$.FormAction( 'actionUpdate' ,modules  ,page , null , false  );
	

				
	// เลือกเมนู
	$('#group_id').change(function(){
		window.location = '?modules='+modules+'&page='+page+'&group_id='+$(this).val();
	});
				
 });

