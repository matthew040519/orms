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
                            <h4 class="mb-3 f-w-400">Signin</h4>
                            <hr>
                            <div class="form-group mb-3">
                                <input type="text" class="form-control" name="username" id="Username" placeholder="Username">
                            </div>
                            <div class="form-group mb-4">
                                <input type="password" class="form-control" name="password" id="Password" placeholder="Password">
                            </div>
                            <!-- <div class="custom-control custom-checkbox text-left mb-4 mt-2">
                                <input type="checkbox" class="custom-control-input" id="customCheck1">
                                <label class="custom-control-label" for="customCheck1">Save credentials.</label>
                            </div> -->
                            <input type="submit" name="submit" class="btn btn-block btn-primary mb-4" value="Sign In">
                            <hr>
                            <!-- <p class="mb-2 text-muted">Forgot password? <a href="auth-reset-password.html" class="f-w-400">Reset</a></p> -->
                            <p class="mb-0 text-muted">Don’t have an account? <a href="register.php" class="f-w-400">Signup</a></p>
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

            session_start();

            $user = mysqli_query($con, "SELECT * FROM users WHERE username = '$username' and active = 1");
            $rowuser = mysqli_fetch_array($user);

            $checkusername = mysqli_num_rows($user);

            if($checkusername > 0)
            {
              if ($password == $rowuser['password']) {

                session_regenerate_id();

                $_SESSION['loggedin'] = TRUE;
                $_SESSION['role'] = $rowuser['role'];
                $_SESSION['username'] = $rowuser['username'];
                $_SESSION['id'] = $rowuser['id'];

                if($rowuser['role'] == 1)
                {
                    header('location: admin/index.php');
                }
                else if($rowuser['role'] == 2) {
                    $id = $_SESSION['id'];
                    $client = mysqli_query($con, "SELECT * FROM clients WHERE user_id = '$id'");
                    $res = mysqli_fetch_array($client);
                    $_SESSION['fullname'] = $res['client_name'];
                    $_SESSION['client_id'] = $res['id'];
                    header('location: clients/index.php');
                }
                

              } else {
                echo "<script>alert('Invalid Password.')</script>";
              }
            } else {
                echo "<script>alert('Invalid Username or Password.')</script>";
            }
            

        }

?>

<!-- Required Js -->
<script src="assets/js/vendor-all.min.js"></script>
<script src="assets/js/plugins/bootstrap.min.js"></script>

<script src="assets/js/pcoded.min.js"></script>



</body>

</html>
