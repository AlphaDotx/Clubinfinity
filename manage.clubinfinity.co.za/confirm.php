<?php
session_start();
require_once 'class.user.php';
$user_home = new USER();

if(!$user_home->is_logged_in())
{
	$user_home->redirect('index.php');
}

$date = @date('Y M d | H:i:s');

if($user_home -> confirmFunds(1,$_GET['traceid'])){
	$user_home->auditTrail($_SESSION['userSession'], 'confirmed transaction with the reference number: '.$_GET['traceid'], $date);
	header("location: transactions.php?code=700");
}


?>