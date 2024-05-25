<?php
class UserModel {
    public $mysql;

    public function __construct() {
        $this->mysql = new mysqli(
            'localhost', // server location (here, local machine)
            'root',       // username
            '',           // password (careful, in plain text!)
            'users'       // database
        );

        if (mysqli_connect_errno()) {
            die('Connection failed...');
        }
    }

    public function getUserByEmail($email) {
        $query = "SELECT username, password FROM students WHERE email = ?";
        $stmt = $this->mysql->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function __destruct() {
        $this->mysql->close();
    }
}