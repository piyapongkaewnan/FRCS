// JavaScript Document
$(function(){
	
	// Get modules name
var modules = $('#modules').val();

// Get page name
var page = $('#page').val();	

$.FormAction( 'edit' ,modules  ,page , null , false  );

});
					
