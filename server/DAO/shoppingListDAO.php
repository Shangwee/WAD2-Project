<?php
    require_once "../db/database.php";

    class shoppingListDAO{
        public function insertShoppingListItem($item, $quantity, $status, $shoppingID){
            $connMgr = new Database();
            $conn = $connMgr->getConnection();

            $sql = "INSERT INTO shoppinglistitem (item, quantity, checkStatus, shoppingID) VALUES (:item, :quantity, :status, :shoppingID)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':item', $item, PDO::PARAM_STR);
            $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
            $stmt->bindParam(':checkStatus', $status, PDO::PARAM_STR);
            $stmt->bindParam(':shoppingID', $shoppingID, PDO::PARAM_STR);

            $isAddOK = $stmt->execute();

            $stmt = null;
            $conn = null;
    
            return $isAddOK;
        }
    }
?>