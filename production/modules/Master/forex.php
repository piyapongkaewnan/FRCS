<?php

include("./includes/Class/DataTable.Class.php");

$tbl = new dataTable();
$tbl->id = ''.$_GET['page'];
//$tbl->title = title_menu($_GET['setPage']);
$tbl->menu = MENU_ADD;//MENU_ACTION_PAGE;
$tbl->module = $_GET['module'];
$tbl->page = $_GET['page'];
$tbl->order = 4;
//$tbl->orderType = "ASC";
$tbl->pagingLength=1;

// List User Group
$sql_list = "SELECT * FROM fx";
$rs_list =  $db ->GetAll($sql_list);

//$DirModule =  MainWeb::ScanDir( '../production/modules'); // path from top);
?>
<?=MainWeb::openTemplate();?>
<?php  $tbl->openTable();  ?>

<div class="row">
  <div class="col-xs-4"></div>
  <div class="col-xs-8 text-right">
    <?=MENU_ADD?>
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
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="table table-striped table-hover table-bordered compact dt-responsive" id="<?=$tbl->id;?>">
  <thead>
    <tr>
      <th width="16%" align="center">FX Code</th>
      <th width="15%" align="center"> FX Symbol</th>
      <th width="34%" align="center">FX Name</th>
      <th width="15%" align="center"> Rate To Base</th>
      <th width="13%" align="center">Is Active</th>
      <th width="7%"  class="header_height">Manage</th>
    </tr>
  </thead>
  <tbody >
    <?php for($i=0;$i<count($rs_list);$i++){ ?>
    <tr>
      <td><?=$rs_list[$i]['FXCode']?></td>
      <td><?=$rs_list[$i]['FXSymbol']?></td>
      <td><?=$rs_list[$i]['FxName']?></td>
      <td align="center"><?=$rs_list[$i]['RateToBase']?></td>
      <td align="center"><?=$rs_list[$i]['IsActive'];?></td>
      <td align="center"><i class="fa fa-save" id="btnUpdate"  rel='actionUpdate' ref="<?=$rs_list[$i]['id']?>"></i> | <i class="fa fa-trash" id="btnDelete"  rel='actionDelete' ref="<?=$rs_list[$i]['id']?>"></i><!--<input type="radio" name="selID" id="selID_<?=$rs_list[$i]['id']?>" value="<?=$rs_list[$i]['id']?>"/>--></td>
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
