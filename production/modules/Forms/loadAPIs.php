<?php
require_once("./includes/DBConnect.php");
?>
<?=MainWeb::openTemplate();?>
<!--  ng-controller="FXController"-->

<div class="x_content" ng-app="FXApps"  ng-controller="FXController"> 
  <!-- Smart Wizard --> 
  <!--  <p>This is a basic form wizard example that inherits the colors from the selected scheme.</p>
-->
  <div id="wizard" class="form_wizard wizard_horizontal">
    <ul class="wizard_steps">
      <li> <a href="#step-1"> <span class="step_no">1</span> <span class="step_descr"> Step 1<br />
        <small>Load FX data</small> </span> </a> </li>
      <li> <a href="#step-2"> <span class="step_no">2</span> <span class="step_descr"> Step 2<br />
        <small>Load API Data</small> </span> </a> </li>
      <li> <a href="#step-3"> <span class="step_no">3</span> <span class="step_descr"> Step 3<br />
        <small>Manual Data Input</small> </span> </a> </li>
      <li> <a href="#step-4"> <span class="step_no">4</span> <span class="step_descr"> Step 4<br />
        <small>View Report</small> </span> </a> </li>
    </ul>
    <div id="step-1">
    <h2 class="StepTitle">Load FX Data</h2>
      <form name="form_step1">
      <!-- Columns are always 50% wide, on mobile and desktop -->
<div class="row">
  <div class="col-xs-6"><button type="button" id="loadFX" class="btn btn-primary btn-sm" ng-click="getFXData();"><i class="fa fa-bolt"></i> Load FX</button> <span class="loading1"></span></div>
  <div class="col-xs-6 text-right"> <button type="button" class="btn btn-sm btn-info btn-save" style="display:none" /><i class="fa fa-save"></i> Save</button></div>
</div>
     <!--ng-click="getFXData();"-->
          
        
        <!-- <h2>Show data from get APIs (Example)</h2>
        <input type="text" class="form-control input-sm" ng-model="queryString">
        Filter by {{queryString}}-->
          <div class="showFX" style="display:none">
            <h4><label class="label label-danger"> FX with no rate</label> </h4>
                      <table width="100%" class="table table-striped table-hover">
              <tr class="danger">
                <th width="12%">FXCode</th>
                <th width="37%">FxName</th>
                <th width="27%">Date</th>
                <th width="24%">RateToBase</th>
              </tr>
              <tr ng-repeat="item in items | orderBy: 'FXCode' | filter: queryString">
                <td>{{item.FXCode}}</td>
                <td>{{item.FxName}}</td>
                <td><div class="col-md-12 col-sm-12 col-xs-12">
      <input class="form-control col-md-12 col-xs-12 has-feedback-left date-picker" id="date" name="date" value="<?=date('Y-m-d')?>" type="date" data-date-inline-picker="true" required="required"/>
      <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span> </div>
 </td>
                <td> <div class="form-group">
   
    <div class="col-md-12 col-sm-12 col-xs-12">
      <input class="form-control col-md-12 col-xs-12 has-feedback-left" id="RateToBase" name="RateToBase" value="<?=number_format($rs_edit['RateToBase'],8);?>" type="number" required="required"/>
      <span class="fa fa-calculator form-control-feedback left" aria-hidden="true"></span> </div>
  </div></td>
              </tr>
            </table>
        </div>
      </form>
    </div>
    <div id="step-2">
    <h2 class="StepTitle">Load API Data</h2>
      <div class="forn-control"><!-- style="overflow-y: scroll; height:350px"-->
       <div class="form-group" ><!--ng-click="getFXData();"-->
          <button type="button" id="loadAPI" class="btn btn-primary btn-sm"><i class="fa fa-bolt"></i> Load API</button>
         <!-- <span class="loading2"></span>--> </div>
          <div class="showAPI" style="display:none">
          <table width="100%" class="table table-striped table-hover">
            <tr class="info">
              <th width="18%">#</th>
              <th width="63%">Source</th>
              <th width="19%">Status</th>
            </tr>
            <?php
		$sqlAPIType = "SELECT * FROM datasourcetype ORDER BY type";
		$rsAPIType = $db->GetAll($sqlAPIType);
		for($i=0;$i<count($rsAPIType);$i++){
	?>
            <tr>
              <td><?=($i+1)?></td>
              <td><?=$rsAPIType[$i]['type']?></td>
              <td><span class="loading2"></span></td>
            </tr>
            <?php } ?>
          </table>
        </div>
      </div>
    </div>
    <div id="step-3">
      <h2 class="StepTitle">Manual Data Input</h2>
      <p>
      <table class="table table-striped table-hover">
            <tr class="info">
              <th width="7%">#</th>
              <th width="50%">Date Source</th>
              <th width="23%">Manual Input using Form</th>
              <th width="20%">Import</th>
            </tr>
            <?php
		$sqlAPIType = "SELECT * FROM datasourcetype WHERE id IN(2,8) ORDER BY type";
		$rsAPIType = $db->GetAll($sqlAPIType);
		for($i=0;$i<count($rsAPIType);$i++){
	?>
            <tr>
              <td><?=($i+1)?></td>
              <td><?=$rsAPIType[$i]['type']?></td>
              <td align="left"><a href="#" class="btn btn-sm btn-info">Edit</a></td>
              <td><a href="#" class="btn btn-sm btn-success">Import from Excel</a></td>
            </tr>
            <?php } ?>
          </table>
      </p>
    </div>
    <div id="step-4">
      <h2 class="StepTitle"> View Report</h2>
      <p>
      <select class="form-control" name="viewReport" id="viewReport">
      	<option> -- Select Report -- </option>
        <option> Report 1</option>
        <option> Report 2</option>
        <option> Report 3</option>
      </select>
      </p>
    </div>
  </div>
  <!-- End SmartWizard Content --> 
  
  <!-- Tabs --><!-- End SmartWizard Content --> 
</div>
<?=MainWeb::closeTemplate();?>

    <script type="text/javascript" src="js/moment/moment.min.js"></script> 

    <script src="./js/datepicker/daterangepicker.js"></script>


<!-- jQuery Smart Wizard --> 
<script src="../vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js"></script> 

<!-- jQuery Smart Wizard --> 
<script>

      $(document).ready(function() {

		var h = $( window ).height();
		
        $('#wizard').smartWizard();

        $('#wizard_verticle').smartWizard({
          transitionEffect: 'slide'
        });

        $('.buttonNext').addClass('btn btn-default');
        $('.buttonPrevious').addClass('btn btn-default');
        $('.buttonFinish').addClass('btn btn-success');
		
		

 });
	  
	  

	  			  /*
		  			$.get('modules/Forms/data.php', function (json) {
  
	//	console.log(json);  
		$('#StoreData').attr("ng-init",json);
		
		   


});*/
			$('#step-1 , #step-2 , #step-3, #step-4').css('height', $( window ).height() -400);
  
	  
	  $('#loadFX').click(function(){
		// console.log(h);
			$('.showFX').hide();
		  $('.loading1').html('');
		  $(this).prop('disabled',true);
		  $(this).html("<i class='fa fa-spinner fa-spin'></i> Plese wait..");
		  $('.btn-save').hide();
	/*	  $.get('data.txt',function(data){
			  console.log(data);
			  var obj = JSON.stringify(data)
			  $('#showData').text(obj);
			  
		  });*/

		setTimeout( step1 ,1000);	
		   

	  });
	  
	  $('#loadAPI').click(function(){
		 $('.showAPI').show();
		  $('.loading2').html("<i class='fa fa-spinner fa-spin'></i> Loading..");
		   $(this).html("<i class='fa fa-spinner fa-spin'></i> Plese wait..");
		  $(this).prop('disabled',true)
		  
		   setTimeout( step2 ,3000);	
		  //step2();
	  });
		

		$("#viewReport").change(function(){
			window.location='?modules=Reports&page=Report1';
		});
	  
	   function step1() {
				$('.loading1').html('');
				$('#loadFX').prop('disabled',false);
				$('#loadFX').html("<i class='fa fa-bolt'></i> Load FX");
				$('.loading1').html("<i class='fa fa-check'></i> Ok ");
				$('.loading1').addClass("text-success");
				$('.showFX').show(); 
				$('.btn-save').show();
			}
	  
	   function step2() {
				$('.loading2').html('');
				$('#loadAPI').prop('disabled',false)
				$('#loadAPI').html("<i class='fa fa-bolt'></i> Load API");
				$('.showAPI').show(); 
				$('.loading2').html("<i class='fa fa-check'></i> Success ");
				$('.loading2').addClass("text-success");
				$('.loading2:eq(1), .loading2:eq(3)').html("<i class='fa fa-close'></i> Fail ");
				$('.loading2:eq(1), .loading2:eq(3)').addClass("text-danger");
				$('#API_3').addClass("border-red");
				
			}
  
    </script> 
<!-- bootstrap-daterangepicker -->
    <script type="text/javascript">
      $(document).ready(function() {
		  
        $('input[name="date"]').daterangepicker({
          singleDatePicker: true,
          calender_style: "picker_4"
        }, function(start, end, label) {
          console.log(start.toISOString(), end.toISOString(), label);
        });
      });
    </script>
    <!-- /bootstrap-daterangepicker -->
