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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/font-awesome.min.css">
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
                            <h5 class="m-b-10">Booking</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="booking.php">Booking</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <!-- <div class="row">
            <div class="col-md-12">
                    <div class="card">
                        <form action="" method="POST">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="message-text" class="col-form-label">Bedrooms</label>
                                            <select class="form-control" name="bedrooms" id="">
                                                <option value="all" selected>All</option>
                                                <option value="1" >1</option>
                                                <option value="2" >2</option>
                                                <option value="3" >3</option>
                                                <option value="4" >4</option>
                                                <option value="5" >5+</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="message-text" class="col-form-label">Bathrooms</label>
                                            <select class="form-control" name="bathrooms" id="">
                                                <option value="all" selected>All</option>
                                                <option value="1" >1</option>
                                                <option value="2" >2</option>
                                                <option value="3" >3</option>
                                                <option value="4" >4</option>
                                                <option value="5" >5+</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="message-text" class="col-form-label">Amenities</label>
                                            <select class="form-control" name="amenities" id="">
                                                <option value="all" selected></option>
                                                <?php $query = mysqli_query($con, "SELECT DISTINCT('amenities') as room, id, amenities FROM amenities WHERE active = 1");
                                                while($row = mysqli_fetch_array($query)){ ?>
                                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['amenities']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-5">
                                        <input type="submit" name="submit" class="btn btn-primary" value="Search">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
            </div>
        </div> -->
        <div class="row">
            <?php 
                if (isset($_GET['pageno'])) {
                    $pageno = $_GET['pageno'];
                } else {
                    $pageno = 1;
                }
                $no_of_records_per_page = 12;
                $offset = ($pageno-1) * $no_of_records_per_page;    
                $total_pages_sql = "SELECT COUNT(*) FROM rooms";
                $result = mysqli_query($con,$total_pages_sql);
                $total_rows = mysqli_fetch_array($result)[0];
                $total_pages = ceil($total_rows / $no_of_records_per_page);

                $sql = "SELECT * FROM rooms LIMIT $offset, $no_of_records_per_page";
                $res_data = mysqli_query($con,$sql);
                while($row = mysqli_fetch_array($res_data)){
                  $id = $row["id"];
                
            ?>
            <div class="col-md-4">
                <div class="card">
					<img class="img-fluid card-img-top" src="../images/<?php echo $row['Image']; ?>" alt="Card image cap">
					<div class="card-body">
						<h5 class="card-title"><?php echo $row['room_name']; ?></h5>
						<p class="card-text"><?php echo $row['details']; ?></p>
                        <ul>
                                    <?php $query1 = mysqli_query($con, "SELECT setuprooms.id, amenities.amenities FROM setuprooms INNER JOIN amenities ON amenities.id=setuprooms.amenities_id WHERE setuprooms.room_id = '$id'");
                                    while($row1 = mysqli_fetch_array($query1)){ ?>
                                    <li id="<?php echo $row1['id']; ?>"><?php echo $row1['amenities']; ?></li>
                                    <?php } ?>
                                </ul>
                        <a href="rooms.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm"><i class="fas fa-list-check"></i> Book Now!</a>
                        
                        <!-- <button type="button" class="btn  btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa-solid fa-list-check"></i> Book Now!</button> -->
                       
                        
					</div>
					<div class="card-footer">
						<!-- <small class="text-muted" >Last updated 3 mins ago</small> -->
                        <div class="row">
                            <div class="col-md-3">
                                <i class="fa fa-bath fa-lg"></i> <?php echo $row['Baths']; ?> <br> Bathroom
                            </div>
                            <div class="col-md-3">
                                <i class="fa fa-bed fa-lg"></i> <?php echo $row['Bedroom']; ?> <br> Bedroom
                            </div>
                            <div class="col-md-3">
                                <i class="fa fa-microchip fa-lg"></i> <?php echo $row['floor_area']; ?> <br> Floor Area
                            </div>
                            <div class="col-md-3">
                                <h5>&#8369; <?php echo number_format($row['Rate'], 2); ?></h5>
                            </div>
                        </div>
					</div>
				</div>
            </div>
            <?php } ?>
            
        </div>
        <nav aria-label="Page navigation example">
							<ul class="pagination justify-content-center">
								<li class="page-item <?php if($pageno <= 1){ echo 'disabled'; } ?>">
									<a class="page-link" href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>" tabindex="-1">Previous</a>
								</li>
                                <?php
                                    for ($i = 1; $i <= $total_pages; $i++)
                                    {?>
                                        <li id="<?php echo $i;?>" class="page-item"><a class="page-link" href="?pageno=<?php echo $i;?>"><?php echo $i;?></a></li>
                                    <?php           
                                    }
                                ?>
								<!-- <li class="page-item"><a class="page-link" href="#!">1</a></li>
								<li class="page-item"><a class="page-link" href="#!">2</a></li>
								<li class="page-item"><a class="page-link" href="#!">3</a></li> -->
								<li class="page-item <?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
									<a class="page-link" href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
								</li>
							</ul>
						</nav>
        <!-- [ Main Content ] end -->
    </div>
</div>
<!-- [ Main Content ] end -->
    <!-- Warning Section start -->
    <!-- Older IE warning message -->
    <!--[if lt IE 11]>
        <div class="ie-warning">
            <h1>Warning!!</h1>
            <p>You are using an outdated version of Internet Explorer, please upgrade
               <br/>to any of the following web browsers to access this website.
            </p>
            <div class="iew-container">
                <ul class="iew-download">
                    <li>
                        <a href="http://www.google.com/chrome/">
                            <img src="assets/images/browser/chrome.png" alt="Chrome">
                            <div>Chrome</div>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.mozilla.org/en-US/firefox/new/">
                            <img src="assets/images/browser/firefox.png" alt="Firefox">
                            <div>Firefox</div>
                        </a>
                    </li>
                    <li>
                        <a href="http://www.opera.com">
                            <img src="assets/images/browser/opera.png" alt="Opera">
                            <div>Opera</div>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.apple.com/safari/">
                            <img src="assets/images/browser/safari.png" alt="Safari">
                            <div>Safari</div>
                        </a>
                    </li>
                    <li>
                        <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                            <img src="assets/images/browser/ie.png" alt="">
                            <div>IE (11 & above)</div>
                        </a>
                    </li>
                </ul>
            </div>
            <p>Sorry for the inconvenience!</p>
        </div>
    <![endif]-->
    <!-- Warning Section Ends -->

    <!-- Required Js -->
    <script src="../assets/js/vendor-all.min.js"></script>
    <script src="../assets/js/plugins/bootstrap.min.js"></script>
    <script src="../assets/js/pcoded.min.js"></script>

<!-- Apex Chart -->
<script src="../assets/js/plugins/apexcharts.min.js"></script>


<!-- custom-chart js -->
<script src="../assets/js/pages/dashboard-main.js"></script>
</body>

</html>
