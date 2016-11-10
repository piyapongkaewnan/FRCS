$(function () {
    $("#tabs").tabs();

    var modules = "Admin";
    var pages = "web_stats";

    /*
     $.get("./modules/Admin/web_stats_by_date.php" ,{ setModule : modules , setPage :pages} , function(data){
     $("#tabs-1").html(data);
     });
     
     
     $("#tab-1").click(function(){		
     $.get("./modules/Admin/web_stats_by_date.php" ,{ setModule : modules , setPage :pages} , function(data){
     $("#tabs-1").html(data);
     });
     });
     
     $("#tab-2").click(function(){		
     $.get("./modules/Admin/web_stats_by_users.php" ,{ setModule : modules , setPage :pages} , function(data){
     $("#tabs-2").html(data);
     });
     });
     
     $("#tab-3").click(function(){		
     $.get("./modules/Admin/web_stats_by_menu.php" ,{ setModule : modules , setPage :pages} , function(data){
     $("#tabs-3").html(data);
     });
     });*/

    $.loading("load");

    $.get("./modules/Admin/web_stats_by_date.php", {setModule: modules, setPage: pages}, function (data) {
        $("#tabs-1").html(data);
    })
            .always(function (data) {
                $.loading("unload");
            });



    $("#tab-1").click(function () {

        $.loading("load");

        $.get("./modules/Admin/web_stats_by_date.php", {setModule: modules, setPage: pages}, function (data) {
            $("#tabs-1").html(data);
        })
                .always(function (data) {
                    $.loading("unload");
                });

    });


    $("#tab-2").click(function () {

        $.loading("load");

        $.get("./modules/Admin/web_stats_by_users.php", {setModule: modules, setPage: pages}, function (data) {
            $("#tabs-2").html(data);
        })
                .always(function (data) {
                    $.loading("unload");
                });

    });

    $("#tab-3").click(function () {

        $("body").addClass("loading");

        $.get("./modules/Admin/web_stats_by_menu.php", {setModule: modules, setPage: pages}, function (data) {
            $("#tabs-3").html(data);
        })
                .always(function (data) {
                    $.loading("unload");
                });

    });


});
