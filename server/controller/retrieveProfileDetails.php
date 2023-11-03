<?php
session_start();
require_once("../model/SearchHistory.php");
require_once ("../DAO/SearchHistoryDAO.php");
require_once("../model/Account.php");
require_once ("../DAO/AccountDAO.php");
$status = false;
$response = [];
// var_dump(isset($_SESSION['login']));
if (isset($_SESSION["login"]))
{   
    $userid = $_SESSION["login"];
    // var_dump($userid);

    $shDAO = new SearchHistoryDAO();
    $accDAO = new AccountDAO();
    $shobjlist = $shDAO->getSearchHistoryByUid($userid);
    $userobj = $accDAO->getAccByUid($userid);
    $shlist=[];
    foreach($shobjlist as $shobj){
        $search=$shobj->getSearch();
        $cuisine = $shobj->getCuisine();
        $meal=$shobj->getMeal();
        $diet =$shobj->getDiet();
        $time = $shobj->getTimeCreated();
        $shlist[]=['search'=>$search,
                    'cuisine'=>$cuisine,
                    'meal'=>$meal,
                    'diet'=>$diet,
                    'time'=>$time];
    };
    $un =$userobj->getUsername();
    $email=$userobj->getEmail();
    $date=$userobj->getDate();
    
    $response =['un'=>$un,
                'email'=>$email,
                'date'=>$date,
                'shlist'=>$shlist];
    // var_dump($response);

    echo json_encode($response);
}

?>