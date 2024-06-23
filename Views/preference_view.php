
<?php
session_start(); // Start the session at the beginning of your script
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preferences Management</title>
    <link rel="stylesheet" href="../public/styles.css">
    <link rel="icon" type="image/x-icon" href="../public/logo.png">
</head>
<body class="preferenceContainer">
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
    <button id="menuButton">&#9776;</button>
    <div class="preferenceContainer">
        <div class="profilePreference">
            <div class="editBox" id="editBox1">
                <span>Edit Allergens</span>
            </div>
            <div class="editBox" id="editBox2">
                <span>Edit Regime</span>
            </div>
            <div class="editBox" id="editBox3">
                <span>Edit Favorite Foods</span>
            </div>
        </div>
    </div>

    <!-- Modal for Editing Preferences -->
    <div id="preferenceModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closePreferenceModal()">&times;</span>
            <h2>Edit Preference</h2>
            <input type="hidden" id="userID" value="<?php echo $userID; ?>"> <!-- Set the user ID -->
            <input type="hidden" id="preferenceType" value=""> <!-- Set the preference type -->
            <textarea id="preferenceInput" placeholder="Enter your preference"></textarea>
            <button onclick="savePreference()">Save</button>
        </div>
    </div>
    <script src="../public/script.js"></script>
</body>
</html>
