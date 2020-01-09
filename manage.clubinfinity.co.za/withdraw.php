<?php
session_start();
date_default_timezone_set('Africa/Johannesburg');
require_once 'config.php';
require_once 'smss.php';
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
?>
<!doctype html>
<html class="no-js" lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title> Administrator Panel - Withdraw </title>
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
    </head>

    <body>
        <div class="main-wrapper">
            <div class="app" id="app">
                <header class="header">
                    <div class="header-block header-block-collapse hidden-lg-up"> <button class="collapse-btn" id="sidebar-collapse-btn">
    			<i class="fa fa-bars"></i>
    		</button> </div>
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
                                <li>
                                    <a href="provide.php"> <i class="fa fa-exchange"></i> Provide Help  </a>
                                 </li>
                                <li class="active">
                                    <a href="investment.php"> <i class="fa fa-calendar"></i> Manage Funds </a>
                                </li>
                                <li>
                                    <a href="acknowledge.php"> <i class="fa fa-check-square"></i> Acknowledge Help  </a>
                                 </li>
                                <li>
                                    <a href="transactions.php"> <i class="fa fa-bar-chart"></i> Transaction Records </a>
                                 </li>
                                <li>
                                    <a href="dl.php"> <i class="fa fa-deMytop"></i> My Refferals </a>
                                  </li>
                                <!--li>
                                    <a href="support.php"> <i class="fa fa-comments-o"></i> Support  </a>
                                </li-->
                            </ul>
                        </nav>
                    </div>
                   
                </aside>
                <div class="sidebar-overlay" id="sidebar-overlay"></div>
               
               
               <div class="sidebar-overlay" id="sidebar-overlay"></div>
                <article class="content responsive-tables-page">
                  
                    <section class="section">
                        <div class="row">
                            
                            <!-- /.col-xl-4 -->
                            <div class="col-xl-12">
                                <div class="card card-danger">
                                    <div class="card-header">
                                        <div class="header-block">
                                            <p class="title"> Investment Details </p>
                                        </div>
                                    </div>
                                    <div class="card-block">
                                  
                                  
                                  
		 <div class="but_list">
                    
<?php
if(isset($_POST['withdraw'])){


$stmt = $user_home->runQuery("SELECT * FROM tbl_helpers WHERE userID=:my_id");
$stmt->execute(array(":my_id"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if($stmt->rowCount() > 0){
echo "<div class='alert alert-danger' role='alert'>
	<strong>WARNING!</strong>  You are only allowed to provide help once at a time! Please settle the first one before you make another one.
</div> ";
exit();
}


$stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:uid LIMIT 1");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$userName = $row['userName'];
$bank = $row['bank'];
$con = $row['Contact'];

$amount = $_POST['amount'];
$id = $_SESSION['userSession'];

$orders = "INSERT INTO tbl_orders VALUES('$id','0','$userName','$amount','$bank','$date')";
mysql_query($orders);

mysql_query("DELETE FROM tbl_waitinglist WHERE userID='$id'");
echo mysql_error();

echo "<div class='alert alert-success' role='alert'>
	<strong>Success!</strong>  You have successfully placed a withdrawal notice of R".$amount.". Please note that allocations will take 24 to 48hours. Thank You
	</div>
    </div>
		</div>
    "; 
    exit();
} 
                 
?>  
<?php
$stmt = $user_home->runQuery("SELECT * FROM tbl_waitinglist WHERE userID=:uid LIMIT 1");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$date1 = new DateTime($row['date']);
$date2 = new DateTime($date);
$diff = $date2->diff($date1)->format("%a");
?>

<p>You are about to make a withdrawal of your investment. </p>

<p><strong>Invested Date: </strong> <?php echo $row['mdate']; ?><br>
<strong>Invested amount: </strong> R<?php echo $row['price']; ?><br>
<strong>Interest Earned: </strong> R<?php echo $_POST['interest']; ?></p>
<br>
<p><h4><strong>Withdrawal Date:</strong> <?php echo $date; ?></h4></p>
<p><h4><strong>Investment Duration:</strong> <?php echo $diff; ?> day(<small>s</small>)</h4></p>
<?php
$input = $_POST['amount'];
$number = floor($input / 500) * 500;
?>
<p><h4><strong>Balance:</strong> R<?php echo $_POST['amount']; ?></h4></p>
<p><h4><strong>Withdrawal Balance:</strong> R<?php echo $number; ?></h4></p>

<form action="withdraw.php" method="POST">
    <input type="hidden" name="amount" value="<?php echo $number; ?>">
    <a href="investment.php" class="btn btn-info-outline">Cancel</a>
<button type="submit" name="withdraw" class="btn btn-success-outline">Withdraw Now</button>
</form>
               </div>
                                  
                                  
                                  
                                   </div>
                                   </div>
                            </div>
                            <!-- /.col-xl-4 -->
                            
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