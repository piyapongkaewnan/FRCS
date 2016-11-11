<!-- Select2 -->
<link href="../vendors/select2/dist/css/select2.min.css" rel="stylesheet">
<?php
$id = $_GET['id'];

if ($_GET['action'] == 'actionUpdate') {
// แสดงรายละเอียด
    $sql_edit = "SELECT
                        *						 
                       FROM dataapi WHERE id = $id ";
    $rs_edit = $db->GetRow($sql_edit);
}

// Get Data from datasourcetype
$sqlSourceType = 'SELECT
                        id,
                       type
                    FROM datasourcetype
                    ORDER BY type ';
$rsSourceType = $db->GetAll($sqlSourceType);

if ($rs_edit['IsActive'] == "1" || $_GET['action'] == 'actionCreate') {
    $strIsActive = "checked";
}
?>
<?= MainWeb::openTemplate(); ?>
<style type="text/css">
    form {
        padding:0px;
        margin:0px;
    }
</style>
<form id="form_<?= $Config['page'] ?>" name="form_<?= $Config['page'] ?>" method="post" data-parsley-validate class="form-horizontal form-label-left">
    <div class="row">
        <div class="control-label col-md-12 col-sm-12 col-xs-12">
            <button id="b2" class="btn btn-danger paramValidate" type="button"><i class="fa fa-bolt"></i> Validate Parameters</button>
            <span class="loading-validate"></span> </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="APIRefCode">API Ref Code <span class="required">*</span> </label>
        <div class="col-md-4 col-sm-3 col-xs-12">
            <input type="text" id="APIRefCode" name="APIRefCode" value="<?= $rs_edit['APIRefCode'] ?>" required="required "  class="form-control col-md-7 col-xs-12 has-feedback-left">
            <span class="fa fa-keyboard-o form-control-feedback left" aria-hidden="true"></span> </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="APIName">API Name <span class="required">*</span> </label>
        <div class="col-md-4 col-sm-3 col-xs-12">
            <input class="form-control  col-md-7 col-xs-12 has-feedback-left" id="APIName" name="APIName" type="text"  value="<?= $rs_edit['APIName'] ?>" required="required"/>
            <span class="fa fa-keyboard-o  form-control-feedback left" aria-hidden="true"></span> </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="APIUrl">API Url <span class="required">*</span> </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input class="form-control  col-md-7 col-xs-12 has-feedback-left" id="APIUrl" name="APIUrl" type="url"  value="<?= $rs_edit['APIUrl'] ?>" required="required"/>
            <span class="fa fa-globe form-control-feedback left" aria-hidden="true"></span> </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="UserName">User Name <span class="required">*</span> </label>
        <div class="col-md-4 col-sm-3 col-xs-12">
            <input class="form-control  col-md-7 col-xs-12 has-feedback-left" id="UserName" name="UserName" type="text"  value="<?= $rs_edit['UserName'] ?>" required="required"/>
            <span class="fa fa-user  form-control-feedback left" aria-hidden="true"></span> </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Password">Password <span class="required">*</span> </label>
        <div class="col-md-4 col-sm-3 col-xs-12">
            <input class="form-control  col-md-7 col-xs-12 has-feedback-left" id="Password" name="Password" type="text"  value="<?= $rs_edit['Password'] ?>" required="required"/>
            <span class="fa fa-lock  form-control-feedback left" aria-hidden="true"></span> </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12"  for="DataSourceType">DataSourceType <span class="required">*</span></label>
        <div class="col-md-4 col-sm-3 col-xs-12">
            <select class="form-control col-md-7 col-xs-12 input-sm" name="DataSourceType" id="DataSourceType" tabindex="-1" required>
                <option></option>
                <?= Form::genOptionSelect($rsSourceType, 'id', 'type', $rs_edit['DataSourceType']); ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12"  for="IsActive">IsActive <span class="required"></span> </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="checkbox" class=" input-sm" name="IsActive" id="IsActive" value="1"  <?= $strIsActive ?> />
        </div>
    </div>
    <div class="ln_solid" style="margin-bottom:0px"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_content" id="APIParam">
                <div class="form-group  pull-left">
                    <label class="control-label col-md-12 col-sm-12 col-xs-12">
                        <button id="b1" class="btn btn-info addParamMore" type="button"><i class="fa fa-plus"></i> Add Parameters <span class="badge totalParam"></span></button>  
                    </label>

                </div>
                <table class="table table-striped table-hover table-responsive" id="tableParam">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Parameter Name</th>
                            <th>Parameter Value</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($_GET['action'] == 'actionUpdate') {
                            $sqlApiDetail = "SELECT * FROM dataapidetail WHERE APIID =$id ";
                            $rsApiDetail = $db->GetAll($sqlApiDetail);
                            if (sizeof($rsApiDetail) > 0) {
                                for ($i = 0; $i < sizeof($rsApiDetail); $i++) {
                                    ?>
                                    <tr>
                                        <th><?= ($i + 1) ?></th>
                                        <td><input type="text" name="paramName[]" id="paramName_<?= $i ?>" class="form-control input-sm read" required="required" value="<?= $rsApiDetail[$i]['ParameterName'] ?>" readonly/></td>
                                        <td><input type="text" name="paramValue[]" id="paramValue_<?= $i ?>" class="form-control input-sm" required="required"  value="<?= $rsApiDetail[$i]['ParameterValue'] ?>" readonly/></td>
                                        <td><span class="actionParam"><a href="javascript:void(0);" class="btn btn-info btn-xs editParam">Edit</a></span><a href="javascript:void(0);" class="btn btn-danger btn-xs removeParam">Remove</a></td>
                                    </tr>
                                    <?php
                                } // End for
                                // }else{ 
                                ?>
                     <!--   <tr>
                          <td colspan="4" scope="row" class="text-center"><label class="text-danger">No Parameter</label></th>
                        </tr>
                                <?php
                                //}
                                //	}else{
                                ?>
                        <tr>
                          <td colspan="4" scope="row" class="text-center"><label class="text-danger">No Parameter</label></td>
                        </tr>-->
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--<div class="ln_solid"></div>-->
    <div class="form-group">
        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
            <?= MENU_SUBMIT ?>
            <input type="hidden" name="action" id="action" value="<?= $_GET['action'] ?>">
            <input type="hidden" name="id" id="id" value="<?= $_GET['id'] ?>">
            <input type="hidden" name="isChange" id="isChange" value="0">
        </div>
    </div>
</form>
<?= MainWeb::closeTemplate(); ?>
<script  type="text/javascript" src="./modules/<?= $Config['modules'] ?>/<?= $Config['page'] ?>.js"></script> 

<!-- Select2 ----> 
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

        genRowNo();

        $("#DataSourceType").select2({
            placeholder: "Select a option..",
            allowClear: true
        });

// Add Parameter
        $('.addParamMore').click(function () {
            //	console.log($('#tableParam > tbody tr:last-child td:first-child').html());		
            var input = '<tr>\n';
            input += '<th scope="row"><i class="fa fa-bolt"></i></th>\n';
            input += '<td><input type="text" name="paramName[]" id="paramName" class="form-control input-sm" required="required" /></td>\n';
            input += '<td><input type="text" name="paramValue[]" id="paramValue" class="form-control input-sm" required="required" /></td>\n';
            input += ' <td><span class="actionParam"><a href="javascript:void(0);" class="btn btn-info btn-xs editParam">Done</a></span><a href="javascript:void(0);" class="btn btn-danger btn-xs removeParam">Remove</a></td>\n';
            input += '</tr>\n';
            $('#tableParam tbody:parent').append(input);
            $('#isChange').val(1);

            //console.log($('#tableParam > tbody tr:last-child td:first-child').html());		
            genRowNo();

        });

// Edit Edit Parameter
        $(document).on('click', '.editParam', function (e) {
//$(this).toggleClass('btn-success' , 'btn-info');	
            //var rowID = $(this).closest('tr').attr('id'); // table row ID 
            var rowIndex = $(this).parents("tr").index();

            if ($.trim($(this).text()) === 'Edit') {
                $(this).text('Done');
//				$(this).addClass('btn-success');
                $('input[name^=paramName]').eq(rowIndex).prop('readonly', false);
                $('input[name^=paramValue]').eq(rowIndex).prop('readonly', false);
            } else {
                $(this).text('Edit');
//				$(this).addClass('btn-info');
                $('input[name^=paramName]').eq(rowIndex).prop('readonly', true);
                $('input[name^=paramValue]').eq(rowIndex).prop('readonly', true);
            }

        });


// Remove Parameter
        $(document).on('click', '.removeParam', function (e) {
            $(this).parent().parent().remove();
            $('#isChange').val(1);
            genRowNo();
        });


// Validate Parameter
        $(document).on('click', '.paramValidate', function (e) {
            $(this).prop("disabled", true);
            $('.loading-validate').html('');
            $(this).html("<i class='fa fa-spinner fa-spin'></i> Plese wait..");
            setTimeout(testResult, 3000);
            //$('.loading-validate').addClass('fa fa-spinner fa-spin');
            return false;
        });


        function testResult() {
            $('.paramValidate').prop("disabled", false);
            $('.paramValidate').html('<i class="fa fa-bolt"></i> Validate Parameters');
            $('.loading-validate').html('<i class="fa fa-check text-success"> </i> Pass ');


            /*$.ajax({
             dataType: "json",
             url: 'http://data.tmd.go.th/api/WeatherToday/V1/?type=json',
             //  data: data,
             success: function(data){
             alert(data);
             //  console.log(data);
             }
             });*/

        }

// Function for generate tablw Row no on first td
        function genRowNo() {
            var numRow = $('#tableParam > tbody  > tr').each(function (i) {
                $("th:first-child", this).html((i + 1));
            });
            $('.totalParam').html(numRow.length);
        }

    });

</script> 
