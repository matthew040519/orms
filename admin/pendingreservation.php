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
                            <h5 class="m-b-10">Pending Reservation</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="pendingreservation.php">Pending Reservation</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
           
            
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
                        <th>Payment Status</th>
                        <th>Mode of Payment</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    
                    $query = mysqli_query($con, "SELECT reservation.id as Id, clients.client_name, rooms.room_name, 
                    rooms.Rate, DATEDIFF(checkout_date, start_date) as totalDays, reservation.mop,
                    rooms.good_for, start_date as start, checkout_date as END, reservation.totalPay, status as status1, 
                    (SELECT CASE WHEN reservation.status = 0 THEN 'Pending' WHEN reservation.status = 1 THEN 'Accepted' 
                    ELSE 'Decline' END) as status, (SELECT CASE WHEN reservation.paid = 0 THEN 'Not Paid' ELSE 'Paid' END) as paidStatus
                    FROM reservation INNER JOIN rooms ON rooms.id=reservation.room_id
    INNER JOIN clients ON clients.id=reservation.client_id
    WHERE reservation.status = 0 OR reservation.paid = 0");
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
                        <td><?php echo $row['paidStatus']; ?></td>
                        <td><?php echo $row['mop']; ?></td>
                        <td><div class="dropdown">
  <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Options
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
    <a href="" data-toggle="modal" data-target="#acceptModal<?php echo $row['Id']; ?>" class="dropdown-item">Accept</a>
    <a href="" class="dropdown-item" data-toggle="modal" data-target="#declineModal<?php echo $row['Id']; ?>">Decline</a>
    <a href="" class="dropdown-item" data-toggle="modal" data-target="#paidModal<?php echo $row['Id']; ?>">Paid</a>
  </div>
</div></td>
                        
                    </tr>
                        
                    <?php include('modals/acceptmodal.php');
                include('modals/declinemodal.php');
                include('modals/paidmodal.php'); } ?>
                </tbody>
            </table>
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>
                        <div id="exampleModalCenter" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalCenterTitle">Add Rooms</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									</div>
									<div class="modal-body">
                                        <form method="POST" enctype="multipart/form-data">
											<div class="form-group">
												<label for="recipient-name" class="col-form-label">Room Image:</label>
												<input type="file" required class="form-control" name="image" id="room-image">
											</div>
                                            <div class="form-group">
												<label for="message-text" class="col-form-label">Room Name</label>
												<input type="text" required name="room_name" class="form-control">
											</div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="message-text" class="col-form-label">Good for # of Person:</label>
                                                        <input type="number" required name="good_for_person" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="message-text" class="col-form-label">Bedroom</label>
                                                        <input type="number" required name="bedroom" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="message-text" class="col-form-label">Bath</label>
                                                        <input type="number" required name="bath" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
											<div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="message-text" class="col-form-label">Floor Area</label>
                                                        <input type="number" required name="floor_area" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="message-text" class="col-form-label">Rate</label>
                                                        <input type="text" required name="rate" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
												<label for="message-text" class="col-form-label">Room Details</label>
												<textarea name="room_details" required class="form-control" id="" cols="30" rows="10"></textarea>
											</div>
										
                                    </div>
									<div class="modal-footer">
										<button type="button" class="btn  btn-secondary" data-dismiss="modal">Close</button>
										<button type="submit" name="submit" class="btn  btn-primary">Save Room</button>
									</div>
                                    </form>
								</div>
							</div>
						</div>


        <?php
        
                if(isset($_POST['submit'])){

                    $target = "../images/". basename($_FILES['image']['name']);
                    $image = $_FILES['image']['name'];
                    $room_name = $_POST['room_name'];
                    $good_for_person = $_POST['good_for_person'];
                    $bedroom = $_POST['bedroom'];
                    $bath = $_POST['bath'];
                    $floor_area = $_POST['floor_area'];
                    $rate = $_POST['rate'];
                    $room_detail = $_POST['room_details'];

                    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)){

                        $query = mysqli_query($con, "INSERT INTO rooms (`room_name`, `good_for`, `Image`, `details`, `Bedroom`, `Baths`, `floor_area`, `Rate`) 
                        Values ('$room_name', '$good_for_person', '$image','$room_detail', '$bedroom', '$bath', '$floor_area', '$rate')");

                        echo "<script>alert('Successfully Upload')</script>";
                        echo "<script>window.location.replace('rooms.php')</script>";
                      } else {
                        echo "<script>alert('Error!')</script>";
                    }

                   
                }
        
        ?>

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
    new DataTable('#example');
</script>
</body>

</html>
