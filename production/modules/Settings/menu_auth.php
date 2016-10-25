<?php
// Title Menu from function.php
$tbl = new dataTable();
//$tbl->paging= false;
$tbl->id = $_GET['setPage'];
$tbl->title = title_menu($_GET['setPage']);
//$tbl->menu = MENU_SAVE_ONLY;
$tbl->module = $_GET['setModule'];
$tbl->page = $_GET['setPage'];
$tbl->paging = false;
$tbl->pagingLength = '100';
$tbl->pagingEnd = '100';
$tbl->order = 0;
$tbl->openTable();


// หาค่ากลุ่มเมนู
$sql_group = "SELECT * FROM tbl_user_group ORDER BY group_id ";
$rs_group = $db->GetAll($sql_group);

//ถ้ามีการเลือกให้ where ตามค่าที่เลือก ถ้าไม่ ให้เอาค่า mgroup_id มา where
$get_mgroup = $_GET['group_id'] ? " ".$_GET['group_id'] : $rs_group[0]['group_id'];


// หาสิทธิ์การเข้าใ้ช้งานเมนูตามเงื่อนไข
$sql_menu_auth = "SELECT menu_id FROM tbl_menu_auth WHERE group_id = $get_mgroup";
$rs_menu_auth = $db->GetAll($sql_menu_auth);
for($a=0;$a<count($rs_menu_auth);$a++){
	$Arr_menu_auth[] = $rs_menu_auth[$a]['menu_id'];
}
?>
<script type="text/javascript" src="./modules/<?=$_GET['setModule']?>/<?=$_GET['setPage']?>.js"></script>
<form name="form_menu_auth" id="form_menu_auth" method="post" />
<table width="100%" border="0" cellspacing="2" cellpadding="0">
  <tr>
    <td width="41%" align="left" valign="middle">กลุ่มผู้ใช้งาน :
      <label>
        <select name="group_id" id="group_id">
          <?php					  
					  genOptionSelect($rs_group,'group_id','group_name',$_GET['group_id']);
		  ?>
        </select>
      </label></td>
    <td width="24%" align="right" valign="bottom"><?=MENU_SAVE_ONLY?><span id="ajaxloading"> กำลังบันทึก...</span> </td>
  </tr>
</table>

<table width="100%" border="0" cellpadding="0" cellspacing="0" class="display compact" id="<?=$tbl->id;?>">
  <thead>
    <tr>
      <th width="8%"  class="header_height">ลำดับ</th>
      <th width="72%"  class="header_height">เมนู</th>
      <th width="20%" align="center">        สิทธิ์การใช้งาน </th>
    </tr>
  </thead>
  <tbody>
  
  <?php
  
  		// หาเมนูหลัก
  		  $sql_gmemu = "SELECT
											 mgroup_id,
											 menu_group_th
										FROM tbl_menu_group
										ORDER BY menu_order";
			$rs_gmenu = $db->GetAll($sql_gmemu);
			
			$loop=1;
			for($i=0;$i<count($rs_gmenu);$i++){// Loop menu group
  ?>
  
    <tr class="gradeA">
      <td align="center"><?=$loop?></td>
      <td><u><b><?=$rs_gmenu[$i]['menu_group_th']?></b></u></td>
      <td align="center"><!--<input type="checkbox" name="chk_gmenu[]" id="chk_gmenu" value="<?=$rs_gmenu[$i]['mgroup_id']?>" />--></td>
    </tr>
    
			<?php
			// หาเมนูย่อย
			$mgroup_id = $rs_gmenu[$i]['mgroup_id'];
			$sql_menu =  "SELECT
												 menu_id,
												 menu_name_th,
												 mgroup_id
											FROM tbl_menu
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
                      <td>&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- <?=$rs_menu[$j]['menu_name_th']?></td>
                      <td align="center"><input type="checkbox" name="chk_menu[]" id="chk_menu" value="<?=$rs_menu[$j]['menu_id']?>" <?=$chk_status?> /></td>
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
<input type="hidden" name="doAction" id="doAction" />
</form>