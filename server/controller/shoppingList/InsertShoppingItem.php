<?php
require_once("../../model/ShoppingListItem.php");
require_once ("../../DAO/shoppingListDAO.php");
$status = false;
$result = [];

if (isset($_GET['name']) && isset($_GET['quantity']) && isset($_GET["checkStatus"]))
{
    $name = $_GET['name'];
    $quantity = intval($_GET['quantity']);
    $checkStatus = $_GET["checkStatus"];

    var_dump($name);
    var_dump($quantity);
    var_dump($checkStatus);

    $shoppingListDAO = new shoppingListDAO();
    $status = $shoppingListDAO->insertShoppingListItem($name, $quantity, $checkStatus, 1);
}
if ($status)
{
    $result = ["status" => "Shopping List Item added successfully"];
}
else
{
    $result = ["status" => "Failed to add Shopping List Item"];
}

$shoppinglistJSON = json_encode($result);
echo $shoppinglistJSON;
?>