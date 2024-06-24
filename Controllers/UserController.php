<?php

include '../Models/UserModel.php';

session_start(); 

class UserController {
    private $model;

    public function __construct() {
        $this->model = new UserModel();
    }

    public function handleRequest() {
        if ($_SESSION['role'] !== 'admin') {
            header('Location: ../Controllers/userProfile_controller.php');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            if (isset($data['action'])) {
                switch ($data['action']) {
                    case 'add':
                        $this->addUser($data);
                        break;
                    case 'edit':
                        $this->editUser($data);
                        break;
                    case 'delete':
                        $this->deleteUser($data['userID']);
                        break;
                    case 'ban':
                        $this->banUser($data['userID']);
                        break;
                    case 'unban':
                        $this->unbanUser($data['userID']);
                        break;
                    case 'resetPassword':
                        $this->resetPassword($data);
                        break;
                }
            }
        } else if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['action'])) {
            switch ($_GET['action']) {
                case 'getUserById':
                    $this->getUserById($_GET['userID']);
                    break;
                case 'getUsers':
                    $this->getUsers();
                    break;
                case 'checkEmail':
                    $this->checkEmail($_GET['email']);
                    break;
            }
        } else {
            $this->viewUsers();
        }
    }

    private function viewUsers() {
        $users = $this->model->getAllUsers();
        include '../Views/UserManagementView.php';
    }

    private function getUserById($userID) {
        $user = $this->model->getUserById($userID);
        header('Content-Type: application/json');
        echo json_encode($user);
    }

    private function addUser($data) {
        $username = $data['username'];
        $email = $data['email'];
        $password = $data['password'];
        $role = $data['role'];

        $this->model->addUser($username, $email, $password, $role);
        header('Content-Type: application/json');
        echo json_encode(['success' => true]);
    }

    private function editUser($data) {
        $userID = $data['userID'];
        $username = $data['username'];
        $email = $data['email'];
        $role = $data['role'];

        $this->model->updateUser($userID, $username, $email, $role);
        header('Content-Type: application/json');
        echo json_encode(['success' => true]);
    }

    private function deleteUser($userID) {
        error_log("Attempting to delete user with ID: $userID"); 
        $result = $this->model->deleteUser($userID);
        header('Content-Type: application/json');
        echo json_encode(['success' => $result]);
    }


    private function banUser($userID) {
        $this->model->updateUserLock($userID, 1);
        echo json_encode(['success' => true]);
    }

    private function unbanUser($userID) {
        $this->model->updateUserLock($userID, 0);
        echo json_encode(['success' => true]);
    }

    private function resetPassword($data) {
        $userID = $data['userID'];
        $password = $data['password'];

        $this->model->resetPassword($userID, $password);
        echo json_encode(['success' => true]);
    }

    private function getUsers() {
        $users = $this->model->getAllUsers();
        header('Content-Type: application/json');
        echo json_encode($users);
    }

    private function checkEmail($email) {
        $exists = $this->model->emailExists($email);
        header('Content-Type: application/json');
        echo json_encode(['exists' => $exists]);
    }
}

$controller = new UserController();
$controller->handleRequest();
