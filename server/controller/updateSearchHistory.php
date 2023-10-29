<?php

session_start();
require_once "../DAO/SearchHistoryDAO.php";

$data = json_decode(file_get_contents("php://input"));

$uid = $data->uid;
$search = $data->search;
$cuisine = $data->cuisine;

$shDAO = new SearchHistoryDAO();
if($search !=''){
    $shDAO->updateSearchHistory($uid,$search,$cuisine);
}

?>