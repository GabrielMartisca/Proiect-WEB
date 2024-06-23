<?php

class UserModel {
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
        $query = "DELETE FROM users WHERE userID = ?";
        $stmt = $this->mysql->prepare($query);
        $stmt->bind_param("i", $userID);
        $stmt->execute();
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
