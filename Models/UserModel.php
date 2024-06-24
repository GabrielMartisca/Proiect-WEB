<?php
include '../Models/shoppinglist_model.php';
class UserModel {
    public $mysql;

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

    public function getConnection(){
        return $this->mysql;
    }
    
    public function getAllUsers() {
        $query = "SELECT * FROM users";
        $result = $this->mysql->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getUserById($userID) {
        $query = "SELECT * FROM users WHERE userID = ?";
        $stmt = $this->mysql->prepare($query);
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    
    public function addUser($username, $email, $password, $role) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)";
        $stmt = $this->mysql->prepare($query);
        $stmt->bind_param("ssss", $username, $email, $hashedPassword, $role);
        $stmt->execute();
    }

    public function updateUser($userID, $username, $email, $role) {
        $query = "UPDATE users SET username = ?, email = ?, role = ?, is_locked = ? WHERE userID = ?";
        $stmt = $this->mysql->prepare($query);
        $lock = 0;
        $stmt->bind_param("sssii", $username, $email, $role, $lock, $userID);
        $stmt->execute();
    }

    public function deleteUser($userID) {
        $shoppingListModel = new ShoppingListModel();
    
        $this->mysql->begin_transaction();
    
        try {
            // Delete user allergens
            $query = "DELETE FROM user_allergens WHERE userID = ?";
            $stmt = $this->mysql->prepare($query);
            $stmt->bind_param("i", $userID);
            $stmt->execute();
    
            // Delete user regimes
            $query = "DELETE FROM user_regimes WHERE userID = ?";
            $stmt = $this->mysql->prepare($query);
            $stmt->bind_param("i", $userID);
            $stmt->execute();
    
            // Delete user favorite food
            $query = "DELETE FROM user_favorite_food WHERE userID = ?";
            $stmt = $this->mysql->prepare($query);
            $stmt->bind_param("i", $userID);
            $stmt->execute();
    
            // Find and delete all lists associated with the user
            $query = "SELECT listID FROM lists WHERE userID = ?";
            $stmt = $this->mysql->prepare($query);
            $stmt->bind_param("i", $userID);
            $stmt->execute();
            $result = $stmt->get_result();
    
            while ($row = $result->fetch_assoc()) {
                $shoppingListModel->deleteShoppingList($row['listID']);
            }
    
            // Delete the user
            $query = "DELETE FROM users WHERE userID = ?";
            $stmt = $this->mysql->prepare($query);
            $stmt->bind_param("i", $userID);
            $stmt->execute();
    
            $this->mysql->commit();
            return $stmt->affected_rows > 0;
        } catch (mysqli_sql_exception $exception) {
            $this->mysql->rollback();
            throw $exception;
        }
    }
    
    

    public function resetPassword($userID, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $query = "UPDATE users SET password = ? WHERE userID = ?";
        $stmt = $this->mysql->prepare($query);
        $stmt->bind_param("si", $hashedPassword, $userID);
        $stmt->execute();
    }

    public function updateUserLock($userID, $is_locked) {
        $query = "UPDATE users SET is_locked = ? WHERE userID = ?";
        $stmt = $this->mysql->prepare($query);
        $stmt->bind_param("ii", $is_locked, $userID);
        $stmt->execute();
    }

    public function emailExists($email) {
        $query = "SELECT COUNT(*) as count FROM users WHERE email = ?";
        $stmt = $this->mysql->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result['count'] > 0;
    }
}

