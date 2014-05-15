<?php
include "config.php";

$tmp = 4;

session_start();

$error=NULL;
if($_SERVER["REQUEST_METHOD"] == "POST")
{
// $username and $password sent from form

$username=addslashes($_POST['username']);
$age=addslashes($_POST['age']);
$city=addslashes($_POST['city']);
$pass=addslashes($_POST['password']);


$sql= $db->prepare("INSERT INTO users (name, $age, $city, access, password) 
					VALUES ($username, $age, $city, NOW(), $pass)");
// $sql->bind_param("ss",$username,$pass);
$sql->execute();
$sql->close();

$sql= $db->prepare("UPDATE users SET $uid=$tmp+1
					WHERE name=? and $password=?");
$sql->bind_param("ss",$username,$pass);
$sql->execute();
$sql->bind_result($uid);

$sql->fetch();
$sql->close();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head></head>
<body>
<div>
	<form action="" method="post">
		<label>UserName  :</label><input type="text" name="username" class="box"/><br /><br />
		<label>Age  :</label><input type="number" name="age" class="box" /><br/><br />
		<label>City  :</label><input type="text" name="city" class="box" /><br/><br />
		<label>Password  :</label><input type="password" name="password" class="box" /><br/><br />
		<input type="submit" value=" Submit "/><br />
	</form>
</div>
</body>
</html>