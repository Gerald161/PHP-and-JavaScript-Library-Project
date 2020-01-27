<?php 
 include('../db/db.php');

 	session_start();
	session_unset();
	session_destroy();

	$errors = ['username'=>"",'email'=>"",'password'=>"",'passwordc'=>""];

	$username = $password = $email = $passwordc = '';

	if(isset($_POST['submit'])){
		$username = strtolower($_POST['username']);
		$email = strtolower($_POST['email']);
		$email = $_POST['email'];
		$password = $_POST['password'];
		$passwordc = $_POST['passwordc'];
		
		if($password !== $passwordc){
			$errors['passwordc'] = "Both passwords don't match";
		}

		if(!preg_match('/^[a-zA-z\s]+$/', $username)){
			$errors['username'] = "Username must be letters Only";
		}

		if(strlen($username) > 10){
			$errors['username'] = "Characters must be less than 11";
		}

		if(!preg_match('/^[a-zA-z\s\.]{1,8}$/', $password)){
			$errors['password'] = "Password is too Short";
		}

		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$errors['email'] = "Please enter a valid Email";
		}

		if(array_filter($errors)){
			
		}else{
			//no errors

			$username = mysqli_real_escape_string($conn, strtolower($_POST['username']));
			$email = mysqli_real_escape_string($conn, strtolower($_POST['email']));
			$password = mysqli_real_escape_string($conn, $_POST['password']);

			//insert into db
			$sql = "INSERT INTO info(username,email,password) VALUES('$username','$email','$password')";

			//check for potential errors

			if(mysqli_query($conn, $sql)){

				$sql = "SELECT id FROM info WHERE username = '$username'";

				$results = mysqli_query($conn, $sql); 

				$user = mysqli_fetch_assoc($results);

				$userid = $user['id'];

				session_start();

				$_SESSION['username'] = $username;

				$_SESSION['id'] = $user['id'];

				$_SESSION['email'] = $email;

				header('Location: ../home/home.php');

			}else{
				echo "Something Went Wrong Please Try Again";
			}
		}	

	}

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="sign.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Log</title>
</head>
<body>
	<div class="box">
		<h2>Join Us</h2>
		<form action="sign.php" method="POST">

			<div class="inputBox">
				<input type="text" name="username" required="" value="<?php echo $username ?>">
				<label>Username</label>
				<?php if($errors['username']){ ?>
					<p class="red"><?php echo $errors['username']; ?></p>
				<?php } ?>	
			</div>

			<div class="inputBox">
				<input type="text" name="email" required="" value="<?php echo $email ?>">
				<label>Email</label>
				<?php if($errors['email']){ ?>
					<p class="red"><?php echo $errors['email']; ?></p>
				<?php } ?>	
			</div>

			<div class="inputBox">
				<input type="password" name="password" required="" value="<?php echo $password ?>">
				<label>Password</label>
				<?php if($errors['password']){ ?>
					<p class="red"><?php echo $errors['password']; ?></p>
				<?php } ?>	
			</div>

			<div class="inputBox">
				<input type="password" name="passwordc" required="" value="<?php echo $passwordc ?>">
				<label>Confirm Password</label>
				<?php if($errors['passwordc']){ ?>
					<p class="red"><?php echo $errors['passwordc']; ?></p>
				<?php } ?>	
			</div>

			<input type="submit" name="submit" value="Sign Up">
		</form>
	</div>
</body>
</html>