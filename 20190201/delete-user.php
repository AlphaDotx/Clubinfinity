<?php
session_start();
require_once 'class.user.php';
$user_home = new USER();
if(!$user_home->is_logged_in())
{
	$user_home->redirect('index.php');
}

date_default_timezone_set('Africa/Johannesburg');
$date = date('Y-m-d H:i:s', time());

$userid = $_GET['userid'];
$admin_name = $_GET['admin'];
$username = $_GET['name'];

$stmt = $user_home -> runQuery("DELETE FROM tbl_users WHERE userID=:userid");
$stmt ->bindparam(":userid",$userid, PDO::PARAM_STR);
$stmt->execute();  

$stmt = $user_home -> runQuery("DELETE FROM tbl_waitinglist WHERE userID=:trace_id");
$stmt ->bindparam(":trace_id",$userid, PDO::PARAM_STR);
$stmt->execute();

$stmt = $user_home -> runQuery("DELETE FROM tbl_helpers WHERE userID=:trace_id");
$stmt ->bindparam(":trace_id",$userid, PDO::PARAM_STR);
$stmt->execute();

$stmt = $user_home -> runQuery("DELETE FROM tbl_orders WHERE userID=:trace_id");
$stmt ->bindparam(":trace_id",$userid, PDO::PARAM_STR);
$stmt->execute();

$deletelog = fopen("deletelog.txt", "a") or die("Unable to open file!");
$txt = $admin_name." deleted ".$username." from the system on ".$date;
fwrite($deletelog, "\n". $txt);
fclose($deletelog);

header('location: users.php?code=600');
?>