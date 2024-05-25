<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="../public/styles.css">
    <link rel="icon" type="image/x-icon" href="../public/logo.png">

</head>
<body class="shoplist">
    <header>
        <h1>User Profile</h1>
    </header>
    <div id="sideMenu">
            <br>
            <a href="../Controllers/userProfile_controller.php">User Profile</a>
            <a href="../Controllers/preference_controller.php">Preferences Management</a>
            <a href="../Controllers/shoppinglist_controller.php">Shopping List</a>
            <a href="../Controllers/foodDatabase_controller.php">Food Database</a>
            <a href="../Controllers/statistics_controller.php">Statistics</a>
            <a href="#" id="logoutLink">Logout</a>
            <form id="logoutForm" action="../public/logout.php" method="post">
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

    <script src="../public/script.js"></script>
    <script>
        document.getElementById('logoutLink').addEventListener('click', function(e) {
    e.preventDefault();
    document.getElementById('logoutForm').submit();
});
    </script>
</body>
</html>