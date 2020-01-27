<?php 
 $conn = mysqli_connect('localhost', 'root', '', 'log');
 if(!$conn){
		echo 'Database connection error: ' . mysqli_connect_error();
	}
?>