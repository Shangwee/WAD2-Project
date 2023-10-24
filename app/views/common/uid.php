<?php
require_once '../../../server/db/ConnectionManager.php';
if (isset($_SESSION['uid'])){
    $myJSON = json_encode($_SESSION['uid']);
}
else{
    $myJSON = json_encode(null);
}

echo $myJSON;
?>