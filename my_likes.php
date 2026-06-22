<?php
include 'includes/db.php';
session_start();

$user_id = $_SESSION['user_id'];

$sql = "SELECT news.*
        FROM news
        JOIN likes ON news.id = likes.news_id
        WHERE likes.user_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();

$result = $stmt->get_result();
?>
<div class="container">

    <h2 class="page-title">❤️ الأخبار التي أعجبتك</h2>

    <div class="news-grid">

        <?php while ($row = $result->fetch_assoc()) { ?>

            <div class="news-card">

                <h3><?php echo $row['title']; ?></h3>

                <p>
                    <?php echo substr($row['content'], 0, 150); ?>...
                </p>

                <a href="view_news.php?id=<?php echo $row['id']; ?>">
                    اقرأ المزيد
                </a>

            </div>

        <?php } ?>

    </div>

</div>
<?php include 'includes/footer.php'; ?>
