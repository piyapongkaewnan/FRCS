<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Access denied!</title>

        <!-- Bootstrap -->
        <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <script type="text/javascript" src="../vendors/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script type="text/javascript" src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/moment/moment.min.js"></script>

        <!-- Custom Theme Style -->
        <link href="../build/css/custom.min.css" rel="stylesheet">
    </head>

    <body class="nav-md">
        <div class="container body">
            <div class="main_container"> 
                <!-- page content -->
                <div class="col-md-12">
                    <div class="col-middle">
                        <div class="text-center">
                            <h1 class="error-number">403</h1>
                            <h2>Access denied</h2>
                            <p>Full authentication is required to access this resource. <br>
                                Please contact administrator! </p>
                            <div class="mid_center"> <span class="input-group-btn">
                                    <button class="btn btn-danger" type="button" onClick="window.location = 'index.php';">Go Home <span class="countdown"></span></button>
                                </span> </div>
                        </div>
                    </div>
                </div>
                <!-- /page content --> 
            </div>
        </div>
        <script type="text/javascript">
            $(function () {
                var time = 5; // Secound
                var duration = moment.duration(time * 1000, 'milliseconds');
                var interval = 1000;

                setInterval(function () {
                    duration = moment.duration(duration.asMilliseconds() - interval, 'milliseconds');


                    if (duration.asSeconds() <= 0) {
                        // console.log("STOP!");
                        // console.log(duration.asSeconds());
                        //clearInterval(timerID);
                        window.location = 'index.php';
                    } else {
                        //show how many hours, minutes and seconds are left

                        $('.countdown').html('(' + moment(duration.asMilliseconds()).format('s') + ')');
                    }
                }, interval);


            });
        </script>
    </body>
</html>