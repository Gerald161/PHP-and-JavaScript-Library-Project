<?php include('../db/db.php'); ?>
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
			<p class="username">Welcome Guest Kun</p>
		</a>
		
		<div>
			<?php $img = '' ?>
			<div class="buts">

				<a href="../sign/log.php" class="logout" style="text-decoration: none">Login</a>
				
				<a href="../sign/sign.php" class="settings" style="text-decoration: none">Sign Up</a>

			</div>
			
		</div>
	</nav>