<?php
if(!isset($_COOKIE["loggedin"])&&!isset($_COOKIE["loggedindont"])){
	header("Location: ../Controllers/login_controller.php");
}
include 'listmodel.php';

class ShoppingListModel extends ListModel {
    public function addShoppingList($userID, $listName, $finished) {
        $stmt = $this->mysql->prepare("INSERT INTO lists (userID, listName, finished) VALUES (?, ?, ?)");
        $stmt->bind_param("isi", $userID, $listName, $finished);
        $stmt->execute();
        $listID = $stmt->insert_id;
        $stmt->close();
        return $listID;
    }

    public function addItemToList($listID, $itemName, $count, $checked) {
        $stmt = $this->mysql->prepare("SELECT itemID FROM items WHERE name = ?");
        $stmt->bind_param("s", $itemName);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $itemID = $row['itemID'];
        } else {
            $stmt = $this->mysql->prepare("INSERT INTO items (name) VALUES (?)");
            $stmt->bind_param("s", $itemName);
            $stmt->execute();
            $itemID = $stmt->insert_id;
        }

        $stmt->close();

        $stmt = $this->mysql->prepare("INSERT INTO listitems (listID, itemID, count, checked) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiii", $listID, $itemID, $count, $checked);
        $stmt->execute();
        $stmt->close();
    }

    public function getShoppingListHistory($userID) {
        $stmt = $this->mysql->prepare("SELECT * FROM lists WHERE userID = ?");
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        $result = $stmt->get_result();
        $history = [];
        while ($row = $result->fetch_assoc()) {
            $history[] = $row;
        }
        $stmt->close();
        return $history;
    }

    public function getItems($listID) {
        $stmt = $this->mysql->prepare("SELECT items.name, listitems.count, listitems.checked 
                                    FROM listitems 
                                    JOIN items ON listitems.itemID = items.itemID 
                                    WHERE listitems.listID = ?");
        $stmt->bind_param("i", $listID);
        $stmt->execute();
        $result = $stmt->get_result();
        $items = [];
        while ($row = $result->fetch_assoc()) {
            $items[] = $row;
        }
        $stmt->close();
        return $items;
    }

    public function deleteShoppingList($listID) {
        $stmt = $this->mysql->prepare("DELETE FROM listitems WHERE listID = ?");
        $stmt->bind_param("i", $listID);
        $stmt->execute();
        $stmt->close();

        $stmt = $this->mysql->prepare("DELETE FROM lists WHERE listID = ?");
        $stmt->bind_param("i", $listID);
        $stmt->execute();
        $stmt->close();
    }

    public function getLists($userID) {
        $stmt = $this->mysql->prepare("SELECT * FROM lists WHERE userID = ?");
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        $result = $stmt->get_result();
        $lists = [];
        while ($row = $result->fetch_assoc()) {
            $lists[] = $row;
        }
        $stmt->close();
        error_log("Fetched lists: " . print_r($lists, true));
        return $lists;
    }
    
}