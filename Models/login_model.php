<?php
include '../Models/model.php';
function verifyLogin() {
    session_start();
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $check = isset($_POST['check']) ? $_POST['check'] : 'not';

    $userModel = new UserModel();
    $user = $userModel->getUserByEmail($email);

    if ($user && password_verify($pass, $user['password'])) {
        $username = $user['username'];

        if ($check == "on") {
            setcookie("loggedin", $username, time() + (86400 * 30),"/");
        } else {
            setcookie("loggedindont", $username,0,"/");
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
