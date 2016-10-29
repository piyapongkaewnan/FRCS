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
		//$('input[type=search]').addClass('form-control input-sm');
		
		
		//$('#btnCreate, #btnUpdate, #btnDelete').css('cursor','pointer');
	
 });

