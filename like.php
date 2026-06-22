<?php

session_start();

include 'includes/db.php';

$user_id = $_SESSION['user_id'];

$news_id = $_GET['id'];

$sql = "INSERT INTO likes(user_id,news_id)

VALUES('$user_id','$news_id')";

mysqli_query($conn,$sql);

header("Location:index.php");

?>
