<?php
require_once("../../model/ShoppingListItem.php");
require_once ("../../DAO/shoppingListDAO.php");

$status = false;
$result = [];

$userid = 1; //hardcoded for now will change to session variable later

$shoppingListDAO = new shoppingListDAO();
$status = $shoppingListDAO->clearShoppingList($userid);

if ($status)
{
    $result = ["status" => "Shopping List cleared successfully"];
}
else
{
    $result = ["status" => "Failed to clear Shopping List"];
}

$resultJSON = json_encode($result);
echo $resultJSON;
?>