<?php
class ConnectionManager
{
    public function getConnection() {
        $servername = 'localhost';
        $dbname = 'wad2project';
        $username = 'root';
        $password = ''; // change this depending on mac or windows
        $port = 3306;
        $url  = "mysql:host=$servername;dbname=$dbname;port=$port";
    
        return new PDO($url, $username, $password);
      }
    
}
class accessdom
{
    public function getBySerial($uid, $serial)
    {
        $conn = new ConnectionManager;
        $pdo = $conn->getConnection();
        $sql = "SELECT * FROM activeinv WHERE serial = :serial and uid = :uid;";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":uid", $uid, PDO::PARAM_INT);
        $stmt->bindParam(":serial", $serial, PDO::PARAM_INT);
        $success = $stmt->execute();
        if ($success) {
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = [];
            while ($row = $stmt->fetch()) {
                $result[] = $row;
            }
            ;
            $pdo = null;
            $stmt = null;
            $sql = null;
            $conn = null;
            return $result[0];
        } else {
            $errors = $stmt->errorInfo();
            $pdo = null;
            $stmt = null;
            $sql = null;
            $conn = null;
            return $errors;
        }
    }
    public function consumed($itemobj){
        $conn = new ConnectionManager;
        $pdo = $conn->getConnection();
        $sql = "insert into historicalinv values (:uid, :serial, :item, :qty, :expired, :category)";
        $stmt = $pdo->prepare($sql);
        $uid = $itemobj["uid"];
        $serial = $itemobj["serial"];
        $item = $itemobj["item"];
        $qty = $itemobj["qty"];
        $expired = 0;
        $category = $itemobj["category"];
        $stmt->bindParam(":uid", $uid, PDO::PARAM_INT);
        $stmt->bindParam(":serial", $serial, PDO::PARAM_STR);
        $stmt->bindParam(":item", $item, PDO::PARAM_STR);
        $stmt->bindParam(":qty", $qty, PDO::PARAM_STR);
        $stmt->bindParam(":expired", $expired, PDO::PARAM_INT);
        $stmt->bindParam(":category", $category, PDO::PARAM_STR);
        $success = $stmt->execute();
        if ($success) {
            $pdo = null;
            $stmt = null;
            $sql = null;
            $conn = null;
            return $success;
        } else {
            $errors = $stmt->errorInfo();
            $pdo = null;
            $stmt = null;
            $sql = null;
            $conn = null;
            return $errors;
        }
    
    }
    public function expired($itemobj){
        $conn = new ConnectionManager;
        $pdo = $conn->getConnection();
        $sql = "insert into historicalinv values (:uid, :serial, :item, :qty, :expired, :category)";
        $stmt = $pdo->prepare($sql);
        $uid = $itemobj["uid"];
        $serial = $itemobj["serial"];
        $item = $itemobj["item"];
        $qty = $itemobj["qty"];
        $expired = 1;
        $category = $itemobj["category"];
        $stmt->bindParam(":uid", $uid, PDO::PARAM_INT);
        $stmt->bindParam(":serial", $serial, PDO::PARAM_STR);
        $stmt->bindParam(":item", $item, PDO::PARAM_STR);
        $stmt->bindParam(":qty", $qty, PDO::PARAM_STR);
        $stmt->bindParam(":expired", $expired, PDO::PARAM_INT);
        $stmt->bindParam(":category", $category, PDO::PARAM_STR);
        $success = $stmt->execute();
        if ($success) {
            $pdo = null;
            $stmt = null;
            $sql = null;
            $conn = null;
            return $success;
        } else {
            $errors = $stmt->errorInfo();
            $pdo = null;
            $stmt = null;
            $sql = null;
            $conn = null;
            return $errors;
        }
    
    }
    public function remove($uid, $serial)
    {
        $toMove = $this->getBySerial($uid, $serial);
        $conn = new ConnectionManager;
        $pdo = $conn->getConnection();
        $sql = "DELETE FROM activeinv WHERE serial = :serial and uid = :uid;";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":uid", $uid, PDO::PARAM_INT);
        $stmt->bindParam(":serial", $serial, PDO::PARAM_INT);
        $success = $stmt->execute();
        if ($success){ 
            $output = $this->consumed($toMove);
            return $output;
        }
    }
    public function expire($uid, $serial)
    {
        $toMove = $this->getBySerial($uid, $serial)[0];
        $conn = new ConnectionManager;
        $pdo = $conn->getConnection();
        $sql = "DELETE FROM activeinv WHERE serial = :serial and uid = :uid;";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":uid", $uid, PDO::PARAM_INT);
        $stmt->bindParam(":serial", $serial, PDO::PARAM_INT);
        $success = $stmt->execute();
        if ($success){ 
            $output = $this->expired($toMove);
            return $output;
        }
    }
    public function getAll($uid)
    {
        $conn = new ConnectionManager;
        $pdo = $conn->getConnection();
        $sql = "select serial, item, qty, expiry, category from activeinv where uid = :uid";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":uid", $uid, PDO::PARAM_STR);
        $success = $stmt->execute();
        if ($success) {
            $stmt->setFetchMode(PDO::FETCH_NUM);
            $result = [];
            while ($row = $stmt->fetch()) {
                $result[] = $row;
            }
            ;
            $pdo = null;
            $stmt = null;
            $sql = null;
            $conn = null;
            return $result;
        } else {
            $errors = $stmt->errorInfo();
            $pdo = null;
            $stmt = null;
            $sql = null;
            $conn = null;
            return $errors;
        }
    }
    public function getLastSerial($uid)
    {
        $serials = [];
        $conn = new ConnectionManager;
        $pdo = $conn->getConnection();
        $sql = "select serial from activeinv where uid = :uid";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":uid", $uid, PDO::PARAM_INT);
        $success = $stmt->execute();
        if ($success) {
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            while ($row = $stmt->fetch()) {
                $serials[] = $row["serial"];
            }
            ;
            $pdo = null;
            $stmt = null;
            $sql = null;
        } else {
            $errors = $stmt->errorInfo();
            $stmt = null;
            return $errors;
        }
        $pdo = $conn->getConnection();
        $sql = "select serial from historicalinv where uid = :uid";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":uid", $uid, PDO::PARAM_INT);
        $success = $stmt->execute();
        if ($success) {
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            while ($row = $stmt->fetch()) {
                $serials[] = $row["serial"];
            }
            ;
            $pdo = null;
            $stmt = null;
            $sql = null;
            $conn = null;
        } else {
            $errors = $stmt->errorInfo();
            $stmt = null;
            return $errors;
        }
        if (count($serials) === 0) {
            return 0;
        } else {
            sort($serials);
            return end($serials);
        }

    }
    public function insert($uid, $item, $qty, $expiry, $category)
    {
        $conn = new ConnectionManager;
        $serial = $this->getLastSerial($uid);

        $serial = $serial + 1;
        $pdo = $conn->getConnection();
        $sql = "insert into activeinv values (:uid, :serial, :item, :qty, :expiry, :category)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":uid", $uid, PDO::PARAM_INT);
        $stmt->bindParam(":serial", $serial, PDO::PARAM_STR);
        $stmt->bindParam(":item", $item, PDO::PARAM_STR);
        $stmt->bindParam(":qty", $qty, PDO::PARAM_STR);
        $stmt->bindParam(":expiry", $expiry, PDO::PARAM_STR);
        $stmt->bindParam(":category", $category, PDO::PARAM_STR);
        $success = $stmt->execute();
        if ($success) {
            $pdo = null;
            $stmt = null;
            $sql = null;
            $conn = null;
            return $success;
        } else {
            $errors = $stmt->errorInfo();
            $pdo = null;
            $stmt = null;
            $sql = null;
            $conn = null;
            return $errors;
        }
    }
    // public function update($uid, $serial, $item, $currentqty, $initialqty, $expiry, $category){
//     $conn = new ConnectionManager;
//     $pdo = $conn->getConnection();
//     $sql = "update activeinv set item = :item, qty = :qty, sexpiry = :expiry, category = :category where uid = :uid and serial = :serial)";
//     $stmt = $pdo->prepare($sql);
//     $stmt->bindParam(":uid", $uid, PDO::PARAM_INT);
//     $stmt->bindParam(":serial", $serial, PDO::PARAM_STR);
//     $stmt->bindParam(":item", $item, PDO::PARAM_STR);
//     $stmt->bindParam(":currentqty", $currentqty, PDO::PARAM_INT);
//     $stmt->bindParam(":initialqty", $intialqty, PDO::PARAM_INT);
//     $stmt->bindParam(":expiry", $expiry, PDO::PARAM_STR);
//     $stmt->bindParam(":category", $category, PDO::PARAM_STR);
//     $success = $stmt->execute();
//     if ($success){
//         return $success;
//     }
//     else{
//     $errors = $stmt->errorInfo();
//     $stmt = null;
//     return $errors;
// }
// }
}