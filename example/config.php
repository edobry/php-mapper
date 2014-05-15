<?php

$mysql_hostname = "localhost";
$mysql_user = "root";
$mysql_password = "";
$mysql_database = "mydb";

$db = new MySQLi($mysql_hostname, $mysql_user, $mysql_password, $mysql_database) or die("Opps some thing went wrong");

?>