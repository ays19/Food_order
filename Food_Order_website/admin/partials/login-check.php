<?php 

 //Authorization - Access control
 //check whether the user is logged in or not
    if (!isset($_SESSION['user'])) //IF user session is not set
    {
        // User is nor logged in
        //redirect to login page with message
        $_SESSION['no-login-message'] = "<div class='error text-center'> Please login to access admin panel.</div>";
        //redirect to login page
        header('location:'.SITEURL.'admin/login.php');
    }
  ?>