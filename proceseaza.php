<?php
/* Un program PHP5 ilustrand maniera de interogare 
	a serverului MySQL via extensia mysqli
     
 	Autor: Sabin-Corneliu Buraga - https://profs.info.uaic.ro/~busaco/
	2007, 2008, 2011, 2015, 2017
   
     Ultima actualizare: 14 martie 2017
*/    

// instantiem obiectul MySQL, via constructorul care va realiza   
// conectarea la serverul MySQL
if(isset($_POST['loginbutton'])){
    $email=$_POST['email'];
    $pass=$_POST['password'];
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


if ($result->num_rows > 0) {
    $user = $result->fetch_assoc()['username'];
    echo "Login Successful! Welcome $user!";
} else {
    echo "Login Failed! Check your mail and password and try again!";
}
echo ('<ol>');

$mysql->close();
?>

