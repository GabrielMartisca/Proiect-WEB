<?php
include '../Models/model.php';

function verifyRegister(){
    session_start();
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    $userModel = new UserModel();

    $existingUser = $userModel->getUserByEmail($email);
    if($existingUser){
        $_SESSION['error'] = "Email already in use!";
        header("Location: ../Controllers/register_controller.php");
        exit();
    } else {
        if($password != $confirm_password){
            $_SESSION['error'] = "Passwords do not match!";
            header("Location: ../Controllers/register_controller.php");
            exit();
        } else {
            $hashedPass = password_hash($password, PASSWORD_DEFAULT);

            $query = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
            $stmt = $userModel->mysql->prepare($query);
            $stmt->bind_param("sss", $username, $email, $hashedPass);

            if (!$stmt->execute()) {
                die('Insertion into db failed');
            } else {
                header("Location: ../Controllers/login_controller.php");
                exit();
            }
        }
    }
}



