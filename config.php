<?php
$server = "localhost";
$username = "root";
$password = "";
$db_name = "clubinfinity";
@mysql_connect($server, $username, $password);
mysql_select_db($db_name) or die("<center><span style='color:red'>database could not connect </span></center>");
?>