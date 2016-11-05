// JavaScript Document
$(function(){
		
		// modules = module name
		// pages = page name
		// select_id = selection id
		// Get modules name
		var modules = $('#modules').val();
		
		// Get page name
		var page = $('#page').val();	
				

		//datatable.custom.js ->(page  ,iDisplayLength  , aaSorting , orderType , bStateSave);
	    $.MyDataTable(page   , 10   , 0 , 'asc' , false);
	
 });

