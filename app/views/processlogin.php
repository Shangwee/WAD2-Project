<?php
require_once "../../server/DAO/AccountDAO.php";
session_start();
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
            $_SESSION['login'] = $user->getUserId();
            header ('location:../index.php');
            exit;
        }else{
            $errors[]=1;
            $pwerr='Password invalid';
        }
    }else{
        $errors[]=1;
        $unerr='Username invalid';
    }
    

}else{
    $errors[]=1;
    $unerr='Username must be filled';
}

if(!empty($errors)){
    // $_SESSION['errors'] =$errors;
    header("location:login.php?username=$name&pwerr=$pwerr&unerr=$unerr");
    exit;
}