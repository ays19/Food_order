<?php 

	//iinclude Constants Page
	include('../config/constants.php');


	//echo "delete food item";

if(isset($_GET['id']) && isset($_GET['image_name'])) //Either use '&&' or 'AND' 
{
	//process to delete
	//echo "process to delete";

	//1.Get id and image name
	$id = $_GET['id'];
	$image_name = $_GET['image_name'];


	//2. remove the image if available
	//Check whether the image is available or not and delete only if available
	if ($image_name!= "") {
		// it has image and need to remove from folder
		//Get the image path
		$path = "../images/food/".$image_name;

		//remove image file from folder
		$remove = unlink($path);

		//Check whether the image is removed or not
		if ($remove==false) {
			// Failed to remove image
			$_SESSION['upload'] = "<div class='error'>Failed to remove image File.</div>"; 
			//redirect to manage food
			header('location:'.SITEURL.'admin/manage-food.php');
			//stop the process to delete food
			die();
		}
	}

	//3.felete food from database
	$sql = "DELETE FROM tbl_food WHERE id=$id";
	$res = mysqli_query($conn, $sql);

	//Check whether query executed or not set the session message respictively
	//4. redirect to manage food with session message
	if ($res==true) {
		// Food Deleted
		$_SESSION['delete']="<div class='success'>Food Deleted Successfully.</div>";\
		header('location:'.SITEURL. 'admin/manage-food.php');
	}
	else{
		//Failed to delete food
		$_SESSION['delete']="<div class='success'>Failed to delete food.</div>";\
		header('location:'.SITEURL. 'admin/manage-food.php');
	}

	
}
else{
	//redirect to manage food page
	//echo "redirect";
	$_SESSION['Unauthorized']= "<div class='error'>Unauthorized Access.</div>";
	header('location:'.SITEURL.'admin/manage-food.php');
 }
 ?>
