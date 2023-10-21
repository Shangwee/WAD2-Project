<?php
require_once("../../model/ShoppingListItem.php");
require_once ("../../DAO/shoppingListDAO.php");

$status = false;
$result = [];
if(isset($_GET['id'])){
    $id = $_GET['id'];

    var_dump($id);

    $shoppingListDAO = new shoppingListDAO();
    $status = $shoppingListDAO->deleteShoppingListItem($id);
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