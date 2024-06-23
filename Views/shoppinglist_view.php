
<?php
session_start(); // Start the session at the beginning of your script
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/styles.css">
    <title>Shopping List</title>
    <link rel="icon" type="image/x-icon" href="../public/logo.png">

</head>

<body class="shoplist">
    <header>
        <h1>Shopping List</h1>
    </header>
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
    <br>
    <div class="container">
        <div class="shopping-list-container">
            <h1>My Shopping List</h1>
            <input type="hidden" id="userID" value=""> <!-- Dynamically set the user ID -->
            <ul id="shoppingList">
                <!-- Shopping list items will be rendered here -->
            </ul>
            <div class="add-item">
                <input type="text" id="itemInput" placeholder="Add new item">
                <button class="addItem" onclick="addItem()">Add</button>
            </div>
        </div>
    </div>
    <div class="action-buttons">
        <button class="actionButton" onclick="finishList()">Finish List</button>
        <button id="viewListHistoryButton" class="actionButton" onclick="viewListHistory()">List History</button>
        <button class="actionButton" onclick="deleteList()">Delete List</button>
    </div>

    <!-- Modal for List History -->
    <div id="listHistoryModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Shopping List History</h2>
            <ul id="listHistory" class="input-container">
                <!-- List history will be displayed here -->
            </ul>
        </div>
    </div>

    <!-- Modal for Adding List Name -->
    <div id="listNameModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeNameModal()">&times;</span>
            <h2>Enter List Name</h2>
            <div>
                <input type="text" id="listNameInput" placeholder="Enter list name">
                <button onclick="submitList()">Submit</button>
            </div>
        </div>
    </div>

    <script src="../public/script.js"></script>
</body>

</html>