<?php
// หาค่ากลุ่มเมนู
$sql_mgroup = "SELECT * FROM menu_group ORDER BY  menu_group_en";
$rs_mgroup = $db->GetAll($sql_mgroup);

//ถ้ามีการเลือกให้ where ตามค่าที่เลือก ถ้าไม่ ให้เอาค่า mgroup_id มา where
$get_mgroup = $_GET['mgroup_id'] ? " " . $_GET['mgroup_id'] : $rs_mgroup[0]['mgroup_id'];

// List Menu Group
$sql_list = "SELECT
                    a.menu_id,
                    a.menu_name_en,
                    a.menu_desc,
                    a.menu_file,
                     a.menu_param,
                    a.mgroup_id,
                    a.menu_id,
                    a.menu_order,
                    a.icon_id,
                    a.is_active,
                    b.icon_name
            FROM menu AS a
                    LEFT JOIN icons b
                      ON a.icon_id = b.icon_id
            WHERE a.mgroup_id = $get_mgroup
            ORDER BY a.menu_order  ";
$rs_list = $db->GetAll($sql_list);
?>
<?= MainWeb::openTemplate(); ?> 

<div class="row">
    <div class="col-xs-4">Menu Group :
        <select name="mgroup_id" id="mgroup_id" class="form-group input-sm">
            <?= Form::genOptionSelect($rs_mgroup, 'mgroup_id', 'menu_group_en', $_GET['mgroup_id']); ?>
        </select>
    </div>
    <div class="col-xs-8 text-right">
        <?= MENU_ACTION ?>
    </div>
</div>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="table-striped table-hover table-bordered"  id="table_<?= $Config['page'] ?>">
    <thead>
        <tr class="headings">
            <th width="7%"  class="no-sort text-center"> <input type="checkbox" id="check-all" class="" /></th>
            <th width="7%"> Order</th>
<!--            <th width="13%">Menu name (TH)</th>-->
            <th width="20%">Menu name</th>
            <th width="30%">Menu Description</th>
            <th width="12%">Menu File</th>
            <th width="9%">Is Active</th>
            <th width="8%">Icons</th>
            <th width="8%" class="no-sort"> Action</th>
        </tr>
    </thead>
    <tbody>
        <?php for ($i = 0; $i < count($rs_list); $i++) { ?>
            <tr>
                <td align="center" valign="top"><input type="checkbox" class="selCheckBox" name="selID[]" id="<?= $rs_list[$i]['menu_id'] ?>" value="<?= $rs_list[$i]['menu_id'] ?>"></td>
                <td align="center" valign="top"><?= $rs_list[$i]['menu_order'] ?></td>
    <!--                <td valign="top"><?= $rs_list[$i]['menu_name_th'] ?></td>-->
                <td valign="top"><?= $rs_list[$i]['menu_name_en'] ?></td>
                <td valign="top"><?= $rs_list[$i]['menu_desc'] ?></td>
                <td valign="top"><?= $rs_list[$i]['menu_file'] ?></td>
                <td align="center" valign="top"><?= $rs_list[$i]['is_active'] == "1" ? "YES" : "NO"; ?></td>
                <td align="center" valign="top"><i class ="<?= $rs_list[$i]['icon_name'] ?>"></i></td>
                <td align="center"><?= MainWeb::doUpdateParam('keyin', $rs_list[$i]['menu_id']) ?></td>
            </tr>
        <?php } // End For  ?>
    </tbody>
</table>

<input type="hidden" name="hidRadio" id="hidRadio" value="" />
<?= MainWeb::closeTemplate(); ?> 
<?= MainWeb::setModalDelete(); ?> 
<script  type="text/javascript" src="./modules/<?= $Config['modules'] ?>/<?= $Config['page'] ?>.js"></script> 
