<?php include 'includes/db.php';
$id = $_GET['id'];
$sql = "SELECT * FROM news WHERE id=$id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
if (isset($_POST['update'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $update = "UPDATE news SET title='$title', content='$content' WHERE id=$id";
    mysqli_query($conn, $update);
    header("Location:index.php");
} ?>
<!DOCTYPE html>
<html>

<head>
    <title>Edit News</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <h2>Edit Article</h2>
    <form method="POST"> <input type="text" name="title" value="<?php echo $row['title']; ?>"> <br><br> <textarea
            name="content" rows="10" cols="60"><?php echo $row['content']; ?></textarea> <br><br> <button type="submit"
            name="update"> Update </button> </form>
</body>

</html>