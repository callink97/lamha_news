<?php
include 'includes/db.php';

$sql = "SELECT * FROM news ORDER BY created_at DESC";

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

        </div>
        <a href="add_news.php">
            Add News
        </a>
    </div>

    <form style="text-align:center;margin-top:20px;">

        <input type="text" placeholder="Search News..." style="padding:10px;width:300px;">

        <button style="padding:10px;">
            Search
        </button>

    </form>

    <div style="text-align:center;margin:20px;">

        <button>Sports</button>

        <button>Politics</button>

        <button>Health</button>

        <button>Technology</button>

    </div>

    <h1 style="text-align:center;margin-top:30px;">
        Latest News
    </h1>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>

        <div class="news-card">

            <img src="uploads/<?php echo $row['image']; ?>">

            <h2><?php echo $row['title']; ?></h2>

            <p><?php echo $row['content']; ?></p>

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
        <h2 style="text-align:center;">Subscribe to Our Newsletter 📬</h2>

        <form style="text-align:center;">

            <input type="email" placeholder="Enter your email" style="padding:10px;width:300px;">

            <button style="padding:10px;">
                Subscribe
            </button>

        </form>
</body>

</html>