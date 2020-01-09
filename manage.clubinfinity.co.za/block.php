<?php
session_start();
require_once 'class.user.php';
//require_once 'config.php';
$user = new USER();

if(!$user->is_logged_in())
{
	$user->redirect('index.php');
}

$block = $_GET['block'];
$status = $_GET['status'];
$name = $_GET['name'];


if($status == "b"){

	if($user -> updateStatus("N",$block)){
		header('location: users.php?code=701&name='.$name);
	}

}elseif($status == "u"){

	if($user -> updateStatus("Y",$block)){
		header('location: users.php?code=702&name='.$name);
		}

}elseif($status == "us"){
	if($user -> updateStatus("Y",$block)){
		header('location: users.php?code=703&name='.$name);
		}
}



?>