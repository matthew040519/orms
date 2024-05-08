<?php include('../include/client_session.php'); ?>
<?php 

    $id = $_GET['id'];

    $queryy = mysqli_query($con,"SELECT * FROM rooms WHERE id = '$id'");
    $row = mysqli_fetch_array($queryy);
?>
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
    <script src="https://www.paypal.com/sdk/js?client-id=AT5OR1upPNtu9s65ThBDBoHCVHoY5FgyeVNoHMItMVnWkBqQyxn3N3l9ZAYsxEy0CO6LWJkzfk6j9YdE&currency=PHP"></script>
    <link rel="stylesheet" href="../fullcalendar/fullcalendar.min.css" />
    <script src="../fullcalendar/lib/jquery.min.js"></script>
    <script src="../fullcalendar/lib/moment.min.js"></script>
    <script src="../fullcalendar/fullcalendar.min.js"></script>
    <script>

$(document).ready(function () {
    var date = new Date()
        var d    = date.getDate(),
            m    = date.getMonth(),
            y    = date.getFullYear()
    var calendar = $('#calendar').fullCalendar({
        editable: false,
        disableDragging: true,
        events:  "fetch-event.php?room_id=" + <?php echo $_GET['id']; ?>,
        nextDayThreshold: '08:00:00',
        displayEventTime: true,
        eventRender: function (event, element, view) {
            // if (event.allDay === 'true') {
            //     event.allDay = true;
            // } else {
            //     event.allDay = false;
            // }
            // event.allDay = 'true';
            console.log(view)
            
            
        },
        // validRange:{
        //         start: moment(date).format("YYYY-MM-DD"),
        //     },
        selectable: true,
        selectHelper: true, 
        eventDidMount:function(info){
                // console.log(appointment)
                // if(!!appointment[info.event.startStr]){
                    // var available = parseInt(info.event.title) - parseInt(appointment[info.event.startStr]);
                     $(info.el).find('.fc-event-title.fc-sticky').text('60')
                // }
                // end_loader()
        },
        select: function (start, end, allDay, view) {
            console.log(end)
            var dateToday = moment(date).format("Y-MM-DD");
            var start = moment(start).format("Y-MM-DD");
            var end = moment(end).subtract(1, "days").format("Y-MM-DD");
        
            if(start >= dateToday)
            {
                
                let date1 = new Date(start);
                let date2 = new Date(end);
                
                let Difference_In_Time =
                    date2.getTime() - date1.getTime();
                
                    // console.log(Difference_In_Time);

                $('#checkindate').val(start);
                $('#checkoutdate').val(end);
                
                let Difference_In_Days =
                    Math.round
                        (Difference_In_Time / (1000 * 3600 * 24));
                
                        console.log(Difference_In_Days);
                var total = <?php echo $row['Rate']; ?>;
                if(Difference_In_Days > 0)
                {
                    total = Difference_In_Days * <?php echo $row['Rate']; ?>
                }
                
                
                $('#totalPay').val(total);
                $('#calendarModal').modal();
            }
            
            
            calendar.fullCalendar('unselect');
        },
        
        editable: false,
        // eventDrop: function (event, delta) {
        //             var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
        //             var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
        //             $.ajax({
        //                 url: 'edit-event.php',
        //                 data: 'title=' + event.title + '&start=' + start + '&end=' + end + '&id=' + event.id,
        //                 type: "POST",
        //                 success: function (response) {
        //                     displayMessage("Updated Successfully");
        //                 }
        //             });
        //         },
        eventClick: function (event) {
            var deleteMsg = confirm("Do you really want to delete?");
            if (deleteMsg) {
                $.ajax({
                    type: "POST",
                    url: "delete-event.php",
                    data: "&id=" + event.id,
                    success: function (response) {
                        if(parseInt(response) > 0) {
                            $('#calendar').fullCalendar('removeEvents', event.id);
                            displayMessage("Deleted Successfully");
                        }
                    }
                });
            }
        },
        selectAllow: function(selectInfo) {
            
            selectInfo.start.startOf("day");
            selectInfo.end.startOf("day");

            var evts = $("#calendar").fullCalendar("clientEvents", function(evt) {
                var st = evt.start.clone().startOf("day");
                if (evt.end) { var ed = evt.end.clone().startOf("day"); }
                else { ed = st; }

                
                return (selectInfo.start.isSameOrBefore(ed) && selectInfo.end.isSameOrAfter(st));
            });

            
            return evts.length == 0;
            },

    });
});
    </script>
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
	<!-- <div class="loader-bg">
		<div class="loader-track">
			<div class="loader-fill"></div>
		</div>
	</div> -->
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
                            <h5 class="m-b-10">Room</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="rooms.php?id=<?php echo $row['id']; ?>"><?php echo $row['room_name']; ?></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
            <div class="col-sm-6">
                <div class="card">
					<div class="card-header">
						<!-- <h5></h5> -->
                        <img class="img-fluid card-img-top" style="height: 500px;" src="../images/<?php echo $row['Image']; ?>" alt="Card image cap">
					</div>
					<div class="card-body">
                        <h5 class="card-title"><?php echo $row['room_name']; ?></h5>
						<ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
							<li class="nav-item">
								<a class="nav-link active text-uppercase" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Overview</a>
							</li>
							<li class="nav-item">
								<a class="nav-link text-uppercase" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Amenities</a>
							</li>
							<li class="nav-item">
								<a class="nav-link text-uppercase" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Details</a>
							</li>
						</ul>
						<div class="tab-content" id="myTabContent">
							<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
								<p class="mb-0">
                                    <?php echo $row['details']; ?>
								</p>
							</div>
							<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
								<ul>
                                    <?php $query1 = mysqli_query($con, "SELECT setuprooms.id, amenities.amenities FROM setuprooms INNER JOIN amenities ON amenities.id=setuprooms.amenities_id WHERE setuprooms.room_id = '$id'");
                                    while($row1 = mysqli_fetch_array($query1)){ ?>
                                    <li id="<?php echo $row1['id']; ?>"><?php echo $row1['amenities']; ?></li>
                                    <?php } ?>
                                </ul>
                            </div>
							<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
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
				</div>
            </div>
            <div class="col-sm-6">
                <div id="calendar"></div>
            </div>
        </div>
        <div id="calendarModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered modal-md" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalCenterTitle">Reserve</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									</div>
									<div class="modal-body">
                                        <form method="POST">
                                        <input type="hidden" id="room_id" value="<?php echo $_GET['id']; ?>">
                                            <div class="form-group">
												<label for="recipient-name" class="col-form-label">Check in Date</label>
                                                <input type="text" readonly name="checkindate" id="checkindate" class="form-control">
											</div>
                                            <div class="form-group">
												<label for="recipient-name" class="col-form-label">Check in Time</label>
                                                <input type="time" name="checkintime" id="checkintime" class="form-control">
											</div>
                                            <div class="form-group">
												<label for="recipient-name" class="col-form-label">Checkout Date</label>
                                                <!-- <input type="date" name="checkoutdate" id="checkoutdate" class="form-control"> -->
                                                <input type="text" readonly name="checkoutdate" id="checkoutdate" class="form-control">
											</div>
                                            <div class="form-group">
												<label for="recipient-name" class="col-form-label">Mode of Payment</label>
                                                <select class="form-control" name="mop" id="mop">
                                                    <option disabled selected value="">Select Mode of Payment</option>
                                                    <option value="cash">Cash</option>
                                                    <option value="paypal">Paypal</option>
                                                </select>
											</div>
                                            <div class="form-group">
												<label for="recipient-name" class="col-form-label">Total Rate</label>
                                                <input type="text" readonly id="totalPay" class="form-control" id="totalPay">
											</div>
                                            
                                            <div style="display: none;" id="paypal-button-container"></div>
                                    </div>
									<div class="modal-footer" id="modalfooter" style="display: none;">
										<button type="button" class="btn  btn-secondary" data-dismiss="modal">Close</button>
										<button type="submit" name="submit" class="btn  btn-primary">Reserve Now!</button>
									</div>
                                    </form>
								</div>
							</div>
						</div>
                        <?php
                            if(isset($_POST['submit'])){

                                date_default_timezone_set('Asia/Manila');
                                $tdate = date("m/d/Y");

                                $checkindate = $_POST['checkindate'];
                                $checkoutdate = $_POST['checkoutdate'];
                                $checkintime = $_POST['checkintime'];
                                $mop = $_POST['mop'];
                                $room_id = $_GET['id'];
                                $client_id = $_SESSION['id'];

                                $getClientID = mysqli_query($con, "SELECT * FROM clients WHERE user_id = '$client_id'");
                                $res = mysqli_fetch_array($getClientID);
                                $finalClientID = $res["id"];

                                $getRoomDetails = mysqli_query($con, "SELECT * FROM rooms WHERE id = '$room_id'");
                                $resRoom = mysqli_fetch_array($getRoomDetails);
                                $rate = $resRoom["Rate"];

                                $date1=date_create($checkindate);
                                $date2=date_create($checkoutdate);
                                $diff=date_diff($date1,$date2);

                                $totalPay = $diff->format("%R%a") * $rate;
                                

                                $reference = rand(10,10000000);


                                mysqli_query($con, "INSERT INTO reservation (`reference`, `tdate`,`client_id`, `room_id`, `start_date`, `checkout_date`, `time`, `totalPay`, `mop`)
                                    Values ('$reference', '$tdate', '$finalClientID', '$room_id', '$checkindate', '$checkoutdate', '$checkintime', '$totalPay', '$mop')");
                                    // echo "<script>window.location.replace('addwalkin.php')</script>";

                             }
                        ?>
                        <!-- -->
    </div>
</div>

    <!-- Required Js -->
    <!-- <script src="../assets/js/vendor-all.min.js"></script> -->
    <script src="../assets/js/plugins/bootstrap.min.js"></script>
    <script src="../assets/js/pcoded.min.js"></script>


<script>
    $(document).ready(function () {

        $('#mop').change(function() {
            var mop = $('#mop').val();
            console.log(mop)
            if(mop == 'cash')
            {
                $('#modalfooter').css('display', 'block');
                $('#paypal-button-container').css('display', 'none');
            }
            else if(mop == 'paypal')
            {
                $('#paypal-button-container').css('display', 'block');
                $('#modalfooter').css('display', 'none');
            }
             
        });

    })
</script>
<script>
        paypal.Buttons({
        createOrder: function(data, actions) {
            // setup transaction
            return actions.order.create({
                payer: {
                    payer_info: {
                        email: 'test',
                        first_name: 'test'
                    }
                },
                purchase_units: [{
                   amount: {
                       value: $('#totalPay').val()
                   }
                }]
            });
        },
        onApprove: function(data, actions) {
            // capture funds from transaction
            return actions.order.capture().then(function(details) {
                // return fetch('/paypal-transaction-complete', {
                //     method: 'post',
                //     body: JSON.stringify({
                //         orderID: data.orderID
                //     })
                // });

                $data = { 

                    checkindate: $('#checkindate').val(),
                    checkoutdate: $('#checkoutdate').val(),
                    checkintime: $('#checkintime').val(),
                    totalPay: $('#totalPay').val(),
                    room_id: $('#room_id').val(),
                    mop: $('#mop').val(),
                }

                $.ajax({
                    type: "POST",
                    url: 'paypal-transaction-complete.php',
                    data: $data,
                    success: function(response){
                        //if request if made successfully then the response represent the data

                        // $( "#result" ).empty().append( response );
                        location.reload(true);
                    }
                });
            });
        }
    }).render('#paypal-button-container');
    </script>
</body>

</html>
