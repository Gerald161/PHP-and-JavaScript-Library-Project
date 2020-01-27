<?php 
	include('../db/db.php');

	$username = $_SESSION['username'];

	$sql = "SELECT id FROM info WHERE username = '$username'";

	$result = mysqli_query($conn, $sql);

	$userid = mysqli_fetch_all($result, MYSQLI_ASSOC);

	$userid = $_SESSION['id'] ?? $userid[0]['id'];

	$sql = "SELECT * FROM profile WHERE userid = '$userid'";

	$result = mysqli_query($conn, $sql);

	$images = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
	<link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="home.css">
	<title>Web Home</title>
</head>
<body>
	<nav>
		<a href="home.php" class="info" style="text-decoration: none">
			<p class="username">Welcome <?php echo $_SESSION['username']; ?></p>
			<?php if(array_filter($images)){ ?>
				<div style="width: 70px;height: 70px;border-radius: 100%;background: url(image.php) center/cover no-repeat;">
				<?php $img = 'yup' ?>	
				</div>
			<?php }else{ ?>
				<?php $img = '' ?>
				<div class="profile" style="background: url(1.png) center/cover no-repeat;"></div>
			<?php } ?>
		</a>
		
		<div>

			<div class="buts">
				<form method="POST" action="logout.php">
					<button type="input" name="logout"  class="logout">Logout</button>
				</form>
				<a href="settings.php" class="settings">Settings</a>
			</div>
			
		</div>
	</nav>