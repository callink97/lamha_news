<?php
include 'includes/db.php';
session_start();

$errors = [];
$message = "";

$categories = mysqli_query($conn, "SELECT * FROM categories");
$regions = mysqli_query($conn, "SELECT * FROM regions");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);
    $category_id = $_POST['category_id'];
    $region_id = $_POST['region_id'];

    $image_name = $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];

    if (!empty($image_name)) {
        move_uploaded_file($tmp_name, "uploads/" . $image_name);
    } else {
        $errors[] = "Image is required";
    }

    if (empty($errors)) {

        $user_id = $_SESSION['user_id'];

        $sql = "INSERT INTO news
                (title, content, image, category_id, region_id, user_id)
                VALUES
                ('$title',
                 '$content',
                 '$image_name',
                 '$category_id',
                 '$region_id',
                 '$user_id')";

        if (mysqli_query($conn, $sql)) {
            $message = "News Added Successfully";
        } else {
            $errors[] = "Database Error: " . mysqli_error($conn);
        }
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

<div class="navbar">
    <div class="logo">Lamha News</div>

    <div class="nav-links">
        <a href="index.php">Home</a>
        <a href="add_news.php">Add News</a>
        <a href="logout.php">Logout</a>
    </div>
</div>

<div class="right-side" style="width:100%;padding:50px;">

    <div class="login-box">

        <h2>Add New Article 📰</h2>

        <form method="POST" enctype="multipart/form-data">

            <input type="text" name="title" placeholder="News Title" required>

            <textarea name="content"
                      placeholder="Write News Content"
                      required
                      style="width:100%;height:150px;padding:12px;margin-bottom:15px;border:1px solid #ccc;border-radius:5px;"></textarea>

            <select name="category_id"
                    required
                    style="width:100%;padding:12px;margin-bottom:15px;border:1px solid #ccc;border-radius:5px;">

                <option value="">Choose Category</option>

                <?php while($cat = mysqli_fetch_assoc($categories)) { ?>
                    <option value="<?php echo $cat['id']; ?>">
                        <?php echo $cat['name']; ?>
                    </option>
                <?php } ?>

            </select>

            <select name="region_id"
                    required
                    style="width:100%;padding:12px;margin-bottom:15px;border:1px solid #ccc;border-radius:5px;">

                <option value="">Choose Region</option>

                <?php while($reg = mysqli_fetch_assoc($regions)) { ?>
                    <option value="<?php echo $reg['id']; ?>">
                        <?php echo $reg['name']; ?>
                    </option>
                <?php } ?>

            </select>

            <input type="file" name="image" required>

            <br><br>

<select name="category" required>

    <option value="">
        اختر التصنيف
    </option>

    <option value="سياسة">
        سياسة
    </option>

    <option value="رياضة">
        رياضة
    </option>

    <option value="تكنولوجيا">
        تكنولوجيا
    </option>

    <option value="صحة">
        صحة
    </option>

    <option value="فن">
        فن
    </option>

</select>

<br><br>

<select name="region" required>

    <option value="">
        اختر المنطقة
    </option>

    <option value="شمال غزة">
        شمال غزة
    </option>

    <option value="جباليا">
        جباليا
    </option>

    <option value="غزة">
        غزة
    </option>

    <option value="النصيرات">
        النصيرات
    </option>

    <option value="دير البلح">
        دير البلح
    </option>

    <option value="خانيونس">
        خانيونس
    </option>

    <option value="رفح">
        رفح
    </option>

</select>

            <button type="submit">Publish News</button>

        </form>

        <p style="color:green;">
            <?php echo $message; ?>
        </p>

        <?php if(!empty($errors)) { ?>
            <ul class="errors">
                <?php foreach($errors as $error) { ?>
                    <li><?php echo $error; ?></li>
                <?php } ?>
            </ul>
        <?php } ?>

    </div>
</div>

<?php include 'includes/footer.php'; ?>

</body>
</html>