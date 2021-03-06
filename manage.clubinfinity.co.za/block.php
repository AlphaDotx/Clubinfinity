<?php
session_start();
require_once 'class.user.php';
//require_once 'config.php';
$user = new USER();

if(!$user->is_logged_in())
{
	$user->redirect('index.php');
}
$date = @date('Y M d | H:i:s');
$block = $_GET['block'];
$status = $_GET['status'];
$name = $_GET['name'];


if($status == "b"){

	if($user -> updateStatus("N",$block)){
		$user->auditTrail($_SESSION['userSession'], 'Suspended '.$name.' from accessing the system', $date);
		header('location: users.php?code=701&name='.$name);
	}

}elseif($status == "u"){

	if($user -> updateStatus("Y",$block)){
		header('location: users.php?code=702&name='.$name);
		$user->auditTrail($_SESSION['userSession'], 'permitted system access to '.$name, $date);
		}

}elseif($status == "us"){
	if($user -> updateStatus("Y",$block)){
		$user->auditTrail($_SESSION['userSession'], 'permitted system access to '.$name, $date);
		header('location: users.php?code=703&name='.$name);
		}
}



?>