<?php
session_start();
require_once '../class.user.php';
require_once '../config.php';
require_once '../dbconfig.php';
$user_home = new USER();
if(!$user_home->is_logged_in())
{
	$user_home->redirect('index.php');
}



if(isset($_POST["submit"]) && $_POST["submit"]!="") {
$err = 0;
$usersCount = count($_POST["userID"]);
for($i=0;$i<$usersCount;$i++) {
    
date_default_timezone_set('Africa/Johannesburg');   
$date = date('Y-m-d H:i:s', time());
    
$stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:uid");
$stmt->execute(array(":uid"=>$_POST["userID"][$i]));
$userrow = $stmt->fetch(PDO::FETCH_ASSOC);
$username = $userrow['userName'];
$userbank = $userrow['bank'];
$usercontact = $userrow['Contact'];

$stmt = $user_home->runQuery("SELECT * FROM tbl_orders WHERE traceid=:trace");
$stmt->execute(array(":trace"=>$_POST["traceid"][$i]));
$lrow = $stmt->fetch(PDO::FETCH_ASSOC);
$userdate = $lrow['date'];
$amount = $lrow['price'];
$userid = $lrow['userID'];
$orderid = $lrow['traceid'];

    
switch ($amount){
	case 500: 

$stmt = $user_home->runQuery("SELECT * FROM tbl_helpers WHERE price=:price AND date < :date LIMIT 1");
$stmt->execute(array(":price"=>$amount,":date"=>$date));

if($stmt->rowCount() > 0){         
        
$hrow = $stmt->fetch(PDO::FETCH_ASSOC);
$helperid = $hrow['userID'];
$helperorderid = $hrow['traceid'];
$helperoffer = $hrow['price'];


$stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:ud");
$stmt->execute(array(":ud"=>$helperid));
$helperrow = $stmt->fetch(PDO::FETCH_ASSOC);
$helpername = $helperrow['userName'];
$helpercontact = $helperrow['Contact'];
    
$file = 'count.txt';
$new_traceid = file_get_contents($file);
$fdata = intval($new_traceid)+1;
file_put_contents($file, $fdata);

$status = "0";  
$pic = "1";
        
if($user_home->Addhistory($userid,$helperid,$new_traceid,$helpername,$username,$helperoffer,$status,$date,$pic)){			
$id = $user_home->lasdID();	$key = base64_encode($id); $id = $key;
  }else{
exit();
  }

$stmt = $user_home -> runQuery("DELETE FROM tbl_helpers WHERE traceid=:trace_id");
$stmt ->bindparam(":trace_id",$helperorderid, PDO::PARAM_STR);
$stmt->execute();        

$stmt = $user_home -> runQuery("DELETE FROM tbl_orders WHERE traceid=:trace_id");  
$stmt ->bindparam(":trace_id",$orderid, PDO::PARAM_STR);
$stmt->execute();  
 
}else{

$err = $err + 1;
      
}   
 
break;
        
case 1000:

$stmt = $user_home->runQuery("SELECT * FROM tbl_helpers WHERE price=:price AND date < :date LIMIT 1");
$stmt->execute(array(":price"=>$amount,":date"=>$date));

if($stmt->rowCount() > 0){         
        
$hrow = $stmt->fetch(PDO::FETCH_ASSOC);
$helperid = $hrow['userID'];
$helperorderid = $hrow['traceid'];
$helperoffer = $hrow['price'];


$stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:ud");
$stmt->execute(array(":ud"=>$helperid));
$helperrow = $stmt->fetch(PDO::FETCH_ASSOC);
$helpername = $helperrow['userName'];
$helpercontact = $helperrow['Contact'];
    
$file = 'count.txt';
$new_traceid = file_get_contents($file);
$fdata = intval($new_traceid)+1;
file_put_contents($file, $fdata);

$status = "0";  
$pic = "1";
        
if($user_home->Addhistory($userid,$helperid,$new_traceid,$helpername,$username,$helperoffer,$status,$date,$pic)){			
$id = $user_home->lasdID();	$key = base64_encode($id); $id = $key;
  }else{
exit();
  }

$stmt = $user_home -> runQuery("DELETE FROM tbl_helpers WHERE traceid=:trace_id");
$stmt ->bindparam(":trace_id",$helperorderid, PDO::PARAM_STR);
$stmt->execute();        
    
$stmt = $user_home -> runQuery("DELETE FROM tbl_orders WHERE traceid=:trace_id");  
$stmt ->bindparam(":trace_id",$orderid, PDO::PARAM_STR);
$stmt->execute();  

}else{
 $err = $err + 1;
}   
        
break;
        
case 1500:

$stmt = $user_home->runQuery("SELECT * FROM tbl_helpers WHERE price=:price AND date < :date LIMIT 1");
$stmt->execute(array(":price"=>$amount,":date"=>$date));

if($stmt->rowCount() > 0){         
        
$hrow = $stmt->fetch(PDO::FETCH_ASSOC);
$helperid = $hrow['userID'];
$helperorderid = $hrow['traceid'];
$helperoffer = $hrow['price'];


$stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:ud");
$stmt->execute(array(":ud"=>$helperid));
$helperrow = $stmt->fetch(PDO::FETCH_ASSOC);
$helpername = $helperrow['userName'];
$helpercontact = $helperrow['Contact'];
    
$file = 'count.txt';
$new_traceid = file_get_contents($file);
$fdata = intval($new_traceid)+1;
file_put_contents($file, $fdata);

$status = "0";  
$pic = "1";
        
if($user_home->Addhistory($userid,$helperid,$new_traceid,$helpername,$username,$helperoffer,$status,$date,$pic)){			
$id = $user_home->lasdID();	$key = base64_encode($id); $id = $key;
  }else{
exit();
  }

$stmt = $user_home -> runQuery("DELETE FROM tbl_helpers WHERE traceid=:trace_id");
$stmt ->bindparam(":trace_id",$helperorderid, PDO::PARAM_STR);
$stmt->execute();        

$stmt = $user_home -> runQuery("DELETE FROM tbl_orders WHERE traceid=:trace_id");  
$stmt ->bindparam(":trace_id",$orderid, PDO::PARAM_STR);
$stmt->execute();  

}else{
  $err = $err + 1;
}   

break;
  }
 }

//echo $err;
//-------sort out output here-------------//

//echo mysql_error();
//header("Location: list_user.php?code=700&o=".$err);
//exit();

}
?>




<html>
<head>
<title>LIst panel</title>
<link rel="stylesheet" type="text/css" href="styles.css" />
</head>
<body>
<form name="frmUser" method="post" action="">
<div style="width:500px;">
<tr class="tableheader">
<td><h1>List Panel</h1></td>
</tr>
<?php
$rowCount = count($_POST["users"]);
for($i=0;$i<$rowCount;$i++) {
$result = mysql_query("SELECT * FROM tbl_orders WHERE userID='".$_POST["users"][$i]."'");
$row[$i]= mysql_fetch_array($result);
?>
<tr>
<td>
<table border="0" cellpadding="5" cellspacing="0" width="100%" align="center" class="tblSaveForm">
<tr>
<td><label>userID</label></td>
<td><input type="hidden" name="userID[]" class="txtField" value="<?php echo $row[$i]['userID']; ?>">
<input type="text"  class="txtField" value="<?php echo $row[$i]['userID']; ?>"></td>

<td><label>Traceid</label></td>
<td><input type="text" name="traceid[]" class="txtField" value="<?php echo $row[$i]['traceid']; ?>"></td>

<td><label>Name</label></td>
<td><input type="text" name="name[]" class="txtField" value="<?php echo $row[$i]['name']; ?>"></td>

<td><label>Amount</label></td>
<td><input type="text" name="price[]" class="txtField" value="<?php echo $row[$i]['price']; ?>"></td>

<td><label>Bank</label></td>
<td><input type="text" name="bank[]" class="txtField" value="<?php echo $row[$i]['status']; ?>"></td>

<td><label>Date</label></td>
<td><input type="text" name="date[]" class="txtField" value="<?php echo $row[$i]['date']; ?>"></td>
</tr>
</table>
</td>
</tr>
<?php
}
?>
<tr>
<td colspan="2"><input type="submit" name="submit" value="Release Now" class="btnSubmit"></td>
</tr>
</table>
</div>
</form>
</body></html>