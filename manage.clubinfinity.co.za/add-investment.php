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
$contact = $row['Contact'];
?>
<!doctype html>
<html class="no-js" lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title> Administrator Panel - Provide Help </title>
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
                                    <a href=""> <i class="fa fa-arrows-h"></i> Assignment &nbsp; <i class="fa fa-caret-down"></i> </a>
                                    
                                    <ul>
                                        <!-- <li> <a href="re-payments.php"> <i class="fa fa-caret-right"></i> &nbsp;
    								R200s
                                </a> </li> -->
                                <li> <a href="payments.php"> <i class="fa fa-caret-right"></i> &nbsp;
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
                                <li class="active">
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
		Investment Options
	</h1>
                    </div>

                    <section class="section">
                        <div class="row">
                          
                           
<div class="col-md-12">
                                <div class="card card-block sameheight-item">
                                  
    <form role="form" action="make-order.php" method="POST">
     <div class="form-group has-error">
         <label class="control-label" for="inputError1">You are about to place an investment for <strong> <?php echo $_GET['name']; ?></strong></label> 
        <input type="text" name="amount" class="form-control boxed" placeholder="Enter amount" id="inputError1">
                     <!-- <option value="">Make a select here!</option>
                     <option value="200">R200</option>
                     <option value="400">R400</option>
                     <option value="500">R500</option>
                     <option value="1000">R1000</option>
                     <option value="2000">R2000</option>
                     <option value="3000">R3000</option>
                     <option value="4000">R4000</option>
                     <option value="5000">R5000</option> -->
                     <!-- <option value="6000">R6000</option>
                     <option value="6500">R6500</option>
                     <option value="7000">R7000</option>
                     <option value="7500">R7500</option>
                     <option value="8000">R8000</option>
                     <option value="8500">R8500</option>
                     <option value="9000">R9000</option>
                     <option value="9500">R9500</option> -->
                     <!-- <option disabled>---------Monthly Option-----------</option>
                     <option value="10000">R10 000</option>
                     <option value="20000">R20 000</option>
                     <option value="30000">R30 000</option>
                     <option value="40000">R40 000</option>
                     <option value="50000">R50 000</option>
                     <option value="60000">R60 000</option>
                     <option value="70000">R70 000</option>
                     <option value="80000">R80 000</option>
                     <option value="90000">R90 000</option>
                     <option value="100000">R100 000</option>
                     <option value="110000">R110 000</option>
                     <option value="120000">R120 000</option>
                     <option value="130000">R130 000</option>
                     <option value="140000">R140 000</option>
                     <option value="150000">R150 000</option>
                     <option value="160000">R160 000</option>
                     <option value="170000">R170 000</option>
                     <option value="180000">R180 000</option>
                     <option value="190000">R190 000</option>
                     <option value="200000">R200 000</option> -->
                     </select>
        <!-- <span class="has-info">Select the desired amount you would like to invest. -->
        </span> 
        </div>
        
        <input type="hidden" name="userid" value="<?php echo $_GET['userid']; ?>">
        <input type="hidden" name="name" value="<?php echo $_GET['name']; ?>">
      <button type="submit" id="submit" class="btn btn-primary-outline btn-lg btn-block">Investment Proceed</button>
                                </form>
                            </div>
                        </div>
            </div>
                     
                     </form>
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