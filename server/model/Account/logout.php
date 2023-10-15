<?php
require_once "../ConnectionManager.php";
if(!isset($_SESSION['login'])){
    header ('location:login.php');
    exit;
}

unset($_SESSION['login']);
header('location:login.php');
exit;
?>