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
        $http.get('data.txt').success(function(data) {
          $scope.countries = data;
        });
      });
    </script>
  </head>
  <body>
<div class="container"  ng-controller="CountryCtrl">
	<h2>Angular.js JSON Fetching Example</h2>
    <input type="text" class="form-control" ng-model="queryString.countryName">
    Filter by {{queryString}}
    <table class="table">
      <tr>
        <th>Code</th>
		<th>Country</th>
      </tr>
      <tr ng-repeat="country in countries | orderBy: 'key' | filter: queryString  ">
        <td>{{country.key}}</td>
		<td>{{country.value}}</td>
      </tr>
    </table>
    </div>
  </body>
</html>