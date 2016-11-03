// JavaScript Document
$(function(){
	
	// Get modules name
var modules = $('#modules').val();

// Get page name
var page = $('#page').val();	

	//  actions , modules  ,page , selected , debug , isCurrentPage
	$.FormAction( 'actionUpdate' ,modules  ,page , null , false ,  true );

});
					
