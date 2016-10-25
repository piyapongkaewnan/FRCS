// JavaScript Document
$(function(){
	
		// modules = module name
		// pages = page name
		// select_id = selection id
		var modules = $("#modules").val();
		
		var page =  $("#page").val();
		
		var setTitle =  $("#setTitle").val();
		
		$.FormAction( 'edit' ,modules  ,page , null , false  );

});
					
