<?php
include "config.php";
session_start();

if(isset($_SESSION['login_user'])) {
	$uid=$_SESSION['login_user'];
}
else {
	fail();
}

$sql = $db->prepare("select name from users where uid=? ");
$sql->bind_param("i",$uid);
$sql->execute();
$sql->bind_result($name);

$sql->fetch();
$sql->close();

if(!isset($name)) {
	fail();
}

function fail() {
	header("Location: login.php");
}
?>