<?php
require_once("../../model/ShoppingListItem.php");
require_once ("../../DAO/shoppingListDAO.php");
$status = false;
$result = [];

if (isset($_GET['name']) && isset($_GET['quantity']) && isset($_GET["checkStatus"]) && isset($_GET["userId"]))
{
    $name = $_GET['name'];
    $quantity = intval($_GET['quantity']);
    $cStatus = $_GET["checkStatus"];
    $checkStatus = 0;
    $userid = $_GET["userId"];
    var_dump($name);
    var_dump($quantity);
    var_dump($cStatus);
    var_dump($userid);

    if ($checkStatus == "true")
    {
        $checkStatus = 1;
    }
    else
    {
        $checkStatus = 0;
    }

    $shoppingListDAO = new shoppingListDAO();
    $status = $shoppingListDAO->insertShoppingListItem($name, $quantity, $checkStatus, $userid);
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