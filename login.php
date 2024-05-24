<?php
if(isset($_COOKIE["loggedin"])||isset($_COOKIE["loggedindont"])){
	header("Location:userProfile.php");
}
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
    <link href="https://fonts.googleapis.com/css2?family=Bree+Serif&display=swap" rel="stylesheet">
    <title>Login Page</title>
    <style>
        body, header {
   font-family: 'Bree Serif', serif;
}
    </style>

</head>
<body>
    <header>
        <h1>Login</h1>
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
        <button id="menuButton" >
            &#9776;
        </button>
        <div id="logoLogin">
            <img src="logo.png" alt="logo" class="loginLogo">
            <div class="login">
                <form action="proceseaza.php" method="post">
                    <input type="email" name="email" placeholder="user_email" required />
                    <input type="password" name="password" placeholder="user_password" required />
                    <button class="actionButton" type="submit" name="loginbutton">Login</button>
                    <div class="remember-me">
                        <input type="checkbox" id="check" name="check" placeholder="check"/>
                        <label for="check">Remember me</label>
                    </div>
                </form>
                <p>Dont have an account? <a href="register.php">Create one now!</a></p>
                <?php if ($error): ?>
                    <p style="color: red;"><?php echo $error; ?></p>
                <?php endif; ?>
            </div>
        </div>
    </main>
    <script src="script.js"></script>

</body>
</html>