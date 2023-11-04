<?php
require_once ("../../DAO/invclasses.php");
$inventoryList = [];

if(isset($_GET['userId'])){
    $userId = $_GET['userId'];
    $newtabledisplaydao = new tabledisplaydao;
    $result = $newtabledisplaydao->getAll($userId);
    for($i=0; $i<count($result); $i++){
        $data = [];
        $item = $result[$i][1];
        $quantity = $result[$i][2];
        $data['item'] = $item;
        $data['quantity'] = $quantity;
        array_push($inventoryList, $data);
    }

    $inventoryList = json_encode($inventoryList);
    echo $inventoryList;
}
?>