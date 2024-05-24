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
    <link rel="stylesheet" href="styles.css">
    <title>Shopping List</title>
    <link rel="icon" type="image/x-icon" href="logo.png">

</head>
<body class="shoplist">
    <header>
        <h1>Shopping List</h1>
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
    <button id="menuButton">
        &#9776;
    </button>
    <br>
    <div class="container">
        <div class="shopping-list-container">
            <h1>My Shopping List</h1>
            <ul id="shoppingList">
            </ul>
            <div class="add-item">
                <input type="text" id="itemInput" placeholder="Add new item">
                <button class="addItem" onclick="addItem()">Add</button>
            </div>
        </div>
    </div>
    <div class="action-buttons">
        <button class="actionButton" onclick="finishList()">Finish List</button>
        <button class="actionButton" onclick="viewListHistory()">List History</button>
        <button class="actionButton" onclick="deleteList()">Delete List</button>
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