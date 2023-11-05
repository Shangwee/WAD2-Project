<?php
require_once ("../DAO/invclasses.php");
session_start();
$invDAO = new tabledisplaydao;

if(isset($_GET) && !empty($_SESSION)){
    $userId = $_SESSION["login"];
    // get all food from inventoy by user
    $inventory = $invDAO->getExpiring($userId);
    $inventoryResult = [];
    for ($i = 0; $i < count($inventory); $i++){
        $name = $inventory[$i][1];
        $inventoryResult[] = array("item" => $name);
    }

    $myJSON = json_encode($inventoryResult);
    echo $myJSON;
}   
?>