<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_COOKIE["loggedin"]) || isset($_COOKIE["loggedindont"])) {
    header("Location: ../Controllers/userProfile_controller.php");
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
    <link href="https://fonts.googleapis.com/css2?family=Bree+Serif&display=swap" rel="stylesheet">
    <title>Reset Password</title>
</head>
<body>
    <header>
        <h1>Reset Password</h1>
    </header>
    <main class="logins">        
        <div id="logoLogin">
            <img src="../public/logo.png" alt="logo" class="loginLogo">
            <div class="login">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <input type="password" name="new_password" placeholder="New Password" required />
                    <input type="password" name="confirm_password" placeholder="Confirm Password" required />
                    <button class="actionButton" type="submit" name="resetbutton">Reset Password</button>
                </form>
                <?php if (isset($error)): ?>
                    <p style="color: red;"><?php echo $error; ?></p>
                <?php endif; ?>
            </div>
        </div>
    </main>
    <script src="../public/script.js"></script>
</body>
</html>

