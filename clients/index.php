<?php include('../include/client_session.php'); ?>
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
    <meta name="author" content="Phoenixcoded" />
    <!-- Favicon icon -->
    <link rel="icon" href="../assets/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap5.css">

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
                            <h5 class="m-b-10">Reservation Status</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="index.php">Reservation Status</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
        <button type="button" style="display: none;" id="modal" class="btn  btn-primary" data-toggle="modal" data-target="#exampleModalCenter"><i class="feather icon-plus"></i> Add Rooms</button>
            <table id="example" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Client Name</th>
                        <th>Room Name</th>
                        <th>Good For</th>
                        <th>Date From</th>
                        <th>Date To</th>
                        <th>Room Rate</th>
                        <th>Days</th>
                        <th>Total Rate</th>
                        <th>Mode of Payment</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $client_id = $_SESSION['client_id']; 
                    $query = mysqli_query($con, "SELECT reservation.id as Id, clients.client_name, rooms.room_name, 
                    rooms.Rate, DATEDIFF(checkout_date, start_date) as totalDays, reservation.mop,
                    rooms.good_for, start_date as start, checkout_date as END, reservation.totalPay, status as status1, 
                    (SELECT CASE WHEN reservation.status = 0 THEN 'Pending' WHEN reservation.status = 1 THEN 'Accepted' 
                    ELSE 'Decline' END) as status
                    FROM reservation INNER JOIN rooms ON rooms.id=reservation.room_id
    INNER JOIN clients ON clients.id=reservation.client_id
    WHERE reservation.client_id = '$client_id'");
                    while($row= mysqli_fetch_array($query)){
                    ?>
                    <tr>
                        <td><?php echo $row['client_name']; ?></td>
                        <td><?php echo $row['room_name']; ?></td>
                        <td><?php echo $row['good_for']; ?></td>
                        <td><?php echo $row['start']; ?></td>
                        <td><?php echo $row['END']; ?></td>
                        <td><?php echo number_format($row['Rate'], 2); ?></td>
                        <td><?php echo $row['totalDays']; ?></td>
                        <td><?php echo number_format($row['totalPay'], 2); ?></td>
                        <td><?php echo $row['mop']; ?></td>
                        <td><span class="badge badge-<?php 
                        if($row['status1'] == 1) { echo 'primary'; }
                        else if($row['status1'] == 0) {echo 'secondary';}
                        else { echo 'danger'; } ?>"><?php echo $row['status']; ?></span></td>
                        
                    </tr>
                        
                    <?php  } ?>
                </tbody>
            </table>
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>
                        <div id="exampleModalCenter" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered modal-md" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalCenterTitle">Instructions for Booking:</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									</div>
									<div class="modal-body">
                                        <ol>
                                            <li class="mb-3">Select Your Start Date: Slide to the specific date you wish to begin your booking.</li>
                                            <li class="mb-3">Choose Your End Date: Continue sliding until you reach the end date you desire for your booking.</li>
                                            <li class="mb-3">Confirm Your Selection: Once you've set both the start and end dates, finalize your booking by confirming your selection.</li>
                                        </ol>
                                    </div>
									<div class="modal-footer">
										<button type="button" class="btn  btn-secondary" data-dismiss="modal">Close</button>
										<!-- <button type="submit" name="submit" class="btn  btn-primary">Save Room</button> -->
									</div>
                                    </form>
								</div>
							</div>
						</div>

    <!-- Required Js -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap5.js"></script>
    <script src="../assets/js/vendor-all.min.js"></script>
    <script src="../assets/js/plugins/bootstrap.min.js"></script>
    <script src="../assets/js/pcoded.min.js"></script>

<!-- Apex Chart -->
<script src="../assets/js/plugins/apexcharts.min.js"></script>


<!-- custom-chart js -->
<script src="../assets/js/pages/dashboard-main.js"></script>
<script>
    $(document).ready(function (){
        $('#modal').click();
    });
    new DataTable('#example');
</script>
</body>

</html>
