<?php
require_once "/WAD2-Project/model/ConnectionManager.php";

Class AccountDAO{

    public function getAllAcc(){
        $connmgr = new ConnectionManager();
        $pdo = $connmgr->getConnection();
        $sql='select * from account';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $results = [];
        while($row=$stmt->fetch()){
            $results[] = new Account($row['userid'],$row['username'],$row['hashedpw']);
        }
        $stmt=null;
        $pdo=null;
        return $results;
    }

    public function getAccByUsername($un){
        $connmgr = new ConnectionManager();
        $pdo = $connmgr->getConnection();
        $sql='select * from account where username=:un';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':un', $un, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $results = null;
        while($row=$stmt->fetch()){
            $results = new Account($row['userid'],$row['username'],$row['hashedpw']);
        }
        $stmt=null;
        $pdo=null;
        return $results;
    }

    public function updatePassword($un,$hashed){
        $connmgr = new ConnectionManager();
        $pdo = $connmgr->getConnection();
        $sql='update account set hashed=:hashed where username=:un';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':hashed', $hashed, PDO::PARAM_STR);
        $stmt->bindParam(':un', $un, PDO::PARAM_STR);
        $status=$stmt->execute();
        
        
        $stmt=null;
        $pdo=null;
        return $status;
    }

    public function createAcc($un,$hashed){
        $connmgr = new ConnectionManager();
        $pdo = $connmgr->getConnection();
        $sql='insert into account(username,hashedpw) values (:un,:hashed)';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':hashed', $hashed, PDO::PARAM_STR);
        $stmt->bindParam(':un', $un, PDO::PARAM_STR);
        // $stmt->bindParam(':uid', $uid, PDO::PARAM_INT);
        $status=$stmt->execute();
        
        
        $stmt=null;
        $pdo=null;
        return $status;
    }
}
?>