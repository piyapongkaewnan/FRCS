$(function(){
// JavaScript Document

// modules = module name
// page = page name
// select_id = selection id
/*****************************************************************************************/
// Get modules name
var modules = $('#modules').val();

// Get page name
var page = $('#page').val();	

	
// Setting Dialogs
//$.setDialog = function(page,w,h , title){


//#########################################################
// Set Realname to localStorage
var profileRealname = localStorage.getItem("APPS.SITE.PROFILE_NAME");
var labelRealname = $('#show_realname').text();
if(profileRealname  != labelRealname){
localStorage.setItem("APPS.SITE.PROFILE_NAME" ,labelRealname);
localStorage.setItem("APPS.SITE.PROFILE_IMG_SRC" ,$(".profile_img").attr('src'));
}


/*****************************************************************************************/

//Add / Remove favorite
$('.actionFavorites').click(function(){
	var id = $(this).attr('rel');
	var action = $(this).attr('rule');
			$.post( "saveActions.php", { action: action, menu_id: id } , function( data ) {
		 		$.showNotify('success');
				//console.log(action);
				setTimeout("window.location.reload(true)",2000);		
			});
});



/*****************************************************************************************/

//Save Stats Event when click menu
$('.clickMenu').click(function(){
	var id = $(this).attr('rel');
			$.post( "saveActions.php", { action: "save_stat", menu_id: id } , function( data ) {
				//console.log(data);				
			});
});

 


/*****************************************************************************************/
// Function Show Notify
 $.showNotify = function(type) {
				var opts = {
					title: "Over Here",
					text: "Check me out. I'm in a different stack.",
					styling: 'bootstrap3',
					delay: 2000,
						nonblock: {
						nonblock: true
					},
					history: {
			            history: false
			        }
					
				};
				switch (type) {
				case 'error':
					opts.title = "Error:";
					opts.text = "Can't save data!";
					opts.type = "error";
					break;
				case 'info':
					opts.title = "Information";
					opts.text = "See more information";
					opts.type = "info";
					break;
				case 'success':
					opts.title = "Actions complete";
					opts.text = "Your operation is complete!!";
					opts.type = "success";
					break;
				}
				new PNotify(opts);
		}




<!--- My Customize DataTable --> 
$.MyDataTable = function(tableID , bStateSave  ,iDisplayLength , iDisplayEnd , aaSorting , orderType){  

	
   if ($('#table_'+tableID).length) { 


	var tableID = $('#table_'+tableID).dataTable({
				//'bJQueryUI': true,
				'bStateSave': bStateSave, 
				'sPaginationType': 'full_numbers',
               'bPaginate': '1', 
               'iDisplayLength' : iDisplayLength ,
               'iDisplayStart': 0 ,
               'iDisplayEnd' : iDisplayEnd,
				'aaSorting': [[ aaSorting, orderType ]],
				'language': {
				     'sProcessing': '<img src="./images/loading-gear.gif">',	
				     'oPaginate':{sFirst:'&laquo;',sLast:'&raquo;',sNext:'&#8250;',sPrevious:'&#8249;'} 
				} ,
			 dom: '<Bf<rt>pi>',  
			 'columnDefs': [ {  
			   'targets': 'no-sort',  
			   'orderable': false,  
			 } ] ,  
			     buttons: [ 
			         { 
			           extend: 'copy', 
			           className: 'btn-sm' 
			         }, 
			         { 
			           extend: 'csv', 
			            className: 'btn-sm' 
			          }, 
			         { 
			           extend: 'excel', 
			           className: 'btn-sm' 
			         }, 
			         { 
			            extend: 'pdfHtml5', 
			            className: 'btn-sm' 
			          }, 
			           { 
			             extend: 'print', 
			             className: 'btn-sm' 
			           } 
			          ], 
			          responsive: true 
 				}); 
   			} 

}
<!--- My Customize DataTable --> 

});


//#########################################################
// Check menu Auth
/*
function chkMenuAuth(status){
	if(status   == 'FALSE'){
		window.location = 'page_403.php';
	}
}*/
