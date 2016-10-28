<?php
class dataTable{
	
	var $module;
	var $page;
	var $title;
	var $menu;
	var $id;
	var $order = 1;
	var $paging = true; // กำหนดค่ากำแสดง Paging true = แสดง / false = ซ่อน
	var $pagingLength = 25;  // กำหนดค่า Default ในการแสดงต่อหน้า
	var $pagingStart =0;		// กำหนดค่าเริ่มต้นการแสดง Pag
	var $pagingEnd =25;    // กำหนดค่าสิ้นสุดการแสดง
	var $orderType = "asc";
	var $saveState = false;
	var $dom = '<Bf<rt>pi>'; // กำหนดการจัดวางตำแหน่ง DOM

	function openTable(){
		echo "<style type='text/css' title='currentStyle'>\n";
		
		
		//echo "	@import '../vendors/datatables/media/css/jquery.dataTables.css';\n";
		/*echo "	@import './js/jquery.dataTables/css/jquery.dataTables_themeroller.css';\n";*/
		//echo "	@import '../vendors/datatables/media/css/dataTables.bootstrap.min.css';\n";
		echo "	@import '../vendors/datatables.net-bs/css/dataTables.bootstrap.css';\n";
		echo "	@import '../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css';\n";
		
		//echo "	@import './js/jquery.dataTables/css/dataTables.jqueryui.css';\n";
		//echo "	@import './js/jquery.dataTables/css/page.css';\n";
		echo "</style>\n";
		
		echo "<script type='text/javascript' src='../vendors/datatables/media/js/jquery.dataTables.min.js'></script>\n";			
		echo "<script type='text/javascript' src='../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js'></script>\n";			
		
		echo "<script type='text/javascript' src='../vendors/datatables.net-responsive/js/dataTables.responsive.min.js'></script>\n";	
	/*	echo "<script type='text/javascript' src='../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js'></script>\n";*/


		echo "<script type='text/javascript' src='../vendors/datatables.net-buttons/js/dataTables.buttons.min.js'></script>\n";			
		echo "<script type='text/javascript' src='../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js'></script>\n";			
		echo "<script type='text/javascript' src='../vendors/datatables.net-buttons/js/buttons.html5.min.js'></script>\n";			
		echo "<script type='text/javascript' src='../vendors/datatables.net-buttons/js/buttons.print.min.js'></script>\n";			
		
		
		echo "<script type='text/javascript' src='../vendors/jszip/dist/jszip.min.js'></script>\n";			
		echo "<script type='text/javascript' src='../vendors/pdfmake/build/pdfmake.min.js'></script>\n";			
		echo "<script type='text/javascript' src='../vendors/pdfmake/build/vfs_fonts.js'></script>\n";		
		
		echo "<script type='text/javascript'>\n";	
		echo "$(function(){";		
		echo "	var handleDataTableButtons = function() { \n";
		echo "   if ($('#".$this->id."').length) { \n";
		
		echo "	var oTable_".$this->id." = $('#".$this->id."').dataTable({\n";
		echo "				'bJQueryUI': true,\n";
		echo "				'bStateSave': '".$this->saveState."', \n";
		echo "				'sPaginationType': 'full_numbers',\n";
		//echo "				'sPaginationType': 'simple_numbers',\n";
		echo "               'bPaginate': '".$this->paging."', \n";
		echo "               'iDisplayLength' : ".$this->pagingLength." ,\n";
		echo "               'iDisplayStart': ".$this->pagingStart." ,\n";
		echo "               'iDisplayEnd' : ".$this->pagingEnd." ,\n";		
		echo "				'aaSorting': [[ ".$this->order.", '$this->orderType' ]],\n";
		echo "				'language': {\n";
		//echo "				    'lengthMenu': 'แสดง _MENU_ เรคคอร์ดต่อหน้า', \n";
		//echo "				    'zeroRecords': 'ไม่พบข้อมูลที่ค้นหา', \n";
		//echo "				     'info': 'แสดงหน้าที่ _PAGE_ ถึง _PAGES_ ทั้งหมด _TOTAL_ เรคคอร์ด', \n";
		//echo "				     'sSearch': '<b>ค้นหา</b> :', \n"; 
		//echo "				     'infoEmpty': 'ไม่พบข้อมูล', \n";
		//echo "				     'infoFiltered': '(จากทั้งหมด _MAX_ เรคคอร์ด )',\n";	
		echo "				     'sProcessing': '<img src=\"./images/loading-gear.gif\">',	\n";
		echo "				     'oPaginate':{sFirst:'&laquo;',sLast:'&raquo;',sNext:'&#8250;',sPrevious:'&#8249;'} \n";		
		echo "				} ,\n";
		
		//echo "			 dom: '<Bf<t><lpi>>',  \n";
		echo "			 dom: '$this->dom',  \n";
		echo "			 'columnDefs': [ {  \n";
        echo "			   'targets': 'no-sort',  \n";
        echo "			   'orderable': false,  \n";
    	echo "			 } ] ,  \n";
		echo "			     buttons: [ \n"; 
		echo "			         { \n";  
		echo "			           extend: 'copy', \n";
		echo "			           className: 'btn-sm' \n";
		echo "			         }, \n";
		echo "			         { \n";
		echo "			           extend: 'csv', \n";
		echo "			            className: 'btn-sm' \n";
		echo "			          }, \n";
		echo "			         { \n";
		echo "			           extend: 'excel', \n";
		echo "			           className: 'btn-sm' \n";
		echo "			         }, \n";
		echo "			         { \n";
		echo "			            extend: 'pdfHtml5', \n";
		echo "			            className: 'btn-sm' \n";
		echo "			          }, \n";
		echo "			           { \n";
		echo "			             extend: 'print', \n";
		echo "			             className: 'btn-sm' \n";
		echo "			           } \n";
	/*	echo " {\n";
       echo "         text: 'Create', \n";
	   echo "			             className: 'btn-xs' ,\n";
        echo "        action: function ( e, dt, node, config ) {";
      echo "          },\n";
      echo "      }\n";*/
		echo "			          ], \n";
		echo "			          responsive: true \n";
		echo " 				}); \n";
		echo "   			} \n";
		echo "	   };\n";
		
		
		echo "TableManageButtons = function() {\n";
		
		echo "  return {\n";
		echo "    init: function() {\n";
		echo "      handleDataTableButtons();\n";
		echo "     }\n";
		echo "    };\n";
		echo "  }();\n";
		
		echo "	 TableManageButtons.init();\n";
	
		echo "});\n";
		echo "</script>\n";
		//echo "	<div id='container'>\n";
		//echo "	<div class='pages_jui'>\n";		
} // End function";


	function openTable1(){
		
		/*	echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'>";
			echo "  <tr>";
			echo "  <td align='right' colspan='2'  valign='top'>".$this->menu."</td>";
			//echo "  <td align='left' valign='middle' height='20'><div class='txt_header' id='menuTitle'> <b>".$this->title."</b></div></td>";
			echo "  </tr>";
			echo "  <tr>";
			echo "  <td colspan='2' align='left' valign='middle' style='height:3px'></td>";
			echo "  </tr>";
			echo "  <tr>";
			echo "  <td colspan='2' align='left' valign='middle'>";*/			
		//	$this->openTemplate();			
			//echo "<div id='data_detail'>";
	} // End Function
			
	function closeTable1(){		
			//echo "     </div>";			
			//$this->closeTemplate();			
			/*echo "</td>";
			echo "  </tr>";
			echo "</table>";*/
	} // End Function


	function closeTable(){		
	//  	echo "</div>\n";
	  	//echo "<div></div>\n";
	//	echo "</div>\n";	
	} // End function
	
}// End Class
?>