<?php
session_start();

if (!isset($_SESSION['reset_code'])) {
    header("Location: forgot_password.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    if ($newPassword !== $confirmPassword) {
        $error = "Passwords do not match. Please try again.";
    } else {

        $email = $_SESSION['email']; 
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $mysql = new mysqli (
            'localhost', // locatia serverului (aici, masina locala)
            'root',       // numele de cont
            '',    // parola (atentie, in clar!)
            'users'   // baza de date
            );
        
        // verificam daca am reusit
        if (mysqli_connect_errno()) {
            die ('Conexiunea a esuat...');
        }
        
        $query = "UPDATE students set password='$hashedPassword' WHERE email= '$email'";
        if (!$result = $mysql->query($query)) {
            die('Insertion into db failed');
        } else {
            header("Location: login.php");        
        }

        unset($_SESSION['reset_code']);
        unset($_SESSION['email']);

      
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="styles.css" rel="stylesheet" type="text/css">
    <link rel="icon" type="image/x-icon" href="logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Bree+Serif&display=swap" rel="stylesheet">
    <title>Reset Password</title>
    <style>
        body, header {
            font-family: 'Bree Serif', serif;
        }
    </style>
</head>
<body>
    <header>
        <h1>Reset Password</h1>
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
    <script src="script.js"></script>
</body>
</html>
