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

// Set URL to Redirect back page
var RedirectURL =  '?modules='+modules+'&page='+page;
				
//}


//#########################################################
// Set Realname to localStorage
var profileRealname = localStorage.getItem("APPS.SITE.PROFILE_NAME");
var labelRealname = $('#show_realname').text();
if(profileRealname  != labelRealname){
localStorage.setItem("APPS.SITE.PROFILE_NAME" ,labelRealname);
}





/*****************************************************************************************/

$("#FormModal ,  #FormModalDelete , #PermissionModal").on('hide.bs.modal', function (e) {
    $(this).data('bs.modal', null);
	$('#divMsg').html('');
});	
	


/*****************************************************************************************/

// Go back page
$('#PermissionModal').on('hide.bs.modal', function (e) {
  // window.history.back(-1);
   window.location = 'index.php';
})


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
// Init on check Radio
$('input[name=selID]').click(function(){
	$("#hidRadio").val($(this).val()) ;		
	$.initActionButton();
});



	
/*****************************************************************************************/
// Main Action 
 $.MainAction= function(modules  ,page  ,select_id){
				$.initActionButton();
				
				$('input[type=search]').addClass('form-control input-sm');
				
				// เลือกเมนู
				$('#'+select_id).change(function(){
					window.location = '?modules='+modules+'&page='+page+'&'+select_id+'='+$(this).val();
				});
			
			
			
				/*****************************************************************************************/
				// Button Create, Edit,Delete Action
				$("#btnCreate , #btnUpdate , #btnDelete").click( function() {	
						var actions  = $(this).attr('rel');
						var selID  = getSelID();
						
						NProgress.start();		
						
						switch(actions) {
							case 'actionCreate'  :
							case  'actionUpdate' :
								var FormModals  =  'FormModal' ;
								 
								 $.get('./modules/'+modules+'/'+page+'_form.php' , { time : $.now() , modules : modules , page : page, action:actions ,select_id : $('#'+select_id).val() ,id : selID },function(data){			
										$('#'+FormModals+' .modal-content').html(data); 
										$('#'+FormModals).modal('show');
										return false;
									});
								 
								//code block
								break;
								
							/*case 'actionUpdate'  :
							  var FormModals  =  'FormModal' ;
							  $.get('./modules/'+modules+'/'+page+'_form.php' , { time : $.now() , modules : modules , page : page, action:actions , id : selID },function(data){			
										$('#'+FormModals+' .modal-content').html(data); 
										$('#'+FormModals).modal('show');
										return false;
									});
								break;*/
								
							case 'actionDelete':
							
								var FormModals  =  'FormModalDelete' ;
								
								$('#'+FormModals).modal('show');
								NProgress.done();		
								return false;
									
								break;
						}
						
							NProgress.done();		
						});
						
												
						// Action for Delete program by ID
						$('#actionDelete').click( function(){
							var selID = getSelID() ;	
						//	alert(page);
							$.post( "./modules/"+modules+"/"+page+"_code.php", { action: 'actionDelete', id: selID } , function( data ) {
										//$('#FormModalDelete').modal('hide');
										$.showNotify('success');
										//console.log(data);
										setTimeout("window.location.reload(true)",2000);		
									});
						
						});
							
			} // End function
			
			
/*****************************************************************************************/
// Main Action  on page
 $.MainActionOnPage= function(modules  ,page  ,select_id){
				
				$.initActionButton();
				
				$('input[type=search]').addClass('form-control input-sm');
				
				// เลือกเมนู
				$('#'+select_id).change(function(){
					window.location = '?modules='+modules+'&page='+page+'&'+select_id+'='+$(this).val();
				});
			
				var isSelected = select_id == '' ? '' : '&select_id='+$('#'+select_id).val();
				
				
				
				
				/*****************************************************************************************/
				// Button Create, Edit,Delete Action
				$("#btnCreate , #btnUpdate , #btnDelete").click( function() {	
						var actions  = $(this).attr('rel');
						//var selID  = $(this).attr('ref');
						var selID  = getSelID();
						
						NProgress.start();		
						
						switch(actions) {
							case 'actionCreate'  :
							window.location = '?modules='+modules+'&page='+page+'&form=keyin&action='+actions+isSelected;
							break;
							case  'actionUpdate' :
								//var FormModals  =  'FormModal' ;
								window.location = '?modules='+modules+'&page='+page+'&form=keyin&action='+actions+'&id='+selID;
								break;
								
								
							case 'actionDelete':
							
								var FormModals  =  'FormModalDelete' ;
								
								$('#'+FormModals).modal('show');
								NProgress.done();		
								return false;
									
								break;
						}
						
							NProgress.done();		
						});
						
												
						// Action for Delete program by ID
						$('#actionDelete').click( function(){
							var selID = getSelID() ;	
							
						//	alert(page);
							$.post( "./modules/"+modules+"/"+page+"_code.php", { action: 'actionDelete', id: selID } , function( data ) {
										//$('#FormModalDelete').modal('hide');
										$.showNotify('success');
										//console.log(data);
										setTimeout("window.location.reload(true)",2000);			
									});
						
						});
						
						// Event when click Cancel button go to back
						$('button[type=reset').click(function(){
								window.history.back(-1);
						});
						
			} // End function			


/*****************************************************************************************/
//debug = true , default = null

 $.FormAction = function(actions , modules  ,page , id , debug ){

	 $('#form_'+page).submit(function(event){
		 		
		NProgress.start();
		event.preventDefault(); // avoid to execute the actual submit of the form.
		
		 var request = $.ajax({
					type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
					url         : './modules/'+modules+'/'+page+'_code.php', // the url where we want to POST
					data        : $(this).serialize(), // our data object
					dataType    : 'html' // text, html, xml, json, jsonp, and script.
					});
									
					//Success
					request.done (function(textStatus){
								if(debug == true){
									console.log(textStatus);   
								}
								NProgress.done();
								if(textStatus == true){
									$.showNotify('success');
									//setTimeout("window.location.reload(true)",2000);
									setTimeout("window.location =  '"+RedirectURL+"' ",2000);		
								}else{
									$.showNotify('error');
								}
					});
									
					// Fail
					request.fail(function(textStatus ) {
								if(debug == true){
									console.log(textStatus);   
								}
								NProgress.done();   
								$.showNotify('error');				
					});
				
});
						
}



/*****************************************************************************************/

$.DataTableServSide = function(table_id ,modules  ,page , key1 , var1 ){
		
	 var table =  $('#'+table_id).DataTable( 
   {
        "processing": true,
        "serverSide": true,
		'bJQueryUI': true,
		'bStateSave': true,
		 'iDisplayLength' : 25,
		'sPaginationType': 'full_numbers',
		/*
		'lengthMenu': 'แสดง _MENU_ เรคคอร์ดต่อหน้า', 
		 'zeroRecords': 'ไม่พบข้อมูลที่ค้นหา', 
		'info': 'แสดงหน้าที่ _PAGE_ ถึง _PAGES_ ทั้งหมด _TOTAL_ เรคคอร์ด ',
		'sSearch': '<b>ค้นหา</b> :', 
		 'infoEmpty': 'ไม่พบข้อมูล',*/
	 'language': {
		
		 'sProcessing': '<img src=\"./images/loading-gear.gif\">',
		'oPaginate':{sFirst:'&laquo;',sLast:'&raquo;',sNext:'&#8250;',sPrevious:'&#8249;'}
		} ,		
		
        "ajax": "./modules/"+modules+"/"+page+"_ajax.php?"+$.now()+"&"+key1+"="+var1,
		'columnDefs': [{
         'targets': 0,
         'className': 'dt-body-center',		
         'render': function (data, type, full, meta){
             return '<input type="radio" name="id[]"  id="rowID_'+ $('<div/>').text(data).html() +'" value="'+ $('<div/>').text(data).html() +'">';
         }
      }]
    } );
	
	
	
  /*  $('#'+table_id+' tbody').on('click', 'tr', function () {
			var data = table.row( this ).data();
			$('#rowID_'+data[0]).prop( "checked", true );
			$("#hidRadio").val(data[0]);
			//console.log( data[0]);
    } );	*/		
	
}




/*****************************************************************************************/


$.DataTableMerg = function(table_id , target, Length , scrollY ,colspan ){
		
	 var table = $("#"+table_id).DataTable({
        "columnDefs": [
            { "visible": false, "targets": target }
        ],
        "order": [[ target, 'asc' ]],
		 "scrollY":        scrollY+"vh",
        "scrollCollapse": true,
        "displayLength": Length,		
		 'language': {
		 'lengthMenu': 'แสดง _MENU_ เรคคอร์ดต่อหน้า', 
		 'zeroRecords': 'ไม่พบข้อมูลที่ค้นหา', 
		'info': 'แสดงหน้าที่ _PAGE_ ถึง _PAGES_ ทั้งหมด _TOTAL_ เรคคอร์ด ',
		'sSearch': '<b>ค้นหา</b> :', 
		 'infoEmpty': 'ไม่พบข้อมูล',
		 'sProcessing': '<img src=\"./images/loading-gear.gif\">',
		 'infoFiltered': '(จากทั้งหมด _MAX_ เรคคอร์ด )',	
		'oPaginate':{sFirst:'&laquo;',sLast:'&raquo;',sNext:'&#8250;',sPrevious:'&#8249;'}
		} ,	
		
        "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
 
            api.column(target, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr class="group"><td colspan="'+colspan+'"><strong>'+group+'</strong></td></tr>'
                    );
 
                    last = group;
                }
            } );
        }
    } );
 

/*****************************************************************************************/

    // Order by the grouping
    $('#'+table_id+' tbody').on( 'click', 'tr.group', function () {
        var currentOrder = table.order()[0];
        if ( currentOrder[0] === target && currentOrder[1] === 'asc' ) {
            table.order( [ target, 'desc' ] ).draw();
        }
        else {
            table.order( [ target, 'asc' ] ).draw();
        }
    } );
}
	
	
 
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
/*****************************************************************************************/

// Function for check select radio 
$.initActionButton = function (){
	var $checkboxes = $('input[name=selID]');
	if($checkboxes.filter(':checked').length<=0){	// if not select set edit,delete button to Disable
		//$('#btnUpdate').attr("disabled", "disabled");
		//$('#btnDelete').attr("disabled", "disabled");
	}else{  // if  select > 0  set edit,delete button to remove Disable
		$('#btnUpdate').removeAttr('disabled'); 
		$('#btnDelete').removeAttr('disabled'); 
	}
}


// Function for Get selection data ID
function getSelID(){
	return $("#hidRadio").val();		
}





function showModalDelete(){
	var str =  "<div class='modal fade' id='FormModalDelete' tabindex='-1' role='dialog' aria-labelledby='ModalLabel' aria-hidden='true' data-keyboard='false' data-backdrop='static'>\n";
   str +=  " <div class='modal-dialog' role='document'>\n";
str +=  "      <div class='modal-content'>\n";	
str +=  "       <div class='modal-header'>\n";	
str +=  "       <button type='button' class='close' data-dismiss='modal' aria-label='Close'> <span aria-hidden='true'>&times;</span> </button>\n";	
str +=  "       <h4 class='modal-title' id='ModalLabel'>Confirm!</h4>\n";	
str +=  "       </div>\n";	
str +=  "       <div class='modal-body'>Do you want to delete?</div>\n";	
str +=  "       <div class='modal-footer'>\n";	
str +=  "       <button type='button' class='btn btn-default' data-dismiss='modal'><i class='fa fa-close'></i> Cancel</button>\n";	
str +=  "       <button type='button' class='btn btn-primary' id='actionDelete'><i class='fa fa-trash'></i> Delete</button>\n";	
str +=  "       </div>\n";	
str +=  "    </div>\n";	
str +=  "     </div>\n";	
str +=  "   </div>\n";	
//console.log(str);
$('#divMsg').html(str);

}

//#########################################################
// Check menu Auth
/*
function chkMenuAuth(status){
	if(status   == 'FALSE'){
		window.location = 'page_403.php';
	}
}*/
