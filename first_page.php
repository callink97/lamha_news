<?php

include 'includes/db.php';

$sql = "SELECT * FROM news ORDER BY created_at DESC LIMIT 8";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>

    <meta charset="UTF-8">

    <title>منصة لمحة نيوز</title>

    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <!-- Navbar -->

    <div class="navbar">

        <div class="logo">

            لمحة نيوز

        </div>

        <div class="nav-links">

            <a href="login.php">تسجيل الدخول</a>

            <a href="register.php">إنشاء حساب</a>

        </div>

    </div>

    <!-- Hero -->

    <section class="hero">

        <h1>

            منصة لمحة نيوز

        </h1>

        <p>

            منصة إخبارية رقمية تهدف إلى تقديم الأخبار بسرعة وموثوقية،
            مع واجهة سهلة الاستخدام تتيح متابعة آخر المستجدات في مختلف
            المجالات مثل السياسة والتكنولوجيا والرياضة والصحة والثقافة.

        </p>
        <a href="login.php" class="main-btn">

            اكتشف المزيد

        </a>

    </section>

    <!-- Features -->

    <section class="features-section">

        <h2>

            لماذا لمحة نيوز؟

        </h2>

        <div class="features">

            <div class="feature-card">

                <h3>📰 أخبار محدثة</h3>

                <p>

                    تابع آخر الأخبار المحلية والعالمية لحظة بلحظة.

                </p>

            </div>

            <div class="feature-card">

                <h3>❤️ مقالاتك المفضلة</h3>

                <p>

                    يمكنك الإعجاب بالمقالات والرجوع إليها بسهولة بعد تسجيل الدخول.

                </p>

            </div>

            <div class="feature-card">

                <h3>🔍 سهولة التصفح</h3>

                <p>

                    ابحث عن الأخبار حسب التصنيف أو المنطقة بكل سهولة.

                </p>

            </div>

            <div class="feature-card">

                <h3>✍️ محتوى احترافي</h3>

                <p>

                    يتم نشر الأخبار من قبل صحفيين مع إمكانية التعديل والإدارة.

                </p>

            </div>

        </div>

    </section>

    <!-- Latest News -->

    <section>

        <h2 class="section-title">

            آخر الأخبار

        </h2>

        <div class="cards-container">

            <?php while ($row = mysqli_fetch_assoc($result)) { ?>

                <div class="news-card">

                    <img src="uploads/<?php echo $row['image']; ?>">

                    <h3>

                        <?php echo $row['title']; ?>

                    </h3>

                    <p>

                        <?php echo substr($row['content'], 0, 120); ?>...

                    </p>

                    <a href="login.php" class="read-btn">

                        اقرأ المزيد

                    </a>

                </div>

            <?php } ?>

        </div>

    </section>

    <!-- Join -->

    <section class="join-section">

        <h2>

            انضم إلى لمحة نيوز

        </h2>

        <p>

            أنشئ حساباً الآن للاستفادة من جميع المزايا،
            قراءة الأخبار كاملة، والإعجاب بالمقالات المفضلة لديك.

        </p>

        <a href="register.php" class="main-btn">

            إنشاء حساب

        </a>

        <!-- Statistics Section -->

        <section class="stats-section">

            <h2>

                لمحة نيوز بالأرقام

            </h2>

            <div class="stats-container">

                <div class="stat-card">

                    <h3>+1000</h3>

                    <p>مقال منشور</p>

                </div>

                <div class="stat-card">

                    <h3>+50</h3>

                    <p>صحفي نشط</p>

                </div>

                <div class="stat-card">

                    <h3>24/7</h3>

                    <p>تحديث مستمر</p>

                </div>

                <div class="stat-card">

                    <h3>+500</h3>

                    <p>مستخدم مسجل</p>

                </div>

            </div>

        </section>
    </section>

    <?php include 'includes/footer.php'; ?>

</body>

</html>