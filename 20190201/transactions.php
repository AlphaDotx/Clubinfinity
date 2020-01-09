<?php
session_start();
require_once 'class.user.php';
//require_once 'config.php';
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
        <title> Administrator Panel | Transactions </title>
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
    		      </button></div>
                    <div class="header-block header-block-search hidden-sm-down">
                        <form role="search" action="" method="post"s>
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
                                <li>
                                    <a href="home.php"> <i class="fa fa-home"></i> Dashboard </a>
                                </li>
                                   <li>
                                    <a href=""> <i class="fa fa-arrows-h"></i> Assignment &nbsp; <i class="fa fa-caret-down"></i> </a>
                                    
                                    <ul>
                                        <li> <a href="re-payments.php"> <i class="fa fa-caret-right"></i> &nbsp;
    								R200s
    							</a> </li><li> <a href="payments.php"> <i class="fa fa-caret-right"></i> &nbsp;
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
                                <li class="active">
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
		Transaction Records
	</h1>
<p class="title-description"> This panel consists of all your the incoming and outgoing transactions  </p>
                    </div>
                   
                    <section class="section">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-block">
<?php                    
if(isset($_GET['code'])){	
     if($_GET['code'] == 700){
        ?>    
	<div class="alert alert-success">You have successfully accepted payment. Thank you</div>       
    <?php 
    }elseif ($_GET['code'] == 701){ 
  ?>
  <div class="alert alert-success">Transaction record is successfully deleted!</div>  
<?php
}
}
?>
                                        <section class="example">
                                            <div class="table-flip-scroll">
                                                <table class="table table-striped table-bordered table-hover flip-content">
                                                    <thead class="flip-header">
                                                        <tr>
                                                            <th>#Id</th>
                                                            <th>From</th>
                                                            <th>To</th>
                                                            <th>Amount</th>
                                                            <th>Status</th>
                                                            <th>Date</th>
                                                            <th>Manage</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
<?php                  

$link = basename($_SERVER['PHP_SELF']);
              
if(isset($_POST['search']) AND $_POST['search'] !== ''){
  
$search  = $_POST['search'];  
              
$stmt = $user_home->runQuery("SELECT * FROM tbl_history WHERE  traceid like '%$search%' || hfrom like '%$search%' || hto like '%$search%' || date like '%$search%' ORDER BY `tbl_history`.`date` DESC");
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
while($row = $stmt->fetch()) {
?>
                                    
 <tr>
      <td><?php echo $row['traceid']; ?></td>
      <td><?php echo $row['hfrom']; ?></a></td>
      <td><?php echo $row['hto']; ?></td>
      <td>R<?php echo $row['amount']; ?></td>
      
      <td style="text-align:center">
      <?php 
      if($row['status']==0){
         echo "<label class='label label-warning'>pending</label>";
      }elseif($row['status']==1){
         echo "<label class='label label-success'>Paid</label>";
      }else{
         echo "<label class='label label-danger'>Cancelled</label>";
      }
       ?></td>
       <td><?php echo $row['date']; ?></td>
        <td> 
 
    
<div class="btn-group">
<button class="btn btn-primary btn-xs">Action</button>
<button data-toggle="dropdown" class="btn btn-primary dropdown-toggle btn-xs"><span class="caret"></span></button>
<ul class="dropdown-menu">
<?php
if($row['status'] == 0){
?>
<li><a href="confirm.php?traceid=<?php echo $row['traceid']; ?>"  onclick="return confirm('Are you sure you want to confirm this transaction?')"> &nbsp;&nbsp;<i class="fa fa-check-square-o" aria-hidden="true"></i> Confirm Payment</a></li>
 <?php
}
?>     
<li><a href="cancel.php?traceid=<?php echo $row['traceid']; ?>?link=<?php echo $link; ?>"  onclick="return confirm('Are you sure you want to reverse this transaction? \n No that the payer will be blocked and the receiver will be returned to payments')"> &nbsp;&nbsp; <i class="fa fa-trash" aria-hidden="true"></i> Cancel </a></li>
    
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