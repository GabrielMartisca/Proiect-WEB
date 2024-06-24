<?php

include '../Models/preference_model.php';
include '../Models/userModel.php';

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
            $action = $_POST['action'];
            switch ($action) {
                case 'updateAllergens':
                    $allergens = isset($_POST['allergens']) ? $_POST['allergens'] : [];
                    $this->preferenceModel->updateAllergens($userID, $allergens);
                    break;
                case 'updateRegimes':
                    $regimes = isset($_POST['regimes']) ? $_POST['regimes'] : [];
                    $this->preferenceModel->updateRegimes($userID, $regimes);
                    break;
                case 'updateFavoriteFood':
                    $favoriteFood = $_POST['favoriteFood'];
                    $this->preferenceModel->updateFavoriteFood($userID, $favoriteFood);
                    break;
            }
            header('Location: preference_controller.php');
            exit();
        } else {
            $allergens = $this->preferenceModel->getAllergens($userID);
            $regimes = $this->preferenceModel->getRegimes($userID);
            $favoriteFood = $this->preferenceModel->getFavoriteFood($userID);
            include '../Views/preference_view.php';
        }
    }
}

$controller = new PreferenceController();
$controller->handleRequest();
?>