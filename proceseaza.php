<?php
session_start();

if(isset($_POST['loginbutton'])){
    $email=$_POST['email'];
    $pass=$_POST['password'];
	if(isset($_POST['check'])){
		$check=$_POST['check'];
	}else{
		$check= 'not';
	}
}
$mysql = new mysqli (
	'localhost', // locatia serverului (aici, masina locala)
	'root',       // numele de cont
	'',    // parola (atentie, in clar!)
	'users'   // baza de date
	);

// verificam daca am reusit
if (mysqli_connect_errno()) {
	die ('Conexiunea a esuat...');
}

$query = "SELECT username FROM students WHERE email = '$email' AND password = '$pass'";
if (!$result = $mysql->query($query)) {
	die ('A survenit o eroare la interogare');
}

if($check=="on"){
	
	if ($result->num_rows > 0) {
		$user = $result->fetch_assoc()['username'];
		setcookie("loggedin", $user, time() + (86400 * 30));
		header("Location:userProfile.php");
	} else {
		$_SESSION['error']="Login Failed! Check you email and password and try again!";
	}

}else{
	if ($result->num_rows > 0) {
		$user = $result->fetch_assoc()['username'];
		setcookie("loggedindont", $user);
		header("Location:userProfile.php");
	} else {
		$_SESSION['error']="Login Failed! Check you email and password and try again!";
	}
}
echo ('<ol>');

$mysql->close();
header("Location: login.php");
exit();



