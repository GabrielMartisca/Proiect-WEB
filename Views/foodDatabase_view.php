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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Database</title>
    <link rel="stylesheet" href="../public/styles.css">
    <link rel="icon" type="image/x-icon" href="../public/logo.png">
</head>

<body class="db">
    <header>
        <h1>Food DataBase</h1>
    </header>

    <main class="dbmain">
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
        <div class="search-container">
            <input type="text" id="searchInput" placeholder="Search for products...">
            <button id="searchButton">Search</button>
        </div>

        <div id="spinnerContainer" class="spinner-container">
            <div class="spinner"></div>
        </div>

        <section id="productsContainer" class="products">
        </section>

        <input type="hidden" id="userID" value="">

    </main>
    <div id="listSelectionModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeListSelectionModal()">&times;</span>
            <h2>Select or Create a Shopping List</h2>
            <div>
                <label for="existingList">Select an existing list:</label>
                <select id="existingList">
                </select>
            </div>
            <div>
                <label for="newListName">Or create a new list:</label>
                <input type="text" id="newListName" placeholder="New list name">
            </div>
            <button class="actionButton" onclick="addProductToList()">Add to List</button>
        </div>
    </div>

    <script src="../public/script.js"></script>
    <script>
        document.getElementById('logoutLink').addEventListener('click', function (e) {
            e.preventDefault();
            document.getElementById('logoutForm').submit();
        });
    </script>

</body>

</html>