<?php
session_start();
require_once 'class.user.php';
$user_home = new USER();

if(!$user_home->is_logged_in())
{
	$user_home->redirect('index.php');
}

if($user_home -> confirmFunds(1,$_GET['traceid'])){
	header("location: dashboard.php?code=700");
}


?>