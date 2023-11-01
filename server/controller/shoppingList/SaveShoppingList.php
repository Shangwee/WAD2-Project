<?php
require_once ("../../DAO/shoppingListDAO.php");
require_once ("../../DAO/PostShoppingListDAO.php");
require_once ("../../DAO/invclasses.php");

// save list in post shopping list and also into inventory
// get all items from shopping list table
$result = [];
$isDelete = false;

if(isset($_GET['slist'])){
    $shoppingList = $_GET['slist'];
    for($i=0; $i<count($shoppingList); $i++){
        var_dump($shoppingList[$i]);
        $Itemid = $shoppingList[$i]['id'];
        $item = $shoppingList[$i]['name'];
        $quantity = $shoppingList[$i]['quantity'];
        $category = $shoppingList[$i]['category'];
        $expiry = getexpiry($category);
        $userId = $_GET['userId'];
        $PostShoppingListDAO = new PostShoppingListDAO;
        $shoppingListDAO = new shoppingListDAO();
        $access = new accessdao;
        // save list in post shopping list
        $isInsertPost = $PostShoppingListDAO->insertPostShoppingListItem($item, $category, $quantity, $userId);
        // save list into the inventory
        if($isInsertPost){
        // insert into inventory
            $result = $access->insert($userId, $item, $quantity, $expiry, $category);
            // delete from shopping list
            $isDelete = $shoppingListDAO->deleteShoppingListItem($Itemid);
            if($isDelete && $result){
                $result = ["status" => "Shopping List Item deleted successfully"];
            } else {
                $result = ["status" => "Failed to delete Shopping List Item"];
            }
        }

    }
    $resultJSON = json_encode($result);
    echo $resultJSON;
}

function getexpiry($category){
    if ($category == 'Produce' or $category == "others"){
        // return current date + 3 days
        $expiry = date('Y-m-d', strtotime('+3 days'));
        return $expiry;
    } elseif ($category == 'Dairy and Protein'){
        // return current date + 7 days
        $expiry = date('Y-m-d', strtotime('+7 days'));
        return $expiry;
    } elseif ("Snacks and Pantry") {
        // return current date + 30 days
        $expiry = date("Y-m-d", strtotime("+30 days"));
        return $expiry;
    } elseif ("Grains and Bakery") {
        // return current date + 5 days
        $expiry = date("Y-m-d", strtotime("+5 days"));
        return $expiry;
    }
}
?>