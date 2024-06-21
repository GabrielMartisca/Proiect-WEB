<?php

include '../Models/shoppinglist_model.php';

class ShoppingListController {
    private $shoppingListModel;

    public function __construct() {
        $this->shoppingListModel = new ShoppingListModel();
    }

    public function handleRequest() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            if (isset($data['action'])) {
                switch ($data['action']) {
                    case 'add':
                        $userID = $data['userID'];
                        $listName = $data['listName'];
                        $finished = $data['finished'];
                        $items = $data['items'];
                        $listID = $this->shoppingListModel->addShoppingList($userID, $listName, $finished);
                        if ($listID) {
                            foreach ($items as $item) {
                                $this->shoppingListModel->insertListItem($listID, $item['name'], $item['count'], $item['checked']);
                            }
                        }
                        break;
                    case 'delete':
                        $userID = $data['userID'];
                        $this->shoppingListModel->deleteShoppingListsByUser($userID);
                        break;
                    case 'deleteSingle':
                        $listID = $data['listID'];
                        $result = $this->shoppingListModel->deleteShoppingList($listID);
                        echo json_encode(['success' => $result]);
                        break;
                }
            }
        } else if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['action'])) {
            switch ($_GET['action']) {
                case 'history':
                    $userID = isset($_GET['userID']) ? $_GET['userID'] : null;
                    if ($userID) {
                        $lists = $this->shoppingListModel->getShoppingListsByUser($userID);
                        header('Content-Type: application/json');
                        echo json_encode($lists);
                    }
                    break;
                case 'getItems':
                    $listID = $_GET['listID'];
                    $items = $this->shoppingListModel->getListItems($listID);
                    header('Content-Type: application/json');
                    echo json_encode($items);
                    break;
            }
        } else {
            $lists = $this->shoppingListModel->getAllShoppingLists();
            include '../Views/shoppinglist_view.php';
        }
    }
}

$controller = new ShoppingListController();
$controller->handleRequest();
