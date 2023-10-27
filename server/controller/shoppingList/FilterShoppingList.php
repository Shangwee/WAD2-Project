<?php
require_once("../../model/ShoppingListItem.php");
require_once("../../DAO/shoppingListDAO.php");
$result = [];

if (isset($_GET)) {
    $userid = $_GET["userId"];
    $data  = array();
    $datas = null;
    $selectedFilter = $_GET['selectedFilter'];

    $shoppingListDAO = new ShoppingListDAO();
    if ($selectedFilter == "Checked") {
        $datas = $shoppingListDAO->getShoppingListItemsbyUserAndStatus($userid, 1);
    } else if ($selectedFilter == "Unchecked") {
        $datas = $shoppingListDAO->getShoppingListItemsbyUserAndStatus($userid, 0);
    }
    if ($datas != null) {
        foreach($datas as $data_object){
            $data = [];
            $data['id'] = $data_object->getId();
            $data['item'] = $data_object->getItem();
            $data['category'] = $data_object->getCategory();
            $data['quantity'] = $data_object->getQuantity();
            $data['checkStatus'] = $data_object->getStatus();
            $data['userid'] = $data_object->getUserID();
            $result[] = $data;
        }
    }
    $shoppinglist = json_encode($result);
    echo $shoppinglist;
}

?>