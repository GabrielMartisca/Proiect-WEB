<?php
session_start();
$error = isset($_SESSION['error']) ? $_SESSION['error'] : '';
unset($_SESSION['error']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="styles.css" rel="stylesheet" type="text/css">
    <link rel="icon" type="image/x-icon" href="logo.png">
    <title>Register Page</title>
</head>
<body>
    <header>
        <h1>Register</h1>
    </header>
    <main class="logins">
        <div id="sideMenu">
            <br>
            <a href="userProfile.html">User Profile</a>
            <a href="preference.html">Preferences Management</a>
            <a href="shoppinglist.html">Shopping List</a>
            <a href="foodDatabase.html">Food Database</a>
            <a href="statistics.html">Statistics</a>
        </div>
        <button id="menuButton">
            &#9776;
        </button>

        <div id="logoLogin">
            <img src="logo.png" alt="logo" class="loginLogo">
            <div class="login">
                <form action="processReg.php" method="post" id="registerForm">
                    <input type="username" name="username" placeholder="user_name" required/>
                    <input type="email" name="email" placeholder="user_email" required />
                    <input type="password" name="password" placeholder="user_password" required />
                    <input type="password" name="confirm_password" placeholder="confirm_password" required />
                    <button class="actionButton" type="submit" name="registerbutton">Register</button>
                </form>
                <p>Already have an account? <a href="login.php">Login here!</a></p>
                <?php if ($error): ?>
                    <p style="color: red;"><?php echo $error; ?></p>
                <?php endif; ?>
            </div>
        </div>
    </main>
    <script src="script.js"></script>
</body>
</html>
