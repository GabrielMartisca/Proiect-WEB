<?php
if(!isset($_COOKIE["loggedin"])&&!isset($_COOKIE["loggedindont"])){
	header("Location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preferences Management</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" type="image/x-icon" href="logo.png">
</head>
<body class="shoplist">
    <header>
        <h1>Preferences Management</h1>
    </header>
    <div id="sideMenu">
            <br>
            <a href="userProfile.php">User Profile</a>
            <a href="preference.php">Preferences Management</a>
            <a href="shoppinglist.php">Shopping List</a>
            <a href="foodDatabase.php">Food Database</a>
            <a href="statistics.php">Statistics</a>
            <a href="#" id="logoutLink">Logout</a>
            <form id="logoutForm" action="logout.php" method="post">
                <input type="hidden" name="logoutbutton" value="1">
            </form>
        </div>
    <button id="menuButton" >
        &#9776;
    </button>
    <br>
    <div class="preferenceContainer">
        <a href="#" class="editBox" id="editBox1"> Edit Alergens </a>
        <a href="#" class="editBox" id="editBox2"> Edit Regime </a>
        <a href="#" class="editBox" id="editBox3"> Edit Favorite Foods </a>
    </div>

    <script src="script.js"></script>
</body>
</html>