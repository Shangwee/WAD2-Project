<?php
require_once("../../model/ShoppingListItem.php");
require_once ("../../DAO/shoppingListDAO.php");

$status = false;
$result = [];
if(isset($_GET['id']) & isset($_GET['quantity'])){
    $id = $_GET['id'];
    $quantity = $_GET['quantity'];

    var_dump($id);
    var_dump($quantity);

    $shoppingListDAO = new shoppingListDAO();
    $status = $shoppingListDAO->editShoppingListItem($id, $quantity);
}

if ($status)
{
    $result = ["status" => "Shopping List Item quanity update successfully"];
}
else
{
    $result = ["status" => "Failed to update Shopping List Item"];
}

$resultJSON = json_encode($result);
echo $resultJSON;
?>