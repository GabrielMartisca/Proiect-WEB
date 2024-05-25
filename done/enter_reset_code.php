<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $enteredCode = $_POST['reset_code'];
    if ($enteredCode == $_SESSION['reset_code']) {
        header("Location: reset_password.php");
        exit();
    } else {  
        $error = "Invalid reset code. Please try again.";
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
    <title>Enter Reset Code</title>
    <style>
        body, header {
            font-family: 'Bree Serif', serif;
        }
    </style>
</head>
<body>
    <header>
        <h1>Enter Reset Code</h1>
    </header>
    <main class="logins">
      
        <div id="logoLogin">
            <img src="logo.png" alt="logo" class="loginLogo">
            <div class="login">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <input type="text" name="reset_code" placeholder="Enter your reset code" required />
                    <button class="actionButton" type="submit" name="submitbutton">Submit</button>
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
