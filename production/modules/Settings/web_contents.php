<?php
// Title Menu from function.php
$tbl = new dataTable();
$tbl->id = $_GET['setPage'];
$tbl->title = title_menu($_GET['setPage']);
$tbl->menu = MENU_ACTION;
$tbl->module = $_GET['setModule'];
$tbl->page = $_GET['setPage'];
$tbl->order = 3;
$tbl->orderType = "desc";
$tbl->openTable();

// List Menu Group
$sql_list = "SELECT
                    *
            FROM tbl_contents
            ORDER BY update_time  DESC ";
$rs_list = $db->GetAll($sql_list);
?>
<script type="text/javascript" src="./modules/<?= $_GET['setModule'] ?>/<?= $_GET['setPage'] ?>.js"></script>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="display compact" id="<?= $tbl->id; ?>">
    <thead>
        <tr>
            <th width="9%"  class="header_height">จัดการ</th>
            <th width="32%">ชื่อเนื้อหา</th>
            <th width="25%">ปรับปรุงล่าสุดโดย</th>
            <th width="21%">วันที่ปรับปรุงแก้ไข</th>
            <th width="13%">แสดง</th>
        </tr>
    </thead>
    <tbody>
<?php for ($i = 0; $i < count($rs_list); $i++) { ?>
            <tr>
                <td align="center"><input type="radio" name="selID" id="selID_<?= $rs_list[$i]['id'] ?>" value="<?= $rs_list[$i]['id'] ?>" <?= $i == 0 ? 'checked' : '' ?>/></td>
                <td><?= $rs_list[$i]['content_name'] ?></td>
                <td align="center"><?= $rs_list[$i]['update_by'] ?></td>
                <td align="center"><?= $rs_list[$i]['update_time']; ?></td>
                <td align="center"><button name="preview" class="preview" value="<?= $rs_list[$i]['content_name'] ?>">View</button></td>
            </tr>
<?php } // End For  ?>
    </tbody>
</table>
<?php
$tbl->closeTable();
?>
<div id="dialog-form-<?= $tbl->page; ?>"  style="display:none"></div>
<div id="dialog-confirm" title="Comfirm!!">ยืนยันการลบข้อมูล ?</div>
<input type="hidden" name="hidRadio" id="hidRadio" value="<?= $rs_list[0]['id'] ?>" />
<input type="hidden" name="setModule" id="setModule" value="<?= $_GET['setModule'] ?>" />
<input type="hidden" name="setPage" id="setPage" value="<?= $_GET['setPage'] ?>" />
<input type="hidden" name="setTitle" id="setTitle" value="<?= $tbl->title ?>" />
<div id="test"></div>