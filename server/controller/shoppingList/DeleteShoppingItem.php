<?php
require_once("../../model/ShoppingListItem.php");
require_once("../../DAO/PostShoppingListDAO.php");
require_once ("../../DAO/shoppingListDAO.php");
session_start();

$poststate = false;
$status = false;
$result = [];
if(isset($_GET['id'])){
    $id = $_GET['id'];

    var_dump($id);

    $shoppingListDAO = new shoppingListDAO();
    $PostShoppingListDAO = new PostShoppingListDAO;
    $getItems = $shoppingListDAO->getShoppingItembyitemID($id);
    foreach($getItems as $getItem){
        $item = $getItem->getItem();
        $category = $getItem->getCategory();
        $quantity = $getItem->getQuantity();
        $userID = $getItem->getUserID();
        $poststate = $PostShoppingListDAO->insertPostShoppingListItem($item, $category, $quantity, $userID);

    }
    if ($poststate){
        $status = $shoppingListDAO->deleteShoppingListItem($id);
    }
   
}

if ($status)
{
    $result = ["status" => "Shopping List Item deleted successfully"];
}
else
{
    $result = ["status" => "Failed to delete Shopping List Item"];
}

$resultJSON = json_encode($result);
echo $resultJSON;
?>