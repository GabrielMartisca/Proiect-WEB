<?php

include '../Models/preference_model.php';
include '../Models/userModel.php'; // Ensure this includes the UserModel

class PreferenceController {
    private $preferenceModel;

    public function __construct() {
        $userModel = new UserModel();
        $this->preferenceModel = new PreferenceModel($userModel->getConnection());
    }

    public function handleRequest() {
        session_start();
        if (!isset($_SESSION['userID'])) {
            header('Location: login_controller.php');
            exit();
        }

        $userID = $_SESSION['userID'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $preferences = [
                'allergens' => $_POST['allergens'],
                'regime' => $_POST['regime'],
                'favoriteFoods' => $_POST['favoriteFoods']
            ];
            $this->preferenceModel->updatePreferences($userID, $preferences);
            header('Location: preference_controller.php');
            exit();
        } else {
            $preferences = $this->preferenceModel->getPreferences($userID);
            include '../Views/preference_view.php';
        }
    }
}

$controller = new PreferenceController();
$controller->handleRequest();
?>