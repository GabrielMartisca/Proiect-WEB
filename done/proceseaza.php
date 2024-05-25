<?php
session_start();

if (isset($_POST['loginbutton'])) {
    $email = $_POST['email'];
    $pass = $_POST['password'];
    if (isset($_POST['check'])) {
        $check = $_POST['check'];
    } else {
        $check = 'not';
    }

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


    $query = "SELECT username, password FROM students WHERE email = ?";
    $stmt = $mysql->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashedPass = $row['password'];
        

        if (password_verify($pass, $hashedPass)) {
            $user = $row['username'];

            if ($check == "on") {
                setcookie("loggedin", $user, time() + (86400 * 30),"/");
            } else {
                setcookie("loggedindont", $user,"/");
            }

            header("Location: userProfile.php");
            exit();
        } else {
            $_SESSION['error'] = "Login Failed! Check your email and password and try again!";
        }
    } else {
        $_SESSION['error'] = "Login Failed! Check your email and password and try again!";
    }

    $stmt->close();
    $mysql->close();
    header("Location: login.php");
    exit();
}
?>
