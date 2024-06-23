<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include '../Models/UserProfile_model.php';

class UserProfileController {
    private $model;

    public function __construct() {
        $this->model = new UserProfileModel();
    }

    public function handleRequest() {
        if (!isset($_SESSION['username'])) {
            header('Location: login_controller.php');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['action']) && $_GET['action'] == 'uploadProfilePicture') {
            $this->uploadProfilePicture();
        } else {
            $this->viewProfile();
        }
    }

    private function viewProfile() {
        $userProfile = $this->model->getUserById($_SESSION['userID']);
        $_SESSION['profile_picture'] = $userProfile['profile_picture'];
        include '../Views/userProfile_view.php';
    }

    private function uploadProfilePicture() {
        $targetDir = "../uploads/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        $targetFile = $targetDir . basename($_FILES["profile_picture"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["profile_picture"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }


        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $targetFile)) {
                $_SESSION['profile_picture'] = $targetFile;
                $this->model->updateUserProfilePicture($_SESSION['userID'], $targetFile);
                header('Location: userProfile_controller.php');
                exit();
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
}

$controller = new UserProfileController();
$controller->handleRequest();
