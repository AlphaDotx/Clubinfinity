<?php
require_once 'config.php';
session_start();
require_once 'class.user.php';
$user_home = new USER();

if(!$user_home->is_logged_in())
{
	$user_home->redirect('index.php');
}

$link = $_GET['link'];
$traceid = $_GET['traceid'];
if($traceid != ""){
$userupdate = "DELETE FROM tbl_history WHERE traceid='$traceid'";
mysql_query($userupdate);

header("location: transactions.php?code=701");
}
?>