<?php
spl_autoload_register(
  function($class){
    require_once "$class.php";
  }
);

session_start();

function printr(){
  if (isset($_SESSION['errors'])){
    echo"<ul>";
    foreach($_SESSION['errors'] as $err){
      echo"<li>$err</li>";
    }
    echo"</ul>";
    unset($_SESSION['errors']);
  }
}
class ConnectionManager {

  public function getConnection() {
    $servername = 'localhost';
    $dbname = 'wad2project';
    $username = 'root';
    $password = ''; // change this depending on mac or windows
    $port = 3306;
    $url  = "mysql:host=$servername;dbname=$dbname;port=$port";

    return new PDO($url, $username, $password);
  }

}
?>
