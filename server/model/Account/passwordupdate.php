<html>
    <body>
    <h2>Password Update</h2>
    <form method='post'>
        <table>
            <tr><td>Username:</td><td><input type='text'name='username'></td></tr>
            <tr><td>Security Keyword:</td><td><input type='text' name='sk'></td></tr>
            <tr><td colspan='2'><input type='submit' name='submit' value='Verify'></td></tr>
</table>
</form>




<?php
require_once "/WAD2-Project/server/model/ConnectionManager.php";
$accdao = new AccountDAO();
$errors = [];
$showpw=false;
if (isset($_POST['submit'])){
    $un = $_POST['username'];
    // $sk = $_POST['sk'];

    if(!empty($un)){
        $user= $accdao->getAccByUsername($un);
        if($user !== null){
            $errors[]='Username invalid';
        }

    }else{
        $errors[]='Username must be filled';
    }
    $_SESSION['errors'] =$errors;
    printr();
    if(empty($errors)){
       $showpw =true;
       $_SESSION['passwordun'] = $un;
    }
}
if($showpw){
    echo"<h2>Verification Successful. Please enter your new password.</h2>";
    echo"<form method='post'><table>
    <tr>
    <td>New Password:</td><td><input type='password' name='newpw'>
    <input type='hidden' name='username' value={$_SESSION['passwordun']}>
    </td>
    </tr>
    <tr>
    <td>Confirm Password:</td><td><input type='password' name='cfmpw'></td>
    </tr>
    <tr>
    <td colspan='2'><input type='submit' name='chgpw' value='Change Password'></td>
    </tr>
    </table>
    </form>";
}

if (isset($_POST['chgpw'])){
    $pw=$_POST['newpw'];
    $cfmpw =$_POST['cfmpw'];
    if(empty($pw) or empty($pw)){
        $errors[] ='Fields must be filled';

    }
    elseif($pw!==$cfmpw){
        $errors[]='Passwords do not match';

    }
    $_SESSION['errors'] =$errors;
    
    if(empty($errors)){
        $accdao->updatePassword($_POST['username'],password_hash($pw,PASSWORD_DEFAULT));
        header('location:login.php');
        exit;
    }else{
        echo"<h2>Verification Successful. Please enter your new password.</h2>";
    echo"<form method='post'><table>
    <tr>
    <td>New Password:</td><td><input type='password' name='newpw'>
    <input type='hidden' name='username' value={$_SESSION['passwordun']}>
    </td>
    </tr>
    <tr>
    <td>Confirm Password:</td><td><input type='password' name='cfmpw'></td>
    </tr>
    <tr>
    <td colspan='2'><input type='submit' name='chgpw' value='Change Password'></td>
    </tr>
    </table>
    </form>";
    printr();
    }
}



?>