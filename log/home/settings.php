<?php session_start(); ?>
<?php 
	include('nav.php');

	include('../db/db.php');

	if(isset($_POST['submit'])){

		$file = $_FILES['img']['tmp_name'];

		if(empty($file)){

			echo "Please Select An Image";

		}else{
			
			$image = base64_encode(file_get_contents($file));
			$imageName = $_FILES['img']['name'];
			$imageType = $_FILES['img']['type'];
			$imageSize = getimagesize($file);
			$userid = $_SESSION['id'];

			if($imageSize == FALSE){
				echo "Please use an image Geez bro";
			}
			else{

				$userid = $_SESSION['id'];

				$sql = "SELECT * FROM profile WHERE userid = '$userid'";

				$result = mysqli_query($conn, $sql);

				$images = mysqli_fetch_all($result, MYSQLI_ASSOC);

				if(array_filter($images)){

				$sql = "UPDATE profile SET image = '$image',name = '$imageName' WHERE userid = '$userid' ";

				if(mysqli_query($conn, $sql)){

					header("Location: home.php");

				}
				else{

					echo "There was an error";
				}

				}
				else{

				$sql = "INSERT INTO `profile`(`name`,`image`,`userid`) VALUES ('$imageName','$image','$userid')";

				if(mysqli_query($conn, $sql)){

					header("Location: home.php");

				}
				else{

					echo "There was an error";
				}

				}

			}
		}
		
	}
?>
	<?php if(array_filter($images)){ ?>
		<form method="POST" action="settings.php" enctype="multipart/form-data">
		File: <input type="file" name="img">
		<button type="submit" name="submit">Update Your Profile Image</button>
	<?php }else{ ?>	
		<form method="POST" action="settings.php" enctype="multipart/form-data">
		File: <input type="file" name="img">
		<button type="submit" name="submit">Upload A profile Image</button>
	<?php } ?>	
</form>

<?php include('footer.php') ?>