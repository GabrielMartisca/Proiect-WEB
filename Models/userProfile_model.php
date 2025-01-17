<?php
if(!isset($_COOKIE["loggedin"])&&!isset($_COOKIE["loggedindont"])){
	header("Location:../Controllers/login_controller.php");
}

class UserProfileModel {
    private $mysql;

    public function __construct() {
        $this->mysql = new mysqli(
            'localhost', // server location (here, local machine)
            'root',       // username
            '',           // password (careful, in plain text!)
            'cupo'       // database
        );

        if (mysqli_connect_errno()) {
            die('Connection failed...');
        }
    }

    public function getUserById($userID) {
        $query = "SELECT * FROM users WHERE userID = ?";
        $stmt = $this->mysql->prepare($query);
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function getUserAllergens($userID) {
        $query = "SELECT allergen FROM user_allergens WHERE userID = ?";
        $stmt = $this->mysql->prepare($query);
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getUserRegimes($userID) {
        $query = "SELECT regime FROM user_regimes WHERE userID = ?";
        $stmt = $this->mysql->prepare($query);
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getUserFavoriteFoods($userID) {
        $query = "SELECT favoriteFood FROM user_favorite_food WHERE userID = ?";
        $stmt = $this->mysql->prepare($query);
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function updateUserProfilePicture($userID, $filePath) {
        $query = "UPDATE users SET profile_picture = ? WHERE userID = ?";
        $stmt = $this->mysql->prepare($query);
        $stmt->bind_param("si", $filePath, $userID);
        $stmt->execute();
    }
}