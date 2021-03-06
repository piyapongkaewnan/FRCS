<?php
// List User Group
$sql_list = "SELECT   a.*,   b.FxName FROM country a  LEFT JOIN fx b  ON a.FxId = b.id ORDER BY a.CountryCode";
$rs_list = $db->GetAll($sql_list);

//$DirModule =  MainWeb::ScanDir( '../production/modules'); // path from top);
?>
<?= MainWeb::openTemplate(); ?>

<div class="row">
    <div class="col-xs-4"></div>
    <div class="col-xs-8 text-right">
        <?= MENU_ACTION ?>
    </div>
</div>
<div style="height:3px"></div>
<!--<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="50%" align="left" valign="middle"></td>
    <td width="50%" align="right" valign="top"><? //=MENU_ACTION ?></td>
  </tr>
<tr>
  <td align="left" valign="middle"></td>
  <td align="right" valign="top" style="height:5px"></td>
</tr>
</table>-->
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="data-table table-striped table-hover table-bordered"  id="table_<?= $Config['page'] ?>">
    <thead>
        <tr class="headings">
            <th width="5%"  class="no-sort text-center noExport"> <input type="checkbox" id="check-all" class="" /></th>
            <th width="12%" align="center">Country Code</th>
            <th width="37%" align="center"> Country Name</th>
            <th width="24%" align="center">FX Name</th>
            <th width="11%" align="center">Is Active</th>
            <th width="11%" class="no-sort noExport"> Action</th>
        </tr>
    </thead>
    <tbody >
        <?php for ($i = 0; $i < count($rs_list); $i++) { ?>
            <tr>
                <td align="center"><input type="checkbox" class="selCheckBox" name="selID[]" id="<?= $rs_list[$i]['id'] ?>" value="<?= $rs_list[$i]['id'] ?>"></td>
                <td align="center"><?= $rs_list[$i]['CountryCode'] ?></td>
                <td><?= $rs_list[$i]['CountryName'] ?></td>
                <td><?= $rs_list[$i]['FxName'] ?></td>
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
