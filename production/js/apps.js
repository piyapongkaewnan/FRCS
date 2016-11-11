// JavaScript Document
// Main Apps
angular.module('apps', ['FXApp', 'QueryDataApp']);
angular.module('apps')
        .controller('loginController', function ($scope) {
            $scope.controllerName = 'loginController';
            $scope.doSometing = console.log('Test');
        });

// FX Apps 
angular.module('FXApp', []);
angular.module('FXApp')
        .controller('FXController', function ($scope, $http) {
            $scope.controllerName = 'FXController';
            $scope.getFXData = function () {
                $http.get('./modules/Forms/fx-data.php?limit=5').success(function (response) {
                    $scope.items = response;
                    //console.log(response);					
                });
            };
            $scope.ShowHide = function () {
                //If DIV is visible it will be hidden and vice versa.
                $scope.IsVisible = $scope.IsVisible ? false : true;
            };
        });

// Query Data Apps
angular.module('QueryDataApp', []);
angular.module('QueryDataApp')
        .controller('QueryDataController', function ($scope, $http) {
            $scope.controllerName = 'QueryDataController';
            //   $scope.getTableData = function () {
            $http.get('./modules/Forms/fx-data.php?limit=5').success(function (response) {
                $scope.items = response;
                //console.log(response);					
            });
            // };
            $scope.ShowHide = function () {
                //If DIV is visible it will be hidden and vice versa.
                $scope.IsVisible = $scope.IsVisible ? false : true;
            };
        });


 