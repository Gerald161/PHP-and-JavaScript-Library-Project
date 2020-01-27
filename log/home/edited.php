<?php 
	if(isset($_POST['submit'])){
		include('../db/db.php');
		session_start();
		$storyid = $_GET['id'];
		$bookName = $_POST['title'];
		$bookAuthor = $_POST['author'];
		$genre = $_POST['genre'];
		$userid = $_SESSION['id'];
		$sypnosis = base64_encode($_POST['sypnosis']);

		
		$userid = $_SESSION['id'];

		print_r($_FILES['other']);


		if($_FILES['other']['size'] == 0){
			echo "not an image";

			$sql = "UPDATE `stories` SET `bookName` = '$bookName', `sypnosis` = '$sypnosis',`bookAuthor` = '$bookAuthor',`genre` = '$genre' WHERE id = '$storyid';";

			if(mysqli_query($conn, $sql)){

				header("Location: read.php?id=$storyid");

			}
			else{

				echo "There was an error";
			}

		}else{
			$Ofile = $_FILES['other']['tmp_name'];
			$Oimage = base64_encode(file_get_contents($Ofile));
			$OimageSize = getimagesize($Ofile);

			if($OimageSize == FALSE){

				echo "Please use an image Geez bro";

			}else{

				$sql = "INSERT INTO otherpics(storyid,image) VALUES('$storyid','$Oimage')";

				if(mysqli_query($conn, $sql)){
					echo "Success";
				}else{
					echo "There was an error";
				}
			}
		}


		if($_FILES['cover']['size'] == 0){

			echo "no image";

			$sql = "UPDATE `stories` SET `bookName` = '$bookName', `sypnosis` = '$sypnosis',`bookAuthor` = '$bookAuthor',`genre` = '$genre' WHERE id = '$storyid';";

			if(mysqli_query($conn, $sql)){

				header("Location: read.php?id=$storyid");

			}
			else{

				echo "There was an error";
			}

			
		}else{

			$file = $_FILES['cover']['tmp_name'];
			$image = base64_encode(file_get_contents($file));
			$imageSize = getimagesize($file);

			if($imageSize == FALSE){

				echo "Please use an image Geez bro";

			}
			else{

			$sql = "UPDATE `stories` SET `bookName` = '$bookName', `sypnosis` = '$sypnosis',`bookAuthor` = '$bookAuthor',`genre` = '$genre',`image` = '$image' WHERE id = '$storyid';";

			if(mysqli_query($conn, $sql)){

				header("Location: read.php?id=$storyid");

			}
			else{

				echo "There was an error";
			}
				
		}
	}	

	}
	else if(isset($_GET['del'])){
		include('../db/db.php');
		session_start();
		$storyid = $_GET['del'];
		$sql = "DELETE FROM stories WHERE id='$storyid'";
		$sql2 = "DELETE FROM `otherpics` WHERE storyid='$storyid'";

		mysqli_query($conn, $sql);
		mysqli_query($conn, $sql2);

		header("Location: home.php");
	}	
?>