<?php
require_once "/WAD2-Project/model/ConnectionManager.php";
if(!isset($_SESSION['login'])){
    header ('location:login.php');
    exit;
}

unset($_SESSION['login']);
header('location:login.php');
exit;
?>