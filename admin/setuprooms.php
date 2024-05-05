<?php include('../include/session.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>ORMS</title>
   
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
                            <h5 class="m-b-10">Rooms With Amenities</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="setuprooms.php">Rooms With Amenities</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
            <?php

                if(isset($_GET['add']) == "success") { ?>

<div class="alert alert-success alert-dismissible fade show" role="alert">
							<strong>Save</strong> Succesfully
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						</div>
               <?php  }


            ?>
            <div class="col-md-4">
                <button type="button" class="btn  btn-primary" data-toggle="modal" data-target="#exampleModalCenter"><i class="feather icon-plus"></i> Add Setup</button>
            </div>
            
            <table id="example" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th style="text-align: left">Id</th>
                        <th>Room</th>
                        <th>Amenities</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $query = mysqli_query($con, "SELECT setuprooms.id as id, amenities.amenities, rooms.room_name FROM setuprooms 
                    INNER JOIN rooms ON  setuprooms.room_id = rooms.id INNER JOIN amenities ON amenities.id=setuprooms.amenities_id");
                    while($row= mysqli_fetch_array($query)){
                    ?>
                    <tr>
                        <td style="text-align: left"><?php echo $row['id']; ?></td>
                        <td><?php echo $row['room_name']; ?></td>
                        <td><?php echo $row['amenities']; ?></td>
                    </tr>
                    <?php } ?>
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
										<h5 class="modal-title" id="exampleModalCenterTitle">Add Amenities</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									</div>
									<div class="modal-body">
                                        <form method="POST">
											<div class="form-group">
												<label for="recipient-name" class="col-form-label">Amenities</label>
												<select name="amenities" class="form-control" id="">
                                                    <?php $query = mysqli_query($con, "SELECT * FROM amenities WHERE active = 1");
                                                    while($row = mysqli_fetch_array($query)){ ?>
                                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['amenities']; ?></option>
                                                    <?php } ?>
                                                </select>
											</div>
                                            <div class="form-group">
												<label for="recipient-name" class="col-form-label">Rooms</label>
												<select name="room" class="form-control" id="">
                                                    <?php $query = mysqli_query($con, "SELECT * FROM rooms WHERE active = 1");
                                                    while($row = mysqli_fetch_array($query)){ ?>
                                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['room_name']; ?></option>
                                                    <?php } ?>
                                                </select>
											</div>
                                    </div>
									<div class="modal-footer">
										<button type="button" class="btn  btn-secondary" data-dismiss="modal">Close</button>
										<button type="submit" name="submit" class="btn  btn-primary">Save</button>
									</div>
                                    </form>
								</div>
							</div>
						</div>


        <?php
        
                if(isset($_POST['submit'])){

                    $amenities = $_POST['amenities'];
                    $room =  $_POST['room'];

                    mysqli_query($con, "INSERT INTO setuprooms (`room_id`, `amenities_id`) VALUES ('$room','$amenities')");

                    echo "<script>window.location.replace('setuprooms.php?add=success')</script>";

                   
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
