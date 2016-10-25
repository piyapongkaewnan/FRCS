<?php

include("./includes/Class/DataTable.Class.php");
include("./includes/Class/Form.Class.php");

$tbl = new dataTable();
$tbl->id = ''.$_GET['page'];
//$tbl->title = title_menu($_GET['setPage']);
$tbl->menu = MENU_ACTION;
$tbl->module = $_GET['module'];
$tbl->page = $_GET['page'];
$tbl->order = 4;
//$tbl->orderType = "ASC";
//$tbl->pagingLength=2;

// List User Group
$sql_list = "SELECT
				  m.*,
				  i.icon_name
				FROM menu_group m
				  JOIN icons i
					ON m.icon_id = i.icon_id
				ORDER BY m.menu_order";
$rs_list =  $db ->GetAll($sql_list);

//$DirModule =  MainWeb::ScanDir( '../production/modules'); // path from top);
?>
<?=MainWeb::openTemplate();?> 
<?php  $tbl->openTable();  ?>
<div class="row">
  <div class="col-xs-4"></div>
  <div class="col-xs-8 text-right"><?=MENU_ACTION?></div>
</div>
<div style="height:3px"></div>
<!--<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="50%" align="left" valign="middle"></td>
    <td width="50%" align="right" valign="top"><? //=MENU_ACTION?></td>
  </tr>
<tr>
  <td align="left" valign="middle"></td>
  <td align="right" valign="top" style="height:5px"></td>
</tr>
</table>-->
        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table table-striped table-hover table-bordered compact dt-responsive" id="<?=$tbl->id;?>">
          <thead>
            <tr>
              <th width="5%"  class="header_height">Manage</th>
              <th width="18%" align="center">Menu Group TH</th>
              <th width="25%" align="center"> Menu Group EN</th>
              <th width="17%" align="center"> Module Name</th>
              <th width="9%" align="center">Order</th>
              <th width="10%" align="center"> Icons</th>
              <th width="16%" align="center">Update Time</th>
            </tr>
          </thead>
          <tbody >
            <?php for($i=0;$i<count($rs_list);$i++){ ?>
            <tr>
              <td align="center"><input type="radio" name="selID" id="selID_<?=$rs_list[$i]['mgroup_id']?>" value="<?=$rs_list[$i]['mgroup_id']?>"/></td>
              <td><?=$rs_list[$i]['menu_group_th']?></td>
              <td><?=$rs_list[$i]['menu_group_en']?></td>
              <td><?=$rs_list[$i]['module_name']?></td>
              <td align="center"><?=$rs_list[$i]['menu_order']?></td>
              <td align="center"><i class="<?=$rs_list[$i]['icon_name']?>"></i></td>
              <td align="center"><?=$rs_list[$i]['update_time'];?></td>
            </tr>
            <?php } // End For ?>
          </tbody>
</table>
        <?php //=Form::listComboBox($DirModule,'Profiles');

	$tbl->closeTable(); 
?>
        <input type="hidden" name="hidRadio" id="hidRadio" value="" />

<?=MainWeb::closeTemplate();?> 
<?=MainWeb::setModal();?> 
<?=MainWeb::setModalDelete();?> 


 <script src="./modules/<?=$Config['modules']?>/<?=$Config['page']?>.js"></script>
