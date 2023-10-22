<?php
require_once __DIR__."\..\db\ConnectionManager.php";
session_start();
if(!isset($_SESSION['login'])){
    header ('location:../../app/views/login.php');
    exit;
}

unset($_SESSION['login']);
header('location:../../app/views/login.php');
exit;
?>