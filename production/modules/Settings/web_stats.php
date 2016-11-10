<?php
// Title Menu from function.php

$tbl = new dataTable();
$tbl->id = $_GET['setPage'];
$tbl->title = title_menu($_GET['setPage']);
//$tbl->menu = MENU_ACTION;
$tbl->module = $_GET['setModule'];
$tbl->page = $_GET['setPage'];
$tbl->order = 0;

$tbl->openTable();
?>
<script type="text/javascript" src="./modules/<?= $_GET['setModule'] ?>/<?= $_GET['setPage'] ?>.js"></script>

<div id="tabs">
    <ul>
        <li><a href="#tabs-1" id="tab-1">สถิติตามรายวัน</a></li>
        <li><a href="#tabs-2" id="tab-2">สถิติตามตามผู้ใช้งาน</a></li>
        <li><a href="#tabs-3" id="tab-3">สถิติตามการใช้งานโปรแกรม</a></li>
    </ul>
    <div id="tabs-1"></div>  
    <div id="tabs-2"></div>
    <div id="tabs-3"></div>
</div>
<?php
$tbl->closeTable();
?>
