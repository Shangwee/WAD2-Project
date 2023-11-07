<?php
require_once("../../model/ShoppingListItem.php");
require_once ("../../DAO/shoppingListDAO.php");
$status = false;
$result = [];

if(isset($_GET['userId']) && isset($_GET['ingredients'])){
    $userId = $_GET['userId'];
    $ingredients = $_GET['ingredients'];
    $shoppingListDAO = new shoppingListDAO();

    for($i=0; $i<count($ingredients); $i++){
        $item = $ingredients[$i]['name'];
        $category = "others";
        $quantity = intval($ingredients[$i]['quantity']);
        if ($quantity == 0){
            $quantity = 1;
        }
        $checkStatus = 0;
        $status = $shoppingListDAO->insertShoppingListItem($item,$category,$quantity, $checkStatus, $userId);
    }
    if($status){
        $result = ["status" => "Shopping List Item added successfully"];
    } else {
        $result = ["status" => "Failed to add Shopping List Item"];
    }
    $shoppinglistJSON = json_encode($result);
    echo $shoppinglistJSON;
}
?>