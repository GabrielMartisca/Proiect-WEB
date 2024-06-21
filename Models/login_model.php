<?php
include '../Models/model.php';
function verifyLogin() {
    session_start();
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $check = isset($_POST['check']) ? $_POST['check'] : 'not';

    $userModel = new UserModel();
    $user = $userModel->getUserByEmail($email);
    $_SESSION['username']=$user['username'];
    if ($user && password_verify($pass, $user['password'])) {
        $username = $user['username'];
        $userId=(string)$user['userID'];

        if ($check == "on") {
            if (setcookie("loggedin", $userId, time() + (86400 * 30), "/")) {
                error_log("Cookie 'loggedin' set successfully with userId: $userId");
            } else {
                error_log("Failed to set cookie 'loggedin' with userId: $userId");
            }
        } else {
            if (setcookie("loggedindont", $userId, 0, "/")) {
                error_log("Cookie 'loggedindont' set successfully with username: $username");
            } else {
                error_log("Failed to set cookie 'loggedindont' with username: $username");
            }
        }
        //header("Location: ../views/user_profile.php");
        header("Location: ../Controllers/login_controller.php");
        exit();
    } else {
        $_SESSION['error'] = "Login Failed! Check your email and password and try again!";
        header("Location: ../controllers/login_controller.php");
        exit();
    }
}
