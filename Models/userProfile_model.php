<?php
if(!isset($_COOKIE["loggedin"])&&!isset($_COOKIE["loggedindont"])){
	header("Location:../Controllers/login_controller.php");
}
