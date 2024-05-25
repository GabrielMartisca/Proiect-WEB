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
            <a href="#" id="logoutLink">Logout</a>
            <form id="logoutForm" action="../public/logout.php" method="post">
                <input type="hidden" name="logoutbutton" value="1">
            </form>
        </div>
    <button id="menuButton" >
        &#9776;
    </button>
        <div id="Statistics">
                <div class="stats-container">
                    <div class="stats-item">
                        <h3>Top 3 Favorite Foods</h3>
                        <ul>
                            <li>Pizza - 25%</li>
                            <li>Burgers - 20%</li>
                            <li>Pasta - 15%</li>
                        </ul>
                    </div>
                    <div class="stats-item">
                        <h3>Most Popular Cuisines</h3>
                        <ul>
                            <li>Italian - 40%</li>
                            <li>American - 30%</li>
                            <li>Mexican - 20%</li>
                        </ul>
                    </div>
                    <div class="stats-item">
                        <h3>Favorite Desserts</h3>
                        <ul>
                            <li>Ice Cream - 35%</li>
                            <li>Cake - 25%</li>
                            <li>Cookies - 20%</li>
                        </ul>
                    </div>
                    <div class="stats-item">
                        <h3>Most Bought Food Items</h3>
                        <ul>
                            <li>Bread - 35%</li>
                            <li>Rice - 25%</li>
                            <li>Milk - 25%</li>
                        </ul>
                    </div>  
                    <div class="stats-item">
                        <h3>Most Bought Vegan Food Items</h3>
                        <ul>
                            <li>Tofu - 45%</li>
                            <li>Plant Based Milk - 40%</li>
                            <li>Vegetables - 10%</li>
                        </ul>
                    </div>
                    <div class="stats-item">
                        <h3>Most Bought Protein-Rich Foods</h3>
                        <ul>
                            <li>Chicken Breast - 50%</li>
                            <li>Eggs - 30%</li>
                            <li>Salmon - 15%</li>
                        </ul>
                    </div>
                    
                </div>
            </div>
        </main>
    <script src="../public/script.js"></script>
    <script>
        document.getElementById('logoutLink').addEventListener('click', function(e) {
    e.preventDefault();
    document.getElementById('logoutForm').submit();
});
    </script>

</body>
</html>