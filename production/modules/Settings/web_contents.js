// JavaScript Document
$(function(){

		
		// modules = module name
		// pages = page name
		// select_id = selection id
		var setModule = $("#setModule").val();
		
		var setPage =  $("#setPage").val();
		
		var setTitle =  $("#setTitle").val();
		
			// Setting Dialog
		$.setDialog(setPage,860,570 ,setTitle );
		
		
		$.MainAction(setModule,setPage,'');
		
		
		$(".preview").button({
		icons: {
			primary: 'ui-icon-search'
		}			
		}).click( function() {
			 $.loading("load");
			$('#dialog-form-'+setPage).dialog('open');	
			var name = $(this).val();	
			$.get('./modules/'+setModule+'/'+setPage+'_view.php?t=app',		
					{ contents : name   },						
							function(data) {													
								$("#dialog-form-"+setPage).html(data);	
								$.loading("unload");		
							}
					)					
				return false;
		});
		
 });

