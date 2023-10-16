<?php
require_once "../model/ShoppingListItem.php";
require_once "../DAO/shoppingListDAO.php";
session_start();
$status = false;
$result = [];

if (isset($_POST['name']) && isset($_POST['quantity']) && isset($_POST["checkStatus"]))
{
    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
    $checkStatus = $_POST["checkStatus"];
    $shoppingID = uniqid();

    $shoppingListDAO = new shoppingListDAO();
    $status = $shoppingListDAO->insertShoppingListItem($name, $quantity, $checkStatus, $shoppingID, 1);
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