<?=MainWeb::openTemplate();?>

<div class="x_content" ng-app="FXApps"  ng-controller="FXController"> 
  <!-- Smart Wizard --> 
  <!--  <p>This is a basic form wizard example that inherits the colors from the selected scheme.</p>
-->
  <div id="wizard" class="form_wizard wizard_horizontal">
    <ul class="wizard_steps">
      <li> <a href="#step-1"> <span class="step_no">1</span> <span class="step_descr"> Step 1<br />
        <small>Load APIs</small> </span> </a> </li>
      <li> <a href="#step-2"> <span class="step_no">2</span> <span class="step_descr"> Step 2<br />
        <small>Verify Data</small> </span> </a> </li>
      <li> <a href="#step-3"> <span class="step_no">3</span> <span class="step_descr"> Step 3<br />
        <small>Finish</small> </span> </a> </li>
    </ul>
    <div id="step-1">
      <div class="forn-control" style="overflow-y: scroll; height:250px">
        <form class="form-horizontal form-label-left">
          <?php
		for($i=1;$i<=10;$i++){
	?>
          <div class="form-group ">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">API
              <?=$i?>
              <span class="loading"></span> </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="API_<?=$i?>" class="form-control col-md-7 col-xs-12 input-sm text-api" value="API Data URL <?=$i?>" readonly>
            </div>
          </div>
          <?php } ?>
        </form>
      </div>
      <div class="form-group">
        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
          <button type="button" id="loadAPI" class="btn btn-danger" ng-click="getData();ShowHide()"><i class="fa fa-bolt"></i> Load APIs</button>
        </div>
      </div>
    </div>
    <div id="step-2">
      <p>
      <div class="container" ng-show="IsVisible">
        <h2>Show data from get APIs (Example)</h2>
        <input type="text" class="form-control input-sm" ng-model="queryString">
        Filter by {{queryString}}
        <table class="table table-striped table-hover">
          <tr class="info">
            <th>FXCode</th>
            <th>FxName</th>
            <th>RateToBase</th>
          </tr>
          <tr ng-repeat="item in items | orderBy: 'FXCode' | filter: queryString  ">
            <td>{{item.FXCode}}</td>
            <td>{{item.FxName}}</td>
            <td>{{item.RateToBase | currency: 'THB '}}</td>
          </tr>
        </table>
      </div>
      </p>
    </div>
    <div id="step-3">
      <h2 class="StepTitle">Step 3 Content</h2>
      <p> sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore
        eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. </p>
      <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
        in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. </p>
    </div>
  </div>
  <!-- End SmartWizard Content --> 
  
  <!-- Tabs --><!-- End SmartWizard Content --> 
</div>
<?=MainWeb::closeTemplate();?>

<!-- jQuery Smart Wizard --> 
<script src="../vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js"></script> 

<!-- jQuery Smart Wizard --> 
<script>

      $(document).ready(function() {



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
	  
	  
	  $('#loadAPI').click(function(){
		 
		  $('.loading').html("<i class='fa fa-spinner fa-spin'></i> ");
		  $(this).prop('disabled',true)
		  
	/*	  $.get('data.txt',function(data){
			  console.log(data);
			  var obj = JSON.stringify(data)
			  $('#showData').text(obj);
			  
		  });*/
		  

		  
		   setTimeout( myFunction ,3000);	
		   
		   function myFunction() {
				$('.loading').html('');
				$('#loadAPI').prop('disabled',false)
				$('.loading').html("<i class='fa fa-check'></i> ");
				$('.loading').addClass("text-success");
				$('.loading:eq(2)').html("<i class='fa fa-close'></i> ");
				$('.loading:eq(2)').addClass("text-danger");
				$('#API_3').addClass("border-red");
				 
			}
			

	  });
	  
	  
  
    </script> 
