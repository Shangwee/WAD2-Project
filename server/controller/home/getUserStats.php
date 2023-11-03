<?php
    require_once("../../DAO/UserStatsDAO.php");
    $UserStatsDAO = new UserStatsDAO;
    $result = [];

    if(isset($_GET['userId'])){
        $userId = $_GET['userId'];
        // get food that are about to expire
        $totelExpiring = $UserStatsDAO->getFoodAboutToExpireByUser($userId);
        if ($totelExpiring != null){
            $result['totelExpiring'] = $totelExpiring['numOfExp'];
        } else {
            $result['totelExpiring'] = 0;
        }

        // get food that are low in quantity
        $totalLowQuantity = $UserStatsDAO->getLowQuantityByUser($userId);
        if ($totalLowQuantity != null){
            $result['LowQuantity'] = $totalLowQuantity['numOfLow'];
        } else {
            $result['LowQuantity'] = 0;
        }
        // get total number of inventory by user
        $totalInventory = $UserStatsDAO->getNumofInventoryByUser($userId);
        if($totalInventory != null){
            $result['totalInventory'] = $totalInventory["count(*)"];
        }
        else {
            $result['totalInventory'] = 0;
        }
        
        $resultJSON = json_encode($result);
        echo $resultJSON;
    }
?>