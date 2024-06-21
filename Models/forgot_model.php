<?php
include '../Models/model.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php'; 

function sendForgotMail(){
    session_start();
    $error = isset($_SESSION['error']) ? $_SESSION['error'] : '';
    unset($_SESSION['error']);
    $userModel=new UserModel();
    $randomNumber = mt_rand(100000, 999999);
    
    
    $subject = "Password Reset Code";
    $message = "Your password reset code is: " . $randomNumber;
    
    $senderEmail = "noreply@CuPo.com"; 
    $recipientEmail = $_POST['email'];
    $_SESSION['email'] = $recipientEmail;
    $user=$userModel->getUserByEmail($recipientEmail);

    if($user){
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

            header("Location: ../Controllers/enter_reset_code_controller.php");
            exit();
        } catch (Exception $e) {
            $_SESSION['error'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            header("Location: ../Controllers/forgot_controller.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "Email not found in the system. Please try again.";
        header("Location: ../Controllers/forgot_controller.php");
        exit();
    }
    
}





