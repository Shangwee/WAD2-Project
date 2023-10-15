<?php
require_once "../ConnectionManager.php";
if(!isset($_POST['submit'])){
    header ('location:login.php');
    exit;
}
$accdao = new AccountDAO();
$name = $_POST['username'];
$pw=$_POST['password'];
$errors = [];
if (!empty($name)){
    $user = $accdao->getAccByUsername($name);
    if($user !==null){
        if(password_verify($pw,$user->getHashed())){
            $_SESSION['login'] =$user;
            header ('location:../Homepage.php');
            exit;
        }else{
            $errors[]='Password invalid';
        }
    }else{
        $errors[]='Username invalid';
    }
    

}else{
    $errors[]='Username must be filled';
}

if(!empty($errors)){
    $_SESSION['errors'] =$errors;
    header("location:login.php?username=$name");
    exit;
}