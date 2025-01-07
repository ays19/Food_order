<?php 

	//Start session
	session_start();

	//Create Constants to store non Repeating values
	define('SITEURL', 'http://localhost/Food_Order_website/');
	define('LOCALHOST', 'localhost');
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD','');
	define('DB_NAME', 'food_order');

	$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or (mysqli_error()); //Database Connection
		$db_select= mysqli_select_db($conn, DB_NAME) or (mysqli_error()); //selectinating Database

 ?>