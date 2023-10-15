<html>
    <head>
        <title>
            Mnet PLUS Login
</title>
</head>
<body>
    <!-- <table><tr>
            <td align='top'><img src='mnetplus.jpeg' width='120'/></td>
            <td align='center'><br><i><h1>Mnet PLUS</h1><i></td>
</table> -->
<?php
    $un='';
    if (isset($_GET['username'])){
        $un = 'value='.$_GET['username'];
    }
?>
<br>
<p>
    <h2>Login</h2>
    <form action='processlogin.php' method='post'>
        <table>
            <tr><td>Username:</td><td><input type='text' name='username' <?=$un?>></td></tr>
            <tr><td>Password:</td><td><input type='password' name='password'></td></tr>
            <tr><td colspan='2'><input type='submit' name='submit' value='Login'><input type='reset'></td></tr>
            <tr><td><a href='register.php'>Create account</a></td><td>&nbsp;&nbsp;<a href='passwordupdate.php'>Forgot Password</a></td></tr>
</table>
</form>
<?php
require_once "../ConnectionManager.php";
    printr();
?>
</body>
</html>