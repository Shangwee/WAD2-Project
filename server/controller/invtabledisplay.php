<?php
require_once "../DAO/invclasses.php";
// commented out cuz the conn manager doesn't work for me due to there being a password when I do not have a password for sql on my side
// require_once "../db/ConnectionManager.php";
header("Access-Control-Allow-Origin: *");

if ( isset($_GET['uid']) ) {
    $uid = $_GET['uid'];
    $mode = $_GET['mode'];
    $tablectrl = new tabledisplaydao;
    if ($mode === "current"){
        $result = $tablectrl->getAll($uid);
    }
    if($mode === "historical"){
        $result = $tablectrl->getHistorical($uid);
    }
    elseif($mode === "expiring"){
        $result = $tablectrl->getExpiring($uid);
    }
    elseif($mode === "expired"){
        $result = $tablectrl->getExpired($uid);
    }
$myJSON = json_encode($result);
echo $myJSON;
}