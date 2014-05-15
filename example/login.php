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
		body {
			font-family:Arial, Helvetica, sans-serif;
			background-color: #25567B;
			margin: 0;
		}

		#wrapper {
			margin: 0;
		}

		#main {
			margin-top: 140px;
			padding: 40px;

			background-color: #3F92D2;
			border: 3px solid #033E6B;
			border-left: 0;
			border-right: 0;
		}

		#formbox {
			text-align: center;
			margin: 0 auto 0 auto;
			width: 300px;
			background-color: #66A3D2;
			padding: 30px;
			border: 1px solid #25567B;
		}

		#login_title {
			margin-bottom: 10px;
			font-size: 30px;
		}

		input {
			text-align: center;
			padding: 5px;
			margin-bottom: 25px;
			color: #A65F00;
			display: block;
			width: 100%;
			height: 30px;
			border: none;
		}

		input[type=submit] {
			padding: 10px;
			width: 75%;
			margin: 0 auto 10 auto;
			background-color: #FFC373;
			color: #25567B;
			font-weight: bold;
			font-size: 20px;
			height: auto;
		}
		
		input[type=submit]:active {
			background-color: #FF9200;
		}

		#register_link {
			text-decoration: none;
			color: black;
			margin-top: 30px;
			font-size: 25px;
			display: inline-block;
		}
		</style>
	</head>
	<body>
		<div id="wrapper">	
			<div id="main">
				<div id="formbox">
					<div id="login_title">login</div>
					<form action="" method="post">
						<input type="text" name="username" placeholder="username" class="box"/>
						<input type="password" name="password" placeholder="password"  class="box" />
						<input type="submit" value="Submit"/> <a href="register.php" id="register_link">Register<a>
					</form>
					<?php
					if( !is_null($error) ) { ?>
					<div style="font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
					<?php } ?>
				</div>
			</div>
		</div>
	</body>
</html>