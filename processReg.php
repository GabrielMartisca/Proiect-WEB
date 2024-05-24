<?php
session_start();

if (isset($_POST['registerbutton'])) {
    $user = $_POST['username'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $pass2 = $_POST['confirm_password'];

    $mysql = new mysqli(
        'localhost', // server location (here, local machine)
        'root',       // username
        '',    // password (careful, in plain text!)
        'users'   // database
    );

    // check connection
    if (mysqli_connect_errno()) {
        die('Connection failed...');
    }

    $query = "SELECT username FROM students WHERE email = '$email'";
    if (!$result = $mysql->query($query)) {
        die('Query error occurred');
    }

    if ($result->num_rows > 0) {
        $_SESSION['error'] = "Email already in use!";
    } else {
        if ($pass != $pass2) {
            $_SESSION['error'] = "Passwords do not match!";
        } else {
            $query = "INSERT INTO students (username, email, password) VALUES ('$user', '$email', '$pass')";
            if (!$result = $mysql->query($query)) {
                die('Insertion into db failed');
            } else {
                header("Location: login.php");
                exit();
            }
        }
    }

    $mysql->close();
    header("Location: register.php");
    exit();
}
