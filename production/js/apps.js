// JavaScript Document
angular.module('apps', ['FXApps']);
angular.module('apps')
	.controller('loginController', function($scope) {
		$scope.controllerName = 'loginController';
		$scope.doSometing = console.log('Test');
	});


angular.module('FXApps', []);
angular.module('FXApps')
		.controller('FXController', function($scope, $http) {
			 $scope.controllerName = 'FXController';
			 $scope.getData = function(){ 
			 		$http.get('./modules/Forms/fx-data.php?limit=15').success(function(response) {
	 		 		$scope.items =  response;					
					//console.log(response);					
				});
			 }
			 $scope.ShowHide = function () {
                //If DIV is visible it will be hidden and vice versa.
                $scope.IsVisible = $scope.IsVisible ? false : true;
            }
  });
  
 