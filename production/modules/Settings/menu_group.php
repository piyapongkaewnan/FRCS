<?php

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

<div class="row">
  <div class="col-xs-4"></div>
  <div class="col-xs-8 text-right">
    <?=MENU_ACTION?>
  </div>
</div>
<div style="height:3px"></div>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="table table-striped table-hover table-bordered compact dt-responsive  bulk_action data-table" id="table_<?=$Config['page']?>">
  <thead>
    <tr class="headings">
      <th width="5%"  class="no-sort text-center"> <input type="checkbox" id="check-all" class="" /></th>
      <th width="18%"> Menu Group EN</th>
      <th width="19%">Menu Group TH</th>
      <th width="16%"> Module Name</th>
      <th width="9%">Order</th>
      <th width="10%"> Icons</th>
      <th width="14%">Update Time</th>
      <th width="9%" class="no-sort"> Action</th>
    </tr>
 <!-- <th class="bulk-actions" colspan="8"> <a class="antoo" style="color:#333; font-weight:500;"><i class="fa fa-chevron-down"></i> Bulk Actions ( <span class="action-cnt"> </span> ) </a> </th>-->
      </thead>
  <tbody >
    <?php for($i=0;$i<count($rs_list);$i++){ ?>
    <tr>
      <td align="center"><input type="checkbox" class="selCheckBox" name="selID[]" id="<?=$rs_list[$i]['mgroup_id']?>" value="<?=$rs_list[$i]['mgroup_id']?>"></td>
      <td><a href='?modules=<?=$Config['modules']?>&page=menu&mgroup_id=<?=$rs_list[$i]['mgroup_id']?>'><?=$rs_list[$i]['menu_group_en']?></a></td>
      <td><?=$rs_list[$i]['menu_group_th']?></td>
      <td><?=$rs_list[$i]['module_name']?></td>
      <td align="center"><?=$rs_list[$i]['menu_order']?></td>
      <td align="center"><i class="<?=$rs_list[$i]['icon_name']?>"></i></td>
      <td align="center"><?=$rs_list[$i]['update_time'];?></td>
      <td align="center"><a href="javascript:void(0);" class="btn btn-xs btn-info btnUpdate" rel="actionUpdate" id="<?=$rs_list[$i]['mgroup_id']?>">Edit</a></td>
    </tr>
    <?php } // End For ?>
  </tbody>
</table>
<!--</div>-->
<input type="hidden" name="hidRadio" id="hidRadio" value="" />
<?=MainWeb::closeTemplate();?>
<?=MainWeb::setModal();?>
<?=MainWeb::setModalDelete();?>
<!-- Form Custom Core JS --> 
<script  type="text/javascript" src="./modules/<?=$Config['modules']?>/<?=$Config['page']?>.js"></script> 
