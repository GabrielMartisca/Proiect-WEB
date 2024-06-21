<?php
include 'listmodel.php';

class ShoppingListModel extends ListModel {

    public function addShoppingList($userID, $listName, $finished) {
        $query = "INSERT INTO Lists (userID, listName, finished, created_at, updated_at) VALUES (?, ?, ?, NOW(), NOW())";
        $stmt = $this->mysql->prepare($query);
        $stmt->bind_param("isi", $userID, $listName, $finished);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            return $this->mysql->insert_id;
        } else {
            return false;
        }
    }

    public function deleteShoppingListsByUser($userID) {
        $query = "DELETE FROM Lists WHERE userID = ?";
        $stmt = $this->mysql->prepare($query);
        $stmt->bind_param("i", $userID);
        $stmt->execute();

        return $stmt->affected_rows > 0;
    }

    public function deleteListItems($listID) {
        $query = "DELETE FROM ListItems WHERE listID = ?";
        $stmt = $this->mysql->prepare($query);
        $stmt->bind_param("i", $listID);
        $stmt->execute();

        return $stmt->affected_rows > 0;
    }

    public function deleteShoppingList($listID) {
        $this->deleteListItems($listID); // First, delete all items associated with the list

        $query = "DELETE FROM Lists WHERE listID = ?";
        $stmt = $this->mysql->prepare($query);
        $stmt->bind_param("i", $listID);
        $stmt->execute();

        return $stmt->affected_rows > 0;
    }

    public function getAllShoppingLists() {
        $query = "SELECT * FROM Lists";
        $result = $this->mysql->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function insertListItem($listID, $itemName, $count, $checked) {
        // Check if the item already exists in the Items table
        $query = "SELECT itemID FROM Items WHERE name = ?";
        $stmt = $this->mysql->prepare($query);
        $stmt->bind_param("s", $itemName);
        $stmt->execute();
        $result = $stmt->get_result();
        $item = $result->fetch_assoc();

        if ($item) {
            $itemID = $item['itemID'];
        } else {
            $query = "INSERT INTO Items (name) VALUES (?)";
            $stmt = $this->mysql->prepare($query);
            $stmt->bind_param("s", $itemName);
            $stmt->execute();
            $itemID = $stmt->insert_id;
        }

        // Insert into ListItems table
        $query = "INSERT INTO ListItems (listID, itemID, count, checked) VALUES (?, ?, ?, ?)";
        $stmt = $this->mysql->prepare($query);
        $stmt->bind_param("iiii", $listID, $itemID, $count, $checked);
        $stmt->execute();

        return $stmt->affected_rows > 0;
    }

    public function getListItems($listID) {
        $query = "SELECT Items.name, ListItems.count, ListItems.checked 
                  FROM ListItems 
                  JOIN Items ON ListItems.itemID = Items.itemID 
                  WHERE ListItems.listID = ?";
        $stmt = $this->mysql->prepare($query);
        $stmt->bind_param("i", $listID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getShoppingListsByUser($userID) {
        $query = "SELECT * FROM Lists WHERE userID = ?";
        $stmt = $this->mysql->prepare($query);
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>
