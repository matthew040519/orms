<?php include('../include/session.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>KBRS</title>
   
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="keywords" content="">
    <!-- Favicon icon -->
    <link rel="icon" href="../assets/images/favicon.ico" type="image/x-icon">

    <!-- vendor css -->
    <link rel="stylesheet" href="../assets/css/style.css">
    
    <style>
        .fixed-button{
            display: none;
        }
    </style>

</head>
<body class="">
	<!-- [ Pre-loader ] start -->
	<div class="loader-bg">
		<div class="loader-track">
			<div class="loader-fill"></div>
		</div>
	</div>
	<!-- [ Pre-loader ] End -->
	<!-- [ navigation menu ] start -->
	<?php include('../include/navbar.php') ?>
	<!-- [ navigation menu ] end -->
	<!-- [ Header ] start -->
	<?php include('../include/header.php') ?>
	<!-- [ Header ] end -->
	
	

<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Dashboard Analytics</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Dashboard Analytics</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="mb-3">Pending Reservation</h5>
                                <?php

                                    date_default_timezone_set('Asia/Manila');
                                    $tdate = date("m/d/Y");
                                
                                    $pending = mysqli_query($con, "SELECT COUNT(*) as count FROM reservation WHERE status = 0");
                                    $countRow = mysqli_fetch_array($pending);

                                    $accepted = mysqli_query($con, "SELECT COUNT(*) as count FROM reservation WHERE status = 1");
                                    $countacceptRow = mysqli_fetch_array($accepted);

                                    $decline = mysqli_query($con, "SELECT COUNT(*) as count FROM reservation WHERE status = 2");
                                    $countdeclineRow = mysqli_fetch_array($decline);

                                    $pending = mysqli_query($con, "SELECT COUNT(*) as count FROM reservation WHERE status = 0");
                                    $countRow = mysqli_fetch_array($pending);

                                    $reserveToday = mysqli_query($con, "SELECT COUNT(*) as count FROM reservation WHERE tdate = '$tdate'");
                                    $countTodayRow = mysqli_fetch_array($reserveToday);
                                
                                ?>
                                <h2><?php echo number_format($countRow['count'], 0); ?>  <span class="text-muted m-l-5 f-14">reservation</span></h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="mb-3">Accepted Reservation</h5>
                                <h2><?php echo number_format($countacceptRow['count'], 0); ?>  <span class="text-muted m-l-10 f-14">reservation</span></h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="mb-3">Decline Reservation</h5>
                                <h2><?php echo number_format($countdeclineRow['count'], 0); ?>  <span class="text-muted m-l-5 f-14">reservation</span></h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="mb-3">Total Reservation for today</h5>
                                <h2><?php echo number_format($countTodayRow['count'], 0); ?>  <span class="text-muted m-l-10 f-14">reservation</span></h2>
                            </div>
                        </div>
                    </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Reservation Statistical Data</h5>
                    </div>
                    <div class="card-body">
                        <div id="line-chart-1"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Sales Statistical Data</h5>
                    </div>
                    <div class="card-body">
                        <div id="line-chart-2"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>

    <!-- Required Js -->
<script src="../assets/js/vendor-all.min.js"></script>
<script src="../assets/js/plugins/bootstrap.min.js"></script>
<script src="../assets/js/pcoded.min.js"></script>

<!-- Apex Chart -->
<script src="../assets/js/plugins/apexcharts.min.js"></script>
<?php
    $a = array();
    $query = mysqli_query($con, "SELECT COUNT(*) AS count, MONTH(start_date) AS monthdate FROM reservation GROUP BY MONTH(start_date)");
    while($row = mysqli_fetch_assoc($query)){
        array_push($a, $row['count']);
    }

    $sales = array();
    $query = mysqli_query($con, "SELECT SUM(totalPay) AS totalPay, MONTH(start_date) AS monthdate FROM reservation WHERE status = 1 GROUP BY MONTH(start_date)");
    while($row = mysqli_fetch_assoc($query)){
        array_push($sales, $row['totalPay']);
    }

    $month = array();
    $queryMonth = mysqli_query($con, "SELECT COUNT(*) AS count, MONTHNAME(start_date) AS monthdate FROM reservation GROUP BY MONTHNAME(start_date)");
    while($row = mysqli_fetch_assoc($queryMonth)){
        array_push($month, "'".$row['monthdate']."'");
    }

    // print_r(implode(",",$));
    // print_r(strval(implode(",",$month)));

?>
<script>
    $(document).ready(function() {
        setTimeout(function() {
            $(function() {
                var options = {
                    chart: {
                        height: 300,
                        type: 'line',
                        zoom: {
                            enabled: false
                        }
                    },
                    dataLabels: {
                        enabled: false,
                        width: 2,
                    },
                    stroke: {
                        curve: 'straight',
                    },
                    colors: ["#4169e1"],
                    series: [{
                        name: "Reserve",
                        data: [<?php print_r(implode(",",$a)); ?>]
                    }],
                    title: {
                        text: 'Reservation Trends by Month',
                        align: 'left'
                    },
                    grid: {
                        row: {
                            colors: ['#f3f6ff', 'transparent'], // takes an array which will be repeated on columns
                            opacity: 0.5
                        },
                    },
                    xaxis: {
                        categories: [<?php print_r(strval(implode(",",$month))); ?>],
                    }
                }

                var chart = new ApexCharts(
                    document.querySelector("#line-chart-1"),
                    options
                );
                chart.render();
            });

            $(function() {
                var options = {
                    chart: {
                        height: 300,
                        type: 'line',
                        zoom: {
                            enabled: false
                        }
                    },
                    dataLabels: {
                        enabled: false,
                        width: 2,
                    },
                    stroke: {
                        curve: 'straight',
                    },
                    colors: ["#4169e1"],
                    series: [{
                        name: "Sales",
                        data: [<?php print_r(implode(",",$sales)); ?>]
                    }],
                    title: {
                        text: 'Reservation Sales by Month',
                        align: 'left'
                    },
                    grid: {
                        row: {
                            colors: ['#f3f6ff', 'transparent'], // takes an array which will be repeated on columns
                            opacity: 0.5
                        },
                    },
                    xaxis: {
                        categories: [<?php print_r(strval(implode(",",$month))); ?>],
                    }
                }

                var chart = new ApexCharts(
                    document.querySelector("#line-chart-2"),
                    options
                );
                chart.render();
            });
        });

    });
    
</script>
</body>

</html>
