<?php
require_once("../model/SearchHistory.php");
require_once ("../DAO/SearchHistoryDAO.php");
$status = false;
$result = [];

if (isset($_GET['search']) && isset($_GET['cuisine'])&&isset($_GET['mealtype']) && isset($_GET["userId"]) && isset($_GET['diet']))
{
    $search = $_GET['search'];
    $cuisine = $_GET['cuisine'];
    $meal = $_GET['mealtype'];
    $diet = $_GET['diet'];
    $userid = $_GET["userId"];
    var_dump($search);
    var_dump($userid);

    $shDAO = new SearchHistoryDAO();
    $shDAO->updateSearchHistory($userid,$search,$cuisine,$meal,$diet);
}

?>