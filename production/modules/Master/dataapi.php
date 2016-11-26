<?php
// List User Group
$sql_list = "SELECT
                    a.*,
                    b.type
           FROM dataapi a
             JOIN datasourcetype b
                   ON a.DataSourceType = b.id
           ORDER BY a.APIRefCode";
$rs_list = $db->GetAll($sql_list);
?>
<?= MainWeb::openTemplate(); ?>

<div class="row">
    <div class="col-xs-12 text-right">
        <?= MENU_ACTION ?>
    </div>
</div>
<div style="height:3px"></div>

<table width="100%" border="0" cellpadding="0" cellspacing="0" class="table-striped table-bordered table-hover"  id="table_<?= $Config['page'] ?>">
    <thead>
        <tr>
            <th class="no-sort text-center noExport"><input type="checkbox" id="check-all" class=""></th>
            <th>APIRefCode</th>
            <th>APIName</th>
            <th>APIUrl</th>
            <th>UserName</th>
            <th> Password</th>
            <th>DataSourceType</th>
            <th>Is Active</th>
            <th class="no-sort noExport"> Action</th>
        </tr>
    </thead>
    <tbody>
        <?php for ($i = 0; $i < count($rs_list); $i++) { ?>
            <tr>
                <td align="center"><input type="checkbox" class="selCheckBox" name="selID[]" id="<?= $rs_list[$i]['id'] ?>" value="<?= $rs_list[$i]['id'] ?>"></td>
                <td align="center"><?= $rs_list[$i]['APIRefCode'] ?></td>
                <td><?= $rs_list[$i]['APIName'] ?></td>
                <td title="<?= $rs_list[$i]['APIUrl'] ?>"><?= MainWeb::subString($rs_list[$i]['APIUrl'], 30) ?></td>
                <td><?= $rs_list[$i]['UserName'] ?></td>
                <td><?= $rs_list[$i]['Password'] ?></td>
                <td><?= $rs_list[$i]['type'] ?></td>
                <td align="center"><?= $rs_list[$i]['IsActive'] == "1" ? "YES" : "NO"; ?></td>
                <td align="center"><?= MainWeb::doUpdateParam('keyin', $rs_list[$i]['id']) ?></td>
            </tr>
        <?php } // End For  ?>
    </tbody>
</table>
<input type="hidden" name="hidRadio" id="hidRadio" value="" />
<?= MainWeb::closeTemplate(); ?>
<?= MainWeb::setModalDelete(); ?>
<script  type="text/javascript" src="./modules/<?= $Config['modules'] ?>/<?= $Config['page'] ?>.js"></script> 