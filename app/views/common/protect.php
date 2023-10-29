<?php
require_once "../../server/model/Account.php";

    // No session variable "user" => no login
    if (!isset($_SESSION["login"])) {
        // redirect to login page
        header("Location: ../views/login.php");
        exit;
    } else {
        $user = $_SESSION["login"];
    }
?>