<?php

class PreferenceModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllergens($userID) {
        $query = 'SELECT allergen FROM user_allergens WHERE userID = ?';
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $userID);
        $stmt->execute();
        $result = $stmt->get_result();
        $allergens = [];
        while ($row = $result->fetch_assoc()) {
            $allergens[] = $row['allergen'];
        }
        return $allergens;
    }

    public function updateAllergens($userID, $allergens) {
        $this->db->begin_transaction();
        $query = 'DELETE FROM user_allergens WHERE userID = ?';
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $userID);
        $stmt->execute();

        $query = 'INSERT INTO user_allergens (userID, allergen) VALUES (?, ?)';
        $stmt = $this->db->prepare($query);
        foreach ($allergens as $allergen) {
            $stmt->bind_param('is', $userID, $allergen);
            $stmt->execute();
        }
        $this->db->commit();
    }

    public function getRegimes($userID) {
        $query = 'SELECT regime FROM user_regimes WHERE userID = ?';
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $userID);
        $stmt->execute();
        $result = $stmt->get_result();
        $regimes = [];
        while ($row = $result->fetch_assoc()) {
            $regimes[] = $row['regime'];
        }
        return $regimes;
    }

    public function updateRegimes($userID, $regimes) {
        $this->db->begin_transaction();
        $query = 'DELETE FROM user_regimes WHERE userID = ?';
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $userID);
        $stmt->execute();

        $query = 'INSERT INTO user_regimes (userID, regime) VALUES (?, ?)';
        $stmt = $this->db->prepare($query);
        foreach ($regimes as $regime) {
            $stmt->bind_param('is', $userID, $regime);
            $stmt->execute();
        }
        $this->db->commit();
    }

    public function getFavoriteFood($userID) {
        $query = 'SELECT favoriteFood FROM user_favorite_food WHERE userID = ?';
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $userID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc()['favoriteFood'] ?? '';
    }

    public function updateFavoriteFood($userID, $favoriteFood) {
        $query = 'REPLACE INTO user_favorite_food (userID, favoriteFood) VALUES (?, ?)';
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('is', $userID, $favoriteFood);
        $stmt->execute();
    }
}
?>
