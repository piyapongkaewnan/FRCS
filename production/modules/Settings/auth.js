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
	
	// Check All checkbox
	$('input[type=checkbox].check-all').click (function () {
	  $('input[type=checkbox].program_'+$(this).val()).prop('checked', this.checked);
	  
	});

				
 });

