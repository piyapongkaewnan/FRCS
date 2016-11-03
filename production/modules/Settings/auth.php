<?php
include("./includes/Class/DataTable.Class.php");


$tbl = new dataTable();
$tbl->id = ''.$_GET['page'];
//$tbl->title = title_menu($_GET['setPage']);
$tbl->menu = MENU_ACTION;
$tbl->module = $_GET['module'];
$tbl->page = $_GET['page'];
$tbl->order = 0;
//$tbl->orderType = "ASC";
$tbl->pagingLength=100;
$tbl->dom = 'tB';

// หาค่ากลุ่มเมนู
$sql_group = "SELECT * FROM user_group ORDER BY group_name";
$rs_group = $db->GetAll($sql_group);

//ถ้ามีการเลือกให้ where ตามค่าที่เลือก ถ้าไม่ ให้เอาค่า mgroup_id มา where
$get_mgroup = $_GET['group_id'] ? " ".$_GET['group_id'] : $rs_group[0]['group_id'];


// หาสิทธิ์การเข้าใ้ช้งานเมนูตามเงื่อนไข
$sql_menu_auth = "SELECT menu_id FROM menu_auth WHERE group_id = $get_mgroup";
$rs_menu_auth = $db->GetAll($sql_menu_auth);
for($a=0;$a<count($rs_menu_auth);$a++){
	$Arr_menu_auth[] = $rs_menu_auth[$a]['menu_id'];
}

$tbl->openTable();

?>
<?=MainWeb::openTemplate();?>

<form  data-parsley-validate name="form_<?=$_GET['page']?>" id="form_<?=$_GET['page']?>" method="post">
  <div class="row">
    <div class="col-xs-4">User Group :
      <select name="group_id" id="group_id" class="form-group input-sm">
        <?=Form::genOptionSelect($rs_group,'group_id','group_name',$_GET['group_id']);?>
      </select>
    </div>
    <div class="col-xs-8 text-right">
      <?=MENU_SAVE_ONLY?>
    </div>
  </div>
  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table table-striped table-hover compact dt-responsive" id="<?=$tbl->id;?>">
    <thead>
      <tr>
        <th width="8%">No.</th>
        <th width="72%">Menu Name</th>
        <th width="20%">Authorize</th>
      </tr>
    </thead>
    <tbody>
      <?php
  
  		// หาเมนูหลัก
  		  $sql_gmemu = "SELECT
											 mgroup_id,
											 menu_group_en
										FROM menu_group
										ORDER BY menu_order";
			$rs_gmenu = $db->GetAll($sql_gmemu);
			
			$loop=1;
			for($i=0;$i<count($rs_gmenu);$i++){// Loop menu group
  ?>
      <tr class="warning">
        <td align="center"><?=$loop?></td>
        <td><u><b>
          <?=$rs_gmenu[$i]['menu_group_en']?>
          </b></u></td>
        <td align="center"></td>
      </tr>
      <?php
			// หาเมนูย่อย
			$mgroup_id = $rs_gmenu[$i]['mgroup_id'];
			$sql_menu =  "SELECT
												 menu_id,
												 menu_name_en,
												 mgroup_id
											FROM menu
											WHERE mgroup_id = $mgroup_id
											ORDER BY menu_order";
				$rs_menu = $db->GetAll($sql_menu);
				
				for($j=0;$j<count($rs_menu);$j++){ // Loop Sub menu	
						$loop++;							
					
					// ตรวจสอบสถานะสิทธิ์การใช้งาน Checked
					$chk_menu_id = $rs_menu[$j]['menu_id'];
					 if(@in_array($chk_menu_id ,$Arr_menu_auth)){
						$chk_status = "checked";
					}else{
						$chk_status = "";
					}//  End ===
					
						
			?>
      <tr>
        <td align="center"><?=$loop?></td>
        <td>&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-
          <?=$rs_menu[$j]['menu_name_en']?></td>
        <td align="center"><input type="checkbox" name="chk_menu[]" id="chk_menu_<?=$rs_menu[$j]['menu_id']?>" value="<?=$rs_menu[$j]['menu_id']?>" <?=$chk_status?> /></td>
      </tr>
      <?php 
				} // Emd loop เมนูย่อย
	$loop++;
	}// End loop เมนูหลัก ?>
    </tbody>
  </table>
  <?php 
	$tbl->closeTable(); 
?>
  <input type="hidden" name="action" id="action" value="actionUpdate" />
</form>
<?=MainWeb::closeTemplate();?>

<script  type="text/javascript" src="./modules/<?=$Config['modules']?>/<?=$Config['page']?>.js"></script> 