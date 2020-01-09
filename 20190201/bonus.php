<?php
require_once 'config.php';
session_start();
date_default_timezone_set('Africa/Johannesburg');
require_once 'class.user.php';
$user_home = new USER();

if(!$user_home->is_logged_in())
{
	$user_home->redirect('index.php');
}
$date = @date("Y-m-d H:i");
$stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$contact = $row['Contact'];
$bank = $row['bank'];
$userName = $row['userName'];

$total = trim($_POST['total']);
$id = $_SESSION['userSession'];

if($total < 500){
header("location: dl.php?code=600");
exit();
}


$bonus = floor($total / 500) * 500;

$orders = "INSERT INTO tbl_orders VALUES('$id','0','$userName','$bonus','$bank','$date')";
mysql_query($orders);



$userupdate = "UPDATE tbl_users SET branch='claimed' WHERE branch_code='$contact'";
mysql_query($userupdate);

header("location: dl.php?code=700");
?>