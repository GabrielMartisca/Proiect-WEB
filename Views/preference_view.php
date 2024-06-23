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
        <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
            <a href="../Controllers/UserController.php">Admin Page</a>
        <?php endif; ?>
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
                <span>Edit Favorite Food</span>
            </div>
        </div>
    </div>

    <!-- Modal for Editing Preferences -->
    <div id="preferenceModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closePreferenceModal()">&times;</span>
            <h2>Edit Preference</h2>
            <input type="hidden" id="userID" value="<?php echo $_SESSION['userID']; ?>"> <!-- Set the user ID -->
            <input type="hidden" id="preferenceType" value=""> <!-- Set the preference type -->

            <!-- Allergen options -->
            <div id="allergenOptions" class="preferenceOptions">
                <?php 
                $allergens = ['Milk', 'Eggs', 'Fish', 'Crustacean shellfish', 'Tree nuts', 'Peanuts', 'Wheat', 'Soybeans'];
                foreach ($allergens as $allergen): 
                    $checked = in_array($allergen, $allergens) ? 'checked' : '';
                ?>
                    <label>
                        <input type="checkbox" name="allergens[]" value="<?php echo $allergen; ?>" <?php echo $checked; ?>>
                        <?php echo $allergen; ?>
                    </label>
                <?php endforeach; ?>
            </div>

            <!-- Regime options -->
            <div id="regimeOptions" class="preferenceOptions">
                <?php 
                $regimes = ['Vegetarian', 'Vegan', 'Keto', 'Paleo', 'Mediterranean'];
                foreach ($regimes as $regime): 
                    $checked = in_array($regime, $regimes) ? 'checked' : '';
                ?>
                    <label>
                        <input type="checkbox" name="regimes[]" value="<?php echo $regime; ?>" <?php echo $checked; ?>>
                        <?php echo $regime; ?>
                    </label>
                <?php endforeach; ?>
            </div>

            <!-- Favorite Food option -->
            <div id="favoriteFoodOption" class="preferenceOptions">
                <label for="favoriteFood">Favorite Food:</label>
                <input type="text" id="favoriteFood" name="favoriteFood" value="<?php echo htmlspecialchars($favoriteFood); ?>">
            </div>

            <button onclick="savePreferences()">Save</button>
        </div>
    </div>
    <script src="../public/script.js"></script>
</body>
</html>
