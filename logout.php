<?php
if(isset($_POST['logoutbutton'])){

    if (isset($_COOKIE['loggedin'])) {
        unset($_COOKIE['loggedin']); 
        setcookie("loggedin", "", time()-3600); 
        header("Location:login.php");
        return true;
    } 
    if (isset($_COOKIE['loggedindont'])) {
        echo "Haplea   ";
        unset($_COOKIE['loggedindont']); 
        setcookie("loggedindont", "", time()-3600); 
        header("Location:login.php");
        return true;
    } else {
        return false;
    }
}

