<?php
// List User Group
$sql_list = "SELECT * FROM fx";
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
        <tr class="headings">
            <th width="5%"  class="no-sort text-center">&nbsp;<input type="checkbox" id="check-all" class="" />&nbsp;</th>
            <th width="12%" align="center">FX Code</th>
            <th width="13%" align="center"> FX Symbol</th>
            <th width="35%" align="center">FX Name</th>
            <th width="14%" align="center"> Rate To Base</th>
            <th width="13%" align="center">Is Active</th>
            <th width="8%" class="no-sort"> Action</th>
        </tr>
    </thead>
    <tbody >
        <?php for ($i = 0; $i < count($rs_list); $i++) { ?>
            <tr>
                <td align="center"><input type="checkbox" class="selCheckBox" name="selID[]" id="<?= $rs_list[$i]['id'] ?>" value="<?= $rs_list[$i]['id'] ?>"></td>
                <td align="center"><?= $rs_list[$i]['FXCode'] ?></td>
                <td align="center"><?= $rs_list[$i]['FXSymbol'] ?></td>
                <td><?= $rs_list[$i]['FxName'] ?></td>
                <td align="right"><?= number_format($rs_list[$i]['RateToBase'], 8) ?></td>
                <td align="center"><?= $rs_list[$i]['IsActive'] == "1" ? "YES" : "NO"; ?></td>
                <td align="center"><a href="<?= MainWeb::getURI() ?>&form=keyin&action=actionUpdate&id=<?= $rs_list[$i]['id'] ?>" class="btn btn-xs btn-info btnUpdate" >Edit</a></td>
            </tr>
        <?php } // End For   ?>
    </tbody>
</table>
<?= MainWeb::closeTemplate(); ?>
<?= MainWeb::setModalDelete(); ?>
<script  type="text/javascript" src="./modules/<?= $Config['modules'] ?>/<?= $Config['page'] ?>.js"></script> 