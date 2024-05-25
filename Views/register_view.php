<?php
session_start();
if (isset($_COOKIE["loggedin"]) || isset($_COOKIE["loggedindont"])) {
    header("Location: user_profile.php");
    exit();
}
$error = isset($_SESSION['error']) ? $_SESSION['error'] : '';
unset($_SESSION['error']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="../public/styles.css" rel="stylesheet" type="text/css">
    <link rel="icon" type="image/x-icon" href="../public/logo.png">
    <title>Register Page</title>
</head>
<body>
    <header>
        <h1>Register</h1>
    </header>
    <main class="logins">
       
    

        <div id="logoLogin">
            <img src="../public/logo.png" alt="logo" class="loginLogo">
            <div class="login">
                <form action="../Controllers/register_controller.php" method="post" id="registerForm">
                    <input type="username" name="username" placeholder="user_name" required/>
                    <input type="email" name="email" placeholder="user_email" required />
                    <input type="password" name="password" placeholder="user_password" required />
                    <input type="password" name="confirm_password" placeholder="confirm_password" required />
                    <button class="actionButton" type="submit" name="registerbutton">Register</button>
                </form>
                <p class="loginHrefs">Already have an account? <a href="login_controller.php">Login here!</a></p>
                <?php if ($error): ?>
                    <p style="color: red;"><?php echo $error; ?></p>
                <?php endif; ?>
            </div>
        </div>
    </main>
    <script src="../public/script.js"></script>
</body>
</html>
