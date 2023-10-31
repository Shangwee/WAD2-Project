<?php
require_once "../../server/DAO/AccountDAO.php";
$errors = [];
$accdao = new AccountDAO();
if (isset($_POST['submit'])){
    
    $un = $_POST['username'];
    $pw = $_POST['password'];
    $cfmpw = $_POST['cfmpassword'];
    $email = $_POST['email'];

    if(empty($un)){
        $unerr = 'Username must be filled';
        $errors[] = 'Username must be filled';
    }elseif($accdao->getAccByUsername($un) !== null){
        $unerr='Username taken';
        $errors[]='Username taken';
    }

    if(empty($email)){
        $emailerr = 'Email must be filled';
        $errors[] = 'Email must be filled';
    }
    else if(!str_contains($email,'@')){
        $emailerr = 'Enter a valid email';
        $errors[] = 'Enter a valid email';
    }
    elseif($accdao->getAccByEmail($email) !== null){
        $unerr='Email taken';
        $errors[]='Email taken';
    }

    if(empty($pw)){
        $pwerr = 'Password must be filled';
        $errors[] = 'Password must be filled';
    }

    if(empty($cfmpw)){
        $cfmpwerr = 'Confirm Password must be filled';
        $errors[] = 'Confirm Password must be filled';
    }

    if($cfmpw !== $pw){
        $errors[] = 'Passwords do not match';
        $cfmpwerr = 'Passwords do not match';
    }

    if(!empty($errors)){
        // $_SESSION['errors'] = $errors;
        header ("location:register.php?pwerr=$pwerr&cfmpwerr=$cfmpwerr&unerr=$unerr&username=$un&email=$email&emailerr=$emailerr");
        exit;
    }
    $status = $accdao->createAcc($un,password_hash($pw,PASSWORD_DEFAULT),$email);
    if($status){
    // echo"<h1>Sign up successful!</h1>";
    // echo"<p><a href='login.php?username=$un'>Return to Login</a></p>";
    header ('location:register.php?success=1');
        exit;
    }else{
        header ('location:register.php');
        exit;
    }
}else{
    header('location:register.php');
    exit;
}
?>