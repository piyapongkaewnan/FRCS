$(function(){
// JavaScript Document



<!--- My Customize DataTable --> 
$.MyDataTable = function(tableID , bStateSave  ,iDisplayLength , iDisplayEnd , aaSorting , orderType){  

   if ($('#table_'+tableID).length) { 

	var table = $('#table_'+tableID).dataTable({
				//'bJQueryUI': true,
				'bStateSave': bStateSave, 
				'sPaginationType': 'full_numbers',
               'bPaginate': '1', 
               'iDisplayLength' : iDisplayLength ,
               'iDisplayStart': 0 ,
               'iDisplayEnd' :  iDisplayEnd ,
				'aaSorting': [[ aaSorting, "'"+orderType+'"']],
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


/*****************************************************************************************/
<!-- DataTableMerg -->

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
 
<!-- DataTableMerg -->


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


/*****************************************************************************************/



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





/*function turn_on_icheck(checkboxClass)
{
   
   
    $('input[type=checkbox]').iCheck({
        checkboxClass: checkboxClass
    });
}
$('.data-table').on('draw.dt', function () {
    turn_on_icheck('icheckbox_flat-green input flat');
});*/




});

