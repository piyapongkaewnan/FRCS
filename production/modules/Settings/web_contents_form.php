<?php
session_start();

require_once("../../includes/config.inc.php");

if ($_GET['doAction'] == "edit") {
    $id = $_GET['id'];
    $sql_edit = "SELECT * FROM tbl_contents WHERE id = '$id'";
    $rs_edit = $db->GetRow($sql_edit);
    $contents = $rs_edit['content_name'];
}
?>

<script type="text/javascript">
    $(function () {
        ajaxLoading();

        //doAction
        var actions = '<?= $_GET['doAction'] ?>';
        //Modules
        var modules = '<?= $_GET['modules'] ?>';
        //Page
        var pages = '<?= $_GET['pages'] ?>';

        //ID
        var id = '<?= $id ?>';

        $.FormAction(actions, modules, pages, id);

    });

</script>
<link type="text/css" rel="stylesheet" href="./modules/DWDM/style.css">
<link type="text/css" rel="stylesheet" href="js/jQuery-TE/jquery-te-1.4.0.css">

<script type="text/javascript" src="js/jQuery-TE/jquery-te-1.4.0.min.js" charset="utf-8"></script>

<!------------------------------------------------------------ Toggle jQTE Button ------------------------------------------------------------>

<form action="" id="form_<?= $_GET['pages'] ?>" name="form_<?= $_GET['pages'] ?>">
    <table width="100%" border="0" cellspacing="2" cellpadding="2">
        <tr>
            <td width="21" align="left" valign="top">&nbsp;</td>
            <td width="118" valign="top"><strong>*ชื่อเนื้อหา :</strong></td>
            <td width="752" align="left" valign="top"><span id="sprytextfield3">
                    <label for="portlet"></label>
                    <input name="content_name" type="text" id="content_name" placeholder="ชื่อของ Page  (ภาษาอังกฤษ)" value="<?= $rs_edit['content_name'] ?>" size="40">
                    <span class="textfieldRequiredMsg">A value is required.</span></span></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td colspan="2"><span id="sprytextarea1">
                    <textarea name="content_desc" rows="15" class="jqte-test" id="content_desc"><?= $rs_edit['content_desc']; ?></textarea>
                    <span class="textareaRequiredMsg">A value is required.</span></span></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><strong>ปรับปรุงล่าสุดโดย :</strong></td>
            <td><span id="sprytextfield2">
                    <label for="update_by"></label>
                    <input name="update_by" type="text" id="update_by" size="50" value="<?= $_GET['doAction'] == "new" ? $_SESSION['sess_name'] : $rs_edit['update_by']; ?>">
                    <span class="textfieldRequiredMsg">A value is required.</span></span></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><strong>วันที่ปรับปรุงแก้ไข : </strong></td>
            <td><?= $_GET['doAction'] == "edit" ? showdateTimeThai($rs_edit['update_time']) : "N/A"; ?></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td colspan="2"><?= MENU_SUBMIT ?></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td colspan="2">&nbsp;</td>
        </tr>
    </table>
</form>
<!------------------------------------------------------------ jQUERY TEXT EDITOR ------------------------------------------------------------><script>
    $('.jqte-test').jqte();

    // settings of status
    var jqteStatus = true;
    $(".status").click(function ()
    {
        jqteStatus = jqteStatus ? false : true;
        $('.jqte-test').jqte({"status": jqteStatus})
    });
    var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1", {validateOn: ["blur", "change"]});
    var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn: ["blur", "change"]});
    var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "none", {validateOn: ["blur", "change"]});
</script>

<!------------------------------------------------------------ jQUERY TEXT EDITOR ------------------------------------------------------------>
