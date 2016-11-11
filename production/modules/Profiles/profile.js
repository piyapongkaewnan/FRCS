// JavaScript Document
$(function () {

    // modules = module name
    // pages = page name
    // select_id = selection id
    //doAction

    var modules = $("#modules").val();

    var page = $("#page").val();

    //$.FormAction( 'edit' ,modules  ,page , null , false  );
    //  actions , modules  ,page , selected , debug , isCurrentPage
    $.FormAction('actionUpdate', modules, page, null, false, true);

    // Call function setPassSelect 
    setPassSelect();


    $('#isChange').click(function () {
        setPassSelect();
    });


    // Function for check change password select
    function setPassSelect() {
        if ($('#isChange').is(':checked')) {
            $('#password_hash').removeAttr("disabled");
            $('#re_password').removeAttr("disabled");
            $('#re_password').attr("required", "required");
            $('#password_hash').attr("required", "required");
            $('#re_password').attr("required", "required");
            $('#password_hash').attr("required", "required");
            //$('.divChange').show();

        } else {
            $('#password_hash').prop("disabled", "disabled");
            $('#re_password').prop("disabled", "disabled");
            $('#password_hash').removeAttr('required');
            $('#re_password').removeAttr('required');
            //$('.divChange').hide();
        }
    }

});

