<?php
session_start();
$error = isset($_SESSION['error']) ? $_SESSION['error'] : '';
unset($_SESSION['error']);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $randomNumber = mt_rand(100000, 999999);


    $subject = "Password Reset Code";
    $message = "Your password reset code is: " . $randomNumber;

    // Sender and recipient
    $senderEmail = "stefanadrian69420@gmail.com"; 
    $recipientEmail = $_POST['email'];
    $_SESSION['email'] = $recipientEmail;

    $mysql = new mysqli(
        'localhost', // server location (here, local machine)
        'root',       // username
        '',    // password (careful, in plain text!)
        'users'   // database
    );

    // Check connection
    if (mysqli_connect_errno()) {
        die('Connection failed...');
    }

    $query = "SELECT username FROM students WHERE email = '$recipientEmail'";
    if (!$result = $mysql->query($query)) {
        die('Query error occurred');
    }

    if ($result->num_rows > 0) {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Port = 2525;
            $mail->Username = 'be639d73eebfdf';
            $mail->Password = '5de61bef424488';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

            $mail->setFrom($senderEmail);
            $mail->addAddress($recipientEmail);


            $mail->isHTML(false);
            $mail->Subject = $subject;
            $mail->Body = $message;


            $mail->send();

            $_SESSION['reset_code'] = $randomNumber;

            header("Location: enter_reset_code.php");
            exit();
        } catch (Exception $e) {
            $_SESSION['error'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            header("Location: forgot.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "Email not found in the system. Please try again.";
        header("Location: forgot.php");
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
    <title>Forgot Password</title>
</head>
<body>
    <header>
        <h1>Forgot Password</h1>
    </header>
    <main class="logins">
        
        <div id="logoLogin">
            <img src="logo.png" alt="logo" class="loginLogo">
            <div class="login">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <input type="email" name="email" placeholder="Your Email" required />
                    <button class="actionButton" type="submit" name="resetbutton">Reset Password</button>
                </form>
                <?php if ($error): ?>
                    <p style="color: red;"><?php echo $error; ?></p>
                <?php endif; ?>
            </div>
        </div>
    </main>
    <script src="script.js"></script>
</body>
</html>
