// JavaScript Document
$(function () {

    // modules = module name
    // pages = page name
    // select_id = selection id
    // Get modules name
    var modules = $('#modules').val();

    // Get page name
    var page = $('#page').val();

    //form.js -> MainAction (modules  ,page  ,select_id) 
    $.MainAction(modules, page, 'mgroup_id');

    //datatable.custom.js ->(page  ,iDisplayLength  , aaSorting , orderType , bStateSave);
    $.MyDataTable(page, 20, 1, 'asc', true);

});

