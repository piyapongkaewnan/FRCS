// JavaScript Document
$(function(){

		
		// modules = module name
		// pages = page name
		// select_id = selection id
		// Get modules name
		var modules = $('#modules').val();
		
		// Get page name
		var page = $('#page').val();	
		
		$.MainAction(modules,page,'mgroup_id');
		
		
		//showModalDelete();
		//$.initActionButton();
	
	

		
 });

