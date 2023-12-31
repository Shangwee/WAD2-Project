<?php
require_once("../DAO/PostShoppingListDAO.php");
require_once ("../model/PostShoppingListItem.php");
require_once ("../DAO/invclasses.php");
session_start();
$PostShoppingListDAO = new PostShoppingListDAO;
$invDAO = new tabledisplaydao;
$result = [];
$finalResult = [];
$itemCount = [];

// get all food from inventoy by user 
// get the quantity
// get the expiry date 
// if the quantity less than or equal to 1 
// if the expiry date is less than or equal to 3 days

// get past shopping list item by user
// get the quantity
// the top 3 most bought items
if(isset($_GET) && !empty($_SESSION)){
    $userId = $_SESSION["login"];
    $data  = array();
    $datas = $PostShoppingListDAO->getPostShoppingListItemsbyUser($userId);

    if($datas != null){
        foreach($datas as $data_object){
            $data = [];

            // $data['id'] = $data_object->getId();
            $data['item'] = $data_object->getItem();
            $data['category'] = $data_object->getCategory();
            $data['reason'] = "Item added frequently to shopping list";
            $result[] = $data;
        }
        // if result length is more than 1;
        if (count($result) >= 3){
            for ($i = 0; $i < count($result); $i++){
                $item = $result[$i]['item'];
                //  if item is not in the itemcount array, set item = 1
                if (!isset($itemCount[$item])){
                    $itemCount[$item] = 1;
                } else {
                    // if item is in the itemcount array, increment the count
                    $itemCount[$item] += 1;
                }
            }
            // sort the itemcount array in descending order
            arsort($itemCount);
            // get the top 3 items
            $top3 = array_slice($itemCount, 0, 3, true);
            // get the keys of the top 3 items
            $top3Keys = array_keys($top3);
            // iterate through result array if the item is in the top 3 items, add to final result array
            for ($i = 0; $i < count($result); $i++){
                if (in_array($result[$i]['item'], $top3Keys)){
                    $finalResult[] = $result[$i];
                }
            }
            // remove duplicates in final result array and make the index start from 0
            $finalResult = array_values(array_unique($finalResult, SORT_REGULAR));

        } else {
            $finalResult = $result;
        }
    }


    // get all food from inventoy by user
    $inventory = $invDAO->getAll($userId);
    $inventoryResult = [];
    for ($i = 0; $i < count($inventory); $i++){
        $name = $inventory[$i][1];
        $quantity = intval($inventory[$i][2]);
        $expiryDate = $inventory[$i][3];
        // get the current date compare to the expiry date
        $days = countDays($expiryDate);
        $category = $inventory[$i][4];
        if ($quantity <= 1){
            $inventoryResult[] = array("item" => $name, "category" => $category, "reason" => "Item quantity is low");
        } elseif ($expiryDate <=3) {
            $inventoryResult[] = array("item" => $name, "category" => $category, "reason" => "Item is expiring soon");
        }
    }
    // merge the two arrays
    $finalResult = array_merge($finalResult, $inventoryResult);
    // remove duplicates in final result array and make the index start from 0
    $finalResult = array_values(array_unique($finalResult, SORT_REGULAR));
    // encode top 7 items to json
    $myJSON = json_encode(array_slice($finalResult, 0, 7, true));
    echo $myJSON;
}   

function countDays($expiryDate){
    $currentDate = date("Y-m-d");
    $diff = abs(strtotime($expiryDate) - strtotime($currentDate));
    $days = floor($diff / (60*60*24));
    return $days;
}
?>