<?php

include("./includes/Class/DataTable.Class.php");
include("./includes/Class/Form.Class.php");

$tbl = new dataTable();
$tbl->id = ''.$_GET['page'];
//$tbl->title = title_menu($_GET['setPage']);
$tbl->menu = MENU_ACTION;
$tbl->module = $_GET['module'];
$tbl->page = $_GET['page'];
$tbl->order = 1;
//$tbl->orderType = "ASC";
//$tbl->pagingLength=2;

// List User Group
$sql_list = "SELECT *
				FROM user_group ORDER BY update_time DESC ";
$rs_list = $db->GetAll($sql_list);

?>
<?=MainWeb::openTemplate();?> 
<?php  $tbl->openTable();  ?>
<div class="row">
  <div class="col-xs-4"></div>
  <div class="col-xs-8 text-right"><?=MENU_ACTION?></div>
</div>
<div style="height:3px"></div>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="table table-striped table-hover table-bordered compact dt-responsive compact" id="<?=$tbl->id;?>">
  <thead>
    <tr>
      <th width="8%" class="no-sort">Action</th>
      <th width="37%" align="center">User Group Name</th>
      <th width="34%" align="center">User Group Description</th>
      <th width="21%" align="center">Update Time</th>
    </tr>
  </thead>
  <tbody>
         <?php for($i=0;$i<count($rs_list);$i++){ ?>
            <tr>
              <td align="center"> <input type="radio" name="selID" id="selID_<?=$rs_list[$i]['group_id']?>" value="<?=$rs_list[$i]['group_id']?>"/></td>
              <td><a href="?modules=<?=$Config['modules']?>&page=users&group_id=<?=$rs_list[$i]['group_id']?>"><?=$rs_list[$i]['group_name']?></a></td>
              <td><?=$rs_list[$i]['group_desc']?></td>
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

<!-- Form Custom Core JS -->
<script type="text/javascript" src="js/form.js"></script>

<script  type="text/javascript" src="./modules/<?=$Config['modules']?>/<?=$Config['page']?>.js"></script> 