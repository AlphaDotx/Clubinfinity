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
        <title> Administrator Panel - Accounts </title>
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
                           
                                         
                                      <img src="logo.png" style="width:45px; margin-top:-45px;"> </div>
                                <span style="color:#52BCD3;">MyAdmin</span> </div>
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
		Member Detail Update
	</h1><p class="title-description"> Updating details of a member </p>
                    </div>
                   
                    <section class="section">
                        <div class="row">
                            

<?php
if(isset($_POST['btn-submit'])){
$date = @date('Y M d | H:i:s');
$Uname = $_POST['uname'];
$Name = $_POST['name'];
$Contact = $_POST['contact'];
$Email = $_POST['email'];
$bank = $_POST['bank'];
$account_no = $_POST['account_no'];

$stmt = $user_home->runQuery("UPDATE tbl_users SET Name=:name_user, Contact=:user_contact, bank=:user_bank, account_no=:user_account_no WHERE userID=:uid");
$stmt->execute(array(":name_user"=>$Name,":user_contact"=>$Contact,":user_bank"=>$bank,":user_account_no"=>$account_no,":uid"=>$_GET['userid']));
    

$msg = "<div class='alert alert-success'>
Changes are successfully saved to ".$Uname.' '.$Name."`s profile record.
</div>"; 

$user_home->auditTrail($_SESSION['userSession'], 'edited '.$Name.' '.$Uname.'`s profile record', $date);
}
?>
<form action="#" method="post" class="mt" role="form">
<?php echo @$msg; ?>

<?php
        
$id = $_GET['userid'];     
$stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:uid");
$stmt->execute(array(":uid"=>$id));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>  
                            
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-block">
                                       
                                        <section class="example">
                                    
                                      <div class="form-group has-success"> <label class="control-label" for="inputSuccess1">Username:</label> <input type="text" name="uname" value="<?php echo $row['userName']; ?>" disabled class="form-control underlined" id="inputSuccess1"  ></div>
                                      <input type="hidden" class="form-control underlined" name="uname" value="<?php echo $row['userName']; ?>"  id="inputError1">
                                        <div class="form-group has-success"> <label class="control-label" for="inputSuccess1">Full Names:</label> <input type="text" name="name" value="<?php echo $row['Name']; ?>" class="form-control underlined" id="inputSuccess1"  ></div>
                                        <div class="form-group has-success">
                                        <label class="control-label" for="inputWarning1">Contact Number:</label> <input type="text" name="contact" value="<?php echo $row['Contact']; ?>" class="form-control underlined" id="inputWarning1"  > </div>
                                        <div class="form-group has-success">
                                        <!--label class="control-label" for="inputError1">Email Address:</label--> <input type="hidden" class="form-control underlined" name="email" value="<?php echo $row['userEmail']; ?>"  id="inputError1"></div>
<br>
<h3>Banking Details</h3>
                                            
                                      <div class="form-group"> <label class="control-label">Account Holder</label> <input type="text" name="bank" value="<?php echo $row['bank']; ?>" class="form-control underlined" required> </div>
                                      <div class="form-group"> <label class="control-label">Account Number</label> <input type="text" name="account_no" value="<?php echo $row['account_no']; ?>" class="form-control underlined" required> </div>
                                      <!--div class="form-group"> <label class="control-label">Account Type</label>   <input type="text" name="account_type" value="<?php echo $row['account_type']; ?>" class="form-control underlined" required> </div-->
                                     <a href="users.php" class="btn btn-secondary">Cancel</a>  <button type="submit" name="btn-submit" class="btn btn-primary">Save Changes</button>
                                    </form>
                                          
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