<!-- Select2 -->
<link href="../vendors/select2/dist/css/select2.min.css" rel="stylesheet">
<?php
if ($_GET['action'] == 'actionUpdate') {
// แสดงรายละเอียด
    $sql_edit = "SELECT
                        *						 
                       FROM game WHERE id = " . $_GET['id'];
    $rs_edit = $db->GetRow($sql_edit);
}

// Get Data from countrys
$sqlCountry = 'SELECT
                id,
               CountryName
              FROM country
              ORDER BY CountryName ';
$rsCountry = $db->GetAll($sqlCountry);

// Get Data from GameType
$sqlGameType = 'SELECT
                id,
               type
              FROM gametype
              ORDER BY type ';
$rsGameType = $db->GetAll($sqlGameType);

// Get Data from Partner
$sqlPartner = 'SELECT
                id,
               PartnerName
              FROM Partner
              ORDER BY PartnerName ';
$rsPartner = $db->GetAll($sqlPartner);

if ($rs_edit['IsActive'] == "1" || $_GET['action'] == 'actionCreate') {
    $strIsActive = "checked";
}

/* 					
  RefCode,
  GroupCode,
  GameName,
  GameType,
  Partner1,
  Partner2,
  PercentShare,
  Territory,
  Publisher,
  PaymentChannel,
  DataSourceRemarks,
  IsActive */
?>
<?= MainWeb::openTemplate(); ?>

<form id="form_<?= $Config['page'] ?>" name="form_<?= $Config['page'] ?>" method="post" data-parsley-validate class="form-horizontal form-label-left">
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="RefCode">Ref Code <span class="required">*</span> </label>
        <div class="col-md-4 col-sm-3 col-xs-12">
            <input type="text" id="RefCode" name="RefCode" value="<?= $rs_edit['RefCode'] ?>" required="required "  class="form-control col-md-7 col-xs-12 has-feedback-left">
            <span class="fa fa-globe form-control-feedback left" aria-hidden="true"></span> </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="GroupCode">Group Code <span class="required">*</span> </label>
        <div class="col-md-4 col-sm-3 col-xs-12">
            <input class="form-control  col-md-7 col-xs-12 has-feedback-left" id="GroupCode" name="GroupCode" type="text"  value="<?= $rs_edit['GroupCode'] ?>" required="required"/>
            <span class="fa fa-keyboard-o  form-control-feedback left" aria-hidden="true"></span> </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="GameName">Game Name <span class="required">*</span> </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input class="form-control  col-md-7 col-xs-12 has-feedback-left" id="GameName" name="GameName" type="text"  value="<?= $rs_edit['GameName'] ?>" required="required"/>
            <span class="fa fa-keyboard-o  form-control-feedback left" aria-hidden="true"></span> </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12"  for="GameType">Game Type <span class="required">*</span></label>
        <div class="col-md-4 col-sm-3 col-xs-12">
            <select class="form-control col-md-7 col-xs-12 input-sm" name="GameType" id="GameType" tabindex="-1" required>
                <option></option>
                <?= Form::genOptionSelect($rsGameType, 'id', 'type', $rs_edit['GameType']); ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12"  for="Territory">Territory <span class="required">*</span></label>
        <div class="col-md-4 col-sm-3 col-xs-12">
            <select class="form-control col-md-7 col-xs-12 input-sm" name="Territory" id="Territory" tabindex="-1" required>
                <option></option>
                <?= Form::genOptionSelect($rsCountry, 'id', 'CountryName', $rs_edit['Territory']); ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12"  for="Partner1">Partner 1 <span class="required">*</span></label>
        <div class="col-md-4 col-sm-3 col-xs-12">
            <select class="form-control col-md-7 col-xs-12 input-sm" name="Partner1" id="Partner1" tabindex="-1" required>
                <option></option>
                <?= Form::genOptionSelect($rsPartner, 'id', 'PartnerName', $rs_edit['Partner1']); ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12"  for="Partner2">Partner 2 <small class="text-danger"> (Optional)</small></label>
        <div class="col-md-4 col-sm-3 col-xs-12">
            <select class="form-control col-md-7 col-xs-12 input-sm" name="Partner2" id="Partner2" tabindex="-1">
                <option></option>
                <?= Form::genOptionSelect($rsPartner, 'id', 'PartnerName', $rs_edit['Partner2']); ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="PercentShare">Percent Share <span class="required">*</span> </label>
        <div class="col-md-4 col-sm-3 col-xs-12">
            <input class="form-control col-md-7 col-xs-12 has-feedback-left" id="PercentShare" name="PercentShare" value="<?= $rs_edit['PercentShare']; ?>" type="text" required="required"/>
            <span class="fa fa-calculator form-control-feedback left" aria-hidden="true"></span> </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Publisher">Publisher </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input class="form-control  col-md-7 col-xs-12 has-feedback-left" id="Publisher" name="Publisher" type="text"  value="<?= $rs_edit['Publisher'] ?>" >
            <span class="fa fa-keyboard-o  form-control-feedback left" aria-hidden="true"></span> </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="PaymentChannel">Payment Channel </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <textarea name="PaymentChannel" rows="3" class="form-control  col-md-7 col-xs-12 has-feedback-left" id="PaymentChannel"><?= $rs_edit['PaymentChannel'] ?></textarea>
            <span class="fa fa-keyboard-o  form-control-feedback left" aria-hidden="true"></span> </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="DataSourceRemarks">DataSource Remarks </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <textarea name="DataSourceRemarks" rows="3" class="form-control  col-md-7 col-xs-12 has-feedback-left" id="DataSourceRemarks"><?= $rs_edit['DataSourceRemarks'] ?>
            </textarea>
            <span class="fa fa-keyboard-o  form-control-feedback left" aria-hidden="true"></span> </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12"  for="IsActive">IsActive <span class="required"></span> </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="checkbox" class="input-sm js-switch" name="IsActive" id="IsActive" value="1"  <?= $strIsActive ?> />
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

<!-- Select2 --> 
<script src="../vendors/select2/dist/js/select2.full.min.js"></script> 
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

        $("#Territory , #Partner1 , #Partner2").select2({
            placeholder: "Select a option..",
            allowClear: true
        });

        // Onload call setPublisher
        setPublisher($('#GameType').val());

        $('#GameType').change(function () {
            setPublisher($(this).val());
        });


        //>> if game type = MarketPlace , then Publisher value is Blank and Field is readonly
        function setPublisher(GameType) {
            if (GameType == '3') {
                $('#Publisher').prop('readonly', true);
            } else {
                $('#Publisher').prop('readonly', false);
            }

        }

    });
</script>