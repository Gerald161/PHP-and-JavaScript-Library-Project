<?php 
	session_start();
	if(isset($_SESSION['id'])){

		if(isset($_GET['id'])){

			include('nav.php');

			$userid = $_GET['id'];

			$sql = "SELECT * FROM stories WHERE userid = '$userid'";

			$result = mysqli_query($conn, $sql);

			$images = mysqli_fetch_all($result, MYSQLI_ASSOC);

			$sql = "SELECT username FROM info WHERE id = '$userid'";

			$result = mysqli_query($conn, $sql);

			$person = mysqli_fetch_all($result, MYSQLI_ASSOC);

		}else{
			
		}
		
	}else{
		if(isset($_GET['id'])){

			include('nav2.php');
			
			$userid = $_GET['id'];

			$sql = "SELECT * FROM stories WHERE userid = '$userid'";

			$result = mysqli_query($conn, $sql);

			$images = mysqli_fetch_all($result, MYSQLI_ASSOC);

			$sql = "SELECT username FROM info WHERE id = '$userid'";

			$result = mysqli_query($conn, $sql);

			$person = mysqli_fetch_all($result, MYSQLI_ASSOC);

		}else{
			header("Location:home.php");
		}
	}
?>

<?php include('footer.php') ?>

<?php if(array_filter($images)){ ?>

		<div style="height: 500px;background: url(timelineimage.php?id=<?php echo $userid;?>) center/cover no-repeat;width: 100%;">
		</div>

		<div style="padding:10px 15px;">
			<p class="username">Name: <?php echo $person[0]['username']; ?></p>
		</div>

	<h3>User currently has <?php echo count($images)?> stories written</h3>

<div class="stories">
			<?php foreach ($images as $image) { ?>	
				<div class="story">
					
					<img src="storyimages.php?id=<?php echo $image['id']?>">
					<div class="details">
						<h2><?php echo $image['bookName']; ?></h2>
						<p>Category: <?php echo $image['genre']; ?></p>
						<a href="read.php?id=<?php echo $image['id']?>">Read</a>
					</div>
				</div>
			<?php } ?>		
			
</div>

<?php }else{ ?>
	<div style="height: 500px;background: url(timelineimage.php?id=<?php echo $userid;?>) center/cover no-repeat;width: 100%;">
		</div>

		<div style="padding:10px 15px;">
			<p class="username">Name: <?php echo $person[0]['username']; ?></p>
	<h3>User hasn't written any stories yet</h3>
<?php } ?>	