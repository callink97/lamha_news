<?php include 'includes/db.php';
$errors = [];
$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);


    if (mysqli_num_rows($result) > 0) {

        $user = mysqli_fetch_assoc($result);

        session_start();
        $user = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        if ($user['role'] == 'journalist') {
            header("Location: journalist_dashboard.php");
        } else {
            header("Location: index.php");
        }

    } else {
        $message = "Invalid Email or Password ";
    }

} ?>

<?php if (!empty($errors)) { ?>

    <ul class="errors">

        <?php foreach ($errors as $error) { ?>

            <li><?php echo $error; ?></li>

        <?php } ?>

    </ul>

<?php } ?>

<!DOCTYPE html>
<html>

<head>
    <title>Login - Lamha News</title>
    <link rel="stylesheet" href="css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="navbar">
        <div class="logo">Lamha News</div>
        <div class="nav-links"> <a href="login.php">Sign In</a> <a href="register.php">Sign Up</a> </div>
    </div> <!-- Login Section -->
    <div class="login-container">
        <div class="left-side"></div>
        <div class="right-side">
            <div class="login-box">
                <h2>Welcome Back </h2>
                <form method="POST"> <input type="email" name="email" placeholder="Enter Email" required> <input
                        type="password" name="password" placeholder="Enter Password" required> <label> <input
                            type="checkbox"> Remember Me </label> <br><br> <button type="submit">Login</button> </form>
                <p style="color:red;"><?php echo $message; ?></p>
                <div class="signup-link"> Don't have an account? <a href="register.php">Sign Up</a> </div>
            </div>
        </div>
    </div> <?php include 'includes/footer.php'; ?>
</body>

</html>