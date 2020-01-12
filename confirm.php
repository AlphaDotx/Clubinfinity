<?php
// require_once 'config.php';
session_start();
require_once 'class.user.php';
$user_home = new USER();

if(!$user_home->is_logged_in())
{
	$user_home->redirect('index.php');
}
date_default_timezone_set('Africa/Johannesburg');


if(isset($_POST['submit'])){

	$stmt = $user_home->runQuery("SELECT * FROM tbl_waitinglist WHERE traceid=:uid LIMIT 1");
	$stmt->execute(array(":uid"=>$_GET['traceid']));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	$userID = $row['userID'];
	$username = $row['name'];
	$bank = $row['bank'];

	$CURRENT_DATE = @date("M d Y H:i:s");
	

	$date = new DateTime($row['date']);
	$date2 = new DateTime($CURRENT_DATE);
	$diff = $date2->diff($date1)->format("%a");
	
	if($diff >= 4){
		$total_payout = $row['price'] * 2;
	}else{
		$percentage = $diff * 25;
		$interests = ($percentage/100) * $row['price'];
		$total_payout = $interests + $row['price'];
	}

	

	// $user_home->updateTransactionsStatus($status, $_POST['traceid']);
	$user_home->addOrders($userID,$username,$total_payout,$bank,$date);
	$user_home->deleteInvestment($_POST['traceid']);
}

// header("location: dashboard.php?code=700");
?>