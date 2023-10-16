<?php
    require_once "../db/ConnectionManager.php";

    class shoppingListDAO{
        public function insertShoppingListItem($item, $quantity, $status, $shoppingID, $userID){
            $connMgr = new ConnectionManager();
            $conn = $connMgr->getConnection();

            $sql = "INSERT INTO shoppinglistitem (item, quantity, checkStatus, shoppingID) VALUES (:item, :quantity, :status, :shoppingID, :userID)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':item', $item, PDO::PARAM_STR);
            $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
            $stmt->bindParam(':checkStatus', $status, PDO::PARAM_STR);
            $stmt->bindParam(':shoppingID', $shoppingID, PDO::PARAM_STR);
            $stmt->bindParam(':userID', $userID, PDO::PARAM_STR);

            $isAddOK = $stmt->execute();

            $stmt = null;
            $conn = null;
    
            return $isAddOK;
        }

        public function selectAllShoppingListItemsbyUser($userID){
            $connMgr = new ConnectionManager();
            $conn = $connMgr->getConnection();
    
            $sql = "SELECT * FROM shoppinglistitem WHERE userID = :userID";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':userID', $userID, PDO::PARAM_STR);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
    
            $result = array();
    
            while($row = $stmt->fetch()){
                $result[] = new ShoppingListItem($row['id'], $row['item'], $row['quantity'], $row['checkStatus'], $row['shoppingID'], $row['userID']);
            }
    
            $stmt = null;
            $conn = null;
    
            return $result;
        }
    }
?>