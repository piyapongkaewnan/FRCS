// JavaScript Document
$(function () {
// modules = module name
// page = page name
// select_id = selection id
    /*****************************************************************************************/
// Get modules name
    var modules = $('#modules').val();

// Get page name
    var page = $('#page').val();

// Set URL to Redirect back page
//var RedirectURL =  '?modules='+modules+'&page='+page;

    var RedirectURL = $('#pageRedirect').val();


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
    });

    /*****************************************************************************************/
// Init on check Radio  $('#TableID').on('click','.icon-trash',function () {...
    $(':checkbox[name^=selID]').on('change', function (e) {
        //$("#hidRadio").val($(this).val()) ;		
        $.initActionButton();
        //console.log(countChecked());
    });

// Event when click Cancel button go to back
    $("button[name='cancel']").click(function () {
        //alert('');
        //window.history.back(-1);
        window.location = RedirectURL;
    });

    /*****************************************************************************************/
// Main Action  
    $.MainAction = function (modules, page, select_id) {

        $.initActionButton();

        $('input[type=search]').addClass('form-control input-sm');

        // เลือกเมนู
        $('#' + select_id).change(function () {
            window.location = '?modules=' + modules + '&page=' + page + '&' + select_id + '=' + $(this).val();
        });

        var isSelected = select_id == '' ? '' : '&select_id=' + $('#' + select_id).val();

        /*****************************************************************************************/
        // Button Create, Edit,Delete Action
        $("#btnCreate , .btnUpdate2 , #btnDelete").click(function () {
            var actions = $(this).attr('rel');
            var selID = $(this).attr('id');//getSelID();

            NProgress.start();

            switch (actions) {
                case 'actionCreate'  :
                    window.location = '?modules=' + modules + '&page=' + page + '&form=keyin&action=' + actions + isSelected;
                    break;
                    /*	case  'actionUpdate' :
                     //var FormModals  =  'FormModal' ;
                     window.location = '?modules='+modules+'&page='+page+'&form=keyin&action='+actions+'&id='+selID+isSelected;
                     break;			*/

                case 'actionDelete':

                    //var FormModals = 'FormModalDelete';

                    $('#FormModalDelete').modal('show');
                    NProgress.done();
                   // return false;

                    break;
            }

            NProgress.done();
        });
        
        
        // Action for Delete program by ID
        $('#actionDelete').click(function () {

            var arrayData = Array();
            $("input:checkbox[name^=selID]:checked").each(function () { // Loop for checkbox is checked
                arrayData.push($(this).val());
            });

            // prepare data for send to delete 1,2,3
            selID = arrayData.join(",");

            //console.log(selID);
            $.post("./modules/" + modules + "/" + page + "_code.php", {action: 'actionDelete', id: selID}, function (data) {
                //$('#FormModalDelete').modal('hide');
                var countAction = data == '1' ? '1' : '0';
                if (countAction == '1') {
                    $.showNotify('success');
                } else {
                    $.showNotify('error');
                }
                //console.log(data);
                $('#FormModalDelete').modal('hide');
                setTimeout("window.location.reload(true)", 2000);

            });

        });

        // Action for Delete program by ID
        /*		$('#actionDelete').click( function(){
         var selID = getSelID() ;	
         
         //	alert(page);
         $.post( "./modules/"+modules+"/"+page+"_code.php", { action: 'actionDelete', id: selID } , function( data ) {
         //$('#FormModalDelete').modal('hide');
         $.showNotify('success');
         //console.log(data);
         setTimeout("window.location.reload(true)",2000);			
         });
         
         });*/

    }; // End function		 Main Action  

    /*****************************************************************************************/
//  Form Action //
//debug = true , default = null
// function(actions , modules  ,page , selected , debug , isCurrentPage ){

    $.FormAction = function (actions, modules, page, selected, debug, isCurrentPage) {

        $('#form_' + page).submit(function (event, redirect) {

            NProgress.start();
            event.preventDefault(); // avoid to execute the actual submit of the form.
            //$("button[type='submit']").addClass("disabled");
            $("button[type='submit']").prop("disabled", true);


            var request = $.ajax({
                type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
                url: './modules/' + modules + '/' + page + '_code.php', // the url where we want to POST
                data: $(this).serialize(), // our data object
                dataType: 'html' // text, html, xml, json, jsonp, and script.
            });

            //Success
            request.done(function (textStatus) {
                NProgress.done();

                if (debug == true) {
                    console.log(textStatus);
                    $("button[type='submit']").prop("disabled", false);
                    return false;
                }

                if (textStatus == true) {
                    $.showNotify('success');

                    //setTimeout("window.location =  '"+redirect+"' ",2000);										

                    //setTimeout("window.history.back(-1)",2000);	

                    // Check redirect			
                    if (isCurrentPage) { // if = true -> reload current page				
                        setTimeout("window.location.reload(true)", 2000);
                    } else { //  else = false -> reload current page

                        //setTimeout("window.history.back(-1)",2000);	
                        setTimeout("window.location = '" + RedirectURL + "'", 2000);
                    }

                } else {
                    $.showNotify('error');
                    $("button[type='submit']").prop("disabled", false);
                }
            });

            // Fail
            request.fail(function (textStatus) {
                if (debug == true) {
                    console.log(textStatus);
                }
                NProgress.done();
                $.showNotify('error');
            });

        });


    };
// Form Action //


    /*************************************************************************/
// try catch for checkbox event 
    /*$('input').on('ifChanged', function(event){  
     $.initActionButton();
     });*/

// Check All checkbox
    $(':checkbox[id=check-all]').click(function () {
        $(':checkbox[name^=selID]').prop('checked', this.checked);
        $.initActionButton();
    });


// on pagination change
    $('.data-table').on('draw.dt', function () {
        $.initActionButton();
    });


    /*************************************************************************/
// Function for check select checkbox 
    $.initActionButton = function () {
        var countCheckBox = $("input[name='selID[]']:checked").length;

        //	console.log(countCheckBox);

        //$('input[type=checkbox]').on('ifChecked', function(event){
        //	console.log(event.type + ' callback');
        if (countCheckBox > 0) {
            $('#btnDelete').removeAttr('disabled');
            //});
        } else {

            //$('input[type=checkbox]').on('ifUnchecked', function(event){
            //	console.log(event.type + ' callback');
            $("input[id='check-all']").prop("checked", false);
            $('#btnDelete').attr("disabled", "disabled");
            //});
        }
    };
    // Function for check select checkbox  

// Function for Get selection data ID
    function getSelID() {
        return $("#hidRadio").val();
    }


    function showModalDelete() {
        var str = "<div class='modal fade' id='FormModalDelete' tabindex='-1' role='dialog' aria-labelledby='ModalLabel' aria-hidden='true' data-keyboard='false' data-backdrop='static'>\n";
        str += " <div class='modal-dialog' role='document'>\n";
        str += "      <div class='modal-content'>\n";
        str += "       <div class='modal-header'>\n";
        str += "       <button type='button' class='close' data-dismiss='modal' aria-label='Close'> <span aria-hidden='true'>&times;</span> </button>\n";
        str += "       <h4 class='modal-title' id='ModalLabel'>Confirm!</h4>\n";
        str += "       </div>\n";
        str += "       <div class='modal-body'>Do you want to delete?</div>\n";
        str += "       <div class='modal-footer'>\n";
        str += "       <button type='button' class='btn btn-default' data-dismiss='modal'><i class='fa fa-close'></i> Cancel</button>\n";
        str += "       <button type='button' class='btn btn-primary' id='actionDelete'><i class='fa fa-trash'></i> Delete</button>\n";
        str += "       </div>\n";
        str += "    </div>\n";
        str += "     </div>\n";
        str += "   </div>\n";
        //console.log(str);
        $('#divMsg').html(str);
    }

});