<?php

class Database {
    // get the database connection
    public function getConnection() {
        $servername = 'localhost';
        $dbname = 'foodwise';
        $username = 'root';
        $password = 'root';  // MAMP "root", WAMP empty string
        $port = 3306;  // Check in PHPMyAdmin for port number

        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);     
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // if fail, exception will be thrown

        return $conn;
    }
}

?>