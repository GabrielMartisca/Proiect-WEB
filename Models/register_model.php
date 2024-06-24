<?php
include '../Models/model.php';

function verifyRegister() {
    session_start();
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    $userModel = new UserModel();

    $existingUser = $userModel->getUserByEmail($email);
    if ($existingUser) {
        $_SESSION['error'] = "Email already in use!";
        header("Location: ../Controllers/register_controller.php");
        exit();
    } else {
        if ($password != $confirm_password) {
            $_SESSION['error'] = "Passwords do not match!";
            header("Location: ../Controllers/register_controller.php");
            exit();
        } else {
            $hashedPass = password_hash($password, PASSWORD_DEFAULT);

            $userModel->mysql->begin_transaction();

            try {
                // Insert the new user into the users table
                $query = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
                $stmt = $userModel->mysql->prepare($query);
                $stmt->bind_param("sss", $username, $email, $hashedPass);

                if (!$stmt->execute()) {
                    throw new Exception('Insertion into users table failed');
                }

                $userModel->mysql->commit();

                header("Location: ../Controllers/login_controller.php");
                exit();
            } catch (Exception $e) {
                // Rollback the transaction in case of an error
                $userModel->mysql->rollback();
                $_SESSION['error'] = $e->getMessage();
                header("Location: ../Controllers/register_controller.php");
                exit();
            }
        }
    }
}
