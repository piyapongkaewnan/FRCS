<?php
// Title Menu from function.php
require_once("../../includes/config.inc.php");
require_once("../../includes/Class/DataTable.Class.php");

$tbl = new dataTable();
$tbl->id = $_GET['setPage'];
$tbl->title = title_menu($_GET['setPage']);
//$tbl->menu = MENU_ACTION;
$tbl->module = $_GET['setModule'];
$tbl->page = $_GET['setPage'];
$tbl->order = 0;
$tbl->orderType = "desc";

$tbl->id = "table_3";

     // List Menu Group
$sql_list = "SELECT
					 *
				FROM 02_view_stats_by_events	  ";
$rs_list = $db->GetAll($sql_list);

$tbl->openTemplate();
  ?>
   <table width="100%" border="0" cellpadding="0" cellspacing="0" class="display compact" id="<?=$tbl->id?>">
      <thead>
        <tr>
          <th width="14%">Event Date</th>
          <th width="23%">User</th>
          <th width="27%">Menu</th>
          <th width="20%">IP Address</th>
          <th width="16%">Hits</th>
        </tr>
      </thead>
      <tbody>
        <?php for($i=0;$i<count($rs_list);$i++){ ?>
        <tr>
          <td align="center"><?=$rs_list[$i]['event_date']?></td>
          <td><?=$rs_list[$i]['users']?></td>
          <td><?=$rs_list[$i]['event_page']?></td>
          <td><?=$rs_list[$i]['ip_address']?></td>
          <td align="center"><?=$rs_list[$i]['counts']?></td>
        </tr>
        <?php } // End For ?>
      </tbody>
    </table>
<?php
$tbl->closeTemplate();
?>