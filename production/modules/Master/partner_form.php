<?php
if ($_GET['action'] == 'actionUpdate') {
// แสดงรายละเอียด
    $sql_edit = "SELECT * FROM partner WHERE id = " . $_GET['id'];
    $rs_edit = $db->GetRow($sql_edit);
}

if ($rs_edit['IsActive'] == "1" || $_GET['action'] == 'actionCreate') {
    $strIsActive = "checked";
}
?>
<?= MainWeb::openTemplate(); ?>

<br />
<form id="form_<?= $Config['page'] ?>" name="form_<?= $Config['page'] ?>" method="post" data-parsley-validate class="form-horizontal form-label-left">
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="PartnerCode">Partner Code <span class="required">*</span> </label>
        <div class="col-md-4 col-sm-3 col-xs-12">
            <input type="text" id="PartnerCode" name="PartnerCode" value="<?= $rs_edit['PartnerCode'] ?>" required="required "  class="form-control col-md-7 col-xs-12 has-feedback-left">
            <span class="fa fa-users form-control-feedback left" aria-hidden="true"></span> </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="PartnerName">Partner Name <span class="required">*</span> </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input class="form-control  col-md-7 col-xs-12 has-feedback-left" id="PartnerName" name="PartnerName" type="text"  value="<?= $rs_edit['PartnerName'] ?>" required="required"/>
            <span class="fa fa-keyboard-o  form-control-feedback left" aria-hidden="true"></span> </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12"  for="IsActive">IsActive <span class="required"></span> </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="checkbox" class=" input-sm js-switch" name="IsActive" id="IsActive" value="1"  <?= $strIsActive ?> />
        </div>
    </div>
    <div class="ln_solid"></div>
    <div class="form-group">
        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
            <?= MENU_SUBMIT ?>
            <input type="hidden" name="action" id="action" value="<?= $_GET['action'] ?>">
            <input type="hidden" name="id" id="id" value="<?= $_GET['id'] ?>">
        </div>
    </div>
</form>
<?= MainWeb::closeTemplate(); ?>

<script  type="text/javascript" src="./modules/<?= $Config['modules'] ?>/<?= $Config['page'] ?>.js"></script> 

<script type="text/javascript">
    $(function () {

        //doAction
        var actions = '<?= $_GET['action'] ?>';

        //Modules
        var modules = '<?= $_GET['modules'] ?>';
        //Page
        var page = '<?= $_GET['page'] ?>';

        //  actions , modules  ,page , selected , debug , isCurrentPage
        $.FormAction(actions, modules, page, '<?= $_GET['id'] ?>', false, false);

    });
</script>