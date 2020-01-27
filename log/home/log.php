<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	include('../db/db.php');

	session_start();

	$userid = $_SESSION['id'];

    $id = $_GET['id'];

    $Ocomment = $_POST['title'];

    $comment = base64_encode($_POST['title']);

    $username = $_SESSION['username'];

    $sql = "INSERT INTO comments(id,userid,comment,username) VALUES('$id','$userid','$comment','$username')";

	mysqli_query($conn, $sql);

    echo json_encode(['id'=>"$id",'userid'=>"$userid",'comment'=>"$Ocomment",'username'=>"$username"]);

}
else if($_SERVER['REQUEST_METHOD'] == 'GET'){
    session_start();

    include('../db/db.php');

    $id = $_GET['id'];

    $username = $_SESSION['username'];

    $sql = "SELECT * FROM comments WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    $comments = mysqli_fetch_all($result, MYSQLI_ASSOC);

    echo json_encode($comments);
    // echo json_encode([['name'=>'kobby','age'=>'troublesome'],['name'=>'kofi']]);
}