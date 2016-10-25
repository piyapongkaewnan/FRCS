// JavaScript Document
$(function(){

		
		// modules = module name
		// pages = page name
		// select_id = selection id
		// Get modules name
		var modules = $('#modules').val();
		
		// Get page name
		var page = $('#page').val();	
		
		//var setTitle =  $("#setTitle").val();

			// Setting Dialog
		//setDialog(setPage,520,220);
	//	$.setDialog(setPage , 520 , 220 ,setTitle);
		
		$.MainAction(modules , page,'');
		//$('input[type=search]').addClass('form-control input-sm');
		
	//	$.initActionButton();
		
 });

