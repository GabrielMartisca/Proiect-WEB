<?php
session_start(); 
if (!(isset($_COOKIE["loggedin"]) || isset($_COOKIE["loggedindont"]))) {
    header("Location: ../Controllers/login_controller.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="../public/styles.css" rel="stylesheet" type="text/css">
    <link rel="icon" type="image/x-icon" href="../public/logo.png">
    <title>Statistics</title>
</head>

<body>
    <header>
        <h1>Statistics</h1>
    </header>
    <main class="logins">
        <div id="sideMenu">
            <br>
            <a href="../Controllers/userProfile_controller.php">User Profile</a>
            <a href="../Controllers/preference_controller.php">Preferences Management</a>
            <a href="../Controllers/shoppinglist_controller.php">Shopping List</a>
            <a href="../Controllers/foodDatabase_controller.php">Food Database</a>
            <a href="../Controllers/statistics_controller.php">Statistics</a>
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
                <a href="../Controllers/UserController.php">Admin Page</a>
            <?php endif; ?>
            <a href="#" id="logoutLink">Logout</a>
            <form id="logoutForm" action="../public/logout.php" method="post">
                <input type="hidden" name="logoutbutton" value="1">
            </form>
        </div>
        <button id="menuButton">
            &#9776;
        </button>
        <div id="Statistics">
            <div class="stats-container">
                <div class="stats-item">
                    <h3>Top 3 Favorite Foods</h3>
                    <ul id="favoriteFoods"></ul>
                </div>
                <div class="stats-item">
                    <h3>Top 3 Most common allergens</h3>
                    <ul id="commonAllergens"></ul>
                </div>
                <div class="stats-item">
                    <h3>Top 3 most common diets</h3>
                    <ul id="commonDiets"></ul>
                </div>
                <div class="stats-item">
                    <h3>Most Bought Food Items</h3>
                    <ul id="boughtItems"></ul>
                </div>
            </div>
            <button class="save" id="exportCSV">Export as CSV</button>
            <button class="save" id="exportPDF">Export as PDF</button>
        </div>
    </main>
    <script src="../public/script.js"></script>
</body>

</html>
