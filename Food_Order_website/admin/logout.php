<?php 
	//include constants.php for siteurl
	include('../config/constants.php');
	//desroy the session
	session_destroy(); //unset $_session['user']

	//2. Redirect to login page
	header('location:'.SITEURL.'admin/login.php');

 ?>