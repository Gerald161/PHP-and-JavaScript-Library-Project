<?php 
		include('../db/db.php');
		session_start();
		
		$storyid = $_GET['id'] ?? $_SESSION['storyid'];

		$image = "SELECT image FROM stories WHERE id ='$storyid'";

		$result = mysqli_query($conn, $image);

		$image = mysqli_fetch_assoc($result);

		$image = $image['image'];
		
		$image = base64_decode($image);

		header("Content-type: ". "image/png");

		echo $image;
			
		header("Location:home.php");
 ?>