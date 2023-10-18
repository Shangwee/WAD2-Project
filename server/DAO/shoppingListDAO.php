<?php
    require_once "/wamp64/www/WAD2-Project/server/db/ConnectionManager.php";
    require_once "/wamp64/www/WAD2-Project/server/model/ShoppingListItem.php";
    
    class shoppingListDAO{
        public function insertShoppingListItem($item, $quantity, $status, $shoppingID, $userID){
            $connMgr = new ConnectionManager();
            $conn = $connMgr->getConnection();

            $sql = "INSERT INTO shoppinglistitem (item, quantity, checkStatus, shoppingID, userid) VALUES (:item, :quantity, :checkStatus, :shoppingID, :userID)";
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

        public function getShoppingListItemsbyUser($userid){
            $connMgr = new ConnectionManager();
            $conn = $connMgr->getConnection();
    
            $sql = "SELECT * FROM shoppinglistitem WHERE userid = :userid";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':userid', $userid, PDO::PARAM_INT);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            $result = null;
    
            while($row = $stmt->fetch()){
                $result[] = new ShoppingListItem($row['id'], $row['item'], $row['quantity'], $row['checkStatus'], $row['shoppingID'], $row['userid']);
            }
    
            $stmt = null;
            $conn = null;
    
            return $result;
        }
    }
?>