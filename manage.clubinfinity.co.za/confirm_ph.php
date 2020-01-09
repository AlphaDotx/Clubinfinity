<?php
session_start();
require_once 'class.user.php';
$user_home = new USER();

if(!$user_home->is_logged_in())
{
	$user_home->redirect('index.php');
}

if($user_home -> confirmTemp($_GET['trace'])){
    if($user_home -> updateUser($_GET['trace'])){
	header("location: re-payments.php?code=700");
    }
}


?>