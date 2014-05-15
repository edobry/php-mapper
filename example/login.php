<?php
include "config.php";

session_start();

$error=NULL;
if($_SERVER["REQUEST_METHOD"] == "POST")
{
// username and password sent from form
$username=addslashes($_POST['username']);
$pass=addslashes($_POST['password']);
$sql= $db->prepare("UPDATE users SET access=NOW() 
					WHERE name=? and password=?");
$sql->bind_param("ss",$username,$pass);
$sql->execute();
$sql->close();

$sql= $db->prepare("SELECT uid FROM users 
					WHERE name=? and password=?");
$sql->bind_param("ss",$username,$pass);
$sql->execute();
$sql->bind_result($uid);

$sql->fetch();
$sql->close();

if(isset($uid)) {
	$_SESSION['login_user']=$uid;
	header("location: welcome.php");
}	
else
{
$error="Your Login Name or Password is invalid";
}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>Login Page</title>
		<style type="text/css">
		body
		{
		font-family:Arial, Helvetica, sans-serif;
		font-size:14px;
		}
		label
		{
		font-weight:bold;
		width:100px;
		font-size:14px;
		}
		.box
		{
		border:#666666 solid 1px;
		}
		</style>
	</head>
	<body>
		<div>
			<div>
				<div><b>Login</b></div>
				<div>
					<form action="" method="post">
						<label>UserName  :</label><input type="text" name="username" class="box"/><br /><br />
						<label>Password  :</label><input type="password" name="password" class="box" /><br/><br />
						<input type="submit" value=" Submit "/><br />
					</form>
					<?php
						if( !is_null($error) ) { ?>
					<div style="font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div> 
					<?php } ?>
				</div>
			</div>
		</div>
		<br><br><br>
		<div>
			<a href="register.php">Register<a>
		</div>
	</body>
</html>