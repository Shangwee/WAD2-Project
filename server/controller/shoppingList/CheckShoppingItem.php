<?php
require_once("../../model/ShoppingListItem.php");
require_once ("../../DAO/shoppingListDAO.php");

$status = false;
$result = [];
if(isset($_GET['id']) & isset($_GET['checkStatus'])){
    $id = $_GET['id'];
    $checkStatus = $_GET['checkStatus'];

    var_dump($id);
    var_dump($checkStatus);

    if ($checkStatus == "true")
    {
        $cStatus = true;
    }
    else
    {
        $cStatus = false;
    }

    $shoppingListDAO = new shoppingListDAO();
    $status = $shoppingListDAO->updateCheckStatus($id, $cStatus);
}

if ($status)
{
    $result = ["status" => "Shopping List Item check status successfully"];
}
else
{
    $result = ["status" => "Failed to check status of Shopping List Item"];
}

$resultJSON = json_encode($result);
echo $resultJSON;
?>