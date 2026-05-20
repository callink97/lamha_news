

<?php
include 'includes/db.php';

$message = "";

$categories = mysqli_query($conn, "SELECT * FROM categories");

/* Fetch Regions */

$regions = mysqli_query($conn, "SELECT * FROM regions");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $title = $_POST['title'];
    $content = $_POST['content'];
    $category_id = $_POST['category_id'];
    $region_id = $_POST['region_id'];


    $image_name = $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];

    move_uploaded_file($tmp_name, "uploads/" . $image_name);

    /* Insert News */

    $sql = "INSERT INTO news
            (title, content, image, category_id, region_id, user_id)

            VALUES

            ('$title',
             '$content',
             '$image_name',
             '$category_id',
             '$region_id',
             1)";

    if(mysqli_query($conn, $sql)) {

        $message = "News Added Successfully 😎";

    } else {

        $message = "Error ❌";
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

<!-- Navbar -->

<div class="navbar">

    <div class="logo">Lamha News</div>

    <div class="nav-links">

        <a href="index.php">Home</a>

        <a href="add_news.php">Add News</a>

        <a href="logout.php">Logout</a>

    </div>

</div>

<!-- Form -->

<div class="right-side" style="width:100%;padding:50px;">

    <div class="login-box">

        <h2>Add New Article 📰</h2>

        <form method="POST" enctype="multipart/form-data">

            <input type="text"
                   name="title"
                   placeholder="News Title"
                   required>

            <textarea
                    name="content"
                    placeholder="Write News Content"
                    required
                    style="width:100%;
                           height:150px;
                           padding:12px;
                           margin-bottom:15px;
                           border:1px solid #ccc;
                           border-radius:5px;"></textarea>

            <!-- Category -->

            <select name="category_id"
                    style="width:100%;
                           padding:12px;
                           margin-bottom:15px;
                           border:1px solid #ccc;
                           border-radius:5px;">

                <?php while($cat = mysqli_fetch_assoc($categories)) { ?>

                    <option value="<?php echo $cat['id']; ?>">

                        <?php echo $cat['name']; ?>

                    </option>

                <?php } ?>

            </select>

            <!-- Region -->

            <select name="region_id"
                    style="width:100%;
                           padding:12px;
                           margin-bottom:15px;
                           border:1px solid #ccc;
                           border-radius:5px;">

                <?php while($reg = mysqli_fetch_assoc($regions)) { ?>

                    <option value="<?php echo $reg['id']; ?>">

                        <?php echo $reg['name']; ?>

                    </option>

                <?php } ?>

            </select>

            <!-- Image -->

            <input type="file"
                   name="image"
                   required>

            <br><br>

            <button type="submit">

                Publish News

            </button>

        </form>

        <p style="color:green;">

            <?php echo $message; ?>

        </p>

    </div>

</div>

<?php include 'includes/footer.php'; ?>

</body>
</html>


