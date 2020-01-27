<?php 
	if(isset($_POST['logout'])){
		session_start();
		include('../db/db.php');
		$userid = $_SESSION['id'];
		$sql = "UPDATE `info` SET `logged` = 'false' WHERE `info`.`id` = '$userid';";
		$results = mysqli_query($conn, $sql); 
		session_unset();
		session_destroy();
		header("Location: ../sign/log.php");
	}
?>