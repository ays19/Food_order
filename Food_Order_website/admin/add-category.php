<?php include('partials/menu.php');?>

<div class="main-content">
	<div class="wrapper">
		<h1>Add Category</h1>
		<br><br>

		<?php 

		if (isset($_SESSION['add'])) {

			echo $_SESSION['add'];
			unset($_SESSION['add']);
		}
		if (isset($_SESSION['upload'])) {

			echo $_SESSION['upload'];
			unset($_SESSION['upload']);
		}
		 ?>

		 <br><br>

		<!-- Add Category form Starts -->
		<form action="" method="POST" enctype="multipart/form-data">
			
			<table class="tbl-30">
				<tr>
					<td>Title: </td>
					<td>
						<input type="text" name="title" placeholder="Category Title">
					</td>
				</tr>

				<tr>
					<td>Select Image: </td>
					
					<td>
						<input type="file" name="image">
					</td>
				</tr>
				<tr>
				<td>Featured: </td>
					<td>
						<input type="radio" name="featured" value="Yes">Yes
						<input type="radio" name="featured" value="NO">NO
					</td>
				</tr>

				<tr>
					<td>Active: </td>
					<td>
						<input type="radio" name="active" value="Yes">Yes
						<input type="radio" name="active" value="NO">NO
					</td>
				</tr>

				<tr>
					<td colspan="2">
						<input type="submit" name="submit" value="Add Category" class="btn-secondary">
					</td>
				</tr>

			</table>

		</form>
		<!-- Add Category form ends -->
		<?php 

		//Check whether the submit button clicked or not
		if (isset($_POST['submit'])) {

			//echo "Clicked";
			//Get the value from category form
			$title=$_POST['title'];

			//for radio input type, we need to check whether the button clicked or not
			if(isset($_POST['featured'])){
				//get the value from form
				$featured = $_POST['featured'];
			}
			else{
				//set the default value
				$featured ="NO";
			}
			if (isset($_POST['active'])) {

				$active = $_POST['active'];
			}
			else{
				$active = "NO";
			}
		

			//check whether the image is selected or not andset the value for image name accordingly
			//print_r($_FILES['image']);

			//die(); //break the code here 
			if (isset($_FILES['image']['name'])) {
				//Upload the image
				//to upload image we need image name, source path and destination path
				$image_name = $_FILES['image']['name'];

				//Upload the image only if image is selected
				if($image_name!="" ) {
					
				
				//Auto rename our image
				//get the Extention of our image(jpg,png,gif,etc)e.g. "foof2.jpg"
				$ext = end(explode('.', $image_name));

				//rename the image
				$image_name = "Food_Category_".rand(000,999).'.'.$ext; //Food_Category_345.jpg
				
				$source_path = $_FILES['image']['tmp_name'];
				$destination_path = "../images/category/".$image_name;

				//Finally upload the image
				$upload=move_uploaded_file($source_path, $destination_path);

				//check whether the image is uploaded or not
				//and if the image is not uploaded then we will stop the process and redirect the error message
				if($upload==false){
					//set message
					$_SESSION['upload'] = "<div class = 'error'>Failed to upload Image.</div>";
					//redirect to add category page
					header('location:'.SITEURL.'admin/add-category.php');
					//stop the process
					die();
				}
			}
			}
			else{
				//don't upload image and set the image_name value as blank
				$image_name="";
			}

			//2. Crete sql query to insert category into database

			$sql ="INSERT INTO tbl_category SET 
				title='$title',
				image_name='$image_name',
				featured='$featured',
				active='$active' ";

				//3. Exucute the query and save into database
				$res = mysqli_query($conn, $sql);

				//4. Check whether the query exucuted or not and data added or not
				if ($res==true) {
					// //query Executed and category added
					$_SESSION['add'] =" <div class ='success'> Category added successfully.</div>";
					//Redirect to manage categoty page
					header('location:'.SITEURL.'admin/manage-category.php');
						}
						else{
							//fail to add Category

					$_SESSION['add'] =" <div class ='success'> Failed to add Category.</div>";
					//Redirect to manage categoty page
					header('location:'.SITEURL.'admin/manage-category.php');
						}
					
				}
		 ?>
	</div>
</div>

 <?php include('partials/footer.php');?>