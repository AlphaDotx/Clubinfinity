<?php
session_start();
require_once 'config.php';
require_once 'dbconfig.php';
require_once 'class.user.php';
date_default_timezone_set('Africa/Johannesburg');
$user_home = new USER();

if(!$user_home->is_logged_in())
{
	$user_home->redirect('index.php');
}
$stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<?php


if(isset($_POST["submit"]) && $_POST["submit"]!="") {
$err = 0;
$suc = 0;
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

$suc = $suc + 1;
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

$suc = $suc + 1;    
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

$suc = $suc + 1;
}else{
  $err = $err + 1;
}   

break;
  }
 }

//echo $err;
//-------sort out output here-------------//

echo mysql_error();
header("Location: re-payments.php?code=700&o=".$err."&s=".$suc);
exit();

}
?>
<!doctype html>
<html class="no-js" lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title> Administrator Panel - Due Payments</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->
        <link rel="stylesheet" href="css/vendor.css">
        <!-- Theme initialization -->
        <script>
            var themeSettings = (localStorage.getItem('themeSettings')) ? JSON.parse(localStorage.getItem('themeSettings')) :
            {};
            var themeName = themeSettings.themeName || '';
            if (themeName)
            {
                document.write('<link rel="stylesheet" id="theme-style" href="css/app-green.css">');
            }
            else
            {
                document.write('<link rel="stylesheet" id="theme-style" href="css/app-green.css">');
            }
        </script>
<script language="javascript" src="js/users.js" type="text/javascript"></script>
    </head>

    <body>
        <div class="main-wrapper">
            <div class="app" id="app">
                <header class="header">
                    <div class="header-block header-block-collapse hidden-lg-up"> <button class="collapse-btn" id="sidebar-collapse-btn">
    			<i class="fa fa-bars"></i>
    		</button> </div>
                     <div class="header-block header-block-search hidden-sm-down">
                        <form role="search">
                            <div class="input-container"> <i class="fa fa-search"></i> <input type="search" placeholder="Search" autocomplete="off">
                                <div class="underline"></div>
                            </div>
                        </form>
                    </div>
                     <div class="header-block header-block-nav">
                        <ul class="nav-profile">
                            <li class="notifications new">
                                <a href="" data-toggle="dropdown"> <i class="fa fa-bell-o"></i> <sup>
<?php 
$id=$_SESSION['userSession'];
$sql = ("SELECT COUNT(*) FROM tbl_pending WHERE userID='$id'");
$rs = mysql_query($sql);
$result = mysql_fetch_array($rs);
$notification = $result[0];
?>            
    			      <span class="counter"><?php echo $notification ?></span>
    			    </sup> </a>
                                <div class="dropdown-menu notifications-dropdown-menu">
                                    <ul class="notifications-container">
                                       
 <?php 
$flag=0;
$id=$_SESSION['userSession'];
$pending="SELECT * FROM tbl_pending WHERE userID='$id'";
$pendingresult=mysql_query($pending); 
 while ($pendingrow = mysql_fetch_array($pendingresult)) {
?>                                 
                                        <li>
                                            <a href="" class="notification-item">
                                                <div class="img-col">
                                                    <div class="img" style="background-image: url('http://simpleicon.com/wp-content/uploads/user-3.svg')"></div>
                                                </div>
                                                <div class="body-col">
                                               <p><?php echo $pendingrow['username']; ?></b> allocated to pay you</p>
												<p><span>R<?php echo $pendingrow['amount']; ?></span></p>
                                                 </div>
                                            </a>
                                        </li>
<?php
 }
?>    
                                       
                                        
                                    </ul>
                                    <footer>
                                        <ul>
                                            <li> <a href="">
    			            View All
    			          </a> </li>
                                        </ul>
                                    </footer>
                                </div>
                            </li>
                            <li class="profile dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                    <div class="img" style="background-image: url('http://simpleicon.com/wp-content/uploads/user-3.svg')"> </div> 
                                    <span class="name"> <?php echo $row['Name']; ?> </span> </a>
                                <div class="dropdown-menu profile-dropdown-menu" aria-labelledby="dropdownMenu1">
                                    <a class="dropdown-item" href="profile.php"> <i class="fa fa-user icon"></i> Profile </a>
                                    <a class="dropdown-item" href="accounts.php"> <i class="fa fa-gear icon"></i>Account Settings </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="logout.php"> <i class="fa fa-power-off icon"></i> Logout </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </header>
                <aside class="sidebar">
                    <div class="sidebar-container">
                        <div class="sidebar-header">
                            <div class="brand">
                                <div class="logo"> 
                                <img src="logo.png" style="width:45px; margin-top:-45px;"> 
                                 </div> <span style="color:#52BCD3;">MyAdmin</span> </div>
                        </div>
                        <nav class="menu">
                            <ul class="nav metismenu" id="sidebar-menu">
                                <li>
                                    <a href="home.php"> <i class="fa fa-home"></i> Dashboard </a>
                                </li>
                                    <li class="active open">
                                    <a href=""> <i class="fa fa-arrows-h"></i> Assignment &nbsp; <i class="fa fa-caret-down"></i> </a>
                                    
                                    <ul>
                                        <!-- <li class="active"> <a href="re-payments.php"> <i class="fa fa-caret-right"></i> &nbsp;
    								R200s
                                </a> </li> -->
                                <li> <a href="due-payments.php"> <i class="fa fa-caret-right"></i> &nbsp;
    								Withdrawn Funds
    							</a> </li>
                                    </ul>
                                    
                                 </li>
                                <li>
                                    <a href=""> <i class="fa fa-th-large"></i> Manage Funds &nbsp; <i class="fa fa-caret-down"></i></a>
                                    
                                    <ul>
                                        <li> <a href="pending.php"><i class="fa fa-caret-right"></i> &nbsp;
    								Pending Funds
    							</a> </li><li> <a href="investment.php"><i class="fa fa-caret-right"></i> &nbsp;
    								Investments
    							</a> </li>
                                        <li> <a href="payments.php"><i class="fa fa-caret-right"></i> &nbsp;
    								Due Payments
    							</a> </li>
                                    </ul>
                                    
                                </li>
                                <li>
                                    <a href="shout-out.php"> <i class="fa fa-envelope-o"></i> Shout-Out  </a>
                                 </li>
                                <li>
                                    <a href="transactions.php"> <i class="fa fa-bar-chart"></i> Transaction Records </a>
                                 </li>
                                <li>
                                    <a href="users.php"> <i class="fa fa-users"></i> Clients Records</a>
                                  </li>
                               
                            </ul>
                        </nav>
                    </div>
                   
                </aside>
                <div class="sidebar-overlay" id="sidebar-overlay"></div>
               
               
               <div class="sidebar-overlay" id="sidebar-overlay"></div>
                <article class="content responsive-tables-page">
                    <div class="title-block">
                        <h1 class="title">

            Payments Confirmation
	</h1>
                        <p class="title-description"> This panel consists of the matured funds to be allocated. </p>
                    </div>
                   
                    <section class="section">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">

                                    <div class="card-block">
                                        <section class="example">
                                            <div class="table-flip-scroll">
                                                
<form name="frmUser" method="post" action="">                                               
                                                
                                                <table class="table table-striped table-bordered table-hover flip-content">
                                                    <thead class="flip-header">
                                                        <tr>
                                                            <th>#Id</th>
                                                            <th>Name</th>
                                                            <th>Amount</th>
                                                            <th>Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
<?php
$rowCount = count($_POST["users"]);
for($i=0;$i<$rowCount;$i++) {
$result = mysql_query("SELECT * FROM tbl_orders WHERE userID='".$_POST["users"][$i]."'");
$row[$i]= mysql_fetch_array($result);
?>
                                    

<tr>
    
<input type="hidden" name="userID[]" value="<?php echo $row[$i]['userID']; ?>">
    
<input type="hidden" value="<?php echo $row[$i]['userID']; ?>">

<td><input type="hidden" name="traceid[]" value="<?php echo $row[$i]['traceid']; ?>"><?php echo $row[$i]['traceid']; ?></td>

<td><input type="hidden" name="name[]" value="<?php echo $row[$i]['name']; ?>"><?php echo $row[$i]['name']; ?></td>

<td><input type="hidden" name="price[]" value="<?php echo $row[$i]['price']; ?>"><?php echo $row[$i]['price']; ?></td>

<td><input type="hidden" name="date[]" value="<?php echo $row[$i]['date']; ?>"><?php echo $row[$i]['date']; ?></td>
                                              
</tr>
              
<?php
}
?>
<tr>
<td colspan="5">
<!--button type="submit" class="btn btn-primary-outline">Pay All</button--> 
<input type="submit" class="btn btn-success-outline" name="submit" value="Confirm Payments">  
</td>
</tr>    
</form>                                                 
                                                    </tbody>
                                                </table>
                                            </div>
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </article>
               
              
                <footer class="footer">
                   <div class="footer-block author">
                        <ul>
                            <li> Copyright 2017. <a href="">All rights reserved</a></li></li>
                        </ul>
                    </div>
                </footer>
               
            </div>
        </div>
        <!-- Reference block for JS -->
        <div class="ref" id="ref">
            <div class="color-primary"></div>
            <div class="chart">
                <div class="color-primary"></div>
                <div class="color-secondary"></div>
            </div>
        </div>
        <script src="js/vendor.js"></script>
        <script src="js/app.js"></script>
    </body>

</html>