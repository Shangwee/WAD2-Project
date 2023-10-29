<?php
require_once "../../server/db/ConnectionManager.php";

Class SearchHistoryDAO{

    public function getAllSearchHistory(){
        $connmgr = new ConnectionManager();
        $pdo = $connmgr->getConnection();
        $sql='select * from SearchHistory';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $results = [];
        while($row=$stmt->fetch()){
            $results[] = new Account($row['userid'],$row['search'],$row['cuisine'],$row['timeCreated']);
        }
        $stmt=null;
        $pdo=null;
        return $results;
    
    }

    public function updateSearchHistory($uid,$search,$cuisine){
        $connmgr = new ConnectionManager();
        $pdo = $connmgr->getConnection();
        $sql='insert into SearchHistory(uid,search,cuisine,timeCreated) values (:uid,:search,:cuisine,CURRENT_TIMESTAMP)';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':uid', $uid, PDO::PARAM_INT);
        $stmt->bindParam(':search', $search, PDO::PARAM_STR);
        $stmt->bindParam(':cuisine', $cuisine, PDO::PARAM_STR);
        $status=$stmt->execute();
        
        
        $stmt=null;
        $pdo=null;
        return $status;
    }
}