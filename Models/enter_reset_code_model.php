<?php

function checkCode(){
    session_start();
    $enteredCode = $_POST['reset_code'];
    if ($enteredCode == $_SESSION['reset_code']) {
        header("Location: ../Controllers/reset_password_controller.php");
        exit();
    } else {  
        $_SESSION['error'] = "Invalid reset code. Please try again.";
    }

}

