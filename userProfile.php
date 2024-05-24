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
    <title>User Profile</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" type="image/x-icon" href="logo.png">

</head>
<body class="shoplist">
    <header>
        <h1>User Profile</h1>
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
    <div class="container2">
        <div class="profilePreference">
            <div>Alergens</div>
            <div class="profileBox">No current Allergens</div>
            <div>Regime</div>
            <div class="profileBox">No current Regime</div>
            <div>Favorite Foods</div>
            <div class="profileBox">No current Favorite Foods</div>
        </div>

        <div class="image-container">
          <img src="https://static.wikia.nocookie.net/d92f8304-34eb-4769-b050-47c68421cd9b/scale-to-width/370" alt="Circular Image">
          <button>Edit Profile</button>
        </div>
      </div>

    <script src="script.js"></script>
    <script>
        document.getElementById('logoutLink').addEventListener('click', function(e) {
    e.preventDefault();
    document.getElementById('logoutForm').submit();
});
    </script>
</body>
</html>