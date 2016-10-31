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
$tbl->pagingLength=10;


// หาค่ากลุ่มผู้ใช้งาน  
$sql_usergroup = "SELECT * FROM user_group ORDER BY group_name";
$rs_usergroup = $db->GetAll($sql_usergroup);

//ถ้ามีการเลือกให้ where ตามค่าที่เลือก ถ้าไม่ ให้เอาค่า group_id มา where
$get_group = $_GET['group_id'] ? " ".$_GET['group_id'] : $rs_usergroup[0]['group_id'];


// List User 
/* $sql_list = "SELECT user_id ,username, passwords, emp_code, first_name, last_name, email, gender, telephone, prefix_id, position_id
				FROM tbl_users ";*/
				
// เงื่อนไขการแสดง
if($_GET['group_id'] && $_GET['group_id'] <> "All"){
	$str_query	= "WHERE b.group_id = $get_group";
}else{
	$str_query = "";
}
$sql_list = "SELECT
						  a.user_id,
						  a.username,
						  a.password_hash,
						  a.realname,
						  a.update_time,
						  a.email
				FROM user a
				  LEFT JOIN user_auth b
					ON a.user_id = b.user_id 
				$str_query
				GROUP BY a.user_id
				ORDER BY a.update_time DESC";				
$rs_list = $db->GetAll($sql_list);

$tbl->openTable();

?>
<?=MainWeb::openTemplate();?> 

<div class="row">
  <div class="col-xs-4">User Group :
<select name="group_id" id="group_id" class="form-group input-sm">
        <option value="All">All</option>
          <?=Form::genOptionSelect($rs_usergroup,'group_id','group_name',$_GET['group_id']); ?>          
        </select>
  </div>
  <div class="col-xs-8 text-right">
    <?=MENU_ACTION?>
  </div>
</div>

        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table table-striped table-hover table-bordered compact dt-responsive" id="<?=$tbl->id;?>">
  <thead>
    <tr>
      <th width="9%" class="no-sort">Action</th>
      <th width="21%">Username</th>
      <th width="26%">Real Name</th>
      <th width="25%">E-mail</th>
      <th width="19%">Update Time</th>
    </tr>
  </thead>
  <tbody>
    <?php for($i=0;$i<count($rs_list);$i++){ ?>
    <tr>
      <td align="center"><label>
          <input type="radio" name="selID" id="selID_<?=$rs_list[$i]['user_id']?>" value="<?=$rs_list[$i]['user_id']?>" />
        </label></td>
      <td><?=$rs_list[$i]['username']?></td>
      <td><?=$rs_list[$i]['realname']?></td>
      <td><?=$rs_list[$i]['email']?></td>
      <td align="center"><?=$rs_list[$i]['update_time'];?></td>
    </tr>
    <?php } // End for ?>
  </tbody>
</table>
<?php 
	$tbl->closeTable(); 
?>
<input type="hidden" name="hidRadio" id="hidRadio" value="" />
<?=MainWeb::closeTemplate();?> 
<?=MainWeb::setModal();?> 
<?=MainWeb::setModalDelete();?> 

<!-- Form Custom Core JS -->
<script type="text/javascript" src="js/form.js"></script>

<script  type="text/javascript" src="./modules/<?=$Config['modules']?>/<?=$Config['page']?>.js"></script> 