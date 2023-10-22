<?php
    require_once __DIR__."\..\db\ConnectionManager.php";
    
    class shoppingListDAO{
        public function insertShoppingListItem($item, $quantity, $status, $userID){
            $connMgr = new ConnectionManager();
            $conn = $connMgr->getConnection();

            $sql = "INSERT INTO shoppinglistitem (item, quantity, checkStatus, userid) VALUES (:item, :quantity, :checkStatus, :userID)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':item', $item, PDO::PARAM_STR);
            $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
            $stmt->bindParam(':checkStatus', $status, PDO::PARAM_BOOL);
            $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);

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
                $result[] = new ShoppingListItem($row['id'], $row['item'], $row['quantity'], $row['checkStatus'], $row['userid']);
            }
    
            $stmt = null;
            $conn = null;
    
            return $result;
        }

        public function deleteShoppingListItem($id){
            $connMgr = new ConnectionManager();
            $conn = $connMgr->getConnection();
    
            $sql = "DELETE FROM shoppinglistitem WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $isDeleteOK = $stmt->execute();
    
            $stmt = null;
            $conn = null;
    
            return $isDeleteOK;
        }

        public function clearShoppingList($userid){
            $connMgr = new ConnectionManager();
            $conn = $connMgr->getConnection();
    
            $sql = "DELETE FROM shoppinglistitem WHERE userid = :userid";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':userid', $userid, PDO::PARAM_INT);
            $isDeleteOK = $stmt->execute();
    
            $stmt = null;
            $conn = null;
    
            return $isDeleteOK;
        }

        public function editShoppingListItem($id, $quantity){
            $connMgr = new ConnectionManager();
            $conn = $connMgr->getConnection();
    
            $sql = "UPDATE shoppinglistitem SET quantity = :quantity WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
            $isEditOK = $stmt->execute();
    
            $stmt = null;
            $conn = null;
    
            return $isEditOK;
        }

        public function updateCheckStatus($id, $status){
            $connMgr = new ConnectionManager();
            $conn = $connMgr->getConnection();

            $sql = "UPDATE shoppinglistitem SET checkStatus = :checkStatus WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':checkStatus', $status, PDO::PARAM_BOOL);
            $isEditOK = $stmt->execute();

            $stmt = null;
            $conn = null;

            return $isEditOK;
        }

        public function getShoppingListItemsbyUserAndStatus($userid, $status){
            $connMgr = new ConnectionManager();
            $conn = $connMgr->getConnection();
    
            $sql = "SELECT * FROM shoppinglistitem WHERE userid = :userid AND checkStatus = :checkStatus";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':userid', $userid, PDO::PARAM_INT);
            $stmt->bindParam(':checkStatus', $status, PDO::PARAM_BOOL);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            $result = null;
    
            while($row = $stmt->fetch()){
                $result[] = new ShoppingListItem($row['id'], $row['item'], $row['quantity'], $row['checkStatus'], $row['userid']);
            }
    
            $stmt = null;
            $conn = null;
    
            return $result;
        }

    }
?>