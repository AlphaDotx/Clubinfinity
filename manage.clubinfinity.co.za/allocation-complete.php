<?php
session_start();
require_once 'class.user.php';
require_once 'smss.php';
$user_home = new USER();
if(!$user_home->is_logged_in())
{
	$user_home->redirect('index.php');
}
?>
<?php	
date_default_timezone_set('Africa/Johannesburg');
$date = date('Y-m-d H:i:s', time());

					                       
$userid = trim($_GET['userid']);
$orderid = trim($_GET['orderid']);
$amount = trim($_GET['amount']);
$link = trim($_GET['link']);

$helperid = trim($_GET['helperid']);
$helperorderid = trim($_GET['helperofferid']);
$helperoffer = trim($_GET['helperoffer']);

$stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:uid");
$stmt->execute(array(":uid"=>$userid));
$userrow = $stmt->fetch(PDO::FETCH_ASSOC);
$username = $userrow['userName'];
$userbank = $userrow['bank'];
$usercontact = $userrow['Contact'];

$stmt = $user_home->runQuery("SELECT * FROM tbl_orders WHERE traceid=:trace");
$stmt->execute(array(":trace"=>$orderid));
$lrow = $stmt->fetch(PDO::FETCH_ASSOC);
$userdate = $lrow['date'];

$stmt = $user_home->runQuery("SELECT * FROM tbl_helpers WHERE traceid=:trace");
$stmt->execute(array(":trace"=>$helperorderid));
$hrow = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:ud");
$stmt->execute(array(":ud"=>$helperid));
$helperrow = $stmt->fetch(PDO::FETCH_ASSOC);
$helpername = $helperrow['userName'];
$helpercontact = $helperrow['Contact'];

if($amount < $helperoffer){
header("location: allocation.php?code=600");      
  exit();
}

$change = $amount - $helperoffer;

if($change == 0){
//auditTrail
$user_home->auditTrail($_SESSION['userSession'], 'allocated '.$helpername.' to '.$username.' for the amount of '.$helperoffer, $date);


$file = 'multiple/count.txt';
$new_traceid = file_get_contents($file);
$fdata = intval($new_traceid)+1;
file_put_contents($file, $fdata);
    
$status = "0";  
$pic = "";
if($user_home->Addhistory($userid,$helperid,$new_traceid,$helpername,$username,$helperoffer,$status,$date,$pic)){			
$id = $user_home->lasdID();	$key = base64_encode($id); $id = $key;
  }else{
exit();
}

$stmt = $user_home -> runQuery("DELETE FROM tbl_orders WHERE traceid=:trace_id");
$stmt ->bindparam(":trace_id",$orderid, PDO::PARAM_STR);
$stmt->execute();  

$stmt = $user_home -> runQuery("DELETE FROM tbl_helpers WHERE traceid=:trace_id");
$stmt ->bindparam(":trace_id",$helperorderid, PDO::PARAM_STR);
$stmt->execute();  

//Execute script
$numbers = '"'.$helpercontact.','.$usercontact.'"';
$test = new MyMobileAPI();
$test->sendSms($numbers,'Dear Member, your Club Infinity order has been released. please log into your account for more info. http://www.clubinfinity.co.za'); //Send SMS
$test->checkcredits(); //Check your credit balance

header("location: ".$link."?code=701&&helper=".$helpername."&&offer=".$helperoffer."&&user=".$username);

}else{

  //Audit Trail
  $user_home->auditTrail($_SESSION['userSession'], 'allocated '.$helpername.' to '.$username.' for the amount of '.$helperoffer, $date);

$file = 'multiple/count.txt';
$new_traceid = file_get_contents($file);
$fdata = intval($new_traceid)+1;
file_put_contents($file, $fdata);
    
$status = "0";  
$pic = "";
if($user_home->Addhistory($userid,$helperid,$new_traceid,$helpername,$username,$helperoffer,$status,$date,$pic)){			
$id = $user_home->lasdID();	$key = base64_encode($id); $id = $key;
  }else{
exit();
}

$stmt = $user_home -> runQuery("DELETE FROM tbl_orders WHERE traceid=:trace_id");
$stmt ->bindparam(":trace_id",$orderid, PDO::PARAM_STR);
$stmt->execute();  

// $addorder = "INSERT INTO tbl_orders VALUES('$userid','0','$username','$change','1','$userdate')";
// mysql_query($addorder); 

$user_home -> AddInvestment($userid,$username,$change,$userbank,$userdate);
      
$stmt = $user_home -> runQuery("DELETE FROM tbl_helpers WHERE traceid=:trace_id");
$stmt ->bindparam(":trace_id",$helperorderid, PDO::PARAM_STR);
$stmt->execute();  


//Execute script
$numbers = '"'.$helpercontact.','.$usercontact.'"';
$test = new MyMobileAPI();
$test->sendSms($numbers,'Dear Member, your Club Infinity order has been released. please log into your account for more info. http://www.clubinfinity.co.za'); //Send SMS
$test->checkcredits(); //Check your credit balance

header("location: ".$link."?code=801&&helper=".$helpername."&&offer=".$helperoffer."&&user=".$username."&&change=".$change);
}


?>                       
 