<?php
    session_start();
    // No session variable "user" => no login
    if (!isset($_SESSION["uid"])) {
        // redirect to login page
        header("Location: ../login.php");
        exit;
    }
?>