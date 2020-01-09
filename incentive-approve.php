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

    $user_home->approveIncentive($_POST['follower']);
    $user_home->activateFollower($_POST['follower']);

}

header("location: dl.php?code=700");
?>