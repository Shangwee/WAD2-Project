<?php
 require_once __DIR__."\..\db\ConnectionManager.php";

 class UserStatsDAO {
    public function getNumofInventoryByUser($userid){
        $connMgr = new ConnectionManager();
        $conn = $connMgr->getConnection();

        $sql = "select count(*) from activeinv where userid = :userid";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':userid', $userid, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

        $result = $stmt->fetch();
        $stmt = null;
        $conn = null;

        return $result;
    }

    public function getLowQuantityByUser($userid){
        $connMgr = new ConnectionManager();
        $conn = $connMgr->getConnection();

        $sql = 'SELECT count(*) as numOfLow FROM activeinv WHERE userid = :userid AND qty <= 1';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':userid', $userid, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

        $result = $stmt->fetch();
        $stmt = null;
        $conn = null;

        return $result;
    }

    public function getFoodAboutToExpireByUser($userid){
        $connMgr = new ConnectionManager();
        $conn = $connMgr->getConnection();

        $sql = 'SELECT count(*) as numOfExp FROM activeinv WHERE userid = :userid AND expiry <= DATE_ADD(CURDATE(), INTERVAL 3 DAY)';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':userid', $userid, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

        $result = $stmt->fetch();
        $stmt = null;
        $conn = null;

        return $result;
    }
 }
 ?>