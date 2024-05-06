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
		
		<div class="card borderless">
			<div class="row align-items-center ">
            
				<div class="col-md-12">
					<div class="card-body">
                    <img src="images/logo.jpg" alt="" class="img-fluid mb-4">
                        <form method="POST">
                            <h4 class="mb-3 f-w-400">Reset your Password</h4>
                            <hr>
                            <div class="form-group mb-4">
                                <input type="password" class="form-control" name="password" id="Password" placeholder="Password">
                            </div>
                           
                            <input type="submit" name="submit" class="btn btn-block btn-primary" value="Sign In">
                            <!-- <a href="login.php" style="color: white;" class="btn btn-block btn-secondary mb-4">Back to Login</a> -->
                            <hr>
                            <!-- <p class="mb-2 text-muted">Forgot password? <a href="resetpassword.php" class="f-w-400">Reset</a></p> -->
                            <!-- <p class="mb-0 text-muted">Don’t have an account? <a href="register.php" class="f-w-400">Signup</a></p> -->
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

            $password = md5($_POST['password']);
            $username = $_GET['username'];

            session_start();

            $user = mysqli_query($con, "UPDATE users SET `password` = '$password' WHERE username = '$username'");
            echo "<script>alert('Password Reset Successfully!')</script>";
                header('location: login.php');
         
            

        }

?>

<!-- Required Js -->
<script src="assets/js/vendor-all.min.js"></script>
<script src="assets/js/plugins/bootstrap.min.js"></script>

<script src="assets/js/pcoded.min.js"></script>



</body>

</html>
