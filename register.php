<!DOCTYPE html>
<html lang="en">

<head>

	<title>ORMS</title>
	
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="description" content="" />
	<meta name="keywords" content="">
	<meta name="author" content="Phoenixcoded" />
	<!-- Favicon icon -->
	<link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">

	<!-- vendor css -->
	<link rel="stylesheet" href="assets/css/style.css">
	
	<style>
        .fixed-button{
            display: none;
        }
    </style>


</head>

<!-- [ auth-signin ] start -->
<div class="auth-wrapper">
	<div class="auth-content text-center">
		<img src="assets/images/logo.png" alt="" class="img-fluid mb-4">
		<div class="card borderless">
			<div class="row align-items-center ">
				<div class="col-md-12">
					<div class="card-body">
                        <form method="POST">
                            <h4 class="mb-3 f-w-400">SignUp</h4>
                            <hr>
                            <div class="form-group mb-3">
                                <input type="text" class="form-control" name="client_name" id="Username" placeholder="Fullname">
                            </div>
                            <div class="form-group mb-3">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                            </div>
                            <div class="form-group mb-3">
                                <input type="number" class="form-control" name="contact_number" id="contact" placeholder="Contact Number">
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" class="form-control" name="username" id="Username" placeholder="Username">
                            </div>
                            <div class="form-group mb-3">
                                <input type="password" class="form-control" name="password" id="Password" placeholder="Password">
                            </div>
                            <div class="form-group mb-4">
                                <textarea name="address" class="form-control" placeholder="Address" id="" cols="30" rows="4"></textarea>
                            </div>
                            <!-- <div class="custom-control custom-checkbox text-left mb-4 mt-2">
                                <input type="checkbox" class="custom-control-input" id="customCheck1">
                                <label class="custom-control-label" for="customCheck1">Save credentials.</label>
                            </div> -->
                            <input type="submit" name="submit" class="btn btn-block btn-primary mb-4" value="Sign In">
                            <hr>
                            <!-- <p class="mb-2 text-muted">Forgot password? <a href="auth-reset-password.html" class="f-w-400">Reset</a></p> -->
                            <p class="mb-0 text-muted">Have an account? <a href="index.php" class="f-w-400">Signin</a></p>
                        </form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- [ auth-signin ] end -->

<?php

        include('include/connection.php');

        if(isset($_POST["submit"]))
        {
            include('include/connection.php');

            $username = $_POST['username'];
            $password = md5($_POST['password']);
            $client_name = $_POST['client_name'];
            $email = $_POST['email'];
            $contact_number = $_POST['contact_number'];
            $address = $_POST['address'];

            $user = mysqli_query($con, "INSERT INTO users (`username`, `password`, `role`) VALUES ('$username', '$password', 2)");

            $userData = mysqli_query($con, "SELECT id FROM users WHERE username = '$username'");
            $rowUser = mysqli_fetch_array($userData);
            $user_id = $rowUser["id"];

            $query = mysqli_query($con, "INSERT INTO clients (`client_name`, `email`, `address`, `contact_number`, `user_id`) VALUES 
                    ('$client_name', '$email', '$address', '$contact_number', '$user_id')");
            
            

            header('location: index.php');

        }

?>

<!-- Required Js -->
<script src="assets/js/vendor-all.min.js"></script>
<script src="assets/js/plugins/bootstrap.min.js"></script>

<script src="assets/js/pcoded.min.js"></script>



</body>

</html>
