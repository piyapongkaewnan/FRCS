// JavaScript Document
$(function(){

		
		// modules = module name
		// pages = page name
		// select_id = selection id
		// Get modules name
		var modules = $('#modules').val();
		
		// Get page name
		var page = $('#page').val();	
		
		$.MainAction(modules,page,'group_id');
		
		
		//showModalDelete();
		//$.initActionButton();
	
	

		
 });

