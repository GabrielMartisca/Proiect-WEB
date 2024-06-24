<?php
if (!isset($_COOKIE["loggedin"]) && !isset($_COOKIE["loggedindont"])) {
    header("Location: ../Controllers/login_controller.php");
    exit();
}

class StatisticsModel {
    private $mysql;

    public function __construct() {
        $this->mysql = new mysqli(
            'localhost', // server location (here, local machine)
            'root',       // username
            '',           // password (careful, in plain text!)
            'cupo'       // database
        );

        if (mysqli_connect_errno()) {
            die('Connection failed: ' . mysqli_connect_error());
        }
    }

    public function getTopFavoriteFoods() {
        $query = "SELECT favoriteFood, COUNT(*) as count FROM user_favorite_food GROUP BY favoriteFood ORDER BY count DESC LIMIT 3";
        $result = $this->mysql->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getTopCommonAllergens() {
        $query = "SELECT allergen, COUNT(*) as count FROM user_allergens GROUP BY allergen ORDER BY count DESC LIMIT 3";
        $result = $this->mysql->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getTopCommonDiets() {
        $query = "SELECT regime, COUNT(*) as count FROM user_regimes GROUP BY regime ORDER BY count DESC LIMIT 3";
        $result = $this->mysql->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getTopBoughtItems() {
        $query = "SELECT name, COUNT(*) as count FROM items GROUP BY name ORDER BY count DESC LIMIT 3";
        $result = $this->mysql->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function __destruct() {
        $this->mysql->close();
    }
}
?>
