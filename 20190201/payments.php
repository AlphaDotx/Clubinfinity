<?php
session_start();
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
                                 </div> My <span style="color:#52BCD3;">Admin</span> </div>
                        </div>
                        <nav class="menu">
                            <ul class="nav metismenu" id="sidebar-menu">
                                <li>
                                    <a href="home.php"> <i class="fa fa-home"></i> Dashboard </a>
                                </li>
                                     <li class="active open">
                                    <a href=""> <i class="fa fa-arrows-h"></i> Assignment &nbsp; <i class="fa fa-caret-down"></i> </a>
                                    
                                    <ul>
                                        <li> <a href="re-payments.php"> <i class="fa fa-caret-right"></i> &nbsp;
    								R200s
    							</a> </li><li class="active"> <a href="payments.php"> <i class="fa fa-caret-right"></i> &nbsp;
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
                                        <li> <a href="due-payments.php"><i class="fa fa-caret-right"></i> &nbsp;
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

            Matured Funds
	</h1>
                        <p class="title-description"> This panel consists of the matured funds invested on the system. </p>
                    </div>
                   
                    <section class="section">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
   <?php
if(isset($_GET['code'])){ 
    
$helpername = @$_GET['helper'];
$helperoffer = @$_GET['offer'];
$username = @$_GET['user'];
$change = @$_GET['change'];     
    
if($_GET['code']==700){
echo  "<div class='alert alert-success'>
<b>Success</b> ".$_GET['s']." Payments allocation was successful.
</div>";  
 echo '<div class="alert alert-warning fade in">
         <strong>Alert!</strong> Note that '.$_GET['o'].' payments was returned. </a>.
      </div>';
     
}elseif($_GET['code']==600){
 echo '<div class="alert alert-danger fade in">
         <strong>Success!</strong> Funds are successfully deleted from the payments</a>.
      </div>';   
}elseif($_GET['code']==701){
 echo '<div class="alert alert-success fade in">
         <strong>Success!</strong> You successfully allocated <b>'.$helpername.'</b> to make the payment of <b>R'.$helperoffer.'</b> to <b>'.$username.'</b></a>.
      </div>';   
}elseif($_GET['code']==801){
 echo '<div class="alert alert-success fade in">
         <strong>Success!</strong> You successfully allocated <b>'.$helpername.'</b> to make the payment of <b>R'.$helperoffer.'</b> to <b>'.$username.'</b>. The payment order of <b>R'.$change.'</b> is still remaining.
      </div>';  
}              
}
?>
                                    <div class="card-block">
                                        <section class="example">
                                            <div class="table-flip-scroll">
<form name="frmUser" method="post" action="">                                               
<!--button type="submit" class="btn btn-primary-outline">Pay All</button--> 
<button type="submit" class="btn btn-warning-outline"  onClick="setUpdateAction();" >Pay Selected</button> 
                                                
                                                <table class="table table-striped table-bordered table-hover flip-content">
                                                    <thead class="flip-header">
                                                        <tr>
                                                            <th></th>
                                                            <th>#Id</th>
                                                            <th>Name</th>
                                                            <th>Amount</th>
                                                            <th>Date</th>
                                                            <th>Manage</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
<?php
date_default_timezone_set('Africa/Johannesburg');
$date = date('Y-m-d', time());

$link = basename($_SERVER['PHP_SELF']);
                                                        
$i=0;

 $stmt = $user_home->runQuery("SELECT * FROM tbl_orders ORDER BY `tbl_orders`.`date` ASC");
 $stmt->setFetchMode(PDO::FETCH_ASSOC);
 $stmt->execute();
 while($row = $stmt->fetch()) {

if($i%2==0)
$classname="evenRow";
else
$classname="oddRow";
?>
                                    
<tr class="<?php if(isset($classname)) echo $classname;?>">
<td><input type="checkbox" name="users[]" value="<?php echo $row["userID"]; ?>" ></td>
<td><?php echo $row["traceid"]; ?></td>
<td><?php echo $row["name"]; ?></td>
<td>R<?php echo $row["price"]; ?></td>
<td><?php echo $row["date"]; ?></td>

<td>   
<div class="btn-group">
<button class="btn btn-primary btn-xs">Action</button>
<button data-toggle="dropdown" class="btn btn-primary btn-xs dropdown-toggle"><span class="caret"></span></button>
<ul class="dropdown-menu">

<li><a href="allocation-process.php?userid=<?php echo $row['userID']; ?>&&orderid=<?php echo $row['traceid']; ?>&&amount=<?php echo $row['price']; ?>&link=<?php echo $link; ?>" class="btn btn-warning btn-xs"> Make Payment <i class="fa fa-arrow-right" aria-hidden="true"></i>
</a>
</li>
    
<!--div class="dropdown-divider"></div>    
<li><a href="edit-pending.php?trace=<?php echo $row['traceid']; ?>">&nbsp;&nbsp;<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a></li-->
<!--div class="dropdown-divider"></div>    
<!--li><a href="delete-payment.php?traceid=<?php echo $row['traceid']; ?>" Onclick='return confirm("Are you sure you want to DELETE this record? \n This will remove the payment from the system and There is no Undo for this transaction!");'>&nbsp;&nbsp;<i class="fa fa-trash" aria-hidden="true"></i> Delete</a></li-->
</ul>
</div>      
</td>
                                                
</tr>
<?php
$i++;
}
?>
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