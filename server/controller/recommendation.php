<?php
require_once("../DAO/PostShoppingListDAO.php");
require_once ("../model/PostShoppingListItem.php");
session_start();
$PostShoppingListDAO = new PostShoppingListDAO;
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
    $resultJSON = json_encode($finalResult);
    echo $resultJSON;
}
?>