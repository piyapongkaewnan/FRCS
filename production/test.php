<html ng-app="countryApp">
  <head>
    <meta charset="utf-8">
    <title>Angular.js JSON Fetching Example</title>
<link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Angular -->
<script type="text/javascript" src="../vendors/angular/angular.min.js"></script>
    <script>
      var countryApp = angular.module('countryApp', []);
      countryApp.controller('CountryCtrl', function ($scope, $http){
        $http.get('./modules/Forms/fx-data.php?limit=<?=$_GET['limit']?>').success(function(data) {
          $scope.countries = data;
        });
      });
    </script>
  </head>
  <body>
<div class="container"  ng-controller="CountryCtrl">
	<h2>Angular.js JSON Fetching Example</h2>
        <input type="text" class="form-control input-sm" ng-model="queryString">
        Filter by {{queryString}}
        <table class="table table-striped table-hover">
          <tr class="info">
            <th>FXCode</th>
            <th>FxName</th>
            <th>RateToBase</th>
          </tr>
          <tr ng-repeat="item in countries | orderBy: 'FXCode' | filter: queryString  ">
            <td>{{item.FXCode}}</td>
            <td>{{item.FxName}}</td>
            <td>{{item.RateToBase | currency: 'THB '}}</td>
          </tr>
        </table>
    </div>
  </body>
</html>