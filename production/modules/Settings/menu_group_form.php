<?php
if ($_GET['action'] == 'actionUpdate') {
// List User Group
    $sql_edit = "SELECT
                    m.*,
                    i.icon_name
                  FROM menu_group m
                    JOIN icons i
                          ON m.icon_id = i.icon_id
                  WHERE m.mgroup_id =  " . $_GET['id'];
    $rs_edit = $db->GetRow($sql_edit);
}

$DirModule = MainWeb::ScanDir('modules/'); // path from top);

if ($rs_edit['is_active'] == "1" || $_GET['action'] == 'actionCreate') {
    $is_active = "checked";
}
?>
<style type="text/css">
    .fontawesome-icon-list .fa-hover1 a .fa {
        font-size:16px;
        padding: 5px 5px 5px 5px;
        -moz-border-radius: 2px;
        border-radius: 2px;
        text-align: center;
    }
    .fontawesome-icon-list .fa-hover1 a:hover .fa, .fa-active {
        border-color: #666;
        background-color: #CCC;
    }
</style>
<?= MainWeb::openTemplate(); ?>
<br />
<form  data-parsley-validate name="form_<?= $_GET['page'] ?>" id="form_<?= $_GET['page'] ?>" method="post" class="form-horizontal form-label-left">
    <!--    <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="menu_group_th">Menu Group TH <span class="required">*</span> </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="menu_group_th" name="menu_group_th" value="<?= $rs_edit['menu_group_th'] ?>" required="required "  class="form-control col-md-7 col-xs-12 has-feedback-left">
                <span class="fa fa-keyboard-o form-control-feedback left" aria-hidden="true"></span> </div>
        </div>-->
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="menu_group_en">Menu Group  <span class="required">*</span> </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="menu_group_en" name="menu_group_en" value="<?= $rs_edit['menu_group_en'] ?>" required="required "  class="form-control col-md-7 col-xs-12 has-feedback-left">
            <span class="fa fa-keyboard-o form-control-feedback left" aria-hidden="true"></span> </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="module_name">Module <span class="required">*</span> </label>
        <div class="col-md-4 col-sm-3 col-xs-12">
            <select name="module_name" id="module_name" class="form-control input-sm" required>
                <?= Form::listComboBox($DirModule, $rs_edit['module_name']); ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="menu_order">Menu Order <span class="required">*</span> </label>
        <div class="col-md-3 col-sm-3 col-xs-12">
            <input type="number" id="menu_order" name="menu_order" value="<?= $rs_edit['menu_order'] ?>" required="required "  class="form-control col-md-7 col-xs-12 has-feedback-left" min="1">
            <span class="fa fa-keyboard-o form-control-feedback left" aria-hidden="true"></span> </div>
    </div>
    <div class="form-group">
        <label for="message-text" class="control-label col-md-3 col-sm-3 col-xs-12">Menu Icon </label>
        <div class="col-md-7 col-sm-7 col-xs-12"> <a href="javascript:$('.fontawesome-icon-list').toggle();$('#btn-icon').toggleClass('fa-caret-up', 'fa-caret-down');" class="btn btn-default btn-sm"> Selected Icon <i id="btn-icon" class="fa fa-caret-down"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;<i id="show_icon" class="<?= $rs_edit['icon_name'] ?>"></i>
            <div class="row fontawesome-icon-list" style="display:none ;border:1px solid #CCC;padding:5px;border-radius:5px" >
                <?php
                $sql_icon = "SELECT icon_id,icon_name FROM icons";
                $rs_icons = $db->GetAll($sql_icon);
                foreach ($rs_icons as $icons) {
                    echo "<div class='fa-hover1 text-center col-md-2 col-sm-2 col-xs-2' rel='" . $icons['icon_id'] . "|" . $icons['icon_name'] . "' title='" . $icons['icon_name'] . "' ><a href='javascript:void(0);'><i class='" . $icons['icon_name'] . "'></i></a> </div>\n";
                }
                ?>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12"  for="is_active">Is Active <span class="required"></span> </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="checkbox" class=" input-sm  js-switch" name="is_active" id="is_active" value="1"  <?= $is_active ?> />
            </div>
        </div>
    </div>
    <div class="ln_solid"></div>
    <div class="form-group">
        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
            <?= MENU_SUBMIT ?>
            <input type="hidden" name="action" id="action" value="<?= $_GET['action'] ?>">
            <input type="hidden" name="id" id="id" value="<?= $_GET['id'] ?>">
            <input type="hidden" name="icon_id" id="icon_id" value="<?= $rs_edit['icon_id'] ?>">
        </div>
    </div>
</form>
<?= MainWeb::closeTemplate(); ?>
<script type="text/javascript">
    $(document).ready(function () {
        // Trigger form submit

        //doAction
        var actions = '<?= $_GET['action'] ?>';

        //Modules
        var modules = '<?= $_GET['modules'] ?>';
        //Page
        var page = '<?= $_GET['page'] ?>';


        //  actions , modules  ,page , selected , debug , isCurrentPage
        $.FormAction(actions, modules, page, '<?= $_GET['id'] ?>', false, false);


//Set icon_id when click as icon list
        $('.fa-hover1').click(function () {
            var Split = $(this).attr('rel').split('|');
            $('#icon_id').val(Split[0]);
            //$('#show_icon').attr('class', Split[1]);
            $('#show_icon').toggleClass('fa-chevron-up fa-chevron-down');//.attr('class', Split[1]);     

        });

    });
</script>