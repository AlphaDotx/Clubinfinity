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
        <title> Administrator Panel - Pending Payments</title>
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
                     <div class="header-block header-block-search hidden-sm-down">
                        <form role="search" action="" method="post">
                            <div class="input-container"> <i class="fa fa-search"></i> <input type="search" name="search" placeholder="Search" autocomplete="off">
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
                                <li class="active">
                                    <a href="home.php"> <i class="fa fa-home"></i> Dashboard </a>
                                </li>
                                <li>
                                    <a href=""> <i class="fa fa-arrows-h"></i> Assignment &nbsp; <i class="fa fa-caret-down"></i> </a>
                                    
                                    <ul>
                                        <li> <a href="re-payments.php"> <i class="fa fa-caret-right"></i> &nbsp;
    								R200s
    							</a> </li>
    							<li> <a href="payments.php"> <i class="fa fa-caret-right"></i> &nbsp;
    								Withdrawn Funds
    							</a> </li>
                                    </ul>
                                    
                                 </li>
                                <li>
                                    <a href=""> <i class="fa fa-th-large"></i> Manage Funds &nbsp; <i class="fa fa-caret-down"></i></a>
                                    
                                    <ul>
                                        <li> <a href="investors.php"><i class="fa fa-caret-right"></i> &nbsp;
    								Investors
    							</a> </li>
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

            Offered Funds
	</h1>
                        <p class="title-description"> This panel consists of the help offers pending to be allocated. </p>
                    </div>
                   
                    <section class="section">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
<?php                    
if(isset($_GET['code'])){	
     if($_GET['code'] == 700){
        ?>    
	<div class="alert alert-success">You have successfully reversed the payment. The receiver will be taken back to Orders to be reallocated</div>       
      <?php 
    }   
}
?>                                 <div class="card-block">
                                       
                                        <section class="example">
                                            <div class="table-flip-scroll">
                                                <table class="table table-striped table-bordered table-hover flip-content">
                                                    <thead class="flip-header">
                                                        <tr>
                                                            <th>#Id</th>
                                                            <th>Name</th>
                                                            <th>Amount</th>
                                                            <th>Date</th>
                                                            <th>Manage</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
<?php   
$link = basename($_SERVER['PHP_SELF']);                                                        
if(isset($_POST['search']) AND $_POST['search'] !== ''){
$search  = $_POST['search']; 
                                                        
$stmt = $user_home->runQuery("SELECT * FROM tbl_helpers WHERE  traceid like '%$search%' || name like '%$search%' || date like '%$search%' ORDER BY `tbl_helpers`.`date` DESC");
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
while($row = $stmt->fetch()) {
?>
<tr>                                
<td><?php echo $row['traceid']; ?></td>
<td><?php echo $row['name']; ?></td>
<td>R<?php echo $row['price']; ?></td>
<td><?php echo $row['date']; ?></td>  
<td>

<div class="btn-group">
<button class="btn btn-primary btn-xs">Action</button>
<button data-toggle="dropdown" class="btn btn-primary btn-xs dropdown-toggle"><span class="caret"></span></button>
<ul class="dropdown-menu">

<li><a href="edit-offers.php?trace=<?php echo $row['traceid']; ?>"> &nbsp;&nbsp;<i class="fa fa-check-square-o" aria-hidden="true"></i> Edit</a></li>

</ul>
</div>

</td>                                
</tr>                                      
<?php
 }
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