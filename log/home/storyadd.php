<?php session_start(); ?>
<?php include('nav.php')?>

<?php 

	if(isset($_POST['submit'])){
		$file = $_FILES['cover']['tmp_name'];

		$image = base64_encode(file_get_contents($file));
		$bookName = $_POST['title'];
		$bookAuthor = $_POST['author'];
		$genre = $_POST['genre'];
		$userid = $_SESSION['id'];
		$sypnosis = base64_encode($_POST['sypnosis']);

		$imageSize = getimagesize($file);
		$userid = $_SESSION['id'];

		if($imageSize == FALSE){
			echo "Please use an image Geez bro";
		}
		else{
			$sql = "INSERT INTO `stories`(`bookName`,`bookAuthor`,`genre`,`image`,`userid`,`sypnosis`) VALUES ('$bookName','$bookAuthor','$genre','$image','$userid','$sypnosis')";

			if(mysqli_query($conn, $sql)){

				header("Location: home.php");

			}
			else{

				echo "There was an error";
			}			

		}

	}

?>


	<div class="bookadd">
			<form class="add" enctype="multipart/form-data" action="storyadd.php" method="POST">
				<h3>Please add a story to your bookstore</h3>
				<label>Title:</label>
				<input type="text" name="title" required="" placeholder="Title">
				<label>Author:</label>
				<input type="text" name="author" required="" placeholder="Author">
				<label for="select">Genre:</label>

				<select id="select" name="genre">
					<option value="Adventure">Adventure</option>
					<option value="Action">Action</option>
					<option value="Fantasy">Fantasy</option>
					<option value="Horror">Horror</option>
					<option value="Mystery">Mystery</option>			
					<option value="Supernatural">Supernatural</option>
					<option value="Sci-Fi">Sci-Fi</option>
					<option value="Comedy">Comedy</option>
				</select>

				<div class="cover">
					<label>Cover Image:</label>
					<input type="file" name="cover" required="">
				</div>

				<label>Sypnosis:</label>
				<textarea name="sypnosis" placeholder="Sypnosis" required=""></textarea>

				<input type="submit" name="submit">
				
			</form>		
		</div>
<?php include('footer.php') ?>