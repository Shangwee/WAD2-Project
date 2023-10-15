<?php
require_once "../ConnectionManager.php";

//  echo"<table><tr>
//  <td align='top'><img src='mnetplus.jpeg' width='120'/></td>
//  <td align='center'><br><i><h1>Mnet PLUS</h1><i></td>
// </table>";

echo"<br><h2>Sign up</h2>";
echo"<form method='post' action='processregister.php'><table>
<tr><td>Username:</td><td><input type='text' name='username'></td></tr>
<tr><td>Password:</td><td><input type='password' name='password'></td></tr>
<tr><td>Confirm Password:</td><td><input type='password' name='cfmpassword'></td></tr>
<tr><td colspan='2'><input type='submit' name='submit' value='Sign up'></td></tr>
</table>
</form>";
printr();


?>