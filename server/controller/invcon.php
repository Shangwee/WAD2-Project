<?php
require_once "../DAO/invclasses.php";
// require_once "../db/ConnectionManager.php";
header("Access-Control-Allow-Origin: *");

if ( isset($_GET['uid']) ) {
    $uid = $_GET['uid'];
    $function = $_GET['function'];
    $access = new accessdao;
    if($function === "add"){
        $item = $_GET["item"];
        $qty = $_GET["qty"];
        $expiry = $_GET["expiry"];
        $category = $_GET["category"];
        $result = $access->insert($uid, $item, $qty, $expiry, $category);
        $myJSON = json_encode($result);
        echo $myJSON;
    }
    elseif($function === "remove"){
        $serial = $_GET["serial"];
        $result = $access->remove($uid, $serial);
        $myJSON = json_encode($result);
        echo $myJSON;
    }
    elseif ($function === "checkexpire"){
        $access->checkExpire($uid);
    }
    elseif($function === "delete"){
        $serial = $_GET["serial"];
        $access->delete($uid,$serial);
    }

}
