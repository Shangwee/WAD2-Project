<?php
require_once "../db/ConnectionManager.php";
$errors = [];
$accdao = new AccountDAO();
if (isset($_POST['submit'])){
    
    $un = $_POST['username'];
    $pw = $_POST['password'];
    $cfmpw = $_POST['cfmpassword'];

    if(empty($un)){
        $errors[] = 'Username must be filled';
    }elseif($accdao->getAccByUsername($un) !== null){
        $errors[]='Username taken';
    }

    if(empty($pw)){
        $errors[] = 'Password must be filled';
    }

    if(empty($cfmpw)){
        $errors[] = 'Confirm Password must be filled';
    }

    if($cfmpw !== $pw){
        $errors[] = 'Passwords do not match';
    }

    if(!empty($errors)){
        $_SESSION['errors'] = $errors;
        header ('location:register.php');
        exit;
    }
    $status = $accdao->createAcc($un,password_hash($pw,PASSWORD_DEFAULT));
    if($status){
    echo"<h1>Sign up successful!</h1>";
    echo"<p><a href='login.php?username=$un'>Return to Login</a></p>";
    }else{
        header ('location:register.php');
        exit;
    }
}else{
    header('location:register.php');
    exit;
}
?>