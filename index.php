<?php
session_start();
include 'includes/db.php';
$category_filter = isset($_GET['category']) ? $_GET['category'] : '';
$region_filter = isset($_GET['region']) ? $_GET['region'] : '';

$sql = "SELECT * FROM news WHERE 1";

if ($category_filter != '') {
    $sql .= " AND category='$category_filter'";
}

if ($region_filter != '') {
    $sql .= " AND region='$region_filter'";
}

$sql .= " ORDER BY created_at DESC";

$result = mysqli_query($conn, $sql);


$sql = "SELECT news.*, users.username
FROM news
JOIN users ON news.user_id = users.id
ORDER BY created_at DESC";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>

<head>

    <title>Lamha News</title>

    <link rel="stylesheet" href="css/style.css">

</head>

<body>


    <div class="navbar">

        <div class="logo">Lamha News</div>

        <div class="nav-links">

            <a href="index.php">Home</a>

            <a href="logout.php">Logout</a>

            <a href="my_likes.php">
                My Likes
            </a>


        </div>
        <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'journalist') { ?>
            <a href="add_news.php">
                Add News
            </a>
        <?php } ?>
    </div>

    <form style="text-align:center;margin-top:20px;">

        <input type="text" placeholder="Search News..." style="padding:10px;width:300px;">

        <button style="padding:10px;">
            Search
        </button>

    </form>

    
<div class="filters">

    <div class="categories">

        <a href="index.php" class="pill">الكل</a>

        <a href="index.php?category=سياسة" class="pill">
            سياسة
        </a>

        <a href="index.php?category=رياضة" class="pill">
            رياضة
        </a>

        <a href="index.php?category=تكنولوجيا" class="pill">
            تكنولوجيا
        </a>

        <a href="index.php?category=صحة" class="pill">
            صحة
        </a>

        <a href="index.php?category=فن" class="pill">
            فن
        </a>

    </div>

    <form method="GET">

        <select name="region"
                onchange="this.form.submit()">

            <option value="">
                📍 كل المناطق
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

    </form>

</div>

    <h1 style="text-align:center;margin-top:30px;">
        Latest News
    </h1>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>

        <div class="news-card">

            <img src="uploads/<?php echo $row['image']; ?>">

<div class="badge-container">

    <span class="category-badge">
        <?php echo $row['category']; ?>
    </span>

    <span class="region-badge">
        📍 <?php echo $row['region']; ?>
    </span>

</div>
<h2><?php echo $row['title']; ?></h2>

            <h2><?php echo $row['title']; ?></h2>
            <p class="author">
                By
                <?php echo $row['username']; ?>
            </p>
            <p><?php echo $row['content']; ?></p>
            <?php if (
                $_SESSION['role'] == 'journalist'
                && $_SESSION['user_id'] == $row['user_id']
            ) { ?>

                <a href="delete_news.php?id=<?php echo $row['id']; ?>">
                    Delete
                </a>

            <?php } ?>

            <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'journalist' && $_SESSION['user_id'] == $row['user_id']) { ?>
                <div class="journalist-actions"> <a class="edit-btn" href="edit_news.php?id=<?php echo $row['id']; ?>"> Edit
                    </a> <a class="delete-btn" href="delete_news.php?id=<?php echo $row['id']; ?>"
                        onclick="return confirm('Delete this article?')"> Delete </a> </div> <?php } ?>
        </div>

    <?php } ?>

    <?php include 'includes/footer.php'; ?>

    <div style="
background:white;
width:80%;
margin:20px auto;
padding:20px;
border-radius:10px;
box-shadow:0 0 10px rgba(0,0,0,0.1);
">
</body>

</html>