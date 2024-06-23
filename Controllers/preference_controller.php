<?php

include '../Models/preference_model.php';

class PreferenceController {
    private $preferenceModel;

    public function __construct() {
        $this->preferenceModel = new PreferenceModel();
    }

    public function handleRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            $userID = $data['userID'];
            $preferences = [
                'allergens' => $data['allergens'] ?? '',
                'regime' => $data['regime'] ?? '',
                'favoriteFoods' => $data['favoriteFoods'] ?? ''
            ];
            $this->preferenceModel->updatePreferences($userID, $preferences);
            echo json_encode(['success' => true]);
        } elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['userID'])) {
            $userID = $_GET['userID'];
            $preferences = $this->preferenceModel->getPreferences($userID);
            header('Content-Type: application/json');
            echo json_encode($preferences);
        } else {
            include '../Views/preference_view.php';
        }
    }
}

$controller = new PreferenceController();
$controller->handleRequest();
?>
