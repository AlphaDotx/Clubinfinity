<?php
session_start();
require_once 'class.user.php';
$user_home = new USER();
if(!$user_home->is_logged_in())
{
	$user_home->redirect('index.php');
}

$trace_id = $_GET['traceid'];
$stmt = $user_home -> runQuery("DELETE FROM tbl_helpers WHERE traceid=:trace_id");
$stmt ->bindparam(":trace_id",$trace_id, PDO::PARAM_STR);
$stmt->execute();  

header('location: investors.php?code=600');

?>