<?php session_start(); ?>
<?php if(isset($_SESSION['username'])){
	$logged = 'yup';
	include('nav.php');
}else{
	$logged = '';
	include('nav2.php');
} ?>

<?php 
	if($logged){

		$sql = "SELECT * FROM stories WHERE userid = '$userid'";

		$result = mysqli_query($conn, $sql);

		$images = mysqli_fetch_all($result, MYSQLI_ASSOC);

		$sql2 = "SELECT * FROM stories WHERE userid != '$userid' ORDER BY id";

		$result2 = mysqli_query($conn, $sql2);

		$images2 = mysqli_fetch_all($result2, MYSQLI_ASSOC);

		if(count($images) > 1){
			$story = "stories";
		}else{
			$story = "story";
		}

	}
	else{

			$sql = "SELECT * FROM stories ORDER BY id";

			$result = mysqli_query($conn, $sql);

			$images = mysqli_fetch_all($result, MYSQLI_ASSOC);

	}
	

?>
	<?php if(array_filter($images)){ ?>
		<h1>Read all available stories</h1>
		<?php if($logged){ ?>
			<h4>Currently have <?php echo count($images) ?> <?php echo $story ?> written</h4>
		<?php } ?>
		
		<?php if($logged){ ?>
		<div style="display:flex; align-items: center; justify-content: center;padding: 15px 0;">
			<a href="storyadd.php" class="storyadd">Would you like to add another story?</a>
		</div>
		<?php } ?>
		
		<div class="stories">

			<?php foreach ($images as $image) { ?>	
				<div class="story">
					
					<img src="storyimages.php?id=<?php echo $image['id']?>">
					<div class="details">
						<h2><?php echo $image['bookName']; ?></h2>
						<p>Category: <?php echo $image['genre']; ?></p>
						<a href="read.php?id=<?php echo $image['id']?>">Read</a>
						<?php if($logged){ ?>
							<a href="edit.php?id=<?php echo $image['id'] ?>">Edit</a>
						<?php } ?>
					</div>
				</div>
			<?php } ?>		
			
		</div>

		<?php if($logged){ ?>
				<h3>Read stories by other members</h3>
				<div class="stories">
				<?php foreach ($images2 as $image2) { ?>
					<div class="story">
						<img src="storyimages.php?id=<?php echo $image2['id']?>">
						<div class="details">
							<h2><?php echo $image2['bookName']; ?></h2>
							<p>Category: <?php echo $image2['genre']; ?></p>
							<a href="read.php?id=<?php echo $image2['id']?>">Read</a>
						</div>
					</div>
				<?php } ?>		
			</div>
		<?php } ?>

		

	<?php }else{ ?>
		<div style="display:flex; align-items: center; justify-content: center;padding: 15px 0;">
			<a href="storyadd.php" class="storyadd">Would you like to add your first story?</a>
		</div>
		<h3>Or Would you care to read stories by other members</h3>
		<div class="stories">
			<?php foreach ($images2 as $image2) { ?>
				<div class="story">
					<img src="storyimages.php?id=<?php echo $image2['id']?>">
					<div class="details">
						<h2><?php echo $image2['bookName']; ?></h2>
						<p>Category: <?php echo $image2['genre']; ?></p>
						<a href="read.php?id=<?php echo $image2['id']?>">Read</a>
					</div>
				</div>
			<?php } ?>		
		</div>
	<?php } ?>	
<?php include('footer.php') ?>