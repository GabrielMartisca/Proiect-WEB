<?php

include 'model.php';

class PreferenceModel {
    private $db;

    public function __construct() {
        $userModel = new UserModel();
        $this->db = $userModel->getConnection();
    }

    public function getPreferences($userID) {
        $query = 'SELECT * FROM preferences WHERE userID = ?';
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $userID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function updatePreferences($userID, $preferences) {
        $query = 'UPDATE preferences SET allergens = ?, regime = ?, favoriteFoods = ? WHERE userID = ?';
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sssi', $preferences['allergens'], $preferences['regime'], $preferences['favoriteFoods'], $userID);
        $stmt->execute();
    }
}
?>
