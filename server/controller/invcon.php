<?php
require_once "../DAO/invclasses.php";
// commented out cuz the conn manager doesn't work for me due to there being a password when I do not have a password for sql on my side
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
