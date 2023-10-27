<?php
 require_once __DIR__."\..\db\ConnectionManager.php";

 class PostShoppingListDAO {
    public function insertPostShoppingListItem($item, $category, $quantity, $userID){
        $connMgr = new ConnectionManager();
        $conn = $connMgr->getConnection();

        $sql = "INSERT INTO postShoppinglistitem (item, category, quantity, userid) VALUES (:item, :category, :quantity, :userID)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':item', $item, PDO::PARAM_STR);
        $stmt->bindParam(':category', $category, PDO::PARAM_STR);
        $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
        $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);

        $isAddOK = $stmt->execute();

        $stmt = null;
        $conn = null;
    
        return $isAddOK;
    }


    public function getPostShoppingListItemsbyUser($userid){
        $connMgr = new ConnectionManager();
        $conn = $connMgr->getConnection();
    
        $sql = "SELECT * FROM postShoppinglistitem WHERE userid = :userid";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':userid', $userid, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $result = null;
    
        while($row = $stmt->fetch()){
            $result[] = new PostShoppingListItem($row['id'], $row['item'], $row["category"], $row['quantity'], $row['userid']);
        }
    
        $stmt = null;
        $conn = null;
    
        return $result;
    }
 }
?>