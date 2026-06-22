<?php

include 'includes/db.php';

$errors = [];

if(isset($_POST['add_news'])){

    $title = $_POST['title'];

    $content = $_POST['content'];

    $image = $_FILES['image'];

    

    $image_name = $image['name'];

    $tmp_name = $image['tmp_name'];

    $image_size = $image['size'];

    

    $image_ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));

    $allowed = ['jpg','jpeg','png'];

   

    if(empty($title)){

        $errors[] = "Title is required";

    }

    if(empty($content)){

        $errors[] = "Content is required";

    }

    if(!in_array($image_ext, $allowed)){

        $errors[] = "Only JPG, JPEG, PNG allowed";

    }


    if(empty($errors)){

        move_uploaded_file($tmp_name, "uploads/" . $image_name);

        $sql = "INSERT INTO news(title,content,image)

                VALUES

                ('$title','$content','$image_name')";

        mysqli_query($conn,$sql);

        header("Location: index.php");

    }

}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Add News</title>

    <link rel="stylesheet" href="css/style.css">

</head>

<body>

<h1>Add New Article 📰</h1>


<?php if(!empty($errors)) { ?>

<ul class="errors">

    <?php foreach($errors as $error) { ?>

        <li><?php echo $error; ?></li>

    <?php } ?>

</ul>

<?php } ?>

<form method="POST"
      enctype="multipart/form-data">

    <input type="text"
           name="title"
           placeholder="News Title">

    <br><br>

    <textarea name="content"
              placeholder="News Content"></textarea>

    <br><br>

    <input type="file"
           name="image">

    <br><br>

    <button type="submit"
            name="add_news">

        Publish

    </button>

</form>

</body>
</html>

