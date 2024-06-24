<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="../public/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Bree+Serif&display=swap" rel="stylesheet">
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
    <div class="container2">
        <div class="profilePreference">
            <div>Allergens</div>
            <div class="profileBox">
                <?php
                if (!empty($allergens)) {
                    foreach ($allergens as $allergen) {
                        echo $allergen['allergen'] . "<br>";
                    }
                } else {
                    echo "No current Allergens";
                }
                ?>
            </div>
            <div>Regime</div>
            <div class="profileBox">
                <?php
                if (!empty($regimes)) {
                    foreach ($regimes as $regime) {
                        echo $regime['regime'] . "<br>";
                    }
                } else {
                    echo "No current Regime";
                }
                ?>
            </div>
            <div>Favorite Food</div>
            <div class="profileBox">
                <?php
                if (!empty($favoriteFoods)) {
                    echo $favoriteFoods['favoriteFood'];
                } else {
                    echo "No current Favorite Food";
                }
                ?>
            </div>
        </div>

        <div class="image-container">
            <span class="username"><?php echo $_SESSION['username']; ?></span>
            <img src="<?php echo isset($_SESSION['profile_picture']) ? $_SESSION['profile_picture'] : 'https://static.wikia.nocookie.net/d92f8304-34eb-4769-b050-47c68421cd9b/scale-to-width/370'; ?>"
                alt="Circular Image">
            <form action="../Controllers/userProfile_controller.php?action=uploadProfilePicture" method="post" enctype="multipart/form-data">
                <input type="file" name="profile_picture" required>
                <button type="submit">Upload</button>
            </form>
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
<?php
if(!isset($_COOKIE["loggedin"])&&!isset($_COOKIE["loggedindont"])){
	header("Location:../Controllers/login_controller.php");
}
?>