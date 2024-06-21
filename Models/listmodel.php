<?php
class ListModel {
    protected $mysql;

    public function __construct() {
        $this->mysql = new mysqli(
            'localhost', 
            'root', 
            '', 
            'cupo'
        );

        if (mysqli_connect_errno()) {
            die('Connection failed: ' . mysqli_connect_error());
        }
    }

    public function __destruct() {
        $this->mysql->close();
    }
}

