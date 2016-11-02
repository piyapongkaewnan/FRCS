// JavaScript Document
$(function(){

		
		// modules = module name
		// pages = page name
		// select_id = selection id
		// Get modules name
		var modules = $('#modules').val();
		
		// Get page name
		var page = $('#page').val();	
		

		$.MainActionOnPage(modules , page,'');

			//(page , bStateSave  ,iDisplayLength , iDisplayEnd , aaSorting , orderType);
	    $.MyDataTable(page , false  , 10  , 10 , 1 , 'asc');
		

		
 });

