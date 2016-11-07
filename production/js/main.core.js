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

});


//#########################################################
// Check menu Auth
/*
function chkMenuAuth(status){
	if(status   == 'FALSE'){
		window.location = 'page_403.php';
	}
}*/


