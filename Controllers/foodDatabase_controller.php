<?php

include '../Models/foodDatabase_model.php';


class ShoppingListController {
    private $model;

    public function __construct() {
        $this->model = new ShoppingListModel();
    }

    public function handleRequest() {
        $action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';
        switch ($action) {
            case 'add':
                $this->addShoppingList();
                break;
            case 'history':
                $this->getShoppingListHistory();
                break;
            case 'getItems':
                $this->getItems();
                break;
            case 'deleteSingle':
                $this->deleteShoppingList();
                break;
            case 'getLists':
                $this->getLists();
                break;
            case 'addItem':
                $this->addItem();
                break;
            default:
                $this->showDefault();
                break;
        }
    }

    private function addShoppingList() {
        $data = json_decode(file_get_contents('php://input'), true);
        $userID = $data['userID'];
        $listName = $data['listName'];
        $items = $data['items'];
        $finished = $data['finished'];

        $listID = $this->model->addShoppingList($userID, $listName, $finished);
        foreach ($items as $item) {
            $this->model->addItemToList($listID, $item['name'], $item['count'], $item['checked']);
        }
        echo json_encode(['success' => true]);
    }

    private function getShoppingListHistory() {
        $userID = $_GET['userID'];
        $history = $this->model->getShoppingListHistory($userID);
        echo json_encode($history);
    }

    private function getItems() {
        $listID = $_GET['listID'];
        $items = $this->model->getItems($listID);
        echo json_encode($items);
    }

    private function deleteShoppingList() {
        $data = json_decode(file_get_contents('php://input'), true);
        $listID = $data['listID'];
        $this->model->deleteShoppingList($listID);
        echo json_encode(['success' => true]);
    }

    private function getLists() {
        $userID = $_GET['userID'];
        $lists = $this->model->getLists($userID);
        error_log("Lists before JSON encode: " . print_r($lists, true));
        echo json_encode($lists);
    }
    

    private function addItem() {
        $data = json_decode(file_get_contents('php://input'), true);
        $userID = $data['userID'];
        $item = $data['item'];

        if (isset($data['listID'])) {
            $listID = $data['listID'];
            $this->model->addItemToList($listID, $item['name'], $item['count'], $item['checked']);
        } else if (isset($data['listName'])) {
            $listName = $data['listName'];
            $listID = $this->model->addShoppingList($userID, $listName, 0);
            $this->model->addItemToList($listID, $item['name'], $item['count'], $item['checked']);
        }
        echo json_encode(['success' => true]);
    }

    private function showDefault() {
    }
}

$controller = new ShoppingListController();
$controller->handleRequest();

include '../Views/foodDatabase_view.php';