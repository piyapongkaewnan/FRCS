<?php

include("./includes/Class/DataTable.Class.php");

$tbl = new dataTable();
$tbl->id = ''.$_GET['page'];
//$tbl->title = title_menu($_GET['setPage']);
//$tbl->menu = MENU_ADD;//MENU_ACTION_PAGE;
$tbl->module = $_GET['module'];
$tbl->page = $_GET['page'];
$tbl->order = 1;
$tbl->saveState  = true;
//$tbl->orderType = "ASC";
$tbl->pagingLength=10;

// List User Group
$sql_list = "SELECT   a.*,   b.FxName FROM country a  LEFT JOIN fx b  ON a.FxId = b.id ORDER BY a.CountryCode";
$rs_list =  $db ->GetAll($sql_list);

//$DirModule =  MainWeb::ScanDir( '../production/modules'); // path from top);
?>
<?=MainWeb::openTemplate();?>
<?php  $tbl->openTable();  ?>

<div class="row">
  <div class="col-xs-4"></div>
  <div class="col-xs-8 text-right">
    <?=MENU_ACTION?>
  </div>
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
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="table  table-striped table-hover table-bordered compact dt-responsive" id="<?=$tbl->id;?>">
  <thead>
    <tr>
      <th width="12%" align="center" class="no-sort">Action</th>
      <th width="16%" align="center">Country Code</th>
      <th width="36%" align="center"> Country Name</th>
      <th width="24%" align="center">FX Name</th>
      <th width="12%" align="center">Is Active</th>
    </tr>
  </thead>
  <tbody >
    <?php for($i=0;$i<count($rs_list);$i++){ ?>
    <tr>
      <td align="center"><input type="radio" name="selID" id="selID_<?=$rs_list[$i]['id']?>" value="<?=$rs_list[$i]['id']?>"/></td>
      <td align="center"><?=$rs_list[$i]['CountryCode']?></td>
      <td><?=$rs_list[$i]['CountryName']?></td>
      <td><?=$rs_list[$i]['FxName']?></td>
      <td align="center"><?=$rs_list[$i]['IsActive']=="1" ? "YES" : "NO";?></td>
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

<!-- Form Custom Core JS -->
<script type="text/javascript" src="js/form.js"></script>

<script  type="text/javascript" src="./modules/<?=$Config['modules']?>/<?=$Config['page']?>.js"></script> 

