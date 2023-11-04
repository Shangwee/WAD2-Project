<?php
require_once "../../server/db/ConnectionManager.php";

Class SearchHistoryDAO{

    public function getSearchHistoryByUid($uid){
        $connmgr = new ConnectionManager();
        $pdo = $connmgr->getConnection();
        $sql='select * from SearchHistory where userid=:uid';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':uid', $uid, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $results = [];
        while($row=$stmt->fetch()){
            $results[] = new SearchHistory($row['userid'],$row['search'],$row['cuisine'],$row['meal'],$row['diet'],$row['timeCreated']);
        }
        $stmt=null;
        $pdo=null;
        return $results;
    
    }

    public function updateSearchHistory($uid,$search,$cuisine,$meal,$diet){
        $connmgr = new ConnectionManager();
        $pdo = $connmgr->getConnection();
        $sql='insert into SearchHistory(userid,search,cuisine,meal,diet,timeCreated) values (:uid,:search,:cuisine,:meal,:diet,CURRENT_TIMESTAMP)';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':uid', $uid, PDO::PARAM_INT);
        $stmt->bindParam(':search', $search, PDO::PARAM_STR);
        $stmt->bindParam(':cuisine', $cuisine, PDO::PARAM_STR);
        $stmt->bindParam(':meal', $meal, PDO::PARAM_STR);
        $stmt->bindParam(':diet', $diet, PDO::PARAM_STR);
        $status=$stmt->execute();
        
        $stmt=null;
        $pdo=null;
        return $status;
    }
}