<?php 
	$error = '';
	include('../db/db.php');

	session_start();
	session_unset();
	session_destroy();

	if(isset($_POST['submit'])){
		$username = $_POST['username'];
		$password = $_POST['password'];

		$sql = "SELECT id, username, email, password FROM info WHERE username = '$username' OR email = '$username';";

		$results = mysqli_query($conn, $sql); 

		$user = mysqli_fetch_assoc($results);

		$userid = $user['id'];

		if($password !== $user['password']){
			$error = "Aww sorry boboo,doesn't match";
		}else{
			$sql = "UPDATE `info` SET `logged` = 'true' WHERE `info`.`id` = '$userid';";

			$results = mysqli_query($conn, $sql); 
			
			session_start();
			$_SESSION['id'] = $user['id'];
			$_SESSION['username'] = $user['username'];
			$_SESSION['email'] = $user['email'];
			header("Location: ../home/home.php");
		}

	}

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="log.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Log</title>
</head>
<body>
	<div class="box">
		<h2>Log In</h2>
		<form method="POST" action="log.php">

			<div class="inputBox">
				<input type="text" name="username" required="">
				<label>Username/Email</label>
			</div>


			<div class="inputBox">
				<input type="password" name="password" required="">
				<label>Password</label>
			</div>

			<?php if($error){ ?>
				<p class="red"><?php echo $error; ?></p>
			<?php } ?>
		

			<input type="submit" name="submit" value="Sign In">
		</form>
	</div>
</body>
</html>