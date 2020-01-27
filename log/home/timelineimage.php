<?php 
		include('../db/db.php');
		session_start();
		$userid = $_GET['id'];
		$image = "SELECT image FROM profile WHERE userid = '$userid'";
		$result = mysqli_query($conn, $image);
		$images = mysqli_fetch_all($result, MYSQLI_ASSOC);

		if(array_filter($images)){
			// echo "yup";
			$image = $images[0]['image'];
		
			$image = base64_decode($image);

			header("Content-type: ". "image/png");
			echo $image;
		}else{
			// echo "nope";
			$prof = '';
			$image = file_get_contents('1.png');
			header("Content-type: ". "image/png");
			echo $image;
		}
		
		header("Location:home.php");
 ?>