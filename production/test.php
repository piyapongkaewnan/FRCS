<?php

$arrData1 = [['FX Code', 'FX Symbol', 'FX Name', 'Rate To Base', 'Is Active', 'Action']];
$arrData2 = [[5, 12, 35, 14, 13, 8]];
$arrData3 = [['left', 'center', 'left', 'left', 'left', 'left']];

$r = [['cation' => ['FX Code', 'FX Symbol', 'FX Name', 'Rate To Base', 'Is Active', 'Action'],
 'width' => [5, 12, 35, 14, 13, 8]
    ]
];

$c = array_merge($arrData1, $arrData2, $arrData3);
print '<pre>';
print_r($c);
print '</pre>';


//$a = [
//        ['field' => 'FXCode', 'catption' => 'FX Code', 'width' => 5, 'align' => 'center', 'class' => ''],
//        ['field' => 'FXCode', 'catption' => 'FX Code', 'width' => 5, 'align' => 'center', 'class' => ''],
//        ['field' => 'FXCode', 'catption' => 'FX Code', 'width' => 5, 'align' => 'center', 'class' => ''],
//        ['field' => 'FXCode', 'catption' => 'FX Code', 'width' => 5, 'align' => 'center', 'class' => '']
//];

$TT = [
        ['field' => ['FX Code', 'FX Symbol', 'FX Name', 'Rate To Base', 'Is Active', 'Action']],
        ['width' => [5, 12, 35, 14, 13, 8]],
        ['align' => ['left', 'center', 'left', 'left', 'left', 'left']],
        ['class' => ['left', 'center', 'left', 'left', 'left', 'left']]
];


foreach ($TT as $key => $val) {

    echo "<br>{$key} => {$val} ";

    foreach ($val as $a => $b) {
        echo "<br>{$a} => {$b} ";
    }
}
print '<pre>';
print_r($TT);
print '</pre>';
?>

<html ng-app="apps">
    <head>
        <meta charset="utf-8">
        <title>Angular.js JSON Fetching Example</title>
        <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- jQuery -->
        <script type="text/javascript" src="../vendors/jquery/dist/jquery.min.js"></script>

        <!-- Angular -->
        <script type="text/javascript" src="../vendors/angular/angular.min.js"></script>



        <script type="text/javascript" src="js/apps.js"></script>

    </head>
    <body>

        <div class="container"  ng-controller="QueryDataController">
            <h2>Angular.js JSON Fetching Example {{ controllerName}}</h2>
            <input type="text" class="form-control input-sm" ng-model="queryString">
            Filter by {{queryString}}
            <table class="table table-striped table-hover table-borderd data-table" id="table_test" width="100%">
                <thead>
                    <tr class="info">
                        <th width="20%">FXCode</th>
                        <th width="50%">FxName</th>
                        <th width="30%">RateToBase</th>
                    </tr>
                </thead>
                <tbody >
                    <tr ng-repeat="item in items| orderBy: 'FXCode' | filter: queryString  ">
                        <td>{{item.FXCode}}</td>
                        <td>{{item.FxName}}</td>
                        <td>{{item.RateToBase| currency: 'THB '}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </body>
</html>