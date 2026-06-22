<?php

include 'includes/db.php';

$id = $_GET['id'];

mysqli_query($conn,
"DELETE FROM news WHERE id='$id'");

header("Location:index.php");

?>