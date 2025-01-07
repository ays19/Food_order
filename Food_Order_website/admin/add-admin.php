<?php include("partials/menu.php"); ?>

<div class="main-content"><div class="wrapper">
<h1>Add Admin</h1>
	
	<br></br>

	<?php 
		if(isset($_SESSION['add']))
		{
			echo $_SESSION['add'];//Dispalyin session Message
			unset($_SESSION['add']);//Removing session Message
		}
	 ?>

	<form action="" method="POST">
		
		<table class="tbl-30">
			<tr>
				<td>Full Name: </td>
				<td>
					<input type="text" name="full_name" placeholder="Enter Your Name "></td>
			</tr>

			<tr>
				<td>Username: </td>
				<td>
					<input type="text" name="username" placeholder="Your Username">
				</td>
				</tr>
				<tr>
					<td>Password</td>
					<td>
						<input type="password" name="password" placeholder="Your password">
					</td>
				</tr>
			
				<tr>
					<td colspan="2">
					<input type="submit" name="submit" value="Add Admin" class="btn-secondary"> </td>
				</tr>
		</table>
	</form>
</div>
</div>


<?php include("partials/footer.php"); ?>

<?php 
	//process the value from form and save it in database
   //check wheteher the submit button is clicked or not

   if(isset($_POST['submit']))
   {
   	//button Clicked
   	//echo "Button Clicked";

   	//Get the from form
   	$full_name=$_POST ['full_name'];
   	$username = $_POST['username'];
   	$password = md5($_POST['password']); //password encryption with md5

   	//sql query to save the data into database
   	$sql = "INSERT INTO tbl_admin SET 
   	full_name='$full_name',
   	username='$username',
   	password='$password'
	";
	
	//Executing Query and saving data intoo database
	$res = mysqli_query($conn, $sql) or die(mysqli_error());
	//Check whether The (query is execued) data is inserted or not and display approporoate message
	if($res==TRUE){
		//data Inserted
		//echo "Data Inserted";
		//create a session variable to display message
		$_SESSION['add']= "Admin Added Successfully";
		//redirect page TO MANAGE ADMIN
		header("location:".SITEURL.'admin/manage-admin.php');
	} 
	else{
		//Failed to insert data
		//echo "Failed to insert data";
		//create a session variable to display message
		$_SESSION['add']= "Failed to Add Admin";
		//redirect page TO MANAGE ADMIN
		header("location:".SITEURL.'admin/add-admin.php');
	
	}

   } 

 ?>