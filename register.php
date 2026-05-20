<?php
include 'includes/db.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    if (!str_ends_with($email, "@gmail.com")) {

        $message = "Email must end with @gmail.com ";

    } else {

        $check = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($conn, $check);

        if (mysqli_num_rows($result) > 0) {

            $message = "Email already exists ";

        } else {

            $sql = "INSERT INTO users(username,email,password,role)
                    VALUES('$username','$email','$password','$role')";

            if(mysqli_query($conn, $sql)) {

                header("Location: login.php");

            } else {

                $message = "Something went wrong ❌";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register - Lamha News</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<!-- Navbar -->

<div class="navbar">

    <div class="logo">Lamha News</div>

    <div class="nav-links">
        <a href="login.php">Sign In</a>
        <a href="register.php">Sign Up</a>
    </div>

</div>

<!-- Register Section -->

<div class="login-container">

    <div class="left-side"></div>

    <div class="right-side">

        <div class="login-box">

            <h2>Create Account ✨</h2>

            <form method="POST">

                <input type="text"
                       name="username"
                       placeholder="Enter Username"
                       required>

                <input type="email"
                       name="email"
                       placeholder="Enter Gmail"
                       required>

                <input type="password"
                       name="password"
                       placeholder="Enter Password"
                       required>

                <select name="role"
                        style="width:100%;padding:12px;margin-bottom:15px;border:1px solid #ccc;border-radius:5px;">

                    <option value="user">User</option>
                    <option value="journalist">Journalist</option>

                </select>

                <button type="submit">Create Account</button>

            </form>

            <p style="color:red;">
                <?php echo $message; ?>
            </p>

            <div class="signup-link">

                Already have an account?

                <a href="login.php">Sign In</a>

            </div>

        </div>

    </div>

</div>

<?php include 'includes/footer.php'; ?>

</body>
</html>