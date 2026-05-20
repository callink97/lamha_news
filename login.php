<?php include 'includes/db.php';
$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        header("Location: index.php");
    } else {
        $message = "Invalid Email or Password ";
    }
} ?>
<!DOCTYPE html>
<html>

<head>
    <title>Login - Lamha News</title>
    <link rel="stylesheet" href="css/style.css">
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