<?php
require_once "../../server/db/ConnectionManager.php";

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
            $results[] = new Account($row['userid'],$row['username'],$row['hashedpw'],$row['email']);
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
            $results = new Account($row['userid'],$row['username'],$row['hashedpw'],$row['email']);
        }
        $stmt=null;
        $pdo=null;
        return $results;
    }

    public function getAccByUid($uid){
        $connmgr = new ConnectionManager();
        $pdo = $connmgr->getConnection();
        $sql='select * from account where userid=:uid';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':uid', $uid, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $results = null;
        while($row=$stmt->fetch()){
            $results = new Account($row['userid'],$row['username'],$row['hashedpw'],$row['email']);
        }
        $stmt=null;
        $pdo=null;
        return $results;
    }

    public function getAccByEmail($email){
        $connmgr = new ConnectionManager();
        $pdo = $connmgr->getConnection();
        $sql='select * from account where email=:email';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $results = null;
        while($row=$stmt->fetch()){
            $results = new Account($row['userid'],$row['username'],$row['hashedpw'],$row['email']);
        }
        $stmt=null;
        $pdo=null;
        return $results;
    }

    public function updateEmail($uid,$email){
        $connmgr = new ConnectionManager();
        $pdo = $connmgr->getConnection();
        $sql='update account set email=:email where userid=:uid';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':uid', $uid, PDO::PARAM_INT);
        $status=$stmt->execute();
        
        
        $stmt=null;
        $pdo=null;
        return $status;
    }

    public function updateUsername($uid,$un){
        $connmgr = new ConnectionManager();
        $pdo = $connmgr->getConnection();
        $sql='update account set username=:un where userid=:uid';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $un, PDO::PARAM_STR);
        $stmt->bindParam(':uid', $uid, PDO::PARAM_INT);
        $status=$stmt->execute();
        
        
        $stmt=null;
        $pdo=null;
        return $status;
    }

    public function updatePassword($un,$hashed){
        $connmgr = new ConnectionManager();
        $pdo = $connmgr->getConnection();
        $sql='update account set hashedpw=:hashed where username=:un';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':hashed', $hashed, PDO::PARAM_STR);
        $stmt->bindParam(':un', $un, PDO::PARAM_STR);
        $status=$stmt->execute();
        
        
        $stmt=null;
        $pdo=null;
        return $status;
    }

    public function createAcc($un,$hashed,$email){
        $connmgr = new ConnectionManager();
        $pdo = $connmgr->getConnection();
        $sql='insert into account(username,hashedpw,email) values (:un,:hashed,:email)';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':hashed', $hashed, PDO::PARAM_STR);
        $stmt->bindParam(':un', $un, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $status=$stmt->execute();
        
        
        $stmt=null;
        $pdo=null;
        return $status;
    }
}
?>