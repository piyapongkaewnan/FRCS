// JavaScript Document
$(function(){

	
		// Get modules name
	var modules = $('#modules').val();
	
	// Get page name
	var page = $('#page').val();	


	//  actions , modules  ,page , selected , debug , isCurrentPage
	$.FormAction( 'actionUpdate' ,modules  ,page , $("#group_id").val() , false ,  true );

				
	// เลือกเมนู
	$('#group_id').change(function(){
		window.location = '?modules='+modules+'&page='+page+'&group_id='+$(this).val();
	});
				
 });

