<?php
session_start();
require_once 'class.user.php';
$user_home = new USER();

if(!$user_home->is_logged_in())
{
	$user_home->redirect('index.php');
}
$date = @date('Y M d | H:i:s');
$link = $_GET['link'];
$traceid = $_GET['traceid'];
$stmt = $user_home->runQuery("SELECT H.myid,H.userid,H.hto,H.amount,H.date,U.bank FROM tbl_history as H JOIN tbl_users as U ON U.userID=H.userid WHERE traceid=:trace_id");
$stmt->execute(array(":trace_id"=>$traceid));
$urow = $stmt->fetch(PDO::FETCH_ASSOC);
$userid = $urow['userid'];
$myid = $urow['myid'];
$user = $urow['hto'];
$amount = $urow['amount'];
$date = $urow['date'];
$bank = $urow['bank'];

if($user_home -> confirmFunds(2,$_GET['traceid'])){
$user_home -> updateStatus("N",$myid);
$user_home -> AddOrders($userid,$user,$amount,$bank,$date);

$user_home->auditTrail($_SESSION['userSession'], 'cancelled transaction with a reference no. '.$_GET['traceid'], $date);
$user_home->redirect($link."?code=700");
}
?>