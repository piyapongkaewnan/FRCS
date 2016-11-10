<?php
// List User Group
$sql_list = "SELECT * FROM user_group ORDER BY update_time DESC ";
$rs_list = $db->GetAll($sql_list);
?>
<?= MainWeb::openTemplate(); ?>

<div class="row">
    <div class="col-xs-4"></div>
    <div class="col-xs-8 text-right">
<?= MENU_ACTION ?>
    </div>
</div>
<div style="height:3px"></div>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="table-striped table-hover table-bordered"  id="table_<?= $Config['page'] ?>">
    <thead>
        <tr>
            <th width="5%"  class="no-sort text-center"> <input type="checkbox" id="check-all" class="" /></th>
            <th width="30%" align="center">User Group Name</th>
            <th width="38%" align="center">User Group Description</th>
            <th width="18%" align="center">Update Time</th>
            <th width="9%" class="no-sort"> Action</th>
        </tr>
    </thead>
    <tbody>
<?php for ($i = 0; $i < count($rs_list); $i++) { ?>
            <tr>
                <td align="center"><input type="checkbox" class="selCheckBox" name="selID[]" id="<?= $rs_list[$i]['group_id'] ?>" value="<?= $rs_list[$i]['group_id'] ?>"></td>
                <td><a href="?modules=<?= $Config['modules'] ?>&page=users&group_id=<?= $rs_list[$i]['group_id'] ?>">
    <?= $rs_list[$i]['group_name'] ?>
                    </a></td>
                <td><?= $rs_list[$i]['group_desc'] ?></td>
                <td align="center"><?= $rs_list[$i]['update_time']; ?></td>
                <td align="center"><a href="<?= MainWeb::getURI() ?>&form=keyin&action=actionUpdate&id=<?= $rs_list[$i]['group_id'] ?>" class="btn btn-xs btn-info btnUpdate" >Edit</a></td>
            </tr>
<?php } // End For  ?>
    </tbody>
</table>
<input type="hidden" name="hidRadio" id="hidRadio" value="" />
<?= MainWeb::closeTemplate(); ?>
<?= MainWeb::setModal(); ?>
<?= MainWeb::setModalDelete(); ?>
<script  type="text/javascript" src="./modules/<?= $Config['modules'] ?>/<?= $Config['page'] ?>.js"></script> 