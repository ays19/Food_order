<?php include('../config/constants.php') ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login - Food Order System</title>
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
</head>
<body>

	<div class="login"> 
		<h1 class="text-center">Login</h1> <br> <br>

		<?php 
			if (isset($_SESSION['login'])) {
				echo $_SESSION['login'];
				unset ($_SESSION['login']);
			}

			if (isset($_SESSION['no-login-message'])) {
				
				echo $_SESSION['no-login-message'];
				unset ($_SESSION['no-login-message']);
			}
		 ?>
		 <br><br>
		<!-- Login Start here -->
		<form action="" method="POST" class="text-center">
			username: <br>
			<input type="text" name="username" placeholder="Enter Username"> <br> <br>
			password: <br>
			<input type="password" name="password" placeholder="Enter Password "> <br> <br>

			<input type="submit" name="submit" value="Login" class="btn-primary"> <br> <br>
		</form>

		<!-- Login End here -->

		<p class="text-center">Created by - <a href="www.sno.com"> SNO </a></p>
	</div>

</body>
</html>

<?php 
	//Check whether the submit button is clicked or not//
	if (isset($_POST['submit'])) {
		// proces for login
		// get the data from login form
		//$username = $_POST['username'];
		//$password = md5($_POST['password']);
		$username =mysqli_real_escape_string($conn, $_POST['username']);
			$raw_password = md5($_POST['password']);
		$password =mysqli_real_escape_string($conn,$raw_password);

		//2.SQL to check whether the user with username and password exists or not
		$sql = "SELECT * FROM tbl_admin WHERE username ='$username' AND password = '$password'";
		//3. Exucute the Query
		$res = mysqli_query($conn, $sql);

		//4. count rows to check whether the user exists or not 
		$count = mysqli_num_rows($res);
		if ($count==1) {
			// User availabale and login success
			$_SESSION['login'] = "<div class = 'success'>Login Successful.</div>";
			$_SESSION['user'] = $username;//to check whether the user is logged in or not and loguot will unset it
			//Redirect to home page/dashboard
			header('location:'.SITEURL.'admin/');
		}
		else{
			//User not available and login fail
			$_SESSION['login'] = "<div class = 'error text-center'>Username or password did not match.</div>";
			//Redirect to home page/dashboard
			header('location:'.SITEURL.'admin/login.php');
		}
	}
 ?>