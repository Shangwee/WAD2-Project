<?php 
require_once("../../model/ShoppingListItem.php");
require_once ("../../DAO/shoppingListDAO.php");
$result = [];

if(isset($_GET['userid'])){
$userid = $_GET['userid'];
$data  = array();

$shoppingListDAO = new ShoppingListDAO();
$datas = $shoppingListDAO->getShoppingListItemsbyUser($userid);


foreach($datas as $data_object){
    $data = [];
    $data['id'] = $data_object->getId();
    $data['item'] = $data_object->getItem();
    $data['quantity'] = $data_object->getQuantity();
    $data['checkStatus'] = $data_object->getStatus();
    $data['shoppingID'] = $data_object->getShoppingID();
    $data['userid'] = $data_object->getUserID();
    $result[] = $data;
}

$shoppinglist = json_encode($result);
echo $shoppinglist;
}
?>