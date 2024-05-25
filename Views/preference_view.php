<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preferences Management</title>
    <link rel="stylesheet" href="../public/styles.css">
    <link rel="icon" type="image/x-icon" href="../public/logo.png">
</head>
<body class="shoplist">
    <header>
        <h1>Preferences Management</h1>
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
    <div class="preferenceContainer">
        <a href="#" class="editBox" id="editBox1"> Edit Alergens </a>
        <a href="#" class="editBox" id="editBox2"> Edit Regime </a>
        <a href="#" class="editBox" id="editBox3"> Edit Favorite Foods </a>
    </div>

    <script src="../public/script.js"></script>
</body>
</html>