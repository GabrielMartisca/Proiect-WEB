<?php
include '../Models/model.php';

function changePassword(){
    session_start();
    if (!isset($_SESSION['reset_code'])) {
        header("Location: forgot_password.php");
        exit();
    }
    
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];
    
    if ($newPassword !== $confirmPassword) {
        $_SESSION['error'] = "Passwords do not match. Please try again.";
    } else {
    
        $email = $_SESSION['email']; 
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $userModel=new UserModel();
    
        
        $query = "UPDATE users set password=? WHERE email= ?";
        $stmt=$userModel->mysql->prepare($query);
        $stmt->bind_param("ss",$hashedPassword,$email);
        if(!$stmt->execute()){
            die('Insertion into db failed');
        }
        else{
            header("Location: ../Controllers/login_controller.php");
        }
     
    
        unset($_SESSION['reset_code']);
        unset($_SESSION['email']);
    
      
        exit();
    }
}


