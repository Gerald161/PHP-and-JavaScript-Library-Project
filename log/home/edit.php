<?php session_start(); ?>
<?php if(isset($_SESSION['username'])){
	$logged = 'yup';

	include('nav.php');

	$storyid = $_GET['id'];


	$sqls = "SELECT * FROM stories WHERE id = '$storyid'";

	$results = mysqli_query($conn, $sqls);

	$imagess = mysqli_fetch_all($results, MYSQLI_ASSOC);

	if($_SESSION['id'] !== $imagess[0]['userid']){
		header("Location: home.php");
	}

	$genre = $imagess[0]['genre'];

}else{
	$logged = '';
	header("Location: home.php");
}

?>


<div class="bookadd">
			<form class="add" enctype="multipart/form-data" action="edited.php?id=<?php echo $storyid ?>" method="POST">
				<h3>Please update the story</h3>
				<label>Title:</label>
				<input type="text" name="title" placeholder="Title" required="" value="<?php echo $imagess[0]['bookName']; ?>">
				<label>Author:</label>
				<input type="text" name="author" placeholder="Author" required="" value="<?php echo $imagess[0]['bookAuthor']; ?>">
				<label for="select">Genre:</label>

				<select id="select" name="genre">
					<option value="Adventure" <?php if($genre  == "Adventure"){ echo "selected='Adventure'";} ?>>Adventure</option>
					<option value="Action" <?php if($genre  == "Action"){echo "selected='Action'";}?>>Action</option>
					<option value="Fantasy" <?php if($genre  == "Fantasy"){echo "selected='Fantasy'";} ?>>Fantasy</option>
					<option value="Horror" <?php if($genre  == "Horror"){echo "selected='Horror'";} ?>>Horror</option>
					<option value="Mystery" <?php if($genre  == "Mystery"){echo "selected='Mystery'";} ?>>Mystery</option>		
					<option value="Supernatural" <?php if($genre  == "Supernatural"){echo "selected='Supernatural'";} ?>>Supernatural</option>
					<option value="Sci-Fi" <?php if($genre  == "Sci-Fi"){echo "selected='Sci-Fi'";} ?>>Sci-Fi</option>
					<option value="Comedy" <?php if($genre  == "Comedy"){echo "selected='Comedy'";} ?>>Comedy</option>
				</select>

				
					<label>Change Cover Image:</label>
					<input type="file" name="cover">

					<label>Add additional Images:</label>
					<input type="file" name="other">
				

				<label>Sypnosis:</label>
				<textarea name="sypnosis" placeholder="Sypnosis" required="" ><?php echo base64_decode($imagess[0]['sypnosis']) ?></textarea>

				<div class="buts">
					<input type="submit" name="submit" value="Update">
					<input type="submit" name="del" class="del" value="Delete" style="position: relative; left: 10px;">	
				</div>	
			</form>		
		</div>

		<script type="text/javascript">
			var del = document.querySelector('.del');
			del.addEventListener('click', function(e){
   				 e.preventDefault();
   				 if(confirm("Would you like to completely delete this story?")){
   				 	window.location = "edited.php?del=<?php echo $storyid ?>";
   				 }else{
   				 	
   				 }
			});
		</script>
</body>
</html>